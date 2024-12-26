<?php
$title = "All Students";
include 'includes/isLogedin.php';
include 'layout/head.php';
?>
<html class="no-js" lang="">

<body>
    <!-- Preloader Start Here -->
    <!-- <div id="preloader"></div> -->
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
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li>All Students</li>
                    </ul>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Students List</h4>
                                </div>
                                <!--end card-header-->
                                <div class="card-body">
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>S/NO</th>
                                                <th>Name</th>
                                                <th>Unique No</th>
                                                <th>Class</th>
                                                <th>Level</th>
                                                <th>Religion</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $i = 0;
                                        $get_student_data = "SELECT * FROM users INNER JOIN class_track ON users.unique_id = class_track.user_id INNER JOIN classes ON class_track.class_id = classes.id INNER JOIN students_info ON users.unique_id = students_info.user_id WHERE users.role = 'student'";
                                        $run_student_data = mysqli_query($dbconnect, $get_student_data);
                                        while ($row = mysqli_fetch_array($run_student_data)) {
                                            $student_id = $row['id'];
                                            $student_name = $row['f_name'];
                                            $user_id = $row['unique_id'];
                                            $class_name = $row['class_name'];
                                            $level = $row['level'];
                                            $i = $i + 1;
                                            echo "
                                                            <tr>
                                                                <td>$i</td>
                                                                <td>$student_name</td>
                                                                <td>$user_id</td>
                                                                <td>$class_name</td>
                                                                <td>$level</td>
                                                                <td>$row[religion]</td>
                                                                <td>
                                                                    <a href='all-student.php?id=$user_id&delete=true' style='margin-right:5%' class='btn btn-danger text-white waves-effect waves-light'><i class='fas fa-trash'></i></a>
                                                                    <a href='student-details.php?id=$user_id' style='margin-right:5%' class='btn btn-success text-white waves-effect waves-light'><i class='fas fa-eye'></i></a>
                                                                    <a href='all-student.php?id=$user_id&modal=true' style='margin-right:5%' class='btn btn-success text-white waves-effect waves-light'><i class='fas fa-file-upload'></i></a>
                                                        </td>
                                                                 </tr>
                                                                 ";
                                        }

                                        ?>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php include_once('layout/footer.php'); ?>
                    </div>

                </div>
                <!-- Page Area End Here -->
            </div>
            <!-- jquery-->
            <?php
            if (isset($_GET['modal'])) {
                $u_id = $_GET['id'];
                $get_student_data = "SELECT * FROM users INNER JOIN class_track ON users.unique_id = class_track.user_id INNER JOIN classes ON class_track.class_id = classes.id INNER JOIN students_info ON users.unique_id = students_info.user_id WHERE users.unique_id = '$u_id'";
                $run_student_data = mysqli_query($dbconnect, $get_student_data);
                while ($row = mysqli_fetch_array($run_student_data)) {

                    echo ' <div class="modal fade" id="large-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Student Detail</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3 class="font-semibold">Update Selected Student Details</h3>
                                <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                           
                                        </div>
                                        <form class="new-added-form" action="includes/process.php" method="POST">
                                            <input type="hidden" value="' . $u_id . '" name="id">
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Full Name *</label>
                                                    <input required type="text" placeholder="Full name" name="fullname" value="' . $row['f_name'] . '" class="form-control">
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Gender *</label>
                                                    <select required class="select2 form-control" name="gender">
                                                        <option value="' . $row['gender'] . '">' . $row['gender'] . '</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Date Of Birth *</label>
                                                    <input required type="date" placeholder="dd/mm/yyyy" value="' . $row['dob'] . '" class="form-control air-datepicker"
                                                        data-position="bottom right" name="dob">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Blood Group *</label>
                                                    <select required class="select2 form-control" name="blood_group">
                                                        <option value="' . $row['blood_group'] . '">' . $row['blood_group'] . '</option>
                                                        <option value="A+">A+</option>
                                                        <option value="A-">A-</option>
                                                        <option value="B+">B+</option>
                                                        <option value="B-">B-</option>
                                                        <option value="O+">O+</option>
                                                        <option value="0-">O-</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Religion *</label>
                                                    <select required class="select2 form-control" name="religion">
                                                        <option value="' . $row['religion'] . '">' . $row['religion'] . '</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Christian">Christian</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>E-Mail</label>
                                                    <input required type="email" placeholder="" value="' . $row['email'] . '" class="form-control" name="email">
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Class *</label>
                                                    <select required class="select2 form-control" name="class_id">';
                    $sql_con = "SELECT * FROM classes WHERE id ='" . $row["class_id"] . "'";
                    $result_ok = mysqli_query($dbconnect, $sql_con);
                    $row_result = mysqli_fetch_assoc($result_ok);
                    echo '<option value="' . $row_result['id'] . '">' . $row_result['class_name'] . '(' . $row_result['class_code'] . ')</option>';

                    $result = mysqli_query($dbconnect, $sql_con);
                    $sql = "SELECT * FROM classes";
                    $result = mysqli_query($dbconnect, $sql);
                    while ($row_run = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row_run['id'] . '">' . $row_run['class_name'] . '(' . $row_run['class_code'] . ')</option>';
                    }
                    echo '
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Level *</label>
                                                    <select required class="select2 form-control" name="level">
                                                        <option value="' . $row['level'] . '">' . $row['level'] . '</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>username</label>
                                                    <input required type="text" placeholder="Parent Number" name="phone" value="' . $row['username'] . '" class="form-control">
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Parent Name *</label>
                                                    <input required type="text" placeholder="Parent Name" name="parent_name" value="' . $row['parent_name'] . '" class="form-control">
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Parent Phone Num. *</label>
                                                    <input required type="number" placeholder="Parent Phone Number" name="parent_phone" value="' . $row['parent_phone_num'] . '" class="form-control">
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Parent Email *</label>
                                                    <input required type="email" placeholder="Parent Email" name="parent_email" value="' . $row['parent_email'] . '" class="form-control">
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                                    <label>Parant Address *</label>
                                                    <textarea required class="form-control" placeholder="Address" name="parent_address"  >' . $row['parent_address'] . '</textarea>
                                                </div>
                                                
                                                <div class="col-12 form-group mg-t-8">
                                                    <button type="submit" name="update_student" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            }
            if (isset($_GET['delete'])) {
                $u_id = $_GET['id'];
                $get_student_data = "SELECT * FROM users INNER JOIN class_track ON users.unique_id = class_track.user_id INNER JOIN classes ON class_track.class_id = classes.id INNER JOIN students_info ON users.unique_id = students_info.user_id WHERE users.unique_id = '$u_id'";
                $run_student_data = mysqli_query($dbconnect, $get_student_data);
                while ($row = mysqli_fetch_array($run_student_data)) {

                    echo ' <div class="modal fade" id="large-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"style="color: red;" >Delete Student</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card height-auto">
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                           
                                        </div>
                                        <form class="new-added-form" action="includes/process.php" method="POST">
                                                <center>
                                                    <h2 style="color: red;"> Are you sure you want to take this action against this student? </h2>
                                                    <h3><strong>Name of the student: </strong>' . $row['f_name'] . '</h3>
                                                    <input type="hidden" value="' . $u_id . '" name="id">
                                                    <div class="col-12 form-group mg-t-8">
                                                        <button type="submit" name="dalate_students" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Delete Student</button>
                                                    </div>
                                                </center>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            }
            ?>

            <?php include_once('layout/scripts.php'); ?>
            <script>
                $(document).ready(function() {
                    $("#large-modal").modal('show');
                });
            </script>
</body>

</html>