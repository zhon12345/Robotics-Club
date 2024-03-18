<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" href="https://www.tarc.edu.my/images/tarIco.ico" />
		<title>About Us</title>

		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/navbar.css" />
		<link rel="stylesheet" href="css/about.css" />

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<body>
		<?php
            require_once('includes/navbar.php');
        ?>

		<section class="about-section">
			<div class="grid-container">
				<?php
            $photos = array(
                array("path" =>
				"assets/about us/images (1).png", "text" => "NAME 1"), array("path" => "assets/about us/images (1).png", "text" => "NAME 2"), array("path" => "assets/about us/images (1).png", "text" => "NAME 3"), array("path" => "assets/about us/images (1).png", "text" => "NAME 4"), array("path" => "assets/about us/images (1).png", "text" => "NAME 5"), ); foreach ($photos as $photo) { ?>
				<div class="grid-item">
					<img src="<?php echo $photo['path']; ?>" alt="Photo" />
					<div class="text-container">
						<p><?php echo $photo['text']; ?></p>
					</div>
				</div>
				<?php
            }
            ?>
			</div>
		</section>
	</body>
</html>
