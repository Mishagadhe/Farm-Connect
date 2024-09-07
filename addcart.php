<?php
session_start();
// Database connection
$conn = mysqli_connect("localhost", "root", "", "farmconnect");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if cart session variable is set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
$email = $_SESSION['email'];
$query = "SELECT Fullname, street, district, mandal, state FROM farmer WHERE email = '$email'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // Fetch the user's details
    $row = $result->fetch_assoc();
    $username = $row['Fullname'];
    $street = $row['street'];
    $district = $row['district'];
    $mandal = $row['mandal'];
    $state = $row['state'];
} else {
    echo "No farmer found with this email.";
    exit();
}

// Function to add item to cart
function addToCart($id, $quantity) {
    // Check if item already exists in cart
    if (array_key_exists($id, $_SESSION['cart'])) {
        $_SESSION['cart'][$id] += $quantity; // Increment quantity if item exists
    } else {
        $_SESSION['cart'][$id] = $quantity; // Add new item to cart
    }
}

// Check if add to cart button is clicked
if (isset($_POST['add_to_cart'])) {
    $crop_id = $_POST['crop_id'];
    $quantity = $_POST['quantity'];
    addToCart($crop_id, $quantity);
}
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to gmaillogin.php or any other desired page
    header("Location: gmaillogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart</title>
        
        <style>
        /* Add your CSS styles here */
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
            margin-top: 30px; /* Optional: Add margin-top to add some space above the heading */
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
            background-color: #f44336; /* Red color for logout button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        /* Add hover effect for the logout button */
        .logout-button:hover {
            background-color: #e53935; /* Darker red on hover */
        }

        /* Emoticon styling */
        .logout-button:before {
            content: "🔒 "; /* Lock emoticon */
        }

        .crop-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        button[type="button"] {
            display: block;
            margin: 20px auto; /* Center the button and add margin */
            padding: 12px 24px; /* Increase padding for larger size */
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px; /* Increase font size for larger text */
        }

        /* Add hover effect for the checkout button */
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
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 0;
        }
        
        .crop-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
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
        
        .checkout-button {
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
.checkout-button:hover {
    background-color: #45a049; /* Darker green on hover */
}
</style>
</head>
<body>
<header>
        <img src="logo.jpeg" alt="Logo">
        <h1>FARM CONNECT</h1>
        <h3>Cultivate.Connect.Thrive</h3>
    </header>
    <h2>Available Crops</h2>
    <div class="crop-container">
        <?php
        // Fetch crops from the database
        $sql = "SELECT * FROM addcrops";
        $result = mysqli_query($conn, $sql);

        // Check if crops are available
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='crop-item'>";
                echo "<img src='".$row['image']."' alt='Crop Image'>";
                echo "<h3>" . $row['cropname'] . "</h3>";
                //echo "<p>" . $row['description'] . "</p>";
                echo "<p>Price: Rs." . $row['cropprice'] . "</p>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='crop_id' value='" . $row['cropid'] . "'>";
                echo " Approximate Quantity in quintals: <input type='number' name='quantity' value='1' min='0' step='0.01'><br><br>";
                echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No crops available";
        }

        mysqli_close($conn);
        ?>
        </div>
        <button class="checkout-button" onclick="window.location.href='Checkout.php'">Checkout</button>
     
</body>
</html>