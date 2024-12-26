<?php
include 'includes/isLogedin.php';
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Students Details</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="fonts/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>

<body>
<div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php include_once('layout/nav-header.php');?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php include_once('layout/side-bar.php');?>
            <!-- Sidebar Area End Here -->
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Students</h3>
                    <ul>
                        <li>
                        <a href="all-student.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Student list</a>
                        </li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Student Details Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>About Student</h3>
                            </div>
                        </div>
                        <div class="single-info-details">
                            <!-- <div class="item-img">
                                <img src="img/figure/student1.jpg" alt="student">
                            </div> -->
                            <?php
                            $id = $_GET['id'];
                            $get_student_data = "SELECT * FROM users INNER JOIN class_track ON users.unique_id = class_track.user_id INNER JOIN classes ON class_track.class_id = classes.id INNER JOIN students_info ON users.unique_id = students_info.user_id WHERE users.unique_id = '$id'";
                            $run_student_data = mysqli_query($dbconnect, $get_student_data);
                            $row = mysqli_fetch_array($run_student_data);
                            // echo $user_id = $row['unique_id'];
            
                            ?>
                            <div class="item-content">

                                <div class="header-inline item-header">
                                    <h3 class="text-dark-medium font-medium"><?php echo $row['f_name'];?></h3>
                                </div>
                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['f_name'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['gender'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Date Of Birth:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['dob'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Religion:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['religion'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Blood Group:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['blood_group'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Class:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['class_name'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Level:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['level'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Parent Name:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['parent_name'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Parent Address:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['parent_address'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Parent Phone:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['parent_phone_num'];?></td>
                                            </tr>
                                            <tr>
                                                <td>Parent Email:</td>
                                                <td class="font-medium text-dark-medium"><?php echo $row['parent_email'];?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Student Details Area End Here -->
                <footer class="footer-wrap-layout1">
                    <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
                </footer>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script data-cfasync="false" src="../../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>


<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/student-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jun 2022 14:38:51 GMT -->
</html>