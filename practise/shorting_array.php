<?php 
echo "<pre>";
$c = [['goblu',5], ["asik",100], ["Romesh",100],["Garbej",500],["Docs",200],["vasses",2005.8745]];



function isOkay($a,$b)
{

	if($a[1]<=$b[1]) return 1;
	else return -1;
}


usort($c, "isOkay");

print_r($c);




?>