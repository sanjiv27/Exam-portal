<?php
    
    // Sign up functions
    function isSignupInputEmpty($user_name, $name, $email, $phone,  $pwd, $confirm_pwd){

        if(empty($user_name) || empty($name) || empty($email) || empty($phone) || empty($confirm_pwd) || empty($pwd) ){
            return true;
        }

        return false;
    }

    function isUserNameValid($user_name){
        if(preg_match("/^[a-zA-Z0-9]+$/" , $user_name)){
            return true;
        }
        return false;
    }

    // if user exists, then return user data, else false.
    function getUserData($conn, $user_name, $email){
        $sqlQuery = "SELECT * FROM `user_info` WHERE `userName` = ? or `email` = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../signup.php?error=sqlStmtFailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt, "ss", $user_name, $email);
        //TODO: find all execute statements and wrap them in error handler/ error reporter.
        if(!mysqli_stmt_execute($stmt)){
            return false;
        }

        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            mysqli_stmt_close($stmt);
            return $row;
        }

        mysqli_stmt_close($stmt);
        return false;
    }

    function dbCreateUser($conn, $user_name, $name, $email, $phone, $pwd){
        if(strlen($pwd) >= 8){
            if (!preg_match("/^[A-Za-z0-9]+$/",$pwd)) {
                header("Location: ../sign_up.php?error=invalidPassword");
                exit();
            }
        }

        $sqlQuery = "INSERT INTO `user_info` ( `userName`, `fullName`, `phone`, `email`, `pwd`) values (?,?,?,?,?);";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../signup.php?error=sqlStmtFailed");
            exit();
        }

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssss", $user_name, $name, $phone, $email, $hashedPwd );

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


    function isNameValid($name){
        if(preg_match("/^[a-zA-Z(\s)]*$/" , $name)){
            return true;
        }
        return false;
    }

    function isEmailValid($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    function isEmailExists($conn, $email){
        $sqlQuery = "SELECT * FROM user_info WHERE email= ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            return false;
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
 
        $resultData = mysqli_stmt_get_result($stmt);
        if(mysqli_fetch_assoc($resultData)){
            return true;
        }

        mysqli_stmt_close($stmt);
        return false;
    }

    function isPhoneValid($phone){
        if(preg_match("/^[0-9]*$/" , $phone)){
            return true;
        }
        return false;
    }

    function isPasswordValid($pwd, $confirm_pwd){
        if($pwd!== $confirm_pwd){
            return false;
        }
        return true; 
    }


    // Log in functions
    function isLoginInputEmpty($uid, $pwd){
        if(empty($uid) || empty($pwd)){
            return true;
        }
        return false;
    }

    function loginUser($conn, $uid, $pwd){
        $uidData = getUserData($conn, $uid, $uid); 

        if($uidData === false){
            header("location: ../login.php?error=invalidLogin");
            exit();
        }
        
        $hashedPwd = $uidData["pwd"];
        $pwdCheck = password_verify($pwd, $hashedPwd);
        if($pwdCheck === false){
            header("location: ../login.php?error=invalidLogin");
            exit();
        }
        else if($pwdCheck === true){
            session_start();
            $_SESSION["userName"] = $uidData["userName"];
            $_SESSION["userUid"]= $uidData["uid"];
            header("location: ../student.php");
            exit();
        }
    }






