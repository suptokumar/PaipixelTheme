<div class="full_border" style="margin-top: 10px">
	
<?php 
include '../extra/db.extra.php';
$team = $_GET['team'];
session_start();
$own= user_detail("team");
if((user_detail("position_in_team")=='Leader' || user_detail("position_in_team")=='Co-Leader') && $team==$own)
{
 ?>

<a href="javascript:void(0)" class="button button_standard" style="background: #170068; color: white;" onclick="add_challenge(<?php echo $team ?>)">Add Challenge</a>

 <?php
}
?>
<?php 
$sql= "SELECT * FROM team_chal WHERE team='$team' ORDER BY id DESC";
$m = mysqli_query($db,$sql);
?>
<div style="margin-top: 10px">

	<table class="func_table table_hoverable full_border attabe">
		<tr>
			<th>Challenge Name</th>
			<th>Subject / Chapter</th>
			<th>Members</th>
			<th>Exam Date</th>
			<th>Option</th>
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
	<td colspan="2" style="color: #170068">
		We accepted challenge from <?php echo get_team($find['team']) ?>. Challenge Description: <?php echo $find['name'] ?>
	</td>
	<td><?php $us = substr($row['member'],1); $us = explode(",", $us); for ($i=0; $i < count($us); $i++) {
	?>
<a href="<?php get_domain("/") ?>profile/<?php echo member_by_id($us[$i]) ?>" style="text-decoration: none;text-shadow: none;"><?php echo my_name(member_by_id($us[$i])) ?><span></span></a>

	<?php
		if (($i+1)<count($us)) {
			echo ", ";
		}
	} ?></td>


		<td><?php echo date("h:i a, d M Y",strtotime($find['date'])) ?>

		<?php $af = rand(); ?>
		
		<div class="ts<?php echo $af; ?>"></div>
		<script>
		setInterval(function(){
			$.ajax({
				url: "<?php get_domain("/"); ?>ajax/extra/time_runner.php",
				type: "GET",
				data:'time=<?php echo $find['date']; ?>',
				success:function(data)
				{
					if (data=='Exam Started') {
						$(".ts<?php echo $af; ?>").html(data);
						$(".at_button<?php echo $r25 ?>").hide(0);
						$(".gt_button<?php echo $r25 ?>").show(0);
				} else if (data=='Exam Finished') {
						$(".ts<?php echo $af; ?>").html(data);
						$(".at_button<?php echo $r25 ?>").hide(0);
						$(".gt_button<?php echo $r25 ?>").hide(0);
						$(".ft_button<?php echo $r25 ?>").show(0);
				} else {
					$(".ts<?php echo $af; ?>").html(data);
				}
			}
			});
		},1000);
		</script>
		</td>
	<td>

	<button class="button button_standard sweet_button ft_button<?php echo $r25 ?>" style="display: none" onclick="window.location='<?php get_domain("/exam.php?team&exam_details=".$row['id']); ?>'">View Result</button>

	<button class="button button_standard sweet_button at_button<?php echo $r25 ?>" onclick="open_ut('<?php echo $find['member']; ?>')">Opponent Members</button>		
	
	<?php
$us = substr($row['member'],1); $us = explode(",", $us); 
for ($i=0; $i < count($us); $i++) {

if (user_detail("user_name")==member_by_id($us[$i])) {
	?>
	<button class="button button_standard sweet_button at_button<?php echo $r25 ?>" onclick="window.location='<?php get_domain("/exam.php?add_question&equality=".$row['id']); ?>'">Add Question</button>
	<button class="button button_standard sweet_button gt_button<?php echo $r25 ?>" style="display: none" onclick="window.location='<?php get_domain("/exam.php?team&exam=".$row['id']); ?>'">Join Exam</button>
	<?php
}
}

?></td>	



</tr>
	<?php
	} else if ($row['accept_id']==1 && $row['parent']==0) {
		$aid = $row['id'];
		$sql = "SELECT * FROM `team_chal` WHERE parent='$aid'";
		$o = mysqli_query($db,$sql);
		$find = mysqli_fetch_array($o);
		$r25  = rand();
	?>
<tr style="font-family: cursive;">
	<td colspan="2" style="color: #170068">
		The team <?php echo get_team($find['team']) ?> Accepted our challenge (<?php echo $row['name'] ?>)
	</td>
	<td><?php $us = substr($row['member'],1); $us = explode(",", $us); for ($i=0; $i < count($us); $i++) {
	?>
<a href="<?php get_domain("/") ?>profile/<?php echo member_by_id($us[$i]) ?>" style="text-decoration: none;"><span style="color: green;"><?php echo my_name(member_by_id($us[$i])) ?><span></span></span></a>

	<?php
		if (($i+1)<count($us)) {
			echo ", ";
		}
	} ?></td>


		<td><?php echo date("h:i a, d M Y",strtotime($row['date'])) ?>
			<?php $af = rand(); ?>
		
		<div class="ts<?php echo $af; ?>"></div>
		<script>
		setInterval(function(){
			$.ajax({
				url: "<?php get_domain("/"); ?>ajax/extra/time_runner.php",
				type: "GET",
				data:'time=<?php echo $row['date']; ?>',
				success:function(data)
				{
					if (data=='Exam Started') {
						$(".ts<?php echo $af; ?>").html(data);
						$(".at_button<?php echo $r25 ?>").hide(0);
						$(".gt_button<?php echo $r25 ?>").show(0);
				} else if (data=='Exam Finished') {
						$(".ts<?php echo $af; ?>").html(data);
						$(".at_button<?php echo $r25 ?>").hide(0);
						$(".gt_button<?php echo $r25 ?>").hide(0);
						$(".ft_button<?php echo $r25 ?>").show(0);
				} else {
						$(".at_button").show(0);
					$(".ts<?php echo $af; ?>").html(data);
				}
			}
			});
		},1000);
		</script>
		</td>
	<td>

	<button class="button button_standard sweet_button ft_button<?php echo $r25 ?>" style="display: none" onclick="window.location='<?php get_domain("/exam.php?team&exam_details=".$row['id']); ?>'">View Result</button>

	<button class="button button_standard sweet_button at_button<?php echo $r25 ?>" onclick="open_ut('<?php echo $find['member']; ?>')">Opponent Members</button>				
	<?php
$us = substr($row['member'],1); $us = explode(",", $us); 
for ($i=0; $i < count($us); $i++) {
if (user_detail("user_name")==member_by_id($us[$i])) {
	?>
	<button class="button button_standard sweet_button at_button<?php echo $r25 ?>" onclick="window.location='<?php get_domain("/exam.php?add_question&equality=".$row['id']); ?>'">Add Question</button>
	<button class="button button_standard sweet_button gt_button<?php echo $r25 ?>" style="display: none"  onclick="window.location='<?php get_domain("/exam.php?team&exam=".$row['id']); ?>'">Join Exam</button>
	<?php
}
}
			?></td>	



</tr>
	<?php
	}




	 else {
?>
<tr style="font-family: cursive;">
	<td><?php echo $row['name'] ?></td>
	<td><?php echo $row['subject'] ?>/ <?php echo $row['chapter']; $us_n = ''; ?></td>
	<td><?php $us = substr($row['member'],1); $us = explode(",", $us); for ($i=0; $i < count($us); $i++) {
	?>
<a href="<?php get_domain("/") ?>profile/<?php echo member_by_id($us[$i]) ?>" style="text-decoration: none;"><?php echo my_name(member_by_id($us[$i])) ?><span></span></a>

	<?php
		if (($i+1)<count($us)) {
			echo ", ";
		}
	} ?></td>
	<td><?php echo date("h:i a, d M Y",strtotime($row['date'])) ?></td>
	<td><?php 
if ((user_detail("position_in_team")=='Leader' || user_detail("position_in_team")=='Co-Leader') && $team==$own) {
	?>
	<button class="button button_standard sweet_button" onclick="edit_team_chal('<?php echo $row['id']; ?>')">Edit</button>		
	<?php
}
$us = substr($row['member'],1); $us = explode(",", $us); 
for ($i=0; $i < count($us); $i++) {
if (user_detail("user_name")==member_by_id($us[$i])) {
	?>
	<button class="button button_standard sweet_button" onclick="window.location='<?php get_domain("/exam.php?add_question&equality=".$row['id']); ?>'">Add Question</button>
	<?php
}
}
			?></td>	
</tr>
<?php
}
}
?>
	</table>
</div>
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