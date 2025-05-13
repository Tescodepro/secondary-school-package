<?php 
// test-result.php

// Connect to your database
$dbconnect = mysqli_connect("localhost", "root", "", "otatotal_student_portal");

// Replace with your actual database name
if (!$dbconnect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set test student ID here (one that you know has result data)
$test_user_id = 'STD1002'; // Change this to a real student user_id

// Fetch result data
$sql = "SELECT * FROM result WHERE user_id = '$test_user_id'";
$query = mysqli_query($dbconnect, $sql);

// Check if any results were found
if (mysqli_num_rows($query) > 0) {
    echo "<h3>Results found for student ID: $test_user_id</h3><hr>";
    echo '<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">';
    echo '<thead>
            <tr>
                <th>Subject ID</th>
                <th>Subject Name</th>
                <th>Exam Score</th>
                <th>CA Score</th>
                <th>Attitude</th>
                <th>Total Score</th>
                <th>Grade</th>
                <th>Remark</th>
            </tr>
          </thead>';
    echo '<tbody>';

    // Loop through the result rows and display them
    while ($row = mysqli_fetch_assoc($query)) {
        // Fetch subject name based on subject id
        $subject_id = $row['subject'];
        $subject_query = mysqli_query($dbconnect, "SELECT subject_name FROM subject WHERE id = '$subject_id'");
        $subject_row = mysqli_fetch_assoc($subject_query);
        $subject_name = $subject_row['subject_name'];

        // Calculate total score
        $total_score = intval($row['exam_score']) + intval($row['total_ca']) + intval($row['attitude']);

        // Assign grade and remark
        if ($total_score >= 70) {
            $grade = 'A';
            $remark = 'Excellent';
        } elseif ($total_score >= 60) {
            $grade = 'B';
            $remark = 'Very Good';
        } elseif ($total_score >= 50) {
            $grade = 'C';
            $remark = 'Good';
        } elseif ($total_score >= 40) {
            $grade = 'D';
            $remark = 'Fairly Good';
        } elseif ($total_score >= 30) {
            $grade = 'E';
            $remark = 'Fair';
        } else {
            $grade = 'F';
            $remark = 'Fail';
        }

        // Output the result in a table row
        echo "<tr>
                <td>{$row['subject']}</td>
                <td>$subject_name</td>
                <td>{$row['exam_score']}</td>
                <td>{$row['total_ca']}</td>
                <td>{$row['attitude']}</td>
                <td>$total_score</td>
                <td>$grade</td>
                <td>$remark</td>
              </tr>";
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "<h3>No result found for student ID: $test_user_id</h3>";
}

// Close the database connection
mysqli_close($dbconnect);
?>
