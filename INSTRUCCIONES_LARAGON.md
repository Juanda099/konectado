# 🚀 Cómo usar Laragon con tu proyecto Konet (antes Proditel)

## ✅ INSTALACIÓN COMPLETADA

Tu proyecto está listo en: `C:\laragon\www\proditel`

## ⚠️ IMPORTANTE: UBICACIONES DEL PROYECTO

Tienes **DOS copias** del proyecto:

1. **📂 Backup/Edición**: `C:\Users\juand\Desktop\Proyecto\public_html\`
   - Aquí puedes editar y hacer cambios
   - Los cambios NO se ven en el navegador hasta sincronizar

2. **🌐 Servidor Activo (Laragon)**: `C:\laragon\www\proditel\`
   - Esta es la versión que se ve en el navegador
   - Edita aquí para ver cambios inmediatos

---

## 📝 PASOS PARA EJECUTAR:

### 1. **Iniciar Laragon**
   - Busca "Laragon" en el menú de inicio de Windows
   - Haz clic derecho en el icono de Laragon (es azul)
   - Selecciona **"Iniciar Todo"** o **"Start All"**
   - Espera unos segundos hasta que los servicios estén en verde ✅

### 2. **Abrir tu sitio web**
   Abre tu navegador y ve a:
   ```
   http://localhost/proditel/index.php
   ```
   
   O simplemente:
   ```
   http://localhost/proditel
   ```

---

## 🔧 MODIFICAR EL PROYECTO:

### Opción 1: Editar directamente en Laragon (RECOMENDADO)
Abre la carpeta del proyecto en VS Code:
```
C:\laragon\www\proditel
```
Los cambios se verán inmediatamente al recargar el navegador.

### Opción 2: Editar desde Desktop y sincronizar
Si editas los archivos en:
```
C:\Users\juand\Desktop\Proyecto\public_html\
```

Luego ejecuta el archivo:
```
sincronizar-con-laragon.bat
```
Esto copiará todos tus cambios a Laragon automáticamente.

---

## 🌐 CARACTERÍSTICAS DE LARAGON:

- ✅ **Auto-start**: Laragon detecta automáticamente tus proyectos
- ✅ **Pretty URLs**: Puedes acceder con URLs bonitas
- ✅ **Múltiples proyectos**: Puedes tener varios proyectos al mismo tiempo
- ✅ **Base de datos**: Incluye MySQL/MariaDB si lo necesitas

---

## 🛠️ COMANDOS ÚTILES:

### Ver todos tus proyectos:
En Laragon: Menu → www

### Crear dominio personalizado:
Laragon puede crear automáticamente: `http://proditel.test`
- Click derecho en Laragon → Preferencias → General → Auto virtual hosts

### Acceder a la base de datos (si la necesitas):
- Usuario: `root`
- Contraseña: (vacía, sin contraseña)
- Host: `localhost`

---

## 📂 ESTRUCTURA DE ARCHIVOS:

```
C:\laragon\www\proditel\
├── index.php           ← Página principal
├── contactenos.php     ← Formulario de contacto
├── navbar.php          ← Menú de navegación
├── header.php          ← Encabezado
├── footer.php          ← Pie de página
├── css/                ← Estilos
├── js/                 ← JavaScript
└── img/                ← Imágenes
```

---

## 🔥 PARA MODIFICAR EN TIEMPO REAL:

1. Abre la carpeta en VS Code: `C:\laragon\www\proditel`
2. Edita cualquier archivo
3. Guarda (Ctrl + S)
4. Recarga el navegador (F5) para ver los cambios

---

## ⚠️ PROBLEMAS COMUNES:

### "No se puede conectar"
- Asegúrate de que Laragon esté iniciado (verde)
- Verifica que Apache esté corriendo en Laragon

### "Página en blanco"
- Revisa que la URL sea correcta: `http://localhost/proditel/index.php`

### Cambios no se ven
- Presiona Ctrl + F5 en el navegador (recarga completa)
- Limpia caché del navegador

---

## 🎯 PRÓXIMOS PASOS:

1. ✅ Inicia Laragon
2. ✅ Abre http://localhost/proditel
3. ✅ Comienza a modificar los archivos
4. ✅ ¡Disfruta programando!

---

**¿Necesitas ayuda?** Solo pregúntame y te ayudo con cualquier modificación. 🚀
