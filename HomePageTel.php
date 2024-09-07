<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FARMCONNECT</title>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0e5;
        }

        /* Spinner */
        .spinner {
            width: 50px;
            height: 50px;
            --clr: rgb(247, 197, 159);
            --clr-alpha: rgba(247, 197, 159, 0.1);
            animation: spinner 1.6s infinite ease;
            transform-style: preserve-3d;
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: -1;
        }

        .spinner>div {
            background-color: var(--clr-alpha);
            height: 100%;
            position: absolute;
            width: 100%;
            border: 3.5px solid var(--clr);
        }

        .spinner>div:nth-of-type(1) {
            transform: translateZ(-17.6px) rotateY(180deg);
        }

        .spinner>div:nth-of-type(2) {
            transform: rotateY(-270deg) translateX(50%);
            transform-origin: top right;
        }

        .spinner>div:nth-of-type(3) {
            transform: rotateY(270deg) translateX(-50%);
            transform-origin: center left;
        }

        .spinner>div:nth-of-type(4) {
            transform: rotateX(90deg) translateY(-50%);
            transform-origin: top center;
        }

        .spinner>div:nth-of-type(5) {
            transform: rotateX(-90deg) translateY(50%);
            transform-origin: bottom center;
        }

        .spinner>div:nth-of-type(6) {
            transform: translateZ(17.6px);
        }

        @keyframes spinner {
            0% {
                transform: rotate(45deg) rotateX(-25deg) rotateY(25deg);
            }

            50% {
                transform: rotate(45deg) rotateX(-385deg) rotateY(25deg);
            }

            100% {
                transform: rotate(45deg) rotateX(-385deg) rotateY(385deg);
            }
        }

        /* Header */
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
        /* Navigation */
        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: absolute;
            top: 50px;
            right: 5px;
        }

        nav li {
            margin-left: 0;
        }
        nav li a {
            text-decoration: none;
            color: white;
        }
        nav li a.clicked {
            color: #0e3109; /* Change to the color you prefer */
        }

        nav a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        
        

        /* Slider */
        .slider-container {
            position: relative;
            width: 100%;
            max-width: 1440px;
            height: 400px;
            overflow: hidden;
            margin: 20px auto;
            border-radius: 8px;
        }

        .slider {
            display: flex;
            transition: transform 0.7s ease-in-out;
            height: 100%;
        }

        .slide {
            min-width: 100%;
            flex-shrink: 0;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Navigation arrows */
        .nav-arrows {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            z-index: 1;
        }

        .nav-arrow {
            width: 40px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .nav-arrow:hover {
            background-color: rgba(10, 11, 10, 0.8);
        }

        /* Sections */
        section {
            padding: 2rem;
            text-align: center;
        }

        /* What's New and Agriculture News */
        #whats-new,
        #agriculture-news {
            background-color: var(--primary-color, #bfd7bc);
            padding: 2rem;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        #whats-new h2,
        #agriculture-news h2 {
            font-size: 1.5rem;
            color: var(--text-color, #333);
        }

        .news-list {
            list-style: none;
            padding: 0;
        }

        .news-list li {
            margin-bottom: 1rem;
            padding: 1rem;
            border: 1px solid #ddd;
            background-color: #fff;
            border-radius: 5px;
            text-align: left;
        }

        .news-list li a {
            font-weight: bold;
            text-decoration: none;
            color: var(--secondary-color, #A0C49D);
        }

        .news-list li p {
            margin: 0.5rem 0 0;
            color: var(--text-color, #333);
        }
        .emoji-link {
            display: inline-block;
            background-color: #fcfcfc;
            color: rgb(23, 25, 23);
            padding: 10px 30px;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            height:auto;
        }
        .instruction-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #8ec3b0; /* Theme color */
    color: white;
    text-decoration: none;
    border-radius: 3px;
    transition: background-color 0.3s ease-in-out;
}

.instruction-button:hover {
    background-color: #9ed5c5; /* Darker theme color on hover */
}

        /* Minister Info */
        .minister-info {
            background-color: #ecf0e5;
            padding: 2rem;
            text-align: center;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 2rem; /* Add margin to separate sections */
        }

        .minister-details {
            max-width: 300px;
            flex: 3;
            margin: 2rem; /* Add margin between minister sections */
        }

        .minister-heading {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .minister-image {
            max-width: 80%;
            height: 150px;
            border-radius: 15px;
            margin-bottom: 1rem;
        }

        .minister-description {
            font-size: 1rem;
        }
        /* Footer */
        footer {
            background-color: var(--primary-color, #bfd7bc);
            padding: 10px;
            text-align: center;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <nav>
            <ul>
                <li><a href="fertilizerstel.php">నమూనా విత్తనాల <br>ఎరువులు</a></li>
                <li><a href="createTel.php">ఖాతా సృష్టించండి<br>లాగిన్</a></li>
                <li><a href="contact_telu.php">మమ్మల్ని సంప్రదించండి</a></li>
                <li><a href="InstructionEng.php">మార్గదర్శకత్వం</a></li>

            </ul>
        </nav>
        
        <img src="logo.jpeg" alt="Logo">
        <h1 style="font-size: 2rem;">ఫార్మ్ కనెక్ట్</h1>
        <h4 style="font-size: 1rem;">సాగు | కనెక్ట్ | అభివృద్ధి చెందండి</h4>
    </header>

    <!-- Spinner -->
    <div class="spinner">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <!-- Slider -->
    <div class="slider-container">
        <div class="slider">
            <div class="slide">
                <img src="img5.jpg" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="img6.jpg" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="img9.jpg" alt="Slide 3">
            </div>
        </div>
        <div class="nav-arrows">
            <div class="nav-arrow prev">&#10094;</div>
            <div class="nav-arrow next">&#10095;</div>
        </div>
    </div>

    <!-- What's New -->
    <section id="whats-new">
        <h2>కొత్తవి ఏమిటి</h2>
        <ul class="news-list">
            <li>
                <a href="#">వార్తల శీర్షిక 1</a>
                <p>వార్తల వివరణ ఇక్కడ ఉంది.</p>
            </li>
            <li>
                <a href="#">వార్తల శీర్షిక 2</a>
                <p>వార్తల వివరణ ఇక్కడ ఉంది.</p>
            </li>
            <li>
                <a href="#">వార్తల శీర్షిక 3</a>
                <p>వార్తల వివరణ ఇక్కడ ఉంది.</p>
            </li>
        </ul>
    </section>

    <!-- Agriculture News -->
    <section id="agriculture-news">
        <h2>వ్యవసాయ వార్తలు</h2>
        <ul class="news-list">
            <li>
                <a href="#">వ్యవసాయ వార్తలు శీర్షిక 1</a>
                <p>వ్యవసాయ వార్తల వివరణ ఇక్కడ ఉంది.</p>
            </li>
            <li>
                <a href="#">వ్యవసాయ వార్తలు శీర్షిక 2</a>
                <p>వ్యవసాయ వార్తల వివరణ ఇక్కడ ఉంది.</p>
            </li>
            <li>
                <a href="#">వ్యవసాయ వార్తలు శీర్షిక 3</a>
                <p>వ్యవసాయ వార్తల వివరణ ఇక్కడ ఉంది.</p>
            </li>
        </ul>
    </section>

    <!-- Minister Info -->
    <section class="minister-info">
    <div class="minister-details">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoqF_UpKDHLFVA08VQnXGcK7hQhsH3kNOHPl5xJgkSWg&s" alt="Telangana Chief Minister" class="minister-image">
        <p class="minister-description">తెలంగాణ ముఖ్యమంత్రి</p>
        <p class="minister-heading">రేవంత్ రెడ్డి</p>
    </div>
    <div class="minister-details">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Telangana_State_English_Map.svg/220px-Telangana_State_English_Map.svg.png" alt="Telangana" class="minister-image">
        <p class="minister-description">తెలంగాణ రాష్ట్రం</p>
        <p class="minister-heading">తెలంగాణ రాష్ట్ర వ్యవసాయం</p>
    </div>
    <div class="minister-details">
        <img src="https://www.telangana.gov.in/wp-content/uploads/2023/12/Sri-Tummala-Nageswara-Rao.jpg" alt="Telangana Agriculture Minister" class="minister-image">
        <p class="minister-description">తెలంగాణ వ్యవసాయ శాఖ మంత్రి</p>
        <p class="minister-heading">సింగిరెడ్డి నిరంజన్ రెడ్డి</p>
    </div>
</section>
    <!-- Footer -->
    <footer>
        <p>మమ్మల్ని ఇక్కడ సంప్రదించండి: <a href="mailto:info@farmconnect.com">info@farmconnect.com</a></p>
        <p>&copy; © 2024 ఫార్మ్ కనెక్ట్</p>
    </footer>

    <!-- JavaScript for Slider -->
    <script>
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.slide');
        const prevButton = document.querySelector('.prev');
        const nextButton = document.querySelector('.next');
        let currentSlide = 0;

        function goToSlide(index) {
            if (index < 0) {
                currentSlide = slides.length - 1;
            } else if (index >= slides.length) {
                currentSlide = 0;
            } else {
                currentSlide = index;
            }
            slider.style.transform = `translateX(${-currentSlide * 100}%)`;
        }

        prevButton.addEventListener('click', () => {
            goToSlide(currentSlide - 1);
        });

        nextButton.addEventListener('click', () => {
            goToSlide(currentSlide + 1);
        });

        setInterval(() => {
            goToSlide(currentSlide + 1);
        }, 5000);

        
    </script>
</body>

</html>
