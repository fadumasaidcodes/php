<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            background-color: #F5DEB3;
            font-family: Arial, sans-serif;
        }
        .results {
            margin-left: 12%;
            margin-right: 12%;
            margin-top: 10px;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .results h2 {
            margin: 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
            color: #333;
        }
        .results a {
            color: #0066cc;
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }
        .results p {
            text-align: justify;
            font-size: 14px;
            color: #555;
        }
        .results img {
            margin-top: 10px;
            border-radius: 5px;
        }
        .no-results, .search-form {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #d9534f;
        }
        .search-form input[type="text"] {
            padding: 10px;
            width: 50%;
            margin-right: 5px;
        }
        .search-form input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .go-back {
            display: block;
            text-align: center;
            margin: 20px 0;
        }
        .go-back button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .go-back button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="search-form">
    <form action="result.php" method="post">
        <span><b>Write your Keyword:</b></span>
        <input type="text" name="user_query" size="60" required />
        <input type="submit" name="search" value="Search Now">
    </form>
</div>

<div class="go-back">
    <a href="search.html"><button>Go Back</button></a>
</div>

<?php
// Database connection details
$host = 'localhost';
$user = 'root';
$pass = 'usbw';
$db = 'search';

// Create connection
$con = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$con) {
    die("<div class='message'>Connection failed: " . mysqli_connect_error() . "</div>");
}

// Handle form submission
if (isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($con, $_POST['user_query']);

    if ($search_query == '') {
        echo "<div class='message'>Please enter a search term.</div>";
    } else {
        // Check if the record already exists
        $check_query = "SELECT * FROM sites WHERE site_title LIKE '%$search_query%' OR site_keywords LIKE '%$search_query%'";
        $check_result = mysqli_query($con, $check_query);

        if (!$check_result) {
            echo "<div class='message'>Error executing query: " . mysqli_error($con) . "</div>";
        } elseif (mysqli_num_rows($check_result) > 0) {
            echo "<div class='message'>Record(s) found:</div>";
            while ($row = mysqli_fetch_assoc($check_result)) {
                echo "<div class='results'>";
                echo "<h2><a href='" . $row['site_link'] . "'>" . htmlspecialchars($row['site_title']) . "</a></h2>";
                echo "<p>" . htmlspecialchars($row['site_desc']) . "</p>";
                if (!empty($row['site_image'])) {
                    echo "<img src='images/" . htmlspecialchars($row['site_image']) . "' alt='" . htmlspecialchars($row['site_title']) . "' />";
                }
                echo "</div>";
            }
        } else {
            echo "<div class='message'>No records found.</div>";
        }
    }
}

// Close the database connection
mysqli_close($con);
?>

</body>
</html>
