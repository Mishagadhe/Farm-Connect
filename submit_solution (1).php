<?php
require_once 'db_connection.php'; // Include the database connection file

// Get the input data from the request
$inputData = file_get_contents('php://input');
$data = json_decode($inputData, true);

// Extract farmer full names and solution text from the input data
$farmerFullnames = $data['farmerFullnames'];
$solutionText = $data['solution'];

// Initialize the success flag
$success = true;

// Check if required data is provided
if (!empty($farmerFullnames) && !empty($solutionText)) {
    // Prepare the SQL statement to insert each solution into the resolvequeries table
    $sql = "INSERT INTO resolvequeries (farmer_fullname, solution_text, solution_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    // Iterate through the farmer full names
    foreach ($farmerFullnames as $farmerFullname) {
        // Bind parameters for each iteration
        $stmt->bind_param('ss', $farmerFullname, $solutionText);

        // Execute the SQL statement
        if (!$stmt->execute()) {
            $success = false;
            // Log the error or print it to debug the issue
            error_log('Database error: ' . $stmt->error);
            break; // Stop the loop if an error occurs
        }
    }

    // Close the prepared statement
    $stmt->close();
} else {
    $success = false;
    echo 'Invalid input data. Please provide farmer full names and solution text.';
}

// Return the success status as JSON
echo json_encode(['success' => $success]);

// Close the database connection
$conn->close();
?>
