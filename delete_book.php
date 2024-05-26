
<?php
// Check if book ID is provided
if(isset($_GET['book_id'])) {
    // Connect to MySQL
   include ('db_connection.php');

    // Prepare a delete statement
    $sql = "DELETE FROM books WHERE id = ?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $bookId);

        // Set parameters
        $bookId = $_GET['book_id'];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "Book deleted successfully.<br>";
        } else {
            echo "Error deleting book.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
} else {
    echo "Book ID not provided";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>

  <a href="home_page.php">Back to Home</a>
</body>
</html>