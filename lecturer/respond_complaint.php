<?php
session_start();
require 'includes/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (!isset($_SESSION['user_type']) || ($_SESSION['user_type'] != 'teacher' && $_SESSION['user_type'] != 'admin')) {
    //die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint_id']) && isset($_POST['response'])) {
    $complaint_id = intval($_POST['complaint_id']);
    $response = trim($_POST['response']);
    $now = date('Y-m-d H:i:s');

    $stmt = $dbconnect->prepare("UPDATE complaints SET response = ?, responded_at = ? WHERE id = ?");
    $stmt->bind_param("ssi", $response, $now, $complaint_id);

    if ($stmt->execute()) {
        // === Fetch complaint info for email ===
        $complaint_query = $dbconnect->query("SELECT user_id, subject FROM complaints WHERE id = '$complaint_id' LIMIT 1");
        $complaint = $complaint_query->fetch_assoc();
        $student_id = $complaint['user_id'];
        $subject = $complaint['subject'];

        // === Get parent email from student_info table ===
        $email_query = $dbconnect->query("SELECT parent_email FROM students_info WHERE user_id = '$student_id' LIMIT 1");
        if ($email_query && $email_query->num_rows > 0) {
            $parent_email = $email_query->fetch_assoc()['parent_email'];

            // === Send email to parent ===
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'harnarf581@gmail.com';  // Your SMTP username
                $mail->Password = 'nddz mdvo efvf jucu';  // Your SMTP password or app password
                $mail->SMTPSecure = 'ssl';                
                $mail->Port = 465;                         


                $mail->setFrom('harnarf581@gmail.com', 'School System');
                $mail->addAddress($parent_email);

                $mail->isHTML(true);
                $mail->Subject = "Response to Your Complaint: $subject";
                $mail->Body = "
                    <h3>Response to Your Complaint</h3>
                    <p><strong>Subject:</strong> $subject</p>
                    <p><strong>Response:</strong><br>" . nl2br(htmlspecialchars($response)) . "</p>
                ";

                $mail->send();
            } catch (Exception $e) {
                // Log the error, but don’t block response submission
                error_log("Failed to send email to parent: " . $mail->ErrorInfo);
            }
        }

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
