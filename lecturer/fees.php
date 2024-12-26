<?php include 'includes/isLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $title = "Fees - Student Portal";
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
										<h3 class="widget-user-username">Payment Details</h3>
									</div>
									<div class="widget-user-image">
										<img class="rounded-circle" src="assets/images/user3-128x128.jpg" alt="User Avatar">
									</div>
									<div class="box-footer">  </div>
								</div>
								<form action="fees.php" method="post">
									<div class="row pr-4 pl-4">
										<div class=" payment_list">
											<div class="box">
													<div class="rw" style="margin-top: 10px; display: flex; justify-content: space-between;">
														<div class="col-6 col-lg-6 col-xl-6">
																<h3 class="box-title">Payment Details</h3>
														</div>
													</div><hr>
													<div class="box-body">
														<?php
															include 'includes/get_payment_recorded.php';
															$count_checkBox = 0;
															$count_payment_type = 0;
															$select_payment = "SELECT * FROM set_payment WHERE user_id = '$unique_id'";
															$result_payment = mysqli_query($dbconnect, $select_payment);
															while ($row_payment = mysqli_fetch_assoc($result_payment)) {
															$count_checkBox++;

															if ($row_payment['payment_type'] == 'school fee') {
															?>		
																<div class="d-flex align-items-center mb-25">

																	<span class="bullet bullet-bar bg-success align-self-stretch"></span>	
																	<div class="input-group" style="width: 50%; margin-right: 10%;margin-left: 4%">
																		<div class="input-group-prepend">
																			<button type="button" class="btn btn-primary btn-sm checkbx">+</button>
																		</div>
																		<input type="number" name="school_fee_amount" class="form-control inputbx" min="1" step="any" placeholder="<?php echo $row_payment['amount'] ?>">
																		<input type="hidden" name="school_fee_topay" value="<?php echo $row_payment['amount'] ?>">
																	</div>									
																	<div class="d-flex flex-column flex-grow-1">
																		<a href="#" class="text-dark hover-success font-weight-500 font-size-16">
																			<?php echo $row_payment['payment_type'] ?>
																		</a>
																		<span class="text-fade font-weight-500">
																			<?php echo number_format($row_payment['amount'],2) ?>
																		</span>
																	</div>
																	<div class="dropdown">
																		<a class="px-10 pt-5" href="#" data-toggle="dropdown"><i class="ti-more-alt"></i></a> 
																	</div>							 
																</div>
															<?php
															}
															else {
														?>

														
														<div class="d-flex align-items-center mb-25">
															<span class="bullet bullet-bar bg-success align-self-stretch"></span>							
															
															<div class="h-20 mx-20 flex-shrink-0">							
																<input type="checkbox" id="md_checkbox_<?php echo $count_checkBox; ?>" name="other_payment[]" value="<?php echo $row_payment['amount'].'_'.$row_payment['payment_type'];?>" class="filled-in chk-col-success checkbx">
																<label for="md_checkbox_<?php echo $count_checkBox; ?>" class="h-20 p-10 mb-0"></label>
															</div>

															
															<div class="d-flex flex-column flex-grow-1">
																<a href="#" class="text-dark hover-success font-weight-500 font-size-16">
																	<?php echo $row_payment['payment_type'] ?>
																</a>
																<span class="text-fade font-weight-500">
																	<?php echo number_format($row_payment['amount'],2) ?>
																</span>
															</div>
															<div class="dropdown">
																<a class="px-10 pt-5" href="#" data-toggle="dropdown"><i class="ti-more-alt"></i></a> 
															</div>							 
														</div>
														<?php }
													} ?>
													</div>
											</div>
										</div>	
										<div class=" payment_sum">
											<div class="box">
												<div class="rw" style="margin-top: 10px; display: flex; justify-content: space-between;">
													<div class="col-6 col-lg-6 col-xl-6">
														<h4 class="box-title">Payment Details</h4>
													</div>
												</div><hr>
												<div class="box-body">
													<!-- input display total value -->
													<div class="row">
														<div class="col-12 col-lg-12 col-xl-12">
														<div class="form-group">
															<label class="control-label">Total Amount</label>
															<input type="text" class="form-control" name="total_amount" id="selectedAmount" value="<?php echo number_format($total_amount,2); ?>" readonly >
														</div>
														<button type="button" class="btn btn-success" data-toggle="modal" onclick="validate_payment()" data-target="#modal-default">Proceed to payment confirmation </button>														</div>
													</div>
												</div>
											</div>	
										</div>
										<!-- confirm modal -->
										<div class="modal fade" id="modal-default">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Comfirmation</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span></button>
													</div>
													<div class="modal-body">
														<p>Payment Details&hellip;</p>
														<h4>Name: <span style="font-weight: 100;"> <?php echo $fullname; ?> </span></h4>
														<h4>Narration: <span style="font-weight: 100;"> payment of school fees </span></h4>
														<h4>Reference no.: <span style="font-weight: 100;"> <input type="text" style=" font-weight: 100; width:100%;  border: none; outline:none; width:auto;" name="school_payment_ref" value="<?php echo date('h:m d-m-y').'/'.rand(999999999, 111771111); ?>" readonly> </span></h4>
														<h4>Amount: <input id="myText" class="form-control me-amount" readonly> </h4>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
														<button type="submit" name="pay_now" id="MakePayment" class="btn btn-primary float-right">Confirm</button>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>	
									</div>
								</form>			
							</div>
					</div>
				</div>  
			</div>
        <!-- /.content-wrapper -->

		
        <footer class="main-footer">
            &copy; <?php echo date('Y') ?> School Name | Developed Autobyte & Tesleem (Tescode)
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
        
        <!-- EduAdmin App -->
        <script src="assets/js/template.js"></script>
        <script src="assets/js/pages/dashboard.js"></script>
        <script src="assets/js/pages/calendar.js"></script>

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
