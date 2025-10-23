# 🚀 RESUMEN: Subir Sistema PQR a Producción

## ✅ Lo que ya está listo:

1. **Base de datos exportada:** `pqr_database.sql` (215 KB)
2. **Código funcional** en GitHub: `Juanda099/konectado`
3. **Sistema probado** localmente y funcionando al 100%

---

## 📧 RESPUESTA A TUS PREGUNTAS:

### 1️⃣ ¿Dónde está la base de datos?

**Respuesta:** La base de datos está en:
- **Local:** MySQL en Laragon (localhost:3306)
- **Exportada a:** `C:\Users\juand\Desktop\Proyecto\pqr_database.sql`

**Para subirla a producción:**
```
1. Ve a tu panel de CO.CLOUD (cPanel)
2. Abre phpMyAdmin
3. Crea nueva base de datos "pqr"
4. Importa el archivo: pqr_database.sql
5. Anota las credenciales (usuario, password, nombre DB)
```

### 2️⃣ ¿Necesito crear nueva API de SendGrid?

**Respuesta: SÍ, es OBLIGATORIO**

**Por qué:**
- La API actual está configurada con: `juandavidramirezcalderon@gmail.com`
- Tu email de empresa es: `konectandointernetrural@gmail.com`
- SendGrid requiere que el remitente esté verificado
- No puedes enviar desde un email diferente al verificado

**Pasos para nueva API:**

1. **Crear cuenta SendGrid nueva:**
   - Web: https://sendgrid.com/
   - Email: `konectandointernetrural@gmail.com`
   - Plan Free (100 emails/día gratis)

2. **Verificar el email:**
   - SendGrid enviará email de verificación
   - Click en el link del email

3. **Crear API Key:**
   - Settings > API Keys
   - "Create API Key"
   - Nombre: `Konectando_Production`
   - Permiso: Full Access
   - **COPIAR LA KEY** (se muestra solo una vez)

4. **Actualizar en el servidor:**
   - Archivo: `pqr/upload/includes/email-config.php`
   - Cambiar: `SENDGRID_API_KEY`
   - Cambiar: `FROM_EMAIL` a `konectandointernetrural@gmail.com`

---

## 🔄 PROCESO COMPLETO PASO A PASO:

### FASE 1: Preparar Archivos (EN LOCAL - ANTES DE SUBIR)

```powershell
# 1. Actualizar email-config.php con nueva API Key de SendGrid
# (Después de crearla en SendGrid)

# 2. Opcional: Actualizar credenciales DB en archivos PHP
# (Puedes hacerlo después en el servidor directamente)
```

### FASE 2: Subir a GitHub

```bash
git add .
git commit -m "Sistema PQR v1.0 - Producción ready"
git push origin main
```

### FASE 3: En CO.CLOUD Hosting

**A. Base de Datos:**
```
1. cPanel > phpMyAdmin
2. Crear DB nueva: "konectando_pqr" (o nombre permitido)
3. Crear usuario: "konectando_user" + password seguro
4. Asignar permisos: TODOS en la DB
5. Importar: pqr_database.sql
6. Ejecutar: configuracion_produccion.sql (opcional)
```

**B. Archivos:**
```
Opción 1 - GitHub (si CO.CLOUD lo soporta):
  - Panel > Git Deployment
  - Conectar: Juanda099/konectado
  - Deploy

Opción 2 - FTP/FileManager:
  - Comprimir carpeta proyecto
  - Subir vía FTP o FileManager
  - Descomprimir en public_html/
```

**C. Configurar Credenciales:**
```
Editar estos archivos en el servidor con credenciales reales:

8 archivos PHP con conexión mysqli:
  1. pqr/upload/crear-ticket-simple.php
  2. pqr/upload/consultar-ticket.php
  3. pqr/upload/ver-ticket.php
  4. pqr/upload/login-simple.php
  5. pqr/upload/panel-admin.php
  6. pqr/upload/reporte-incidente.php
  7. pqr/upload/reporte-seguridad-simple.php
  8. pqr/upload/includes/simple-email-notifier.php

Cambiar:
  new mysqli('localhost', 'root', 'admin123', 'pqr')
Por:
  new mysqli('localhost', 'konectando_user', 'tu_password', 'konectando_pqr')
```

**D. Configurar Emails:**
```
Editar: pqr/upload/includes/email-config.php

Cambiar:
  - SENDGRID_API_KEY (nueva key)
  - FROM_EMAIL (konectandointernetrural@gmail.com)
  - SYSTEM_URL (tu dominio real)
  - TICKET_VIEW_URL (tu dominio real + ruta)
  - ADMIN_VIEW_URL (tu dominio real + ruta)
```

**E. Seguridad:**
```
1. Cambiar contraseña admin:
   phpMyAdmin > ost_staff > 
   UPDATE passwd = MD5('nueva_password_segura') WHERE username='admin'

2. Eliminar archivos de prueba:
   - test-*.php
   - debug-*.php
   - diagnostico.php

3. Permisos:
   chmod 755 carpetas
   chmod 644 archivos .php
   chmod 777 pqr/upload/ost-attachments/
```

### FASE 4: Testing

```
✅ Login admin: https://tudominio.co.cloud/pqr/upload/login-simple.php
✅ Portal PQR: https://tudominio.co.cloud/pqr/upload/portal-pqr.php
✅ Crear ticket de prueba
✅ Verificar email llegó
✅ Responder desde admin
✅ Verificar email de respuesta
```

---

## 📦 ARCHIVOS IMPORTANTES:

| Archivo | Descripción |
|---------|-------------|
| `pqr_database.sql` | Base de datos completa |
| `configuracion_produccion.sql` | Configuraciones post-import |
| `INSTRUCCIONES_PRODUCCION.md` | Guía detallada completa |
| `ACTUALIZAR_CREDENCIALES.md` | Lista de archivos a editar |
| Este archivo | Resumen ejecutivo |

---

## ⏱️ TIEMPO ESTIMADO:

- SendGrid nueva cuenta: **10 minutos**
- Subir a GitHub: **2 minutos**
- Crear DB e importar: **5 minutos**
- Actualizar credenciales: **15 minutos**
- Testing: **10 minutos**

**TOTAL: ~45 minutos**

---

## 🆘 SI ALGO FALLA:

1. **Emails no llegan:**
   - Verifica API Key correcta
   - Confirma email verificado en SendGrid
   - Revisa spam

2. **Error de DB:**
   - Confirma usuario/password correctos
   - Verifica permisos del usuario en la DB

3. **Error 500:**
   - Revisa permisos de archivos/carpetas
   - Activa display_errors en php.ini para ver error

---

## 📞 CHECKLIST FINAL:

Antes de marcar como "LISTO":

- [ ] SendGrid: Cuenta creada con konectandointernetrural@gmail.com
- [ ] SendGrid: Email verificado ✅
- [ ] SendGrid: API Key generada y copiada
- [ ] Base de datos importada en hosting
- [ ] Credenciales DB actualizadas en 8 archivos
- [ ] email-config.php actualizado con nueva API Key
- [ ] URLs actualizadas con dominio real
- [ ] Contraseña admin cambiada
- [ ] Archivos test eliminados
- [ ] Login admin funciona
- [ ] Crear ticket funciona
- [ ] Emails llegan correctamente
- [ ] Panel admin funciona al 100%

---

**¡TODO LISTO PARA PRODUCCIÓN! 🚀**

Los archivos están en: `C:\Users\juand\Desktop\Proyecto\`
