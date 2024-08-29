<?php
// index.php - Main file with PHP logic

// Capture client's IP
$clientIP = $_SERVER['REMOTE_ADDR'];

// Perform simple Geo Location lookup using freegeoip.app
$geoLocationData = json_decode(file_get_contents("https://freegeoip.app/json/{$clientIP}"), true);
$coordinates = [$geoLocationData['latitude'], $geoLocationData['longitude']];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventPlanner</title>
    <link rel="stylesheet" type="text/css" href="event-planning-style.css"> 
</head>
<body>
    <header>
        <!-- Header content -->
    </header>

    <nav>
        <!-- Navigation content -->
    </nav>

    <div class="container">
        <main>
            <section class="feature">
                <!-- Main content -->
            </section>
        </main>
    </div>

    <footer>
        <!-- Footer content -->
    </footer>

    <!-- Embed map.php -->
    <?php include('map.php'); ?>
</body>
</html>
