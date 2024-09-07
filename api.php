<?php
// Start the session
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmconnect";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to save a farmer query to the database
function saveQuery($conn) {
    // Get JSON data from the request body
    $data = json_decode(file_get_contents("php://input"), true);
    $query_text = $data['query'];

    // Get farmer's email from the session
    $farmer_email = $_SESSION['email'];

    if ($query_text && $farmer_email) {
        // Get the current date and time
        $current_datetime = date("Y-m-d H:i:s");

        // Prepare the SQL statement to insert the query, farmer's email, and created_at timestamp
        $stmt = $conn->prepare("INSERT INTO queries (query, farmer_email, created_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $query_text, farmer_email, $current_datetime);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["message" => "Query saved successfully"]);
        } else {
            echo json_encode(["message" => "Failed to save query"]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(["message" => "Query data or email is missing"]);
    }
}

// Function to get farmer queries and details from the database
function getQueries($conn) {
    // SQL query to retrieve all queries with farmer information
    $query = "SELECT q.query, q.created_at, f.name AS farmer_name, f.email AS farmer_email, f.district, f.mandal, f.street
              FROM queries q
              JOIN farmers f ON q.farmer_email = f.email";
              
    // Execute the query
    $result = $conn->query($query);

    // Create an array to hold the results
    $queries = [];

    // Fetch rows from the result set and add them to the queries array
    while ($row = $result->fetch_assoc()) {
        $queries[] = $row;
    }

    // Output the queries as JSON
    echo json_encode($queries);
}

// Determine the request method
$request_method = $_SERVER['REQUEST_METHOD'];

// Handle POST and GET requests accordingly
if ($request_method == "POST") {
    saveQuery($conn);
} elseif ($request_method == "GET") {
    getQueries($conn);
} else {
    echo json_encode(["message" => "Invalid request method"]);
}

// Close the database connection
$conn->close();
?>
