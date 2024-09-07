<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "You must be logged in to access this page.";
    exit;
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "farmconnect");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve session data
$email = $_SESSION['email'];

// Query the farmer's details based on the email
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

// Get crop and quantity data from the POST request
$crop = $_POST['crop'] ?? ''; // Assuming the crop type is sent as a form input with the name 'crop'
$quantity = $_POST['quantity1'] ?? ''; // Assuming the quantity is sent as a form input with the name 'quantity'

// Insert data into the quantity table
$query = "INSERT INTO quantity (email, username, crop, cropquantity, street, district, mandal, state) 
          VALUES ('$email', '$username', '$crop', '$quantity', '$street', '$district', '$mandal', '$state')";

if ($conn->query($query) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the database connection
$conn->close();

// Redirect the user to a specific page after successful insertion
header("Location: farmerhomepage.html");
exit();
?>
