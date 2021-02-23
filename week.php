<?php include 'header.php'; ?>
<?php get_header("Score LeaderBoard | PaiPixel Online Exam") ?>
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
      <a href="<?php get_domain("/") ?>week.php" class="menu_item_weakly active">Weekly Top Scorers</a>
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
<div class="area_content" style="max-width: 1100px; margin: 1% auto; position: relative;">
	<link rel="stylesheet" href="<?php get_domain("/") ?>css/table.css?s5">
	<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
session_start();
} else {
	include 'ajax/db_back.php';
}
?>
<link rel="stylesheet" href="<?php get_domain("/css/table.css?s5.0gs") ?>">

<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container">
	<div class="body_content content_area" style="width: 97%;">
<aside>
	<h2 class="caption">
		<style>
#search_user #ms25 {
  background:url(../image/search-icon.png) 2% 50% / auto 90% no-repeat;
  width: 82%;
  padding: 10px 0% 10px 15%;
  border: 1px solid #ccc;
  margin: 1%;
  font-size: 14px;
}
		</style>

<style>
	* {
  box-sizing: border-box;
}

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}

.autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    width: 400px;
    margin-top: 37px;
    right: 41px;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
  font-weight: 100;
  font-size: 16px;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
 #institutionautocomplete-list{
     margin-top: 30.85px;
     right: 40px;
}
@media (max-width:1088px)
{
    #institutionautocomplete-list{
        right: 3.7%;
        margin-top: 30.6px;
    }
}
@media (max-width:820px)
{
    #institutionautocomplete-list{
        right: 2.6%;
        margin-top: 30.6px;
    }
}
@media (max-width:533px)
{
    #institution {
       width: 74% !important;
    }
    #institutionautocomplete-list{
        right: 2.9%;
        margin-top: 30.6px;
        width: 75.4%;
    }
}


#institutionautocomplete-list {
    box-shadow: 0px 3px 3px 1px #ccc;
    max-height: 450px;
    overflow-y: scroll;
}

</style>
	<!-- <label for="institution" style="font-size: 18px; float:">Institution</label> -->

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
</form>
	</h2>
<script>
	setInterval(function(){
$.ajax({
	url: '<?php get_domain("/ajax/extra/weekcounter.php") ?>',
})
.done(function(data) {
	$("#module_410").html("Week Ends In: "+data);
});

	},100);
</script>
	<h2 style="text-align: center;" id="module_410">Week Ends In: </h2>
<select name="week" id="week" style="padding: 10px;float: right;" onchange="search_d52(1)">
<option value="">Current Week</option>
		<?php 
		$sql = "SELECT week FROM weektopscore GROUP BY week ORDER BY id DESC";
		$m = mysqli_query($db,$sql);
		$i = 1;
		while($r=mysqli_fetch_array($m)){
				 	?>
		
<option value="<?php echo $r['week'] ?>">Week <?php echo $i ?></option>
		 	<?php
		 } ?>
	</select>
	<input type="search" autocomplete="off" id="ms25" placeholder="search" style="padding: 10px;" onkeyup="search_d52(1)"> <button style="padding: 10px; border: 1px solid #ccc; cursor: pointer; background: #26FF68" onclick="search_d52(1)">Refresh</button>
<script>
function search_d52(page){
	var key = $("#ms25").val();
	var week = $("#week").val();
	var data = "week="+week+"&&key="+key+"&&page="+page;
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/rating/week.php',
		type: 'GET',
		data: data,
	})
	.done(function(data) {
		$(".asdf40").html(data);
	});
}
$(document).ready(function() {
	search_d52(1);
});
</script>
	<div class="asdf40">

	</div>
</aside>
</div>
</div>
</div>
<?php get_footer() ?>
