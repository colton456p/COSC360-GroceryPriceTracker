<?php
    include 'removeFavourite.php';

    if (isset($_POST['itemId'])) {
        removeFromFavorites($_POST['itemId']);
    }
?>