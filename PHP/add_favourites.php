<?php
    include "db_connect.php";
    session_start();

    $conn = db_connect();
    $productId = $_POST['productId'];
    // $itemId = $_POST['itemId'];
    // $storeId = $_POST['storeId'];
    $userId = $_SESSION["userId"];

    // $sql = "INSERT INTO favourite (productId, itemId, storeId, userId) VALUES ('$productId', '$itemId', '$storeId', '$userId')";
    $sql = "INSERT INTO favourite (productId, userId) VALUES ('$productId', '$userId')";
    $conn->query($sql);
    db_disconnect($conn);
    echo json_encode(['success' => true]);
?>