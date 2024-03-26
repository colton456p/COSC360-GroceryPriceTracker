<?php
require "connection.php"; // Ensure this points to your database connection script

$itemId = filter_input(INPUT_GET, 'itemId', FILTER_SANITIZE_NUMBER_INT); // Or use a different method to set $itemId

// SQL query to fetch comments
$sql = "SELECT c.commentText, u.firstName FROM comments c JOIN user u ON c.userId = u.userId WHERE c.groceryItemId = :itemId ORDER BY c.commentId DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
$stmt->execute();

$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($comments) {
    foreach ($comments as $comment) {
        echo "<div class='comment'>";
        echo "<p><strong>User: </strong>" . htmlspecialchars($comment['firstName']) . "</p>";
        echo "<p>" . htmlspecialchars($comment['commentText']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No comments to display.</p>";
}
?>
