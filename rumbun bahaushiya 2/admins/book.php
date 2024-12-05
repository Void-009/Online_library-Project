<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
      <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

</body>
</html>

<?php
require_once('config.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_name = $_POST['book_name'];
    $isbn = $_POST['isbn'];
    $book_description = $_POST['book_description'];
    $publisher_id = $_POST['publisher_id'];

 

    // Handle image upload
    $upload_dir = 'upload/';
    $book_image_name = $_FILES['book_image']['name'];
    $book_image_path = $upload_dir . $book_image_name;

    if (move_uploaded_file($_FILES['book_image']['tmp_name'], $book_image_path)) {
        // Image uploaded successfully

        // Handle eBook upload
$upload_ebook_dir = 'ebook/';
$book_ebook_name = $_FILES['book_ebook']['name'];
$book_ebook_path = $upload_ebook_dir . $book_ebook_name;

if (move_uploaded_file($_FILES['book_ebook']['tmp_name'], $book_ebook_path)) {
    // eBook uploaded successfully
    $sql = "INSERT INTO book (BOOK_NAME, BOOK_IMAGE, BOOK_EBOOK, PUBLISHER_ID, ISBN, BOOK_DESCRIPTION) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiis", $book_name, $book_image_path, $book_ebook_path, $publisher_id, $isbn, $book_description);

    if ($stmt->execute()) {
        // Book added successfully
        header("Location: all_books.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error uploading eBook.";
}


}}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
</head>
<body>
    <h2>Add New Book</h2>
    <form method="post" action="book.php" enctype="multipart/form-data">
       
        <label for="book_name">Book Title:</label>
        <input type="text" name="book_name" required><br>

        <label for="book_image">Upload Book Image:</label>
        <input type="file" name="book_image" accept="image/*" required><br>

        <label for="book_ebook">Upload eBook (PDF, TXT, DOC, etc.):</label>
<input type="file" name="book_ebook" accept=".pdf, .txt, .doc, .docx"><br>



       <label for="publisher_id">Publisher:</label>
        <select name="publisher_id" required>

            <?php
            // Query the database to fetch publishers
            $publisherQuery = "SELECT ID, PUBLISHER FROM publisher";
            $publisherResult = $conn->query($publisherQuery);

            if ($publisherResult->num_rows > 0) {
                while ($publisherRow = $publisherResult->fetch_assoc()) {
                    // Create an option for each publisher
                    echo "<option value='" . $publisherRow['ID'] . "'>" . $publisherRow['PUBLISHER'] . "</option>";
                }
            }
            ?>
        </select><br>


        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn"><br>

        <label for="book_description">Book Description:</label><br>
        <textarea name="book_description" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Add Book">
    </form>
</body>
</html>
