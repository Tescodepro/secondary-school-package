<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'database.php';

if (isset($_POST['login'])) {
    
    $password = mysqli_real_escape_string($dbconnect, $_POST['password']);
    $username = mysqli_real_escape_string($dbconnect, $_POST['username']);

    if(empty($username) && empty($password)){
        header('location:../index.php?msg=username and password fields are required&type=error');
    }elseif (empty($password) && !empty($username)) {
        header('location:../index.php?msg=password field is required&type=error');
    }elseif (empty($username) && !empty($password)) {
        header('location:../index.php?msg=username field is required&type=error');
    }
    else{

        $stmt_Update_Payment = $dbconnect->prepare("SELECT * FROM users WHERE username = ? and password = ?");
        $stmt_Update_Payment->bind_param("ss", $username, $password);
        $stmt_Update_Payment->execute();
        $loginGet = $stmt_Update_Payment->get_result();
        if ($loginGet->num_rows > 0) {
            
            while ($loginAns = mysqli_fetch_array($loginGet)) {
                if ($loginAns['role'] == 'student') {
                    $_SESSION['auth_user'] = $loginAns['unique_id'];
                    header("location: ../dashboard.php");
                }else{
                    // Unset all of the session variables
                    unset($_SESSION["auth_user"]);
                    session_destroy();
                    
                    // Redirect to login page
                    header("location: ../index.php?msg=Invalid%20username%20or%20password&type=information");
                }
            
            }
        } else {
            header('location:../index.php?msg=Invalid%20username%20or%20password&type=error');
        }

    }
}
