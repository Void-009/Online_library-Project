<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
      <link rel="stylesheet" type="text/css" href="styles.css">
           <style>
        /* Page container */
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Add shadow */
        }

        /* Center the h2 element with a rectangular shape and space */
        h2 {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin: 20px auto 10px; /* Add margin to create space */
            width: 50%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Add shadow */
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 8px  #007bff; /* Add a border with blue color */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8); /* Add shadow */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 20px solid #007bff; /* Customize the horizontal line color */
            border-right: 2px solid #007bff; /* Customize the vertical line color */
             border-left: 2px solid #007bff; /* Customize the vertical line color */
        }

        th {
            background-color: #007bff;
            color: white;
        }

        /* Book image styles */
        .book-image {
            max-width: 100px;
            height: auto;
        }

        /* Book description styles */
        .book-description {
            max-height: 100px;
            overflow: hidden;
        }

        /* Links styles */
        .action-links a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        } 


    
    .custom-icon {
        font-size: 24px; /* Adjust the icon size */
        color: #007bff; /* Adjust the icon color */
        margin-right: 5px; /* Add margin to separate icons */
    }


           </style>


           <!-- Include Bootstrap CSS (if using Bootstrap) -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Include Font Awesome CSS (if using Font Awesome) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<body>

</body>
</html>

<?php
require_once('config.php');


           


$sql = "SELECT b.ID, b.BOOK_NAME, b.BOOK_IMAGE, b.BOOK_DESCRIPTION, b.ISBN, b.BOOK_EBOOK, p.PUBLISHER 
        FROM book b
        JOIN publisher p ON b.PUBLISHER_ID = p.ID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>All Books</h2>";
    echo "<table>";
    echo "<tr><th>Title</th><th>Image</th><th>Description</th><th>ISBN</th><th>Publisher</th><th>Ebook</th><th>Edit</th><th>Delete</th></tr>";
   
   while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['BOOK_NAME'] . "</td>";
    echo "<td><img src='" . $row['BOOK_IMAGE'] . "' alt='Book Image' height='100'></td>";
    
    echo "<td>" . $row['BOOK_DESCRIPTION'] . "</td>";
    echo "<td>" . $row['ISBN'] . "</td>";
    echo "<td>" . $row['PUBLISHER'] . "</td>";

 // Display download link for ebook
        //echo "<td><a href='" . $row['EBOOK_FILE'] . "' download>Download Ebook</a></td>";

        
        // View eBook link -->
    echo "<td><a href='view_ebook.php?book=" . urlencode($row['BOOK_EBOOK']) . "' target='_blank'>View eBook</a></td>";



// Download eBook link -->
    echo "<td><a href='download_ebook.php?book=" . urlencode($row['BOOK_EBOOK']) . "' target='_blank'>Download eBook</a></td>";




      // Edit and Delete links with book ID

      // Edit icon with custom style
echo "<td><a href='book_edit.php?id=" . $row['ID'] . "'><i class='fas fa-edit custom-icon'></i></a></td>";

// Delete icon with custom style
echo "<td><a href='book_delete.php?id=" . $row['ID'] . "'><i class='fas fa-trash custom-icon'></i></a></td>";

    echo "</tr>";
}

    echo "</table>";
} else {
    echo "No books found.";
}
?>
