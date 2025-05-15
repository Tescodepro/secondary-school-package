<?php include 'includes/isLogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $title = "Dashboard - Student Portal";
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
		<!-- Main content -->
		<section class="content">
			<div class="row align-items-end">
				<div class="col-xl-9 col-12">
					<div class="box bg-primary-light pull-up">
						<div class="box-body p-xl-5">							
							<div class="row align-items-center">
								<div class="col-12 col-lg-3"><img src="../assets/images/summit.png" alt=""></div>
								<div class="col-12 col-lg-9">
									<h3>Hello <?php echo $fullname; ?>, Welcome Back!</h3>
									<p class="text-muted">Email: <span class="text-primary"><?php echo $email; ?></span></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
            <?php
                if (isset($_GET['msg']) && isset($_GET['type'])) {
                    $msg = htmlspecialchars(urldecode($_GET['msg']));
                    $type = $_GET['type'];

                    $bgColor = ($type === 'success') ? '#04a08b' : '#04a08b';
                    $textColor = ($type === 'success') ? '#ffffff' : '#ffffff';
                    $borderColor = ($type === 'success') ? '#c3e6cb' : '#f5c6cb';


                    echo "<div style='background-color: $bgColor; color: $textColor; border: 1px solid $borderColor; padding: 10px; margin-bottom: 20px; border-radius: 5px;'>
                        $msg
                    </div>";
                }
                ?>
			<div class="row"> 
				<div class="col-xl-12 col-md-12 col-12">
                    <div class="box">
						<div class="box-body">							
							<div id="calendar" class="dask evt-cal min-h-400"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            &copy; <?php echo date('Y') ?> SCHOOL NAME
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
        
    </body>
</html>
