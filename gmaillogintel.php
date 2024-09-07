<?php
// Start session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['gmail'] ?? '';
    $password = $_POST['pwd'] ?? '';
    $user_type = $_POST['user_type'] ?? '';

    // Database connection
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "farmconnect";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement based on user type
    $sql = "";
    switch ($user_type) {
        case 'admin':
            $sql = "SELECT * FROM admin WHERE email = ? AND password = ?";
            $redirect_url = "adminhomepagetel.php";
            break;
        case 'farmer':
            $sql = "SELECT * FROM farmer WHERE email = ? AND password = ?";
            $redirect_url = "farmerhomepageTel.php";
            break;
        case 'agriculture_officer':
            $sql = "SELECT * FROM agrregister WHERE email = ? AND password = ?";
            $redirect_url = "agriqueryresolve.php";
            break;
        case 'selection_officer':
            $sql = "SELECT * FROM selectionofficer WHERE email = ? AND password = ?";
            $redirect_url = "selection_homepage.php";
            break;
        case 'truck_driver':
            $sql = "SELECT * FROM truckdriver WHERE email = ? AND password = ?";
            $redirect_url = "truck_driver_dashboard.php";
            break;
        default:

            exit; // Exit script
    }

    // Prepare and execute SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and handle login
    if ($result->num_rows == 1) {
        // Set session variable for logged-in user
        $_SESSION['email'] = $username;
        // Redirect user to the corresponding homepage based on user type
        header("Location: $redirect_url");
        exit; // Exit script
    } else {
        // Invalid username or password
        echo "<script>document.querySelector('.error-message').style.display = 'block';</script>";
    }

    // Close connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef0e9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Allows header and form to be in a column */
            justify-content: center; /* Center content vertically */
            align-items: center; /* Center content horizontally */
            min-height: 100vh;
        }
        
        /* Header styles */
        header {
            background-color: #bfd7bc;
            color: white;
            width: 100%; /* Full width of the page */
            text-align: center;
            padding: 20px;
            position: fixed; /* Fixed at the top of the page */
            top: 0;
            left: 0;
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
        
        /* Form container styles */
        .login-container {
            text-align: center;
            padding: 30px;
            border: 26px solid black;
            border-radius: 5px;
            background-color: #58a36b;
            margin-top: 100px; /* Adds spacing below the header */
        }

        .login-input {
            width: 90%; /* Maintain consistency with other containers */
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-button {
            background-color: #2b673d;
            color: white;
            border: none;
            border-radius: 80px;
            padding: 10px 30px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .login-button:hover {
            background-color: black;
        }

        /* Error message styling */
        .error-message {
            color: black;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.jpeg" alt="Logo">
        <h1>ఫార్మ్ కనెక్ట్</h1>
        <h3>పండించండి. కనెక్ట్ చేయండి. అభివృద్ధి చెందండి</h3>
    </header>

    <!-- Container for centering the login form -->
    <form method="post" action="">
        <div class="login-container">
            <h2>ప్రవేశించండి</h2>

            <!-- Error message container -->
            <div class="error-message" style="display: none;">
                Invalid username or password.
            </div>


            <div>
                <select name="user_type" class="login-input">
                    <option value="farmer">రైతు</option>
                    <option value="admin">అడ్మిన్</option>
                    <option value="agriculture_officer">వ్యవసాయ అధికారి</option>
                    <option value="selection_officer">ఎంపిక అధికారి</option>
                    <option value="truck_driver">ట్రక్ డ్రైవర్</option>
                </select>
            </div>
            <div>
                <input type="text" name="gmail" value="" class="login-input" placeholder="జీమెయిల్">
            </div>
            <div>
                <input type="password" name="pwd" value="" class="login-input" placeholder="పాస్వర్డ్">
            </div>
            <div>
                <input type="submit" name="login" value="ప్రవేశించండి" class="login-button">
            </div>
        </div>
    </form>


</body>
</html>
