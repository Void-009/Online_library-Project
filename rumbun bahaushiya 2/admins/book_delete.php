
<?php
require_once('config.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $book_id = $_GET['id'];

    // Check if the book exists
    $check_sql = "SELECT ID FROM book WHERE ID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $book_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Delete the book
        $delete_sql = "DELETE FROM book WHERE ID = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $book_id);

        if ($delete_stmt->execute()) {
            // Book deleted successfully
            header("Location: all_books.php");
            exit;

    echo "Book deleted successfully. <a href='all_books.php'>Back to All Books</a>";

        } else {
            echo "Error deleting book: " . $delete_stmt->error;
        }
    } else {
        echo "Book not found.";
    }
} else {
    echo "Invalid book ID.";
}
?>
