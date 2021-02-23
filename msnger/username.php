<?php 
$id = $_POST['user'];
include '../ajax/db_back.php';
$sql = "SELECT * FROM user WHERE id='$id'";
$r = mysqli_query($db,$sql);
$row = mysqli_fetch_array($r);
echo $row['first_name']." ".$row['last_name'];
?>