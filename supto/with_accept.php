<?php 

include '../functions.php';
include '../ajax/db_back.php';
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");
$id = $_POST['id'];

$sql = "UPDATE withdraw SET status='Approved', date2='$date' WHERE id='$id'";
mysqli_query($db,$sql);

$sql = "SELECT * FROM withdraw WHERE id='$id'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$user = $r['user'];
$amount = $r['amount'];
$phone = $r['phone'];
$content = "Your withdrawal amount BDT $amount is successfully sent to $phone.";
send_notification($user,"",$content);
?>