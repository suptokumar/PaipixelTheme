<?php 
$db = mysqli_connect("localhost","paipixel_supto","Sk571960","paipixel_real") OR die("no connectiong available.");
include '../functions.php';
$id = $_POST['id'];
$sql = "SELECT SUM(vote) FROM `blog_vote` WHERE question_id='$id'";
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
<?php echo $i ?></span><?php  mysqli_close($db); ?>