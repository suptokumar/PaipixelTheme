<?php 
include '../extra/db.extra.php';
date_default_timezone_set("Asia/Dhaka");
session_start();
$user = user_detail("user_name");
$id = $_POST['id'];
$user1 = $_POST['user1'];
$team1 = more_user("team",$_POST['user1']);
$type = $_POST['type'];
$user2 = $_POST['user2'];
$team2 = more_user("team",$_POST['user2']);
$chal = $_POST['chal'];
$date = date("Y-m-d H:i:s");
$sql ="INSERT INTO `report_vote` (`id`, `user1`, `user2`, `chal`, `score_id`, `team1`, `team2`, `voting_user`, `date`, `type`) VALUES (NULL, '$user1', '$user2', '$chal', '$id', '$team1', '$team2', '$user', '$date', '$type')";
mysqli_query($db,$sql);
?>