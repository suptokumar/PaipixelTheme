<?php 
include '../extra/db.extra.php';

$team_name = $_GET['team_name'];
$team_class = $_GET['team_class'];
$id = $_GET['id'];
$required_ratings = $_GET['required_ratings'];
$team_type = $_GET['team_type'];
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
$sql = "UPDATE `team` SET `team_name`='$team_name',`description`='$description_team', `type`='$team_type',`min_rate`='$required_ratings',`r_class`='$team_class' WHERE rand_id='$id'";
if (mysqli_query($db,$sql)) {

		echo "Successfuly Updated Team '$team_name'";

}
?>