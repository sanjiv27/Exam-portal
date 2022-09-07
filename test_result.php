<?php
    session_start();
    require_once 'includes/database.inc.php';
    $quizid = $_SESSION['quizid'];
?>

<?php 
    $right_answer=0;
    $keys=array_keys($_POST);
    $order=join(",",$keys);
    echo "$order";

    $result=mysqli_query($conn,"SELECT * from question_answer where qid IN($order) and quizid='".$quizid."';");

    $total = mysqli_num_rows($result);

    while($row=mysqli_fetch_array($result)){
        $res1 = $row['answer']; // correct answer
        $res2 = $_POST[$row['qid']]; // user's answer

        if($res2==$res1){
            $right_answer++;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Result</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">     
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles/test_style.css">
    </head>
    <body>
        <div class="container">
           <div class="card-body"> 
                <div class="card"> 
                    <h1>Score : <?php echo $right_answer;?>/<?php echo $total?></h1>
                    <?php 
                        if($right_answer < $total/4) { 
                            echo "<h1>Work hard, you should do better next time.</h1>";
                        }
                        else if($right_answer< $total/2){
                            echo "<h1>Good, but needs more practice.</h1>";
                        } else if($right_answer<$total){
                            echo "<h1>Very good, aim for the perfect score next time.</h1>";
                        } else {
                            echo "<h1>Excellent! You got a perfect score.</h1>";
                        } 
                    ?>
                </div>
            </div>    
            
            <div class="card">
                <?php 
                $res = mysqli_query($conn,"SELECT * from question_answer where quizid='".$quizid."' ORDER BY RAND();");
                $i=1;
                while($row=mysqli_fetch_array($res))
                { ?>                        
                    
                    <p class='questions' id='question'> <?php echo $i?>. <?php echo $row['question'];?></p>
                    <p id='ans'>Answer : 
                        <?php 
                            $option = 'opt'. $row['answer'];
                            // echo "$option";
                            echo $row[$option];
                        ?>
                    </p>
                   
                    <?php  
                    $i++; 
                }
                ?>
                <br>
                <a class="btn btn-primary" href="student.php">Take new Quiz</a>          
            </div>     
        </div>
    </body>
</html>