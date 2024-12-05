<?php
require_once('config.php');

if (isset($_GET['ebook_id'])) {
    $ebook_id = $_GET['ebook_id'];

    

    // Fetch the eBook path from the database
    $sql = "SELECT BOOK_EBOOK FROM book WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ebook_id);
    $stmt->execute();
    $stmt->bind_result($ebook_path);

    if ($stmt->fetch()) {
        // Get the file name from the eBook path
        $ebook_filename = basename($ebook_path);

        // Set appropriate content headers for downloading
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $ebook_filename . '"');

        // Output the eBook content for download
        readfile($ebook_path);
        exit;
    } else {
        echo "Ebook not found.";
    }
} else {
    echo "Invalid request.";
}
?>
