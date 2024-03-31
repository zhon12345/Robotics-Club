<?php
$title = 'Events';
$css = 'css/website/event.css';

include('includes/header.php');
require_once('includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM event";
$result = $con->query($sql);

?>

<section class="event-section">
    <h1 class="section-title"><?php echo $title; ?></h1>
    <div class="event-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='event-item'>";
                echo "<div class='event-details'>";
                echo "<div class='event-date'>Date: " . date("Y-m-d", strtotime($row["date"])) . "</div>";
                echo "<div class='event-title'>Event: " . htmlspecialchars($row["title"]) . "</div>";
                echo "<div class='event-content'>About Event: " . $row["content"] . "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='no-results'>0 results</div>";
        }
        ?>
    </div>
</section>

</body>

</html>

<?php
$con->close();
?>