<?php
if(isset($_POST['submit'])){
    extract($_POST);
    require_once '../../includes/database.inc.php';
    require_once 'functions.inc.php';

    // To modify the subject
    if($_POST['submit']=='mod_subject'){
        if(empty($oldsubname)||empty($newsubname)){
            header("location: ../subject.php?error2=inputempty");
            exit();
        }
        
        $prev_id = isSubjectExists($conn, $oldsubname);
        $id = isSubjectExists($conn, $newsubname);
        if($id < 0 || $prev_id <= 0){
            header("location: ../subject.php?error2=failed");
            exit();
        }
        else if($id >0){
            header("location: ../subject.php?error2=subjectexists");
            exit();
        }
    
        $sqlQuery = "UPDATE subjects SET subName = ? WHERE subName = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../subject.php?error2=failed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "ss", $newsubname, $oldsubname);
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../subject.php?error2=failed");
            exit();
        }

        header("location: ../subject.php?result2=success");
        exit();
    }
    // To modify the quiz
    else if($_POST['submit']=='mod_quiz'){
        if(empty($oldquizname)||empty($newquizname)){
            header("location: ../quiz.php?error2=inputempty");
            exit();
        }

        $prev_id = isQuizExists($conn, $oldquizname);
        $id = isQuizExists($conn, $newquizname);
        if($id < 0 || $prev_id <=0){
            header("location: ../quiz.php?error2=failed");
            exit();
        }
        else if($id >0){
            header("location: ../quiz.php?error2=subjectexists");
            exit();
        }

        $sqlQuery = "UPDATE quizes SET `quizName` = ? WHERE `quizName` = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../quiz.php?error2=failed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $newquizname, $oldquizname);
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../quiz.php?error2=failed");
            exit();
        }
        header("location: ../quiz.php?result2=success");
        exit();
    }
    // to modify a question
    else if($_POST['submit']=="mod_question"){
        // check if qid is valid
        if(empty($ques_name)|| empty($opt1) || empty($opt2) || empty($opt3) || empty($opt4) || empty($opt_ans)){
            header("location: ../question.php?quizid=".$quizid."&error=inputempty");
            exit();
        }

        if(!preg_match("/^[1-4]$/", $opt_ans)){
            header("location: ../question.php?quizid=".$quizid."&error=invalidans");
            exit();
        }
    
        // update question
        $sqlQuery = "UPDATE question_answer
        SET question=?, opt1=?, opt2=?, opt3=?, opt4=?, answer=?
        WHERE qid=?;";
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../question.php?quizid=".$quizid."&error=failed");
            exit();
        }

        if(!mysqli_stmt_bind_param($stmt, "sssssss", $ques_name, $opt1, $opt2, $opt3, $opt4, $opt_ans, $qid)){
            header("location: ../question.php?quizid=".$quizid."&error=failed");
            exit();
        }

        if(!mysqli_stmt_execute($stmt)){
            header("location: ../question.php?quizid=".$quizid."&error=failed");
            exit();
        }

        header("location: ../question.php?quizid=".$quizid."&result=successMod");
        exit();
    }
    else{
        header("location: ../index.php?error=failed");
        exit();
    }
}
else{
    header("location: ../index.php?error=failed");
    exit();
}