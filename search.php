<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script>
            function popUpItem(){
                
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
                    <a type="button" id="trend-nav-link" href="priceTrendsLogin.php">TRENDS</a>
                </div>
                <div class="nav-element">
                    <a type="button"id="account-nav-link" href="account.php">ACCOUNT</a>
                </div>

            </p>
        </div>
    </header>
    <body>
        <div id="main">
            <div id="item-group">
                <div id="item-shelf">
                <?php
            session_start();
            $userId = $_SESSION["userId"];
            $servername = "localhost";
            $username = "38885190";
            $dbPass = "38885190";
            $database = "db_38885190";

            $conn = new mysqli($servername, $username, $dbPass, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Handle search form submission
            if (isset($_POST['search-bar'])) {
                $searchKeyword = $_POST['search-bar'];
                // Prepare and bind parameters to avoid SQL injection
                $stmt = $conn->prepare("SELECT * FROM groceryItems WHERE groceryItemName LIKE ?");
                $stmt->bind_param("ss", $searchKeywordParam);

                // Set parameters and execute the statement
                $searchKeywordParam = "%$searchKeyword%";
                $stmt->execute();

                $result = $stmt->get_result();

                $twoDArray = []; // Initialize the 2D array

                if ($result->num_rows > 0) {
                    // Fetch data and store in the 2D array
                    while ($row = $result->fetch_assoc()) {
                        $twoDArray[] = [$row["productId"], $row["groceryItemName"], $row["currentPrice"], $row["groceryItemImage"], $row["priceDate"], $row["storeID"], $row["categoryId"]];
                    }

                    // Sort the 2D array based on product prices
                    usort($twoDArray, function($a, $b) {
                        return $a[3] <=> $b[3]; // Compare poduct prices
                    });

                    // Output the sorted 2D array
                    foreach ($twoDArray as $product) {
                        echo "<div class=\"item\" onclick=\"popUpItem()\">
                               r <div class =\"item-center-image\">
                                    <img id=\"img1\" class=\"item-image\" src=\"".$product[3]."\">
                                </div>
                                <h3 class=\"item-name\">".$product[1]."</h3>
                                <h5 class=\"item-price\">Price: $".$product[2]."</h5>
                            </div>";
                    }
                } else {
                    echo "No products found.";
                }

                $stmt->close();
            }

            $conn->close();
            ?>
                    <div id="popUpDiv" style="display:none;">
                    <div id="popUptopBar">
                        <div id="back-arrow">
                            <i  class="bi bi-arrow-left-circle-fill"> Back</i>
                        </div>
                    </div>
                    
                    <div id="popUpTitle">
                        <h1>Item name</h1>
                    </div>
                    <div id="popUpImageDiv">
                        <img id="popUpImage" src="img/potatoChips.png">
                    </div>
                    <div id="popUpDescription">
                        <h2>production Description</h2>
                        <p>This is where the description of the product will go. So many
                            things to say about this product and how it is the best thing
                            since sliced bread. 
                        </p>
                    </div>
                        
                </div>
                </div>
            </div>
        </div>
    </body>
    <footer>

    </footer>
</html>