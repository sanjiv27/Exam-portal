<?php
if(isset($_POST['submit'])){
    extract($_POST);
    require_once '../../includes/database.inc.php';
    require_once 'functions.inc.php';
    
    //add subject
    if($_POST['submit']=='add_subject'){            
        if(empty($sub_name)){
            header("location: ../subject.php?error=inputempty");
            exit();
        }

        // check if subject exists
        $id = isSubjectExists($conn, $sub_name);
        if($id == -1){
            header("location: ../subject.php?error=failed");
            exit();
        }
        else if($id >0){
            header("location: ../subject.php?error=subjectexists");
            exit();
        }
    
        $sqlQuery = "INSERT INTO subjects (subName) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../subject.php?error=failed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $sub_name);
        mysqli_stmt_execute($stmt);
        header("location: ../subject.php?result=success");
        exit();
    }
    // add quiz 
    else if($_POST['submit']=='add_quiz'){
        if(empty($sub_name)|| empty($quiz_name)){
            header("location: ../quiz.php?error=inputempty");
            exit();
        }

        // check if quiz exists and return id if exists
        $qid = isQuizExists($conn, $quiz_name);
        if($qid == -1){
            header("location: ../quiz.php?error=failed");
            exit();
        }
        else if($qid >0){
            header("location: ../quiz.php?error=quizexists");
            exit();
        }
    
        $sqlQuery = "INSERT INTO quizes (`quizName`, subid) VALUES (?,?);";
        $sid = isSubjectExists($conn, $sub_name);
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../quiz.php?error=failed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $quiz_name, $sid);
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../quiz.php?error=failed");
            exit();
        }
        header("location: ../quiz.php?result=success");
        exit();
    }

    //add question
    else if($_POST['submit']=="add_question"){
        // check if quizid is valid
        if(empty($quizid) || !is_numeric($quizid)){
            header("location: ../question.php?error=quiznotexist");
            exit();
        }
        $sqlQuery = "SELECT * FROM quizes WHERE quizid='".$quizid."';";
        $result = mysqli_query($conn, $sqlQuery);
        if(mysqli_num_rows($result)==0){
            header("location: ../question.php?error=quiznotexist");
            exit();
        }

        if(empty($ques_name)|| empty($opt1) || empty($opt2) || empty($opt3) || empty($opt4) || empty($opt_ans)){
            header("location: ../question.php?quizid=".$quizid."&error=inputempty");
            exit();
        }
        
        //TODO: Set max number of questions allowed
        // check if quiz already has 50 questions
        $sqlQuery= "SELECT * FROM question_answer WHERE quizid='".$quizid."';";
        $result = mysqli_query($conn, $sqlQuery);

        if(mysqli_num_rows($result)>=50){
            header("location: ../question.php?quizid=".$quizid."&error=excessquestions");
            exit();
        }

        if(!preg_match("/^[1-4]$/", $opt_ans)){
            header("location: ../question.php?quizid=".$quizid."&error=invalidans");
            exit();
        }
    
        // add question
        $sqlQuery = "INSERT INTO question_answer (quizid, question, opt1, opt2, opt3, opt4, answer) VALUES (?,?,?,?,?,?,?);";
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlQuery)){
            header("location: ../question.php?quizid=".$quizid."&error=failed");
            exit();
        }

        if(!mysqli_stmt_bind_param($stmt, "sssssss", $quizid, $ques_name, $opt1, $opt2, $opt3, $opt4, $opt_ans)){
            header("location: ../question.php?quizid=".$quizid."&error=failed");
            exit();
        }

        if(!mysqli_stmt_execute($stmt)){
            header("location: ../question.php?quizid=".$quizid."&error=failed");
            exit();
        }

        header("location: ../question.php?quizid=".$quizid."&result=successAdd");
        exit();
    }
}
else{
    header("location: ../index.php?error=failed");
    exit();
}