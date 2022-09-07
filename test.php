<?php
    session_start();
    require_once 'includes/database.inc.php';
    $_SESSION['quizid'] = $_GET['id'];
    $quizid = $_GET['id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quiz</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles/test_style.css">

    </head>

    <script>
        function countdown(minutes) {
            var seconds = 60;
            var mins = minutes
            function tick() {
                var counter = document.getElementById("timer");
                var current_minutes = mins-1
                seconds--;
                counter.innerHTML = current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                if( seconds > 0 ) {
                    setTimeout(tick, 1000);
                }     
                else {
                    if(mins > 1){
                        setTimeout(function () { countdown(mins - 1); }, 1000); 
                    }
                }
                if(seconds==0 && current_minutes==0){
                    alert("time up!");
                    document.getElementById("sub").click();
                }
            }
            tick();
        } 
    </script>


    <body onload="countdown(10)">
        <div id="timer">10:00</div>

        <div class="container"> 
            <form id='login' method="post" action="test_result.php">
                <div class = 'card-body'>
                <?php 
                $res = mysqli_query($conn,"select * from question_answer where quizid='".$quizid."' ORDER BY RAND();");
                $rows = mysqli_num_rows($res); 
                $i=1;
                
                while($result=mysqli_fetch_array($res)){?>

                    <div class = 'card'>
                        <p><?php echo $i?>.<?php echo $result['question'];?></p>

                        <input type="hidden" value="0" name='<?php echo $result['qid'];?>' checked> 
                        
                        <label><input class="form-check-input option" type="radio" value="1" name='<?php echo $result['qid'];?>'/> <?php echo $result['opt1'];?></label>

                        <label><input class="form-check-input option" type="radio" value="2" name='<?php echo $result['qid'];?>'/> <?php echo $result['opt2'];?></label>

                        <label><input class="form-check-input option" type="radio" value="3" name='<?php echo $result['qid'];?>'/> <?php echo $result['opt3'];?></label>
                        
                        <label><input class="form-check-input option" type="radio" value="4" name='<?php echo $result['qid'];?>'/> <?php echo $result['opt4'];?></label>
                    </div>
                    <br/>
                    <?php $i++;} ?>
                </div>
                <div style="text-align:center">
                    <button id="sub" class="btn btn-success"type='submit'>Submit</button>
                </div>
                <br>
            </form>
        </div>
    </body>
</html>