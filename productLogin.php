<!-- I know the name is a bit confusing but this is the product page that is displayed for when a user is logged in -->

<?php
session_start();
if(!isset($_SESSION['userId']) && !isset($_SESSION['adminPriv'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/product-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>All products (logged in user)</title>

    <script>
        function popUpItem(itemId, itemName, imageSrc) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'productTrend.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    console.log(xhr.responseText);
                }
            };
            var params = 'itemId=' + encodeURIComponent(itemId) +
                '&itemName=' + encodeURIComponent(itemName) +
                '&imageSrc=' + encodeURIComponent(imageSrc);
            xhr.send(params);
        }
    </script>


</head>
<header>
    <div id="site_logo">
        <p>
            <img id="logo_img" src="img/grocery_logo.png" alt="logo">
        <h2>Grocery</h2>
        <h1 class="greentext">Sense</h1>
        </p>
    </div>

    <div id="header-search-div">
        <form id="search-form" action="search-login.php">
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
            <a type="button" id="login-nav-link" href="account.php">ACCOUNT</a>
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

                $servername = "localhost";
                $username = "root";
                $dbPass = "";
                $database = "db_38885190";

                $conn = new mysqli($servername, $username, $dbPass, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT DISTINCT groceryItemId, groceryItemName, groceryItemImage FROM groceryItems";

                $results = $conn->query($sql);

                if ($results->num_rows > 0) {
                    $i = 0;
                    while ($row = $results->fetch_assoc()) {
                        $i++;
                        $groceryItemId = $row["groceryItemId"];
                        $groceryItemName = $row["groceryItemName"];
                        $groceryItemImage = $row["groceryItemImage"];
                        $cheapestStore = "Walmart";
                        echo "<div class=\"item\">
                                <div class=\"favourite-icon-unfill\">
                                    <i class=\"bi-heart\"></i>
                                </div>
                                <div class=\"item-center-image\" onClick=\"popUpItem('$groceryItemId', '$groceryItemName', '$groceryItemImage')\">
                                    <img id=\"img$i\" class=\"item-image\" src=\"$groceryItemImage\">
                                </div>
                                <div class=\"title-click\" onClick=\"popUpItem('$groceryItemId', '$groceryItemName', '$groceryItemImage')\">
                                    <h3 id=\"item$i\" class=\"item-name\">$groceryItemName</h3>
                                    <h5 class=\"item-price\"><b class=\"greentext\">Lowest price at:</b> $cheapestStore</h5>
                                </div>
                            </div>";
                    }
                    
                } else {
                    echo "No products found";
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