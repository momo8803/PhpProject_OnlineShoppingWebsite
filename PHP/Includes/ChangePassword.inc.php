<?php

include "../Classes/Dbh.class.php";
include "../Classes/ChangePassword.class.php";

if(isset($_POST["submit-request"])) {
    
    //Grabbing data
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $confirmPwd = $_POST["confirmPwd"];
    
    //instatiating object
    $changePwd = new ChangePassword($email, $password, $confirmPwd);
    
    //Running error
    $changePwd->updateClientPassword();
    
    //Going back to home page
    header("Location: ../../HTML/index.php?error=none");
}