<?php

// autocomplete_functions.php

function getAutocompleteSuggestions($searchString) {
    $server = "localhost";
    $username = "mowais";
    $mysql_password = "cQgD8R";
    $database = "Group-18";

    $mysqli = new mysqli($server, $username, $mysql_password, $database);

    // Check the connection
    if ($mysqli->connect_error) {
        die("MySQL Connection failed: " . $mysqli->connect_error);
    }

    // Construct the SQL query to select vendor names based on the search string
    $sql = "SELECT vendorName FROM Vendors WHERE vendorName LIKE ? LIMIT 10";
    $stmt = $mysqli->prepare($sql);

    // Add '%' to the search string to perform a partial match
    $searchString = '%' . $searchString . '%';
    $stmt->bind_param("s", $searchString);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch vendor names from the result
    $suggestions = array();
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['vendorName'];
    }

    // Close the database connection
    $mysqli->close();

    return $suggestions;
}


?>
