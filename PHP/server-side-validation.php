<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "38885190";
    $dbPass = "38885190";
    $database = "db_38885190";

    $conn = new mysqli($servername, $username, $dbPass, $database);
    $sql = "SELECT userId FROM user WHERE email = '$email' AND pass = '$password'";
    if ($conn->connect_error) {
        header("Location: ../signup.php?signup=failed");
        exit();
    }
    if($conn->query($sql)===FALSE){
        header("Location: ../login.php?login=failed");
        exit();
    }
    else{
        $temp = "Location: ../dashboard.php?userId=".$userId;
        header($temp);
        exit();
    }
}

?>