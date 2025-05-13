<?php
ini_set('max_execution_time', 300);
set_time_limit(300);

$title = "All Students";
include 'includes/isLogedin.php';
include 'layout/head.php';
?>
<html class="no-js" lang="">
<body>
    <div id="wrapper" class="wrapper bg-ash">
        <?php include_once('layout/nav-header.php'); ?>
        <div class="dashboard-page-one">
            <?php include_once('layout/side-bar.php'); ?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3>Students</h3>
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li>All Students</li>
                    </ul>
                    <?php
                    if (isset($_GET['type'])) {
                        $alertType = $_GET['type'] == 'error' ? 'danger' : 'success';
                        echo '<div class="alert alert-' . $alertType . ' alert-dismissible fade show" role="alert">
                                ' . $_GET['msg'] . '
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                    }
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Students List</h4>
                                </div>
                                <div class="card-body">
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>S/NO</th>
                                                <th>Name</th>
                                                <th>Unique No</th>
                                                <th>Class</th>
                                                <th>Level</th>
                                                <th>Religion</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $limit = 50;
                                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                            $offset = ($page - 1) * $limit;

                                            $get_student_data = "
                                                SELECT users.f_name, users.unique_id, users.role, users.username, students_info.religion, classes.class_name, class_track.level
                                                FROM users 
                                                INNER JOIN class_track ON users.unique_id = class_track.user_id 
                                                INNER JOIN classes ON class_track.class_id = classes.id 
                                                INNER JOIN students_info ON users.unique_id = students_info.user_id 
                                                WHERE users.role = 'student'
                                                LIMIT $limit OFFSET $offset";
                                            
                                            $run_student_data = mysqli_query($dbconnect, $get_student_data);
                                            $i = $offset + 1;

                                            while ($row = mysqli_fetch_assoc($run_student_data)) {
                                                echo "
                                                <tr>
                                                    <td>{$i}</td>
                                                    <td>{$row['f_name']}</td>
                                                    <td>{$row['unique_id']}</td>
                                                    <td>{$row['class_name']}</td>
                                                    <td>{$row['level']}</td>
                                                    <td>{$row['religion']}</td>
                                                    <td>
                                                        <a href='all-student.php?id={$row['unique_id']}&delete=true' class='btn btn-danger text-white'><i class='fas fa-trash'></i></a>
                                                        <a href='student-details.php?id={$row['unique_id']}' class='btn btn-success text-white'><i class='fas fa-eye'></i></a>
                                                        <a href='all-student.php?id={$row['unique_id']}&modal=true' class='btn btn-primary text-white'><i class='fas fa-file-upload'></i></a>
                                                    </td>
                                                </tr>";
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <!-- Pagination Links -->
                                    <?php
                                    $count_query = "SELECT COUNT(*) as total FROM users WHERE role = 'student'";
                                    $result = mysqli_query($dbconnect, $count_query);
                                    $total = mysqli_fetch_assoc($result)['total'];
                                    $total_pages = ceil($total / $limit);

                                    if ($total_pages > 1) {
                                        echo '<nav><ul class="pagination justify-content-center">';
                                        for ($p = 1; $p <= $total_pages; $p++) {
                                            $active = ($p == $page) ? 'active' : '';
                                            echo "<li class='page-item $active'><a class='page-link' href='all-student.php?page=$p'>$p</a></li>";
                                        }
                                        echo '</ul></nav>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php include_once('layout/footer.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('layout/scripts.php'); ?>
</body>
</html>
