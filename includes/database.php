<?php
/* Database credentials Live Production. */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Tescode@902!');
define('DB_NAME', 'otatotal_student_portal');
 
/* Attempt to connect to MySQL database */
$dbconnect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($dbconnect === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>