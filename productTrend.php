<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/productTrend-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Product Trend</title>
    <script>
        function backButton(){
            window.history.back();
        } 
    </script>
</head>
<header>
    <div id="site_logo">
        <p>
            <img id="logo_img" src="img/grocery_logo.png" alt="logo">
            <h2>Grocery</h2><h1 class="greentext">Sense</h1>
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
                <a type="button"id="login-nav-link" href="account.php">ACCOUNT</a>
            </div>
        </p>
    </div>
</header>
<body>
    <div id="topBar">
        <div id="back-arrow" onclick="return backButton()">
            <i  class="bi bi-arrow-left-circle-fill"> Back</i>
        </div>
    </div>
    <?php
    echo "<h1 id=\"productName\">".$_POST['itemName']."</h1>";
    ?>
    <div id="centerContent">
        <div id="left">
            <?php
            echo "<img id=\"productImage\" src=\"".$_POST['imageSrc']."\" alt=\"product image\">";
            ?>
        </div>
        <div id="right">
            <div id="image_bubbles">
                <div class="storePrice">
                    <img class="logobubble" src="img/saveon-logo.png" alt="SaveOn Logo">
                    <h1 class="price">Save On Foods </h1> <h1 class="greentext">$10.00</h1>
                </div>
                <div class="storePrice">
                    <img class="logobubble" src="img/walmart-logo.jpg" alt="Walmart Logo">
                    <h1 class="price">Walmart </h1> <h1 class="greentext">$10.00</h1>
                </div>
                <div class="storePrice">
                    <img class="logobubble" src="img/safewaylogo.png" alt="Safeway Logo">
                    <h1 class="price">Safeway</h1> <h1 class="greentext">$10.00</h1>
                </div>
                <div class="storePrice">
                    <img class="logobubble" src="img/maxi-logo.png" alt="Maxi Logo">
                    <h1 class="price">Maxi </h1> <h1 class="greentext">$10.00</h1>
                </div>
                <div class="storePrice">
                    <img class="logobubble" src="img/pclogo.png" alt="Presidents Choice Logo">
                    <h1 class="price">Superstore </h1> <h1 class="greentext">$10.00</h1>
                </div>
            </div>
        </div>
    </div> 
    <div id="trends">
        <h1>PRICE TRENDS</h1>
        <div id="trendGraph">
            <img src="img/fakeDemoGraph.jpg" alt="trend graph">
        </div>
    </div>
    <h1 id="commentTitle">COMMENTS</h1>
    <div id="comments">
        
        <div id="productComments">
            <?php
            session_start();    
            $userId = $_SESSION["userId"];
            $servername = "localhost";
            $username = "38885190";
            $dbPass = "38885190";
            $database = "db_38885190";
    
            $conn = new mysqli($servername, $username, $dbPass, $database);
            $sql = "SELECT (commentText, commentDate) FROM user WHERE itemId=".$itemId;
            $result = $conn->query($sql);
            $comment = $result->fetch_assoc(); 
            $result->close();

            $sql ="SELECT userId FROM user WHERE ";
            $commentText = $comment["commentText"];
            $date = $comment["commentDate"];
            ?>
            <div class="singleComment">
                <div class="leftComment">
                    
                    <h3>Name</h3>
                    <p id="commentValue">Comments will go here</p>
                    <p id="commentDate">Date: 10/08/24</p>
                </div>
                <div class="rightComment">
                    <span class="tooltip-text">Report a Comment? &#8594;</span>
                    <i class="bi bi-flag-fill"></i>
                </div>
            </div>
            <div class="singleComment">
                <div class="leftComment">
                    
                    <h3>Name</h3>
                    <p id="commentValue">Comments will go here</p>
                    <p id="commentDate">Date: 10/08/24</p>
                </div>
                <div class="rightComment">
                    <span class="tooltip-text">Report a Comment? &#8594;</span>
                    <i class="bi bi-flag-fill"></i>
                </div>
            </div>
            <div class="singleComment">
                <div class="leftComment">
                    
                    <h3>Name</h3>
                    <p id="commentValue">Comments will go here</p>
                    <p id="commentDate">Date: 10/08/24</p>
                </div>
                <div class="rightComment">
                    <span class="tooltip-text">Report a Comment? &#8594;</span>
                    <i class="bi bi-flag-fill"></i>
                </div>
            </div>
            <div class="singleComment">
                <div class="leftComment">
                    
                    <h3>Name</h3>
                    <p id="commentValue">Comments will go here</p>
                    <p id="commentDate">Date: 10/08/24</p>
                </div>
                <div class="rightComment">
                    <span class="tooltip-text">Report a Comment? &#8594;</span>
                    <i class="bi bi-flag-fill"></i>
                </div>
            </div>
            <div class="singleComment">
                <div class="leftComment">
                    
                    <h3>Name</h3>
                    <p id="commentValue">Comments will go here</p>
                    <p id="commentDate">Date: 10/08/24</p>
                </div>
                <div class="rightComment">
                    <span class="tooltip-text">Report a Comment? &#8594;</span>
                    <i class="bi bi-flag-fill"></i>
                </div>
            </div>
        </div>
        <div id="addComment">
            <h2>Add a Comment</h2>
            <form id="commentForm" method="post" action="PHP/addComment.php">
                <input type="text" id="commentInput" name="commentInput" placeholder="Add a comment...">
                <input type="submit" value="Post Comment" id="commentButton">
            </form>
        </div>
    </div>
</body>