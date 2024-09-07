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
function removeQuantityFromCart($id, $remove_quantity) {
    if (array_key_exists($id, $_SESSION['cart'])) {
        // Check if the quantity to remove is greater than or equal to the current quantity
        if ($remove_quantity >= $_SESSION['cart'][$id]) {
            // Remove the entire item from the cart
            unset($_SESSION['cart'][$id]);
        } else {
            // Decrease the quantity of the item in the cart
            $_SESSION['cart'][$id] -= $remove_quantity;
        }
    }
}

// Check if remove button is clicked
if (isset($_POST['remove'])) {
    $crop_id = $_POST['crop_id'];
    $remove_quantity = (int)$_POST['remove_quantity']; // Convert to integer

    // Call the function to remove the specified quantity from the cart
    removeQuantityFromCart($crop_id, $remove_quantity);
}

// Initialize total price
$totalPrice = 0;

// Check if place order button is clicked
// Check if place order button is clicked
if (isset($_POST['place_order'])) {
    // Get user email from session
    $user_email = $_SESSION['email'];

    // Get current date
    $order_date = date('Y-m-d');

    // Retrieve user details from the database
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

    // Loop through each item in the cart and insert order details into the database
    foreach ($_SESSION['cart'] as $crop_id => $quantity) {
        // Retrieve crop details (including crop name) from the database
        $sql_crop = "SELECT cropname, cropprice FROM addcrops WHERE cropid = '$crop_id'";
        $result_crop = mysqli_query($conn, $sql_crop);
        $crop_data = mysqli_fetch_assoc($result_crop);
        $crop_name = $crop_data['cropname'];

        // Calculate the total price for the order
        $total_price = $crop_data['cropprice'] * $quantity;

        // Insert the order details into the orders table
        $sql_order = "INSERT INTO finalorders (email, fullname, cropid, cropname, quantity, order_date, street, district, mandal, state) VALUES ('$user_email', '$username', '$crop_id', '$crop_name', '$quantity', '$order_date', '$street', '$district', '$mandal', '$state')";
        mysqli_query($conn, $sql_order);
    }

    // Clear the cart after placing the order
    $_SESSION['cart'] = array();

    // Redirect to a confirmation page or another page as desired
    header("Location: confirm_farmerorder.php");
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
        <img src="logo.jpeg" alt="Logo">
        <h1>FARM CONNECT</h1>
        <h3>Cultivate.Connect.Thrive</h3>
        <nav>
            <ul>
                <!-- Add logout button here -->
                <li>
                    <form action="gmaillogin.php" method="post">
                        <button type="submit" name="logout" class="logout-button">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>
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
            $sql = "SELECT * FROM addcrops WHERE cropid = '$id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            // Calculate total price for this item
            $itemTotal = $row['cropprice'] * $quantity;
            $totalPrice += $itemTotal; // Add item total to total price

            $crop_name=$row['cropname'];
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
                    <label for='remove_quantity'>Remove Quantity:</label>
                    <input type='number' name='remove_quantity' min='1' max='$quantity' value='1' required>
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
        <button type="submit" name="place_order" class="place-order-button">Place Order for cropy quality check</button>
    </form>
</body>
</html>