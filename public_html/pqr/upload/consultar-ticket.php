<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consultar Estado de Ticket - Sistema PQR</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden; }
        .header { background: #2c3e50; color: white; padding: 30px; text-align: center; }
        .header h1 { font-size: 28px; margin-bottom: 10px; }
        .header p { color: #bdc3c7; }
        .content { padding: 40px; }
        .search-form { background: #f8f9fa; padding: 30px; border-radius: 8px; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600; }
        .form-group input { width: 100%; padding: 12px; border: 2px solid #ecf0f1; border-radius: 6px; font-size: 14px; }
        .form-group input:focus { outline: none; border-color: #667eea; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .btn-search { background: #667eea; color: white; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; cursor: pointer; width: 100%; transition: background 0.3s; }
        .btn-search:hover { background: #5568d3; }
        .error-message { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #dc3545; }
        .ticket-card { border: 2px solid #e9ecef; border-radius: 8px; padding: 25px; margin-bottom: 20px; }
        .ticket-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #e9ecef; }
        .ticket-number { font-size: 24px; font-weight: bold; color: #2c3e50; }
        .status-badge { padding: 8px 16px; border-radius: 20px; font-weight: 600; font-size: 13px; text-transform: uppercase; }
        .status-open { background: #28a745; color: white; }
        .status-closed { background: #6c757d; color: white; }
        .status-resolved { background: #17a2b8; color: white; }
        .ticket-info { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 20px; }
        .info-item { padding: 10px; background: #f8f9fa; border-radius: 6px; }
        .info-item strong { display: block; color: #6c757d; font-size: 12px; margin-bottom: 5px; }
        .info-item span { color: #2c3e50; font-size: 14px; }
        .subject-box { background: #e7f3ff; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #007bff; }
        .subject-box strong { color: #0056b3; display: block; margin-bottom: 5px; }
        .message-thread { margin-top: 25px; }
        .thread-title { font-size: 18px; font-weight: 600; color: #2c3e50; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #e9ecef; }
        .message { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px; border-left: 4px solid #667eea; }
        .message-staff { background: #fff3cd; border-left-color: #ffc107; }
        .message-header { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .message-author { font-weight: 600; color: #2c3e50; }
        .message-date { color: #6c757d; font-size: 13px; }
        .message-body { color: #495057; line-height: 1.6; }
        .reply-form { background: #f8f9fa; padding: 25px; border-radius: 8px; margin-top: 25px; }
        .reply-form h3 { color: #2c3e50; margin-bottom: 15px; }
        .reply-form textarea { width: 100%; min-height: 120px; padding: 12px; border: 2px solid #ecf0f1; border-radius: 6px; font-family: inherit; resize: vertical; }
        .reply-form textarea:focus { outline: none; border-color: #667eea; }
        .btn-reply { background: #28a745; color: white; border: none; padding: 12px 30px; font-size: 14px; font-weight: 600; border-radius: 6px; cursor: pointer; margin-top: 10px; }
        .btn-reply:hover { background: #218838; }
        .back-link { text-align: center; margin-top: 30px; }
        .back-link a { color: #667eea; text-decoration: none; font-weight: 500; }
        .back-link a:hover { text-decoration: underline; }
        .success-message { background: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Consultar Estado de Ticket</h1>
            <p>Ingresa tu número de ticket y email para ver el estado</p>
        </div>
        
        <div class="content">
            <?php
            $ticket = null;
            $error = '';
            $reply_success = false;
            
            // Procesar respuesta del cliente
            if (isset($_POST['reply_message']) && isset($_POST['ticket_id'])) {
                $conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
                $conn->set_charset("utf8");
                
                $ticket_id = intval($_POST['ticket_id']);
                $message = trim($_POST['reply_message']);
                
                if (!empty($message)) {
                    // Obtener información del ticket
                    $ticket_query = "SELECT t.*, u.name, ue.address as email 
                                    FROM ost_ticket t 
                                    JOIN ost_user u ON t.user_id = u.id 
                                    JOIN ost_user_email ue ON t.user_email_id = ue.id 
                                    WHERE t.ticket_id = $ticket_id";
                    $ticket_result = $conn->query($ticket_query);
                    
                    if ($ticket_result && $ticket_result->num_rows > 0) {
                        $ticket_data = $ticket_result->fetch_assoc();
                        
                        // Obtener thread_id
                        $thread_query = "SELECT id FROM ost_thread WHERE object_id = $ticket_id AND object_type = 'T' LIMIT 1";
                        $thread_result = $conn->query($thread_query);
                        $thread_id = $thread_result->fetch_assoc()['id'];
                        
                        // Insertar respuesta del cliente
                        $message_safe = $conn->real_escape_string($message);
                        $name_safe = $conn->real_escape_string($ticket_data['name']);
                        $email_safe = $conn->real_escape_string($ticket_data['email']);
                        
                        $insert_entry = "INSERT INTO ost_thread_entry (thread_id, user_id, type, poster, source, title, body, format, ip_address, created, updated)
                                        VALUES ($thread_id, {$ticket_data['user_id']}, 'M', '$name_safe', 'Web', 'RE: Ticket #{$ticket_data['number']}', '$message_safe', 'html', '{$_SERVER['REMOTE_ADDR']}', NOW(), NOW())";
                        
                        if ($conn->query($insert_entry)) {
                            // Reabrir ticket si está cerrado
                            $conn->query("UPDATE ost_ticket SET status_id = 1, updated = NOW(), lastupdate = NOW() WHERE ticket_id = $ticket_id AND status_id = 3");
                            $conn->query("UPDATE ost_thread SET lastmessage = NOW() WHERE id = $thread_id");

                            // Enviar notificación al soporte
                            require_once 'includes/simple-email-notifier.php';
                            
                            $cd_query = "SELECT subject FROM ost_ticket__cdata WHERE ticket_id = $ticket_id";
                            $cd_result = $conn->query($cd_query);
                            $ticket_subject = $cd_result->fetch_assoc()['subject'] ?? '(Sin asunto)';
                            
                            SimpleEmailNotifier::notifyStaffNewMessage(
                                $ticket_id,
                                $ticket_data['number'],
                                $ticket_subject,
                                $ticket_data['name'],
                                $ticket_data['email'],
                                $message,
                                date('Y-m-d H:i:s')
                            );
                            
                            $reply_success = true;
                        }
                    }
                }
                
                $conn->close();
            }
            
            // Buscar ticket
            if (isset($_POST['ticket_number']) || isset($_POST['ticket_id'])) {
                $conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
                $conn->set_charset("utf8");
                
                if (isset($_POST['ticket_number'])) {
                    $number = trim($_POST['ticket_number']);
                    $email = trim($_POST['email']);
                    
                    // Limpiar el número (remover # si existe)
                    $number = str_replace('#', '', $number);
                    
                    if (empty($number) || empty($email)) {
                        $error = 'Por favor ingresa el número de ticket y tu email.';
                    } else {
                        $number_safe = $conn->real_escape_string($number);
                        $email_safe = $conn->real_escape_string($email);
                        
                        $query = "SELECT t.*, 
                                        cd.subject, cd.priority,
                                        u.name as user_name,
                                        ue.address as user_email,
                                        d.name as dept_name,
                                        tp.topic as topic_name,
                                        CASE t.status_id
                                            WHEN 1 THEN 'Abierto'
                                            WHEN 2 THEN 'Resuelto'
                                            WHEN 3 THEN 'Cerrado'
                                            ELSE 'Desconocido'
                                        END as status_name,
                                        CASE cd.priority
                                            WHEN '1' THEN 'Baja'
                                            WHEN '2' THEN 'Normal'
                                            WHEN '3' THEN 'Alta'
                                            WHEN '4' THEN 'Urgente'
                                            ELSE 'Normal'
                                        END as priority_name
                                FROM ost_ticket t
                                LEFT JOIN ost_ticket__cdata cd ON t.ticket_id = cd.ticket_id
                                LEFT JOIN ost_user u ON t.user_id = u.id
                                LEFT JOIN ost_user_email ue ON t.user_email_id = ue.id
                                LEFT JOIN ost_department d ON t.dept_id = d.id
                                LEFT JOIN ost_help_topic tp ON t.topic_id = tp.topic_id
                                WHERE t.number = '$number_safe' AND ue.address = '$email_safe'
                                LIMIT 1";
                        
                        $result = $conn->query($query);
                        
                        if ($result && $result->num_rows > 0) {
                            $ticket = $result->fetch_assoc();
                        } else {
                            $error = 'No se encontró el ticket. Verifica el número y que el email sea correcto.';
                        }
                    }
                } else {
                    // Recargar ticket después de responder
                    $ticket_id = intval($_POST['ticket_id']);
                    $query = "SELECT t.*, 
                                    cd.subject, cd.priority,
                                    u.name as user_name,
                                    ue.address as user_email,
                                    d.name as dept_name,
                                    tp.topic as topic_name,
                                    CASE t.status_id
                                        WHEN 1 THEN 'Abierto'
                                        WHEN 2 THEN 'Resuelto'
                                        WHEN 3 THEN 'Cerrado'
                                        ELSE 'Desconocido'
                                    END as status_name,
                                    CASE cd.priority
                                        WHEN '1' THEN 'Baja'
                                        WHEN '2' THEN 'Normal'
                                        WHEN '3' THEN 'Alta'
                                        WHEN '4' THEN 'Urgente'
                                        ELSE 'Normal'
                                    END as priority_name
                            FROM ost_ticket t
                            LEFT JOIN ost_ticket__cdata cd ON t.ticket_id = cd.ticket_id
                            LEFT JOIN ost_user u ON t.user_id = u.id
                            LEFT JOIN ost_user_email ue ON t.user_email_id = ue.id
                            LEFT JOIN ost_department d ON t.dept_id = d.id
                            LEFT JOIN ost_help_topic tp ON t.topic_id = tp.topic_id
                            WHERE t.ticket_id = $ticket_id
                            LIMIT 1";
                    
                    $result = $conn->query($query);
                    if ($result && $result->num_rows > 0) {
                        $ticket = $result->fetch_assoc();
                    }
                }
                
                $conn->close();
            }
            ?>
            
            <?php if ($reply_success): ?>
                <div class="success-message">
                    <strong>Tu respuesta ha sido enviada exitosamente</strong><br>
                    Nuestro equipo de soporte la revisará y te responderá pronto.
                </div>
            <?php endif; ?>
            
            <?php if (!$ticket): ?>
                <div class="search-form">
                    <?php if ($error): ?>
                        <div class="error-message">
                            <strong>œ— Error:</strong> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="form-row">
                            <div class="form-group">
                                <label>número de Ticket</label>
                                <input type="text" name="ticket_number" placeholder="Ej: 100009 o #100009" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Tu Email</label>
                                <input type="email" name="email" placeholder="email@ejemplo.com" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-search">Buscar Ticket</button>
                    </form>
                </div>
                
                <div class="back-link">
                    <a href="crear-ticket-simple.php">Crear nuevo ticket</a>
                </div>
            <?php else: ?>
                <!-- Mostrar detalles del ticket -->
                <div class="ticket-card">
                    <div class="ticket-header">
                        <div class="ticket-number">Ticket #<?php echo $ticket['number']; ?></div>
                        <div class="status-badge status-<?php echo strtolower($ticket['status_name']); ?>">
                            <?php echo $ticket['status_name']; ?>
                        </div>
                    </div>
                    
                    <div class="subject-box">
                        <strong>Asunto:</strong>
                        <?php echo htmlspecialchars($ticket['subject'] ?: '(Sin asunto)'); ?>
                    </div>
                    
                    <div class="ticket-info">
                        <div class="info-item">
                            <strong>SOLICITANTE</strong>
                            <span><?php echo htmlspecialchars($ticket['user_name']); ?></span>
                        </div>
                        <div class="info-item">
                            <strong>EMAIL</strong>
                            <span><?php echo htmlspecialchars($ticket['user_email']); ?></span>
                        </div>
                        <div class="info-item">
                            <strong>DEPARTAMENTO</strong>
                            <span><?php echo htmlspecialchars($ticket['dept_name']); ?></span>
                        </div>
                        <div class="info-item">
                            <strong>CATEGORÍA</strong>
                            <span><?php echo htmlspecialchars($ticket['topic_name']); ?></span>
                        </div>
                        <div class="info-item">
                            <strong>PRIORIDAD</strong>
                            <span><?php echo $ticket['priority_name']; ?></span>
                        </div>
                        <div class="info-item">
                            <strong>FECHA DE CREACIÓN</strong>
                            <span><?php echo date('d/m/Y H:i', strtotime($ticket['created'])); ?></span>
                        </div>
                    </div>
                    
                    <?php
                    // Obtener mensajes del thread
                    $conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
                    $conn->set_charset("utf8");
                    
                    $thread_query = "SELECT te.*, 
                                           CASE WHEN te.staff_id > 0 THEN 1 ELSE 0 END as is_staff,
                                           COALESCE(s.firstname, te.poster) as author_name
                                    FROM ost_thread_entry te
                                    LEFT JOIN ost_thread t ON te.thread_id = t.id
                                    LEFT JOIN ost_staff s ON te.staff_id = s.staff_id
                                    WHERE t.object_id = {$ticket['ticket_id']} AND t.object_type = 'T'
                                    ORDER BY te.created ASC";
                    
                    $messages = $conn->query($thread_query);
                    ?>
                    
                    <div class="message-thread">
                        <div class="thread-title">💬 Conversación</div>
                        
                        <?php if ($messages && $messages->num_rows > 0): ?>
                            <?php while ($msg = $messages->fetch_assoc()): ?>
                                <div class="message <?php echo $msg['is_staff'] ? 'message-staff' : ''; ?>">
                                    <div class="message-header">
                                        <span class="message-author">
                                            <?php echo $msg['is_staff'] ? 'ðŸ‘¨€ðŸ’¼ ' : 'ðŸ‘¤ '; ?>
                                            <?php echo htmlspecialchars($msg['author_name']); ?>
                                            <?php echo $msg['is_staff'] ? ' (Soporte)' : ''; ?>
                                        </span>
                                        <span class="message-date">
                                            <?php echo date('d/m/Y H:i', strtotime($msg['created'])); ?>
                                        </span>
                                    </div>
                                    <div class="message-body">
                                        <?php echo nl2br(htmlspecialchars($msg['body'])); ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p style="text-align: center; color: #6c757d;">No hay mensajes en este ticket.</p>
                        <?php endif; ?>
                    </div>

                    <?php if ($ticket['status_id'] != 3): // Si no está cerrado ?>
                        <div class="reply-form">
                            <h3>💬 Agregar Respuesta</h3>
                            <form method="POST" action="">
                                <input type="hidden" name="ticket_id" value="<?php echo $ticket['ticket_id']; ?>">
                                <textarea name="reply_message" placeholder="Escribe tu mensaje aquí..." required></textarea>
                                <button type="submit" class="btn-reply">Enviar Respuesta</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div style="background: #fff3cd; padding: 15px; border-radius: 6px; text-align: center; margin-top: 20px;">
                            💬 Este ticket está cerrado. Si necesitas más ayuda, crea un nuevo ticket.
                        </div>
                    <?php endif; ?>
                    
                    <?php $conn->close(); ?>
                </div>
                
                <div class="back-link">
                    <a href="consultar-ticket.php">🔍 Buscar otro ticket</a> | 
                    <a href="crear-ticket-simple.php">Crear nuevo ticket ➕</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

