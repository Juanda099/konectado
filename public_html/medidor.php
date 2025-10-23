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
		  
            <!-- Test de Velocidad Integrado -->
            <div style="max-width: 900px; margin: 40px auto; padding: 20px;">
                <div style="background: white; border-radius: 15px; padding: 40px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
                    <h2 style="text-align: center; color: #2068b0; margin-bottom: 30px;">
                        <i class="fas fa-tachometer-alt"></i> Test de Velocidad
                    </h2>
                    <p style="text-align: center; color: #666; margin-bottom: 30px; line-height: 1.6;">
                        Haz clic en el botón para iniciar la medición de tu velocidad de internet.
                        El test medirá tu velocidad de descarga, carga y latencia (ping).
                    </p>
                    
                    <!-- Botón Principal Speedtest -->
                    <div style="text-align: center; margin: 40px 0;">
                        <a href="https://www.speedtest.net/es" 
                           target="_blank" 
                           style="display: inline-block; background: linear-gradient(135deg, #2068b0 0%, #0aaeef 100%); 
                                  color: white; padding: 25px 60px; text-decoration: none; border-radius: 12px; 
                                  font-weight: 700; font-size: 20px; transition: all 0.3s; box-shadow: 0 5px 20px rgba(32,104,176,0.4);
                                  text-transform: uppercase; letter-spacing: 1px;">
                            <i class="fas fa-bolt" style="margin-right: 10px;"></i> INICIAR TEST DE VELOCIDAD
                        </a>
                        <p style="color: #888; margin-top: 15px; font-size: 14px;">
                            Se abrirá Speedtest.net en una nueva pestaña
                        </p>
                    </div>
                    
                    <!-- Opciones alternativas -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 40px;">
                        <a href="https://fast.com" target="_blank" 
                           style="text-decoration: none; background: #f8f9fa; padding: 25px; border-radius: 10px; 
                                  border: 2px solid #e0e0e0; transition: all 0.3s; text-align: center;">
                            <div style="font-size: 40px; margin-bottom: 10px;">⚡</div>
                            <h3 style="color: #2068b0; margin-bottom: 10px; font-size: 18px;">Fast.com</h3>
                            <p style="color: #666; font-size: 14px; line-height: 1.6;">Test rápido de Netflix. Solo mide velocidad de descarga.</p>
                        </a>
                        
                        <a href="https://www.speedcheck.org/es/" target="_blank" 
                           style="text-decoration: none; background: #f8f9fa; padding: 25px; border-radius: 10px; 
                                  border: 2px solid #e0e0e0; transition: all 0.3s; text-align: center;">
                            <div style="font-size: 40px; margin-bottom: 10px;">📊</div>
                            <h3 style="color: #2068b0; margin-bottom: 10px; font-size: 18px;">SpeedCheck</h3>
                            <p style="color: #666; font-size: 14px; line-height: 1.6;">Alternativa completa con historial de pruebas.</p>
                        </a>
                        
                        <a href="https://www.nperf.com/es/" target="_blank" 
                           style="text-decoration: none; background: #f8f9fa; padding: 25px; border-radius: 10px; 
                                  border: 2px solid #e0e0e0; transition: all 0.3s; text-align: center;">
                            <div style="font-size: 40px; margin-bottom: 10px;">🎯</div>
                            <h3 style="color: #2068b0; margin-bottom: 10px; font-size: 18px;">nPerf</h3>
                            <p style="color: #666; font-size: 14px; line-height: 1.6;">Test detallado con calidad de streaming.</p>
                        </a>
                    </div>
                    
                    <!-- Información adicional -->
                    <div style="margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #2068b0;">
                        <h3 style="color: #2068b0; margin-bottom: 15px; font-size: 18px;">
                            <i class="fas fa-info-circle"></i> ¿Qué significan los resultados?
                        </h3>
                        <ul style="color: #555; line-height: 2; list-style: none; padding-left: 0;">
                            <li><strong style="color: #2068b0;">📥 Descarga (Download):</strong> Velocidad al recibir datos (navegar, ver videos, descargar archivos)</li>
                            <li><strong style="color: #2068b0;">📤 Subida (Upload):</strong> Velocidad al enviar datos (videollamadas, subir archivos, transmitir)</li>
                            <li><strong style="color: #2068b0;">⚡ Ping/Latencia:</strong> Tiempo de respuesta (importante para juegos y videollamadas). Menor es mejor.</li>
                        </ul>
                    </div>
                    
                    <div style="margin-top: 30px; padding: 20px; background: linear-gradient(135deg, #f0f7fc 0%, #e8f4f8 100%); border-radius: 10px; text-align: center;">
                        <p style="color: #2068b0; font-weight: 600; margin-bottom: 10px;">
                            <i class="fas fa-lightbulb"></i> Consejos para una medición precisa
                        </p>
                        <ul style="color: #666; line-height: 1.8; display: inline-block; text-align: left; list-style: none; padding-left: 0;">
                            <li>✓ Conecta tu dispositivo por cable Ethernet si es posible</li>
                            <li>✓ Cierra otras aplicaciones que usen internet</li>
                            <li>✓ Realiza varias pruebas en diferentes horarios</li>
                            <li>✓ Desconecta otros dispositivos de la red durante la prueba</li>
                        </ul>
                    </div>
                </div>
            </div>
            <br>
            
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


