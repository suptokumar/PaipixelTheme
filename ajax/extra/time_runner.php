<?php 
include 'db.extra.php';
$time = $_GET['time'];
date_default_timezone_set("Asia/Dhaka");
$d = time();
$s = strtotime($time);
$h = $s + 86400;
if (($h-$d) < 0) {
	echo "Exam Finished";
	exit();
}
if (($s-$d) < 0) {
	echo "Exam Started";
	exit();
}
echo def_time($time);
?>