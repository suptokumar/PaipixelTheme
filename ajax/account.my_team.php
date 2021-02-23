<link rel="stylesheet" href="../css/table.css?vp=510">

<?php 
include 'db.php';

session_start();
if (isset($_SESSION['login_data_paipixel24'])) {
	$user = $_SESSION['login_data_paipixel24'];
	$sql = "SELECT * FROM user WHERE user_name = '$user'";
	$q = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($q);
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$role = $row['role'];
	$rating = $row['rating'];
	$team = $row['team'];
	$team_role = $row['position_in_team'];
?>



<style>
	.aonod01,table {
		font-family: arial;
	}
</style>
<div class="button_set">
	<?php 
if ($team!='') {
	if ($team_role=='Leader' || $team_role=='Co-Leader') {
		$sql = "SELECT * FROM team WHERE rand_id = '$team'";
$dg1 = mysqli_query($db,$sql);
$w = mysqli_fetch_array($dg1);
$apply = $w['apply'];
$apply=explode(",", $apply);
$req = count($apply)-2;
if ($req!=0) {
	$fsono = '<span class="assist">'.$req.'</span>';
} else {
	$fsono = '';

}
		?>
<a href="javascript:void(0)" onclick="edit_team('<?php echo $team; ?>')">Edit Team</a>
<a href="javascript:void(0)" onclick="view_request('<?php echo $team; ?>','<?php echo $user; ?>')">Incoming Join Requests <?php echo $fsono; ?></a>
		<?php
	}
	 ?>
<a href="javascript:void(0)" onclick="leave_team('<?php echo $team; ?>','<?php echo $user; ?>')">Leave Team</a>
<a href="javascript:void(0)" onclick="add_members('<?php echo $team; ?>','<?php echo $user; ?>')">Add Members</a>
<a href="javascript:void(0)" class="cment" onclick="conversations('<?php echo $team; ?>')">Messages</a>
<a href="javascript:void(0)" class="hd_chall" onclick="challenges('<?php echo $team; ?>')">Challenges</a>

<?php }
?>
</div>
<?php $so = rand(); ?>
	<?php 
if ($team!='') { ?>
<style>
	.data_table tr td a {
		color: #555;
		font-weight: 500;
	}
	.data_table tr td a:hover {
		color: white;
	}
</style>
<div id="add_challenge"></div>
<style>
@media(max-width: 550px)
{
	.attabe {
		font-size: 10px;
	}
}
</style>
<script>
function add_challenge(team)
{
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/team_exam/new_team_content.php',
		type: 'POST',
		data: {team: team, enon:"<?php echo $enon = rand(); ?>"},
	})
	.done(function(data) {
		$("#add_challenge").html(data);
		$("#add_challenge").dialog({
		open: true,
		title: "New Challenge",
		modal: true,
		width: "auto"
	});
		get_subjectst("subject<?php echo $enon ?>",'<?php echo user_detail("class") ?>');
	get_chapterst("chapter<?php echo $enon ?>",'<?php echo user_detail("class") ?>',"বাংলা প্রথম পত্র");
	});
	
}
</script>
		<script>
function get_subjectst(id,clas)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/subject.php") ?>',
		type: 'GET',
		data: {class: clas},
	})
	.done(function(data) {
		$("#bbb"+id).html(data);
	});
	
}
</script>
<script>
function get_chapterst(id,clas,subject)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/oddhay.php") ?>',
		type: 'GET',
		data: {class: clas, subject: subject},
	})
	.done(function(data) {
		$("#bbb"+id).html(data);
	});
	
}
</script>
<script>
function challenges(team)
{
	if ($(".hd_chall").html() == "Hide Challenges") {
			$(".conversations").slideUp("slow");
			$(".hd_chall").html("Challenges");		
			$(".aonod01").fadeIn("slow");

		} else {
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/team_exam/show_challenges.php',
		type: 'GET',
		data: {team: team},
	})
	.done(function(data) {
	$(".conversations").html(data);
	$(".conversations").show('fast');
	$(".aonod01").slideUp("slow");
	$(".hd_chall").html("Hide Challenges");	
	});
	
}
}
</script>
<?php 
$do = rand();
?>

<div class="eonon<?php echo $do ?>"></div>
<script>
function edit_team_chal(team)
{	
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/team_exam/new_team_content.php',
		type: 'POST',
		data: {id: team, enon:'<?php echo $do ?>'},
	})
	.done(function(data) {
	$(".eonon<?php echo $do ?>").html(data);
	$(".eonon<?php echo $do ?>").dialog({
		open: true,
		title: "Edit Challenge",
		modal: true,
		width: "auto"
	});
	get_subjectaaa("subject<?php echo $do ?>",'<?php echo user_detail("class") ?>');
	get_chapteraaa("chapter<?php echo $do ?>",'<?php echo user_detail("class") ?>',"বাংলা প্রথম পত্র");
	});
}
</script>
<script>
function get_subjectaaa(id,clas)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/subject.php") ?>',
		type: 'GET',
		data: {class: clas},
	})
	.done(function(data) {
		$("#aaa"+id).html(data);
	});
	
}
</script>
<script>
function get_chapteraaa(id,clas,subject)
{
	$.ajax({
		url: '<?php get_domain("/ajax/teacher/oddhay.php") ?>',
		type: 'GET',
		data: {class: clas, subject: subject},
	})
	.done(function(data) {
		$("#aaa"+id).html(data);
	});
	
}
</script>
<script>

function add_members(team){
$.ajax({
	url: '<?php get_domain("/ajax/team/add_member_content.php") ?>',
	type: 'GET',
	data: {team: team},
})
.done(function(data) {
	$(".rtem<?php echo $so; ?>").html(data);
	$(".rtem<?php echo $so; ?>").dialog({
		open: true,
		modal: true,
		width: "auto",
		title: "Add Members",
		buttons:{
			"ok":function(){
				$(this).dialog("close");
			}
		}
	});
});

}
</script>
<?php $r25 = rand(); ?>
<div class="rand<?php echo $r25 ?>"></div>
<script>
	function view_request(team,user)
	{
		$.ajax({
			url: '<?php get_domain("/ajax/team/get_requests.php") ?>',
			type: 'GET',
			data: {team: team},
		})
		.done(function(data) {
			$(".rand<?php echo $r25 ?>").html(data);
			$(".rand<?php echo $r25 ?>").dialog({
				open: true,
				modal: true,
				width: "auto",
				title: "Join Requests",
				buttons: {
					"ok":function(){
						$(this).dialog("close");
					}
				}
			});
		});
		
	}
</script>
<script>
function load_comments(from, to, team)
{
	$.ajax({
		url: '<?php get_domain("/ajax/team/load_comments.php") ?>',
		type: 'GET',
		data: {from: from, to: to, team: team},
	})
	.done(function(data) {
		$(".comments_bcs").html(data);
	});
	
}
</script>
<script>
function load_message(from, to, team)
{
	$.ajax({
		url: '<?php get_domain("/ajax/team/load_comments.php") ?>',
		type: 'GET',
		data: {from: from, to: to, team: team},
	})
	.done(function(data) {
		$(".load_mse").html(data);
		$(".load_more_msges").show("slow");
		var scto = $("#older_msg").offset().top;
		$("body,html").animate({
			scrollTop: scto-100
		},500);
	});
	
}
</script>

<script>
	function conversations(team) {
		if ($(".cment").html() == "Hide Messages") {
			$(".conversations").slideUp("slow");
			$(".cment").html("Messages");		
			$(".aonod01").fadeIn("slow");

		} else {
		$.ajax({
			url:"<?php get_domain("/ajax/team/team_conversation.php") ?>",
			type: 'GET',
			data: {team: team},
		})
		.done(function(data) {
			$(".conversations").html(data);
			$(".conversations").slideDown("slow");
			$(".cment").html("Hide Messages");
			$(".aonod01").slideUp("slow");
		});
		}
	}
</script>
<div class="conversations" style="display: none;"></div>
<div class="aonod01">
	<div style="overflow: hidden;background: #9ef7e7;padding: 2%;color: black;font-size: 20px;">
<dib class="lln" style="float: left;width: 60%">
	<?php $sql = "SELECT * FROM team WHERE rand_id='$team'";
	$q = mysqli_query($db,$sql);
$apply_s = '';
$rsdee = '';

	while ($row=mysqli_fetch_array($q)) {
$apply_s = $row['apply'];
$rsdee = $row['rand_id'];

		?>
<h2 style="font-family: tahoma;"><?php echo $row['team_name'] ?></h2><br>
<p style="font-size: 17px;"><?php echo $row['description'] ?></p>
		<?php
	} ?>
</dib>
<table class="lln" style="width: 36%; padding: 1%; float: left; margin-top: -1%">

<?php
	$sql = "SELECT * FROM team WHERE rand_id='$team'";
	$q = mysqli_query($db,$sql);
	while ($row=mysqli_fetch_array($q)) {
		echo "<tr>";
		echo "<td style='font-weight: bold;'>Team Rating:</td>";
		echo "<td style='color: #000; font-weight: bold; text-shadow: none; font-family: arial;'>".$row['rating']."</td>";
		echo "</tr>";
$sq = "SELECT SUM(rating) FROM user WHERE team='$team'";
$w = mysqli_query($db,$sq);
$r = mysqli_fetch_array($w);
		echo "<tr>";
		echo "<td style='font-weight: bold;'>Team Weight:</td>";
		echo "<td>".$r[0]."</td>";
		echo "</tr>";
$sq = "SELECT * FROM user WHERE team='$team'";
$w = mysqli_query($db,$sq);
$r = mysqli_num_rows($w);
		echo "<tr>";
		echo "<td style='font-weight: bold;'>Total Members:</td>";
		echo "<td>".$r."</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td style='font-weight: bold;'>Required Rating:</td>";
		echo "<td>".$row['min_rate']."</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td style='font-weight: bold;'>Required Class:</td>";
		echo "<td>".$row['r_class']."</td>";
		echo "</tr>";
}
?>
</table>



<style>
@media(max-width: 494px){
	.lln {
		width: 100% !important;
	}
}
</style>
</div>
<table class="data_table">
	<tr>
		<th>User Name</th>
		<th>Ratings</th>
		<th>Team Score</th>
		<th>Options</th>
	</tr>
	<?php 
$sql = "SELECT * FROM user WHERE team='$team' ORDER BY rating DESC";
$q = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($q)) {
	?>

	<tr>
		<td><a style="color: blue; font-weight: bold; text-decoration: none;" href="http://localhost/profile/<?php echo $row['user_name'] ?>" onclick="query_url(event,this,'from_main_body','<?php echo $row['user_name'] ?> | PaiPixel Online Exam','http://localhost/profiles/<?php echo $son = $row['user_name'] ?>')"><?php echo my_name($row['user_name']); ?></a>
<br>
<?php 
	echo "<h5 style='line-height: 24px'>".$row["position_in_team"]."</h5>";
?>
		</td>
		<td><?php echo rating($row['rating']) ?></td>
				<td><?php 
$sql = "SELECT * FROM `team_score` WHERE user='$son' AND team='$team'";
$m10 = mysqli_query($db,$sql);
$r = mysqli_fetch_array($m10);
echo number_format($r[0],3);
		 ?></td>
		<td class="button_set">
			<?php 
if ($team_role=='Leader') {
?>
<?php if ($user!=$row['user_name']) { ?>
<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="kickout('<?php echo $row['user_name'] ?>','<?php echo $team ?>')">Kick Out</a>&nbsp;&nbsp;

<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="promote('<?php echo $row['user_name'] ?>','<?php echo $team ?>')">Promote</a>&nbsp;&nbsp;
<?php } else { ?>
	<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="leave_team(<?php echo $team; ?>,'<?php echo $user; ?>')">Leave</a>&nbsp;&nbsp;
<?php } ?>
	<?php 
}
?>





<?php 
if ($team_role=='Co-Leader') {
$user_24 = $row['user_name'];
$sql = "SELECT id FROM user WHERE user_name='$user_24' AND position_in_team='Leader'";
$qs = mysqli_query($db,$sql);
if (mysqli_num_rows($qs) != 1) {
?>
<?php if ($user!=$row['user_name']) { ?>
<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="kickout('<?php echo $user_24 ?>','<?php echo $team ?>')">Kick Out</a>&nbsp;&nbsp;
<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="promoteC('<?php echo $row['user_name'] ?>','<?php echo $team ?>')">Promote</a>&nbsp;&nbsp;
	<?php 
	
} else {
	?>
<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="leave_team(<?php echo $team; ?>,'<?php echo $user; ?>')">Leave</a>&nbsp;&nbsp;

	<?php
}
}
}
?>





<?php 
if ($team_role=='Senior') {
$user_24 = $row['user_name'];
$sql = "SELECT id FROM user WHERE user_name='$user_24' AND (position_in_team='Leader' || position_in_team='Co-Leader')";
$qs = mysqli_query($db,$sql);
if (mysqli_num_rows($qs) != 1) {
?>
<?php if ($user!=$row['user_name']) { ?>
<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="kickout('<?php echo $user_24 ?>','<?php echo $team ?>')">Kick Out</a>&nbsp;&nbsp;
<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="promoteS('<?php echo $row['user_name'] ?>','<?php echo $team ?>')">Promote</a>&nbsp;&nbsp;
	<?php 
	
} else {
	?>
<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="leave_team(<?php echo $team; ?>,'<?php echo $user; ?>')">Leave</a>&nbsp;&nbsp;

	<?php
}
}
}
?>


<?php 
if ($team_role=='Junior') {
	if ($user==$row['user_name']) {
	?>
<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="leave_team(<?php echo $team; ?>,'<?php echo $user; ?>')">Leave</a>&nbsp;&nbsp;

	<?php
}
}
?>



<?php 
if ($user!=$row['user_name']) {
			 ?>

			<a style="margin: 0;" href="javascript:void(0)" class="button" onclick="open_msg_only();
    add_user_to_msg('<?php echo $row['id'] ?>');">Message</a>
	<?php
}
	?>
	</td>
	</tr>

	<?php
}
	?>
</table>

</div>
<div class="rtem<?php echo $so; ?>"></div>
<script>
function promote(user, team)
{
	$(".rtem<?php echo $so; ?>").html('<span style="color:red">If you promote someone as a Leader, you will be demoted to Co-Leader</span><form id="eobd488"> <select name="select_role" id="select_role" class="full_border input"><option value="Junior">Junior</option> <option value="Senior">Senior</option> <option value="Leader">Leader</option> <option value="Co-Leader">Co-Leader</option>  </select> </form>');
	$(".rtem<?php echo $so; ?>").dialog({
		open: true,
		modal: true,
		title: "Select a Role",
		buttons: {
			"ok":function(){
				var data = $(".rtem<?php echo $so; ?> #select_role").val();
				$.ajax({
					url: '<?php get_domain("/ajax/team/role_swicher.php") ?>',
					type: 'POST',
					data: "select_role="+data+"&user="+user+"&team="+team,
				})
				.done(function(data) {
					$(".rtem<?php echo $so; ?>").dialog("close");
					$(".my_team15").click();

				});
				
			},
			"Cancel":function(){
				$(this).dialog("close");
			}
		}
	});
} 
function promoteC(user, team)
{
	$(".rtem<?php echo $so; ?>").html('<form id="eobd488"> <select name="select_role" id="select_role" class="full_border input"><option value="Junior">Junior</option> <option value="Senior">Senior</option> <option value="Co-Leader">Co-Leader</option>  </select> </form>');
	$(".rtem<?php echo $so; ?>").dialog({
		open: true,
		modal: true,
		title: "Select a Role",
		buttons: {
			"ok":function(){
				var data = $(".rtem<?php echo $so; ?> #select_role").val();
				$.ajax({
					url: '<?php get_domain("/ajax/team/role_swicher.php") ?>',
					type: 'POST',
					data: "select_role="+data+"&user="+user+"&team="+team,
				})
				.done(function(data) {
					$(".rtem<?php echo $so; ?>").dialog("close");
					$(".my_team15").click();

				});
				
			},
			"Cancel":function(){
				$(this).dialog("close");
			}
		}
	});
} 
function promoteS(user, team)
{
	$(".rtem<?php echo $so; ?>").html('<form id="eobd488"> <select name="select_role" id="select_role" class="full_border input"><option value="Junior">Junior</option> <option value="Senior">Senior</option></select> </form>');
	$(".rtem<?php echo $so; ?>").dialog({
		open: true,
		modal: true,
		title: "Select a Role",
		buttons: {
			"ok":function(){
				var data = $(".rtem<?php echo $so; ?> #select_role").val();
				$.ajax({
					url: '<?php get_domain("/ajax/team/role_swicher.php") ?>',
					type: 'POST',
					data: "select_role="+data+"&user="+user+"&team="+team,
				})
				.done(function(data) {
					$(".rtem<?php echo $so; ?>").dialog("close");
					$(".my_team15").click();

				});
				
			},
			"Cancel":function(){
				$(this).dialog("close");
			}
		}
	});
} 
</script>
<script>
	function kickout(user, team) {
		leave_team(team, user, "Kickout "+ user+"?");
	}
</script>
<script>
	function leave_team(team, user, ass="")
	{
		if (ass!="") {

	$(".rtem<?php echo $so; ?>").html(ass);
		} else {
	$(".rtem<?php echo $so; ?>").html("Are you sure, You want to Leave this Team?");

		}

		$(".rtem<?php echo $so; ?>").dialog({
			open: true,
			modal: true,
			title: "Confirmation",
			buttons: {
				"Yes":function(){
$.ajax({
	url: '<?php get_domain("/ajax/team/leave_team.php") ?>',
	type: 'POST',
	data: {team: team, user: user},
})
.done(function(data) {
	$(".rtem<?php echo $so; ?>").dialog("close");
	$(".my_team15").click();
});
				},
				"No":function(){
					$(this).dialog("close");
				}
			}
		});
		
	}
</script>
<div class="load_more_msges" id="f24" style="display: none; padding: 10px;border: 1px dotted #313131;">
<h2 class="heading_title" onclick="document.getElementById('f24').style.display='none'" id="older_msg" style="cursor:pointer;">Older Messages:</h2>
<div class="load_mse"></div>
</div>
<script>
	function edit_team(team)
	{
		$.ajax({
			url: '<?php get_domain("/ajax/team/get_edit_details.php") ?>',
			type: 'POST',
			data: {team: team},
		})
		.done(function(data) {
			$(".rtem<?php echo $so; ?>").html(data);
			$(".rtem<?php echo $so; ?>").dialog({
				open: true,
				title: "edit team",
				modal: true,
				buttons:{
					"Update":function(){
						var data = $("#team_dfcreater_from").serialize();
						$.ajax({
							url: '<?php get_domain("/ajax/team/edit_team.php") ?>',
							type: 'GET',
							data: data,
						})
						.done(function(data) {
							$(".rtem<?php echo $so; ?>").dialog("close");
							$(".my_team15").click();
						});
						
					},
					"Cancel":function(){
						$(this).dialog("close");
					}
				}
			});
		});
		
	}
</script>
<?php
} } ?>
<?php if ($team=='') {
 ?>
<div class="wrapper">
	<form action="" id="search_user">
<div class="button_set" style="float: left;">
<a href="javascript:void(0)" style="margin: -3px" onclick="create_team('<?php echo $user; ?>');">Create New Team</a>
</div>	<input type="search" onkeyup="team_table(this.value,document.getElementsByName('filter_team')[0].value,1)" id="search_user_input" name="search_team" placeholder="Search Team" style="max-width: 160px; float: left; padding: 10px 40px;">

<select onchange="team_table(document.getElementsByName('search_team')[0].value,this.value,1)" name="filter_team" id="filter_team" style="padding: 10px; float: right; margin-top: 10px">
	<option value="25">-- Table Limit --</option>
	<option value="25">25</option>
	<option value="50">50</option>
	<option value="100">100</option>
	<option value="200">200</option>
</select>
	</form>

</div>

<div class="wrapper d48e1">
	<table class="data_table">
		<tr>
		<th>Team Name</th>
		<th>Team Ranking</th>
		<th>View Details</th>
		<th>Apply</th>
		</tr>
	</table>
</div>
<script>
function team_table(search,filter,page) {
	$.ajax({
		url: '<?php get_domain("/ajax/team/team_table.php") ?>',
		type: 'GET',
		data: {search: search, filter: filter, page: page, apply: 1},
	})
	.done(function(data) {
		$(".d48e1").html(data);
	});
	
}
$(document).ready(function() {
	team_table("",25,1);
});
</script>
<script>
function apply_team(team)
{
	$.ajax({
		url: '<?php get_domain("/ajax/team/apply_team.php") ?>',
		type: 'POST',
		data: {team: team},
	})
	.done(function(data) {
		$("#apply_korbi"+team).html(data);
	});
	
}
</script>
<?php $random = rand(); ?>
<div class="team_content" style="display: none;">
	<form action="" id="team_creater_from">
		<div class="form_handler">	
		<label for="team_name">Team Name</label>
		<input type="text" id="team_name" name="team_name" class="last_border input">
		</div>
		<div class="form_handler">	
		<label for="description_team">Team Description</label>
		<textarea id="description_team" name="description_team" class="full_border input"></textarea>
		</div>
		<div class="form_handler">	
		<label for="team_class">Team Class</label>
		<select name="team_class" id="team_class" class="full_border input">
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		</div>
		<div class="form_handler">	
		<label for="required_ratings">Required Ratings</label>
		<input type="text" id="required_ratings" name="required_ratings" class="last_border input">
		</div>
		<div class="form_handler">	
		<label for="team_type">Team Type</label>
		<select name="team_type" id="team_type" class="full_border input">
			<option value="1">Anyone Can Join</option>
			<option value="2">Anyone Can send a Request</option>
			<option value="3">Only added Members</option>
		</select>
		</div>
	</form>
</div>
<div class="team_creater<?php echo $random ?>" style="display: none;">
</div>
<script>
	function create_team(user)
	{
		$(".team_creater<?php echo $random ?>").html($(".team_content").html());
		$(".team_creater<?php echo $random ?>").dialog({
			open: true,
			modal: true,
			show: "explode",
			hide: "fade",
			title: 'Create Team',
			buttons:{
				"Create Team":function(){
					var datae = $(".team_creater<?php echo $random ?> form").serialize();
					$.ajax({
						url: '<?php get_domain("/ajax/team/team_creater.php") ?>',
						type: 'GET',
						data: datae+"&user="+user,
					})
					.done(function(data) {
						$(".team_creater<?php echo $random ?>").html(data);
						$(".team_creater<?php echo $random ?>").dialog({
							open: true,
							title: "Message",
							buttons:{
								"ok":function(){
									$(this).dialog("close");
									$(".my_team15").click();
								}
							}
						});
					});
					
				},
				"Close":function(){
					$(this).dialog("close");
				}
			}
		});
	}
</script>
<?php
} ?>