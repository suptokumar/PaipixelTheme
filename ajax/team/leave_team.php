<?php 
$team = $_POST['team'];
$user = $_POST['user'];
include '../extra/db.extra.php';
$sql = "UPDATE user SET team='',position_in_team='' WHERE user_name='$user'";
mysqli_query($db,$sql);
session_start();
if ($user!=user_detail("user_name")) {
	$kickouter = user_detail("user_name");
	$content1 = "you have been kicked out by <a href='".return_domain("/profile/").$kickouter."'><b>".my_name($kickouter)."</b></a>.";
send_notification($user,"",$content1);

}
?>