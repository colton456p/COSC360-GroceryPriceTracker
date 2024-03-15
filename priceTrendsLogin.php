<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/price-trends-style.css">
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
                <a type="button" id="home-nav-link" href="dashboard.php">HOME</a>
            </div>
            <div class="nav-element">
                <a type="button" id="pricetrend-nav-link" href="priceTrendsLogin.php">TRENDS</a>
            </div>
            <div class="nav-element">
                <a type="button"id="login-nav-link" href="account.php">ACCOUNT</a>
            </div>
        </p>
    </div>
</header>
<body>
    <div id="main">
        <div id="priceTrends-content">
            <h3>Price Trends</h3>
            <p>
                Explore the latest trends in grocery prices from various stores. Our price tracker
                constantly updates to provide you with real-time information on the cost of essential items.
            </p>

            
            <div class="priceTrend-item">
                <h4>Item Name</h4>
                <p>Store: ABC Supermarket</p>
                <p>Current Price: $X.XX</p>
                <p>Previous Price: $Y.YY</p>
            </div>

            <div class="priceTrend-item">

            </div>



        </div>
    </div>
</body>
<footer>
    <p></p>
</footer>
</html>
