<?php 
session_start();
$me = $_SESSION['login_data_paipixel24'];
$user = $_POST['user'];
include 'db.php';
$sql = "SELECT * FROM user WHERE user_name='$me'";
$mysql = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysql);
$friend = $row['friend'];
$rq = str_replace(",".$user, "", $friend);
$sql = "UPDATE user SET friend='$rq' WHERE user_name='$me'";
if (mysqli_query($db,$sql)) {
	echo "Add Friend";
	$sql = "SELECT * FROM user WHERE user_name='$user'";
$mysql = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysql);
$friend = $row['friend'];
$rq = str_replace(",".$me, "", $friend);
	$sql = "UPDATE user SET friend='$rq' WHERE user_name='$user'";
if (mysqli_query($db,$sql)) {
	
}

}


?>