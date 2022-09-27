<?php

    session_start();

    if (isset($_POST['sbmt_btn'])) {
        try {
            $title = $_POST['title'];
            $price = (float) $_POST['price'];
            $token = $_POST['token'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $userid = $_SESSION['id'];
            $listingid = $_POST['listingid'];
        } catch (\Throwable $th) {
            header('location: ../sell.php?error=unknown');
            exit();
        }
        
        require_once 'functions.inc.php';
        require_once 'dbHandler.inc.php';

        if(!isset($_SESSION['uid'])){
            header('location: ../listingaction/edit.php?listingid='.$listingid.'&error=userNotLoggedIn');
            exit();
        }
        if(emptyInputs($title,$price,$token,$category) !== false){
            header('location: ../listingaction/edit.php?listingid='.$listingid.'&error=Empty');
            exit();
        }
        if($price <= 0){
            header('location: ../listingaction/edit.php?listingid='.$listingid.'&error=InvalidPrice');
            exit();
        }
        if(strlen($token)>=6){
            header('location: ../listingaction/edit.php?listingid='.$listingid.'&error=Invalidtoken');
            exit();
        }
        if(invalidcategory($category)){
            header('location: ../listingaction/edit.php?listingid='.$listingid.'&error=Invalidcategory');
            exit();
        }

        updatelisting($db,$listingid,$title,$price,$token,$category,$description);



    }
    else{
       header('location: ../sell.php');
       exit();
    }   