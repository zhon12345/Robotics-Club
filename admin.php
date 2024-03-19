<!DOCTYPE html>
<html>

<head>
    <title>仪表板</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <!--导航栏 -->
    <div class="sidenav">
        <div class="grid-item">
            <a href="ttt.php">
                <i class="far fa-user-circle"></i>
        </div>
        <a href="admin.php">Home page</a>
        <a href="#" class="toggle">manage </a>
        <div class="subnav">
            <a href="user management.php">user management</a>
            <a href="notification.php">manage 2</a>
        </div>

        <a href="index.php">USER-PAGE</a>
    </div>

    <!-- content -->
    <div class="main">

        <h2>Welcome admin</h2>

        <?php
        $news = array();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_news"])) {
            $new_news = $_POST["new_news"];
            if (!empty($new_news)) {
                $news[] = $new_news;

                if (count($news) > 3) {
                    $news = array_slice($news, -3, 3);
                }
            }
        }

        foreach ($news as $item) {
            echo '
    <div class="announcement-container">
        <div class="announcement">
            <h3>News</h3>
            <p>' . $item . '</p>
        </div>
    </div>';
        }

        ?>

        <div class="announcement-container">
            <div class="announcement">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <h3>Add News</h3>
                    <textarea name="new_news" rows="3" cols="50"></textarea>
                    <br>
                    <input type="submit" value="Add News">
                </form>
            </div>
        </div>

    </div>

    <script src="js/dashboard.js"></script>
</body>

</html>