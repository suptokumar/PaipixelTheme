<div class="sononah">
	
<table class="w3-table-all">
	
<tr class="w3-purple">
	<th>Question</th>
	<th style="text-align: center;">Explain</th>
	<th style="text-align: center;">Audio Explain</th>
	<th style="text-align: center;">View</th>
	<th style="text-align: center;">Status</th>
</tr>
<?php 
include 'db.php';
$s = $_POST['search'];
$limit = 20;
if (isset($_POST['page'])) {
	$page = $_POST['page'];
}else {
	$page = 1;
}
$start = ($page-1)*$limit;
$sql= "SELECT * FROM question WHERE setter='$s' AND  exam_id=0 LIMIT $start,$limit";
$m = mysqli_query($db,$sql);
	if (mysqli_num_rows($m)==0) {
		?>
<tr>
	<td colspan="5">Nothing Found</td>
</tr>
		<?php
	}
while ($row = mysqli_fetch_array($m)) {
	$id = $row['id'];

?>
<tr>
	<td><?php echo "<h3 style='float: left; font-size: 16px; vertical-align: top;'>".color(arial(translate(get_numbers($row['id'],$s))),"green").".</h3>"; ?> <?php echo $row['question'] ?></td>
	<td class="w3-orange w3-center"><?php if($row['details']!=''){echo "Yes";} else {echo "No";  } ?></td>
	<td class="<?php if($row['audio_explain']!=''){echo "w3-green";} else {echo "w3-red";  } ?> w3-center"><?php if($row['audio_explain']!=''){echo "Yes";} else {echo "No";  } ?></td>
	<td class="w3-yellow w3-center"><a href="javascript:void(0)" onclick="open_row(<?php echo $id ?>,'<?php echo $row['setter'] ?>');" class="w3-button w3-pink">Open</a></td>
	<td class="w3-yellow w3-center"><button href="javascript:void(0)" onclick="open_row(<?php echo $id ?>);" class="w3-button" style="text-transform: uppercase; font-weight: bold;color:<?php if($row['pending']==0){echo "blue";} else if($row['pending']==1){echo "green";  } else {echo "red";} ?>"><?php if($row['pending']==0){echo "Pending";} else if($row['pending']==1){echo "Approved";  } else {echo "Rejected";} ?></button></td>
</tr>
<?php
}
?>
</table>
<?php
$st = "SELECT * FROM question WHERE setter='$s' AND exam_id=0";
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
<li class="pagenation_list"><a onclick="search_d52(1)" href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a onclick="search_d52(<?php echo ($crnt-1) ?>)" href="javascript:void(0)"><</a></li>
	<?php
}
for ($i=0; $i < $page_number; $i++) { 
	if (($i+1)==$crnt) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" class="selected_crnt_page"><?php echo ($i+1) ?></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="search_d52(<?php echo ($i+1) ?>)" href="javascript:void(0)"><?php echo ($i+1) ?></a></li>
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
<li class="pagenation_list"><a onclick="search_d52(<?php echo ($crnt+1) ?>)" href="javascript:void(0)">></a></li>
<li class="pagenation_list"><a onclick="search_d52(<?php echo ($page_number) ?>)" href="javascript:void(0)">>></a></li>
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
	function search_d52(page){
		$.ajax({
			url: 'open_total.php',
			type: 'POST',
			data: "search=<?php echo $_POST['search']; ?>&&page="+page,
		})
		.done(function(data) {
			$(".sononah").html(data);
		});
		
	}
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
</div>