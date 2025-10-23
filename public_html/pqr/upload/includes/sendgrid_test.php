<?php
/**
 * Script de diagnóstico para ejecutar en producción.
 * Colócalo en /pqr/upload/includes/ y ejecútalo desde navegador o CLI.
 * Mostrará resultado y escribirá un log en sendgrid_test.log
 */

require_once __DIR__ . '/email-config.php';
require_once __DIR__ . '/sendgrid-sender.php';

$to = isset($_GET['to']) ? $_GET['to'] : ADMIN_EMAIL;
$subject = 'Prueba SendGrid - ' . date('Y-m-d H:i:s');
$body = '<p>Prueba de envío desde sendgrid_test.php en ' . php_uname('n') . '</p>';

$ok = SendGridEmailSender::sendWithTemplate($to, $subject, $body);

header('Content-Type: text/plain; charset=utf-8');
echo "Enviar a: {$to}\n";
echo "Resultado: " . ($ok ? 'OK' : 'FALLÓ') . "\n";
echo "Revisa el archivo sendgrid_test.log en el mismo directorio para detalles.\n";

?>
