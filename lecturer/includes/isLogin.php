<?php
// Initialize the session
session_start();
// Reporting None error
// error_reporting(0);

include ("database.php");
 
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION['is_lecture']) ) { // if session variable "username" does not exist.
    header("location: index.php?msg=Please%20login%20to%20access%20the%20dashboad&type=error");
    exit;
}
$session = '2020/2021';
$unique_id = $_SESSION['is_lecture'];
$teacher_sql = "SELECT 
                *
                FROM users
                WHERE unique_id = '$unique_id'";
                $teacher_data = mysqli_query($dbconnect, $teacher_sql);
                while ($teacher_row = mysqli_fetch_array($teacher_data)) {
                    $teacher_id = $teacher_row['id'];
                    $fullname = $teacher_row['f_name'];
                    $email = $teacher_row['email'];
                }
               
?>