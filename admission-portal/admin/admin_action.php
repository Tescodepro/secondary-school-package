<?php
include '../database.php';
if (isset($_POST['admit'])) {
     $updateID  = $_POST['id'];
    $UPDADEADMITED = "UPDATE admission_user SET add_status = '1' WHERE assign_id = '$updateID'";
    $updateResult = mysqli_query($dbconnect, $UPDADEADMITED);
    $user_table = "UPDATE users SET status = '1' WHERE addmission_id = '$updateID'";
    $run_user_table = mysqli_query($dbconnect, $user_table);
    $students_info_table = "UPDATE students_info SET admition_status = '1' WHERE addmission_id = '$updateID'";
    $run_students_info_table = mysqli_query($dbconnect, $students_info_table);
    if ($updateResult && $run_user_table && $run_students_info_table) {
        echo "<script type=\"text/javascript\">
                alert(\"Successfully Admitted\");
                    window.location = \"student.php\"
            </script>";
    }
}
if (isset($_POST['NOTapprove'])) {
    $updateID  = $_POST['id'];
    $UPDADEADMITED = "UPDATE admission_user SET add_status = '2' WHERE assign_id = '$updateID'";
    $updateResult = mysqli_query($dbconnect, $UPDADEADMITED);
    $user_table = "UPDATE users SET status = '0' WHERE addmission_id = '$updateID'";
    $run_user_table = mysqli_query($dbconnect, $user_table);
    $students_info_table = "UPDATE students_info SET admition_status = '0' WHERE addmission_id = '$updateID'";
    $run_students_info_table = mysqli_query($dbconnect, $students_info_table);
    if ($updateResult && $run_user_table && $run_students_info_table) {
        echo "<script type=\"text/javascript\">
                alert(\"Admittion successfully terminated\");
                    window.location = \"student.php\"
            </script>";
    }
}
?>