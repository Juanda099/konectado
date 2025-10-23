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
<title>Konectando Internet Rural - Pagar Factura</title>
<style type="text/css">
	.payment-container {
		max-width: 1200px;
		margin: 0 auto;
		padding: 40px 20px;
	}
	
	.payment-header {
		text-align: center;
		margin-bottom: 50px;
	}
	
	.payment-header h1 {
		font-size: 36pt;
		color: #2068b0;
		margin-bottom: 15px;
		font-weight: 300;
	}
	
	.payment-header p {
		font-size: 13pt;
		color: #616163;
		line-height: 1.8em;
		max-width: 700px;
		margin: 0 auto;
	}
	
	.qr-grid {
		display: flex;
		flex-direction: column;
		gap: 40px;
		margin-top: 40px;
		max-width: 800px;
		margin-left: auto;
		margin-right: auto;
	}
	
	.qr-card {
		background: white;
		border-radius: 15px;
		padding: 40px;
		box-shadow: 0 5px 20px rgba(0,0,0,0.1);
		text-align: center;
		transition: all 0.3s ease;
		border: 3px solid transparent;
		position: relative;
	}
	
	.qr-card::before {
		content: '';
		position: absolute;
		top: -15px;
		left: 50%;
		transform: translateX(-50%);
		width: 80%;
		height: 3px;
		background: linear-gradient(90deg, transparent, #e0e0e0, transparent);
	}
	
	.qr-card:first-child::before {
		display: none;
	}
	
	.qr-card:hover {
		transform: scale(1.02);
		box-shadow: 0 15px 40px rgba(0,0,0,0.15);
	}
	
	.qr-card.nequi:hover {
		border-color: #fc2779;
	}
	
	.qr-card.daviplata:hover {
		border-color: #ed1c24;
	}
	
	.qr-card.bancolombia:hover {
		border-color: #ffdd00;
	}
	
	.qr-card-header {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 15px;
		margin-bottom: 30px;
		padding: 25px;
		background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
		border-radius: 12px;
		position: relative;
	}
	
	.qr-card-number {
		position: absolute;
		top: -15px;
		left: 30px;
		background: white;
		width: 40px;
		height: 40px;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 18pt;
		font-weight: bold;
		box-shadow: 0 2px 10px rgba(0,0,0,0.1);
	}
	
	.qr-card-header i {
		font-size: 40pt;
	}
	
	.qr-card.nequi .qr-card-header i {
		color: #fc2779;
	}
	
	.qr-card.daviplata .qr-card-header i {
		color: #ed1c24;
	}
	
	.qr-card.bancolombia .qr-card-header i {
		color: #004b93;
	}
	
	.qr-card-header h2 {
		font-size: 22pt;
		color: #333;
		margin: 0;
		font-weight: 500;
	}
	
	.qr-image-container {
		background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
		padding: 40px;
		border-radius: 15px;
		margin: 30px auto;
		display: inline-block;
		box-shadow: inset 0 2px 10px rgba(0,0,0,0.05);
		border: 3px dashed #dee2e6;
	}
	
	.qr-image {
		width: 280px;
		height: 280px;
		border-radius: 12px;
		box-shadow: 0 5px 20px rgba(0,0,0,0.15);
		background: white;
		padding: 10px;
	}
	
	.qr-instructions {
		background: #e7f3ff;
		padding: 20px;
		border-radius: 10px;
		margin-top: 20px;
		text-align: left;
		font-size: 11pt;
		color: #555;
		line-height: 1.8em;
	}
	
	.qr-instructions h3 {
		color: #2068b0;
		font-size: 13pt;
		margin-bottom: 15px;
		display: flex;
		align-items: center;
		gap: 10px;
	}
	
	.qr-instructions ol {
		margin: 10px 0;
		padding-left: 25px;
	}
	
	.qr-instructions li {
		margin: 8px 0;
	}
	
	.info-banner {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		padding: 30px;
		border-radius: 15px;
		margin: 40px 0;
		text-align: center;
	}
	
	.info-banner h3 {
		font-size: 18pt;
		margin-bottom: 15px;
	}
	
	.info-banner p {
		font-size: 12pt;
		line-height: 1.8em;
		margin: 0;
	}
	
	.contact-support {
		background: #fff3cd;
		padding: 25px;
		border-radius: 10px;
		margin-top: 40px;
		border-left: 4px solid #ffc107;
		text-align: center;
	}
	
	.contact-support h3 {
		color: #856404;
		margin-bottom: 15px;
		font-size: 16pt;
	}
	
	.contact-support p {
		color: #856404;
		font-size: 12pt;
		line-height: 1.8em;
		margin: 10px 0;
	}
	
	.contact-support a {
		color: #25d366;
		text-decoration: none;
		font-weight: bold;
		display: inline-flex;
		align-items: center;
		gap: 8px;
		margin-top: 10px;
		font-size: 13pt;
	}
	
	.contact-support a:hover {
		text-decoration: underline;
	}
	
	@media (max-width: 768px) {
		.payment-header h1 {
			font-size: 24pt;
		}
		
		.qr-grid {
			gap: 50px;
			padding: 0 10px;
		}
		
		.qr-card {
			padding: 30px 20px;
		}
		
		.qr-image-container {
			padding: 30px 20px;
		}
		
		.qr-image {
			width: 220px;
			height: 220px;
		}
		
		.qr-card-header h2 {
			font-size: 18pt;
		}
		
		.qr-card-header i {
			font-size: 32pt;
		}
	}
</style>
</head>
<body>
	<?php include 'msg.php';?>
	<script type="text/javascript" src="js/msg.js"></script>
	
	<div id="container">
		<?php include 'navbar.php';?>
		
		<div id="subcont">
			<div id="banner2" style="background: linear-gradient(135deg, #2068b0 0%, #0aaeef 100%);" class="tableo">
				<span class="tablei wtitle" style="font-size: 32pt;">
					<i class="fas fa-qrcode"></i> PAGAR FACTURA
				</span>
			</div>
			
			<section style="background-color: #f5f9fc; padding: 60px 0;">
				<div class="payment-container">
					
					<!-- Header -->
					<div class="payment-header">
						<h1>
							<i class="fas fa-mobile-alt" style="color: #0aaeef;"></i>
							Paga tu Factura con Código QR
						</h1>
						<div style="width: 80px; height: 3px; background: linear-gradient(90deg, #2068b0, #0aaeef); margin: 20px auto;"></div>
						<p>
							Realiza el pago de tu servicio de internet de forma rápida y segura escaneando 
							cualquiera de nuestros códigos QR desde tu aplicación de pagos favorita.
						</p>
					</div>
					
					<!-- Info Banner -->
					<div class="info-banner">
						<h3><i class="fas fa-info-circle"></i> Información Importante</h3>
						<p>
							<strong>Después de realizar el pago</strong>, envíanos el comprobante por WhatsApp 
							al <strong>314-399-4608</strong> junto con tu número de cuenta o nombre completo 
							para registrar tu pago de inmediato.
						</p>
					</div>
					
					<!-- Advertencia de QR -->
					<div style="background: #fff3cd; padding: 25px; border-radius: 12px; border-left: 5px solid #ffc107; margin: 30px 0; text-align: center;">
						<h3 style="color: #856404; font-size: 16pt; margin-bottom: 15px;">
							<i class="fas fa-exclamation-triangle"></i> ¡Importante al Escanear!
						</h3>
						<p style="color: #856404; font-size: 12pt; line-height: 1.8em;">
							<strong>Escanea ÚNICAMENTE el código QR de tu aplicación.</strong><br>
							Los códigos están separados para evitar errores.<br>
							<span style="font-size: 13pt;">👇 Baja con cuidado y escanea solo el que necesites 👇</span>
						</p>
					</div>
					
					<!-- QR Grid -->
					<div class="qr-grid">
						
						<!-- Nequi -->
						<div class="qr-card nequi">
							<div class="qr-card-header">
								<div class="qr-card-number" style="color: #fc2779;">1</div>
								<i class="fas fa-mobile-alt"></i>
								<h2>Nequi</h2>
							</div>
							<p style="font-size: 12pt; color: #666; margin-bottom: 20px; font-weight: 500;">
								<i class="fas fa-arrow-down"></i> Escanea SOLO este código QR desde tu app Nequi <i class="fas fa-arrow-down"></i>
							</p>
							
							<div class="qr-image-container">
								<img src="img/NequiQR.png" alt="Código QR Nequi" class="qr-image">
							</div>
							
							<div class="qr-instructions">
								<h3><i class="fas fa-list-ol"></i> Cómo pagar:</h3>
								<ol>
									<li>Abre la app <strong>Nequi</strong></li>
									<li>Toca el botón <strong>"Pagar con QR"</strong></li>
									<li>Escanea este código QR</li>
									<li>Ingresa el monto de tu factura</li>
									<li>Confirma el pago</li>
									<li>Envía el comprobante por WhatsApp</li>
								</ol>
							</div>
						</div>
						
						<!-- Daviplata -->
						<div class="qr-card daviplata">
							<div class="qr-card-header">
								<div class="qr-card-number" style="color: #ed1c24;">2</div>
								<i class="fas fa-credit-card"></i>
								<h2>Daviplata</h2>
							</div>
							<p style="font-size: 12pt; color: #666; margin-bottom: 20px; font-weight: 500;">
								<i class="fas fa-arrow-down"></i> Escanea SOLO este código QR desde tu app Daviplata <i class="fas fa-arrow-down"></i>
							</p>
							
							<div class="qr-image-container">
								<img src="img/DaviplataQR.png" alt="Código QR Daviplata" class="qr-image">
							</div>
							
							<div class="qr-instructions">
								<h3><i class="fas fa-list-ol"></i> Cómo pagar:</h3>
								<ol>
									<li>Abre la app <strong>Daviplata</strong></li>
									<li>Selecciona <strong>"Pagar con QR"</strong></li>
									<li>Escanea este código QR</li>
									<li>Ingresa el valor a pagar</li>
									<li>Confirma la transacción</li>
									<li>Envía el comprobante por WhatsApp</li>
								</ol>
							</div>
						</div>
						
						<!-- Bancolombia -->
						<div class="qr-card bancolombia">
							<div class="qr-card-header">
								<div class="qr-card-number" style="color: #004b93;">3</div>
								<i class="fas fa-university"></i>
								<h2>Bancolombia</h2>
							</div>
							<p style="font-size: 12pt; color: #666; margin-bottom: 20px; font-weight: 500;">
								<i class="fas fa-arrow-down"></i> Escanea SOLO este código QR desde tu app Bancolombia <i class="fas fa-arrow-down"></i>
							</p>
							
							<div class="qr-image-container">
								<img src="img/BancolombiaQR.png" alt="Código QR Bancolombia" class="qr-image">
							</div>
							
							<div class="qr-instructions">
								<h3><i class="fas fa-list-ol"></i> Cómo pagar:</h3>
								<ol>
									<li>Abre la app <strong>Bancolombia</strong></li>
									<li>Ve a <strong>"Pagar con QR"</strong></li>
									<li>Escanea este código QR</li>
									<li>Ingresa el monto de tu factura</li>
									<li>Autoriza el pago</li>
									<li>Envía el comprobante por WhatsApp</li>
								</ol>
							</div>
						</div>
						
					</div>
					
					<!-- Contact Support -->
					<div class="contact-support">
						<h3><i class="fas fa-headset"></i> ¿Necesitas Ayuda?</h3>
						<p>
							Si tienes dudas sobre tu factura o el proceso de pago, contáctanos:
						</p>
						<a href="https://wa.me/573143994608?text=Hola,%20necesito%20ayuda%20con%20el%20pago%20de%20mi%20factura" target="_blank">
							<i class="fab fa-whatsapp fa-2x"></i>
							WhatsApp: 314-399-4608
						</a>
						<p style="margin-top: 15px;">
							<i class="fas fa-envelope"></i> 
							<strong>Email:</strong> konectandointernetrural@gmail.com
						</p>
					</div>
					
				</div>
			</section>
			
		</div>
		
		<?php include 'footer.php';?>
	</div>
	
	<!-- Botón flotante de WhatsApp -->
	<a href="https://wa.me/573143994608?text=Hola,%20necesito%20ayuda%20con%20el%20pago%20de%20mi%20factura" 
	   class="whatsapp-float" 
	   target="_blank"
	   title="Chatea con nosotros por WhatsApp">
		<i class="fab fa-whatsapp whatsapp-icon"></i>
	</a>
	
	<style>
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
	</style>
	
</body>
</html>
