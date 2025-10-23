# 🔧 Configurar ost-config.php en Producción

## 📋 PASO 1: Encontrar Credenciales de Base de Datos

### En cPanel → MySQL® Databases

1. **Ve a cPanel** de tu hosting
2. Busca la sección **"Bases de datos"** (Databases)
3. Clic en **"MySQL® Databases"** o **"Bases de datos MySQL"**

### Información que Verás:

#### A) Bases de Datos Actuales (Current Databases)
Aquí verás una tabla con tus bases de datos, algo como:

```
Database                    Actions
konectan_pqr               [Check DB] [Delete Database]
konectan_test              [Check DB] [Delete Database]
```

**📝 ANOTA EL NOMBRE COMPLETO**: `konectan_pqr` (o el que hayas creado)

#### B) Usuarios Actuales de MySQL (Current MySQL Users)
Más abajo verás una tabla con los usuarios:

```
User                       Actions
konectan_admin            [Change Password] [Delete User]
konectan_pqr_user         [Change Password] [Delete User]
```

**📝 ANOTA EL NOMBRE COMPLETO**: `konectan_admin` (o el que hayas creado)

#### C) Agregar Usuario a Base de Datos (Add User to Database)
En esta sección podrás ver qué usuarios tienen acceso a qué bases de datos.

Debería aparecer algo como:
```
User: konectan_admin  →  Database: konectan_pqr  →  Privileges: ALL PRIVILEGES
```

---

## ⚠️ IMPORTANTE: Formato de Nombres

cPanel **siempre** agrega un prefijo a tus bases de datos y usuarios:

### Formato:
```
prefijo_nombre
```

### Ejemplo:
Si tu cuenta cPanel es `konectan`, entonces:
- Base de datos: `pqr` → **`konectan_pqr`**
- Usuario: `admin` → **`konectan_admin`**

---

## 🔑 PASO 2: Recuperar/Crear Contraseña

### Si NO recuerdas la contraseña:

1. **En cPanel → MySQL® Databases**
2. **Sección "Current MySQL Users"**
3. **Encuentra tu usuario** (ej: `konectan_admin`)
4. **Clic en "Change Password"**
5. **Opción 1**: Usar "Password Generator" (recomendado)
   - Clic en "Generate Password"
   - Se generará una contraseña segura
   - **⚠️ CÓPIALA INMEDIATAMENTE** (guardarla en un lugar seguro)
6. **Opción 2**: Escribir tu propia contraseña
   - Escribe una contraseña segura
   - Confirma la contraseña
7. **Clic en "Change Password"**

### Guarda Esta Información:

```
=== CREDENCIALES DE BASE DE DATOS ===
Nombre de BD: konectan_pqr (ejemplo)
Usuario: konectan_admin (ejemplo)
Contraseña: [LA QUE ACABAS DE GENERAR/CREAR]
Host: localhost
Prefijo de tablas: ost_
```

---

## 📝 PASO 3: Editar ost-config.php en el Hosting

### A) Abrir el Archivo

1. **cPanel → File Manager** (Administrador de archivos)
2. **Navega a**: `public_html/pqr/upload/include/`
3. **Busca**: `ost-config.php`
4. **Clic derecho → Edit**
5. Si aparece un popup de codificación, selecciona **"utf-8"** y clic en "Edit"

### B) Encontrar la Sección de Base de Datos

Busca estas líneas (alrededor de la línea 40-45):

```php
# Database Options
# ---------------------------------------------------
# Mysql Login info
define('DBTYPE','mysql');
define('DBHOST','localhost');
define('DBNAME','pqr');
define('DBUSER','root');
define('DBPASS','');
```

### C) Actualizar con TUS Credenciales

**REEMPLAZA** esas líneas con tus datos reales:

```php
# Database Options
# ---------------------------------------------------
# Mysql Login info
define('DBTYPE','mysql');
define('DBHOST','localhost');
define('DBNAME','konectan_pqr');        // ⚠️ TU NOMBRE DE BD COMPLETO
define('DBUSER','konectan_admin');      // ⚠️ TU USUARIO COMPLETO
define('DBPASS','TU_CONTRASEÑA_AQUI');  // ⚠️ TU CONTRASEÑA REAL
```

### D) Guardar el Archivo

1. **Clic en "Save Changes"** (Guardar cambios) - esquina superior derecha
2. **Clic en "Close"** (Cerrar)

---

## 🧪 PASO 4: Probar la Conexión

### Prueba 1: Página Principal del Sistema

Abre en tu navegador:
```
https://konectandointernetrural.com/pqr/upload/
```

**Resultado esperado**: 
- ✅ La página carga sin errores
- ✅ Aparece el sistema osTicket
- ✅ Puedes ver opciones de soporte

**Si ves error**:
- ❌ "Database connection error" → Credenciales incorrectas
- ❌ Página en blanco → Revisa error_log en cPanel

### Prueba 2: Portal PQR

Abre:
```
https://konectandointernetrural.com/pqr/upload/portal-pqr.php
```

**Resultado esperado**:
- ✅ Aparecen las 3 tarjetas (Crear Ticket, Seguridad, Consultar)
- ✅ Todo con el diseño de "Konectando Internet Rural"

### Prueba 3: Login de Administrador

Abre:
```
https://konectandointernetrural.com/pqr/upload/login-simple.php
```

**Resultado esperado**:
- ✅ Formulario de login aparece
- ✅ Puedes escribir usuario/contraseña

**Credenciales por defecto** (de tu base de datos local):
```
Usuario: admin
Contraseña: [la que tenías en local - necesitarás verificarla]
```

---

## 🔍 TROUBLESHOOTING

### Error: "Unknown database 'pqr'"

**Causa**: El nombre de la base de datos está mal (le falta el prefijo)

**Solución**: 
- Ve a cPanel → MySQL Databases
- Copia el nombre EXACTO de tu base de datos (ej: `konectan_pqr`)
- Actualiza `ost-config.php` con ese nombre exacto

### Error: "Access denied for user"

**Causa**: Usuario o contraseña incorrectos

**Solución**:
- Ve a cPanel → MySQL Databases → Current MySQL Users
- Copia el nombre EXACTO del usuario (ej: `konectan_admin`)
- Si no recuerdas la contraseña, usa "Change Password"
- Actualiza `ost-config.php`

### Error: "Can't connect to MySQL server"

**Causa**: DBHOST incorrecto

**Solución**:
- La mayoría de hostings usan `localhost`
- Algunos usan `127.0.0.1`
- Verifica en cPanel → MySQL Databases si hay una nota sobre el "MySQL Host"
- Intenta cambiar a `127.0.0.1` si `localhost` no funciona

### Página en Blanco

**Causa**: Error de PHP (permisos, sintaxis, etc.)

**Solución**:
1. Ve a cPanel → Metrics → Errors (o "Errores")
2. Busca el error más reciente
3. Copia el mensaje completo
4. Verifica que `ost-config.php` esté guardado correctamente

---

## 📊 VERIFICACIÓN RÁPIDA

### Checklist de Configuración:

- [ ] Nombre de base de datos copiado de cPanel (con prefijo)
- [ ] Nombre de usuario copiado de cPanel (con prefijo)
- [ ] Contraseña generada/recuperada
- [ ] `ost-config.php` editado con las credenciales
- [ ] Archivo guardado correctamente
- [ ] Probado en navegador
- [ ] Login de admin funciona

---

## 🔐 Seguridad Post-Configuración

Una vez que todo funcione:

### 1. Verificar Permisos del Archivo

En File Manager:
- `ost-config.php` debería tener permisos **644**
- Si tiene 777 o 666, es un riesgo de seguridad

### 2. Desactivar Edición (Opcional)

Puedes hacer el archivo de solo lectura:
```
Permisos: 444 (solo lectura)
```

Esto previene que alguien lo edite accidentalmente.

---

## 📞 Siguiente Paso: Configurar SendGrid

Una vez que `ost-config.php` funcione, el siguiente paso es crear:

**Archivo**: `/public_html/pqr/upload/includes/email-config.php`

Con tu API key de SendGrid para que funcionen las notificaciones por email.

---

## 💡 Resumen Rápido

1. **cPanel → MySQL Databases** → Copiar nombre de BD y usuario
2. **Generar/recuperar contraseña** del usuario
3. **File Manager** → Editar `ost-config.php`
4. **Actualizar** DBNAME, DBUSER, DBPASS con datos reales
5. **Guardar** y probar en el navegador

**¿Funcionó?** ✅ Siguiente paso: email-config.php  
**¿No funcionó?** ❌ Revisar error_log y verificar credenciales
