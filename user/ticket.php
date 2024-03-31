<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'My Tickets';
$user = $_SESSION['user'];

include('../includes/header-user.php');
