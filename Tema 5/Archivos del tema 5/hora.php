<!DOCTYPE html>
<html>
	<head>
		<title>Hora en el servidor</title>		
		<meta charset = "UTF-8">
		<script>
			function loadDoc() {
				var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() { 
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("hora").innerHTML =
							"Hora en el servidor:" + this.response;
					}
				};
				xhttp.open("GET", "hora_servidor.php", false);
				xhttp.send();
				// return false;
			}
			setInterval(loadDoc, 5000);
		</script>
	</head>	
	<body>
	<?php echo date("h:m:s");?>
		<h1>Hora en el servidor</h1>
		<section id="hora"></section>		
	</body>	
</html>