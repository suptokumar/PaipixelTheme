<?php 
include '../extra/db.extra.php';
$page = $_GET['page'];
$key = $_GET['key'];
$institution = $_GET['institution'];
if ($institution=='null') {
	$institution='';
}
$class = $_GET['class'];
$psql = '';
$user_name='';
if ($class!='') {
	$p = '';
if ($institution!='') {
	$p = " AND subject='$institution'";
}
	$sql = "SELECT * FROM `teachers_qualifications` WHERE class='$class' ".$p;
	$m = mysqli_query($db,$sql);
	$psql = "AND ( ";
	$i=0;
	$mt = mysqli_num_rows($m);
while ($row = mysqli_fetch_array($m)) {
	$i++;
	$i;
	$psql .=" user_name='".$row['user']."' ";
	if ($i==$mt) {
		$psql.=" )";
	} else {
		$psql.=" OR ";
	}
}
if ($psql == "AND ( ") {
	$psql=" AND user_name='dsfgsd10frdilamdofnoenfsd1023412024202d1fd0f01fosdsdasas14' ";
}
}
$page_per_post = 50;
$limit = ($page-1)*$page_per_post;
?>
<style>
	@media (max-width: 500px) {
		.asg4000 {
			font-size: 11px;
		}
	}
</style>
<table class="data_table table_hoverable asg4000" style="font-family: cursive;">
<tr>
<th>Position</th>
<th>Image</th>
<th>User Name</th>
<th>Avarage Accuracy (AA)</th>
<th>Contribution (CC)</th>
</tr>
			<?php 
			global $db;
			$st = "SELECT * FROM user WHERE role=2 AND user_name LIKE '%$key%' ".$psql." ORDER BY CASE
			WHEN user_name = '$key' THEN 1
			WHEN user_name LIKE '$key%' THEN 2
			ELSE 3 END, user_name ASC LIMIT $limit,$page_per_post";
			if ($key=='') {
				$st = "SELECT * FROM user WHERE role=2 ".$psql." ORDER BY rating DESC LIMIT $limit,$page_per_post";
			}
			
			$r = mysqli_query($db,$st);
			$user="";
			$rating="";
			$image="";
			$i = 0;
			if (mysqli_num_rows($r)==0) {
				?>
<td colspan="5" style="text-align: center;">No user Found</td>

				<?php
			}
			while($row = mysqli_fetch_array($r)){
				$user= $row['user_name'];
				$rating= $row['rating'];
				?>
<tr>
<td><?php 
$bracket = false;
$more_rate = "";
if ($class!='' AND $institution!='') {
	// echo "Both selected";
	$bracket = true;
	$more_rate = teacher_class_subject($class,$institution,$rating);
} else
if ($class!='') {
	$bracket = true;
	$more_rate = teacher_class($class,$rating);
	// echo "class selected";
}

?>
<?php echo $more_rate;
if ($bracket) {
	echo "(".teacher_position($row['rating']).")";
} else {
	echo teacher_position($row['rating']);
}
 ?>
</td>
<td><img src="<?php get_domain("/content/".$row['image']) ?>" style="width: 60px; height: 60px;"></td>
<td><a href="<?php get_domain("/profile/");?><?php echo $user; ?>" style="text-decoration: none;"><?php echo my_name($user); ?></a></td>
<td style="background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).'11' ?>"><?php echo number_format($rating,2); ?>%</td>
<td><?php if ($row['cc']>0) {
	echo color("+","green");
} echo color($row['cc'],"green"); ?></td>
</tr>
				<?php
				$i++;
			}
			 ?>
</table>
<?php
$st = "SELECT * FROM user WHERE role=2 AND user_name LIKE '%$key%' ORDER BY rating DESC";
$r = mysqli_query($db,$st);
$total = mysqli_num_rows($r);
pagination($page,$total,$page_per_post);

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