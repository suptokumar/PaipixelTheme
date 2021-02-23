<?php 
include '../extra/db.extra.php';
$page = $_POST['page'];
$limit = 25;
$paginate = ($page-1)*$limit;
$class = $_POST['class'];
$chapter = $_POST['chapter'];
$subject = $_POST['subject'];
$name = $_POST['name'];
$onga = '';
if ($class!='') {
	$onga .=' AND class=\''.$class.'\' ';
}
if ($chapter!='') {
	$onga .=' AND chapter=\''.$chapter.'\' ';
}
if ($subject!='') {
	$onga .=' AND subject=\''.$subject.'\' ';
}
if ($name!='') {
	$onga .=' AND name LIKE \'%'.$name.'%\' ';
	$name_short = "CASE
WHEN name='$name' THEN 0
WHEN name LIKE '$name%' THEN 1
WHEN name LIKE '%$name%' THEN 2
ELSE 3 END,";
} else {
	$name_short = '';

}
$sql = "SELECT * FROM question WHERE exam_id!=0 AND exam_starting_date < CURRENT_TIME ".$onga." AND pending=1 GROUP BY exam_id ORDER BY $name_short id DESC LIMIT $paginate,$limit";
session_start();

$q = mysqli_query($db,$sql);
?>

<table class="data_table func_table table_hoverable">

<tr>
	<th>Exam Name</th>
	<th>Question Setter</th>
	<th>Class</th>
	<th class="to_min500">Number of Questions</th>
	<th class="to_min500">Duration</th>
	<th>Exam Date</th>
	<th>LeaderBoard</th>
</tr>
<?php
while ($row = mysqli_fetch_array($q)) {
	?>
<tr style="font-family: cursive;">
	<td><a href="<?php get_domain("/exam.php?exam_details=".$row['exam_id']); ?>" style="color: #156B73;"><?php echo $row['name'] ?></a></td>
	<td><?php echo $row['setter'] ?></td>
	<td><?php echo $row['class'] ?></td>
	<td class="to_min500"><?php 
$ex = $row['exam_id'];
	$e = "SELECT * FROM question WHERE exam_id = '$ex' AND pending=1";
	$s = mysqli_query($db,$e);
	date_default_timezone_set("Asia/Dhaka");
	echo mysqli_num_rows($s); ?></td>
<?php 
$user05 = user_detail("user_name"); 
$rs = "SELECT * FROM `exam_reg` WHERE exam = '$ex' AND user='$user05'";
$d = mysqli_query($db,$rs);
$nu = mysqli_num_rows($d);
	?>
	<td class="to_min500"><?php echo $row['exam_duration'] ?> Min</td>
	<td><?php echo date("d M Y, h:i a", (strtotime($row['exam_starting_date'])+($row['exam_duration']*60))); ?></td>
	

	<td style="padding: 10px">
<div id="e<?php echo $ex ?>">

		<button href="javascript:void(0)" onclick="view_result('<?php echo $ex ?>',this);" class="button button_standard more_button">View</button>
</div>

	</td>
	
</tr>

	<?php
}if (mysqli_num_rows($q)==0) {
	?>
<tr>
	<td colspan="7" style="text-align: center;">No exams found</td>
</tr>
	<?php
}
?>
</table>
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
<?php
$st = "SELECT * FROM question WHERE exam_starting_date < CURRENT_TIME ".$onga." AND pending=1 GROUP BY exam_id ORDER BY $name_short id DESC";
$r = mysqli_query($db,$st);
$total = mysqli_num_rows($r);
if ($limit<$total) {
pagination($page,$total,$limit);
}

function pagination($page,$total,$limit){
$crnt = $page;
$page_number = ceil($total/$limit);
echo "<ul class='pagination_bar'>";
if ($crnt==1) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a href="javascript:void(0)"><</a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="dno(1)" href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a onclick="dno(<?php echo ($crnt-1) ?>)" href="javascript:void(0)"><</a></li>
	<?php
}
for ($i=0; $i < $page_number; $i++) { 
	if (($i+1)==$crnt) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" class="selected_crnt_page"><?php echo ($i+1) ?></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="dno(<?php echo ($i+1) ?>)" href="javascript:void(0)"><?php echo ($i+1) ?></a></li>
	<?php
}
}
if ($crnt==$page_number) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" disabled>></a></li>
<li class="pagenation_list"><a href="javascript:void(0)" disabled>>></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="dno(<?php echo ($crnt+1) ?>)" href="javascript:void(0)">></a></li>
<li class="pagenation_list"><a onclick="dno(<?php echo ($page_number) ?>)" href="javascript:void(0)">>></a></li>
	<?php
}
echo "</ul>";
?>
<style>
	p {
		background: none !important;
	}
</style>

<script>
	$(document).ready(function() {
	$(".header span").removeAttr("style");
	$(".as span").removeAttr("style");
	});
</script>
<style>
	.pagination_bar{
	width: 99%;
	text-align: center;
	background: white;
	padding: 1%;
}
.pagenation_list {
	display: inline-block;
	margin-left: -3px;
}
.pagenation_list a {
	text-decoration: none;
	color: #242424;
	background: linear-gradient(rgba(215,215,220),rgba(225,225,230));
	padding: 10px 20px;
	display: block;
}
.pagenation_list a.selected_crnt_page {
	background: tomato !important;
}
.pagenation_list a:hover {
	background: yellowgreen;
}

</style>
<?php
}
?>