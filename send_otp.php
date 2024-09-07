<!-- send_otp.php -->
<?php
session_start();

// Get the mobile number from the form submission
$mobile_number = $_POST['mobile_number'];

// Generate a random 6-digit OTP
$otp = rand(100000, 999999);

// Store the OTP and mobile number in session variables
$_SESSION['otp'] = $otp;
$_SESSION['mobile_number'] = $mobile_number;

// Use an SMS API to send the OTP to the user's mobile number
// Example: Use Twilio or any other SMS API

// Send the OTP using the API (you'll need to replace 'your_account_sid', 'your_auth_token', 'your_twilio_number', and the API call with your SMS API's details)
require_once 'vendor/autoload.php';
use Twilio\Rest\Client;

$account_sid = 'your_account_sid';
$auth_token = 'your_auth_token';
$twilio_number = 'your_twilio_number';

$client = new Client($account_sid, $auth_token);

$message = $client->messages->create(
    $mobile_number,
    [
        'from' => $twilio_number,
        'body' => "Your OTP is: $otp"
    ]
);

// Redirect the user to the OTP verification page
header("Location: verify_otp.php");
exit;
?>