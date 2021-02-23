<?php 
$role = $_POST['select_role'];
$user = $_POST['user'];
$team = $_POST['team'];
include '../extra/db.extra.php';
session_start();
$me = user_detail("user_name");
$pre_role = more_user("position_in_team",$user);
if ($role=='Leader') {
	$sql  = "UPDATE user SET position_in_team='Co-Leader' WHERE team='$team' AND user_name='$me'";
$q = mysqli_query($db,$sql);
$content1 = "You have changed <a href='".return_domain("/profile/").$user."'><b>".my_name($user)."</b>'s</a> role in team. Now he is a Leader and You are a Co-Leader of Your Team.";
send_notification($me,"",$content1);
}
$sql  = "UPDATE user SET position_in_team='$role' WHERE team='$team' AND user_name='$user'";
$q = mysqli_query($db,$sql);


$content1 = "<a href='".return_domain("/profile/").$me."'><b>".my_name($user)."</b></a> changed your role in team. Now you are $b of <a href='".return_domain("/team/").$team."'>".get_team($team)."</b></a>";
send_notification($user,"",$content1);
?>