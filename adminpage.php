<?php
    // Start session and error reporting
    error_reporting(0); // Suppress PHP errors
    session_start();

    // Handle logout request
    if(isset($_REQUEST['logout'])){
        session_destroy(); // Destroy session
        header("Location: gmaillogin.php"); // Redirect to login page
        exit(); // Stop script execution
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef0e9;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 1rem 0;
            position: relative;
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

        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        nav li {
            margin: 2 10px;
        }

        nav li a {
            margin: 2 10px;
            text-decoration: none;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #cbd1bc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .crop-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            background-color: #fff;
            padding-right: 20px; /* Add right padding to account for scrollbar width */
        }
        
        .crop {
            flex: 0 0 calc(33.333% - 20px);
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        
        .crop img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            cursor: pointer;
        }
        
        .crop-info {
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            text-align: center;
        }
        
        .crop-info h3 {
            margin: 0;
        }
        
        .crop-info p {
            margin: 5px 0;
        }
        
        .separator {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
            background-color: #fff;
        }
        
        .add-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .add-button:hover {
            background-color: #45a049;
        }
        
        .manage-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #1976D2;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .manage-button:hover {
            background-color: #1565C0;
        }
        
        .logout {
            position: fixed;
            top: 10px;
            right: 10px;
        }
        
        .logout a {
            text-decoration: none;
            color: #ffffff;
            background-color: #2b673d;
            padding: 8px 16px;
            border-radius: 5px;
        }
        
        .logout a:hover {
            background-color: #1a5a36;
        }

    </style>
</head>
<body>
    <header>
        <img src="logo.jpeg" alt="Logo">
        <h1>FARM CONNECT</h1>
        <h3>Cultivate.Connect.Thrive</h3>
        <nav>
            <ul>
               
            </ul>
        </nav>
    </header>
    <div class="logout">
        <form action="adminpage.php" method="post">
            <button type="submit" name="logout" value="Logout">Logout</button>
        </form>
    </div>
    <div class="container">
        <form action="managecrops.php" method="post">
            <button type="submit" name="managecrops" value="Manage Crop" class="manage-button">Manage Crops</button>
        </form>
        <form action="addcrop.php" method="post">
            <button type="submit" name="addcrop" value="Add Crop" class="add-button">Add Crop</button>
        </form>
        <!-- Manage Crops Section -->
        <h2>Available Crops</h2>
        <div class="separator"></div>
        <div class="crop-container">
            <?php
            // Establish database connection
            $conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());

            // Fetch crops from the database
            $query = "SELECT cropname, avail, cropprice, image FROM addcrops";
            $result = mysqli_query($conn, $query);

            // Loop through crops data and display them
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="crop">';
                    echo '<img src="' . $row["image"] . '" alt="' . $row["cropname"] . '">';
                    echo '<div class="crop-info">';
                    echo '<h3>' . $row["cropname"] . '</h3>';
                    echo '<p>Price: $' . $row["cropprice"] . '/kg</p>';
                    echo '<p>Availability: ' . ($row["avail"] == "available" ? "Yes" : "No") . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No crops available.";
            }

            // Close database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>