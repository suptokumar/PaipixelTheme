<?php 
include 'db.php';
session_start();
$user = $_SESSION['login_data_paipixel24'];
$sql = "SELECT * FROM user WHERE user_name='$user'";
$mysq = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysq);
$friends = $row['friend'];
$fr_rq = $row['fr_rq'];
$ex_rq = explode(",", $fr_rq);
$ex_fr = explode(",", $friends);
?>
<div style="overflow: hidden; max-width: 1000px; margin: 10px auto;">
	<script>
	$(document).ready(function() {
		$(".aos15").click(function() {
			$.ajax({
				url: '<?php get_domain("/ajax/account.friend_rq_list.php") ?>',
				type: 'POST',
			})
			.done(function(data) {
				$(".account_view").html(data);
			});
		});
	});
</script>
<?php
if (count($ex_fr)==1) {
	echo "<h2 style='float:left;'>No friends !</h2><a href='#friend_rq' style='float: right; font-size: 20px;' class='aos15'>Show Friend Request(".(count($ex_rq)-1).")</a>";
} else {
	echo "<h2 style='float:left;'>Total Friends: ".(count($ex_fr)-1)."</h2><a style='font-family: arial; padding: 10px; border: 1px solid #ccc; color: #0D0B0B; float: right; text-decoration: none; background: #95E0FE; display: inline-block;' href='#friend_rq' style='float: right; font-size: 20px;' class='aos15'>Show Friend Request(".(count($ex_rq)-1).")</a>";
	?>

<style>
	#my_friends {
  clear: both;
  margin-top: 10px;
}
#my_friends .friend_box{
  width: 160px;
  border: 1px solid #ccc;
  display: inline-block;
  overflow: hidden;
  text-align: center;
  background: linear-gradient(rgba(255,2,25,.01),rgba(0,220,255,.2));
  margin: 10px;
  transition: .4s;
}
#my_friends .friend_box:hover {
  padding: 10px;
  margin: 0px;  box-shadow: 0px 0px 4px 1px #ccc;
}
#my_friends img {
  height: 120px;
}
#my_friends .friend_box h2{
  font-size: 19px;
  padding: 5px;
}
#my_friends .friend_box h2 a{
  color: tomato;
}
#my_friends .friend_box h3{
  font-size: 17px;
}
</style>
<div class="friend_section" id="my_friends">
<?php 
for ($i=1; $i < count($ex_fr); $i++) { 
 	$user = $ex_fr[$i];
 	$sql = "SELECT * FROM user WHERE user_name='$user'";
 	$q = mysqli_query($db,$sql);
 	if (mysqli_num_rows($q)==0) {
 		continue;
 	}
 	$row = mysqli_fetch_array($q);
 ?>
		<div class="friend_box">
			<div class="aside">
			<img src="<?php echo get_domain("/content/") ?><?php echo $row['image'] ?>" alt="">
			</div>
			<div class="aside">
				<h2><a href="http://localhost/profile/<?php echo $row['user_name'] ?>"><?php echo $row['user_name'] ?></a></h2>
				<h3>Rating <b style="font-family: arial"><?php echo $row['rating'] ?></b></h3>
			</div>
		</div>
<?php } ?>
</div>
	</div>
	<?php }
?>
</div>