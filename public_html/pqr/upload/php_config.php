<?php
// Suprimir todos los errores de compatibilidad PHP 8.x
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

// Configuración de sesión antes de que se envíen headers
if (!session_id()) {
    ini_set('session.use_cookies', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_httponly', '1');
}
