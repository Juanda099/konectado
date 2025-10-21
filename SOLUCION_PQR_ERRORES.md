# 🔧 Solución de Problemas - Sistema PQR (osTicket)

## ⚠️ Problema Identificado

El sistema PQR muestra múltiples warnings y errores "Deprecated" porque:
- El sistema PQR (osTicket) fue diseñado para **PHP 7.x o anterior**
- Laragon viene con **PHP 8.x** por defecto
- PHP 8.x tiene requisitos más estrictos de compatibilidad

---

## ✅ Soluciones Aplicadas

### 1. **Archivo `.htaccess` creado**
📁 Ubicación: `C:\laragon\www\proditel\pqr\upload\.htaccess`

Este archivo configura PHP para:
- Desactivar la visualización de errores
- Suprimir warnings y notices
- Cargar automáticamente un archivo de configuración

### 2. **Archivo `suppress_errors.php` creado**
📁 Ubicación: `C:\laragon\www\proditel\pqr\upload\suppress_errors.php`

Este archivo se carga automáticamente antes de cualquier script PHP en el directorio PQR.

---

## 🚀 Opción 1: Usar PHP 7.4 (Recomendado para osTicket)

Si los errores persisten, la mejor solución es cambiar la versión de PHP solo para el sistema PQR:

### Pasos:

1. **Verificar versiones de PHP disponibles en Laragon**
   - Abre Laragon
   - Click derecho en el icono de Laragon → PHP → Version
   - Verifica si tienes PHP 7.4 instalado

2. **Si NO tienes PHP 7.4:**
   - Descarga PHP 7.4: https://windows.php.net/download/
   - Extrae en: `C:\laragon\bin\php\php-7.4.x`
   - Reinicia Laragon

3. **Cambiar PHP solo para PQR** (Opción A)
   Agrega esto al `.htaccess` del PQR:
   ```apache
   <IfModule mod_php7.c>
       php_value auto_prepend_file "suppress_errors.php"
   </IfModule>
   ```

4. **O cambiar PHP globalmente en Laragon** (Opción B)
   - Click derecho en Laragon
   - PHP → Version → 7.4.x
   - Start All

---

## 🔄 Opción 2: Actualizar osTicket (Más Complejo)

Si quieres mantener PHP 8.x:

1. **Descargar la última versión de osTicket**
   - Visita: https://osticket.com/download/
   - Descarga la versión más reciente (compatible con PHP 8.x)

2. **Hacer backup de la base de datos actual**
   ```bash
   # En phpMyAdmin o desde línea de comandos
   mysqldump -u root -p nombre_base_datos > backup_pqr.sql
   ```

3. **Reemplazar archivos**
   - Backup de la carpeta actual: `C:\laragon\www\proditel\pqr\upload\`
   - Copiar nueva versión de osTicket
   - Restaurar archivo de configuración: `ost-config.php`

---

## 🎯 Opción 3: Ocultar Errores (Ya Aplicada)

Esta es la solución más rápida pero NO resuelve los problemas de compatibilidad subyacentes:

### Archivos modificados:
1. `.htaccess` - Configuración de Apache
2. `suppress_errors.php` - Supresión de errores PHP

### Para verificar:
1. Cierra completamente tu navegador
2. Abre Laragon → Stop All → Start All
3. Abre el navegador en modo incógnito
4. Visita: `http://localhost/proditel/pqr/upload/`

---

## 🧪 Verificar la Versión de PHP Actual

Crea un archivo para verificar la versión:

1. Crea: `C:\laragon\www\proditel\info.php`
2. Contenido:
   ```php
   <?php
   phpinfo();
   ?>
   ```
3. Abre: `http://localhost/proditel/info.php`
4. Busca "PHP Version" en la parte superior

---

## 📝 Configuración Recomendada

### Para Desarrollo:
- **PHP 8.2 o 8.3** para el sitio principal
- **PHP 7.4** solo para el directorio PQR (osTicket)

### Cómo configurar versiones diferentes:
En Laragon no es fácil tener dos versiones simultáneas, pero puedes:

1. **Opción A**: Usar PHP 7.4 globalmente (más compatible)
2. **Opción B**: Actualizar osTicket a la última versión
3. **Opción C**: Suprimir los errores (ya hecho)

---

## ⚙️ Si necesitas cambiar la versión de PHP:

### En Laragon:
1. Click derecho en el icono de Laragon
2. PHP → Version → Selecciona 7.4
3. Menu → Apache → Reload
4. Reinicia todos los servicios

---

## 🔍 Diagnóstico Adicional

Si después de aplicar estos cambios sigues viendo errores:

1. **Limpiar caché del navegador**
   - Ctrl + Shift + Delete
   - Borrar todo
   - O usar modo incógnito

2. **Reiniciar Laragon**
   ```
   Laragon → Stop All
   Esperar 5 segundos
   Laragon → Start All
   ```

3. **Verificar permisos de archivos**
   - El archivo `.htaccess` debe ser legible
   - El archivo `suppress_errors.php` debe existir

4. **Verificar que Apache lee el .htaccess**
   - Laragon → Apache → httpd.conf
   - Buscar: `AllowOverride All`
   - Si dice `AllowOverride None`, cámbialo a `All`

---

## 📞 Contacto de Soporte osTicket

Si necesitas ayuda oficial:
- Documentación: https://docs.osticket.com/
- Foro: https://forum.osticket.com/
- GitHub: https://github.com/osTicket/osTicket

---

## ✨ Resumen

**Problema**: osTicket antiguo vs PHP 8.x nuevo
**Solución Inmediata**: Errores suprimidos con `.htaccess`
**Solución Permanente**: Actualizar osTicket o usar PHP 7.4

---

**Estado actual**: ✅ Archivos de configuración creados
**Próximo paso**: Reiniciar Laragon y probar el sistema PQR

