<?php
// Vista simple de tickets sin restricciones de osTicket
session_start();
if (!isset($_SESSION['staff_logged']) || $_SESSION['staff_logged'] !== true) {
    header('Location: login-simple.php');
    exit;
}

$conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
$conn->set_charset("utf8");

echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Lista de Tickets</title>";
echo "<style>
body{font-family:Arial;margin:20px;background:#f5f5f5;}
.header{background:#2c3e50;color:white;padding:15px 30px;margin:-20px -20px 30px -20px;display:flex;justify-content:space-between;align-items:center;}
.header h1{font-size:24px;margin:0;}
.header a{color:white;text-decoration:none;padding:8px 15px;background:rgba(255,255,255,0.1);border-radius:4px;}
.header a:hover{background:rgba(255,255,255,0.2);}
h1{color:#0088cc;}
table{border-collapse:collapse;width:100%;background:white;box-shadow:0 2px 4px rgba(0,0,0,0.1);}
th,td{border:1px solid #ddd;padding:12px;text-align:left;}
th{background:#0088cc;color:white;}
tr:hover{background:#f0f0f0;}
a{color:#0088cc;text-decoration:none;}
a:hover{text-decoration:underline;}
.status-open{color:green;font-weight:bold;}
.status-closed{color:gray;}
</style></head><body>";

echo "<div class='header'><h1>📋 Lista Completa de Tickets</h1><a href='logout-simple.php'>Cerrar Sesión</a></div>";

$query = "SELECT t.ticket_id, t.number, t.created, t.updated, 
          cd.subject,
          ts.name as status, ts.state,
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
          ORDER BY t.created DESC";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    echo "<p><strong>Total de tickets: " . $result->num_rows . "</strong></p>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Número</th><th>Asunto</th><th>Estado</th><th>Usuario</th><th>Email</th><th>Departamento</th><th>Creado</th><th>Acciones</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        $status_class = ($row['state'] == 'open') ? 'status-open' : 'status-closed';
        echo "<tr>";
        echo "<td>" . $row['ticket_id'] . "</td>";
        echo "<td><strong>" . htmlspecialchars($row['number']) . "</strong></td>";
        echo "<td>" . htmlspecialchars($row['subject'] ?: '(Sin asunto)') . "</td>";
        echo "<td class='$status_class'>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['dept_name']) . "</td>";
        echo "<td>" . date('Y-m-d H:i', strtotime($row['created'])) . "</td>";
        echo "<td><a href='ver-ticket.php?id=" . $row['ticket_id'] . "'>Ver detalles</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay tickets en el sistema.</p>";
}

$conn->close();
echo "</body></html>";
?>
