<!-- I know the name is a bit confusing but this is the product page that is displayed for when a user is NOT logged in -->
<?php
include "PHP/db_connect.php";


?>

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
        <form id="search-form" action="search.php" method="post">
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
                    $conn = db_connect();
                    
                    $sql ="SELECT productId, MAX(groceryItemName) AS groceryItemName, MAX(groceryItemImage) AS groceryItemImage FROM groceryItems GROUP BY productId";


                    $results = $conn->query($sql);

                    $i = 0;
                    while ($row = $results->fetch_assoc()){
                        $i+=1;
                        $productId = $row["productId"];
                        $groceryItemName = $row["groceryItemName"];
                        $groceryItemImage = $row["groceryItemImage"];
                        $sql2 = "SELECT G.groceryStoreName FROM groceryItems AS GI JOIN groceryStore AS G ON GI.storeId = G.groceryStoreId WHERE GI.productId = '$productId' AND GI.currentPrice = (SELECT MIN(currentPrice) FROM groceryItems WHERE productId = '$productId')";
                        $results2 = $conn->query($sql2);
                        $row2 = $results2->fetch_assoc();
                        $cheapestStore = $row2["groceryStoreName"];
                        echo "<div class=\"item\">
                                <div class =\"item-center-image\" >
                                    <img id=\"img".$i."\" class=\"item-image\" src=\"".$groceryItemImage."\">
                                </div>
                                <div class=\"title-click\">
                                    <h3 id=\"item".$i."\"class=\"item-name\"> ".$groceryItemName."</h3>
                                    <h5 class=\"item-price\"><b class=\"greentext\">Lowest price at: </b>".$cheapestStore."</h5>
                                </div>
                            </div>";
                    }
                    db_disconnect($conn);
                ?>
            </div>
        </div>
    </div>
</body>
<footer>
    <p></p>
</footer>
</html>
