<?php 
 br();
$array = [10,19,18,5,4,20,6,3,7,9,16,2,41,49,44,48,43,35,42,45,47,39,17,46,38,37,40,36,1,8];

$max = count($array);
$limit = 20;
$new[$limit] = [];
for ($i=0; $i < $limit; $i++) { 
	$new[$i] = 0;
}
for ($i=0; $i < $limit; $i++) { 
	$rand = rand(0,$max);
	$approve = 1;
	for ($j=0; $j < $limit; $j++) { 
		if ($new[$j]==$rand) {
			$approve = 0;
		}
	}
	if ($approve==1) {
		$new[$i] = $rand;
	} else {
		$i--;
	}
}

for ($i=0; $i < $limit; $i++) { 
	$
}

?>
<pre>
	<?php 
print_r($new);

	 ?>
</pre>
<?php

function br()
{
	echo "<br>";
}
 ?>