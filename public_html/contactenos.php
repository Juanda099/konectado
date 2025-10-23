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
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
<link rel="manifest" href="favicon_io/site.webmanifest">
<title>Konectando Internet Rural - Contáctenos</title>
<style type="text/css">
	/* Botón flotante de WhatsApp */
	.whatsapp-float {
		position: fixed;
		width: 60px;
		height: 60px;
		bottom: 40px;
		right: 40px;
		background-color: #25d366;
		color: #FFF;
		border-radius: 50px;
		text-align: center;
		font-size: 30px;
		box-shadow: 2px 2px 3px #999;
		z-index: 100;
		transition: all 0.3s;
	}
	
	.whatsapp-float:hover {
		background-color: #128c7e;
		transform: scale(1.1);
	}
	
	.whatsapp-icon {
		margin-top: 16px;
	}
	
	/* Mensajes de éxito/error */
	.alert {
		padding: 15px;
		margin: 20px 0;
		border-radius: 5px;
		font-size: 14pt;
	}
	
	.alert-success {
		background-color: #d4edda;
		color: #155724;
		border: 1px solid #c3e6cb;
	}
	
	.alert-error {
		background-color: #f8d7da;
		color: #721c24;
		border: 1px solid #f5c6cb;
	}
	
	/* Validación formulario */
	input:required:invalid, textarea:required:invalid {
		border-left: 3px solid #ff6b6b;
	}
	
	input:required:valid, textarea:required:valid {
		border-left: 3px solid #51cf66;
	}
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
				
				<?php
				// Mostrar mensajes de éxito o error
				if (isset($_GET['success']) && $_GET['success'] == '1') {
					echo '<div class="alert alert-success">
						<i class="fas fa-check-circle"></i> 
						¡Mensaje enviado exitosamente! Nos pondremos en contacto contigo pronto.
					</div>';
				} elseif (isset($_GET['error'])) {
					echo '<div class="alert alert-error">
						<i class="fas fa-exclamation-triangle"></i> 
						Hubo un error al enviar el mensaje. Por favor intenta nuevamente o contáctanos por WhatsApp.
					</div>';
				}
				?>
				
       			<form action="send.php" method="post" onsubmit="return validarFormulario()">
       				<div class="form-cont">
						<div class="form-icon"><i class="fas fa-user fa-1.7x"></i></div>
						<input name="nombre" type="text" placeholder="Nombre *" required minlength="3">
      				</div>
      				<div class="form-cont">
						<div class="form-icon"><i class="far fa-envelope fa-1.7x"></i></div>
       					<input name="correo" type="email" placeholder="Correo Electrónico *" required>
       				</div>
       				<div class="form-cont">
						<div class="form-icon"><i class="fas fa-phone fa-1.7x"></i></div>
       					<input name="telefono" type="tel" placeholder="Teléfono *" required pattern="[0-9]{7,10}">
       				</div>
       				<div class="form-cont">
						<div class="form-icon"><i class="fas fa-pen fa-1.7x"></i></div>
       					<textarea name="mensaje" rows="8" placeholder="Comentarios *" draggable="false" required minlength="10"></textarea>
       					
       				</div>
       				<div class="form-cont" style="text-align: center;">
       					<input type="submit" class="button1" value="Enviar Mensaje">
					</div>	
       			</form>
       			
       			<p style="font-size: 12pt; color: #666; margin-top: 20px;">
       				<i class="fas fa-info-circle"></i> Los campos marcados con * son obligatorios
       			</p>
       		</div>
       		<div class="w50" style="text-align: center; margin-top: 80px; padding-left: 20px; box-sizing: border-box;">
       			<p style="line-height: 3em">
       				<img src="img/logo_konet.png" width="200px"><br>
					<strong>Konectando Internet Rural</strong><br>
					Girardot - Cundinamarca<br><br>
					
					<a href="https://wa.me/573143994608?text=Hola,%20necesito%20información%20sobre%20sus%20servicios" 
					   target="_blank" 
					   style="color: #25d366; text-decoration: none; display: inline-block; margin: 10px 0;">
						<i class="fab fa-whatsapp fa-2x"></i><br>
						<strong>WhatsApp: 314-399-4608</strong>
					</a><br>
					
					<a href="tel:+573143994608" style="color: #1c64ac; text-decoration: none;">
						<i class="fas fa-phone"></i> Celular: 314-399-4608
					</a><br>
					
					<a href="mailto:konectandointernetrural@gmail.com" style="color: #1c64ac; text-decoration: none;">
						<i class="fas fa-envelope"></i> konectandointernetrural@gmail.com
					</a>
				</p>
			</div>
        
		  </div>
		  </div>
      		
       		
		<?php include 'footer.php';?>
       		
        </div>
	</div>
	
	<!-- Botón flotante de WhatsApp -->
	<a href="https://wa.me/573143994608?text=Hola,%20necesito%20información%20sobre%20sus%20servicios" 
	   class="whatsapp-float" 
	   target="_blank"
	   title="Chatea con nosotros por WhatsApp">
		<i class="fab fa-whatsapp whatsapp-icon"></i>
	</a>
	
	<script>
	function validarFormulario() {
		// Validación adicional con JavaScript
		var nombre = document.getElementsByName('nombre')[0].value;
		var correo = document.getElementsByName('correo')[0].value;
		var telefono = document.getElementsByName('telefono')[0].value;
		var mensaje = document.getElementsByName('mensaje')[0].value;
		
		if (nombre.trim().length < 3) {
			alert('Por favor ingresa tu nombre completo');
			return false;
		}
		
		if (!correo.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
			alert('Por favor ingresa un correo electrónico válido');
			return false;
		}
		
		if (!telefono.match(/^[0-9]{7,10}$/)) {
			alert('Por favor ingresa un número de teléfono válido (7-10 dígitos)');
			return false;
		}
		
		if (mensaje.trim().length < 10) {
			alert('Por favor escribe un mensaje más detallado (mínimo 10 caracteres)');
			return false;
		}
		
		return true;
	}
	</script>
	
</body>
</html>


