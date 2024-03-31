<?php
session_start();

// 检查用户是否已登录，如果没有则重定向到登录页面
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    exit();
}

// 设置页面标题和样式表
$title = 'Edit User Information';
$css = '../css/admin/edit.css';

// 初始化错误和成功消息变量
$error_message = '';
$success_message = '';

// 包含页眉文件和帮助程序文件
include('../includes/header-user.php');
require_once('../includes/helper.php');

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 连接数据库
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // 获取当前用户
    $current_user = $_SESSION['user'];
    
    // 获取新的用户名、电子邮件和密码
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];

    // 验证输入
    if (empty($new_email) || empty($new_password)) {
        $error_message = "Email and password are required fields.";
    } else {
        // 更新用户信息
        $update_query = "UPDATE user SET email = '$new_email', password = '$new_password' WHERE username = '$current_user'";
        if ($con->query($update_query) === TRUE) {
            // 更新成功，设置成功消息并重定向回用户面板页面
            $success_message = 'User information updated successfully.';
            header("location: user-information.php");
            exit();
        } else {
            // 更新失败，设置错误消息
            $error_message = "Error updating record: " . $con->error;
        }
    }

    // 关闭数据库连接
    $con->close();
}
?>

<section class="main-section">
    <div class="edit-container">
        <h2>Edit User Information</h2>
        <?php
        // 显示错误消息和成功消息
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
