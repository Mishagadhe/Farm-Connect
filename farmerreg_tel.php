<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>రైతు నమోదు</title>
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
    </style>
</head>
<body>
    <header>
        <img src="logo.jpeg" alt="Logo">
        <h1>ఫార్మ్ కనెక్ట్</h1>
        <h3>సాగు చేయండి. కనెక్ట్ చేయండి. వృద్ధి చెందండి</h3>
        <nav>
            <ul>
               
            </ul>
        </nav>
    </header>
    <div class="container">
        <h2>రైతు నమోదు</h2>
        <form method="POST" action="process_farmer_registration.php">
            <div>
                <label for="full-name">పూర్తి పేరు<span class="required">*</span>:</label>
                <input type="text" id="full-name" name="full_name" required>
            </div>
            <div>
                <label for="email">ఇమెయిల్</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="phone">ఫోను నంబరు<span class="required">*</span>:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div>
                <label for="aadhar">ఆధార్ సంఖ్య<span class="required">*</span>:</label>
                <input type="number" id="aadhar" name="aadhar" required>
            </div>
            <div>
                <label for="state">రాష్ట్రం<span class="required">*</span>:</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div>
                <label for="district">జిల్లా<span class="required">*</span>:</label>
                <input type="text" id="district" name="district" required>
            </div>
            <div>
                <label for="village">గ్రామం<span class="required">*</span>:</label>
                <input type="text" id="village" name="village" required>
            </div>
            <div>
                <label for="street">వీధి<span class="required">*</span>:</label>
                <input type="text" id="street" name="street" required>
            </div>
            <div>
                <button type="submit">నమోదు చేసుకోండి</button>
            </div>
        </form>
    </div>
</body>
</html>