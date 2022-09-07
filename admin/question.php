<?php
require_once "includes/header.inc.php";
require_once "includes/functions.inc.php";
require_once "../includes/database.inc.php";
?>

<?php
//main module with add, modify, delete options
if (isset($_SESSION['admin_name'])) {
    // error message check
    if (isset($_GET['quizid']) && !empty($_GET['quizid'])) {
?>
        <form>
            <button type="submit" class="btn btn-primary">Chose different quiz</button>
        </form><br>

        <?php
        // error message
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'excessquestions') {
                echo '<div class="alert alert-warning" role="alert">Max limit for number of questions reached!</div>';
            } else if ($_GET['error'] == 'failed') {
                echo '<div class="alert alert-warning" role="alert">Failed request! Please try again later.</div>';
            } else if ($_GET['error'] == 'inputempty') {
                echo '<div class="alert alert-warning" role="alert">Please fill all fields!</div>';
            } else if ($_GET['error'] == 'invalidans') {
                echo '<div class="alert alert-warning" role="alert">Invalid option number for answer. Must be from 1-4.</div>';
            }
            else if ($_GET['error'] == 'questionnotexist'){
                echo '<div class="alert alert-warning" role="alert">Invalid option number for answer. Must be from 1-4.</div>'; 
            }
        }

        if (isset($_GET['result'])) {
            if($_GET['result'] == 'successAdd'){
                echo '<div class="alert alert-success">Question added successfully</div>';
            }
            else if ($_GET['result'] == 'successMod'){
                echo '<div class="alert alert-success">Question changed successfully</div>';
            }
            else if($_GET['result'] == 'successDel'){
                echo '<div class="alert alert-success">Question deleted successfully</div>';
            }
        }
        ?>

<!-- ################################################# -->
        <!-- Question add, modify and delete buttons. Table of questions display-->
        <div class="container">
            <?php
                $sqlQuery = "SELECT * FROM question_answer WHERE quizid ='".$_GET['quizid']."';";
                $result = mysqli_query($conn, $sqlQuery);
                if(mysqli_num_rows($result)==0){
                    echo '<h5>No questions here. Start adding them!</h5>';
                }
            ?>
                <div class="card-body">
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#quesAddModal">Add</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
            <?php
                if(mysqli_num_rows($result)>0){
                    $i = 1;
                    while($row = mysqli_fetch_array($result)){
                        echo'       <tr>   
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$row['question'].'</td>
                                        <td>
                                            <button type="button" class="btn btn-primary modbtn" >Modify</button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger delbtn">Delete</button>
                                        </td>
                                        <input type="hidden" value="'.$row['qid'].'">
                                        <input type="hidden" value="'.$row['quizid'].'">
                                        <input type="hidden" value="'.$row['opt1'].'">
                                        <input type="hidden" value="'.$row['opt2'].'">
                                        <input type="hidden" value="'.$row['opt3'].'">
                                        <input type="hidden" value="'.$row['opt4'].'">
                                        <input type="hidden" value="'.$row['answer'].'">
                                    </tr>';
                        $i++;
                    }  
                }
            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
<!-- ################################################### -->
<?php
    // Contains all modals for add, delete, modify
    require_once 'includes/question_modal.inc.php';
?>

<?php
    } else {
        echo '<h4>Select quiz</h4>
            <p>Choose a quiz to modify it\'s questions:</p>
            <form action="includes/question.inc.php" method="post" autocomplete="off">

                <input class="form-control" list="quizes" name="quizChoice" placeholder="Quiz of question">

                <datalist id="quizes">';

        $sqlQuery = "SELECT * FROM (quizes q INNER JOIN subjects s on s.subid = q.subid);";
        $subList = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($subList) > 0) {
            while ($row = mysqli_fetch_assoc($subList)) {
                echo '<option value = "' . $row['quizName'] . '">' . $row['subName'] . '</option>';
            }
        }
        echo '</datalist>
                <button class="btn btn-primary" type="submit" name="quizNameSubmit">Show questions</button>
            </form>';

        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'inputempty') {
                echo '<div class="alert alert-warning" role="alert">Please fill in the field!</div>';
            } else if ($_GET['error'] == 'failed') {
                echo '<div class="alert alert-warning" role="alert">Failed request! Please try again later.</div>';
            } else if ($_GET['error'] == 'quiznotexist') {
                echo '<div class="alert alert-warning" role="alert">Quiz does not exist!</div>';
            }
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<?php
include_once "../includes/footer.inc.php";
?>