<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Edit Event';
$css = '../css/admin/edit_display.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

$error_message = '';
$success_message = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['edit_id']) && !empty($_POST['edit_title']) && !empty($_POST['edit_content'])) {
        $id = $_POST['edit_id'];
        $title = trim($_POST['edit_title']);
        $content = trim($_POST['edit_content']);

        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql = 'UPDATE event SET title = ?, content = ? WHERE id = ?';
        $stm = $con->prepare($sql);
        $stm->bind_param('ssi', $title, $content, $id);
        $stm->execute();

        if ($stm->affected_rows > 0) {
            $success_message = 'Events updated successfully.';
        } else {
            $error_message = 'Error: Unable to update event.';
        }

        $stm->close();
        $con->close();
    } else {
        $error_message = 'Please fill in all the required fields.';
    }
}

if (isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $result = $con->query("SELECT title, content FROM event WHERE id = $edit_id");
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $edit_title = $row['title'];
        $edit_content = $row['content'];
    } else {
        $error_message = 'Error: Event not found.';
    }
    $con->close();
}
?>

<section class="main-section">
    <div class="edit-container">
        <h2>Edit Notification</h2>
        <?php
        if ($error_message !== '') {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        if ($success_message !== '') {
            echo '<div class="success-message">' . $success_message . '</div>';
        }
        ?>
        <form method="post" action="">
            <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
            <div class="input-container">
                <label for="edit_title">Title:</label><br>
                <input type="text" id="edit_title" name="edit_title" value="<?php echo $edit_title; ?>">
            </div>
            <div class="input-container">
                <label for="edit_content">Content:</label><br>
                <textarea id="edit_content" name="edit_content" rows="4"><?php echo $edit_content; ?></textarea>
            </div>
            <div>
                <input type="submit" value="Submit" class="submit-button">
            </div>
        </form>
    </div>
</section>