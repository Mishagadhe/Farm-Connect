<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Connect</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('farm_background.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #fff;
            position: relative;
            
        }

        .spinner {
            width: 50px;
            height: 50px;
            --clr: rgb(247, 197, 159);
            --clr-alpha: rgb(247, 197, 159, .1);
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

        .spinner div:nth-of-type(1) {
            transform: translateZ(-17.6px) rotateY(180deg);
        }

        .spinner div:nth-of-type(2) {
            transform: rotateY(-270deg) translateX(50%);
            transform-origin: top right;
        }

        .spinner div:nth-of-type(3) {
            transform: rotateY(270deg) translateX(-50%);
            transform-origin: center left;
        }

        .spinner div:nth-of-type(4) {
            transform: rotateX(90deg) translateY(-50%);
            transform-origin: top center;
        }

        .spinner div:nth-of-type(5) {
            transform: rotateX(-90deg) translateY(50%);
            transform-origin: bottom center;
        }

        .spinner div:nth-of-type(6) {
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

        header,
        nav {
            background-color: #1e824c;
            color: #fff;
            padding: 15px;
            text-align: center;
            z-index: 1;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav li {
            margin: 0 15px;
        }

        /* === removing default button style ===*/
        .button {
            margin: 0 10px;
            height: auto;
            background: transparent;
            padding: 0;
            border: none;
            cursor: pointer;
            --border-right: 6px;
            --text-stroke-color: rgba(255, 255, 255, 0.6);
            --animation-color: #37FF8B;
            --fs-size: 2em;
            letter-spacing: 3px;
            text-decoration: none;
            font-size: var(--fs-size);
            font-family: "Arial";
            position: relative;
            text-transform: uppercase;
            color: transparent;
            -webkit-text-stroke: 1px var(--text-stroke-color);
        }

        .button .hover-text {
            position: absolute;
            box-sizing: border-box;
            content: attr(data-text);
            color: var(--animation-color);
            width: 0%;
            inset: 0;
            border-right: var(--border-right) solid var(--animation-color);
            overflow: hidden;
            transition: 0.5s;
            -webkit-text-stroke: 1px var(--animation-color);
        }

        .button:hover .hover-text {
            width: 100%;
            filter: drop-shadow(0 0 23px var(--animation-color));
        }

        .marquee {
            --spacing: 5em;
            --start: 0em;
            --end: 5em;
            -webkit-animation: marquee 1s linear infinite;
            animation: marquee 1s linear infinite;
            -webkit-animation-play-state: paused;
            animation-play-state: paused;
            opacity: 0;
            position: relative;
            text-shadow: #fff var(--spacing) 0, #fff calc(var(--spacing) * -1) 0,
                #fff calc(var(--spacing) * -2) 0;
        }

        .button:hover .marquee {
            -webkit-animation-play-state: running;
            animation-play-state: running;
            opacity: 1;
        }

        @keyframes marquee {
            0% {
                transform: translateX(var(--start));
            }

            to {
                transform: translateX(var(--end));
            }
        }

        .btn-23,
.btn-23 *,
.btn-23 :after,
.btn-23 :before,
.btn-23:after,
.btn-23:before {
  border: 0 solid;
  box-sizing: border-box;
}

.btn-23 {
  -webkit-tap-highlight-color: transparent;
  -webkit-appearance: button;
  background-color: #000;
  background-image: none;
  color: #fff;
  cursor: pointer;
  font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
    Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif,
    Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
  font-size: 100%;
  font-weight: 900;
  line-height: 1.5;
  margin: 0;
  mask-image: -webkit-radial-gradient(#000, #fff);
  padding: 0;
  text-transform: uppercase;
}

.btn-23:disabled {
  cursor: default;
}

.btn-23:-moz-focusring {
  outline: auto;
}

.btn-23 svg {
  display: block;
  vertical-align: middle;
}

.btn-23 [hidden] {
  display: none;
}

.btn-23 {
  border-radius: 99rem;
  border-width: 2px;
  overflow: hidden;
  padding: 0.8rem 3rem;
  position: relative;
}

.btn-23 span {
  display: grid;
  inset: 0;
  place-items: center;
  position: absolute;
  transition: opacity 0.2s ease;
}

.btn-23 .marquee {
  --spacing: 5em;
  --start: 0em;
  --end: 5em;
  -webkit-animation: marquee 1s linear infinite;
  animation: marquee 1s linear infinite;
  -webkit-animation-play-state: paused;
  animation-play-state: paused;
  opacity: 0;
  position: relative;
  text-shadow: #fff var(--spacing) 0, #fff calc(var(--spacing) * -1) 0,
    #fff calc(var(--spacing) * -2) 0;
}

.btn-23:hover .marquee {
  -webkit-animation-play-state: running;
  animation-play-state: running;
  opacity: 1;
}

.btn-23:hover .text {
  opacity: 0;
}

@-webkit-keyframes marquee {
  0% {
    transform: translateX(var(--start));
  }

  to {
    transform: translateX(var(--end));
  }
}

@keyframes marquee {
  0% {
    transform: translateX(var(--start));
  }

  to {
    transform: translateX(var(--end));
  }
}

        
        section {
            padding: 40px;
            text-align: center;
        }

        h2 {
            color: #1e824c;
        }

        p {
            color: #555;
            font-size: 18px;
            line-height: 1.6;
        }

        /* Additional Styling */
        .highlight-box {
            background-color: #1b5228;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .subtle-text {
            margin-bottom: 20px;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="spinner">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <section>
        <h2>Welcome to Farm Connect</h2>
        <p>Explore the world of farming with us. Connect with nature and experience the beauty of agriculture.</p>

        <div class="language-buttons">
            <button class="button" onclick="goToEnglishPage()">English</button>
            <button class="button" onclick="goToTeluguPage()">తెలుగు
                <span class="marquee">తెలుగు</span>
            </button>
        </div>

        <button class="btn-23" onclick="goToEnglishPage()">
            <span class="text">English</span>
            <span aria-hidden="" class="marquee">English</span>
        </button>
        
        <button class="btn-23" onclick="goToTeluguPage()">
            <span class="text">తెలుగు</span>
            <span aria-hidden="" class="marquee">తెలుగు</span>
        </button>

        <div class="highlight-box">
            <p class="subtle-text">Join our community and stay connected!</p>
        </div>
    </section>

     <script>
          function goToEnglishPage() {
        window.location.href = "HomePageEng.php";
    }

    function goToTeluguPage() {
        window.location.href = "HomePageTel.php";
    }

    // Dynamically insert an image
    const dynamicImageContainer = document.getElementById('dynamic-image-container');
    const dynamicImage = document.createElement('img');
    dynamicImage.src = 'WhatsApp Image 2024-02-16 at 2.47.09 PM (1).jpeg'
    dynamicImageContainer.appendChild(dynamicImage);
    </script>
    <script>
        window.embeddedChatbotConfig = {
        chatbotId: "QEoBvqpbXHwiNraQ24aIW",
        domain: "www.chatbase.co"
        }
        </script>
        <script
        src="https://www.chatbase.co/embed.min.js"
        chatbotId="QEoBvqpbXHwiNraQ24aIW"
        domain="www.chatbase.co"
        defer>
        </script>
</body>

</html>
