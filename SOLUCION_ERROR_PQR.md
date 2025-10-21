# 🔧 Solución: "Fatal Error: Contact system administrator"

## 🔍 Problema Identificado

El sistema PQR (osTicket) está intentando conectarse a una base de datos que probablemente no existe o no tiene las credenciales correctas.

**Configuración detectada:**
- Base de datos: `pqr`
- Usuario: `proditelsas`
- Host: `localhost`

---

## ✅ SOLUCIÓN: Crear la base de datos

### Opción 1: Desde phpMyAdmin (Recomendado - Más Fácil)

1. **Abre phpMyAdmin**
   - Abre Laragon
   - Click en "Database" o "phpMyAdmin"
   - O ve a: http://localhost/phpmyadmin

2. **Crear la base de datos**
   - Click en "New" (Nueva) en el panel izquierdo
   - Nombre de la base de datos: `pqr`
   - Cotejamiento: `utf8mb4_unicode_ci`
   - Click en "Create" (Crear)

3. **Crear usuario (si es necesario)**
   - En phpMyAdmin, ve a: Cuentas de usuario
   - Click en "Agregar cuenta de usuario"
   - Nombre: `proditelsas`
   - Host: `localhost`
   - Contraseña: (la que tengas configurada, o déjala vacía)
   - Permisos: Marcar "Otorgar todos los privilegios"
   - Click en "Continuar"

4. **Recarga la página del PQR**
   - http://localhost/proditel/pqr/upload/

---

### Opción 2: Desde la Terminal (Más Rápido)

Ejecuta estos comandos en PowerShell:

```powershell
# Conectar a MySQL
cd C:\laragon\bin\mysql\mysql-8.x.x\bin
.\mysql.exe -u root -p

# Crear base de datos (dentro de MySQL)
CREATE DATABASE pqr CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Crear usuario (si es necesario)
CREATE USER 'proditelsas'@'localhost';
GRANT ALL PRIVILEGES ON pqr.* TO 'proditelsas'@'localhost';
FLUSH PRIVILEGES;

# Salir
EXIT;
```

---

### Opción 3: Si ya existe la base de datos

Si la base de datos `pqr` ya existe pero está vacía o corrupta:

1. **Restaurar desde backup (si tienes uno)**
   - En phpMyAdmin
   - Selecciona la base de datos `pqr`
   - Click en "Import" (Importar)
   - Selecciona el archivo .sql de backup
   - Click en "Go"

2. **O reinstalar osTicket desde cero**
   - Ve a: http://localhost/proditel/pqr/upload/setup/
   - Sigue el asistente de instalación

---

## 🎯 SOLUCIÓN RÁPIDA (Recomendada)

### Paso 1: Abrir phpMyAdmin

```
http://localhost/phpmyadmin
```

Usuario: `root`
Contraseña: (vacía o la que tengas)

### Paso 2: Crear base de datos

1. Click en "New" (o "Nueva")
2. Nombre: `pqr`
3. Cotejamiento: `utf8mb4_unicode_ci`
4. Click en "Create"

### Paso 3: Verificar usuario

Si ya existe el usuario `proditelsas`:
- Click en "User accounts" (Cuentas de usuario)
- Busca `proditelsas`
- Asegúrate que tenga permisos en la base de datos `pqr`

Si NO existe:
- Usa el usuario `root` temporalmente (ver abajo)

---

## 🔧 ALTERNATIVA: Usar usuario ROOT

Si quieres que funcione inmediatamente, puedes cambiar la configuración para usar el usuario `root`:

**ADVERTENCIA**: Solo para desarrollo local, NO para producción.

Edita el archivo:
```
C:\laragon\www\proditel\pqr\upload\include\ost-config.php
```

Busca:
```php
define('DBUSER','proditelsas');
define('DBPASS','CONTRASEÑA_AQUI');
```

Cámbialo a:
```php
define('DBUSER','root');
define('DBPASS','');
```

Guarda el archivo y recarga la página del PQR.

---

## 📋 Checklist de Verificación

□ Base de datos `pqr` existe en MySQL
□ Usuario `proditelsas` existe (o usar `root`)
□ Usuario tiene permisos sobre la base de datos `pqr`
□ Contraseña en ost-config.php es correcta
□ MySQL está corriendo en Laragon
□ PHP 7.4 está activo

---

## 🔍 Verificar qué está fallando exactamente

Para ver el error real (no solo "Fatal Error"), temporalmente:

1. Edita: `C:\laragon\www\proditel\pqr\upload\bootstrap.php`
2. Al principio del archivo (después de `<?php`), agrega:
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```
3. Recarga la página para ver el error específico

---

## 💡 Lo más probable

El problema es que:
1. La base de datos `pqr` no existe
2. O el usuario `proditelsas` no tiene permisos

**Solución inmediata**: Crear la base de datos `pqr` en phpMyAdmin.

---

¿Quieres que te ayude a crear la base de datos paso a paso?
