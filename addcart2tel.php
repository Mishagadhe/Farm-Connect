<?php
session_start();
// డేటాబేస్ కనెక్షన్
$conn = mysqli_connect("localhost", "root", "", "farmconnect");

// కనెక్షన్ తనిఖీ చేయండి
if (!$conn) {
    die("కనెక్షన్ విఫలమైంది: " . mysqli_connect_error());
}

// చెక్ చేయండి మరియు కార్ట్ సెషన్ వేరియబుల్ సెట్ అయ్యింది లేదా లేదు
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$email = $_SESSION['email'];
$query = "SELECT Fullname, street, district, mandal, state FROM farmer WHERE email = '$email'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // వినియోగదారు వివరాలు పొందండి
    $row = $result->fetch_assoc();
    $username = $row['Fullname'];
    $street = $row['street'];
    $district = $row['district'];
    $mandal = $row['mandal'];
    $state = $row['state'];
} else {
    echo "ఈ ఇమెయిల్ తో ఫార్మర్ కనుగొనబడలేదు.";
    exit();
}

// ఐటం కార్ట్ లో జోడించడానికి ఫంక్షన్
function addToCart($id, $quantity) {
    // చెక్ చేయండి అందుబాటులో ఉంది లేదా లేదు
    if (array_key_exists($id, $_SESSION['cart'])) {
        $_SESSION['cart'][$id] += $quantity; // ఐటం ఉంది అయితే పరిమాణంను పెంచండి
    } else {
        $_SESSION['cart'][$id] = $quantity; // కొత్త ఐటం కార్ట్ కి జోడించండి
    }
}

// జోడించడానికి అడ్డు కార్ట్ బటన్ నొక్కితే
if (isset($_POST['add_to_cart'])) {
    $crop_id = $_POST['crop_id'];
    $quantity = $_POST['quantity'];
    addToCart($crop_id, $quantity);
}
if (isset($_POST['logout'])) {
    // అన్ని సెషన్ వేరియబుల్లను అస్తిత్వం లేనివి చేస్తుంది
    $_SESSION = array();

    // సెషన్ అన్నిటినీ అంతా మార్చేందుకు
    session_destroy();

    // gmaillogin.php లేదా ఏదో కావలసిన పేజీకి రిడెయిరెక్ట్
    header("Location: gmaillogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="te">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>కార్టుకు జోడించండి</title>
    <style>
        /* మీ CSS శైలిలను ఇక్కడ జోడించండి */
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
        h2 {
            text-align: center;
            margin-top: 30px; /* ఐటం మీద కొనసాగడానికి ముందు కొనసాగడానికి ముందు */
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
            background-color: #f44336; /* బదిలీ బటన్ కోసం ఎర్రటి రంగు */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        /* లాగౌట్ బటన్ కోసం హోవర్ ప్రభావాన్ని జోడించండి */
        .logout-button:hover {
            background-color: #e53935; /* హోవర్ పైన గాఢంగా ఎర్రటి */
        }

        /* ఇమోటికాన్ శైలింగ్ */
        .logout-button:before {
            content: "🔒 "; /* లాక్ ఇమోటికాన్ */
        }

        .crop-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        button[type="button"] {
            display: block;
            margin: 20px auto; /* బటన్ను నిర్దిష్టం పొందండి మరియు మార్జిన్ ప్రదర్శించండి */
            padding: 12px 24px; /* పెద్ద పరిమాణం కోసం పాడించండి */
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px; /* మీరు చదవగల మెరిసే అక్షరాలకు పెద్ద పరిమాణం */
        }

        /* చెక్ చేయండి బటన్ కోసం హోవర్ ప్రభావాన్ని జోడించండి */
        button[type="button"]:hover {
            background-color:#95b591b9; 
        }
        
        .crop-item {
            width: 300px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .crop-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        form {
            display: flex;
            align-items: center;
        }
        
        input[type="number"] {
            width: 60px;
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        button[type="submit"], button[type="button"] {
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #95b591b9;
        }
    </style>
</head>
<body>
<header>
        <img src="logo.jpeg" alt="లోగో">
        <h1>FARM CONNECT</h1>
        <h3>రెండుపైన నిర్వహించండి.కనెక్ట్ పరిశోధించండి.పెరిగింది</h3>
    </header>
    <h2>అందుబాటులో క్రాప్లు</h2>
    <div class="crop-container">
        <?php
        // డేటాబేస్ నుండి ప్రమాణం తనిఖీ చేయబడిన రెండు పంటలను తీసుకోండి
        $sql = "SELECT distinct addcrops.* FROM addcrops INNER JOIN orders ON addcrops.cropid = orders.cropid";
        $result = mysqli_query($conn, $sql);

        // క్రాప్లు అందుబాటులో ఉన్నాయని తనిఖీ చేయండి
        if (mysqli_num_rows($result) > 0) {
            // ప్రతి వరుస యొక్క డేటాను ఔట్ చేయండి
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='crop-item'>";
                echo "<img src='".$row['image']."' alt='క్రాప్ చిత్రం'>";
                echo "<h3>" . $row['cropnametel'] . "</h3>";
                //echo "<p>" . $row['description'] . "</p>";
                echo "<p>ధర: Rs." . $row['cropprice'] . "</p>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='crop_id' value='" . $row['cropid'] . "'>";
                echo "పరిమాణం: <input type='number' name='quantity' value='1' min='0' step='0.01'><br><br>";
                echo "<button type='submit' name='add_to_cart'>కార్టుకు జోడించు</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "ఏ పంటలు అందుబాటులో లేవు";
        }

        mysqli_close($conn);
        ?>
        </div>
        <button class="checkout-button" onclick="window.location.href='Checkout2.php'">చెక్ చేయండి</button>
</body>
</html>
