<?php
    // if user exists, then return user data, else false.
    function getAdminData($conn, $user_name){
        $sqlQuery = "SELECT * FROM admins WHERE `name` = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../login.php?error=sqlStmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $user_name);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }

        mysqli_stmt_close($stmt);
        return false;
    }

    // Admin 
    function isAdminLoginInputEmpty($uid, $pwd){
        if(empty($uid) || empty($pwd)){
            return true;
        }
        return false;
    }

    function loginAdmin($conn, $uid, $pwd){
        $uidData = getAdminData($conn, $uid); 

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
            $_SESSION["admin_name"] = $uidData["name"];
            $_SESSION["admin_id"] = $uidData["adminid"];
            header("location: ../index.php");
            exit();
        }
    }

    // returns -1 for error, 
    // 0 for no records found, 
    // else the subject ID if it exists.
    function isSubjectExists($conn, $subName){
        $sqlQuery = "SELECT * FROM subjects WHERE `subName` = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            return -1;
        }
    
        mysqli_stmt_bind_param($stmt, "s", $subName);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    
        if(mysqli_num_rows($resultData) >0){
            $row = mysqli_fetch_assoc($resultData);
            return $row['subid'];
        }
        
        return 0;
    }

    // returns -1 for error, 
    // 0 for no records found, 
    // else the Quiz ID if it exists.
    function isQuizExists($conn, $quizName){
        $sqlQuery = "SELECT * FROM quizes WHERE `quizName`=?;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            return -1;
        }
    
        mysqli_stmt_bind_param($stmt, "s", $quizName);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    
        if(mysqli_num_rows($resultData) >0){
            $row = mysqli_fetch_assoc($resultData);
            return $row['quizid'];
        }
        return 0;
    }

   