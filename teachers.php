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
			<a href="<?php get_domain("/") ?>ratings" class="menu_item_rating active">Rating</a>
			<a href="<?php get_domain("/") ?>score.php" class="menu_item_score">Score Leaderboard</a>
			<a href="<?php get_domain("/") ?>week.php" class="menu_item_weakly">Weekly Top Scorers</a>
<?php if (user_detail("role")==1) {
?>
<a href="<?php get_domain("/") ?>model.php" class="menu_item_model">Start Exam Now</a>

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
<div class="container" style="max-width: 1100px; margin: 1% auto; position: relative; min-height: 1000px;">
	<div class="body_content content_area" style="width: 97%;">
<aside>
	<h2 class="caption">

<form action="" id="search_user">
		<div id="at">
		
	</div>
<style>
	.mobile {
		display: none;
	}
	@media (max-width: 500px) {
		.mobile{
			display: block;
		}
		.desktop {
			display: none;
		}
	}
</style>
<div style="float: left; margin-right: 10px; margin-top: 6px; font-size: 17px;" class="mobile">Search Teachers of </div>

	<!-- <label for="class" style="font-size: 18px; float:">class</label> -->
  <select id="subject" onchange="search_d52(1)" style="padding: 6px 6px; float: right;" name="class">
    <option value="">Subject</option>
    <optgroup label="Please Select Your Class First"></optgroup>
  </select>
  <script>
function get_subject(id,clas)
{
  $.ajax({
    url: '<?php get_domain("/ajax/teacher/subject.php") ?>',
    type: 'GET',
    data: {class: clas},
  })
  .done(function(data) {
    $("#"+id).html(data);
  });
  
}
</script>
  <select id="class" onchange="get_subject('subject',this.value);search_d52(1)" style="padding: 6px 6px; float: right;" name="class">
    <option value="">Class</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
  </select>
<div style="float: right; margin-right: 10px; margin-top: 6px; font-size: 17px;" class="desktop">Search Teachers of </div>
	<script>
		function show_data(v) {
			setTimeout(function(){
				$.ajax({
					url: '<?php get_domain("/ajax/school.php") ?>',
					type: "POST",
					data: "v="+v,
				})
				.done(function(data) {
			$("#don").html(data);
				});
				

			});
		}
	</script>
		<style>
#search_user #ms25 {
  background:url(../image/search-icon.png) 2% 50% / auto 90% no-repeat;
  width: 98%;
  padding: 10px 0% 10px 50px;
  border: 1px solid #ccc;
  margin: 1%;
  font-size: 14px;
}
		</style>
	<input type="text" onkeyup="search_d52(1)" autocomplete="off" name="search_user" id="ms25" placeholder="Search by username">
</form>
	</h2>
<script>
function search_d52(page){
	var institution = $("#subject").val();
	var classs = $("#class").val();
	var key = $("#ms25").val();
	var data = "class="+classs+"&&key="+key+"&&institution="+institution+"&&page="+page;
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/rating/teachers.php',
		type: 'GET',
		data: data,
	})
	.done(function(datas) {
		$(".asdf40").html(datas);
	});
}
$(document).ready(function() {
	search_d52(1);
});
</script>
	<div class="asdf40">

	</div>
</aside>