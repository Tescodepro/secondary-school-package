<!doctype html>
<html class="no-js" lang="">

<?php
    $title = 'Admin Control - School Portal';
    include_once 'layout/head.php';
?>



<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Login Page Start Here -->
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo">
                    <img src="../assets/images/logo.png" alt="logo" width="100" height="100"> 
                    <h3>OTA Total Academy <br>Admin Control System</h3>
                </div>
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
                <form action="includes/login_code.php" method="post" class="login-form">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter email" class="form-control">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" class="form-control">
                        <i class="fas fa-lock"></i>
                    </div> 
                    <div class="form-group">
                        <button type="submit" name="login" class="login-btn">Login</button>
                    </div>
                </form> 
            </div> 
        </div>
    </div>
    <!-- Login Page End Here -->
    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
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

</html>