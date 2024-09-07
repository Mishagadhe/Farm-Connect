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
            background-color: #45a049;
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
        
        button[type="submit"] {
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
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
                echo "<p>Price: $" . $row['cropprice'] . "</p>";
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='crop_id' value='" . $row['cropid'] . "'>";
                echo "Quantity: <input type='number' name='quantity' value='1' min='0' step='0.01'><br><br>";
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
    <button onclick="window.location.href='Checkout.php'">Checkout</button>
    <!-- Logout form -->
    <form action="gmaillogin.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>