<?php 
include '../extra/db.extra.php';
$as = ($_POST['i'])-1;
$cm_data = $_POST['cm_data'];
$team_data = $_POST['team_data'];
$sql = "SELECT * FROM team_exam_data WHERE data='$cm_data'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
date_default_timezone_set("Asia/Dhaka");
$time = strtotime($r['time']);

$d = time();

$def = (($d)-($time));
// echo date("H:i:s",$def);

$auto_mark = (5-($as));
$curs = 0;
$date = date("Y-m-d H:i:s");
session_start();
$user = user_detail("user_name");
$team = user_detail("team");
$data = '';
$tcur = 0;
if ($auto_mark!=0) {
	$score = $auto_mark-($def*0.001);
}



for ($i=0; $i < $as; $i++) { 
	if (isset($_POST['answer'.($i+1)])) {
		$ans = $_POST['answer'.($i+1)];
		$report = $_POST['report'.($i+1)];
		$report_about = $_POST['report_about'.($i+1)];
		$id = $_POST['id'.($i+1)];
		$sql = "SELECT * FROM `team_chal_qtn` WHERE id='$id'";
		$s = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($s);
		$question = $row['question'];
		$ans1 = $row['ans1'];
		$ans2 = $row['ans2'];
		$ans3 = $row['ans3'];
		$ans4 = $row['ans4'];
		$ct = $row['ct'];
		if ($ans==$ct) {
	$curss = 1-($def*0.0002);
	$curs += 1-($def*0.0002);
$tcur += 1;
} else {
	$curss = 0-($def*0.0002);
	$curs += 0-($def*0.0002);

}
$sql = "INSERT INTO `team_score` (`score`, `cm_id`, `date`, `user`,`team`, `chal`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `cur`, `ans`, `report`, `report_about`) VALUES ('$curss', '$cm_data', '$date', '$user','$team', '$team_data', '$question', '$ans1', '$ans2', '$ans3', '$ans4', '$ct', '$ans', '$report', '$report_about') ";

mysqli_query($db,$sql);

}

}
$score = ($curs+$auto_mark);

$sql = "INSERT INTO `team_score` (`score`, `cm_id`, `date`, `user`, `chal`, `question`) VALUES ('$auto_mark', '$cm_data', '$date', '$user', '$team_data', 'Auto Mark') ";

if (mysqli_query($db,$sql)) {
$sql = "UPDATE team_exam_data SET value='Finished' WHERE data='$cm_data'";
mysqli_query($db,$sql);
echo "Your Score: ". $score;
}
$sql = "INSERT INTO `score_leader_board` (`id`, `user_name`, `score`, `currect`, `total`, `date`) VALUES (NULL, '$user', '$score', '$tcur', '$as', '$date') ";
mysqli_query($db,$sql);
?>