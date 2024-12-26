<?php
session_start();
include 'database.php';

if (isset($_POST['login'])) {
    
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);

    if(empty($email) && empty($password)){
        header('location:../index.php?msg=email and password fields are required&type=error');
    }elseif (empty($password) && !empty($email)) {
        header('location:../index.php?msg=password field is required&type=error');
    }elseif (empty($email) && !empty($password)) {
        header('location:../index.php?msg=email field is required&type=error');
    }
    else{

        $stmt_Update_Payment = $dbconnect->prepare("SELECT * FROM admin_login WHERE email = ? and password = ?");
        $stmt_Update_Payment->bind_param("ss", $email, $password);
        $stmt_Update_Payment->execute();
        $loginGet = $stmt_Update_Payment->get_result();
        if ($loginGet->num_rows > 0) {
            
            while ($loginAns = mysqli_fetch_array($loginGet)) {
            $_SESSION['admin_login_token'] = $loginAns['token'];
            header("location: ../dashboard.php");
            }
        } else {
            header('location:../index.php?msg=Invalid%20email%20or%20password&type=error');
        }

    }
}
