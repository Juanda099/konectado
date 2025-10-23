# INSTRUCCIONES PARA CORREGIR LA CODIFICACIÓN

## El Problema
Los archivos PHP fueron guardados con codificación incorrecta, por eso los caracteres especiales (tildes, ñ, emojis) se ven mal.

## Solución Manual (Recomendada)

### Opción 1: Usando VS Code
1. Abre VS Code
2. File → Open Folder → C:\laragon\www\proditel\pqr\upload
3. Abre el archivo: reporte-seguridad-simple.php
4. En la barra inferior derecha, haz clic donde dice la codificación actual
5. Selecciona "Save with Encoding"
6. Elige "UTF-8"
7. Guarda el archivo (Ctrl+S)
8. Repite para todos los archivos PHP

### Opción 2: Usando Notepad++
1. Abre Notepad++
2. File → Open → reporte-seguridad-simple.php
3. Encoding → Convert to UTF-8 (without BOM)
4. File → Save
5. Repite para todos los archivos

### Opción 3: Recrear el archivo
1. Elimina: C:\laragon\www\proditel\pqr\upload\reporte-seguridad-simple.php
2. Crea un nuevo archivo con el mismo nombre
3. Copia el código de: C:\Users\juand\Desktop\Proyecto\CODIGO_REPORTE_SEGURIDAD.txt
4. Pega en el nuevo archivo
5. Guarda con codificación UTF-8

## Archivos afectados
- reporte-seguridad-simple.php
- reporte-incidente.php  
- crear-ticket-simple.php
- consultar-ticket.php
- ver-ticket.php
- portal-pqr.php
- panel-admin.php
- login-simple.php

## Verificar que funcionó
1. Abre: http://localhost/proditel/pqr/upload/test-utf8.php
2. Deberías ver correctamente:
   - ⚠️ (emoji de advertencia)
   - á, é, í, ó, ú (tildes)
   - ñ, Ñ (eñes)
   - ¿, ¡ (signos de interrogación/exclamación)

## Para Producción
Cuando subas los archivos a tu hosting:
- USA FileZilla o el FTP del hosting
- MARCA la opción "Transfer Type: Binary" o "Auto"
- NO uses editores del hosting que puedan cambiar la codificación
- Si necesitas editar en producción, usa el editor del hosting que soporte UTF-8

## Nota Importante
Windows PowerShell y algunos comandos de consola NO manejan bien UTF-8.
Por eso el script automático no funcionó.
La solución manual con VS Code o Notepad++ es más confiable.
