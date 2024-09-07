<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Truck Driver Home</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0e5;
        }

        /* Container Styles */
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
            margin: 120px auto; /* Centered container */
        }
        header {
            position: relative;
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 0.4rem ;
        }

        header img {
            position: absolute;
            top: 30px;
            left: 10px;
            width: 250px;
            height: auto;
            border-radius: 5%;
        }
        /* Welcome Message */
        h1 {
            margin-bottom: 20px;
        }

        /* Button Styles */
        .button {
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

        .button:hover {
            background-color: #3e8e41;
        }
        .logout-button {
            display: inline-block;
            padding: 10px;
            background-color: #4caf50; /* Red color for logout button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        /* Add hover effect for the logout button */
        .logout-button:hover {
            background-color:#95b591b9; /* Darker green on hover */
        }

        /* Header Styles */
        
        
    </style>
</head>

<body>

    <!-- Header Section -->
    <header>
        <img src="logo.jpeg" alt="Logo">
        <h1>FARM CONNECT</h1>
        <h3>Cultivate. Connect. Thrive</h3>
        <nav>
            <ul style="display: flex; justify-content: flex-end;">
                <!-- Logout button -->
                <li>
                    <form action="gmaillogin.php" method="post">
                        <button type="submit" name="logout" class="logout-button">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Welcome Message -->
        <h1>Welcome, Truck Driver!</h1>
        
        <!-- Options for the Truck Driver -->
        <a href="truck_driver_dashboard.php" class="button">Delivery Locations</a>
        <a href="acceptedrides.php" class="button">Accepted Rides</a>
    </div>

</body>

</html>
