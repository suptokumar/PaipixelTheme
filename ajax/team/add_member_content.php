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

<input type="text" id="myInput" onkeyup="myFunction(this.value)" placeholder="Search...">

<table id="myTable">
  <tr class="header">
    <th>Image</th>
    <th>User Name</th>
    <th>Ratings</th>
    <th>Options</th>
  </tr>
<?php 
session_start();
$user = $_SESSION['login_data_paipixel24'];
$sql = "SELECT * FROM user WHERE friend LIKE '%,$user%' AND team=''";
$q = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($q)) {
  ?>
  <tr id="d<?php echo $row['id'] ?>">
    <td><img style=" width: 80px; height: 100px;" src="<?php get_domain("/content/".$row['image']) ?>" alt=""></td>
    <td><?php echo $row['user_name'] ?></td>
    <td><?php echo $row['rating'] ?></td>
    <td class="button_set"><a href="javascript:void(0)" class="button" onclick="add_user('<?php echo $row['user_name'] ?>' ,'<?php echo $row['id'] ?>')">Add</a></td>
  </tr>
<?php } ?>
</table>
<script>
	function add_user(user_name,id){
		$.ajax({
			url: '<?php get_domain("/ajax/team/add_member.php") ?>',
			type: 'POST',
			data: {user_name: user_name, adder: '<?php echo $user; ?>'},
		})
		.done(function(data) {
			$("#d"+id+" .button_set .button").html(data);
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
