<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'User Dashboard';
include('../includes/header-admin.php');
?>
include('../includes/header-user.php');
<section class="main-section">
    <div class="main-container">
        <h2>Welcome <b></b>, what would you like to do?</h2>

        <div class="grid">
            <a href="events.php"><i class="fa-regular fa-calendar-days"></i>Event Tickets</a>
            <a href="news.php"><i class="fa-solid fa-newspaper"></i> News</a>
            <a href="users.php"><i class="fa-solid fa-users"></i>Edit User Information</a>
            <a href="notification.php"><i class="fa-solid fa-bell"></i>Notification</a>
        </div>
    </div>
</section>

</body>

</html>