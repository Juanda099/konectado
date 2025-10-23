<?php
// Panel Administrativo Profesional - Sistema PQR
session_start();
if (!isset($_SESSION['staff_logged']) || $_SESSION['staff_logged'] !== true) {
    header('Location: login-simple.php');
    exit;
}

$conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
$conn->set_charset("utf8");

// Obtener estadísticas
$stats_query = "SELECT 
    COUNT(*) as total,
    SUM(CASE WHEN status_id = 1 THEN 1 ELSE 0 END) as abiertos,
    SUM(CASE WHEN status_id = 2 THEN 1 ELSE 0 END) as resueltos,
    SUM(CASE WHEN status_id = 3 THEN 1 ELSE 0 END) as cerrados,
    SUM(CASE WHEN topic_id = 8 THEN 1 ELSE 0 END) as seguridad,
    SUM(CASE WHEN DATE(created) = CURDATE() THEN 1 ELSE 0 END) as hoy
FROM ost_ticket";
$stats = $conn->query($stats_query)->fetch_assoc();

// Filtros
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$where_conditions = [];
if ($filter == 'open') $where_conditions[] = "t.status_id = 1";
if ($filter == 'closed') $where_conditions[] = "t.status_id = 3";
if ($filter == 'security') $where_conditions[] = "t.topic_id = 8";
if ($filter == 'today') $where_conditions[] = "DATE(t.created) = CURDATE()";
if ($search) {
    $search_safe = $conn->real_escape_string($search);
    $where_conditions[] = "(t.number LIKE '%$search_safe%' OR cd.subject LIKE '%$search_safe%' OR u.name LIKE '%$search_safe%' OR ue.address LIKE '%$search_safe%')";
}

$where_clause = count($where_conditions) > 0 ? "WHERE " . implode(" AND ", $where_conditions) : "";

$query = "SELECT t.ticket_id, t.number, t.created, t.updated, t.topic_id,
          cd.subject, cd.priority,
          ts.name as status, ts.state,
          u.name as user_name,
          COALESCE(ue.address, (SELECT address FROM ost_user_email WHERE user_id = t.user_id LIMIT 1)) as user_email,
          d.name as dept_name
          FROM ost_ticket t
          LEFT JOIN ost_ticket__cdata cd ON t.ticket_id = cd.ticket_id
          LEFT JOIN ost_ticket_status ts ON t.status_id = ts.id
          LEFT JOIN ost_user u ON t.user_id = u.id
          LEFT JOIN ost_user_email ue ON t.user_email_id = ue.id
          LEFT JOIN ost_department d ON t.dept_id = d.id
          $where_clause
          ORDER BY t.created DESC";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo - Sistema PQR</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        
        /* Top Bar */
        .top-bar { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .top-bar-content { max-width: 1400px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 20px 0; }
        .top-bar h1 { font-size: 24px; font-weight: 600; }
        .top-bar .user-info { display: flex; align-items: center; gap: 20px; }
        .top-bar .user-name { opacity: 0.9; font-size: 14px; }
        .top-bar a { color: white; text-decoration: none; padding: 8px 16px; background: rgba(255,255,255,0.2); border-radius: 6px; transition: all 0.3s; font-size: 14px; }
        .top-bar a:hover { background: rgba(255,255,255,0.3); }
        
        /* Container */
        .container { max-width: 1400px; margin: 30px auto; padding: 0 30px; }
        
        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: transform 0.3s, box-shadow 0.3s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .stat-card .icon { font-size: 36px; margin-bottom: 10px; }
        .stat-card .number { font-size: 32px; font-weight: bold; color: #2c3e50; }
        .stat-card .label { font-size: 14px; color: #7f8c8d; margin-top: 5px; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-total { border-left: 4px solid #3498db; }
        .stat-open { border-left: 4px solid #27ae60; }
        .stat-closed { border-left: 4px solid #95a5a6; }
        .stat-security { border-left: 4px solid #e74c3c; }
        .stat-today { border-left: 4px solid #f39c12; }
        
        /* Actions Bar */
        .actions-bar { background: white; padding: 20px 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; }
        .filter-buttons { display: flex; gap: 10px; flex-wrap: wrap; }
        .filter-btn { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 500; transition: all 0.3s; text-decoration: none; display: inline-block; }
        .filter-btn.active { color: white; }
        .filter-all { background: #ecf0f1; color: #2c3e50; }
        .filter-all.active { background: #3498db; }
        .filter-open { background: #d5f4e6; color: #27ae60; }
        .filter-open.active { background: #27ae60; }
        .filter-security { background: #fadbd8; color: #e74c3c; }
        .filter-security.active { background: #e74c3c; }
        .filter-today { background: #fdeaa8; color: #f39c12; }
        .filter-today.active { background: #f39c12; }
        .search-box { display: flex; gap: 10px; }
        .search-box input { padding: 10px 15px; border: 2px solid #ecf0f1; border-radius: 6px; font-size: 14px; width: 250px; }
        .search-box button { padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; }
        .search-box button:hover { background: #5568d3; }
        .btn-new { padding: 10px 20px; background: #27ae60; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; }
        .btn-new:hover { background: #229954; }
        .btn-colcert { padding: 10px 20px; background: #c0392b; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; margin-left: 10px; }
        .btn-colcert:hover { background: #a93226; }
        
        /* Table */
        .table-container { background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #f8f9fa; }
        th { padding: 15px 20px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #ecf0f1; }
        td { padding: 15px 20px; border-bottom: 1px solid #ecf0f1; color: #555; }
        tbody tr { transition: background 0.2s; }
        tbody tr:hover { background: #f8f9fa; }
        .ticket-number { font-weight: bold; color: #3498db; font-size: 15px; }
        .ticket-subject { color: #2c3e50; font-weight: 500; }
        .badge { display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-open { background: #d5f4e6; color: #27ae60; }
        .badge-resolved { background: #d1ecf1; color: #0c5460; }
        .badge-closed { background: #e2e3e5; color: #6c757d; }
        .badge-security { background: #fadbd8; color: #e74c3c; }
        .badge-priority-1 { background: #d1ecf1; color: #0c5460; }
        .badge-priority-2 { background: #d5f4e6; color: #27ae60; }
        .badge-priority-3 { background: #fdeaa8; color: #f39c12; }
        .badge-priority-4 { background: #fadbd8; color: #e74c3c; }
        .btn-view { color: #667eea; text-decoration: none; font-weight: 500; }
        .btn-view:hover { text-decoration: underline; }
        .no-tickets { padding: 60px; text-align: center; color: #7f8c8d; }
        .no-tickets-icon { font-size: 64px; margin-bottom: 20px; opacity: 0.3; }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-content">
            <h1>🎫 Panel Administrativo PQR</h1>
            <div class="user-info">
                <span class="user-name">👤 <?php echo htmlspecialchars($_SESSION['staff_name'] ?? 'Administrador'); ?></span>
                <a href="logout-simple.php">Cerrar Sesión</a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card stat-total">
                <div class="icon">📊</div>
                <div class="number"><?php echo $stats['total']; ?></div>
                <div class="label">Total Tickets</div>
            </div>
            
            <div class="stat-card stat-open">
                <div class="icon">✅</div>
                <div class="number"><?php echo $stats['abiertos']; ?></div>
                <div class="label">Abiertos</div>
            </div>
            
            <div class="stat-card stat-closed">
                <div class="icon">✔️</div>
                <div class="number"><?php echo $stats['cerrados']; ?></div>
                <div class="label">Cerrados</div>
            </div>
            
            <div class="stat-card stat-security">
                <div class="icon">🔒</div>
                <div class="number"><?php echo $stats['seguridad']; ?></div>
                <div class="label">Seguridad</div>
            </div>
            
            <div class="stat-card stat-today">
                <div class="icon">📅</div>
                <div class="number"><?php echo $stats['hoy']; ?></div>
                <div class="label">Hoy</div>
            </div>
        </div>
        
        <!-- Actions Bar -->
        <div class="actions-bar">
            <div class="filter-buttons">
                <a href="?filter=all" class="filter-btn filter-all <?php echo $filter == 'all' ? 'active' : ''; ?>">Todos</a>
                <a href="?filter=open" class="filter-btn filter-open <?php echo $filter == 'open' ? 'active' : ''; ?>">Abiertos</a>
                <a href="?filter=security" class="filter-btn filter-security <?php echo $filter == 'security' ? 'active' : ''; ?>">Seguridad</a>
                <a href="?filter=today" class="filter-btn filter-today <?php echo $filter == 'today' ? 'active' : ''; ?>">Hoy</a>
            </div>
            
            <form method="GET" class="search-box">
                <input type="text" name="search" placeholder="Buscar por #, asunto, usuario..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">🔍 Buscar</button>
            </form>
            
            <div>
                <a href="reporte-incidente.php" class="btn-colcert">🔒 Reporte ColCERT</a>
            </div>
        </div>
        
        <!-- Tickets Table -->
        <div class="table-container">
            <?php if ($result && $result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número</th>
                            <th>Asunto</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Departamento</th>
                            <th>Creado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['ticket_id']; ?></td>
                                <td class="ticket-number">#<?php echo htmlspecialchars($row['number']); ?></td>
                                <td class="ticket-subject">
                                    <?php echo htmlspecialchars($row['subject'] ?: '(Sin asunto)'); ?>
                                    <?php if ($row['topic_id'] == 8): ?>
                                        <span class="badge badge-security">🔒 SEGURIDAD</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                    $badge_class = 'badge-closed';
                                    if ($row['state'] == 'open') $badge_class = 'badge-open';
                                    elseif ($row['state'] == 'resolved') $badge_class = 'badge-resolved';
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?>"><?php echo htmlspecialchars($row['status']); ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                                <td><?php echo htmlspecialchars($row['dept_name']); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($row['created'])); ?></td>
                                <td><a href="ver-ticket.php?id=<?php echo $row['ticket_id']; ?>" class="btn-view">Ver detalles →</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-tickets">
                    <div class="no-tickets-icon">📭</div>
                    <h3>No se encontraron tickets</h3>
                    <p>No hay tickets que coincidan con los filtros seleccionados.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>
