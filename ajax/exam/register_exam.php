<?php 
include '../extra/db.extra.php';

$exam = $_POST['exam'];

$sql = "SELECT * FROM question WHERE exam_id='$exam' AND pending=1";
$q= mysqli_query($db,$sql);
$row = mysqli_fetch_array($q);
date_default_timezone_set("Asia/Dhaka");
$stdate = $row['exam_starting_date'];
$nowdate = date("Y-m-d H:i:s");

$start = strtotime($stdate);
$current = strtotime($nowdate);
session_start();
if (!isset($_SESSION['login_data_paipixel24'])) {
echo "Login Error !";	
exit();
}
$user = $_SESSION['login_data_paipixel24'];

$balance = user_detail("balance");
if ($balance<1) {
	echo '<h1 style="text-align: center;">Sorry !</h1>';
	echo '<h2 style="text-align: center;">You don\'t have enough Exams. <br><a href="'.return_domain("/buy.php").'" style="color: #009cdb">Buy Exam Now</a></h2>';
	exit();
}
if ($start <= $current) {
	echo "Registration Times Up !";
} else {
	$b = "INSERT INTO `exam_reg`(`user`, `exam`, `date`) VALUES ('$user','$exam','$nowdate')";
	if (mysqli_query($db,$b)) {
	echo "<h3>Successfully Registered.</h3>";
	}

	$sql = "UPDATE user SET balance=balance-1 WHERE user_name='$user'";
	mysqli_query($db,$sql);

	echo "</br> <h3>Your Remaining exams: ".user_detail("balance")."</h3>";
}
?>