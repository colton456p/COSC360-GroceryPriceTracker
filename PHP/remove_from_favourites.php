<?php
    include "db_connect.php";
    session_start(); 
    $conn = db_connect();
    $productId = $_POST['productId'];
    $userId = $_SESSION["userId"];
    $sql = "DELETE FROM favourite WHERE productId = '$productId' AND userId = '$userId'";

    $conn->query($sql);

    db_disconnect($conn);
    echo json_encode(['success' => true]);
?>