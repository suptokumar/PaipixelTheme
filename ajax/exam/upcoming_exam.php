<?php 
include '../extra/db.extra.php';
$row = $_POST['date'];
session_start();
$exam = $_POST['exam'];
$user05 = user_detail("user_name"); 
$rs = "SELECT * FROM `exam_reg` WHERE `exam` = '$exam' AND `user`='$user05'";
$d = mysqli_query($db,$rs);
$nu = mysqli_num_rows($d);

date_default_timezone_set("Asia/Dhaka");
$sql = "SELECT * FROM question WHERE exam_id = '$exam' AND pending=1";
$q = mysqli_query($db,$sql);
$m = mysqli_fetch_array($q);
$main_time = strtotime($row);
// $main_time = strtotime($m['exam_starting_date']);
$exam_time = ($main_time) + (($m['exam_duration'])*60);
$now_time = strtotime(date("Y-m-d H:i:s"));

if ($main_time <= $now_time && $now_time <= $exam_time) {
	if (has_registry($exam)) {
	?>
	<span class="time_bar exam_register">Exam Started</span>

	<a href="<?php get_domain("/") ?>exam.php?exam=<?php echo $exam; ?>" class="time_bar exam_register">Join Exam</a>
<?php
} else {
	?>
	<span class="time_bar exam_register">Exam Started</span>
	<?php
}
} else {
	?>


<div style="font-family: arial">
	
</div>

<span class="time_bar exam_register"><?php echo def_time($row); ?></span>
<a href="javascript:void(0)" <?php if($nu==0){ ?>
onclick="register_exam('<?php echo $exam ?>',this);"

		<?php } else { ?>
onclick="cancel_reg_exam('<?php echo $exam ?>',this);"

		<?php } ?>  class="time_bar exam_register"><?php if($nu==0){ echo "Register";} else {echo "Cancel Reg."; } ?></a>
		<?php }

		if ($now_time >= $exam_time) {
			?>
<script>
	document.getElementById('ad<?php echo $exam; ?>').style.display='none';
</script>
			<?php
		}
?>