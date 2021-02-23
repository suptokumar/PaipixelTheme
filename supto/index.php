<?php 
session_start();
if (isset($_POST['login'])) {
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];
	include 'db.php';
	$error = 0;
	if ($user_name!='paipixel') {
		$error = 1;
	}
	if ($password!='paipixel') {
		$error = 1;
	}
	if ($error!=1) {
		$_SESSION['dbpx'] = $user_name;
	}



}
?>

<html>
<head>
	<title>Paipixel DashBoard</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=0.01"/>
</head>	
<body>
	<?php 
if (isset($_POST['login'])) {
if ($error==1) {
	echo "Login Failed. Please Try again.";
		?>
<a href="login.php">Click Here</a>
	<?php
	exit();
}
}
?>
<?php 
if (!isset($_SESSION['dbpx'])) {
	echo "Login to Go to dashboard.";
	?>
<a href="login.php">Click Here</a>
	<?php
	exit();
}
?>
<style>
	ul li{
		list-style: none;
	}
	li a {
		text-decoration: none;
		background: #F4E8E8;
		display: block;
		padding: 10px;
		font-family: arial;
		font-size: 20px;
		border-bottom: 1px solid #ccc;
	}
	li a:hover {
		background: red;
		color: white;
	}
</style>
<div style="max-width: 500px; margin: 2% auto;">
	<ul>
		<li>
			<a href="teacher.php">Teacher's Question</a>
		</li>
		<li>
			<a href="live_exam.php">Live Questions</a>
		</li>
		<li>
			<a href="announcement.php">Add Announcement</a>
		</li>
		<li>
			<a href="approve_anc.php">Approve Announcement</a>
		</li>
		<li>
			<a href="condi_ques.php">Ask for Question</a>
		</li>
    <li>
      <a href="withdraw.php">Withdraw Request</a>
    </li>
	</ul>
</div>




</body>

</html>