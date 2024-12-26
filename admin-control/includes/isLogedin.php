<?php
session_start();
include("database.php");
if (!isset($_SESSION['admin_login_token']) ) {
header("location: index.php?msg=Please%20login%20to%20access%20the%20dashboad&type=error");
exit;
}
$session = '2020/2021';
$token = $_SESSION['admin_login_token'];
$teacher_sql = "SELECT *
                FROM admin_login
                WHERE token = '$token'";
                $teacher_data = mysqli_query($dbconnect, $teacher_sql);
                while ($teacher_row = mysqli_fetch_array($teacher_data)) {
                    $teacher_id = $teacher_row['id'];
                    $fullname = $teacher_row['f_name'];
                    $email = $teacher_row['email'];
                }
?>