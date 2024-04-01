<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Event Management';
$css = '../css/admin/event.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

if (!empty($_POST)) {
    if (!isset($_POST['id'])) {
        $title = trim($_POST['title']);
        $type = trim($_POST['event_type']);
        $seats = trim($_POST['seats_available']);
        $content = trim($_POST['content']);

        $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $sql = 'INSERT INTO events (title, date, type, seats, content) VALUES (?, ?, ?, ?)';

        $stm = $con->prepare($sql);

        $stm->bind_param('sssis', $title, $date, $type, $seats, $content);

        $stm->execute();

        if ($stm->affected_rows > 0) {
            header("Location: events.php");
            exit();
        } else {
            $error_message = 'Error: Unable to insert event.';
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
        $stm = $con->prepare("DELETE FROM events WHERE id = ?");

        $stm->bind_param('i', $id);

        $stm->execute();

        if ($stm->affected_rows > 0) {
            header("location: events.php");
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
    $sql = "SELECT * FROM events WHERE id = $id";

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
                        <td>Date: </td>
                        <td>%s</td>
                    </tr>
                    <tr>
                        <td>Type: </td>
                        <td>%s</td>
                    </tr>
                    <tr>
                        <td>Seats: </td>
                        <td>%d</td>
                    </tr>
                    <tr>
                        <td>Content: </td>
                        <td>%s</td>
                    </tr>
                    </table>

                    <form action="" method="post">
                        <input type="hidden" name="id" value="%s" />
                        <input type="submit" name="yes" value="Yes" class="button"/>
                        <input type="button" value="Cancel" onclick="location=\'events.php\'" class="button"/>
                    </form>
                </div>
            </div>',
            $row->id,
            $row->title,
            date("d-M-Y", strtotime($row->date)),
            $row->type,
            $row->seats,
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

$result = $con->query("SELECT id, title, date, type, seats, content FROM events");
?>

<section class="main-section">
    <div class="main-container">
        <div class="events-list">
            <h1>EVENT LIST</h1>
            <div class="event-container">
                <table border="1">
                    <colgroup>
                        <col style="width: 3%;">
                        <col>
                        <col>
                        <col>
                        <col style="width: 10%;">
                        <col style="width: 10%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Seats</th>
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
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%d</td>
                                    <td>
                                        <a href="edit.php?table=events&id=%d">Edit</a> | 
                                        <a href="events.php?delete=%d;">Delete</a>
                                    </td>
                                </tr>',
                                $row->id,
                                $row->title,
                                date("d-M-Y", strtotime($row->date)),
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

                    $result->free();
                    $con->close();
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

                <div class="options">
                    <div class="input-container option-1">
                        <label for="event_type">Event Type:</label>
                        <select id="event_type" name="event_type" required>
                            <option value="Meetup">Meetup</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Competition">Competition</option>
                        </select>
                    </div>

                    <div class="input-container option-2">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                    <div class="input-container option-3">
                        <label for="seats_available">Seats Available:</label>
                        <input type="number" id="seats_available" name="seats_available" min="1" required>
                    </div>
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