<?php

    session_start();

    if(isset($_SESSION['id']) && isset($_GET['listingid'])){
        require_once "../include/dbHandler.inc.php";

        $delete = "DELETE FROM listings WHERE listing_id=? AND userid=?;";
        $stmt = $db->prepare($delete);
        $stmt->execute(array($_GET['listingid'],$_SESSION['id']));
        $stmt=null;

        header('location: ../my_listings.php');

    }else {
        header('location: ../index.php');
    }