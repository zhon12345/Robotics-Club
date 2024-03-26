<!DOCTYPE html>
<html>
<head>
    <title>notification</title>
    <link rel="stylesheet" type="text/css" href="css\notification.css">
</head>
<body>
    <h1>notification</h1>

    <hr>

    <section class="main-section">
        <div class="main-container">
            <?php
            include('includes/header-user.php');

            define('DB_HOST', 'localhost');
            define('DB_USER', 'root');
            define('DB_PASS', '');
            define('DB_NAME', 'notification');

            $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            $sql = "SELECT id, title, content, time FROM notification ORDER BY time DESC";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="notification">'; 
                    echo "<p><strong>DATE:</strong> " . $row["time"] . "</p>";
                    echo "<p><strong>Title:</strong> " . htmlspecialchars($row["title"]) . "</p>";
                    echo "<p><strong>Content:</strong> " . $row["content"] . "</p>";
                    echo '</div>'; 
                }
            } else {
                echo "<p>0 results</p>";
            }

            $con->close();
            ?>
        </div>
    </section>
</body>
</html>



