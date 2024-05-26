<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Library Management System</h1>
	<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}
?>
     <h2>Welcome to the Library Management System, <?php echo $_SESSION['username']; ?></h2>
	<form method="post" action="logout.php">
        <input type="submit" name="logout" value="Logout">
    </form>
    <h2>Books</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
        <?php

		include ('db_connection.php');
        // Fetch books with author details from database
        $sql = "SELECT books.id, books.title, authors.name AS author_name FROM books 
                INNER JOIN authors ON books.author_id = authors.id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["author_name"] . "</td>";
                echo "<td>";
                echo "<a href='edit_book.php?book_id=" . $row["id"] . "'>Edit</a>";
				 echo "<a href='delete_book.php?book_id=" . $row["id"] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No books found</td></tr>";
        }

        // Close connection
        $mysqli->close();
        ?>
    </table>

    <a href="add_book.php">Add New Book</a>
	<a href="add_author.php">Add New Author</a>
    
    <a href="display_borrowed_books.php">Display Borrowed Books</a>
</body>
</html>
