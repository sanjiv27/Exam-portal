<?php
    include_once "includes/header.inc.php";
    require_once "includes/database.inc.php";    
?>

<?php
    if(isset($_SESSION['userUid'])){
        if(isset($_GET['listType'])){ 
            $listType = $_GET['listType'];
            if($listType=='subject'){
                echo "<form action=student.php>
                <button type='submit' class='btn btn-primary'>Go Back</button></form>
                <br>
                <h2>Quiz list</h2>
                <ul>";

                $choice = $_GET['choice'];
                $sql = "SELECT * FROM quizes WHERE subid=?;";

                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: index.php?error=failed");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "s", $choice);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);
                
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<li><a href='test.php?id=".$row['quizid']."'>". $row['quizName'] ."</a></li>";
                    }
                }
                else{
                    echo "No quizes found.";
                }
                echo "</ul>";
            }
        }
        else{
            echo "<br><h2>Subject List</h2>
            To take a quiz, choose the relevant subject.
            <ul>";
            $sql = "SELECT * FROM subjects;";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<li><a href='student.php?listType=subject&choice=".$row['subid']."'>". $row['subName']."</a></li>";
                }
            }
            else{
                echo "No subjects found.";
            }
            echo "</ul>";
        }
    }
    else{
        echo "
        <h1>Welcome!</h1>
        <p>To get access to quizes, log in or sign up.</p>";
    }
?>

<?php
    include_once "includes/footer.inc.php";
?>
