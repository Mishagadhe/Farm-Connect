<!DOCTYPE html>
<html>
<head>
    <title>Notification Sent</title>
    <style>
        /* Add some basic styling to center the message */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Notification sent successfully.</p>
    </div>

    <!-- Redirect to selection homepage after a delay -->
    <script>
        setTimeout(function() {
            window.location.href = "truckdriverhomepage.php"; // Replace with your selection homepage URL
        }, 2000); // Redirect after 3 seconds
    </script>
</body>
</html>
