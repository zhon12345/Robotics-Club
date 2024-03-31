<?php
session_start();

$title = 'Show Notification';
$css = '../css/user/notification.css';

include('../includes/header-user.php');
require_once('../includes/helper.php');

?>
<section class="main-section">
    <div class="main-container">
        <div class="Notification Display">
            <h1>Notifications</h1>
            <div class="notification-container">
                <?php
                $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }

                $notification = [];
                $query = "SELECT * FROM notification";
                $result = mysqli_query($con, $query);
                if (!$result) {
                    die("Error in query: " . mysqli_error($con));
                }
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="notification">';
                        echo '<h2>' . $row['title'] . '</h2>';
                        echo '<p>' . $row['message'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "Error fetching notifications: " . mysqli_error($con);
                }
                mysqli_close($con);
                ?>
            </div>
        </div>
    </div>
</section>