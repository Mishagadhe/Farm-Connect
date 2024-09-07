<?php
session_start();

// డేటాబేస్ కనెక్షన్
$conn = mysqli_connect("localhost", "root", "", "farmconnect");

// కనెక్షన్ చెక్
if (!$conn) {
    die("కనెక్షన్ విఫలమైంది: " . mysqli_connect_error());
}

// కార్ట్ సెషన్ వేరియబుల్ సెట్ అయింది లేదా లేదు అని తనిఖీ చేయండి
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// కార్ట్ నుండి ఐటంను తొలగించే ఫంక్షన్
function removeQuantityFromCart($id, $remove_quantity) {
    if (array_key_exists($id, $_SESSION['cart'])) {
        // తొలగించడానికి నిర్దిష్ట పరిమాణం ప్రస్తుత పరిమాణం కంటే ఎక్కువగా ఉంటే చూడండి
        if ($remove_quantity >= $_SESSION['cart'][$id]) {
            // ఐటంను కార్టు నుండి పూర్తిగా తొలగించండి
            unset($_SESSION['cart'][$id]);
        } else {
            // ఐటం స్టాక్ నుండి పరిమాణం తొలగించడానికి
            $_SESSION['cart'][$id] -= $remove_quantity;
        }
    }
}

// తొలగించడానికి బటన్ నొక్కబడింది లేదా లేదా అని తనిఖీ చేయండి
if (isset($_POST['remove'])) {
    $crop_id = $_POST['crop_id'];
    $remove_quantity = (int)$_POST['remove_quantity']; // పూర్తిగా మార్చడానికి

    // కార్టు నుండి నిర్దిష్ట పరిమాణం తొలగించే ఫంక్షన్ను కాల్ చేయండి
    removeQuantityFromCart($crop_id, $remove_quantity);
}

// మొత్తం ధర స్థిరార్ధం
$totalPrice = 0;

// ఓర్డర్ బటన్ నొక్కబడిందా లేదా లేదా అని తనిఖీ చేయండి
if (isset($_POST['place_order'])) {
    // యూజర్ ఇమెయిల్ను సెషన్ నుండి పొందండి
    $user_email = $_SESSION['email'];

    // ప్రస్తుత తేదీని పొందండి
    $order_date = date('Y-m-d');

    // డేటాబేస్ నుండి యూజర్ వివరాలను తీసుకోండి
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
        echo "ఈ ఇమెయిల్‌తో యొక్క ఫార్మర్ కనుగొనబడలేదు.";
        exit();
    }

    // ఓర్డర్ వివరాలను డేటాబేస్‌లో ఎంచుకోడాం
    foreach ($_SESSION['cart'] as $crop_id => $quantity) {
        // డేటాబేస్‌ను నుండి క్రాప్ వివరాలను (క్రాప్ పేరును కూడా) పొందండి
        $sql_crop = "SELECT cropname, cropprice FROM addcrops WHERE cropid = '$crop_id'";
        $result_crop = mysqli_query($conn, $sql_crop);
        $crop_data = mysqli_fetch_assoc($result_crop);
        $crop_name = $crop_data['cropname'];

        // ఓర్డర్ కోసం మొత్తం ధరను కల్పించండి
        $total_price = $crop_data['cropprice'] * $quantity;

        // ఓర్డర్ వివరాలను డేటాబేస్ టేబులులో ఇన్‌సర్ట్ చేయండి
        $sql_order = "INSERT INTO orders (email, fullname, cropid, cropname, quantity, price, order_date, street, district, mandal, state) VALUES ('$user_email', '$username', '$crop_id', '$crop_name', '$quantity', '$total_price', '$order_date', '$street', '$district', '$mandal', '$state')";
        mysqli_query($conn, $sql_order);
    }

    // ఓర్డర్ ప్లేస్ చేసిన తరువాత కార్ట్‌ను క్లియర్ చేయండి
    $_SESSION['cart'] = array();

    // కన్ఫర్మ్ చేయడానికి లేదా మరో పేజీకి దానికి రీడెయిర్యండి
    header("Location: confirm_farmerorder.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="te">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>చెక్ చేయండి</title>
    <style>
        /* మీ CSS శైలీలను ఇక్కడ జోడించండి */
        /* ఇక్కడ మీ CSS శైలీలను జోడించండి */
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
            background-color: #4caf50; /* Red color for logout button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        /* Add hover effect for the logout button */
        .logout-button:hover {
            background-color:#95b591b9; /* Darker green on hover */
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

        .remove-btn:hover {
            background-color:#95b591b9; /* Darker green on hover */
;
        }

        .place-order-button {
    display: block; /* Display as a block element */
    margin: 80px auto; /* Center the button horizontally and add margin for space */
    padding: 12px 24px; /* Increase padding for a larger size */
    background-color: #4caf50; /* Green background color */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px; /* Larger font size for better readability */
    text-align: center;
}

/* Add hover effect for the place order button */
.place-order-button:hover {
    background-color: #95b591b9; /* Darker green on hover */
}
    </style>
</head>
<body>
<header>
        <img src="logo.jpeg" alt="లోగో">
        <h1>ఫార్మ్ కనెక్ట్</h1>
        <h3>కల్టివేట్.కనెక్ట్.థ్రైవ్</h3>
        <nav>
            <ul>
                <!-- ఇక్కడ లాగౌట్ బటన్ జోడించండి -->
                <li>
                    <form action="gmaillogin.php" method="post">
                        <button type="submit" name="logout" class="logout-button">లాగౌట్</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>
    <h2>షాపింగ్ కార్ట్</h2>
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
        // కార్టులో ఐటంలను లూప్ చేయండి
        foreach ($_SESSION['cart'] as $id => $quantity) {
            // డేటాబేస్ నుండి క్రాప్ వివరాలను పొందండి
            $sql = "SELECT * FROM addcrops WHERE cropid = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // ఈ ఐటంకు మొత్తం ధరను లెక్కించండి
            $itemTotal = $row['cropprice'] * $quantity;
            $totalPrice += $itemTotal; // మొత్తం ధరను మొత్తం ధరకు జోడించండి

            $crop_name=$row['cropname'];
            // ఈ క్రాప్ కోసం టేబుల్ వరుసను తీసుకొనండి
            echo "<tr>";
            echo "<td>{$row['cropname']}</td>";
            echo "<td><img src='{$row['image']}' alt='{$row['cropname']}' style='max-width: 100px;'></td>";
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

        // మొత్తం ధర వరుస నుండి మొత్తం ధరను చూపండి
        echo "<tr>";
        echo "<td colspan='4'><strong>మొత్తం:</strong></td>";
        echo "<td colspan='2'>$totalPrice</td>";
        echo "</tr>";
        ?>
    </table>

    <!-- ఓర్డర్ బటన్ -->
    <form action="" method="post">
        <button type="submit" name="place_order" class="place-order-button">ఆర్డర్ చేయండి</button>
    </form>
</body>
</html>
