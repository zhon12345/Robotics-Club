<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Robotics Club</title>

		<!-- CSS Files -->
		<link rel="stylesheet" href="css/reset.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/login.css" />


		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>

	<body>

		<!-- Account Section -->
		<section class="account-section">
			<div class="container">
				<div class="forms-container">
					<!-- Login Form -->
					<div class="login-form">
						<header>Login</header>

						<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="login">
							<div class="form-input">
								<label for="username">Username</label>
								<span class="fa-solid fa-user"></span>
								<input type="text" id="username" name="username" placeholder="Enter username" />
								<i class="fa-solid fa-circle-check"></i>
								<i class="fa-solid fa-circle-exclamation"></i>
								<small>Error Message</small>
							</div>

							<div class="form-input">
								<label for="password">Password</label>
								<span class="fa-solid fa-key"></span>
								<input type="password" id="password" placeholder="Enter password" />
								<i class="fa-solid fa-circle-check"></i>
								<i class="fa-solid fa-circle-exclamation"></i>
								<small>Error Message</small>
							</div>

							<div class="form-link">
								<a href="#" class="forgot-link">Forgot password?</a>
							</div>

							<div class="form-button">
								<input type="submit" name="submit" value="Login">
							</div>
						</form>

						<div class="form-link">
							<span>Don't have an account? <a href="#" onclick="switchForm()">Signup</a></span>
						</div>
					</div>

					<!-- Signup Form -->
					<div class="signup-form not-active">
						<header>Signup</header>

						<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="signup">
							<div class="form-input">
								<label for="username">Username</label>
								<span class="fa-solid fa-user"></span>
								<input type="text" id="username" name="username" placeholder="Enter username" />
								<i class="fa-solid fa-circle-check"></i>
								<i class="fa-solid fa-circle-exclamation"></i>
								<small>Error Message</small>
							</div>

							<div class="form-input">
								<label for="email">Email</label>
								<span class="fa-solid fa-at"></span>
								<input type="email" id="email" placeholder="Enter e-mail" />
								<i class="fa-solid fa-circle-check"></i>
								<i class="fa-solid fa-circle-exclamation"></i>
								<small>Error Message</small>
							</div>

							<div class="form-input">
								<label for="password">Password</label>
								<span class="fa-solid fa-key"></span>
								<input type="password" id="password" placeholder="Create password" />
								<i class="fa-solid fa-circle-check"></i>
								<i class="fa-solid fa-circle-exclamation"></i>
								<small>Error Message</small>
							</div>

							<div class="form-input">
								<label for="password2">Confirm Password</label>
								<span class="fa-solid fa-key"></span>
								<input type="password" id="password2" placeholder="Confirm password" />
								<i class="fa-solid fa-circle-check"></i>
								<i class="fa-solid fa-circle-exclamation"></i>
								<small>Error Message</small>
							</div>

							<div class="form-button">
                                <input type="submit" class="button" value="Signup">
							</div>
						</form>

						<div class="form-link">
							<span>Already have an account? <a href="#" onclick="switchForm()">Login</a></span>
						</div>
					</div>

					<div class="line"></div>

					<div class="media-options">
						<a href="#" class="facebook">
							<svg viewBox="0 0 36 36" height="40" width="40">
								<path fill="#0866FF" d="M20.181 35.87C29.094 34.791 36 27.202 36 18c0-9.941-8.059-18-18-18S0 8.059 0 18c0 8.442 5.811 15.526 13.652 17.471L14 34h5.5l.681 1.87Z"></path>
								<path fill="#fff" class="xe3v8dz" d="M13.651 35.471v-11.97H9.936V18h3.715v-2.37c0-6.127 2.772-8.964 8.784-8.964 1.138 0 3.103.223 3.91.446v4.983c-.425-.043-1.167-.065-2.081-.065-2.952 0-4.09 1.116-4.09 4.025V18h5.883l-1.008 5.5h-4.867v12.37a18.183 18.183 0 0 1-6.53-.399Z"></path>
							</svg>
							<span>Facebook</span>
						</a>

						<a href="#" class="google">
							<svg viewBox="0 0 24 24" height="40" width="40">
								<path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
								<path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
								<path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
								<path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
								<path d="M1 1h22v22H1z" fill="none" />
							</svg>
							<span>Google</span>
						</a>
					</div>
				</div>
			</div>
		</section>
        
		<script src="./js/login.js"></script>
	</body>
</html>
