<?php
session_start();
include '../../database.php'; 

if (isset($_POST['login'])) { 

// echo 'jj';
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $password  = mysqli_real_escape_string($dbconnect, $_POST['password']);

    $stmt_Update_Payment = $dbconnect->prepare("SELECT * FROM  admission_admin  WHERE email = ? and password = ?");
    $stmt_Update_Payment->bind_param("ss", $email, $password );
    $stmt_Update_Payment->execute();
    $loginGet = $stmt_Update_Payment->get_result();
    if ($loginGet->num_rows > 0) {
        while ($loginAns = mysqli_fetch_array($loginGet)) {
            $password = $loginAns['password'];
            $_SESSION['login'] = true;
            $_SESSION['id'] = $password;
            header('location:../dashboard2.php');
        } 
    }
    else{ 
        header('location:../index.php?msg=Invalid Details &type=error');
    }
}
 