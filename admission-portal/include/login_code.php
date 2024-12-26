<?php
session_start();
include '../database.php'; 
echo "login";
if (isset($_POST['login'])) { 


    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $assign_id  = mysqli_real_escape_string($dbconnect, $_POST['assign_id']);

    $stmt_Update_Payment = $dbconnect->prepare("SELECT * FROM user WHERE email = ? and assign_id  = ?");
    $stmt_Update_Payment->bind_param("ss", $email, $assign_id );
    $stmt_Update_Payment->execute();
    $loginGet = $stmt_Update_Payment->get_result();
    if ($loginGet->num_rows > 0) {
        while ($loginAns = mysqli_fetch_array($loginGet)) {
            $assign_id = $loginAns['assign_id'];
            $_SESSION['login'] = true;
            $_SESSION['id'] = $assign_id;
            header('location:../dashboard.php');
        } 
    }
    else{ 
        header('location:../index.php?msg=Invalid Details &type=error');
    }
}
 