# 📋 GUÍA PARA SUBIR CAMBIOS A GITHUB

## ✅ ARCHIVOS YA SINCRONIZADOS (Laragon → Proyecto)

### 📁 Archivos PHP Principales Corregidos (UTF-8):
- ✅ `public_html/pqr/upload/portal-pqr.php`
- ✅ `public_html/pqr/upload/crear-ticket-simple.php`
- ✅ `public_html/pqr/upload/consultar-ticket.php`
- ✅ `public_html/pqr/upload/reporte-seguridad-simple.php`
- ✅ `public_html/pqr/upload/login-simple.php`
- ✅ `public_html/pqr/upload/panel-admin.php`
- ✅ `public_html/pqr/upload/reporte-incidente.php`
- ✅ `public_html/pqr/upload/ver-ticket.php`

### 📁 Archivos de Configuración:
- ✅ `public_html/pqr/upload/includes/email-config.php`
- ✅ `public_html/pqr/upload/includes/simple-email-notifier.php`

### 📁 Otros Archivos Modificados:
- ✅ `public_html/index.php` (botón Sistema PQR)
- ✅ `public_html/medidor.php` (Speedtest.net)

---

## 🚀 COMANDOS PARA SUBIR A GITHUB

### Opción 1: Subir TODO (Recomendado)
```bash
cd C:\Users\juand\Desktop\Proyecto

# Agregar todos los archivos nuevos y modificados
git add .

# Crear commit con mensaje descriptivo
git commit -m "✅ Sistema PQR completo: UTF-8 corregido, SendGrid configurado, diseño profesional"

# Subir a GitHub
git push origin main
```

### Opción 2: Subir SOLO archivos importantes (Selectivo)
```bash
cd C:\Users\juand\Desktop\Proyecto

# Agregar archivos PHP corregidos
git add public_html/pqr/upload/*.php
git add public_html/pqr/upload/includes/

# Agregar archivos de configuración y documentación
git add public_html/index.php
git add public_html/medidor.php
git add pqr_database.sql
git add README_PRODUCCION.md
git add GUIA_NUEVO_API_SENDGRID.md
git add email-config-PRODUCCION.php

# Crear commit
git commit -m "✅ Sistema PQR: UTF-8 corregido + SendGrid + Diseño profesional"

# Subir a GitHub
git push origin main
```

---

## ⚠️ ARCHIVOS QUE NO DEBES SUBIR (Ya en .gitignore o sensibles)

### ❌ Archivos de prueba (NO subir):
- `test-*.php` (todos los archivos de prueba)
- `debug-*.php` (archivos de debug)
- `diagnostico*.php`
- `corregir-utf8*.ps1` (scripts PowerShell)

### ❌ Archivos con credenciales sensibles:
- `email-config.php` (tiene tu API key real)
  → En su lugar, sube: `email-config-PRODUCCION.php` (template sin API key)

### ❌ Backups y temporales:
- `reporte-seguridad-simple-BACKUP.php`
- `*.bat` (scripts de Windows)

---

## 📝 RECOMENDACIÓN: Crear .gitignore

Crea un archivo `.gitignore` en la raíz de tu proyecto:

```
# Archivos de prueba
test-*.php
debug-*.php
diagnostico*.php

# Scripts de desarrollo
*.bat
*.ps1

# Backups
*-BACKUP.php

# Configuraciones con credenciales
public_html/pqr/upload/includes/email-config.php

# Base de datos (opcional, solo si es muy grande)
# pqr_database.sql
```

---

## 🔐 ANTES DE SUBIR: Proteger API Keys

### 1. Verificar email-config-PRODUCCION.php
```php
<?php
// Template para producción - CAMBIAR valores
define('SENDGRID_API_KEY', 'TU_API_KEY_AQUI');
define('FROM_EMAIL', 'tu-email@dominio.com');
define('FROM_NAME', 'Tu Nombre Empresa');
define('SYSTEM_URL', 'https://tu-dominio.com');
?>
```

### 2. NO subir el email-config.php real
```bash
# Si ya lo agregaste por error, quitarlo:
git rm --cached public_html/pqr/upload/includes/email-config.php
```

---

## ✅ PASOS FINALES

1. **Revisar cambios antes de commit:**
   ```bash
   git status
   git diff
   ```

2. **Agregar archivos:**
   ```bash
   git add .
   ```

3. **Crear commit:**
   ```bash
   git commit -m "✅ Sistema PQR completo: UTF-8 corregido, SendGrid, diseño profesional"
   ```

4. **Subir a GitHub:**
   ```bash
   git push origin main
   ```

5. **Verificar en GitHub:**
   - Ve a: https://github.com/Juanda099/konectado
   - Verifica que los archivos se subieron correctamente
   - Revisa que NO se subió el API key real

---

## 🎯 RESUMEN DE CAMBIOS PARA EL COMMIT

**Mensaje recomendado:**
```
✅ Sistema PQR Completo - Konectando Internet Rural

Cambios principales:
- UTF-8 corregido en todos los archivos (ñ, tildes, emojis funcionan)
- SendGrid API configurado para envío de emails
- Diseño profesional consistente en todos los formularios
- Panel de administración moderno con estadísticas
- Sistema de seguridad ColCERT implementado
- Formulario simplificado para usuarios
- Branding "Konectando" aplicado en todo el sistema
- Base de datos exportada lista para producción
```

---

## 📞 SOPORTE

Si tienes dudas al hacer el commit/push:
1. Verifica el estado: `git status`
2. Si hay conflictos: `git pull origin main` primero
3. Luego haz `git push origin main`

---

**Fecha de sincronización:** 22 de octubre de 2025
**Archivos sincronizados:** 10 principales + 2 includes
**Estado:** ✅ Listos para GitHub
