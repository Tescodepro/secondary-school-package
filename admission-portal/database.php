<?php //$config["database"] = "igxoiomy_fuo"; $config["host"]= "162.241.225.48";$config["username"]= "igxoiomy_fuo"; $config["password"]= "Portalfuo123@";?>
<?php
/* Database credentials Live Production. */
define('DB_SERVER', '67.220.187.98');
define('DB_USERNAME', 'otatotal_portal');
define('DB_PASSWORD', 'Tescode@portal');
define('DB_NAME', 'otatotal_student_portal');
 
/* Attempt to connect to MySQL database */
$dbconnect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($dbconnect === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>