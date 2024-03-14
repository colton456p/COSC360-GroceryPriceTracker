<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $servername = "localhost";
    $username = "38885190";
    $dbPass = "38885190";
    $database = "db_38885190";

    $conn = new mysqli($servername, $username, $dbPass, $database);
    if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
        header("Location: ../signup.php?signup=failed");
        exit();
    }

    $sql = "INSERT INTO user (firstName, lastName, email, pass) VALUES ('$firstName', '$lastName', '$email', '$password')";
    if($conn->query($sql)===FALSE){
            header("Location: ../signup.php?emailFail=failed");
            exit();
    }

    $conn->close();
    header("Location: ../dashboard.php?userId=$userId");
    exit();
}
?>