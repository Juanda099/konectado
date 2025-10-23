<!-- Header -->
		<?php include 'header.php';?>
	<!-- Header ends here -->
	<!-- Nav Bar -->
	<div id="navbarcont" class="borderb">
			<div class="inwidth">
				<a href="index.php"><div id="logo"><img src="img/logo_konet.png"></div></a>
				<div id="navbuttcont">
					<a href="index.php"><div id="button" class="w14 tableo borderl but">
						<span class="tablei">Inicio</span>
					</div></a>
					<a href="index.php#acerca"><div id="button" class="w14 tableo borderl but">
						<span class="tablei">Acerca de</span>
					</div></a>
					<a href="index.php#servicios"><div id="button" class="w14 tableo borderl but">
						<span class="tablei">Servicios</span>
					</div></a>
					<a href="index.php#soporte"><div id="button" class="w14 tableo borderl but">
						<span class="tablei">Soporte</span>
					</div></a>
				<a href="index.php#proteccion"><div id="button" class="w14 tableo borderl but">
					<span class="tablei">Proteccion</span>
				</div></a>
				<a href="pagar-factura.php"><div id="button" class="w14 tableo borderl but">
					<span class="tablei">Pagar Factura</span>
				</div></a>
				<a href="contactenos.php"><div id="button" class="w14 tableo borderl borderr but">
					<span class="tablei">Contactenos</span>
				</div></a>
				</div>
			</div>
	
	</div>
	<!-- Nav Bar ends here-->
	
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
		<a href="index.php#acerca"><div class="mob-but borderb">
			<div class="tableo but">
				<span class="tablei">Acerca de</span>
			</div>
		</div></a>
		<a href="index.php#servicios"><div class="mob-but borderb">
			<div class="tableo but">
				<span class="tablei">Servicios</span>
			</div>
		</div></a>
		<a href="index.php#soporte"><div class="mob-but borderb">
			<div class="tableo but">
				<span class="tablei">Soporte</span>
			</div>
		</div></a>
		<a href="index.php#proteccion"><div class="mob-but borderb">
			<div class="tableo but">
				<span class="tablei">Proteccion</span>
			</div>
		</div></a>
		<a href="pagar-factura.php"><div class="mob-but borderb">
			<div class="tableo but">
				<span class="tablei">Pagar Factura</span>
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
// Función para menú móvil
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
		