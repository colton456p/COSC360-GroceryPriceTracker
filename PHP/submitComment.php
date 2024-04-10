<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    $productId = $_POST['productId'];
    $commentInput = $_POST['commentInput'];
    $currentDate = date('Y-m-d');
    
    $sql = "INSERT INTO comments (userId, productId, commentText) VALUES (?, ?, ?)";
    $conn = db_connect();
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $userId, $productId, $commentInput);
    if ($stmt->execute()) {
        $sql = "SELECT U.firstName AS fName, C.commentText AS cText, C.commentDate AS cDate FROM comments AS C JOIN user AS U ON U.userId = C.userId WHERE productId = ? ORDER BY C.commentDate DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $comments = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        db_disconnect($conn);

        echo json_encode($comments);
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo "Failed to insert comment into the database. Error: " . $stmt->error;
    }
}
?>