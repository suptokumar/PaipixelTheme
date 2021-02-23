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
$main = "SELECT * FROM user WHERE user_name='$me'";
$f = mysqli_query($db,$main);
$row = mysqli_fetch_array($f);
$friend = $row['friend'].','.$user;

$main = "SELECT * FROM user WHERE user_name='$user'";
$ds = mysqli_query($db,$main);
$ds = mysqli_fetch_array($ds);
$friend2 = $ds['friend'].','.$me;


$sql = "UPDATE user SET friend='$friend' WHERE user_name='$me'";
if(mysqli_query($db,$sql)){
	echo "Done";
	$fr_rq = $row['fr_rq'];
	$r = ",".$user;
	$refresh = str_replace($r, "", $fr_rq);
	$sql = "UPDATE user SET fr_rq='$refresh' WHERE user_name='$me'";
	mysqli_query($db,$sql);
	$sql = "UPDATE user SET friend='$friend2' WHERE user_name='$user'";
	mysqli_query($db,$sql);
$content = "<a href='".return_domain("/profile/".$me)."'><b>$me</b></a> accepted your friend request.";
	send_notification($user,"",$content);
} else {
	echo "Failed to sent request";
}
?>