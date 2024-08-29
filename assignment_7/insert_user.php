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
    // Retrieve user information from the form
    $first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : null;
    $last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $zipCode = isset($_POST["zipCode"]) ? $_POST["zipCode"] : null;

    // Check if required fields are not empty
    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($zipCode)) {
        // Construct the SQL query to insert user information
        $userQuery = "INSERT INTO User (first_name, last_name, email, zipCode) VALUES (?, ?, ?, ?)";

        $userStmt = $mysqli->prepare($userQuery);

        if ($userStmt === false) {
            echo "User Preparation Error: " . $mysqli->error;
        } else {
            $userStmt->bind_param("sssi", $first_name, $last_name, $email, $zipCode);

            if ($userStmt->execute()) {
                echo "Successful Insertion!", $user_id;
            } else {
                echo "User Insertion Error: " . $userStmt->error;
            }

            $userStmt->close();
        }
    } else {
        echo "User Insertion Error: Required fields cannot be empty.", $user_id;
    }
}

$mysqli->close();
?>
