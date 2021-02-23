 [10,19,18,5,4,20,6,3,7,9,16,2,41,49,44,48,43,35,42,45,47,39,17,46,38,37,40,36,1,8]
 <?php 
 br();
$array = [10,19,18,5,4,20,6,3,7,9,16,2,41,49,44,48,43,35,42,45,47,39,17,46,38,37,40,36,1,8];
br();


$max = count($array);
br();

$m='';

$p=$max;

for ($i=0; $i <$p ; $i++) { 
	$m.=",".'0';
}
$m = substr($m, 1);
$m = explode(",", $m);
$need = 20;
$cnt=0;
$myArray=[];
while(true) { 
	$s=rand(0,$max-1);
	if($m[$s]==0)
	{
		$myArray[$cnt]=$array[$s];
		echo $m[$s]=$array[$s];
		br();
		$cnt++;
	}
	if($cnt==$need) break; 
}

print_r($myArray);


function br()
{
	echo "<br>";
}
 ?>