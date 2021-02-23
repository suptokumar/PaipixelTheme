  <tr class="header">
    <th>Image</th>
    <th>User Name</th>
    <th>Ratings</th>
    <th>Options</th>
  </tr>
<?php 
include '../extra/db.extra.php';


if (isset($_GET['search'])) {
	$s = $_GET['search'];
session_start();
$user = $_SESSION['login_data_paipixel24'];
$sql = "SELECT * FROM user WHERE friend LIKE '%,$user%' AND team='' AND user_name LIKE '%$s%' ORDER BY CASE 
WHEN user_name='$s' THEN 1
WHEN user_name LIKE '$s%' THEN 2
WHEN user_name LIKE '_$s%' THEN 3
WHEN user_name LIKE '%$s%' THEN 4
ELSE 14 END, user_name ASC;
";
$q = mysqli_query($db,$sql);
while ($row = mysqli_fetch_array($q)) {
  ?>
  <tr id="d<?php echo $row['id'] ?>">
    <td><img style=" width: 80px; height: 100px;" src="<?php get_domain("/content/".$row['image']) ?>" alt=""></td>
    <td><?php echo $row['user_name'] ?></td>
    <td><?php echo $row['rating'] ?></td>
    <td class="button_set"><a href="javascript:void(0)" class="button" onclick="add_user('<?php echo $row['user_name'] ?>','<?php echo $row['id'] ?>')">Add</a></td>
  </tr>
<?php }

	exit();
}
?>