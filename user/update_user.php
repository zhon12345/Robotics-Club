<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Edit User Information';
$css = '../css/admin/edit.css';
$user = $_SESSION['user'];

$error_message = '';
$success_message = '';

include('../includes/header-user.php');
require_once('../includes/helper.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $current_user = $_SESSION['user'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    if (empty($new_email) || empty($new_password)) {
        $error_message = "Email and password are required fields.";
    } else {
        $update_query = "UPDATE user SET email = '$new_email', password = '$new_password' WHERE username = '$current_user'";
        if ($con->query($update_query) === TRUE) {
            $success_message = 'User information updated successfully.';
            header("location: user-information.php");
            exit();
        } else {
            $error_message = "Error updating record: " . $con->error;
        }
    }

    $con->close();
}
?>

<section class="main-section">
    <div class="edit-container">
        <h2>Edit User Information</h2>
        <?php
        if ($error_message !== '') {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        if ($success_message !== '') {
            echo '<div class="success-message">' . $success_message . '</div>';
        }
        ?>
        <form method="post" action="">
            <div class="input-container">
                <label for="new_email">New Email:</label><br>
                <input type="email" id="new_email" name="new_email">
            </div>
            <div class="input-container">
                <label for="new_password">New Password:</label><br>
                <input type="password" id="new_password" name="new_password">
            </div>
            <div>
                <input type="submit" value="Submit" class="submit-button">
            </div>
        </form>
    </div>
</section>