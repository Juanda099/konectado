# 🚀 Instrucciones para Subir a Producción

## 📊 1. BASE DE DATOS

### Paso 1: Importar la base de datos en el hosting
```bash
# En el panel de control de CO.CLOUD (cPanel o similar):

1. Ve a phpMyAdmin
2. Crea una nueva base de datos llamada: pqr (o el nombre que prefieras)
3. Selecciona la base de datos
4. Click en "Importar"
5. Sube el archivo: pqr_database.sql
6. Click en "Continuar"
```

### Paso 2: Crear usuario de base de datos
```sql
-- En phpMyAdmin, crea un usuario para la base de datos:
Usuario: pqr_user (o tu preferido)
Contraseña: [CREA UNA CONTRASEÑA SEGURA]
Host: localhost
Privilegios: TODOS en la base de datos 'pqr'
```

### Paso 3: Actualizar credenciales en los archivos PHP
Debes cambiar las conexiones en estos archivos:

**Archivos a actualizar:**
- `pqr/upload/includes/ost-config.php` (principal de osTicket)
- `pqr/upload/crear-ticket-simple.php`
- `pqr/upload/consultar-ticket.php`
- `pqr/upload/ver-ticket.php`
- `pqr/upload/login-simple.php`
- `pqr/upload/panel-admin.php`
- `pqr/upload/reporte-incidente.php`
- `pqr/upload/reporte-seguridad-simple.php`

**Cambiar de:**
```php
$conn = new mysqli('localhost', 'root', 'admin123', 'pqr');
```

**A (usando tus datos reales del hosting):**
```php
$conn = new mysqli('localhost', 'tu_usuario_db', 'tu_password_db', 'tu_nombre_db');
```

---

## 📧 2. SENDGRID - CONFIGURACIÓN DE EMAIL

### Necesitas crear nueva API Key para el correo de la empresa

#### Paso 1: Crear cuenta SendGrid con el nuevo email
1. Ve a: https://sendgrid.com/
2. Crea cuenta con: **konectandointernetrural@gmail.com**
3. Verifica el email

#### Paso 2: Verificar el dominio del remitente
1. En SendGrid, ve a: **Settings > Sender Authentication**
2. Click en **Single Sender Verification**
3. Agrega: **konectandointernetrural@gmail.com**
4. Verifica el email que te enviarán

#### Paso 3: Crear nueva API Key
1. Settings > API Keys
2. Click en "Create API Key"
3. Nombre: `Konectando_PQR_Production`
4. Permisos: **Full Access** (o al menos "Mail Send")
5. **COPIA LA API KEY** (solo se muestra una vez)

#### Paso 4: Actualizar en el servidor
Edita el archivo: `pqr/upload/includes/email-config.php`

```php
<?php
// Configuración de Email
define('EMAIL_ENABLED', true);
define('EMAIL_METHOD', 'sendgrid'); // 'sendgrid' o 'mail'

// SendGrid
define('SENDGRID_API_KEY', 'SG.XXXXX_TU_NUEVA_API_KEY_AQUI_XXXXX');

// Configuración del remitente
define('FROM_EMAIL', 'konectandointernetrural@gmail.com');
define('FROM_NAME', 'Konectando Internet Rural - Soporte');

// Email del administrador
define('ADMIN_EMAIL', 'konectandointernetrural@gmail.com');

// URLs del sistema (CAMBIAR A TU DOMINIO REAL)
define('SYSTEM_URL', 'https://tudominio.co.cloud');
define('TICKET_VIEW_URL', 'https://tudominio.co.cloud/pqr/upload/consultar-ticket.php');
define('ADMIN_VIEW_URL', 'https://tudominio.co.cloud/pqr/upload/ver-ticket.php');
?>
```

---

## 🔄 3. SUBIR CON GITHUB

### Opción A: Push directo (SI tu hosting soporta GitHub Deploy)
```bash
# En tu proyecto local:
git add .
git commit -m "Sistema PQR completo - Listo para producción"
git push origin main

# En CO.CLOUD:
# Ve al panel de control y busca "GitHub Integration" o "Git Deploy"
# Conecta tu repositorio: Juanda099/konectado
# Branch: main
# Deploy automático
```

### Opción B: Subir manualmente vía FTP/FileManager
```bash
1. Comprimir la carpeta del proyecto (sin node_modules, .git, etc)
2. Subir vía FTP o FileManager de cPanel
3. Descomprimir en el servidor
4. Configurar permisos:
   - Carpetas: 755
   - Archivos PHP: 644
   - Carpeta pqr/upload/ost-attachments: 777 (escribible)
```

---

## ⚙️ 4. CONFIGURACIONES IMPORTANTES EN PRODUCCIÓN

### A. Archivo .htaccess (si no existe, crear)
```apache
# Seguridad básica
Options -Indexes

# Proteger archivos sensibles
<FilesMatch "\.(sql|log|ini)$">
    Order allow,deny
    Deny from all
</FilesMatch>

# Forzar HTTPS (si tienes SSL)
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### B. Verificar PHP
- Versión mínima: PHP 7.4
- Extensiones requeridas:
  - mysqli
  - curl (para SendGrid)
  - mbstring
  - json
  - iconv

### C. Permisos de carpetas
```bash
chmod 755 pqr/upload/
chmod 777 pqr/upload/ost-attachments/
chmod 644 pqr/upload/*.php
```

---

## 🧪 5. TESTING EN PRODUCCIÓN

### Checklist post-deployment:
- [ ] Probar login admin: `tudominio.co.cloud/pqr/upload/login-simple.php`
- [ ] Crear ticket de prueba: `tudominio.co.cloud/pqr/upload/portal-pqr.php`
- [ ] Verificar email de notificación llegue
- [ ] Consultar ticket creado
- [ ] Responder desde admin
- [ ] Verificar email de respuesta llegue al cliente
- [ ] Probar formulario de seguridad
- [ ] Verificar ColCERT (admin only)

---

## 🔐 6. SEGURIDAD POST-INSTALACIÓN

### Cambiar credenciales por defecto:
```sql
-- Conectar a phpMyAdmin y ejecutar:
UPDATE ost_staff 
SET passwd = MD5('TU_NUEVA_CONTRASEÑA_SEGURA') 
WHERE username = 'admin';
```

### Eliminar archivos de prueba:
```bash
rm pqr/upload/test-*.php
rm pqr/upload/debug-*.php
rm pqr/upload/diagnostico.php
```

---

## 📝 RESUMEN RÁPIDO

1. ✅ Exportar DB: `pqr_database.sql` (YA HECHO)
2. ✅ Subir código a GitHub
3. ✅ Crear base de datos en hosting
4. ✅ Importar `pqr_database.sql`
5. ✅ Actualizar credenciales DB en archivos PHP
6. ✅ Crear SendGrid con nuevo email: konectandointernetrural@gmail.com
7. ✅ Actualizar `email-config.php` con nueva API key
8. ✅ Actualizar URLs en `email-config.php` con dominio real
9. ✅ Configurar permisos de carpetas
10. ✅ Probar todo el flujo

---

## ❓ SOPORTE

Si tienes dudas durante el proceso:
1. Revisa logs del servidor en cPanel
2. Activa `display_errors` temporalmente para debug
3. Verifica phpMyAdmin para errores de DB

**La base de datos exportada está en:**
`C:\Users\juand\Desktop\Proyecto\pqr_database.sql`
