<?php 
include 'db.php';
$id=$_POST['id'];
$sql = "UPDATE announce SET pending=2 WHERE id='$id'";
mysqli_query($db,$sql);
?>