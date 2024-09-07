<!-- verify_otp_action.php -->
<?php
session_start();

// Get the OTP entered by the user
$user_otp = $_POST['otp'];

// Check if the entered OTP matches the one stored in the session
if (isset($_SESSION['otp']) && $_SESSION['otp'] == $user_otp) {
    // Authentication successful
    // Redirect the user to their account page or home page
    header("Location: home.php");
    exit;
} else {
    // Authentication failed
    echo "Invalid OTP. Please try again.";
    // Optionally, you can redirect the user back to the OTP verification page
    // header("Location: verify_otp.php");
    // exit;
}
?>