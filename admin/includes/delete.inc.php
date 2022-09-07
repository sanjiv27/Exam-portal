<?php

if(isset($_POST['submit'])){
    extract($_POST);
    require_once '../../includes/database.inc.php';
    require_once 'functions.inc.php';
    
    // Deletion of subject
    if($_POST['submit']=='del_subject'){
        if(empty($sub_name)){
            header("location: ../subject.php?error3=inputempty");
            exit();
        }

        $id = isSubjectExists($conn, $sub_name);
        if($id < 0){
            header("location: ../subject.php?error3=failed");
            exit();
        }
        else if($id == 0){
            header("location: ../subject.php?error3=notexist");
            exit();
        }

        $sqlQuery = "DELETE FROM subjects WHERE `subName`=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../subject.php?error3=failed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $sub_name);
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../subject.php?error3=failed");
            exit();
        }
        header("location: ../subject.php?result3=success");
        exit();
    }
    // deletion of quiz
    else if($_POST['submit']=='del_quiz'){
        if(empty($quiz_name)){
            header("location: ../quiz.php?error3=inputempty");
            exit();
        }
    
        $id = isQuizExists($conn, $quiz_name);
        if($id < 0){
            header("location: ../quiz.php?error3=failed");
            exit();
        }
        else if($id == 0){
            header("location: ../quiz.php?error3=notexist");
            exit();
        }
    
        $sqlQuery = "DELETE FROM quizes WHERE quizName = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../quiz.php?error3=failed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "s", $quiz_name);
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../quiz.php?error3=failed");
            exit();
        }
        header("location: ../quiz.php?result3=success");
        exit();
    }
    // deletion of question
    else if($_POST['submit']=='del_question'){      
        $sqlQuery = "DELETE FROM question_answer WHERE qid =".$qid.";";
        if(!mysqli_query($conn, $sqlQuery)){
            header("location: ../question.php?quizid=".$quizid."&error=failed");
            exit();
        }

        header("location: ../question.php?quizid=".$quizid."&result=successDel");
        exit();
    }

}
else{
    header("location: ../index.php");
    exit();
}