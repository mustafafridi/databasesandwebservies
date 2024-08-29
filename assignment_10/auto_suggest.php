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

// Retrieve input and selected city from AJAX request
$input = isset($_GET['input']) ? $_GET['input'] : '';
$selectedCity = isset($_GET['city']) ? $_GET['city'] : '';

// Construct the SQL query to fetch auto-suggestions
$sql = "SELECT vendorName FROM Vendor WHERE vendorName LIKE ? AND city = ? LIMIT 5";
$stmt = $mysqli->prepare($sql);

// Add percent signs to the input for a broader search
$inputWithWildcards = '%' . $input . '%';
$stmt->bind_param("ss", $inputWithWildcards, $selectedCity);
$stmt->execute();

$result = $stmt->get_result();

// Build the suggestion list
$suggestions = [];
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row['vendorName'];
}

// Return suggestions as a JSON array
echo json_encode($suggestions);

$mysqli->close();
?>
