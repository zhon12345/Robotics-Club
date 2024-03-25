<?php
$title = 'Admin Panel';

include('includes/header-admin.php');
?>

<!-- content -->
<section class="main-section">
    <div class="main-container">
        <h2>Welcome <b><?php echo ADMIN_USER ?></b>, what would you like to do?</h3>

            <div class="grid">
                <a href=""><i class="fa-solid fa-list-check"></i>Manage Projects</a>
                <a href="add-news.php"><i class="fa-solid fa-newspaper"></i> Manage News</a>
                <a href="users.php"><i class="fa-solid fa-users"></i>Manage Users</a>
                <a href=""><i class="fa-solid fa-bell"></i>Manage Notification</a>
            </div>
    </div>
</section>

</body>

</html>