
<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
$productId = $_POST['productId'];
$itemName = $_POST['itemName'];
$imageSrc = $_POST['imageSrc'];
$userId = $_SESSION['userId'];

include "PHP/db_connect.php";
if(!isset($_SESSION['userId']) && !isset($_SESSION['adminPriv'])){
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/productTrend-style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <title>Product Trend</title>
    <script>
        function backButton() {
            window.history.back();
        }
        
        $(document).ready(function() {
            function updateComments() {
                $.ajax({
                    url: 'PHP/submitComment.php',
                    type: 'POST',
                    data: $('#commentForm').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        var commentsHtml = '';
                        if (data.length < 1) {
                            commentsHtml = '<h3>No comments yet. Be the first to comment!</h3>';
                        }
                        for (var i = 0; i < data.length; i++) {
                            var cDate = data[i].cDate
                            cDate = cDate.slice(0, 10);
                            commentsHtml += '<div class="singleComment">';
                            commentsHtml += '<div class="leftComment">';
                            commentsHtml += '<h3>' + data[i].fName + '</h3>';
                            commentsHtml += '<p id="commentValue">' + data[i].cText + '</p>';
                            commentsHtml += '<p id="commentDate">Date: ' + cDate + '</p>';
                            commentsHtml += '</div>';
                            commentsHtml += '<div class="rightComment">';
                            commentsHtml += '<span class="tooltip-text">Report a Comment? &#8594;</span>';
                            commentsHtml += '<i class="bi bi-flag-fill"></i>';
                            commentsHtml += '</div>';
                            commentsHtml += '</div>';
                        }
                        $('#productComments').html(commentsHtml);
                        
                        $('#commentInput').val('');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        
            $('#commentForm').on("submit", function(event) {
                event.preventDefault(); 
                updateComments();
            });
        });


        $(document).ready(function() {
            function updateComments(productId) {
                $.ajax({
                    url: 'PHP/getComments.php',
                    type: 'POST',
                    data: { productId: productId },
                    dataType: 'json',
                    success: function(data) {
                        var commentsHtml = '';
                        if (data.length < 1) {
                            commentsHtml = '<h3>No comments yet. Be the first to comment!</h3>';
                        }
                        for (var i = 0; i < data.length; i++) {
                            commentsHtml += '<div class="singleComment">';
                            commentsHtml += '<div class="leftComment">';
                            commentsHtml += '<h3>' + data[i].fName + '</h3>';
                            commentsHtml += '<p id="commentValue">' + data[i].cText + '</p>';
                            commentsHtml += '<p id="commentDate">Date: ' + data[i].cDate.slice(0, 10) + '</p>';
                            commentsHtml += '</div>';
                            commentsHtml += '<div class="rightComment">';
                            commentsHtml += '<span class="tooltip-text">Report a Comment? &#8594;</span>';
                            commentsHtml += '<i class="bi bi-flag-fill"></i>';
                            commentsHtml += '</div>';
                            commentsHtml += '</div>';
                        }
                        $('#productComments').html(commentsHtml);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
            
            var productId = '<?php echo $productId; ?>';
            updateComments(productId);
            setInterval(function() {
                updateComments(productId);
            }, 2000);
        });

        function flag(commentId) {
            $.ajax({
                url: 'PHP/flagComment.php',
                type: 'POST',
                data: { commentId: commentId },
                success: function(response) {
                    console.log('PHP script executed successfully');
                    console.log('Response:', response);
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
    <div id="topBar">
        <div id="back-arrow" onclick="return backButton()">
            <i class="bi bi-arrow-left-circle-fill"> Back</i>
        </div>
    </div>
    <?php
        echo "<h1 id=\"productName\">".$itemName."</h1>";
    ?>
    <div id="centerContent">
        <div id="left">
            <?php
            echo "<img id=\"productImage\" src=\"".$imageSrc."\" alt=\"product image\">";
            $conn = db_connect();
            ?>
        </div>
        <div id="right">
            <div id="image_bubbles">
                <div class="storePrice">
                    <?php
                    $sql ="SELECT currentPrice FROM groceryItems WHERE productId ='$productId' AND storeID = 15";
                    $result = $conn->query($sql);
                    if ($result->num_rows < 1) {
                        $price = 'N/A';
                    }else{
                        $temp = $result->fetch_assoc();
                        $price = '$'.$temp['currentPrice'];
                        $result->close();
                    }
                    ?>
                    <img class="logobubble" src="img/saveon-logo.png" alt="SaveOn Logo">
                    <h1 class="price">Save On Foods </h1>
                    <h1 class="greentext"><?php echo $price;?></h1>
                </div>
                <div class="storePrice">
                    <?php
                    $sql ="SELECT currentPrice FROM groceryItems WHERE productId ='$productId' AND storeID = 12";
                    $result = $conn->query($sql);
                    if ($result->num_rows < 1) {
                        $price = 'N/A';
                    }else{
                        $temp = $result->fetch_assoc();
                        $price = '$'.$temp['currentPrice'];
                        $result->close();
                    }
                    ?>
                    <img class="logobubble" src="img/walmart-logo.jpg" alt="Walmart Logo">
                    <h1 class="price">Walmart </h1>
                    <h1 class="greentext"><?php echo $price;?></h1>
                </div>
                <div class="storePrice">
                    <?php
                    $sql ="SELECT currentPrice FROM groceryItems WHERE productId ='$productId' AND storeID = 14";
                    $result = $conn->query($sql);
                    if ($result->num_rows < 1) {
                        $price = 'N/A';
                    }else{
                        $temp = $result->fetch_assoc();
                        $price = '$'.$temp['currentPrice'];
                        $result->close();
                    }
                    ?>
                    <img class="logobubble" src="img/safewaylogo.png" alt="Safeway Logo">
                    <h1 class="price">Safeway</h1>
                    <h1 class="greentext"><?php echo $price;?></h1>
                </div>
                <div class="storePrice">
                    <?php
                    $sql ="SELECT currentPrice FROM groceryItems WHERE productId ='$productId' AND storeID = 16";
                    $result = $conn->query($sql);
                    if ($result->num_rows < 1) {
                        $priceMaxi = 'N/A';
                    }else{
                        $temp = $result->fetch_assoc();
                        $priceMaxi = '$'.$temp['currentPrice'];
                        $result->close();
                    }
                    ?>
                    <img class="logobubble" src="img/maxi-logo.png" alt="Maxi Logo">
                    <h1 class="price">Maxi </h1>
                    <h1 class="greentext"><?php echo $priceMaxi;?></h1>
                </div>
                <div class="storePrice">
                    <?php
                    $sql ="SELECT currentPrice FROM groceryItems WHERE productId ='$productId' AND storeID = 13";
                    $result = $conn->query($sql);
                    if ($result->num_rows < 1) {
                        $price = 'N/A';
                    }else{
                        $temp = $result->fetch_assoc();
                        $price = '$'.$temp['currentPrice'];
                        $result->close();
                    }
                    ?>
                    <img class="logobubble" src="img/pclogo.png" alt="Presidents Choice Logo">
                    <h1 class="price">Superstore </h1>
                    <h1 class="greentext"><?php echo $price;?></h1>
                </div>
            </div>
        </div>
    </div>
    <div id="trends">
        <h1>PRICE TRENDS</h1>
        <div id="trendGraph">
            <img src="img/fakeDemoGraph.jpg" alt="trend graph">
        </div>
    </div>
    <h1 id="commentTitle">COMMENTS</h1>
    <div id="comments">
        <div id="productComments">
            <?php
                $productId = $_POST['productId'];
                $conn = db_connect();
                $sql = "SELECT U.firstName AS fName, C.commentText AS cText, C.commentDate AS cDate, commentId FROM comments AS C JOIN user AS U ON U.userId = C.userId WHERE productId = '$productId' ORDER BY C.commentDate DESC";
                $result = $conn->query($sql);
                if ($result->num_rows < 1) {
                    echo "<h3>No comments yet. Be the first to comment!</h3>";
                }else{
                    while($temp = $result->fetch_assoc()){
                    $name = $temp["fName"];
                    $commentText = $temp["cText"];
                    $commentId = $temp["commentId"];
                    $cDate = $temp["cDate"];
                    $cDate = substr($cDate, 0, 10); 
                            echo "<div class=\"singleComment\">
                                    <div class=\"leftComment\">
                                        <h3>".$name."</h3>
                                        <p id=\"commentValue\">".$commentText."</p>
                                        <p id=\"commentDate\">Date: ".$cDate."</p>
                                    </div>
                                    <div class=\"rightComment\">
                                        <span class=\"tooltip-text\">Report a Comment? &#8594;</span>
                                        <i class=\"bi bi-flag-fill\" onClick=\" return flag('" . $commentId . "')\"></i>
                                    </div>
                                </div>";
                    }
                }
                db_disconnect($conn);
            ?>
                
        </div>
        <div id="addComment">
            <h2>Add a Comment</h2>
            <form id="commentForm" method="post" action="PHP/submitComment.php">
                <input type="text" id="commentInput" name="commentInput" placeholder="Add a comment...">
                <input type="hidden" id="userId" name="userId" value="<?php echo $userId;?>">
                <input type="hidden" id="productId" name="productId" value="<?php echo $productId;?>">
                <input type="submit" value="Post Comment" id="commentButton">
            </form>
        </div>
    </div>
</body>

</html>