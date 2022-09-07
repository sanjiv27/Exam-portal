<?php
    require_once "includes/header.inc.php";
    require_once "includes/functions.inc.php";
    require_once "../includes/database.inc.php";
?>
<!-- page for adding and modifying quizes -->
<?php
    if(isset($_SESSION['admin_name'])){
        // Add quiz module -
        // selecting the subject
        echo '<h2>Add quiz</h2>
        <form action="includes/add.inc.php" method="post" autocomplete="off">
            <input class="form-control" list="subjects" name="sub_name" placeholder="Subject of quiz">
            <datalist id="subjects">';
            
        $sqlQuery = "SELECT * FROM subjects;";
        $subList = mysqli_query($conn, $sqlQuery);
        if(mysqli_num_rows($subList)>0){
            while($row = mysqli_fetch_assoc($subList)){
                echo '<option value = "'.$row['subName'].'">';
            }
        }
        echo '</datalist>
            <input class="form-control"type = "text" name="quiz_name" placeholder="Quiz Name">
            <button class="btn btn-primary" type="submit" name="submit" value="add_quiz">Add</button>
        </form>'; 

        // error message check
        if(isset($_GET["error"])){
            if($_GET["error"] == "inputempty"){
                echo '<div class="alert alert-warning" role="alert">Please fill in the field!</div>';
            }
            else if($_GET["error"] == "failed"){
                echo '<div class="alert alert-warning" role="alert">Failed to add quiz, please try again later.</div>';
            }
            else if($_GET["error"] == "quizexists"){
                echo '<div class="alert alert-warning" role="alert">Quiz already exists!</div>';
            }

        }

        // success message
        if(isset($_GET["result"]) && $_GET["result"] == "success"){
            echo '<div class="alert alert-success">Quiz successfully added.</div>';
        } 

        // modifying existing subject
        echo '<br>
        <h2>Change quiz</h2>
        <form action="includes/modify.inc.php" method="post" autocomplete="off">
        <input class="form-control"class="form-control" list="quizes_mod" name="oldquizname" placeholder="Choose a quiz">
        <datalist id="quizes_mod">';
        
        $sqlQuery = "SELECT `quizName` , `subName` FROM 
        (quizes q INNER JOIN subjects s on s.subid = q.subid);";

        $subList = mysqli_query($conn, $sqlQuery);
        if(mysqli_num_rows($subList)>0){
            while($row = mysqli_fetch_assoc($subList)){
                echo '<option value = "'.$row['quizName'].'">'.$row['subName'].'</option>';
            }
        }
        echo '</datalist>
            <input class="form-control"type="text" name="newquizname" placeholder="Changed quiz name" >
            <button class="btn btn-primary" type="submit" name="submit" value="mod_quiz">Change</button>
        </form>';

        // error message check
        if(isset($_GET["error2"])){
            if($_GET["error2"] == "inputempty"){
                echo '<div class="alert alert-warning" role="alert">Please fill in the field!</div>';
            }
            else if($_GET["error2"] == "failed"){
                echo '<div class="alert alert-warning" role="alert">Failed to make changes, please try again later.</div>';
            }
            else if($_GET["error2"] == "quizexists"){
                echo '<div class="alert alert-warning" role="alert">The changed quiz name already exists!</div>';
            }
        }

        // success message
        if(isset($_GET["result2"]) && $_GET["result2"] == "success"){
            echo '<div class="alert alert-success">Quiz successfully changed.</div>';
        } 

        // Delete existing quiz
        echo '<br><h2>Delete quiz</h2>
        <form action="javascript:confirmDelete(quiz_choice.value)" autocomplete ="off">
            <input class="form-control"list="quizes_del" id="quiz_choice" placeholder="Choose a quiz">
            <datalist id="quizes_del">';
        
        $sqlQuery = "SELECT `quizName` , `subName` FROM 
        (quizes q INNER JOIN subjects s on s.subid = q.subid);";

        $subList = mysqli_query($conn, $sqlQuery);
        if(mysqli_num_rows($subList)>0){
            while($row = mysqli_fetch_assoc($subList)){
                echo '<option value = "'.$row['quizName'].'">'.$row['subName'].'</option>';
            }
        }
        echo '</datalist>
            <button class="btn btn-primary" type="submit" name="submit">Delete</button>
        </form>';

        // error message check
        if(isset($_GET["error3"])){
            if($_GET["error3"] == "inputempty"){
                echo '<div class="alert alert-warning" role="alert">Please fill in the field!</div>';
            }
            else if($_GET["error3"] == "failed"){
                echo '<div class="alert alert-warning" role="alert">Failed to delete, please try again later.</div>';
            }
            else if($_GET["error3"] == "notexist"){
                echo '<div class="alert alert-warning" role="alert">Deletion failed. Quiz doesn\'t exist.</div>';
            }
        }

        // success message
        if(isset($_GET["result3"]) && $_GET["result3"] == "success"){
            echo '<div class="alert alert-success">Subject successfully deleted.</div>';
        } 

    }
    else{
        header("location: index.php");
        exit();
    }
?>

<script>
    // script for confirming delete
    function confirmDelete(quiz){
        document.getElementById("form-delete-quiz").quiz_name.value = quiz;
        $("#deleteModal").modal("show");       
    }
</script>

<!-- modal pop-up for confirming delete -->
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Quiz?</h4>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete the quiz?</p>
                <p>This will delete the quiz and its questions.</p>
                <form method="post" action="includes/delete.inc.php" id="form-delete-quiz">
                    <input class="form-control"type = "hidden" name="quiz_name">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" form="form-delete-quiz" class="btn btn-danger" value="del_quiz">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php
    include_once "../includes/footer.inc.php";
?>



