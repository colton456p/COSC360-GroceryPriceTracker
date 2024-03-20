<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/product-style.css">
    <title>Price Trends</title>
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
<div id="main">
            <div id="item-group">
                <div id="item-shelf">
                    <?php
                        $twoDArray = array(
                            array("Lays Chips", "img/potatoChips.png"),
                            array("Corona Extra", "img/corona.png",),
                            array("Gala Apples", "img/gala-apples.png"),
                            array("Gatorade 355mL", "img/gatorade.png"),
                            array("White Rice", "img/rice.png"),
                            array("Mi Goreng Noodles", "img/mi-goreng.png"),
                            array("Tostitos Salsa", "img/salsa.png"),
                            array("Eggs", "img/eggs.png")
                        );

                        for ($i = 0; $i < count($twoDArray); $i++) {
                            echo "<div class=\"item\" onclick=\"popUpItem()\">
                                    <div class =\"item-center-image\">
                                        <img id=\"img".$i."\" class=\"item-image\" src=\"".$twoDArray[$i][1]."\">
                                    </div>
                                    <h3 id=\"item".$i."\"class=\"item-name\">".$twoDArray[$i][0]."</h3>
                                    <p class=\"item-description\">This is where the description of the product will go</p>
                                    <h5 class=\"item-price\">Cheapest at:</h5>
                                </div>";
                        }
                    ?>
                </div>
            </div>
        </div>
</body>
<footer>
    <p></p>
</footer>
</html>
