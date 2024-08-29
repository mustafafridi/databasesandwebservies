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
    $username = isset($_POST["username"]) ? $_POST["username"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;

    // Check if required fields are not empty
    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($zipCode) && !empty($username) && !empty($password)) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Construct the SQL query to insert user information
        $userQuery = "INSERT INTO User (first_name, last_name, email, zipCode, username, password) VALUES (?, ?, ?, ?, ?, ?)";

        $userStmt = $mysqli->prepare($userQuery);

        if ($userStmt === false) {
            echo "User Preparation Error: " . $mysqli->error;
        } else {
            $userStmt->bind_param("ssssss", $first_name, $last_name, $email, $zipCode, $username, $hashedPassword);

            if ($userStmt->execute()) {
                echo "Successful Insertion!";
            } else {
                echo "User Insertion Error: " . $userStmt->error;
            }

            $userStmt->close();
        }
    } else {
        echo "User Insertion Error: Required fields cannot be empty.";
    }
}

$mysqli->close();
?>
