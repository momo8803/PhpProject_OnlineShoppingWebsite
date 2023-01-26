<?php

include "../Classes/Dbh.class.php";
include "../Classes/Signup.class.php";
// include "../Classes/SignupController.class.php";

if(isset($_POST["submit"])) {
    
    //Grabbing data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["confirmPwd"];
    
    //instatiating object
    $signup = new Signup($name,$phone,$address,$email,$password,$passwordRepeat);
    
    //Running error
    $signup->signupClient();
    
    //Going back to home page
    header("Location: ../../html/signUp.php?error=none");
}