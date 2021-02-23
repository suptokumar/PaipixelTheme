<?php 
include '../extra/db.extra.php';
$page = $_GET['page'];
$key = $_GET['key'];
$institution = $_GET['institution'];
$class = $_GET['class'];
$psql = '';
if ($institution!='') {
	$psql .= " AND school='".$institution."' ";
}
if ($class!='') {
	$psql .= " AND class='".$class."' ";
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
<th>Attempted Questions (lifetime)</th>
<th>Currect Answers</th>
<th>Accuracy</th>
<th>Lifetime Score</th>
</tr>
			<?php 
			global $db;
			$st = "SELECT * FROM score_leader_board WHERE user_name LIKE '%$key%' GROUP BY user_name ORDER BY CASE
			WHEN user_name = '$key' THEN 1
			WHEN user_name LIKE '$key%' THEN 2
			ELSE 3 END, user_name ASC LIMIT $limit,$page_per_post";
			if ($key=='') {
				$st = "SELECT * FROM score_leader_board WHERE user_name LIKE '%$key%' GROUP BY user_name ORDER BY SUM(score) DESC LIMIT $limit,$page_per_post";
			}
			
			$r = mysqli_query($db,$st);
			$user="";
			$rating="";
			$image="";
			$i = 0;
			$numrows = mysqli_num_rows($r);

			while($row = mysqli_fetch_array($r)){

				$user= $row['user_name'];
if ($class!='' AND $institution!='') {
	if (more_user("class",$user)!=$class && more_user("school",$user)!=$institution) {
		$numrows--;
		continue;
	}
}
if ($class!='') {
	if (more_user("class",$user)!=$class) {
		$numrows--;
		continue;
	}
}
if ($institution!='') {
	if (strtoupper(more_user("school",$user))!=$institution) {
		$numrows--;
		continue;
	}
}

				$rating= more_user("rating",$user);
				$sql = "SELECT SUM(score) FROM score_leader_board WHERE user_name='$user'";
				$o = mysqli_query($db,$sql);
				$score = mysqli_fetch_array($o);

				$sql = "SELECT SUM(currect) FROM score_leader_board WHERE user_name='$user'";
				$te = mysqli_query($db,$sql);
				$currect = mysqli_fetch_array($te);

				$sql = "SELECT SUM(total) FROM score_leader_board WHERE user_name='$user'";
				$ao = mysqli_query($db,$sql);
				$total = mysqli_fetch_array($ao);

				?>
<tr>
<td>
<?php 
$bracket = false;
$more_rate = "";
if ($class!='' AND $institution!='') {
	// echo "Both selected";
	$bracket = true;
	$more_rate = position_class_inst($class,$institution,$score[0]);
} else
if ($class!='') {
	$bracket = true;
	$more_rate = position_class($class,$score[0]);
	// echo "class selected";
} else  if ($institution!='') {
	$more_rate = position_inst($institution,$score[0]);
	$bracket = true;
	// echo "institution selected";
}

?>
<?php echo $more_rate;
if ($bracket) {
	echo "(".get_position_by_score($score[0]).")";
} else {
	echo get_position_by_score($score[0]);
}
?>


	</td>
<td><img src="<?php get_domain("/content/".more_user("image",$user)) ?>" style="width: 60px; height: 60px;"></td>
<td><a href="<?php get_domain("/profile/");?><?php echo $user; ?>" style="text-decoration: none;"><?php echo my_name($user); ?></a></td>
<td><?php echo $total[0]; ?></td>
<td><?php echo $currect[0]; ?></td>
<td><?php echo number_format(((($score[0])*100)/($total[0])),2); ?>%</td>
<td style="background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).'11' ?>"><?php echo number_format($score[0],3); ?></td>
</tr>
				<?php
				$i++;
			}
						if ($numrows==0) {
				?>
<td colspan="7" style="text-align: center;">No user Found</td>

				<?php
			}
			 ?>
</table>
<?php
$st = "SELECT * FROM user WHERE role=1 AND user_name LIKE '%$key%' ORDER BY rating DESC";
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
<li class="pagenation_list"><a onclick="search_d52(document.getElementById('ms25').value,1,'pd')" href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a onclick="search_d52(document.getElementById('ms25').value,<?php echo ($crnt-1) ?>)" href="javascript:void(0)"><</a></li>
	<?php
}
for ($i=0; $i < $page_number; $i++) { 
	if (($i+1)==$crnt) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" class="selected_crnt_page"><?php echo ($i+1) ?></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="search_d52(document.getElementById('ms25').value,<?php echo ($i+1) ?>)" href="javascript:void(0)"><?php echo ($i+1) ?></a></li>
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
<li class="pagenation_list"><a onclick="search_d52(document.getElementById('ms25').value,<?php echo ($crnt+1) ?>)" href="javascript:void(0)">></a></li>
<li class="pagenation_list"><a onclick="search_d52(document.getElementById('ms25').value,<?php echo ($page_number) ?>)" href="javascript:void(0)">>></a></li>
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