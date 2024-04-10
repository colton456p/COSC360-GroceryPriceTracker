<?php
include "PHP/db_connect.php";
session_start();

if(!isset($_SESSION['adminPriv'])){
    header("Location: login.php");
    exit;
}


session_start();
$userId = $_SESSION["userId"];

function adminRemoveAction($userId, $conn) {
    $sql = "DELETE FROM user WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['remove_user'])) {
    $userIdToRemove = $_POST['remove_user'];
    $conn = db_connect();
    adminRemoveAction($userIdToRemove, $conn);
    db_disconnect($conn);
}

if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $conn = db_connect();
    $sql = "SELECT * FROM user WHERE adminPriv != 1 AND (firstName LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%')";
    $result = $conn->query($sql);
    db_disconnect($conn);
} else {
    $conn = db_connect();
    $sql = "SELECT * FROM user WHERE adminPriv != 1";
    $result = $conn->query($sql);
    db_disconnect($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>GrocerySmart - Admin</title>
    <link rel="stylesheet" href="css/adminRemove.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
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

<div id="container">
    <h1>Admin Remove</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="search" placeholder="Search by name or email">
        <input type="submit" value="Search">
        <button type="submit" name="see_all">See All</button>
    </form>

    <table>
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['userId']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['pass']}</td>
                        <td>{$row['firstName']}</td>
                        <td>{$row['lastName']}</td>
                        <td>
                            <form method='POST'>
                                <button class='remove-btn' name='remove_user' value='{$row['userId']}'>Remove</button>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "No users found.";
        }
        ?>
    </table>
</div>
</body>
</html>
