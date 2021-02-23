
<?php 
session_start();
include 'functions.php';
include 'footer.php';
include 'aside.php';
function get_header($title = "PaiPixel Online School")
{
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title id="page_title"><?php echo $title; ?></title>
	<!-- The fonts -->
<link href="https://fonts.googleapis.com/css2?family=Orbitron&family=Raleway&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- The Scripts -->
	<script src="<?php get_domain("/"); ?>js/jquery.js"></script>
  	<script src="<?php get_domain("/"); ?>js/ui/jquery-ui.min.js"></script>
	<!-- The Css Links -->
	<link rel="stylesheet" href="<?php get_domain("/"); ?>js/ui/jquery-ui.min.css">
	<!-- Icon -->
	<link rel="icon" href="<?php get_domain("/"); ?>image/favicon.png">
	<!-- Default Css Links -->
	<link rel="stylesheet" href="<?php get_domain("/"); ?>css/main.css?qs">
	<link rel="stylesheet" href="<?php get_domain("/"); ?>css/pup_up.css">
	<script>
		setInterval(function(){
			set_dato();
		},1000);
		function set_dato()
		{
			$.ajax({
				url: "<?php get_domain("/"); ?>ajax/active.user.php",
				type: "POST"
			});
		}

	</script>
	<style>
#loader{
	top: 0;
	left: 0;
	position: fixed;
	width: 100%;
	height: 100%;
	background:url(../image/tt.gif) 50% 50% no-repeat #ffffff;
	z-index: 1000;
	display: none;
}
#loader .text{
	display: block;
	text-align: center;
	font-size: 25px;
	line-height: 70vh;
	color: #20b99d;
	font-weight: bold;
	text-shadow: 1px 1px 1px green;
}
	</style>
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
<script>
function get_chapter(id,clas,subject)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/oddhay.php") ?>',
		type: 'GET',
		data: {class: clas, subject: subject},
	})
	.done(function(data) {
		$("#"+id).html(data);
	});
	
}
</script>
	<script>
	function resolver_class(cl)
	{
$.ajax({
	url: '<?php get_domain("/") ?>ajax/filter/resolver.php',
	type: 'GET',
	data: {cl: cl},
	beforeSend:function()
	{
		alert("pross");
	}
})
.done(function(data) {
	// $("#aj"+user).html(data);
	alert(data);
});
	}
</script>
	<script>
	function question_view(num,exam)
	{
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/exam/exam.php',
			type: 'POST',
			data: {q: num, exam: exam},
		})
		.done(function(data) {
			$(".area_content").html(data);
		})
		.fail(function() {
			alert("Network Error");
		});
		
	}
	function view_result(exam, t)
	{
		window.location = '<?php get_domain("/") ?>exam.php?pre_exams&exam_id='+exam;
		// $(".view_exam74").dialog({
		// 		width: "auto",
		// 		title: "Exam Result",
		// 		modal: "true",
		// 		buttons:{
		// 			"ok":function(){
		// 				$(this).dialog("close");
		// 			}
		// 		}
		// });
		// setInterval(function(){

		// $.ajax({
		// 	url: '<?php get_domain("/") ?>ajax/exam/live_result.php',
		// 	type: 'POST',
		// 	data: {exam: exam},
		// })
		// .done(function(data) {
		// 	$(".view_exam"+exam).html(data);
		// });
		// },2000);
		
	}
</script>
	<script>
		window.onpopstate = function(event) {
  window.location=document.location;
};
	</script>
	<script>
		$(document).ready(function() {
			$(".pup_up").click(function(event) {
	$(this).fadeOut(100);
	$(".ajax_data").fadeOut(100);
	var history = $(".ajax_data").attr("data-history");
	var title = $(".ajax_data").attr("data-title");
	$("#page_title").text(title);
	$(".ajax_data").removeAttr("data-history");
	$(".ajax_data").removeAttr("data-title");
	$(".ajax_data").html("");
	window.history.pushState("", "", history);
});
		});
	</script>
	<script>
function query_url(event,action,position = "", title = "<?php get_title(); ?>",file,active){

event.preventDefault();
if (active=='menu') {
	$(".nav_menu .cf a").removeClass('active');
	var class_list = action.classList;
	$("."+class_list).addClass('active');
	if ($(window).innerWidth()<716) {
		$(".nav_menu .cf .nav_responsive").hide('100');
		$(".nav_menu .nav_responsive_fix").fadeOut('100');
	}
}
if (position=='pup_up') {
	$("."+position).fadeIn(100);
	$(".ajax_data").css("display","block");
}
$.ajax({
	url: file,
	type: 'GET',
	data: 'handshake'
})
.done(function(data) {
	$("body,html").animate({
		scrollTop: 0
	},
	200);
	if (position=='pup_up') {
	$(".ajax_data").attr("data-history","<?php echo $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>");
	$(".ajax_data").attr("data-title", $("#page_title").text());
	$(".ajax_data").html(data);
	var window_height = $(window).innerHeight();
	var window_width = $(window).innerWidth();
	var book_height = $(".ajax_data").innerHeight();
	var book_width = $(".ajax_data").innerWidth();
	$(".ajax_data").css({
		'margin-top': (window_height/2)-(book_height/2),
		'margin-left': (window_width/2)-(book_width/2)
	});
	} else {
	$("."+position).html("<div class='free_data'>"+data+"</div>");
	}
	$("#page_title").text(title);
})
.fail(function() {
	alert("Network Error");
});

if (history.pushState) {
	window.history.pushState("", "", action);
} else {
	document.location.href = "/";
}

 };
</script>


<script>
function register_exam(exam,t)
{
$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/register_exam.php',
		type: 'POST',
		data: {exam:exam},
	})
	.done(function(data) {
$(".reg_exam_md").html(data);
$(".reg_exam_md").dialog({
open: true,
modal: true,
title: "Notification",
buttons:{
	"Ok":function(){
		$(this).dialog("close");
}
}
});
});

}


function cancel_reg_exam(exam, t)
{
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/exam/cancel.reg.php',
		type: 'POST',
		data: {exam:exam},
	})
	.done(function(data) {
		if (data=='Register') {
			t.innerHTML = data;
		} else {
		alert(data);
		}
	});
}
function exam_details(exam)
{
	$.ajax({
		url: '<?php get_domain("/")?>ajax/exam/exam_details.php',
		type: 'POST',
		data: {exam: exam},
	})
	.done(function(data) {
		$(".exam_details58").html(data);
		$(".exam_details58").dialog({
		open: true,
		modal: true,
		width: "auto",
		hide: "explode",
		show: "fade",
		title: "Exam Details",
		buttons:{
			"ok": function(){
				$(this).dialog("close");
			}
		}
	});
	})
	.fail(function() {
		alert("Network Error !");
	});
	
	
}
</script>



</head>
<div id="loader"><div class="text">Prepareing Your Exam</div></div>

<body onload="apply_changes()">
<div class="reg_exam_md"></div>
<div class="exam_details58"></div>
<?php
}


function get_top_menu()
{
	?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/top_menu.css?d">
<div class="logOut_info"></div>
<div class="top_menu">
	
	<div class="top_menu_section logo_section">
		<div class="logo_content">
			<h2>PaiPixel</h2>
			<p>More Exams, More Skills</p>
		</div>
	</div>

	<?php 
if (!isset($_SESSION['login_data_paipixel24'])) {
	?>
<div class="top_menu_section menu_section">
		<a href="<?php get_domain("/") ?>register">Create Account</a>
		<a href="<?php get_domain("/") ?>login">Login</a>
	</div>
	<?php
} else {
	?><script>
setInterval(function(){
$.ajax({
	url: '<?php get_domain("/ajax/noti/show.php") ?>',
})
.done(function(data) {
	// alert(data);
	$(".resp_notie").html(data);
});

},1000);
</script>

<div class="top_menu_section menu_section">
		<a href="<?php get_domain("/") ?>account">My Account <span class="resp_notie"></span></a>
		<a href="<?php get_domain("/") ?>ajax/logout.php">Log out</a>
	</div>
	<?php
}

	?>

</div>

	<?php
}


function get_nav_menu($active = "menu_item_home")
{
	?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/nav_menu.css?dd">
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
			if ($(window).innerWidth() > 785 && $(".nav_responsive").css("display","none")) {
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
		<a href="<?php get_domain("/") ?>" onclick="query_url(event,this,'from_main_body','Home | <?php get_title() ?>','<?php get_domain("/pages/home.php") ?>','menu')" class="menu_item_home">Home</a>
<?php if (user_detail("power")==1 || user_detail("role")==2) {
	?>
<a href="<?php get_domain("/") ?>exam.php?add_question" class="menu_item_results">Add Questions</a>
	<?php
}
 ?>
		<a href="javascript:void(0)" class="open_nav nav_button"><span class="material-icons">menu</span></a>
<div class="nav_responsive_fix"></div>
<!-- 		<div class="nav_responsive">
			<a href="javascript:void(0)" class="close_nav nav_button"><span class="material-icons">close</span></a>
			 <a href="<?php get_domain("/") ?>tutorial" onclick="query_url(event,this,'from_main_body','Tutorial | <?php get_title() ?>','<?php get_domain("/pages/tutorial.php") ?>','menu')" class="menu_item_tutorial">Tutorial</a>
			<a href="<?php get_domain("/") ?>exams" onclick="query_url(event,this,'from_main_body','Exams | <?php get_title() ?>','<?php get_domain("/pages/exam.php") ?>','menu')" class="menu_item_exams">Individual Exam</a>
			<a href="<?php get_domain("/") ?>team_exam" onclick="query_url(event,this,'from_main_body','Team Exams | <?php get_title() ?>','<?php get_domain("/pages/team_exam.php") ?>','menu')"class="menu_item_team_exam">Team Exam</a>
		<a href="<?php get_domain("/exam.php") ?>" class="menu_item_exam_list">Exam List</a>
			<a href="<?php get_domain("/") ?>ratings" onclick="query_url(event,this,'from_main_body','Ratings | <?php get_title() ?>','<?php get_domain("/pages/ratings.php") ?>','menu')" class="menu_item_rating">Rating</a>
			<a href="<?php get_domain("/") ?>score.php" class="menu_item_score">Score Leaderboard</a>
			<a href="<?php get_domain("/") ?>model.php" class="menu_item_model">Start Exam Now</a>
			<a href="<?php get_domain("/") ?>buy.php" class="menu_item_buy">Buy Exam</a>
			<a href="<?php get_domain("/") ?>ask_teacher" onclick="query_url(event,this,'from_main_body','Ask Teacher | <?php get_title() ?>','<?php get_domain("/pages/ask_teacher.php") ?>','menu')" class="menu_item_ask_teacher">Ask Question</a>
			<a href="<?php get_domain("/") ?>hire_teacher" onclick="query_url(event,this,'from_main_body','Hire Teacher | <?php get_title() ?>','<?php get_domain("/pages/hire_teacher.php") ?>','menu')" class="menu_item_hire_teacher">Hire Teacher</a>
			<a href="<?php get_domain("/") ?>FAQ" onclick="query_url(event,this,'from_main_body','FAQ | <?php get_title() ?>','<?php get_domain("/pages/faq.php") ?>','menu')" class="menu_item_faq">FAQ</a>

		</div> -->

				<div class="nav_responsive">
			<a href="javascript:void(0)" class="close_nav nav_button"><span class="material-icons">close</span></a>
			<!-- <a href="<?php get_domain("/") ?>tutorial" onclick="query_url(event,this,'from_main_body','Tutorial | <?php get_title() ?>','<?php get_domain("/pages/tutorial.php") ?>','menu')" class="menu_item_tutorial">Tutorial</a> -->
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
			<a href="<?php get_domain("/") ?>buy.php" class="menu_item_buy">Buy Exam</a>
			<a href="<?php get_domain("/") ?>ask_teacher" class="menu_item_ask_teacher"><?php echo x("Ask") ?> Question</a>
			<!-- <a href="<?php get_domain("/") ?>hire_teacher" onclick="query_url(event,this,'from_main_body','Hire Teacher | <?php get_title() ?>','<?php get_domain("/pages/hire_teacher.php") ?>','menu')" class="menu_item_hire_teacher">Hire Teacher</a> -->
			<a href="<?php get_domain("/") ?>FAQ" class="menu_item_faq">FAQ</a>

		</div>
		
	</nav>
</div>

	<?php
}
?>