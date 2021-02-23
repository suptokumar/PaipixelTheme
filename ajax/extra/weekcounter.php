<?php 
include 'db.extra.php';
date_default_timezone_set("Asia/Dhaka");
$sql = "SELECT * FROM weektime ORDER BY id DESC LIMIT 1";
			$m = mysqli_query($db,$sql);
			$r = mysqli_fetch_array($m);
			$date = $r['date'];
			$time = strtotime($date)+3600*24*7;
$date =  date('Y-m-d H:i:s',$time);
echo dir_time($time);
?>