<!DOCTYPE html>
<html>
<head>
    <title>user management</title>
    <link rel="stylesheet" href="test.css">
    <link rel="stylesheet" href="notification.css">
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
        <a href="#">manage 2</a>
    </div>
    
    <a href="#">SETTING</a>
</div>

<!-- content -->
<div class="main">
    <div class="notification-container">
        <?php
        // example come form phpmyadmin
        $notifications = array(
            array("title" => "notify 1", "content" => "Here is the content of Notice 1。"),
            array("title" => "notify 2", "content" => "Here is the content of Notice 2。"),
            // more
        );

        foreach ($notifications as $notification) {
            echo "<div class='notification'>";
            echo "<h3>" . $notification['title'] . "</h3>";
            echo "<p>" . $notification['content'] . "</p>";
            echo "</div>";
        }
        ?>
    </div>

    <form class="add-notification-form" method="post" action="add_notification.php">
        <button class="add-notification" type="submit">add new notify</button>
    </form>

</div>

<script src="dashboard.js"></script>
</body>
</html>