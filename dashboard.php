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
            include 'layout/sidebar.php';
        ?>

        
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                <section class="content">

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

                <div class="row align-items-end">
                    <div class="col-xl-9 col-12">
                        <div class="box bg-primary-light pull-up">
                            <div class="box-body p-xl-5">							
                                <div class="row align-items-center">
                                    <div class="col-12 col-lg-3"><img src="assets/images/svg-icon/color-svg/custom-14.svg" alt=""></div>
                                    <div class="col-12 col-lg-9">
                                        <h3>Hello <?php echo $fullname; ?>, Welcome Back!</h3>
                                        <p class="text-dark mb-0 font-size-15" style="padding-right: 10px; padding-bottom: 5px">
                                            <?php echo $class_name.' '.$level;?> - <span class="text-primary"> <?php echo $class_code.' '.$level;?> </span>
                                        </p>
                                        <p class="text-dark mb-0 font-size-15" style="padding-right: 10px; padding-bottom: 5px">
                                            <?php echo $unique_id;?> </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-12">
                        <div class="box bg-transparent no-shadow">
                            <div class="box-body p-xl-0 text-center">							
                                <p class="px-30 mb-10">You can pay your school fees here(Under Development)</p> 
                                <button type="button" class="waves-effect waves-light btn-block btn btn-primary">Pay now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12">
                        <div class="box box-widget widget-user">
                            <div class="widget-user-header bg-black" style="background: url('assets/images/gallery/full/10.jpg') center center;">
                                <h3 class="widget-user-username">Student's Details</h3>
                            </div>
                            <div class="widget-user-image">
                                <img class="rounded-circle" src="assets/images/user3-128x128.jpg" alt="User Avatar">
                            </div>
                            <div class="box-footer"></div>
                        </div>

                        <div class="box">
                            <div class="box-body box-profile">            
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <h5 class="text-primary">Email :<span class="pl-10" style="color:black;"><?php echo $email; ?></span> </h5>
                                            <h5 class="text-primary">Parent Phone :<span class="pl-10" style="color:black;"><?php echo $parent_phone_num; ?></span></h5>
                                            <h5 class="text-primary">Address :<span class="pl-10" style="color:black;"><?php echo $contact_address; ?></span></h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div>
                                            <h5 class="text-primary">Class :<span class="pl-10" style="color:black;"> <?php echo $class_code.' ('.$class_name;?>)</span> </h5>
                                            <h5 class="text-primary">Level :<span class="pl-10" style="color:black;"><?php echo $level; ?></span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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

        <footer class="main-footer">
            &copy; <?php echo date('Y') ?> SCHOOL NAME |
        </footer>

        <div class="control-sidebar-bg"></div>
        </div>

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
