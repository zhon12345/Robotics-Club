<?php
$PAGE_TITLE = 'Insert News'; 
define('DB_HOST', 'localhost'); 
define('DB_USER', 'root'); 
define('DB_PASS', ''); 
define('DB_NAME', 'atdata'); 

if (!empty($_POST)) {

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    
    $id = strtoupper(trim($_POST['id']));
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $publish_date = date('Y-m-d H:i:s'); 
    
    $sql = 'INSERT INTO news (id, title, content, publish_date) VALUES (?, ?, ?, ?)';

    $stm = $con->prepare($sql);
    $stm->bind_param('ssss', $id, $title, $content, $publish_date);
    $stm->execute();

    if ($stm->affected_rows > 0) {
        echo '<div class="info">News inserted successfully.</div>';

        $id = $title = $content = null;
    } else {
        echo '<div class="error">Error: Unable to insert news.</div>';
    }

    $stm->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>ADD NOTIFICATIONS</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <!--导航栏 -->
    <div class="sidenav">
        <div class="grid-item">
            <a href="ttt.php">
                <i class="far fa-user-circle"></i>
            </a>
        </div>
        <a href="admin.php">HOME PAGE</a>
        <a href="#" class="toggle">MANAGE </a>
        <div class="subnav">
            <a href="user management.php">USER MANAGEMENT</a>
            <a href="#">MANAGE 2</a>
        </div>

        <a href="#">USER PAGE</a>
    </div>

    <!-- content -->
    <div class="main">
        <div class="container">
            <h2>ADD NOTIFICATION</h2>
            <form method="post" action="">
                <label for="id">ID：</label><br>
                <input type="text" id="id" name="id" style="text-transform: uppercase;"><br>

                <label for="title">TITLE：</label><br>
                <input type="text" id="title" name="title"><br>

                <label for="content">CONTENT：</label><br>
                <textarea id="content" name="content" rows="4"></textarea><br>

                <input type="submit" value="SUBMIT">
            </form>
        </div>
    </div>
</body>

</html>

