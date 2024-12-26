<?php

session_start();
if (!isset($_SESSION['id'])) {
    header('location:index.php?msg=Please login to access your portal &type=error');
}else {
    include 'database.php';
    $id = $_SESSION['id'];
    $QueryDetails = "SELECT * FROM admission_user WHERE assign_id = '$id'";
    $getDetails = mysqli_query($dbconnect, $QueryDetails);
    while ($row = mysqli_fetch_array($getDetails)) {
        $name  = $row['first_name'].' '.$row['last_name'];
        $email = $row['email'];
        $app_id = $row['assign_id'];
        $application_found = $row['application_found'];        
        $acceptance_found = $row['acceptance_found'];
        $add_status = $row['add_status'];
        $is_register = $row['is_register'];
    }     
}
?>