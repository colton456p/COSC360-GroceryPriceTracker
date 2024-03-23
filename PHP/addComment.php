<?php
$userId = $_SESSION["userId"];
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $commentInput = $_POST['commentInput'];

    $servername = "localhost";
    $username = "38885190";
    $dbPass = "38885190";
    $database = "db_38885190";

    $conn = new mysqli($servername, $username, $dbPass, $database);
    
    if ($conn->connect_error) {
        header("Location: ../productTrend.php");
        exit();
    }
    $sql ="INSERT INTO comment (userId, commentText) VALUES ('$userId', '$commentInput')";
    if($conn->query($sql)===FALSE){
        header("Location: ../signup.php?emailFail=failed");
        exit();
    }
}

?>