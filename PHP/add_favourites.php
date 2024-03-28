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
    $itemId = $_POST['itemId'];
    $storeId = $_POST['storeId'];
    $productId = $_SESSION["productId"];

    $sql = "INSERT INTO favourite (productId, storeId, itemId) VALUES ('$productId', '$storeId', '$itemId')";
    $conn->query($sql);

    $conn->close();
    echo json_encode(['success' => true]);
?>