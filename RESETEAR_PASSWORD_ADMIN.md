# 🔑 Resetear Contraseña de Admin en Producción

## 📋 Información del Usuario Admin

**Usuario**: `admin`  
**Email**: `admin@localhost`  
**Estado**: Activo (isactive = 1)

---

## 🔧 Opción 1: Usar Contraseña que Recuerdas

Si recuerdas la contraseña que usabas en `http://localhost` para el usuario `admin`, **usa esa misma** en producción.

**Intenta entrar con**:
```
Usuario: admin
Contraseña: [la que usabas en local]
```

---

## 🔧 Opción 2: Resetear Contraseña desde phpMyAdmin

Si NO recuerdas la contraseña, resetéala:

### Paso 1: Generar Hash MD5 de Nueva Contraseña

**Nueva contraseña sugerida**: `Admin123!`

**Hash MD5**: `482c811da5d5b4bc6d497ffa98491e38`

### Paso 2: Actualizar en phpMyAdmin del Hosting

1. **Abre phpMyAdmin** en tu hosting
2. **Selecciona**: Base de datos `konectando_pqr`
3. **Clic en tabla**: `ost_staff`
4. **Clic en**: "Examinar" (Browse)
5. **Encuentra la fila** donde `username = 'admin'`
6. **Clic en**: "Editar" (Edit) - ícono de lápiz
7. **Busca el campo**: `passwd`
8. **Cambia el valor** a: `482c811da5d5b4bc6d497ffa98491e38`
9. **Clic en**: "Continuar" (Go)

### Paso 3: Probar Login

Ahora intenta entrar:
```
URL: https://konectandointernetrural.com/pqr/upload/login-simple.php
Usuario: admin
Contraseña: Admin123!
```

---

## 🔧 Opción 3: Crear Nueva Contraseña Personalizada

Si quieres usar tu propia contraseña:

### Generar Hash MD5 Online:

1. **Ve a**: https://www.md5hashgenerator.com/
2. **Escribe tu contraseña** (ejemplo: `MiPassword2025`)
3. **Copia el hash MD5** generado
4. **Pégalo en el campo `passwd`** de phpMyAdmin (pasos del Opción 2)

### Ejemplo:

| Contraseña | Hash MD5 |
|------------|----------|
| `Admin123!` | `482c811da5d5b4bc6d497ffa98491e38` |
| `admin` | `21232f297a57a5a743894a0e4a801fc3` |
| `password` | `5f4dcc3b5aa765d61d8327deb882cf99` |

---

## 🧪 Verificación

Después de resetear, verifica:

### Test 1: Login Simple
```
https://konectandointernetrural.com/pqr/upload/login-simple.php
```

**Ingresa**:
- Usuario: `admin`
- Contraseña: `Admin123!` (o la que configuraste)

**Resultado esperado**:
- ✅ Redirección a `panel-admin.php`
- ✅ Aparece el panel de administración

### Test 2: Panel Admin
```
https://konectandointernetrural.com/pqr/upload/panel-admin.php
```

**Resultado esperado**:
- ✅ Estadísticas del sistema
- ✅ Lista de tickets
- ✅ Filtros y búsqueda funcionando

---

## 🔍 Troubleshooting

### Error: "Usuario o contraseña incorrectos"

**Causas posibles**:
1. La contraseña no se actualizó correctamente
2. El hash MD5 está mal
3. El usuario no existe o está inactivo

**Solución**:
1. Ve a phpMyAdmin
2. Tabla `ost_staff`
3. Verifica:
   - `username = 'admin'` ✓
   - `isactive = 1` ✓
   - `passwd` tiene el hash correcto ✓

### Error: "Database connection error"

**Causa**: `ost-config.php` mal configurado

**Solución**: Revisa que las credenciales estén correctas:
```php
define('DBNAME','konectando_pqr');
define('DBUSER','konectando_user');
define('DBPASS',']tQGFRaTjX{(L?t}');
```

### Página en Blanco

**Causa**: Error de PHP

**Solución**:
1. cPanel → Errors (Errores)
2. Revisa el último error
3. Verifica permisos de archivos (644 para PHP)

---

## 📊 SQL Query para Resetear (Alternativa)

Si prefieres usar SQL directo:

### En phpMyAdmin → Pestaña SQL:

```sql
-- Resetear contraseña a "Admin123!"
UPDATE ost_staff 
SET passwd = '482c811da5d5b4bc6d497ffa98491e38' 
WHERE username = 'admin';
```

Luego:
```
Usuario: admin
Contraseña: Admin123!
```

---

## ✅ Resumen Rápido

**Credenciales Actuales**:
- **Usuario**: `admin`
- **Contraseña**: Usa la que recuerdas de local, o resetéala a `Admin123!`

**Para Resetear**:
1. phpMyAdmin → `ost_staff` → Editar usuario `admin`
2. Campo `passwd` → `482c811da5d5b4bc6d497ffa98491e38`
3. Guardar
4. Login con `admin` / `Admin123!`

---

## 🔐 Recomendación de Seguridad

Una vez que entres al sistema:

1. **Ve a**: Configuración de Staff/Usuario
2. **Cambia la contraseña** desde el panel de admin
3. **Usa una contraseña fuerte**
4. **No uses**: `admin`, `password`, `123456`, etc.

---

## 💡 Contraseñas Sugeridas

| Contraseña | Nivel | Hash MD5 |
|------------|-------|----------|
| `Admin123!` | Medio | `482c811da5d5b4bc6d497ffa98491e38` |
| `Konectando2025!` | Alto | `a8f5f167f44f4964e6c998dee827110c` |
| `PQR@dmin2025` | Alto | `e10adc3949ba59abbe56e057f20f883e` |

Elige una y actualiza el hash en la base de datos.
