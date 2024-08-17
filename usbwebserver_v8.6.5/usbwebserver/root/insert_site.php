<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Site Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], textarea, input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            color: #d9534f;
            margin-top: 20px;
        }
        .return-home {
            text-align: center;
            margin-top: 20px;
        }
        .return-home a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 4px;
            background-color: #fff;
        }
        .return-home a:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Insert Site Data</h1>
        <form action="insert_site.php" method="post" enctype="multipart/form-data">
            <label for="site_title">Site Title:</label>
            <input type="text" id="site_title" name="site_title" required>
            
            <label for="site_link">Site Link:</label>
            <input type="text" id="site_link" name="site_link" required>
            
            <label for="site_keywords">Site Keywords:</label>
            <input type="text" id="site_keywords" name="site_keywords" required>
            
            <label for="site_desc">Site Description:</label>
            <textarea id="site_desc" name="site_desc" required></textarea>
            
            <label for="site_image">Site Image:</label>
            <input type="file" id="site_image" name="site_image" accept="image/*" required>
            
            <input type="submit" value="Insert Data">
        </form>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection
            $host = 'localhost';  // Your database host
            $user = 'root';       // Your database username
            $pass = '';           // Your database password
            $db = 'search';       // Your database name
            
            // Create connection
            $con = mysqli_connect($host, $user, $pass, $db);
            
            // Check connection
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve and sanitize form input
            $site_title = mysqli_real_escape_string($con, $_POST['site_title']);
            $site_link = mysqli_real_escape_string($con, $_POST['site_link']);
            $site_keywords = mysqli_real_escape_string($con, $_POST['site_keywords']);
            $site_desc = mysqli_real_escape_string($con, $_POST['site_desc']);

            // Handle image upload
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["site_image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is an actual image
            $check = getimagesize($_FILES["site_image"]["tmp_name"]);
            if ($check === false) {
                echo "<div class='message'>File is not an image.</div>";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["site_image"]["size"] > 500000) {
                echo "<div class='message'>Sorry, your file is too large.</div>";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                echo "<div class='message'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "<div class='message'>Sorry, your file was not uploaded.</div>";
            } else {
                if (move_uploaded_file($_FILES["site_image"]["tmp_name"], $target_file)) {
                    echo "<div class='message'>The file " . htmlspecialchars(basename($_FILES["site_image"]["name"])) . " has been uploaded.</div>";
                    $site_image = basename($_FILES["site_image"]["name"]);

                    // Insert data into the database
                    $sql = "INSERT INTO sites (site_title, site_link, site_keywords, site_desc, site_image)
                            VALUES ('$site_title', '$site_link', '$site_keywords', '$site_desc', '$site_image')";

                    if (mysqli_query($con, $sql)) {
                        echo "<div class='message'>Data inserted successfully</div>";
                    } else {
                        echo "<div class='message'>Error: " . mysqli_error($con) . "</div>";
                    }
                } else {
                    echo "<div class='message'>Sorry, there was an error uploading your file.</div>";
                }
            }

            mysqli_close($con);
        }
        ?>
        
        <div class="return-home">
    <a href="search.html" class="btn btn-outline-light me-3 mb-3">
        <i class="fas fa-home me-2"></i> Return to Search Page
    </a>
</div>
>
    </div>
</body>
</html>
