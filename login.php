<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/login-style.css">
    <title>Login</title>
    <script>
        function validateInput(){
            document.getElementById("failedLogin").hidden = true;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            if (email.trim() =="" || !email.includes("@") || !email.includes(".")){
                document.getElementById("email-warning").hidden = false;
                if (password.trim() == ""){
                    document.getElementById("password-warning").hidden = false;
                }
                else{
                    document.getElementById("password-warning").hidden = true;
                }
                return false;
            }else{
                document.getElementById("email-warning").hidden = true;
            }
            if (password.trim() == ""){
                document.getElementById("password-warning").hidden = false;
                return false;
            }
            else{
                document.getElementById("password-warning").hidden = true;
            }
            
            return true;    
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
        <form id="search-form" action="">
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
                <a type="button" id="pricetrend-nav-link" href="priceTrends.php">TRENDS</a>
            </div>
            <div class="nav-element">
                <a type="button"id="login-nav-link" href="login.php">LOGIN</a>
            </div>
        </p>
    </div>
</header>
<body>
    <div id="main">
        <div id="signup-section">
            <h2>Don't have an account yet? <a type="button" id="signup-link" href="signup.php">SIGN UP NOW!</a></h2>
        </div>
        <div id="login-div">
            <h2>LOGIN</h2>
            <?php 
                if (isset($_GET['login']) && $_GET['login'] === "failed") {
                    echo '<p id="failedLogin" class="warning">Incorrect email or password</p>';
                }else{
                    echo "<p id=\"failedLogin\" class=\"warning\" style=\"text-decoration:none\" hidden>Incorrect email or password</p>";
                }
            ?>
            <form id="loginForm" method="post" action="PHP/server-side-validation.php" onsubmit="return validateInput()" >
                <div class="login-message">
                    <label for="email">Email:</label>
                    <p id="email-warning" class="warning" hidden>Invalid email address!</p>
                </div>
                <input type="text" id="email" name="email" placeholder="Ex: John_doe@email.com">
                
                <div class="login-message">
                    <label for="password">Password: </label>
                    <p id="password-warning" class="warning" hidden>Please enter a password!</p>
                </div>
                <input type="password" id="password" name="password" placeholder="Enter password...">
                <div id="button-center">
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
<footer>
    <p></p>
</footer>
</html>
