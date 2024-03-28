

<!DOCTYPE html>
<html lang="en">
<?php
session_start();

// Include connection.php or ensure that the PDO connection is established here
include 'PHP/connection.php'; // Adjust the path if necessary
include('PHP/displayComments.php');



// Retrieve the data sent via GET
$itemId = $_GET['itemId'];
$itemName = $_GET['itemName'];
$imageSrc = $_GET['imageSrc'];

// Proceed with processing the data
// Your code logic goes here
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/comments.css" />
    <link rel="stylesheet" href="css/productTrend-style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <title>Product Trend</title>
    <script>
        function backButton() {
            window.history.back();
        }
        $(document).ready(function() {
            console.log("Document ready, loading comments...");
            loadMoreComments();

            setInterval(function() {
                loadMoreComments();
            }, 1000);
        });

        function loadMoreComments() {
            console.log("Loading more comments...");
            $.ajax({
                url: "PHP/displayComments.php",
                type: "GET",
                data: {
                    itemId: <?php echo $_GET['itemId']; ?>
                },
                dataType: "html",
                success: function(response) {
                    console.log("Received response:", response);
                    $('#displayComments').html(response); 
                },
                error: function(xhr, status, error) {
                    console.error("Failed to load comments:", error);
                    $("#displayComments").html("<p>Error loading comments.</p>");
                }
            });
        }



        $(document).ready(function() {
            $('#commentForm').on("submit", function(event) {
                event.preventDefault(); 
                $.ajax({
                    type: "POST",
                    url: "PHP/addComment.php",
                    data: $(this).serialize(),
                }).done(function(response) {
                    if (response.success) {
                        $('#commentText').val('');

                        var newCommentHtml = "<div class='comment'>" +
                            "<p><strong>User: </strong>" + response.firstName + "</p>" +
                            "<p>" + response.commentText + "</p>" +
                            "</div>";
                        $('#displayComments').prepend(newCommentHtml);
                    } else {
                        alert("Failed to submit comment: " + response.message);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX call failed:", textStatus, errorThrown);
                });
            });
        });
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
    <input type="hidden" id="productName" value="<?php echo isset($itemName) ? htmlspecialchars($itemName) : ''; ?>">
    <div id="centerContent">
        <div id="left">
            <?php
            echo "<img id=\"productImage\" src= $imageSrc alt=\"product image\">";
            ?>
        </div>
        <div id="right">
            <div id="image_bubbles">
                <div class="storePrice">
                    <img class="logobubble" src="img/saveon-logo.png" alt="SaveOn Logo">
                    <h1 class="price">Save On Foods </h1>
                    <h1 class="greentext">$10.00</h1>
                </div>
                <div class="storePrice">
                    <img class="logobubble" src="img/walmart-logo.jpg" alt="Walmart Logo">
                    <h1 class="price">Walmart </h1>
                    <h1 class="greentext">$10.00</h1>
                </div>
                <div class="storePrice">
                    <img class="logobubble" src="img/safewaylogo.png" alt="Safeway Logo">
                    <h1 class="price">Safeway</h1>
                    <h1 class="greentext">$10.00</h1>
                </div>
                <div class="storePrice">
                    <img class="logobubble" src="img/maxi-logo.png" alt="Maxi Logo">
                    <h1 class="price">Maxi </h1>
                    <h1 class="greentext">$10.00</h1>
                </div>
                <div class="storePrice">
                    <img class="logobubble" src="img/pclogo.png" alt="Presidents Choice Logo">
                    <h1 class="price">Superstore </h1>
                    <h1 class="greentext">$10.00</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="trends">
        <h1>PRICE TRENDS</h1>
        <div id="trendGraph">
            <img src="img/fakeDemoGraph.jpg" alt="trend graph">
        </div>
        <div id="commentsSection">
            <div id="commentBox">
                <h2>Leave a Comment</h2>
                <form id="commentForm" action="PHP/addComment.php" method="POST">
                    <input type="hidden" name="itemId" value="<?php echo $itemId; ?>">
                    <textarea name="commentText" id="commentText" rows="4" placeholder="Write your comment here..." required></textarea>
                    <input type="submit" value="Submit Comment" id="submitComment">
                </form>
            </div>
            <div id="displayComments">
            </div>
        </div>
    </div>
</body>

</html>