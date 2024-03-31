<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'User Dashboard';
include('../includes/header-user.php');
?>
<section class="main-section">
    <div class="main-container">
        <h2>Welcome <b></b>, what would you like to do?</h2>

        <!-- content -->
        <section class="main-section">
            <div class="main-container">
                <h2>Welcome <b>User</b>, what would you like to do?</h2>
                <div>
                
                </div>

                <div class="grid">
                    <a href="notification-display.php"><i class="fa-regular fa-envelope"></i>Notification</a>
                    <a href="user-information.php"><i class="fa-solid fa-user"></i>User Information</a>
                    <a href="ticket.php"><i class="fa-solid fa-ticket"></i>Ticket</a>
                </div>
            </div>
        </section>

        </body>

        </html>