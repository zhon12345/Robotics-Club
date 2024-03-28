<?php
$title = 'News';
$css = 'css\website\news.css';

include('includes/header.php');
require_once('includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM news";
$result = $con->query($sql);

?>

<section class="main-section">
    <div class="main-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='news-item'>";
                echo "<div class='news-photo'>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($row["photo"]) . '" />';
                echo "</div>";
                echo "<div class='news-details'>";
                echo "<div class='news-date'>" . $row["date"] . "</div>";
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

</body>
</html>

<?php
$con->close();
?>
<script>
    function toggleContent(element) {
        var newsItem = element.closest('.news-item');
        var content = newsItem.querySelector('.news-content');

        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            element.textContent = 'Less';
            newsItem.classList.add('enlarge');

            document.addEventListener('click', closeEnlargedItem);
        } else {
            content.style.display = 'none';
            element.textContent = 'More';
            newsItem.classList.remove('enlarge');

            document.removeEventListener('click', closeEnlargedItem);
        }
    }
    
    function closeEnlargedItem(event) {
        var enlargedItem = document.querySelector('.enlarge');

        if (!enlargedItem.contains(event.target)) {
            var content = enlargedItem.querySelector('.news-content');
            var moreButton = enlargedItem.querySelector('.more');
            content.style.display = 'none';
            moreButton.textContent = 'More';
            enlargedItem.classList.remove('enlarge');
            document.removeEventListener('click', closeEnlargedItem);
        }
    }
</script>

