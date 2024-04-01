<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Notification Management';
$css = '../css/admin/event.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

if (!empty($_POST)) {
    if (!isset($_POST['id'])) {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql = 'INSERT INTO notification (title, content) VALUES (?, ?)';

        $stm = $con->prepare($sql);

        $stm->bind_param('ss', $title, $content);

        $stm->execute();

        if ($stm->affected_rows > 0) {
            header("Location: notification.php");
            exit();
        } else {
            $error_message = 'Error: Unable to insert notification.';
        }

        $stm->close();
        $con->close();
    } else {
        $id = trim($_POST['id']);

        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $id  = $con->real_escape_string($id);
        $stm = $con->prepare("DELETE FROM notification WHERE id = ?");

        $stm->bind_param('i', $id);

        $stm->execute();

        if ($stm->affected_rows > 0) {
            header("location: notification.php");
            exit();
        }

        $stm->close();
        $con->close();
    }
}

if (!empty($_GET)) {
    $id = isset($_GET['delete']) ? trim(($_GET['delete'])) : null;

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $id  = $con->real_escape_string($id);
    $sql = "SELECT * FROM notification WHERE id = $id";

    $result = $con->query($sql);

    if ($row = $result->fetch_object()) {
        printf(
            '<div class="popup active">
                <div class="card">
                    <h3>Confirmation</h3>
                    <p>Are you sure you want to delete the following?</p>
                    
                    <table border="1">
                    <tr>
                        <td>ID: </td>
                        <td>%d</td>
                    </tr>
                    <tr>
                        <td>Title: </td>
                        <td>%s</td>
                    </tr>
                    <tr>
                        <td>Content: </td>
                        <td>%s</td>
                    </tr>
                    </table>

                    <form action="" method="post">
                        <input type="hidden" name="id" value="%s" />
                        <input type="submit" name="yes" value="Yes" class="button"/>
                        <input type="button" value="Cancel" onclick="location=\'notification.php\'" class="button"/>
                    </form>
                </div>
            </div>',
            $row->id,
            $row->title,
            $row->content,
            $row->id
        );
    }

    $result->free();
    $con->close();
}

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con->query("SELECT id, title, content FROM notification");
?>

<section class="main-section">
    <div class="main-container">
        <h1>NOTIFICATION LIST</h1>
        <div class="notification-container">
            <table border="1">
                <colgroup>
                    <col style="width: 3%;">
                    <col>
                    <col style="width: 10%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <?php
                if ($result->num_rows > 0 && $result->num_rows <= 20) {
                    while ($row = $result->fetch_object()) {
                        printf(
                            '<tr>
                            <td>%d</td>
                            <td>%s</td>
                            <td>
                                <a href="edit.php?table=notification&id=%d">Edit</a> | 
                                <a href="notification.php?delete=%d">Delete</a>
                            </td>
                        </tr>',
                            $row->id,
                            $row->title,
                            $row->id,
                            $row->id
                        );
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="3">No records found.</td>
                    </tr>
                <?php
                }

                $result->free();
                $con->close();
                ?>
            </table>
        </div>

        <hr class="line">

        <div class="notification-add">
            <h1>ADD NOTIFICATION</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="input-container title">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="input-container content">
                    <label for="content">Description:</label>
                    <textarea id="content" name="content" required></textarea>
                </div>

                <div class="input-container submit">
                    <input type="submit" value="Submit" class="submit-button">
                </div>
            </form>
        </div>
    </div>
</section>

</body>

</html>