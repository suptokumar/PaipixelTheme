<html>
<head>
	<title>Paipixel DashBoard LOGIN</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=0.01"/>
</head>	
<body>
	
<?php 
session_start();
if (isset($_SESSION['dbpx'])) {
	echo "You are already Logged In.";
	?>
<a href="index.php">Go to Dashboard</a>
	<?php
	exit();
}
?>

</body>

<form action="index.php" method="POST" style="max-width: 500px; margin: 1% auto;">
	<fieldset>
		<legend>Log In: </legend>
	<input type="text" placeholder="user_name" name="user_name" style="padding: 10px; width: 95%; margin-top: 10px">
	<input type="password" placeholder="password" name="password" style="padding: 10px; width: 95%; margin-top: 10px">
	<input type="submit" name="login" value="Login" style="padding: 10px; cursor: pointer;">
	</fieldset>
</form>

</html>