<?php 
include '../extra/db.extra.php';

$team_name = $_GET['team_name'];
$team_class = $_GET['team_class'];
$required_ratings = $_GET['required_ratings'];
$team_type = $_GET['team_type'];
$user = $_GET['user'];
$description_team = $_GET['description_team'];
$msg = 0;
if ($team_name=='') {
	echo "Team Name Could not Be Empty. <br><br>";
	$msg += 1;
}
if ($required_ratings=='') {
	echo "Required Ratings Could not Be Empty. <br><br>";
	$msg += 1;
}
if ($msg!=0) {
	exit();
}
$sql = "SELECT id FROM team ORDER BY id DESC";
$q = mysqli_query($db,$sql);
$n = mysqli_num_rows($q);
$rand_id = $n.rand(1000,9999);
date_default_timezone_set("Asia/Dhaka");
$date_time = date("Y-m-d H:i:s");
$show_time = date("d M Y, h:i a");
$sql = "INSERT INTO `team` (`rand_id`, `team_name`, `description`, `rating`, `type`, `min_rate`, `r_class`, `leader`, `co_leader`, `date_time`, `show_time`, `apply`) VALUES ('$rand_id', '$team_name', '$description_team', '0', '$team_type', '$required_ratings', '$team_class',',$user,', ',', '$date_time', '$show_time', ',')";
if (mysqli_query($db,$sql)) {
	$sql = "UPDATE user SET team='$rand_id' WHERE user_name='$user'";
	if (mysqli_query($db,$sql)) {
		echo "<h2 style='color: green;'>Successfuly Created Team $team_name</h2>";
		?>
<table class="data_table">
	<tr>
		<td>Team Id</td>
		<td><?php echo $rand_id ?></td>
	</tr>
	<tr>
		<td>Team Leader</td>
		<?php 
$sql = "UPDATE user SET position_in_team = 'Leader' WHERE user_name='$user'";
mysqli_query($db,$sql);
		?>
		<td><?php echo $user ?></td>
	</tr>
	<tr>
		<td>Required Ratings</td>
		<td><?php echo $required_ratings ?></td>
	</tr>
</table>
<div class="info">Click Ok, And Start adding People.</div>
		<?php
	}
}
?>