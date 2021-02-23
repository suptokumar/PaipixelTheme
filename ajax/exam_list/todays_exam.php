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
<input type="date" placeholder="search..."  style="padding: 10px;" onchange="searchinverter(1);" id="ast" value="">
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
	$sql = "SELECT * FROM todays_model WHERE user='$user' AND date LIKE '%$search%' GROUP BY date ORDER BY id DESC LIMIT $crt,$limit";

// if ($search=='') {
	
// }
// $sql = "SELECT * FROM exam_score WHERE user='$user' GROUP BY exam ORDER BY id DESC LIMIT $crt,$limit";
	$q = mysqli_query($db,$sql);
	?>
<link rel="stylesheet" href="<?php get_domain("/css/table.css") ?>">
<script>
function open_todays_exam(id)
{
	$.ajax({
	url: '<?php get_domain("/ajax/") ?>exam_list/question_today.php',
	type: 'GET',
	data: "id="+id,
})
.done(function(dta) {
	$(".sdn<?php echo $rs = rand() ?>").html(dta);
	$(".sdn<?php echo $rs ?>").dialog({
		open: true,
		modal: true,
		width: "auto",
		title: "question set",
		show: "fade",
		hide: "explode",
		buttons:{
			"close":function(){
				$(this).dialog("close");
			}
		}
	})
});
}
</script>
<section class="sdn<?php echo $rs ?>"></section>
<table class="data_table">
	<tr>
		<th>Id</th>
		<th>Score</th>
		<th>Date</th>
		<!-- <th class="rtr25">Penalty</th> -->
		<th>View Question</th>
	</tr>
	<?php if (mysqli_num_rows($q)==0): ?>
		<tr>
			<td colspan="6">No Details Found</td>
		</tr>
	<?php endif ?>
	<?php
	$i = 0;
	while ($row = mysqli_fetch_array($q)) {
		$i++;
?>

<tr class="exam_b<?php echo $row['id'] ?>">
<td style="font-family: arial;"><?php echo $crt*$limit+$i ?></td>
<td style="font-family: arial; text-align: left;"><?php echo number_format($row['score'],2); ?></td>
<!-- <td class="rtr25" style="font-family: arial;"><?php echo number_format($penalty,3); ?> Min</td> -->
<td style="font-family: arial;"><?php echo date("d M Y",strtotime($row['date'])) ?></td>
<td style="font-family: arial;"><a href="javascript:void(0)" onclick="open_todays_exam(<?php echo strtotime($row['date']) ?>)" class="button button_standard" style="display: block;">View</a></td>
</tr>

	<?php
}
?>
</table>
<?php 
$sql = "SELECT * FROM todays_model WHERE user='$user' AND date LIKE '%$search%' GROUP BY date ORDER BY id DESC";
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
	url: '<?php get_domain("/ajax/") ?>exam_list/todays_exam.php',
	type: 'GET',
	data: "search="+search+"&page="+page,
})
.done(function(dta) {
	$(".acctt").html(dta);
});
}
</script>
