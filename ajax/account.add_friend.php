<?php 
session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
	echo "Login and Try again.";
	exit();
}
$me = $_SESSION['login_data_paipixel24'];
$user = $_POST['user'];
if ($user==$me) {
	echo "It's You";
	exit();
}
include 'db.php';
$sql = "SELECT * FROM user WHERE user_name='$user'";
$mysql = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysql);
$friend = $row['friend'];
$fr_rq = $row['fr_rq'];
$friend = explode(",", $friend);
for ($i=0; $i < count($friend); $i++) { 
	if ($friend[$i]==$me) {
		echo "You are already Friends.";
		exit();
	}
}
$frrq = $row['fr_rq'];
$fr_rq = explode(",", $frrq);
for ($i=0; $i < count($fr_rq); $i++) { 
	if ($fr_rq[$i]==$me) {
		echo "You already Send Friend Request.";
		exit();
	}
}
$sql ="";

	$add = $frrq.",".$me;
	$sql = "UPDATE user SET fr_rq='$add' WHERE user_name='$user'";

if(mysqli_query($db,$sql)){
	echo "Friend Request Sent";
} else {
	echo "Failed to sent request";
}
?>