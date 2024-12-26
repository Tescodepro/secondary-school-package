<?php
include 'includes/database.php';
if (isset($_GET['ref'])) {
    $_GET['paystarck_money'];
    $school_fee =  $_GET['school_fees'];
    $unique_id =  $_GET['unique_id'];
    $ref =  $_GET['ref'];
    $size =  $_GET['size'];
    $session =  $_GET['session'];
    $amountExpected_schoolFEE =  $_GET['amountExpected'];
    // update school fee paid amountExpected
    for ($i = 0; $i < $size; $i++) {
        $key_type_paid =  $_GET[$i];
       $payment_exploded[] = explode('_', $_GET[$i]);
       
    }
    foreach ($payment_exploded as $payment_esc) {
       echo $amount_paid = intval($payment_esc[0]);
       echo $payment_type = $payment_esc[1];

       $update_school_fee_paid = "UPDATE student_payment SET amount_topay = '$amount_paid', amount_paid = '$amount_paid', paystack_retune = 1 , paystack_ref = '$ref',
       amount_justpaid = '$amount_paid' WHERE user_id = '$unique_id' AND payment_type = '$payment_type' AND session = '$session'";
       $run_school_fee_paid = mysqli_query($dbconnect, $update_school_fee_paid);
    }

    // update school fee paid
   if ($school_fee != 0) {
        
    
                $last_paid_school_fee = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = 'school fee' AND session = '$session'";
                $run_last_paid_school_fee = mysqli_query($dbconnect, $last_paid_school_fee);
                $row_last_paid_school_fee = mysqli_fetch_array($run_last_paid_school_fee);
                $last_paid_school_fee_amount = $row_last_paid_school_fee['amount_paid'];
                $balance_school_fee = $school_fee + $last_paid_school_fee_amount;
    
                if ($amountExpected_schoolFEE <= $balance_school_fee) {
                    $paystarck_return =  1;
                }elseif ($amountExpected_schoolFEE != $balance_school_fee){
                    $paystarck_return =  2;
                }

                $update_paid_school_fee = "UPDATE student_payment SET paystack_retune =  '$paystarck_return' , paystack_ref = '$ref', amount_topay = '$amountExpected_schoolFEE', amount_paid = '$balance_school_fee' WHERE user_id = '$unique_id' AND payment_type = 'school fee' AND session = '$session'";
                $run_update_paid_school_fee = mysqli_query($dbconnect, $update_paid_school_fee);
    }

    // return to fees page
    header("location: fees.php?msg=Payment%20Successful&type=success");

}

?>