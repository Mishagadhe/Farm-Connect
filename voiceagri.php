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
        <button id="start">Start&#127908;</button>
        <button id="stop">Stop&#128721;</button><br>
        <button id="submit">Submit Problem</button>
    </div>

    <script>
        // Initialize speech recognition
        if ("webkitSpeechRecognition" in window) {
            let speechRecognition = new webkitSpeechRecognition();
            let final_transcript = "";

            // Configure speech recognition
            speechRecognition.continuous = true;
            speechRecognition.interimResults = true;
            speechRecognition.lang = "te-IN"; // Telugu language setting

            // Define events
            speechRecognition.onstart = () => {
                document.querySelector("#status").style.display = "block";
            };

            speechRecognition.onerror = () => {
                document.querySelector("#status").style.display = "none";
            };

            speechRecognition.onend = () => {
                document.querySelector("#status").style.display = "none";
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

                // Display the transcriptions
                document.querySelector("#final").innerHTML = final_transcript;
                document.querySelector("#interim").innerHTML = interim_transcript;
            };

            // Event handler for start button
            document.querySelector("#start").onclick = () => {
                speechRecognition.start();
            };

            // Event handler for stop button
            document.querySelector("#stop").onclick = () => {
                speechRecognition.stop();
            };

            // Event handler for submit button
            document.querySelector("#submit").onclick = () => {
                if (final_transcript.trim() !== "") {
                    // Send the captured text to the server using AJAX POST request
                    fetch('save_query.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ query: final_transcript })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the server response
                        if (data.message === "Query saved successfully") {
                            alert("Query saved successfully");
                        } else {
                            alert("Failed to save query");
                        }
                    })
                    .catch(error => console.error('Error:', error));

                    // Clear the final transcript and display text
                    final_transcript = "";
                    document.querySelector("#final").innerHTML = final_transcript;
                }
            };
        } else {
            console.log("Speech Recognition Not Available");
        }
    </script>
</body>
</html>
