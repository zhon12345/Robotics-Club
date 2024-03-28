<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Admin Panel';

include('../includes/header-admin.php');
?>

<!-- content -->
<section class="main-section">
    <div class="main-container">
        <h2>Welcome <b><?php echo ADMIN_USER ?></b>, what would you like to do?</h3>

            <div class="grid">
                <a href=""><i class="fa-regular fa-calendar-days"></i>Manage Events</a>
                <a href="add-news.php"><i class="fa-solid fa-newspaper"></i> Manage News</a>
                <a href="users.php"><i class="fa-solid fa-users"></i>Manage Users</a>
                <a href="notification.php"><i class="fa-solid fa-bell"></i>Manage Notification</a>
            </div>
    </div>
</section>

</body>

</html>