<?php
// Include the database connection file
require_once 'db_connection.php';

// Retrieve the JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Extract the farmer name, query, and solution from the JSON data
$query = isset($data['query']) ? trim($data['query']) : '';
$solution = isset($data['solution']) ? trim($data['solution']) : '';
$farmer_name = isset($data['farmer_names']) ? trim($data['farmer_names']) : '';

// Validate the data
if ($farmer_name !== '' && $query !== '' && $solution !== '') {
    // Prepare the SQL statement to insert the farmer's name, query, and solution into the voicesolution table
    $stmt = $conn->prepare("INSERT INTO voicesolution (query, solution, farmer_names,created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $query, $solution,$farmer_name);

    // Execute the statement
    if ($stmt->execute()) {
        // Send success response
        echo json_encode(['success' => true, 'message' => 'Solution submitted successfully.']);
    } else {
        // Send an error response
        echo json_encode(['success' => false, 'message' => 'Failed to submit solution: ' . $stmt->error]);
    }

    // Close the statement
    $stmt->close();
} else {
    // Missing farmer name, query, or solution
    echo json_encode(['success' => false, 'message' => 'Missing data: farmer name, query, or solution.']);
}

// Close the database connection
$conn->close();
?>
