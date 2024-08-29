<?php
session_start();

// Check if the user is not authenticated
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secured Page - EventPlanner</title>
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
                <li><a href="maintenance.php">Maintenance</a></li>
                <!-- Add more navigation items as needed -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <main>
            <section>
                <h2>Secured Page</h2>
                <p>This is the secured content for authorized users.</p>
                <!-- You can include the content from maintenance.html here -->
                <?php include('maintenance.html'); ?>
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
