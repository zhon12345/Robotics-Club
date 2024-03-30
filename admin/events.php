<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Admin Panel';
$css = '../css/admin/events.css';

include('../includes/header-admin.php');
