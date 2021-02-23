<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title id="page_title">Bynary</title>
	<!-- The fonts -->
<link href="https://fonts.googleapis.com/css2?family=Orbitron&family=Raleway&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- The Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!-- The Css Links -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script>
		// setInterval(function(){
		// 	set_dato();
		// },1);
		$(document).ready(function() {
			d();
		});
		function d(v)
		{
			var score = Number($("#score").html());
			var limit = Number($("#limit").html());
			var vs = $(".s"+v).val();
if ($(".win").val()==vs) {
	score += 1;
	$("#score").html(score);
}
	limit--; 
	if (limit!=0) {

$.ajax({
	url: "ajax_runner1.php",
	type: "POST",
	success:function(data)
	{
		$(".div").html(data);
		// $("body,html").animate({
		// 	scrollTop: 5000000000000
		// });
	}
});
	} else {
		$(".score_board").addClass('fixed');
	}
	$("#limit").html(limit);
		}
	</script>
</head>
<style>
	* {
		margin: 0;
		padding: 0;
	}
	.fixed {
    position: fixed;
    width: 100%;
    background: #ffffff50;
    height: 100%;
    margin:0;
    top:0;
    text-align: center;
    color: tomato;
    text-shadow:1px 1px 1px blue;
    font: 58px airal;
    padding-top: 15%;
    transition: .2s;
    font-weight: bold;
}
</style>

<body style="background: #212121; color: white; font-family: arial; overflow: hidden;">
	<div class="score_board" style="text-align: center;">
	<div>Your Score: <span id="score">-1</span></div>
	<div>Your Clicks: <span id="limit">21</span></div>
	</div>
	<div class="div" style="margin: 5% auto; width: 1000px;"></div>
</body>