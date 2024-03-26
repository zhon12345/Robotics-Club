<?php
$title = 'About Us';
$css = 'css/about.css';

include('includes/header-user.php');
?>

<section class="about-section">
	<div class="grid-container">
		<?php
		$photos = array(
			array("path" => "assets/about us/zx.jpeg", "text" => "Tan Zhi Xuan</br>Robotics Engineer"),
			array("path" => "assets/about us/zo.jpg", "text" => "Ng Zhun Onn</br>Software Developer"),
			array("path" => "assets/about us/st.jpeg", "text" => "Lee Soon Teng</br>Mechanical Engineer"),
			array("path" => "assets/about us/sj.jpeg", "text" => "Yap Sheng Jin</br>Robotics Researcher"),
			array("path" => "assets/about us/yb.jpg", "text" => "Hoo Yean Bin</br>Technology Consultant"),
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