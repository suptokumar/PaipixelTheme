<?php 

$s = "sono";
echo strtoupper($s[0]);
echo substr($s, 1);
?>




<!DOCTYPE html>
<html>
<head>
	<title>Document</title>
</head>
<body>

<!--

H tag sikhlam

<h1>Partho is good.</h1>
<h2>Partho is good.</h2>
<h3>Partho is good.</h3>
<h4>Partho is good.</h4>
<h5>Partho is good.</h5>
<h6>Partho is good.</h6>

-->

<p>
Lorem ipsum dolor sit amet, <i>consectetur adipisicing elit,</i> sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. <strong>Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
Lorem ipsum dolor sit amet,</strong> consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
<pre>
	
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. <br>Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
</pre>
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
Lorem ipsum dolor sit amet, <div style="color:red">consectetur adipisicing elit,</div> sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>

<hr>
<!--
partho is a good boy
-->


partho<br>
school<br>
<b>valo</b>

<!-- 
The Tage we learned



<h1></h1>
<h2></h2>
<h3></h3>
<h4></h4>
<h5></h5>
<h6></h6>

<p></p>
<b></b>
<i></i>
<pre></pre>
<strong></strong>
<span></span>
<hr>
<br>
<div></div>


-->

<hr>

<style>
	table {
		border-collapse: collapse;
		border: 1px solid #ccc;
		color: white;
		background: #<?php echo rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9) ?>;
		width: 100%
	}
	td {
		border: 1px solid #ccc;
		padding: 10px;
	}
</style>
<!-- 
<table>
	<tr>
		<td>Role</td>
		<td>Name</td>
		<td>Class</td>
		<td>Section</td>
	</tr>
<?php 
for ($i=0; $i < 10; $i++) { 
	$user = ["supto","partho","adil","risad","rayhan","joy","alibaba","marhaba","rahul","beguni"];
	$rand = rand(0,9);
	$role = rand(20,50);
?>
	<tr>
		<td><?php echo $i+1 ?></td>
		<td><?php echo $user[$rand] ?></td>
		<td><?php echo $rand+1 ?></td>
		<td>A</td>
	</tr>
<?php 

}

?>
</table> -->

<?php 
// $x = 10;
// $y = 20;
// $z = 40;
// if ($x>$y) {
// 	if ($x>$z) {
// 	$big = $x;	
// 	} else {
// 		$big = $z;
// 	}
// } else {
// 	if ($y>$z) {
// 		$big = $y;
// 	}else {
// 		$big = $z;
// 	}
// }
// for ($i=1; $i <= $big ; $i++) { 
// echo $i;
// echo "<br>";
// }

?>

</body>
</html>
