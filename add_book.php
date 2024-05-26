<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add Book</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form data when form is submitted
        $title = $_POST['title'];
        $authorId = $_POST['author_id'];

        // Validate form inputs (you can add more validation if needed)
        if (empty($title) || empty($authorId)) {
            echo "<p>Please fill out all fields</p>";
        } else {
            // Connect to MySQL and insert new book
          include ('db_connection.php');
            $sql = "INSERT INTO books (title, author_id) VALUES ('$title', '$authorId')";
            if ($mysqli->query($sql) === TRUE) {
                echo "<p>Book added successfully</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $mysqli->error . "</p>";
            }
            $mysqli->close();
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="author">Author:</label><br>
        <select id="author" name="author_id">
            <?php
            // Fetch authors from database
           include ('db_connection.php');
            $sql = "SELECT id, name FROM authors";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            }
            $mysqli->close();
            ?>
        </select><br><br>
        <input type="submit" value="Add Book">
    </form>

    <a href="home_page.php">Back to Home</a>
</body>
</html>
