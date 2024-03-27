<?php
include('includes/header-admin.php');
require_once('includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $time = $_POST['time'];

    $sql = "INSERT INTO notification (id, title, content, time) VALUES ('$id', '$title', '$content', '$time')";
    if ($con->query($sql) === TRUE) {
        echo "notification added successfully. ID: $id";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
</head>
<body>
    <h1>Notification</h1>

    <h2>Add a New notification</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        ID: <input type="text" name="id"><br>
        Title: <input type="text" name="title"><br>
        Content: <textarea name="content"></textarea><br>
        Time: <input type="text" name="time"><br>
        <input type="submit" value="Submit">
    </form>

    <hr>

<?php
$sql = "SELECT * FROM notification ORDER BY time DESC";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>ID:</strong> " . $row["id"] . "</p>";
        echo "<p><strong>Title:</strong> " . $row["title"] . "</p>";
        echo "<p><strong>Time:</strong> " . $row["time"] . "</p>";
        echo "<p><strong>Content:</strong><br>" . $row["content"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "0 results";
}

$con->close();
?>
</body>
</html>
