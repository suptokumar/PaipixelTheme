
<?php 
$db = mysqli_connect("localhost","paipixel_supto","Sk571960","paipixel_real") OR die("no connectiong available.");
include '../functions.php';
$id = $_POST['id'];
$a = $_POST['a'];
$page = $a*20-20;
$sql = "SELECT * FROM `blog_comment` WHERE blog_id='$id' ORDER BY id";
$g = mysqli_query($db,$sql);
if (mysqli_num_rows($g)>($page+20)) {
?>

<a href="javascript:void(0)" style="direction: inline-block; float: right; color: black; font-size: 20px;" onclick="get_comments('<?php echo $id ?>',<?php echo ($a+1) ?>,this)">Load More Comments</a>
<?php
}
$page = mysqli_num_rows($g)-$a*20;
$limit = $page+20;
if ($page<0) {
	$page=0;
}
$sql = "SELECT * FROM `blog_comment` WHERE blog_id='$id' ORDER BY id LIMIT $page,$limit";
$m = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($m)) {
?>

<div class="def_com">
	<div style="overflow: hidden;">
	<div class="ap" style="float: left; width: 60px">
		<img src="<?php get_domain("/content/") ?><?php echo more_user("image",$row['user']) ?>" style="width: 50px; border-radius: 10px; height: 50px" alt="<?php echo $row['user'] ?>">
	</div>
	<div class="ap" style="float: left; width: 85%">
<a href="<?php get_domain("/profile/") ?><?php echo $row['user'] ?>" style="color: black; text-decoration: none;"><?php echo $row['user'] ?></a>
<div>
<?php echo $row['content']; ?>

<time style="display: block;"><?php echo date("h:ia, d M Y", strtotime($row['date_time'])) ?></time>
	</div>
</div>
</div>
	<table>
<tr>
<td>
<img style="cursor: pointer" src="<?php get_domain("/image/voteup.png") ?>" alt="vote up" title="I like it." onclick="add_sub_vote(<?php echo $row['id']; ?>);">
<span class="sub_vote<?php echo $row['id'] ?>" style="font-family: arial; font-weight: bold; font-size: 23px; padding: 10px 0px; text-align: center;"></span>
<img style="cursor: pointer" src="<?php get_domain("/image/votedown.png") ?>" alt="vote up" title="I don't like it." onclick="out_sub_vote(<?php echo $row['id']; ?>);">
</td>
</tr>
<tr>
	<td id="notif">
		
	</td>
</tr>
</table>

<script>
setInterval(function(){
	$.ajax({
		url: '<?php get_domain("/") ?>blog/ans_vote.php',
		type: 'POST',
		data: {id: '<?php echo $row['id'] ?>'},
	})
	.done(function(data) {
		$(".sub_vote<?php echo $row['id'] ?>").html(data);
	});
},1000)
</script>
</div>
<?php }
?>
<?php  mysqli_close($db); ?>