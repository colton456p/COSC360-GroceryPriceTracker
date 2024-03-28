<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "38885190";
    $dbPass = "38885190";
    $database = "db_38885190";
    
    $conn = new mysqli($servername, $username, $dbPass, $database);
    $sql = "SELECT userId, adminPriv FROM user WHERE email = '$email' AND pass = '$password'";
    if ($conn->connect_error) {
        header("Location: ../signup.php?signup=failed");
        exit();
    }
    $result = $conn->query($sql);
    
    if ($result->num_rows < 1) {
        header("Location: ../login.php?login=failed");
        exit();
    }else{
        $row = $result->fetch_assoc();
        session_start();
        $adminPriv = $row["adminPriv"];
        if ($adminPriv == 1) {
            $_SESSION["adminPriv"] = $adminPriv;
        }
        $_SESSION["userId"] = $row["userId"];
        header("Location: ../dashboard.php");
        exit();
    }
}

?>