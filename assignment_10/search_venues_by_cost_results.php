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

// Retrieve cost range from the form
$minCost = isset($_GET['min_cost']) ? floatval($_GET['min_cost']) : 0.00;
$maxCost = isset($_GET['max_cost']) ? floatval($_GET['max_cost']) : 1000.00;

// Construct the SQL query to select venues within the specified cost range
$sql = "SELECT venueName, cost FROM Venue WHERE cost >= ? AND cost <= ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("dd", $minCost, $maxCost);

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
    <title>Venues by Cost - EventPlanner</title>
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
                <h2>Venues by Cost</h2>
                <p>Venues within the specified cost range:</p>

                <?php if ($result->num_rows > 0) : ?>
                    <ul>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <li>
                                <strong>Venue Name:</strong> <a href="venue_details.php?venueName=<?php echo $row['venueName']; ?>"><?php echo $row['venueName']; ?></a><br>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <p>No venues found within the specified cost range.</p>
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
