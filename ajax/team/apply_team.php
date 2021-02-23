<?php 
include '../extra/db.extra.php';
session_start();
$team = $_POST['team'];
$user = $_SESSION['login_data_paipixel24'];
$sql = "SELECT * FROM user WHERE user_name='$user'";
$r = mysqli_query($db,$sql);
$row = mysqli_fetch_array($r);
$rating = $row['rating'];
$class = $row['class'];
if($row["team"]!=''){
echo "You are a Team Member. Please Leave Your Team to Apply";
}else {
$sql = "SELECT * FROM team WHERE rand_id='$team'";
$q = mysqli_query($db,$sql);
$qs = mysqli_fetch_array($q);
if ($class<$qs['r_class']) {
	echo "Required Class: ".$qs['r_class'];
	exit();
}
if ($rating<$qs['min_rate']) {
	echo "Required Ratings: ".$qs['min_rate'];
	exit();
}
if ($qs['type'] == 1) {
	$sql = "UPDATE user SET team='$team' , position_in_team='Junior' WHERE user_name='$user'";
	if (mysqli_query($db,$sql)) {
		echo "Successfuly Joined"; 
	}
}
if ($qs['type'] == 2) {
	$sql = "SELECT * FROM team WHERE rand_id='$team'";
	$q = mysqli_query($db,$sql);
	$d = mysqli_fetch_array($q);
	$apply = $d['apply'];
	$set_apply = $apply.$user.',';
	$sql = "UPDATE team SET apply='$set_apply' WHERE rand_id='$team'";
	if (mysqli_query($db,$sql)) {
		echo "Request Sent";
	}
}
if ($qs['type'] == 3) {
	echo "Please Contact a Team Member";
}
}
?>