<?php 
include '../extra/db.extra.php';
if (isset($_POST['team'])) {
$team = $_POST['team'];
$enon = $_POST['enon'];
	?>
<form id="new_team_chal">
	<input type="hidden" name="team" value="<?php echo $team ?>">
	<div class="team_away_part">
		<label for="name">Challenge Description</label>
		<textarea type="text" id="name" name="name" class="input"></textarea>
	</div>
	<!-- <div class="team_away_part"> -->
		<!-- <label for="s">Class</label> -->
		<input type="hidden" id="s" name="s" value="<?php session_start(); echo user_detail("class") ?>" class="input">
	<!-- </div> -->



	<div class="team_away_part">
		<label for="subject">Subject</label>
		<select id="bbbsubject<?php echo $enon ?>" name="subject" class="input" onchange="get_chapterst('chapter<?php echo $enon ?>','<?php echo user_detail("class"); ?>',this.value)"></select>
	</div>
	<div class="team_away_part">
		<label for="chapter">Chapter</label>
		<select id="bbbchapter<?php echo $enon ?>" name="chapter" class="input"></select>
	</div>
	<div class="team_away_part">
		<label for="datetime">Date</label>
		<input type="text" id="datetime" name="datetime" class="input" autocomplete="off">
	</div>

	<div class="team_away_part">
		<label for="member">Members</label>
		<select id="member" name="member" class="input" onchange="select_player(this.value)">
			<option value="">--Select Quantity--</option>
			<option value="2">2</option>
			<option value="5">5</option>
			<option value="10">10</option>
			<option value="20">20</option>
			<option value="25">25</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>
<?php 
$p0d = rand();
?>
<input id="s544d<?php echo $p0d ?>" type="hidden" value="0">
		<table class="func_table table_hoverable gdgas4ds1fd00"></table>
		<script>
function yea_this(t, user)
			{
var qn = $("#member").val();
var in_v = $("#s544d<?php echo $p0d ?>").val();
if ($("#s544d<?php echo $p0d ?>").hasClass('sc'+user)) {
	$("#s544d<?php echo $p0d ?>").removeClass('sc'+user);
$("#s544d<?php echo $p0d ?>").val((Number(in_v)-1));
} else {
$("#s544d<?php echo $p0d ?>").addClass('sc'+user);
$("#s544d<?php echo $p0d ?>").val((Number(in_v)+1));
}
var ew = $("#s544d<?php echo $p0d ?>").val();
if ((Number(ew))==(Number(qn))) {
	$(".t44f").attr('disabled', 'disabled');
	$(".t44f:checked").removeAttr('disabled');
	$(".at0150").removeClass('disabled');
	$(".at0150").removeAttr('disabled');
} else {
	$(".t44f").removeAttr('disabled');
	$(".at0150").addClass('disabled');
	$(".at0150").attr('disabled','disabled');
}
}
		</script>

<script>
	function select_player(val) {
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/user_search.php',
			type: 'GET',
			data: {user: val, edit: "edit", team: "<?php user_detail("team") ?>"},
		})
		.done(function(data) {
			$(".gdgas4ds1fd00").html(data);
			$("#s544d<?php echo $p0d ?>").removeAttr('class');
			$("#s544d<?php echo $p0d ?>").removeAttr('value');
		})
		.fail(function() {
			$(".gdgas4ds1fd00").html("network error.");
		});
		
	}
</script>
	</div>
	<div class="button_set">
	<input type="submit" value="Create Challenge" name="submits" class="button at0150 button_standard disabled" disabled="disabled">
	</div>
</form>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/jquery.datetimepicker.css">
<script src="<?php get_domain("/"); ?>js/jquery.datetimepicker.full.js"></script>

<script>
    /*jslint browser:true*/
    /*global jQuery, document*/

    jQuery(document).ready(function () {
        'use strict';

        jQuery('#datetime').datetimepicker({
        	format:'Y-m-d H:i:00'
        });
    });
</script>
<script>
$(document).ready(function() {
	$("#new_team_chal").submit(function(event) {
		event.preventDefault();
		var data =$(this).serialize()+"&class="+document.getElementById('s544d<?php echo $p0d ?>').classList;
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/team_exam/add_chal.php',
			type: 'POST',
			data: data,
		})
		.done(function(data) {
			$("#add_challenge").dialog("close");
			$(".hd_chall").html("Challenges");
			challenges('<?php echo $team ?>');
			alert(data);
		})
		.fail(function() {
			alert("Network Error !");
		});
		
	});
});
</script>
	<?php
}
?>
































<?php 
if (isset($_POST['id'])) {
$id = $_POST['id'];
$enon = $_POST['enon'];
$sql = "SELECT * FROM `team_chal` WHERE id='$id'";
$m = mysqli_query($db,$sql);
$q = mysqli_fetch_array($m);
$team = $q['team'];
session_start();
	?>

<form id="new_team_chal">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<div class="team_away_part">
		<label for="name">Challenge Description</label>
		<textarea type="text" id="name" name="name" class="input"><?php echo $q['name'] ?></textarea>
	</div>

<input type="hidden" name="s" value="<?php echo user_detail("class") ?>">

	<div class="team_away_part">
		<label for="subject">Subject (<?php echo $q['subject'] ?>, please select it manualy if you want to edit.)</label>
		<select id="aaasubject<?php echo $enon ?>" name="subject" class="input" onchange="get_chapteraaa('chapter<?php echo $enon ?>',<?php echo user_detail("class") ?>,this.value)"></select>
	</div>
	<div class="team_away_part">
		<label for="chapter">Chapter (<?php echo $q['chapter'] ?>, please select it manualy if you want to edit.)</label>
		<select id="aaachapter<?php echo $enon ?>" name="chapter" class="input">
			
		</select>
	</div>
	<div class="team_away_part">
		<label for="datetime">Date</label>
		<input type="text" id="datetime" value="<?php echo $q['date'] ?>" name="datetime" class="input">
	</div>
<?php 
function select_at25($t,$m)
{
$m = substr($m, 1);
$m = explode(",", $m);
if(count($m)==$t)
{
	return "selected";
}
return;
}



function asdfnone($m)
{
$m = substr($m, 1);
$m = explode(",", $m);
$s= "";
for ($i=0; $i < count($m); $i++) { 
	$s .="sc".$m[$i];
if ($i!=(count($m)-1)) {
	$s.=" ";
}
}
return $s;
}



function rot($id,$m)
{
$m = substr($m, 1);
$m = explode(",", $m);
$s= "";
for ($i=0; $i < count($m); $i++) { 
	if ($id==$m[$i]) {
		return "checked";
	}
}
return "disabled";
}



function fon_m($m)
{
$m = substr($m, 1);
$m = explode(",", $m);
return count($m) - 1;;
}
$p0d = rand();
?>
	<div class="team_away_part">
		<label for="member">Members</label>
		<select id="member" name="member" class="input" onchange="select_player(this.value)">
			<option value="">--Select Quantity--</option>
			<option value="2" <?php echo select_at25('2', $q['member']); ?>>2</option>
			<option value="5" <?php echo select_at25('5', $q['member']); ?>>5</option>
			<option value="10" <?php echo select_at25('10', $q['member']); ?>>10</option>
			<option value="20" <?php echo select_at25('20', $q['member']); ?>>20</option>
			<option value="25" <?php echo select_at25('25', $q['member']); ?>>25</option>
			<option value="30" <?php echo select_at25('30', $q['member']); ?>>30</option>
			<option value="50" <?php echo select_at25('50', $q['member']); ?>>50</option>
			<option value="100" <?php echo select_at25('100', $q['member']); ?>>100</option>
		</select>
<input id="s544d<?php echo $p0d ?>" type="hidden" class="<?php echo asdfnone($q['member']); ?>" value="<?php echo fon_m($q['member']) ?>">
		<table class="func_table table_hoverable gdgas4ds1fd00">
<tr>
		<?php 

$limit = 50000000;
$user = '';
	?>
	<th>Select</th>
<th>Image</th>
	<th>User</th>
	<th>Rating</th>

</tr>
<?php $team = user_detail("team") ?>
<?php
$sql = "SELECT * FROM user WHERE user_name LIKE '%$user%' AND role=1 AND team='$team' ORDER BY CASE
WHEN user_name = '$user' THEN 1
WHEN user_name LIKE '$user%' THEN 2
ELSE 3 END, user_name ASC LIMIT $limit";
$m = mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($m)) {
	?>
<tr>
	<td><input type="checkbox" <?php echo rot($row['id'],$q['member']) ?> onchange="yea_this(this,'<?php echo $row['id'] ?>')" value="<?php echo $row['user_name'] ?>" class="t44f" name="user_id<?php echo $row['id'] ?>"></td>

	<td><img src="<?php get_domain("/content/") ?><?php echo $row['image'] ?>" style="width: 20px" alt="<?php echo $row['user_name'] ?>"></td>
	<td><a href="<?php get_domain("") ?>/profile/<?php echo $row['user_name'] ?>" style="text-decoration: none;" onclick="query_url(event,this,'from_main_body','<?php echo $row['user_name'] ?> | PaiPixel Online Exam','<?php get_domain("") ?>profiles/<?php echo $row['user_name'] ?>')"><?php echo my_name($row['user_name']) ?></a></td>
	<td><?php echo rating($row['rating']) ?><span id="aj<?php echo $row['id'] ?>"></span></td>

</tr>
	<?php
}
?>
		</table>
<script>
function yea_this(t, user)
{
var qn = $("#member").val();
var in_v = $("#s544d<?php echo $p0d ?>").val();
if ($("#s544d<?php echo $p0d ?>").hasClass('sc'+user)) {
	$("#s544d<?php echo $p0d ?>").removeClass('sc'+user);
$("#s544d<?php echo $p0d ?>").val((Number(in_v)-1));
} else {
$("#s544d<?php echo $p0d ?>").addClass('sc'+user);
$("#s544d<?php echo $p0d ?>").val((Number(in_v)+1));
}
var ew = $("#s544d<?php echo $p0d ?>").val();
if ((Number(ew))==(Number(qn))) {
	$(".t44f").attr('disabled', 'disabled');
	$(".t44f:checked").removeAttr('disabled');
	$(".at0150").removeClass('disabled');
	$(".at0150").removeAttr('disabled');
} else {
	$(".t44f").removeAttr('disabled');
	$(".at0150").addClass('disabled');
	$(".at0150").attr('disabled','disabled');
}
}
		</script>

		<script>
			function select_player(val) {
				$.ajax({
					url: '<?php get_domain("/") ?>ajax/user_search.php',
					type: 'GET',
					data: {user: val, edit: "edit"},
				})
				.done(function(data) {
					$(".gdgas4ds1fd00").html(data);
					$("#s544d<?php echo $p0d ?>").removeAttr('class');
					$("#s544d<?php echo $p0d ?>").removeAttr('value');
				})
				.fail(function() {
					$(".gdgas4ds1fd00").html("network error.");
				});
				
			}
		</script>
	</div>
	<div class="button_set">
	<input type="submit" value="Save Challenge" name="submits" class="button at0150 button_standard">
	<input type="button" class="button button_standard" value="Delete" style="background: red; color: white;" onclick="delete_02102('<?php echo $q['id'] ?>')">
	</div>
</form>
<?php $pd0d = rand() ?>

<div class="dev_al<?php echo $pd0d ?>" style="display: none;"></div>
<script>
function delete_02102(id)
{
	$(".dev_al<?php echo $pd0d ?>").html("Are you sure, you want to delete it?");
	$(".dev_al<?php echo $pd0d ?>").dialog({
		open: true,
		modal: true,
		title: "Confirmation",
		width: "auto",
		buttons:{
			"yes":function(){
				$.ajax({
					url: '<?php get_domain("/ajax/") ?>team_exam/delete.chal.php',
					type: 'GET',
					data: {id: id},
				})
				.done(function(data) {
$(".dev_al<?php echo $pd0d ?>").html(data);
$(".eonon<?php echo $enon ?>").dialog("close");
$(".dev_al<?php echo $pd0d ?>").dialog({
open: true,
modal: true,
title: "Success",
width: "auto",
buttons:{
	"ok":function(){
		$(this).dialog("close");
		$(".hd_chall").html("Challenges");
		challenges('<?php echo $team; ?>');
	}
}
});
})
.fail(function() {
	alert("Network Error !");
});
				
			},
			"no":function(){
				$(this).dialog("close");
			}
		}
	});
}
</script>
<script>
$(document).ready(function() {
	$("#new_team_chal").submit(function(event) {
		event.preventDefault();
		var data =$(this).serialize()+"&class="+document.getElementById('s544d<?php echo $p0d ?>').classList;
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/team_exam/add_chal.php',
			type: 'POST',
			data: data,
		})
		.done(function(data) {
			$(".eonon<?php echo $enon ?>").dialog("close");
			$(".hd_chall").html("Challenges");
			challenges('<?php echo $team ?>');
			alert(data);
		})
		.fail(function() {
			alert("Network Error !");
		});
		
	});
});
</script>

<script>
    /*jslint browser:true*/
    /*global jQuery, document*/

    jQuery(document).ready(function () {
        'use strict';

        jQuery('#datetime').datetimepicker({
        	format:'Y-m-d H:i:00'
        });
    });
</script>
	<?php
}
?>