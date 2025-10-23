<?php
// Sistema de gestiÃ³n de tickets - Ver detalles de un ticket
session_start();
if (!isset($_SESSION['staff_logged']) || $_SESSION['staff_logged'] !== true) {
    header('Location: login-simple.php');
    exit;
}

$conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
$conn->set_charset("utf8");

$ticket_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$ticket_id) {
    header('Location: panel-admin.php');
    exit;
}

// Obtener datos del ticket
$query = "SELECT t.*, 
          cd.subject,
          ts.name as status_name, ts.state,
          u.name as user_name,
          COALESCE(ue.address, 
                   (SELECT address FROM ost_user_email WHERE user_id = t.user_id LIMIT 1)
          ) as user_email,
          d.name as dept_name
          FROM ost_ticket t
          LEFT JOIN ost_ticket__cdata cd ON t.ticket_id = cd.ticket_id
          LEFT JOIN ost_ticket_status ts ON t.status_id = ts.id
          LEFT JOIN ost_user u ON t.user_id = u.id
          LEFT JOIN ost_user_email ue ON t.user_email_id = ue.id
          LEFT JOIN ost_department d ON t.dept_id = d.id
          WHERE t.ticket_id = $ticket_id";

$ticket = $conn->query($query)->fetch_assoc();

if (!$ticket) {
    die("Ticket no encontrado");
}

// Obtener mensajes del thread
$thread_query = "SELECT th.id as thread_id FROM ost_thread th 
                 WHERE th.object_id = $ticket_id AND th.object_type = 'T'";
$thread_result = $conn->query($thread_query);
$thread = $thread_result->fetch_assoc();

$messages = [];
if ($thread) {
    $msg_query = "SELECT te.*, s.firstname, s.lastname 
                  FROM ost_thread_entry te
                  LEFT JOIN ost_staff s ON te.staff_id = s.staff_id
                  WHERE te.thread_id = {$thread['thread_id']}
                  ORDER BY te.created ASC";
    $msg_result = $conn->query($msg_query);
    while ($row = $msg_result->fetch_assoc()) {
        $messages[] = $row;
    }
}

// Procesar nueva respuesta
if ($_POST && isset($_POST['response'])) {
    $response = $conn->real_escape_string($_POST['response']);
    $staff_id = $_SESSION['staff_id'];
    
    if ($thread) {
        $insert = "INSERT INTO ost_thread_entry (thread_id, staff_id, type, poster, source, body, format, ip_address, created, updated)
                   VALUES ({$thread['thread_id']}, $staff_id, 'R', 'Staff', 'Web', '$response', 'html', '{$_SERVER['REMOTE_ADDR']}', NOW(), NOW())";
        
        if ($conn->query($insert)) {
            // Actualizar fecha de última actualización del ticket
            $conn->query("UPDATE ost_ticket SET updated = NOW(), isanswered = 1 WHERE ticket_id = $ticket_id");

            // Enviar notificación al cliente
            require_once 'includes/simple-email-notifier.php';
            
            $staff_query = "SELECT firstname, lastname FROM ost_staff WHERE staff_id = $staff_id";
            $staff_result = $conn->query($staff_query);
            $staff_data = $staff_result->fetch_assoc();
            $staff_name = trim($staff_data['firstname'] . ' ' . $staff_data['lastname']);
            
            SimpleEmailNotifier::notifyClientNewResponse(
                $ticket['number'],
                $ticket['subject'] ?? '(Sin asunto)',
                $ticket['user_name'],
                $ticket['user_email'],
                $staff_name,
                $response,
                date('Y-m-d H:i:s')
            );
            
            $success_msg = "Respuesta agregada correctamente";
            header("Location: ver-ticket.php?id=$ticket_id&success=1");
            exit;
        }
    }
}

// Obtener estados disponibles
$status_query = "SELECT id, name FROM ost_ticket_status ORDER BY name";
$status_result = $conn->query($status_query);

// Procesar cambio de estado
if ($_POST && isset($_POST['change_status'])) {
    $new_status = intval($_POST['status_id']);
    $conn->query("UPDATE ost_ticket SET status_id = $new_status, updated = NOW() WHERE ticket_id = $ticket_id");
    header("Location: ver-ticket.php?id=$ticket_id&status_changed=1");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ticket #<?php echo $ticket['number']; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f5f7fa; }
        .header { background: #2c3e50; color: white; padding: 15px 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header h1 { font-size: 24px; display: inline-block; }
        .header .nav { float: right; margin-top: 5px; }
        .header .nav a { color: white; text-decoration: none; margin-left: 20px; padding: 8px 15px; border-radius: 4px; transition: background 0.3s; }
        .header .nav a:hover { background: rgba(255,255,255,0.1); }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .ticket-header { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .ticket-number { font-size: 28px; color: #2c3e50; margin-bottom: 10px; }
        .ticket-subject { font-size: 20px; color: #555; margin-bottom: 15px; }
        .ticket-meta { display: flex; gap: 30px; flex-wrap: wrap; }
        .meta-item { display: flex; flex-direction: column; }
        .meta-label { font-size: 12px; color: #888; text-transform: uppercase; margin-bottom: 5px; }
        .meta-value { font-size: 14px; color: #333; font-weight: 500; }
        .status-open { color: #27ae60; font-weight: bold; }
        .status-closed { color: #95a5a6; }
        .messages { background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .message { padding: 20px; border-bottom: 1px solid #ecf0f1; }
        .message:last-child { border-bottom: none; }
        .message-header { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .message-author { font-weight: bold; color: #2c3e50; }
        .message-date { color: #888; font-size: 13px; }
        .message-body { color: #555; line-height: 1.6; white-space: pre-wrap; }
        .response-form { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .response-form h3 { margin-bottom: 15px; color: #2c3e50; }
        .response-form textarea { width: 100%; min-height: 150px; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-family: inherit; font-size: 14px; resize: vertical; }
        .response-form button { background: #3498db; color: white; border: none; padding: 12px 30px; border-radius: 4px; font-size: 14px; cursor: pointer; margin-top: 10px; transition: background 0.3s; }
        .response-form button:hover { background: #2980b9; }
        .actions { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .actions h3 { margin-bottom: 15px; color: #2c3e50; }
        .actions select { padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; margin-right: 10px; }
        .actions button { background: #27ae60; color: white; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; transition: background 0.3s; }
        .actions button:hover { background: #229954; }
        .success-msg { background: #d4edda; color: #155724; padding: 12px 20px; border-radius: 4px; margin-bottom: 20px; }
        .staff-response { background: #e8f4f8; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔒 Sistema de Tickets</h1>
        <div class="nav">
            <a href="panel-admin.php">🔙 Volver al Panel</a>
            <a href="panel-admin.php">Todos los Tickets</a>
            <a href="logout-simple.php">Cerrar Sesión</a>
        </div>
    </div>

    <div class="container">
        <?php if (isset($_GET['success'])): ?>
            <div class="success-msg">✅ Respuesta agregada correctamente</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['status_changed'])): ?>
            <div class="success-msg">✅ Estado del ticket actualizado</div>
        <?php endif; ?>

        <div class="ticket-header">
            <div class="ticket-number">Ticket #<?php echo htmlspecialchars($ticket['number']); ?></div>
            <div class="ticket-subject"><?php echo htmlspecialchars($ticket['subject'] ?: '(Sin asunto)'); ?></div>
            <div class="ticket-meta">
                <div class="meta-item">
                    <span class="meta-label">Estado</span>
                    <span class="meta-value <?php echo $ticket['state'] == 'open' ? 'status-open' : 'status-closed'; ?>">
                        <?php echo htmlspecialchars($ticket['status_name']); ?>
                    </span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Usuario</span>
                    <span class="meta-value"><?php echo htmlspecialchars($ticket['user_name']); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Email</span>
                    <span class="meta-value"><?php echo htmlspecialchars($ticket['user_email']); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Departamento</span>
                    <span class="meta-value"><?php echo htmlspecialchars($ticket['dept_name']); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Creado</span>
                    <span class="meta-value"><?php echo date('d/m/Y H:i', strtotime($ticket['created'])); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Última actualización</span>
                    <span class="meta-value"><?php echo date('d/m/Y H:i', strtotime($ticket['updated'])); ?></span>
                </div>
            </div>
        </div>

        <div class="messages">
            <h3 style="padding: 20px; border-bottom: 2px solid #3498db; color: #2c3e50;">🔒 Conversación</h3>
            <?php if (count($messages) > 0): ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="message <?php echo $msg['staff_id'] > 0 ? 'staff-response' : ''; ?>">
                        <div class="message-header">
                            <span class="message-author">
                                <?php 
                                if ($msg['staff_id'] > 0) {
                                    echo "🔒 " . htmlspecialchars($msg['firstname'] . ' ' . $msg['lastname']) . " (Staff)";
                                } else {
                                    echo "🔹 " . htmlspecialchars($msg['poster']);
                                }
                                ?>
                            </span>
                            <span class="message-date"><?php echo date('d/m/Y H:i', strtotime($msg['created'])); ?></span>
                        </div>
                        <div class="message-body"><?php echo nl2br(htmlspecialchars($msg['body'])); ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="message">
                    <p style="color: #888;">No hay mensajes en este ticket.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($ticket['state'] == 'open'): ?>
            <div class="response-form">
                <h3>✅ Agregar Respuesta</h3>
                <form method="POST">
                    <textarea name="response" placeholder="Escribe tu respuesta aquí..." required></textarea>
                    <button type="submit">Enviar Respuesta</button>
                </form>
            </div>
        <?php endif; ?>

        <div class="actions">
            <h3>🔧 Acciones</h3>
            <form method="POST" style="display: inline;">
                <select name="status_id" required>
                    <option value="">Cambiar estado...</option>
                    <?php while ($status = $status_result->fetch_assoc()): ?>
                        <option value="<?php echo $status['id']; ?>" <?php echo ($status['id'] == $ticket['status_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($status['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="change_status">Actualizar Estado</button>
            </form>
            
            <?php if ($ticket['topic_id'] == 8): // Si es un ticket de seguridad ?>
                <div style="margin-top: 20px; padding: 15px; background: #fff3cd; border-left: 4px solid #c0392b; border-radius: 4px;">
                    <strong style="color: #856404;">🔒 Ticket de Seguridad</strong><br>
                    <p style="margin: 10px 0; color: #856404; font-size: 14px;">
                        Si este ticket requiere escalamiento a ColCERT, usa el formulario técnico para completar la información requerida.
                    </p>
                    <a href="reporte-incidente.php" target="_blank" style="display: inline-block; background: #c0392b; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 10px; font-size: 14px;">
                        🔒 Formulario Técnico ColCERT →
                    </a>
                    <p style="margin-top: 10px; color: #7f8c8d; font-size: 12px;">
                        <strong>Información del ticket:</strong><br>
                        Usuario: <?php echo htmlspecialchars($ticket['user_name']); ?> (<?php echo htmlspecialchars($ticket['user_email']); ?>)<br>
                        Número de ticket: #<?php echo $ticket['number']; ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>

