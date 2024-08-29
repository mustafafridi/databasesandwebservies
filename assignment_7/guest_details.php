<?php
// Define your database connection details
$server = "localhost";
$username = "mowais";
$mysql_password = "cQgD8R";
$database = "Group-18";

// Create a new MySQLi connection
$mysqli = new mysqli($server, $username, $mysql_password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("MySQL Connection failed: " . $mysqli->connect_error);
}

// Connect to the database and retrieve details for the specified guest based on the ID passed in the URL
$userID = isset($_GET['user_id']) ? $_GET['user_id'] : null;

if (!$userID) {
    // Handle the case where no valid user ID is provided in the URL
    echo "Invalid user ID.";
    exit;
}

// Perform a database query to retrieve details for the guest with the specified ID
$sql = "SELECT g.fullName AS GuestFullName, u.first_name AS UserFirstName, u.last_name AS UserLastName
        FROM Guest g
        INNER JOIN User u ON g.user_id = u.user_id
        WHERE u.user_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Handle the case where no matching guest is found
    echo "Guest not found.";
} else {
    // Fetch guest details
    $row = $result->fetch_assoc();
    $guestFullName = $row['GuestFullName'];
    $userFirstName = $row['UserFirstName'];
    $userLastName = $row['UserLastName'];

    // HTML code to display the guest details
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Guest Details - EventPlanner</title>
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
                    <h2>Guest Details</h2>
                    <strong>Guest Name:</strong> <?php echo $guestFullName; ?><br>
                    <strong>User Name:</strong> <?php echo $userFirstName . ' ' . $userLastName; ?><br>
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
    <?php
}

// Close the MySQL connection
$mysqli->close();
?>
