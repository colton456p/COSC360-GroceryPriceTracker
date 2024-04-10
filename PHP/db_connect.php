<?php
function db_connect(){
    //For local db connection
    // $servername = "localhost";
    // $username = "webuser";
    // $dbPass = "P@ssw0rd";
    // $database = "db_38885190";

    //For server db connection
    $servername = "localhost";
    $username = "38885190";
    $dbPass = "38885190";
    $database = "db_38885190";

    $conn = new mysqli($servername, $username, $dbPass, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function db_disconnect($conn){
    $conn->close();
}
?>