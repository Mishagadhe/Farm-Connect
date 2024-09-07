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

// Function to remove item from cart
function removeFromCart($id) {
    if (array_key_exists($id, $_SESSION['cart'])) {
        unset($_SESSION['cart'][$id]); // Remove item from cart
    }
}

// Check if remove button is clicked
if (isset($_POST['remove'])) {
    $crop_id = $_POST['crop_id'];
    removeFromCart($crop_id);
}

// Initialize total price
$totalPrice = 0;

// Check if place order button is clicked
if (isset($_POST['place_order'])) {
    // Insert order details into the database
    $user_email = $_SESSION['email']; // Assuming you have stored the user ID in the session
    $order_date = date('Y-m-d'); // Get current date
    $query = "SELECT Fullname, street, district, mandal, state FROM farmer WHERE email = '$user_email'";
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
    foreach ($_SESSION['cart'] as $crop_id => $quantity) {
        $sql = "INSERT INTO orders (email, fullname, cropid, quantity, order_date, street, district, mandal, state) VALUES ('$user_email', '$username', '$crop_id', '$quantity', '$order_date', '$street', '$district', '$mandal', '$state')";
        mysqli_query($conn, $sql);
    }
    // Clear the cart after placing the order
    $_SESSION['cart'] = array();
    // Redirect to a confirmation page or any other desired page
    header("Location: agri.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 0;
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
            background-color: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background-color: #ff3d00;
        }

        .place-order-btn {
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .place-order-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Shopping Cart</h2>
    <table>
        <tr>
            <th>Crop</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        // Loop through items in the cart
        foreach ($_SESSION['cart'] as $id => $quantity) {
            // Retrieve crop details from the database based on $id
            $sql = "SELECT cropname, image, cropprice FROM addcrops WHERE cropid = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // Calculate total price for this item
            $itemTotal = $row['cropprice'] * $quantity;
            $totalPrice += $itemTotal; // Add item total to total price

            // Output table row for this crop
            echo "<tr>";
            echo "<td>{$row['cropname']}</td>";
            echo "<td><img src='{$row['image']}' alt='{$row['cropname']}' style='max-width: 100px;'></td>";
            echo "<td>$quantity</td>";
            echo "<td>{$row['cropprice']}</td>";
            echo "<td>$itemTotal</td>";
            echo "<td>
                    <form action='' method='post'>
                        <input type='hidden' name='crop_id' value='$id'>
                        <button type='submit' name='remove' class='remove-btn'>Remove</button>
                    </form>
                </td>";
            echo "</tr>";
        }

        // Output total price row
        echo "<tr>";
        echo "<td colspan='4'><strong>Total:</strong></td>";
        echo "<td colspan='2'>$totalPrice</td>";
        echo "</tr>";

        ?>
    </table>

    <!-- Place order button -->
    <form action="" method="post">
        <button type="submit" name="place_order" class="place-order-btn">Place Order</button>
    </form>

    <form action="gmaillogin.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
