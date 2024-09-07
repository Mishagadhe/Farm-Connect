<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Crop</title>
    <style>
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
        <h1>Add Crop</h1>
        <form action="addcrop.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="crop_id">Crop Id:</label>
                <input type="text" id="crop_id" name="crop_id" required>
            </div>
            <div class="form-group">
                <label for="crop_name">Crop Name (English):</label>
                <input type="text" id="crop_name" name="crop_name" required>
            </div>
            <div class="form-group">
                <label for="crop_name_telugu">Crop Name (Telugu):</label>
                <input type="text" id="crop_name_telugu" name="crop_name_telugu" required>
            </div>
            <div class="form-group">
                <label for="crop_price">Crop Price:</label>
                <input type="number" id="crop_price" name="crop_price" required>
            </div>
            <div class="form-group">
                <label for="availability">Availability:</label>
                <select id="availability" name="availability" required>
                    <option value="available">Available</option>
                    <option value="not_available">Not Available</option>
                </select>
            </div>
            <div class="form-group">
                <label for="crop_image">Crop Image:</label>
                <input type="file" id="crop_image" name="crop_image" accept="image/*" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Add Crop</button>
            </div>
        </form>
    </div>

    <?php
    // Check if the form is submitted
    if(isset($_POST["submit"])) {
        // Establish database connection
        $conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());

        // Retrieve form data and sanitize
        $cropid = mysqli_real_escape_string($conn, $_POST['crop_id']);
        $cropname = mysqli_real_escape_string($conn, $_POST['crop_name']);
        $cropname_telugu = mysqli_real_escape_string($conn, $_POST['crop_name_telugu']); // Retrieve Telugu crop name
        $cropprice = mysqli_real_escape_string($conn, $_POST['crop_price']);
        $availability = mysqli_real_escape_string($conn, $_POST['availability']);

        // Handle image upload
        $cropimage = $_FILES['crop_image']['name'];
        $target_dir = "C:/xampp/htdocs/farmconnect"; // Specify the target directory with forward slashes
        $target_file = $target_dir . basename($_FILES["crop_image"]["name"]);

        // Check if file is an image
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        // Check file size (assuming max size of 5MB)
        if ($_FILES["crop_image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            exit();
        }

        // Upload the file
        if (move_uploaded_file($_FILES["crop_image"]["tmp_name"], $target_file)) {
            // Insert crop details into the database
            $query = "INSERT INTO addcrops (cropid, cropname, cropnametel, cropprice, avail, image) 
              VALUES ($cropid, '$cropname', '$cropname_telugu', '$cropprice', '$availability', '$cropimage')";
    $result = mysqli_query($conn, $query);


            // Check if insertion was successful
            if ($result) { 
                echo "<p style='color:green;'>Crop added successfully.</p>";
            } else {
                echo "<p style='color:red;'>Failed to add crop. Please try again.</p>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

        // Close database connection
        mysqli_close($conn);
    }
    ?>

</body>
</html>
