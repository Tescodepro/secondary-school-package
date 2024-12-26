<?php include 'includes/isLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $title = $fullname." ". $unique_id." Result (".$session.")";
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
									<!-- Add the bg color to the header using any of the bg-* classes -->
									<div class="widget-user-header bg-primary" style="background: url('assets/image/gallery/full/10.jpg') center center;">
										<h3 class="widget-user-username">Get Result</h3>
									</div>
									<div class="widget-user-image">
										<img class="rounded-circle" src="assets/images/logo.png" width="50" height="50" alt="User Avatar">
									</div>
									<div class="box-footer">  </div>
								</div>
								
									<div class="row pr-4 pl-4"> 
										<div class="col-md-12">
											<div class="box">
												<div class="rw" style="margin-top: 10px; display: flex; justify-content: space-between;">
													<div class="col-6 col-lg-6 col-xl-6">
														<h4 class="box-title">Search Result</h4>
													</div>
												</div><hr>
												
											<form action="" method="post">
												<div class="box-body">
													<!-- input display total value -->
													<div class="row">
														<div class="col-md-4">
															<div class="form-group">
																<label class="control-label">Class</label>
																<select name="class_id" class="form-control">
																	<option value="" > --choose-- </option>
																	<!-- select class from database -->
																	<?php
																	$get_classes = "SELECT * FROM classes";
																	$class_result = mysqli_query($dbconnect, $get_classes);
																	while ($row_classes = mysqli_fetch_array($class_result)) {
																		echo '<option value="'.$row_classes["id"].'">'.$row_classes["class_name"].' ('.$row_classes["class_code"].')</option>';
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label class="control-label">Level</label>
																<select name="level" class="form-control">
																	<option value="" > --choose level-- </option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																</select>
															</div>
														</div>
														<div class="col-md-4">
															<div class="form-group">
																<label class="control-label">Terms</label>
																<select name="terms" class="form-control">
																	<option value="" > --choose-- </option>
																	<option value="first">first term</option>
																	<option value="second">second term</option>
																	<option value="third">third term</option>
																</select>
															</div>
														</div>
														<div class="col-12 col-lg-12 col-xl-12">
															<button type="submit" class="btn btn-success btn-sm" name="search_result">Get Student Results <span class="path1"></span><span class="path2"></span><i class="glyphicon glyphicon-search"></i> </button>														</div>
													
															<!-- <input type="submit" class="btn btn-success btn-sm" name="search_result" value="Search"> -->
														</div>
													</div>
											</form>
													
												</div>
										</div>	
											<div class="box">
												<div class="box-header with-border">
													<h3 class="box-title">Student Results Distribution</h3>
													<h6 class="box-subtitle">Get students results</h6>
												</div> 
												<div class="box-body">
													<div class="table-responsive">
														<table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
															<thead>
																<tr>
																	<th>S/No</th>
																	<th>Subjects</th>
																	<th>Apitude(/5)</th>
																	<th>Mid Term(/15)</th>
																	<th>Exam Score (/80)</th>
																	<th>Total Score(/100)</th>
																	<th>Grade Key/Point</th>
																	<th>Grade Remark</th>
																	<th>Class Average Score</th>
																</tr>
															</thead>
															<tbody> 
																<?php
																	if (isset($_POST['search_result'])) {
																		$i = 1;
																		$class_id = $_POST['class_id'];
																		$level = $_POST['level'];
																		$terms = $_POST['terms'];

																		$result_search = "SELECT * FROM result WHERE 
																		class_id = '$class_id' AND terms = '$terms' AND level = '$level'";
																		$result_result = mysqli_query($dbconnect, $result_search);
																		while($row_result_result = mysqli_fetch_array($result_result)) {
																			if ($row_result_result['user_id'] == $unique_id) {
																				$subject = $row_result_result['subject'];
																				$total_score = intval($row_result_result['exam_score'])+intval($row_result_result['total_ca'])+intval($row_result_result['attitude']);
																				if ($total_score >= 70) {
																					$grade_point = 'A';
																					$grade_remark = 'Excellent';
																				}elseif($total_score > 59) {
																					$grade_point = "B";
																					$grade_remark = 'Very Good';
																				}elseif($total_score > 49) {
																					$grade_point = "C";
																					$grade_remark = "Good";
																				}elseif($total_score > 40) {
																					$grade_point = "D";
																					$grade_remark = "Fearly Good";
																				}elseif($total_score > 30) {
																					$grade_point = "E";
																					$grade_remark = "Fear";
																				}elseif($total_score > 0) {
																					$grade_point = "F";
																					$grade_remark = "Fail";
																				}
																				echo '<tr>';
																				echo '<td>'.$i++.'</td>';
																				$get_subject_name = "SELECT * FROM subject WHERE id = '$subject'";
																				$get_subject_name_result = mysqli_query($dbconnect, $get_subject_name);
																				while($row_get_subject_name_result = mysqli_fetch_array($get_subject_name_result)) {
																					echo '<td>'.$row_get_subject_name_result['subject_name'].'</td>';
																				}
																				echo '<td>'.$row_result_result['attitude'].'</td>';
																				echo '<td>'.$row_result_result['total_ca'].'</td>';
																				echo '<td>'.$row_result_result['exam_score'].'</td>';
																				echo '<td>'.$total_score.'</td>';
																				echo '<td>'.$grade_point.'</td>';
																				echo '<td>'.$grade_remark.'</td>';
																				// average score
																				$average_score = "SELECT subject, sum(exam_score + total_ca + attitude) as total, COUNT(subject) as sub FROM result GROUP BY subject";
																				$average_result = mysqli_query($dbconnect, $average_score);
																				while($row_average_result = mysqli_fetch_array($average_result)) {
																					if ($row_average_result['subject'] == $subject) {
																						echo '<td>'.$average_score = $row_average_result['total']/$row_average_result['sub'].'</td>';
																					}
																				}
																			}
																		}
																		echo '</tr>';
																	}
																?>
															</tbody>
															<tfoot>
																<tr>
																	<th>S/No</th>
																	<th>Subjects</th>
																	<th>Apitude</th>
																	<th>Total C A</th>
																	<th>Exam Score</th>
																	<th>Total Score</th>
																	<th>Grade Key/Point</th>
																	<th>Grade Remark</th>
																	<th>Class Average Score</th>
																</tr>
															</tfoot>	
														</table>
													</div>              
												</div> 
											</div>
										</div>
									</div>  
							</div>
					</div>
				</div>  
			</div>
        <!-- /.content-wrapper -->

		
        <footer class="main-footer">
            &copy; <?php echo date('Y') ?> OTA TOTAL ACADEMY | 
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
