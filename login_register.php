<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FARMCONNECT - Revolutionizing Agriculture</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }

        #features {
            background-color: #C4D7B2;
            padding: 2rem 0;
        }

        #how-it-works {
            background-color: #F7FFE5;
            padding: 2rem 0;
        }

        #get-started {
            background-color: #A0C49D;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }

        footer {
            background-color: #C4D7B2;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
        body {
            font-family: 'Varela Round', sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 3;
        }

        header {
            position: relative;
            background-color: #bfd7bc;
            color: white;
            text-align: center;
            padding: 0.4rem 0;
        }

        header img {
            position: absolute;
            top: 30px;
            left: 10px;
            width: 250px;
            height: auto;
            border-radius: 5%;
        }

        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: absolute;
            top: 50px;
            right: 10px;
        }

        nav li {
            margin: 8px;
        }

        nav li a {
            text-decoration: none;
            color: white;
        }

        /* Style for clicked navigation links */
        nav li a.clicked {
            color: #0e3109; /* Change to the color you prefer */
        }


        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 97%;
            max-width: 12000px;
            padding: 20px; /* Add some padding for spacing */
        }

        .login-form-container,
        .registration-buttons-container {
            flex: 2;
            padding: 35px;
            background-color: #9acfa2;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(91, 159, 100, 0.1);
        }

        .login-button,
        .registration-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #4b815d; /* Facebook blue */
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-bottom: 25px;
        }

        .login-button.google {
            background-color: #4b815d; /* Google red */
        }

        .login-button:hover,
        .registration-button:hover {
            background-color: #1a5a36; /* Darker color on hover */
        }

        .registration-buttons-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .registration-button {
            background-color: #4b815d; /* Teal color */
        }
    </style>
</head>
<body>
    <header>       
        
        <img src="logo.jpeg" alt="Logo">
        <h1 style="font-size: 2rem;">FARM CONNECT</h1>
        <h4 style="font-size: 1rem;">Cultivate | Connect | Thrive</h4>
    </header>
    <div class="container">
        <div class="login-form-container">
            <h2><b>Login Options</b></h2>
            <a href="gmaillogin.php" class="login-button google"><b>Login with Email</b></a>
        </div>
        <div style="width: 100px;"></div> 
        <div class="registration-buttons-container">
            <p style="text-align: center;"><b>Create an Account</b></p>
            <a href="farmerreg.php" class="registration-button"><b>Farmer 🌾</b></a>
            <a href="SeleOffReg.php" class="registration-button"><b>Selection Officer</b></a>
            <a href="agriregister.php" class="registration-button"><b>Agricultural Officer&#129333;</b></a>
            <a href="truckdriverreg.php" class="registration-button"><b>Truck Driver&#128666;</b></a>
        </div>
    </div>
    <section id="get-started">
        <h2>Get Started</h2>
        <p>Join FARMCONNECT today to empower your farming journey!</p>
        
    </section>

    <footer>
        <p>&copy; 2023 FARMCONNECT. All rights reserved.</p>
    </footer>
</body>
</html>