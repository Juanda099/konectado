<?php
session_start();
$error = '';

if ($_POST) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $conn = new mysqli('localhost', 'konectando_user', 'Iuf+E2AZ+H~+gC(z', 'konectando_pqr');
    $conn->set_charset("utf8");
    
    $username = $conn->real_escape_string($username);
    $query = "SELECT staff_id, username, passwd, firstname, lastname FROM ost_staff WHERE username = '$username' AND isactive = 1";
    $result = $conn->query($query);
    
    if ($result && $row = $result->fetch_assoc()) {
        // Verificar contraseÃ±a (MD5 o bcrypt)
        if (md5($password) === $row['passwd'] || password_verify($password, $row['passwd'])) {
            $_SESSION['staff_logged'] = true;
            $_SESSION['staff_id'] = $row['staff_id'];
            $_SESSION['staff_name'] = $row['firstname'] . ' ' . $row['lastname'];
            header('Location: panel-admin.php');
            exit;
        }
    }
    $error = 'Usuario o contraseÃ±a incorrectos';
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Tickets</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-container { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
        .logo { text-align: center; margin-bottom: 30px; }
        .logo h1 { color: #2c3e50; font-size: 28px; }
        .logo p { color: #888; font-size: 14px; margin-top: 5px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #555; font-weight: 500; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .form-group input:focus { outline: none; border-color: #667eea; }
        .error { background: #fee; color: #c33; padding: 12px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; }
        .btn { width: 100%; padding: 12px; background: #667eea; color: white; border: none; border-radius: 4px; font-size: 16px; font-weight: 500; cursor: pointer; transition: background 0.3s; }
        .btn:hover { background: #5568d3; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>Sistema de Tickets</h1>
            <p>Konectando Internet Rural - Gestión PQR</p>
        </div>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>

