<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username === 'xuan' && $password === '1234567') {
        $_SESSION['username'] = $username;
        header("location: welcome.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    
        <h2>Login</h2>
        <input type="text" name="phone" id="phone" placeholder="phone nomber" maxlength="11" required>
        <input type="date" id="birthdate" name="birthdate">
        <input type="text" name="username" placeholder="Username" required>
        
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="submit">
        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </form>
</body>
</html>
