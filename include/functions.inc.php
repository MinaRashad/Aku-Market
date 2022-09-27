<?php

use LDAP\Result;

function emptyInputs($name,$email,$pwd,$repwd){
    $result = false;

    if(empty($name) || empty($email) ||empty($pwd) ||empty($repwd)){
        $result = true;
    }
    return $result;
}
function invalidUsername($name){
    $result = false;

    if(!preg_match('/^[A-Za-z0-9]*$/',$name)){
        $result= true;
    }
    return $result;
}
function invalidcategory($name){
    $result = false;

    if(!preg_match('/^[A-Za-z0-9]*$/',$name)){
        $result= true;
    }
    return $result;
}

function invalidEmail($email){
    $result = false;

    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $result= true;
    }
    return $result;
}
function usernameExists($db,$name){

    $result = false;

    
    # Prepare SELECT statement. 
    # Note: we use ? to avoid sql injection

    $select = "SELECT * FROM users WHERE username = ?;";
    $stmt = $db->prepare($select);

    # Execute statement.
    $stmt->execute(array($name));

    # Get the results.
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $result = $results?$results:false; 
    $stmt = null;

    return $result;
    
}
function emailExists($db,$email){
    
    $result = false;

    
    # Prepare SELECT statement. 
    # Note: we use ? to avoid sql injection

    $select = "SELECT * FROM users WHERE email = ?;";
    $stmt = $db->prepare($select);

    # Execute statement.
    $stmt->execute(array($email));

    # Get the results.
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $result = $results?$results:false; 
    
    return $result;
    
}

function createUser($db,$name,$email,$pwd){
    $result = false;


    $insert = "INSERT INTO users(username, email, password,created) VALUES(?,?,?,?);";
    $stmt = $db->prepare($insert);

    # Execute statement.
    $date = date("Y-m-d h:i:s");
    $hashedPwd = password_hash($pwd.".".$date, PASSWORD_DEFAULT);
    $stmt->execute(array($name,$email,$hashedPwd,$date));
    $stmt = null;
    header('location: ../signup.php?error=none');
    exit();
}

function loginUser($db,$uid,$pwd){
    $select = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = $db->prepare($select);

    # Execute statement.
    $stmt->execute(array($uid,$uid));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    if(!$result){
        header('location: ../login.php?error=usernameDoesntExist');
        exit();
    }
    $userEntry = $result[0];
    $hashedPwd = $userEntry['password'];
    $createdDate = $userEntry['created'];
    #verify
    $saltedPwd = $pwd.".".$createdDate;
    $PasswordIsCorrect = password_verify($saltedPwd,$hashedPwd);

    if(!$PasswordIsCorrect){
        header('location: ../login.php?error=incorrectPassword&salted='.$saltedPwd);
        exit();
    }else{
        session_start();
        $_SESSION["id"]= $userEntry['userid'];
        $_SESSION["uid"]= $userEntry['username'];
        header('location: ../index.php');
        exit();

    }


}


function addlisting($db,$userid,$title,$price,$token,$category){
    $insert = "INSERT INTO listings(userid, title, posted_on, category, price, token) VALUES(?,?,?,?,?,?);";
    $stmt = $db->prepare($insert);

    # Execute statement.
    $date = date("Y-m-d h:i:s");
    $stmt->execute(array($userid,htmlspecialchars($title ?? '',ENT_QUOTES),$date,htmlspecialchars($category ?? '',ENT_QUOTES),$price,htmlspecialchars($token ?? '',ENT_QUOTES)));
    $stmt = null;
    header('location: ../my_listings.php?');
    exit();
}

function updatelisting($db,$listingid,$title,$price,$token,$category,$description){
    $update = "UPDATE listings 
                SET title =?, description=?, posted_on=?,category=?,price=?,token=?
                WHERE listing_id=? AND userid=?";
    $stmt = $db->prepare($update);


    $date = date("Y-m-d h:i:s");
    $stmt->execute(array( htmlspecialchars($title ?? '',ENT_QUOTES),
                         htmlspecialchars($description ?? '',ENT_QUOTES),
                         $date,
                         htmlspecialchars($category ?? '',ENT_QUOTES),
                         $price,
                         htmlspecialchars($token ?? '',ENT_QUOTES),
                         $listingid,
                         $_SESSION['id'] ));
    $stmt = null;
    header('location: ../my_listings.php?');
    exit();

}