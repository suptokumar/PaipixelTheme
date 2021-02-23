<?php 
include '../extra/db.extra.php';
$id = $_POST['id'];
$sql = "UPDATE ans_ask SET accept='1' WHERE id='$id'";
mysqli_query($db,$sql);

$sql = "SELECT * FROM ans_ask WHERE id='$id'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$ques = $r["question"];
$user = $r["user"];
$sql = "SELECT * FROM `ask_teacher` WHERE id='$ques'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$owner = $r["user"];
date_default_timezone_set("Asia/Dhaka");
$date =date("Y-m-d H:i:s");
if ($r['post_type']=='Premium') {
	$sql = "INSERT INTO `noti_provide_ans` (`id`, `question`, `answer`, `owner`, `provider`, `feedback`, `full`, `datetime`) VALUES (NULL, '$ques', '', '$owner', '$user', '', '0', '$date') ";
	mysqli_query($db,$sql);
	$link = return_domain("/full_question.php?id=".$ques);
	$content = "<a href='".return_domain("/profile/".$owner)."'>".my_name($owner)."</a> accepted your proposal to answer his question,<a href='".return_domain("/full_question.php?id=".$ques)."' style='font-weight: bold;'><b>".get_question($ques,"question")."</b></a>. Go to Assigned Question and try to upload the answer as soon as posible.";
	send_notification($user,$link,$content);
}
?>