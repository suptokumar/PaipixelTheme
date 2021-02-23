<?php 
include '../extra/db.extra.php';
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
$row = $m["exam_starting_date"];
$main_time = strtotime($row);
// $main_time = strtotime($m['exam_starting_date']);
$exam_time = ($main_time) + (($m['exam_duration'])*60);
$now_time = strtotime(date("Y-m-d H:i:s"));

if ($main_time <= $now_time && $now_time <= $exam_time) {
 ?>
<div class="full_border" style="text-align: center; padding: 1%">
	<h2>Hi <?php echo user_detail("user_name") ?></h2>
	<h2>Your Exam (<?php echo exam_info("Exam_name", $ex) ?>) Has Started.</h2>
<?php 
$mobile = "SELECT * FROM exam_page WHERE exam='$ex' AND user='$user05' ORDER BY id DESC LIMIT 1";
$mob = mysqli_query($db,$mobile);
$mo  = mysqli_fetch_array($mob);
if($mo['page']!=''){
?>
<h2><a href="javascript:void(0)" onclick="question_view('<?php echo ($mo['page'])+1 ?>','<?php echo $ex ?>')">View Question</a></h2>
<?php
} else {
?>
<h2><a href="javascript:void(0)" onclick="question_view(1,'<?php echo $ex ?>')">View Question</a></h2>

<?php 
}
?>
	<h2>The exam will end in <br><b><?php echo dir_time($exam_time); ?></b></h2>
</div>
 <?php
} else {
	if ($now_time > $exam_time) {
		?>

 <h2>Sorry, Your has exam Passed Away !</h2>

		<?php
	} else {
				?>

 <h2>Exam is starting <p style="font-family: tahoma">		<?php 
echo def_time($row);
		 ?></p></h2>

<?php
$sql= "SELECT * FROM question WHERE exam_id='$ex' AND pending=1";
$q = mysqli_query($db,$sql);
$total = mysqli_num_rows($q);
$row = mysqli_fetch_array($q);
?>
<style>
	.pd tr td,.pd tr th{
		padding: 1%;
	}
</style>
<table class="data_table table_hoverable pd" style="max-width: 400px; margin: 0 auto;">
	<tr>
		<th>Title</th>
		<th>Descriptions</th>
	</tr>
	<tr>
		<td>Exam Name</td>
		<td><?php echo $row['Exam_name'] ?></td>
	</tr>
	<tr>
		<td>Total Question</td>
		<td><?php echo $total ?></td>
	</tr>
	<tr>
		<td>Exam Duration</td>
		<td><?php echo $row['exam_duration'] ?></td>
	</tr>
	<tr>
		<td>Starting Time</td>
		<td><?php echo $row['exam_starting_date'] ?></td>
	</tr>
	<tr>
		<td>Ending Time</td>
		<td><?php echo $row['exam_ending_date'] ?></td>
	</tr>
	<tr>
		<td>Question Setter</td>
		<td><?php echo $row['setter'] ?></td>
	</tr>
	<tr>
		<td>Total Register</td>
		<?php 
$user = user_detail("user_name");
		$sql = "SELECT * FROM exam_reg WHERE exam = '$ex'";
		$g = mysqli_query($db,$sql);
		$s = mysqli_num_rows($g);
		?>
		<td><?php echo $s ?></td>
	</tr>
	<tr>
		<td>Class</td>
		<td><?php echo $row['class'] ?></td>
	</tr>
	<tr>
		<td>Subject</td>
		<td><?php echo $row['subject'] ?></td>
	</tr>
	<tr>
		<td>Chapter</td>
		<td><?php echo $row['chapter'] ?></td>
	</tr>
	
</table>

		<?php
	}
}

 ?>