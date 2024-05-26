<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Borrowed Books</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Borrowed Books</h1>

    <table>
        <tr>
            <th>Book Title</th>
            <th>Borrower Name</th>
            <th>Borrowed Date</th>
            <th>Return Date</th>
        </tr>
        <?php
        // Connect to MySQL
        $mysqli = new mysqli("localhost", "root", "", "library");

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Fetch borrowed books from database
        $sql = "SELECT books.title AS book_title, borrowing.borrower_name, borrowing.borrowed_date, borrowing.return_date 
                FROM borrowing 
                INNER JOIN books ON borrowing.book_id = books.id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["book_title"] . "</td>";
                echo "<td>" . $row["borrower_name"] . "</td>";
                echo "<td>" . $row["borrowed_date"] . "</td>";
                echo "<td>" . $row["return_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No borrowed books found</td></tr>";
        }

        // Close connection
        $mysqli->close();
        ?>
    </table>

    <a href="home_page.php">Back to Home</a>
</body>
</html>
