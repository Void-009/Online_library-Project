<?php
require_once('config.php');

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $publisher_name = $_POST['publisher_name'];
    $publisher_description = $_POST['publisher_description'];

    // Handle image upload
    $upload_dir = 'upload/';
    $publisher_image_name = $_FILES['publisher_image']['name'];
    $publisher_image_path = $upload_dir . $publisher_image_name;

    if (move_uploaded_file($_FILES['publisher_image']['tmp_name'], $publisher_image_path)) {
        // Image uploaded successfully
        $sql = "INSERT INTO publisher (PUBLISHER, PUBLISHER_DESCRIPTION, PUBLISHER_IMAGE) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $publisher_name, $publisher_description, $publisher_image_path);

        if ($stmt->execute()) {
            $message = "Publisher created successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
    } else {
        $message = "Error uploading publisher image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Publisher</title>
</head>
<body>
    <h2>Add New Publisher</h2>
    <?php
    if ($message !== "") {
        echo "<p>" . $message . "</p>";
    }
    ?>
    <form method="post" action="publisher.php" enctype="multipart/form-data">
        <label for="publisher_name">Publisher Name:</label>
        <input type="text" name="publisher_name" required><br>

        <label for="publisher_image">Upload Publisher Image:</label>
        <input type="file" name="publisher_image" accept="image/*" required><br>

        <label for="publisher_description">Publisher Description:</label><br>
        <textarea name="publisher_description" rows="4" cols="50"></textarea><br>

        <input type="submit" value="Add Publisher">
    </form>
</body>
</html>
