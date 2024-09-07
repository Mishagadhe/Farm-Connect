<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Farmer Queries</title>
    <style>
        /* General Styles */
        /* Styles remain the same as your provided file */
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
            margin: 0 10px;
        }

        nav li a {
            text-decoration: none;
            color: white;
        }

        .emoji-link {
            display: inline-block;
            background-color: #4caf50;
            color: rgb(247, 244, 244);
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .logout-button {
            display: inline-block;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        /* Container */
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        h1 {
            text-align: center;
            color: #2d3e50;
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

        /* JavaScript styling */
        #query-table-body tr:hover {
            background-color: #f1f1f1;
        }

        /* Form styling */
        #submitTextSolution {
    display: inline-block;
    background-color: #4caf50; /* Green background color */
    color: white; /* White text */
    padding: 10px 20px; /* Padding around the text */
    border: none; /* Remove default border */
    border-radius: 8px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size */
    text-align: center; /* Center the text */
    transition: background-color 0.3s; /* Smooth transition for background color */
    margin-top: 10px; /* Margin above the button */
}

/* Button hover state */
#submitTextSolution:hover {
    background-color: #45a049; /* Darker green color on hover */
}

        /* Solution sections */
        #textSolutionSection,
        #voiceSolutionSection {
            display: none;
            margin-top: 20px;
        }

        #textSolutionSection textarea {
            width: 100%;
            resize: vertical;
        }
    </style>
</head>

<body>
    <header>
        <img src="logo.jpeg" alt="Logo">
        <h1>FARM CONNECT</h1>
        <h3>Cultivate. Connect. Thrive</h3>
        <nav>
            <ul style="display: flex; justify-content: flex-end;">
                <!-- Voice emoji link -->

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
        <h1>Farmer Queries</h1>
        <table>
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Farmer Full Name</th>
                    <th>District</th>
                    <th>Mandal</th>
                    <th>Street</th>
                    <th>Query</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody id="query-table-body">
                <!-- Rows will be populated by JavaScript -->
            </tbody>
        </table>

        <!-- Solution through text -->
        <div id="textSolutionSection" style="display: none;">
            <h3>Submit Solution Through Text</h3>
            <textarea id="solutionText" rows="4" placeholder="Enter your solution here..."></textarea>
            <br>
            <button id="submitTextSolution">Submit Solution</button>
        </div>

        <!-- Solution through voice-to-text -->
       
    </div>

    <script>
        // Fetch data from the server
        fetch('get_queries.php')
            .then(response => response.json())
            .then(data => {
                const queryTableBody = document.getElementById('query-table-body');

                // Populate the table with data
                data.forEach(farmerQuery => {
                    const row = document.createElement('tr');

                    // Create a checkbox cell
                    const selectCell = document.createElement('td');
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.value = farmerQuery.query_id;
                    checkbox.dataset.fullname = farmerQuery.Fullname;
                    selectCell.appendChild(checkbox);

                    // Create cells for Fullname, district, mandal, street, query, and date
                    const nameCell = document.createElement('td');
                    nameCell.textContent = farmerQuery.Fullname;

                    const districtCell = document.createElement('td');
                    districtCell.textContent = farmerQuery.district;

                    const mandalCell = document.createElement('td');
                    mandalCell.textContent = farmerQuery.mandal;

                    const streetCell = document.createElement('td');
                    streetCell.textContent = farmerQuery.street;

                    const queryCell = document.createElement('td');
                    queryCell.textContent = farmerQuery.query;

                    const dateCell = document.createElement('td');
                    dateCell.textContent = farmerQuery.created_at;

                    // Append cells to the row
                    row.appendChild(selectCell);
                    row.appendChild(nameCell);
                    row.appendChild(districtCell);
                    row.appendChild(mandalCell);
                    row.appendChild(streetCell);
                    row.appendChild(queryCell);
                    row.appendChild(dateCell);

                    // Append the row to the table body
                    queryTableBody.appendChild(row);

                    // Add event listener to the checkbox
                    checkbox.addEventListener('change', function() {
                        // Display the sections when a checkbox is selected
                        const isAnySelected = Array.from(queryTableBody.getElementsByTagName('input'))
                            .some(input => input.checked);
                        document.getElementById('textSolutionSection').style.display = isAnySelected ? 'block' : 'none';
                        document.getElementById('voiceSolutionSection').style.display = isAnySelected ? 'block' : 'none';
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

        // Handle submit text solution
        document.getElementById('submitTextSolution').addEventListener('click', function() {
            // Get selected rows and provided solution text
            const checkboxes = document.querySelectorAll('#query-table-body input[type="checkbox"]:checked');
            const selectedQueries = [];
            const farmerFullnames = [];

            checkboxes.forEach(cb => {
                // Add the value (query ID) and fullname
                selectedQueries.push(cb.value);
                farmerFullnames.push(cb.dataset.fullname);
            });

            const solutionText = document.getElementById('solutionText').value.trim();

            if (selectedQueries.length === 0) {
                alert('Please select a query to provide a solution.');
                return;
            }

            // Send selected queries, farmer full names, and solution text to the server
            fetch('submit_solution.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    queries: selectedQueries,
                    farmerFullnames: farmerFullnames,
                    solution: solutionText
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Solution submitted successfully.');
                    document.getElementById('solutionText').value = ''; // Clear the textarea
                    // Optionally refresh the page or perform additional actions
                } else {
                    alert('Failed to submit solution.');
                }
            })
            .catch(error => {
                console.error('Error submitting solution:', error);
                alert('Error submitting solution.');
            });
        });
    </script>
</body>

</html>
