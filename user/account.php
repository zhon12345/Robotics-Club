<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'User Management';
$css = '../css/user/user_panel.css';
$user = $_SESSION['user'];

include('../includes/header-user.php');
require_once('../includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$query = "SELECT * FROM user WHERE username = '$user'";
$result = $con->query($query);

?>

<section class="main-section">
    <div class="main-container">
        <div class="user-info-table-container">
            <header>User Information</header>
            <table class="user-info-table">
                <tr>
                    <th>Attribute</th>
                    <th>Details</th>
                </tr>
                <?php
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<tr>";
                    echo "<td class='attribute'>Username</td>";
                    echo "<td class='details'>" . $row['username'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td class='attribute'>Email</td>";
                    echo "<td class='details'>" . $row['email'] . "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='2'>No user information available.</td></tr>";
                }
                ?>
            </table>
        </div>

        <div class="edit-button">
            <a href="edit.php"><button class="edit-btn">Edit</button></a>
        </div>
    </div>
</section>