<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

$title = 'Edit User Information';
$css = '../css/admin/edit.css';

include('../includes/header-user.php');
require_once('../includes/helper.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 连接数据库
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // 获取当前用户
    $current_user = $_SESSION['user'];
    
    // 获取新的用户名、电子邮件和密码
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    // 更新用户信息
    $update_query = "UPDATE user SET username = '$new_username', email = '$new_email', password = '$new_password' WHERE username = '$current_user'";
    if ($con->query($update_query) === TRUE) {
        // 更新成功，重定向回用户面板页面
        header("location: user_panel.php");
        exit();
    } else {
        // 处理更新失败的情况
        echo "Error updating record: " . $con->error;
    }

    // 关闭数据库连接
    $con->close();
}
?>
