<?php 
if (isset($_POST['team'])) {
include '../extra/db.extra.php';
$name = $_POST['name'];
$s = $_POST['s'];
$team = $_POST['team'];
$subject = $_POST['subject'];
$chapter = $_POST['chapter'];
$member = $_POST['member'];
$class = $_POST['class'];
$datetime = $_POST['datetime'];
$class = str_replace("sc", "", $class);
$cl = explode(" ", $class);
$user = "";
for ($i=0; $i < count($cl); $i++) { 
	$user .= ",".$cl[$i];
}
$sql = "INSERT INTO `team_chal` ( `team`, `member`, `name`, `class`, `chapter`, `subject`, `date`) VALUES ('$team', '$user', '$name', '$s', '$chapter', '$subject', '$datetime')";
if (mysqli_query($db,$sql)) {
	echo "Successfully Added Team Challenge.";
} else {
	echo "Failed to Add Team Challenge.";
}
}
?><?php 
if (isset($_POST['id'])) {
include '../extra/db.extra.php';
$name = $_POST['name'];
$s = $_POST['s'];
$id = $_POST['id'];
$subject = $_POST['subject'];
$chapter = $_POST['chapter'];
$member = $_POST['member'];
$class = $_POST['class'];
$datetime = $_POST['datetime'];
$class = str_replace("sc", "", $class);
$cl = explode(" ", $class);
$user = "";
for ($i=0; $i < count($cl); $i++) { 
	$user .= ",".$cl[$i];
}

$sql = "UPDATE `team_chal` SET  `member` = '$user', `name` = '$name', `class` = '$s', `chapter` = '$chapter', `subject` = '$subject', `date` = '$datetime' WHERE `id` = $id ";

if (mysqli_query($db,$sql)) {
	echo "Successfully Updated Team Challenge.";
} else {
	echo "Failed to Update Team Challenge.";
}
}
?>