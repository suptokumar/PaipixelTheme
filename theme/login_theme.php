<style>
.red_alert {
  color: red;
  font: 12px cursive !important;
  padding: 2px;
  display: block;
  text-align: right;
}
.login_div {
  width: 400px;
  border: 1px solid #ccc;
  padding: 10px;
  margin: 0 auto;
  text-align: center;
  box-shadow: 0px 0px 3px 1px #688bf7;
  background: white;
}
.admit_form {
  text-align: left;
  margin: 20px 0px;
  color: black;
  overflow: hidden;
}
.admit_form label {
  display: block;
  margin-top: 10px;
}
.admit_form input {
  width: 98%;
  padding-top: 10px;
  padding-left: 5px;
  padding-bottom: 4px;
  font-size: 17px;
  color: #777;
  background: white;
  border: none;
  border-bottom: 1px solid #ccc;
  display: block;
  margin-top: -10px;
  margin-left: 2px;
}
.admit_form #login_button {
  width: auto;
  float: right;
  border: 1px solid;
  padding: 10px 20px;
  margin-bottom: 0;
  cursor: pointer;
  color: #d53f04;
  transition: .2s ease-in-out;
  margin-top: 5px;
}
.hoverable_button:hover {
  background: #d53f04;
  color: white !important;
}

@media (max-width:500px)
{
  .login_div {
    width: 90%;
    box-shadow: none;
    border: none;
  }
}

</style>
<?php 
if (isset($_GET['handshake'])) {
  include '../functions.php';
}

?>
<script>
$(document).ready(function() {
  $(".form_partition input").keypress(function(event) {
    $(this).removeAttr('style');
  });
});
</script>
<script>
  function create_login(event){
    event.preventDefault();
    var login_box = $("#login_box").val();
    var password_box = $("#password_box").val();
    if (login_box=='' || password_box=='') {

    if (login_box=='') {
      $("#login_box").css("border","2px solid red");
    }
    if (password_box=='') {
      $("#password_box").css("border","2px solid red");
    }
    } else {
      $.ajax({
        url: '<?php get_domain("/ajax/login.php") ?>',
        type: 'POST',
        data: "data="+login_box+"&login="+password_box,
        beforeSend:function(){
          $(".login_message").html("Please Wait...");
        },
        success:function(data){
          if (data=='0') {
            $(".login_message").html("<span style='color: red'>Your Login Information Doesn't Match !</span>");
          } else if (data=='1') {
            $(".login_message").html("<span style='color: green'>Login Success !</span>");

            window.location='<?php get_domain("") ?>';



          } else {
             $(".login_message").html("<span style='color: red'>ERROR !</span>");
          }
        }
      });
      
    }
    

  }
</script>
<div class="login_div">
<h2 class="heading_text"> Log In </h2>
<?php
error_reporting(0);
session_start(); 
if (isset($_SESSION['login_data_paipixel24'])) {
  echo "You are already Logged In.";
} else {
?>
<form action="<?php get_domain("/") ?>ajax/login.php" method="post" id="login_form" onsubmit="create_login(event)" class="admit_form">
  <div class="login_message" style="text-align: center;"></div>
	<div class="form_partition">
		<label for="login_box" > UserName / Phone Number <span style="color: red"></span>
			<input type="text" id="login_box" name="login_box" />
		</label>
		<label for="password_box" > Password <span style="color: red"></span>
			<input type="password" id="password_box" name="password_box" />
		</label>
		<input type="submit" value="Login" name="login_button" id="login_button" class="hoverable_button button_skyblue">
	</div>
</form>
<?php } ?>
</div>