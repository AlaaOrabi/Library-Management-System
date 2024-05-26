<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="index.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>

    <?php
    // Check if login form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check username and password
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Your authentication logic here (e.g., database query)
        if ($username === "admin" && $password === "123") {
            // Successful login
            session_start();
            $_SESSION["username"] = $username;
            header("Location:home_page.php");
            exit;
        } else {
            // Invalid login
            echo "<p>Invalid username or password.</p>";
        }
    }
    ?>
</body>
</html>
