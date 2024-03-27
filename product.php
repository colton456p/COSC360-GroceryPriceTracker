<!-- I know the name is a bit confusing but this is the product page that is displayed for when a user is NOT logged in -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/product-style.css">
    <title>All products (logged out user)</title>
</head>
<header>
    <div id="site_logo">
        <p>
            <img id="logo_img" src="img/grocery_logo.png" alt="logo">
            <h2>Grocery</h2><h1 class="greentext">Sense</h1>
        </p>
    </div>
    
    <div id="header-search-div">
        <form id="search-form" action="search.php">
            <input type="search" id="search-bar" name="search-bar" placeholder="Search for items...">
            <input type="submit" value="Search" id="search-button">
        </form>
    </div>

    <div id="menu_bar">
        <p>
            <div class="nav-element">
                <a type="button" id="home-nav-link" href="homepage.php">HOME</a>
            </div>
            <div class="nav-element">
                <a type="button" id="product-nav-link" href="product.php">PRODUCTS</a>
            </div>
            <div class="nav-element">
                <a type="button"id="login-nav-link" href="login.php">LOGIN</a>
            </div>
        </p>
    </div>
</header>
<body>
    <div id="main">
        <div id="item-group">

            <div id="item-shelf">
                <?php
                    $servername = "localhost";
                    $username = "38885190";
                    $dbPass = "38885190";
                    $database = "db_38885190";
                    
                    $conn = new mysqli($servername, $username, $dbPass, $database);
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    $sql ="SELECT productId, MAX(groceryItemName) AS groceryItemName, MAX(groceryItemImage) AS groceryItemImage FROM groceryItems GROUP BY productId";


                    $results = $conn->query($sql);

                    $i = 0;
                    while ($row = $results->fetch_assoc()){
                        $i+=1;
                        $productId = $row["productId"];
                        $groceryItemName = $row["groceryItemName"];
                        $groceryItemImage = $row["groceryItemImage"];
                        $cheapestStore = "Walmart";
                        echo "<div class=\"item\">
                                <div class =\"item-center-image\" onClick=\"popUpItem('".$productId."', '".$groceryItemName."', '".$groceryItemImage."')\">
                                    <img id=\"img".$i."\" class=\"item-image\" src=\"".$groceryItemImage."\">
                                </div>
                                <div class=\"title-click\" onClick=\"popUpItem('".$productId."', '".$groceryItemName."', '".$groceryItemImage."')\">
                                    <h3 id=\"item".$i."\"class=\"item-name\"> ".$groceryItemName."</h3>
                                    <h5 class=\"item-price\"><b class=\"greentext\">Lowest price at: </b>".$cheapestStore."</h5>
                                </div>
                            </div>";
                    }
                    $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
<footer>
    <p></p>
</footer>
</html>
