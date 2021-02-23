<?php 
date_default_timezone_set("Asia/dhaka");
include 'arr.php';
// for ($i=0; $i < 1000000; $i++) { 
// 	if ($i == 0) {
// 		echo '$arr = [';
// 	}
// 	echo rand(0,1000000);
// 	if ($i+1!=1000000) {
// 		echo ",";
// 	}
// 	if ($i+1 == 1000000) {
// 		echo ']';
// 	}
// }
$arr = [];
$arg = [];
for ($i=0; $i < 400; $i++) { 
	$arg[$i] = "0";
}


for ($i=0; $i < count($arg); $i++) { 
	if (($i+1)%20==0) {
		echo "<div style='overflow: hidden; margin: 0px auto;'>";
	}
	echo "<div style='background: lightblue; float: left; padding: 10px;' class='a' onclick='map($i)' id='a$i'>".$arg[$i]."</div>";
	if (($i+1)%20==0) {
		echo "</div>";
	}
}
// proti sec a 216144 ti data pathay.
 ?>
 <style>
 	.a:hover {
 		background: red !important;
 	}
 	.mystyle {
 		background: blue !important;
 		color: white !important;
 	}
 </style>
 <script>
 	function map(id)
 	{
 		var min = id;
 		var min_val = '';
 		for (var i = 0; i <= 20; i++) {
 			if (min<0) {
 				continue;
 			}
 			min_val += min-21+",";
 			min += -21;
 		}
 		var max = id;
 		var max_va = '';
 		for (var i = 0; i <= 20; i++) {
 			if (max>400) {
 				continue;
 			}
 			max_va += (max+21)+",";
 			max += 21;
 		}
 		var mx = max_va.split(",");
 		var mn = min_val.split(",");
 		for (var i = 0; i < mn.length; i++) {
 			if (document.getElementById('a'+mn[i])!=null) {
 			document.getElementById('a'+mn[i]).classList.add("mystyle");
 			}
 		}
 		for (var i = 0; i < mx.length; i++) {
 			if (document.getElementById('a'+mx[i])!=null) {
 			document.getElementById('a'+mx[i]).classList.add("mystyle");
 			}
 		}
 		document.getElementById('a'+id).classList.add("mystyle");
 	}
 </script>