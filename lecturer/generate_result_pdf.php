<?php
require_once('TCPDF-main/tcpdf.php');
session_start();

// Optional: restrict access to lecturers/admins
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'lecturer') {
    die('Access denied.');
}

if (!isset($_GET['student_id'])) {
    die('Student ID is required.');
}

$student_id = intval($_GET['student_id']);

$conn = new mysqli('localhost', 'root', '', 'otatotal_student_portal'); // Update DB name
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_res = $conn->query("SELECT * FROM students WHERE student_id = '$student_id'");
if ($student_res->num_rows === 0) {
    die('Student not found.');
}
$student = $student_res->fetch_assoc();

$results = $conn->query("SELECT * FROM results WHERE student_id = '$student_id'");

$html = "<h1>Student Result Sheet</h1>";
$html .= "<p><strong>Name:</strong> {$student['name']}</p>";
$html .= "<p><strong>Student ID:</strong> {$student['student_id']}</p><br>";
$html .= "<table border='1' cellpadding='5'><thead><tr><th>Subject</th><th>Score</th></tr></thead><tbody>";

while ($row = $results->fetch_assoc()) {
    $html .= "<tr><td>{$row['subject']}</td><td>{$row['score']}</td></tr>";
}
$html .= "</tbody></table>";

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output("result_{$student_id}.pdf", 'I');
?>
