<?php
include "db_connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = md5($password);

    $conn = db_connect();
    $sql = "SELECT userId, adminPriv FROM user WHERE email = '$email' AND pass = '$hashed_password'";
    if ($conn->connect_error) {
        header("Location: ../signup.php?signup=failed");
        exit();
    }
    $result = $conn->query($sql);
    
    if ($result->num_rows < 1) {
        db_disconnect($conn);
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
        db_disconnect($conn);
        header("Location: ../dashboard.php");
        exit();
    }
    
}

?>