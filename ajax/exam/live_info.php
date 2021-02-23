
<?php 
include '../extra/db.extra.php';
$ex  = $_POST['exam'];
date_default_timezone_set("Asia/Dhaka");
$sql = "SELECT * FROM question WHERE exam_id = '$ex' AND pending=1";
$q = mysqli_query($db,$sql);
$m = mysqli_fetch_array($q);
$s = $m["exam_starting_date"];
$main_time = strtotime($s);
$exam_time = ($main_time) + (($m['exam_duration'])*60);
session_start();
$rate = user_detail("rating");
?>
<?php if (dir_time($exam_time)=='Exam Has Finished') {
	?>
<p style="color: green">
	Result Published !
<style>
	.exam_box {
		display: none;
	}
</style>
<?php 


$sql = "SELECT * FROM exam_reg WHERE exam = '$ex'";
$g = mysqli_query($db,$sql);
while ($s = mysqli_fetch_array($g)) {
	$user = $s['user'];
$sql ="SELECT * FROM rating_board WHERE exam='$ex' AND user='$user'";
$q = mysqli_query($db,$sql);
if (mysqli_num_rows($q)==0) {
$pre_rate = more_user("rating",$user);
if (more_user("isnew",$user)==0) {
	$pre_rate = 3500;
}
$sql = "SELECT SUM(score) FROM exam_score WHERE exam='$ex' AND user='$user'";
$q = mysqli_query($db,$sql);
$m = mysqli_fetch_array($q);
$score = floatval($m[0]);

$sql = "SELECT * FROM question WHERE exam_id='$ex' AND pending=1";
$asdf = mysqli_query($db,$sql);
$r = mysqli_num_rows($asdf);

$score100 = (($score)/($r))*100;
$expected_score = (($pre_rate)/100);
$actual_score = $score100;
$score_def = (($actual_score)-($expected_score));


if ($pre_rate<1000) {
	$c = ($pre_rate) + floor(($score_def)*0.4);
} else if($pre_rate>=1000 && $pre_rate<2000){
	$c = ($pre_rate) + floor(($score_def)*3.5);
} else if($pre_rate>=2000 && $pre_rate<3000){
	$c = ($pre_rate) + floor(($score_def)*3);
}
 else if($pre_rate>=3000 && $pre_rate<4000){
	$c = ($pre_rate) + floor(($score_def)*2.8);
}
 else if($pre_rate>=4000 && $pre_rate<5000){
	$c = ($pre_rate) + floor(($score_def)*2.5);
}
 else if($pre_rate>=5000 && $pre_rate<6000){
	$c = ($pre_rate) + floor(($score_def)*2.3);
}
 else if($pre_rate>=6000 && $pre_rate<7000){
	$c = ($pre_rate) + floor(($score_def)*2.1);
}
 else if($pre_rate>=7000 && $pre_rate<8000){
	$c = ($pre_rate) + floor(($score_def)*1.9);
}
 else if($pre_rate>=8000 && $pre_rate<9000){
	$c = ($pre_rate) + floor(($score_def)*1.6);
} else {
	$c = ($pre_rate) + floor(($score_def)*1);
}

$new_date = date("Y-m-d H:i:s");
$sql = "INSERT INTO `rating_board` (`exam`, `user`, `pre_rating`, `now_rating`, `date`) VALUES ('$ex', '$user', '$pre_rate', '$c', '$new_date')";
if (more_user("isnew",$user)==0) {
$sql = "INSERT INTO `rating_board` (`exam`, `user`, `pre_rating`, `now_rating`, `date`) VALUES ('$ex', '$user', 'Unrated', '$c', '$new_date')";
}
if (mysqli_query($db,$sql)) {
	$max_rate = more_user("max-rate",$user);
	if ($max_rate<$c) {
		$max_rate = $c;
	}
	$sql = "UPDATE user SET rating='$c',isnew='1',`max-rate`='$max_rate' WHERE user_name='$user'";
	mysqli_query($db,$sql);
}
}
}

?>
</p>
	<?php
	exit();
} ?>
<p style="color: red">
	Exam will be end in:
</p>
<h2><?php echo dir_time($exam_time); ?></h2>
