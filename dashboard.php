<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/dashboard.css">
        <!-- <?php
            
            if (isset($_GET['userId'])) {
                $userId = $_GET['userId'];
            }else{
                $userId = '';
            }
        ?> -->
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
                <!-- <?php
                    echo "<div class='nav-element'>";
                        echo "<a type=\"button\" id=\"home-nav-link\" href=\"dashboard.php?userId=".$userId."\"HOME</a>";
                    echo"</div>";
                    echo"<div class='nav-element'>";
                        echo"<a type='button' id='trend-nav-link' href='trends.php?userId=$userId'>TRENDS</a>";
                    echo"</div>";
                    echo"<div class='nav-element'>";
                        echo "<a type=\"button\" id=\"account-nav-link\" href=\"account.php?userId=".$userId."\"ACCOUNT</a>";
                    echo"</div>";
                ?> -->
                <?php
                    if (isset($_GET['userId'])) {
                        $userId = $_GET['userId'];
                    }else{
                        $userId = '';
                    }
                    $dashboardLink = "dashboard.php?userId=".$userId;
                    $trendLink = "priceTrendsLogin.php?userId=".$userId;
                    $accountLink = "account.php?userId=".$userId;
                ?>
                <div class="nav-element">
                    <?php
                        echo "<a type=\"button\" id=\"home-nav-link\" href=\"".$dashboardLink."\"HOME</a>";
                    ?>
                    <!-- <a type="button" id="home-nav-link" href="dashboard.php">HOME</a> -->
                </div>
                <div class="nav-element">
                    <a type="button" id="trend-nav-link" href="priceTrendsLogin.php">TRENDS</a>
                </div>
                <div class="nav-element">
                    <?php
                        echo "<a type=\"button\" id=\"account-nav-link\" href=\"".$accountLink."\"ACCOUNT</a>";
                    ?>
                    <!-- <a type="button"id="account-nav-link" href="account.php">ACCOUNT</a> -->
                </div>

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
                    <div class="item">
                        <div class ="item-center-image">
                            <img id="img1" class="item-image" src="img/potatoChips.png">
                        </div>
                        <h3 class="item-name">Lays Chips</h3>
                        <p class="item-description">This is where the description of the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div class ="item-center-image">
                            <img id="img1" class="item-image" src="img/corona.png">
                        </div>
                        <h3 class="item-name">Corona Extra</h3>
                        <p class="item-description">This is where the description of the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div class ="item-center-image">
                            <img id="img1" class="item-image" src="img/gala-apples.png">
                        </div>
                        <h3 class="item-name">Gala Apples</h3>
                        <p class="item-description">This is where the description of the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div class ="item-center-image">
                            <img id="img1" class="item-image" src="img/gatorade.png">
                        </div>
                        <h3 class="item-name">Gatorade 355mL</h3>
                        <p class="item-description">This is where the description of the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                </div>

                <div id="item-shelf2">
                    <div class="item">
                        <div class ="item-center-image">
                            <img id="img1" class="item-image" src="img/rice.png">
                        </div>
                        <h3 class="item-name">White Rice</h3>
                        <p class="item-description">This is where the description of the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div class ="item-center-image">
                            <img id="img1" class="item-image" src="img/mi-goreng.png">
                        </div>
                        <h3 class="item-name">Mi Goreng Noodles</h3>
                        <p class="item-description">This is where the description of the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div class ="item-center-image">
                            <img id="img1" class="item-image" src="img/salsa.png">
                        </div>
                        <h3 class="item-name">Tostitos Salsa</h3>
                        <p class="item-description">This is where the description of the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                    <div class="item">
                        <div class ="item-center-image">
                            <img id="img1" class="item-image" src="img/eggs.png">
                        </div>
                        <h3 class="item-name">Item name</h3>
                        <p class="item-description">This is where the description of the product will go</p>
                        <h5 class="item-price">Cheapest at:</h5>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer>

    </footer>
</html>