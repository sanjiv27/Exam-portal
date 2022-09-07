<?php
// sets up the database connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '1234';
$db_name = 'exam_portal';

$conn = mysqli_connect($db_host, $db_user, $db_pass,$db_name);

if(!$conn){
    die("Error connecting to database: " . mysqli_connect_error());
}
