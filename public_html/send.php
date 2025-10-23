<?php
// Configuración de SendGrid
require_once 'pqr/upload/includes/email-config.php';
require_once 'pqr/upload/includes/sendgrid-sender.php';

// Validar que vengan datos por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contactenos.php?error=metodo');
    exit;
}

// Obtener y sanitizar datos del formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$correo_cliente = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$mensaje_cliente = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

// Validar que no estén vacíos
if (empty($nombre) || empty($correo_cliente) || empty($telefono) || empty($mensaje_cliente)) {
    header('Location: contactenos.php?error=campos_vacios');
    exit;
}

// Validar formato de email
if (!filter_var($correo_cliente, FILTER_VALIDATE_EMAIL)) {
    header('Location: contactenos.php?error=email_invalido');
    exit;
}

// Preparar el correo para el administrador
$asunto_admin = 'Nuevo mensaje de contacto - ' . $nombre;
$mensaje_admin = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background: #f8f9fa; padding: 20px; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: white; padding: 30px; border-radius: 0 0 8px 8px; }
        .info-box { background: #e7f3ff; padding: 15px; border-radius: 6px; margin: 15px 0; border-left: 4px solid #007bff; }
        .info-box strong { color: #0056b3; }
        .footer { text-align: center; padding: 20px; color: #6c757d; font-size: 12px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>📬 Nuevo Mensaje de Contacto</h2>
            <p>Formulario Web - Konectando</p>
        </div>
        
        <div class='content'>
            <div class='info-box'>
                <strong>👤 Nombre:</strong><br>
                " . htmlspecialchars($nombre) . "
            </div>
            
            <div class='info-box'>
                <strong>📧 Correo Electrónico:</strong><br>
                <a href='mailto:" . htmlspecialchars($correo_cliente) . "'>" . htmlspecialchars($correo_cliente) . "</a>
            </div>
            
            <div class='info-box'>
                <strong>📱 Teléfono:</strong><br>
                <a href='tel:" . htmlspecialchars($telefono) . "'>" . htmlspecialchars($telefono) . "</a><br>
                <a href='https://wa.me/57" . preg_replace('/[^0-9]/', '', $telefono) . "' target='_blank' style='color: #25d366;'>
                    💬 Abrir en WhatsApp
                </a>
            </div>
            
            <div class='info-box'>
                <strong>💬 Mensaje:</strong><br>
                " . nl2br(htmlspecialchars($mensaje_cliente)) . "
            </div>
            
            <p style='color: #6c757d; font-size: 12px; margin-top: 20px;'>
                📅 Recibido: " . date('d/m/Y H:i:s') . "
            </p>
        </div>
        
        <div class='footer'>
            <p>Sistema de Contacto - Konectando Internet Rural</p>
            <p>© " . date('Y') . " Konectando - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>
";

// Preparar correo de confirmación para el cliente
$asunto_cliente = 'Gracias por contactarnos - Konectando Internet Rural';
$mensaje_confirmacion = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background: #f8f9fa; padding: 20px; }
        .header { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 30px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: white; padding: 30px; border-radius: 0 0 8px 8px; }
        .info-box { background: #fff3cd; padding: 20px; border-radius: 6px; margin: 20px 0; border-left: 4px solid #ffc107; }
        .button { display: inline-block; background: #25d366; color: white !important; padding: 15px 30px; text-decoration: none; border-radius: 6px; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #6c757d; font-size: 12px; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>✅ ¡Mensaje Recibido!</h2>
            <p>Konectando Internet Rural</p>
        </div>
        
        <div class='content'>
            <p>Hola <strong>" . htmlspecialchars($nombre) . "</strong>,</p>
            
            <p>¡Gracias por contactarnos! Hemos recibido tu mensaje y nos pondremos en contacto contigo lo antes posible.</p>
            
            <div class='info-box'>
                <strong>📝 Tu mensaje:</strong><br>
                <em>" . nl2br(htmlspecialchars($mensaje_cliente)) . "</em>
            </div>
            
            <p><strong>Horario de atención:</strong><br>
            Lunes a Viernes: 8:00 AM - 6:00 PM<br>
            Sábados: 8:00 AM - 2:00 PM</p>
            
            <p style='text-align: center;'>
                <a href='https://wa.me/573143994608?text=Hola,%20necesito%20información' class='button'>
                    💬 Escríbenos por WhatsApp
                </a>
            </p>
            
            <p style='color: #6c757d; font-size: 12pt;'>
                Si tienes alguna urgencia, puedes contactarnos directamente:<br>
                📱 WhatsApp: 314-399-4608<br>
                📧 Email: konectandointernetrural@gmail.com
            </p>
        </div>
        
        <div class='footer'>
            <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
            <p>© " . date('Y') . " Konectando Internet Rural - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>
";

// Enviar correo al administrador usando SendGrid
$envio_admin = false;
if (defined('EMAIL_METHOD') && EMAIL_METHOD === 'sendgrid') {
    $envio_admin = SendGridEmailSender::sendWithTemplate(
        ADMIN_EMAIL,
        $asunto_admin,
        $mensaje_admin
    );
} else {
    // Fallback a mail() nativo si SendGrid no está configurado
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . FROM_EMAIL . "\r\n";
    $headers .= "Reply-To: " . $correo_cliente . "\r\n";
    $envio_admin = mail(ADMIN_EMAIL, $asunto_admin, $mensaje_admin, $headers);
}

// Enviar correo de confirmación al cliente
$envio_cliente = false;
if (defined('EMAIL_METHOD') && EMAIL_METHOD === 'sendgrid') {
    $envio_cliente = SendGridEmailSender::sendWithTemplate(
        $correo_cliente,
        $asunto_cliente,
        $mensaje_confirmacion
    );
} else {
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . FROM_EMAIL . "\r\n";
    $headers .= "Reply-To: " . ADMIN_EMAIL . "\r\n";
    $envio_cliente = mail($correo_cliente, $asunto_cliente, $mensaje_confirmacion, $headers);
}

// Registrar en log
error_log("Contacto web - De: $nombre ($correo_cliente) - Admin: " . ($envio_admin ? 'OK' : 'FAIL') . " Cliente: " . ($envio_cliente ? 'OK' : 'FAIL'));

// Redirigir según resultado
if ($envio_admin || $envio_cliente) {
    header('Location: contactenos.php?success=1');
} else {
    header('Location: contactenos.php?error=envio');
}
exit;
?>