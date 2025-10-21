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
<title>Konectando Internet Rural - Contáctenos</title>
<style type="text/css">
	
</style>
</head>
<body>
	<?php include 'msg.php';?>
	
<script type="text/javascript" src="js/msg.js"></script>
	<div id="container">
		<?php include 'navbar.php';?>
	  <div id="subcont">
	  		<div id="banner2" style="background-image: url(img/contactenos.png);" class="tableo">
			  <span class="tablei wtitle">CONTACTENOS</span>
			</div>
			<section  style="background-color: #1c64ac; padding-bottom: 50px;">
				<div class="inwidth">
					<p style="color: white;">Por favor llene este formulario y nos podremos en contacto con usted tan pronto como nos sea posible.<br>
				Tambien puede comunicarse a nuestras lineas de atencion o escribirnos a nuestro correo electronico.</p>
				</div>
			</section>
		  <div class="inwidth-block2" style="text-align: center;">
		  
			<div class="w50" style="text-align: left; font-size: 15pt; margin-top: 80px; padding-left: 20px; box-sizing: border-box;">
       			<form action="send.php" method="post">
       				<div class="form-cont">
						<div class="form-icon"><i class="fas fa-user fa-1.7x"></i></div>
						<input name="nombre" type="text" placeholder="Nombre">
      				</div>
      				<div class="form-cont">
						<div class="form-icon"><i class="far fa-envelope fa-1.7x"></i></div>
       					<input name="correo" type="text" placeholder="Correo Electronico">
       				</div>
       				<div class="form-cont">
						<div class="form-icon"><i class="fas fa-phone fa-1.7x"></i></div>
       					<input name="telefono" type="tel" placeholder="Telefono" >
       				</div>
       				<div class="form-cont">
						<div class="form-icon"><i class="fas fa-pen fa-1.7x"></i></div>
       					<textarea name="mensaje" rows="8" placeholder="Comentarios" draggable="false" ></textarea>
       					
       				</div>
       				<div class="form-cont" style="text-align: center;">
       					<input type="submit" class="button1" value="Enviar">
					</div>	
       			</form>
       		</div>
       		<div class="w50" style="text-align: center; margin-top: 80px; padding-left: 20px; box-sizing: border-box;">
       			<p style="line-height: 3em"><img src="img/logo_konet.png" width="200px"><br>
				Girardot - Cundinamarca<br>
				 Celular: 314-399-4608<br>
				 konectandointernetrural@gmail.com</p>
			</div>
        
		  </div>
		  </div>
      		
       		
		<?php include 'footer.php';?>
       		
        </div>
	</div>
	
</body>
</html>


