<?php
// Include the database connection file
require_once 'db_connection.php';

// Prepare the SQL query to fetch farmer details from the queries table
$sql = "SELECT farmer_name, farmer_email, district, mandal, street FROM queries";

// Execute the query
$result = $conn->query($sql);

// Create an array to store the results
$queries = [];

// Iterate through the result set and add each row to the array
while ($row = $result->fetch_assoc()) {
    $queries[] = $row;
}

// Output the queries as JSON
echo json_encode($queries);

// Close the database connection
$conn->close();
?>
