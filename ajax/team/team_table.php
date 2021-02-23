
<style>
	.pagination_bar{
	width: 97%;
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
<table class="data_table">
		<tr>
		<th>Team Name</th>
		<th>Team Ranking</th>
		<th>View Details</th>
<?php 
include '../extra/db.extra.php';
if (isset($_GET['apply'])) {
	session_start();
	$se = $_SESSION['login_data_paipixel24'];
	$sql = "SELECT * FROM user WHERE user_name='$se'";
	$c = mysqli_query($db,$sql);
	$b = mysqli_fetch_array($c);
	$my_team = $b['team'];
	if ($my_team=='') {
		
	?>
		<th>Apply</th>

	<?php
	}
}
?>
		</tr>
<?php 
$s= $_GET['search'];
$page = $_GET['page'];
$page_per_post = intval($_GET['filter']);
$limit = ($page-1)*($page_per_post);
$sql = "SELECT * 
FROM team 
WHERE team_name LIKE '%$s%' 
ORDER BY CASE WHEN team_name = '$s' THEN 0 
              WHEN team_name LIKE '$s%' THEN 1  
              WHEN team_name LIKE '%$s%' THEN 2  
              ELSE 3
         END, team_name ASC LIMIT $limit,$page_per_post";

$q = mysqli_query($db,$sql);
while($r = mysqli_fetch_array($q))
{
	?>
<tr>
	<td><?php echo $r['team_name'] ?></td>
	<td style="font-family: arial;"><?php echo $r['my_rating'] ?></td>
	<td class='button_set'><a style="font-weight: 500;" href="<?php get_domain("/team/".$r['rand_id']) ?>" class="button" onclick="query_url(event,this,'from_main_body','<?php echo $r['team_name'] ?> | PaiPixel Online Exam','<?php get_domain("/teams/".$r['rand_id']) ?>')">View Details</a></td>
	<?php 
if (isset($_GET['apply'])) {
	if ($my_team=='') {
		$apply_s = $r['apply'];
		$code = "Apply Now";
		$func =  'onclick="apply_team(\'' . $r['rand_id'] .'\')"';
		if (strpos($apply_s, ','.$se.',') !== false) {
			$code="Request Pending";
			$func = "";
		}
	;
	?>
	<td class='button_set'><a style="font-weight: 500;" href="javascript:void(0)" <?php echo $func; ?> id="apply_korbi<?php echo $r['rand_id'] ?>" class="button"><?php echo $code; ?></a></td>

	<?php
}
}
?>
</tr>
	<?php
}

?>
</table>
<?php


$sql = "SELECT * 
FROM team 
WHERE team_name LIKE '%$s%' 
ORDER BY CASE WHEN team_name = '$s' THEN 0 
              WHEN team_name LIKE '$s%' THEN 1  
              WHEN team_name LIKE '%$s%' THEN 2  
              ELSE 3
         END, team_name ASC";
$total = mysqli_num_rows(mysqli_query($db,$sql));
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
<li class="pagenation_list"><a onclick="team_table(document.getElementsByName('search_team')[0].value,document.getElementsByName('filter_team')[0].value,1)" href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a onclick="team_table(document.getElementsByName('search_team')[0].value,document.getElementsByName('filter_team')[0].value,<?php echo ($crnt-1) ?>)" href="javascript:void(0)"><</a></li>
	<?php
}
for ($i=0; $i < $page_number; $i++) { 
	if (($i+1)==$crnt) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" class="selected_crnt_page"><?php echo ($i+1) ?></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="team_table(document.getElementsByName('search_team')[0].value,document.getElementsByName('filter_team')[0].value,<?php echo ($i+1) ?>)" href="javascript:void(0)"><?php echo ($i+1) ?></a></li>
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
<li class="pagenation_list"><a onclick="team_table(document.getElementsByName('search_team')[0].value,document.getElementsByName('filter_team')[0].value,<?php echo ($crnt+1) ?>)" href="javascript:void(0)">></a></li>
<li class="pagenation_list"><a onclick="team_table(document.getElementsByName('search_team')[0].value,document.getElementsByName('filter_team')[0].value,<?php echo ($page_number) ?>)" href="javascript:void(0)">>></a></li>
	<?php
}
echo "</ul>";
}
?>