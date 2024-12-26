<?php

if (isset($_POST['pay_now'])) { 
    $school_payment_ref = $_POST['school_payment_ref'];


    $school_fee_amount = intval($_POST['school_fee_amount']);
    $school_fee_topay = intval($_POST['school_fee_topay']);
    $other_payment = $_POST['other_payment'];

    if($school_fee_amount != '' and !empty($other_payment)) {
        // get the school fee paid
        $get_school_fee_paid = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = 'school fee'";
        $run_school_fee_paid = mysqli_query($dbconnect, $get_school_fee_paid);

        // if the student has not paid the school fee
        if (mysqli_num_rows($run_school_fee_paid) == 0) { 
            $insert_school_fee_paid = "INSERT INTO student_payment (user_id, amount_topay, amount_paid, payment_type, session, amount_justpaid, school_payment_ref) VALUES 
            ('$unique_id', '$school_fee_topay', '$school_fee_amount', 'school fee', '$session', '$school_fee_amount', '$school_payment_ref')";
            $run_school_fee_paid = mysqli_query($dbconnect, $insert_school_fee_paid);
        }else {

            $row_school_fee_paid = mysqli_fetch_array($run_school_fee_paid);
            $amount_paid = intval($row_school_fee_paid['amount_paid']);
            $school_fee_topay = intval($row_school_fee_paid['amount_topay']);

            $school_fee_amount = intval($amount_paid) + intval($school_fee_amount);
            
            $update_school_fee_paid = "UPDATE student_payment SET amount_topay = '$school_fee_topay', amount_paid = '$school_fee_amount', 
            amount_justpaid = '$school_fee_amount', school_payment_ref = '$school_payment_ref' WHERE user_id = '$unique_id' AND payment_type = 'school fee'";
            $run_school_fee_paid = mysqli_query($dbconnect, $update_school_fee_paid);
        }

        // get the other payment paid
        foreach($other_payment as $payment) {
            $payment_exploded[] = explode('_', $payment);
        }
        foreach ($payment_exploded as $payment_esc) {

            $amount_paid = intval($payment_esc[0]);
            $payment_type = $payment_esc[1];

            $get_otherpayment_paid = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = '$payment_type'";
            $run_otherpayment_paid = mysqli_query($dbconnect, $get_otherpayment_paid);
    
            // if the student has not paid the other payement
            if (mysqli_num_rows($run_otherpayment_paid) == 0) {
                $insert_otherpayment_paid = "INSERT INTO student_payment (user_id, amount_topay, amount_paid, payment_type, session, amount_justpaid, school_payment_ref) VALUES 
                ('$unique_id', '$amount_paid', '$amount_paid', '$payment_type', '$session', '$amount_paid', '$school_payment_ref')";
                $run_otherpayment_paid = mysqli_query($dbconnect, $insert_otherpayment_paid);

            } else {
                $update_school_fee_paid = "UPDATE student_payment SET amount_topay = '$amount_paid', amount_paid = '$amount_paid', 
                amount_justpaid = '$amount_paid', school_payment_ref = '$school_payment_ref' WHERE user_id = '$unique_id' AND payment_type = '$payment_type'";
                $run_school_fee_paid = mysqli_query($dbconnect, $update_school_fee_paid);
            }
    }

        
    } elseif($school_fee_amount == '' and !empty($other_payment)) {

        // get the other payment paid
        foreach($other_payment as $payment) {
            $payment_exploded[] = explode('_', $payment);
        }
        foreach ($payment_exploded as $payment_esc) {
            
            $amount_paid = intval($payment_esc[0]);
            $payment_type = $payment_esc[1];

            $get_otherpayment_paid = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = '$payment_type'";
            $run_otherpayment_paid = mysqli_query($dbconnect, $get_otherpayment_paid);
    
            // if the student has not paid the other payement
            if (mysqli_num_rows($run_otherpayment_paid) == 0) {
                $insert_otherpayment_paid = "INSERT INTO student_payment (user_id, amount_topay, amount_paid, payment_type, session, amount_justpaid, school_payment_ref) VALUES 
                ('$unique_id', '$amount_paid', '$amount_paid', '$payment_type', '$session', '$amount_paid', '$school_payment_ref')";
                $run_otherpayment_paid = mysqli_query($dbconnect, $insert_otherpayment_paid);

            } else {
                $update_school_fee_paid = "UPDATE student_payment SET amount_topay = '$amount_paid', amount_paid = '$amount_paid', 
                amount_justpaid = '$amount_paid', school_payment_ref = '$school_payment_ref' WHERE user_id = '$unique_id' AND payment_type = '$payment_type'";
                $run_school_fee_paid = mysqli_query($dbconnect, $update_school_fee_paid);
            }
    }

} elseif($school_fee_amount != '' and empty($other_payment)) {

    // get the school fee paid
    $get_school_fee_paid = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = 'school fee'";
    $run_school_fee_paid = mysqli_query($dbconnect, $get_school_fee_paid);

    // if the student has not paid the school fee
    if (mysqli_num_rows($run_school_fee_paid) == 0) { 
        $insert_school_fee_paid = "INSERT INTO student_payment (user_id, amount_topay, amount_paid, payment_type, session, amount_justpaid, school_payment_ref) VALUES 
        ('$unique_id', '$school_fee_topay', '$school_fee_amount', 'school fee', '$session', '$school_fee_amount', '$school_payment_ref')";
        $run_school_fee_paid = mysqli_query($dbconnect, $insert_school_fee_paid);
    }else {

        $row_school_fee_paid = mysqli_fetch_array($run_school_fee_paid);
        $amount_paid = intval($row_school_fee_paid['amount_paid']);
        $school_fee_topay = intval($row_school_fee_paid['amount_topay']);

        $school_fee_amount = intval($amount_paid) + intval($school_fee_amount);
        
        $update_school_fee_paid = "UPDATE student_payment SET amount_topay = '$school_fee_topay', amount_paid = '$school_fee_amount', 
        amount_justpaid = '$school_fee_amount', school_payment_ref = '$school_payment_ref' WHERE user_id = '$unique_id' AND payment_type = 'school fee'";
        $run_school_fee_paid = mysqli_query($dbconnect, $update_school_fee_paid);
    }

}
    
}

?>