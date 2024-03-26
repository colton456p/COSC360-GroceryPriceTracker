<?php
session_start();
$userId = $_SESSION["userId"];
$servername = "localhost";
$username = "38885190";
$dbPass = "38885190";
$database = "db_38885190";

// Function to remove user
function adminRemoveAction($userId, $conn) {
    $sql = "DELETE FROM user WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
}

// Check if the remove button is clicked
if (isset($_POST['remove_user'])) {
    $userIdToRemove = $_POST['remove_user'];
    $conn = new mysqli($servername, $username, $dbPass, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Call adminRemoveAction function to remove the user
    adminRemoveAction($userIdToRemove, $conn);
    $conn->close();
}

// Search functionality
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $conn = new mysqli($servername, $username, $dbPass, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM user WHERE adminPriv != 1 AND (firstName LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%')";
    $result = $conn->query($sql);
    $conn->close();
} else {
    // Retrieve all users except admin
    $conn = new mysqli($servername, $username, $dbPass, $database);
    $sql = "SELECT * FROM user WHERE adminPriv != 1";
    $result = $conn->query($sql);
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Remove</title>
    <link rel="stylesheet" href="css/adminRemove.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<header>
    <!-- Your header content here -->
</header>

<div id="container">
    <h1>Admin Remove</h1>
    <!-- Search form -->
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
            // Output data of each row
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
