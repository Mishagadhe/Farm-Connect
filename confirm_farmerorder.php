<!-- order_confirmation.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <meta http-equiv="refresh" content="5;url=farmerhomepage.php">
    <style>
        /* CSS styles for the container */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }
        
        h2 {
            color: #28a745;
            margin-bottom: 10px;
        }
        
        p {
            color: #555;
        }
    </style>
    <script>
        // Play audio notification after the order is placed
        function playAudio() {
            var audio = new Audio('success.mp3');
            audio.play();
        }
        
        window.onload = playAudio;
    </script>
</head>
<body>
    <div class="container">
        <h2>Your order has been placed!</h2>
        <p>Thank you for your order. You will be redirected to the home page shortly.</p>
        <p>If you are not redirected automatically, please <a href="farmerhomepage.php">click here</a>.</p>
    </div>
</body>
</html>