<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=0.6, user-scalable=0"/>
<script type="text/javascript" src="jquery/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="jquery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="jquery/jquery.mousewheel.js"></script>
<link href="https://fonts.googleapis.com/css?family=Fira+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Archivo+Black|Paytone+One&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/be342632af.js"></script>
<script type="text/javascript" src="js/navbar.js"></script>
<link rel="stylesheet" type="text/css" href="css/general.css">
<link rel="stylesheet" type="text/css" href="css/navbar.css">
<title>Konectando Internet Rural - Medidor de Velocidad</title>
<style type="text/css">
	
</style>
</head>
<body>
	<div id="container">
		<?php include 'navbar.php';?>
	  <div id="subcont">
	  		<div id="banner2" style="background-image: url(img/speed.png);" class="tableo">
			  <span class="tablei wtitle">MEDIDOR DE VELOCIDAD</span>
			</div>
		  
            <iframe style="display:block; opacity: 1;" width="100%" height="650px" frameborder="0" src="https://aycnetworks.speedtestcustom.com"></iframe><br>
            
		  <span id="fecha"></span>
     		
						<script>

						var dt = new Date();
						var weekday = new Array(7);
						weekday[0] =  "Domingo";
						weekday[1] = "Lunes";
						weekday[2] = "Martes";
						weekday[3] = "Miercoles";
						weekday[4] = "Jueves";
						weekday[5] = "Viernes";
						weekday[6] = "Sabado";

						var month = new Array(12);
						month[0] =  "Enero";
						month[1] =  "Febrero";
						month[2] =  "Marzo";
						month[3] =  "Abril";
						month[4] =  "Mayo";
						month[5] =  "Junio";
						month[6] =  "Julio";
						month[7] =  "Agosto";
						month[8] =  "Septiembre";
						month[9] =  "Octubre";
						month[10] =  "Noviembre";
						month[11] =  "Diciembre";


						var time = weekday[dt.getDay()] + " " + dt.getDate() + " de " + month[dt.getMonth()] + " del " + dt.getFullYear() + " - " + dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();

						document.getElementById("fecha").innerHTML = time;

						</script>
		  
		  </div>
      		
       		
		<?php include 'footer.php';?>
       		
        </div>
	</div>
	
</body>
</html>


