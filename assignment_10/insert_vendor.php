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
    // Retrieve vendor information from the form
    $vendorName = $_POST["vendorName"];
    $vendorType = $_POST["vendorType"];
    $description = $_POST["description"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $website = $_POST["website"];
    $address = $_POST["address"];
    $zipCode = $_POST["zipCode"];
    $city = $_POST["city"];
    $cost = $_POST["cost"];

    // Construct the SQL query to insert a new vendor
    $vendorQuery = "INSERT INTO Vendor (person_id, vendorName, vendorType, description, email, phone, website, address, zipCode, city, cost) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // You'll need to replace 1 with the actual user_id you want to associate with the new vendor
    $user_id = 1; // Replace with the actual user_id value

    $vendorStmt = $mysqli->prepare($vendorQuery);

    if ($vendorStmt === false) {
        echo "Vendor Preparation Error: " . $mysqli->error;
    } else {
        $vendorStmt->bind_param("isssssssssd", $user_id, $vendorName, $vendorType, $description, $email, $phone, $website, $address, $zipCode, $city, $cost);

        if ($vendorStmt->execute()) {
            echo "Successful Insertion!";
        } else {
            echo "Vendor Insertion Error: " . $vendorStmt->error;
        }

        $vendorStmt->close();
    }
}

$mysqli->close();
?>
<!DOCTYPE html>
<html>
    <body>
        <a href="maintenance.html">Go Back to Maintenance Page</a>
    </body>
</html>
