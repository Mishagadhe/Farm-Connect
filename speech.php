<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speech Recognition Demo</title>
    <style>
        /* Styles for speech recognition demo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
    <h1>Speech Recognition Demo</h1>
    <li><a href="VoiceEng.html" class="emoji-link">&#127897;</a></li>
    <form action="store_query.php" method="POST">
        <label for="query">Enter Your Query:</label><br>
        <textarea id="query" name="query" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="Submit">
    </form>

    <script>
        // JavaScript for speech recognition demo
        // No specific JavaScript code provided in the original HTML document
    </script>
</body>
</html>
