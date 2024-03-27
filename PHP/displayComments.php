<?php
require "connection.php";

// Determine if the request is via AJAX
$isAjaxRequest = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

$itemId = filter_input(INPUT_GET, 'itemId', FILTER_SANITIZE_NUMBER_INT);

// SQL query to fetch comments
$sql = "SELECT c.commentText, u.firstName FROM comments c JOIN user u ON c.userId = u.userId WHERE c.groceryItemId = :itemId ORDER BY c.commentId DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
$stmt->execute();

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($isAjaxRequest) {
    // If AJAX request, respond with JSON
    header('Content-Type: application/json');
    echo json_encode($comments);
} else {
    // If not an AJAX request, generate HTML
    if ($comments) {
        echo "<div class='displayComments'>"; // Start the displayComments div
        foreach ($comments as $comment) {
            echo "<div class='comment'>";
            echo "<p><strong>User: </strong>" . htmlspecialchars($comment['firstName']) . "</p>";
            echo "<p>" . htmlspecialchars($comment['commentText']) . "</p>";
            echo "</div>";
        }
        echo "</div>"; // End the displayComments div
    } else {
        echo "<p>No comments to display.</p>";
    }
}
?>
