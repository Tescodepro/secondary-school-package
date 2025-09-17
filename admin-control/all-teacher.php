<?php 
ini_set('max_execution_time', 300);
set_time_limit(300);

$title = "All Teachers";
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
                <h3>Teachers</h3>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li>All Teachers</li>
                </ul>

                <!-- Alert Message -->
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
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Teachers List</h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S/NO</th>
                                        <th>Name</th>
                                        <th>Unique No</th>
                                        <th>Email</th>
                                        <th>Religion</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $limit = 50;
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($page - 1) * $limit;

                                    $get_teacher_data = "
                                        SELECT users.f_name, users.unique_id, users.email, users.role, teachers_info.religion, teachers_info.gender
                                        FROM users 
                                        INNER JOIN teachers_info ON users.unique_id = teachers_info.teacher_id
                                        WHERE users.role = 'teacher'
                                        LIMIT $limit OFFSET $offset";

                                    $run_teacher_data = mysqli_query($dbconnect, $get_teacher_data);
                                    $i = $offset + 1;

                                    while ($row = mysqli_fetch_assoc($run_teacher_data)) {
                                        echo "
                                        <tr>
                                            <td>{$i}</td>
                                            <td>{$row['f_name']}</td>
                                            <td>{$row['unique_id']}</td>
                                            <td>{$row['email']}</td>
                                            <td>{$row['religion']}</td>
                                            <td>{$row['gender']}</td>
                                            <td>
                                                <a href='teacher-details.php?id={$row['unique_id']}' class='btn btn-success text-white' title='View'><i class='fas fa-eye'></i></a>
                                                <a href='edit-teacher.php?id={$row['unique_id']}' class='btn btn-primary text-white' title='Edit'><i class='fas fa-edit'></i></a>
                                                <a href='delete-teacher.php?id={$row['unique_id']}' class='btn btn-danger text-white' onclick=\"return confirm('Are you sure you want to delete this teacher?')\" title='Delete'><i class='fas fa-trash'></i></a>
                                            </td>
                                        </tr>";
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <?php
                            $count_query = "SELECT COUNT(*) as total FROM users WHERE role = 'teacher'";
                            $result = mysqli_query($dbconnect, $count_query);
                            $total = mysqli_fetch_assoc($result)['total'];
                            $total_pages = ceil($total / $limit);

                            if ($total_pages > 1) {
                                echo '<nav><ul class="pagination justify-content-center">';
                                for ($p = 1; $p <= $total_pages; $p++) {
                                    $active = ($p == $page) ? 'active' : '';
                                    echo "<li class='page-item $active'><a class='page-link' href='all-teacher.php?page=$p'>$p</a></li>";
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

<?php include_once('layout/scripts.php'); ?>
</body>
</html>
