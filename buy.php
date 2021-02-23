<?php include 'header.php'; ?>
<?php get_header("Buy Exam | PaiPixel Online Exam") ?>
<?php get_top_menu("") ?>


<script>
	$(document).ready(function() {
		$(".top_menu_section.menu_section a").click(function(event) {
			window.location=$(this).attr("href");
		});
	});
</script>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/nav_menu.css?d">
<script>
	$(document).ready(function() {
		$(".open_nav").click(function() {
			$(".nav_responsive").fadeIn(100);
			$(".nav_responsive_fix").fadeIn(100);
		});
		$(".nav_responsive_fix").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});
		$(".close_nav").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});

		$(window).resize(function() {
			if ($(window).innerWidth() > 716 && $(".nav_responsive").css("display","none")) {
				$(".nav_responsive").css("display","inline-block");
			} else {
				$(".nav_responsive").css("display","none");
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		$(window).scroll(function() {
			var height = $(window).scrollTop();
			if(height>306){
				$(".nav_menu").addClass('fixed_menu');
				$(".container").css('margin-top', '50px');
			} else {
				$(".nav_menu").removeClass('fixed_menu');
				$(".container").css('margin-top', '0px');
			}
		});

		$(".nav_menu .cf a.<?php echo $active ?>").addClass('active');
	});
</script>

<div class="nav_menu">
	
<nav class="cf">
		<a href="<?php get_domain("/") ?>" class="menu_item_home">Home</a>
		<?php 
if (user_detail("power")==1 || user_detail("role")==2) {
	?>
<a href="<?php get_domain("/") ?>exam.php?add_question" class="menu_item_results">Add Questions</a>
	<?php
}
	?>
	<a href="javascript:void(0)" class="open_nav nav_button"><span class="material-icons">menu</span></a>
<div class="nav_responsive_fix"></div>
		
		<div class="nav_responsive">
			<a href="javascript:void(0)" class="close_nav nav_button"><span class="material-icons">close</span></a>
			<!-- <a href="<?php get_domain("/") ?>tutorial" class="menu_item_tutorial">Tutorial</a> -->
			<a href="<?php get_domain("/") ?>exams" class="menu_item_exams">Individual Exam</a>
			<a href="<?php get_domain("/") ?>team_exam" class="menu_item_team_exam">Team Exam</a>
			<!-- <a href="<?php get_domain("/exam.php") ?>" class="menu_item_exam_list">Exam List</a> -->
			<a href="<?php get_domain("/") ?>ratings" class="menu_item_rating">Rating</a>
			<a href="<?php get_domain("/") ?>score.php" class="menu_item_score">Score Leaderboard</a>
<a href="<?php get_domain("/") ?>week.php" class="menu_item_weakly">Weekly Top Scorers</a>
<?php if (user_detail("role")==1) {
?>
<a href="<?php get_domain("/") ?>model.php" class="menu_item_model">Start Exam Now</a>

<?php
} ?>
<a href="<?php get_domain("/") ?>buy.php" class="menu_item_buy active">Buy Exam</a>
			
			<a href="<?php get_domain("/") ?>ask_teacher" class="menu_item_ask_teacher"><?php echo x("Ask") ?> Question</a>
			<!-- <a href="<?php get_domain("/") ?>hire_teacher" class="menu_item_hire_teacher">Hire Teacher</a> -->
			<a href="<?php get_domain("/") ?>FAQ" class="menu_item_faq">FAQ</a>
		</div>

		</div>
		
	</nav>
</div>
<div class="pup_up" style="display: none;"></div>
<div class="ajax_data" style="display: none;"></div>
<div class="area_content" style="margin: 10px auto; background: white; width: 95%; box-shadow: 0px 0px 4px 2px #ccc; padding: 2%; min-height: 500px">
<link rel="stylesheet" href="<?php get_domain("/") ?>css/table.css?s5">
<!-- Develop The Buy Exam page -->
<!-- direct give the question without payment -->

<?php 
if (isset($_GET['buy_exam'])) {
	$user = user_detail("user_name");
	$sql = "UPDATE user SET balance=balance+10 WHERE user_name='$user'";
	if(mysqli_query($db,$sql)){
		?>

<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 400px;">
Successfully added 10 Questions to your account.
</div>
<?php 
	} else {
		?>

<div class="part_question" style="font-family: tahoma; background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>11; padding: 1%; margin: 1% auto; max-width: 400px;">
Failed to Add The question to your account.
</div>
<?php 
	}
}
?>


<!-- Buy page Theme Setup -->

<div class="main_page_theme">


<div class="areal_theme">
	<h2><?php echo arial("12"); ?> Exams</h2>
	<h3>at BDT  <?php echo arial("50") ?></h3>
	<a href="<?php get_domain("/buy.php?buy_exam=12") ?>" class="sk_button">Buy Now</a>
</div>

<div class="areal_theme">
	<h2><?php echo arial("25"); ?> Exams</h2>
	<h3>at BDT  <?php echo arial("100") ?></h3>
	<a href="<?php get_domain("/buy.php?buy_exam=25") ?>" class="sk_button">Buy Now</a>
</div>


<div class="areal_theme">
	<h2><?php echo arial("60"); ?> Exams</h2>
	<h3>at BDT  <?php echo arial("200") ?></h3>
	<a href="<?php get_domain("/buy.php?buy_exam=60") ?>" class="sk_button">Buy Now</a>
</div>



<div class="areal_theme">
	<h2><?php echo arial("100"); ?> Exams</h2>
	<h3>at BDT  <?php echo arial("300") ?></h3>
	<a href="<?php get_domain("/buy.php?buy_exam=100") ?>" class="sk_button">Buy Now</a>
</div>


<div class="areal_theme">
	<h2><?php echo arial("200"); ?> Exams</h2>
	<h3>at BDT  <?php echo arial("500") ?></h3>
	<a href="<?php get_domain("/buy.php?buy_exam=200") ?>" class="sk_button">Buy Now</a>
</div>

<div class="areal_theme">
	<h2><?php echo arial("500"); ?> Exams</h2>
	<h3>at BDT  <?php echo arial("1000") ?></h3>
	<a href="<?php get_domain("/buy.php?buy_exam=500") ?>" class="sk_button">Buy Now</a>
</div>
</div>
</div>

<?php get_footer() ?>

