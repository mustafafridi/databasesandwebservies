[18:38, 22/10/2023] Sabeeh Sulehri JUB: <?php
$server = "localhost"; // Since you are on the same server
$username = "mowais";
$mysql_password = "cQgD8R"; // MySQL password
$database = "Group-18";

// Create a MySQL connection
$mysqli = new mysqli($server, $username, $mysql_password, $database);

// Check the MySQL connection
if ($mysqli->connect_error) {
    die("MySQL Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    if($user_id == 'C')
    {
        $user_id = 'C'.substr(uniqid(), 0, rand(1, 7));
    }
    else if($user_id == 'E')
    {
        $user_id = 'E'.substr(uniqid(), 0, rand(1, 7));
    }
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];
    $…
if ($stmt === false) {
        echo "Preparation Error: " . $mysqli->error;
    } else {
        $stmt->bind_param("ssssssss", $user_id, $first_name, $last_name, $gender, $birth_date, $phone, $username, $password);
        if ($stmt->execute()) {
            echo "Successful Insertion!";
        } else {
            echo "Insertion Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Close the MySQL connection
$mysqli->close();
?>

<!DOCTYPE html>
<html>
    <body>
        <a href="#maintenance.html"> Go Back to Maintenance Page </a>
    </body>
</html>