<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('includes/db-config.php');
    require_once('includes/simple-email-notifier.php');
    
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $tipo_problema = $_POST['tipo_problema'] ?? '';
    $que_paso = $_POST['que_paso'] ?? '';
    $cuando_paso = $_POST['cuando_paso'] ?? '';
    $donde_paso = $_POST['donde_paso'] ?? '';
    $informacion_adicional = $_POST['informacion_adicional'] ?? '';
    
    $subject = "⚠️ SEGURIDAD: " . $tipo_problema;
    
    $detalle_completo = "=== REPORTE DE SEGURIDAD - FORMULARIO SIMPLE ===\n\n";
    $detalle_completo .= "TIPO DE PROBLEMA: " . $tipo_problema . "\n\n";
    $detalle_completo .= "¿QUÉ PASÓ?\n" . $que_paso . "\n\n";
    $detalle_completo .= "¿CUÁNDO PASÓ?\n" . ($cuando_paso ?: 'No especificado') . "\n\n";
    $detalle_completo .= "¿DÓNDE PASÓ?\n" . ($donde_paso ?: 'No especificado') . "\n\n";
    if ($informacion_adicional) {
        $detalle_completo .= "INFORMACIÓN ADICIONAL:\n" . $informacion_adicional . "\n\n";
    }
    $detalle_completo .= "=== DATOS DE CONTACTO ===\n";
    $detalle_completo .= "Nombre: " . $nombre . "\n";
    $detalle_completo .= "Email: " . $email . "\n";
    $detalle_completo .= "Teléfono: " . ($telefono ?: 'No proporcionado') . "\n";
    
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            throw new Exception("Error de conexión: " . $conn->connect_error);
        }
        
        // Obtener siguiente número de ticket
        $seq_sql = "UPDATE ost_sequence SET next = LAST_INSERT_ID(next + 1) WHERE name = 'Ticket Sequence'";
        $conn->query($seq_sql);
        $ticket_id_result = $conn->query("SELECT LAST_INSERT_ID() as ticket_id");
        $ticket_row = $ticket_id_result->fetch_assoc();
        $ticket_number = $ticket_row['ticket_id'];
        
        // Crear ticket con prioridad ALTA (3) y tema "Incidente de Seguridad" (8)
        $ticket_sql = "INSERT INTO ost_ticket (number, user_id, ticket_pid, dept_id, topic_id, priority_id, staff_id, team_id, 
                       sla_id, status, source, isanswered, isoverdue, isescalated, created, updated, duedate) 
                       VALUES (?, 0, 0, 1, 8, 3, 0, 0, 0, 'open', 'Web', 0, 0, 0, NOW(), NOW(), NULL)";
        
        $stmt = $conn->prepare($ticket_sql);
        $stmt->bind_param('i', $ticket_number);
        $stmt->execute();
        $ticket_db_id = $conn->insert_id;
        
        // Crear thread (conversación)
        $thread_sql = "INSERT INTO ost_ticket_thread (ticket_id, staff_id, user_id, thread_type, poster, source, 
                       title, body, format, created, updated) 
                       VALUES (?, 0, 0, 'M', ?, 'Web', ?, ?, 'text', NOW(), NOW())";
        
        $stmt = $conn->prepare($thread_sql);
        $stmt->bind_param('isss', $ticket_db_id, $nombre, $subject, $detalle_completo);
        $stmt->execute();
        
        // Insertar información de contacto
        $user_sql = "INSERT INTO ost_user (org_id, name, created, updated) VALUES (0, ?, NOW(), NOW())";
        $stmt = $conn->prepare($user_sql);
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
        $user_id = $conn->insert_id;
        
        $email_sql = "INSERT INTO ost_user_email (user_id, address) VALUES (?, ?)";
        $stmt = $conn->prepare($email_sql);
        $stmt->bind_param('is', $user_id, $email);
        $stmt->execute();
        
        // Actualizar user_id en ticket
        $update_user = "UPDATE ost_ticket SET user_id = ? WHERE ticket_id = ?";
        $stmt = $conn->prepare($update_user);
        $stmt->bind_param('ii', $user_id, $ticket_db_id);
        $stmt->execute();
        
        $conn->close();
        
        // Enviar notificación por email
        SimpleEmailNotifier::notifyNewTicket($ticket_number, $nombre, $email, $subject, $detalle_completo);
        
        header("Location: msg.php?msg=ticket_creado&numero=" . $ticket_number);
        exit;
        
    } catch (Exception $e) {
        die("Error al crear el ticket: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚠️ Reportar Problema de Seguridad - Konectando Internet Rural</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden; }
        .header { background: #e74c3c; color: white; padding: 30px; text-align: center; }
        .header h1 { font-size: 28px; margin-bottom: 10px; }
        .header p { font-size: 16px; opacity: 0.9; }
        .content { padding: 30px; }
        .info-box { background: #fff3cd; border-left: 4px solid #ffc107; padding: 20px; border-radius: 6px; margin-bottom: 25px; }
        .info-box h3 { color: #856404; margin-bottom: 12px; font-size: 18px; }
        .info-box ul { margin-left: 20px; margin-top: 10px; }
        .info-box li { margin-bottom: 8px; color: #666; }
        .info-box p { color: #856404; margin-top: 10px; font-style: italic; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        .required { color: #e74c3c; }
        input[type="text"], input[type="email"], input[type="tel"], select, textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 15px; font-family: 'Segoe UI', Arial, sans-serif; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        select { cursor: pointer; }
        textarea { resize: vertical; min-height: 100px; }
        .tip-box { background: #e7f3ff; border-left: 4px solid #2196f3; padding: 15px; border-radius: 6px; margin-top: 10px; }
        .tip-box strong { color: #1565c0; display: block; margin-bottom: 8px; }
        .tip-box ul { margin-left: 20px; margin-top: 8px; }
        .tip-box li { margin-bottom: 6px; color: #555; font-size: 14px; }
        .small-text { display: block; margin-top: 5px; font-size: 13px; color: #666; }
        .btn-submit { background: #667eea; color: white; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; cursor: pointer; width: 100%; transition: background 0.3s; }
        .btn-submit:hover { background: #5568d3; }
        .footer { background: #f8f9fa; padding: 20px 30px; text-align: center; border-top: 1px solid #e9ecef; }
        .footer p { color: #666; margin-bottom: 8px; }
        .footer strong { color: #333; }
        .back-link { display: inline-block; margin-top: 20px; color: #667eea; text-decoration: none; font-weight: 600; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚠️ Reportar Problema de Seguridad</h1>
            <p>Si detectaste algo sospechoso, repórtalo aquí</p>
        </div>

        <div class="content">
            <div class="info-box">
                <h3>⚠️ ¿Cuándo usar este formulario?</h3>
                <p><strong>Repórtanos si notaste algo como:</strong></p>
                <ul>
                    <li>Recibiste un email sospechoso pidiendo tu contraseña</li>
                    <li>Una página web parece falsa o te pide información extraña</li>
                    <li>Tu computadora se comporta de forma rara</li>
                    <li>Alguien intentó acceder a tu cuenta sin permiso</li>
                    <li>Detectaste un virus o archivo malicioso</li>
                    <li>Cualquier cosa que te parezca insegura</li>
                </ul>
                <p>No te preocupes por los detalles técnicos, solo cuéntanos qué viste.</p>
            </div>

            <form method="POST" action="">
                <!-- Nombre -->
                <div class="form-group">
                    <label for="nombre">Tu Nombre <span class="required">*</span></label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Tu Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>

                <!-- Teléfono (opcional) -->
                <div class="form-group">
                    <label for="telefono">Tu Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Opcional">
                </div>

                <!-- Tipo de problema -->
                <div class="form-group">
                    <label for="tipo_problema">¿Qué tipo de problema detectaste? <span class="required">*</span></label>
                    <select id="tipo_problema" name="tipo_problema" required>
                        <option value="">Selecciona...</option>
                        <option value="Email sospechoso o phishing">Email sospechoso o phishing</option>
                        <option value="Página web falsa o sospechosa">Página web falsa o sospechosa</option>
                        <option value="Virus o archivo malicioso">Virus o archivo malicioso</option>
                        <option value="Intento de acceso a mi cuenta">Intento de acceso a mi cuenta</option>
                        <option value="Computadora con comportamiento extraño">Computadora con comportamiento extraño</option>
                        <option value="Otro problema de seguridad">Otro problema de seguridad</option>
                    </select>
                </div>

                <!-- Qué pasó -->
                <div class="form-group">
                    <label for="que_paso">Cuéntanos qué pasó <span class="required">*</span></label>
                    <textarea id="que_paso" name="que_paso" rows="5" required placeholder="Describe con tus propias palabras qué sucedió. No te preocupes por los términos técnicos, solo cuéntanos lo que viste o notaste.&#10;&#10;Ejemplo: &quot;Recibí un email que dice ser del banco pidiendo mi contraseña. El email tiene errores de ortografía y el enlace se ve raro.&quot;"></textarea>
                    
                    <div class="tip-box">
                        <strong>💡 Información útil que puedes incluir:</strong>
                        <ul>
                            <li>Si tienes un email sospechoso: ¿de quién viene? ¿qué dice?</li>
                            <li>Si es una página web: ¿cuál es la dirección (URL)?</li>
                            <li>Si fue un archivo: ¿cómo se llama? ¿de dónde lo descargaste?</li>
                            <li>¿Le diste clic a algo? ¿Descargaste o instalaste algo?</li>
                            <li>¿Compartiste alguna información (contraseñas, datos personales)?</li>
                        </ul>
                    </div>
                </div>

                <!-- Cuándo pasó -->
                <div class="form-group">
                    <label for="cuando_paso">¿Cuándo pasó?</label>
                    <input type="text" id="cuando_paso" name="cuando_paso" placeholder="Ejemplo: Hoy en la mañana, ayer, hace 2 días...">
                    <span class="small-text">No necesitas la hora exacta, solo una idea aproximada</span>
                </div>

                <!-- Dónde pasó -->
                <div class="form-group">
                    <label for="donde_paso">¿Dónde pasó?</label>
                    <input type="text" id="donde_paso" name="donde_paso" placeholder="Ejemplo: En mi email de Gmail, en Facebook, en mi computadora del trabajo, en mi celular...">
                    <span class="small-text">Ayuda a entender el contexto</span>
                </div>

                <!-- Información adicional -->
                <div class="form-group">
                    <label for="informacion_adicional">Información Adicional</label>
                    <textarea id="informacion_adicional" name="informacion_adicional" rows="4" placeholder="Si tienes capturas de pantalla, enlaces, o cualquier otra cosa que creas importante, descríbelo aquí..."></textarea>
                    <span class="small-text">Cualquier detalle adicional que quieras compartir</span>
                </div>

                <button type="submit" class="btn-submit">🚨 Enviar Reporte de Seguridad</button>
            </form>
        </div>

        <div class="footer">
            <p><strong>🔒 Tu información está segura</strong></p>
            <p>Todo lo que compartas será tratado de forma confidencial y solo será usado para investigar y solucionar el problema.</p>
            <a href="portal-pqr.php" class="back-link">← Volver al inicio</a>
        </div>
    </div>
</body>
</html>
