<?php

if(isset($_POST["login-submit"])) {
    
    //Grabbing data
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    require_once 'Dbh.inc.php';
    include '../Classes/Login.class.php';
    
    $loginClient = new Login($email, $password);
    
    if($loginClient->isEmpty() !== false) {
        header("Location: ../../html/login.php?error=emptyinput");
        exit();
    }
    elseif($loginClient->isEmpty() === false){
        $loginClient->loginClient($conn);
    }
}
else {
    header("Location: ../../html/login.php");
    exit();
}