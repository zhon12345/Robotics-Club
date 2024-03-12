<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Photo Grid</title>

        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/about.css" />
		<style></style>
	</head>
	<body>
		<div class="title">
			<a href="" class="icon-button"><i class="fa-solid fa-user"></i></a>
			<a href="about-us.php" class="link-button">About Us</a>
			<a href="" class="link-button">Schedule</a>
			<a href="index.php">
				<img src="assets/tarc.png" alt="Photo" />
			</a>
			<h1>TARC ROBOTICS CLUB</h1>
			<hr />
		</div>

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
	</body>
</html>
