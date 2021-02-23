<table class="data_table">
<tr>
	<th>Image</th>
	<th>User Name</th>
	<th>Rating</th>
</tr>	
<?php 
include '../extra/db.extra.php';
$member = $_POST['data'];
$us = substr($member,1); $us = explode(",", $us); for ($i=0; $i < count($us); $i++) {
$m = member_by_id($us[$i]);
$rating = more_user("rating",$m);
$image = more_user("image",$m);
?>
<tr>
	<td><img src="<?php get_domain("/") ?>content/<?php echo $image ?>" alt="<?php echo $m  ?>" style="width: 60px; height: 60px;"></td>
	<td><a href="<?php get_domain("/") ?>profile/<?php echo member_by_id($us[$i]) ?>" style="text-decoration: none;" ><span style="color: green; text-shadow: 0px 1px 1px green;"><?php echo my_name(member_by_id($us[$i])) ?><span></span></span></a></td>
	<td><?php echo $rating ?></td>
</tr>
<?php
}
?>
</table>