
<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
			session_start();
} else {
	include 'ajax/db_back.php';
}
?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/table.css?c">
<div class="container">
<div class="body_content content_area" style="width: 96%">

<h2>Open Challenges</h2>
<?php 
$team = user_detail("team");

?>

<div style="margin-top: 10px">
	<table class="func_table table_hoverable full_border attabe sweet_table">
		<tr>
			<th>Challenge Name</th>
			<th>Class / Subject</th>
			<th>Chapter</th>
			<th>Members</th>
			<th>Exam Time</th>
			<th>Options</th>
<?php 
$sql= "SELECT * FROM team_chal WHERE date>CURRENT_TIME AND parent=0 AND accept_id=0 ORDER BY id DESC";
$m = mysqli_query($db,$sql);
if (mysqli_num_rows($m)==0) {
?>
<tr>
	<td colspan="6" style="font-family: cursive;column-rule-width: 6;">No challenges Found</td>
</tr>
<?php
}
while ($row=mysqli_fetch_array($m)) {
?>
<tr style="font-family: cursive;">
	<td><?php echo $row['name'] ?></td>
	<td><?php echo $row['class'] ?>/<?php echo $row['subject'] ?></td>
	<td><?php echo $row['chapter'] ?></td>
	<!-- <td> -->
		<?php 
		// $us = substr($row['member'],1); $us = explode(",", $us); for ($i=0; $i < count($us); $i++) {
	?>
<!-- <a href="<?php get_domain("/") ?>profile/<?php echo member_by_id($us[$i]) ?>" style="text-decoration: none;" onclick="query_url(event,this,'from_main_body','<?php echo member_by_id($us[$i]) ?> | PaiPixel Online Exam','<?php get_domain("/") ?>profiles/<?php echo member_by_id($us[$i]) ?>')"><span style="color: green; text-shadow: 0px 1px 1px green;"><?php echo my_name(member_by_id($us[$i])) ?><span></span></span></a> -->

	<?php
	// 	if (($i+1)<count($us)) {
	// 		echo ", ";
	// 	}
	// }
	 ?>
	 	
	 <!-- </td> -->



	<td><?php $us = substr($row['member'],1); $us = explode(",", $us); 
	?>
<a href="javascript:void(0)" style="text-decoration: none;" onclick="open_ut('<?php echo $row['member']; ?>')"><span style="color: green; text-shadow: 0px 1px 1px green;"><?php echo count($us); ?><span></span></span></a>
</td>
	<td><?php echo date("h:i a, d M Y",strtotime($row['date'])) ?></td>

	<td><button class="button button_standard sweet_button" onclick="accept_it('<?php echo $row['id']; ?>','<?php echo user_detail("user_name") ?>')">Accept</button></td>			

</tr>
<?php
}
?>
	</table>
<?php $df4s = rand(); ?>
<?php $a254 = rand(); ?>
<script>
	function accept_it(id,user)
	{
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/team_exam/accept_team_chal.php',
			type: 'GET',
			data: {id: id,user:user},
		})
		.done(function(data) {
			var title;
			if ($.trim(data)=='1') {
			$(".as<?php echo $a254 ?>").html("please Contact your Team Leader / Co-Leader To accept this Team Challenge.");
			title = "Message";
			} else if ($.trim(data)=='2'){
			$(".as<?php echo $a254 ?>").html("You are not permited to accept the challenge.");
			title = "Message";
			} else {
			title = "Success";
			$(".as<?php echo $a254 ?>").html(data);
			}
			$(".as<?php echo $a254 ?>").dialog({
				open: true,
				modal: true,
				width: "auto",
				show: "fade",
				title: "Message",
				buttons:{
					"Close":function()
					{
						$(this).dialog("close");
					}
				}
			});
		});
	}
</script>
<div class="as<?php echo $df4s ?>"></div>
<div class="as<?php echo $a254 ?>"></div>
<script>
	function open_ut(data)
	{
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/team_exam/view_dorsok.php',
			type: 'POST',
			data: {data: data},
		})
		.done(function(data) {
			$(".as<?php echo $df4s ?>").html(data);
			$(".as<?php echo $df4s ?>").dialog({
				open: true,
				modal:true,
				title: "Members",
				buttons:{
					"ok":function(){
						$(this).dialog("close");
					}
				}
			});
		})
		.fail(function() {
			alert("Network Error");
		});
		
	}
</script>
</div>



















<br><br>
<h2>LIVE Challenges</h2>




<?php 

date_default_timezone_set("Asia/Dhaka");
$my_time = time();
$new_date = date("Y-m-d H:i:s",$my_time);


$sql= "SELECT * FROM team_chal WHERE DATE_ADD(date, INTERVAL 1 DAY)>'$new_date' AND date<'$new_date' ORDER BY id DESC";
$m = mysqli_query($db,$sql);
?>
<div style="margin-top: 10px">

	<table class="func_table table_hoverable full_border attabe">
		<tr>
			<th>Challenging Team</th>
			<th>Accepting Team</th>
			<th>Details</th>
			<th>Exam Date</th>
			<th>View Result</th>
		</tr>
<?php 
if (mysqli_num_rows($m)==0) {
?>
<tr>
	<td colspan="6" style="font-family: cursive;column-rule-width: 6;">No challenges Found</td>
</tr>
<?php
}
while ($row=mysqli_fetch_array($m)) {
	$this_cl = rand();
	$date = $row['date'];
	$int_date = strtotime($date);
	$one_hour_add = (($int_date)+3600);
	$now_date = time();
$r25  = rand();
	if ($row['accept_id']==1 && $row['parent']==0) {
		$aid = $row['id'];
		$sql = "SELECT * FROM `team_chal` WHERE parent='$aid'";
		$o = mysqli_query($db,$sql);
		$find = mysqli_fetch_array($o);
	?>
<tr style="font-family: cursive;" class="table_data<?php echo $this_cl ?>">
	<td>
		<?php echo get_team($row['team']) ?>
	</td>
	<td >
		<?php echo get_team($find['team']) ?>
	</td>
	<td>
<?php echo $row['class']; ?> / <?php echo $row['subject']; ?> / <?php echo $row['chapter']; ?>
	</td>


		<td><?php echo date("h:i a, d M Y",strtotime($row['date'])) ?>

		<?php $af = rand(); ?>
		
		<div class="ts<?php echo $af; ?>"></div>
		<script>
		setInterval(function(){
			$.ajax({
				url: "<?php get_domain("/"); ?>ajax/extra/time_runner.php",
				type: "GET",
				data:'time=<?php echo $row['date']; ?>',
				success:function(data){
					$(".ts<?php echo $af; ?>").html(data);
				}

			});
		},1000);
		</script>
		<?php 
$tr = 0;
$us = substr($find['member'],1); $us = explode(",", $us); 
for ($i=0; $i < count($us); $i++) { 
	if (user_detail('id')==$us[$i]) {
		$tr = $find['id'];
	}
}
if ($tr==0) {
$us = substr($row['member'],1); $us = explode(",", $us); 
for ($i=0; $i < count($us); $i++) { 
	if (user_detail('id')==$us[$i]) {
		$tr = $row['id'];
	}
}
}
		 ?>
		</td>
	<td>
	<button class="button button_standard sweet_button" onclick="window.location='<?php get_domain("/exam.php?team&exam_details=".$row['id']); ?>'">View Result</button>
	<?php if ($tr!=0): ?>
		
	<button class="button button_standard sweet_button gt_button<?php echo $r25 ?>" onclick="window.location='<?php get_domain("/exam.php?team&exam=".$tr); ?>'">Join Exam</button>
	<?php endif ?>
</td>	



</tr>
	<?php
	}
}
?>
	</table>
</div>
<div class="as<?php echo $df4s = rand(); ?>"></div>
<script>
  function open_ut(data)
  {
    $.ajax({
      url: '<?php get_domain("/") ?>ajax/team_exam/view_dorsok.php',
      type: 'POST',
      data: {data: data},
    })
    .done(function(data) {
      $(".as<?php echo $df4s ?>").html(data);
      $(".as<?php echo $df4s ?>").dialog({
        open: true,
        modal:true,
        title: "Members",
        buttons:{
          "ok":function(){
            $(this).dialog("close");
          }
        }
      });
    })
    .fail(function() {
      alert("Network Error");
    });
    
  }
</script>








<br>
<br>


<h2>Upcoming Callenges</h2>




<?php 
date_default_timezone_set("Asia/Dhaka");
$my_time = time();
$new_date = date("Y-m-d H:i:s",$my_time);
$sql= "SELECT * FROM team_chal WHERE accept_id=1 AND res=0 AND date>CURRENT_TIME ORDER BY date DESC";
$m = mysqli_query($db,$sql);
?>
<div style="margin-top: 10px">

	<table class="func_table table_hoverable full_border attabe">
		<tr>
			<th>Challenging Team</th>
			<th>Accepting Team</th>
			<th>Details</th>
			<th>Exam Date</th>
			<th>Members</th>
		</tr>
<?php 
if (mysqli_num_rows($m)==0) {
?>
<tr>
	<td colspan="6" style="font-family: cursive;column-rule-width: 6;">No challenges Found</td>
</tr>
<?php
}
while ($row=mysqli_fetch_array($m)) {
	$this_cl = rand();
	$date = $row['date'];
	$int_date = strtotime($date);
	$one_hour_add = (($int_date)+3600);
	$now_date = time();
$r25  = rand();
	if ($row['accept_id']==1 && $row['parent']!=0) {
		$aid = $row['parent'];
		$sql = "SELECT * FROM `team_chal` WHERE id='$aid'";
		$o = mysqli_query($db,$sql);
		$find = mysqli_fetch_array($o);
	?>
<tr style="font-family: cursive;" class="table_data<?php echo $this_cl ?>">
	<td>
		<?php echo get_team($find['team']) ?>
	</td>
	<td >
		<?php echo get_team($row['team']) ?>
	</td>
	<td>
<?php echo $find['class']; ?> / <?php echo $find['subject']; ?> / <?php echo $find['chapter']; ?>
	</td>


		<td><?php echo date("h:i a, d M Y",strtotime($find['date'])) ?>

		<?php $af = rand(); ?>
		
		<div class="ts<?php echo $af; ?>"></div>
		<script>
		setInterval(function(){
			$.ajax({
				url: "<?php get_domain("/"); ?>ajax/extra/time_runner.php",
				type: "GET",
				data:'time=<?php echo $find['date']; ?>',
				success:function(data){
					$(".ts<?php echo $af; ?>").html(data);
				}

			});
		},1000);
		</script>
		<td><?php $us = substr($row['member'],1); $us = explode(",", $us); 
	?>
<a href="javascript:void(0)" style="text-decoration: none;" onclick="open_ut('<?php echo $row['member']; ?>')"><span style="color: green; text-shadow: 0px 1px 1px green;"><?php echo count($us); ?><span></span></span></a>
vs

<?php 
$us = substr($find['member'],1); $us = explode(",", $us); 
	?>
<a href="javascript:void(0)" style="text-decoration: none;" onclick="open_ut('<?php echo $find['member']; ?>')"><span style="color: green; text-shadow: 0px 1px 1px green;"><?php echo count($us); ?><span></span></span></a>
</td>

</td>	



</tr>
	<?php
	}
}
?>
	</table>
</div>
<div class="as<?php echo $df4s = rand(); ?>"></div>
<script>
  function open_ut(data)
  {
    $.ajax({
      url: '<?php get_domain("/") ?>ajax/team_exam/view_dorsok.php',
      type: 'POST',
      data: {data: data},
    })
    .done(function(data) {
      $(".as<?php echo $df4s ?>").html(data);
      $(".as<?php echo $df4s ?>").dialog({
        open: true,
        modal:true,
        title: "Members",
        buttons:{
          "ok":function(){
            $(this).dialog("close");
          }
        }
      });
    })
    .fail(function() {
      alert("Network Error");
    });
    
  }
</script>


































<br>
<br>


<h2>Past Callenges</h2>




<?php 
date_default_timezone_set("Asia/Dhaka");

$new_date = date("Y-m-d H:i:s");
$sql= "SELECT * FROM team_chal WHERE date<'$new_date' AND res=1 ORDER BY id DESC";
$m = mysqli_query($db,$sql);
?>
<div style="margin-top: 10px">

	<table class="func_table table_hoverable full_border attabe">
		<tr>
			<th>Challenging Team</th>
			<th>Accepting Team</th>
			<th>Details</th>
			<th>Exam Date</th>
			<th>View Result</th>
		</tr>
<?php 
if (mysqli_num_rows($m)==0) {
?>
<tr>
	<td colspan="6" style="font-family: cursive;column-rule-width: 6;">No challenges Found</td>
</tr>
<?php
}
while ($row=mysqli_fetch_array($m)) {
	$this_cl = rand();
	$date = $row['date'];
	$int_date = strtotime($date);
	$one_hour_add = (($int_date)+3600);
	$now_date = time();
$r25  = rand();
	if ($row['accept_id']==1 && $row['parent']!=0) {
		$aid = $row['parent'];
		$sql = "SELECT * FROM `team_chal` WHERE id='$aid'";
		$o = mysqli_query($db,$sql);
		$find = mysqli_fetch_array($o);
	?>
<tr style="font-family: cursive;" class="table_data<?php echo $this_cl ?>">
	<td>
		<?php echo get_team($find['team']) ?>
	</td>
	<td >
		<?php echo get_team($row['team']) ?>
	</td>
	<td>
<?php echo $find['class']; ?> / <?php echo $find['subject']; ?> / <?php echo $find['chapter']; ?>
	</td>


		<td><?php echo date("h:i a, d M Y",strtotime($find['date'])) ?>

		<?php $af = rand(); ?>
		
		<div class="ts<?php echo $af; ?>"></div>

		</td>
	<td>
	<button class="button button_standard sweet_button" onclick="window.location='<?php get_domain("/exam.php?team&exam_details=".$row['id']); ?>'">View Result</button>
</td>	



</tr>
	<?php
	}
}
?>
	</table>
</div>
<div class="as<?php echo $df4s = rand(); ?>"></div>
<script>
  function open_ut(data)
  {
    $.ajax({
      url: '<?php get_domain("/") ?>ajax/team_exam/view_dorsok.php',
      type: 'POST',
      data: {data: data},
    })
    .done(function(data) {
      $(".as<?php echo $df4s ?>").html(data);
      $(".as<?php echo $df4s ?>").dialog({
        open: true,
        modal:true,
        title: "Members",
        buttons:{
          "ok":function(){
            $(this).dialog("close");
          }
        }
      });
    })
    .fail(function() {
      alert("Network Error");
    });
    
  }
</script>






















</div>
</div>
