<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Notification Management';
$css = '../css/admin/news.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql = 'INSERT INTO notification (title, content) VALUES (?, ?)';
        $stm = $con->prepare($sql);
        $stm->bind_param('ss', $title, $content);
        $stm->execute();

        if ($stm->affected_rows > 0) {
            $success_message = 'News inserted successfully.';
            header("Location: ./notification.php");
            exit();
        } else {
            $error_message = 'Error: Unable to insert notification.';
        }

        $stm->close();
        $con->close();
    } else {
        $error_message = 'Please fill in all the required fields.';
    }
}

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $delete_query = "DELETE FROM notification WHERE id = ?";

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
$result = $con->query("SELECT id, title, content FROM notification");
?>

<section class="main-section">
    <div class="main-container">
        <h1>NOTIFICATION LIST</h1>
        <div class="notification-container">
            <?php
            $count = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $title = isset($row['title']) ? $row['title'] : '';
                    $content = isset($row['content']) ? $row['content'] : '';
                    $count++;
            ?>
                    <div class="notification-box">
                        <div class="notification-title">ID: <?php echo $id; ?> - Title: <?php echo $title; ?></div>
                        <div class="notification-content" style="display: none;"><?php echo $content; ?></div>
                        <div class="delete-edit-column">
                            <div class="delete-column">
                                <form method="post" action="">
                                    <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </div>
                            <div class="edit-column">
                                <form method="post" action="edit_notification.php">
                                    <input type="hidden" name="edit_id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="edit_title" value="<?php echo $title; ?>">
                                    <input type="hidden" name="edit_content" value="<?php echo $content; ?>">
                                    <input type="submit" value="Edit">
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                    if ($count % 4 == 0) {
                        if ($count == 4) {
                            echo '<button id="more-button-1" onclick="toggleNotifications()" class="more-button">More</button>';
                        }
                        echo '<div id="more-notifications-' . $count . '" class="more-notifications" style="display: none;">';
                    }
                }
            } else {
                echo '<div class="no-notification-box">No Notification available.</div>';
            }
            ?>
        </div>

        <hr class="line">

        <h1>ADD notification</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="input-container">
                <label for="title">TITLE：</label><br>
                <input type="text" id="title" name="title">
            </div>

            <div class="input-container">
                <label for="content">CONTENT：</label><br>
                <textarea id="content" name="content" rows="4"></textarea>
            </div>

            <div>
                <input type="submit" value="SUBMIT" class="submit-button">
            </div>

        </form>
    </div>
</section>

<script>
    function toggleNotifications() {
        var moreNotifications = document.querySelectorAll(".more-notifications");
        var moreButton = document.getElementById("more-button-1");
        if (moreNotifications.length > 0 && moreButton) {
            var isDisplayed = moreNotifications[0].style.display === "block";
            moreNotifications.forEach(function(notification) {
                notification.style.display = isDisplayed ? "none" : "block";
            });
            moreButton.textContent = isDisplayed ? "More" : "Less";
        }
    }

    document.addEventListener("click", function(event) {
        var target = event.target;
        var isMoreButton = target.tagName === "BUTTON" && target.classList.contains("more-button");
        var isNotificationContent = target.classList.contains("notification-content");
        if (!isMoreButton && !isNotificationContent) {
            var moreNotifications = document.querySelectorAll(".more-notifications");
            var moreButton = document.getElementById("more-button-1");
            if (moreButton) {
                moreButton.textContent = "More";
            }
            moreNotifications.forEach(function(notification) {
                notification.style.display = "none";
            });
        }
    });
</script>
</body>

</html>