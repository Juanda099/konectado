<?php
/**
 * SendGridEmailSender - Implementación ligera usando la API v3 de SendGrid
 * Este archivo guarda logs en sendgrid_test.log para diagnóstico.
 */

require_once __DIR__ . '/email-config.php';

class SendGridEmailSender {
    public static function sendWithTemplate($to, $subject, $htmlBody) {
        if (!defined('SENDGRID_API_KEY') || empty(SENDGRID_API_KEY) || SENDGRID_API_KEY === 'TU_API_KEY_SENDGRID_AQUI') {
            error_log("SendGrid: API key no configurada");
            return false;
        }

        $payload = [
            'personalizations' => [[
                'to' => [[ 'email' => $to ]]
            ]],
            'from' => [ 'email' => FROM_EMAIL, 'name' => FROM_NAME ],
            'subject' => $subject,
            'content' => [[ 'type' => 'text/html', 'value' => $htmlBody ]]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . SENDGRID_API_KEY,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $resp = curl_exec($ch);
        $errno = curl_errno($ch);
        $err = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $logLine = date('Y-m-d H:i:s') . " | to={$to} | http={$http_code} | errno={$errno} | err=" . str_replace("\n", ' ', $err) . " | resp=" . substr($resp ?? '',0,1000) . "\n";
    // Guardar log en ruta absoluta
    $logPath = __DIR__ . '/sendgrid_test.log';
    file_put_contents($logPath, $logLine, FILE_APPEND | LOCK_EX);

        // Éxito si el HTTP code es 202 (SendGrid acepta el mail)
        if ($http_code === 202) {
            return true;
        }

        // Registrar error más detallado
        error_log("SendGrid send failed: http={$http_code} errno={$errno} err={$err} resp=" . substr($resp ?? '',0,1000));
        return false;
    }
}

?>
