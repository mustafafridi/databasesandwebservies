<?php
// map.php - Display map using PHP

// Use the coordinates and IP provided by index.php
$coordinates = json_encode($coordinates);
$clientIP = json_encode($clientIP);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EventPlanner Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Use the coordinates and IP provided by index.php
        const clientCoordinates = <?php echo $coordinates; ?>;
        const clientIP = <?php echo $clientIP; ?>;

        const map = L.map('map').setView(clientCoordinates, 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker with a callout
        const marker = L.marker(clientCoordinates).addTo(map);
        marker.bindPopup("Client IP: " + clientIP).openPopup();
    </script>
</body>
</html>
