<?php

    if (isset($_POST['sbmt_btn'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $repwd = $_POST['repassword'];

        require_once 'dbHandler.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputs($username,$email,$pwd,$repwd) !== false){
            header('location: ../signup.php?error=emptyInputs');
            exit();
        }
        if(invalidUsername($username) !== false){
            header('location: ../signup.php?error=invalidUsername');
            exit();
        }
        if(invalidEmail($email) !== false){
            header('location: ../signup.php?error=invalidEmail');
            exit();
        }
        if($pwd !== $repwd){
            header('location: ../signup.php?error=PasswordMatch');
            exit();
        }
        if(userNameExists($db,$username)){
            header('location: ../signup.php?error=usernameExists');
            exit();
        }
        if(emailExists($db,$email)){
            header('location: ../signup.php?error=emailExists');
            exit();
        }
        createUser($db,$username,$email,$pwd);
    }
    else{
       header('location: ../signup.php');
       exit();
    }