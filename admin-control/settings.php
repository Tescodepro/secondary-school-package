
<?php include 'includes/isLogedin.php'; ?>

<?php 
     $title = "Dashboard";
    include 'layout/head.php';
    


// Fetch current settings from DB (assuming a `settings` table with key/value columns)
$query = "SELECT * FROM settings";
$result = mysqli_query($dbconnect, $query);

$settings = [];
while ($row = mysqli_fetch_assoc($result)) {
    $settings[$row['setting_key']] = $row['setting_value'];


// Update settings if submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $school_name = $_POST['school_name'];
    $footer_text = $_POST['footer_text'];
    $navbar_color = $_POST['navbar_color'];
    $navbar_text_color = $_POST['navbar_text_color'];
    $footer_color = $_POST['footer_color'];
    $background_color = $_POST['background_color'];
    $font_size = $_POST['font_size'];
    $font_family = $_POST['font_family'];
    $text_align = $_POST['text_align'];

    // Handle Logo Upload
    $logo = $settings['logo'];
    if (!empty($_FILES['logo']['name'])) {
        $target_dir = "uploads/";
        $logo = $target_dir . basename($_FILES["logo"]["name"]);
        move_uploaded_file($_FILES["logo"]["tmp_name"], $logo);
    }

    $update = $pdo->prepare("UPDATE settings SET school_name=?, footer_text=?, navbar_color=?, navbar_text_color=?, footer_color=?, background_color=?, font_size=?, font_family=?, text_align=?, logo=? WHERE id=1");
    $update->execute([$school_name, $footer_text, $navbar_color, $navbar_text_color, $footer_color, $background_color, $font_size, $font_family, $text_align, $logo]);

    header("Location: dashboard.php?updated=true");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: <?= $settings['background_color'] ?? "#f8f9fa" ?>;
            font-size: <?= $settings['font_size'] ?? "16px" ?>;
            font-family: <?= $settings['font_family'] ?? "Arial, sans-serif" ?>;
            text-align: <?= $settings['text_align'] ?? "left" ?>;
        }
        .navbar {
            background-color: <?= $settings['navbar_color'] ?? "#343a40" ?> !important;
        }
        .navbar a {
            color: <?= $settings['navbar_text_color'] ?? "#ffffff" ?> !important;
        }
        footer {
            background-color: <?= $settings['footer_color'] ?? "#343a40" ?>;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .settings-card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <?php if (!empty($settings['logo'])): ?>
                <img src="<?= $settings['logo'] ?>" alt="Logo" style="height:60px; width:auto;">
            <?php endif; ?>
            <a class="navbar-brand ms-3" href="#"><?= $settings['school_name'] ?? "My School" ?></a>
        </div>
    </nav>

    <div class="container my-4">
        <h2 class="mb-4">Dashboard - Website Settings</h2>

        <div class="card settings-card">
            <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>School Name</label>
                        <input type="text" name="school_name" class="form-control" value="<?= $settings['school_name'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label>Footer Text</label>
                        <input type="text" name="footer_text" class="form-control" value="<?= $settings['footer_text'] ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Upload Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Text Alignment</label>
                        <select name="text_align" class="form-control">
                            <option value="left" <?= ($settings['text_align']=="left")?"selected":"" ?>>Left</option>
                            <option value="center" <?= ($settings['text_align']=="center")?"selected":"" ?>>Center</option>
                            <option value="right" <?= ($settings['text_align']=="right")?"selected":"" ?>>Right</option>
                        </select>
                    </div>
                </div>

                <h5 class="mt-4">Colors</h5>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Navbar Color</label>
                        <input type="color" name="navbar_color" class="form-control" value="<?= $settings['navbar_color'] ?>">
                    </div>
                    <div class="col-md-3">
                        <label>Navbar Text</label>
                        <input type="color" name="navbar_text_color" class="form-control" value="<?= $settings['navbar_text_color'] ?>">
                    </div>
                    <div class="col-md-3">
                        <label>Footer Color</label>
                        <input type="color" name="footer_color" class="form-control" value="<?= $settings['footer_color'] ?>">
                    </div>
                    <div class="col-md-3">
                        <label>Background</label>
                        <input type="color" name="background_color" class="form-control" value="<?= $settings['background_color'] ?>">
                    </div>
                </div>

                <h5 class="mt-4">Typography</h5>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Font Size</label>
                        <input type="text" name="font_size" class="form-control" placeholder="e.g. 16px" value="<?= $settings['font_size'] ?>">
                    </div>
                    <div class="col-md-8">
                        <label>Font Family</label>
                        <input type="text" name="font_family" class="form-control" placeholder="e.g. Arial, sans-serif" value="<?= $settings['font_family'] ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Save Settings</button>
            </form>
        </div>
    </div>

    <footer>
        <?= $settings['footer_text'] ?? "© My School" ?>
    </footer>
</body>
</html>
