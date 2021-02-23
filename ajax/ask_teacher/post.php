<?php 
include '../extra/db.extra.php';
$content = $_POST['content'];
$subject = $_POST['subject'];
$questions = $_POST['questions'];
if (isset($_POST['chapter'])) {
$chapter = $_POST['chapter'];
}else {
	$chapter = '';
}
session_start();
$user = user_detail("user_name");
$class = user_detail("class");
$type = $_POST['radio-1'];
if ($type=='Premium') {
$deal = $_POST['radio-2'];
$price = $_POST['price'];
} else {
$deal = '';
$price = 0;
}
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$sql = "INSERT INTO `ask_teacher` (`id`, `content`, `post_type`, `need_deal`, `date_time`, `price`, `user`, `class`, `subject`, `chapter`, `question`) VALUES (NULL, '$content', '$type', '$deal', '$date', '$price', '$user', '$class', '$subject', '$chapter', '$questions')";
if (mysqli_query($db,$sql)) {
	$sql = "SELECT id FROM ask_teacher ORDER BY id DESC LIMIT 1";
	$m = mysqli_query($db,$sql);
	$f = mysqli_fetch_array($m);
	$link = $f[0];
	echo "<div class='box_edon'><h2 style='text-align: center;' class='e10fd'>Successfuly Question Added !</h2><div> <a href='".return_domain("/full_question.php?id=$link")."' class='ullink eo'>View Question</a></div>";
} else {
	echo "Sorry Failed To add The Question.";
}
?>