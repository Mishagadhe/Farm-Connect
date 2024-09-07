<?php
// Include the database connection file
require_once 'db_connection.php';

// Get the JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Extract query text, farmer names, and the solution from the JSON data
$query_text = isset($data['query']) ? trim($data['query']) : '';
$farmer_names = isset($data['farmerNames']) && is_array($data['farmerNames']) ? $data['farmerNames'] : [];
$officer_solution = isset($data['solution']) ? trim($data['solution']) : '';

// Validate the received data
if ($query_text && count($farmer_names) > 0 && $officer_solution) {
    // Get the current date and time
    $current_datetime = date("Y-m-d H:i:s");

    // Convert farmer names array to a string (comma-separated)
    $farmer_names_string = implode(', ', $farmer_names);

    // Prepare the SQL statement to insert the data
    $stmt = $conn->prepare("INSERT INTO voicesolution (solution, query, farmer_names, created_at) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(["message" => "Failed to prepare statement: " . $conn->error]);
        exit();
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("ssss", $officer_solution, $query_text, $farmer_names_string, $current_datetime);
    if (!$stmt->execute()) {
        echo json_encode(["message" => "Failed to save data: " . $stmt->error]);
    } else {
        echo json_encode(["message" => "Query, solution, and selected farmer names saved successfully"]);
    }

    // Close the statement
    $stmt->close();
} else {
    // Missing query data, farmer names, or officer's solution
    echo json_encode(["message" => "Query, farmer names, or solution missing"]);
}

// Close the database connection
$conn->close();
?>
