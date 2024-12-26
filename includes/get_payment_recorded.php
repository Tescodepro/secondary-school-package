<?php
if (isset($_POST['pay_now'])) { 

    $sum_total_payment_to_paystack = $_POST['total_amount'];

    $school_payment_ref = $_POST['school_payment_ref'];
    $school_fee_amount_top = intval($_POST['school_fee_amount']);
    $school_fee_topay = intval($_POST['school_fee_topay']);
    $other_payment = $_POST['other_payment'];
    if ($other_payment == '') {
        $other_payment = [];
    }else{
        $other_payment = $_POST['other_payment'];
    }
    $other_payment_arr = http_build_query($other_payment);
   
     $size_of_other_payment = sizeof($other_payment);



    if ($school_fee_amount_top == 0 && sizeof($other_payment) != 0) { 
        foreach($other_payment as $payment) {
            $payment_exploded[] = explode('_', $payment);
        }
        foreach ($payment_exploded as $payment_esc) {
            $amount_paid = intval($payment_esc[0]);
            $payment_type = $payment_esc[1];
            
            // check if other payment is not empty
            $get_otherpayment_paid = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = '$payment_type' AND session = '$session'";
            $run_otherpayment_paid = mysqli_query($dbconnect, $get_otherpayment_paid); 

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

        echo'<div class="modal fade" id="confirmationlast">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Comfirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <strong>You are about to make this payments as selected. Do note that N300 will be charged from your account for the payment gateway (PAYSTACK).</strong> 
       
               </div>
               <div class="modal-footer">
               <a href="fees.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
               <script src="https://js.paystack.co/v1/inline.js"></script>
             <button class="btn btn-me mb-3" type="button" onclick="payWithPaystack()"> Proceed to make Payment <i class="fa fa-arrow-right"></i></button>
             </div>
               </div>
           </div>
           <!-- /.modal-content -->
       </div>
       <!-- /.modal-dialog -->
   </div>';

    }
    elseif ($school_fee_amount_top != 0 && sizeof($other_payment) != 0) {
        // pay other payment first
        foreach($other_payment as $payment) {
            $payment_exploded[] = explode('_', $payment);
        }
        foreach ($payment_exploded as $payment_esc) {
            $amount_paid = intval($payment_esc[0]);
            $payment_type = $payment_esc[1];
            
            // check if other payment is not empty
            $get_otherpayment_paid = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = '$payment_type' AND session = '$session'";
            $run_otherpayment_paid = mysqli_query($dbconnect, $get_otherpayment_paid); 

            if (mysqli_num_rows($run_otherpayment_paid) == 0) {
                $insert_otherpayment_paid = "INSERT INTO student_payment (user_id, amount_topay, amount_paid, payment_type, session, amount_justpaid, school_payment_ref) VALUES 
                ('$unique_id', '$amount_paid', '$amount_paid', '$payment_type', '$session', '$amount_paid', '$school_payment_ref')";
                $run_otherpayment_paid = mysqli_query($dbconnect, $insert_otherpayment_paid);
        
            } else {
                        $update_school_fee_paid = "UPDATE student_payment SET amount_topay = '$amount_paid', amount_paid = '$amount_paid', 
                        amount_justpaid = '$amount_paid', school_payment_ref = '$school_payment_ref' WHERE user_id = '$unique_id' AND payment_type = '$payment_type' AND session = '$session'";
                        $run_school_fee_paid = mysqli_query($dbconnect, $update_school_fee_paid);
                    }
        }

        // pay school fee
        $check_school_payment = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = 'school fee' AND session = '$session'";
        $run_check_school_payment = mysqli_query($dbconnect, $check_school_payment);
        $count_payment_existence = mysqli_num_rows($run_check_school_payment);
        $count_payment_existence;
        if ($count_payment_existence == 0) {
            $insert_school_fee_paid = "INSERT INTO student_payment (user_id, amount_topay, amount_paid, payment_type, session, amount_justpaid, school_payment_ref) VALUES 
            ('$unique_id', '$school_fee_topay', '$school_fee_amount_top', 'school fee', '$session', '$school_fee_amount_top', '$school_payment_ref')";
            $run_school_fee_paid = mysqli_query($dbconnect, $insert_school_fee_paid);
        }else{
            $last_paid_school_fee = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = 'school fee' AND session = '$session'";
            $run_last_paid_school_fee = mysqli_query($dbconnect, $last_paid_school_fee);
            $row_last_paid_school_fee = mysqli_fetch_array($run_last_paid_school_fee);
            $last_paid_school_fee_amount = $row_last_paid_school_fee['amount_paid'];
            $balance_school_fee = $school_fee_amount_top + $last_paid_school_fee_amount;

            $update_paid_school_fee = "UPDATE student_payment SET amount_topay = '$school_fee_topay' WHERE user_id = '$unique_id' AND payment_type = 'school fee' AND session = '$session'";
            $run_update_paid_school_fee = mysqli_query($dbconnect, $update_paid_school_fee);

        }
        echo'<div class="modal fade" id="confirmationlast">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Comfirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <strong>You are about to make this payments as selected. Do note that N300 will be charged from your account for the payment gateway (PAYSTACK).</strong> 
       
               </div>
               <div class="modal-footer">
               <a href="fees.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
               <script src="https://js.paystack.co/v1/inline.js"></script>
             <button class="btn btn-me mb-3" type="button" onclick="payWithPaystack()"> Proceed to make Payment <i class="fa fa-arrow-right"></i></button>
             </div>
               </div>
           </div>
           <!-- /.modal-content -->
       </div>
       <!-- /.modal-dialog -->
   </div>';

    }
    elseif ($school_fee_amount_top != 0 && sizeof($other_payment) == 0) {

        // pay school fee
        $check_school_payment = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = 'school fee' AND session = '$session'";
        $run_check_school_payment = mysqli_query($dbconnect, $check_school_payment);
        $count_payment_existence = mysqli_num_rows($run_check_school_payment);
        $count_payment_existence;
        if ($count_payment_existence == 0) {
            $insert_school_fee_paid = "INSERT INTO student_payment (user_id, amount_topay, amount_paid, payment_type, session, amount_justpaid, school_payment_ref) VALUES 
            ('$unique_id', '$school_fee_topay', '$school_fee_amount_top', 'school fee', '$session', '$school_fee_amount_top', '$school_payment_ref')";
            $run_school_fee_paid = mysqli_query($dbconnect, $insert_school_fee_paid);
        }else{
            $last_paid_school_fee = "SELECT * FROM student_payment WHERE user_id = '$unique_id' AND payment_type = 'school fee' AND session = '$session'";
            $run_last_paid_school_fee = mysqli_query($dbconnect, $last_paid_school_fee);
            $row_last_paid_school_fee = mysqli_fetch_array($run_last_paid_school_fee);
            $last_paid_school_fee_amount = $row_last_paid_school_fee['amount_paid'];
            $balance_school_fee = $school_fee_amount_top + $last_paid_school_fee_amount;

            $update_paid_school_fee = "UPDATE student_payment SET amount_topay = '$school_fee_topay' WHERE user_id = '$unique_id' AND payment_type = 'school fee' AND session = '$session'";
            $run_update_paid_school_fee = mysqli_query($dbconnect, $update_paid_school_fee);

        }
         echo'<div class="modal fade" id="confirmationlast">
	 			<div class="modal-dialog" role="document">
	 				<div class="modal-content">
	 					<div class="modal-header">
	 						<h4 class="modal-title">Comfirmation</h4>
	 						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	 						<span aria-hidden="true">&times;</span></button>
	 					</div>
	 					<div class="modal-body">
	 					    <strong>You are about to make this payments as selected. Do note that N300 will be charged from your account for the payment gateway (PAYSTACK).</strong> 
                
						</div>
						<div class="modal-footer">
						<a href="fees.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
						<script src="https://js.paystack.co/v1/inline.js"></script>
					  <button class="btn btn-me mb-3" type="button" onclick="payWithPaystack()"> Proceed to make Payment <i class="fa fa-arrow-right"></i></button>
					  </div>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>';

    }

    
   
}

?>