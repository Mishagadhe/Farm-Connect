<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selection Officer Homepage</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 6px;
            padding: 0px;
        }

        header {
            position: relative;
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }

        header img {
            position: absolute;
            top: 15px;
            left: 15px;
            width: 170px;
            height: auto;
            border-radius: 5%;
        }

        header h1 {
            margin: 0;
        }

        header h3 {
            margin: 0;
            color: #ffffff;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
            margin: 120px auto; /* Centered container */
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .logout-button {
            position: absolute;
            bottom: 15px;
            right: 15px;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        /* Add hover effect for the logout button */
        .logout-button:hover {
            background-color: #3e8e41;
        }

        .option-button {
            display: block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px 0;
            transition: background-color 0.3s;
        }

        .option-button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <header>
        <img src="logo.jpeg" alt="Logo">
        <h1>FARM CONNECT</h1>
        <h3>Cultivate.Connect.Thrive</h3>
        <button class="logout-button" onclick="window.location.href = 'gmaillogin.php';">Logout</button>
    </header>

    <div class="container">
        <h2>Welcome, Selection Officer</h2>
        
        <!-- Option 1: View Orders from Farmers -->
        <a href="ordersdisplay.php" class="option-button">View Orders from Farmers</a>

        <!-- Option 2: Send Notification to Farmers -->
        <a href="send_notification.php" class="option-button">Send Notification to Farmers</a>
    </div>
</body>

</html>
