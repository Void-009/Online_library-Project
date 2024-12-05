<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $publisher_id = $_POST['publisher_id'];
    $publisher_name = $_POST['publisher_name'];
    $publisher_description = $_POST['publisher_description'];

    // Handle image upload if a new image is provided
    if ($_FILES['publisher_image']['name'] !== "") {
        $upload_dir = 'upload/';
        $publisher_image_name = $_FILES['publisher_image']['name'];
        $publisher_image_path = $upload_dir . $publisher_image_name;

        if (move_uploaded_file($_FILES['publisher_image']['tmp_name'], $publisher_image_path)) {
            // Image uploaded successfully
            $sql = "UPDATE publisher SET PUBLISHER = ?, PUBLISHER_DESCRIPTION = ?, PUBLISHER_IMAGE = ? WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $publisher_name, $publisher_description, $publisher_image_path, $publisher_id);
        } else {
            echo "Error uploading publisher image.";
            exit;
        }
    } else {
        // If no new image is provided, update other details
        $sql = "UPDATE publisher SET PUBLISHER = ?, PUBLISHER_DESCRIPTION = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $publisher_name, $publisher_description, $publisher_id);
    }

    if ($stmt->execute()) {
        header("Location: all_publishers.php");
        exit;
    } else {
        echo "Error updating publisher: " . $stmt->error;
    }
} elseif (isset($_GET['id'])) {
    $publisher_id = $_GET['id'];

    // Retrieve publisher details
    $sql = "SELECT * FROM publisher WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $publisher_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Publisher not found.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Publisher</title>
</head>
<body>
    <h2>Edit Publisher</h2>
    <form method="post" action="edit_publisher.php" enctype="multipart/form-data">
        <input type="hidden" name="publisher_id" value="<?php echo $publisher_id; ?>">
        <label for="publisher_name">Publisher Name:</label>
        <input type="text" name="publisher_name" value="<?php echo $row['PUBLISHER']; ?>" required><br>

        <label for="publisher_image">Upload New Publisher Image:</label>
        <input type="file" name="publisher_image" accept="image/*"><br>
        <img src="<?php echo $row['PUBLISHER_IMAGE']; ?>" alt="Current Publisher Image" height="100"><br>

        <label for="publisher_description">Publisher Description:</label><br>
        <textarea name="publisher_description" rows="4" cols="50"><?php echo $row['PUBLISHER_DESCRIPTION']; ?></textarea><br>

        <input type="submit" value="Update Publisher">
    </form>
</body>
</html>
