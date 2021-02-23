<form action="" id="date_s">
	<input type="date" id="from" style="padding: 8px;"> to <input type="date" id="to" style="padding: 8px;"> <input type="submit" value="search" name="search" style="padding:10px">
<?php include 'db.php'; ?>
</form>

<script>
	function search_dos(){
		var from = $("#from").val();
		var to = $("#to").val();
		$.ajax({
			url: '<?php get_domain("/ajax/account.asked_q2.php") ?>',
			type: 'POST',
			data: {from: from,to:to},
			beforeSend:function(){
				$(".content").html("Loading...");
			}
		})
		.done(function(data) {
			$(".content").html(data);
		});
		
	}
</script>
<script>
	$(document).ready(function() {
		$("#date_s").submit(function(event) {
			event.preventDefault();
			search_dos();
		});
			search_dos();
	});
</script>
<div class="content">
	
</div>