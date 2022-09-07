<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content= "width=device-width, initial-scale = 1.0"/>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles/style.css">
        
        <title>Exam portal</title>
    </head>

    <body class="d-flex flex-column h-100">
        <!-- navigation bar - student user-->
        <header>
            <nav class="top-toolbar" >
                <div>
                    <table cellpadding="5" cellspacing="0">
                        <tr>
                            <td><a class="navbar-brand navsel" href="index.php"><img src="images/logo.jpg" alt="Quiz logo" width="100" height="50"></td>

                            <td><a class="navsel" href="student.php">Home</a></td>
                            <?php
                                if(isset($_SESSION['userUid'])){
                                    echo '<td><a class="navsel" href="logout.php">Log out</a></td>';
                                }
                                else{
                                    echo '<td><a class="navsel" href="sign_up.php">Sign Up</a></td>';
                                    echo '<td><a class="navsel" href="login.php">Log In</a></td>';
                                }
                            ?>
                        </tr>
                    </table>
                </div>
            </nav>
        </header>
        <main>        
            <div class="all-content">
