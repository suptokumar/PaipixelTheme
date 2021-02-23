<?php 
$team = $_POST['team'];
include '../extra/db.extra.php';
$sql = "SELECT * FROM team WHERE rand_id='$team'";
$r = mysqli_query($db,$sql);
$row = mysqli_fetch_array($r);
?>
<form action="" id="team_dfcreater_from">
		<div class="form_handler">	
		<label for="team_name">Team Name</label>
		<input type="text" id="team_name" name="team_name" value="<?php echo $row['team_name'] ?>" class="last_border input">
		</div>
		<div class="form_handler">	
		<label for="description_team">Team Description</label>
		<textarea id="description_team" name="description_team" class="full_border input"><?php echo $row['description']; ?></textarea>
		</div>
		<div class="form_handler">	
		<label for="team_class">Team Class</label>
		<?php 
function check_tamp_cls($a,$b){
if ($a==$b) {
	echo "selected";
}
}
function check_tamp_type($a,$b){
if ($a==$b) {
	echo "selected";
}
}
		 ?>
		<select name="team_class" id="team_class" class="full_border input">
			<option value="8" <?php check_tamp_cls(8,$row['r_class']); ?>>8</option>
			<option value="9" <?php check_tamp_cls(9,$row['r_class']); ?>>9</option>
			<option value="10" <?php check_tamp_cls(10,$row['r_class']); ?>>10</option>
			<option value="11" <?php check_tamp_cls(11,$row['r_class']); ?>>11</option>
			<option value="12" <?php check_tamp_cls(12,$row['r_class']); ?>>12</option>
		</select>
		</div>
		<div class="form_handler">	
		<label for="required_ratings">Required Ratings</label>
		<input type="text" id="required_ratings" value="<?php echo $row['min_rate'] ?>" name="required_ratings" class="last_border input">
		</div>
		<div class="form_handler">	
		<label for="team_type">Team Type</label>
		<select name="team_type" id="team_type" class="full_border input">
			<option value="1" <?php check_tamp_type(1,$row['type']); ?>>Anyone Can Join</option>
			<option value="2" <?php check_tamp_type(2,$row['type']); ?>>Anyone Can send a Request</option>
			<option value="3" <?php check_tamp_type(3,$row['type']); ?>>Invited Only</option>
		</select>
		<input type="hidden" name="id" value="<?php echo $row['rand_id'] ?>">
		</div>
	</form>