<?php 
$p = $_POST['query'];
include '../extra/db.extra.php';
session_start();
$cls = user_detail("class");
$sql = "SELECT Exam_name FROM question WHERE Exam_name LIKE '%$p%' AND class='$cls' AND pending=1";
$m = mysqli_query($db,$sql);
// $i = 0;
$result_founded = [];
while ($row=mysqli_fetch_array($m)) {
// $i++;
$j = explode(",", $row[0]);
for ($i=0; $i < count($j); $i++) { 
	array_push($result_founded,$j[$i]);
}
}
?>
	<?php 
$s = array_unique($result_founded);
$fazlami=[];
$jotodurjaoyajay=0;
for ($i=0; $i <count($s) ; $i++) { 
	if(isset($s[$i])){
	$fazlami[$jotodurjaoyajay]=$s[$i];
	$jotodurjaoyajay++;
	}
}
$s = $fazlami;
error_reporting(0);
function isSubstring($s1, $s2)
{
	// we are searching s1 in s2 as a substring, if found, then return it's index. 
    $n=strlen($s1);
    $m=strlen($s2);
    for($i=0;$i<$m;$i++)
    {
        if(strtolower($s1[0])==strtolower($s2[$i]))
        {
            $cnt=1;
            for($j=1;$j<$n;$j++)
            {
                if($s1[$j]==$s2[($i+$j)]) $cnt++;
            }
            if($cnt==$n) return $i;
        }
    }
    return -1;
}
function bubbleSort(&$arr,&$brr) 
{ 
    $n = count($arr); 

  
    // Traverse through all array elements 
    for($i = 0; $i < $n; $i++)  
    { 
        // Last i elements are already in place 
        for ($j = 0; $j < $n - $i - 1; $j++)  
        { 
            // traverse the array from 0 to n-i-1 
            // Swap if the element found is greater 
            // than the next element 
            if ($arr[$j] > $arr[$j+1]) 
            { 
                $t1 = $arr[$j];
                $t2=$brr[$j]; 
                $arr[$j] = $arr[$j+1]; 
                $brr[$j] = $brr[$j+1];
                $arr[$j+1] = $t1; 
                $brr[$j+1] = $t2;
            } 
        } 
    } 
}


   $u=[];
   $v=[];
   $counter = 0;
    for($i=0;$i<count($s);$i++)
    {
        $d=isSubstring($p,$s[$i]);
        //cout<<p<<" "<<s[i]<<" "<<d<<endl;
        if($d!=-1)
        {
           $u[$counter]=$d;
           $v[$counter]=$s[$i];
           $counter++;
        }
    }
    bubbleSort($u,$v);
    echo json_encode($v);
?>