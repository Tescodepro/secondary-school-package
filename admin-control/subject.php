<?php
include 'includes/isLogedin.php';
$title = "Subject";
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
                    <h3>Subjects</h3>
                    <ul>
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li>Subjects</li>
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
                                <div class="card-body">
                                    <h3 class="font-semibold">Subject</h3>
                                    <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                            
                                            </div>
                                            <form class="new-added-form" action="includes/process.php" method="POST">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-6 col-12 form-group">
                                                        <label>Subject *</label>
                                                        <input required type="text" placeholder="Subject" name="subject_name"  class="form-control">
                                                    </div>
                                                    <div class="col-12 form-group mg-t-8">
                                                        <button type="submit" name="add_subject" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
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
                                                    <th>Subject</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                                <?php
                                                    $i = 0;
                                                    $get_classes = "SELECT * FROM subject ";
                                                    $run_classes = mysqli_query($dbconnect, $get_classes);
                                                    while($row_classes = mysqli_fetch_array($run_classes)){
                                                        $id = $row_classes['id'];
                                                        $subject_name = $row_classes['subject_name'];
                                                        $i = $i + 1;
                                                        echo "
                                                            <tr>
                                                                <td>$i</td>
                                                                <td>$subject_name</td>
                                                                <td> 
                                                                <!--<a href='subject.php?id=$id&modal=delete' style='margin-right:5%' class='btn btn-danger text-white waves-effect waves-light'><i class='fas fa-trash'></i></a>-->
                                                                 <a href='subject.php?id=$id&modal=edit' style='margin-right:5%' class='btn btn-success text-white waves-effect waves-light'><i class='fas fa-file-upload'></i></a>
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
                    $get_classes = "SELECT * FROM subject WHERE id = $u_id";
                    $run_classes = mysqli_query($dbconnect, $get_classes);
                    while($row_classes_edit = mysqli_fetch_array($run_classes)){
                        
                        echo' <div class="modal fade" id="large-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Subject</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h3 class="font-semibold">Edit Subject</h3>
                                    <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                            
                                            </div>
                                            <form class="new-added-form" action="includes/process.php" method="POST">
                                                <input type="hidden" value="'.$u_id.'" name="id">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-6 col-12 form-group">
                                                        <label>Subject *</label>
                                                        <input required type="text" placeholder="Class Name" name="subject_name" value="'.$row_classes_edit['subject_name'].'" class="form-control">
                                                    </div>
                                                    <div class="col-12 form-group mg-t-8">
                                                        <button type="submit" name="update_subject" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                        
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