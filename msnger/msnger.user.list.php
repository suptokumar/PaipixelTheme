
<center class="pre_loader"></center>

<?php 
include '../ajax/db.php';
$profile = $_POST['user'];
session_start();
$me = $_SESSION['login_data_paipixel24'];
$sql = "SELECT id FROM user WHERE user_name='$me'";
$m = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m);
$mea=$r[0];
$sql = "SELECT * FROM user WHERE friend LIKE '%,$me%' and user_name!='$me' ORDER BY active DESC LIMIT 200";
$q = mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($q)) {
	$active = $row['active'];
	date_default_timezone_set("Asia/Dhaka");
	$status;
	$date_time = date("Y-m-d H:i:s");
	$img = $row['image'];
	$id = $row['id'];
	$sql = "SELECT * FROM msg WHERE (f_from='$id' and f_to='$mea') OR (f_from='$mea' and f_to='$id') ORDER BY id DESC";
	$s = mysqli_query($db,$sql);
	$r = mysqli_fetch_array($s);
	$the_conseft = $r['msg'];
	$date = $r['date'];
	if ((strtotime($date_time)-strtotime($active))>10) {
		$status = 'active_status not_active';
	} else {
		$status = 'active_status';
	}
	if ($img=='') {
		$img = 'image/user.PNG';
	}
	?>
<li><a href="javascript:void(0)" class="data_users data_<?php echo $row['id'] ?>" onclick="add_user_to_msg('<?php echo $row['id'] ?>')" user="<?php echo $row['id'] ?>"><img src="<?php echo $img ?>" alt="Image"><span id="aboco<?php echo $row['id'] ?>" style="font-size: 18px; color: green;"><?php echo $row['user_name'] ?> <i class="goggle<?php echo $row['id'] ?>"></i></span><span class="<?php echo $status ?>" id="active<?php echo $row['id'] ?>"></span>
<span class="pre_text" id="text_usl<?php echo $row['id'] ?>" style="display: block; clear: both; text-align: right; width: 95%"><?php echo $the_conseft ?> </span>
</a></li>
<script>
	setInterval(function(){
		$.ajax({
			url: "<?php get_domain("/") ?>msnger/msnger.dmc.php",
			type: "POST",
			data: "profile=<?php echo $row['id'] ?>&me=<?php echo $me; ?>",
			success:function(data){
				$("#text_usl<?php echo $row['id'] ?>").html(data);	
			}
		});
	},1000);
</script>
<script>
	setInterval(function(){
		$.ajax({
			url: "<?php get_domain("/") ?>msnger/msnger.check_unread.php",
			type: "POST",
			data: "profile=<?php echo $row['id'] ?>&me=<?php echo $me; ?>",
			success:function(data){
				if ($.trim(data)==0) {
				$(".goggle<?php echo $row['id'] ?>").html("");
				$(".data_<?php echo $row['id'] ?>").css("background", "#FFF");
				}else {
				$(".data_<?php echo $row['id'] ?>").css("background", "#E8FEF4");
				$(".goggle<?php echo $row['id'] ?>").html("("+$.trim(data)+")");
				}
			}
		});
	},1000);
</script>
<script>
	setInterval(function(){
		$.ajax({
			url: "msnger/msnger.dianamic.content.php",
			type: "POST",
			data: "me=<?php echo $row['user_name'] ?>",
			success:function(data){
				if (data=='1') {
				$("#active<?php echo $row['id'] ?>").removeClass("not_active");
				} else {
				$("#active<?php echo $row['id'] ?>").addClass("not_active");
				}
			}
		});
	},1000);
</script>

	<?php
}

?>

