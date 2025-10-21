# 🚀 Guía Completa: Instalar PHP 7.4 en Laragon

## 📥 PASO 1: Descargar PHP 7.4

### Opción A: Desde el sitio oficial de PHP

1. **Abre tu navegador**
2. **Ve a**: https://windows.php.net/downloads/releases/archives/
3. **Busca**: `php-7.4.33` (la última versión de PHP 7.4)
4. **Descarga**: `php-7.4.33-Win32-vc15-x64.zip`
   - ⚠️ **IMPORTANTE**: Descarga la versión **x64** (64 bits)
   - ⚠️ **IMPORTANTE**: Descarga **Thread Safe** (VC15)

### Opción B: Descarga directa (más rápido)

**Link directo:**
```
https://windows.php.net/downloads/releases/archives/php-7.4.33-Win32-vc15-x64.zip
```

---

## 📂 PASO 2: Extraer PHP 7.4 en Laragon

1. **Una vez descargado el archivo** `php-7.4.33-Win32-vc15-x64.zip`

2. **Extrae el archivo ZIP** (clic derecho → Extraer todo)

3. **Copia la carpeta extraída** y pégala en:
   ```
   C:\laragon\bin\php\
   ```

4. **Renombra la carpeta** a algo simple como:
   ```
   C:\laragon\bin\php\php-7.4.33
   ```

### Estructura final debe verse así:
```
C:\laragon\bin\php\
├── php-7.4.33\          ← Nueva carpeta
│   ├── php.exe
│   ├── php.ini-development
│   ├── php.ini-production
│   └── ext\
└── php-8.x.x\           ← La versión anterior
```

---

## ⚙️ PASO 3: Configurar PHP 7.4 en Laragon

### 3.1 Cambiar la versión de PHP

1. **Abre Laragon**
2. **Click derecho en el icono de Laragon** (en la bandeja del sistema)
3. **PHP → Version → php-7.4.33**
   
   Si NO aparece en el menú:
   - Cierra Laragon completamente
   - Vuelve a abrirlo
   - Debería detectar automáticamente la nueva versión

### 3.2 Crear archivo php.ini

1. **Ve a**: `C:\laragon\bin\php\php-7.4.33\`
2. **Copia el archivo**: `php.ini-development`
3. **Pégalo en la misma carpeta**
4. **Renómbralo a**: `php.ini`

---

## 🔧 PASO 4: Configurar php.ini para tu proyecto

Abre el archivo `C:\laragon\bin\php\php-7.4.33\php.ini` con un editor de texto y modifica:

### 4.1 Busca estas líneas y cámbialas:

```ini
; Cambiar esto:
;extension=mysqli
; Por esto:
extension=mysqli

; Cambiar esto:
;extension=pdo_mysql
; Por esto:
extension=pdo_mysql

; Cambiar esto:
;extension=mbstring
; Por esto:
extension=mbstring

; Cambiar esto:
;extension=curl
; Por esto:
extension=curl

; Cambiar esto:
;extension=openssl
; Por esto:
extension=openssl

; Cambiar esto:
;extension=gd
; Por esto:
extension=gd
```

**Tip**: Usa Ctrl+F para buscar cada extensión

### 4.2 Configurar timezone

Busca:
```ini
;date.timezone =
```

Cámbialo a:
```ini
date.timezone = America/Bogota
```

### 4.3 Configurar límites (opcional pero recomendado)

```ini
max_execution_time = 300
max_input_time = 300
memory_limit = 256M
post_max_size = 100M
upload_max_filesize = 100M
```

---

## 🔄 PASO 5: Reiniciar Laragon

1. **En Laragon, click en** "Stop All" (botón rojo)
2. **Espera 5 segundos**
3. **Click en** "Start All" (botón verde)
4. **Espera a que Apache y MySQL se pongan en verde** ✅

---

## ✅ PASO 6: Verificar que PHP 7.4 está activo

### Opción 1: Desde el navegador

1. **Crea un archivo** `info.php` en: `C:\laragon\www\proditel\`
2. **Contenido**:
   ```php
   <?php
   phpinfo();
   ?>
   ```
3. **Abre en el navegador**: http://localhost/proditel/info.php
4. **Verifica**: En la primera línea debe decir "PHP Version 7.4.33"

### Opción 2: Desde Laragon

1. **Click derecho en Laragon**
2. **PHP → Quick app → PHP Info**
3. **Se abrirá una página** mostrando la versión de PHP

---

## 🎯 PASO 7: Probar el sistema PQR

1. **Ve a**: http://localhost/proditel/pqr/upload/
2. **Los errores deberían haber desaparecido** ✅
3. **El sistema debería funcionar normalmente**

---

## 🔍 Solución de Problemas

### ❌ Problema: "PHP 7.4 no aparece en el menú"

**Solución**:
1. Verifica que la carpeta esté en: `C:\laragon\bin\php\php-7.4.33\`
2. Verifica que dentro haya un archivo `php.exe`
3. Reinicia Laragon completamente (cerrar y abrir)

### ❌ Problema: "Apache no inicia con PHP 7.4"

**Solución**:
1. Ve a: `C:\laragon\bin\php\php-7.4.33\`
2. Asegúrate de tener el archivo `php.ini` (no `php.ini-development`)
3. Verifica que las extensiones estén descomentadas (sin `;` al inicio)

### ❌ Problema: "Extensiones no cargan"

**Solución**:
1. Abre `php.ini`
2. Busca: `extension_dir`
3. Asegúrate que diga: `extension_dir = "ext"`

---

## 📝 Notas Importantes

### ✅ Ventajas de PHP 7.4:
- Compatible con osTicket (sistema PQR)
- Más estable para aplicaciones legacy
- Sin warnings de deprecación

### ⚠️ Consideraciones:
- PHP 7.4 ya no recibe actualizaciones de seguridad (EOL desde nov 2022)
- Solo para desarrollo local, NO para producción real
- Si llevas el proyecto a producción, considera actualizar osTicket

---

## 🎉 RESUMEN RÁPIDO

```bash
1. Descargar: php-7.4.33-Win32-vc15-x64.zip
2. Extraer en: C:\laragon\bin\php\php-7.4.33\
3. Copiar: php.ini-development → php.ini
4. Editar: php.ini (habilitar extensiones)
5. Laragon: PHP → Version → php-7.4.33
6. Laragon: Stop All → Start All
7. Verificar: http://localhost/proditel/info.php
8. Probar: http://localhost/proditel/pqr/upload/
```

---

## 📞 ¿Necesitas ayuda?

Si algo no funciona, dime en qué paso te quedaste y te ayudo a resolverlo.

---

**Estado**: 📝 Guía lista para usar
**Siguiente**: Descargar PHP 7.4 y seguir los pasos

