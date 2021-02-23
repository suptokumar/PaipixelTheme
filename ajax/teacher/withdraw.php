<?php 
include '../extra/db.extra.php';
session_start();
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d");
$user_name = user_detail("user_name");
?>
<div class="dsn" style="max-width: 1000px;border: 1px solid #20b99d; margin: 10px auto;">
	<span style="font: 20px arial; color: green; font-weight: bold;"><span style="color: black; font-weight: 400">Your Current Balance is:</span> BDT  <?php echo user_detail("balance"); ?></span><a href="javascript:void(0)" style="background: green;padding: 10px;border: 1px solid #20b99d;text-decoration: none;box-shadow: 1px 1px 1px 1px #ccc;display: inline-block;color: white;border-radius: 10px;margin: 10px;" onclick="withdraw();">Withdraw Now</a>
	<div id="withdraw" style="display: none;">
		<span style="color: orangered; font-size: 15px">* Fill up the information carefully.</span>
		<?php $vst = rand(); ?>
		<input type="text" class="input" id="phone<?php echo $vst ?>" placeholder="Phone Number (Bkash Personal)">
		<input type="number" class="input" id="amounts<?php echo $vst ?>" placeholder="Amount: min. 500 BDT ">
		<input type="password" class="input" id="pass<?php echo $vst ?>" placeholder="Your Account Password">
	</div>
	<select name="short" id="short" style="padding: 10px;" onchange="donoe(1)">
		<option value="">Short By</option>
		<option value="1">Your Withdraws</option>
		<option value="2">Your Pending Withdraws</option>
		<option value="3">All Pending Withdraws</option>
		<option value="4">Your Approved Withdraws</option>
		<option value="5">All Approved Withdraws</option>
		<!-- <option value="6">Your Rejected Withdraws</option> -->
		<!-- <option value="7">All Rejected Withdraws</option> -->
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
			url: '<?php get_domain("/ajax/teacher/live_withdrow.php") ?>',
			type: 'GET',
			data: "page="+page+"&&short="+short,
		})
		.done(function(data) {
			$(".live_withdrow_manager").html(data);
		});
		}
	</script>
	<script>
	    function withdraw()
	    {
	    	var amount = '<?php echo user_detail("balance"); ?>';
	    	if (amount>1) {
$("#withdraw").dialog({
	open: true,
	modal: true,
	title: "Withdraw",
	show: "bounce",
	hide: "scale",
	width: "auto",
	height: "auto",
	buttons:{
		"I Confirm & Send Request": function(){
			$("#confonr").html("You are about to withdraw "+$("#amounts<?php echo $vst ?>").val()+" BDT in your "+$("#phone<?php echo $vst ?>").val()+" bkash personal number.<br> Do you want to proceed and confirm?");
			$("#confonr").dialog({
				open: true,
				modal: true,
				width: "auto",
				title: "Confirmation",
				buttons:{
					"Yes":function(){
$.ajax({
				url: '<?php get_domain("/ajax/teacher/sure_withdraw.php") ?>',
				type: 'POST',
				data: {phone: $("#phone<?php echo $vst ?>").val(),amount:$("#amounts<?php echo $vst ?>").val(),pass:$("#pass<?php echo $vst ?>").val()},
			})
			.done(function(data) {
				$("#confonr").html(data);
				$("#confonr").dialog({
				open: true,
				modal: true,
				title: "Message",
				width: "auto",
				buttons:{
					"Close":function(){
						$(this).dialog("close");
					}
				}
			});
				if (data=='Successfully request Sent.') {
					location.reload();
				}
			});
			
					},
					"No":function(){
$(this).dialog("close");
					}
				}
			});
			
		},
		"Cancel":function(){
			$(this).dialog("close");
		}
	}
});
	    	} else {
	    		alert("Withdrawal amount can't be less than 500 BDT.");
	    	}
	    }
	</script>
</div>
<div id="confonr"></div>