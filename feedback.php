<?php 
include 'ajax/db_back.php';
include 'functions.php';
$id = $_POST['id'];
$rate = $_POST['rate'];
$feedback = $_POST['feedback'];
if ($rate!=1) {
	$sql = "SELECT * FROM noti_provide_ans WHERE id='$id'";
	$m = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($m);
	$prov = $r['provider'];
	$question = $r['question'];
	$amount  = get_question($question,"price");
	$qut  = get_question($question,"question");
	$user  = get_question($question,"user");
	$sql = "SELECT balance FROM user WHERE  user_name='$prov'";
	$m = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($m);
	$bal = $r[0];
	$new_bal = $bal+(floor($amount*0.8));
	$sql = "UPDATE user SET balance='$new_bal' WHERE user_name='$prov'";
	mysqli_query($db,$sql);
	$content = "<a href='".return_domain("/profile/".$user)."'><b>".my_name($user)."</b></a> rated $rate out of 5 for your answer on <a href='".return_domain("/full_question.php?id=".$question)."'><b>".$qut."</b>.</a> <a href='".return_domain("/profile/".$user)."'><b>".my_name($user)."'s</b></a> feedback is: <em>".$feedback."</em>. <b>BDT $new_bal</b> is successfully added to your account.";
send_notification($prov,"",$content);
}
$sql = "UPDATE noti_provide_ans SET feedback='$rate', feed_back_text='$feedback' WHERE id='$id'";
mysqli_query($db,$sql);



?>