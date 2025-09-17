<?php
session_start();
set_time_limit(300); 

require 'includes/database.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (!isset($_SESSION['auth_user'])) {
    die("Unauthorized access");
}

$user_id = $_SESSION['auth_user'];
$user_type = 'student';

$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

if ($subject && $message) {
    $stmt = $dbconnect->prepare("INSERT INTO complaints (user_id, user_type, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user_id, $user_type, $subject, $message);

    if ($stmt->execute()) {
     
        $emails = ['harnarf581@gmail.com'];

        $admin_result = $dbconnect->query("SELECT email FROM admin_login WHERE email IS NOT NULL");
        while ($row = $admin_result->fetch_assoc()) {
            $emails[] = $row['email'];
        }

        $teacher_result = $dbconnect->query("SELECT email FROM users WHERE role = 'teacher' AND email IS NOT NULL");
        while ($row = $teacher_result->fetch_assoc()) {
            $emails[] = $row['email'];
        }

       
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'harnarf581@gmail.com';
            $mail->Password = 'nddzmdvoefvfjucu'; 
                $mail->SMTPSecure = 'ssl';                
    $mail->Port = 465;                         


            $mail->setFrom('harnarf581@gmail.com', 'School System');

            foreach ($emails as $recipient) {
                $mail->addBCC($recipient); 
            }

            $mail->isHTML(true);
            $mail->Subject = 'New Complaint Submitted';
            $mail->Body = "
                <h3>New Complaint Submitted</h3>
                <p><strong>User ID:</strong> $user_id ($user_type)</p>
                <p><strong>Subject:</strong> $subject</p>
                <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            error_log("PHPMailer Error: {$mail->ErrorInfo}");
        }

        header('Location: dashboard.php?type=success&msg=' . urlencode("Complaint submitted and admin notified."));
        exit();
    } else {
        header('Location: dashboard.php?type=error&msg=' . urlencode("Error submitting complaint."));
        exit();
    }
} else {
    header('Location: dashboard.php?type=error&msg=' . urlencode("All fields are required."));
    exit();
}
?>
