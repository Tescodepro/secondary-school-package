<?php
// Initialize the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Reporting None error
// error_reporting(0);

include ("database.php");
 
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION['auth_user']) ) { // if session variable "username" does not exist.
    header("location: index.php?msg=Please%20login%20to%20access%20the%20dashboad&type=error");
    exit;
}
$session = '2020/2021';
$unique_id = $_SESSION['auth_user'];
$student_sql = "SELECT 
                *
                FROM users
                INNER JOIN students_info ON users.unique_id = students_info.user_id
                INNER JOIN class_track ON users.unique_id = class_track.user_id 
                INNER JOIN classes ON class_track.class_id = classes.id 
                WHERE users.unique_id = '$unique_id'";
                $student_data = mysqli_query($dbconnect, $student_sql);
                while ($student_row = mysqli_fetch_array($student_data)) {
                    $id = $student_row['id'];
                    $fullname = $student_row['f_name'];
                    $unique_id = $student_row['unique_id'];
                    $role = $student_row['role'];
                    $status = $student_row['status'];
                    $email = $student_row['email'];
                    $dob = $student_row['dob'];
                    $contact_address = 'okay';
                    $parent_name = $student_row['parent_name'];
                    $parent_address = $student_row['parent_address'];
                    $parent_phone_num = $student_row['parent_phone_num'];
                    $level = $student_row['level'];
                    $class_code = $student_row['class_code'];
                    $class_name = $student_row['class_name'];
                    $class_id = $student_row['class_id'];
                }
               
?>
