<?php 
include '../extra/db.extra.php';
session_start();
$user = $_SESSION['login_data_paipixel24'];
$team = $_GET['team'];
?>
<form action="" id="input_form">
	<input type="text" autocomplete="off" placeholder="type your Messages" style="width: 70%" name="cvs" class="input doe14574"><input type="submit" name="sbv" value="Send" class="input_button">
</form>
	<div class="comments_bcs">

	</div>
	<style>

.msg_corner a {
    color: blue;
    text-decoration: none;
}
.msg_corner p {
    font-family: cursive;
}
.msg_corner {
  background: #eee;
  width: max-content;
  padding: 10px;
  border-radius: 10px;
  margin-bottom: 5px;
  display: block;
  max-width: 90%;
}
.msg_corner.dasbin_corner {
    background: #C3FFFA;
}
	</style>
<script>
$(document).ready(function() {
	load_comments(0,25,"<?php echo $team ?>");
});
setInterval(function(){
	load_comments(0,25,"<?php echo $team ?>");
},2000);
</script>
<script>
	$(document).ready(function() {
		$("#input_form").submit(function(event) {
			event.preventDefault();
			var msg = $(".doe14574").val();
			var team = '<?php echo $team ?>';
	$.ajax({
		url: '<?php get_domain("/ajax/team/add_comment.php") ?>',
		type: 'GET',
		data: {msg: msg, team: team},
	})
	.done(function(data) {
		load_comments(0,25,"<?php echo $team ?>");
		$(".doe14574").val("");
	});
		});
	});
</script>