# 🗄️ Configurar Base de Datos en Producción (Hosting)

**Fecha**: 22 de octubre de 2025  
**Archivo SQL**: `pqr_database.sql` (220 KB)  
**Hosting**: co.cloud con cPanel

---

## 📋 PASO 1: Crear Base de Datos en cPanel

### 1.1 Acceder a MySQL Databases

1. **Inicia sesión en cPanel** de tu hosting
2. Busca la sección **"Bases de datos"** (Databases)
3. Clic en **"MySQL® Databases"** o **"Bases de datos MySQL"**

### 1.2 Crear Nueva Base de Datos

1. En la sección **"Crear nueva base de datos"**:
   ```
   Nombre: konectando_pqr
   ```
   (El sistema agregará automáticamente un prefijo como: cpses_konectando_pqr)

2. Clic en **"Crear base de datos"** (Create Database)

3. **Anota el nombre completo** que aparece, por ejemplo:
   ```
   cpses_konectando_pqr
   ```

### 1.3 Crear Usuario de Base de Datos

1. En la sección **"Usuarios de MySQL"** (MySQL Users):
   ```
   Nombre de usuario: pqr_admin
   Contraseña: [Genera una contraseña segura]
   ```

2. Clic en **"Generar contraseña"** (Generate Password)
   - Se generará automáticamente una contraseña segura
   - **⚠️ IMPORTANTE: Copia y guarda esta contraseña**, la necesitarás después

3. Clic en **"Crear usuario"** (Create User)

4. **Anota**:
   ```
   Usuario completo: cpses_pqr_admin
   Contraseña: [la que generaste]
   ```

### 1.4 Asignar Privilegios

1. En la sección **"Agregar usuario a la base de datos"** (Add User to Database):
   - Selecciona el **usuario**: `cpses_pqr_admin`
   - Selecciona la **base de datos**: `cpses_konectando_pqr`
   - Clic en **"Agregar"** (Add)

2. En la página de privilegios:
   - Marca **"TODOS LOS PRIVILEGIOS"** (ALL PRIVILEGES)
   - Clic en **"Realizar cambios"** (Make Changes)

---

## 📊 PASO 2: Importar Base de Datos con phpMyAdmin

### 2.1 Acceder a phpMyAdmin

1. **Regresa al cPanel**
2. En la sección **"Bases de datos"** (Databases)
3. Clic en **"phpMyAdmin"**

### 2.2 Seleccionar Base de Datos

1. En el **panel izquierdo** de phpMyAdmin
2. Clic en tu base de datos: `cpses_konectando_pqr`

### 2.3 Importar el Archivo SQL

1. Clic en la pestaña **"Importar"** (Import) en la parte superior

2. Clic en **"Elegir archivo"** (Choose file)

3. **Navega hasta**:
   ```
   C:\Users\juand\Desktop\Proyecto\pqr_database.sql
   ```

4. **Configuración de importación**:
   - ✅ Formato: **SQL**
   - ✅ Juego de caracteres del archivo: **utf8mb4_unicode_ci**
   - ✅ Formato específico: **SQL**
   - ✅ Deja las demás opciones por defecto

5. **Scroll hacia abajo** y clic en **"Continuar"** (Go)

6. **Espera** a que termine (debería ser rápido, solo 220 KB)

7. **Verifica** que aparezca:
   ```
   ✅ Importación finalizada con éxito
   ✅ 35 consultas ejecutadas correctamente
   ```

### 2.4 Verificar las Tablas

1. En el panel izquierdo, clic en tu base de datos
2. Deberías ver **todas estas tablas**:
   ```
   ost_api_key
   ost_attachment
   ost_canned_response
   ost_config
   ost_department
   ost_email
   ost_email_template
   ost_file
   ost_filter
   ost_form
   ost_form_entry
   ost_form_field
   ost_group
   ost_help_topic
   ost_organization
   ost_queue
   ost_role
   ost_sequence          ⭐ (Esta es la importante para los tickets)
   ost_session
   ost_staff
   ost_staff_dept_access
   ost_sla
   ost_team
   ost_thread
   ost_thread_entry
   ost_ticket
   ost_ticket_status
   ost_user
   ost_user_account
   ... y más
   ```

3. **Verifica la secuencia de tickets**:
   - Clic en la tabla **`ost_sequence`**
   - Clic en **"Examinar"** (Browse)
   - Deberías ver: `name = 'Ticket Sequence'` y `next = 100009`

---

## 🔧 PASO 3: Configurar Conexión en el Código

Ahora necesitas actualizar el archivo de configuración en tu hosting:

### 3.1 Ubicación del Archivo

```
/public_html/pqr/upload/include/ost-config.php
```

### 3.2 Editar desde cPanel File Manager

1. **Ve al cPanel**
2. Clic en **"Administrador de archivos"** (File Manager)
3. Navega a: `/public_html/pqr/upload/include/`
4. Busca el archivo: **`ost-config.php`**
5. **Clic derecho** → **"Editar"** (Edit)

### 3.3 Actualizar las Credenciales

Busca estas líneas (alrededor de la línea 42-45):

```php
# Mysql Login info
define('DBTYPE','mysql');
define('DBHOST','localhost');
define('DBNAME','pqr');
define('DBUSER','root');
define('DBPASS','');
```

**Cámbialo por** (con tus datos reales):

```php
# Mysql Login info
define('DBTYPE','mysql');
define('DBHOST','localhost');  // ⚠️ Verifica con tu hosting, puede ser 'localhost' o una IP
define('DBNAME','cpses_konectando_pqr');  // ⚠️ TU NOMBRE DE BASE DE DATOS
define('DBUSER','cpses_pqr_admin');  // ⚠️ TU USUARIO
define('DBPASS','TU_CONTRASEÑA_AQUI');  // ⚠️ LA CONTRASEÑA QUE GENERASTE
```

### 3.4 Guardar y Cerrar

1. Clic en **"Guardar cambios"** (Save Changes)
2. Cierra el editor

---

## ✅ PASO 4: Probar la Conexión

### 4.1 Acceder al Sistema PQR

1. **Abre tu navegador**
2. Ve a tu URL de producción:
   ```
   https://tudominio.co.cloud/pqr/upload/
   ```

3. Si todo está bien, deberías ver:
   - ✅ La página principal del sistema PQR
   - ✅ Sin errores de conexión a base de datos
   - ✅ Posibilidad de hacer login

### 4.2 Probar Login de Administrador

**Credenciales de prueba** (de tu base de datos actual):

```
Usuario: admin
Contraseña: [la que tengas configurada en tu Laragon]
```

Si no recuerdas la contraseña, puedes:
1. Ir a phpMyAdmin en producción
2. Tabla: `ost_staff`
3. Buscar el usuario `admin`
4. Editar el campo `passwd`
5. Copiar el hash de contraseña de tu base de datos local

### 4.3 Crear Ticket de Prueba

1. Ve al portal público:
   ```
   https://tudominio.co.cloud/pqr/upload/portal-pqr.php
   ```

2. Clic en **"Crear Nuevo Ticket"**

3. Completa el formulario y envía

4. **Verifica**:
   - ✅ El ticket se crea correctamente
   - ✅ El número de ticket es: **#100009** (o el siguiente)
   - ✅ Aparece en el panel de administración

---

## 🔍 Troubleshooting (Solución de Problemas)

### Problema 1: "Error de conexión a la base de datos"

**Causas posibles**:
- ❌ Nombre de base de datos incorrecto
- ❌ Usuario o contraseña incorrectos
- ❌ DBHOST incorrecto

**Solución**:
1. Verifica en **cPanel → MySQL Databases** el nombre EXACTO de tu base de datos
2. Verifica el nombre EXACTO del usuario
3. Si usas cPanel, DBHOST generalmente es `localhost`
4. Algunos hostings usan `127.0.0.1` o una IP específica

### Problema 2: "Tablas no encontradas"

**Causa**: La importación no se completó

**Solución**:
1. Ve a phpMyAdmin
2. Selecciona tu base de datos
3. Clic en **"Examinar"** (Browse)
4. Si no ves las tablas `ost_*`, repite el PASO 2

### Problema 3: "Caracteres raros (tildes mal)"

**Causa**: Problema de codificación UTF-8

**Solución**:
1. Ve a phpMyAdmin
2. Selecciona tu base de datos
3. Clic en **"Operaciones"** (Operations)
4. En **"Cotejamiento"** (Collation), selecciona: `utf8mb4_unicode_ci`
5. Clic en **"Continuar"**

### Problema 4: "Los tickets empiezan en #000001"

**Causa**: La secuencia no se importó correctamente

**Solución**:
1. Ve a phpMyAdmin
2. Tabla: `ost_sequence`
3. Clic en **"Examinar"** (Browse)
4. Edita la fila donde `name = 'Ticket Sequence'`
5. Cambia `next` a `100009` (o el número que quieras)
6. Clic en **"Continuar"**

---

## 📦 Archivos que También Necesitas Subir al Hosting

Además del código, recuerda crear manualmente estos archivos:

### 1. email-config.php
```
Ubicación: /public_html/pqr/upload/includes/email-config.php
Usa: email-config-PRODUCCION.php como plantilla
Agrega: Tu API key de SendGrid real
```

### 2. footer.php
```
Ubicación: /public_html/footer.php
Agrega: Tu API key de Google Maps real (línea 3)
```

---

## ✅ Checklist Final de Producción

- [ ] Base de datos creada en cPanel
- [ ] Usuario de base de datos creado
- [ ] Privilegios asignados correctamente
- [ ] Archivo `pqr_database.sql` importado en phpMyAdmin
- [ ] Tablas verificadas (35+ tablas `ost_*`)
- [ ] Secuencia de tickets verificada (`ost_sequence` = 100009)
- [ ] `ost-config.php` actualizado con credenciales de producción
- [ ] `email-config.php` creado con API key de SendGrid
- [ ] `footer.php` actualizado con API key de Google Maps
- [ ] Verificar sender en SendGrid
- [ ] Sistema PQR accesible en producción
- [ ] Login de administrador funcional
- [ ] Ticket de prueba creado exitosamente
- [ ] Email de notificación recibido

---

## 📝 Datos a Guardar (Completa con tus valores)

```
=== CREDENCIALES DE BASE DE DATOS ===
Nombre de base de datos: cpses_____________________
Usuario de base de datos: cpses_____________________
Contraseña: _________________________________________
Host: localhost (o ________________________________)

=== URLs DEL SISTEMA ===
URL principal: https://________________________________
Portal PQR: https://________________________________/pqr/upload/portal-pqr.php
Panel Admin: https://________________________________/pqr/upload/login-simple.php

=== ACCESO ADMINISTRADOR ===
Usuario admin: admin
Contraseña: _________________________________________
```

---

**🎯 ¿Necesitas ayuda con alguno de estos pasos?** Puedo asistirte con:
- Generar el SQL actualizado si necesitas cambiar algo
- Crear un script de verificación de conexión
- Ayudarte a solucionar errores específicos
