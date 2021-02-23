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
  margin-top: 4px;
}
.admit_form input , .admit_form select {
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
  margin-top: 0px;
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
<div class="login_div">
	<h2 class="heading_text"> Register </h2>

<?php
error_reporting(0);
session_start(); 
if (isset($_SESSION['login_data_paipixel24'])) {
  echo "You are already Registered.";
} else {
?>
<?php 
if (isset($_GET['handshake'])) {
  include '../functions.php';
}

?>
<style>
	.form_partition {
		overflow: hidden;
	}
</style>
<script>
$(document).ready(function() {
	$(".form_partition input").keypress(function(event) {
		var span = $(this).attr("id");
		$("label[for="+span+"] span.red_alert").html("");
	});
	$(".form_partition select").change(function(event) {
		var span = $(this).attr("id");
		$("label[for="+span+"] span.red_alert").html("");
	});
});
</script>
<script>
	function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
function isNumber(number) {
  	var res;
  if (number=='' || number.length!=11) {
  	$("label[for=phone_number] span.red_alert").html("Number length is not valid");
  	res = "a";
  } else {
  	var variable2 = number.substring(0, 3);
if (variable2=='013' || variable2=='014' || variable2=='015' || variable2=='016' || variable2=='017' || variable2=='018' || variable2=='019') {
		res = "b";
	} else {
		res = "a";
  		$("label[for=phone_number] span.red_alert").html("Network Operator is not Valid.");
	}
  }
  return res;
}

</script>
<script>
	
	function register_submit(event)
	{
		event.preventDefault();
		if ($(".form_partition input[name=step]").val()==1) {
			sendtonext_reg();
		} else {
			var first_name = $("#first_name");
		var last_name = $("#last_name");
		var phone_number = $("#phone_number");
		var email_address = $("#email_address");
		var password_box = $("#password_box");
		var re_password_box = $("#re_password_box");
			var user_name = $("#user_name");
			var your_role = $("#your_role");
			var your_class = $("#your_class");
			var school_name = $("#school_name");
if (user_name.val() == '') {
	$("label[for=user_name] span.red_alert").html("Username can't be empty !");
} else {
	$.ajax({
			url: '<?php get_domain("/ajax/filter.php") ?>',
			type: 'GET',
			data: "user_name_24="+user_name.val(),
			success:function($data){
				if ($data==1) {
	$("label[for=user_name] span.red_alert").html("Username is already taken !");

} else {
 if(your_class.val() == '' && your_role.val()==1){
	$("label[for=your_class] span.red_alert").html("Please Select Your Class");
} else if(school_name.val() == '' && school_name.val() == '2' && your_role.val()==1){
	$("label[for=school_name] span.red_alert").html("Your Institution name is needed !");
} else {
	$.ajax({
		url: '<?php get_domain("/ajax/register.php") ?>',
		type: 'POST',
		data: "first_name="+first_name.val()+"&last_name="+last_name.val()+"&email_address="+email_address.val()+"&phone_number="+phone_number.val()+"&last_name="+last_name.val()+"&last_name="+last_name.val()+"&password_box="+password_box.val()+"&user_name="+user_name.val()+"&your_class="+your_class.val()+"&your_role="+your_role.val()+"&school_name="+school_name.val(),
		beforeSend:function()
		{
			$("input[type='submit']").val('wait...');
		}
	})
	.done(function(data) {
		$(".login_div").animate({
			background: "rgba(0,250,255,.4)",
			opacity: "0"},
			500, function() {
			$(".login_div").html(data);
			$(".login_div").animate({
			background: "white",
			opacity: "1"},
			500, function(){
				var window_height = $(window).innerHeight();
		var window_width = $(window).innerWidth();
		var book_height = $(".ajax_data").innerHeight();
		var book_width = $(".ajax_data").innerWidth();
		
		$(".ajax_data").animate({
			'margin-top': (window_height/2)-(book_height/2),
			'margin-left': (window_width/2)-(book_width/2)
		},500);
			});
		});
		
	})
	.fail(function() {
		alert("failed");
	});
	
}
}
			}
		});
}
		}
		
	}

	function sendtonext_reg()
	{
		var first_name = $("#first_name");
		var last_name = $("#last_name");
		var phone_number = $("#phone_number");
		var email_address = $("#email_address");
		var password_box = $("#password_box");
		var re_password_box = $("#re_password_box");


if (first_name.val()=='') {
			$("label[for=first_name] span.red_alert").html("First Name can not be empty !");
		}else if (last_name.val()=='') {
			$("label[for=last_name] span.red_alert").html("Last Name can not be empty !");
		}else if(isNumber(phone_number.val())=='a'){
	
} else if (!isEmail(email_address.val()) && email_address.val()!='') {
			$("label[for=email_address] span.red_alert").html("Email Address is not valid.");
		}else if (password_box.val()=='' || password_box.val().length>20 || password_box.val().length<4) {
			$("label[for=password_box] span.red_alert").html("Password must be 4-20 Characters !");
		}else if (re_password_box.val()!=password_box.val()) {
			$("label[for=re_password_box] span.red_alert").html("Password doesn't match !");
		} else {


$.ajax({
      url: '<?php get_domain("/ajax/phone_checker.php") ?>',
      type: 'POST',
      data: {number: phone_number.val()},
      success:function(data){
        if ($.trim(data)=='b') {
          $("label[for=phone_number] span.red_alert").html("The phone number is already exist.");
        } else {


		$(".form_partition input[name=step]").val("2");
		$(".form_partition[data-step=1]").hide(1000);
		$(".form_partition[data-step=2]").fadeIn(1000,function(){
			var window_height = $(window).innerHeight();
			var window_width = $(window).innerWidth();
			var book_height = $(".ajax_data").innerHeight();
			var book_width = $(".ajax_data").innerWidth();
			
			$(".ajax_data").animate({
				'margin-top': (window_height/2)-(book_height/2),
				'margin-left': (window_width/2)-(book_width/2)
			},500);


		});
		

        }
      }
    });








		}
	}
	
</script>
<script>
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}
</script>
<script>
	$(document).ready(function() {
		$("#your_role").change(function() {
			if ($(this).val()==1) {
				$("label[for=your_class]").fadeIn(100);
				$("label[for=school_name]").fadeIn(100);
			} else {
				$("label[for=your_class]").fadeOut(100);
				$("label[for=school_name]").fadeOut(100);
			}
		});
	});
</script>
<form action="<?php get_domain("/") ?>ajax/register.php" method="post" id="login_form" class="admit_form" onsubmit="register_submit(event);">
	<div class="form_partition" data-step="1">
		<label for="first_name" > First Name <span style="color: red">*</span>
			<input type="text" autofocus="" autocomplete="off" id="first_name" name="first_name" />
			<span class="red_alert"></span>
		</label>
		<label for="last_name" > Last Name <span style="color: red">*</span>
			<input type="text" autocomplete="off" id="last_name" name="last_name" />
			<span class="red_alert"></span>
		</label>
		<label for="phone_number" > Phone Number <span style="color: red">*</span>
			<input type="tel" autocomplete="off" id="phone_number" name="phone_number" />
			<span class="red_alert"></span>
		</label>
		<label for="email_address" > Email Address <span style="color: red"></span>
			<input type="email" autocomplete="off" id="email_address" name="email_address" />
			<span class="red_alert"></span>
		</label>
		<label for="password_box" > Password <span style="color: red">*</span>
			<input type="password" autocomplete="off" id="password_box" name="password_box" />
			<span class="red_alert"></span>
		</label>
		<label for="re_password_box" > Confirm Password <span style="color: red">*</span>
			<input type="password" autocomplete="off" id="re_password_box" name="re_password_box" />
			<span class="red_alert"></span>
		</label>
		<input type="hidden" name="step" value="1">
		<input type="button" value="Next" onclick="sendtonext_reg()" name="reg_step_1" id="login_button" class="hoverable_button button_skyblue">
	</div>
	
	<div class="form_partition" data-step="2" style="display: none;">
		<label for="user_name" > User Name <span style="color: red">*</span>
			<input type="text" autofocus="" autocomplete="off" id="user_name" name="user_name" />
			<span class="red_alert"></span>
		</label>
		<label for="your_role" > Register As <span style="color: red">*</span>
			<select id="your_role" name="your_role">
				<option value="1" selected="">Student</option>
				<option value="2">Teacher</option>
			</select>
			<span class="red_alert"></span>
		</label>
		<label for="your_class" > Your Class <span style="color: red">*</span>
			<select id="your_class" name="your_class">
				<option value="">-- Select Class --</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select>
			<span class="red_alert"></span>
		</label>
		<div id="at">
			
		<label for="school_name" >Your school or collage <span style="color: red">*</span>
			<input type="text" autocomplete="off" id="school_name" name="school_name" list="ds" />
		</div>
<script>

function autocomplete(inp) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;

      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/

$.ajax({
	url: '<?php get_domain("/ajax/school.php") ?>',
	type: 'POST',
	data: "s="+val+"&&id=school_name",
})
.done(function(data) {
	a.innerHTML=data;
});



// 
      // for (i = 0; i < arr.length; i++) {
        // /*check if the item starts with the same letters as the text field value:*/
        // if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          // /*create a DIV element for each matching element:*/
          // b = document.createElement("DIV");
          // /*make the matching letters bold:*/
          // b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          // b.innerHTML += arr[i].substr(val.length);
          // /*insert a input field that will hold the current array item's value:*/
          // b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          // /*execute a function when someone clicks on the item value (DIV element):*/
          // b.addEventListener("click", function(e) {
              // /*insert the value for the autocomplete text field:*/
              // inp.value = this.getElementsByTagName("input")[0].value;
              // close the list of autocompleted values,
              // (or any other open lists of autocompleted values:
              // closeAllLists();
          // });
          // a.appendChild(b);
        // }
      // }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
       if (e.keyCode == 40) {
      	// alert(scrol);
        currentFocus++;
        addActive(x);
      	if(currentFocus>0){
        var sd = document.getElementsByClassName("autocomplete-active")[0].offsetHeight;

        var sc = document.getElementsByClassName("autocomplete-active")[0].offsetTop;
        // alert(sc);
        $("#school_nameautocomplete-list").animate({
          scrollTop: (sc-(450-sd))*1,
     
        },100);
      	}
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        /*and and make the current item more visible:*/
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;

      	addActive(x);
        var sd = document.getElementsByClassName("autocomplete-active")[0].offsetHeight;

        var sc = document.getElementsByClassName("autocomplete-active")[0].offsetTop;
        // alert(sc);
        $("#school_nameautocomplete-list").animate({
          scrollTop: (sc-(450-sd))*1,
     
        },100);
        
      	
        /*and and make the current item more visible:*/
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
      });
}


/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("school_name"));




</script>

<style>
	* {
  box-sizing: border-box;
}

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}

.autocomplete-items {
	position: relative;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    margin-top: 0px;
    right: 0.6%;
    width: 98.8%;
    max-height: 450px;
    overflow-y: scroll;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
  font-weight: 100;
  font-size: 16px;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
 #institutionautocomplete-list{
     margin-top: 30.85px;
     right: 40px;
}
@media (max-width:1088px)
{
    #institutionautocomplete-list{
        right: 3.7%;
        margin-top: 30.6px;
    }
}
@media (max-width:820px)
{
    #institutionautocomplete-list{
        right: 2.6%;
        margin-top: 30.6px;
    }
}
@media (max-width:533px)
{
    #institution {
       width: 74% !important;
    }
    #institutionautocomplete-list{
        right: 2.9%;
        margin-top: 30.6px;
        width: 75.4%;
    }
}


#institutionautocomplete-list {
    box-shadow: 0px 3px 3px 1px #ccc;
    max-height: 450px;
    overflow-y: scroll;
}

</style>
	<!-- <label for="institution" style="font-size: 18px; float:">Institution</label> -->
			<span class="red_alert"></span>
		</label>
		<input type="submit" value="Save and Create Profile" name="login_button" id="login_button" class="hoverable_button button_skyblue">
	</div>

</form>
<?php } ?>
</div>