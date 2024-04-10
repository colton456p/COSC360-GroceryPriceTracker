<?php
include "db_connect.php";

if(isset($_POST['productId'])) {
    $conn = db_connect();
    $productId = $_POST['productId'];

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
    echo json_encode(array('error' => 'productId not provided'));
}
?>