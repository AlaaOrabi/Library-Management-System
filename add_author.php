<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Author</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add Author</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form data when form is submitted
        $author_name = $_POST['name'];
       

        // Validate form inputs (you can add more validation if needed)
        if (empty($author_name) ) {
            echo "<p>Please fill out all fields</p>";
        } else {
            // Connect to MySQL and insert new book
            $mysqli = new mysqli("localhost", "root", "", "library");
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }
            $sql = "INSERT INTO authors (name) VALUES ('$author_name')";
            if ($mysqli->query($sql) === TRUE) {
                echo "<p>Author added successfully</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $mysqli->error . "</p>";
            }
            $mysqli->close();
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Author Name:</label><br>
        <input type="text" id="name" name="name"><br>
      
        <input type="submit" value="Add Author">
    </form>

    <a href="home_page.php">Back to Home</a>
</body>
</html>
