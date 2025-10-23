<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Ticket - Sistema PQR</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden; }
        .header { background: #2c3e50; color: white; padding: 30px; text-align: center; }
        .header h1 { font-size: 28px; margin-bottom: 10px; }
        .header p { color: #bdc3c7; }
        .form-container { padding: 40px; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600; font-size: 14px; }
        .form-group label .required { color: #e74c3c; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 12px; border: 2px solid #ecf0f1; border-radius: 6px; font-size: 14px; font-family: inherit; transition: border 0.3s; }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus { outline: none; border-color: #667eea; }
        .form-group textarea { min-height: 150px; resize: vertical; }
        .form-group small { display: block; margin-top: 5px; color: #7f8c8d; font-size: 12px; }
        .btn-submit { background: #667eea; color: white; border: none; padding: 15px 40px; font-size: 16px; font-weight: 600; border-radius: 6px; cursor: pointer; width: 100%; transition: background 0.3s; }
        .btn-submit:hover { background: #5568d3; }
        .success-message { background: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #28a745; }
        .error-message { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #dc3545; }
        .info-box { background: #e7f3ff; border: 1px solid #b3d9ff; padding: 15px; border-radius: 6px; margin-bottom: 20px; }
        .info-box strong { color: #0056b3; }
        .back-link { text-align: center; margin-top: 20px; padding: 20px; }
        .back-link a { color: #667eea; text-decoration: none; font-weight: 500; }
        .back-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Crear Nuevo Ticket</h1>
            <p>Sistema de Soporte PQR</p>
        </div>
        
        <div class="form-container">
            <?php
            $success = false;
            $error = '';
            $ticket_number = '';
            
            if ($_POST) {
                $conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
                $conn->set_charset("utf8");
                
                // Validar datos
                $name = trim($_POST['name'] ?? '');
                $email = trim($_POST['email'] ?? '');
                $phone = trim($_POST['phone'] ?? '');
                $subject = trim($_POST['subject'] ?? '');
                $message = trim($_POST['message'] ?? '');
                $topic_id = intval($_POST['topic_id'] ?? 2);
                $priority = intval($_POST['priority'] ?? 2);
                
                if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                    $error = 'Por favor completa todos los campos obligatorios.';
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
                        // Crear nuevo usuario
                        $name_safe = $conn->real_escape_string($name);
                        $insert_user = "INSERT INTO ost_user (org_id, default_email_id, name, created, updated) VALUES (0, 0, '$name_safe', NOW(), NOW())";
                        $conn->query($insert_user);
                        $user_id = $conn->insert_id;
                        
                        // Crear email del usuario
                        $insert_email = "INSERT INTO ost_user_email (user_id, address) VALUES ($user_id, '$email_safe')";
                        $conn->query($insert_email);
                        $email_id = $conn->insert_id();
                        
                        // Actualizar default_email_id
                        $conn->query("UPDATE ost_user SET default_email_id = $email_id WHERE id = $user_id");
                        
                        // Crear user__cdata
                        $phone_safe = $conn->real_escape_string($phone);
                        $insert_cdata = "INSERT INTO ost_user__cdata (user_id, name, phone) VALUES ($user_id, '$name_safe', '$phone_safe')";
                        $conn->query($insert_cdata);
                    }

                    // Generar número de ticket (método corregido)
                    // Primero obtener el número actual
                    $number_result = $conn->query("SELECT next FROM ost_sequence WHERE name = 'Ticket Sequence'");
                    $ticket_num = $number_result->fetch_assoc()['next'];
                    $ticket_number = str_pad($ticket_num, 6, '0', STR_PAD_LEFT);
                    
                    // Luego incrementar para el siguiente
                    $new_next = $ticket_num + 1;
                    $conn->query("UPDATE ost_sequence SET next = $new_next, updated = NOW() WHERE name = 'Ticket Sequence'");
                    
                    // Crear ticket
                    $insert_ticket = "INSERT INTO ost_ticket (number, user_id, user_email_id, status_id, dept_id, topic_id, sla_id, source, ip_address, created, updated, lastupdate)
                                     VALUES ('$ticket_number', $user_id, $email_id, 1, 1, $topic_id, 1, 'Web', '{$_SERVER['REMOTE_ADDR']}', NOW(), NOW(), NOW())";
                    
                    if ($conn->query($insert_ticket)) {
                        $ticket_id = $conn->insert_id;
                        
                        // Crear ticket__cdata
                        $subject_safe = $conn->real_escape_string($subject);
                        $insert_cdata = "INSERT INTO ost_ticket__cdata (ticket_id, subject, priority) VALUES ($ticket_id, '$subject_safe', '$priority')";
                        $conn->query($insert_cdata);
                        
                        // Crear thread
                        $insert_thread = "INSERT INTO ost_thread (object_id, object_type, lastmessage, created) VALUES ($ticket_id, 'T', NOW(), NOW())";
                        $conn->query($insert_thread);
                        $thread_id = $conn->insert_id;
                        
                        // Crear entrada del thread
                        $message_safe = $conn->real_escape_string($message);
                        $name_safe = $conn->real_escape_string($name);
                        $subject_safe = $conn->real_escape_string($subject);
                        $insert_entry = "INSERT INTO ost_thread_entry (thread_id, user_id, type, poster, source, title, body, format, ip_address, created, updated)
                                        VALUES ($thread_id, $user_id, 'M', '$name_safe', 'Web', '$subject_safe', '$message_safe', 'html', '{$_SERVER['REMOTE_ADDR']}', NOW(), NOW())";
                        $conn->query($insert_entry);
                        
                        // Crear form_entry
                        $insert_form_entry = "INSERT INTO ost_form_entry (object_id, object_type, form_id, created, updated) VALUES ($ticket_id, 'T', 2, NOW(), NOW())";
                        $conn->query($insert_form_entry);
                        $form_entry_id = $conn->insert_id;
                        
                        // Insertar valores del formulario
                        $conn->query("INSERT INTO ost_form_entry_values (entry_id, field_id, value) VALUES ($form_entry_id, 4, '$subject_safe')");
                        $conn->query("INSERT INTO ost_form_entry_values (entry_id, field_id, value) VALUES ($form_entry_id, 5, '$message_safe')");
                        $conn->query("INSERT INTO ost_form_entry_values (entry_id, field_id, value) VALUES ($form_entry_id, 6, '$priority')");
                        
                        // Enviar notificaciÃ³n por email
                        require_once 'includes/simple-email-notifier.php';
                        
                        $priority_names = ['1' => 'Baja', '2' => 'Normal', '3' => 'Alta', '4' => 'Urgente'];
                        $topic_names = ['1' => 'Consulta General', '2' => 'Problema TÃ©cnico', '3' => 'PeticiÃ³n', '4' => 'Queja', '5' => 'Reclamo', '6' => 'Sugerencia', '7' => 'FacturaciÃ³n'];
                        
                        SimpleEmailNotifier::notifyNewTicket(
                            $ticket_number,
                            $name,
                            $email,
                            $subject,
                            $message,
                            $topic_names[$topic_id] ?? 'Soporte',
                            $priority_names[$priority] ?? 'Normal',
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
            
            <?php if ($success): ?>
                <div class="success-message">
                    <strong>✔  Ticket creado exitosamente!</strong><br>
                    Tu número de ticket es: <strong>#<?php echo $ticket_number; ?></strong><br>
                    Guarda este número para consultar el estado de tu ticket.
                </div>
                <div class="info-box">
                    <strong>¿Qué sigue?</strong><br>
                    • Recibirás una respuesta lo antes posible<br>
                    • Puedes consultar el estado usando tu número de ticket y email<br>
                    • Nuestro equipo de soporte revisará tu caso
                </div>
                <div class="back-link">
                    <a href="crear-ticket-simple.php">← Crear otro ticket</a> | 
                    <a href="consultar-ticket.php">Consultar mi ticket →</a>
                </div>
            <?php else: ?>
                <?php if ($error): ?>
                    <div class="error-message">
                        <strong>✖ Error:</strong> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label>Nombre Completo <span class="required">*</span></label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                        <small>Usa este email para consultar el estado de tu ticket</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="tel" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Tipo de Solicitud <span class="required">*</span></label>
                        <select name="topic_id" required>
                            <option value="1">Consulta General</option>
                            <option value="2" selected>Problema Técnico</option>
                            <option value="3">Petición</option>
                            <option value="4">Queja</option>
                            <option value="5">Reclamo</option>
                            <option value="6">Sugerencia</option>
                            <option value="7">Facturación</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Prioridad</label>
                        <select name="priority">
                            <option value="1">Baja</option>
                            <option value="2" selected>Normal</option>
                            <option value="3">Alta</option>
                            <option value="4">Urgente</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Asunto <span class="required">*</span></label>
                        <input type="text" name="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" placeholder="Describe brevemente tu solicitud" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Mensaje <span class="required">*</span></label>
                        <textarea name="message" placeholder="Describe detalladamente tu solicitud o problema" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">Crear Ticket</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

