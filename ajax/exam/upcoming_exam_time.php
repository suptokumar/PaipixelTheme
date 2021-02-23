
<?php 
include '../extra/db.extra.php';
$row = $_POST['date'];
session_start();
$ex = $_POST['exam'];
$user05 = user_detail("user_name"); 
$rs = "SELECT * FROM `exam_reg` WHERE `exam` = '$ex' AND `user`='$user05'";
$d = mysqli_query($db,$rs);
$nu = mysqli_num_rows($d);
date_default_timezone_set("Asia/Dhaka");
$sql = "SELECT * FROM question WHERE exam_id = '$ex' AND pending=1";
$q = mysqli_query($db,$sql);
$m = mysqli_fetch_array($q);
$main_time = strtotime($row);
// $main_time = strtotime($m['exam_starting_date']);
$exam_time = ($main_time) + (($m['exam_duration'])*60);
$now_time = strtotime(date("Y-m-d H:i:s"));

if ($main_time <= $now_time && $now_time <= $exam_time) {
	if (has_registry($ex)) {
	?>
<button onclick="window.location='<?php get_domain("/") ?>exam.php?exam=<?php echo $ex; ?>'" class="button button_standard more_button">Join Exam</button>
<div class="pre_date" style="margin-top: 10px">
Exam Started
</div>
<?php
} else {
	?>
<script>
	document.getElementById('asddfff<?php echo $ex; ?>').style.display='none';
</script>
<?php
}
} else {
?>
	<button href="javascript:void(0)" <?php if($nu==0){ ?>
onclick="register_exam('<?php echo $ex ?>',this);"

		<?php } else { ?>
onclick="cancel_reg_exam('<?php echo $ex ?>',this);"

		<?php } ?> class="button button_standard more_button"><?php if($nu==0){ echo "Register";} else {echo "Cancel Registration"; } ?></button>
<div class="pre_date" style="margin-top: 10px; font-size: 12px">
<?php 
echo def_time($row);
if ($now_time >= $exam_time) {
	?>
<script>
	document.getElementById('rt<?php echo $ex; ?>').style.display='none';
</script>
	<?php
}
?>
</div>
		<?php }
?>