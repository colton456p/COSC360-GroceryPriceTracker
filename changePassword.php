<?php
include "PHP/db_connect.php";
session_start();
$userId = $_SESSION["userId"];

if (!isset($_SESSION['userId']) && !isset($_SESSION['adminPriv'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $error = "";
    if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } else {

        $conn = db_connect();

        $userId = $_SESSION['userId'];
        $sql = "SELECT pass FROM user WHERE userId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($storedPassword);
        $stmt->fetch();
        $stmt->close();

        $hashed_old_password = md5($oldPassword);
        if ($hashed_old_password != $storedPassword) {
            $error = "Incorrect old password.";
        } else {

            $updateSql = "UPDATE user SET pass = ? WHERE userId = ?";
            $updateStmt = $conn->prepare($updateSql);
            $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateStmt->bind_param("si", $hashed_password, $userId);
            $updateStmt->execute();
            $updateStmt->close();

            db_disconnect($conn);


            header("Location: account.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>GrocerySmart</title>
    <link rel="stylesheet" href="css/change-pass.css">
</head>
<header>
    <div id="site_logo">
        <p>
            <img id="logo_img" src="img/grocery_logo.png" alt="logo">
            <h2 >Grocery</h2><h1 class="greentext">Sense</h1>
        </p>
    </div>
    <div id="header-search-div">
        <form id="search-form" action="search-login.php">
            <input type="search" id="search-bar" name="search-bar" placeholder="Search for items...">
            <input type="submit" value="Search" id="search-button">
        </form>
    </div>

    <div id="menu_bar">
        <p>
            <div class="nav-element">
                <a type="button" id="home-nav-link" href="dashboard.php">FAVOURITES</a>
            </div>
            <div class="nav-element">
                <a type="button" id="product-nav-link" href="productLogin.php">PRODUCTS</a>
            </div>
            <div class="nav-element">
                <a type="button"id="account-nav-link" href="account.php">ACCOUNT</a>
            </div>
        </p>
    </div>
</header>
<body>
    <h1>Change Password</h1>
    <?php
    if (!empty($error)) {
        echo "<p>Error: $error</p>";
    }
    ?>
    <div id="passchange-div">
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
            <input type="submit" name="submit" value="Submit" id="change-pass-button">
        </form>
    </div>
</body>
</html>
