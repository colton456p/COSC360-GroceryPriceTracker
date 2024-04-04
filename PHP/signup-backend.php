<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = md5($password);
    $
    $conn = db_connect();
    
    // $sql = "INSERT INTO user (firstName, lastName, email, pass, userImage) VALUES ('$firstName', '$lastName', '$email', '$hashed_password' , '$userImage')";
    $sql = "INSERT INTO user (firstName, lastName, email, pass) VALUES ('$firstName', '$lastName', '$email', '$hashed_password')";
    if($conn->query($sql)===FALSE){
            header("Location: ../signup.php?emailFail=failed");
            exit();
    }

    $sql = "SELECT userId FROM user WHERE email = '$email'";
    $result = $conn->query($sql);
    db_disconnect($conn);

    if ($result->num_rows < 1) {
        header("Location: ../signup.php?emailFail=failed");
        exit();
    }else{
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION["userId"] = $row["userId"];
        header("Location: ../dashboard.php");
        exit();
    }
}
?>