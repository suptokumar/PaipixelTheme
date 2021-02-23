<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container">
	<div class="body_content content_area" style="padding: 60px 0px">
	
	<?php 
if ($_GET["login"]!='') {
	echo $_GET["login"];
}else {
	include 'theme/login_theme.php';
}

	?>

	</div>
	<div class="aside_content content_area">
		<?php get_aside("top_students"); ?>
	</div>
</div>