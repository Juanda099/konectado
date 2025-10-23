# 🗺️ Google Maps API Key - Problema Resuelto

**Fecha**: 22 de octubre de 2025  
**Problema**: GitHub detectó Google Maps API Key expuesta en `public_html/footer.php`

---

## ⚠️ El Problema

GitHub Secret Scanning encontró:
```
Google API Key detected in public_html/footer.php#L3
Commit: e4b14506
```

La API key estaba expuesta públicamente en:
```javascript
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLsIXyGWmytDNc91Mq2VMfEH9oytRp9Ec&callback=initMap"
```

---

## ✅ Solución Aplicada

### 1. API Key Protegida Localmente
- Creado: `GOOGLE_MAPS_API_KEY.md` con la API key real
- Protegido por `.gitignore` (nunca se subirá a GitHub)

### 2. Archivo footer.php Corregido
- **En GitHub**: Ahora tiene placeholder `TU_GOOGLE_MAPS_API_KEY_AQUI`
- **En local**: Debe tener la API key real para funcionar

### 3. Actualización de .gitignore
Agregado `GOOGLE_MAPS_API_KEY.md` a la lista de archivos protegidos.

---

## 📋 Estado Actual

### ✅ En GitHub (commit 5362c7d):
```javascript
// footer.php - LÍNEA 3 (con placeholder)
<script src="https://maps.googleapis.com/maps/api/js?key=TU_GOOGLE_MAPS_API_KEY_AQUI&callback=initMap"></script>
```

### 🔧 En Laragon (NECESITA ACTUALIZACIÓN):
**ACCIÓN REQUERIDA**: Copiar el archivo corregido del proyecto a Laragon.

---

## 🚀 Pasos para Actualizar Laragon

### Opción 1: Copiar Manualmente

1. **Abre el archivo del proyecto**:
   ```
   C:\Users\juand\Desktop\Proyecto\public_html\footer.php
   ```

2. **Encuentra la línea 3** (aproximadamente):
   ```javascript
   <script src="https://maps.googleapis.com/maps/api/js?key=TU_GOOGLE_MAPS_API_KEY_AQUI&callback=initMap"></script>
   ```

3. **Reemplaza el placeholder** con la API key real:
   ```javascript
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLsIXyGWmytDNc91Mq2VMfEH9oytRp9Ec&callback=initMap"></script>
   ```

4. **Copia el archivo** a Laragon:
   - Desde: `C:\Users\juand\Desktop\Proyecto\public_html\footer.php`
   - Hasta: `C:\laragon\www\proditel\public_html\footer.php`

### Opción 2: Usar PowerShell (RECOMENDADO)

```powershell
# 1. Ir a la carpeta del proyecto
cd "C:\Users\juand\Desktop\Proyecto"

# 2. Copiar el archivo
Copy-Item "public_html\footer.php" "C:\laragon\www\proditel\public_html\footer.php" -Force

# 3. Editar el archivo en Laragon para agregar la API key real
# (Abrir C:\laragon\www\proditel\public_html\footer.php y reemplazar el placeholder)
```

---

## 🔒 Para Producción (Hosting)

Cuando subas a **co.cloud**, el archivo `footer.php` necesita la API key real:

1. **Descarga desde GitHub**: `public_html/footer.php` (tiene placeholder)

2. **Edita la línea 3**, cambia:
   ```javascript
   key=TU_GOOGLE_MAPS_API_KEY_AQUI
   ```
   
   Por:
   ```javascript
   key=AIzaSyBLsIXyGWmytDNc91Mq2VMfEH9oytRp9Ec
   ```

3. **Sube el archivo** a tu hosting en: `/public_html/footer.php`

---

## 🛡️ Recomendaciones de Seguridad para Google Maps

### Restringir la API Key en Google Cloud Console

1. **Ve a**: https://console.cloud.google.com/apis/credentials

2. **Encuentra tu API key**: AIzaSyBLsIXyGWmytDNc91Mq2VMfEH9oytRp9Ec

3. **Configura Restricciones de Aplicación**:
   - Tipo: **Referentes HTTP (sitios web)**
   - Dominios permitidos:
     ```
     *.proditelsas.com/*
     *.co.cloud/*
     localhost/*
     ```

4. **Configura Restricciones de API**:
   - Selecciona solo: **Maps JavaScript API**
   - Desactiva todas las demás APIs

5. **Guarda los cambios**

Con estas restricciones, aunque la API key esté visible en el código del sitio web, solo funcionará en tus dominios autorizados.

---

## 📊 Resumen de Archivos

| Archivo | Ubicación | Estado | API Key |
|---------|-----------|--------|---------|
| `GOOGLE_MAPS_API_KEY.md` | Proyecto (protegido .gitignore) | ✅ Local | Real |
| `footer.php` | GitHub | ✅ Seguro | Placeholder |
| `footer.php` | Laragon | ⚠️ Actualizar | Real (manual) |
| `footer.php` | Producción | ⏳ Pendiente | Real (manual) |

---

## ✅ Checklist Final

- [x] API key removida de GitHub
- [x] Archivo `GOOGLE_MAPS_API_KEY.md` creado y protegido
- [x] `.gitignore` actualizado
- [x] Commit de seguridad subido (5362c7d)
- [ ] **Actualizar footer.php en Laragon con API key real**
- [ ] Configurar restricciones en Google Cloud Console
- [ ] Al desplegar en producción, agregar API key manualmente

---

## 🆘 Si Necesitas Regenerar la API Key

Si crees que la API key fue comprometida (muy expuesta mucho tiempo):

1. **Ve a**: https://console.cloud.google.com/apis/credentials
2. **Elimina la API key actual**
3. **Crea una nueva API key**
4. **Actualiza** `GOOGLE_MAPS_API_KEY.md` con la nueva
5. **Actualiza** `footer.php` en Laragon y producción
6. **Configura restricciones** inmediatamente

---

**🎯 Próximos pasos**: 
1. Actualizar footer.php en Laragon
2. Probar el mapa en localhost
3. Configurar restricciones en Google Cloud Console
