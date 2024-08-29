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
    // Retrieve guest information from the form
    $fullName = isset($_POST["fullName"]) ? $_POST["fullName"] : null;
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
    $guestCategory = isset($_POST["guestCategory"]) ? $_POST["guestCategory"] : null;
    $confirmed = isset($_POST["confirmed"]) ? $_POST["confirmed"] : null;
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

    // Check if required fields are not empty
    if (!empty($fullName) && !empty($phone) && !empty($guestCategory) && !empty($confirmed) && !empty($user_id)) {
        // Check if the user_id exists in the User table
        $userExistsQuery = "SELECT user_id FROM User WHERE user_id = ?";
        $userExistsStmt = $mysqli->prepare($userExistsQuery);
        $userExistsStmt->bind_param("i", $user_id);
        $userExistsStmt->execute();
        $userExistsStmt->store_result();

        if ($userExistsStmt->num_rows > 0) {
            // User exists, proceed with the Guest insertion
            $userExistsStmt->close();

            // Construct the SQL query to insert guest information
            $guestQuery = "INSERT INTO Guest (fullName, phone, guestCategory, confirmed, user_id) VALUES (?, ?, ?, ?, ?)";

            $guestStmt = $mysqli->prepare($guestQuery);

            if ($guestStmt === false) {
                echo "Guest Preparation Error: " . $mysqli->error;
            } else {
                $guestStmt->bind_param("ssssi", $fullName, $phone, $guestCategory, $confirmed, $user_id);

                if ($guestStmt->execute()) {
                    echo "Successful Insertion!";
                } else {
                    echo "Guest Insertion Error: " . $guestStmt->error;
                }

                $guestStmt->close();
            }
        } else {
            echo "Guest Insertion Error: 'user_id' does not exist in the User table.";
        }
    } else {
        echo "Guest Insertion Error: Required fields cannot be empty.";
    }
}

$mysqli->close();
?>
