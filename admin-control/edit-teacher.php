<?php
$title = "Edit Teacher";
include 'includes/isLogedin.php';
include 'layout/head.php';


// Get teacher ID from query string
if (!isset($_GET['id'])) {
    header("Location: all-teacher.php?type=error&msg=Teacher ID is missing");
    exit;
}

$teacher_id = $_GET['id'];

// Fetch teacher details
$query = "SELECT users.*, teachers_info.* 
          FROM users 
          INNER JOIN teachers_info ON users.unique_id = teachers_info.teacher_id 
          WHERE users.unique_id = '$teacher_id'";
$result = mysqli_query($dbconnect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: all-teacher.php?type=error&msg=Teacher not found");
    exit;
}

$teacher = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $f_name = mysqli_real_escape_string($dbconnect, $_POST['f_name']);
    $email = mysqli_real_escape_string($dbconnect, $_POST['email']);
    $religion = mysqli_real_escape_string($dbconnect, $_POST['religion']);
    $gender = mysqli_real_escape_string($dbconnect, $_POST['gender']);

    $update_user = "UPDATE users SET f_name='$f_name', email='$email' WHERE unique_id='$teacher_id'";
    $update_info = "UPDATE teachers_info SET religion='$religion', gender='$gender' WHERE teacher_id='$teacher_id'";

    if (mysqli_query($dbconnect, $update_user) && mysqli_query($dbconnect, $update_info)) {
        header("Location: all-teacher.php?type=success&msg=Teacher updated successfully");
        exit;
    } else {
        $error = "Failed to update teacher. Please try again.";
    }
}
?>

<html class="no-js" lang="">
<body>
    <div id="wrapper" class="wrapper bg-ash">
        <?php include_once('layout/nav-header.php'); ?>
        <div class="dashboard-page-one">
            <?php include_once('layout/side-bar.php'); ?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3>Edit Teacher</h3>
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="all-teacher.php">Teachers</a></li>
                        <li>Edit Teacher</li>
                    </ul>
                    <?php if (isset($error)) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    } ?>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="f_name">Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $teacher['f_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $teacher['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="religion">Religion</label>
                                <input type="text" name="religion" class="form-control" value="<?php echo $teacher['religion']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="Male" <?php echo ($teacher['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo ($teacher['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                    <option value="Other" <?php echo ($teacher['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Teacher</button>
                            <a href="all-teacher.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>

                <?php include_once('layout/footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include_once('layout/scripts.php'); ?>
</body>
</html>
