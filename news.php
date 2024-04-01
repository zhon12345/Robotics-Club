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
    <div class="news-container">
        <h1 class="section-title"><?php echo $title; ?></h1>

        <?php
        if ($result->num_rows > 0) {
        ?>
            <div class="news-items">
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='news-card' onclick='location=\"news.php?card=" . $row['id'] . "\"'>
                        <div class='row title'>
                            <h1>" . htmlspecialchars($row["title"])  . " </h1>
                        </div>
                        <div class='row content'>
                            <p>" . $row["content"] . "</p>
                        </div>
                        <div class='row date'>
                            <p>" . date("d-M-Y", strtotime($row["date"])) . "</p>
                        </div>
                    </div>";
                }
                ?>
            </div>
        <?php
        } else {
            echo "<div class='no-results'>No results found!</div>";
        }
        ?>
    </div>
</section>
</body>

<?php
if (isset($_GET['card'])) {
    $id = trim($_GET['card']);

    $id = $con->real_escape_string($id);
    $sql .= " WHERE id = $id";

    $result = $con->query($sql);

    if ($row = $result->fetch_object()) {
        printf(
            '<div class="popup active">
                <div class="big-card">
                    <a href="news.php">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </a>

                    <div class="big-content">
                        <h1>%s</h1>
                        <span>%s</span>
                        <p>%s</p>
                    </div>
                </div>
            </div>',
            $row->title,
            date("d-M-Y", strtotime($row->date)),
            $row->content
        );
    }
}

$result->free();
$con->close();
?>

</html>