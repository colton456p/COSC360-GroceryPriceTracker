<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/homepage-style.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <title>Homepage</title>
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
                    <a type="button" id="home-nav-link" href="homepage.php">HOME</a>
                </div>
                <div class="nav-element">
                    <a type="button" id="pricetrend-nav-link" href="priceTrends.php">TRENDS</a>
                </div>
                <div class="nav-element">
                    <a type="button"id="login-nav-link" href="login.php">LOGIN</a>
                </div>
            </p>
        </div>
    </header>

    <body>
        <div id="main">
            <div id="banner">
                <figure>
                    <img id="bannerimg" src="img/sitebanner2.png" alt="Money_Tree"> 
                </figure>
            </div>
            <div id="side-div">
                <a href="priceTrends.php" style="text-decoration:none;">
                    <div class="side-text" >
                        
                        <h1>
                            View which store has the CHEAPEST grocery prices
                        <h1>
                    </div>
                </a>

                <a href="login.php" style="text-decoration:none;">
                    <div class="side-text" href="login.php">
                        <h1>
                            Login and save the stores or items you track most
                        <h1>
                    </div>
                </a>
                <a href="priceTrends.php" style="text-decoration:none;">
                    <div class="side-text">
                        <h1>
                            View comments, price trends, and real time prices
                        <h1>
                    </div>
                </a>
            </div>

            <div id="image_bubbles">
                <img class="logobubble" src="img/saveon-logo.png" alt="SaveOn Logo">
                <img class="logobubble" src="img/walmart-logo.jpg" alt="Walmart Logo">
                <img class="logobubble" src="img/loblaws-logo.jpg" alt="Lowblaws Logo">
                <img class="logobubble" src="img/safewaylogo.png" alt="Safeway Logo">
                <img class="logobubble" src="img/maxi-logo.png" alt="Maxi Logo">
                <img class="logobubble" src="img/pclogo.png" alt="Presidents Choice Logo">
            </div>
        </div>
        
    </body>
    <footer>
        <div id="description-text">
            <h3 id="footer_title">About Us</h3>
            <p>
                This site was created for the course COSC 360 (Introduction to Web. 
                Development). It uses APIs from several popular Canadian grocery 
                stores to help you easily find the cheapest grocery prices. With everything
                being so expensive nowadays we believe this website will help save 
                time and money especially for students.
            </p>
            <p>All credits go to:<i></i> Colton Palfrey, Karam Hejazin, and Tyler Cummings</i></p>
        </div>
    </footer>
</html>