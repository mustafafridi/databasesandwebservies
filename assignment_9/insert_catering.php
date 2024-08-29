<?php
$server = "localhost";
$username = "mowais";
$mysql_password = "cQgD8R";
$database = "Group-18";

$mysqli = new mysqli($server, $username, $mysql_password, $database);

if ($mysqli->connect_error) {
    die("MySQL Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve catering information from the form
    $vendor_id = isset($_POST["vendor_id"]) ? $_POST["vendor_id"] : null;
    $cateringDetails = isset($_POST["cateringDetails"]) ? $_POST["cateringDetails"] : null;

    // Check if vendor_id is not empty
    if (!empty($vendor_id)) {
        // Construct the SQL query to insert catering information
        $cateringQuery = "INSERT INTO Catering (vendor_id, cateringDetails) VALUES (?, ?)";

        $cateringStmt = $mysqli->prepare($cateringQuery);

        if ($cateringStmt === false) {
            echo "Catering Preparation Error: " . $mysqli->error;
        } else {
            $cateringStmt->bind_param("is", $vendor_id, $cateringDetails);

            if ($cateringStmt->execute()) {
                echo "Successful Insertion!";
            } else {
                echo "Catering Insertion Error: " . $cateringStmt->error;
            }

            $cateringStmt->close();
        }
    } else {
        echo "Catering Insertion Error: 'vendor_id' cannot be empty.";
    }
}

$mysqli->close();
?>
