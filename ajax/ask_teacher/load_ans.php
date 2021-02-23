<style>
	.tft_image {
		width: 70px;
		height: 70px;
		float: left;
	}
</style>
<style>
	.at4{
		float: right; padding: 10px; color: green; border: 1px solid green;text-decoration: none;
	}
	.at4:hover {
color: white;
background: green;
	}
	.at5{
		float: right; padding: 10px; border: 1px solid green;text-decoration: none;
		color: white;
background: green;
	}
</style>
<?php 
include '../extra/db.extra.php';
$question_id = $_POST['id'];
session_start();
$reader = user_detail("user_name");
$sql = "SELECT * FROM ask_teacher WHERE id='$question_id'";
$g= mysqli_query($db,$sql);
$o = mysqli_fetch_array($g);
$setter= $o['user'];
$sql = "SELECT * FROM `ans_ask` WHERE question='$question_id' AND accept=1";
$m = mysqli_query($db,$sql);
$oosadf = mysqli_num_rows($m);
$sql = "SELECT * FROM `ans_ask` WHERE question='$question_id' ORDER BY accept DESC";
$m = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($m)) {
	$cmer = $row['user'];
?>
<div class="time_to_comment" style=" border: 1px solid #ccc; margin: 1%;">
	<div class="user_part" style="overflow: hidden;">
		<div style="width: 15%">
	<img src="<?php get_domain("/content/") ?><?php echo more_user("image",$cmer) ?>" alt="" class="tft_image">
		</div>
	<?php if ($reader==$setter && $oosadf==0) {
		?>
<a href="javascript:void(0)" title="This is the answer I needed. Thanks." class="at4" onclick="mark_select('<?php echo $row['id'] ?>')">Select</a>
		<?php
	} ?>
<?php if ($row['accept']==1) {
		?>
<a href="javascript:void(0)" title="This is the answer I needed. Thanks." class="at5"> ✓ Selected</a>
		<?php
	} ?>
	<div class="st" style="float: left; padding: 0% 1%; width: 85%">
	<h3><a style="padding: 1%; color: #00BAFF" href="<?php get_domain("/profile/".$cmer) ?>"><?php echo $cmer ?></a></h3>
	<h4><span style="padding: 1%;"><?php if (more_user("role",$cmer)==2): ?>
		<span style='font-family: arial'>AA:	<?php endif ?> <?php if (more_user("role",$cmer)==1): ?> Rating:	<?php endif ?><?php echo rating(more_user("rating",$cmer)) ?><?php if (more_user("role",$cmer)==2): ?>%<?php endif ?></span></span></h4>
	<div class="content"  style="padding: 1% 2%">
		<?php echo $row['content'] ?>
	</div>
	</div>
</div>
	<div class="act">
<div class="voter_machine">
<table>
<tr>
<td>
<img style="cursor: pointer" src="<?php get_domain("/image/voteup.png") ?>" alt="vote up" title="I like it." onclick="ans_ad_vote(<?php echo $row['id']; ?>);">
<span class="sub_vote sdk_vote<?php echo $row['id'] ?>" style="font-family: arial; text-align: center;"></span>
<img style="cursor: pointer" src="<?php get_domain("/image/votedown.png") ?>" alt="vote up" title="I don't like it." onclick="ans_bd_vote(<?php echo $row['id']; ?>);">
</td>
</tr>
<tr>
	<td id="notif">
		
	</td>
</tr>
</table>
	</div>
	</div>
<script>
setInterval(function(){
$.ajax({
			url: '<?php get_domain("/") ?>ajax/ask_teacher/answer_vote.php',
			type: 'POST',
			data: {id: '<?php echo $row['id'] ?>'},
		})
		.done(function(data) {
			$(".sdk_vote<?php echo $row['id'] ?>").html(data);
		});
},1000);
</script>
</div>
<?php
}
?>
<script>
$(document).ready(function() {
	$(".torldo").html("<?php echo mysqli_num_rows($m) ?>");
});
</script>
<script>
function mark_select(id)
{
$.ajax({
	url: '<?php get_domain("/ajax/ask_teacher/mark_select.php") ?>',
	type: 'POST',
	data: "id="+id,
})
.done(function(data) {
	location.reload();
})
.fail(function() {
	alert("failed to proccess your request");
});

}
</script>