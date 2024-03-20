<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Account</title>
    <link rel="stylesheet" href="css/account.css">
    <script>
        function logOut(){
            sessionStorage.clear();
            session_destroy();
        }
    </script>
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
    
        <?php
        session_start();    
        $userId = $_SESSION["userId"];
        $servername = "localhost";
        $username = "38885190";
        $dbPass = "38885190";
        $database = "db_38885190";

        $conn = new mysqli($servername, $username, $dbPass, $database);
        $sql = "SELECT firstName, lastName, email FROM user WHERE userId =".$userId;
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();    
        $result->close();
        ?>
    
    <div id="container">
        <h2>Your Account</h2>
        <h3>User Profile</h3>
        <div class="indent">
            
                <?php
                echo "<p><strong>Account Number:</strong> <span class=\"green-text\">".$userId."</span></p>
                <p><strong>First Name:</strong> <span class=\"green-text\">".$user["firstName"]."</span></p>
                <p><strong>Last Name:</strong> <span class=\"green-text\">".$user["lastName"]."</span></p>
                <p><strong>Email:</strong> <span class=\"green-text\">".$user["email"]."</span></p>";
                ?>
            
        </div>
        <h3>Actions</h3>
        
        <a href="#" class="btn">Change Password</a>
        <a href="homepage.php" action="logOut()"style="background-color:rgb(220, 6, 6);"class="btn">Log out</a>
    </div>
</body>
</html>
