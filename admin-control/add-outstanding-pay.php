<?php
include 'includes/isLogedin.php';
$title = "Add Outstanding Student Fees";
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
                    <h3>Student Fees</h3>
                    <ul>
                        <li>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li>Student Fees</li>
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
                            <!-- <div class="col-12"> -->
                                <div class="card">
                                    <h3 class="font-semibold mt-5 mb-5">Add Fees</h3>
                                    <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                            
                                            </div>
                                            <form class="new-added-form" action="includes/process.php" method="POST">
                                                <input type="hidden" value="'.$u_id.'" name="id">
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Payment Type *</label>
                                                        <input type="text" placeholder="Payment Type" name="payment_type" class="form-control" id="">
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Class *</label>
                                                        <select required class="form-control" name="class_id">
                                                            <option value="">Please Select Class *</option>
                                                            <?php 
                                                                include 'includes/database.php';
                                                                $sql = "SELECT * FROM classes";
                                                                $result = mysqli_query($dbconnect, $sql);
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                    echo '<option value="'.$row['id'].'">'.$row['class_name'].'('.$row['class_code'].')</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Level *</label>
                                                        <select required class="form-control" name="level">
                                                            <option value="">Please Select Level *</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Amount *</label>
                                                        <input type="number" placeholder="Amount" name="amount" class="form-control" id="">
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Session *</label>
                                                        <select required class="form-control" name="session">
                                                            <option value="">Please Select Session *</option>
                                                            <?php 
                                                                include 'includes/database.php';
                                                                $sql = "SELECT * FROM sessions";
                                                                $result = mysqli_query($dbconnect, $sql);
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                    echo '<option value="'.$row['session'].'">'.$row['session'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Unique Number *</label>
                                                        <input type="text" placeholder="Unique Number" name="unique_id" class="form-control" id="">
                                                    </div>
                                                    <div class="col-12 form-group mg-t-8">
                                                        <button type="submit" name="add_outstanding_payment" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <!-- <div class="col-12"> -->
                                
                                <!-- <div class="card"> -->
                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>S/NO</th>
                                                    <th>Payment Type</th>
                                                    <th>Amount</th>
                                                    <th>Class</th>
                                                    <th>Level</th>
                                                    <th>Unique Number</th>
                                                    <th>Session</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                                <?php
                                                    $i = 0;
                                                    $get_payment = "SELECT * FROM set_payment INNER JOIN classes ON classes.id = set_payment.class_id WHERE set_payment.user_id != 'null'";
                                                    $run_payment = mysqli_query($dbconnect, $get_payment);
                                                    while($row_payment = mysqli_fetch_array($run_payment)){
                                                        $id = $row_payment['payment_id'];
                                                        $payment_type = $row_payment['payment_type'];
                                                        $amount = $row_payment['amount'];
                                                        $class_name = $row_payment['class_name'];
                                                        $level = $row_payment['level'];
                                                        $unique_id = $row_payment['user_id'];
                                                        $session = $row_payment['session'];
                                                        $i = $i + 1;
                                                        echo "
                                                            <tr>
                                                                <td>$i</td>
                                                                <td>$payment_type</td>
                                                                <td>$amount</td>
                                                                <td>$class_name</td>
                                                                <td>$level</td>
                                                                <td>$unique_id</td>
                                                                <td>$session</td>
                                                                <td> 
                                                                <!--<a href='add-outstanding-pay.php?id=$id&modal=delete' style='margin-right:5%' class='btn btn-danger text-white waves-effect waves-light'><i class='fas fa-trash'></i></a>-->
                                                                 <a href='add-outstanding-pay.php?id=$id&modal=edit' style='margin-right:5%' class='btn btn-success text-white waves-effect waves-light'><i class='fas fa-file-upload'></i></a>
                                                        </td>
                                                                 </tr>
                                                                 ";
                                                    } 
                                                
                                                ?>
                                            <tbody>
                                            </tbody>
                                        </table>   
                                    </div>
                                <!-- </div> -->
                        <!-- </div> -->
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
                    $get_payment = "SELECT * FROM set_payment INNER JOIN classes ON classes.id = set_payment.class_id WHERE payment_id = '$u_id'";
                    $run_payment = mysqli_query($dbconnect, $get_payment);
                    while($row_payment = mysqli_fetch_array($run_payment)){
                        
                        echo' <div class="modal fade" id="large-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Student Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h3 class="font-semibold">Edit Selected Student Payments</h3>
                                    <div class="card height-auto">
                                        <div class="card-body">
                                            <div class="heading-layout1">
                                            
                                            </div>
                                            <form class="new-added-form" action="includes/process.php" method="POST">
                                                <input type="hidden" value="'.$u_id.'" name="id">
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Payment Type *</label>
                                                        <input type="text" placeholder="Payment Type" value="'.$row_payment['payment_type'].'" name="payment_type" class="form-control" id="">
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Class *</label>
                                                        <select required class="form-control" name="class_id">
                                                        <option value="'.$row_payment['id'].'">'.$row_payment['class_name'].'('.$row_payment['class_code'].')</option>';
                                                            
                                                                include 'includes/database.php';
                                                                $sql = "SELECT * FROM classes";
                                                                $result = mysqli_query($dbconnect, $sql);
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                    echo '<option value="'.$row['id'].'">'.$row['class_name'].'('.$row['class_code'].')</option>';
                                                                }
                                                            
                                                       echo' </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Level *</label>
                                                        <select required class="form-control" name="level">
                                                            <option value="'.$row_payment['level'].'">'.$row_payment['level'].'</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Amount *</label>
                                                        <input type="number" placeholder="Amount" value="'.$row_payment['amount'].'" name="amount" class="form-control" id="">
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Session *</label>
                                                        <select required class="form-control" name="session">
                                                        <option value="'.$row_payment['session'].'">'.$row_payment['session'].'</option>
                                                            ';
                                                                include 'includes/database.php';
                                                                $sql = "SELECT * FROM sessions";
                                                                $result = mysqli_query($dbconnect, $sql);
                                                                while($row = mysqli_fetch_assoc($result)){
                                                                    echo '<option value="'.$row['session'].'">'.$row['session'].'</option>';
                                                                }
                                                       echo' </select>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                                        <label>Unique Number *</label>
                                                        <input type="text" placeholder="Unique Number" name="unique_id" value="'.$row_payment['user_id'].'" class="form-control" id="">
                                                    </div>
                                                    <div class="col-12 form-group mg-t-8">
                                                        <button type="submit" name="update_outstanding_payment" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
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