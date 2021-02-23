<?php 
$ar = array("ami","tumi");
if (isset($_POST['query'])) {
	$ar[0]=$_POST['query'];
}
echo json_encode($ar);

?>