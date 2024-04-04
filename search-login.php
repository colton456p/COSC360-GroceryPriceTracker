<?php
include "PHP/db_connect.php";
session_start();
if (isset($_POST['search-bar'])){
    $searchKeyword = $_POST['search-bar'];
}

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

            function fav(productId) {
                $.ajax({
                    url: 'PHP/add_favourites.php',
                    method: 'POST',
                    data: {productId: productId},
                    success: function(response) {
                        console.log('PHP script executed successfully');
                        console.log('Response:', response);
                        // window.location.reload();
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
                <h2 >Grocery</h2><h1 class="greentext">Sense</h1>
            </p>
        </div>
        <div id="header-search-div">
            <form id="search-form" action="search-login.php" method="post">
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
                        
                            $conn = db_connect();
                            $stmt = $conn->prepare("SELECT productId, MAX(groceryItemName) AS itemName, groceryItemImage FROM groceryItems WHERE groceryItemName LIKE ? GROUP BY productId");
                            $stmt->bind_param("s", $searchKeywordParam);

                            $searchKeywordParam = "%$searchKeyword%";
                            $stmt->execute();

                            $result = $stmt->get_result();

                            $twoDArray = [];

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $twoDArray[] = [$row["productId"], $row["itemName"], $row["groceryItemImage"]];
                                }

                                usort($twoDArray, function($a, $b) {
                                    return $a[3] <=> $b[3];
                                });
                                $i = 0;
                                $stmt->close();
                                foreach ($twoDArray as $product) {
                                    $i += 1;
                                    $productId = $product[0];
                                    $groceryItemName = $product[1];
                                    $groceryItemImage = $product[2];
                                    $sql2 = "SELECT G.groceryStoreName FROM groceryItems AS GI JOIN groceryStore AS G ON GI.storeId = G.groceryStoreId WHERE GI.productId = '$productId' AND GI.currentPrice = (SELECT MIN(currentPrice) FROM groceryItems WHERE productId = '$productId')";
                                    $results2 = $conn->query($sql2);
                                    $row2 = $results2->fetch_assoc();
                                    $cheapestStore = $row2["groceryStoreName"];

                                    echo "<div class=\"item\">
                                        <div class=\"favourite-icon-unfill\" onClick=\"return fav('" . $productId . "')\">
                                            <i class=\"bi-heart\"></i>
                                        </div>
                                        <div class =\"item-center-image\" onClick=\"popUpItem('" . $productId . "', '" . $groceryItemName . "', '" . $groceryItemImage . "')\">
                                            <img id=\"img" . $i . "\" class=\"item-image\" src=\"" . $groceryItemImage . "\">
                                        </div>
                                        <div class=\"title-click\" onClick=\"popUpItem('$productId', '$groceryItemName', '$groceryItemImage')\">
                                            <h3 id=\"item".$i."\" class=\"item-name\">$groceryItemName</h3>
                                            <h5 class=\"item-price\"><b class=\"greentext\">Lowest price at:</b> $cheapestStore</h5>
                                        </div>
                                    </div>";
                                }
                            } else {
                                echo "No products found.";
                            }


                        db_disconnect($conn);
                    ?>
                </div>
            </div>
        </div>
    </body>
    <footer>

    </footer>
</html>