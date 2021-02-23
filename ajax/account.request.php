<?php 
include 'db.php';
$id = $_POST['id'];
$class = $_POST['class'];
$school = $_POST['school'];
$cause = $_POST['cause'];
date_default_timezone_set("Asia/Dhaka");
$date_time = date("d M Y, h:i a");
$datetime = date("Y-m-d H:i:s");
$sql = "SELECT * FROM user WHERE id='$id'";
$q = mysqli_query($db,$sql);
$s = mysqli_fetch_array($q);
$user_name = $s['user_name'];
$sql = "INSERT INTO `request` (`id`, `user_name`, `class`, `Institution`, `cause`, `datetime`, `date_time`) VALUES (NULL, '$user_name', '$class', '$school', '$cause', '$datetime', '$date_time')";
if(mysqli_query($db,$sql)){
echo "Successfuly Changed.";
} else {
echo "Failed to Change.";
}
?>