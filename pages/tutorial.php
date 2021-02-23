<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
} else {
	include 'ajax/db_back.php';
}
?>

<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container">
	<div class="body_content content_area" style="width: 99%">
<link rel="stylesheet" href="<?php get_domain("/css/table.css?v=1.0.0") ?>">
<script>
	$(document).ready(function() {
		$.ajax({
			url: '<?php get_domain("/pages/home.tu.php") ?>',
			type: 'GET',
			data: {sql: "sql",handshake: "handshake",page: 1},
		})
		.done(function(data) {
			$("#tutorial_block").html(data);
		})
		.fail(function() {
			alert("Network error");
		});
		
	});
</script>
<script>
	function tu_page(page) {
		var datas = $(".search_form").serialize();
			$.ajax({
			url: '<?php get_domain("/pages/home.tu.php") ?>',
			type: 'GET',
			data: "sql&handshake&"+datas+"&page="+page,
		})
		.done(function(data) {
			$("#tutorial_block").html(data);
			$("body,html").animate({
				scrollTop: 0
			},1000);
		})
		.fail(function() {
			alert("Network error");
		});
	}
</script>
<script>
	$(document).ready(function() {
		$(".search_form").submit(function(event) {
			event.preventDefault();
			var datas = $(this).serialize();
			$.ajax({
			url: '<?php get_domain("/pages/home.tu.php") ?>',
			type: 'GET',
			data: "sql&handshake&"+datas+"&page="+1,
		})
		.done(function(data) {
			$("#tutorial_block").html(data);
		})
		.fail(function() {
			alert("Network error");
		});
		});
	});
</script>
<div class="search_decimal" style="text-align: center;">
	<script>
	function get_subject(val)
	{
		$.ajax({
			url: '<?php get_domain("/") ?>ajax/teacher/subject.php',
			type: 'GET',
			data: {class: val},
		})
		.done(function(data) {
			$("#subject").html(data);
		})
		.fail(function() {
			$("#subject").html('<option value="">--Select--</option> <option value="বাংলা প্রথম পত্র">বাংলা প্রথম পত্র</option> <option value="বাংলা দ্বিতীয় পত্র">বাংলা দ্বিতীয় পত্র</option> <option value="ইংরেজি প্রথম পত্র">ইংরেজি প্রথম পত্র</option> <option value="ইংরেজি দ্বিতীয় পত্র">ইংরেজি দ্বিতীয় পত্র</option> <option value="গনিত">গনিত</option> <option value="সাধারণ বিজ্ঞান">সাধারণ বিজ্ঞান</option> <option value="কৃষিশিক্ষা">কৃষিশিক্ষা</option> <option value="বাংলাদেশ ও বিশ্ব পরিচয়">বাংলাদেশ ও বিশ্ব পরিচয়</option> <option value="তথ্য ও যোগাযোগ প্রযুক্তি">তথ্য ও যোগাযোগ প্রযুক্তি</option> <option value="ইসলাম ও নৈতিক শিক্ষা">ইসলাম ও নৈতিক শিক্ষা</option> <option value="হিন্দু ধর্ম ও নৈতিক শিক্ষা">হিন্দু ধর্ম ও নৈতিক শিক্ষা</option> <option value="খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা">খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা</option> <option value="বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা">বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা</option> <option value="চারু ও কারু কলা">চারু ও কারু কলা</option> <option value="কর্ম ও জীবনমুখী শিক্ষা">কর্ম ও জীবনমুখী শিক্ষা</option> <option value="শারীরিক শিক্ষা">শারীরিক শিক্ষা</option>'); }); } </script>
	<form action="" class="search_form">
		<select name="class" id="class" class="short_input" onchange="get_subject(this.value)">
		<option value="">--Class--</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		</select>
		<select name="subject" class="short_input" id="subject">
<option value="">--Subject--</option>
<option value="বাংলা প্রথম পত্র">বাংলা প্রথম পত্র</option>
<option value="বাংলা দ্বিতীয় পত্র">বাংলা দ্বিতীয় পত্র</option>
<option value="ইংরেজি প্রথম পত্র">ইংরেজি প্রথম পত্র</option>
<option value="ইংরেজি দ্বিতীয় পত্র">ইংরেজি দ্বিতীয় পত্র</option>
<option value="গনিত">গনিত</option>
<option value="সাধারণ বিজ্ঞান">সাধারণ বিজ্ঞান</option>
<option value="কৃষিশিক্ষা">কৃষিশিক্ষা</option>
<option value="বাংলাদেশ ও বিশ্ব পরিচয়">বাংলাদেশ ও বিশ্ব পরিচয়</option>
<option value="তথ্য ও যোগাযোগ প্রযুক্তি">তথ্য ও যোগাযোগ প্রযুক্তি</option>
<option value="ইসলাম ও নৈতিক শিক্ষা">ইসলাম ও নৈতিক শিক্ষা</option>
<option value="হিন্দু ধর্ম ও নৈতিক শিক্ষা">হিন্দু ধর্ম ও নৈতিক শিক্ষা</option>
<option value="খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা">খ্রিস্টান ধর্ম ও নৈতিক শিক্ষা</option>
<option value="বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা">বৌদ্ধ ধর্ম ও নৈতিক শিক্ষা</option>
<option value="চারু ও কারু কলা">চারু ও কারু কলা</option>
<option value="কর্ম ও জীবনমুখী শিক্ষা">কর্ম ও জীবনমুখী শিক্ষা</option>
<option value="শারীরিক শিক্ষা">শারীরিক শিক্ষা</option>
</select>
  <select name="chapter" class="short_input" id="chapter">
<option value="">--Chapter--</option>
<option value="1st">1st</option>
<option value="2nd">2nd</option>
</select>
<input type="text" name="keyword" class="short_input" placeholder="keyword">
<input type="submit" name="submit" value="Search" class="button button_standard">
</form>
</div>
<div id="tutorial_block"></div>
</div>
</div>