<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="css/signup.css">
        <script>
            function validateInput(){
                document.getElementById("failedSignup").hidden = true;
                document.getElementById("failedEmail").hidden = true;
                let counter = 0;
                var fname = document.getElementById("first-name").value;
                var lname = document.getElementById("last-name").value;
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                var password2 = document.getElementById("password2").value;

                if (fname.trim() == ""){
                    counter++;
                    document.getElementById("firstname-warning").hidden = false;
                }else{
                    document.getElementById("firstname-warning").hidden = true;
                }
                if (lname.trim() == ""){
                    counter++;
                    document.getElementById("lastname-warning").hidden = false;
                }else{
                    document.getElementById("lastname-warning").hidden = true;
                }
                if (email.trim() =="" || !email.includes("@") || !email.includes(".")){
                    counter++;
                    document.getElementById("email-warning").hidden = false;
                }else{
                    document.getElementById("email-warning").hidden = true;
                }
                if (password.trim().length < 7){
                    counter++;
                    document.getElementById("pass-warning").hidden = false;
                }
                else{
                    document.getElementById("pass-warning").hidden = true;
                }
                if (password != password2 || password2.trim() == ""){
                    counter++;
                    document.getElementById("pass2-warning").hidden = false;
                }
                else{
                    document.getElementById("pass2-warning").hidden = true;
                }
                if (counter > 0){
                    return false;
                }else{
                    return true;
                }   
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
                    <a type="button" id="product-nav-link" href="priceTrends.php">PRODUCTS</a>
                </div>
                <div class="nav-element">
                    <a type="button"id="login-nav-link" href="login.php">LOGIN</a>
                </div>
            </p>
        </div>
    </header>

    <body>
        <div id="signup-div">
            <h2>SIGN UP</h2>
            <?php 
                if (isset($_GET['signup']) && $_GET['signup'] === "failed") {
                    echo '<p id="failedSignup" class="warning">Something went wrong</p>';
                }else{
                    echo "<p id=\"failedSignup\" class=\"warning\" style=\"text-decoration:none\" hidden>Something went wrong</p>";
                }

                if (isset($_GET['emailFail']) && $_GET['emailFail'] === "failed") {
                    echo '<p id="failedEmail" class="warning">An account with this email already exists</p>';
                }else{
                    echo "<p id=\"failedEmail\" class=\"warning\" style=\"text-decoration:none\" hidden>An account with this email already exists</p>";
                }
            ?>
            <form onsubmit="return validateInput()" action="PHP/signup-backend.php" method="POST">
                <div class="signup-text">
                    <label for="first-name">First Name</label>
                    <p class="warning" id="firstname-warning" hidden>**Do not leave blank**</p>
                </div>
                <input type="text" id="first-name" name="first-name">

                <div class="signup-text">
                    <label for="last-name">Last Name</label>
                    <p class="warning" id="lastname-warning" hidden>**Do not leave blank**</p>
                </div>
                <input type="text" id="last-name" name="last-name">
                
                <div class="signup-text">
                    <label for="email">Email</label>
                    <p class="warning" id="email-warning" hidden>**Invalid email address**</p>
                </div>
                <input type="email" id="email" name="email">
                
                <div class="signup-text">
                    <label for="password">Password</label>
                    <p class="warning" id="pass-warning" hidden>**Password must be atleast 7 characters long**</p>
                </div>
                <input type="password" id="password" name="password">

                <div class="signup-text">
                    <label for="password2">Retype Password</label>
                    <p class="warning" id="pass2-warning" hidden>**Passwords do not match**</p>
                </div>
                <input type="password" id="password2" name="password2">
                
                <div id="button-center">
                    <button type="submit">Create Account</button>
                </div>
            </form>
        </div>
    </body>
</html>
