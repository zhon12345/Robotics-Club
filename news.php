<?php
$title = 'News';
$css = 'css/website/news.css';

include('includes/header.php');
require_once('includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM news";
$result = $con->query($sql);

?>

<section class="news-section">
    <h1 class="section-title"><?php echo $title; ?></h1>
    <div class="news-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='news-item'>";
                echo "<div class='news-details'>";
                echo "<div class='news-date'>" . date("Y-m-d", strtotime($row["date"])) . "</div>";
                echo "<div class='news-title'>" . htmlspecialchars($row["title"]) . "</div>";
                echo "<div class='news-content' style='display: none;'>" . $row["content"] . "</div>";
                echo "<div class='more' onclick='toggleContent(this)'>More</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='no-results'>0 results</div>";
        }
        ?>
    </div>
</section>

<script src="js/script.js"></script>
</body>

</html>

<?php
$con->close();
?>