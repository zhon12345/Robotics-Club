<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Notification Management';
$css = '../css/admin/notification.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];

    $sql = "INSERT INTO notification (title, content, date) VALUES ('$title', '$content', '$date')";
    if ($con->query($sql) === TRUE) {
        echo "notification added successfully. ID: $id";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<section class="main-section">
    <div class="main-container">
        <h2>Add a New notification</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Title: <input type="text" name="title"><br>
            Content: <textarea name="content"></textarea><br>
            <input type="submit" value="Submit">
        </form>

        <hr>

        <?php
        $sql = "SELECT * FROM notification ORDER BY date DESC";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p><strong>ID:</strong> " . $row["id"] . "</p>";
                echo "<p><strong>Date:</strong> " . $row["date"] . "</p>";
                echo "<p><strong>Title:</strong> " . $row["title"] . "</p>";
                echo "<p><strong>Content:</strong><br>" . $row["content"] . "</p>";
                echo "<hr>";
            }
        } else {
            echo "0 results";
        }

        $con->close();
        ?>
    </div>
</section>
</body>

</html>