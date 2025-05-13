<?php
 include 'isLogin.php';
 require "../vendor/autoload.php";
 
 use Phpoffice\PhpSpreadsheet\Spreadsheet;
 use Phpoffice\PhpSpreadsheet\Writer\Xlsx;

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP;
                     if (isset($_POST['upload_result'])) {
                        
                        
                        $file = $_FILES['file'];
                        $file_name = $file['name'];
                        $file_tmp = $file['tmp_name'];

                        $level = $_POST['level'];
                        $class_id = $_POST['class_id'];
                        $subject_id = $_POST['subject'];
                        $terms = $_POST['terms'];
                        $today = date("Y-m-d H:i:s"); //date("Y-m-d H:i:s");
                        
                        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_tmp); 
                        $sheetData = $spreadsheet->getActiveSheet()->toArray();
                        foreach ($sheetData as $data) {
                            $name_arr[] = $data[0];
                            $unique_i[] = $data[1];
                            $attitude_arr[] = $data[2];
                            $ca_test_arr[] = $data[3];
                            $exam_score_arr[] = $data[4];
                        }
                        
                       


                        for ($i=1; $i < count($unique_i); $i++) { 
                            $unique_id = $unique_i[$i];
                            $attitude = $attitude_arr[$i];
                            $ca_test = $ca_test_arr[$i];
                            $exam_score = $exam_score_arr[$i];

                            // check if the student result is already in the databaseunique_id  
                            $check_result_sql = "SELECT * FROM result WHERE user_id = '$unique_id' AND class_id = '$class_id' AND subject = '$subject_id' AND terms = '$terms' AND level = '$level'";
                            $check_result_data = mysqli_query($dbconnect, $check_result_sql);
                            $check_result_row = mysqli_num_rows($check_result_data);
                            if ($check_result_row > 0) {
                                $update_result_sql = "UPDATE result SET attitude = '$attitude', total_ca = '$ca_test', exam_score = '$exam_score', updated_at = '$today' WHERE user_id = '$unique_id' AND class_id = '$class_id' AND subject = '$subject_id' AND terms = '$terms' AND level = '$level'";
                                $update_result_data = mysqli_query($dbconnect, $update_result_sql);
                            } else {
                                $insert_result_sql = "INSERT INTO result (user_id, level, class_id, subject, terms, attitude, total_ca, exam_score, teacher_id) VALUES ('$unique_id', '$level', '$class_id', '$subject_id', '$terms', '$attitude', '$ca_test', '$exam_score', '$teacher_id')";
                                $result = mysqli_query($dbconnect, $insert_result_sql);
                            }
                        }

                        if (isset($result) or isset($update_result_data)) {
                            // echo '<center><div style="width: 80%;" class="alert alert-success alert-dismissible fade show" role="alert">
                            //             Result Uploaded Successfully.
                            //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            //                 <span aria-hidden="true">&times;</span>
                            //             </button>
                            //         </div></center>';
                            header('location:../classes.php?type=success&msg=Result Uploaded Successfully');
                        } 
                        else {
                            echo '<center><div style="width: 80%;" class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Error Uploading Result.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div></center>';
                        }
                        
                    }
                ?>