<?php
    session_start(); 
    $servername = "localhost";
    $username = "38885190";
    $dbPass = "38885190";
    $database = "db_38885190";

    $conn = new mysqli($servername, $username, $dbPass, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $productId = $_POST['productId'];
    $userId = $_SESSION["userId"];
    $sql = "DELETE FROM favourite WHERE productId = '$productId' AND userId = '$userId'";

    $conn->query($sql);

    $conn->close();
    echo json_encode(['success' => true]);
?>