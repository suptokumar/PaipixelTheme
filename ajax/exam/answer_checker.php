<?php 
$question = $_POST['question'];
$answer = $_POST['answer'];
$time = $_POST['time'];
$page = $_POST['page'];
include '../extra/db.extra.php';
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$s = time()-$time;
$sql = "SELECT * FROM question WHERE id='$question' AND pending=1";
$m = mysqli_query($db,$sql);
$w = mysqli_fetch_array($m);
$may = $w['currect'];
$exam = $w['exam_id'];
$exam_starting_date = strtotime($w['exam_starting_date']);
$cur_time = time();

$spent = ($cur_time) - ($exam_starting_date);
$c = 0;
if ($answer==$may) {
	$c  = 1;
} else {
	$c = 0;
}

$score = 0;
session_start();
$p = user_detail("rating");
$user = user_detail("user_name");
if ($c==1) {
	$score = 1-($spent*0.0002);
	$sql = "INSERT INTO `score_leader_board` (`id`, `user_name`, `score`, `currect`, `total`, `date`) VALUES (NULL, '$user', '$score', 1, 1, '$date') ";
mysqli_query($db,$sql);
} else {
	$score = 0-($spent*0.0002);
	$sql = "INSERT INTO `score_leader_board` (`id`, `user_name`, `score`, `currect`, `total`, `date`) VALUES (NULL, '$user', '$score', 0, 1, '$date') ";
mysqli_query($db,$sql);
}
$sql = "INSERT INTO `exam_score` (`user`, `exam`, `question`, `answer`, `time`, `datetime`, `score`) VALUES ('$user', '$exam', '$question', '$answer', '$s', '$date', '$score')";
mysqli_query($db,$sql);

$sql = "INSERT INTO `exam_page` (`exam`, `user`, `page`) VALUES ('$exam', '$user', '$page')";
mysqli_query($db,$sql);


?>