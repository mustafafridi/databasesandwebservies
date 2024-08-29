<?php
$ip = $_SERVER['REMOTE_ADDR'];
$api_key = '59889c2140691f'; // Replace with your actual ipinfo.io API key

// Perform a geo-location lookup using ipinfo.io
$api_url = "http://ipinfo.io/{$ip}?token={$api_key}";
$response = file_get_contents($api_url);

if ($response === false) {
    die('Error during IPinfo.io request.');
}

$data = json_decode($response);

// Extract the latitude and longitude
$lat = $data->loc ? explode(',', $data->loc)[0] : 0;
$lon = $data->loc ? explode(',', $data->loc)[1] : 0;

// Display the map with Leaflet
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Location Map</title>
    <!-- Include Leaflet from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>

    <div id="map" style="height: 500px;"></div>

    <script>
        var map = L.map('map').setView([<?php echo $lat; ?>, <?php echo $lon; ?>], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([<?php echo $lat; ?>, <?php echo $lon; ?>]).addTo(map)
            .bindPopup('IP Address: <?php echo $ip; ?>')
            .openPopup();
    </script>

</body>
</html>
