<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'User Management';
$css = '../css/user/user_panel.css';

include('../includes/header-user.php');
require_once('../includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$current_user = $_SESSION['user'];

$query = "SELECT * FROM user WHERE username = '$current_user'";
$result = $con->query($query);

?>

<section class="main-section">
    <div class="main-container">
        <div class="user-info-table">
            <header>User Information</header>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
                <?php
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='3'>No user information available.</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="edit-button">
            <button onclick="openEditForm()">Edit</button>
        </div>

        <div class="edit-form" style="display: none;">
            <form action="user\update_user.php" method="post">

            </form>
        </div>
    </div>
</section>
