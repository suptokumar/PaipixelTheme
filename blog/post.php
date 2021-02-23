<?php 
include '../ajax/db_back.php';
include '../functions.php';
$content = $_POST['area'];
$header = $_POST['header'];
$class = $_POST['class'];
$subject = $_POST['subject'];
$chapter = $_POST['chapter'];
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
session_start();
$user = user_detail("user_name");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
	$sql = "UPDATE announce SET header='$header',class='$class',subject='$subject',chapter='$chapter', body='$content', datetime='$date', pending='0' WHERE id='$id'";
}else {
$sql  = "INSERT INTO `announce` (`id`, `header`, `body`, `datetime`, `pending`, `user`, `class`, `subject`, `chapter`) VALUES (NULL, '$header', '$content', '$date', '0', '$user', '$class', '$subject', '$chapter') ";
}
if (mysqli_query($db,$sql)) {
	if (isset($_POST['id'])) {
		echo "Successfully Updated !";
	}else {

	echo "Successfully added post !";
	}
} else {
	if (isset($_POST['id'])) {
		echo "Failed to Update this Post !";
	}else {
	echo "Failed to add this post !";
	}
}
?><?php  mysqli_close($db); ?>