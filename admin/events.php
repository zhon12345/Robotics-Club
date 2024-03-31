<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'event Management';
$css = '../css/admin/event.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

if (!empty($_POST)) {
    $title = trim($_POST['title']);
    $type = trim($_POST['event_type']);
    $seats = trim($_POST['seats_available']);
    $content = trim($_POST['content']);

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = 'INSERT INTO event (title, type, seats, content) VALUES (?, ?, ?, ?)';

    $stm = $con->prepare($sql);

    $stm->bind_param('ssis', $title, $type, $seats, $content);

    $stm->execute();

    if ($stm->affected_rows > 0) {
        header("Location: events.php");
        exit();
    } else {
        $error_message = 'Error: Unable to insert event.';
    }

    $stm->close();
    $con->close();
}

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $delete_query = "DELETE FROM event WHERE id = ?";

    $stm_delete = $con->prepare($delete_query);

    $stm_delete->bind_param('s', $delete_id);

    $stm_delete->execute();

    $stm_delete->close();
    $con->close();
}
?>

<section class="main-section">
    <div class="main-container">
        <div class="events-list">
            <h1>EVENT LIST</h1>
            <div class="event-container">
                <table border="1">
                    <colgroup>
                        <col style="vertical-align: middle;">
                        <col>
                        <col>
                        <col style="width: 10%;">
                        <col style="width: 10%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Seats</th>
                            <th>Options</th>
                        </tr>
                    </thead>

                    <?php
                    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $result = $con->query("SELECT id, title, type, seats, content FROM event");

                    if ($result->num_rows > 0 && $result->num_rows <= 20) {
                        while ($row = $result->fetch_object()) {
                            printf(
                                '<tr>
                                    <td>%d</td>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%d</td>
                                    <td>
                                        <a href="edit-events.php?id=%s">Edit</a> | 
                                        <a href="events.php?delete=%s">Delete</a>
                                    </td>
                                </tr>',
                                $row->id,
                                $row->title,
                                $row->type,
                                $row->seats,
                                $row->id,
                                $row->id

                            );
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="5">No records found.</td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>

        <hr class="line">

        <div class="events-add">
            <h1>ADD EVENT</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="input-container title">
                    <label for="title">Event Name:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="input-container option-1">
                    <label for="event_type">Event Type:</label>
                    <select id="event_type" name="event_type" required>
                        <option value="Meetup">Meetup</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Competition">Competition</option>
                    </select>
                </div>

                <div class="input-container option-2">
                    <label for="seats_available">Seats Available:</label>
                    <input type="number" id="seats_available" name="seats_available" min="1" required>
                </div>

                <div class="input-container content">
                    <label for="content">Description:</label>
                    <textarea id="content" name="content" required></textarea>
                </div>

                <div class="input-container submit">
                    <input type="submit" value="SUBMIT" class="submit-button">
                </div>
            </form>
        </div>
    </div>
</section>
</body>

</html>