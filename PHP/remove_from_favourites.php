<?php
    session_start(); 
    $servername = "localhost";
    $username = "root";
    $dbPass = "";
    $database = "db_38885190";

    $conn = new mysqli($servername, $username, $dbPass, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $itemId = $_POST['itemId'];
    $userId = $_SESSION["userId"];
    $sql = "DELETE FROM favourite WHERE itemId = '$itemId' AND userId = '$userId'";

    $conn->query($sql);

    $conn->close();
    echo json_encode(['success' => true]);
?>