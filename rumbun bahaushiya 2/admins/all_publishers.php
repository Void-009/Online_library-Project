<?php
require_once('config.php');

$sql = "SELECT * FROM publisher";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Publishers</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>


        /* Background styles */
        body {
            background-color: #f2f2f2; /* Background color */
            background-image: url('your-background-image.jpg'); /* Background image (optional) */
            background-repeat: no-repeat;
            background-size: cover; /* Adjust to fit your image */
        }

        /* Text color styles */
        .container {
            color: #333; /* Text color */
        }

        /* Custom styles for the publisher list */
        .publisher-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .publisher-item {
            width: calc(33.33% - 20px); /* Adjust the width as needed */
            margin: 10px;
            padding: 10px;
            background-color: #fff; /* Background color for publisher items */
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            display: flex;
            flex-direction: column;
        }

        .publisher-item img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .publisher-description {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            max-height: 100px; /* Adjust the max height as needed */
            overflow-y: auto;
            text-align: left;
        }

        .publisher-links {
            margin-top: 10px;
        }

        .publisher-links a {
            text-decoration: none;
            color: #007bff;
            margin: 0 5px;
        }

        .vertical-line {
            border-left: 1px solid #ccc;
            height: 100%;
            margin: 0 10px;
        }
   
     

 

       

      

    </style>
</head>
<body>
    <div class="container">
        <h2>All Publishers</h2>
        <div class="publisher-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='publisher-item'>";
                    echo "<img src='" . $row['PUBLISHER_IMAGE'] . "' alt='Publisher Image' height='100'>";
                    echo "<h3 style='border: 1px solid #ccc; padding: 5px; border-radius: 5px; margin-bottom: 5px;'>" . $row['PUBLISHER'] . "</h3>";
                    echo "<div class='publisher-description'>" . $row['PUBLISHER_DESCRIPTION'] . "</div>";
                    echo "<div class='publisher-links'>";
                    echo "<a href='edit_publisher.php?id=" . $row['ID'] . "'>Edit</a>";
                    echo "<span class='vertical-line'></span>"; // Vertical line separator
                    echo "<a href='delete_publisher.php?id=" . $row['ID'] . "'>Delete</a>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No publishers found.";
            }
            ?>
        </div>
    </div>
</body>
</html>
