<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FARMCONNECT</title>
    <style>
        
      body {
            font-family: 'Varela Round', sans-serif;
            background-color: #ecf0e5;
            margin: 0;
            padding: 3;
        }

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

        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: absolute;
            top: 50px;
            right: 10px;
        }

        nav li {
            margin: 8px;
        }

        nav li a {
            text-decoration: none;
            color: white;
        }

        /* Style for clicked navigation links */
        nav li a.clicked {
            color: #0e3109; /* Change to the color you prefer */
        }

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

        #get-started {
            background-color: #A0C49D;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }

        footer {
            background-color: #C4D7B2;
            color: white;
            text-align: center;
            padding: 0.5rem 0;
        }

        /* Updated styles for ministers' info */
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

        /* Color variables */
        :root {
            --primary-color: #bfd7bc; /* Primary color from your homepage */
            --secondary-color: #A0C49D; /* Secondary color from your homepage */
            --text-color: #333; /* Text color from your homepage */
        }

        /* Style for the "What's New" and "Agriculture News" sections */
        #whats-new, #agriculture-news {
            background-color: var(--primary-color); /* Match the primary color */
            padding: 2rem;
            color: var(--text-color); /* Match the text color */
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
        }

        .news-list li a {
            color: var(--secondary-color); /* Match the secondary color */
            text-decoration: none;
            font-weight: bold;
        }

        .news-list li p {
            margin-top: 0.5rem;
            overflow: auto; /* Add scrollbar for news description */
            max-height: 120px; /* Set max height for the scrollbar */
        }
        .emoji-link {
            display: inline-block;
            background-color: #fcfcfc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
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

#collect-places {
    background-color: #A0C49D; /* Secondary color */
    color: white;
    text-align: center;
    padding: 2rem 0;
    border-radius: 5px;
    margin: 2rem 0;
}

#collect-places h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

#collect-places form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

#collect-places label {
    font-weight: bold;
    margin-bottom: 1rem;
}

#places {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 3px;
    background-color: white;
}

#places option {
    padding: 5px;
}

#places:focus {
    outline: none;
    border-color: #87b687; /* Focus color */
}

#get-directions {
    margin-top: 1rem;
}

    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="CreateEng.php">Create Account</a></li>
                <li><a href="gmaillogin.php">Login</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                <li><a href="abt.html">About Page</a></li>
                <li><a href="contact.html" class="emoji-link">&#128222;</a></li>
            </ul>
        </nav>        
        
        <img src="logo.jpeg" alt="Logo">
        <h1 style="font-size: 2rem;">FARM CONNECT</h1>
        <h4 style="font-size: 1rem;">Cultivate | Connect | Thrive</h4>
    </header>
    
    <div class="slider-container">
    <div class="slider">
        <div class="slide">
            <img src="img6.jpg" alt="Slide 1">
        </div>
        <div class="slide">
            <img src="img9.jpg" alt="Slide 2">
        </div>
        <div class="slide">
            <img src="img5.jpg" alt="Slide 2">
        </div>
        <!-- Add more slides as needed -->
    </div>
    <div class="nav-arrows">
        <div class="nav-arrow" onclick="prevSlide()">‹</div>
        <div class="nav-arrow" onclick="nextSlide()">›</div>
    </div>
</div>
    <!-- Add this section after the "get-started" section -->
<section id="collect-places">
    <h2>Select Collection Places</h2>
    <form>
        <label for="places">Select Places:</label>
        <select id="places" name="places" multiple>
            <option value="place1">Shaikpet Rd, Ambedkar Nagar, Shaikpet, Hyderabad, Telangana 500104</option>
            <option value="place2"></option>
            <option value="place3">Place 3</option>
            <!-- Add more places as needed -->
        </select>
        <button id="get-directions" class="instruction-button">Get Directions</button>
    </form>
</section>


    <section id="whats-new">
        <h2>What's New<span> 🔔 </span></h2>
        <ul class="news-list">
            <li>
                <a href="#">News Title 1</a>
                <p>News description goes here...</p>
            </li>
            <li>
                <a href="#">News Title 2</a>
                <p>News description goes here...</p>
            </li>
            <!-- Add more news items as needed -->
        </ul>
    </section>

    <section id="agriculture-news">
        <h2>Agriculture News &#128240;</h2>
        <ul class="news-list">
            <li>
                <a href="#">Agriculture News 1</a>
                <p>News description goes here...</p>
            </li>
            <li>
                <a href="#">Agriculture News 2</a>
                <p>News description goes here...</p>
            </li>
            <!-- Add more agriculture news items as needed -->
        </ul>
        </section>

<section class="minister-info">
    <div class="minister-details">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoqF_UpKDHLFVA08VQnXGcK7hQhsH3kNOHPl5xJgkSWg&s" alt="Telangana Chief Minister" class="minister-image">
        <p class="minister-description">Telangana Chief Minister</p>
        <p class="minister-heading">Revanth Reddy</p>
    </div>
    <div class="minister-details">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Telangana_State_English_Map.svg/220px-Telangana_State_English_Map.svg.png" alt="Telangana" class="minister-image">
        <p class="minister-description">Telangana State</p>
        <p class="minister-heading">Telangana State Agriculture</p>
    </div>
    <div class="minister-details">
        <img src="https://www.telangana.gov.in/wp-content/uploads/2023/12/Sri-Tummala-Nageswara-Rao.jpg" alt="Telangana Agriculture Minister" class="minister-image">
        <p class="minister-description">Telangana Agriculture Minister</p>
        <p class="minister-heading">Singireddy Niranjan Reddy</p>
    </div>
</section>



    <section id="get-started">
        <p>Join FARMCONNECT today to empower your farming journey!</p>
        <a href="instruction.html" class="instruction-button">Instructions</a>
    </section>

    <footer>
        <p>&copy; 2023 FARMCONNECT. All rights reserved.</p>

    </footer>
    
    <script>
        const slider = document.querySelector(".slider");
        const prevArrow = document.querySelector(".nav-arrow:first-child");
        const nextArrow = document.querySelector(".nav-arrow:last-child");
        const slideWidth = slider.clientWidth;
        let currentIndex = 0;

        prevArrow.addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + slider.children.length) % slider.children.length;
            slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        });

        nextArrow.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % slider.children.length;
            slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        });

        // JavaScript for marking clicked link
        const navLinks = document.querySelectorAll("nav li a");
        
        navLinks.forEach(link => {
            link.addEventListener("click", () => {
                // Remove 'clicked' class from all links
                navLinks.forEach(navLink => {
                    navLink.classList.remove("clicked");
                });
                // Add 'clicked' class to the clicked link
                link.classList.add("clicked");
            });
        });
        </script>

<script>
    // Your existing code ...

    const getDirectionsButton = document.getElementById("get-directions");

    getDirectionsButton.addEventListener("click", () => {
        const selectedPlaces = document.getElementById("places").selectedOptions;
        if (selectedPlaces.length > 0) {
            const placesQuery = Array.from(selectedPlaces)
                .map(place => encodeURIComponent(place.value))
                .join("+to:");
            const gpsLink = `https://www.google.com/maps/dir/${placesQuery}`;
            window.open(gpsLink, "_blank");
        } else {
            alert("Please select at least one place.");
        }
    });
</script>


</body>
</html>