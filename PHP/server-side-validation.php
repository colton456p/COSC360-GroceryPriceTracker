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
    $result = $conn->query($sql);
    
    if ($result->num_rows < 1) {
        $sql = "SELECT adminId FROM adminTable WHERE email = '$email' AND pass = '$password'";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows < 1) {
            header("Location: ../login.php?login=failed");
            exit();
        }else{
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION["adminId"] = $row["adminId"];
            header("Location: ../admin.php");
            exit();
        }
        
    }else{
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION["userId"] = $row["userId"];
        header("Location: ../dashboard.php");
        exit();
    }
}

?>