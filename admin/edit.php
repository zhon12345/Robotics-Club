<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Edit';
$css = '../css/admin/edit.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

$message = array();

if (empty($_GET) && empty($_POST)) {
    header('location: dashboard.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $table = trim($_GET['table']);
    $id = trim($_GET['id']);

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $id  = $con->real_escape_string($id);
    $result = $con->query("SELECT * FROM $table WHERE id = $id");
} else {
    $id = trim($_POST['id']);
    $table = trim($_POST['table']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($table == 'events') {
        $date = trim($_POST['date']);
        $type = trim($_POST['event_type']);
        $seats = trim($_POST['seats_available']);
    }

    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    if ($table == 'events') {
        $stm = $con->prepare("UPDATE events SET title = ?, date = ?, type = ?, seats = ?, content = ? WHERE id = ?");

        $stm->bind_param('sssisi', $title, $date, $type, $seats, $content, $id);
    } else {
        $stm = $con->prepare("UPDATE $table SET title = ?, content = ? WHERE id = ?");

        $stm->bind_param('ssi', $title, $content, $id);
    }

    if ($stm->execute()) {
        header("location: " . $table . ".php");
        exit();
    } else {
        $message['error'] = 'Something went wrong, please try again!';
    }

    $stm->close();
    $con->close();
}
?>

<section class="main-section">

    <?php
    if ($row = $result->fetch_object()) {
        $id = $row->id;
        $title = $row->title;
        $content = $row->content;

        if ($table == 'events') {
            $date = $row->date;
            $type = $row->type;
            $seats = $row->seats;
        }
    ?>
        <div class="form-container">
            <h1>Edit <?php echo ucfirst($table) ?></h1>

            <?php
            if (!empty($message['error'])) {
                echo '<div class="message error">' . $message['error'] . '</div>';
            }
            ?>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="number" name="id" id="id" value="<?php echo $id ?>" hidden>
                <input type="text" name="table" id="table" value="<?php echo $table ?>" hidden>

                <div class="input-container title">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo $title ?>" required>
                </div>

                <?php
                if ($table == 'events') {
                ?>
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
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" value="<?php echo $date ?>" required>
                        </div>

                        <div class="input-container option-3">
                            <label for="seats_available">Seats Available:</label>
                            <input type="number" id="seats_available" name="seats_available" min="1" value="<?php echo $seats ?>" required>
                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="input-container content">
                    <label for="content">Description:</label>
                    <textarea id="content" name="content" required><?php echo $content ?></textarea>
                </div>

                <div class="input-container submit">
                    <input type="submit" value="Submit">
                    <input type="button" value="Cancel" onclick="location='<?php echo $table ?>.php'">
                </div>
            </form>
        </div>
    <?php
        $result->free();
        $con->close();
    } else {
        echo
        '<div class="error-container" style="width: 20vw">
            <h1>Oops, Record not found.</h1>

            <input type="button" value="Back to list" onclick="location=\'' . $table . '.php\'">
        </div>';
    }
    ?>
</section>