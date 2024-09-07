<?php
// Start session (if not already started)
session_start();

// Check if the user is logged in
$conn = mysqli_connect("localhost", "root", "", "farmconnect");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_SESSION['email'])) {
    // If the user is logged in, retrieve their mandal from the session
    $email = $_SESSION['email'];
    $query = "SELECT mandal,phoneno from truckdriver where email='$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Fetch the user's details
        $row = $result->fetch_assoc();
        $mandal = $row['mandal'];
        $phoneno=$row['phoneno'];
        $_SESSION['mandal'] = $mandal;
        $_SESSION['phoneno']=$phoneno;
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
        /* Styles from previous code are retained */

        /* Style for the table */
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }

        #features {
            background-color: #C4D7B2;
            padding: 2rem 0;
        }

        #how-it-works {
            background-color: #F7FFE5;
            padding: 2rem 0;
        }

        #get-started {
            background-color: #A0C49D;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }

        footer {
            background-color: #C4D7B2;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
        body {
            font-family: 'Varela Round', sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 3;
        }

        header {
            position: relative;
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 0.4rem 0;
        }

        header img {
            position: absolute;
            top: 30px;
            left: 10px;
            width: 250px;
            height: auto;
            border-radius: 5%;
        }

        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: absolute;
            top: 50px;
            right: 10px;
        }

        nav li {
            margin: 8px;
        }

        nav li a {
            text-decoration: none;
            color: white;
        }

        /* Style for clicked navigation links */
        nav li a.clicked {
            color: #0e3109; /* Change to the color you prefer */
        }


        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 97%;
            max-width: 12000px;
            padding: 20px; /* Add some padding for spacing */
        }

        .login-form-container,
        .registration-buttons-container {
            flex: 2;
            padding: 35px;
            background-color: #9acfa2;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(91, 159, 100, 0.1);
        }

        .login-button,
        .registration-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #4b815d; /* Facebook blue */
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-bottom: 25px;
        }

        .login-button.google {
            background-color: #4b815d; /* Google red */
        }

        .login-button:hover,
        .registration-button:hover {
            background-color: #1a5a36; /* Darker color on hover */
        }

        .registration-buttons-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .registration-button {
            background-color: #4b815d; /* Teal color */
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
            background-color: #3e8e41; /* Darker red on hover */
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #bfd7bc;
            color: white;
        }

        /* Style for the checkbox */
        .checkbox-column {
            width: 20px;
        }

        /* Style for the submit button */
        #submit-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4b815d;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        /* Add hover effect for the submit button */
        #submit-button:hover {
            background-color: #1a5a36;
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
            </ul>
        </nav>
    </header>
    <br>
    <center>
        <form action="process_selection.php" method="post">
            <h2>Select Delivery Location:</h2>
            <table>
                <thead>
                    <tr>
                        <th class="checkbox-column"></th>
                        <th>Location</th>
                        <th>Farmer Name</th>
                        <th>Farmer Phone</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Fetch locations and farmer phone from the orders table matching the truck driver's mandal
                    $sql = "SELECT finalorders.street, finalorders.mandal, farmer.Fullname, farmer.phoneno 
                            FROM finalorders 
                            JOIN farmer ON finalorders.email = farmer.email 
                            WHERE finalorders.mandal = '$mandal' AND 
                                  CONCAT(finalorders.street, ',', finalorders.mandal) NOT IN 
                                  (SELECT CONCAT(street, ',', mandal) FROM acceptedrides)";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            // Concatenate street and mandal into a single value separated by a delimiter (e.g., comma)
                            $value = $row['street'] . ',' . $row['mandal'];

                            echo "<tr>";
                            echo "<td class='checkbox-column'><input type='checkbox' name='delivery_location[]' value='" . $value . "'></td>";
                            echo "<td>" . $row['street'] . ", " . $row['mandal'] . "</td>";
                            echo "<td>" . $row['Fullname'] . "</td>";
                            echo "<td>" . $row['phoneno'] . "</td>";
                            echo "</tr>";
                        }

                    } else {
                        echo "<tr><td colspan='3'>No locations available</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
            <br>
            <label for="delivery_date">Select Delivery Date:</label>
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
            <button type="submit" id="submit-button">Accept Ride</button>
        </form>
    </center>
    <!-- JavaScript and Google Maps API code is retained -->
</body>

</html>
