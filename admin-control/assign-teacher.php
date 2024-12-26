<?php
include 'includes/isLogedin.php';
$title = "Assign Teacher";
include 'layout/head.php'; ?>
<html class="no-js" lang="">

<body>
    <!-- Preloader Start Here -->
    <!-- <div id="preloader"></div> -->
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
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Assign Teacher</h3>
                    <ul>
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li>Assign Teacher</li>
                    </ul>
                    <?php
                    if (isset($_GET['type'])) {
                        if ($_GET['type'] == 'error') {
                           echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                '.$_GET['msg'].'
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        }elseif ($_GET['type'] == 'success') {
                            echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                            '.$_GET['msg'].'
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
                                    <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                            
                                            </div>
                                            <form class="new-added-form" action="includes/process.php" method="POST">
                                            <input type="hidden" value="<?php echo $u_id; ?>" name="id">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                    <label>Class *</label>
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
                                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                    <label>Level *</label>
                                                    <select name="level" class="form-control">
                                                        <option value="" > --choose level-- </option>
                                                        <option value="1A">1A</option>
                                                        <option value="1B">1B</option>
                                                        <option value="1C">1C</option>
                                                        <option value="1D">1D</option>
                                                        
                                                        <option value="2A">2A</option>
                                                        <option value="2B">2B</option>
                                                        <option value="2C">2C</option>
                                                        <option value="2D">2D</option>
                                                        <option value="2E">2E</option>
                                                        
                                                        <option value="3A">3A</option>
                                                        <option value="3B">3B</option>
                                                        <option value="3C">3C</option>
                                                        
                                                        <option value="" > --Senior Categories-- </option>
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
                                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                    <label>Subject *</label>
                                                    <select required class="select2 form-control" name="subject_id">
                                                    <option value="" > --choose-- </option>
                                                        <?php
                                                        $get_subject_name = "SELECT * FROM subject ORDER BY subject_name ASC";
                                                        $get_subject_name_result = mysqli_query($dbconnect, $get_subject_name);
                                                        while($row_get_subject_name_result = mysqli_fetch_array($get_subject_name_result)) {
                                                            echo '<option value = "'.$row_get_subject_name_result["id"].'" >'.$row_get_subject_name_result['subject_name'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-12 form-group">
                                                    <label>Teachers *</label>
                                                    <select required class="select2 form-control" name="teacher_id">
                                                    <option value="" > --choose-- </option>
                                                        <?php
                                                        $get_teacher_name = "SELECT * FROM users WHERE role = 'teacher' ORDER BY f_name ASC";
                                                        $get_teacher_name_result = mysqli_query($dbconnect, $get_teacher_name);
                                                        while($row_get_teacher_name_result = mysqli_fetch_array($get_teacher_name_result)) {
                                                            echo '<option value = "'.$row_get_teacher_name_result["id"].'" >'.$row_get_teacher_name_result['f_name'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 form-group mg-t-8">
                                                    <button type="submit" name="assign_teacher" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <!-- <div class="card-header">
                                        <h4 class="card-title">Students List</h4>
                                    </div> -->
                                    <!--end card-header-->
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>S/NO</th>
                                                    <th>Class</th>
                                                    <th>Level</th>
                                                    <th>Teacher</th>
                                                    <th>Subject</th>
                                                    <!-- <th>Season</th> -->
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 0;
                                                    $get_classes = "SELECT * FROM class_assign ";
                                                    $run_classes = mysqli_query($dbconnect, $get_classes);
                                                    while($row_classes = mysqli_fetch_array($run_classes)){
                                                        $assign_id = $row_classes['assign_id'];
                                                        $teacher_id = $row_classes['teacher_id'];
                                                        $class_id = $row_classes['class_id'];
                                                        $level = $row_classes['level'];
                                                        $subject = $row_classes['subject'];
                                                        // $season = $row_classes['season'];
                                                        $i = $i + 1;
                                                        echo "
                                                            <tr>
                                                                  <td>$i</td>";
                                                            $get_class_name = "SELECT * FROM classes WHERE id = '$class_id'";
                                                            $get_class_name_result = mysqli_query($dbconnect, $get_class_name);
                                                            while($row_get_class_name_result = mysqli_fetch_array($get_class_name_result)) {
                                                              echo '<td>'.$row_get_class_name_result['class_name'].' ('.$row_get_class_name_result['class_code'].')</td>';
                                                            }
                                                            echo "<td>$level</td>";
                                                            
                                                            $get_teacher_name = "SELECT * FROM users WHERE id = '$teacher_id'";
                                                            $get_teacher_name_result = mysqli_query($dbconnect, $get_teacher_name);
                                                            while($row_get_teacher_name_result = mysqli_fetch_array($get_teacher_name_result)) {
                                                                echo '<td>'.$row_get_teacher_name_result['f_name'].'</td>';
                                                            }

                                                            $get_subject_name = "SELECT * FROM subject WHERE id = '$subject'";
                                                            $get_subject_name_result = mysqli_query($dbconnect, $get_subject_name);
                                                            while($row_get_subject_name_result = mysqli_fetch_array($get_subject_name_result)) {
                                                                echo '<td>'.$row_get_subject_name_result['subject_name'].'</td>';
                                                            }

                                                            echo" <td> 
                                                                <!--<a href='student-details.php?id=$assign_id&modal=delete' style='margin-right:5%' class='btn btn-danger text-white waves-effect waves-light'><i class='fas fa-trash'></i></a>
                                                                 <a href='classes.php?id=$assign_id&modal=edit' style='margin-right:5%' class='btn btn-success text-white waves-effect waves-light'><i class='fas fa-file-upload'></i></a>-->
                                                                </td>
                                                                 </tr>
                                                                 ";
                                                    } 
                                                
                                                ?>
                                            
                                            </tbody>
                                        </table>   
                                </div>
                            </div>
                        </div>
                <?php include_once('layout/footer.php');?>
            </div>
           
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <?php
                if (isset($_GET['modal'])) {
                   if ($_GET['modal'] == 'edit') {
                    $u_id = $_GET['id'];
                    $get_classes = "SELECT * FROM classes WHERE id = $u_id";
                    $run_classes = mysqli_query($dbconnect, $get_classes);
                    while($row_classes_edit = mysqli_fetch_array($run_classes)){
                        
                        echo' <div class="modal fade" id="large-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                <input type="hidden" value="'.$u_id.'" name="id">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                        <label>Class Name *</label>
                                                        <input required type="text" placeholder="Class Name" name="class_name" value="'.$row_classes_edit['class_name'].'" class="form-control">
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                        <label>Class Code *</label>
                                                        <input required type="text" placeholder="Class Code" name="class_code" value="'.$row_classes_edit['class_code'].'" class="form-control">
                                                    </div>
                                                    <div class="col-12 form-group mg-t-8">
                                                        <button type="submit" name="update_class" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                        
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
                }
            ?>
   
    <?php include_once('layout/scripts.php');?>
    <script>
         $(document).ready(function(){
        $("#large-modal").modal('show');
    });
    </script>
</body>

</html>