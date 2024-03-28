<?php
$title = 'News Management';
include('../includes/header-admin.php');
require_once('../includes/helper.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['content'])) {
        $id = strtoupper(trim($_POST['id']));
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $photoData = null;

        if (isset($_FILES["photo"]["tmp_name"]) && $_FILES["photo"]["error"] === UPLOAD_ERR_OK) {
            $photo = $_FILES["photo"]["tmp_name"];
            $photoData = addslashes(file_get_contents($photo));
        }

        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql = 'INSERT INTO news (id, title, content, photo) VALUES (?, ?, ?, ?)';
        $stm = $con->prepare($sql);
        $stm->bind_param('ssss', $id, $title, $content, $photoData);
        $stm->execute();

        if ($stm->affected_rows > 0) {
            echo '<div class="info">News inserted successfully.</div>';
            header("Location: add-news.php");
            exit();
        } else {
            echo '<div class="error">Error: Unable to insert news.</div>';
        }

        $stm->close();
        $con->close();
    } else {
        echo '<div class="error">Please fill in all the required fields.</div>';
    }
}

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $delete_query = "DELETE FROM news WHERE id = ?";
    $stm_delete = $con->prepare($delete_query);
    $stm_delete->bind_param('s', $delete_id);
    $stm_delete->execute();
    $stm_delete->close();
    $con->close();
}

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$result = $con->query("SELECT id, content FROM news");
?>

<section class="main-section">
    <div class="main-container">
        <h2 style="margin-top: 6rem;">ADD NOTIFICATION</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="id">ID：</label><br>
            <input type="text" id="id" name="id" style="text-transform: uppercase; font-size: 20px;"><br>
            <label for="title">TITLE：</label><br>
            <input type="text" id="title" name="title" style="font-size: 20px;"><br>
            <label for="content">CONTENT：</label><br>
            <textarea id="content" name="content" rows="4" style="width: 1044px; height: 318px; font-size: 20px;"></textarea><br>

            <label for="photo">PHOTO：</label><br>
            <input type="file" id="photo" name="photo" style="margin-bottom: 10px; width: 200px;"><br>

            <div>
                <input type="submit" value="SUBMIT" style="margin-right: 10px; width: 150px; height: 40px;">
            </div>
        </form>

        <h2 style="margin-top: 6rem;">Notification List</h2>
        <?php
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $content = $row['content'];
        ?>
            <div class="notification-box">
                <div class="notification-content"><?php echo $content; ?></div>
                <div class="delete-column">
                    <form method="post" action="">
                        <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>