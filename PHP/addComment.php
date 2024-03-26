<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

require 'connection.php';

$userId = $_SESSION['userId'] ?? null;
$itemId = $_POST['itemId'] ?? null;
$commentText = filter_input(INPUT_POST, 'commentText', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Corrected to 'commentText'

if ($userId && $itemId && $commentText) {
    $query = "INSERT INTO comments (userId, groceryItemId, commentText) VALUES (:userId, :itemId, :commentText)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':itemId', $itemId);
    $statement->bindValue(':commentText', $commentText);
    $statement->execute();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
}
?>
