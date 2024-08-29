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

// Retrieve search criteria from the form in search_vendor.html
$cityFilter = isset($_GET['city']) ? $_GET['city'] : '';
$vendorFilter = isset($_GET['vendor']) ? $_GET['vendor'] : '';
$searchInput = isset($_GET['q']) ? '%' . $_GET['q'] . '%' : ''; // Modified to include wildcards

// Construct the SQL query to select the desired fields
$sql = "SELECT vendor_id, vendorName, email, phone, website, address, zipCode, cost, vendorType, city 
        FROM Vendor 
        WHERE city = ? AND vendorType = ? AND vendorName LIKE ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sss", $cityFilter, $vendorFilter, $searchInput); // Modified to include search input

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
    <title>Search Results - EventPlanner</title>
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
            <h2>Search Results</h2>
            <p>Results for your vendor search query:</p>
            <?php if ($result->num_rows > 0) : ?>
                <ul>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <li>
                            <a href="detail_page.php?id=<?php echo $row['vendor_id']; ?>">
                                <strong>Vendor Name:</strong> <?php echo $row['vendorName']; ?>
                            </a>
                        </li>
                        <br>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p>No vendor results found.</p>
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
