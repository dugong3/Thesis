<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <div class="navbar">
        <a href="dashboard.php">Dashboard</a>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
            <a href="schedule.php">Schedule Entry</a>
            <a href="feeds.php">Feeds Entry</a>
            <a href="mortality.php">Mortality Entry</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="signin.php">Login</a>
        <?php endif; ?>
    </div>
</body>
</html>
