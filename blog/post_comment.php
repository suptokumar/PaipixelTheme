<?php 
include '../ajax/db_back.php';
include '../functions.php';
$id = $_POST['id'];
$content = $_POST['content'];
session_start();
$user = user_detail("user_name");
date_default_timezone_set("Asia/Dhaka");
$date = date("Y-m-d H:i:s");


$sql = "SELECT * FROM announce WHERE id='$id'";
$m = mysqli_query($db,$sql);
$ros = mysqli_fetch_array($m);

$owner = $ros['user'];
$link = return_domain("/post/".$id);
$contents = "<a href='".return_domain("/profile/".$user)."'><b>".my_name($user)."</b></a> commented on <a href='".return_domain("/post/".$id)."'><b>your post</b>.</a>";






$sql = "INSERT INTO `blog_comment` (`id`, `blog_id`, `content`, `user`, `date_time`) VALUES (NULL, '$id', '$content', '$user', '$date')";
if (mysqli_query($db,$sql)) {
?>
<div class="def_com">
	<div style="overflow: hidden;">
		
	<div class="ap" style="float: left; width: 60px">
		<img src="<?php get_domain("/content/") ?><?php echo user_detail("image") ?>" style="width: 50px; border-radius: 10px; height: 50px" alt="<?php echo user_detail("user_name") ?>">
	</div>
	<div class="ap" style="float: left; width: 85%">
<a href="<?php get_domain("/profile/") ?><?php echo user_detail("user_name") ?>" style="color: black; text-decoration: none;"><?php echo user_detail("user_name") ?></a>
<div>
<?php echo $content ?>
<time style="display: block;"><?php echo date("h:ia, d M Y", strtotime($date)) ?></time>
	</div>
	</div>
	</div>
	<table>
<tr>
<td>
<?php 
$sql= "SELECT * FROM blog_comment WHERE date_time='$date' ORDER BY id DESC LIMIT 1";
$r = mysqli_query($db,$sql);
$row = mysqli_fetch_array($r);
?>
<img style="cursor: pointer" src="<?php get_domain("/image/voteup.png") ?>" alt="vote up" title="I like it." onclick="add_vote(<?php echo $row['id']; ?>);">
<span class="sub_vote<?php echo $row['id'] ?>" style="font-family: arial; font-weight: bold; font-size: 23px; padding: 10px 0px; text-align: center;"></span>
<img style="cursor: pointer" src="<?php get_domain("/image/votedown.png") ?>" alt="vote up" title="I don't like it." onclick="out_vote(<?php echo $row['id']; ?>);">
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
<?php
}
if ($owner!=$user) {
send_notification($owner,$link,$contents);
}
?><?php  mysqli_close($db); ?>