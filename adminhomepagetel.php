<?php
    // సెషన్ ప్రారంభం మరియు లోపాల నివారణ
    error_reporting(0); // PHP లోపాలను మంచిచేయండి
    session_start();

    // లాగౌట్ అభ్యర్థనను నిర్వహించు
    if(isset($_REQUEST['logout'])){
        session_destroy(); // సెషన్ నిర్మించు
        header("Location: gmaillogin.php"); // లాగిన్ పేజీకి దారికి రిడెయిరెక్ట్ చేయండి
        exit(); // స్క్రిప్ట్ కన్నిమ నిర్వహించండి
    }
?>
<!DOCTYPE html>
<html lang="te">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>అడ్మిన్ పానెల్</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef0e9;
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
            margin: 2 10px;
        }

        nav li a {
            margin: 2 10px;
            text-decoration: none;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #cbd1bc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .crop-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            background-color: #fff;
            padding-right: 20px; /* స్క్రోల్‌బార్ విస్తరణకు కొనసాగేందుకు డబ్బు డబ్బు చేయండి */
        }
        
        .crop {
            flex: 0 0 calc(33.333% - 20px);
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        
        .crop img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            cursor: pointer;
        }
        
        .crop-info {
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ddd;
            text-align: center;
        }
        
        .crop-info h3 {
            margin: 0;
        }
        
        .crop-info p {
            margin: 5px 0;
        }
        
        .separator {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
            background-color: #fff;
        }
        
        .add-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .add-button:hover {
            background-color: #45a049;
        }
        
        .manage-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #1976D2;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .manage-button:hover {
            background-color: #1565C0;
        }
        
        .logout {
            position: fixed;
            top: 10px;
            right: 10px;
        }
        .logout-button {
            position: absolute;
            bottom: 15px;
            right: 15px;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        .logout-button:hover {
            background-color: #3e8e41;
        }
        .logout a {
            text-decoration: none;
            color: #ffffff;
            background-color: #2b673d;
            padding: 8px 16px;
            border-radius: 5px;
        }
        
        .logout a:hover {
            background-color: #1a5a36;
        }

    </style>
</head>
<body>
    <header>
        <img src="logo.jpeg" alt="లోగో">
        <h1>ఫార్మ్ కనెక్ట్</h1>
        <h3>అత్యంత నేరంగా. కనెక్ట్. తలికైంది</h3>
        <nav>
            <ul>
               
            </ul>
        </nav>
        <button class="logout-button" onclick="window.location.href = 'gmaillogintel.php';">లాగౌట్</button>
    </header>
    <div class="container">
        <form action="managecropstel.php" method="post">
            <button type="submit" name="managecrops" value="మరియు నిర్వహించడానికి పంటలను నిర్వహించు" class="manage-button">పంటలను నిర్వహించు</button>
        </form>
        <form action="addcroptel.php" method="post">
            <button type="submit" name="addcrop" value="పంట" class="add-button">పంట</button>
        </form>
        <!-- పంటలను నిర్వహించడానికి విభాగం -->
        <h2>అందుబాటులో ఉన్న పంటలు</h2>
        <div class="separator"></div>
        <div class="crop-container">
            <?php
            // డేటాబేస్ కనెక్షన్ స్థాపించండి
            $conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());

            // డేటాబేస్ నుండి పంటలను తీసుకోండి
            $query = "SELECT cropnametel, avail, cropprice, image FROM addcrops";
            $result = mysqli_query($conn, $query);

            // పంటల డేటాను లూప్ చేసి ప్రదర్శించండి
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="crop">';
                    echo '<img src="' . $row["image"] . '" alt="' . $row["cropname"] . '">';
                    echo '<div class="crop-info">';
                    echo '<h3>' . $row["cropnametel"] . '</h3>';
                    echo '<p>ధర: Rs.' . $row["cropprice"] . '/క్వింటాల్</p>';
                    echo '<p>అందుబాటు: ' . ($row["avail"] == "available" ? "అవును" : "లేదు") . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "ఏ పంటలు అందుబాటులో లేవు.";
            }

            // డేటాబేస్ కనెక్షన్‌ను మూసివేయండి
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
