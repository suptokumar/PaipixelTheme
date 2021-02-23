<?php include 'header.php'; ?>
<?php get_header("Model Question | PaiPixel Online Exam") ?>
<?php get_top_menu("") ?>

<div class="from_main_body">
	
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
<a href="<?php get_domain("/") ?>model.php" class="menu_item_model active">Start Exam Now</a>

<?php
} ?>
			<a href="<?php get_domain("/") ?>buy.php" class="menu_item_buy">Buy Exam</a>
			<a href="<?php get_domain("/") ?>ask_teacher" class="menu_item_ask_teacher"><?php echo x("Ask") ?> Question</a>
			<!-- <a href="<?php get_domain("/") ?>hire_teacher" class="menu_item_hire_teacher">Hire Teacher</a> -->
			<a href="<?php get_domain("/") ?>FAQ" class="menu_item_faq">FAQ</a>
		</div>

		</div>
		
	</nav>
</div>
<div class="pup_up" style="display: none;"></div>
<div class="ajax_data" style="display: none;"></div>
<div class="area_content" style="margin: 10px auto; background: white; width: 95%; max-width: 1000px; box-shadow: 0px 0px 4px 2px #ccc; padding: 2%; ">
<link rel="stylesheet" href="<?php get_domain("/") ?>css/table.css?s5">
<link rel="stylesheet" href="<?php get_domain("/") ?>css/sks.css?s1">
<div class="tab_menu">
	<a href="javascript:void(0)" class="menu_button2 active menu_button" onclick="open_tab(2)">Prepare Your Own Exam</a>
	<a href="javascript:void(0)" class="menu_button1 menu_button" onclick="open_tab(1)">Todays Exam</a>
	<!-- <a href="javascript:void(0)" class="menu_button3 menu_button" onclick="open_tab(3)">Board Questions</a> -->
</div>
<script>
$(document).ready(function() {
	open_tab(2);
});
function open_tab(id)
{
	if (id==1) {

	$.ajax({
		url: '<?php get_domain("/ajax/model/") ?>todays_model.php',
		type: 'GET',
	})
	.done(function(data) {
		$(".open_tab").html(data);
		$(".menu_button").removeClass('active');
		$(".menu_button"+id).addClass('active');
	});
	}

	if (id==2) {
		
	$.ajax({
		url: '<?php get_domain("/ajax/model/") ?>custom_model.php',
		type: 'GET',
	})
	.done(function(data) {
		$(".open_tab").html(data);
		$(".menu_button").removeClass('active');
		$(".menu_button"+id).addClass('active');
	});
	}
	if (id==3) {
		
	$.ajax({
		url: '<?php get_domain("/ajax/model/") ?>board_question.php',
		type: 'GET',
	})
	.done(function(data) {
		$(".open_tab").html(data);
		$(".menu_button").removeClass('active');
		$(".menu_button"+id).addClass('active');
	});
	}
	
}
</script>
<style>
@media (max-width: 524px) {
	.tab_menu a{
		font-size: 10px;
		font-weight: bold;
		padding: 10px 5px
	}
}
</style>
<div class="open_tab" style="padding: 1%; border: 1px solid #ccc;"></div>
</div>
</div>
<?php get_footer() ?>

