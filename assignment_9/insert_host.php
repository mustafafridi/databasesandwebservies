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
    // Retrieve host information from the form
    $person_id = isset($_POST["person_id"]) ? $_POST["person_id"] : null;
    $hostDetails = isset($_POST["hostDetails"]) ? $_POST["hostDetails"] : null;

    // Check if required fields are not empty
    if (!empty($person_id) && !empty($hostDetails)) {
        // Construct the SQL query to insert host information
        $hostQuery = "INSERT INTO Host (person_id, hostDetails) VALUES (?, ?)";

        $hostStmt = $mysqli->prepare($hostQuery);

        if ($hostStmt === false) {
            echo "Host Preparation Error: " . $mysqli->error;
        } else {
            $hostStmt->bind_param("is", $person_id, $hostDetails);

            if ($hostStmt->execute()) {
                echo "Successful Insertion!";
            } else {
                echo "Host Insertion Error: " . $hostStmt->error;
            }

            $hostStmt->close();
        }
    } else {
        echo "Host Insertion Error: Required fields cannot be empty.";
    }
}

$mysqli->close();
?>
