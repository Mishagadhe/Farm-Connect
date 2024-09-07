<?php
require_once 'db_connection.php'; // Include the database connection file

// Query to join the queries table with the farmers table using the email ID
$sql = "
    SELECT
        f.Fullname,
        f.district,
        f.mandal,
        f.street,
        q.query,
        q.farmer_email AS email_id,
        DATE_FORMAT(q.created_at, '%Y-%m-%d') AS created_at
    FROM
        queries q
    JOIN
        farmer f ON q.farmer_email = f.email
    ORDER BY
        q.created_at DESC"; // Optional: Order by created_at

// Execute the query
$result = $conn->query($sql);

$data = [];

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch each row and add it to the data array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return the data as JSON
echo json_encode($data);

// Close the database connection
$conn->close();
?>
