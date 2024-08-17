<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Page</title>
    <style type="text/css">
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
    <form action="result.php" method="get">
        <span><b>Write your Keyword:</b></span>
        <input type="text" name="user_query" size="60" />
        <input type="submit" name="search" value="Search Now">
    </form>
</div>

<div class="go-back">
    <a href="search.html"><button>Go Back</button></a>
</div>

<?php
if (isset($_GET['search'])) {
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

    $get_value = mysqli_real_escape_string($con, $_GET['user_query']);

    if ($get_value == '') {
        echo "<div class='no-results'><b>Please go back and write something in the search box!</b></div>";
    } else {
        $result_query = "SELECT * FROM sites WHERE site_keywords LIKE '%$get_value%'";
        $run_result = mysqli_query($con, $result_query);

        if (mysqli_num_rows($run_result) < 1) {
            echo "<div class='no-results'><b>Oops! Sorry, nothing was found in the database!</b></div>";
        } else {
            while ($row_result = mysqli_fetch_assoc($run_result)) {
                $site_title = htmlspecialchars($row_result['site_title']);
                $site_link = htmlspecialchars($row_result['site_link']);
                $site_desc = htmlspecialchars($row_result['site_desc']);
                $site_image = htmlspecialchars($row_result['site_image']);

                echo "<div class='results'>
                    <h2>$site_title</h2>
                    <a href='$site_link' target='_blank'>$site_link</a>
                    <p>$site_desc</p>
                    <img src='images/$site_image' width='100' height='100' alt='$site_title' />
                </div>";
            }
        }
    }

    mysqli_close($con);
}
?>

</body>
</html>
