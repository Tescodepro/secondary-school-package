<?php include 'includes/isLogin.php'; ?>

<!DOCTYPE html>

<html lang="en">

<?php

$title = "Uploaded Result";

include 'layout/head.php'

?>



<body class="hold-transition light-skin sidebar-mini theme-primary fixed">



    <div class="wrapper">

        <div id="loader"></div>



        <?php

        include 'layout/header.php';

        ?>



        <?php

        include 'layout/sidebar.php';

        ?>



        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">

            <div class="container-full">

                <div class="row">

                    <div class="col-12 col-lg-12 col-xl-12">

                        <div class="box box-widget widget-user">

                            <div class="widget-user-header bg-primary">

                                <h3 class="widget-user-username">View Uploaded Result</h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-12">

                <div class="box">

                    <div class="rw" style="margin-top: 10px; display: flex; justify-content: space-between;">

                        <div class="col-6 col-lg-6 col-xl-6">

                            <h4 class="box-title">Search Result</h4>

                        </div>

                    </div>

                    <hr>



                    <form action="uploaded_result.php" method="post">

                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label">Class</label>

                                        <select name="class_asigned" class="form-control">

                                            <option value=""> --choose-- </option>

                                            <?php

                                            echo $teacher_id;

                                            $my_class = mysqli_query($dbconnect, "SELECT * FROM class_assign INNER JOIN classes on classes.id  = class_assign.class_id INNER JOIN subject on subject.id  = class_assign.subject

                                                    WHERE class_assign.teacher_id = '$teacher_id'");

                                            while ($class_row = mysqli_fetch_array($my_class)) {

                                                echo '<option value="' . $class_row["class_id"] . '_' . $class_row["level"] . '_' . $class_row['subject'] . '"> ' . $class_row["class_name"] . ' (' . $class_row["class_code"] . '' . $class_row["level"] . ') ' . $class_row['subject_name'] . '</option>';
                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label">Terms</label>

                                        <select name="terms" class="form-control">

                                            <option value=""> --choose-- </option>

                                            <option value="first">first term</option>

                                            <option value="second">second term</option>

                                            <option value="third">third term</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-12 col-lg-12 col-xl-12">

                                    <button type="submit" class="btn btn-success btn-sm" name="search_result">Search <span class="path1"></span><span class="path2"></span><i class="glyphicon glyphicon-search"></i> </button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>



                <div class="box">

                    <div class="box-header with-border">

                        <h3 class="box-title">Result</h3>

                        <h6 class="box-subtitle">Export result to Copy, CSV, Excel, PDF & Print</h6>

                    </div>

                    <div class="box-body">

                        <div class="table-responsive">

                            <table id="exampley1" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">

                                <thead>

                                    <tr>

                                        <th>S/No</th>

                                        <th>Subjects</th>

                                        <th>Unique Code</th>

                                        <th>Aptitude</th>

                                        <th>Total C A</th>

                                        <th>Exam Score</th>

                                        <th>Total Score</th>

                                        <th>Grade Key/Point</th>

                                        <th>Grade Remark</th>

                                        <th>Class Average Score</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    if (isset($_POST['search_result'])) {

                                        $i = 1;

                                        $class_entity = explode('_', $_POST['class_asigned']);

                                        $class_id = $class_entity[0];

                                        $level = $class_entity[1];

                                        $subject = $class_entity[2];

                                        $terms = $_POST['terms'];

                                        $grade_point = '';

                                        $grade_remark = '';

                                        $result_search = "SELECT * FROM result WHERE 

																		class_id = '$class_id' AND terms = '$terms' AND level = '$level' AND subject = '$subject'";

                                        $result_result = mysqli_query($dbconnect, $result_search);

                                        while ($row_result_result = mysqli_fetch_array($result_result)) {

                                            if ($row_result_result['teacher_id'] == $teacher_id) {

                                                $subject = $row_result_result['subject'];

                                                $total_score = intval($row_result_result['exam_score']) + intval($row_result_result['total_ca']) + intval($row_result_result['attitude']);

                                                if ($total_score >= 70) {

                                                    $grade_point = 'A';

                                                    $grade_remark = 'Excellent';
                                                } elseif ($total_score > 59) {

                                                    $grade_point = "B";

                                                    $grade_remark = 'Very Good';
                                                } elseif ($total_score > 49) {

                                                    $grade_point = "C";

                                                    $grade_remark = "Good";
                                                } elseif ($total_score > 40) {

                                                    $grade_point = "D";

                                                    $grade_remark = "Fearly Good";
                                                } elseif ($total_score > 30) {

                                                    $grade_point = "E";

                                                    $grade_remark = "Fear";
                                                } elseif ($total_score > 0) {

                                                    $grade_point = "F";

                                                    $grade_remark = "Fail";
                                                }



                                                echo '<tr>';

                                                echo '<td>' . $i++ . '</td>';

                                                $get_subject_name = "SELECT * FROM subject WHERE id = '$subject'";

                                                $get_subject_name_result = mysqli_query($dbconnect, $get_subject_name);

                                                while ($row_get_subject_name_result = mysqli_fetch_array($get_subject_name_result)) {

                                                    echo '<td>' . $row_get_subject_name_result['subject_name'] . '</td>';
                                                }

                                                echo '<td>' . $row_result_result['user_id'] . '</td>';

                                                echo '<td>' . $row_result_result['attitude'] . '</td>';

                                                echo '<td>' . $row_result_result['total_ca'] . '</td>';

                                                echo '<td>' . $row_result_result['exam_score'] . '</td>';

                                                echo '<td>' . $total_score . '</td>';

                                                echo '<td>' . $grade_point . '</td>';

                                                echo '<td>' . $grade_remark . '</td>';

                                                // average score

                                                $average_score = "SELECT subject, sum(exam_score + total_ca + attitude) as total, COUNT(subject) as sub FROM result GROUP BY subject";

                                                $average_result = mysqli_query($dbconnect, $average_score);

                                                while ($row_average_result = mysqli_fetch_array($average_result)) {

                                                    if ($row_average_result['subject'] == $subject) {

                                                        echo '<td>' . $average_score = $row_average_result['total'] / $row_average_result['sub'] . '</td>';
                                                    }
                                                }
                                            }
                                        }

                                        echo '</tr>';
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

    <!-- /.content-wrapper -->





    <footer class="main-footer">

        &copy; <?php echo date('Y') ?> OTA Total Academy

    </footer>





    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->

    <div class="control-sidebar-bg"></div>



    </div>

    <!-- ./wrapper -->





    <!-- Page Content overlay -->





    <!-- Vendor JS -->

    <script src="assets/js/vendors.min.js"></script>

    <script src="assets/js/pages/chat-popup.js"></script>

    <script src="assets/icons/feather-icons/feather.min.js"></script>



    <script src="assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>

    <script src="assets/vendor_components/moment/min/moment.min.js"></script>

    <script src="assets/vendor_components/fullcalendar/fullcalendar.js"></script>

    <script src="assets/vendor_components/datatable/datatables.min.js"></script>

    <!-- EduAdmin App -->

    <script src="assets/js/template.js"></script>

    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/pages/calendar.js"></script>



    <script src="assets/js/pages/data-table.js"></script>

    <script>
        const btns = document.querySelectorAll('button');

        btns.forEach((items) => {

            items.addEventListener('click', (evt) => {

                evt.target.classList.add('activeLoading');

            })

        })
    </script>







    <script type="text/javascript">
        $(document).ready(function() {

            $('.checkbx').click(function() {

                var amount = 0;

                var p = 0;

                $('.checkbx:checked').each(function() {

                    const raw = $(this).val().split("_");

                    amount = amount + Number(raw[0]);



                });

                $('.inputbx').each(function() {

                    p = Number($(this).val());

                    amount = amount + Number($(this).val());

                });



                $("#selectedAmount").val(amount);

                console.log(amount);

            });

        });
    </script>



    <script>
        function validate_payment() {

            var p = document.getElementById("selectedAmount").value;

            console.log(p);

            if (p == 0) {

                p = 'You must select a payment';

                document.getElementById("myText").style.color = 'red';

                document.getElementById("MakePayment").disabled = true;

                document.getElementById("myText").value = p;



            } else {

                document.getElementById("myText").style.color = 'green';

                document.getElementById("MakePayment").disabled = false;

                document.getElementById("myText").value = p;

            }



        }
    </script>



    <script>
        $(document).ready(function() {

            $(window).keydown(function(event) {

                if (event.keyCode == 13) {

                    event.preventDefault();

                    return false;

                }

            });

        });
    </script>

</body>



</html>