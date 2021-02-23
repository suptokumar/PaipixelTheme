<div class="atodgs">
<?php 
include '../extra/db.extra.php';
$user = $_GET['user'];
$id=$_GET['id'];
$sql = "SELECT * FROM `team_chal` WHERE id='$id'";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);
session_start();
if (user_detail("position_in_team")=='Leader' || user_detail("position_in_team")=='Co-Leader') {
	$cl = $row['class'];
	$team = $row['team'];
	$member = $row['member'];
	$member = substr($member, 1);
	$ms = explode(",", $member);
	$me = count($ms);
if ($cl != user_detail("class")) {
	echo 2;
	exit();
}
if ($team == user_detail("team")) {
	echo 'It\' from Your team. You can not accept this request againest your team.';
	exit();
}
if ($row["accept_id"]==1) {
	echo 'The Challenge already accepted.';
	exit();
}
$t = user_detail("team");
$sql = "SELECT * FROM user WHERE team='$t'";
$q = mysqli_query($db,$sql);
$d = mysqli_num_rows($q);
if ($me>$d) {
	echo "Your Team doesn't Have Enough member to accept the challenge.";
}

echo "Please Select The members You need to For this challenge. (Needed members: ".$me.") <br>";

?>

<form id="new_team_chal">
	<div>
		<input type="hidden" name="team" value="<?php echo $id ?>">
	</div>
	<?php 
$p0d = rand();
?>
<input id="s544d<?php echo $p0d ?>" type="hidden" value="0">
		<table class="func_table table_hoverable gdgas4ds1fd00"></table>
		<script>
			function yea_this(t, user)
			{
var qn = $("#member").val();
var in_v = $("#s544d<?php echo $p0d ?>").val();
if ($("#s544d<?php echo $p0d ?>").hasClass('sc'+user)) {
	$("#s544d<?php echo $p0d ?>").removeClass('sc'+user);
$("#s544d<?php echo $p0d ?>").val((Number(in_v)-1));
} else {
$("#s544d<?php echo $p0d ?>").addClass('sc'+user);
$("#s544d<?php echo $p0d ?>").val((Number(in_v)+1));
}
var ew = $("#s544d<?php echo $p0d ?>").val();
if ((Number(ew))==(Number(qn))) {
	$(".t44f").attr('disabled', 'disabled');
	$(".t44f:checked").removeAttr('disabled');
	$(".at0150").removeClass('disabled');
	$(".at0150").removeAttr('disabled');
} else {
	$(".t44f").removeAttr('disabled');
	$(".at0150").addClass('disabled');
	$(".at0150").attr('disabled','disabled');
}
}
		</script>
		<script>
	function select_player(val) {
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/user_search.php',
			type: 'GET',
			data: {user: val, edit: "edit"},
		})
		.done(function(data) {
			$(".gdgas4ds1fd00").html(data);
			$("#s544d<?php echo $p0d ?>").removeAttr('class');
			$("#s544d<?php echo $p0d ?>").removeAttr('value');
		})
		.fail(function() {
			$(".gdgas4ds1fd00").html("network error.");
		});
		
	}
	$(document).ready(function() {
		select_player(<?php echo $me ?>);
	});
</script>
		<input id="member" name="member" type="hidden" class="input" value='<?php echo $me ?>'>

	<div class="button_set">
	<input type="submit" value="Accept Challenge" name="submits" class="button at0150 button_standard disabled" disabled="disabled">
	</div>
</form>
<link rel="stylesheet" href="<?php get_domain("/") ?>css/table.css">
</div>
<div class="a4z<?php echo $dfs105 = rand(); ?>"></div>
<script>
$(document).ready(function() {
	$("#new_team_chal").submit(function(event) {
		event.preventDefault();
		var s = $(this).serialize()+"&token="+document.getElementById('s544d<?php echo $p0d ?>').classList;
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/team_exam/step_passed_and_accept.php',
			type: 'POST',
			data: s,
		})
		.done(function(d) {
			$(".atodgs").slideUp(1000);
			$(".a4z<?php echo $dfs105; ?>").html(d);
		});
		
	});
});
</script>
<?php

} else {
	echo "Sorry ! You must have to be Leader or Co-Leader of a team to accept this challenge";

}



?>