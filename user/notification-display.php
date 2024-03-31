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
                $connection = mysqli_connect('localhost', 'username', 'password', 'notification');
                if (!$connection) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $notification = [];
                $query = "SELECT * FROM notification";
                $result = mysqli_query($connection, $query);
                if (!$result) {
                    die("Error in query: " . mysqli_error($connection));
                }
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="notification">';
                        echo '<h2>' . $row['title'] . '</h2>';
                        echo '<p>' . $row['message'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "Error fetching notifications: " . mysqli_error($connection);
                }
                mysqli_close($connection);
                ?>
            </div>
        </div>
    </div>
</section>
