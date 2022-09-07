<?php
// Autthenticates login credentials
if(isset($_POST['submit'])){
    extract($_POST);

    require_once 'database.inc.php';
    require_once 'functions.inc.php';

    if(isLoginInputEmpty($uid, $pwd) !== false){
        header("location: ../login.php?error=inputempty");
        exit();
    }

    loginUser($conn, $uid, $pwd);
}
else{
    header("location: ../login.php");
    exit();
}