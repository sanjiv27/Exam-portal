<?php
// Autthenticates login credentials

if(isset($_POST['submit'])){
    extract($_POST);

    require_once '../../includes/database.inc.php';
    require_once 'functions.inc.php';

    if(isAdminLoginInputEmpty($uid, $pwd) !== false){
        header("location: ../login.php?error=inputempty");
        exit();
    }

    loginAdmin($conn, $uid, $pwd);
    exit();
}
else{
    header("location: ../login.php");
    exit();
}