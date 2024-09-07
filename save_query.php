<?php
// Establish the database connection
require_once 'db_connection.php';  // Include the database connection file

// Start the session
session_start();

// Retrieve farmer's email from session
$farmer_email = $_SESSION['email'];

// Get the JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$query_text = $data['query'];

// Save the query to the database
if ($query_text && $farmer_email) {
    // Get the current date and time
    $current_datetime = date("Y-m-d");

    // Prepare the SQL statement to include query text, farmer email, and current date and time
    $stmt = $conn->prepare("INSERT INTO queries (query, farmer_email, created_at) VALUES (?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("sss", $query_text, $farmer_email, $current_datetime);
    
    // Execute the query
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Query saved successfully
        echo json_encode(["message" => "Query saved successfully"]);
    } else {
        // Failed to save query
        echo json_encode(["message" => "Failed to save query"]);
    }

    // Close the statement
    $stmt->close();
} else {
    // Missing query data or farmer email
    echo json_encode(["message" => "Query data or farmer email is missing"]);
}

// Close the database connection
$conn->close();
?>
