<?php
session_start();
if (!isset($_SESSION["id"]) and isset($_SESSION["login"])) {
    header('Location:index.php');
}
?>
<!DOCTYPE html
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        Student | AUAS Admin Panel 
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
<?php include 'includes/side_bar.php'; ?>

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <!-- Navbar -->
  <?php
    include 'includes/menu.php';
  ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Registered Student's</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                            <th class="text-secondary opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        include '../database.php';
                                        $fetch_student = "SELECT * FROM admission_user INNER JOIN students_info ON admission_user.assign_id = students_info.addmission_id 
                                        INNER JOIN users ON admission_user.assign_id = users.addmission_id INNER JOIN class_track ON class_track.user_id = users.unique_id
                                        INNER JOIN classes ON classes.id = class_track.class_id";

                                        $result_fetch_student = mysqli_query($dbconnect, $fetch_student) or die(mysqli_error($dbconnect));
                                        while($row = mysqli_fetch_array($result_fetch_student)) {
                                            if ($row['add_status'] == 1) {
                                                $status =  '<span class="badge badge-sm bg-gradient-success">Admited</span>';
                                            } else if ($row['add_status'] == 2) {
                                                $status =  '<span class="badge badge-sm bg-gradient-danger">Admission Rejected</span>';
                                            }else {
                                                $status =  '<span class="badge badge-sm bg-gradient-warning">pending</span>';
                                            }
                                            
                                            // $f_name =  $row['first_name'];
                                            echo '<tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1"> 
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"> '.$row['first_name'].' '.$row['last_name'].'</h6>
                                                            <p class="text-xs text-secondary mb-0">'.$row['assign_id'].'</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">  
                                                   '.$status.'
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">'.$row['email'].'</span>
                                                </td>
                                                <td class="align-middle"> 
                                                    <a style"margin-top:30px" type="button" class="text-success font-weight-bold text-xs" data-toggle="modal" data-target="#exampleModal'.$row['assign_id'].'">
                                                        Admit
                                                    </a>
                                                    <a type="button" style="margin-left:5px;" class="text-danger font-weight-bold text-xs" data-toggle="modal" data-target="#disapprove'.$row['assign_id'].'">
                                                        Reject
                                                    </a> 
                                                    <a href="javascript:;" style="margin-left:5px;" class="text-primary  font-weight-bold text-xs" data-toggle="modal" data-target="#detail'.$row['assign_id'].'">
                                                        View
                                                    </a>
                                                </td>
                                            </tr>'; 

                                            echo '  <div class="modal fade" id="exampleModal'.$row['assign_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Admit Student</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="admin_action.php" method="post">
                                                    <div class="modal-body">
                                                    <h5 class="text-primary text-center" > Note this Action will Reject a Student Application </h5>
                                                    <p class=" text-secondary text-center ">
                                                        You are about to Accept <b>'.$row['first_name'].' '.$row['last_name'].'</b> Applications 
                                                    </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                                                        <input type="hidden" name="id" value="'.$row['assign_id'].'">
                                                        <button class="btn btn-success mb-3" name="admit" type="submit"> Admit </button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>';

                                        echo '  <div class="modal fade" id="disapprove'.$row['assign_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger" id="exampleModalLabel">Reject Student</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="admin_action.php" method="post">
                                                    <div class="modal-body">
                                                        <h5 class="text-primary text-center" > Note this Action will Reject a Student Application </h5>
                                                        <p class=" text-danger text-center ">
                                                           You are about to Reject <b>'.$row['first_name'].' '.$row['last_name'].'</b> Applications 
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                                                        <input type="hidden" name="id" value="'.$row['assign_id'].'">
                                                        <button class="btn btn-danger mb-3" name="NOTapprove" type="submit"> Reject </button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>';

                                        echo '  <div class="modal fade" id="detail'.$row['assign_id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-primary" id="exampleModalLabel">View Student Detail</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="admin_action.php" method="post">
                                                    <div class="modal-body">
                                                        <h5 class="text-primary text-center" > Student Details </h5>
                                                        <p class="">
                                                           <b style="margin-right:10px;">Date of Birth:</b>'.$row['dob'].'
                                                        </p>
                                                        <p class="">
                                                            <b style="margin-right:10px;">Blood Group:</b>'.$row['blood_group'].'
                                                        </p>
                                                        <p class="">
                                                           <b style="margin-right:10px;">Religion:</b>'.$row['religion'].'
                                                        </p>
                                                        <p class="">
                                                            <b style="margin-right:10px;">Gender:</b>'.$row['gender'].'
                                                        </p>  
                                                        <h6 class="text-primary text-center" >Parent</h6>
                                                       
                                                        </p> 
                                                        <p class="">
                                                            <b style="margin-right:10px;">Parent Name:</b>'.$row['parent_name'].'
                                                        </p>
                                                        <p class="">
                                                            <b style="margin-right:10px;">Parent Email:</b>'.$row['parent_email'].'
                                                        </p>
                                                        <p class="">
                                                            <b style="margin-right:10px;">Parent Phone Num:</b>'.$row['parent_phone_num'].'
                                                        </p> 
                                                        <p class="">
                                                            <b style="margin-right:10px;">Parent Address:</b>'.$row['parent_address'].'
                                                        </p> 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>   
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>';
                                        };
                                        ?>
                                      
                                    </tbody>
                                    <!-- <input type="button" value=""required> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                            </div>
                        </div> 
                    </div>
                </div>
            </footer>
        </div>
    </main> 
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
</body>

</html>