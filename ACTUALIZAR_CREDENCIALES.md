# 🔧 Archivos que Necesitan Actualización de Credenciales DB

## Cuando subas a producción, busca y reemplaza en estos archivos:

### 🔍 Buscar:
```php
new mysqli('localhost', 'root', 'admin123', 'pqr')
```

### ✏️ Reemplazar por (con tus datos reales del hosting):
```php
new mysqli('localhost', 'TU_USUARIO_DB', 'TU_PASSWORD_DB', 'TU_NOMBRE_DB')
```

---

## 📂 Lista de Archivos a Actualizar:

### Sistema PQR Personalizado:
1. `pqr/upload/crear-ticket-simple.php` - Línea ~6
2. `pqr/upload/consultar-ticket.php` - Línea ~4
3. `pqr/upload/ver-ticket.php` - Línea ~9
4. `pqr/upload/login-simple.php` - Línea ~9
5. `pqr/upload/panel-admin.php` - Línea ~10
6. `pqr/upload/reporte-incidente.php` - Línea ~10
7. `pqr/upload/reporte-seguridad-simple.php` - Línea ~4
8. `pqr/upload/includes/simple-email-notifier.php` - Línea ~98

### osTicket Core (si usas funciones de osTicket):
9. `pqr/upload/includes/ost-config.php` - Configuración principal

---

## 🤖 Script de Reemplazo Automático

### Opción 1: Buscar/Reemplazar en Editor
1. Abre VS Code
2. Presiona `Ctrl+Shift+H` (Buscar y Reemplazar en archivos)
3. Buscar: `new mysqli('localhost', 'root', 'admin123', 'pqr')`
4. Reemplazar: `new mysqli('localhost', 'TU_USUARIO', 'TU_PASSWORD', 'TU_DB')`
5. Aplica a carpeta: `pqr/upload/`

### Opción 2: Script PowerShell (Windows)
```powershell
# Cambiar estos valores:
$usuario = "pqr_user"
$password = "tu_password_seguro"
$database = "pqr_database"

# Ejecutar en PowerShell desde la raíz del proyecto:
$archivos = @(
    "pqr/upload/crear-ticket-simple.php",
    "pqr/upload/consultar-ticket.php",
    "pqr/upload/ver-ticket.php",
    "pqr/upload/login-simple.php",
    "pqr/upload/panel-admin.php",
    "pqr/upload/reporte-incidente.php",
    "pqr/upload/reporte-seguridad-simple.php",
    "pqr/upload/includes/simple-email-notifier.php"
)

foreach ($archivo in $archivos) {
    $contenido = Get-Content $archivo -Raw
    $contenido = $contenido -replace "new mysqli\('localhost', 'root', 'admin123', 'pqr'\)", "new mysqli('localhost', '$usuario', '$password', '$database')"
    Set-Content $archivo $contenido -Encoding UTF8
    Write-Host "✅ Actualizado: $archivo"
}
```

### Opción 3: Script Bash (Linux/Mac)
```bash
#!/bin/bash
# Cambiar estos valores:
USUARIO="pqr_user"
PASSWORD="tu_password_seguro"
DATABASE="pqr_database"

# Ejecutar desde la raíz del proyecto:
find pqr/upload -name "*.php" -type f -exec sed -i \
    "s/new mysqli('localhost', 'root', 'admin123', 'pqr')/new mysqli('localhost', '$USUARIO', '$PASSWORD', '$DATABASE')/g" {} \;

echo "✅ Credenciales actualizadas en todos los archivos"
```

---

## ⚠️ IMPORTANTE: email-config.php

Este archivo también necesita actualización:

### Archivo: `pqr/upload/includes/email-config.php`

```php
<?php
// ============================================
// CONFIGURACIÓN DE PRODUCCIÓN
// ============================================

// Email habilitado
define('EMAIL_ENABLED', true);
define('EMAIL_METHOD', 'sendgrid');

// SendGrid API Key - NUEVA KEY CON EMAIL konectandointernetrural@gmail.com
define('SENDGRID_API_KEY', 'SG.XXXXX_NUEVA_API_KEY_AQUI_XXXXX');

// Configuración del remitente
define('FROM_EMAIL', 'konectandointernetrural@gmail.com');
define('FROM_NAME', 'Konectando Internet Rural - Soporte PQR');

// Email del administrador
define('ADMIN_EMAIL', 'konectandointernetrural@gmail.com');

// URLs del sistema - ACTUALIZAR CON TU DOMINIO REAL
define('SYSTEM_URL', 'https://tudominio.co.cloud');
define('TICKET_VIEW_URL', 'https://tudominio.co.cloud/pqr/upload/consultar-ticket.php');
define('ADMIN_VIEW_URL', 'https://tudominio.co.cloud/pqr/upload/ver-ticket.php');
?>
```

---

## 📋 Checklist Pre-Deploy

- [ ] Base de datos exportada (`pqr_database.sql`)
- [ ] Credenciales DB actualizadas en 8 archivos PHP
- [ ] SendGrid: Nueva cuenta con konectandointernetrural@gmail.com
- [ ] SendGrid: Email verificado
- [ ] SendGrid: API Key creada
- [ ] `email-config.php` actualizado con nueva API Key
- [ ] URLs actualizadas en `email-config.php`
- [ ] Archivos de prueba eliminados (`test-*.php`, `debug-*.php`)
- [ ] Contraseña de admin cambiada
- [ ] `.htaccess` configurado
- [ ] Permisos de carpetas verificados

---

## 🔍 Verificación Post-Deploy

Después de subir a producción, verifica:

1. **Conectividad DB:**
   - Accede a cualquier página PHP
   - Si ves errores de conexión, revisa credenciales

2. **Emails funcionando:**
   - Crea un ticket de prueba
   - Verifica que llegue el email
   - Responde desde admin
   - Verifica que llegue respuesta al cliente

3. **Panel Admin:**
   - Login funcional
   - Estadísticas se cargan
   - Puedes ver y responder tickets

---

## 🆘 Troubleshooting Común

### Error: "Can't connect to MySQL server"
- Verifica usuario/password de DB en archivos PHP
- Confirma que el usuario tiene permisos en la DB

### Emails no llegan
- Verifica API Key de SendGrid
- Confirma que el email está verificado en SendGrid
- Revisa logs del servidor

### Error 500
- Revisa permisos de archivos (644) y carpetas (755)
- Verifica que PHP tenga extensiones mysqli y curl
- Activa display_errors temporalmente para debug

---

**Archivos importantes creados:**
- ✅ `pqr_database.sql` - Base de datos completa
- ✅ `configuracion_produccion.sql` - Ajustes post-import
- ✅ Este archivo - Guía de actualización de credenciales
