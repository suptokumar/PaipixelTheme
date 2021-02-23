<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Annoucement - aipixel Dashboard</title>
</head>
<body>
	<?php 
include 'db.php';
$sql = "SELECT * FROM `announce` WHERE pending=0";
$m = mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($m)) {
?>
<div class="announce" id="ao<?php echo $row['id'] ?>" style="overflow: hidden; max-width: 1000px; margin: 0px auto; margin: 1% auto; border: 1px solid #ccc; padding: 1%; background: #DFFFF0">
	<h3><?php echo $row['header'] ?></h3>
	<p>by <strong><a href="<?php get_domain("/profile/") ?><?php echo $row['user'] ?>"><?php echo $row['user'] ?></a></strong> at <time><?php echo $row['datetime'] ?></time></p>
	<button class="cd_button" onclick="approve(<?php echo $row['id'] ?>)">Approve</button><button class="cd_button" onclick="reject(<?php echo $row['id'] ?>)">Reject</button>
	<div class="body">
		<?php echo $row['body'] ?>
	</div>
</div>
<?php
}
?>
<style>
	* {
		font-family: arial;
	}
	img {
		max-width: 100%;
	}
</style>
<script>
function approve(id){
$.ajax({
	url: 'approve.anc.php',
	type: 'POST',
	data: {id: id},
})
.done(function() {
	$("#ao"+id).fadeOut(1200);
});

}
function reject(id){
$.ajax({
	url: 'reject.anc.php',
	type: 'POST',
	data: {id: id},
})
.done(function() {
	$("#ao"+id).fadeOut(1200);
});

}
</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</body>
</html>
