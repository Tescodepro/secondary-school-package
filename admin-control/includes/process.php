<?php
    include 'database.php';
    // insert student data into the database
    if (isset($_POST['add_student'])) {
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
        $unique_id = mysqli_real_escape_string($dbconnect, $_POST['unique_code']);
        
        // get last id from users table
        // $last_id_sql = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
        // $last_id_data = mysqli_query($dbconnect, $last_id_sql);
        // $last_id_row = mysqli_fetch_array($last_id_data);
        // $last_id = intval($last_id_row['id'])+1;
        // $year = date('Y');
        // $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       
        // $rand_alph = substr(str_shuffle($permitted_chars), 0, 4);
        // $unique_id = 'STU/'.$year.'/'.sprintf('%04d',$last_id).'/'.$rand_alph;




        // check if user exit
        
        $users_detail = "INSERT INTO users (f_name, username, email, password, unique_id, role, status) 
        VALUES ('$fullname', '$username', '$email', '$unique_id', '$unique_id', 'student', '1')";
        $users_detail_run = mysqli_query($dbconnect, $users_detail);
        if ($users_detail_run) {
            $student_detail = "INSERT INTO students_info (user_id, blood_group, religion, gender, dob, parent_email, parent_name, parent_address, parent_phone_num)
            VALUES ('$unique_id', '$blood_group', '$religion', '$gender', '$dob', '$parent_email', '$parent_name', '$parent_address', '$parent_phone')";
            $student_detail_run = mysqli_query($dbconnect, $student_detail);
            if ($student_detail_run) {
                $class_detail = "INSERT INTO class_track (class_id, user_id, level) VALUES ('$class_id', '$unique_id', '$level')";
                $class_detail_run = mysqli_query($dbconnect, $class_detail);
                if ($class_detail_run) {
                    header('Location:../admit-form.php?msg=Student added successfully&type=success');
                } else {
                    header('Location:../admit-form.php?msg=Something went wrong&type=error');
                }
            } else {
                header('Location:../admit-form.php?msg=Something went wrong&type=error');
            }
        }      
    }

    if (isset($_POST['update_student'])) {
        $fullname = mysqli_real_escape_string($dbconnect, $_POST['fullname']);
        $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
        $gender = mysqli_real_escape_string($dbconnect, $_POST['gender']);
        $dob = mysqli_real_escape_string($dbconnect, $_POST['dob']);
        $blood_group = mysqli_real_escape_string($dbconnect, $_POST['blood_group']);
        $religion = mysqli_real_escape_string($dbconnect, $_POST['religion']);
        $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
        $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
        $phone = mysqli_real_escape_string($dbconnect, $_POST['phone']);
        $parent_name = mysqli_real_escape_string($dbconnect, $_POST['parent_name']);
        $parent_phone = mysqli_real_escape_string($dbconnect, $_POST['parent_phone']);
        $parent_email = mysqli_real_escape_string($dbconnect, $_POST['parent_email']);
        $parent_address = mysqli_real_escape_string($dbconnect, $_POST['parent_address']);
        
       $unique_id = $_POST['id'];


        // check if user exitgender
        
        $users_detail = "UPDATE users SET f_name='$fullname',username='$phone', email='$email' WHERE unique_id = '$unique_id'";
        $users_detail_run = mysqli_query($dbconnect, $users_detail);
        if ($users_detail_run) {
            $student_detail = "UPDATE students_info SET blood_group = '$blood_group', religion = '$religion', gender = '$gender', dob = '$dob', parent_email = '$parent_email', 
            parent_name = '$parent_name', parent_address = '$parent_address', parent_phone_num = '$parent_phone' WHERE user_id = '$unique_id'";
            $student_detail_run = mysqli_query($dbconnect, $student_detail);
            if ($student_detail_run) {
                $class_detail = "UPDATE class_track  SET class_id = '$class_id', level = '$level' WHERE user_id = '$unique_id'";
                $class_detail_run = mysqli_query($dbconnect, $class_detail);
                if ($class_detail_run) {
                    header('Location:../all-student.php?msg=Student update successfully&type=success');
                } else {
                    header('Location:../all-student.php?msg=Something went wrong&type=error');
                }
            } else {
                header('Location:../all-student.php?msg=Something went wrong&type=error');
            }
        }      
    }

    // delete student
    if (isset($_POST['dalate_students'])) {
        $id = $_POST['id'];
        $delete_payment = "DELETE FROM users WHERE unique_id = '$id'";
        $delete_payment_run = mysqli_query($dbconnect, $delete_payment);
        if ($delete_payment_run) {
            header('Location:../all-student.php?msg=Student deleted successfully&type=success');
        }
    }

    // dalate_teacher

    if (isset($_POST['dalate_teacher'])) {
        $id = $_POST['id'];
        $delete_payment = "DELETE FROM users WHERE unique_id = '$id'";
        $delete_payment_run = mysqli_query($dbconnect, $delete_payment);
        if ($delete_payment_run) {
            header('Location:../all-teacher.php?msg=Teacher deleted successfully&type=success');
        }
    }

    if (isset($_POST['add_teacher'])) {
        $fullname = mysqli_real_escape_string($dbconnect, $_POST['fullname']);
        $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
        $gender = mysqli_real_escape_string($dbconnect, $_POST['gender']);
        $dob = mysqli_real_escape_string($dbconnect, $_POST['dob']);
        $blood_group = mysqli_real_escape_string($dbconnect, $_POST['blood_group']);
        $religion = mysqli_real_escape_string($dbconnect, $_POST['religion']);
        $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
        $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
        $username = mysqli_real_escape_string($dbconnect, $_POST['username']);
        
        // get last id from users table
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       
        $rand_alph = substr(str_shuffle($permitted_chars), 0, 2);
        $unique_id = rand(000000, 999999).'/'.$rand_alph;


        // check if user exit
        
        $users_detail = "INSERT INTO users (f_name, username, email, password, unique_id, role, status) 
        VALUES ('$fullname', '$username', '$email', '$unique_id', '$unique_id', 'teacher', '1')";
        $users_detail_run = mysqli_query($dbconnect, $users_detail);
        if ($users_detail_run) {
            $student_detail = "INSERT INTO teachers_info (teacher_id, blood_group, religion, gender, dob)
            VALUES ('$unique_id', '$blood_group', '$religion', '$gender', '$dob')";
            $student_detail_run = mysqli_query($dbconnect, $student_detail);
            if ($student_detail_run) {
                    header('Location:../add-teacher.php?msg=Teacher added successfully&type=success');
            } else {
                header('Location:../add-teacher.php?msg=Something went wrong&type=error');
            }
        }      
    }

    if (isset($_POST['update_teacher'])) {
        $fullname = mysqli_real_escape_string($dbconnect, $_POST['fullname']);
        $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
        $gender = mysqli_real_escape_string($dbconnect, $_POST['gender']);
        $dob = mysqli_real_escape_string($dbconnect, $_POST['dob']);
        $blood_group = mysqli_real_escape_string($dbconnect, $_POST['blood_group']);
        $religion = mysqli_real_escape_string($dbconnect, $_POST['religion']);
        $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
        $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
        $username = mysqli_real_escape_string($dbconnect, $_POST['username']);
        
       $unique_id = $_POST['id'];


        // check if user exitgender
        
        $users_detail = "UPDATE users SET f_name='$fullname',username='$username', email='$email' WHERE unique_id = '$unique_id'";
        $users_detail_run = mysqli_query($dbconnect, $users_detail);
        if ($users_detail_run) {
            $student_detail = "UPDATE teachers_info SET blood_group = '$blood_group', religion = '$religion', gender = '$gender', dob = '$dob' WHERE teacher_id = '$unique_id'";
            $student_detail_run = mysqli_query($dbconnect, $student_detail);
            if ($student_detail_run) {
                    header('Location:../all-teacher.php?msg=Teacher update successfully&type=success');
            } else {
                header('Location:../all-teacher.php?msg=Something went wrong&type=error');
            }
        }      
    }

    // assign class to teacher and adding to class_assign table
    if (isset($_POST['assign_teacher'])) {
        $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
        $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
        $teacher_id = mysqli_real_escape_string($dbconnect, $_POST['teacher_id']);
        $subject_id = mysqli_real_escape_string($dbconnect, $_POST['subject_id']);
        
        // check if user exit

        $class_detail = "INSERT INTO class_assign (class_id, level, teacher_id, subject) 
        VALUES ('$class_id', '$level', '$teacher_id', '$subject_id')";
        $class_detail_run = mysqli_query($dbconnect, $class_detail);
        if ($class_detail_run) {
            header('Location:../assign-teacher.php?msg=Class assigned successfully&type=success');
        } else {
            header('Location:../assign-teacher.php?msg=Something went wrong&type=error');
        }      
    }    

    if (isset($_POST['update_class'])) {

        $class_name = mysqli_real_escape_string($dbconnect, $_POST['class_name']);
        $class_code = mysqli_real_escape_string($dbconnect, $_POST['class_code']);
        
       $unique_id = $_POST['id'];


        // check if user exitgender
        $check_class = "SELECT * FROM classes WHERE id != '$unique_id' and class_name = '$class_name' and class_code = '$class_code'";
        $classes_check_run = mysqli_query($dbconnect, $check_class);
       $rows_classes_check_run= mysqli_num_rows($classes_check_run);
        // type of variable $rows_classes_check_run is integer

        
        if ($rows_classes_check_run == 0) {
            $classes_detail = "UPDATE classes SET class_name='$class_name', class_code='$class_code' WHERE id  = '$unique_id'";
                $classes_detail_run = mysqli_query($dbconnect, $classes_detail);
                if ($classes_detail_run) {
                    header('Location:../classes.php?msg=Class updated successfully&type=success');
                }
            }else {
                header('Location:../classes.php?msg=The class you entered already exist&type=error');
            }
    } 
    
    if (isset($_POST['add_class'])) {

        $class_name = mysqli_real_escape_string($dbconnect, $_POST['class_name']);
        $class_code = mysqli_real_escape_string($dbconnect, $_POST['class_code']);


        // check if user exitgender
        $check_class = "SELECT * FROM classes WHERE class_name = '$class_name' and class_code = '$class_code'";
        $classes_check_run = mysqli_query($dbconnect, $check_class);
       $rows_classes_check_run= mysqli_num_rows($classes_check_run);
        
        if ($rows_classes_check_run < 1) {
            $classes_detail = "INSERT INTO classes (class_name, class_code) VALUES('$class_name', '$class_code')";
                $classes_detail_run = mysqli_query($dbconnect, $classes_detail);
                if ($classes_detail_run) {
                    header('Location:../classes.php?msg=Class added successfully&type=success');
                }
            }else {
                header('Location:../classes.php?msg=The class you entered already exist&type=error');
            }
    } 

    if (isset($_POST['add_subject'])) {

        $subject_name = mysqli_real_escape_string($dbconnect, $_POST['subject_name']);

        // check if user exitgender
        $check_class = "SELECT * FROM subject WHERE subject_name = '$subject_name'";
        $classes_check_run = mysqli_query($dbconnect, $check_class);
       $rows_classes_check_run= mysqli_num_rows($classes_check_run);
        
        if ($rows_classes_check_run == 0) {
            $classes_detail = "INSERT INTO subject (subject_name) VALUES('$subject_name')";
                $classes_detail_run = mysqli_query($dbconnect, $classes_detail);
                if ($classes_detail_run) {
                    header('Location:../subject.php?msg=Subject updated successfully&type=success');
                }
            }else {
                header('Location:../subject.php?msg=The subject you entered already exist&type=error');
            }
    } 

    if (isset($_POST['update_subject'])) {

        $subject_name = mysqli_real_escape_string($dbconnect, $_POST['subject_name']);
        $unique_id = $_POST['id'];
       
        // check if user exitgender
        $check_class = "SELECT * FROM subject WHERE id != '$unique_id' and subject_name = '$subject_name'";
        $classes_check_run = mysqli_query($dbconnect, $check_class);
       $rows_classes_check_run= mysqli_num_rows($classes_check_run);

        if ($rows_classes_check_run == 0) {
            $classes_detail = "UPDATE subject SET subject_name='$subject_name' WHERE id  = '$unique_id'";
                $classes_detail_run = mysqli_query($dbconnect, $classes_detail);
                if ($classes_detail_run) {
                    header('Location:../subject.php?msg=Subject updated successfully&type=success');
                }
            }else {
                header('Location:../subject.php?msg=The subject you entered already exist&type=error');
            }
    } 

    //  fees

    if (isset($_POST['add_payment'])) {
        
        $payment_type = mysqli_real_escape_string($dbconnect, $_POST['payment_type']);
        $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
        $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
        $amount = mysqli_real_escape_string($dbconnect, $_POST['amount']);
        $session = mysqli_real_escape_string($dbconnect, $_POST['session']);

        // check if user exitgender
        $add_payment = "SELECT * FROM set_payment WHERE payment_type = '$payment_type' AND amount = '$amount' AND class_id= '$class_id' AND level = '$level' AND session = '$session'";
        $add_payment_run = mysqli_query($dbconnect, $add_payment);
        $rows_add_payment_run= mysqli_num_rows($add_payment_run);
        
        if ($rows_add_payment_run == 0) {
            $classes_detail = "INSERT INTO set_payment (payment_type, amount, class_id, level, user_id, session) VALUES('$payment_type', '$amount', '$class_id', '$level', 'null', '$session')";
                $classes_detail_run = mysqli_query($dbconnect, $classes_detail);
                if ($classes_detail_run) {
                    header('Location:../all-fees.php?msg=Payment added successfully&type=success');
                }
            }else {
                header('Location:../all-fees.php?msg=The payment you entered already exist&type=error');
            }
    }

    if (isset($_POST['update_payment'])) {
        
        $payment_type = mysqli_real_escape_string($dbconnect, $_POST['payment_type']);
        $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
        $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
        $amount = mysqli_real_escape_string($dbconnect, $_POST['amount']);
        $session = mysqli_real_escape_string($dbconnect, $_POST['session']);

        $id = $_POST['id'];

        // check if user exitgender
        $add_payment = "SELECT * FROM set_payment WHERE payment_type = '$payment_type' AND amount = '$amount' AND class_id= '$class_id' AND level = '$level' AND session = '$session' AND payment_id != '$id' ";
        $add_payment_run = mysqli_query($dbconnect, $add_payment);
        $rows_add_payment_run= mysqli_num_rows($add_payment_run);
        // echo $add_payment;
        if ($rows_add_payment_run == 0) {
            $update_payment = "UPDATE set_payment SET  payment_type ='$payment_type', amount ='$amount', class_id ='$class_id', level ='$level', session ='$session' WHERE payment_id = '$id'";
                $update_payment_run = mysqli_query($dbconnect, $update_payment);
                if ($update_payment_run) {
                    header('Location:../all-fees.php?msg=Payment updated successfully&type=success');
                }
            }else {
                header('Location:../all-fees.php?msg=The payment you entered already exist&type=error');
            }
    }


    if (isset($_POST['add_outstanding_payment'])) {
        
        $payment_type = mysqli_real_escape_string($dbconnect, $_POST['payment_type']);
        $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
        $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
        $amount = mysqli_real_escape_string($dbconnect, $_POST['amount']);
        $session = mysqli_real_escape_string($dbconnect, $_POST['session']);
        $unique_id = mysqli_real_escape_string($dbconnect, $_POST['unique_id']);

        // check if user exitgender
        $add_payment = "SELECT * FROM set_payment WHERE payment_type = '$payment_type' AND amount = '$amount' AND class_id= '$class_id' AND level = '$level' AND session = '$session' AND user_id = '$unique_id'";
        $add_payment_run = mysqli_query($dbconnect, $add_payment);
        $rows_add_payment_run= mysqli_num_rows($add_payment_run);
        
        if ($rows_add_payment_run == 0) {
            $classes_detail = "INSERT INTO set_payment (payment_type, amount, class_id, level, user_id, session) VALUES('$payment_type', '$amount', '$class_id', '$level', '$unique_id', '$session')";
                $classes_detail_run = mysqli_query($dbconnect, $classes_detail);
                if ($classes_detail_run) {
                    header('Location:../add-outstanding-pay.php?msg=Payment added successfully&type=success');
                }
            }else {
                header('Location:../add-outstanding-pay.php?msg=The payment you entered already exist&type=error');
            }
    }

    if (isset($_POST['update_outstanding_payment'])) {
        
        $payment_type = mysqli_real_escape_string($dbconnect, $_POST['payment_type']);
        $class_id = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
        $level = mysqli_real_escape_string($dbconnect, $_POST['level']);
        $amount = mysqli_real_escape_string($dbconnect, $_POST['amount']);
        $session = mysqli_real_escape_string($dbconnect, $_POST['session']);
        $unique_id = mysqli_real_escape_string($dbconnect, $_POST['unique_id']);

        $id = $_POST['id'];

        // check if user exitgender
        $add_payment = "SELECT * FROM set_payment WHERE payment_type = '$payment_type' AND amount = '$amount' AND class_id= '$class_id' AND level = '$level' AND session = '$session' AND user_id = '$unique_id' AND payment_id != '$id' ";
        $add_payment_run = mysqli_query($dbconnect, $add_payment);
        $rows_add_payment_run= mysqli_num_rows($add_payment_run);
        // echo $add_payment;
        if ($rows_add_payment_run == 0) {
            $update_payment = "UPDATE set_payment SET  payment_type ='$payment_type', amount ='$amount', class_id ='$class_id', level ='$level', session ='$session', user_id = '$unique_id' WHERE payment_id = '$id'";
                $update_payment_run = mysqli_query($dbconnect, $update_payment);
                if ($update_payment_run) {
                    header('Location:../add-outstanding-pay.php?msg=Payment updated successfully&type=success');
                }
            }else {
                header('Location:../add-outstanding-pay.php?msg=The payment you entered already exist&type=error');
            }
    }

    // delete payment

    if (isset($_POST['dalate_student'])) {
        $id = $_POST['id'];
        $delete_payment = "DELETE FROM set_payment WHERE payment_id = '$id'";
        $delete_payment_run = mysqli_query($dbconnect, $delete_payment);
        if ($delete_payment_run) {
            header('Location:../all-fees.php?msg=Payment deleted successfully&type=success');
        }
    }

    
?>