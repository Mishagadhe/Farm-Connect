<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speech Recognition Demo</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #FAF1E4; /* Light Cream */
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            text-align: center;
            padding: 20px;
            background-color: #CEDEBD; /* Light Green */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #435334; /* Dark Green */
        }

        #final {
            color: #333;
            font-weight: bold;
        }

        #interim {
            color: #aaa;
        }

        #status {
            display: none;
            color: green;
        }

        button {
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff; /* Blue */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3; /* Dark Blue */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Speech Recognition Demo</h1>
        <p id="status">Listening...</p>
        <div>
            <span id="final"></span>
            <span id="interim"></span>
        </div>
        <button id="start">Start</button>
        <button id="stop">Stop</button>
        <br>
        <button id="submit">Submit Problem</button>
    </div>

    <script>
        if ('webkitSpeechRecognition' in window) {
            const speechRecognition = new webkitSpeechRecognition();
            let finalTranscript = '';

            speechRecognition.continuous = true;
            speechRecognition.interimResults = true;
            speechRecognition.lang = 'en-US';

            speechRecognition.onstart = () => {
                document.getElementById('status').style.display = 'block';
            };

            speechRecognition.onerror = () => {
                document.getElementById('status').style.display = 'none';
            };

            speechRecognition.onend = () => {
                document.getElementById('status').style.display = 'none';
            };

            speechRecognition.onresult = (event) => {
                let interimTranscript = '';
                
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    if (event.results[i].isFinal) {
                        finalTranscript += event.results[i][0].transcript;
                    } else {
                        interimTranscript += event.results[i][0].transcript;
                    }
                }

                document.getElementById('final').innerText = finalTranscript;
                document.getElementById('interim').innerText = interimTranscript;
            };

            document.getElementById('start').onclick = () => {
                speechRecognition.start();
            };

            document.getElementById('stop').onclick = () => {
                speechRecognition.stop();
            };

            document.getElementById('submit').onclick = () => {
                const query = finalTranscript.trim();

                if (query) {
                    // Collect the farmer names and officer solution from the form or input
                    const farmerNames = ['Farmer 1', 'Farmer 2']; // Example: replace with actual farmer names
                    const solution = 'Solution provided by officer.'; // Example: replace with actual solution text

                    // Make a POST request to the server with the query, farmer names, and solution
                    fetch('save_queryagri.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ query, farmerNames, solution })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === "Query, solution, and selected farmer names saved successfully") {
                            alert("Query, solution, and selected farmer names saved successfully");
                        } else {
                            alert("Failed to save query, solution, or farmer names");
                        }
                    })
                    .catch(error => console.error('Error:', error));

                    // Clear the final transcript and display text
                    finalTranscript = '';
                    document.getElementById('final').innerText = '';
                } else {
                    alert('Query is empty. Please provide a valid query.');
                }
            };
        } else {
            console.log('Speech Recognition Not Available');
        }
    </script>
</body>
</html>