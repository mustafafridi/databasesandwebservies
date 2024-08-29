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
    // Retrieve person information from the form
    $user_id = isset($_POST["user_id"]) ? $_POST["user_id"] : null;

    // Check if user_id is not empty
    if (!empty($user_id)) {
        // Check if the user_id exists in the User table
        $userExistsQuery = "SELECT user_id FROM User WHERE user_id = ?";
        $userExistsStmt = $mysqli->prepare($userExistsQuery);
        $userExistsStmt->bind_param("i", $user_id);
        $userExistsStmt->execute();
        $userExistsStmt->store_result();

        if ($userExistsStmt->num_rows > 0) {
            // User exists, proceed with the Person insertion
            $userExistsStmt->close();

            // Construct the SQL query to insert person information
            $personQuery = "INSERT INTO Person (user_id) VALUES (?)";

            $personStmt = $mysqli->prepare($personQuery);

            if ($personStmt === false) {
                echo "Person Preparation Error: " . $mysqli->error;
            } else {
                $personStmt->bind_param("i", $user_id);

                if ($personStmt->execute()) {
                    echo "Successful Insertion!";
                } else {
                    echo "Person Insertion Error: " . $personStmt->error;
                }

                $personStmt->close();
            }
        } else {
            echo "Person Insertion Error: 'user_id' does not exist in the User table.";
        }
    } else {
        echo "Person Insertion Error: 'user_id' cannot be empty.";
    }
}

$mysqli->close();
?>
