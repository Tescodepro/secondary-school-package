<?php
session_start();
require 'includes/database.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['user_type'] != 'teacher' && $_SESSION['user_type'] != 'admin')) {
   // header('Location: login.php');
    //exit();
}

$fullname = $_SESSION['fullname'] ?? ''; 

include 'layout/head.php';
?>
<body>
    <div id="wrapper" class="wrapper bg-ash">
        <?php include_once('layout/nav-header.php'); ?>
        <div class="dashboard-page-one">
            <?php include_once('layout/side-bar.php'); ?>
            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3>Complaints</h3>
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li>View Complaints</li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <h5 class="font-weight-bold mb-4">All Complaints</h5>

                                <?php
                                $result = $dbconnect->query("SELECT * FROM complaints ORDER BY date_submitted DESC");

                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <p><strong>ID:</strong> ' . $row['id'] . '</p>
                                            <p><strong>User ID:</strong> ' . $row['user_id'] . ' (' . $row['user_type'] . ')</p>
                                            <p><strong>Subject:</strong> ' . htmlspecialchars($row['subject']) . '</p>
                                            <p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($row['message'])) . '</p>
                                            <p><strong>Status:</strong> <span class="badge badge-' . ($row['status'] == 'resolved' ? 'success' : 'danger') . '">' . ucfirst($row['status']) . '</span></p>
                                            <p><strong>Submitted:</strong> ' . $row['date_submitted'] . '</p>';

                                    if ($row['status'] == 'resolved') {
                                        echo '
                                            <hr>
                                            <p><strong>Response:</strong><br>' . nl2br(htmlspecialchars($row['response'])) . '</p>
                                            <p><strong>Responded On:</strong> ' . $row['date_responded'] . '</p>';
                                    } else {
                                        echo '
                                            <hr>
                                            <form action="respond_complaint.php" method="POST">
                                                <input type="hidden" name="complaint_id" value="' . $row['id'] . '">
                                                <div class="form-group">
                                                    <label>Response:</label>
                                                    <textarea name="response" class="form-control" rows="4" required placeholder="Enter your response..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit Response</button>
                                            </form>';
                                    }

                                    echo '</div></div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include_once('layout/footer.php'); ?>
            </div>
        </div>
    </div>

    <?php include_once('layout/scripts.php'); ?>
</body>
</html>
