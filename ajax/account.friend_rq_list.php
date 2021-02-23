<?php 
include 'db.php';
session_start();
$user = $_SESSION['login_data_paipixel24'];
$sql = "SELECT * FROM user WHERE user_name='$user'";
$mysq = mysqli_query($db,$sql);
$row = mysqli_fetch_array($mysq);
$friends = $row['friend'];
$fr_rq = $row['fr_rq'];
$ex_fr = explode(",", $fr_rq);
?>
<div style="overflow: hidden; max-width: 1000px; margin: 10px auto;">
<?php
if (count($ex_fr)==0) {
	echo "<h2 style='float:left;'>No Requests !</h2><a href='#friend_rq' style='float: right; font-size: 20px;' class='aos15'>Show Friends List</a>";
} else {
	echo "<h2 style='float:left;'>Total Request: ".(count($ex_fr)-1)."</h2><a href='#friend_rq'  style='font-family: arial; padding: 10px; border: 1px solid #ccc; color: #0D0B0B; float: right; text-decoration: none; background: #95E0FE; display: inline-block;' href='#friend_rq' style='float: right; font-size: 20px;' class='aos15'>Show Friends List</a>";
	?>
<script>
	$(document).ready(function() {
		$(".aos15").click(function() {
			$.ajax({
				url: '<?php get_domain("/ajax/account.friends.php") ?>',
				type: 'POST',
			})
			.done(function(data) {
				$(".account_view").html(data);
			});
		});
	});
</script>
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
  margin: 0px;
  box-shadow: 0px 0px 4px 1px #ccc;
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
.button_green_light {
  text-align: center;
  padding: 10px;
  display: block;
  width: 60%;
  margin: 10px auto;
  color: green;
  border: 1px solid green;
  text-decoration: none;
  font-family: cursive;
  transition: .4s;
}
.button_green_light:hover {
  background: green;
  color: white;
}
.button_red_light {
  text-align: center;
  padding: 10px;
  display: block;
  width: 60%;
  margin: 10px auto;
  color: red;
  border: 1px solid red;
  text-decoration: none;
  font-family: cursive;
  transition: .4s;
}
.button_red_light:hover {
  background: red;
  color: white;
}
</style>
<script>
function accept_friend(id,div,user) {
	$.ajax({
		url: '<?php get_domain("/ajax/account.confirm_friend.php") ?>',
		type: 'POST',
		data: "user="+user,
		before:function(){
			$("#"+id).html("Please Wait...");
		}
	})
	.done(function(data) {
		$("#"+id).html(data);
		setTimeout(function(){
			$(div).fadeOut(2000);
		},1000);
	});
	
}
function delete_friend(id,div,user) {
	$.ajax({
		url: '<?php get_domain("/ajax/account.delete_request.php") ?>',
		type: 'POST',
		data: "user="+user,
		before:function(){
			$("#"+id).html("Please Wait...");
		}
	})
	.done(function(data) {
		$("#"+id).html(data);
		setTimeout(function(){
			$(div).fadeOut(2000);
		},1000);
	});
	
}

</script>
<div class="friend_section" id="my_friends">
<?php 
for ($i=1; $i < count($ex_fr); $i++) { 
 	$user = $ex_fr[$i];
 	$sql = "SELECT * FROM user WHERE user_name='$user'";
 	$q = mysqli_query($db,$sql);
 	$row = mysqli_fetch_array($q);
 ?>
		<div class="friend_box" id="friend<?php echo $i ?>">
			<div class="aside">
			<img src="<?php get_domain("/content/") ?><?php echo $row['image'] ?>" alt="">
			</div>
			<div class="aside">
				<h2><a href="http://localhost/profile/<?php echo $user; ?>" ><?php echo $user; ?></a></h2>
				<h3>Rating <b style="font-family: arial"><?php echo $row['rating']; ?></b></h3>
				<a href="javascript:void(0)" id="a4<?php echo $user ?>" onclick="accept_friend(this.id,'#friend<?php echo $i ?>','<?php echo $user; ?>');" class="button_green_light"> Confirm</a>
				<a href="javascript:void(0)" id="a5<?php echo $user ?>" onclick="delete_friend(this.id,'#friend<?php echo $i ?>','<?php echo $user; ?>');" class="button_red_light"> Reject</a>
			</div>
		</div>
<?php } ?>
</div>
	</div>
	<?php }
?>
</div>