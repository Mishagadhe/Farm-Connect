<?php
// Set SMTP settings dynamically
ini_set("SMTP", "me@example.com");
ini_set("smtp_port", "25"); // Change the port if needed

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected delivery location and date
    $selected_location = $_POST["delivery_location"];
    $selected_date = $_POST["delivery_date"];

    // Update the database to mark the selected location as unavailable
    // Example SQL query:
    // UPDATE delivery_locations SET available = 0 WHERE location = '$selected_location'

    // Send notification to selection officer (example: via email)
    $conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());
    $query="select email from farmer where mandal='thalapet'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);
    $to = $row['email'];
    $subject = "Officer Acceptance Notification";
    $message = "Selection officer has accepted the ride to check your crop quality $selected_location on $selected_date.";
    $headers = "From: truckdriver@example.com";

    // Send email notification
    if (mail($to, $subject, $message, $headers)) {
        echo "Notification sent successfully.";
    } else {
        echo "Error: Notification could not be sent.";
    }
} else {
    // Redirect to the truck driver page if accessed directly without submitting the form
    header("Location: truck_driver_page.php");
    exit;
}
?>
