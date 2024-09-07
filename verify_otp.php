<!-- verify_otp.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
    <h2>Verify OTP</h2>
    <form method="POST" action="verify_otp_action.php">
        <label for="otp">Enter the OTP sent to your mobile:</label><br>
        <input type="text" id="otp" name="otp" required><br><br>
        <input type="submit" value="Verify OTP">
    </form>
</body>
</html>