<?php include 'db.php'; ?>
<style>
.second-toolbar #logo{
		display: none !important;
	}

#cd_button {
  background: none;
  color: #ff3c00;
  border: 1px solid #ff3c00;
  border-radius: 11px;
  padding: 9px 20px;
}
#cd_button:hover {
  background: #ff3c00;
  color: white;
}

.atp {
  padding: 10px;
  background: #a3ff00;
  float: left;
  margin: 1%;
  border-radius: 10px;
}
</style>

<script>
	$(document).ready(function() {
		$.ajax({
			url: '<?php get_domain("/") ?>blog/post_area.php',
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
		
	});
</script>
<script>
	$(document).ready(function() {
		$.ajax({
			url: '<?php get_domain("/") ?>blog/total_post.php',
		})
		.done(function(data) {
			$(".all_post").html(data);
		});
		
	});
</script>
<div class="mainPosx" style="max-width: 1200px; margin: 1% auto;">
<div class="mango_script">
	Sorry Your Post Box hasn't Loaded !
</div>
<div class="algo_part">
	<span class="nots" style="padding: 1%; margin: 1% auto; visibility: hidden; border: 1px solid #ccc;"></span>
	<div class="all_post">
		No Previous Posts.
	</div>
</div>
</div>