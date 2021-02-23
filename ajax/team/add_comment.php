<?php 
include '../extra/db.extra.php';
session_start();
$user = $_SESSION['login_data_paipixel24'];
$team = $_GET['team'];
$msg = $_GET['msg'];
$msg = str_replace(array("<",">"), array("&lt;","&gt;"), $msg);
date_default_timezone_set("Asia/Dhaka");
$datetime = date("Y-m-d H:i:s");
$show_time = date("d M Y, h:i a");
$sql = "INSERT INTO `team_comments` (`id`, `team`, `user`, `comment`, `datetime`, `show_time`) VALUES (NULL, '$team', '$user', '$msg', '$datetime', '$show_time')";
mysqli_query($db,$sql);
?>