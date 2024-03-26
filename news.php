<?php
$title = 'News';
$css = 'css/news.css';

include('includes/header-user.php');
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
        <table>
            <tr>
                <th>DATE</th>
                <th>Title</th>
                <th>Content</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                    echo "<td>" . $row["content"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }
            ?>
        </table>
    </div>
</section>
</body>

</html>

<?php
$con->close();
?>