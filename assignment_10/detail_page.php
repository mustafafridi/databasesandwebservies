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

// Connect to the database and retrieve details for the specified vendor based on the ID passed in the URL
$vendorId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$vendorId) {
    // Handle the case where no valid vendor ID is provided in the URL
    echo "Invalid vendor ID.";
    exit;
}

// Perform a database query to retrieve details for the vendor with the specified ID
$sql = "SELECT * FROM Vendor WHERE vendor_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $vendorId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Handle the case where no matching vendor is found
    echo "Vendor not found.";
} else {
    // Fetch vendor details
    $row = $result->fetch_assoc();
    $vendorName = $row['vendorName'];
    $email = $row['email'];
    $phone = $row['phone'];
    $website = $row['website'];
    $address = $row['address'];
    $zipCode = $row['zipCode'];
    $cost = $row['cost'];
    $vendorType = $row['vendorType'];
    $city = $row['city'];

    // HTML code to display the vendor details
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vendor Details - EventPlanner</title>
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
                    <h2>Vendor Details</h2>
                    <strong>Vendor Name:</strong> <?php echo $vendorName; ?><br>
                    <strong>Email:</strong> <?php echo $email; ?><br>
                    <strong>Phone:</strong> <?php echo $phone; ?><br>
                    <strong>Website:</strong> <?php echo $website; ?><br>
                    <strong>Address:</strong> <?php echo $address; ?><br>
                    <strong>Zip Code:</strong> <?php echo $zipCode; ?><br>
                    <strong>Cost:</strong> <?php echo $cost; ?><br>
                    <strong>Vendor Type:</strong> <?php echo $vendorType; ?><br>
                    <strong>City:</strong> <?php echo $city; ?><br>
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
