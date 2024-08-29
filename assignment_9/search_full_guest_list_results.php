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

$userID = isset($_GET['user_id']) ? $_GET['user_id'] : '';

// Construct the SQL query to select the full guest list with filtering by user ID
$sql = "SELECT g.user_id, g.fullName AS GuestFullName, u.first_name AS UserFirstName, u.last_name AS UserLastName
        FROM Guest g
        INNER JOIN User u ON g.user_id = u.user_id
        WHERE u.user_id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $userID);

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
        <div class="container"> <!-- Fixed a typo here -->
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
                <form action="search_full_guest_list_results.php" method="GET">
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id" class="search-bar">
                    <button type="submit" class="search-button">Search</button>
                </form>
                <?php if ($result->num_rows > 0) : ?>
                    <ul>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <li>
                                <a href="guest_details.php?user_id=<?php echo $row['user_id']; ?>">
                                    <strong>Guest Name:</strong> <?php echo $row['GuestFullName']; ?>
                                </a><br>
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
