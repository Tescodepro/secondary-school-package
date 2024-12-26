<?php 
    require "vendor/autoload.php";
    use Phpoffice\PhpSpreadsheet\Spreadsheet;
    use Phpoffice\PhpSpreadsheet\Writer\Xlsx;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    include 'includes/isLogin.php'; 
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $title = "My Classes";
        include 'layout/head.php' 
    ?>
    <body class="hold-transition light-skin sidebar-mini theme-primary fixed">
            
        <div class="wrapper">
            <div id="loader"></div>
            
			<?php 
				include 'layout/header.php';
			?>
			
			<?php 
				include 'layout/sidebar.php';
			?>

        	<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<div class="container-full">
					<div class="row">
						<div class="col-12 col-lg-12 col-xl-12">
							<div class="box box-widget widget-user">
								<div class="widget-user-header bg-primary">
									<h3 class="widget-user-username">My Class(es)</h3>
								</div>
							</div>	 
						</div>  
					</div>
				</div>
                <?php
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
                            echo '<center><div style="width: 80%;" class="alert alert-success alert-dismissible fade show" role="alert">
                                        Result Uploaded Successfully.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div></center>';
                        } else {
                            echo '<center><div style="width: 80%;" class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Error Uploading Result.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div></center>';
                        }
                        
                    }
                ?>
				<div class="container">
					<div class="row">
                        <?php 
                            $count = 0;
                            $my_class = mysqli_query($dbconnect, "SELECT * FROM class_assign INNER JOIN classes on classes.id  = class_assign.class_id INNER JOIN subject on subject.id  = class_assign.subject
                            WHERE class_assign.teacher_id = '$teacher_id'");
                            while ($class_row = mysqli_fetch_array($my_class)) {
                                echo '<div class="col-md-6">
                                        <div class="card text-center">
                                            <div class="card-header">
                                                '.$class_row['subject_name'].'
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">'.$class_row['class_name'].' '.$class_row['level'].'</h5>';
                                                // total student
                                                $total_student = mysqli_query($dbconnect, "SELECT COUNT(id) as number_student FROM class_track WHERE class_id = '$class_row[class_id]' and level = '$class_row[level]'");
                                                $total_student_row = mysqli_fetch_array($total_student);
                                                echo '<p class="card-text">Total Student(s): '.$total_student_row['number_student'].'</p>';
                                                // assign_id
                                                $assign_id = $class_row['assign_id'];

                                                ?>
                                               
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#viewStudent<?php echo $assign_id; ?>"> View Student </button>
                                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#resultSheet<?php echo $assign_id; ?>"> Download Result Sheet </button>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#UploadRresult<?php echo $assign_id; ?>"> Upload Result </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade"  id="resultSheet<?php echo $assign_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg"  role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Result Sheet Template</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="box">
                                                                            <div class="box-header with-border">
                                                                                <h3 class="box-title">Student List Result Sheet Template</h3>
                                                                                <h6 class="box-subtitle">Export result sheet to Copy, CSV, Excel, PDF & Print</h6>
                                                                                <code>Note: excel copy of the sheet is only required for result uploading.</code>
                                                                            </div>
                                                                            <!-- /.box-header -->
                                                                            <div class="box-body">
                                                                                <div class="table-responsive">
                                                                                    <table id="exampley<?php echo $count; ?>" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">Name</th>
                                                                                                <th scope="col">Unique Code</th>
                                                                                                <th scope="col">Aptitude</th>
                                                                                                <th scope="col">Mid Term</th>
                                                                                                <th scope="col">Exam</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php 
                                                                                            $i = 1;
                                                                                            $student_list = mysqli_query($dbconnect, "SELECT * FROM class_track INNER JOIN users on users.unique_id = class_track.user_id WHERE class_track.class_id = '$class_row[class_id]' and class_track.level = '$class_row[level]'");
                                                                                            while ($student_list_row = mysqli_fetch_array($student_list)) {
                                                                                            echo'
                                                                                                <tr>
                                                                                                    <td>'.$student_list_row['f_name'].'</td>
                                                                                                    <td>'.$student_list_row['user_id'].'</td>
                                                                                                    <td>0</td>
                                                                                                    <td>0</td>
                                                                                                    <td>0</td>
                                                                                                </tr>';
                                                                                            
                                                                                            }?>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>              
                                                                            </div>
                                                                        </div>                                             
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- List of student start -->
                                                            <div class="modal fade"  id="viewStudent<?php echo $assign_id; ?>" tabindex="-1" role="dialog" aria-labelledby="viewStudent<?php echo $assign_id; ?>" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg"  role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="viewStudent<?php echo $assign_id; ?>">Student list</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="box">
                                                                            <div class="box-header with-border">
                                                                                <h3 class="box-title">Student List</h3>
                                                                                <h6 class="box-subtitle">View list of all your students</h6>
                                                                            </div>
                                                                            <!-- /.box-header -->
                                                                            <div class="box-body">
                                                                                <div class="table-responsive">
					                                                                <table id="example1<?php echo $count; ?>" class="table table-bordered table-striped">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col">S/No</th>
                                                                                                <th scope="col">Full name</th>
                                                                                                <th scope="col">Unique code</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php 
                                                                                            $i = 1;
                                                                                            $student_list = mysqli_query($dbconnect, "SELECT * FROM class_track INNER JOIN users on users.unique_id = class_track.user_id WHERE class_track.class_id = '$class_row[class_id]' and class_track.level = '$class_row[level]'");
                                                                                            while ($student_list_row = mysqli_fetch_array($student_list)) {
                                                                                            echo'
                                                                                                <tr>
                                                                                                    <th scope="row">'.$i++.'</th>
                                                                                                    <td>'.$student_list_row['f_name'].'</td>
                                                                                                    <td>'.$student_list_row['user_id'].'</td>
                                                                                                </tr>';
                                                                                            
                                                                                            }?>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>              
                                                                            </div>
                                                                        </div>                                             
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- List of student end -->
                                                            
                                                            <div class="modal fade" id="UploadRresult<?php echo $assign_id; ?>" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="resultModalLabel">Upload Result</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <?php
                                                                    ?>
                                                                    <form action="classes.php" method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <div class="file-upload-wrapper">
                                                                            <input type="file" name="file" id="input-file-now" class="file-upload" required/>
                                                                            <div class="form-group">
                                                                                <label class="control-label">Terms</label>
                                                                                <select name="terms" class="form-control" required>
                                                                                    <option value="" > --choose-- </option>
                                                                                    <option value="first">first term</option>
                                                                                    <option value="second">second term</option>
                                                                                    <option value="third">third term</option>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="class_id" value="<?php echo $class_row['class_id']; ?>">
                                                                            <input type="hidden" name="level" value="<?php echo $class_row['level']; ?>">
                                                                            <input type="hidden" name="subject" value="<?php echo $class_row['subject']; ?>">
                                                                        </div>
                                                                        <!-- </form> -->
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" name="upload_result" class="btn btn-secondary">Load <span class="load loading"></span> </button>
                                                                    </div>
                                                                    </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                        $count++;    
                        }

                        ?>
						
					</div>
					
				</div>
			</div>  
			
		</div>
        <!-- /.content-wrapper -->

		
        <footer class="main-footer">
            &copy; <?php echo date('Y') ?> OTA Total Academy
        </footer>

        
        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
        
        </div>
        <!-- ./wrapper -->
        
        
        <!-- Page Content overlay -->
        
        
        <!-- Vendor JS -->
        <script src="assets/js/vendors.min.js"></script>
        <script src="assets/js/pages/chat-popup.js"></script>
        <script src="assets/icons/feather-icons/feather.min.js"></script>

        <script src="assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
        <script src="assets/vendor_components/moment/min/moment.min.js"></script>
        <script src="assets/vendor_components/fullcalendar/fullcalendar.js"></script>
		<script src="assets/vendor_components/datatable/datatables.min.js"></script>
        <!-- EduAdmin App -->
        <script src="assets/js/template.js"></script>
        <script src="assets/js/pages/dashboard.js"></script>
        <script src="assets/js/pages/calendar.js"></script>
		
		<script src="assets/js/pages/data-table.js"></script>
        <script>
            const btns = document.querySelectorAll('button');
btns.forEach((items)=>{
    items.addEventListener('click',(evt)=>{
        evt.target.classList.add('activeLoading');
    }) 
})
        </script>
	


		<script type="text/javascript">
        $(document).ready(function() {
            $('.checkbx').click(function() {
                var amount = 0;
                var p = 0;
                $('.checkbx:checked').each(function() {
                   const raw =  $(this).val().split("_");
				   amount = amount + Number(raw[0]);
				   
                });
                $('.inputbx').each(function() {
                    p = Number($(this).val());
                    amount = amount + Number($(this).val());
                });

                $("#selectedAmount").val(amount);
				console.log(amount);
            });
        });
    </script>

	<script>
		function validate_payment() {
            var p = document.getElementById("selectedAmount").value;
            console.log(p);
			if (p == 0) {
                p = 'You must select a payment';
                document.getElementById("myText").style.color = 'red';
                document.getElementById("MakePayment").disabled = true;
                document.getElementById("myText").value = p;

            } else {
                document.getElementById("myText").style.color = 'green';
                document.getElementById("MakePayment").disabled = false;
                document.getElementById("myText").value = p;
            }

        }
	</script>

	<script>
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
        });
    </script>
        
    </body>
</html>
