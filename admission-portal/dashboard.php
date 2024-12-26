<?php
include 'islogin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
    Dashboard 
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
<div class="container position-sticky z-index-sticky top-5">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="dashboard.php">
              AUAS
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="dashboard.html">
                    <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="include/logout.php">
                    <i class="fa fa-user opacity-6 text-dark me-1"></i>
                    Logout
                  </a>
                </li>
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="include/logout.php" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
 
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-80"> 
        <div class="container-fluid">
       
            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('assets/img/curved-images/cur0.jpg'); background-position-y: 50%;">
                <span class="mask bg-primary ">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 text-center mx-auto mt-5">
                            <h1 class="text-white mb-2 mt-5">Dashboard</h1>
                            <p class="text-lead text-white">Well come to the Our Portal</p>
                        </div>
                    </div>
                </span>
                
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <!-- <img src="assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm"> -->
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <?php echo $name;?>
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                <?php echo $email;?>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                        <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(603.000000, 0.000000)">
                                                <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                                </path>
                                                <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                                                <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                                                </g>
                                            </g>
                                            </g>
                                        </g>
                                        </svg>
                                        <span class="ms-1"><?php echo $app_id;?></span>
                                    </a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                
                <?php
                    if (isset($_GET['type']) && $_GET['type']=='success') { 
                       echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
                        '.$_GET["msg"].' 

                     </div>';
                    }
                  ?>
                <div class="col-12 col-xl-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Admission Status</h6>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder">Status</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 px-0">
                                    <div class="form-check form-switch ps-0"> 
                                        <?php
                                            if ($is_register == 1 and $add_status == 1) {
                                               echo '<label style="color:green;" class="form-check-label text-success text-body ms-3 w-80 mb-0" for="flexSwitchCheckDefault">Congratulation you application had been approved.</label>';
                                            }else{
                                               echo '<label style="color:red;" class="form-check-label text-danger text-body ms-3 w-80 mb-0" for="flexSwitchCheckDefault">Application in process....</label>';

                                            }
                                        ?>
                                        <!-- <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label> -->
                                    </div>
                                </li> 
                            </ul>
                            <!-- <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Message</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 px-0">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                                        <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">New launches and projects</label>
                                    </div>
                                </li> 
                            </ul> -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="mb-0">Application Form</h6>
                                </div>
                                <div class="col-md-4 text-end">
                                    <a href="javascript:;">
                                        <!-- <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm">
                                You have pay 10,000 naira before you will able to access Admission portal.
                            </p>
                            <hr class="horizontal gray-light my-2">
                            <div class="row justify-content-between">
                                <?php
                                    if ($application_found == 1) {
                                       echo '<div class="col-lg-6 mx-auto ">  
                                                <button class="btn btn-success" disabled >Payment 10k</button>
                                            </div>';
                                    }else {
                                       echo '<div class="col-lg-6 mx-auto ">   
                                                <button type="button" class="btn btn-success" id="money" value="10000" data-toggle="modal" data-target="#exampleModal">
                                                Payment 10k
                                                </button>
                                                
                                            </div>';
                                    }
                                    if ($is_register == 1 and $application_found == 1) {
                                        echo '<div class="col-lg-6 mx-auto ">  
                                                 <button class="btn btn-secondary" disabled >Application form</button>
                                             </div>';
                                     }elseif($is_register == 0 and $application_found == 1) {
                                        echo '<div class="col-lg-6 mx-auto">  
                                                 <a href="application.php" class="btn btn-secondary" >Application form</a> 
                                              </div>';
                                     }else {
                                        echo '<div class="col-lg-6 mx-auto ">  
                                                    <button class="btn btn-secondary" disabled >Application form</button>
                                                </div>';
                                     }

                                ?> 
                                
                            </div>
                        </div>
                    </div>
                </div> 

                <!-- Modal Form-->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Admission portal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            You about to pay for your application form 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                            <script src="https://js.paystack.co/v1/inline.js"></script> 
                            <input type="hidden" id="email" value="<?php echo $email; ?>">
                            <button class="btn btn-success mb-3" type="button" id="payment_type" value="application form" onclick="payWithPaystack()"> Proceed to make Payment <i class="fa fa-arrow-right"></i></button>
                                               
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Admission Letter</h6>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-sm">
                                You have pay 30,000 naira to get your Admission Letter and this will be active after you have been admitted
                            </p>
                            <hr class="horizontal gray-light my-2">
                            <div class="row justify-content-between">
                            <div class="col-lg-6 mx-auto "> 
                                    <!-- <button class="btn btn-success" >Payment 300k</button> -->
                                    <?php
                                         if ($add_status == 1 and $acceptance_found	== 1) {
                                            echo '<button class="btn btn-success" disabled>Payment 30k</button>';
                                        } elseif ($add_status != 1 ) {
                                            echo '<button class="btn btn-success" disabled>Payment 30k</button>';
                                        }else {
                                            echo ' <button type="button" class="btn btn-success" id="money" value="30000" data-toggle="modal" data-target="#admission">
                                            Payment 30k
                                            </button>';
                                        }
                                    ?>
                                </div>
                                <div class="col-lg-6 mx-auto"> 
                                <?php
                                     if ($add_status == 1 and $acceptance_found	!= 1) {
                                        echo '
                                        <form action="admission_letter.php" method="POST">
                                            <button type="submit" class="btn btn-secondary" name="create_pdf">Admission Letter</button>
                                        </form>';
                                    }else {
                                        echo '<button class="btn btn-secondary" disabled>Admission Letter</button>';
                                    }
                                ?>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="modal fade" id="admission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            You about to pay for your acceptance fee 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                            <script src="https://js.paystack.co/v1/inline.js"></script> 
                            <input type="hidden" id="email" value="<?php echo $email; ?>">
                            <button class="btn btn-success" type="button" id="payment_type" onclick="payWithPaystack()"> Proceed to make Payment <i class="fa fa-arrow-right"></i></button>                   
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
    </div> 
    <!--   Core JS Files   -->
    <script>
        function payWithPaystack() {
            var payment_type = document.getElementById('payment_type').value;
            if (payment_type == 'application form') {
                var amount_fee = 10000;
            } else {
                var amount_fee = 30000;
            }
            var handler = PaystackPop.setup({
                // key: 'pk_live_ed261d3beb7cae41f315b2d8e6a40228d1f1d280',
                key: 'pk_test_c9ca3055dbbb92e1f0009295a4402c5caeb938b4', 

                email: document.getElementById('email').value,
                amount: 100 * amount_fee,
                ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                metadata: {
                    custom_fields: [{
                        display_name:"Full Name",
                        variable_name: "stu_name", 
                        value: 'Tesleem',
                    }, 
                ]
                },
                callback: function(response) {
                    window.location.replace("payment.php?app_id=<?php echo $app_id; ?>&amount="+ amount_fee +"&email= <?php echo $email; ?>&payment_type="+document.getElementById('payment_type').value+"&ref=" + response.reference);
                },
                onClose: function() {
                    alert('Trasaction terminated');
                }
            });
            handler.openIframe();
        }
    </script>
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