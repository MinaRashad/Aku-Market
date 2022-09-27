<?php

    session_start();

    if (isset($_POST['sbmt_btn'])) {
        try {
            $title = $_POST['title'];
            $price = (float) $_POST['price'];
            $token = $_POST['token'];
            $category = $_POST['category'];
            $userid = $_SESSION['id'];
        } catch (\Throwable $th) {
            header('location: ../sell.php?error=unknown');
            exit();
        }
        
        require_once 'functions.inc.php';
        require_once 'dbHandler.inc.php';

        if(!isset($_SESSION['uid'])){
            header('location: ../sell.php?error=user Not Logged In');
            exit();
        }
        if(emptyInputs($title,$price,$token,$category) !== false){
            header('location: ../sell.php?error=Empty inputs');
            exit();
        }
        if($price <= 0){
            header('location: ../sell.php?error=invalid price');
            exit();
        }
        if(strlen($token)>=6){
            header('location: ../sell.php?error=invalid token');
            exit();
        }
        if(invalidcategory($category)){
            header('location: ../sell.php?error=invalid category');
            exit();
        }

        addlisting($db,$userid,$title,$price,$token,$category);



    }
    else{
       header('location: ../sell.php');
       exit();
    }   