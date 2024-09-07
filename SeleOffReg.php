<?php
// Start the session at the very beginning of the file
    // Check if the form is submitted
    if(isset($_POST["submit"])) {
        $Fullname1 = $_POST['Fullname'];
        $password1 = $_POST['Password'];
        $confirmpassword1 = $_POST['Confirm_Password'];
        $email1 = $_POST['email']; 
        $phoneno1 = $_POST['phoneno'];
        $aadhar1 = $_POST['aadhar'];
        $state1 = $_POST['state'];
        $district1 = $_POST['district']; 
        $mandal1 = $_POST['mandal']; 
        $street1 = $_POST['street'];

        // Validate the form fields
        $errors = array();

        // Example: Add validation rules for form fields
        if (empty($Fullname1)) {
            $errors[] = "Fullname is required";
        }

        if (empty($password1)) {
            $errors[] = "password is required";
        }

        if (empty($confirmpassword1)) {
            $errors[] = "confirm password is required";
        }

        if (empty($email1)) {
            $errors[] = "Email is required";
        }

        if (empty($phoneno1)) {
            $errors[] = "Phone number is required";
        }

        if (empty($aadhar1)) {
            $errors[] = "aadhar is required";
        }

        if (empty($state1)) {
            $errors[] = "state is required";
        }

        if (empty($district1)) {
            $errors[] = "district is required";
        }

        if (empty($mandal1)) {
            $errors[] = "mandal is required";
        }

        if (empty($street1)) {
            $errors[] = "street is required";
        }

        // Add more validation rules as needed...

        // If there are no errors, proceed with registration
        if (empty($errors)) {
            $conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());

            $query = "INSERT INTO selectionofficer VALUES ('$Fullname1', '$password1','$confirmpassword1','$email1', $phoneno1, '$aadhar1', '$state1', '$district1', '$mandal1', '$street1')";
            $result = mysqli_query($conn, $query);
            
            if ($result) { 
                header("Location: gmaillogin.php");
                exit(); // Make sure to exit after redirection
            } else {
                echo "<p style='color:red;'>Registration failed.> Please try again.</p>";
            }

            mysqli_close($conn);
        } else {
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 0;
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
            max-width: 400px;
            margin: 28px auto; /* Adjusted margin */
            padding: 40px;
            background-color: #ffffff;
            border-radius: 7px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #250323; /* Dark text color */
        }

        label {
            font-weight: bold;
            color: #250323; /* Dark text color */
        }

        .required {
            color: #e74c3c; /* Red color for asterisk */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 1px;
            margin-bottom: 1px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        label {
            font-weight: bold;
            color: #250323; /* Dark text color */
        }

        .required {
            color: #e73c3c; /* Red color for asterisk */
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input:required {
            border-color: #63e08f; /* Red border for required fields */
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            resize: vertical;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #8ec3b0; /* Theme color */
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #9ed5c5; /* Darker theme color on hover */
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle input[type="password"] {
            padding-right: 30px; /* Add padding for the eye icon */
        }
        .password-toggle .toggle-icon {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.jpeg" alt="Logo">
        <h1>FARM CONNECT</h1>
        <h3>Cultivate.Connect.Thrive</h3>
    </header>
    <div class="container">
        <h2>Selection Officer Registration</h2>
        <form method="POST" action="">
            <div>
                <label for="full-name">Full Name<span class="required">*</span>:</label>
                <input type="text" id="full-name" name="Fullname" required>
            </div>
            <div class="password-toggle">
        <label for="password">Password<span class="required">*</span>:</label>
        <input type="password" id="password" name="Password" required>
        <span class="toggle-icon" onclick="togglePasswordVisibility()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="none" d="M0 0h24v24H0z"/>
                <path d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm0-2c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/>
            </svg>
        </span>
    </div>
    <div>
        <label for="confirmpassword">Confirm Password<span class="required">*</span>:</label>
        <input type="password" id="confirmpassword" name="Confirm_Password" required>
    </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="phone">Phone Number<span class="required">*</span>:</label>
                <input type="text" id="phone" name="phoneno" required>
            </div>
            <div>
                <label for="aadhar">Aadhar Number<span class="required">*</span>:</label>
                <input type="number" id="aadhar" name="aadhar" required>
            </div>
            <div>
                <label for="state">State<span class="required">*</span>:</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div>
                <label for="village">District<span class="required">*</span>:</label>
                <input type="text" id="District" name="district" required>
            </div>
            <div>
                <label for="village">Mandal<span class="required">*</span>:</label>
                <input type="text" id="mandal" name="mandal" required>
            </div>
            <div>
                <label for="street">Street<span class="required">*</span>:</label>
                <input type="text" id="street" name="street" required>
            </div>
            <div>
                    <button type="submit" name="submit" >Register</button>
                </a>
            </div>
        </form>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var icon = document.querySelector(".toggle-icon svg path");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.setAttribute("d", "M0 0h24v24H0z M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm0-2c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z");
            } else {
                passwordField.type = "password";
                icon.setAttribute("d", "M0 0h24v24H0z M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm0-2c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z");
            }
        }
    </script>
</body>
</html>