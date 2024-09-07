<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Queries</title>
    <style>
        /* Add your CSS styling here */
        body {
            font-family: Arial, sans-serif;
            background-color: #FAF1E4;
            padding: 20px;
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
    <h1>Farmer Queries</h1>
    <p id="status">Listening...</p>
    <div>
        <span id="final"></span>
        <span id="interim"></span>
    </div>
    <button id="start">Start&#127908;</button>
    <button id="stop">Stop&#128721;</button>
    <button id="submit">Submit Query</button>

    <button id="view">View Queries</button> <!-- Button to navigate to the agriculture page -->

    <script>
        let speechRecognition;
        let final_transcript = "";

        // Initialize speech recognition if available
        if ("webkitSpeechRecognition" in window) {
            speechRecognition = new webkitSpeechRecognition();
            speechRecognition.continuous = true;
            speechRecognition.interimResults = true;
            speechRecognition.lang = "en-US"; // Telugu language

            speechRecognition.onstart = () => {
                document.querySelector("#status").innerText = "Listening...";
            };

            speechRecognition.onerror = () => {
                document.querySelector("#status").innerText = "Error occurred";
            };

            speechRecognition.onend = () => {
                document.querySelector("#status").innerText = "";
            };

            speechRecognition.onresult = (event) => {
                let interim_transcript = "";

                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    if (event.results[i].isFinal) {
                        final_transcript += event.results[i][0].transcript;
                    } else {
                        interim_transcript += event.results[i][0].transcript;
                    }
                }

                document.querySelector("#final").innerText = final_transcript;
                document.querySelector("#interim").innerText = interim_transcript;
            };
        } else {
            console.error("Speech Recognition Not Available");
        }

        // Start button click handler
        document.querySelector("#start").onclick = () => {
            if (speechRecognition) {
                speechRecognition.start();
            }
        };

        // Stop button click handler
        document.querySelector("#stop").onclick = () => {
            if (speechRecognition) {
                speechRecognition.stop();
            }
        };

        // Submit button click handler
        document.querySelector("#submit").onclick = () => {
            if (final_transcript.trim() !== "") {
                // Send POST request to backend API
                fetch('/api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ query: final_transcript })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    final_transcript = ""; // Reset the final transcript
                    document.querySelector("#final").innerText = "";
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        };

        // Handler for the View Queries button
        document.querySelector("#view").onclick = () => {
            // Redirect to the agriculture page
            window.location.href = "/agriculture_queries.php";
        };
    </script>
</body>

</html>
