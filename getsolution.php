<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Farmer Queries</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 0;
        }

        /* Header */
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

        /* Navigation */
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
            margin: 0 10px;
        }

        nav li a {
            text-decoration: none;
            color: white;
        }

        /* Buttons */
        

        /* Container */
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #bfd7bc;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <img src="logo.jpeg" alt="Logo">
        <h1>Farm Connect</h1>
        <h3>Cultivate. Connect. Thrive</h3>
    </header>

    <!-- Main container -->
    <div class="container">
        <!-- PHP code to fetch and display resolved queries -->
        <?php
        require_once 'db_connection.php';

        // Query to fetch all resolved queries from the resolvequeries table
        $sql = "
            SELECT
                r.solution_text,
                DATE_FORMAT(r.solution_date, '%Y-%m-%d') AS solution_date
            FROM
                resolvequeries r
            ORDER BY
                r.solution_date DESC";

        // Execute the query and fetch the results
        $result = $conn->query($sql);

        // Display the resolved queries in a table
        echo "<h2>Resolved Queries from Agriculture Officer</h2>";
        if ($result && $result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Solution</th><th>Date Resolved</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['solution_text'] . "</td>";
                echo "<td>" . $row['solution_date'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No resolved queries found.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>
