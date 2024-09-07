<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Queries</title>
    <style>
        /* Your CSS styles here */
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

        .container {
            max-width: 800px;
            margin: 28px auto; /* Adjusted margin */
            padding: 20px;
            background-color: #ffffff;
            border-radius: 7px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #250323; /* Dark text color */
        }

        .query-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        .query-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333; /* Dark text color */
        }

        .query {
            margin-bottom: 10px;
        }

        .query p {
            margin: 0;
            color: #666; /* Light text color */
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
        <h2>Farmer Queries</h2>
        <div class="query-container">
            <div class="query-title">Query 1</div>
            <div class="query">
                <p>Query details here...</p>
            </div>
        </div>
        <div class="query-container">
            <div class="query-title">Query 2</div>
            <div class="query">
                <p>Query details here...</p>
            </div>
        </div>
        <!-- Add more query containers as needed -->
    </div>
    <form id="speechForm">
        <label for="speechInput">Speak Here:</label>
        <input type="text" id="speechInput" name="speechInput" readonly>
        <button type="submit">Submit</button>
    </form>

    <textarea id="queries" rows="4" cols="50"></textarea>

    <script src="script.js"></script>
</body>
</html>
