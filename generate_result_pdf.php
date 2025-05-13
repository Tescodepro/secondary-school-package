<?php
require_once('TCPDF-main/tcpdf.php');
session_start();

if (!isset($_SESSION['student_id'])) {
    die('Unauthorized access');
}

$student_id = $_SESSION['student_id'];

$conn = new mysqli('localhost', 'root', '', 'otatotal_student_portal'); // Update DB name if different
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_res = $conn->query("SELECT * FROM students WHERE student_id = '$student_id'");
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
