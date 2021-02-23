<?php 
include '../extra/db.extra.php';
$sql = "SELECT * FROM question GROUP BY exam_id AND pending=1 ORDER BY id DESC LIMIT 20";
if (isset($_SESSION['login_data_paipixel24'])) {
	$class = user_detail("class");
	$sql = "SELECT * FROM question WHERE class='$class' AND pending=1 GROUP BY exam_id ORDER BY id DESC LIMIT 20";
}
$q = mysqli_query($db,$sql);

?>
<style>
	@media(max-width: 500px)
	{
		.to_min500 {
			display: none;
		}
		.data_table {
			font-size: 10px;
		}
		.button_standard {
			font-size: 10px;
		}
		.table.data_table td {
			padding: 0px
		}
		.table.data_table th {
			padding: 0px
		}
	}
</style>


<h2 class="heading_title">Current exams
			<?php 
session_start();
if (user_detail("power")==1) {
	?>
<a style="float:right" href="<?php get_domain("/") ?>exam.php?add_question" target="_blank" class="button active">Add Questions</a>
	<?php
}
	?></h2><br>
<table class="data_table func_table table_hoverable">
<tr>
	<th>Exam Name</th>
	<th class="to_min500">Question Setter</th>
	<th>Class</th>
	<th class="to_min500">Number of Questions</th>
	<th>Duration</th>
	<th>Ending Time</th>
	<th>Options</th>
</tr>
<?php
$r=0;
while ($row = mysqli_fetch_array($q)) {
	$starting_time = $row['exam_starting_date'];
	$exam_duration = $row['exam_duration'];
	date_default_timezone_set("Asia/Dhaka");
	$exam_ending_date = strtotime($starting_time)+$exam_duration*60;
	$time = time();
	if ($exam_ending_date>=$time && (intval(strtotime($starting_time))<=intval($time))) {
		
	?>
<tr style="font-family: cursive;" id="rt<?php echo $row['exam_id']; ?>">
	<td><a href="javascript:void(0)" onclick="exam_details('<?php echo $row['exam_id']; ?>')"><?php echo $row['Exam_name'] ?></a></td>
	<td class="to_min500"><?php echo $row['setter']; ?></td>
	<td><?php echo $row['class'] ?></td>
	<td class="to_min500"><?php 
$ex = $row['exam_id'];
	$e = "SELECT * FROM question WHERE exam_id = '$ex' AND pending=1";
	$s = mysqli_query($db,$e);
	echo mysqli_num_rows($s); ?></td>
<?php 
$user05 = user_detail("user_name"); 
$rs = "SELECT * FROM `exam_reg` WHERE exam = '$ex' AND user='$user05'";
$d = mysqli_query($db,$rs);
$nu = mysqli_num_rows($d);
	?>
	<td><?php echo $row['exam_duration'] ?> Min</td>
	<td><?php echo date("d M Y, h:i a", $exam_ending_date); ?></td>
	

	<td style="padding: 10px">
<div id="d<?php echo $ex ?>">
<?php 
if (has_registry($ex)) {
	?>
		<button href="javascript:void(0)" onclick="window.location='exam.php?exam=<?php echo $ex ?>'" class="button button_standard more_button">Join Exam</button>
	<?php 
} else {
	?>
		<button href="javascript:void(0)" onclick="view_result('<?php echo $ex ?>',this);" class="button button_standard more_button">View Result</button>

	<?php
}
?>
</div>

	</td>
	
</tr>

	<?php
	$r++;
	}
}
if ($r==0) {
	?>
<tr>
<td colspan="7" id="d4d84f110" style="text-align: center; column-span: 7">No Current exams</td>

</tr>
	<?php
}
?>
</table>



