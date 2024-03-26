<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
</head>
<body>
    <h1>notification</h1>
    <h2>Add a New Note</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Title</TITLE>: <input type="text" name="subject"><br>
        Content: <textarea name="content"></textarea><br>
        <input type="submit" value="Submit">
    </form>

    <hr>

    <?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'notification');

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $subject = $_POST['subject'];
        $content = $_POST['content'];

        $sql = "INSERT INTO notification (subject, content) VALUES ('$subject', '$content')";
        if ($con->query($sql) === TRUE) {
            echo "Note added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    $sql = "SELECT * FROM notification ORDER BY time DESC";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>Title:</strong> " . $row["subject"] . "</p>";
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
