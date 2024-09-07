<?php
// Start session (if not already started)
session_start();

// Check if the user is logged in
$conn = mysqli_connect("localhost", "root", "", "farmconnect");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_SESSION['email'])) {
    // If the user is logged in, retrieve their mandal from the session
    $email=$_SESSION['email'];
    $query="SELECT mandal from selectionofficer where email='$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Fetch the user's details
        $row = $result->fetch_assoc();
        $mandal = $row['mandal'];
    } else {
        echo "No farmer found with this email.";
        exit();
    }
    // Now you can use $mandal in your code
} else {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Driver Page</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 6px;
            padding: 0px;
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

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
            margin: 120px auto; /* Centered container */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .logout-button {
            position: absolute;
            bottom: 15px;
            right: 15px;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        /* Add hover effect for the logout button */
        .logout-button:hover {
            background-color: #3e8e41;
        }

        .option-button {
            display: block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px 0;
            transition: background-color 0.3s;
        }

        .option-button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
<header>
        <img src="logo.jpeg" alt="Logo">
        <h1>FARM CONNECT</h1>
        <h3>Cultivate. Connect. Thrive</h3>
        <nav>
        <ul style="display: flex; justify-content: flex-end;">
            <form action="gmaillogin.php" method="post">
                <button type="submit" name="logout" class="logout-button">Logout</button>
            </form>
        </li>
    </ul>
</nav>
    </header>
    <br>
    </br>
    <br></br>
    <br></br>
    <center>
    <form action="process_selection1.php" method="post">
        <label for="delivery_location">Select Quality Check Location:</label>
        <select name="delivery_location" id="delivery_location">
            <?php
            // Connect to your database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "farmconnect";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch locations from the orders table matching the truck driver's mandal
            $sql = "SELECT distinct street, mandal FROM orders WHERE mandal = '$mandal'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['mandal'] . "'>" . $row['mandal']  . "</option>";
                }
            } else {
                echo "<option value=''>No locations available</option>";
            }
            $conn->close();
            ?>
        </select>
        <br>
        <label for="delivery_date">Select Quality Check Date:</label>
        <select name="delivery_date" id="delivery_date">
            <?php
            // Generate next 5 dates from current date
            for ($i = 0; $i < 5; $i++) {
                $date = date('Y-m-d', strtotime("+$i days"));
                echo "<option value='$date'>$date</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit">Accept Ride</button>
    </form>
    </center>
    
    <!-- Include Google Maps JavaScript API with your API key -->
</body>
</html>
