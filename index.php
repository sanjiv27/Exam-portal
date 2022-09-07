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

    <body class="d-flex flex-column h-100" style= "height: 100; background-position: center; background-repeat: no-repeat; background-size: cover;">
        <!-- navigation bar -home -->
        <style type="text/css">
            .floated {
                width: 48%;
            }

            .floated {
                float: left;
                padding: 1%;
            }

            .first {
                text-align: right;
            }

            .indexbutton {
                margin: 15px;
                background-color: #0066FF;
                border: none;
                color: white;
                padding: 30%;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
            }

            .indexbutton:hover {
                background-color: rgb(29, 221, 235);
            }

        </style>
        <main>        
            <div class="all-content">
                <br><br>
                <center>
                    <h1>Choose your role to continue.</h1>
                </center>
                <br><br>
                <div class="container">
                    <div class="floated run first">
                        <form action="student.php">
                            <button class="indexbutton"><h2>Student</h2></button>
                        </form>
                    </div>

                    <div class="floated run">
                        <form action="admin/index.php">
                            <button class="indexbutton"><h2>Admin</h2></button>
                        </form>
                    </div>
                </div>

<?php
    include_once "includes/footer.inc.php";
?>