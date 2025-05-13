<?php
// Localhost database connection settings for XAMPP
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Default is blank in XAMPP
define('DB_NAME', 'otatotal_student_portal'); // ← Replace with your actual database name

// Connect to MySQL database
$dbconnect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if (!$dbconnect) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
