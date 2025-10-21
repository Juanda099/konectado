<?php
$nombre = $_POST ['nombre'];
$Correo = 'servicioalcliente@serkoi.com';
$Correo2 = $_POST ['correo'];
$telefono = $_POST ['telefono'];
$Asunto = 'Contacto Pagina Web';
$Comentarios = $_POST ['mensaje'];
$mensaje = "De: $nombre. \n". "Correo: $Correo2. \n". "Telefono: $telefono. \n". "Mensaje: $Comentarios. \n";

mail ($Correo, $Asunto, $mensaje, 'From:' .$Correo2);


ob_start(); // ensures anything dumped out will be caught



// do stuff here
$url = 'contactenos.php?ok'; // this can be set based on whatever

// clear out the output buffer
while (ob_get_status()) 
{
	
    ob_end_clean();
}

// no redirect

header( "Location: $url" );


?>