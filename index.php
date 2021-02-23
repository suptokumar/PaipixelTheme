<?php 
// Include the functions and other files here
include 'header.php';
?>



<!-- Develop The Profile Part -->
<?php 
if (is_page("profile")) {

get_header("PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu();
?>
<div class="from_main_body">
<?php include 'profile.php'; // Get Home Posts ?>
</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>







<!-- Handleing Custom Profile -->
<?php 
if (is_page("profiles")) {
?>
<?php include 'profile.php'; // Get Home Posts ?>


<?php
get_footer();
?>
	<?php
	exit;
}
?>





<!-- Develop The Log in Part -->
<?php 
if (is_page("login")) {

get_header("Log In | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"

	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu();
?>
<div class="from_main_body">

<?php include 'login.php'; // Get Home Posts ?>


</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>




<!-- Develop The Register Part -->
<?php 
if (is_page("register")) {

get_header("Register | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu();
?>
<div class="from_main_body">

<?php include 'register.php'; // Get Home Posts ?>


</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>







<!-- Develop The Page Part -->

<?php 

// The tutorial page 
if (is_page("tutorial")) {

get_header("Tutorial | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_tutorial");
?>


<div class="from_main_body">


		<?php 
		include 'pages/tutorial.php';
		?>

	</div>

</div>




</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>






<?php 

// The exams page 
if (is_page("exams")) {

get_header("Exams | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_exams");
?>


<div class="from_main_body">
	<?php 
	include 'pages/exam.php';
	?>
</div>




</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>





<?php 

// The team_exam page 
if (is_page("team_exam")) {

get_header("Team Exams | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_team_exam");
?>


<div class="from_main_body">


		<?php 
		include 'pages/team_exam.php';
		?>

	</div>

</div>




</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>





<?php 

// The ratings page 
if (is_page("ratings")) {

get_header("Ratings | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_rating");
?>


<div class="from_main_body">


		<?php 
		include 'pages/ratings.php';
		?>

	</div>
</div>




</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>









<?php 

// The ask_teacher page 
if (is_page("ask_teacher")) {

get_header("Ask Teacher | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_ask_teacher");
?>


<div class="from_main_body">


		<?php 
		include 'pages/ask_teacher.php';
		?>

	</div>

</div>




</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>







<?php 

// The hire_teacher page 
if (is_page("hire_teacher")) {

get_header("Hire Teacher | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_hire_teacher");
?>


<div class="from_main_body">


<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container">
	<div class="body_content content_area">
		<?php 
		include 'pages/hire_teacher.php';
		?>

	</div>
	<div class="aside_content content_area">
		<?php get_aside(); ?>
	</div>
</div>




</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>






<?php 

// The FAQ page 
if (is_page("FAQ")) {

get_header("FAQ | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_faq");
?>


<div class="from_main_body">


		<?php 
		include 'pages/faq.php';
		?>

	</div>

</div>




</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>







<?php 

// The account page 
if (is_page("account")) {

get_header("Account | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_account");
?>


<div class="from_main_body">

		<?php 
		include 'pages/account.php';
		?>






</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();
?>
	<?php
	exit;
}
?>









<?php 

// The Team Viewer 
if (is_page("team")) {

get_header("Team | PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
	?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu("menu_item_home");
?>


<div class="from_main_body">

		<?php 
		include 'pages/team.php';
		?>






</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>

<?php
get_footer();

?>
	<?php
	exit;
}
?>















<?php 

// The Team Viewer 
if (is_page("teams")) {
	include 'pages/team.php';

	exit;
}
?>









<!-- The main Index Page Template -->


<?php
// GET and Display The header file Linkup
get_header("PaiPixel Online Exam"); // Site Title "Paipxel Online Exam"
// It's Return the start of body section.
?>
<div class="from_main_menu">
<?php
// GET top LOGO and LOG Section
get_top_menu();
?>
<div class="from_nav_menu">
<?php
// GET the main menu with responsive CSS
get_nav_menu();
?>
<div class="from_main_body">


		<?php 
		include 'pages/home.php';
		?>


</div>




</div>
</div>
</div>
<div class="pup_up"></div>
<div class="ajax_data"></div>
<?php
get_footer();
?>