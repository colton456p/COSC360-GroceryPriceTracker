<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/dashboard.css">
        <?php
            
            if (isset($_GET['userId'])) {
                $userId = $_GET['userId'];
            }else{
                $userId = '';
            }
        ?>
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
                <?php
                    echo "<div class='nav-element'>";
                        echo "<a type='button' id='home-nav-link' href='dashboard.php?userId=$userId'>HOME</a>";
                        // <a type="button" id="dashboard-nav-link" href="dashboard.php">DASHBOARD</a>
                    echo"</div>";
                    echo"<div class='nav-element'>";
                        echo"<a type='button' id='trend-nav-link' href='trends.php?userId=$userId'>TRENDS</a>";
                    echo"</div>";
                    echo"<div class='nav-element'>";
                        echo"<a type='button'id='account-nav-link' href='account.php?userId=$userId'>ACCOUNT</a>";
                    echo"</div>";
                ?>
            </p>
        </div>
    </header>
    <body>
        <div id="favourite-page-title">
            <h1>YOUR FAVOURITES</h1>
        </div>
        <div id="main">
            <div id="item-group">
                <div id="item-shelf1">
                    <div class="item" href="">
                        <div id ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div id ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div id ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div id ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                </div>

                <div id="item-shelf2">
                    <div class="item">
                        <div id ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div id ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div id ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div id ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>

    </footer>
</html>