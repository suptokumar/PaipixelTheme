<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
			session_start();
} else {
	include 'ajax/db_back.php';
}
?>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet"> 
<div class="container">
	<div class="body_content content_area" style="width: 96.7%">
		<div class="main_box" style="max-width: 1200px; margin: 0px auto;">


<style>

.cd_button {
  background: none;
  color: #ff3c00;
  border: 1px solid #ff3c00;
  border-radius: 11px;
  padding: 9px 20px;
  transition: .2s;
  text-decoration: none;
}
.cd_button:hover {
  background: #ff3c00;
  color: white;
}
.bd_button {
  background: none;
  color: #FF14C5;
  border: 1px solid #FF14C5;
  border-radius: 11px;
  padding: 9px 20px;
  transition: .2s;
  text-decoration: none;
  font-size: 12px;
}
.bd_button:hover {
  background: #FF14C5;
  color: white;
}
.right {
	float: right;
}

.question_boar {
  border: 1px solid #ccc;
  padding: 1%;
  margin-top: 10px;
}
.acure {
  text-align: center;
  float: left;
  padding: 4%;
}
.acure h2 {
  font-family: arial;
  font-weight: lighter;
}
.acure h3 {
  font-size: 14px;
  font-weight: lighter;
}
.ask {
  padding-left: 1%;
}
.user_det a {
  text-decoration: none;
  color: #F18543;
  font-weight: lighter;
}
.users_det h2 {
  font-weight: lighter;
  font-size: 15px;
}
.user_det h2 {
  font-size: 14px;
}
.question {
	color: #04b6ff; cursor: pointer;
}
.question:hover {
	color: #FF4A57;
}
#idtos input {
  background:url(../image/search-icon.png) 2% 50% / auto 90% no-repeat;
  width: 55%;
  padding: 10px 0% 10px 45px;
  border: 1px solid #ccc;
  font-size: 14px;
}
.pre_sign {
  float: right;
}
@media(max-width: 926px)
{
  .acure_part {
    width: 100% !important;
  }
  .acure {
    float: left;
    padding: 0px 10px;
  }
  .acure h2, .acure h3 {
    float: left;
    font-size: 17px;
  }
  .acure h3 {
    text-align: center;
    margin-left: 3px;
    font-size: 12px;
    margin-top: 3px;
  }
  #idtos input {
  	width: 50%;
  }
  .bd_button {
    font-size: 10px;
    padding: 7px
  }
  .cd_button {
    font-size: 10px;
    padding: 12px 7px;
  }
  .content_desk {
    width: 100%;
    display: block;
  }
}



</style>
<div style="overflow: hidden;">
  <?php if (user_detail("role")==1): ?>
    
<a href="<?php get_domain("/ask_own_question.php") ?>" class="button  cd_button right">Ask Your Own Question</a>
  <?php endif ?>
<form action="" id="idtos">
	<input type="text" onkeyup="key_pressed(this.value)" name="search_user" id="inputdo" placeholder="Quick Search">
</form>
</div>
<div class="flow_answers">

</div>
<script>
$(document).ready(function() {

	$("#idtos").submit(function(event) {
		event.preventDefault();
		var search = $("#idtos input").val();
		search_sot(search,1);
	});
});
$(document).ready(function() {
	search_sot("",1);
});
function search_sot(key,page)
{
	$.ajax({
			url: '<?php get_domain("/") ?>ajax/ask_teacher/all_post.php',
			type: 'GET',
			data: "search="+key+"&&page="+page,
			beforeSend:function(){
				$(".flow_answers").html("Loading...");
			}
		})
		.done(function(data) {
			$(".flow_answers").html(data);
		})
		.fail(function() {
			$(".flow_answers").html("Please Check your Network And Try Again !");
		})
		.always(function() {
			console.log("complete");
		});
}
</script>
</div>
	</div>
</div>