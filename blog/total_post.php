<?php 
include '../ajax/db.php';
session_start();
$user = user_detail("user_name");
$sql = "SELECT * FROM announce WHERE user='$user' ORDER BY id DESC";
$m = mysqli_query($db,$sql);
$rm  = rand();
if (mysqli_num_rows($m)==0) {
	echo "No Previous Posts.";
}
while ($row= mysqli_fetch_array($m)) {
	?>
<div class="main_c id<?php echo $row['id'] ?>" style="margin: 1%; padding: 1%; border: 1px solid #ccc;">
	<h3><a href=""><?php echo $row['header']; ?></a></h3>
	<div class="contents" style="overflow: hidden">
		<span class="status" style="float: right;font-weight: bold;color: green;"><?php if($row['pending']==0){echo 'Pending<br><button id="cd_button" onclick="gt'.$rm.'('.$row['id'].')">edit</button><button id="cd_button"  onclick="dl'.$rm.'('.$row['id'].')">delete</button>';}else if($row['pending']==1){echo "Published";}else {echo "Rejected";} ?></span>
		<?php echo $row['body']; ?>
	</div>
</div>
	<?php
}
?>
<style>
	.at_e,.at_d{
		border-radius: 2px !important;
	}
</style>
<script>
function gt<?php echo $rm ?>(data){
$("body,html").animate({
			scrollTop: 0
		},500);
$.ajax({
	url: '<?php get_domain("/") ?>blog/post_area.php',
	data: 'edit='+data,
	type: 'POST'
})
.done(function(data) {
	$(".mango_script").html(data);
})
.fail(function() {
	console.log("error");
})
.always(function() {
	console.log("complete");
});
}
</script>
<script>
function dl<?php echo $rm ?>(id){
	$(".confirmation<?php echo $rm ?>").html("Are you sure you want to delete it?");
	$(".confirmation<?php echo $rm ?>").dialog({
		modal: true,
		open: true,
		buttons:{
			"yes":function(){
				$.ajax({
					url: '<?php get_domain("/blog/post.del.php") ?>',
					type: 'POST',
					data: {id: id},
				})
				.done(function(data) {
					$(".confirmation<?php echo $rm ?>").dialog("close");
					$(".id"+id).fadeOut(1000);
				});
				
			},
			"no":function(){
				$(this).dialog("close");
			}
		}
	});
}
</script>
<div class="confirmation<?php echo $rm ?>" title="confirmation"></div><?php  mysqli_close($db); ?>