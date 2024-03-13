<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (strtolower($email) ==="colton.p@hotmail.com" && $password === "password"){
        header("Location: ../dashboard.php");
        exit();
    }
    else{
        header("Location: ../login.php?login=failed");
        exit();
    }
}
?>