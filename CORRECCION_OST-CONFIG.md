# 🔧 CORRECCIÓN: Configuración MySQL en ost-config.php

## ❌ ERROR COMÚN: Usar URL de phpMyAdmin

**INCORRECTO** (lo que NO debes hacer):
```php
define('DBHOST','https://dylan.protectedserver.net:2083/.../phpMyAdmin/...');
```

❌ **Esto está MAL porque**:
- phpMyAdmin es solo una **interfaz web** para administrar la BD
- NO es la dirección del servidor MySQL
- MySQL se conecta de forma interna, no por HTTP

---

## ✅ CONFIGURACIÓN CORRECTA

### Explicación Simple:

**phpMyAdmin** = Una herramienta web para VER y editar la base de datos  
**MySQL** = El servidor real de base de datos (funciona en el fondo)

**Analogía**:
- phpMyAdmin = El navegador de archivos de Windows
- MySQL = El disco duro donde están los archivos

No usas "la ventana del explorador" para conectarte, usas la ruta directa al disco.

---

## 📝 Configuración en ost-config.php

### Ubicación del Archivo:
**En el hosting**: `/public_html/pqr/upload/include/ost-config.php`

### Líneas a Editar (42-45 aproximadamente):

```php
# Database Options
# ---------------------------------------------------
# Mysql Login info
define('DBTYPE','mysql');
define('DBHOST','localhost');                    // ✅ SIEMPRE 'localhost' en 99% de hostings
define('DBNAME','konectando_pqr');               // ✅ TU NOMBRE DE BASE DE DATOS
define('DBUSER','konectando_pqr');               // ⚠️ TU USUARIO (ver más abajo)
define('DBPASS','TU_CONTRASEÑA_REAL_AQUI');      // ⚠️ TU CONTRASEÑA
```

---

## 🔑 Encontrar Usuario y Contraseña

### Paso 1: Ir a cPanel

1. **Cierra phpMyAdmin**
2. **Ve al cPanel principal** (la página con todos los íconos)

### Paso 2: MySQL® Databases

1. **Busca el ícono**: "MySQL® Databases" o "Bases de datos MySQL"
2. **Clic en él**

### Paso 3: Encontrar Usuario

En la sección **"Current MySQL Users"** (Usuarios actuales de MySQL), verás algo como:

```
User                          Actions
konectando_pqr               [Change Password] [Delete]
konectando_admin             [Change Password] [Delete]
konectando_root              [Change Password] [Delete]
```

**📝 Copia el nombre EXACTO** de uno de estos usuarios. Probablemente sea:
- `konectando_pqr` (mismo nombre que la BD)
- O `konectando_admin`
- O `konectando_root`

### Paso 4: Verificar Privilegios

En la sección **"Add User To Database"** o al final de la página, verás una tabla que muestra:

```
User: konectando_pqr  →  Database: konectando_pqr  →  Privileges: ALL PRIVILEGES
```

Esto confirma qué usuario tiene acceso a qué base de datos.

### Paso 5: Contraseña

**Si NO recuerdas la contraseña**:

1. En "Current MySQL Users"
2. Clic en **"Change Password"** junto a tu usuario
3. Clic en **"Generate Password"** (botón que genera una contraseña automática)
4. **⚠️ COPIA LA CONTRASEÑA INMEDIATAMENTE** (se muestra en pantalla)
5. **Guárdala en un lugar seguro** (Notepad, archivo de texto, etc.)
6. Clic en **"Change Password"** para confirmar

**Ejemplo de contraseña generada**:
```
xK9#mP2$nQ8!wE5@rT7
```

---

## 🔧 Editar el Archivo en Hosting

### Método 1: File Manager (Recomendado)

1. **cPanel → File Manager**
2. **Navega a**: `public_html/pqr/upload/include/`
3. **Busca**: `ost-config.php`
4. **Clic derecho → Edit**
5. **Busca las líneas** (42-45):

```php
define('DBHOST','localhost');
define('DBNAME','pqr');
define('DBUSER','root');
define('DBPASS','');
```

6. **Cámbialas a**:

```php
define('DBHOST','localhost');
define('DBNAME','konectando_pqr');              // ✅ De phpMyAdmin
define('DBUSER','konectando_pqr');              // ✅ De cPanel MySQL Users
define('DBPASS','xK9#mP2$nQ8!wE5@rT7');         // ✅ La contraseña que generaste
```

7. **Guarda**: Clic en "Save Changes" (esquina superior derecha)
8. **Cierra**: Clic en "Close"

---

## 🧪 Probar la Conexión

### Test 1: Portal PQR

Abre en el navegador:
```
https://konectandointernetrural.com/pqr/upload/portal-pqr.php
```

**Resultado esperado**:
✅ Aparecen las 3 tarjetas (Crear Ticket, Seguridad, Consultar)

**Si aparece error**:
❌ "Database connection error" o "Unable to connect to database"
→ Revisa credenciales (nombre de usuario/contraseña incorrectos)

### Test 2: Login Admin

Abre:
```
https://konectandointernetrural.com/pqr/upload/login-simple.php
```

**Resultado esperado**:
✅ Formulario de login aparece correctamente

---

## 🔍 Troubleshooting

### Error: "Access denied for user 'root'@'localhost'"

**Causa**: Estás usando `root` como usuario, pero en hosting compartido NO existe `root`

**Solución**: 
- Usa el usuario real de cPanel (ej: `konectando_pqr`)

### Error: "Unknown database 'pqr'"

**Causa**: El nombre de la base de datos está mal

**Solución**:
- Ve a phpMyAdmin
- En el panel izquierdo, copia el nombre EXACTO de tu BD
- Debe ser: `konectando_pqr` (con el prefijo completo)

### Error: "Access denied for user 'konectando_pqr'@'localhost'"

**Causa**: Contraseña incorrecta

**Solución**:
- Ve a cPanel → MySQL Databases
- "Change Password" → "Generate Password"
- Copia la nueva contraseña
- Actualiza `ost-config.php`

### Página en Blanco

**Causa**: Error de PHP

**Solución**:
- cPanel → Metrics → Errors
- Revisa el último error
- Busca líneas que mencionen `ost-config.php`

---

## 📊 Ejemplo de Configuración Completa

```php
<?php
# osTicket Configuration File

#Disable direct access.
if (!strcasecmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__)))
    die('kwaheri rafiki!');

# Database Options
# ---------------------------------------------------
# Mysql Login info
define('DBTYPE','mysql');
define('DBHOST','localhost');                      // ✅ NO cambiar
define('DBNAME','konectando_pqr');                 // ✅ Tu BD
define('DBUSER','konectando_pqr');                 // ✅ Tu usuario
define('DBPASS','xK9#mP2$nQ8!wE5@rT7');            // ✅ Tu contraseña

# Table prefix
define('TABLE_PREFIX','ost_');                     // ✅ NO cambiar

# ... resto del archivo ...
```

---

## ✅ Checklist de Configuración

- [ ] Ir a cPanel (NO phpMyAdmin)
- [ ] MySQL® Databases → Ver "Current MySQL Users"
- [ ] Copiar nombre exacto del usuario (ej: `konectando_pqr`)
- [ ] Generate Password → Copiar contraseña generada
- [ ] File Manager → Editar `ost-config.php`
- [ ] Cambiar DBNAME a `konectando_pqr`
- [ ] Cambiar DBUSER a `konectando_pqr` (o el usuario real)
- [ ] Cambiar DBPASS a la contraseña generada
- [ ] Guardar archivo
- [ ] Probar en navegador

---

## 💡 Resumen Ultra-Rápido

1. **DBHOST**: Siempre `localhost` (NO la URL de phpMyAdmin)
2. **DBNAME**: `konectando_pqr` (lo ves en phpMyAdmin)
3. **DBUSER**: Ir a cPanel → MySQL Databases → Current MySQL Users → copiar nombre
4. **DBPASS**: Si no la sabes → Change Password → Generate → Copiar
5. **Editar**: File Manager → `ost-config.php` → Cambiar credenciales → Guardar
6. **Probar**: Abrir portal-pqr.php en el navegador

---

## 🎯 Lo Más Importante

**NO uses URLs en DBHOST**. MySQL se conecta internamente usando:
- `localhost` (99% de los casos)
- `127.0.0.1` (1% de los casos)
- Una IP/hostname específico (solo en VPS/dedicados avanzados)

En hosting compartido (cPanel), **SIEMPRE es `localhost`**.
