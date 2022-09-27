<?php

    if (isset($_POST['sbmt_btn'])) {
        $uid = $_POST['uid'];
        $pwd = $_POST['password'];

        require_once 'dbHandler.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputs($uid,true,$pwd,true) !== false){
            header('location: ../login.php?error=emptyInputs');
            exit();
        }
        
        print_r(loginUser($db,$uid,$pwd));

    }
    else{
       header('location: ../login.php');
       exit();
    }   