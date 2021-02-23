<?php 
include 'db.extra.php';
$time = $_GET['time'];
date_default_timezone_set("Asia/Dhaka");
echo def_time($time);
?>