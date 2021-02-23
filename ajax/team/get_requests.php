<?php 
include '../extra/db.extra.php';
?>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background: url('<?php get_domain("/") ?>/image/search-icon.png') 1% 50% / 35px 35px no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>

<?php 
$team = $_GET['team'];
$sql = "SELECT * FROM team WHERE rand_id = '$team'";
$m = mysqli_query($db,$sql);
$w = mysqli_fetch_array($m);
$apply = $w['apply'];
?>
<table id="myTable">
  <tr class="header">
    <th>Image</th>
    <th>User Name</th>
    <th>Ratings</th>
    <th>Options</th>
  </tr>
<?php
$apply=explode(",", $apply);
session_start();
$user = $_SESSION['login_data_paipixel24'];
if (count($apply)-2!=0) {
for ($i=1; $i < count($apply); $i++) { 
$users = $apply[$i];
$sql = "SELECT * FROM user WHERE user_name='$users' AND team=''";
$q = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($q)) {
  ?>
  <tr id="d<?php echo $row['id'] ?>">
    <td><img style=" width: 80px; height: 100px;" src="<?php get_domain("/content/".$row['image']) ?>" alt=""></td>
    <td><?php echo $row['user_name'] ?></td>
    <td><?php echo $row['rating'] ?></td>
    <td class="button_set"><a href="javascript:void(0)" class="button" onclick="add_user('<?php echo $row['user_name'] ?>' ,'<?php echo $row['id'] ?>')">Add</a>  <a href="javascript:void(0)" style="background: #FFC2B7" class="button" onclick="remove_rq('<?php echo $row['user_name'] ?>' ,'<?php echo $row['id'] ?>')">Remove</a></td>
  </tr>
<?php }}}else {
	echo "<tr><td colspan=4>No Requests</td></tr>";
} ?>


</table>
<script>
	function add_user(user_name,id){
		$.ajax({
			url: '<?php get_domain("/ajax/team/add_member.php") ?>',
			type: 'POST',
			data: {user_name: user_name, adder: '<?php echo $user; ?>'},
		})
		.done(function(data) {
			$("#d"+id+" .button_set .button:first-child").html(data);
			setTimeout(function(){
				$("#d"+id).fadeOut('slow', function() {
					$(".my_team15").click();
					remove_rq(user_name, id);
				});
			},2000);
		});
		
	}

	function remove_rq(user, id){
		$.ajax({
			url: '<?php get_domain("/ajax/team/remove_request.php") ?>',
			type: 'POST',
			data: {user_name: user, team: '<?php echo $team; ?>'},
		})
		.done(function(data) {
			$("#d"+id+" .button_set .button:last-child").html(data);
			setTimeout(function(){
				$("#d"+id).fadeOut('slow', function() {
					$(".my_team15").click();
				});
			},2000);
		});
	}
</script>
<script>
function myFunction(v) {
  $.ajax({
  	url: '<?php get_domain("/ajax/team/search_member.php") ?>',
  	type: 'GET',
  	data: {search: v},
  })
  .done(function(data) {
  	$("#myTable").html(data);
  });
}
</script>
