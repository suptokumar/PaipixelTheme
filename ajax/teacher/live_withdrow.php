<?php 

include '../../functions.php';
include '../../ajax/db_back.php';
session_start();
$user = $_SESSION['login_data_paipixel24'];
?>
<link rel="stylesheet" href="<?php get_domain("/css/table.css?s5.0gs") ?>">
<style>
	.content_area.body_content {
		background: transparent;
		border: none;
		padding: 0px;
	}
	.area_content {
		background: white;
		padding: 1%;
		font-family: arial;
		border: 1px solid #ccc;
	}
	.accuont_btn {
		background: white;
	}
	.r {
		animation: fade_blow .4s;
	}
	.question {
		animation: question .4s;
	}
	.area {
		animation: area .4s;

	}
	@keyframes fade_blow {
		0%{
			filter: blur(100px);
		}
		30% {
			border-radius: 50px;
		}
		100% {
		filter: blur(0px);
		border-radius: 0px;
		}
	}
	@keyframes question {
		0%{
			transform: rotateX(50deg);
		}
	}
	@keyframes area {
		0%{
			transform: rotate(45deg);
		}
	}
</style>
<div class="account_view">
	<script>
function get_subject(id,clas)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/subject.php") ?>',
		type: 'GET',
		data: {class: clas},
	})
	.done(function(data) {
		$("#"+id).html(data);
	});
	
}
</script>
<script>
function get_chapter(id,clas,subject)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/oddhay.php") ?>',
		type: 'GET',
		data: {class: clas, subject: subject},
	})
	.done(function(data) {
		$("#"+id).html(data);
	});
	
}
</script>
<?php 
$short = $_GET['short'];
$page = $_GET['page'];
$q = '';
if ($short==1) {
	$q = " AND user='".$user."' ";
}
if ($short==2) {
	$q = " AND user='".$user."' AND status='Pending' ";
}
if ($short==3) {
	$q = " AND status='Pending' ";
}
if ($short==4) {
	$q = " AND user='".$user."' AND status='Approved' ";
}

if ($short==5) {
	$q = " AND status='Approved' ";
}


if ($short==6) {
	$q = " AND user='".$user."' AND status='Rejected' ";
}

if ($short==7) {
	$q = " AND status='Rejected' ";
}


$limit = 25;
$ps = ($page-1)*$limit;
$sql = "SELECT id FROM withdraw WHERE user LIKE '%%' ".$q." ORDER BY id DESC";
$m = mysqli_query($db,$sql);
$row1 = mysqli_num_rows($m);

$sql = "SELECT id FROM withdraw WHERE status='Pending' ";
$m = mysqli_query($db,$sql);
$row2 = mysqli_num_rows($m);
$sql = "SELECT id FROM withdraw WHERE  status='Approved' ";
$m = mysqli_query($db,$sql);
$row3 = mysqli_num_rows($m);
$sql = "SELECT id FROM withdraw WHERE  status='Rejected' ";
$m = mysqli_query($db,$sql);
$row4 = mysqli_num_rows($m);
?>
<style>
.area {
  display: inline-block;
  text-align: center;
  padding: 2%;
  background: linear-gradient(#39d0b5,#7efbef);
  border: 1px solid #20b99d;
}
@media (max-width: 744px) {
	.area{
		width: 33%;
		margin: 1%;
		font-size: 15px
	}
}
</style>
<div class="area">
	<h3>Total Withdrawal Requests</h3>
	<h4  style="font-family: arial; padding-top: 7px; color: #0077f5"><?php echo $row1 ?></h4>
</div>
<div class="area">
	<h3>Pending Requests</h3>
	<h4  style="font-family: arial; padding-top: 7px; color: #0077f5"><?php echo $row2 ?></h4>
</div>
<div class="area">
	<h3>Approved Requests</h3>
	<h4  style="font-family: arial; padding-top: 7px; color: #0077f5"><?php echo $row3 ?></h4>
</div>
<!-- <div class="area">
	<h3>Total Rejected Requests</h3>
	<h4  style="font-family: arial; padding-top: 7px; color: #0077f5"><?php echo $row4 ?></h4>
</div><br><br> -->
<table class="data_table" style="font-family: arial;">
	<tr>
		<td>Id</td>
		<td>User Name</td>
		<td>Amount</td>
		<td>Status</td>
	</tr>
<?php
$sql = "SELECT * FROM withdraw WHERE user LIKE '%%'  ".$q." ORDER BY id DESC LIMIT $ps,$limit";
$m = mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($m)) {
?>
<tr>
	<td><?php echo $row['id'] ?></td>
	<td><?php echo $row['user'] ?></td>
	<td><?php echo $row['amount'] ?> BDT </td>
	<td style="padding: 15px"><?php if ($row['status']=='Pending'): ?>
		<span style="padding: 4px; margin: 5px; border-radius: 5px; background: #1F8EFF; color: white;"><?php echo $row['status'] ?></span>
		<br>
		<br>
		<span><?php echo date("h:ia, d M Y",strtotime($row['datetime'])) ?></span>
	<?php endif ?><?php if ($row['status']=='Approved'): ?>
		<span style="padding: 4px; margin: 5px; border-radius: 5px; background: green; color: white;"><?php echo $row['status'] ?></span>
		<br>
		<br>
		<span><?php echo date("h:ia, d M Y",strtotime($row['date2'])) ?></span>
	<?php endif ?><?php if ($row['status']=='Rejected'): ?>
		<span style="padding: 4px; margin: 5px; border-radius: 5px; background: red; color: white;"><?php echo $row['status'] ?></span>
		<br>
		<br>
		<span><?php echo date("h:ia, d M Y",strtotime($row['date2'])) ?></span>
	<?php endif ?></td>
</tr>
<?php
}
if (mysqli_num_rows($m)==0) {
	echo "<tr><td style='text-align:center' colspan=4>No previous Record Detected</td></tr>";
}
	?>
</table>
<?php
$sql = "SELECT id FROM withdraw WHERE user LIKE '%%' ".$q;
$r = mysqli_query($db,$sql);
$total = mysqli_num_rows($r);
pagination($page,$total,$limit);

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
<li class="pagenation_list"><a onclick="donoe(1)" href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a onclick="donoe(<?php echo ($crnt-1) ?>)" href="javascript:void(0)"><</a></li>
	<?php
}
for ($i=0; $i < $page_number; $i++) { 
	if (($i+1)==$crnt) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" class="selected_crnt_page"><?php echo ($i+1) ?></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="donoe(<?php echo ($i+1) ?>)" href="javascript:void(0)"><?php echo ($i+1) ?></a></li>
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
<li class="pagenation_list"><a onclick="donoe(<?php echo ($crnt+1) ?>)" href="javascript:void(0)">></a></li>
<li class="pagenation_list"><a onclick="donoe(<?php echo ($page_number) ?>)" href="javascript:void(0)">>></a></li>
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
</div>
</div>
</div>
