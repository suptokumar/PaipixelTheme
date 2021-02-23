
<?php 
include '../ajax/db.php';
$profile = $_POST['profile'];
$me = $_POST['me'];
$sql = "SELECT id FROM user WHERE user_name='$me'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$me=$r[0];
// echo "$profile $me";
$sql = "SELECT * FROM msg WHERE (f_from='$profile' and f_to='$me') OR (f_from='$me' and f_to='$profile') ORDER BY id DESC LIMIT 1";
$q = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($q)) {
	if ($row['f_from']==$me) {
	$sql = "SELECT * FROM user WHERE id='$me'";
	$ms = mysqli_query($db,$sql);
	$so = mysqli_fetch_array($ms);
	$user_image=$so['image'];
	$user_fst_name=$so['first_name'];
		if ($user_image=='') {
			$user_image='img/user11.jpg';	
		}
		?>
		
You: <?php echo $row['msg']; ?>

		<?php
	}


	if ($row['f_from']==$profile) {
	$sql = "SELECT * FROM user WHERE id='$profile'";
	$ms = mysqli_query($db,$sql);
	$so = mysqli_fetch_array($ms);
	$user_fst_name=$so['first_name'];
	$user_image=$so['image'];
	$id_s = $row['id'];
		if ($user_image=='') {
		$user_image='img/user12.jpg';
		}

		?>
<?php echo $user_fst_name; ?>: <?php echo $row['msg']; ?>
<?php
}



}
?>

