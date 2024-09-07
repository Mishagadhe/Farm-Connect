<?php
session_start();

// డేటాబేస్ కనెక్షన్
$conn = mysqli_connect("localhost", "root", "", "farmconnect");

// కనెక్షన్ చూడండి
if (!$conn) {
    die("కనెక్షన్ విఫలమైంది: " . mysqli_connect_error());
}

// కార్ట్ సెషన్ వేరియబుల్ సెట్ ఉండటం నిరీక్షించండి
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// కార్ట్ నుండి ఐటం తొలగించడానికి ఫంక్షన్
function removeQuantityFromCart($id, $remove_quantity) {
    if (array_key_exists($id, $_SESSION['cart'])) {
        // తొలగించడానికి మాత్రమే కోల్పోతున్న పరిమాణం ప్రస్తుతం ఉంటే నిర్ధారించండి
        if ($remove_quantity >= $_SESSION['cart'][$id]) {
            // ఐటం నుండి కార్ట్ నుండి మొత్తం తొలగించండి
            unset($_SESSION['cart'][$id]);
        } else {
            // కార్ట్‌లో ఐటం పరిమాణం తగ్గించండి
            $_SESSION['cart'][$id] -= $remove_quantity;
        }
    }
}

// తొలగించు బటన్ నొక్కితే నిర్ధారించండి
if (isset($_POST['remove'])) {
    $crop_id = $_POST['crop_id'];
    $remove_quantity = (int)$_POST['remove_quantity']; // పూర్తిగా నిర్ధారించండి

    // కార్ట్ నుండి నిర్ధారించిన పరిమాణం తొలగించు ఫంక్షన్ ను పిలుస్తుంది
    removeQuantityFromCart($crop_id, $remove_quantity);
}

// సమీక్షా చెల్లింపు బటన్ నొక్కితే
if (isset($_POST['place_order'])) {
    // యూజర్ ఇమెయిల్‌ను సెషన్ నుండి పొందండి
    $user_email = $_SESSION['email'];

    // ప్రస్తుత తేదీని పొందండి
    $order_date = date('Y-m-d');

    // డేటాబేస్ నుండి యూజర్ వివరాలను తనిఖీ చేయండి
    $query = "SELECT Fullname, street, district, mandal, state FROM farmer WHERE email = '$user_email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // యూజర్ వివరాలను పొందండి
        $row = $result->fetch_assoc();
        $username = $row['Fullname'];
        $street = $row['street'];
        $district = $row['district'];
        $mandal = $row['mandal'];
        $state = $row['state'];
    } else {
        echo "ఈ ఇమెయిల్‌తో ఎటువంటి రెండు ఫార్మర్‌లు కనుగొనబడలేదు.";
        exit();
    }

    // ప్రతి ఐటం యొక్క నిర్దిష్ట పరిమాణాన్ని కార్ట్‌లో ఇట్టిన తరువాత డేటాబేస్ లో ఆర్డర్ వివరాలను ఇన్‌సర్ట్ చేయండి
    foreach ($_SESSION['cart'] as $crop_id => $quantity) {
        // డేటాబేస్‌లో క్రాప్ వివరాలను పొందండి
        $sql_crop = "SELECT cropnametel, cropprice FROM addcrops WHERE cropid = '$crop_id'";
        $result_crop = mysqli_query($conn, $sql_crop);
        $crop_data = mysqli_fetch_assoc($result_crop);
        $crop_name = $crop_data['cropnametel'];

        // ఆర్డర్ కోసం మొత్తాన్ని గణన చేయండి
        $total_price = $crop_data['cropprice'] * $quantity;

        // ఆర్డర్ వివరాలను ఆర్డర్లు టేబులులో ఇన్‌సర్ట్ చేయండి
        $sql_order = "INSERT INTO qualitycheck (email, fullname, cropid, cropnametel, quantity, price, order_date, street, district, mandal, state) VALUES ('$user_email', '$username', '$crop_id', '$crop_name', '$quantity', '$total_price', '$order_date', '$street', '$district', '$mandal', '$state')";
        mysqli_query($conn, $sql_order);
    }

    // ఆర్డర్ ప్లేస్ చేయనంతవరకు కార్ట్ ను క్లియర్ చేయండి
    $_SESSION['cart'] = array();

    // కన్ఫిర్మ్ పేజీ లాంచ్ చేయండి
    header("Location: confirm_farmerorder.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="te">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>చెక్ అవుట్</title>
    <style>
        /* మీ CSS శైలిని ఇక్కడ జోడించండి */
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 0;
        }
        header {
            position: relative;
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }

        header img {
            position: absolute;
            top: 15px;
            left: 15px;
            width: 170px;
            height: auto;
            border-radius: 5%;
        }

        header h1 {
            margin: 0;
        }

        header h3 {
            margin: 0;
            color: #ffffff; 
        }

        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        nav li {
            margin: 2 10px;
        }

        nav li a {
            margin: 2 10px;
            text-decoration: none;
            color: white;
        }
        .logout-button {
            display: inline-block;
            padding: 10px;
            background-color: #4caf50; /* చురుకు రంగు */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        /* లాగ్‌అవుట్ బటన్ కోసం హోవర్ ఎఫెక్ట్ జోడించండి */
        .logout-button:hover {
            background-color:#95b591b9; /* హోవర్ పై ఎరుపుగా */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .remove-btn {
            padding: 5px 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* హోవర్ పై చురుకు రంగులో హోవర్ ఎఫెక్ట్ జోడించండి */
        .remove-btn:hover {
            background-color:#95b591b9;
        }

        .place-order-button {
            display: block;
            margin: 80px auto;
            padding: 12px 24px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
        }

        /* ప్లేస్ ఆర్డర్ బటన్ మీద హోవర్ ఎఫెక్ట్ జోడించండి */
        .place-order-button:hover {
            background-color: #95b591b9;
        }
    </style>
</head>
<body>
<header>
        <img src="logo.jpeg" alt="లోగో">
        <h1>ఫార్మ్ కనెక్ట్</h1>
        <h3>రెకలు. సంప్రదించండి. వెళ్ళండి</h3>
        <nav>
            <ul>
                <!-- లాగ్ అవుట్ బటన్ ఇక్కడ జోడించండి -->
                <li>
                    <form action="gmaillogin.php" method="post">
                        <button type="submit" name="logout" class="logout-button">లాగ్ అవుట్</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <h2>షాపింగ్ కార్టు</h2>
    <table>
        <tr>
            <th>క్రాప్</th>
            <th>చిత్రం</th>
            <th>పరిమాణం</th>
            <th>ధర</th>
            <th>మొత్తం</th>
            <th>చర్య</th>
        </tr>
        <?php
        // కార్టులో ఐటంల మీద లూపు చేయండి
        foreach ($_SESSION['cart'] as $id => $quantity) {
            // డేటాబేస్ నుండి క్రాప్ వివరాలను పొందండి
            $sql = "SELECT * FROM addcrops WHERE cropid = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // ఈ ఐటం కోసం మొత్తాన్ని గణన చేయండి
            $totalPrice=0;
            $itemTotal = $row['cropprice'] * $quantity;
            $totalPrice += $itemTotal; // మొత్తాన్ని మొత్తం ధరకు జోడించండి

            $crop_name=$row['cropnametel'];
            // ఈ క్రాప్ కోసం టేబుల్ వరుస వేరుగా ఎగుమతి చేయండి
            echo "<tr>";
            echo "<td>{$row['cropnametel']}</td>";
            echo "<td><img src='{$row['image']}' alt='{$row['cropnametel']}' style='max-width: 100px;'></td>";
            echo "<td>$quantity</td>";
            echo "<td>{$row['cropprice']}</td>";
            echo "<td>$itemTotal</td>";
            echo "<td>
                <form action='' method='post'>
                    <input type='hidden' name='crop_id' value='$id'>
                    <label for='remove_quantity'>పరిమాణం తొలగించు:</label>
                    <input type='number' name='remove_quantity' min='1' max='$quantity' value='1' required>
                    <button type='submit' name='remove' class='remove-btn'>తొలగించు</button>
                </form>
            </td>";
            echo "</tr>";
        }

        // మొత్తం ధరను బయటించు వరుసను ఎగుమతి చేయండి
        echo "<tr>";
        echo "<td colspan='4'><strong>మొత్తం:</strong></td>";
        echo "<td colspan='2'>$totalPrice</td>";
        echo "</tr>";
        ?>
    </table>

    <!-- ఆర్డర్ చేయండి బటన్ -->
    <form action="" method="post">
        <button type="submit" name="place_order" class="place-order-button">గుణమును తనిఖీ చేయండి</button>
    </form>
</body>
</html>
