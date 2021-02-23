<?php 
session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
	echo "Login and Try again.";
	exit();
}
$me = $_SESSION['login_data_paipixel24'];
$user = $_POST['user'];

include 'db.php';
$sql = "SELECT * FROM user WHERE user_name='$user'";
$mysql = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysql);
$friend = $row['friend'];
$fr_rq = $row['fr_rq'];


$remove = ",".$me;
$new_data = str_replace($remove, "", $fr_rq);

$sql = "UPDATE user SET fr_rq='$new_data' WHERE user_name='$user'";
if (mysqli_query($db,$sql)) {
	echo "Add Friend";
} else {
	echo "Server Problem";
}
?>