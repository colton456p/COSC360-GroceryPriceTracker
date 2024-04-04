<?php
session_start();
$_SESSION["userId"] = "";
$_SESSION["adminPriv"] = "";
unset($_SESSION['userId']);
unset($_SESSION['adminPriv']);
$_SESSION = [];
session_destroy();
header("Location: ../homepage.php");
exit();
?>