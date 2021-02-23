<?php include 'header.php'; ?>
<?php get_header("Score LeaderBoard | PaiPixel Online Exam") ?>
<?php get_top_menu("") ?>


<script>
	$(document).ready(function() {
		$(".top_menu_section.menu_section a").click(function(event) {
			window.location=$(this).attr("href");
		});
	});
</script>
<link rel="stylesheet" href="<?php get_domain("/"); ?>css/nav_menu.css?d">
<script>
	$(document).ready(function() {
		$(".open_nav").click(function() {
			$(".nav_responsive").fadeIn(100);
			$(".nav_responsive_fix").fadeIn(100);
		});
		$(".nav_responsive_fix").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});
		$(".close_nav").click(function() {
			$(".nav_responsive").fadeOut(100);
			$(".nav_responsive_fix").fadeOut(100);
		});

		$(window).resize(function() {
			if ($(window).innerWidth() > 716 && $(".nav_responsive").css("display","none")) {
				$(".nav_responsive").css("display","inline-block");
			} else {
				$(".nav_responsive").css("display","none");
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		$(window).scroll(function() {
			var height = $(window).scrollTop();
			if(height>306){
				$(".nav_menu").addClass('fixed_menu');
				$(".container").css('margin-top', '50px');
			} else {
				$(".nav_menu").removeClass('fixed_menu');
				$(".container").css('margin-top', '0px');
			}
		});

		$(".nav_menu .cf a.<?php echo $active ?>").addClass('active');
	});
</script>

<div class="nav_menu">
	
<nav class="cf">
		<a href="<?php get_domain("/") ?>" class="menu_item_home">Home</a>
		<?php 
if (user_detail("power")==1 || user_detail("role")==2) {
	?>
<a href="<?php get_domain("/") ?>exam.php?add_question" class="menu_item_results">Add Questions</a>
	<?php
}

	?>
	<a href="javascript:void(0)" class="open_nav nav_button"><span class="material-icons">menu</span></a>
<div class="nav_responsive_fix"></div>
		
		<div class="nav_responsive">
			<a href="javascript:void(0)" class="close_nav nav_button"><span class="material-icons">close</span></a>
			<!-- <a href="<?php get_domain("/") ?>tutorial" class="menu_item_tutorial">Tutorial</a> -->
			<a href="<?php get_domain("/") ?>exams" class="menu_item_exams">Individual Exam</a>
			<a href="<?php get_domain("/") ?>team_exam" class="menu_item_team_exam">Team Exam</a>
			<!-- <a href="<?php get_domain("/exam.php") ?>" class="menu_item_exam_list">Exam List</a> -->
			<a href="<?php get_domain("/") ?>ratings" class="menu_item_rating">Rating</a>
			<a href="<?php get_domain("/") ?>score.php" class="menu_item_score active">Score Leaderboard</a>
      <a href="<?php get_domain("/") ?>week.php" class="menu_item_weakly">Weekly Top Scorers</a>
<?php if (user_detail("role")==1) {
?>
<a href="<?php get_domain("/") ?>model.php" class="menu_item_model">Start Exam Now</a>

<?php
} ?>
      <a href="<?php get_domain("/") ?>buy.php" class="menu_item_buy">Buy Exam</a>
      <a href="<?php get_domain("/") ?>ask_teacher" class="menu_item_ask_teacher"><?php echo x("Ask") ?> Question</a>
			<!-- <a href="<?php get_domain("/") ?>hire_teacher" class="menu_item_hire_teacher">Hire Teacher</a> -->
			<a href="<?php get_domain("/") ?>FAQ" class="menu_item_faq">FAQ</a>
		</div>

		</div>
		
	</nav>
</div>






<div class="pup_up" style="display: none;"></div>
<div class="ajax_data" style="display: none;"></div>
<div class="area_content" style="max-width: 1100px; margin: 1% auto; position: relative;">
	<link rel="stylesheet" href="<?php get_domain("/") ?>css/table.css?s5">
	<?php 
if (isset($_GET['handshake'])) {
include '../ajax/db_back.php';
include '../functions.php';
session_start();
} else {
	include 'ajax/db_back.php';
}
?>
<link rel="stylesheet" href="<?php get_domain("/css/table.css?s5.0gs") ?>">

<link rel="stylesheet" href="<?php get_domain("/"); ?>css/container.css">
<div class="container">
	<div class="body_content content_area" style="width: 97%;">
<aside>
	<h2 class="caption">
		<style>
#search_user #ms25 {
  background:url(../image/search-icon.png) 2% 50% / auto 90% no-repeat;
  width: 82%;
  padding: 10px 0% 10px 15%;
  border: 1px solid #ccc;
  margin: 1%;
  font-size: 14px;
}
		</style>
<form action="" id="search_user">
			<div id="at">
		
	<input id="institution" list="don" style="padding: 6px 20px; float: right; width: 400px" placeholder="institution" autocomplete="off" name="institution" >
	</div>
	<!-- <label for="class" style="font-size: 18px; float:">class</label> -->
	<select id="class" onchange="search_d52(1)" style="padding: 6px 6px; float: right;" name="class">
		<option value="">Class</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
	</select>
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
	data: "s="+val,
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
        if (currentFocus>0) {
        var sc = document.getElementsByClassName("autocomplete-active")[0].offsetTop;
        var sd = document.getElementsByClassName("autocomplete-active")[0].offsetHeight;
        // alert(sc);
        $("#institutionautocomplete-list").animate({
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
        var scrol = $("#institutionautocomplete-list").scrollTop();
        var sd = document.getElementsByClassName("autocomplete-active")[0].offsetHeight;

        var sc = document.getElementsByClassName("autocomplete-active")[0].offsetTop;
        // alert(sc);
        $("#institutionautocomplete-list").animate({
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
        search_d52(1);
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
autocomplete(document.getElementById("institution"));




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
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    width: 400px;
    margin-top: 37px;
    right: 41px;
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

	<script>
		function show_data(v) {
			setTimeout(function(){
				$.ajax({
					url: '<?php get_domain("/ajax/school.php") ?>',
					type: "POST",
					data: "v="+v,
				})
				.done(function(data) {
			$("#don").html(data);
				});
				

			});
		}
	</script>
		<style>
#search_user #ms25 {
  background:url(../image/search-icon.png) 2% 50% / auto 90% no-repeat;
  width: 98%;
  padding: 10px 0% 10px 50px;
  border: 1px solid #ccc;
  margin: 1%;
  font-size: 14px;
}
		</style>
	<input type="text" onkeyup="search_d52(1)" name="search_user" id="ms25" placeholder="Search by username">
</form>
	</h2>
<script>
function search_d52(page){
	var key = $("#ms25").val();
	var classs = $("#class").val();
	var institution = $("#institution").val();
	var data = "class="+classs+"&&key="+key+"&&institution="+institution+"&&page="+page;
	$.ajax({
		url: '<?php get_domain("/") ?>ajax/rating/score_leader_board.php',
		type: 'GET',
		data: data,
	})
	.done(function(data) {
		$(".asdf40").html(data);
	});
}
$(document).ready(function() {
	search_d52(1);
});
</script>
	<div class="asdf40">

	</div>
</aside>
</div>
</div>
</div>
<?php get_footer() ?>
