<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/product-style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script>  
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
                        include "PHP/db_connect.php";
                        session_start();
                        $userId = $_SESSION["userId"];

                        $conn = db_connect();

                        if (isset($_POST['search-bar'])) {
                            $searchKeyword = $_POST['search-bar'];
                            $stmt = $conn->prepare("SELECT * FROM groceryItems WHERE groceryItemName LIKE ?");
                            $stmt->bind_param("s", $searchKeywordParam);

                            $searchKeywordParam = "%$searchKeyword%";
                            $stmt->execute();

                            $result = $stmt->get_result();

                            $twoDArray = [];

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $twoDArray[] = [$row["productId"], $row["groceryItemName"], $row["currentPrice"], $row["groceryItemImage"], $row["priceDate"], $row["storeID"]];
                                }

                                usort($twoDArray, function($a, $b) {
                                    return $a[3] <=> $b[3];
                                });
                                $i = 0;
                                $stmt->close();
                                foreach ($twoDArray as $product) {
                                    $i += 1;
                                    $sql = "SELECT groceryStoreName FROM groceryStore WHERE groceryStoreID ='$product[5]'";
                                    $storeResult = $conn->query($sql);
                                    $temp = $storeResult->fetch_assoc();
                                    $store = $temp["groceryStoreName"];
                                    $storeResult->close();
                                    echo "<div class=\"item\">
                                        <div class =\"item-center-image\">
                                            <img id=\"img".$i."\" class=\"item-image\" src=\"".$product[3]."\">
                                        </div>
                                        <div class=\"title-click\">
                                            <h3 id=\"item".$i."\"class=\"item-name\"> ".$product[1]."</h3>
                                            <h5 class=\"item-price\"><b class=\"greentext\">Price at ".$store.": </b>$".$product[2]."</h5>
                                        </div>
                                    </div>";
                                }
                            } else {
                                echo "No products found.";
                            }

                            
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