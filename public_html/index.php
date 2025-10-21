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
<title>Konectando Internet Rural</title>
<style type="text/css">

</style>
</head>
<body>
	<div id="container">
				<?php include 'header.php';?>
		<!-- Nav Bar -->
		<div id="navbarcont" class="borderb">
				<div class="inwidth">
					<a href="index.php"><div id="logo"><img src="img/logo_konet.png"></div></a>
					<div id="navbuttcont">
							<a href="index.php"><div id="button" class="w14 tableo borderl but">
								<span class="tablei">Inicio</span>
							</div></a>
							<a href="#acerca"><div id="button" class="w14 tableo borderl but">
								<span class="tablei">Acerca de</span>
							</div></a>
							<a href="#servicios"><div id="button" class="w14 tableo borderl but">
								<span class="tablei">Servicios</span>
							</div></a>
							<a href="#soporte"><div id="button" class="w14 tableo borderl but">
								<span class="tablei">Soporte</span>
							</div></a>
							<a href="#proteccion"><div id="button" class="w14 tableo borderl but">
								<span class="tablei">Proteccion</span>
							</div></a>
							<a href="https://www.zonapagos.com/t_Proditelsas" target="_blank"><div id="button" class="w14 tableo borderl but">
								<span class="tablei">Pagar Factura</span>
							</div></a>
							<a href="contactenos.php"><div id="button" class="w14 tableo borderl borderr but">
								<span class="tablei">Contactenos</span>
							</div></a>
						</div>
					</div>

			</div>

			<!-- Nav bar ends here -->
			<!-- Mobile Nav Bar -->
	
				<div id="mobilelogocont" class="borderb">
					<div id="menubut" onClick="menu()"><i class="fas fa-bars fa-2x"></i></div>
					<img src="img/logo_konet.png" width="200px;">
				</div>

				<div id="navmobilecont">
					<a href="index.php"><div class="mob-but borderb">
						<div class="tableo but">
							<span class="tablei">Inicio</span>
						</div>
					</div></a>
					<a href="#acerca"><div class="mob-but borderb">
						<div class="tableo but">
							<span class="tablei">Acerca de</span>
						</div>
					</div></a>
					<a href="#servicios"><div class="mob-but borderb">
						<div class="tableo but">
							<span class="tablei">Servicios</span>
						</div>
					</div></a>
					<a href="#soporte"><div class="mob-but borderb">
						<div class="tableo but">
							<span class="tablei">Soporte</span>
						</div>
					</div></a>
					<a href="#proteccion"><div class="mob-but borderb">
						<div class="tableo but">
							<span class="tablei">Proteccion</span>
						</div>
					</div></a>
					<a href="contactenos.php"><div class="mob-but borderb">
						<div class="tableo but">
							<span class="tablei">Contactenos</span>
						</div>
					</div></a>
				</div>

				<!-- Mobile Nav Bar ends here -->

				<script>
			function menu(){
				var margin = $("#navmobilecont").css("left");

				if(margin == "-300px"){
					$('#navmobilecont').stop().animate({left: 0},400,'easeOutQuint');
				}
				else {
					$('#navmobilecont').stop().animate({left: -300},400,'easeOutQuint');
				}

			}

			</script>
	<!-- Nav bar ends here -->
		
			<script>

				$('a[href^="#"]').click(function (e) {
						e.preventDefault();

						var target = this.hash;
						var $target = $(target);

						$('html, body').stop().animate({
							'scrollTop': $target.offset().top
						}, 1000, 'easeOutQuint', function () {
							window.location.hash = target;
						});
					});

				</script>
		
	  <div id="subcont">
			<img src="img/banner2.jpg" width="100%" alt=""/>
<section id="acerca" style="background: linear-gradient(135deg, #f5f9fc 0%, #e8f4f8 100%); padding: 60px 0;">
	  <div class="inwidth">
					<!-- Título Principal -->
					<div style="text-align: center; margin-bottom: 40px;">
						<h1 style="font-size: 42pt; color: #2068b0; font-weight: 300; margin-bottom: 15px; line-height: 1.2em;">
							Konectando Internet Rural
						</h1>
						<div style="width: 80px; height: 3px; background: linear-gradient(90deg, #2068b0, #0aaeef); margin: 0 auto 25px;"></div>
						<p style="font-size: 13pt; color: #616163; max-width: 800px; margin: 0 auto; line-height: 1.8em;">
							Brindamos servicios de internet de alta calidad mediante tecnología inalámbrica, llevando conectividad a las zonas rurales del norte del municipio de Girardot, Cundinamarca.
						</p>
					</div>

					<!-- Cobertura con Grid Moderno -->
					<div style="background: white; border-radius: 15px; padding: 40px; box-shadow: 0 5px 20px rgba(0,0,0,0.08); margin: 40px auto; max-width: 900px;">
						<h2 style="text-align: center; color: #2068b0; font-size: 24pt; font-weight: 400; margin-bottom: 35px;">
							<i class="fas fa-map-marker-alt" style="color: #0aaeef; margin-right: 10px;"></i>
							Nuestra Cobertura
						</h2>
						
						<!-- Grid de Veredas -->
						<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-bottom: 30px;">
							<div class="vereda-item">• Barzaloza</div>
							<div class="vereda-item">• Guabinal</div>
							<div class="vereda-item">• Altos de Chicala</div>
							<div class="vereda-item">• Altos de Piamonte</div>
							<div class="vereda-item">• Piamonte</div>
							<div class="vereda-item">• Galán</div>
							<div class="vereda-item">• Presidente</div>
							<div class="vereda-item">• Berlín</div>
							<div class="vereda-item">• Pubenza</div>
							<div class="vereda-item">• Salada</div>
							<div class="vereda-item">• Malberto</div>
							<div class="vereda-item">• Teté</div>
						</div>
					</div>

					<!-- Propuesta de Valor -->
					<div style="text-align: center; margin-top: 50px; padding: 35px; background: rgba(32, 104, 176, 0.05); border-radius: 12px; border-left: 4px solid #2068b0;">
						<p style="font-size: 13pt; color: #616163; line-height: 1.9em; max-width: 850px; margin: 0 auto;">
							<strong style="color: #2068b0; font-size: 14pt;">Nuestro Compromiso:</strong><br>
							Nos especializamos en llevar internet de alta velocidad a zonas rurales de difícil acceso, ofreciendo planes simétricos con la mejor relación calidad-precio del mercado. 
							<span style="color: #0aaeef; font-weight: 500;">Conectamos a las comunidades rurales con el mundo digital.</span>
						</p>
					</div>

				</div>      		
       		</section>
			
			<style>
				.vereda-item {
					background: linear-gradient(135deg, #f8fbff 0%, #f0f7fc 100%);
					padding: 12px 15px;
					border-radius: 8px;
					font-size: 11pt;
					color: #2068b0;
					font-weight: 500;
					transition: all 0.3s ease;
					border: 1px solid #e0f0f8;
					text-align: center;
				}
				.vereda-item:hover {
					background: linear-gradient(135deg, #2068b0 0%, #1a5490 100%);
					color: white;
					transform: translateY(-3px);
					box-shadow: 0 5px 15px rgba(32, 104, 176, 0.3);
				}
				
				@media (max-width: 768px) {
					.vereda-item {
						font-size: 10pt;
						padding: 10px 12px;
					}
				}
			</style>
			<section id="servicios" style="background-color: #fbfbfb; padding-bottom: 50px;">
				<div class="inwidth-block">
							<div class="w50">
								<div class="wi90 borders">
									<span class="fa-stack fa-3x">
									  <i class="fas fa-circle fa-stack-2x" style="color:#2068b0"></i>
									  <i class="fas fa-home fa-stack-1x fa-inverse"></i>
									</span>
									<h2>NUESTROS PLANES</h2>
									<span>Ofrecemos tres planes de internet con velocidades simétricas diseñados especialmente para zonas rurales. Desde navegación básica hasta trabajo remoto profesional.</span><br><br>
									<span><strong>Plan Básico:</strong> 20 Mbps - $70.000</span><br>
									<span><strong>Plan Universitario:</strong> 30 Mbps - $100.000</span><br>
									<span><strong>Plan Empresarial:</strong> 50 Mbps - $150.000</span><br><br>
									<span style="font-size: 0.9em;">* Estratos 1 y 2 exentos de IVA</span><br><br>
									<a href="residenciales.php"><div class="button1">Mas Informacion</div></a>
								</div>
							</div>  
							<div class="w50">
								<div class="wi90 borders">
									<span class="fa-stack fa-3x">
									  <i class="fas fa-circle fa-stack-2x" style="color:#2068b0"></i>
									  <i class="fas fa-wifi fa-stack-1x fa-inverse"></i>
									</span>
									<h2>COBERTURA RURAL</h2>						
									<span>Llevamos internet de alta velocidad a las veredas del norte de Girardot: Barzaloza, Guabinal, Altos de Chicala, Altos de Piamonte, Piamonte, Galán, Presidente, Berlín, Pubenza, Salada, Malberto y Teté.</span><br><br>
									<span>Tecnología inalámbrica de última generación para zonas de difícil acceso.</span><br><br>
									<a href="#acerca"><div class="button1">Conoce Nuestra Cobertura</div></a>
								</div>
							</div>
				    		
   		  </section>
       		
   		  <section style="padding-top: 0px;">
	     	 <img src="img/banner22.jpg" width="100%" alt=""/> 
      	  </section>
       		
   		  <section id="soporte" style="padding-top: 0px; background-color: #fbfbfb;">
   			  <div id="banner-back">
   			  
					<div class="inwidth-block">
						<a href="pqr/upload"><div class="w25">
					  	  <div class="wi90p20 borders" style="background-color: white; text-align: center;">						
								 <i class="fas fa-file-alt fa-3x" style="color:#1c64ac"></i>

								<div class="el-tit tableo"><h3 class="tablei" style="color:#1c64ac">PQR</h3></div>						
								<span>Radique y consulte el estado de su PQR.</span>
							</div>
						</div></a>
     					<a href="medidor.php"><div class="w25">
					  	  <div class="wi90p20 borders" style="background-color: white;">						
								 <i class="fas fa-tachometer-alt fa-3x" style="color:#1c64ac"></i>

								<div class="el-tit tableo"><h3 class="tablei" style="color:#1c64ac">MEDIDOR DE VELOCIDAD</h3></div>						
								<span>Mida la velocidad de su conexion a internet.</span>
							</div>
						</div></a>
     					<a href="disponibilidad.pdf" target="_blank"><div class="w25">
					  	  <div class="wi90p20 borders" style="background-color: white;">						
								 <i class="fas fa-chart-line fa-3x" style="color:#1c64ac"></i>

								<div class="el-tit tableo"><h3 class="tablei" style="color:#1c64ac">INDICADORES DE DISPONIBILIDAD</h3></div>						
								<span>Indicadores de calidad de nuestros servicios.</span>
							</div>
     					</div></a>
     					<a href="caracteristicas.php"><div class="w25">
					  	  <div class="wi90p20 borders" style="background-color: white;">						
								 <i class="fas fa-clipboard-list fa-3x" style="color:#1c64ac"></i>

								<div class="el-tit tableo"><h3 class="tablei" style="color:#1c64ac">CARACTERISTICAS DEL SERVICIO</h3></div>						
								<span>Caracteristicas de nuestros servicios.</span>
							</div>
						</div></a>
					</div>
    				<a href="ficha tecnica.pdf" target="_blank"><div class="inwidth-block">
     					<div class="w25">
					  	  <div class="wi90p20 borders" style="background-color: white;">						
								 <i class="fas fa-list fa-3x" style="color:#1c64ac"></i>

								<div class="el-tit tableo"><h3 class="tablei" style="color:#1c64ac">FICHA TECNICA MODEMS</h3></div>						
								<span>Informacion sobre nuestros dispositivos.</span>
							</div>
						</div></a>
     					<a href="factores.php"><div class="w25">
					  	  <div class="wi90p20 borders" style="background-color: white;">						
								 <i class="fas fa-exclamation-triangle fa-3x" style="color:#1c64ac"></i>

								<div class="el-tit tableo"><h3 class="tablei" style="color:#1c64ac">FACTORES DE LIMITACION DE VELOCIDAD</h3></div>						
								<span>Facores que pueden estar limitando su servicio.</span>
							</div>
						</div></a>
     					<a href="informacion_crc.php"><div class="w25">
					  	  <div class="wi90p20 borders" style="background-color: white;">						
								 <i class="fas fa-glasses fa-3x" style="color:#1c64ac"></i>

								<div class="el-tit tableo"><h3 class="tablei" style="color:#1c64ac">INFORMACION CRC MODEMS</h3></div>						
								<span>Informacion de utilidad de la CRC.</span>
							</div>
						</div></a>
      				
      				
      				</div>       				
       			</div>
			</section>
     		
      		<section id="proteccion" style="background-color: #1c64ac;">
      			<div class="inwidth-block" style="color: white;">
					<a href="procedimientos.php"><div class="w33">
						<div class="wi90p20">
					    	<img src="img/procedimientos.jpg" class="rimg" width="100%" alt=""/> 
					    	<div class="el-tit tableo">
					    		<h3 class="tablei">PROCEDIMIENTOS PQR</h3>
					    	</div>
					    </div>
					</div></a>		
				
				
				
					<a href="atencion.pdf" target="_blank"><div class="w33">
						<div class="wi90p20">
					    	<img src="img/atencion.jpg" class="rimg" width="100%" alt=""/> 
					    	<div class="el-tit tableo">
					    		<h3 class="tablei">INDICADORES DE ATENCION AL USUARIO</h3>
					    	</div>
					    </div>
					</div></a>			
				
				
					<a href="control.php"><div class="w33">
						<div class="wi90p20">
					    	<img src="img/control.jpg" class="rimg" width="100%" alt=""/> 
					    	<div class="el-tit tableo">
					    		<h3 class="tablei">CONTROL PARENTAL</h3>
					    	</div>
					    </div>
					</div>	</a>			
				</div>
			</section>
     		
      		<section>
      			<div class="inwidth-block">
      				<a href="https://www.crcom.gov.co/es/pagina/regimen-proteccion-usuario" target="_blank"><img src="img/1562617504187.jpg" width="100%"></a>
				</div> 			
      			
      		</section>
      		
      		
       		
		<?php include 'footer.php';?>
       		
        </div>
	</div>
	
</body>
</html>


