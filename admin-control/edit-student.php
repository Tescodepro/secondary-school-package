<?php
//session_start();
include 'includes/isLogedin.php';
//include 'includes/dbconnect.php'; // Add this if not already included

// Ensure only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    //die("Unauthorized access.");
}

$id = mysqli_real_escape_string($dbconnect, $_GET['id']);

// Handle update
if (isset($_POST['update'])) {
    $f_name         = mysqli_real_escape_string($dbconnect, $_POST['f_name']);
    $gender         = mysqli_real_escape_string($dbconnect, $_POST['gender']);
    $dob            = mysqli_real_escape_string($dbconnect, $_POST['dob']);
    $religion       = mysqli_real_escape_string($dbconnect, $_POST['religion']);
    $blood_group    = mysqli_real_escape_string($dbconnect, $_POST['blood_group']);
    $class_id       = mysqli_real_escape_string($dbconnect, $_POST['class_id']);
    $level          = mysqli_real_escape_string($dbconnect, $_POST['level']);
    $parent_name    = mysqli_real_escape_string($dbconnect, $_POST['parent_name']);
    $parent_address = mysqli_real_escape_string($dbconnect, $_POST['parent_address']);
    $parent_phone   = mysqli_real_escape_string($dbconnect, $_POST['parent_phone_num']);
    $parent_email   = mysqli_real_escape_string($dbconnect, $_POST['parent_email']);

    mysqli_query($dbconnect, "UPDATE users SET f_name='$f_name' WHERE unique_id='$id'");
    mysqli_query($dbconnect, "UPDATE students_info SET gender='$gender', dob='$dob', religion='$religion', blood_group='$blood_group', parent_name='$parent_name', parent_address='$parent_address', parent_phone_num='$parent_phone', parent_email='$parent_email' WHERE user_id='$id'");
    mysqli_query($dbconnect, "UPDATE class_track SET class_id='$class_id', level='$level' WHERE user_id='$id'");

    header("Location: all-student.php?type=success&msg=" . urlencode("Student updated successfully."));
    exit;
}

// Fetch existing student info from the database
$query = "
    SELECT u.f_name, s.gender, s.dob, s.religion, s.blood_group,
           c.class_name, ct.class_id, ct.level,
           s.parent_name, s.parent_address, s.parent_phone_num, s.parent_email
    FROM users u
    JOIN students_info s ON u.unique_id = s.user_id
    JOIN class_track ct ON u.unique_id = ct.user_id
    JOIN classes c ON ct.class_id = c.id
    WHERE u.unique_id='$id'
";
$res = mysqli_query($dbconnect, $query);
if (!$res || mysqli_num_rows($res) !== 1) die("Student not found.");

$row = mysqli_fetch_assoc($res);

// Get class options
$classOptions = mysqli_query($dbconnect, "SELECT id, class_name FROM classes");
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Student Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="fonts/flaticon.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>
<body>
<div id="preloader"></div>
<div id="wrapper" class="wrapper bg-ash">
    <?php include_once('layout/nav-header.php'); ?>
    <div class="dashboard-page-one">
        <?php include_once('layout/side-bar.php'); ?>
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area">
                <h3>Edit Student</h3>
                <ul>
                    <li><a href="all-student.php"><i class="fa fa-arrow-left"></i> Student List</a></li>
                </ul>
            </div>

            <div class="card height-auto">
                <div class="card-body">
                    <h3>About Student</h3>
                    <form method="post">
                        <div class="form-group"><label>Full Name</label>
                            <input type="text" name="f_name" value="<?= htmlspecialchars($row['f_name']) ?>" class="form-control" required>
                        </div>
                        <div class="form-group"><label>Gender</label>
                            <select name="gender" class="form-control">
                                <?php foreach(['M'=>'Male','F'=>'Female'] as $g => $label): ?>
                                    <option value="<?= $g ?>" <?= ($row['gender'] == $g) ? 'selected' : '' ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group"><label>Date of Birth</label>
                            <input type="date" name="dob" value="<?= htmlspecialchars($row['dob']) ?>" class="form-control">
                        </div>
                        <div class="form-group"><label>Religion</label>
                            <input type="text" name="religion" value="<?= htmlspecialchars($row['religion']) ?>" class="form-control">
                        </div>
                        <div class="form-group"><label>Blood Group</label>
                            <input type="text" name="blood_group" value="<?= htmlspecialchars($row['blood_group']) ?>" class="form-control">
                        </div>
                        <div class="form-group"><label>Class</label>
                            <select name="class_id" class="form-control">
                                <?php while ($c = mysqli_fetch_assoc($classOptions)): ?>
                                    <option value="<?= $c['id'] ?>" <?= ($c['id'] == $row['class_id']) ? 'selected' : '' ?>><?= htmlspecialchars($c['class_name']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group"><label>Level</label>
                            <input type="text" name="level" value="<?= htmlspecialchars($row['level']) ?>" class="form-control">
                        </div>
                        <div class="form-group"><label>Parent Name</label>
                            <input type="text" name="parent_name" value="<?= htmlspecialchars($row['parent_name']) ?>" class="form-control">
                        </div>
                        <div class="form-group"><label>Parent Address</label>
                            <input type="text" name="parent_address" value="<?= htmlspecialchars($row['parent_address']) ?>" class="form-control">
                        </div>
                        <div class="form-group"><label>Parent Phone</label>
                            <input type="text" name="parent_phone_num" value="<?= htmlspecialchars($row['parent_phone_num']) ?>" class="form-control">
                        </div>
                        <div class="form-group"><label>Parent Email</label>
                            <input type="email" name="parent_email" value="<?= htmlspecialchars($row['parent_email']) ?>" class="form-control">
                        </div>

                        <button type="submit" name="update" class="btn btn-primary">Update Student</button>
                    </form>
                </div>
            </div>

            <footer class="footer-wrap-layout1">
                <div class="copyright">© <?= date('Y') ?> <a href="#">Your School Name</a>. All rights reserved.</div>
            </footer>
        </div>
    </div>
</div>

<!-- JS Scripts -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
