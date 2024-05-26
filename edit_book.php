<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Book</h1>

    <?php
    // Database connection
   include ('db_connection.php');

    
    // Define variables and initialize with empty values
    $bookId = $title = $authorId = "";
    $title_err = $author_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate book ID
        if (empty(trim($_POST["book_id"]))) {
            echo "Invalid book ID.";
        } else {
            $bookId = trim($_POST["book_id"]);
        }
        
        // Validate title
        if (empty(trim($_POST["title"]))) {
            $title_err = "Please enter a title.";
        } else {
            $title = trim($_POST["title"]);
        }
        
        // Validate author
        if (empty(trim($_POST["author_id"]))) {
            $author_err = "Please select an author.";
        } else {
            $authorId = trim($_POST["author_id"]);
        }
        
        // Check input errors before updating the database
        if (empty($title_err) && empty($author_err)) {
            // Prepare an update statement
            $sql = "UPDATE books SET title=?, author_id=? WHERE id=?";
            
            if ($stmt = $mysqli->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("sii", $param_title, $param_authorId, $param_bookId);
                
                // Set parameters
                $param_title = $title;
                $param_authorId = $authorId;
                $param_bookId = $bookId;
                
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    echo "Book updated successfully.";
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }
    }

    // Fetch book details from database
    if(isset($_GET['book_id'])) {
        $bookId = $_GET['book_id'];

        $sql = "SELECT books.id, books.title, authors.id AS author_id, authors.name AS author_name FROM books 
                INNER JOIN authors ON books.author_id = authors.id WHERE books.id = $bookId";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Output edit form with pre-filled book details
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $authorId = $row['author_id'];
        } else {
            echo "No book found with ID: $bookId";
        }
    }

    // Close connection
    $mysqli->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
        <div <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>"><br>
            <span class="error"><?php echo $title_err; ?></span>
        </div>
        <div <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
            <label for="author">Author:</label><br>
            <select id="author" name="author_id">
                <option value="">Please select</option>
                <?php
                // Fetch authors from database
               include ('db_connection.php');
                $sql = "SELECT id, name FROM authors";
                $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $selected = ($row['id'] == $authorId) ? "selected" : "";
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                    }
                }
                ?>
            </select><br>
            <span class="error"><?php echo $author_err; ?></span>
        </div>
        <br>
        <input type="submit" value="Update Book">
    </form>

    <a href="index.php">Back to Home</a>
</body>
</html>
