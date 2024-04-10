<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentId = $_POST['commentId'];
    
    $conn = db_connect();

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'error' => 'Database connection error']);
        exit();
    }

    $sql = "UPDATE comments SET flagged = 1 WHERE commentId = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $commentId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to update comment']);
    }

    $stmt->close();
    db_disconnect($conn);
}
?>
