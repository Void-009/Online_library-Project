<?php
require_once('config.php');

if (isset($_GET['id'])) {
    $publisher_id = $_GET['id'];

    // Delete publisher by ID
    $sql = "DELETE FROM publisher WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $publisher_id);

    if ($stmt->execute()) {
        header("Location: all_publishers.php");
        exit;
    } else {
        echo "Error deleting publisher: " . $stmt->error;
    }
}
?>
