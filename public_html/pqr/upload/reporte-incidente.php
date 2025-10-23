<?php
// Proteger pÃ¡gina - Solo administradores
session_start();
if (!isset($_SESSION['staff_logged']) || $_SESSION['staff_logged'] !== true) {
    header('Location: login-simple.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Incidentes de Seguridad - ColCERT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f5f7fa; min-height: 100vh; }
        .top-bar { background: #2c3e50; color: white; padding: 15px 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .top-bar h1 { font-size: 20px; display: inline-block; }
        .top-bar .nav { float: right; margin-top: 5px; }
        .top-bar .nav a { color: white; text-decoration: none; margin-left: 20px; padding: 8px 15px; border-radius: 4px; transition: background 0.3s; background: rgba(255,255,255,0.1); }
        .top-bar .nav a:hover { background: rgba(255,255,255,0.2); }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background: #c0392b; color: white; padding: 30px; text-align: center; }
        .header h1 { font-size: 28px; margin-bottom: 10px; }
        .header p { color: #ecf0f1; }
        .alert-box { background: #fff3cd; border-left: 4px solid #ff9800; padding: 20px; margin: 20px; border-radius: 6px; }
        .alert-box strong { color: #856404; }
        .form-container { padding: 40px; }
        .section-title { background: #34495e; color: white; padding: 12px 20px; margin: 30px -40px 20px -40px; font-size: 16px; font-weight: 600; }
        .section-title:first-child { margin-top: 0; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600; font-size: 14px; }
        .form-group label .required { color: #e74c3c; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px; border: 2px solid #ecf0f1; border-radius: 6px; font-size: 14px; font-family: inherit; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #c0392b; }
        .form-group textarea { min-height: 120px; resize: vertical; }
        .form-group small { display: block; margin-top: 5px; color: #7f8c8d; font-size: 12px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 768px) { .form-row { grid-template-columns: 1fr; } }
        .btn-submit { background: #c0392b; color: white; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; cursor: pointer; width: 100%; transition: background 0.3s; }
        .btn-submit:hover { background: #a93226; }
        .success-message { background: #d4edda; color: #155724; padding: 20px; border-radius: 6px; margin: 20px; border-left: 4px solid #28a745; }
        .error-message { background: #f8d7da; color: #721c24; padding: 20px; border-radius: 6px; margin: 20px; border-left: 4px solid #dc3545; }
        .info-box { background: #d1ecf1; border: 1px solid #bee5eb; padding: 20px; border-radius: 6px; margin: 20px; }
        .pgp-box { background: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; border-radius: 6px; margin: 10px 0; }
        .pgp-box code { background: #e9ecef; padding: 3px 8px; border-radius: 3px; font-family: monospace; }
        .back-link { text-align: center; margin: 20px; padding: 20px; }
        .back-link a { color: #c0392b; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="top-bar">
        <h1>🚨 Sistema PQR - Reporte ColCERT</h1>
        <div class="nav">
            <a href="panel-admin.php">Volver al Panel</a>
            <a href="logout-simple.php">Cerrar Sesión</a>
        </div>
    </div>
    
    <div class="container">
        <div class="header">
            <h1>🚨 Reporte de Incidentes de Seguridad</h1>
            <p>Sistema de Gestión de Incidentes - ColCERT</p>
        </div>
        
        <?php
        $success = false;
        $error = '';
        $ticket_number = '';
        
        if ($_POST) {
            $conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
            $conn->set_charset("utf8");
            
            // Validar datos obligatorios
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $pais = trim($_POST['pais'] ?? '');
            $zona_horaria = trim($_POST['zona_horaria'] ?? '');
            $tipo_organizacion = $_POST['tipo_organizacion'] ?? '';
            $tipo_sector = trim($_POST['tipo_sector'] ?? '');
            // Información del host objetivo
            $host_objetivo_ip = trim($_POST['host_objetivo_ip'] ?? '');
            $host_objetivo_funcion = trim($_POST['host_objetivo_funcion'] ?? '');
            $host_objetivo_so = trim($_POST['host_objetivo_so'] ?? '');
            $host_objetivo_apps = trim($_POST['host_objetivo_apps'] ?? '');

            // Información del host origen
            $host_origen_ip = trim($_POST['host_origen_ip'] ?? '');
            $host_origen_funcion = trim($_POST['host_origen_funcion'] ?? '');
            $host_origen_so = trim($_POST['host_origen_so'] ?? '');
            $host_origen_apps = trim($_POST['host_origen_apps'] ?? '');

            // Información del incidente
            $fecha_incidente = trim($_POST['fecha_incidente'] ?? '');
            $hora_incidente = trim($_POST['hora_incidente'] ?? '');
            $zona_horaria_incidente = trim($_POST['zona_horaria_incidente'] ?? '');
            $tipo_incidente = trim($_POST['tipo_incidente'] ?? '');
            $taxonomia_clase = trim($_POST['taxonomia_clase'] ?? '');
            $taxonomia_tipo = trim($_POST['taxonomia_tipo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');

            // Información adicional
            $entidad = trim($_POST['entidad'] ?? '');
            $telefono_entidad = trim($_POST['telefono_entidad'] ?? '');
            $movil = trim($_POST['movil'] ?? '');
            
            if (empty($nombre) || empty($email) || empty($descripcion)) {
                $error = 'Por favor completa todos los campos obligatorios marcados con *.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Por favor ingresa un email válido.';
            } else {
                // Buscar o crear usuario
                $email_safe = $conn->real_escape_string($email);
                $user_query = "SELECT ue.user_id, ue.id as email_id FROM ost_user_email ue WHERE ue.address = '$email_safe' LIMIT 1";
                $user_result = $conn->query($user_query);
                
                if ($user_result && $user_result->num_rows > 0) {
                    $user_data = $user_result->fetch_assoc();
                    $user_id = $user_data['user_id'];
                    $email_id = $user_data['email_id'];
                } else {
                    $nombre_safe = $conn->real_escape_string($nombre);
                    $insert_user = "INSERT INTO ost_user (org_id, default_email_id, name, created, updated) VALUES (0, 0, '$nombre_safe', NOW(), NOW())";
                    $conn->query($insert_user);
                    $user_id = $conn->insert_id;
                    
                    $insert_email = "INSERT INTO ost_user_email (user_id, address) VALUES ($user_id, '$email_safe')";
                    $conn->query($insert_email);
                    $email_id = $conn->insert_id;
                    
                    $conn->query("UPDATE ost_user SET default_email_id = $email_id WHERE id = $user_id");
                    
                    $telefono_safe = $conn->real_escape_string($telefono);
                    $insert_cdata = "INSERT INTO ost_user__cdata (user_id, name, phone) VALUES ($user_id, '$nombre_safe', '$telefono_safe')";
                    $conn->query($insert_cdata);
                }

                // Generar número de ticket
                $number_result = $conn->query("SELECT next FROM ost_sequence WHERE name = 'Ticket Sequence'");
                $ticket_num = $number_result->fetch_assoc()['next'];
                $ticket_number = str_pad($ticket_num, 6, '0', STR_PAD_LEFT);
                $new_next = $ticket_num + 1;
                $conn->query("UPDATE ost_sequence SET next = $new_next, updated = NOW() WHERE name = 'Ticket Sequence'");
                
                // Crear asunto del ticket
                $subject = "INCIDENTE DE SEGURIDAD - {$tipo_incidente} - {$taxonomia_clase}";
                
                // Construir mensaje detallado
                $mensaje_detallado = "=== REPORTE DE INCIDENTE DE SEGURIDAD ===\n\n";
                $mensaje_detallado .= "INFORMACIÓN DE CONTACTO:\n";
                $mensaje_detallado .= "Nombre: {$nombre}\n";
                $mensaje_detallado .= "País: {$pais}\n";
                $mensaje_detallado .= "Zona horaria: {$zona_horaria}\n";
                $mensaje_detallado .= "Teléfono: {$telefono}\n";
                $mensaje_detallado .= "Email: {$email}\n";
                if ($entidad) $mensaje_detallado .= "Entidad: {$entidad}\n";
                if ($telefono_entidad) $mensaje_detallado .= "Teléfono Entidad: {$telefono_entidad}\n";
                if ($movil) $mensaje_detallado .= "Móvil: {$movil}\n";
                $mensaje_detallado .= "Tipo de Organización: {$tipo_organizacion}\n";
                $mensaje_detallado .= "Sector: {$tipo_sector}\n\n";
                
                $mensaje_detallado .= "HOST OBJETIVO:\n";
                $mensaje_detallado .= "IP/Hostname: {$host_objetivo_ip}\n";
                $mensaje_detallado .= "Función: {$host_objetivo_funcion}\n";
                $mensaje_detallado .= "Sistema Operativo: {$host_objetivo_so}\n";
                $mensaje_detallado .= "Aplicaciones: {$host_objetivo_apps}\n\n";
                
                if ($host_origen_ip) {
                    $mensaje_detallado .= "HOST ORIGEN:\n";
                    $mensaje_detallado .= "IP/Hostname: {$host_origen_ip}\n";
                    $mensaje_detallado .= "Función: {$host_origen_funcion}\n";
                    $mensaje_detallado .= "Sistema Operativo: {$host_origen_so}\n";
                    $mensaje_detallado .= "Aplicaciones: {$host_origen_apps}\n\n";
                }

                $mensaje_detallado .= "INFORMACIÓN DEL INCIDENTE:\n";
                $mensaje_detallado .= "Fecha: {$fecha_incidente}\n";
                $mensaje_detallado .= "Hora: {$hora_incidente}\n";
                $mensaje_detallado .= "Zona horaria: {$zona_horaria_incidente}\n";
                $mensaje_detallado .= "Tipo: {$tipo_incidente}\n";
                $mensaje_detallado .= "Taxonomía - Clase: {$taxonomia_clase}\n";
                $mensaje_detallado .= "Taxonomía - Tipo: {$taxonomia_tipo}\n\n";
                $mensaje_detallado .= "DESCRIPCIÓN:\n{$descripcion}\n";
                
                // Crear ticket con topic_id = 8 (Incidente de Seguridad)
                $subject_safe = $conn->real_escape_string($subject);
                $insert_ticket = "INSERT INTO ost_ticket (number, user_id, user_email_id, status_id, dept_id, topic_id, sla_id, source, ip_address, created, updated, lastupdate)
                                 VALUES ('$ticket_number', $user_id, $email_id, 1, 1, 8, 1, 'Web', '{$_SERVER['REMOTE_ADDR']}', NOW(), NOW(), NOW())";
                
                if ($conn->query($insert_ticket)) {
                    $ticket_id = $conn->insert_id;
                    
                    // Crear ticket__cdata con prioridad URGENTE (4)
                    $insert_cdata = "INSERT INTO ost_ticket__cdata (ticket_id, subject, priority) VALUES ($ticket_id, '$subject_safe', '4')";
                    $conn->query($insert_cdata);
                    
                    // Crear thread
                    $insert_thread = "INSERT INTO ost_thread (object_id, object_type, lastmessage, created) VALUES ($ticket_id, 'T', NOW(), NOW())";
                    $conn->query($insert_thread);
                    $thread_id = $conn->insert_id;
                    
                    // Crear entrada del thread
                    $mensaje_safe = $conn->real_escape_string($mensaje_detallado);
                    $nombre_safe = $conn->real_escape_string($nombre);
                    $insert_entry = "INSERT INTO ost_thread_entry (thread_id, user_id, type, poster, source, title, body, format, ip_address, created, updated)
                                    VALUES ($thread_id, $user_id, 'M', '$nombre_safe', 'Web', '$subject_safe', '$mensaje_safe', 'text', '{$_SERVER['REMOTE_ADDR']}', NOW(), NOW())";
                    $conn->query($insert_entry);
                    
                    // Enviar notificación por email
                    require_once 'includes/simple-email-notifier.php';
                    
                    SimpleEmailNotifier::notifyNewTicket(
                        $ticket_number,
                        $nombre,
                        $email,
                        $subject,
                        $mensaje_detallado,
                        'Seguridad - Incidentes',
                        'Urgente',
                        date('Y-m-d H:i:s')
                    );
                    
                    // Notificar al equipo de seguridad
                    SimpleEmailNotifier::notifyStaffNewMessage(
                        $ticket_id,
                        $ticket_number,
                        $subject,
                        $nombre,
                        $email,
                        $mensaje_detallado,
                        date('Y-m-d H:i:s')
                    );
                    
                    $success = true;
                } else {
                    $error = 'Error al crear el ticket: ' . $conn->error;
                }
            }
            
            $conn->close();
        }
        ?>
        
        <div class="alert-box">
            <strong>IMPORTANTE:</strong> Este formulario es para reportar incidentes y vulnerabilidades de seguridad.
            Para otros tipos de solicitudes, usa el <a href="crear-ticket-simple.php" style="color: #c0392b; font-weight: bold;">formulario regular</a>.
        </div>
        
        <div class="form-container">
            <?php if ($success): ?>
                <div class="success-message">
                    <strong>✔ ¡Incidente reportado exitosamente!</strong><br><br>
                    Tu número de ticket es: <strong style="font-size: 20px;">#<?php echo $ticket_number; ?></strong><br><br>
                    Se ha enviado una copia a tu correo electrónico y se ha notificado al equipo de seguridad.<br>
                    Recibirás respuesta lo antes posible según la prioridad del incidente.
                </div>
                
                <div class="info-box">
                    <strong>🔍 Información de Contacto Adicional:</strong><br><br>
                    Para incidentes críticos también puedes contactar directamente a:<br>
                    • <strong>ColCERT:</strong> contacto@colcert.gov.co<br>
                    • <strong>Malware:</strong> malware@colcert.gov.co<br>
                    • <strong>Clave PGP/GPG:</strong> 0x8B134C7E
                </div>
                
                <div class="back-link">
                    <a href="reporte-incidente.php">← Reportar otro incidente</a> | 
                    <a href="consultar-ticket.php">Consultar estado →</a>
                </div>
            <?php else: ?>
                <?php if ($error): ?>
                    <div class="error-message">
                        <strong>✖ Error:</strong> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="section-title">🔍 INFORMACIÓN DE CONTACTO</div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nombre(s) y Apellido(s) <span class="required">*</span></label>
                            <input type="text" name="nombre" required value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Correo Electrónico <span class="required">*</span></label>
                            <input type="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>País <span class="required">*</span></label>
                            <input type="text" name="pais" required value="<?php echo htmlspecialchars($_POST['pais'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Zona Horaria <span class="required">*</span></label>
                            <select name="zona_horaria" required>
                                <option value="">Seleccione...</option>
                                <option value="UTC-5 (Colombia)">UTC-5 (Colombia)</option>
                                <option value="UTC-6 (México)">UTC-6 (México)</option>
                                <option value="UTC-3 (Argentina)">UTC-3 (Argentina)</option>
                                <option value="UTC-4 (Venezuela)">UTC-4 (Venezuela)</option>
                                <option value="UTC-5 (Perú)">UTC-5 (Perú)</option>
                                <option value="Otra">Otra</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Número de Teléfono <span class="required">*</span></label>
                            <input type="tel" name="telefono" required value="<?php echo htmlspecialchars($_POST['telefono'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Número de Móvil</label>
                            <input type="tel" name="movil" value="<?php echo htmlspecialchars($_POST['movil'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nombre de la Entidad (si aplica)</label>
                            <input type="text" name="entidad" value="<?php echo htmlspecialchars($_POST['entidad'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Teléfono de la Entidad (si aplica)</label>
                            <input type="tel" name="telefono_entidad" value="<?php echo htmlspecialchars($_POST['telefono_entidad'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tipo de Organización <span class="required">*</span></label>
                            <select name="tipo_organizacion" required>
                                <option value="">Seleccione...</option>
                                <option value="Gobierno">Gobierno</option>
                                <option value="Privada">Privada</option>
                                <option value="Operador de Infraestructura Crítica">Operador de Infraestructura Crítica</option>
                                <option value="Academia">Academia</option>
                                <option value="ONG">ONG</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Tipo de Sector <span class="required">*</span></label>
                            <input type="text" name="tipo_sector" required placeholder="Ej: Financiero, Salud, Telecomunicaciones" value="<?php echo htmlspecialchars($_POST['tipo_sector'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="section-title">🔒 HOST OBJETIVO (Sistema Afectado)</div>
                    
                    <div class="form-group">
                        <label>Nombres de Hosts y Direcciones IPs <span class="required">*</span></label>
                        <textarea name="host_objetivo_ip" required placeholder="Ej: servidor.ejemplo.com - 192.168.1.100"><?php echo htmlspecialchars($_POST['host_objetivo_ip'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Función del Sistema <span class="required">*</span></label>
                            <input type="text" name="host_objetivo_funcion" required placeholder="Ej: Web Server, Mail Server, DB Server" value="<?php echo htmlspecialchars($_POST['host_objetivo_funcion'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Sistema Operativo <span class="required">*</span></label>
                            <input type="text" name="host_objetivo_so" required placeholder="Ej: Windows Server 2019, Ubuntu 20.04" value="<?php echo htmlspecialchars($_POST['host_objetivo_so'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Aplicaciones Involucradas <span class="required">*</span></label>
                        <input type="text" name="host_objetivo_apps" required placeholder="Ej: Apache 2.4, MySQL 8.0, WordPress 5.8" value="<?php echo htmlspecialchars($_POST['host_objetivo_apps'] ?? ''); ?>">
                    </div>
                    
                    <div class="section-title">🔍 HOST ORIGEN (Fuente del Ataque/Incidente)</div>
                    
                    <div class="form-group">
                        <label>Nombres de Hosts y Direcciones IPs</label>
                        <textarea name="host_origen_ip" placeholder="Si se conoce - Ej: atacante.com - 203.0.113.42"><?php echo htmlspecialchars($_POST['host_origen_ip'] ?? ''); ?></textarea>
                        <small>Dejar en blanco si se desconoce</small>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Función del Sistema</label>
                            <input type="text" name="host_origen_funcion" placeholder="Si se conoce" value="<?php echo htmlspecialchars($_POST['host_origen_funcion'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Sistema Operativo</label>
                            <input type="text" name="host_origen_so" placeholder="Si se conoce" value="<?php echo htmlspecialchars($_POST['host_origen_so'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Aplicaciones Involucradas</label>
                        <input type="text" name="host_origen_apps" placeholder="Si se conoce" value="<?php echo htmlspecialchars($_POST['host_origen_apps'] ?? ''); ?>">
                    </div>
                    
                    <div class="section-title">🔒 INFORMACIÓN DEL INCIDENTE</div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Fecha del Incidente <span class="required">*</span></label>
                            <input type="date" name="fecha_incidente" required value="<?php echo htmlspecialchars($_POST['fecha_incidente'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Hora del Incidente <span class="required">*</span></label>
                            <input type="time" name="hora_incidente" required value="<?php echo htmlspecialchars($_POST['hora_incidente'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Zona Horaria del Incidente <span class="required">*</span></label>
                        <select name="zona_horaria_incidente" required>
                            <option value="">Seleccione...</option>
                            <option value="UTC-5 (Colombia)">UTC-5 (Colombia)</option>
                            <option value="UTC-6 (México)">UTC-6 (México)</option>
                            <option value="UTC-3 (Argentina)">UTC-3 (Argentina)</option>
                            <option value="UTC-4 (Venezuela)">UTC-4 (Venezuela)</option>
                            <option value="UTC-5 (Perú)">UTC-5 (Perú)</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tipo de Incidente <span class="required">*</span></label>
                        <select name="tipo_incidente" required>
                            <option value="">Seleccione...</option>
                            <option value="Intrusión">Intrusión</option>
                            <option value="Denegación de Servicio (DoS/DDoS)">Denegación de Servicio (DoS/DDoS)</option>
                            <option value="Malware">Malware</option>
                            <option value="Phishing">Phishing</option>
                            <option value="Defacement">Defacement</option>
                            <option value="Ransomware">Ransomware</option>
                            <option value="Vulnerabilidad">Vulnerabilidad</option>
                            <option value="Fuga de Información">Fuga de Información</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Taxonomía - Clase <span class="required">*</span></label>
                            <select name="taxonomia_clase" required>
                                <option value="">Seleccione...</option>
                                <option value="Abusive Content">Abusive Content</option>
                                <option value="Malicious Code">Malicious Code</option>
                                <option value="Information Gathering">Information Gathering</option>
                                <option value="Intrusion Attempts">Intrusion Attempts</option>
                                <option value="Intrusions">Intrusions</option>
                                <option value="Availability">Availability</option>
                                <option value="Information Content Security">Information Content Security</option>
                                <option value="Fraud">Fraud</option>
                                <option value="Vulnerable">Vulnerable</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Taxonomía - Tipo <span class="required">*</span></label>
                            <input type="text" name="taxonomia_tipo" required placeholder="Ej: SQL Injection, XSS, Brute Force" value="<?php echo htmlspecialchars($_POST['taxonomia_tipo'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>DescripciÃ³n Detallada del Incidente <span class="required">*</span></label>
                        <textarea name="descripcion" required placeholder="Describe detalladamente el incidente: qué ocurrió, cómo se detectó, impacto, evidencias, etc." style="min-height: 200px;"><?php echo htmlspecialchars($_POST['descripcion'] ?? ''); ?></textarea>
                        <small>Incluye toda la información técnica relevante: logs, hashes, URLs, IPs, etc.</small>
                    </div>
                    
                    <div class="pgp-box">
                        <strong>🔒 Información Sensible:</strong><br>
                        Si necesitas enviar logs, archivos o información sensible adicional, usa nuestra clave PGP/GPG:<br>
                        <code>0x8B134C7E</code> - <a href="https://colcert.gov.co/pgp" target="_blank">Descargar clave pública</a>
                    </div>
                    
                    <button type="submit" class="btn-submit">🔒 Reportar Incidente de Seguridad</button>
                </form>
            <?php endif; ?>
        </div>
        
        <?php if (!$success): ?>
        <div class="info-box" style="margin: 20px;">
            <strong>🔒 Contacto Alternativo ColCERT:</strong><br><br>
            <strong>Para reportar directamente:</strong><br>
            • Incidentes/Vulnerabilidades: <a href="mailto:contacto@colcert.gov.co">contacto@colcert.gov.co</a> (PGP: 0x8B134C7E)<br>
            • Muestras de Malware: <a href="mailto:malware@colcert.gov.co">malware@colcert.gov.co</a> (PGP: 0xEE3184F1)
        </div>
        <?php endif; ?>
    </div>
</body>
</html>

