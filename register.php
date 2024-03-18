<?php 
    function detectError() {
        global $username, $email, $password, $confirm;

        $error = array();

        if ($username == null) {
            $error["username"] = 'Username cannot be blank';
        }
        else if(strlen($username) < 3 || strlen($username) > 30) {
            $error["username"] = 'Username must be between 3 to 30 characters long.';
        }
        else if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
            $error["username"] = 'Username must contain only letters, numbers, dashes and underscore.';
        }

        if ($email == null) {
            $error["email"] = 'E-mail cannot be blank.';
        }
        else if (strlen($email) > 30) {
            $error["email"] = 'E-mail must be less than 30 characters long.';
        }
        else if (!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $email)) {
            $error["email"] = 'Invalid e-mail address';
        }

        if ($password == null) {
            $error["password"] = 'Password cannot be blank.';
        }
        else if (strlen($password) < 8 || strlen($password) > 16) {
            $error["password"] = 'Password must be between 8 to 15 characters long.';
        }
        else if (!preg_match('/^[a-zA-Z0-9!@#$%^&*]$/', $password)) {
            $error["password"] = 'Password must contain only letters, numbers and symbols.';
        }


        if ($confirm == null || $confirm != $password) {
            $error["confirm"] = 'Passwords does not match';
        }

        return $error;
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" href="https://www.tarc.edu.my/images/tarIco.ico" />
		<title>Login</title>

		<!-- CSS Files -->
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/navbar.css" />
		<link rel="stylesheet" href="css/login.css" />

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>

	<body>
		<?php
            require_once('includes/navbar.php');
        ?>

		<!-- Account Section -->
		<section class="account-section">
			<div class="forms-container">
				<!-- Signup Form -->
				<div class="signup-form">
					<header>Signup</header>

                    <?php 
                        if(!empty($_POST)) {
                            $username = trim($_POST['username']);
                            $email = trim($_POST['email']);
                            $password = trim($_POST['password']);
                            $confirm = trim($_POST['confirm']);

                            $error = detectError();
                        }
                        else {
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
                            }
                            else {
                                echo '<div class="form-input">';
                            }
                        ?>
							<label for="username">Username</label>
							<span class="fa-solid fa-user"></span>
							<input type="text" name="username" id="username" value="<?php echo $username ?>" placeholder="Enter username" />

							<i class="fa-solid fa-circle-exclamation"></i>
                            <?php if(isset($error) && isset($error['username'])) printf('<small>%s</small>', $error['username']); ?>
						</div>

						<?php 
                            if (isset($error) && isset($error['email'])) {
                                echo '<div class="form-input error">';
                            }
                            else {
                                echo '<div class="form-input">';
                            }
                        ?>
							<label for="email">Email</label>
							<span class="fa-solid fa-at"></span>
							<input type="text" name="email" id="email" value="<?php echo $email ?>" placeholder="Enter e-mail" />

							<i class="fa-solid fa-circle-exclamation"></i>
							<?php if(isset($error) && isset($error['email'])) printf('<small>%s</small>', $error['email']); ?>
						</div>

						<?php 
                            if (isset($error) && isset($error['password'])) {
                                echo '<div class="form-input error">';
                            }
                            else {
                                echo '<div class="form-input">';
                            }
                        ?>
							<label for="password">Password</label>
							<span class="fa-solid fa-key"></span>
							<input type="password" name="password" id="password" value="<?php echo $password ?>" placeholder="Create password" />

							<i class="fa-solid fa-circle-exclamation"></i>
							<?php if(isset($error) && isset($error['password'])) printf('<small>%s</small>', $error['password']); ?>
						</div>

						<?php 
                            if (isset($error) && isset($error['confirm'])) {
                                echo '<div class="form-input error">';
                            }
                            else {
                                echo '<div class="form-input">';
                            }
                        ?>
							<label for="confirm">Confirm Password</label>
							<span class="fa-solid fa-key"></span>
							<input type="password" name="confirm" id="confirm" value="<?php echo $confirm ?>" placeholder="Confirm password" />

							<i class="fa-solid fa-circle-exclamation"></i>
							<?php if(isset($error) && isset($error['confirm'])) printf('<small>%s</small>', $error['confirm']); ?>
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
                        require_once('includes/media-options.php');
                    ?>
				</div>
			</div>
		</section>
	</body>
</html>
