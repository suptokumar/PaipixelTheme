<?php 
include '../extra/db.extra.php';
$search = $_GET['search'];
$page = $_GET['page'];
$paged = (($page)-1);
$page_per_post = 100;
if ($search=='') {
	$sql = "SELECT * FROM `ask_teacher` ORDER BY id DESC LIMIT $paged, $page_per_post";
} else {
$sql = "SELECT * FROM `ask_teacher` WHERE (class='$search' OR subject='$search' OR chapter='$search') OR user='$search' OR question LIKE '%$search%' ORDER BY 
CASE 
WHEN user='$search' THEN 0
WHEN class='$search' AND subject='$search' AND chapter='$search' AND question LIKE '%$search%'  THEN 1
WHEN class='$search' THEN 2
WHEN subject='$search' THEN 2
WHEN chapter='$search' THEN 2
WHEN question LIKE '$search%'  THEN 2
WHEN question LIKE '%$search%'  THEN 3
ELSE 3 END, chapter ASC LIMIT $paged, $page_per_post";
}
$m = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($m)) {
?>
<script>
	setInterval(function(){
	$.ajax({
			url: '<?php get_domain("/") ?>ajax/ask_teacher/question_vote.php',
			type: 'POST',
			data: {id: '<?php echo $row['id'] ?>'},
		})
		.done(function(data) {
			$("#son<?php echo $row['id']; ?>").html(data);
		});
		
	},1000);
</script>
<div class="question_boar" style="overflow: hidden;">
	<div class="question_type">
		<div class="acure_part" style="overflow: hidden; float:left; width: 20%">
		<div class="acure">
			<h2><?php echo $row['view'] ?></h2>
			<h3>Views</h3>
		</div>
		<div class="acure">
			<h2 id="son<?php echo $row['id']; ?>"><?php echo $row['updown'] ?></h2>
			<h3>Votes</h3>
		</div>
		<div class="acure">
			<?php $sql = "SELECT * FROM `ans_ask` WHERE question='".$row['id']."'";
$sdg = mysqli_query($db,$sql);
$rv = mysqli_num_rows($sdg); ?>
			<h2><?php echo $rv ?></h2>
			<h3>Answers</h3>
		</div>
		</div>
		<div class="acure_part" style="float:left; width: 80%">
		<div class="ask">
		<?php if ($row['post_type']=='Premium') {
			?>
		<div class="pre_sign">
<img width="100px" src="<?php get_domain("/image/Premium_logo.png") ?>">
		</div>
			<?php
		} ?>
			
		<div class="question" onclick="window.location='full_question.php?id=<?php echo $row['id'] ?>'">
			<?php echo $row['question']; ?>
		</div>
		<div class="content_desk">
			<?php 
if ($row['class']!='') {
	?>
			<a href="javascript:void(0)" class="button bd_button" style="margin-top: 10px; display: inline-block;"><?php echo $row['class'] ?></a>

	<?php
}
if ($row['subject']!='') {
	?>
			<a href="javascript:void(0)" class="button bd_button" style="margin-top: 10px; display: inline-block;"><?php echo $row['subject'] ?></a>

	<?php
}
if ($row['chapter']!='') {
	?>

			<a href="javascript:void(0)" class="button bd_button"  style="margin-top: 10px; display: inline-block;"><?php echo $row['chapter'] ?></a>
	<?php
}
			?>
		</div>
		<div class="user_det" style="float: right;">
			<h3><a href="<?php get_domain("/profile/") ?><?php echo $row['user'] ?>"><?php echo $row['user'] ?></a></h3>
			<h2><?php echo date("d M Y",strtotime($row['date_time'])) ?></h2>
		</div>
		</div>
		</div>
	</div>
</div>
<?php
}
?>
<script>
		$(".bd_button").click(function(event) {
		$("#idtos input").val($(this).html());
$("#idtos").submit();
	});
</script>
<?php 
if ($search=='') {
	$sql = "SELECT * FROM `ask_teacher` ORDER BY id DESC";
} else {
$sql = "SELECT * FROM `ask_teacher` WHERE (class='$search' OR subject='$search' OR chapter='$search') OR user='$search' OR question LIKE '%$search%' ORDER BY 
CASE 
WHEN user='$search' THEN 0
WHEN class='$search' AND subject='$search' AND chapter='$search' AND question LIKE '%$search%'  THEN 1
WHEN class='$search' THEN 2
WHEN subject='$search' THEN 2
WHEN chapter='$search' THEN 2
WHEN question LIKE '$search%'  THEN 2
WHEN question LIKE '%$search%'  THEN 3
ELSE 3 END, chapter DESC";
}
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
<li class="pagenation_list"><a onclick="search_sot(document.getElementById('inputdo').value,1)" href="javascript:void(0)"><<</a></li>
<li class="pagenation_list"><a onclick="search_sot(document.getElementById('inputdo').value,<?php echo ($crnt-1) ?>)" href="javascript:void(0)"><</a></li>
	<?php
}
for ($i=0; $i < $page_number; $i++) { 
	if (($i+1)==$crnt) {
		?>
<li class="pagenation_list"><a href="javascript:void(0)" class="selected_crnt_page"><?php echo ($i+1) ?></a></li>
		<?php 
	} else {
	?>
<li class="pagenation_list"><a onclick="search_sot(document.getElementById('inputdo').value,<?php echo ($i+1) ?>)" href="javascript:void(0)"><?php echo ($i+1) ?></a></li>
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
<li class="pagenation_list"><a onclick="search_sot(document.getElementById('inputdo').value,<?php echo ($crnt+1) ?>)" href="javascript:void(0)">></a></li>
<li class="pagenation_list"><a onclick="search_sot(document.getElementById('inputdo').value,<?php echo ($page_number) ?>)" href="javascript:void(0)">>></a></li>
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