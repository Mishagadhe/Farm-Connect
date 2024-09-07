<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us - FarmConnect</title>
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
            color: white;
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

        /* Container */
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Contact Form */
        h1 {
            text-align: center;
            color: #2d3e50;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #2d3e50;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button.submit {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
        }

        button.submit:hover {
            background-color: #45a049;
        }

        /* About Section */
        .about-section {
            padding: 20px;
            background-color: #ffffff;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none; /* Initially hidden */
        }

        .about-section h2 {
            text-align: center;
            color: #2d3e50;
        }

        .about-section p {
            text-align: justify;
            color: #2d3e50;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <img src="logo.jpeg" alt="FarmConnect Logo">
        <h1>FarmConnect</h1>
        <h3>Cultivate. Connect. Thrive</h3>
        <nav>
            <ul>
                <li><a href="HomePageEng.php">Home</a></li>
                <li><a href="#" id="aboutLink">About</a></li>
            </ul>
        </nav>
    </header>

    <!-- About Section -->
    <div class="about-section container" id="aboutSection">
        <h2>About FarmConnect</h2>
        <p>FarmConnect is a platform designed to connect farmers with agricultural experts and other farmers. Our goal is to help farmers cultivate their knowledge and resources to thrive in the ever-changing world of agriculture. Whether you have questions about your crops, soil, or farming techniques, our community is here to help you succeed.</p>
    </div>

    <!-- Main content -->
    <div class="container">
        <h1>Contact Us</h1>
        <p>If you have any questions or concerns, please don't hesitate to reach out to us. Fill out the form below, and we'll get back to you as soon as possible.</p>
        <form id="contactForm" action="process_contact.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="submit">Submit</button>
        </form>
    </div>

    <script>
        // JavaScript code to handle the "About" link click event
        document.getElementById('aboutLink').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link action
            // Get the About FarmConnect container
            const aboutSection = document.getElementById('aboutSection');
            // Toggle the display property between "none" and "block"
            aboutSection.style.display = aboutSection.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>

</html>
