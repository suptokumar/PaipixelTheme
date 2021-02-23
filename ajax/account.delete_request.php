<?php 
session_start();
$me = $_SESSION['login_data_paipixel24'];
$user = $_POST['user'];
include 'db.php';
$sql = "SELECT * FROM user WHERE user_name='$me'";
$mysql = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysql);
$fr_rq = $row['fr_rq'];
$rq = str_replace(",".$user, "", $fr_rq);
$sql = "UPDATE user SET fr_rq='$rq' WHERE user_name='$me'";
if (mysqli_query($db,$sql)) {
	echo "Removed";
}

?>