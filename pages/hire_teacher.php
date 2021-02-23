<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
			session_start();
} else {
	include 'ajax/db_back.php';
}
?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<link rel="stylesheet" href="<?php get_domain("/css/table.css?v=1.0.0") ?>">
<div class="container">
<div class="body_content content_area" style="width: 96%">
Hire Teacher
</div>