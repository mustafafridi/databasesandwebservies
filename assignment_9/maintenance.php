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
    <title>Maintenance - EventPlanner</title>
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
                <li class="active"><a href="maintenance.php">Maintenance</a></li>
                <a class="login-button" href="logout.php">Logout</a>
            </ul>
        </div>
    </nav>

    <div class="container">
        <main>
            <section>
                <h2>Maintenance Page</h2>
                <p>Our website is currently undergoing maintenance. Please use the following links to access our other pages:</p>
                <ul>
                    <li><a href="vendor.html">Vendor</a></li>
                    <li><a href="user.html">User</a></li>
                    <li><a href="person.html">Person</a></li>
                    <li><a href="catering.html">Catering</a></li>
                    <li><a href="guest.html">Guest</a></li>
                    <li><a href="host.html">Host</a></li>
                </ul>
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
