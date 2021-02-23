<?php 
include '../extra/db.extra.php';
session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
	echo "Login Error";
	exit();
}
$setter = $_SESSION['login_data_paipixel24'];
$asdf0 = $_POST['asdf0'];
$cout = $_POST['count'];
$success = 0;
$failed = 0;
date_default_timezone_set("Asia/Dhaka");
$date_time = date("Y-m-d H:i:s");

for ($i=0; $i < ($cout); $i++) { 
	$q =  $_POST['q'.(($i)+1)];
	$opt1 = $_POST['opt'.(($i)+1).'1'];
	$opt2 = $_POST['opt'.(($i)+1).'2'];
	$opt3 = $_POST['opt'.(($i)+1).'3'];
	$opt4 = $_POST['opt'.(($i)+1).'4'];
	$currect = $_POST['currect'.(($i)+1)];
if ($q!='') {
	
$sql = "INSERT INTO `team_chal_qtn` (`question`, `ans1`, `ans2`, `ans3`, `ans4`, `ct`, `date`, `user`, `ids`) VALUES ('$q', '$opt1', '$opt2', '$opt3', '$opt4', '$currect', '$date_time', '$setter', '$asdf0')";
if (mysqli_query($db,$sql)) {
	$success += 1;
} else {
	$failed += 1;
}
}
}

echo "Successfuly Added ".$success." Questions of ".$cout.". Failed : ".$failed;


 ?>