<?php
$title = 'TAR UMT Robotics Club';
$css = 'css/website/index.css';
$css1 = 'css/website/news.css';

include('includes/header.php');
require_once('includes/helper.php');

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM news LIMIT 3";

$result = $con->query($sql);
?>

<section class="main-section">
	<div class="hero-container">
		<div class="text-box">
			<h1>Welcome to TAR UMT Robotics Club</h1>
			<p>Explore the world of robotics with us and unleash your creativity!</p>
		</div>
	</div>

	<div class="news-container">
		<h1 class="section-title">News</h1>

		<?php
		if ($result->num_rows > 0) {
		?>
			<div class="news-items">
				<?php
				for ($i = 0; $i < 3; $i++) {
				}

				while ($row = $result->fetch_object()) {
					printf(
						'<div class="news-card" onclick="location=\'news.php?card=%d\'">
							<div class="row title">
								<h1>%s</h1>
							</div>
							<div class="row content">
								<p>%s</p>
							</div>
							<div class="row date">
								<p>%s</p>
							</div>
						</div>',
						$row->id,
						htmlspecialchars($row->title),
						$row->content,
						date("d-M-Y", strtotime($row->date))
					);
				}
				?>

				<div class="news-card more" onclick="location='news.php'">
					<i class="fa-solid fa-circle-arrow-right"></i>
					<h1>See More</h1>
				</div>
			</div>

		<?php
		}
		?>
	</div>
</section>
</body>

</html>