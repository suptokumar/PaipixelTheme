<style>
@media(max-width: 700px)
{
	.data_table{
		font-size: 9px;
	}
	.rtr25 {
		display: none;
	}
}
</style>
<?php
if (!isset($_GET['search'])) {
	?>
<input type="search" style='display:none' placeholder="search..."  style="padding: 10px;" onkeyup="searchinverter(1);" id="ast" value="">
	<?php
}
if (isset($_GET['search'])) {
	
$search = $_GET['search'];
} else {
$search = '';

}
if (isset($_GET['page'])) {
	
$p = $_GET['page'];
} else {
$p = 1;
}

$limit = 50;
$crt = ($p-1)*$limit;
include '../extra/db.extra.php';
echo "<div class='acctt'>";
session_start();
$user = user_detail("user_name");
	$sql = "SELECT * FROM exam_score WHERE user='$user' AND exam LIKE '%$search%' GROUP BY exam ORDER BY CASE
WHEN exam='$search' THEN 0
WHEN exam LIKE '$search%' THEN 1
WHEN exam LIKE '_$search%' THEN 2
WHEN exam LIKE '__$search%' THEN 3
WHEN exam LIKE '___$search%' THEN 4
WHEN exam LIKE '____$search%' THEN 5
WHEN exam LIKE '_____$search%' THEN 6
WHEN exam LIKE '______$search%' THEN 7
WHEN exam LIKE '_______$search%' THEN 8
WHEN exam LIKE '________$search%' THEN 9
WHEN exam LIKE '_________$search%' THEN 10
WHEN exam LIKE '__________$search%' THEN 11
WHEN exam LIKE '___________$search%' THEN 12
ELSE 13 END, id DESC LIMIT $crt,$limit";

// if ($search=='') {
	
// }
// $sql = "SELECT * FROM exam_score WHERE user='$user' GROUP BY exam ORDER BY id DESC LIMIT $crt,$limit";
	$q = mysqli_query($db,$sql);
	?>
<link rel="stylesheet" href="<?php get_domain("/css/table.css") ?>">
<table class="data_table">
	<tr>
		<th>Exam No.</th>
		<th>Exam Name</th>
		<th>Total Registered</th>
		<th>Your Score</th>
		<!-- <th class="rtr25">Penalty</th> -->
		<th>Date</th>
	</tr>
	<?php if (mysqli_num_rows($q)==0): ?>
		<tr>
			<td colspan="6">No Details Found</td>
		</tr>
	<?php endif ?>
	<?php
	while ($row = mysqli_fetch_array($q)) {
	$e = $row['exam'];
	$my_score = 0;
	$time = 0;
	$user_name = $row['user'];
	$cur=0;
	$penalty=0;
	$sql = "SELECT * FROM exam_score WHERE exam='$e' AND user='$user_name'";
	$o = mysqli_query($db,$sql);
	while ($r = mysqli_fetch_array($o)) {
		$my_score += $r['score'];
		$time += $r['time'];
		$eee = $r['question'];
		$answer = $r['answer'];
		$ddd = "SELECT * FROM question WHERE id='$eee' AND pending=1";
		$dfas = mysqli_query($db,$ddd);
		$t = mysqli_fetch_array($dfas);
		if ($t['opt'.$t['currect']]==$answer) {
		$cur++;
		$penalty += 1-($r['score']);
		} else {
		$penalty += 0-($r['score']);
		}

	}
	?>

<tr class="exam_b<?php echo $row['exam_id'] ?>">
<td style="font-family: arial;"><?php echo get_exam_id($row['exam']) ?></td>
<td style="font-family: arial;"><a href="<?php get_domain("/exam.php?exam_details=".$row['exam']) ?>">
<?php echo get_exam_name($row['exam']) ?></a></td>
<td style="font-family: arial;">
<?php
$sql = "SELECT * FROM exam_reg WHERE exam = '".$row['exam']."'";
$g = mysqli_query($db,$sql);
echo $s = mysqli_num_rows($g);  ?></td>
<td style="font-family: arial; text-align: left;"><?php echo number_format($my_score,3); ?></td>
<!-- <td class="rtr25" style="font-family: arial;"><?php echo number_format($penalty,3); ?> Min</td> -->
<td style="font-family: arial;"><?php echo date("d M Y, h:i a",strtotime($row['datetime'])) ?></td>
</tr>

	<?php
}
?>
</table>
<?php 
$sql = "SELECT * FROM exam_score WHERE user='$user' GROUP BY exam ORDER BY id DESC";
$total = mysqli_num_rows(mysqli_query($db,$sql));
pagination($p,$total,$limit);

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
<li class="pagenation_list"><a onclick="searchinverter(1)" href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a onclick="searchinverter(<?php echo ($crnt-1) ?>)" href="javascript:void(0)"><</a></li>
	<?php
}
for ($i=0; $i < $page_number; $i++) { 
	if (($i+1)==$crnt) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" class="selected_crnt_page"><?php echo ($i+1) ?></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="searchinverter(<?php echo ($i+1) ?>)" href="javascript:void(0)"><?php echo ($i+1) ?></a></li>
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
<li class="pagenation_list"><a onclick="searchinverter(<?php echo ($crnt+1) ?>)" href="javascript:void(0)">></a></li>
<li class="pagenation_list"><a onclick="searchinverter(<?php echo ($page_number) ?>)" href="javascript:void(0)">>></a></li>
	<?php
}
echo "</ul>";
?>
<style>
.pagination_bar{
	width: 100%;
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
</div>
<script>
function searchinverter(page)
{
	var search = $("#ast").val();
$.ajax({
	url: '<?php get_domain("/ajax/") ?>exam_list/live.php',
	type: 'GET',
	data: "search="+search+"&page="+page,
})
.done(function(dta) {
	$(".acctt").html(dta);
});
}
</script>
