<?php 
include 'db.php';
 ?>
<link rel="stylesheet" href="<?php get_domain("/") ?>css/table.css?s5">
<link rel="stylesheet" href="<?php get_domain("/") ?>css/sks.css?s1">
<style>
@media(max-width: 700px)
{
	.data_table{
		font-size: 9px;
	}
	.rtr25 {
		display: none;
	}
}
</style>
<?php
echo "<div class='acctt'>";
session_start();
$user = user_detail("user_name");

	?>
<div class="tab_menu">
	<a href="javascript:void(0)" class="menu_button1 active menu_button" onclick="open_tab(1)">Individual Exam</a>

	<a href="javascript:void(0)" class="menu_button4 menu_button" onclick="open_tab(4)">Team Exam</a>

	<a href="javascript:void(0)" class="menu_button3 menu_button" onclick="open_tab(3)">Custom Exam</a>

	<a href="javascript:void(0)" class="menu_button2 menu_button" onclick="open_tab(2)">Model Exam</a>

	<a href="javascript:void(0)" class="menu_button5 menu_button" onclick="open_tab(5)">Suggestion</a>

</div>
<script>
$(document).ready(function() {
	open_tab(1);
});
function open_tab(id)
{
	if (id==1) {

	$.ajax({
		url: '<?php get_domain("/ajax/exam_list/") ?>live.php',
		type: 'GET',
		beforeSend:function(){
			$(".open_tab").html("Loading...");
		}
	})
	.done(function(data) {
		$(".open_tab").html(data);
		$(".menu_button").removeClass('active');
		$(".menu_button"+id).addClass('active');
	});
	}

	if (id==3) {
		
	$.ajax({
		url: '<?php get_domain("/ajax/exam_list/") ?>custom_exam.php',
		type: 'GET',
		beforeSend:function(){
			$(".open_tab").html("Loading...");
		}
	})
	.done(function(data) {
		$(".open_tab").html(data);
		$(".menu_button").removeClass('active');
		$(".menu_button"+id).addClass('active');
	});
	}
	if (id==2) {
		
	$.ajax({
		url: '<?php get_domain("/ajax/exam_list/") ?>todays_exam.php',
		type: 'GET',
		beforeSend:function(){
			$(".open_tab").html("Loading...");
		}
	})
	.done(function(data) {
		$(".open_tab").html(data);
		$(".menu_button").removeClass('active');
		$(".menu_button"+id).addClass('active');
	});
	}
	if (id==4) {
		
	$.ajax({
		url: '<?php get_domain("/ajax/exam_list/") ?>team_exam.php',
		type: 'GET',
		beforeSend:function(){
			$(".open_tab").html("Loading...");
		}
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