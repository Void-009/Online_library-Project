<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $isbn = $_POST['isbn'];
    $book_description = $_POST['book_description'];
    $publisher_id = $_POST['publisher_id'];

if (isset($_FILES['new_ebook']) && $_FILES['new_ebook']['error'] === UPLOAD_ERR_OK) {
    // Handle eBook update
    $new_ebook_name = $_FILES['new_ebook']['name'];
    $new_ebook_path = $upload_ebook_dir . $new_ebook_name;

    if (move_uploaded_file($_FILES['new_ebook']['tmp_name'], $new_ebook_path)) {
        // eBook uploaded successfully, update the eBook path in the database
        $sql = "UPDATE book SET BOOK_NAME = ?, ISBN = ?, BOOK_DESCRIPTION = ?, PUBLISHER_ID = ?, BOOK_IMAGE = ?, BOOK_EBOOK = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssissi", $book_name, $isbn, $book_description, $publisher_id, $new_image_path, $new_ebook_path, $book_id);
    } else {
        echo "Error uploading eBook.";
        exit;
    }
} else {
    // No new eBook uploaded, update the book record without changing the eBook path
    $sql = "UPDATE book SET BOOK_NAME = ?, ISBN = ?, BOOK_DESCRIPTION = ?, PUBLISHER_ID = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $book_name, $isbn, $book_description, $publisher_id, $book_id);
}

// The rest of your code for updating the book record remains the same


   // Update the book record with optional image update
if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
    // Handle image update
    $new_image_name = $_FILES['new_image']['name'];
    $new_image_path = $upload_dir . $new_image_name;

    if (move_uploaded_file($_FILES['new_image']['tmp_name'], $new_image_path)) {
        // Image uploaded successfully, update the image path in the database
        $sql = "UPDATE book SET BOOK_NAME = ?, ISBN = ?, BOOK_DESCRIPTION = ?, PUBLISHER_ID = ?, BOOK_IMAGE = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisi", $book_name, $isbn, $book_description, $publisher_id, $new_image_path, $book_id);
    } else {
        echo "Error uploading image.";
        exit;
    }
} else {
    // No new image uploaded, update the book record without changing the image path
    $sql = "UPDATE book SET BOOK_NAME = ?, ISBN = ?, BOOK_DESCRIPTION = ?, PUBLISHER_ID = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $book_name, $isbn, $book_description, $publisher_id, $book_id);
}

if ($stmt->execute()) {
    // Book updated successfully
    header("Location: all_books.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}



} else {
    if (isset($_GET['id'])) {
        $book_id = $_GET['id'];
        $sql = "SELECT * FROM book WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $book_name = $row['BOOK_NAME'];
            $isbn = $row['ISBN'];
            $book_description = $row['BOOK_DESCRIPTION'];
            $publisher_id = $row['PUBLISHER_ID'];
            $current_image = $row['BOOK_IMAGE']; // Get the current image URL
        } else {
            echo "Book not found.";
            exit;
        }
    } else {
        // Handle invalid requests (e.g., direct access to the script)
        header("Location: all_books.php");
        exit;
    }
}

// Fetch publishers from the database for the dropdown
$sql = "SELECT ID, PUBLISHER FROM publisher";
$result = $conn->query($sql);
$publishers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $publishers[] = [
            'id' => $row['ID'],
            'name' => $row['PUBLISHER']
        ];
    }
}



?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <h2>Edit Book</h2>
    <form method="post" action="book_edit.php" enctype="multipart/form-data">
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">

        <label for="book_name">Book Title:</label>
        <input type="text" name="book_name" value="<?php echo $book_name; ?>" required><br>

        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" value="<?php echo $isbn; ?>"><br>

        <label for="book_description">Book Description:</label><br>
        <textarea name="book_description" rows="4" cols="50"><?php echo $book_description; ?></textarea><br>

        <label for="publisher_id">Publisher:</label>
        <select name="publisher_id" required>
            <?php foreach ($publishers as $publisher) { ?>
                <option value="<?php echo $publisher['id']; ?>" <?php echo ($publisher['id'] == $publisher_id) ? 'selected' : ''; ?>>
                    <?php echo $publisher['name']; ?>
                </option>
            <?php } ?>
        </select><br>

        <label for="new_ebook">New eBook (PDF, TXT, DOC, etc.)</label>
        <input type="file" name="new_ebook" accept=".pdf, .txt, .doc, .docx"><br>

        <label for="current_ebook">Current eBook:</label>
        <a href="<?php echo $current_ebook; ?>" target="_blank">View eBook</a>
        <br>


        <label for="current_image">Current Image:</label>
        <img src="<?php echo $current_image; ?>" alt="Current Book Image" height="100">
        <br>

        <label for="new_image">New Image (optional):</label>
        <input type="file" name="new_image" accept="image/*"><br>

        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
