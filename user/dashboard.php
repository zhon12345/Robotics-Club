<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'User Dashboard';
$user = $_SESSION['user'];

include('../includes/header-user.php');
?>

<!-- content -->
<section class="main-section">
    <div class="main-container">
        <h2>Welcome <b><?php echo $user ?></b>, what would you like to do?</h2>

        <div class="grid">
            <a href="notification-display.php"><i class="fa-regular fa-envelope"></i>View Notification</a>
            <a href="user-information.php"><i class="fa-solid fa-user"></i>My Account</a>
        </div>
    </div>
</section>

</body>

</html>