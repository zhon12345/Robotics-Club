<?php
function detectError()
{
	global $username, $password;

	$error = array();

	if ($username == null) {
		$error["username"] = 'Username cannot be blank';
	} else if (strlen($username) < 3 || strlen($username) > 30) {
		$error["username"] = 'Username must be between 3 to 30 characters long.';
	} else if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
		$error["username"] = 'Username must contain only letters, numbers, dashes and underscore.';
	}

	if ($password == null) {
		$error["password"] = 'Password cannot be blank.';
	} else if (strlen($password) < 8 || strlen($password) > 16) {
		$error["password"] = 'Password must be between 8 to 15 characters long.';
	} else if (!preg_match('/^[a-zA-Z0-9!@#$%^&*]+$/', $password)) {
		$error["password"] = 'Password must contain only letters, numbers and symbols.';
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
			<!-- Login Form -->
			<div class="login-form">
				<header>Login</header>

				<?php
				if (!empty($_POST)) {
					$username = trim($_POST['username']);
					$password = trim($_POST['password']);

					$error = detectError();

					if (empty($error) && $username == 'admin' && $password == 'admin1234') {
						header("location: index.php");

						$username = $password = null;
					}
				} else {
					$username = '';
					$password = '';
				}
				?>

				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="login">
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
			if (isset($error) && isset($error['password'])) {
				echo '<div class="form-input error">';
			} else {
				echo '<div class="form-input">';
			}
			?>
			<label for="password">Password</label>
			<span class="fa-solid fa-key"></span>
			<input type="password" name="password" id="password" value="<?php echo $password ?>" placeholder="Enter password" />

			<i class="fa-solid fa-circle-exclamation"></i>
			<?php if (isset($error) && isset($error['password'])) printf('<small>%s</small>', $error['password']); ?>
		</div>

		<div class="form-link">
			<a href="#" class="forgot-link">Forgot password?</a>
		</div>

		<div class="form-button">
			<input type="submit" name="submit" value="Login" />
			<input type="button" class="button" value="Reset" onclick="location='<?php echo $_SERVER["PHP_SELF"] ?>'">
		</div>
		</form>

		<div class="form-link">
			<span>Don't have an account? <a href="register.php">Signup</a></span>
		</div>
		</div>

		<?php
		require_once('includes/media-options.php');
		?>
		</div>
	</section>
</body>

</html>