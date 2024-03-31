<?php
$title = 'Notifications';
$css = '..\css\user\notification.css';

include('..\includes\header-user.php');
require_once('..\includes\helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM notification";
$result = $con->query($sql);

?>

<section class="main-section">
<h1>Notification</h1>
    <div class="main-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $date = date("Y-m-d", strtotime($row["date"]));
                $title = htmlspecialchars($row["title"]);
                $content = $row["content"];

                echo "<div class='event-item'>";
                echo "<div class='event-details'>";
                echo "<div class='event-date'>date：$date</div>";
                echo "<div class='event-title'>title：$title</div>";
                echo "<div class='event-content'>content：$content</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='no-results'>0 result</div>";
        }
        ?>
    </div>
</section>

</body>

</html>

<?php
$con->close();
?>
