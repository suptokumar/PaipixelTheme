<?php 
$db = mysqli_connect("localhost","paipixel_supto","Sk571960","paipixel_real") OR die("no connectiong available.");
include '../functions.php';
$id = $_POST['id'];
session_start();
$user = user_detail("user_name");
$sql = "SELECT * FROM `blog_comment` WHERE id='$id'";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);
$owner = $row['user'];
if ($user=="Nothing") {
echo "Please Login to Vote.";
	exit();
}
if ($user==$owner) {
echo "You can't vote your content.";
exit();
}
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$sql = "SELECT * FROM `blog_cm_like` WHERE question_id='$id' AND user='$user'";
$m  = mysqli_query($db,$sql);
$n = mysqli_num_rows($m);
if ($n==0) {
$sql = "INSERT INTO `blog_cm_like` (`id`, `user`, `question_id`, `vote`, `datetime`) VALUES (NULL, '$user', '$id', '1', '$date')";
mysqli_query($db,$sql);
$sql = "UPDATE user SET cc=cc+1 WHERE user_name='$owner'";
mysqli_query($db,$sql);
} else {
	echo "You've already Voted it.";
}

?><?php  mysqli_close($db); ?>