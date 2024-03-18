<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <script>
            function popUpItem(){
                document.getElementById("popUpDiv").style.display = "block";
                var itemName = document.getElementsByClassName("item-name").textContent;
                document.getElementById("h1PopUpTitle").innerHTML = itemName;
                var itemDescription = document.getElementsByClassName("item-description").textContent;
                var imgTag = document.getElementsById("img1").src;
                document.getElementById("popUpImage").src = imgTag;
            }

            function backButton(){
                document.getElementById("popUpDiv").style.display = "none";
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
        <div id="favourite-page-title">
            <?php
                session_start();    
                $userId = $_SESSION["userId"];
                $servername = "localhost";
                $username = "38885190";
                $dbPass = "38885190";
                $database = "db_38885190";
        
                $conn = new mysqli($servername, $username, $dbPass, $database);
                $sql = "SELECT firstName FROM user WHERE userId =".$userId;
                $result = $conn->query($sql);
                $user = $result->fetch_assoc();    
                $result->close();
                $name = strtoupper($user["firstName"]);

                echo "<h1>".$name."'S FAVOURITES</h1>";
            ?>
        </div>
        <div id="main">
            <div id="item-group">
                <div id="item-shelf">
                    <?php
                        $twoDArray = array(
                            array("Lays Chips", "img/potatoChips.png"),
                            array("Corona Extra", "img/corona.png",),
                            array("Gala Apples", "img/gala-apples.png"),
                            array("Gatorade 355mL", "img/gatorade.png"),
                            array("White Rice", "img/rice.png"),
                            array("Mi Goreng Noodles", "img/mi-goreng.png"),
                            array("Tostitos Salsa", "img/salsa.png"),
                            array("Eggs", "img/eggs.png")
                        );

                        for ($i = 0; $i < count($twoDArray); $i++) {
                            echo "<div class=\"item\" onclick=\"popUpItem()\">
                                    <div class =\"item-center-image\">
                                        <img id=\"img1\" class=\"item-image\" src=\"".$twoDArray[$i][1]."\">
                                    </div>
                                    <h3 class=\"item-name\">".$twoDArray[$i][0]."</h3>
                                    <p class=\"item-description\">This is where the description of the product will go</p>
                                    <h5 class=\"item-price\">Cheapest at:</h5>
                                </div>";
                        }
                    ?>
                    <div id="popUpDiv" style="display:none;">
                    <div id="popUptopBar">
                        <div id="back-arrow" onclick="return backButton()">
                            <i  class="bi bi-arrow-left-circle-fill"> Back</i>
                        </div>
                    </div>
                    
                    <div id="popUpTitle">
                        <h1 id=h1PopUpTitle></h1>
                    </div>
                    <div id="popUpImageDiv">
                        <img id="popUpImage" src="">
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