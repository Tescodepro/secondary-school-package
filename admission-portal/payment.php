<?php

if (isset($_GET['ref'])) {
    // echo 'hi'; 
    $app_id  = $_GET['app_id']; 
    $ref_no = $_GET['ref'];
    $amount = $_GET['amount'];
    $email = $_GET['email'];
    $payment_type = $_GET['payment_type'];
    include 'database.php'; 

        if($payment_type == 'application form') {
            // echo 'hi';
            $Update_payment_application_form = "UPDATE  admission_user  SET application_found  = '1'  WHERE assign_id ='$app_id'";
            $Update_paymentResult_application_form = mysqli_query($dbconnect, $Update_payment_application_form);
            if ($Update_paymentResult_application_form){
                header('location:dashboard.php');
            }
        }elseif ($payment_type == 'paymentStatus') {
            $Update_payment_paymentStatus  = "UPDATE  admission_user  SET acceptance_found  = '1'  WHERE assign_id ='$app_id'";
            $Update_paymentResult_paymentStatus  = mysqli_query($dbconnect, $Update_payment_paymentStatus );
            if ($Update_paymentResult_paymentStatus ){
                header('location:dashboard.php');
            }
        } 
}

?>