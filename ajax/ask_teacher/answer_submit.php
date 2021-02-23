<?php 
include '../extra/db.extra.php';
$id = $_POST['id'];
$content = $_POST['content'];
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
session_start();
$user= user_detail("user_name");
$sql = "INSERT INTO `ans_ask` (`id`, `question`, `content`, `datetime`, `accept`, `parent`, `user`) VALUES (NULL, '$id', '$content', '$date', '0', '0', '$user') ";
mysqli_query($db,$sql);
$sql = "SELECT * FROM ask_teacher WHERE id='$id'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$owner = $r['user'];
$link = return_domain("/full_question.php?id=".$id);
$question = $r['question'];
$tssss = str_replace("'","\'",my_name($user));
if (more_user("role",$user)==2) {
	$tssss = $user;
}
$content = "<a href=\"".return_domain("/profile/".$user)."\"><b>".$tssss."</b></a> answered/replied to your question <b><a href=\"".return_domain("/full_question.php?id=".$id)."\">".$question."</a></b>";

send_notification($owner,$link,$content);
?>