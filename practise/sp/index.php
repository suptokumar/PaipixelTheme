<!DOCTYPE html>
<html>
<head>
<title>TTS - Google Text To Speech and PHP solution</title>
</head>


<body>

<p>
Uses <a href="http://translate.google.com/support/">Google Translator</a> to convert text to speech (TTS) with PHP.
<br/>
Saves file as MP3 (converts to OGG using mp32ogg) and plays back with browsers built in HTML5 audio player.
<br/>
creating this for <a href="HeckleOnline.com">HeckleOnline.com</a>
<br/>
online convertor: http://translate.google.com/translate_tts?tl=en&q=Your Text Here
<br/>
Still having some issues with Firefox... Works with WebKit browsers; Safari and Chrome.
</p>

<?php
require "tts.php";

$your_domain = "http://stuffthatspins.com/stuff/php-TTS/files/";
$tts = new TextToSpeech();
$file_name = time();

$heckle = "This is a PHP + Google TTS solution";
if ( isset($_GET['heckle']) ) $heckle = $_GET['heckle'];
$tts->setText($heckle,$file_name);

$mp3 = $your_domain.$file_name.".mp3";
$ogg = $your_domain.$file_name.".ogg";


?>

<br/><br/>
TTS: <?=$heckle?>
MP3: <?=$mp3?>
<br/>
<audio controls="controls" autoplay="autoplay">
  <source src="<?=$mp3?>" type="audio/mp3" />
  <source src="<?=$ogg?>" type="audio/ogg" />
  Your browser does not support the audio tag.
</audio> 

<br/><br/>

<hr class="space"/>

<form class="form" action="<?=$_SERVER['PHP_SELF']?>" method="get">
	<label>Heckle</label>
	<input type="text" class="text" name="heckle" maxlength="100" size="100" value=""/>
	<input type="submit" class="submit" value="TTS"/>
</form>




<br/><br/>
<br/>
<br/>
<a href="http://stufthatspins.com">StuffThatSpins.com</a>


<?
//not using this...
//$tts->saveToFile("/var/www/vhosts/heckleonline.com/httpdocs/mp3/test.mp3");
?>

<div class="widget-wrap"><div class="widget widget_text">			<div class="textwidget"><script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-465543-13']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>