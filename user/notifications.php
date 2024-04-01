<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Notifications';
$css = '..\css\user\notification.css';
$user = $_SESSION['user'];

include('..\includes\header-user.php');
require_once('..\includes\helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con->query("SELECT * FROM notification");
?>

<section class="main-section">
    <div class="main-container">
        <h1 class="section-title"><?php echo $title ?></h1>

        <?php
        if ($result->num_rows > 0) {
        ?>
            <div class="notification-items">
                <?php
                while ($row = $result->fetch_object()) {
                    printf(
                        '<div class="notification-card">
                            <div class="row details">
                                <h1>%s</h1>
                                <p>%s</p>
                            </div>

                            <div class="row content">
                                <p>%s</p>
                            </div>
                        </div>',
                        htmlspecialchars($row->title),
                        date("d-M-Y", strtotime($row->date)),
                        $row->content
                    );
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

</html>

<?php
$result->free();
$con->close();
?>