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

?>

 <h2>Exam Details <p style="font-family: tahoma">
<?php 
echo def_time($row);
if(($exam_time)-time() > 1){
if (has_registry($ex)) {
	echo '<div style="margin: 10px"><a href="'.return_domain("/exam.php?exam=".$ex).'" class="button button_standard">Join Exam</a></div>';
} else {
	echo '<div style="margin: 10px"><a href="'.return_domain("/exam.php?pre_exams&exam_id=".$ex).'" class="button button_standard">View Score</a></div>';
}
} else {
	echo '<div style="margin: 10px"><a href="'.return_domain("/exam.php?pre_exams&exam_id=".$ex).'" class="button button_standard">View Score</a></div>';
}
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
		<td>Starting Time</td>
		<td><?php echo date("h:ia, d M Y",strtotime($row['exam_starting_date'])); ?></td>
	</tr>
	<tr>
		<td>Ending Time</td>
		<td><?php echo date("h:ia, d M Y",strtotime($row['exam_starting_date'])+($row['exam_duration']*60)) ?></td>
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
