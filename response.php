<?php
session_start();
require 'includes/isLogin.php';
require 'includes/database.php';

$user_id = $_SESSION['auth_user'] ?? null;
$fullname = $_SESSION['fullname'] ?? 'Parent Portal'; // or whatever you use

$title = $fullname . " - Complaint Responses";
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'layout/head.php'; ?>
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
                            <h3 class="widget-user-username">Complaint Responses</h3>
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
                                    <div style="overflow-x: auto;">
                                        <?php
                                        $query = $dbconnect->prepare("SELECT subject, message, response, date_responded FROM complaints WHERE user_id = ?");
                                        $query->bind_param("s", $user_id);
                                        $query->execute();
                                        $result = $query->get_result();

                                        if ($result->num_rows > 0) {
                                            echo '<table class="table table-bordered table-striped">';
                                            echo '<thead class="thead-light">';
                                            echo '<tr>
                                                <th>Subject</th>
                                                <th>Complaint</th>
                                                <th>Response</th>
                                                <th>Responded At</th>
                                            </tr></thead><tbody>';

                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                                                echo "<td>" . nl2br(htmlspecialchars($row['message'])) . "</td>";

                                                if (!empty($row['response'])) {
                                                    echo "<td style='color:green;'>" . nl2br(htmlspecialchars($row['response'])) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['date_responded']) . "</td>";
                                                } else {
                                                    echo "<td style='color:red;'><em>No response yet</em></td>";
                                                    echo "<td><em>--</em></td>";
                                                }

                                                echo "</tr>";
                                            }

                                            echo '</tbody></table>';
                                        } else {
                                            echo "<p class='text-danger'>No complaints found.</p>";
                                        }
                                        ?>
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
        &copy; <?php echo date('Y') ?> AMIS |
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
