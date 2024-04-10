<?php
include "PHP/db_connect.php";
session_start();

if(!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>GrocerySmart - Favourites</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
            function popUpItem(productId, itemName, imageSrc){
                var form = document.createElement('form');
                form.setAttribute('method', 'POST');
                form.setAttribute('action', 'productTrend.php');

                var productIdInput = document.createElement('input');
                productIdInput.setAttribute('type', 'hidden');
                productIdInput.setAttribute('name', 'productId');
                productIdInput.setAttribute('value', productId);

                var imageInput = document.createElement('input');
                imageInput.setAttribute('type', 'hidden');
                imageInput.setAttribute('name', 'imageSrc');
                imageInput.setAttribute('value', imageSrc);

                var itemInput = document.createElement('input');
                itemInput.setAttribute('type', 'hidden');
                itemInput.setAttribute('name', 'itemName');
                itemInput.setAttribute('value', itemName);

                form.appendChild(productIdInput);
                form.appendChild(imageInput);
                form.appendChild(itemInput);

                document.body.appendChild(form);
                form.submit();
                
            }


        function unFavourite(productId) {
            $.ajax({
                url: 'PHP/remove_from_favourites.php',
                method: 'POST',
                data: {
                    productId: productId
                },
                success: function(response) {
                    console.log('PHP script executed successfully');
                    console.log('Response:', response);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error executing PHP script:', error);
                }
            });
        }

        function fav(productId, itemId, storeId) {
            $.ajax({
                url: 'PHP/add_favourites.php',
                method: 'POST',
                data: {productId: productId, itemId: itemId, storeId: storeId},
                success: function(response) {
                    console.log('PHP script executed successfully');
                    console.log('Response:', response);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error executing PHP script:', error);
                }
            });
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
        <form id="search-form" method="post" action="search-login.php" >
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
            <a type="button" id="account-nav-link" href="account.php">ACCOUNT</a>
        </div>

        </p>
    </div>
</header>

<body>
    <div id="favourite-page-title">
        <?php
        session_start();
        $userId = $_SESSION["userId"];
        $conn = db_connect();
        $sql = "SELECT firstName FROM user WHERE userId =" . $userId;
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        $result->close();
        db_disconnect($conn);
        $name = strtoupper($user["firstName"]);

        echo "<h1>" . $name . "'S FAVOURITES</h1>";
        ?>
    </div>
    <div id="main">
        <div id="item-group">
            <div id="item-shelf">
                <?php
                $conn = db_connect();

                $sql = "SELECT F.productId, MAX(G.groceryItemName) AS itemName, G.groceryItemImage FROM favourite AS F JOIN groceryItems AS G ON F.productId = G.productId WHERE F.userId = '$userId' GROUP BY productId";
                $results = $conn->query($sql);

                $i = 0;
                while ($row = $results->fetch_assoc()) {
                    $i += 1;
                    $productId = $row["productId"];
                    $groceryItemName = $row["itemName"];
                    $groceryItemImage = $row["groceryItemImage"];
                    $sql2 = "SELECT G.groceryStoreName FROM groceryItems AS GI JOIN groceryStore AS G ON GI.storeId = G.groceryStoreId WHERE GI.productId = '$productId' AND GI.currentPrice = (SELECT MIN(currentPrice) FROM groceryItems WHERE productId = '$productId')";
                    $results2 = $conn->query($sql2);
                    $row2 = $results2->fetch_assoc();
                    $cheapestStore = $row2["groceryStoreName"];
                    echo "<div class=\"item\">
                                    <div class=\"favourite-icon\" onClick=\"return unFavourite('" . $productId . "')\">
                                        <i class=\"bi-heart-fill\"></i>
                                    </div>
                                    <div class =\"item-center-image\" onClick=\"popUpItem('" . $productId . "', '" . $groceryItemName . "', '" . $groceryItemImage . "')\">
                                        <img id=\"img" . $i . "\" class=\"item-image\" src=\"" . $groceryItemImage . "\">
                                    </div>
                                    <div class=\"title-click\" onClick=\"popUpItem('" . $productId . "', '" . $groceryItemName . "', '" . $groceryItemImage . "')\">
                                        <h3 id=\"item" . $i . "\"class=\"item-name\"> " . $groceryItemName . "</h3>
                                        <h5 class=\"item-price\"><b class=\"greentext\">Lowest price at: </b>" . $cheapestStore . "</h5>
                                    </div>
                                </div>";
                }
                db_disconnect($conn);
                ?>
            </div>
            <div id="item-shelf-trends">
                <div id="trending-title">
                    <h2>TRENDING ITEMS</h2>
                </div>
                <?php
                $conn = db_connect();
                $sql = "SELECT F.productId, G.groceryItemId, MAX(G.groceryItemName) AS itemName, G.groceryItemImage FROM favourite AS F JOIN groceryItems AS G ON F.productId = G.productId WHERE F.userId <> '$userId' GROUP BY productId";
                $results = $conn->query($sql);
                $i = 0;
                while ($row = $results->fetch_assoc()) {
                    $i++;
                    $itemId = $row["groceryItemId"];
                    $productId = $row["productId"];
                    $groceryItemName = $row["itemName"];
                    $groceryItemImage = $row["groceryItemImage"];
                    $sql2 = "SELECT G.groceryStoreName FROM groceryItems AS GI JOIN groceryStore AS G ON GI.storeId = G.groceryStoreId WHERE GI.productId = '$productId' AND GI.currentPrice = (SELECT MIN(currentPrice) FROM groceryItems WHERE productId = '$productId')";
                    $results2 = $conn->query($sql2);
                    $row2 = $results2->fetch_assoc();
                    $cheapestStore = $row2["groceryStoreName"];

                    echo "<div class=\"item\">
                                    <div class=\"favourite-icon-unfill\" onClick=\"return fav('" . $productId . "', '" . $itemId . "', '" . $storeId . "')\">
                                        <i class=\"bi-heart\"></i>
                                    </div>
                                    <div class =\"item-center-image\" onClick=\"popUpItem('" . $productId . "', '" . $groceryItemName . "', '" . $groceryItemImage . "')\">
                                        <img id=\"img" . $i . "\" class=\"item-image\" src=\"" . $groceryItemImage . "\">
                                    </div>
                                    <div class=\"title-click\" onClick=\"popUpItem('" . $productId . "', '" . $groceryItemName . "', '" . $groceryItemImage . "')\">
                                        <h3 id=\"item" . $i . "\"class=\"item-name\"> " . $groceryItemName . "</h3>
                                        <h5 class=\"item-price\"><b class=\"greentext\">Lowest price at: </b>" . $cheapestStore . "</h5>
                                    </div>
                                </div>";
                }
                ?>

                
                <?php              
                db_disconnect($conn);
                ?>
            </div>
        </div>
    </div>
</body>
<footer>

</footer>

</html>