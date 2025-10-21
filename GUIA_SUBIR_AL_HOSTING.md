# 📤 GUÍA COMPLETA: SUBIR SITIO AL HOSTING CO.CLOUD

## 🎯 CONTEXTO
Has modificado localmente el sitio de **Proditel** → **Konectando Internet Rural**
Ahora necesitas subir estos cambios al hosting en **co.cloud** para que estén en producción.

---

## 📋 ARCHIVOS QUE DEBES SUBIR

### ✅ Archivos PHP Modificados (14 archivos):
```
public_html/index.php
public_html/header.php
public_html/footer.php
public_html/navbar.php
public_html/contactenos.php
public_html/residenciales.php
public_html/corporativo.php
public_html/caracteristicas.php
public_html/procedimientos.php
public_html/medidor.php
public_html/control.php
public_html/factores.php
public_html/informacion_crc.php
public_html/suspencion.php
```

### ✅ Archivos CSS Modificados:
```
public_html/css/navbar.css
```

### ✅ Archivos de Imagen:
```
public_html/img/logo_konet.png
```

---

## 🚀 MÉTODO 1: USANDO cPANEL (RECOMENDADO)

### Paso 1: Acceder al cPanel
1. Ve a tu panel de control de **co.cloud**
2. URL típica: `https://tudominio.com:2083` o `https://cp.co.cloud`
3. Ingresa tu usuario y contraseña del hosting

### Paso 2: Abrir el Administrador de Archivos
1. Dentro de cPanel, busca **"Administrador de archivos"** o **"File Manager"**
2. Haz clic para abrirlo
3. Navega hasta la carpeta `public_html/` (es donde está tu sitio web público)

### Paso 3: Hacer RESPALDO antes de subir (MUY IMPORTANTE)
1. En el File Manager, selecciona toda la carpeta `public_html/`
2. Haz clic en **"Comprimir"** o **"Compress"**
3. Selecciona formato `.zip`
4. Nómbralo: `backup_proditel_ANTES_20oct2025.zip`
5. Haz clic en **"Descargar"** para guardarlo en tu PC
6. **GUARDA ESTE BACKUP** por si algo sale mal

### Paso 4: Subir los Archivos Modificados
#### Opción A - Subir archivo por archivo (más seguro):
1. En el File Manager, navega a `public_html/`
2. Haz clic en **"Cargar"** o **"Upload"**
3. Selecciona los archivos PHP modificados uno por uno
4. El sistema te preguntará si quieres **sobrescribir** → Confirma **SÍ**

#### Opción B - Subir todos de una vez:
1. En tu PC, comprime SOLO los archivos modificados en un `.zip`:
   - Selecciona: index.php, header.php, footer.php, navbar.php, etc.
   - Clic derecho → Enviar a → Carpeta comprimida
   - Nómbralo: `archivos_konectando.zip`
2. En el File Manager, sube este `.zip`
3. Selecciona el archivo subido → **"Extraer"** o **"Extract"**
4. Confirma que sobrescriba los archivos existentes

### Paso 5: Subir el Logo
1. Navega a `public_html/img/`
2. Haz clic en **"Cargar"**
3. Selecciona `logo_konet.png` de tu PC
4. Confirma sobrescribir si ya existe

### Paso 6: Verificar Permisos
1. Selecciona cada archivo PHP subido
2. Clic derecho → **"Permisos"** o **"Change Permissions"**
3. Asegúrate que tengan permisos **644** (lectura/escritura para propietario, solo lectura para otros)

### Paso 7: Probar el Sitio
1. Abre tu navegador
2. Ve a: `http://tudominio.com` o `http://proditelsas.com`
3. Verifica que:
   - ✅ Aparece "Konectando Internet Rural" en el título
   - ✅ El logo `logo_konet.png` se muestra correctamente
   - ✅ Teléfono: 314-399-4608
   - ✅ Email: konectandointernetrural@gmail.com
   - ✅ Las 12 veredas aparecen en "Acerca de"
   - ✅ Los 3 planes tienen precios correctos

---

## 🔌 MÉTODO 2: USANDO FTP (FileZilla)

### Paso 1: Obtener Credenciales FTP
1. En cPanel, busca **"Cuentas FTP"** o **"FTP Accounts"**
2. Anota:
   - **Host/Servidor**: ftp.tudominio.com o IP del servidor
   - **Usuario**: tu_usuario_ftp
   - **Contraseña**: tu_contraseña_ftp
   - **Puerto**: 21 (normal) o 22 (SFTP seguro)

### Paso 2: Descargar e Instalar FileZilla
1. Ve a: https://filezilla-project.org/download.php
2. Descarga **FileZilla Client** (gratuito)
3. Instala normalmente

### Paso 3: Conectar al Servidor
1. Abre FileZilla
2. En la parte superior, ingresa:
   - **Host**: ftp.tudominio.com
   - **Usuario**: tu_usuario_ftp
   - **Contraseña**: tu_contraseña_ftp
   - **Puerto**: 21
3. Haz clic en **"Conexión rápida"**
4. Si aparece advertencia de certificado → **"Aceptar"**

### Paso 4: Hacer RESPALDO (MUY IMPORTANTE)
1. Panel derecho de FileZilla = Servidor remoto
2. Navega a `/public_html/`
3. Selecciona TODA la carpeta `public_html`
4. Clic derecho → **"Descargar"**
5. Guárdala en: `C:\Users\juand\Desktop\BACKUP_HOSTING_20oct2025\`
6. Espera que termine de descargar TODO

### Paso 5: Subir Archivos Modificados
1. Panel izquierdo = Tu PC
2. Navega a: `C:\Users\juand\Desktop\Proyecto\public_html\`
3. Panel derecho = Servidor
4. Navega a: `/public_html/`
5. Selecciona los archivos modificados en el panel izquierdo:
   - index.php, header.php, footer.php, navbar.php, etc.
6. Arrástralos al panel derecho (servidor)
7. Confirma **"Sobrescribir"** cuando pregunte

### Paso 6: Subir CSS y Logo
1. En panel izquierdo: `C:\Users\juand\Desktop\Proyecto\public_html\css\`
2. En panel derecho: `/public_html/css/`
3. Arrastra `navbar.css` → Sobrescribir
4. En panel izquierdo: `C:\Users\juand\Desktop\Proyecto\public_html\img\`
5. En panel derecho: `/public_html/img/`
6. Arrastra `logo_konet.png` → Sobrescribir

### Paso 7: Verificar Transferencia
1. En FileZilla, revisa la pestaña **"Transferencias exitosas"**
2. Asegúrate que todos los archivos se subieron sin errores

### Paso 8: Probar el Sitio
1. Abre navegador
2. Ve a tu dominio
3. **CTRL + F5** para forzar recarga sin caché
4. Verifica todos los cambios

---

## ⚠️ CONSIDERACIONES IMPORTANTES

### 🗄️ Base de Datos PQR (osTicket)
**NO subas la carpeta `/pqr/` local al hosting**, porque:
- El hosting ya tiene su propia base de datos PQR configurada
- Si subes la carpeta local, romperás la conexión a la base de datos del hosting
- Los tickets existentes están en la base de datos del hosting, no en tu PC

**Lo que SÍ debes hacer:**
1. En el hosting, verifica que la base de datos `pqr` exista
2. Si el PQR no funciona en el hosting, necesitas:
   - Acceder a phpMyAdmin del hosting
   - Verificar que exista la base de datos `pqr`
   - Verificar las credenciales en `/pqr/upload/include/ost-config.php` del hosting

### 🔐 Archivos que NO debes subir:
```
❌ proditel/ (carpeta completa de Laragon)
❌ pqr/ (puede tener config local diferente)
❌ info.php (es para pruebas locales)
❌ GUIAS_*.md (documentación local)
❌ sincronizar-con-laragon.bat (script local)
❌ application_backups/ (backups locales)
```

### 📁 Estructura en el Hosting:
Tu hosting **co.cloud** probablemente tiene esta estructura:
```
/home/tuusuario/
  ├── public_html/          ← Aquí subes los archivos
  │   ├── index.php
  │   ├── header.php
  │   ├── css/
  │   ├── img/
  │   └── pqr/              ← YA EXISTE en el hosting, NO sobrescribir
  └── databases/
      └── pqr               ← Base de datos en el servidor
```

---

## 🧪 CHECKLIST FINAL ANTES DE SUBIR

- [ ] ✅ Hice backup del hosting completo
- [ ] ✅ Revisé que `logo_konet.png` existe en mi carpeta local
- [ ] ✅ Verifiqué que todos los archivos PHP tienen "Konectando Internet Rural"
- [ ] ✅ Probé localmente en Laragon que todo funciona
- [ ] ✅ Tengo las credenciales de cPanel o FTP
- [ ] ✅ Sé cuál es mi dominio web

---

## 📞 CREDENCIALES QUE NECESITAS

**Para acceder al hosting co.cloud:**
- URL del cPanel: _______________________
- Usuario: _______________________
- Contraseña: _______________________

**Dominio del sitio:**
- http://________________________________

**Credenciales FTP (si usas FileZilla):**
- Host FTP: _______________________
- Usuario FTP: _______________________
- Contraseña FTP: _______________________
- Puerto: 21 o 22

---

## 🆘 SOLUCIÓN DE PROBLEMAS

### Problema 1: "No puedo acceder al cPanel"
**Solución:**
- Busca en tu correo el email de bienvenida de **co.cloud**
- Debe tener la URL del cPanel y credenciales
- Si no lo encuentras, contacta soporte de co.cloud

### Problema 2: "Los cambios no se ven"
**Solución:**
1. Limpia caché del navegador: **CTRL + SHIFT + DELETE**
2. Recarga forzado: **CTRL + F5**
3. Verifica que subiste al directorio correcto (`public_html/`)
4. Revisa permisos de archivos (deben ser 644)

### Problema 3: "Error 500 después de subir"
**Solución:**
1. Revisa permisos de archivos (644 para archivos, 755 para carpetas)
2. Verifica que no hayas subido archivos locales con rutas de Windows
3. Revisa el archivo `.htaccess` si existe

### Problema 4: "El logo no aparece"
**Solución:**
1. Verifica que `logo_konet.png` esté en `/public_html/img/`
2. Revisa que el nombre sea exacto (minúsculas)
3. Permisos del archivo deben ser 644

### Problema 5: "PQR no funciona"
**Solución:**
1. **NO subas la carpeta `/pqr/` local**
2. La carpeta PQR del hosting usa su propia base de datos
3. Si hay error, contacta soporte para verificar base de datos

---

## 📝 NOTAS ADICIONALES

### Tiempo estimado: 15-30 minutos
### Dificultad: Fácil-Media
### Método recomendado: cPanel (más visual y seguro)
### Método alternativo: FTP FileZilla (más control)

---

## ✅ DESPUÉS DE SUBIR

1. **Prueba TODO el sitio:**
   - Página principal
   - Planes residenciales
   - Planes corporativos
   - Contacto
   - Todas las páginas del menú

2. **Verifica en móvil:**
   - Abre el sitio desde tu celular
   - Revisa que el logo se vea bien
   - Verifica que sea responsive

3. **Comparte el enlace:**
   - Prueba desde otra conexión (datos móviles)
   - Pide a alguien más que lo revise

4. **Documenta:**
   - Anota la fecha de actualización
   - Guarda el backup que descargaste

---

## 🎉 ¡LISTO!

Una vez que hayas seguido estos pasos, tu sitio **Konectando Internet Rural** estará en producción en el hosting **co.cloud**.

**¿Necesitas ayuda con algún paso específico?**
¡Pregúntame y te guío!

---

**Fecha de creación de esta guía:** 20 de octubre de 2025
**Creado para:** Konectando Internet Rural - Migración Proditel
