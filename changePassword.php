<?php
session_start();
$userId = $_SESSION["userId"];
$servername = "localhost";
$username = "38885190";
$dbPass = "38885190";
$database = "db_38885190";

// Check if the user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate inputs
    $error = "";
    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } else {
        // Connect to the database
        $conn = new mysqli($servername, $username, $dbPass, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the user's current password from the database
        $userId = $_SESSION['userId'];
        $sql = "SELECT pass FROM user WHERE userId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($storedPassword);
        $stmt->fetch();
        $stmt->close();

        // Check if the old password matches the stored password
        if ($oldPassword != $storedPassword) {
            $error = "Incorrect old password.";
        } else {
            // Update the user's password in the database
            $updateSql = "UPDATE user SET pass = ? WHERE userId = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("si", $newPassword, $userId);
            $updateStmt->execute();
            $updateStmt->close();

            $conn->close();

            // Redirect back to the account page
            header("Location: account.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <!-- Add your CSS stylesheets here -->
</head>
<body>
    <h1>Change Password</h1>
    <?php
    if (!empty($error)) {
        echo "<p>Error: $error</p>";
    }
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" required>
        <br>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br>
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
