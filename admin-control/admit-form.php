<?php
include 'includes/isLogedin.php';
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Student</title>
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
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="css/datepicker.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php include_once('layout/nav-header.php'); ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php include_once('layout/side-bar.php'); ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Students</h3>
                    <ul>
                        <li>
                            <a href="dashboard.php">Home</a>
                        </li>
                        <li>Student Admit Form</li>
                    </ul>
                </div>
                <?php
                if (isset($_GET['type'])) {
                    if ($_GET['type'] == 'error') {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ' . $_GET['msg'] . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                    } elseif ($_GET['type'] == 'success') {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            ' . $_GET['msg'] . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                }
                ?>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add New Students</h3>
                                <p>Fields marked with <code>*</code> are required</p>
                            </div>
                        </div>
                        <form class="new-added-form" action="includes/process.php" method="POST">
                            <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Full Name <code>*</code></label>
                                    <input required type="text" placeholder="Full name" name="fullname" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Unique Code <code>*</code></label>
                                    <input required type="text" placeholder="Unique Code" name="unique_code"  class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Gender <code>*</code></label>
                                    <select required class="select2" name="gender">
                                        <option value="">Please Select Gender <code>*</code></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Date Of Birth <code>*</code></label>
                                    <input required type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker" data-position='bottom right' name="dob">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Blood Group <code>*</code></label>
                                    <select required class="select2" name="blood_group">
                                        <option value="">Please Select Group <code>*</code></option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="0-">O-</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Religion <code>*</code></label>
                                    <select required class="select2" name="religion">
                                        <option value="">Please Select Religion <code>*</code></option>
                                        <option value="Islam">Islam</option>
                                        <option value="Christian">Christian</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>E-Mail <code>*</code></label>
                                    <input required type="email" placeholder="" class="form-control" name="email">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class <code>*</code></label>
                                    <select required class="select2" name="class_id">
                                        <option value="">Please Select Class <code>*</code></option>
                                        <?php
                                        $sql = "SELECT * FROM classes";
                                        $result = mysqli_query($dbconnect, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['id'] . '">' . $row['class_name'] . '(' . $row['class_code'] . ')</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Level <code>*</code></label>
                                    <select required class="select2" name="level">
                                        <option value=""> --choose level-- </option>
                                        <option value="1A">1A</option>
                                        <option value="1B">1B</option>
                                        <option value="1C">1C</option>
                                        <option value="1D">1D</option>

                                        <option value="2A">2A</option>
                                        <option value="2B">2B</option>
                                        <option value="2C">2C</option>
                                        <option value="2D">2D</option>

                                        <option value="3A">3A</option>
                                        <option value="3B">3B</option>

                                        <option value=""> --Senior Categories-- </option>
                                        <option value="1A1">1A1</option>
                                        <option value="1A2">1A2</option>
                                        <option value="1A3">1A3</option>
                                        <option value="1A4">1A4</option>

                                        <option value="1B">1B</option>
                                        <option value="1C">1C</option>

                                        <option value="2A1">2A1</option>
                                        <option value="2A2">2A2</option>
                                        <option value="2A3">2A3</option>
                                        <option value="2B">2B</option>
                                        <option value="2C">2C</option>

                                        <option value="3A1">3A1</option>
                                        <option value="3A2">3A2</option>
                                        <option value="3B">3B</option>
                                        <option value="3C">3C</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Username <code>*</code></label>
                                    <input required type="text" placeholder="Choose username" name="username" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Parent Name <code>*</code></label>
                                    <input required type="text" placeholder="Parent Name" name="parent_name" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Parent Phone Number <code>*</code></label>
                                    <input required type="number" placeholder="Parent Phone Number" name="parent_phone" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Parent Email <code>*</code></label>
                                    <input required type="email" placeholder="Parent Email" name="parent_email" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Parant Address <code>*</code></label>
                                    <textarea required class="form-control" placeholder="Address" name="parent_address"></textarea>
                                </div>

                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" name="add_student" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Admit Form Area End Here -->
                <footer class="footer-wrap-layout1">
                    <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
                </footer>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Select 2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="js/datepicker.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>

</html>