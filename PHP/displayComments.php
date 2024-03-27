<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // This is an AJAX request, output only comments
    require "connection.php";

    // SQL query to fetch comments
    $sql = "SELECT c.commentText, u.firstName FROM comments c JOIN user u ON c.userId = u.userId WHERE c.groceryItemId = :itemId ORDER BY c.commentId DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':itemId', $_GET['itemId'], PDO::PARAM_INT);
    $stmt->execute();

    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the comments directly
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
} else {
    // This is not an AJAX request, you can output additional HTML structure if needed
}
?>
