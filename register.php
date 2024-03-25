<?php
function detectError()
{
    global $username, $email, $password, $confirm;

    $error = array();

    if ($username == null) {
        $error["username"] = 'Username cannot be blank';
    } else if (strlen($username) < 3 || strlen($username) > 30) {
        $error["username"] = 'Username must be between 3 to 30 characters long.';
    } else if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
        $error["username"] = 'Username must contain only letters, numbers, dashes and underscore.';
    }

    if ($email == null) {
        $error["email"] = 'E-mail cannot be blank.';
    } else if (strlen($email) > 30) {
        $error["email"] = 'E-mail must be less than 30 characters long.';
    } else if (!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $email)) {
        $error["email"] = 'Invalid e-mail address';
    }

    if ($password == null) {
        $error["password"] = 'Password cannot be blank.';
    } else if (strlen($password) < 8 || strlen($password) > 16) {
        $error["password"] = 'Password must be between 8 to 15 characters long.';
    } else if (!preg_match('/^[a-zA-Z0-9!@#$%^&*]$/', $password)) {
        $error["password"] = 'Password must contain only letters, numbers and symbols.';
    }


    if ($confirm == null || $confirm != $password) {
        $error["confirm"] = 'Passwords does not match';
    }

    return $error;
}
?>

<?php
$title = 'Register';
$css = 'css/login.css';

include('includes/header-user.php');
require_once('includes/helper.php');
?>

<!-- Account Section -->
<section class="account-section">
    <div class="forms-container">
        <!-- Signup Form -->
        <div class="signup-form">
            <header>Signup</header>

            <?php
            if (!empty($_POST)) {
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $confirm = trim($_POST['confirm']);

                $error = detectError();
            } else {
                $username = '';
                $email = '';
                $password = '';
                $confirm = '';
            }
            ?>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="signup">
                <?php
                if (isset($error) && isset($error['username'])) {
                    echo '<div class="form-input error">';
                } else {
                    echo '<div class="form-input">';
                }
                ?>
                <label for="username">Username</label>
                <span class="fa-solid fa-user"></span>
                <input type="text" name="username" id="username" value="<?php echo $username ?>" placeholder="Enter username" />

                <i class="fa-solid fa-circle-exclamation"></i>
                <?php if (isset($error) && isset($error['username'])) printf('<small>%s</small>', $error['username']); ?>
        </div>

        <?php
        if (isset($error) && isset($error['email'])) {
            echo '<div class="form-input error">';
        } else {
            echo '<div class="form-input">';
        }
        ?>
        <label for="email">Email</label>
        <span class="fa-solid fa-at"></span>
        <input type="text" name="email" id="email" value="<?php echo $email ?>" placeholder="Enter e-mail" />

        <i class="fa-solid fa-circle-exclamation"></i>
        <?php if (isset($error) && isset($error['email'])) printf('<small>%s</small>', $error['email']); ?>
    </div>

    <?php
    if (isset($error) && isset($error['password'])) {
        echo '<div class="form-input error">';
    } else {
        echo '<div class="form-input">';
    }
    ?>
    <label for="password">Password</label>
    <span class="fa-solid fa-key"></span>
    <input type="password" name="password" id="password" value="<?php echo $password ?>" placeholder="Create password" />

    <i class="fa-solid fa-circle-exclamation"></i>
    <?php if (isset($error) && isset($error['password'])) printf('<small>%s</small>', $error['password']); ?>
    </div>

    <?php
    if (isset($error) && isset($error['confirm'])) {
        echo '<div class="form-input error">';
    } else {
        echo '<div class="form-input">';
    }
    ?>
    <label for="confirm">Confirm Password</label>
    <span class="fa-solid fa-key"></span>
    <input type="password" name="confirm" id="confirm" value="<?php echo $confirm ?>" placeholder="Confirm password" />

    <i class="fa-solid fa-circle-exclamation"></i>
    <?php if (isset($error) && isset($error['confirm'])) printf('<small>%s</small>', $error['confirm']); ?>
    </div>

    <div class="form-button">
        <input type="submit" class="button" value="Signup" />
        <input type="button" class="button" value="Reset" onclick="location='<?php echo $_SERVER["PHP_SELF"] ?>'">
    </div>
    </form>

    <div class="form-link">
        <span>Already have an account? <a href="login.php">Login</a></span>
    </div>

    <?php
    include('includes/media-options.php');
    ?>
    </div>
    </div>
</section>
</body>

</html>