<?php
session_start();
require 'includes/database.php';

if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 'teacher' && $_SESSION['user_type'] != 'admin')) {
    //die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint_id']) && isset($_POST['response'])) {
    $complaint_id = intval($_POST['complaint_id']);
    $response = trim($_POST['response']);

    $stmt = $dbconnect->prepare("UPDATE complaints SET response = ?, status = 'resolved', date_responded = NOW() WHERE id = ?");
    $stmt->bind_param("si", $response, $complaint_id);

    if ($stmt->execute()) {
        //echo "Response submitted successfully.";
          // Redirect to dashboard with success message
          header('Location: dashboard.php?type=success&msg=Response submitted successfully');
          exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}
?>
