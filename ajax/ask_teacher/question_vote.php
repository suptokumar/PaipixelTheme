<?php 
include '../extra/db.extra.php';
$id = $_POST['id'];
$sql = "SELECT SUM(vote) FROM `question_like` WHERE question_id='$id'";
$m = mysqli_query($db,$sql);
$row = mysqli_fetch_array($m);
if ($row[0]=='') {
	$i = 0;
}else {
	$i = $row[0];
}
?>
<span style="color: green">
<?php
if ($i>0) {
	echo "+";
}

?>
<?php echo $i ?></span>