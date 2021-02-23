<?php 
include 'db.php';
$id=$_POST['id'];
$sql = "UPDATE announce SET pending=1 WHERE id='$id'";
mysqli_query($db,$sql);
?>