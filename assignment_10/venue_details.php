<?php
$server = "localhost";
$username = "mowais";
$mysql_password = "cQgD8R";
$database = "Group-18";

$mysqli = new mysqli($server, $username, $mysql_password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("MySQL Connection failed: " . $mysqli->connect_error);
}

// Retrieve the venueName from the query parameter
$venueName = isset($_GET['venueName']) ? $_GET['venueName'] : '';

// Construct the SQL query to select venue details by venueName
$sql = "SELECT * FROM Venue WHERE venueName = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $venueName);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue Details - EventPlanner</title>
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
                <li><a href="maintenance.html">Maintenance</a></li>
                <li><a class="login-button" href="#">Login</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <main>
            <section>
                <h2>Venue Details</h2>
                <?php if ($result->num_rows > 0) : ?>
                    <?php $row = $result->fetch_assoc(); ?>
                    <ul>
                        <li>
                            <strong>Venue Name:</strong> <?php echo $row['venueName']; ?><br>
                            <strong>Description:</strong> <?php echo $row['description']; ?><br>
                            <strong>Phone:</strong> <?php echo $row['phone']; ?><br>
                            <strong>Email:</strong> <?php echo $row['email']; ?><br>
                            <strong>Website:</strong> <?php echo $row['website']; ?><br>
                            <strong>Address:</strong> <?php echo $row['address']; ?><br>
                            <strong>Zip Code:</strong> <?php echo $row['zipCode']; ?><br>
                            <strong>City:</strong> <?php echo $row['city']; ?><br>
                            <strong>Cost:</strong> <?php echo $row['cost']; ?><br>
                        </li>
                    </ul>
                <?php else : ?>
                    <p>Venue not found.</p>
                <?php endif; ?>
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
