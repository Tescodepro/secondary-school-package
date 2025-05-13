<?php include 'includes/isLogin.php';  
$user_role = $_SESSION['user_role'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<?php 
    $title = $fullname." ". $unique_id." Result (".$session.")";
    include 'layout/head.php' 
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
                            <h3 class="widget-user-username">Get Result</h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="rounded-circle" src="assets/images/summit.png" width="50" height="50" alt="User Avatar">
                        </div>
                        <div class="box-footer">  </div>
                    </div>

                    <div class="row pr-4 pl-4"> 
                        <div class="col-md-12">
                            <div class="box">
                                <div class="rw" style="margin-top: 10px; display: flex; justify-content: space-between;">
                                    <div class="col-6 col-lg-6 col-xl-6">
                                        <h4 class="box-title">Search Result</h4>
                                    </div>
                                </div><hr>

                                <form action="" method="post">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Class</label>
                                                    <select name="class_id" class="form-control">
                                                        <option value="">--choose--</option>
                                                        <?php
                                                        $get_classes = "SELECT * FROM classes";
                                                        $class_result = mysqli_query($dbconnect, $get_classes);
                                                        while ($row_classes = mysqli_fetch_array($class_result)) {
                                                            echo '<option value="'.$row_classes["id"].'">'.$row_classes["class_name"].' ('.$row_classes["class_code"].')</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Level</label>
                                                    <select name="level" class="form-control">
                                                        <option value="">--choose level--</option>
                                                        <?php
                                                        $letters = ['A', 'B', 'C'];
                                                        for ($i = 1; $i <= 7; $i++) {
                                                            foreach ($letters as $letter) {
                                                                $value = "$i$letter";
                                                                echo "<option value=\"$value\">$value</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Terms</label>
                                                    <select name="terms" class="form-control">
                                                        <option value="">--choose--</option>
                                                        <option value="first">first term</option>
                                                        <option value="second">second term</option>
                                                        <option value="third">third term</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <button type="submit" class="btn btn-success btn-sm" name="search_result">
                                                    Get Student Results <i class="glyphicon glyphicon-search"></i>
                                                </button>
                                                <?php if (isset($_POST['search_result'])): ?>
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="downloadPDF()">
                                                        Download Result as PDF
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Student Results Distribution</h3>
                                    <h6 class="box-subtitle">Get students results</h6>
                                </div> 
                                <div class="box-body">
                                    <div class="table-responsive" id="resultContent">
                                        <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                            <thead>
                                                <tr>
                                                    <th>S/No</th>
                                                    <th>Subjects</th>
                                                    <th>Apitude(/5)</th>
                                                    <th>Mid Term(/15)</th>
                                                    <th>Exam Score (/80)</th>
                                                    <th>Total Score(/100)</th>
                                                    <th>Grade Key/Point</th>
                                                    <th>Grade Remark</th>
                                                    <th>Class Average Score</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_POST['search_result'])) {
                                                    $i = 1;
                                                    $class_id = $_POST['class_id'];
                                                    $level = $_POST['level'];
                                                    $terms = $_POST['terms'];

                                                    $result_search = "SELECT * FROM result WHERE class_id = '$class_id' AND terms = '$terms' AND level = '$level'";
                                                    $result_result = mysqli_query($dbconnect, $result_search);
                                                    while($row_result_result = mysqli_fetch_array($result_result)) {
                                                        if ($row_result_result['user_id'] == $unique_id || $user_role == 'lecturer') {
                                                            $subject = $row_result_result['subject'];
                                                            $total_score = intval($row_result_result['exam_score']) + intval($row_result_result['total_ca']) + intval($row_result_result['attitude']);

                                                            if ($total_score >= 70) {
                                                                $grade_point = 'A'; $grade_remark = 'Excellent';
                                                            } elseif ($total_score > 59) {
                                                                $grade_point = 'B'; $grade_remark = 'Very Good';
                                                            } elseif ($total_score > 49) {
                                                                $grade_point = 'C'; $grade_remark = 'Good';
                                                            } elseif ($total_score > 40) {
                                                                $grade_point = 'D'; $grade_remark = 'Fairly Good';
                                                            } elseif ($total_score > 30) {
                                                                $grade_point = 'E'; $grade_remark = 'Fair';
                                                            } else {
                                                                $grade_point = 'F'; $grade_remark = 'Fail';
                                                            }

                                                            echo '<tr>';
                                                            echo '<td>'.$i++.'</td>';

                                                            $get_subject_name = mysqli_query($dbconnect, "SELECT subject_name FROM subject WHERE id = '$subject'");
                                                            $subject_row = mysqli_fetch_assoc($get_subject_name);
                                                            echo '<td>'.$subject_row['subject_name'].'</td>';

                                                            echo '<td>'.$row_result_result['attitude'].'</td>';
                                                            echo '<td>'.$row_result_result['total_ca'].'</td>';
                                                            echo '<td>'.$row_result_result['exam_score'].'</td>';
                                                            echo '<td>'.$total_score.'</td>';
                                                            echo '<td>'.$grade_point.'</td>';
                                                            echo '<td>'.$grade_remark.'</td>';

                                                            $average_score_query = "SELECT subject, SUM(exam_score + total_ca + attitude) AS total, COUNT(subject) AS sub FROM result GROUP BY subject";
                                                            $average_result = mysqli_query($dbconnect, $average_score_query);
                                                            while($row_avg = mysqli_fetch_array($average_result)) {
                                                                if ($row_avg['subject'] == $subject) {
                                                                    echo '<td>'.round($row_avg['total'] / $row_avg['sub'], 2).'</td>';
                                                                }
                                                            }

                                                            echo '</tr>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
        &copy; <?php echo date('Y') ?> OTA TOTAL ACADEMY |
    </footer>

    <div class="control-sidebar-bg"></div>
</div>

<!-- Include html2pdf.js -->
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

<!-- Download Script -->
<script>
    function downloadPDF() {
        const element = document.getElementById('resultContent');

        if (!element || element.innerText.trim() === '') {
            alert("Result content is empty. Please display results first.");
            return;
        }

        setTimeout(() => {
            const opt = {
                margin:       0.5,
                filename:     '<?= $fullname . "_" . $unique_id . "_result.pdf" ?>',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(element).save();
        }, 500);
    }
</script>

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
