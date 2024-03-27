<?php
ob_start(); // Start buffering output at the very beginning

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Your existing PHP code for database connection and logic
require 'connection.php';

$userId = $_SESSION['userId'] ?? null;
$itemId = $_POST['itemId'] ?? null;
$commentText = filter_input(INPUT_POST, 'commentText', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($userId) {
    // Prepare a statement to retrieve the user's first name
    $stmt = $pdo->prepare("SELECT firstName FROM user WHERE userId = :userId");
    $stmt->execute([':userId' => $userId]);
    
    // Fetch the result
    $user = $stmt->fetch();
    
    if ($user) {
        $firstName = $user['firstName'];
    } else {
        // Handle the case where the user doesn't exist
        $firstName = "Unknown User";
    }
} else {
    // Handle the case where $userId isn't set
    $firstName = "Guest";
}
if ($userId && $itemId && $commentText) {
    $query = "INSERT INTO comments (userId, groceryItemId, commentText) VALUES (:userId, :itemId, :commentText)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':itemId', $itemId);
    $statement->bindValue(':commentText', $commentText);

    if ($statement->execute()) {
        header('Content-Type: application/json'); // Set header just before echoing the response
        // Inside addComment.php, after successfully inserting the comment
        echo json_encode([
            'success' => true,
            'message' => 'Comment added successfully',
            'firstName' => $firstName, // Assuming you have the user's first name available
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

ob_end_flush(); // End buffering and send output to browser
