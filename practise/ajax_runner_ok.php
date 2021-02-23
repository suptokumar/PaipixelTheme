<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title id="page_title">Bynary</title>
	<!-- The fonts -->
<link href="https://fonts.googleapis.com/css2?family=Orbitron&family=Raleway&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- The Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!-- The Css Links -->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script>
		$(document).ready(function() {
			set_dato(0);
		});
		function set_dato(i)
		{
			$.ajax({
				url: "array.php",
				type: "POST",
				data: "i="+i,
				success:function(data)
				{
					$("body").html("success:"+data+"/19007");
					if (data!=19007) {
					setTimeout(function(){
						set_dato((((i)+1)));
					},10);
					}
				}
			});
		}
	</script>
</head>
<body style="background: #212121; color: white; font-family: arial; font-size: 100px; text-align: center;">
	
</body>