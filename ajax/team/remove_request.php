<?php 
include '../extra/db.extra.php';
$user = $_POST['user_name'];
$team = $_POST['team'];

$sql = "SELECT * FROM team WHERE rand_id='$team'";
$m = mysqli_query($db,$sql);
$q = mysqli_fetch_array($m);
$app = $q['apply'];
$apply = str_replace(",$user,", ",", $app);

$sql = "UPDATE team SET apply='$apply' WHERE rand_id='$team'";
if (mysqli_query($db,$sql)) {
	echo "Removed";
}
?>