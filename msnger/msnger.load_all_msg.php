<?php 
include '../ajax/db.php';
$profile = $_POST['profile'];
$me = $_POST['me'];
$sql = "SELECT id FROM user WHERE user_name='$me'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$me=$r[0];
$sql = "SELECT * FROM msg WHERE (f_from='$me' and f_to='$profile') OR (f_from='$profile' and f_to='$me') ORDER BY id";
$agh = mysqli_query($db,$sql);
$eo = mysqli_num_rows($agh);
if (isset($_POST['page'])) {
	$page = $_POST['page'];
}
else {
	$page =1;
}
$limit = 25;

$back = ($eo)-($limit*$page);
if ($back<0) {
	$back = 0;
}
if ($back!=0) {
	?>
<a href="javascript:void(0)" id="rand<?php echo $dono = rand(); ?>" style="display: block; color: black; text-align: center;padding: 10px" onclick="prev_load('<?php echo ($page+1) ?>','<?php echo $profile ?>','<?php echo $me ?>','<?php echo $dono ?>')">Load Previous Messages</a>
	<?php
}
$sql = "SELECT * FROM msg WHERE (f_from='$me' and f_to='$profile') OR (f_from='$profile' and f_to='$me') ORDER BY id ASC LIMIT $back,$limit";
$q = mysqli_query($db,$sql);
if (mysqli_num_rows($q) != 0) {
	
while ($row = mysqli_fetch_array($q)) {
	$id= $row['id'];
	$sql = "UPDATE msg SET readed='1' WHERE id='$id'";
	mysqli_query($db,$sql);
	if ($row['f_from']==$me) {
	$sql = "SELECT * FROM user WHERE id='$me'";
	$ms = mysqli_query($db,$sql);
	$so = mysqli_fetch_array($ms);
	$user_image=$so['image'];
	$user_fst_name=$so['first_name'];
	$classes_t = "msnger_own_port";
		if ($user_image=='') {
			$user_image='img/user11.jpg';	
		}
	}


	if ($row['f_from']==$profile) {
	$sql = "SELECT * FROM user WHERE id='$profile'";
	$ms = mysqli_query($db,$sql);
	$so = mysqli_fetch_array($ms);
	$user_fst_name=$so['first_name'];
	$classes_t = "msnger_off_port";
	$user_image=$so['image'];
		if ($user_image=='') {
		$user_image='img/user12.jpg';
		}

}

?>

<div class="<?php echo $classes_t; ?>"><img src="<?php echo $user_image; ?>" alt="<?php echo $user_fst_name; ?>" /><span class="text"><?php echo $row['msg']; ?></span></div>


<?php

}
?>
<?php 

} else {
	echo '<div class="log">Start The New Message</div>';
}

?>