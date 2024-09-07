<?php
// Database connection parameters
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "farmconnect"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the quantities from the form submission
if (empty($errors)) {
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());

    // Get the quantities from the form submission
    $crop1 = $_POST['quantity1'];
    $crop2 = $_POST['quantity2'];
    $crop3 = $_POST['quantity3'];

    // Prepare the SQL query
    $query = "INSERT INTO quantity VALUES ('$crop1', '$crop2', '$crop3')";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        echo "<p style='color:green;'>Quantities saved successfully!</p>";
        header("Location: quantity.html");
        exit(); // Make sure to exit after redirection
    } else {
        echo "<p style='color:red;'>Error saving quantities: " . mysqli_error($conn) . "</p>";
    }

    // Close the connection
    mysqli_close($conn);
} else {
    // Display any errors
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}
?>
