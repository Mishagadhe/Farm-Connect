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
    $query="SELECT mandal from truckdriver where email='$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Fetch the user's details
        $row = $result->fetch_assoc();
        $mandal = $row['mandal'];
        $_SESSION['mandal']=$mandal;
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
    <form action="process_selection.php" method="post">
        <label for="delivery_location">Select Delivery Location:</label>
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
                    echo "<option value='" . $row['street'] . "'>" . $row['street'] . ", " . $row['mandal'] . "</option>";
                }
            } else {
                echo "<option value=''>No locations available</option>";
            }
            $conn->close();
            ?>
        </select>
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
        <button type="submit">Accept Ride</button>
    </form>
    </center>
    <script>
        // Initialize Google Maps API
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 40.7128, lng: -74.0060 }, // New York coordinates (default)
                zoom: 8
            });
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('directionsPanel'));
        }

        // Get directions to selected destination
        function getDirections() {
            var destination = document.getElementById('destinations').value;
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('directionsPanel'));

            directionsService.route({
                origin: { lat: 40.7128, lng: -74.0060 }, // New York coordinates (default)
                destination: destination,
                travelMode: 'DRIVING'
            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

        // Logout function
        function logout() {
            // Redirect to logout page or perform logout action
            window.location.href = 'logout.php'; // Change to your logout page URL
        }
    </script>
    <!-- Include Google Maps JavaScript API with your API key -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
</body>
</html>
