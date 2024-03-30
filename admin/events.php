<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Events Management';
$css = '../css/admin/events.css';

include('../includes/header-admin.php');
