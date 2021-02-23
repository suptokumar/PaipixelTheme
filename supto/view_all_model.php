<?php 
include 'db.php';
$exam_id = $_POST['id'];
$sql = "SELECT * FROM question WHERE exam_id='$exam_id' ORDER BY id DESC";
$m = mysqli_query($db,$sql);
$i = 0;
while ($row=mysqli_fetch_array($m)) {
$i++;
?>
<div class="question" style="margin: 1% 0%; background: #fff; padding: 1%; border: 1px solid #20b99d;">
	<div class="status" style="float:right; background:<?php if($row['pending']==1){echo '#20b99d';} if($row['pending']==0){echo '#ffd640';} if($row['pending']==2){echo 'tomato';} ?>; padding: 10px;"><?php if($row['pending']==1){echo color("Approved","white");} if($row['pending']==0){echo color("Pending","black");} if($row['pending']==2){echo color("Rejected","white");} ?></div>
	<div class="header" style="font-weight: bold; overflow: hidden;"><?php echo  $row['question'] ?></div>
	<div class="body">
		<div class="r" style="overflow: hidden;"><div class="as" style="float: left"><?php echo translate("A") ?>. </div><div class="as" style="float:left"><?php echo $row['opt1'] ?></div></div>
		<div class="r" style="overflow: hidden;"><div class="as" style="float: left"><?php echo translate("B") ?>. </div><div class="as" style="float:left"><?php echo $row['opt2'] ?></div></div>
		<div class="r" style="overflow: hidden;"><div class="as" style="float: left"><?php echo translate("C") ?>. </div><div class="as" style="float:left"><?php echo $row['opt3'] ?></div></div>
		<div class="r" style="overflow: hidden;"><div class="as" style="float: left"><?php echo translate("D") ?>. </div><div class="as" style="float:left"><?php echo $row['opt4'] ?></div></div>
		<div class="r" style="overflow: hidden;"><div class="as" style="float: left; font-weight: bold">Answer:&nbsp;&nbsp;</div><div class="as" style="float:left"> <?php echo $row['currect'] ?></div></div>
		<div class="r" style="overflow: hidden;"><div class="as" style="float: left; font-weight: bold">Explaination: </div><div class="as" style="float:left"> <?php echo $row['details'] ?> </div></div>
		<div class="r" style="overflow: hidden;"><div class="as" style="float: left;font-weight: bold">Audio explaination:&nbsp;&nbsp;</div><div class="as" style="float:left"> <?php if($row['audio_explain']==''){echo color("No","red");}else { echo color("Yes","green");} ?> </div></div>
		<?php 
if ($row['pending']==2) {
	$q_id = $row['id'];
	$sql = "SELECT * FROM `reject_msg` WHERE q_id='$q_id' ORDER BY id DESC LIMIT 1";
	$s = mysqli_query($db,$sql);
	$co = mysqli_fetch_array($s);
?>
<div class="r" style="overflow: hidden;"><div class="as" style="float: left; font-weight: bold">Reason for Rejection:&nbsp;&nbsp;</div><div class="as" style="float:left; color: #e22bdf;"> <?php echo $co['msg'] ?></div></div>
<?php
}
		?>
	</div>
	<a href="javascript:void(0)" onclick="edit_question('<?php echo $row['id'] ?>','<?php echo $row['setter'] ?>')" style="padding: 10px; border: 1px solid; color: white; background: green; text-decoration: none;  display: inline-block;">Edit</a>
</div>
<?php
}
if (mysqli_num_rows($m)==0) {
	echo "No Questions Found !";
}
	?>