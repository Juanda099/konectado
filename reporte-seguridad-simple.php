<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reportar Problema de Seguridad - Sistema PQR</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden; }
        .header { background: #c0392b; color: white; padding: 30px; text-align: center; }
        .header h1 { font-size: 28px; margin-bottom: 10px; }
        .header p { color: #ecf0f1; }
        .alert-box { background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; margin: 20px; border-radius: 6px; }
        .alert-box strong { color: #856404; }
        .alert-box ul { margin: 15px 0 15px 20px; }
        .alert-box li { margin: 8px 0; color: #856404; }
        .form-container { padding: 40px; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600; font-size: 14px; }
        .form-group label .required { color: #e74c3c; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px; border: 2px solid #ecf0f1; border-radius: 6px; font-size: 14px; font-family: inherit; transition: border 0.3s; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #e74c3c; }
        .form-group textarea { min-height: 150px; resize: vertical; }
        .form-group small { display: block; margin-top: 5px; color: #7f8c8d; font-size: 12px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media (max-width: 768px) { .form-row { grid-template-columns: 1fr; } }
        .btn-submit { background: #c0392b; color: white; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; cursor: pointer; width: 100%; transition: background 0.3s; }
        .btn-submit:hover { background: #a93226; }
        .success-message { background: #d4edda; color: #155724; padding: 20px; border-radius: 6px; margin: 20px; border-left: 4px solid #28a745; }
        .error-message { background: #f8d7da; color: #721c24; padding: 20px; border-radius: 6px; margin: 20px; border-left: 4px solid #dc3545; }
        .info-box { background: #d1ecf1; border: 1px solid #bee5eb; padding: 20px; border-radius: 6px; margin: 20px; }
        .back-link { text-align: center; margin: 20px; padding: 20px; }
        .back-link a { color: #c0392b; text-decoration: none; font-weight: 500; }
        .examples { background: #f8f9fa; padding: 15px; border-radius: 6px; margin: 10px 0; }
        .examples strong { display: block; margin-bottom: 10px; color: #2c3e50; }
        .examples ul { margin-left: 20px; }
        .examples li { margin: 5px 0; color: #495057; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>âš ï¸ Reportar Problema de Seguridad</h1>
            <p>Si detectaste algo sospechoso, repÃ³rtalo aquÃ­</p>
        </div>
        
        <?php
        $success = false;
        $error = '';
        $ticket_number = '';
        
        if ($_POST) {
            $conn = new mysqli('localhost', 'root', 'admin123', 'pqr');
            $conn->set_charset("utf8");
            
            // Validar datos
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');
            $tipo_problema = $_POST['tipo_problema'] ?? '';
            $que_paso = trim($_POST['que_paso'] ?? '');
            $cuando_paso = trim($_POST['cuando_paso'] ?? '');
            $donde_paso = trim($_POST['donde_paso'] ?? '');
            $informacion_adicional = trim($_POST['informacion_adicional'] ?? '');
            
            if (empty($nombre) || empty($email) || empty($tipo_problema) || empty($que_paso)) {
                $error = 'Por favor completa todos los campos obligatorios marcados con *.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Por favor ingresa un email vÃ¡lido.';
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
                
                // Generar nÃºmero de ticket
                $number_result = $conn->query("SELECT next FROM ost_sequence WHERE name = 'Ticket Sequence'");
                $ticket_num = $number_result->fetch_assoc()['next'];
                $ticket_number = str_pad($ticket_num, 6, '0', STR_PAD_LEFT);
                $new_next = $ticket_num + 1;
                $conn->query("UPDATE ost_sequence SET next = $new_next, updated = NOW() WHERE name = 'Ticket Sequence'");
                
                // Crear asunto
                $subject = "SEGURIDAD: {$tipo_problema}";
                
                // Construir mensaje
                $mensaje = "=== REPORTE DE PROBLEMA DE SEGURIDAD (Usuario) ===\n\n";
                $mensaje .= "TIPO DE PROBLEMA: {$tipo_problema}\n\n";
                $mensaje .= "Â¿QUÃ‰ PASÃ“?\n{$que_paso}\n\n";
                if ($cuando_paso) $mensaje .= "Â¿CUÃNDO PASÃ“?\n{$cuando_paso}\n\n";
                if ($donde_paso) $mensaje .= "Â¿DÃ“NDE PASÃ“?\n{$donde_paso}\n\n";
                if ($informacion_adicional) $mensaje .= "INFORMACIÃ“N ADICIONAL:\n{$informacion_adicional}\n\n";
                $mensaje .= "--- DATOS DE CONTACTO ---\n";
                $mensaje .= "Nombre: {$nombre}\n";
                $mensaje .= "Email: {$email}\n";
                $mensaje .= "TelÃ©fono: {$telefono}\n\n";
                $mensaje .= "âš ï¸ NOTA PARA EL ADMINISTRADOR:\n";
                $mensaje .= "Este es un reporte simplificado de un usuario.\n";
                $mensaje .= "Si requiere escalamiento a ColCERT, usa el formulario tÃ©cnico para completar la informaciÃ³n requerida.\n";
                
                // Crear ticket con topic_id = 8 (Incidente de Seguridad) y prioridad ALTA (3)
                $subject_safe = $conn->real_escape_string($subject);
                $insert_ticket = "INSERT INTO ost_ticket (number, user_id, user_email_id, status_id, dept_id, topic_id, sla_id, source, ip_address, created, updated, lastupdate)
                                 VALUES ('$ticket_number', $user_id, $email_id, 1, 1, 8, 1, 'Web', '{$_SERVER['REMOTE_ADDR']}', NOW(), NOW(), NOW())";
                
                if ($conn->query($insert_ticket)) {
                    $ticket_id = $conn->insert_id;
                    
                    // Crear ticket__cdata con prioridad ALTA (3)
                    $insert_cdata = "INSERT INTO ost_ticket__cdata (ticket_id, subject, priority) VALUES ($ticket_id, '$subject_safe', '3')";
                    $conn->query($insert_cdata);
                    
                    // Crear thread
                    $insert_thread = "INSERT INTO ost_thread (object_id, object_type, lastmessage, created) VALUES ($ticket_id, 'T', NOW(), NOW())";
                    $conn->query($insert_thread);
                    $thread_id = $conn->insert_id;
                    
                    // Crear entrada del thread
                    $mensaje_safe = $conn->real_escape_string($mensaje);
                    $nombre_safe = $conn->real_escape_string($nombre);
                    $insert_entry = "INSERT INTO ost_thread_entry (thread_id, user_id, type, poster, source, title, body, format, ip_address, created, updated)
                                    VALUES ($thread_id, $user_id, 'M', '$nombre_safe', 'Web', '$subject_safe', '$mensaje_safe', 'text', '{$_SERVER['REMOTE_ADDR']}', NOW(), NOW())";
                    $conn->query($insert_entry);
                    
                    // Enviar notificaciones
                    require_once 'includes/simple-email-notifier.php';
                    
                    SimpleEmailNotifier::notifyNewTicket(
                        $ticket_number,
                        $nombre,
                        $email,
                        $subject,
                        $mensaje,
                        'Seguridad',
                        'Alta',
                        date('Y-m-d H:i:s')
                    );
                    
                    // Notificar al equipo de seguridad
                    SimpleEmailNotifier::notifyStaffNewMessage(
                        $ticket_id,
                        $ticket_number,
                        $subject,
                        $nombre,
                        $email,
                        $mensaje,
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
            <strong>âš ï¸ Â¿CuÃ¡ndo usar este formulario?</strong><br><br>
            RepÃ³rtanos si notaste algo como:
            <ul>
                <li>Recibiste un email sospechoso pidiendo tu contraseÃ±a</li>
                <li>Una pÃ¡gina web parece falsa o te pide informaciÃ³n extraÃ±a</li>
                <li>Tu computadora se comporta de forma rara</li>
                <li>Alguien intentÃ³ acceder a tu cuenta sin permiso</li>
                <li>Detectaste un virus o archivo malicioso</li>
                <li>Cualquier cosa que te parezca insegura</li>
            </ul>
            <strong>No te preocupes por los detalles tÃ©cnicos, solo cuÃ©ntanos quÃ© viste.</strong>
        </div>
        
        <div class="form-container">
            <?php if ($success): ?>
                <div class="success-message">
                    <strong>âœ“ Â¡Reporte recibido!</strong><br><br>
                    Tu nÃºmero de ticket es: <strong style="font-size: 20px;">#<?php echo $ticket_number; ?></strong><br><br>
                    Hemos notificado a nuestro equipo de seguridad.<br>
                    Te contactaremos pronto. Gracias por ayudarnos a mantener la seguridad.
                </div>
                
                <div class="info-box">
                    <strong>ðŸ“§ Â¿QuÃ© sigue?</strong><br><br>
                    â€¢ Nuestro equipo revisarÃ¡ tu reporte<br>
                    â€¢ Te contactaremos si necesitamos mÃ¡s informaciÃ³n<br>
                    â€¢ RecibirÃ¡s actualizaciones por email<br>
                    â€¢ Puedes consultar el estado con tu nÃºmero de ticket
                </div>
                
                <div class="back-link">
                    <a href="reporte-seguridad-simple.php">â† Reportar otro problema</a> | 
                    <a href="consultar-ticket.php">Consultar estado â†’</a>
                </div>
            <?php else: ?>
                <?php if ($error): ?>
                    <div class="error-message">
                        <strong>âœ— Error:</strong> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tu Nombre <span class="required">*</span></label>
                            <input type="text" name="nombre" required value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Tu Email <span class="required">*</span></label>
                            <input type="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Tu TelÃ©fono</label>
                        <input type="tel" name="telefono" placeholder="Opcional" value="<?php echo htmlspecialchars($_POST['telefono'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Â¿QuÃ© tipo de problema detectaste? <span class="required">*</span></label>
                        <select name="tipo_problema" required>
                            <option value="">Selecciona...</option>
                            <option value="Email sospechoso (Phishing)">ðŸ“§ Email sospechoso (Phishing)</option>
                            <option value="PÃ¡gina web falsa">ðŸŒ PÃ¡gina web falsa</option>
                            <option value="Virus o archivo malicioso">ðŸ¦  Virus o archivo malicioso</option>
                            <option value="Intento de hackeo">ðŸ”“ Alguien intentÃ³ entrar a mi cuenta</option>
                            <option value="Computadora infectada">ðŸ’» Mi computadora actÃºa raro</option>
                            <option value="Mensaje sospechoso (SMS/WhatsApp)">ðŸ’¬ Mensaje sospechoso (SMS/WhatsApp)</option>
                            <option value="Llamada sospechosa">ðŸ“ž Llamada sospechosa</option>
                            <option value="Robo de informaciÃ³n">ðŸ”’ Creo que robaron mi informaciÃ³n</option>
                            <option value="Otro problema de seguridad">âš ï¸ Otro problema de seguridad</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>CuÃ©ntanos quÃ© pasÃ³ <span class="required">*</span></label>
                        <textarea name="que_paso" required placeholder="Describe con tus propias palabras quÃ© sucediÃ³. No te preocupes por los tÃ©rminos tÃ©cnicos, solo cuÃ©ntanos lo que viste o notaste."><?php echo htmlspecialchars($_POST['que_paso'] ?? ''); ?></textarea>
                        <small>Ejemplo: "RecibÃ­ un email que dice ser del banco pidiendo mi contraseÃ±a. El email tiene errores de ortografÃ­a y el enlace se ve raro."</small>
                    </div>
                    
                    <div class="examples">
                        <strong>ðŸ’¡ InformaciÃ³n Ãºtil que puedes incluir:</strong>
                        <ul>
                            <li>Si tienes un email sospechoso: Â¿de quiÃ©n viene? Â¿quÃ© dice?</li>
                            <li>Si es una pÃ¡gina web: Â¿cuÃ¡l es la direcciÃ³n (URL)?</li>
                            <li>Si fue un archivo: Â¿cÃ³mo se llama? Â¿de dÃ³nde lo descargaste?</li>
                            <li>Â¿Le diste clic a algo? Â¿Descargaste o instalaste algo?</li>
                            <li>Â¿Compartiste alguna informaciÃ³n (contraseÃ±as, datos personales)?</li>
                        </ul>
                    </div>
                    
                    <div class="form-group">
                        <label>Â¿CuÃ¡ndo pasÃ³?</label>
                        <input type="text" name="cuando_paso" placeholder="Ejemplo: Hoy en la maÃ±ana, ayer, hace 2 dÃ­as..." value="<?php echo htmlspecialchars($_POST['cuando_paso'] ?? ''); ?>">
                        <small>No necesitas la hora exacta, solo una idea aproximada</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Â¿DÃ³nde pasÃ³?</label>
                        <textarea name="donde_paso" placeholder="Ejemplo: En mi email de Gmail, en Facebook, en mi computadora del trabajo, en mi celular..."><?php echo htmlspecialchars($_POST['donde_paso'] ?? ''); ?></textarea>
                        <small>Ayuda a entender el contexto</small>
                    </div>
                    
                    <div class="form-group">
                        <label>InformaciÃ³n Adicional</label>
                        <textarea name="informacion_adicional" placeholder="Si tienes capturas de pantalla, enlaces, o cualquier otra cosa que creas importante, descrÃ­belo aquÃ­..."><?php echo htmlspecialchars($_POST['informacion_adicional'] ?? ''); ?></textarea>
                        <small>Cualquier detalle adicional que quieras compartir</small>
                    </div>
                    
                    <button type="submit" class="btn-submit">ðŸš¨ Enviar Reporte de Seguridad</button>
                </form>
                
                <div class="info-box" style="margin-top: 30px;">
                    <strong>ðŸ” Tu informaciÃ³n estÃ¡ segura</strong><br>
                    Todo lo que compartas serÃ¡ tratado de forma confidencial y solo serÃ¡ usado para investigar y solucionar el problema.
                </div>
            <?php endif; ?>
        </div>
        
        <div class="back-link">
            <a href="portal-pqr.php">â† Volver al inicio</a>
        </div>
    </div>
</body>
</html>


