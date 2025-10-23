<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema PQR - Konectando</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .header { text-align: center; color: white; padding: 40px 20px; }
        .header h1 { font-size: 48px; margin-bottom: 10px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
        .header p { font-size: 20px; opacity: 0.9; }
        .cards-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; margin-top: 40px; max-width: 1100px; margin-left: auto; margin-right: auto; }
        .card { background: white; border-radius: 15px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transition: transform 0.3s, box-shadow 0.3s; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(0,0,0,0.3); }
        .card-icon { font-size: 60px; margin-bottom: 20px; }
        .card-title { font-size: 24px; color: #2c3e50; margin-bottom: 15px; font-weight: 600; }
        .card-description { color: #7f8c8d; line-height: 1.6; margin-bottom: 20px; }
        .card-button { display: inline-block; background: #667eea; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: 600; transition: background 0.3s; }
        .card-button:hover { background: #5568d3; }
        .card-security { border-left: 4px solid #c0392b; }
        .card-security .card-button { background: #c0392b; }
        .card-security .card-button:hover { background: #a93226; }
        .card-admin { border-left: 4px solid #27ae60; }
        .card-admin .card-button { background: #27ae60; }
        .card-admin .card-button:hover { background: #229954; }
        .card-search { border-left: 4px solid #f39c12; }
        .card-search .card-button { background: #f39c12; }
        .card-search .card-button:hover { background: #e67e22; }
        .features { background: rgba(255,255,255,0.1); border-radius: 15px; padding: 30px; margin-top: 40px; color: white; }
        .features h3 { font-size: 24px; margin-bottom: 20px; text-align: center; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .feature-item { background: rgba(255,255,255,0.1); padding: 20px; border-radius: 10px; text-align: center; }
        .feature-item strong { display: block; margin-top: 10px; font-size: 16px; }
        .footer { text-align: center; color: white; padding: 30px; margin-top: 40px; opacity: 0.8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎫 Sistema PQR</h1>
            <p>Plataforma de Gestión de Peticiones, Quejas, Reclamos e Incidentes de Seguridad</p>
        </div>
        
        <div class="cards-container">
            <!-- Card 1: Crear Ticket Regular -->
            <div class="card">
                <div class="card-icon">📝</div>
                <h2 class="card-title">Crear Ticket</h2>
                <p class="card-description">
                    Reporta peticiones, quejas, reclamos, sugerencias o problemas técnicos. 
                    Recibirás un número de seguimiento y notificaciones por email.
                </p>
                <a href="crear-ticket-simple.php" class="card-button">Crear Ticket →</a>
            </div>
            
            <!-- Card 2: Problema de Seguridad (Simple) -->
            <div class="card card-security">
                <div class="card-icon">⚠️</div>
                <h2 class="card-title">Problema de Seguridad</h2>
                <p class="card-description">
                    ¿Notaste algo sospechoso? Repórtalo aquí de forma simple.
                    Email falso, virus, página rara, etc. <strong>Fácil y rápido.</strong>
                </p>
                <a href="reporte-seguridad-simple.php" class="card-button">Reportar →</a>
            </div>
            
            <!-- Card 3: Consultar Estado -->
            <div class="card card-search">
                <div class="card-icon">🔍</div>
                <h2 class="card-title">Consultar Estado</h2>
                <p class="card-description">
                    Consulta el estado de tu ticket usando tu número de ticket y correo electrónico. 
                    Ver conversación y agregar respuestas.
                </p>
                <a href="consultar-ticket.php" class="card-button">Consultar →</a>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>Konectando</strong> - Sistema de Gestión PQR</p>
            <p style="margin-top: 10px; font-size: 14px;">
                Para soporte técnico: <a href="mailto:konectandointernetrural@gmail.com" style="color: white;">konectandointernetrural@gmail.com</a>
            </p>
            <p style="margin-top: 20px; font-size: 12px;">© 2025 Konectando Internet Rural. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
