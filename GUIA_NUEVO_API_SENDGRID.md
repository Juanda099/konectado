# 📧 CONFIGURACIÓN NUEVO API SENDGRID - KONECTANDO

## ✅ LO QUE YA HICE (Local - Desarrollo)

1. **Actualicé el API Key de SendGrid:**
   - ### 🔑 **Nuevo API Key Generado:**

```
TU_API_KEY_DE_SENDGRID_AQUI
```

**⚠️ IMPORTANTE:** Reemplaza este valor con tu API key real de SendGrid en el archivo de configuración local.
   - Nombre: "Api_Konectando"

2. **Actualicé el email remitente:**
   - Email: `konectandointernetrural@gmail.com`
   - Nombre: "Konectando Internet Rural - Soporte PQR"

3. **Archivos actualizados:**
   - ✅ `email-config.php` (en desarrollo - Laragon)
   - ✅ `email-config-PRODUCCION.php` (para subir a producción)

---

## 🔴 LO QUE DEBES HACER AHORA

### PASO 1: Verificar el email en SendGrid ⚠️ OBLIGATORIO

**Antes de enviar emails, DEBES verificar el remitente en SendGrid:**

1. Ve a: https://app.sendgrid.com/settings/sender_auth/senders
2. Haz clic en **"Create New Sender"**
3. Llena el formulario:
   - **From Email Address:** `konectandointernetrural@gmail.com`
   - **From Name:** `Konectando Internet Rural`
   - **Reply To:** `konectandointernetrural@gmail.com`
   - **Company:** Konectando
   - **Address, City, Country:** (Tus datos de la empresa)
4. Haz clic en **"Save"**
5. SendGrid enviará un email a `konectandointernetrural@gmail.com`
6. **IMPORTANTE:** Abre ese email y haz clic en **"Verify Sender"**

### PASO 2: Probar en Local (Desarrollo)

1. Abre en tu navegador: http://localhost/proditel/pqr/upload/test-nuevo-api.php
2. Haz clic en **"Enviar Email de Prueba"**
3. Verifica que llegue a `konectandointernetrural@gmail.com`
4. Si no llega, revisa:
   - Que hayas verificado el email en SendGrid (Paso 1)
   - La carpeta de SPAM
   - El log de errores de PHP

### PASO 3: Preparar para Producción

**Archivos que debes subir a producción:**

1. **email-config.php** (usar el archivo `email-config-PRODUCCION.php`)
   - Ubicación: `/pqr/upload/includes/email-config.php`
   - ⚠️ CAMBIAR la línea `SYSTEM_URL` por tu dominio real
   - Ejemplo: `https://konectando.co.cloud/pqr/upload`

2. **Base de datos** (`pqr_database.sql`)
   - Importar en tu hosting usando phpMyAdmin o similar

---

## 📂 ARCHIVOS PARA PRODUCCIÓN

### Archivo: `email-config.php` (Producción)

```php
define('SENDGRID_API_KEY', 'TU_API_KEY_SENDGRID_AQUI');
define('FROM_EMAIL', 'konectandointernetrural@gmail.com');
define('FROM_NAME', 'Konectando Internet Rural - Soporte PQR');

// 🔴 CAMBIAR ESTO POR TU URL REAL:
define('SYSTEM_URL', 'https://TU-DOMINIO.co.cloud/pqr/upload');
```

**⚠️ IMPORTANTE:** El API key real está en tu archivo local en Laragon. NO lo subas a GitHub.

**⚠️ Pasos en producción:**
1. Edita `email-config-PRODUCCION.php`
2. Cambia `https://TU-DOMINIO.co.cloud` por tu dominio real
3. Renómbralo a `email-config.php`
4. Súbelo a `/pqr/upload/includes/`

---

## 🗄️ BASE DE DATOS EN PRODUCCIÓN

### Opción 1: Importar vía phpMyAdmin (Recomendado)

1. **Accede a phpMyAdmin en tu hosting:**
   - URL típica: `https://tu-hosting.co.cloud/phpmyadmin`
   - Usuario: (tu usuario de hosting)
   - Contraseña: (tu contraseña de hosting)

2. **Crear la base de datos:**
   - Haz clic en "Nueva" (o "New")
   - Nombre: `pqr` (o el que prefieras)
   - Cotejamiento: `utf8mb4_unicode_ci`
   - Crear

3. **Importar el archivo SQL:**
   - Selecciona la base de datos `pqr`
   - Clic en pestaña "Importar"
   - Clic en "Seleccionar archivo"
   - Busca: `C:\Users\juand\Desktop\Proyecto\pqr_database.sql`
   - Clic en "Continuar" o "Import"
   - Esperar a que termine (puede tardar 1-2 minutos)

4. **Verificar:**
   - Deberías ver 68 tablas
   - Verifica que exista `ost_ticket`, `ost_staff`, etc.

### Opción 2: Vía Terminal SSH (Avanzado)

```bash
# Conectar por SSH a tu hosting
ssh usuario@tu-hosting.co.cloud

# Importar el SQL
mysql -u usuario_db -p nombre_base_datos < pqr_database.sql
```

---

## 🔧 ACTUALIZAR CONEXIONES DE BASE DE DATOS

### Archivos que debes editar en producción:

**1. Conexiones principales:**

Busca en todos los archivos `.php` las líneas:
```php
$conn = new mysqli('localhost', 'root', 'admin123', 'pqr');
```

Cámbialas por tus datos de hosting:
```php
$conn = new mysqli('localhost', 'TU_USUARIO_DB', 'TU_PASSWORD_DB', 'pqr');
```

**Archivos a editar:**
- `crear-ticket-simple.php`
- `consultar-ticket.php`
- `ver-ticket.php`
- `panel-admin.php`
- `login-simple.php`
- `reporte-incidente.php`
- `reporte-seguridad-simple.php`
- `includes/simple-email-notifier.php`

---

## 📋 CHECKLIST FINAL - PRODUCCIÓN

### Antes de subir:
- [ ] Email verificado en SendGrid ✅
- [ ] Test local funcionando ✅
- [ ] `email-config-PRODUCCION.php` con URL correcta
- [ ] Base de datos exportada (`pqr_database.sql`)
- [ ] Credenciales de base de datos de producción anotadas

### Al subir:
- [ ] Archivos PHP subidos vía GitHub o FTP
- [ ] Base de datos importada en phpMyAdmin
- [ ] `email-config.php` con credenciales correctas
- [ ] Conexiones de BD actualizadas en todos los `.php`

### Después de subir:
- [ ] Probar crear un ticket
- [ ] Verificar que llegue el email
- [ ] Probar consultar ticket
- [ ] Probar login administrativo
- [ ] Revisar que no haya errores en logs

---

## 🚨 SOLUCIÓN DE PROBLEMAS

### ❌ No llegan los emails

1. **Verificar remitente en SendGrid:**
   - https://app.sendgrid.com/settings/sender_auth/senders
   - Debe estar verificado (checkmark verde)

2. **Revisar Activity Feed:**
   - https://app.sendgrid.com/email_activity
   - Busca los emails enviados
   - Revisa si hay errores

3. **Verificar configuración:**
   - API Key correcto
   - Email remitente correcto
   - cURL habilitado en PHP

### ❌ Error de conexión a base de datos

1. Verifica las credenciales en los archivos PHP
2. Asegúrate que la base de datos se importó correctamente
3. Revisa que el usuario tenga permisos

### ❌ Error 500 en producción

1. Activa error reporting:
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```
2. Revisa logs del servidor
3. Verifica permisos de archivos (644 para .php, 755 para carpetas)

---

## 📞 CONTACTO Y RECURSOS

- **Panel SendGrid:** https://app.sendgrid.com/
- **Verificar Remitentes:** https://app.sendgrid.com/settings/sender_auth/senders
- **Activity Feed:** https://app.sendgrid.com/email_activity
- **Test Local:** http://localhost/proditel/pqr/upload/test-nuevo-api.php

---

## 📝 NOTAS ADICIONALES

### Diferencia entre Local y Producción:

**Local (Desarrollo):**
- Host BD: `localhost`
- Usuario BD: `root`
- Password BD: `admin123`
- URL Sistema: `http://localhost/proditel/pqr/upload`

**Producción:**
- Host BD: `localhost` (o el que te dé tu hosting)
- Usuario BD: (tu usuario de hosting)
- Password BD: (tu password de hosting)
- URL Sistema: `https://tu-dominio.co.cloud/pqr/upload`

### SendGrid - Límites del Plan Gratuito:
- 100 emails/día
- Suficiente para empezar
- Si necesitas más, actualiza a plan de pago

---

¡Listo! Sigue estos pasos y tu sistema estará funcionando en producción. 🚀
