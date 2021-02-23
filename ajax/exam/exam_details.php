<?php 
include '../extra/db.extra.php';
$exam = $_POST['exam'];
$sql= "SELECT * FROM question WHERE exam_id='$exam' AND pending=1";
$q = mysqli_query($db,$sql);
$total = mysqli_num_rows($q);
$row = mysqli_fetch_array($q);
date_default_timezone_set("Asia/Dhaka");
?>
<style>
	.pd tr td,.pd tr th{
		padding: 1%;
	}
</style>
<table class="data_table table_hoverable pd">
	<tr>
		<th>Title</th>
		<th>Descriptions</th>
	</tr>
	<tr>
		<td>Exam Name</td>
		<td><?php echo $row['name'] ?></td>
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
		<td>Exam Starting</td>
		<td><?php echo $row['exam_starting_date'] ?></td>
	</tr>
	<tr>
		<td>Exam Ending</td>
		<td><?php echo date("Y-m-d H:i:s",strtotime($row['exam_starting_date'])+($row['exam_duration']*60)); ?></td>
	</tr>
	<tr>
		<td>Question Setter</td>
		<td><?php echo $row['setter'] ?></td>
	</tr>
	<tr>
		<td>Total Register</td>
		<?php 
session_start();
$user = user_detail("user_name");
		$sql = "SELECT * FROM exam_reg WHERE exam = '$exam'";
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