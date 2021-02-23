<?php 
	
$color = ["red","green","blue","yellow","gold","skyblue","lime","olive","orange","purple","tan"];
$t = date("i");
$temp=[];
$temps = [];
echo "<div style='overflow:hidden'>Which color is mostly There?</div>";
for ($i=0; $i < 300; $i++) { 
$j = rand(0,10);
if (isset($temp[$j])) {
	$temp[$j]+=1;
} else {
	$temp[$j] = 1;
}

	?>
<div class="co" onclick="d(<?php echo $j ?>)" style="background: <?php echo $color[$j]; ?>; width: 50px; height: 50px; float: left; cursor: pointer;"></div>
<!-- <pre> -->
	
	<?php
}
for ($i=0; $i < count($temp); $i++) { 
	?>
<input type="hidden" class="s<?php echo $i ?>" value="<?php echo $temp[$i]; ?>">
	<?php
}
rsort($temp);
	?>
<input type="hidden" class="win" value="<?php echo $temp[0]; ?>">
	<?php
?>

<!-- </pre> -->