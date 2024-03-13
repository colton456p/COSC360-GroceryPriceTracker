<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Account</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<header>
    <div id="site_logo">
        <p>
            <img id="logo_img" src="img/grocery_logo.png" alt="logo">
            <h2 >Grocery</h2><h1 class="greentext">Sense</h1>
        </p>
    </div>
    <div id="header-search-div">
        <form id="search-form" action="">
            <input type="search" id="search-bar" name="search-bar" placeholder="Search for items...">
            <input type="submit" value="Search" id="search-button">
        </form>
    </div>
    
    <div id="menu_bar">
        <p>
            <div class="nav-element">
                <a type="button" id="home-nav-link" href="dashboard.php">HOME</a>
            </div>
            <div class="nav-element">
                <a type="button" id="trend-nav-link" href="priceTrendsLogin.php">TRENDS</a>
            </div>
            <div class="nav-element">
                <a type="button"id="account-nav-link" href="account.php">ACCOUNT</a>
            </div>
        </p>
    </div>
</header>
<body>
    <!-- <?php
        if (isset($_GET['userId'])) {
            $userId = $_GET['userId'];
        }
        $servername = "localhost";
        $username = "38885190";
        $dbPass = "38885190";
        $database = "db_38885190";

        $conn = new mysqli($servername, $username, $dbPass, $database);
        $sql = "SELECT firstName, lastName, email FROM user WHERE userId =".$userId;
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();    
        $result->close();
    ?> -->
    <div id="container">
        <h2>Your Account</h2>
        <h3>User Profile</h3>
        <div class="indent">
            <!-- <?php
                echo"<p><strong>Account Number:</strong>".$userId."</p>";
                echo"<p><strong>First Name:</strong>".$user[0]."</p>";
                echo"<p><strong>Last Name:</strong>".$user[1]."</p>";
                echo"<p><strong>Email:</strong>".$user[2]."</p>";
            ?> -->

            <p><strong>Account Number:</strong></p>";
            <p><strong>First Name:</strong></p>";
            <p><strong>Last Name:</strong></p>";
            <p><strong>Email:</strong></p>"
        </div>
        <h3>Actions</h3>
        
        <a href="#" class="btn">Change Password</a>
        <a href="homepage.php" style="background-color:rgb(220, 6, 6);"class="btn">Log out</a>
    </div>
</body>
</html>
