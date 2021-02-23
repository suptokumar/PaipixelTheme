<div class="asov">
	
<?php include 'db.php'; ?>
<?php session_start(); ?>
<?php $user = user_detail("user_name");
$page = $_POST['page']; 
$limit = 25;
$from = (($page)-1)*($limit);
$sql = "SELECT * FROM noti WHERE user='$user' ORDER BY id DESC LIMIT $from,$limit";
$m = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($m)) {
	$sql = "UPDATE noti SET seen=1 WHERE id='".$row['id']."'";
	mysqli_query($db,$sql);
?>
<div class="assistent <?php if($row['seen']==0){echo "unread";} ?>" id="noti_<?php echo $row['id'] ?>">
	<button href="javascript:void(0)" onclick="deletes5('<?php echo $row['id'] ?>')" style="float: right; cursor: pointer; border: none; background: none;"><img style="width: 20px" src="<?php get_domain("/image/delete.png") ?>" alt=""></button>
<?php if($row['link']!=''){echo '<a href="'.$row['link'].'">';} ?>
	<div class="part1">
	<?php echo $row['content']; ?>
	</div>
	<div class="part2">
		<?php echo date("h:ia d M Y",strtotime($row['date'])) ?>
	</div>
<?php if($row['link']!=''){echo '</a>';} ?>
</div>


<?php 

}

if (mysqli_num_rows($m)==0) {
	echo "<h2 style='max-width: 1000px; margin: 10px auto; text-align: center;'>No Notifications Found !</h2>";
}
	?>
<?php
$st = "SELECT * FROM noti WHERE user='$user' ORDER BY id";
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
			url: '<?php get_domain("/ajax/account.notifications.php") ?>',
			type: 'POST',
			data: "page="+page,
		})
		.done(function(data) {
			$(".asov").html(data);

		});
		
	}
</script>
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


<script>
	function deletes5(id){
		$.ajax({
			url: '<?php get_domain("/ajax/delete_noti.php") ?>',
			type: 'POST',
			data: {id: id},
		})
		.done(function(data) {
			$("#noti_"+id).fadeOut('slow');
		});
	}
</script>
<style>
	
.assistent {
  border: 1px solid #20b99d;
  padding: 1%;
  font: 17px tahoma;
  max-width: 1000px;
  margin: 5px auto;
  color: black;
  text-decoration: none;
}
a{
	text-decoration: none;
	color: black;
}
.unread{
	background: #EEF6FE;
}
</style>
