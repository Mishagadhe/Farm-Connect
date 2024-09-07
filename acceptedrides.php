<?php
// Start session (if not already started)
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmconnect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch accepted rides from the database
$sql = "SELECT * FROM acceptedrides";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accepted Rides</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0e5;
        }

        /* Container Styles */
        /* Container Styles */
.container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 800px; /* Increased width */
    margin: 80px auto; /* Centered container */
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px; /* Increased padding */
    border-bottom: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

        header {
            position: relative;
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 0.4rem ;
        }

        header img {
            position: absolute;
            top: 30px;
            left: 10px;
            width: 250px;
            height: auto;
            border-radius: 5%;
        }
        /* Welcome Message */
        h1 {
            margin-bottom: 20px;
        }

        /* Button Styles */
        .button {
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

        .button:hover {
            background-color: #3e8e41;
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
    </style>
</head>
<body>

<!-- Header Section -->
<header>
    <img src="logo.jpeg" alt="Logo">
    <h1>FARM CONNECT</h1>
    <h3>Cultivate. Connect. Thrive</h3>
    <nav>
        <ul style="display: flex; justify-content: flex-end;">
            <!-- Logout button -->
            <li>
                <form action="gmaillogin.php" method="post">
                    <button type="submit" name="logout" class="logout-button">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

<div class="container">
    <!-- Table of Accepted Rides -->
    <table>
        <thead>
            <tr>
                <th>Location</th>
                <th>Delivery Date</th>
                <th>Driver Name</th>
                <th>Driver Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if any accepted rides exist
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['street'] . ", " . $row['mandal'] . "</td>";
                    echo "<td>" . $row['delivery_date'] . "</td>";
                    echo "<td>" . $row['farmer_name'] . "</td>";
                    echo "<td>" . $row['farmer_phone'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No accepted rides found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Back Button -->
    <a href="truckdriverhomepage.php" class="button">Back to Homepage</a>
</div>

</body>
</html>
