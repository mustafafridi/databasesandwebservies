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

// Construct the SQL query to select the full guest list
$sql = "SELECT g.fullName AS GuestFullName, u.first_name AS UserFirstName, u.last_name AS UserLastName
        FROM Guest g
        INNER JOIN User u ON g.user_id = u.user_id";

// Execute the query
$result = $mysqli->query($sql);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Guest List - EventPlanner</title>
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
                <li><a class="login-button" href="#">Login</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <main>
            <section>
                <h2>Full Guest List</h2>
                <p>Full list of guests:</p>
                <?php if ($result->num_rows > 0) : ?>
                    <ul>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <li>
                                <strong>Guest Name:</strong> <?php echo $row['GuestFullName']; ?><br>
                                <strong>User Name:</strong> <?php echo $row['UserFirstName'] . ' ' . $row['UserLastName']; ?>
                            </li>
                            <br>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <p>No results found.</p>
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
