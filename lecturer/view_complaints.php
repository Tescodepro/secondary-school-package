<?php
session_start();
require 'includes/database.php';
if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 'teacher' && $_SESSION['user_type'] != 'admin')) {
    // Access control
   // die("<p style='color: red; font-weight: bold;'>Access denied.</p>");
}
?>
<!DOCTYPE html>
<html>
<?php include 'layout/head.php'; ?>
<title>View Complaints</title>
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
                            <h3 class="widget-user-username">All Complaints</h3>
                        </div>
                        <div class="box-footer"></div>
                    </div>

                    <div class="row pr-4 pl-4">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title">Complaint List</h4>
                                    <h6 class="box-subtitle">Submitted by students</h6>
                                </div>
                                <div class="box-body">
                                    <?php
                                    $result = $dbconnect->query("SELECT * FROM complaints ORDER BY date_submitted DESC");
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<div class='box' style='background: #f9f9f9; padding: 20px; margin-bottom: 20px; border-radius: 10px; border: 1px solid #ccc;'>";
                                        echo "<p><strong>ID:</strong> {$row['id']}</p>";
                                        echo "<p><strong>User ID:</strong> {$row['user_id']} ({$row['user_type']})</p>";
                                        echo "<p><strong>Subject:</strong> {$row['subject']}</p>";
                                        echo "<p><strong>Message:</strong><br><span style='white-space: pre-line;'>".nl2br(htmlspecialchars($row['message']))."</span></p>";
                                        echo "<p><strong>Status:</strong> <span style='color:" . ($row['status'] == 'resolved' ? 'green' : 'red') . "; font-weight:bold;'>".ucfirst($row['status'])."</span></p>";
                                        echo "<p><strong>Submitted:</strong> {$row['date_submitted']}</p>";

                                        if ($row['status'] == 'resolved') {
                                            echo "<p><strong>Response:</strong><br><span style='white-space: pre-line; color: #2b2b2b;'>".nl2br(htmlspecialchars($row['response']))."</span></p>";
                                            echo "<p><strong>Responded On:</strong> {$row['date_responded']}</p>";
                                        } else {
                                            echo "
                                            <form action='respond_complaint.php' method='POST' style='margin-top: 10px;'>
                                                <input type='hidden' name='complaint_id' value='{$row['id']}'>
                                                <textarea name='response' rows='4' required placeholder='Enter your response...'
                                                    style='width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;'></textarea><br><br>
                                                <button type='submit' class='btn btn-primary btn-sm'>
                                                    Submit Response
                                                </button>
                                            </form>";
                                        }
                                        echo "</div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            &copy; <?php echo date('Y'); ?> SCHOOL NAME |
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>

    <!-- Existing Scripts -->
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
