<?php
function removeFromFavorites($itemId) {
    $servername = "localhost";
    $username = "38885190";
    $dbPass = "38885190";
    $database = "db_38885190";

    // Create connection
    $conn = new mysqli($servername, $username, $dbPass, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to delete the product from favorites table
    $sql = "DELETE FROM favorite WHERE itemId = $itemId"; // Change 'favorites' to your table name

    $conn->query($sql);

    $conn->close();
}
?>
