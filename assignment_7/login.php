<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the entered credentials
    if (authenticateUser($username, $password)) {
        // Authentication successful
        $_SESSION['username'] = $username;
        // Redirect to the maintenance page
        header('Location: maintenance.php');
        exit();
    } else {
        // Authentication failed
        $error_message = 'Invalid username or password.';
    }
}

function authenticateUser($username, $password) {
    // Replace these values with your database connection details
    $server = "localhost";
    $username_db = "mowais";
    $password_db = "cQgD8R";
    $database = "Group-18";

    // Create a connection to the database
    $mysqli = new mysqli($server, $username_db, $password_db, $database);

    // Check for a successful connection
    if ($mysqli->connect_error) {
        die("MySQL Connection failed: " . $mysqli->connect_error);
    }

    // Fetch user data from the database based on the entered username
    $query = "SELECT * FROM User WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // User found, check the password
        $row = $result->fetch_assoc();
        $hashed_password_db = $row['password'];

        // Verify the entered password against the stored hash
        if (password_verify($password, $hashed_password_db)) {
            // Password is correct
            $mysqli->close();
            return true;
        }
    }

    // Close the database connection
    $mysqli->close();
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EventPlanner</title>
    <link rel="stylesheet" type="text/css" href="event-planning-style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1 id="logo">EventPlanner</h1>
        </div>
    </header>

    <nav>
        <div class="container">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="events.html">Events</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <main>
            <section>
                <h2>Login</h2>
                <?php if (isset($error_message)) : ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <form method="post" action="login.php">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <br>
                    <input type="submit" value="Login">
                </form>
            </section>
        </main>
    </div>

    <footer>
        <div class="container">
            &copy; 2023 EventPlanner | <a href="imprint.html">Imprint</a>
        </div>
    </footer>
</body>
</html>
