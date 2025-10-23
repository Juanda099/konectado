<?php
/**
 * Sistema Simple de Notificaciones por Email
 * Funciona con mail() nativo de PHP o SMTP básico
 */

require_once 'email-config.php';

class SimpleEmailNotifier {
    
    /**
     * Enviar email cuando se crea un nuevo ticket
     */
    public static function notifyNewTicket($ticket_number, $user_name, $user_email, $subject, $message, $department, $priority, $created) {
        if (!EMAIL_ENABLED) {
            error_log("Email deshabilitado - Ticket #{$ticket_number} creado");
            return true; // Simular éxito para no bloquear el flujo
        }
        
        $to = $user_email;
        $email_subject = "Ticket #{$ticket_number} - Recibido";
        
        $body = self::getTemplateNewTicket([
            'number' => $ticket_number,
            'name' => $user_name,
            'subject' => $subject,
            'message' => nl2br(htmlspecialchars($message)),
            'department' => $department,
            'priority' => $priority,
            'created' => date('d/m/Y H:i', strtotime($created))
        ]);
        
        return self::sendEmail($to, $email_subject, $body);
    }
    
    /**
     * Notificar al cliente cuando el soporte responde
     */
    public static function notifyClientNewResponse($ticket_number, $ticket_subject, $user_name, $user_email, $staff_name, $response_message, $created) {
        if (!EMAIL_ENABLED) {
            error_log("Email deshabilitado - Respuesta en Ticket #{$ticket_number}");
            return true;
        }
        
        $to = $user_email;
        $email_subject = "Ticket #{$ticket_number} - Nueva respuesta de soporte";
        
        $body = self::getTemplateStaffResponse([
            'number' => $ticket_number,
            'name' => $user_name,
            'subject' => $ticket_subject,
            'staff_name' => $staff_name,
            'message' => nl2br(htmlspecialchars($response_message)),
            'created' => date('d/m/Y H:i', strtotime($created))
        ]);
        
        return self::sendEmail($to, $email_subject, $body);
    }
    
    /**
     * Notificar al soporte cuando el cliente responde
     */
    public static function notifyStaffNewMessage($ticket_id, $ticket_number, $ticket_subject, $user_name, $user_email, $message, $created) {
        if (!EMAIL_ENABLED) {
            error_log("Email deshabilitado - Cliente respondió Ticket #{$ticket_number}");
            return true;
        }
        
        // Obtener emails del personal
        $staff_emails = self::getStaffEmails();
        
        $email_subject = "Ticket #{$ticket_number} - Nueva respuesta del cliente";
        
        $body = self::getTemplateClientResponse([
            'ticket_id' => $ticket_id,
            'number' => $ticket_number,
            'subject' => $ticket_subject,
            'name' => $user_name,
            'email' => $user_email,
            'message' => nl2br(htmlspecialchars($message)),
            'created' => date('d/m/Y H:i', strtotime($created))
        ]);
        
        foreach ($staff_emails as $email) {
            self::sendEmail($email, $email_subject, $body);
        }
        
        return true;
    }
    
    /**
     * Obtener emails del personal de soporte
     */
    private static function getStaffEmails() {
        $conn = new mysqli('localhost', 'root', 'admin123', 'pqr');
        $conn->set_charset("utf8");
        
        $query = "SELECT email FROM ost_staff WHERE isactive = 1 AND email != '' AND email IS NOT NULL";
        $result = $conn->query($query);
        
        $emails = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emails[] = $row['email'];
            }
        }
        
        // Si no hay emails, usar el admin por defecto
        if (empty($emails) && defined('ADMIN_EMAIL')) {
            $emails[] = ADMIN_EMAIL;
        }
        
        $conn->close();
        return $emails;
    }
    
    /**
     * Enviar email
     */
    private static function sendEmail($to, $subject, $body) {
        // Si SendGrid está configurado, usarlo
        if (EMAIL_METHOD === 'sendgrid') {
            require_once 'sendgrid-sender.php';
            return SendGridEmailSender::sendWithTemplate($to, $subject, $body);
        }
        
        // Fallback a mail() nativo
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . FROM_NAME . " <" . FROM_EMAIL . ">" . "\r\n";
        $headers .= "Reply-To: " . FROM_EMAIL . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Registrar en log para debugging
        error_log("Enviando email a: $to - Asunto: $subject");
        
        $result = mail($to, $subject, $body, $headers);
        
        if ($result) {
            error_log("Email enviado exitosamente a: $to");
        } else {
            error_log("Error enviando email a: $to");
        }
        
        return $result;
    }
    
    // ========== PLANTILLAS HTML ==========
    
    private static function getTemplateNewTicket($data) {
        $ticket_url = TICKET_VIEW_URL;
        
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #f8f9fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .header p { margin: 10px 0 0 0; opacity: 0.9; }
        .content { background: white; padding: 30px; margin: 20px; border-radius: 8px; }
        .ticket-number { font-size: 32px; font-weight: bold; color: #667eea; text-align: center; margin: 20px 0; padding: 20px; background: #f8f9fa; border-radius: 8px; }
        .info-box { background: #e7f3ff; padding: 20px; border-radius: 6px; border-left: 4px solid #007bff; margin: 20px 0; }
        .info-box strong { color: #0056b3; }
        .message-box { background: #f8f9fa; padding: 20px; border-radius: 6px; margin: 20px 0; }
        .button { display: inline-block; background: #667eea; color: white !important; padding: 15px 40px; text-decoration: none; border-radius: 6px; margin: 20px 0; font-weight: bold; }
        .tip { background: #fff3cd; padding: 15px; border-radius: 6px; border-left: 4px solid #ffc107; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; color: #6c757d; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎫 Ticket Recibido</h1>
            <p>Sistema de Soporte PQR - Konectando</p>
        </div>
        
        <div class="content">
            <p>Hola <strong>{$data['name']}</strong>,</p>
            
            <p>Hemos recibido tu solicitud correctamente. Tu ticket ha sido asignado y nuestro equipo lo revisará lo antes posible.</p>
            
            <div class="ticket-number">
                #{$data['number']}
            </div>
            
            <div class="info-box">
                <strong>📋 Asunto:</strong><br>
                {$data['subject']}
                <br><br>
                <strong>📅 Fecha:</strong> {$data['created']}<br>
                <strong>🏢 Departamento:</strong> {$data['department']}<br>
                <strong>⚡ Prioridad:</strong> {$data['priority']}
            </div>
            
            <p><strong>Tu mensaje:</strong></p>
            <div class="message-box">
                {$data['message']}
            </div>
            
            <p style="text-align: center;">Puedes consultar el estado de tu ticket en cualquier momento:</p>
            
            <div style="text-align: center;">
                <a href="{$ticket_url}" class="button">Ver Estado del Ticket</a>
            </div>
            
            <div class="tip">
                💡 <strong>Consejo:</strong> Guarda tu número de ticket (<strong>#{$data['number']}</strong>) y tu email para futuras consultas.
            </div>
        </div>
        
        <div class="footer">
            <p>Este es un mensaje automático del sistema PQR.</p>
            <p>© 2025 Konectando - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>
HTML;
    }
    
    private static function getTemplateStaffResponse($data) {
        $ticket_url = TICKET_VIEW_URL;
        
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #f8f9fa; }
        .header { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .content { background: white; padding: 30px; margin: 20px; border-radius: 8px; }
        .subject-box { background: #e7f3ff; padding: 15px; border-radius: 6px; margin: 15px 0; }
        .response-box { background: #fff3cd; padding: 20px; border-radius: 6px; border-left: 4px solid #ffc107; margin: 20px 0; }
        .staff-name { color: #856404; font-weight: bold; font-size: 16px; }
        .button { display: inline-block; background: #28a745; color: white !important; padding: 15px 40px; text-decoration: none; border-radius: 6px; margin: 20px 0; font-weight: bold; }
        .footer { text-align: center; padding: 20px; color: #6c757d; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💬 Nueva Respuesta de Soporte</h1>
            <p>Ticket #{$data['number']}</p>
        </div>
        
        <div class="content">
            <p>Hola <strong>{$data['name']}</strong>,</p>
            
            <p>Nuestro equipo de soporte ha respondido a tu ticket:</p>
            
            <div class="subject-box">
                <strong>📋 {$data['subject']}</strong>
            </div>
            
            <div class="response-box">
                <div class="staff-name">👨‍💼 {$data['staff_name']} escribió:</div>
                <div style="margin-top: 15px;">
                    {$data['message']}
                </div>
                <div style="color: #6c757d; font-size: 12px; margin-top: 15px;">
                    📅 {$data['created']}
                </div>
            </div>
            
            <p style="text-align: center;">Puedes ver la conversación completa y responder:</p>
            
            <div style="text-align: center;">
                <a href="{$ticket_url}" class="button">Ver y Responder</a>
            </div>
        </div>
        
        <div class="footer">
            <p>Para responder a tu ticket, usa el enlace de arriba.</p>
            <p>© 2025 Proditel - Sistema PQR</p>
        </div>
    </div>
</body>
</html>
HTML;
    }
    
    private static function getTemplateClientResponse($data) {
        $ticket_url = ADMIN_VIEW_URL . '?id=' . $data['ticket_id'];
        
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; background: #f8f9fa; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .content { background: white; padding: 30px; margin: 20px; border-radius: 8px; }
        .client-info { background: #e7f3ff; padding: 15px; border-radius: 6px; margin: 15px 0; }
        .message-box { background: #f8f9fa; padding: 20px; border-radius: 6px; border-left: 4px solid #667eea; margin: 20px 0; }
        .button { display: inline-block; background: #667eea; color: white !important; padding: 15px 40px; text-decoration: none; border-radius: 6px; margin: 20px 0; font-weight: bold; }
        .footer { text-align: center; padding: 20px; color: #6c757d; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📨 Nuevo Mensaje del Cliente</h1>
            <p>Ticket #{$data['number']}</p>
        </div>
        
        <div class="content">
            <p>El cliente <strong>{$data['name']}</strong> ha respondido al ticket:</p>
            
            <div class="client-info">
                <strong>👤 Cliente:</strong> {$data['name']}<br>
                <strong>📧 Email:</strong> {$data['email']}<br>
                <strong>📋 Asunto:</strong> {$data['subject']}
            </div>
            
            <div class="message-box">
                <strong>Mensaje del cliente:</strong>
                <div style="margin-top: 10px;">
                    {$data['message']}
                </div>
                <div style="color: #6c757d; font-size: 12px; margin-top: 15px;">
                    📅 {$data['created']}
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="{$ticket_url}" class="button">Ver Ticket y Responder</a>
            </div>
        </div>
        
        <div class="footer">
            <p>Sistema de Notificaciones PQR - Proditel</p>
            <p>© 2025 Proditel</p>
        </div>
    </div>
</body>
</html>
HTML;
    }
}
?>
