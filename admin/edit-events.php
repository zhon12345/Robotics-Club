<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Edit Event';
$css = '../css/admin/edit-display.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

$message = array();


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = isset($_GET['id']) ? trim($_GET['id']) : null;

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $id  = $con->real_escape_string($id);
    $result = $con->query("SELECT * FROM event WHERE id = $id");

    if ($row = $result->fetch_object()) {
        $hideForm = false;

        $id = $row->id;
        $title = $row->title;
        $type = $row->type;
        $seats = $row->seats;
        $content = $row->content;
    } else {
        echo
        '<div class="error">
            Oops, Record not found.
            [ <a href="events.php">Back to list</a> ]
        </div>';

        $hideForm = true;
    }

    $result->free();
    $con->close();
} else {
    $hideForm = false;

    $id = trim($_POST['id']);
    $title = trim($_POST['title']);
    $type = trim($_POST['event_type']);
    $seats = trim($_POST['seats_available']);
    $content = trim($_POST['content']);

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $stm = $con->prepare("UPDATE event SET title = ?, type = ?, seats = ?, content = ? WHERE id =?");

    $stm->bind_param('ssisi', $title, $type, $seats, $content, $id);

    if ($stm->execute()) {
        $message['success'] = 'Event successfully updated! <a href="events.php">Go Back</a>';
    } else {
        $message['error'] = 'Something went wrong, please try again!';
    }

    $stm->close();
    $con->close();
}
?>

<section class="main-section">
    <div class="form-container">
        <h1>Edit Notification</h1>

        <?php
        if (!empty($message['error'])) {
            echo '<div class="message error">' . $message['error'] . '</div>';
        }
        if (!empty($message['success'])) {
            echo '<div class="message success">' . $message['success'] . '</div>';
        }
        ?>

        <form action="" method="post">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input type="number" name="id" id="id" value="<?php echo $id ?>" hidden>

                <div class="input-container title">
                    <label for="title">Event Name:</label>
                    <input type="text" id="title" name="title" value="<?php echo $title ?>" required>
                </div>

                <div class="options">
                    <div class="input-container option-1">
                        <label for="event_type">Event Type:</label>
                        <select id="event_type" name="event_type" required>
                            <option value="Meetup" <?php echo $type === 'Meetup' ? 'selected' : '' ?>>Meetup</option>
                            <option value="Workshop" <?php echo $type === 'Workshop' ? 'selected' : '' ?>>Workshop</option>
                            <option value="Competition" <?php echo $type === 'Competition' ? 'selected' : '' ?>>Competition</option>
                        </select>
                    </div>

                    <div class="input-container option-2">
                        <label for="seats_available">Seats Available:</label>
                        <input type="number" id="seats_available" name="seats_available" min="1" value="<?php echo $seats ?>" required>
                    </div>
                </div>

                <div class="input-container content">
                    <label for="content">Description:</label>
                    <textarea id="content" name="content" required><?php echo $content ?></textarea>
                </div>

                <div class="input-container submit">
                    <input type="submit" value="submit" class="submit-button">
                </div>
            </form>
        </form>
    </div>
</section>
</body>

</html>