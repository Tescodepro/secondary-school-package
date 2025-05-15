<?php
session_start();
require 'includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complaint_id'], $_POST['response'])) {
    $complaint_id = intval($_POST['complaint_id']);
    $response = mysqli_real_escape_string($dbconnect, $_POST['response']);
    $date_responded = date('Y-m-d H:i:s');

    $update = "UPDATE complaints SET response = '$response', status = 'resolved', date_responded = '$date_responded' WHERE id = $complaint_id";

    if (mysqli_query($dbconnect, $update)) {
        $_SESSION['dashboard_msg'] = [
            'type' => 'success',
            'text' => 'Complaint responded to successfully.'
        ];
    } else {
        $_SESSION['dashboard_msg'] = [
            'type' => 'error',
            'text' => 'Failed to respond to complaint. Please try again.'
        ];
    }

    header('Location: dashboard.php');
    exit();
} else {
    $_SESSION['dashboard_msg'] = [
        'type' => 'error',
        'text' => 'Invalid request.'
    ];
    header('Location: dashboard.php');
    exit();
}
