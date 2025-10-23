<?php
/**
 * Configuración de Email - Sistema PQR
 * VERSIÓN PARA PRODUCCIÓN
 * 
 * ⚠️ IMPORTANTE ANTES DE SUBIR A PRODUCCIÓN:
 * 1. Verifica el email konectandointernetrural@gmail.com en SendGrid
 * 2. Cambia SYSTEM_URL por la URL real de tu hosting
 * 3. Renombra este archivo a "email-config.php" en producción
 */

// ========== CONFIGURACIÓN GENERAL ==========
define('EMAIL_ENABLED', true);  // ✅ HABILITADO
define('EMAIL_METHOD', 'sendgrid');  // sendgrid es el método recomendado

// ========== CONFIGURACIÓN SENDGRID ==========
// ⚠️ REEMPLAZAR CON TU API KEY REAL DE SENDGRID
define('SENDGRID_API_KEY', 'TU_API_KEY_SENDGRID_AQUI');

// ========== INFORMACIÓN DEL REMITENTE ==========
// ⚠️ IMPORTANTE: Debes verificar este email en SendGrid antes de enviar
// https://app.sendgrid.com/settings/sender_auth/senders
define('FROM_EMAIL', 'konectandointernetrural@gmail.com');
define('FROM_NAME', 'Konectando Internet Rural - Soporte PQR');

// ========== URLs DEL SISTEMA ==========
// 🔴 CAMBIAR ESTAS URLs POR LAS DE TU HOSTING EN PRODUCCIÓN
define('SYSTEM_URL', 'https://tudominio.co.cloud/pqr/upload');  // ⚠️ CAMBIAR
define('TICKET_VIEW_URL', SYSTEM_URL . '/consultar-ticket.php');
define('ADMIN_VIEW_URL', SYSTEM_URL . '/ver-ticket.php');

// ========== EMAIL DEL ADMINISTRADOR ==========
define('ADMIN_EMAIL', 'konectandointernetrural@gmail.com');

/**
 * PASOS PARA CONFIGURAR EN PRODUCCIÓN:
 * 
 * 1. VERIFICAR EMAIL EN SENDGRID:
 *    - Ve a: https://app.sendgrid.com/settings/sender_auth/senders
 *    - Clic en "Create New Sender"
 *    - Agrega: konectandointernetrural@gmail.com
 *    - SendGrid enviará un email de verificación a esa cuenta
 *    - Abre el email y haz clic en "Verify Sender"
 * 
 * 2. CAMBIAR LA URL DEL SISTEMA:
 *    - Encuentra la línea: define('SYSTEM_URL', ...
 *    - Cámbiala por tu URL real, por ejemplo:
 *      define('SYSTEM_URL', 'https://konectando.co.cloud/pqr/upload');
 * 
 * 3. SUBIR ARCHIVOS:
 *    - Renombra este archivo a "email-config.php"
 *    - Súbelo a: /pqr/upload/includes/
 *    - Asegúrate de que los permisos sean correctos (644)
 * 
 * 4. PROBAR:
 *    - Crea un ticket de prueba desde tu web en producción
 *    - Verifica que llegue el email a konectandointernetrural@gmail.com
 */
?>
