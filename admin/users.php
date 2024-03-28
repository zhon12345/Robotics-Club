<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'User Management';
$css = '../css/admin/users.css';

include('../includes/header-admin.php');
?>

<section class="main-section">
    <div class="main-container">
        <div class="person-management">
            <h3>user management</h3>
            <?php
            $users = array(
                array("username" => "user123", "phone" => "1234567890"),
                array("username" => "user456", "phone" => "0987654321"),
                array("username" => "user456", "phone" => "0987654321"),
                array("username" => "user456", "phone" => "0987654321"),
                array("username" => "user456", "phone" => "0987654321"),
                array("username" => "user456", "phone" => "0987654321"),
                array("username" => "user789", "phone" => "1112223333")
            );
            $total_users = count($users);

            echo "<p>total user：" . $total_users . "</p>";

            foreach ($users as $index => $user) {
                echo "<div class='person-info'>";
                echo "<p>" . ($index + 1) . ". " . $user['username'] . " " . $user['phone'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="button-container">
            <div class="button">
                <a href="#">Add user</a>
            </div>
            <div class="button">
                <a href="#">Remove user</a>
            </div>
            <div class="button">
                <a href="#">Others</a>
            </div>
        </div>
    </div>
</section>
</body>

</html>