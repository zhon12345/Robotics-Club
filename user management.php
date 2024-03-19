<!DOCTYPE html>
<html>
<head>
    <title>user management</title>
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<!--导航栏 -->
<div class="sidenav">
    <div class="grid-item">
    <a href="ttt.php">
        <i class="far fa-user-circle"></i> 
    </div>
    <a href="test.php">Home page</a>
    <a href="#" class="toggle">manage </a>
    <div class="subnav">
        <a href="user management.php">user management</a>
        <a href="notification.php">notification</a>
    </div>
    
    <a href="#">SETTING</a>
</div>

<!-- content -->
<div class="main">
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
            <a href="#">add user</a>
        </div>
        <div class="button">
            <a href="#">remove user</a>
        </div>
        <div class="button">
            <a href="#">other</a>
        </div>
    </div>
</div>
<script src="dashboard.js"></script>
</body>
</html>
