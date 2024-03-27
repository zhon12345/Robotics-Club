<?php
$title = 'News Management';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

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

<section class="main-section">
    <div class="main-container">
        <h2>ADD NOTIFICATION</h2>
        <form method="post" action="">
            <label for="id">DATE：</label><br>
            <input type="text" id="id" name="id" style="text-transform: uppercase;"><br>

            <label for="title">TITLE：</label><br>
            <input type="text" id="title" name="title"><br>

            <label for="content">CONTENT：</label><br>
            <textarea id="content" name="content" rows="4"></textarea><br>

            <input type="submit" value="SUBMIT">
        </form>
    </div>
</section>
</body>

</html>