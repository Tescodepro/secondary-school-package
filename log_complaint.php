<?php
include 'includes/isLogin.php';  
$user_role = $_SESSION['user_role'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $title = $fullname . " - Log Complaint";
    include 'layout/head.php'; 
?>
<body class="hold-transition light-skin sidebar-mini theme-primary fixed">

<div class="wrapper">
    <div id="loader"></div>

    <?php include 'layout/header.php'; ?>
    <?php include 'layout/sidebar.php'; ?>

    <div class="content-wrapper">
        <div class="container-full">
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-12">
                    <div class="box box-widget widget-user">
                        <div class="widget-user-header bg-primary" style="background: url('assets/image/gallery/full/10.jpg') center center;">
                            <h3 class="widget-user-username">Log Complaint</h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="rounded-circle" src="assets/images/summit.png" width="50" height="50" alt="User Avatar">
                        </div>
                        <div class="box-footer"></div>
                    </div>

                    <div class="row pr-4 pl-4">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div style="max-width: 600px; margin: auto; background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                        <h4 style="text-align: center; color: #333; margin-bottom: 20px;">Log a Complaint</h4>

                                        <form action="submit_complaint.php" method="POST">
                                            <div class="form-group">
                                                <label for="subject"><strong>Subject:</strong></label>
                                                <input type="text" name="subject" required class="form-control" placeholder="Enter subject">
                                            </div>

                                            <div class="form-group">
                                                <label for="message"><strong>Message:</strong></label>
                                                <textarea name="message" rows="5" required class="form-control" placeholder="Describe your issue..."></textarea>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success btn-block">Submit Complaint</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                </div>
            </div>
        </div>  
    </div>

    <footer class="main-footer">
        &copy; <?php echo date('Y') ?> SCHOOL NAME |
    </footer>

    <div class="control-sidebar-bg"></div>
</div>

<!-- Scripts -->
<script src="assets/js/vendors.min.js"></script>
<script src="assets/js/pages/chat-popup.js"></script>
<script src="assets/icons/feather-icons/feather.min.js"></script>
<script src="assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
<script src="assets/vendor_components/moment/min/moment.min.js"></script>
<script src="assets/vendor_components/fullcalendar/fullcalendar.js"></script>
<script src="assets/vendor_components/datatable/datatables.min.js"></script>
<script src="assets/js/template.js"></script>
<script src="assets/js/pages/dashboard.js"></script>
<script src="assets/js/pages/calendar.js"></script>
<script src="assets/js/pages/data-table.js"></script>

</body>
</html>
