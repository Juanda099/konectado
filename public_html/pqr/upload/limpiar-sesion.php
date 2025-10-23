<?php
// Limpiar todas las sesiones de osTicket
session_start();
session_unset();
session_destroy();

// Limpiar cookies
if (isset($_COOKIE['OSTSESSID'])) {
    setcookie('OSTSESSID', '', time() - 3600, '/');
    unset($_COOKIE['OSTSESSID']);
}

// Limpiar archivos de sesión antiguos
$sessionPath = 'C:/laragon/tmp';
$sessions = glob($sessionPath . '/sess_*');
foreach ($sessions as $session) {
    @unlink($session);
}

echo "<!DOCTYPE html>";
echo "<html><head><title>Limpieza Completada</title>";
echo "<style>body{font-family:Arial;max-width:600px;margin:50px auto;padding:20px;}";
echo "h1{color:#28a745;}p{font-size:18px;}</style></head><body>";
echo "<h1>✓ Limpieza Completada</h1>";
echo "<p>✓ Sesión PHP destruida</p>";
echo "<p>✓ Cookie OSTSESSID eliminada</p>";
echo "<p>✓ " . count($sessions) . " archivo(s) de sesión eliminados</p>";
echo "<hr>";
echo "<h2>Siguiente paso:</h2>";
echo "<p><strong>1.</strong> Cierra esta pestaña</p>";
echo "<p><strong>2.</strong> Abre una ventana de incógnito (Ctrl + Shift + N)</p>";
echo "<p><strong>3.</strong> Ve a: <a href='http://localhost/proditel/pqr/upload/scp/'>http://localhost/proditel/pqr/upload/scp/</a></p>";
echo "<p><strong>4.</strong> Inicia sesión con: <strong>admin</strong> / <strong>admin123</strong></p>";
echo "</body></html>";
?>
