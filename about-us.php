<?php
$title = 'About Us';
$css = 'css/about.css';

include('includes/header-user.php');
?>

<section class="about-section">
	<div class="grid-container">
		<?php
		$photos = array(
			array("path" =>
			"assets/about us/images (1).png", "text" => "NAME 1"), array("path" => "assets/about us/images (1).png", "text" => "NAME 2"), array("path" => "assets/about us/images (1).png", "text" => "NAME 3"), array("path" => "assets/about us/images (1).png", "text" => "NAME 4"), array("path" => "assets/about us/images (1).png", "text" => "NAME 5"),
		);
		foreach ($photos as $photo) { ?>
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