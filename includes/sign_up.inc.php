<?php

if(isset($_POST["submit"])){
    extract($_POST);
    $user_name = trim($user_name);
    $name = trim($name);
    $email = trim($email);
    $phone = trim($phone);
    $pwd = trim($pwd);
    $confirm_pwd= trim($confirm_pwd);

    require_once 'database.inc.php';
    require_once 'functions.inc.php';

    // checking validity of sign up details
    if(isSignupInputEmpty($user_name, $name, $email, $phone,  $pwd, $confirm_pwd) !== false){
        header("location: ../sign_up.php?error=inputempty");
        exit();
    }
    if(isUserNameValid($user_name) == false){
        header("location: ../sign_up.php?error=invalidusername");
        exit();
    }
    if(getUserData($conn, $user_name, $email) !== false) {
        header("location: ../sign_up.php?error=usernameExists");
        exit();
    }
    if(isNameValid($name) == false){
        header("location: ../sign_up.php?error=invalidName");
        exit();
    }
    if(isEmailValid($email) == false){
        header("location: ../sign_up.php?error=invalidEmail");
        exit();
    }
    if(isEmailExists($conn, $email) !== false){
        header("location: ../sign_up.php?error=emailExists");
        exit();
    }
    if(isPhoneValid($phone) == false){
        header("location: ../sign_up.php?error=invalidPhone");
        exit();
    }
    if(isPasswordValid($pwd, $confirm_pwd) == false){
        header("location: ../sign_up.php?error=invalidPassword");
        exit();
    }
    
    dbCreateUser($conn, $user_name, $name, $email, $phone, $pwd);
    header("location: ../sign_up.php?error=signupSuccess");
    exit();
}
else{
    header("location: ../sign_up.php");
}