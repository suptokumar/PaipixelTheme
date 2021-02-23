<?php 

include '../functions.php';
include '../ajax/db_back.php';
session_start();
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d");
$user_name = user_detail("user_name");
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<!-- The Css Links -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">
	<!-- Icon -->
	<link rel="icon" href="<?php get_domain("/"); ?>image/favicon.png">
<style>
	* {
		font-family: arial;
	}
</style>
<div class="dsn" style="max-width: 1000px;border: 1px solid #20b99d; margin: 10px auto;">

	<select name="short" id="short" style="padding: 10px;" onchange="donoe(1)">
		<option value="">Short By</option>
		<option value="1">Your Withdraws</option>
		<option value="2">Your Pending Withdraws</option>
		<option value="3">All Pending Withdraws</option>
		<option value="4">Your Approved Withdraws</option>
		<option value="5">All Approved Withdraws</option>
		<option value="6">Your Rejected Withdraws</option>
		<option value="7">All Rejected Withdraws</option>
	</select>
	<div class="live_withdrow_manager">

	</div>
	<script>
		$(document).ready(function() {
			donoe(1);
		});
		function donoe(page)
		{
var short = $("#short").val();
		$.ajax({
			url: 'live_withdraw.php',
			type: 'GET',
			data: "page="+page+"&&short="+short,
		})
		.done(function(data) {
			$(".live_withdrow_manager").html(data);
		});
		}
	</script>
</div>