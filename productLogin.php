<!-- I know the name is a bit confusing but this is the product page that is displayed for when a user is logged in -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/product-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>All products (logged in user)</title>

        <script>
            function popUpItem(itemId, itemName, imageSrc){
                var form = document.createElement('form');
                form.setAttribute('method', 'POST');
                form.setAttribute('action', 'productTrend.php');

                var imageInput = document.createElement('input');
                itemInput.setAttribute('type', 'hidden');
                itemInput.setAttribute('name', 'itemId');
                itemInput.setAttribute('value', itemId);

                var imageInput = document.createElement('input');
                imageInput.setAttribute('type', 'hidden');
                imageInput.setAttribute('name', 'imageSrc');
                imageInput.setAttribute('value', imageSrc);

                var itemInput = document.createElement('input');
                inputName.setAttribute('type', 'hidden');
                inputName.setAttribute('name', 'itemName');
                inputName.setAttribute('value', itemName);

                form.appendChild(imageInput);
                form.appendChild(itemInput);
                form.appendChild(inputName);

                document.body.appendChild(form);

                form.submit();
                
            }
                
        </script>

</head>
<header>
    <div id="site_logo">
        <p>
            <img id="logo_img" src="img/grocery_logo.png" alt="logo">
            <h2>Grocery</h2><h1 class="greentext">Sense</h1>
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
                    $servername = "localhost";
                    $username = "38885190";
                    $dbPass = "38885190";
                    $database = "db_38885190";
                    
                    $conn = new mysqli($servername, $username, $dbPass, $database);
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    $sql ="SELECT productId, MAX(groceryItemName) AS groceryItemName, MAX(groceryItemImage) AS groceryItemImage FROM groceryItems GROUP BY productId";


                    $results = $conn->query($sql);

                    $i = 0;
                    while ($row = $results->fetch_assoc()){
                        $i+=1;
                        $productId = $row["productId"];
                        $groceryItemName = $row["groceryItemName"];
                        $groceryItemImage = $row["groceryItemImage"];
                        $cheapestStore = "Walmart";
                        echo "<div class=\"item\">
                                <div class=\"favourite-icon-unfill\">
                                    <i class=\"bi-heart\"></i>
                                </div>
                                <div class =\"item-center-image\" onClick=\"popUpItem('".$productId."', '".$groceryItemName."', '".$groceryItemImage."')\">
                                    <img id=\"img".$i."\" class=\"item-image\" src=\"".$groceryItemImage."\">
                                </div>
                                <div class=\"title-click\" onClick=\"popUpItem('".$productId."', '".$groceryItemName."', '".$groceryItemImage."')\">
                                    <h3 id=\"item".$i."\"class=\"item-name\"> ".$groceryItemName."</h3>
                                    <h5 class=\"item-price\"><b class=\"greentext\">Lowest price at: </b>".$cheapestStore."</h5>
                                </div>
                            </div>";
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
