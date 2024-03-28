<?php
ob_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'connection.php';

$userId = $_SESSION['userId'] ?? null;
$itemId = $_POST['itemId'] ?? null;
$commentText = filter_input(INPUT_POST, 'commentText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($userId) {
    $stmt = $pdo->prepare("SELECT firstName FROM user WHERE userId = :userId");
    $stmt->execute([':userId' => $userId]);
    
    $user = $stmt->fetch();
    
    if ($user) {
        $firstName = $user['firstName'];
    }
} else {
    echo json_encode(['success' => false, 'message' => 'missing user id']);
}
if ($userId && $itemId && $commentText) {
    $query = "INSERT INTO comments (userId, groceryItemId, commentText) VALUES (:userId, :itemId, :commentText)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':itemId', $itemId);
    $statement->bindValue(':commentText', $commentText);

    if ($statement->execute()) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'message' => 'Comment added successfully',
            'firstName' => $firstName, 
            'commentText' => $commentText
        ]);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Failed to add comment']);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}

ob_end_flush();
