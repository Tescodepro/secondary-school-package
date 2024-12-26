<?php
include 'includes/isLogedin.php';
$title = "Classes";
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
                    <h3>Classes</h3>
                    <ul>
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li>Classes</li>
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
                                                <input type="hidden" value="'.$u_id.'" name="id">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                        <label>Class Name *</label>
                                                        <input required type="text" placeholder="Class Name" name="class_name"  class="form-control">
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                                        <label>Class Code *</label>
                                                        <input required type="text" placeholder="Class Code" name="class_code" class="form-control">
                                                    </div>
                                                    <div class="col-12 form-group mg-t-8">
                                                        <button type="submit" name="add_class" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                        
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
                                                    <th>Class Name</th>
                                                    <th>Class Code</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                                <?php
                                                    $i = 0;
                                                    $get_classes = "SELECT * FROM classes ";
                                                    $run_classes = mysqli_query($dbconnect, $get_classes);
                                                    while($row_classes = mysqli_fetch_array($run_classes)){
                                                        $id = $row_classes['id'];
                                                        $class_name = $row_classes['class_name'];
                                                        $class_code = $row_classes['class_code'];
                                                        $i = $i + 1;
                                                        echo "
                                                            <tr>
                                                                <td>$i</td>
                                                                <td>$class_name</td>
                                                                <td>$class_code</td>
                                                                <td> 
                                                                <!--<a href='student-details.php?id=$id&modal=delete' style='margin-right:5%' class='btn btn-danger text-white waves-effect waves-light'><i class='fas fa-trash'></i></a>-->
                                                                 <a href='classes.php?id=$id&modal=edit' style='margin-right:5%' class='btn btn-success text-white waves-effect waves-light'><i class='fas fa-file-upload'></i></a>
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