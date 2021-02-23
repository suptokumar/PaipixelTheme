<?php 
include 'db.php';
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone_number = $_POST['phone_number'];
$email_address = $_POST['email_address'];
$password_box = $_POST['password_box'];
$password_box = md5($password_box);
$user_name = $_POST['user_name'];
$your_class = $_POST['your_class'];
$school_name = strtoupper($_POST['school_name']);
$your_role = $_POST['your_role'];
date_default_timezone_set("Asia/Dhaka");
$datetime = date("Y-m-d H:i:s");
$sql = "SELECT * FROM school WHERE school='$school_name'";
$m = mysqli_query($db,$sql);
if (mysqli_num_rows($m)==0) {
  $sql = "INSERT INTO school(`school`) VALUES('$school_name')";
  mysqli_query($db,$sql);
}
$sql = "INSERT INTO `user` ( `role`, `datetime`, `user_name`, `phone_number`, `email`, `first_name`, `last_name`, `back_data`, `class`, `school`, `friend`, `balance`,`image`) VALUES ('$your_role', '$datetime', '$user_name', '$phone_number', '$email_address', '$first_name', '$last_name', '$password_box', '$your_class', '$school_name', '$user_name', '0', '../image/user.PNG')";
if (mysqli_query($db,$sql)) {
  if ($your_role==1) {
    $member = "Student";
  } else {
    $member = "Teacher";
  }
	echo "Hi $first_name, <br> You are now a $member of PaiPixel. <br> ";
?>

<a href="<?php get_domain("/") ?>login" id="login_button" class="hoverable_button button_skyblue">Go to Login</a>

<style>

#login_button {
  width: auto;
  border: 1px solid;
  padding: 10px 20px;
  margin-bottom: 0;
  cursor: pointer;
  transition: .2s ease-in-out;
  margin: 10px auto;
  text-decoration: none;
  background: aqua;
  color: black;
  font-weight: normal;
  border: 1px solid black;
  display: block;
  width: 50%;
  font-size: 20px;
}
#login_button:hover {
  background: red;
  box-shadow: 0px 0px 3px 2px #ccc;
  border: 1px solid red;
}
.login_div {
	overflow: hidden;
	text-align: center;
  font-size: 25px;
}

</style>
<?php

} else {
	echo "Please Try again ! Server Error.";
	?>
<a href="<?php get_domain("/") ?>register" onclick="query_url(event,this,'pup_up','Register | <?php get_title() ?>','<?php get_domain("/theme/register_theme.php") ?>')" id="login_button" class="hoverable_button button_skyblue">Try again</a>

<?php
}
?>