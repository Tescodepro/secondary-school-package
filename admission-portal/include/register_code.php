<?php
session_start();
include '../database.php'; 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['register'])) {
    
    $Register_user = $dbconnect->prepare("INSERT INTO user(first_name, last_name, email, assign_id) VALUES (?,?,?,?)");
    $Register_user->bind_param("ssss", $first_name, $last_name, $email, $assign_id);

    $first_name = mysqli_real_escape_string($dbconnect, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($dbconnect, $_POST['last_name']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);

    $current_year = date('Y');
    $assign_id = $first_name[0].$last_name[0].'/'.$current_year.'/'.rand (99999999,11111111); 

    if ($Register_user->execute()) {
                
        //Load Composer's autoloader
        require '../vendor/autoload.php';
        // require '../vendor/autoload.php'
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'tescodepro@gmail.com';                     //SMTP username
            $mail->Password   = 'qzkkyoturoxxympp';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('auas@gmail.com', 'AUAS');
            $mail->addAddress($email, 'AUAS');     //Add a recipient
            // $mail->addAddress('ellen@gmail.com');               //Name is optional
            // $mail->addReplyTo('info@gmail.com', 'Information');
            // $mail->addCC('cc@gmail.com');
            // $mail->addBCC('bcc@gmail.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Admission Number Generation';
            $mail->Body =  '<div class="row">
															<div class="col-12">
																<table class="body-wrap" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: transparent; margin: 0;">
																	<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																		<td style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
																		<td class="container" width="600" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
																			valign="top">
																			<div class="content" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
																				<table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 7px; background-color: #fff; color: #495057; margin: 0; box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);"
																					bgcolor="#fff">
																					<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																						<td class="alert alert-success" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 7px 7px 0 0; background-color: #556ee6; margin: 0; padding: 20px;"
																							align="center" bgcolor="#71b6G10" valign="top">
																							<b>Application Number Generation</b>
																						</td>
																					</tr><br>
																					<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																						<td class="content-wrap" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
																							<table width="100%" cellpadding="0" cellspacing="0" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																								
																								<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																												<td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
																												Hi ' . $firstname . ', <br><br>
																												Your account has been successfully created. Please login into your portal for the status of your application. 
																												</td>
																											</tr><br>
																								<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																												<td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
																												Application Number: <b>' . $assign_id . '<br>Thank you for your interest in studying at Adeleke University Ede.
																												</td>
																											</tr><br>
																								 
																								
																								<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																									<td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
																										Thanks for choosing <b>Adeleke University</b>.
																									</td>
																								</tr><br>
																								<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																									<td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
																										<b>Adeleke University</b>
																										<p>Management.</p>
																									</td>
																								</tr>
													
																								<tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
																									<td class="content-block" style="text-align: center;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;" valign="top">
																										© 2021 Adeleke University
																									</td>
																								</tr>
																							</table>
																						</td>
																					</tr>
																				</table>
																			</div>
																		</td>
																	</tr>
																</table>
																<!-- end table -->
															</div>
            											</div>';

            $mail->send();
            header('location:../register.php?msg=Registration successful Application Number has been sent your mail it will be requied to access your portal! &type=success');

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } 

}

if (isset($_POST['add_student'])) {
    $app_id = $_POST['app_id'];
    $fullname = mysqli_real_escape_string($dbconnect, $_POST['fullname']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $gender = mysqli_real_escape_string($dbconnect, $_POST['gender']);
    $dob = mysqli_real_escape_string($dbconnect, $_POST['dob']);
    $blood_group = mysqli_real_escape_string($dbconnect, $_POST['blood_group']);
    $religion = mysqli_real_escape_string($dbconnect, $_POST['religion']);
    $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
    $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
    $username = mysqli_real_escape_string($dbconnect, $_POST['username']);
    $parent_name = mysqli_real_escape_string($dbconnect, $_POST['parent_name']);
    $parent_phone = mysqli_real_escape_string($dbconnect, $_POST['parent_phone']);
    $parent_email = mysqli_real_escape_string($dbconnect, $_POST['parent_email']);
    $parent_address = mysqli_real_escape_string($dbconnect, $_POST['parent_address']);
    
    // get last id from users table
    $last_id_sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
    $last_id_data = mysqli_query($dbconnect, $last_id_sql);
    $last_id_row = mysqli_fetch_array($last_id_data);
    $last_id = intval($last_id_row['id'])+1;
    $year = date('Y');
    $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   
    $rand_alph = substr(str_shuffle($permitted_chars), 0, 4);
    $unique_id = 'STU/'.$year.'/'.sprintf('%04d',$last_id).'/'.$rand_alph;


    // check if user exit
    
    $users_detail = "INSERT INTO users (f_name, username, email, password, unique_id, role, status) 
    VALUES ('$fullname', '$username', '$email', '$unique_id', '$unique_id', 'student', '0')";
    $users_detail_run = mysqli_query($dbconnect, $users_detail);
    if ($users_detail_run) {
        $student_detail = "INSERT INTO students_info (user_id, blood_group, religion, gender, dob, parent_email, parent_name, parent_address, parent_phone_num)
        VALUES ('$unique_id', '$blood_group', '$religion', '$gender', '$dob', '$parent_email', '$parent_name', '$parent_address', '$parent_phone')";
        $student_detail_run = mysqli_query($dbconnect, $student_detail);
        if ($student_detail_run) {
            $class_detail = "INSERT INTO class_track (class_id, user_id, level) VALUES ('$class_id', '$unique_id', '$level')";
            $class_detail_run = mysqli_query($dbconnect, $class_detail);
            if ($class_detail_run) {
                // update admittion table
                $update_admission_user = "UPDATE admission_user SET is_register = '1' WHERE assign_id = '$app_id'";
                if(mysqli_query($dbconnect, $update_admission_user)){
                header('Location:../dashboard.php?msg=Student added successfully&type=success');
                }
            } else {
                header('Location:../dashboard.php?msg=Something went wrong&type=error');
            }
        } else {
            header('Location:../dashboard.php?msg=Something went wrong&type=error');
        }
    }      
}




