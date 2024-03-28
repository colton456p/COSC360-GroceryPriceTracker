<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    require "connection.php";

    $sql = "SELECT c.commentText, u.firstName FROM comments c JOIN user u ON c.userId = u.userId WHERE c.groceryItemId = :itemId ORDER BY c.commentId DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':itemId', $_GET['itemId'], PDO::PARAM_INT);
    $stmt->execute();

    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($comments) {
        foreach ($comments as $comment) {
            echo "<div class='comment'>";
            echo "<p><strong>" . htmlspecialchars($comment['firstName']) . ":&nbsp &nbsp</strong></p>";
            echo "<p>" . htmlspecialchars($comment['commentText']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No comments to display.</p>";
    }
}
?>
