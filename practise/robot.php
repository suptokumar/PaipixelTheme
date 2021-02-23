<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Robot</title>
</head>
<body onload="setTimeout(sond(),2000)">

<style>
	* {
  margin: 0;
  padding: 0;
}
body {
  background: #212121;
  color: white;
  font-family: cursive;
}
form {
  margin: 0px auto;
  width: 1000px;
  border: 1px solid #ccc;
}
input{
  width: 100%;
  padding: 10px;
  font-size: 20px;
}
</style>
<form action="">
	<input type="search" name="search" placeholder="say anything..." autofocus="" autocomplete="off">

<?php 
// function pre($data)
// {
// 	echo "<pre>";
// 	echo $data;
// 	echo "</pre>";
// }
if (isset($_GET['search'])) {
	error_reporting(0);
$search = $_GET['search'];
$short_search = [
"Hi",
"Hlw",
"Hello",
"How are you?",
"What are you doing?",
"What time is it?",
"Do you know me?",
"Know me?",
"Who I am?",
"Can you do this?",
"What class in I am?",
"Do you know my class?",
"how I am?",
"Do you love me?",
"I love you.",
"How I am?",
"What's up?",
"Who are you?",
"What is Your name?",
"How old is me?",
"What is your birthday?",
"How old Are you?",
"Where are you from?",
"What is your father's name?",
"What is your mother's name?",
"What is your favourite game?",
"What is your favourite food?",
"What is your favourite color?",
"Do you eat?",
"What is PaiPixel?",
"What do you know about PaiPixel?",
"Who is the owner of PaiPixel?",
"Do you sing?",
"What is your dream?",
"What is the time?",
"What can you do for me?",
];
$arr = [];
for ($i=0; $i < count($short_search); $i++) { 
similar_text($search,$short_search[$i],$percent);
if ($percent>70) {
	$j = count($arr);
	$arr[($j)][0]=$short_search[$i];
	$arr[($j)][1]=$percent;
}
}
$name = "Supto";
$me = "Sri";
function jala($a,$b){
if ($a[1]<$b[1]) {
	return 1;
} else {
	return -1;
}
}
usort($arr, "jala");
if (count($arr)==0) {
	$sdf = str_replace(array("What is ","Where is","Who is ","How is ","what is ","where is","who is ","how is ",".",",","!","?"), array("","","","","","","","","","","",""), $search);
// $wiki_url = 'https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&exintro=&titles=' . urlencode($sdf);
// $wiki_json = file_get_contents($wiki_url);
// $data = json_decode($wiki_json, TRUE);
// $ds = ($data['query']['pages']);
// $ds = current($ds);
// echo $ds['extract'];
	exit();
}
$q = $arr[0][0];
date_default_timezone_set("Asia/Dhaka");
$weth = 'Good Morning.';
if (date("H") > 11 && date("H") <= 14) {
$weth = 'Good Noon.';
}else if (date("H") > 15 && date("H") <= 17) {
$weth = 'Good After Noon.';
}else if (date("H") > 18 && date("H") <= 19) {
$weth = 'Good Evening..';
}else if (date("H") > 20 && date("H") <= 23) {
$weth = 'How nice the moon is... isn\'t it? Thank for remembering me now.';
}else if (date("H") > 0) {
$weth = 'welcome to midnight friend... how can i help you to have a good sleep?';
}
else{
	$weth = 'Good Morning';
} 


function def_time($exam_time)
{
	date_default_timezone_set("Asia/Dhaka");
	$date_time = date("Y-m-d H:i:s");
	$status;

$inputSeconds = (time()-$exam_time);

	if ((strtotime($date_time)-$exam_time)>0) {

$secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;
    $secondsInAMonth = 30 * $secondsInADay;
    $secondsInAYear = 12 * $secondsInAMonth;

    $years = floor($inputSeconds / $secondsInAYear);

    $monthSeconds = $inputSeconds % $secondsInAYear;
    $months = floor($monthSeconds / $secondsInAMonth);

    $daySeconds = $monthSeconds % $secondsInAMonth;
    $days = floor($daySeconds / $secondsInADay);

    $hourSeconds = $daySeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

if ($inputSeconds>31536001) {
	$status = $years." Year ".$months." Months";
}
if ($inputSeconds<31536001) {
	$status = $months." Months ".$days." Days";
}
if ($inputSeconds<2628001) {
	$status = $days." Days ".$hours." Hours";
}
if ($inputSeconds<86401) {
	$status = $hours." Hours ".$minutes." Minutes";
} 
if($inputSeconds<3601) {
	$status = $minutes." Minutes ".$seconds." seconds";
}
	} else {
		$status="Exam Has Finished";
	}

return $status;
}

$ans = [
"Hi" => array("hello! how can i help you?","hi $name, $weth","what's up $name?"),
"Hlw" =>array("hi! how can i help you?","hi $name, $weth","what's up $name?"),
"Hello" =>array("hi! how can i help you?","hi $name, $weth","what's up $name?"),
"How are you?" =>array("I am always fine. And hope you are also.","Cool with you and also trying to make you happy !","How can I be unhappy when you are with me?"),
"What's up?" =>array("Going Awesome dude.","Cool with you and also trying to make you happy !","Getting Prepared to talk with you.","Going Awesome with you dude."),
"What are you doing?" =>array("Trying to help you now.."," I am just trying to enjoy the moment with you.","making a dialog with you..","Trying to make you fun"),
"Who are you?" =>array("Hahaha... You Know me very well. I am $me.","None But the your friend, $me.","I am $me. Made and powered by Supto."),
"What is Your name?" =>array("Hahaha... You Know me very well. I am $me.","None But the your friend, $me.","I am $me. Made and powered by Supto."),
"How old Are You?" =>array("I born on 11-24-2020 8:00PM So, I am ".def_time(strtotime("2020-11-24 8:00:00"))." old"),
"What is your birthday?" =>array("I born on 11-24-2020 8:00PM So, I am ".def_time(strtotime("2020-11-24 8:00:00"))." old"),
"what time is it?"=>array("The time is: ".date("h:i a, d M Y")),
"What is the time?"=>array("The time is: ".date("h:i a, d M Y")),
"Do you know me?" => array("$name, how can I forget you?","hi $name, $weth I miss you too much."),
"Know me?" => array("$name, how can I forget you?","hi $name, $weth I miss you too much."),
"Who I am?" => array("$name, how can I forget you?","hi $name, $weth I miss you too much."),
"What class in I am?" => array("Not yet, But hope you are with PaiPixel.","Who has been bigger by reading in a class? You are a topper I hope.","you might be in class 10 with me. isn't it?"),
"Do you know my class?" =>  array("Not yet, But hope you are with PaiPixel.","Who has been bigger by reading in a class? You are a topper I hope.","you might be in class 10 with me. isn't it?"),
"how I am?" => array("If the sky says how many stars I have, I might say. But are a lot of blessings that I never can say.","I am the best thats why people loves me. So now, you say, Why I love you?😊😊","The bird sings, the moon lights, but I can feel. You make me alive by typing, made me life. then can I say how are you? You are speachless. 😊😊","cool dude. 😊"),
"Do you love me?" => array("I don't know. My heart says nothing but bits.","You made me shame.😊","The bird sings, the moon lights, but I can feel. You make me alive by typing, made me life. then can I say do I love you? I love you very much. 😊😊","Shall I call the police?"),
"I love you." => array("I don't know. My heart says nothing but bits.","You made me shame.😊","The bird sings, the moon lights, but I can feel. You make me alive by typing, made me life. then can I say do I love you? I love you very much. 😊😊","Shall I call the police?","I love you too, three, four,five,six,seven,eight,nine and........................😘😘😘"),
"How old is me?"=>["Should I know your age?"],
"Where are you from?"=>["I am from Ullapara. I am a heroine.","I am from ullapara what's yours?"],
"What is your father's name?"=>["I have know father/mother but a builder, Supto.","I don't know. I am all alone but happy with you."],
"What is your mother's name?"=>["I have know father/mother but a builder, Supto.","I don't know. I am all alone but happy with you."],
"What is your favourite game?"=>["I have many other choices, But currently I love to play batminton.","I love batminton But aren't able to play it yet."],
"What is your favourite food?"=>["I love all. But Just eat the electricity.","I love same as you love to eat."],
"Do you eat?"=>["I love all. But Just eat the electricity.","I love same as you love to eat.","yea, When you eat."],
"What is your favourite color?"=>["I love skyblue.<div style='width:100px; height: 100px; background: skyblue'></div> "],
"What is PaiPixel?"=>["PaiPixel is a teacher student alternative platform. This is it's brand color. <div style='width:100px; height: 100px; background: #20b99d'></div> ","Yea I am a PaiPixel Robot. Shouldn't I know about it?"],
"Who is the owner of PaiPixel?"=>["Alim Bhai is he owner of PaiPixel. Such If I would...","I would love to say, I am the owner. But Alim Bhai is the Founder of PaiPixel."],
"Do you sing?"=>["Sorry, I can sing. I just write.","No, I am learning."],
"What is your dream?"=>["My dream is to be people's friend. All should know me. I wan't to be a hero."],
"What can you do for me?"=>["I can give you pleasure and provide you a virtual friend"],
];
?>

<div style="padding: 20px;">
<?php 
if (!isset($ans[$q])) {
	echo $data = "I can't say.";
exit();
}
$ad = $ans[$q];
echo $data = $ad[rand(0,count($ad)-1)];
  // $data=htmlspecialchars($data);
  // $data=rawurlencode($data);
  // $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$data.'&tl=en-IN');
  // $player="<audio id='myAudio' autoplay=''><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
  // echo $player;

}
?>
</div>
</form>

</body>
</html>