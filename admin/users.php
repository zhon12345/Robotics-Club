<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'User Management';
$css = '../css/admin/users.css';

include('../includes/header-admin.php');
require_once('../includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];

    $delete_query = "DELETE FROM user WHERE username = '$username'";
    if ($con->query($delete_query) === TRUE) {
        echo "<script>alert('User deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting user.');</script>";
    }
}

$result = $con->query("SELECT * FROM user");
?>

<section class="main-section">
    <div class="main-container">
        <h2>Registered Users</h2>

        <?php
        $totalUsersResult = $con->query("SELECT COUNT(*) AS total_users FROM user");
        $totalUsers = 0;

        if ($totalUsersResult && $totalUsersResult->num_rows > 0) {
            $totalUsersData = $totalUsersResult->fetch_assoc();
            $totalUsers = $totalUsersData['total_users'];
        }

        echo "<div style='color: white;'>Total Users: $totalUsers</div>";
        ?>

        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>
                                <form action='' method='post'>
                                    <input type='hidden' name='username' value='" . $row['username'] . "'>
                                    <button type='submit'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>