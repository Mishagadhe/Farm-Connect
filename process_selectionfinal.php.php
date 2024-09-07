<?php
// Set SMTP settings dynamically
session_start();
ini_set("SMTP", "me@example.com");
ini_set("smtp_port", "25"); // Change the port if needed

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected delivery location, date, and truck driver's mandal
    $selected_location = $_POST["delivery_location"];
    $selected_date = $_POST["delivery_date"];
    $truck_driver_mandal = $_SESSION['mandal'];
    $truck_driver_email = $_SESSION['email']; 
    $truck_driver_phoneno=$_SESSION['phoneno'];// Added truck driver's email
    
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());
    
    // Loop through each selected delivery location
    foreach ($selected_location as $location) {
        // Split the location into street and mandal
        list($street, $mandal) = explode(',', $location);
        
        // Retrieve farmer details based on the location
        $query = "SELECT farmer.email, farmer.Fullname, farmer.phoneno FROM farmer INNER JOIN orders ON farmer.email = orders.email WHERE orders.street = '$street' AND orders.mandal = '$mandal'";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch farmer details
            $row = mysqli_fetch_assoc($result);
            $farmer_email = $row['email'];
            $farmer_name = $row['Fullname'];
            $farmer_phone = $row['phoneno'];
            
            // Insert the accepted ride into the acceptedrides table
            $insert_query = "INSERT INTO acceptedrides (truck_driver_mandal, truck_driver_email, farmer_email, street, mandal, farmer_name, farmer_phone, delivery_date) VALUES ('$truck_driver_mandal', '$truck_driver_email', '$farmer_email', '$street', '$mandal', '$farmer_name', '$farmer_phone', '$selected_date')";
            
            // Execute the query
            if (mysqli_query($conn, $insert_query)) {
                // Send notification to the farmer
                $to = $farmer_email;
                $subject = "Driver Acceptance Notification";
                $message = "Driver has accepted the ride to $street, $mandal on $selected_date. You can contact the driver at $truck_driver_phoneno.";
                $headers = "From: truckdriver@example.com";
                
                // Send email notification
                if (mail($to, $subject, $message, $headers)) {
                    echo "Notification sent successfully.";
                } else {
                    echo "Error: Notification could not be sent.";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: Farmer details not found.";
        }
    }
    
    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to the truck driver page if accessed directly without submitting the form
    header("Location: truck_driver_page.php");
    exit;
}
?>
