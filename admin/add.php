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
} else {
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
        $stm = $con->prepare("INSERT INTO events (title, date, type, seats, content) VALUES (?, ?, ?, ?, ?)");

        $stm->bind_param('sssis', $title, $date, $type, $seats, $content);
    } else {
        $stm = $con->prepare("INSERT INTO $table (title, content) VALUES (?, ?)");

        $stm->bind_param('ss', $title, $content);
    }

    $stm->execute();

    if ($stm->affected_rows > 0) {
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
    <div class="form-container" <?php if ($table == 'events') echo 'style="width: 30vw;"' ?>>
        <h1>Add <?php echo ucfirst($table) ?></h1>

        <?php
        if (!empty($message['error'])) {
            echo '<div class="message error">' . $message['error'] . '</div>';
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="table" id="table" value="<?php echo $table ?>" hidden>

            <div class="input-container title">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <?php
            if ($table == 'events') {
            ?>
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
            <?php
            }
            ?>

            <div class="input-container content">
                <label for="content">Description:</label>
                <textarea id="content" name="content" required></textarea>
            </div>

            <div class="input-container submit">
                <input type="submit" value="Submit">
                <input type="button" value="Cancel" onclick="location='<?php echo $table ?>.php'">
            </div>
        </form>
    </div>
</section>