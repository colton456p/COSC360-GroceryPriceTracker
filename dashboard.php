<!DOCTYPE html>
<html lang="en">

<head>
    <title>Favourites</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
function popUpItem(groceryItemId, itemName, imageSrc) {
    // Construct the URL with query parameters
    var url = 'productTrend.php?itemId=' + encodeURIComponent(groceryItemId) + '&itemName=' + encodeURIComponent(itemName) + '&imageSrc=' + encodeURIComponent(imageSrc);

    // Redirect to the productTrend page
    window.location.href = url;
}


        function unFavourite(itemId) {
            console.log('Removing item from favourites:', itemId);
            $.ajax({
                url: 'PHP/remove_from_favourites.php',
                method: 'POST',
                data: {
                    itemId: itemId
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
        $servername = "localhost";
        $username = "root";
        $dbPass = "";
        $database = "db_38885190";

        $conn = new mysqli($servername, $username, $dbPass, $database);
        $sql = "SELECT firstName FROM user WHERE userId =" . $userId;
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        $result->close();
        $name = strtoupper($user["firstName"]);

        echo "<h1>" . $name . "'S FAVOURITES</h1>";
        ?>
    </div>
    <div id="main">
        <div id="item-group">
            <div id="item-shelf">
                <?php
                $servername = "localhost";
                $username = "root";
                $dbPass = "";
                $database = "db_38885190";

                $conn = new mysqli($servername, $username, $dbPass, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT F.itemId, G.groceryItemName, G.groceryItemImage, F.storeId FROM favourite AS F JOIN groceryItems AS G ON F.itemId = G.groceryItemId WHERE F.userId ='$userId'";

                $results = $conn->query($sql);

                $i = 0;
                while ($row = $results->fetch_assoc()) {
                    $i += 1;
                    $itemId = $row["itemId"];
                    $groceryItemName = $row["groceryItemName"];
                    $groceryItemImage = $row["groceryItemImage"];
                    $cheapestStore = "Walmart";
                    echo "<div class=\"item\">
                                    <div class=\"favourite-icon\" onClick=\"return unFavourite('" . $itemId . "')\">
                                        <i class=\"bi-heart-fill\"></i>
                                    </div>
                                    <div class =\"item-center-image\" onClick=\"popUpItem('" . $itemId . "', '" . $groceryItemName . "', '" . $groceryItemImage . "')\">
                                        <img id=\"img" . $i . "\" class=\"item-image\" src=\"" . $groceryItemImage . "\">
                                    </div>
                                    <div class=\"title-click\" onClick=\"popUpItem('" . $itemId . "', '" . $groceryItemName . "', '" . $groceryItemImage . "')\">
                                        <h3 id=\"item" . $i . "\"class=\"item-name\"> " . $groceryItemName . "</h3>
                                        <h5 class=\"item-price\"><b class=\"greentext\">Lowest price at: </b>" . $cheapestStore . "</h5>
                                    </div>
                                </div>";
                }
                $conn->close();
                ?>
            </div>
            <div id="item-shelf-trends">
                <div id="trending-title">
                    <h2>TRENDING ITEMS</h2>
                </div>
                <?php
                $servername = "localhost";
                $username = "root";
                $dbPass = "";
                $database = "db_38885190";

                $conn = new mysqli($servername, $username, $dbPass, $database);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT F.itemId, G.groceryItemId, G.groceryItemName, G.groceryItemImage, F.storeId FROM favourite AS F JOIN groceryItems AS G ON F.itemId = G.groceryItemId WHERE F.userId <> '$userId'";

                $results = $conn->query($sql);
                $i = 0;
                while ($row = $results->fetch_assoc()) {
                    $i++;
                    $groceryItemId = $row["groceryItemId"];
                    $itemId = $row["itemId"];
                    $groceryItemName = $row["groceryItemName"];
                    $groceryItemImage = $row["groceryItemImage"];
                    $storeId = $row["storeId"];
                    $cheapestStore = "Walmart";
                ?>
                
                <div class="item">
                    <div class="favourite-icon-unfill" onclick="fav('<?php echo $itemId; ?>','<?php echo $groceryItemId; ?>','<?php echo $storeId; ?>')">
                        <i class="bi-heart"></i>
                    </div>
                    <div class="item-center-image" onclick="popUpItem('<?php echo $groceryItemId; ?>', '<?php echo $groceryItemName; ?>', '<?php echo $groceryItemImage; ?>')">
                        <img id="img<?php echo $i; ?>" class="item-image" src="<?php echo $groceryItemImage; ?>">
                    </div>
                    <div class="title-click" onclick="popUpItem('<?php echo $groceryItemId; ?>', '<?php echo $groceryItemName; ?>', '<?php echo $groceryItemImage; ?>')">
                        <h3 id="item<?php echo $i; ?>" class="item-name"><?php echo $groceryItemName; ?></h3>
                        <h5 class="item-price"><b class="greentext">Lowest price at: </b><?php echo $cheapestStore; ?></h5>
                    </div>
                </div>
                
                <?php
                }                
                $conn->close();

                ?>
            </div>
        </div>
    </div>
</body>
<footer>

</footer>

</html>