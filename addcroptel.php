<!DOCTYPE html>
<html lang="te">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>పంట జోడించు</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #eef0e9;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
        }
        
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .form-group button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>విత్తనం జోడించు</h1>
        <form action="addcrop.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="crop_id">విత్తన ఐడి:</label>
                <input type="text" id="crop_id" name="crop_id" required>
            </div>
            <div class="form-group">
                <label for="crop_name">విత్తన పేరు (ఇంగ్లీష్):</label>
                <input type="text" id="crop_name" name="crop_name" required>
            </div>
            <div class="form-group">
                <label for="crop_name_telugu">విత్తన పేరు (తెలుగులో):</label>
                <input type="text" id="crop_name_telugu" name="crop_name_telugu" required>
            </div>
            <div class="form-group">
                <label for="crop_price">విత్తన ధర:</label>
                <input type="number" id="crop_price" name="crop_price" required>
            </div>
            <div class="form-group">
                <label for="availability">అందుబాటు:</label>
                <select id="availability" name="availability" required>
                    <option value="available">అందుబాటు</option>
                    <option value="not_available">అందుబాటు లేదు</option>
                </select>
            </div>
            <div class="form-group">
                <label for="crop_image">విత్తన చిత్రం:</label>
                <input type="file" id="crop_image" name="crop_image" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">విత్తనం జోడించు</button>
            </div>
        </form>
    </div>

    <?php
    // ఫారం సమర్పించబడింది అని తనిఖీ చేసినాము
    if(isset($_POST["submit"])) {
        // డేటాబేస్ కనెక్షన్ స్థాపించండి
        $conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());

        // ఫారం డేటాను తీసుకొని స్యానిటైజ్ చేసి
        $cropid = mysqli_real_escape_string($conn, $_POST['crop_id']);
        $cropname = mysqli_real_escape_string($conn, $_POST['crop_name']);
        $cropname_telugu = mysqli_real_escape_string($conn, $_POST['crop_name_telugu']); // తెలుగు విత్తన పేరు పొందండి
        $cropprice = mysqli_real_escape_string($conn, $_POST['crop_price']);
        $availability = mysqli_real_escape_string($conn, $_POST['availability']);

        // చిత్రం అప్‌లోడ్ చేయడానికి చిక్కని మార్గాలు
        $cropimage = $_FILES['crop_image']['name'];
        $target_dir = "C:/xampp/htdocs/farmconnect"; // మార్గాను సూచించు
        $target_file = $target_dir . basename($_FILES["crop_image"]["name"]);

        // ఫైలు చిత్రమైనా పరిక్షించండి
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "క్షమించండి, నిర్దిష్టమైన JPG, JPEG, PNG & GIF ఫైళ్లు మాత్రమే అనుమతించబడినవి.";
            exit();
        }

        // ఫైలు పరిమాణం తనిఖీ చేయండి (5MB గరిష్ట పరిమాణం అందుబాటులో భావించండి)
        if ($_FILES["crop_image"]["size"] > 5000000) {
            echo "క్షమించండి, మీ ఫైలు చాలా పెద్దది.";
            exit();
        }

        // ఫైలు అప్‌లోడ్ చేయండి
        if (move_uploaded_file($_FILES["crop_image"]["tmp_name"], $target_file)) {
            // డేటాబేస్‌లో విత్తన వివరాలను చేర్చండి
            $query = "INSERT INTO addcrops (cropid, cropname, cropnametel, cropprice, avail, image) 
              VALUES ($cropid, '$cropname', '$cropname_telugu', '$cropprice', '$availability', '$cropimage')";
            $result = mysqli_query($conn, $query);

            // ఎంచుకోవడం విజయవంతం కాదు అని తనిఖీ చేయండి
            if ($result) { 
                echo "<p style='color:green;'>విత్తనం విజయవంతంగా జోడించబడింది.</p>";
            } else {
                echo "<p style='color:red;'>విత్తనం జోడించలేదు. దయచేసి మళ్లీ ప్రయత్నించండి.</p>";
            }
        } else {
            echo "క్షమించండి, మీ ఫైలు అప్‌లోడ్ చేయబడలేదు.";
        }

        // డేటాబేస్ కనెక్షన్‌ను మూసుకోండి
        mysqli_close($conn);
    }
    ?>

</body>
</html>