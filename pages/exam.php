<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
			session_start();
} else {
	include 'ajax/db_back.php';
}
?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container" style="width: 99%; margin: 1% auto; max-width: 1400px;">
<div class="body_content content_area" style="width: 97.7%; padding: 1%">

<link rel="stylesheet" href="<?php get_domain("/css/table.css?s5.0gs") ?>">
<div class="ajax_sandi">

<?php 

$sql = "SELECT * FROM question WHERE  pending=1 GROUP BY exam_id ORDER BY id DESC LIMIT 20";
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
	<td><a href="javascript:void(0)" onclick="exam_details('<?php echo $row['exam_id']; ?>')"><?php echo $row['name'] ?></a></td>
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
<div id="e<?php echo $ex ?>">
<?php 
if (has_registry($ex)) {
	?>
		<button href="javascript:void(0)" onclick="window.location=" class="button button_standard more_button">Join Exam</button>
	<?php 
} else {
	?>
		<button href="javascript:void(0)" onclick="view_result('<?php echo $ex ?>',this);" class="button button_standard more_button">View Result</button>

	<?php
}
?>
</div>

	</td>




<!-- <script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/ajax/exam/upcoming_exam_time.php?version=") ?><?php echo rand(); ?>',
		type: 'POST',
		data: 'date=<?php echo $row['exam_starting_date']; ?>'+'&exam=<?php echo $row['exam_id']; ?>'
	})
	.done(function(data) {
		$("#e<?php echo $ex ?>").html(data);
	});
	
},1000);
</script> -->
	
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




	
</div>

<script>
setInterval(function(){
$.ajax({
	url: '<?php get_domain("/") ?>ajax/exam/ajax_sandi.php',
	type: 'POST',
})
.done(function(data) {
	$(".ajax_sandi").html(data);
});

},1500);
</script>





<?php 

$sql = "SELECT * FROM question WHERE exam_starting_date > CURRENT_TIME AND pending=1 GROUP BY exam_id ORDER BY id DESC LIMIT 20";
if (isset($_SESSION['login_data_paipixel24'])) {
	$class = user_detail("class");
	$sql = "SELECT * FROM question WHERE exam_starting_date>CURRENT_TIME AND pending=1 GROUP BY exam_id ORDER BY class,id DESC LIMIT 20";
}
$q = mysqli_query($db,$sql);

?>
<h2 class="heading_title">Upcoming exams</h2><br>
<table class="data_table func_table table_hoverable">
<tr>
	<th>Exam Name</th>
	<th class="to_min500">Question Setter</th>
	<th>Class</th>
	<th class="to_min500">Number of Questions</th>
	<th>Duration</th>
	<th>Starting Time</th>
	<th>Register</th>
</tr>
<?php
while ($row = mysqli_fetch_array($q)) {
	?>
<tr style="font-family: cursive;" id="asddfff<?php echo $row['exam_id']; ?>">
	<td><a href="javascript:void(0)" onclick="exam_details('<?php echo $row['exam_id']; ?>')"><?php echo $row['name'] ?></a></td>
	<td class="to_min500"><?php echo $row['setter'] ?></td>
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
	<td><?php echo date("d M Y, h:i a", strtotime($row['exam_starting_date'])); ?></td>
	

	<td style="padding: 10px">
<div id="e<?php echo $ex ?>">

		<button href="javascript:void(0)" onclick="register_exam('<?php echo $ex ?>',this);" class="button button_standard more_button"><?php if($nu==0){ echo "Register";} else {echo "Cancel Registration";} ?></button>
</div>

	</td>

		<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/ajax/exam/upcoming_exam_time.php?version=") ?><?php echo rand(); ?>',
		type: 'POST',
		data: 'date=<?php echo $row['exam_starting_date']; ?>'+'&exam=<?php echo $row['exam_id']; ?>'
	})
	.done(function(data) {
		$("#e<?php echo $ex ?>").html(data);
	});
	
},1000);
</script>
	
</tr>

	<?php
}
if (mysqli_num_rows($q)==0) {
	?>
<tr>
<td colspan="7" id="d4d84f110" style="text-align: center; column-span: 7">No upcoming exams</td>

</tr>
	<?php
}
?>
</table>







<?php 

$sql = "SELECT * FROM question WHERE exam_starting_date < CURRENT_TIME AND pending=1 GROUP BY exam_id ORDER BY id DESC LIMIT 20";
if (isset($_SESSION['login_data_paipixel24'])) {
	$class = user_detail("class");
	$sql = "SELECT * FROM question WHERE class='$class' AND exam_starting_date < CURRENT_TIME AND pending=1 GROUP BY exam_id ORDER BY id DESC LIMIT 20";
}
$q = mysqli_query($db,$sql);
?>


<h2 class="heading_title">Past exams</h2><br>
	<form action="" id="idon410000000" onsubmit="dno(1)">
		<input type="text" style="padding: 10px;" id="name" placeholder="Exam Name">
		<select name="class" id="class" style="padding: 10px;" onchange="get_subject('subject',this.value)">
			<option value=''>Select Class</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		<select name="subject" style="padding: 10px;" id="subject" onchange="get_subject('chapter',document.getElementById('class').value,this.value)">
			<option value="">Select Subject</option>
		</select>
		<select name="chapter" style="padding: 10px;" id="chapter">
			<option value="">Select Chapter</option>
		</select>
		<input type="submit" value="Filter" name="filter" id="filter" style="padding: 10px;" >
	</form>
	<script>
	function dno(page){
		event.preventDefault();
		var name = $("#name").val();
		var classs = $("#class").val();
		var subject = $("#subject").val();
		var chapter = $("#chapter").val();
	$.ajax({
		url: '<?php get_domain("/ajax/exam/passed_exam.php") ?>',
		type: 'POST',
		data: 'page='+page+'&name='+name+'&class='+classs+'&subject='+subject+'&chapter='+chapter,
	})
	.done(function(data) {
		$(".asot55").html(data);
	});
	
}
</script>
<div class="asot55">

</div>
<script>
$(document).ready(function() {
	dno(1);
});
</script>
</div>
</div>