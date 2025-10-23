# 🔄 GUÍA DE SINCRONIZACIÓN: PROYECTO ↔ LARAGON

## 📌 IMPORTANTE: Entender el flujo

### ❓ ¿Dónde trabajo?
- **Editas archivos**: En `C:\Users\juand\Desktop\Proyecto\` (VS Code)
- **Pruebas en navegador**: En `C:\laragon\www\proditel\` (Laragon)

### ❓ ¿Por qué necesito sincronizar?
- **Laragon** solo lee archivos de su propia carpeta (`C:\laragon\www\`)
- **GitHub** solo lee archivos de tu proyecto (`C:\Users\juand\Desktop\Proyecto\`)
- **No están conectados automáticamente** → Debes sincronizar manualmente

---

## 🎯 ESCENARIO 1: Hacer modificaciones y probarlas

### Pasos:

1. **Editar archivo en VS Code**
   ```
   📂 C:\Users\juand\Desktop\Proyecto\public_html\pqr\upload\portal-pqr.php
   ```
   - Haces cambios
   - Guardas (Ctrl + S)

2. **Copiar a Laragon** (para ver en localhost)
   - **Opción A - Script automático:**
     ```
     Doble clic en: SINCRONIZAR-A-LARAGON.bat
     ```
   
   - **Opción B - Manual PowerShell:**
     ```powershell
     Copy-Item "C:\Users\juand\Desktop\Proyecto\public_html\pqr\upload\portal-pqr.php" "C:\laragon\www\proditel\pqr\upload\" -Force
     ```

3. **Ver en navegador**
   ```
   http://localhost/proditel/pqr/upload/portal-pqr.php
   ```
   - Presiona **Ctrl + F5** para limpiar caché
   - Ves tus cambios

4. **Si te gusta** → Continúa al Escenario 3
   **Si NO te gusta** → Modifica de nuevo y repite desde paso 1

---

## 🎯 ESCENARIO 2: Guardar cambios que hiciste en Laragon

### Cuándo usar:
- Si editaste directamente en `C:\laragon\www\proditel\`
- Quieres guardar esos cambios en tu proyecto para GitHub

### Pasos:

1. **Copiar de Laragon a Proyecto**
   - **Opción A - Script automático:**
     ```
     Doble clic en: GUARDAR-DE-LARAGON.bat
     ```
   
   - **Opción B - Manual PowerShell:**
     ```powershell
     Copy-Item "C:\laragon\www\proditel\pqr\upload\portal-pqr.php" "C:\Users\juand\Desktop\Proyecto\public_html\pqr\upload\" -Force
     ```

2. **Verificar en VS Code**
   - Abre el archivo en VS Code
   - Verifica que los cambios estén ahí

3. **Continúa al Escenario 3** (subir a GitHub)

---

## 🎯 ESCENARIO 3: Subir cambios a GitHub

### Cuándo usar:
- Ya probaste todo en localhost
- Todo funciona correctamente
- Quieres guardar en GitHub para producción

### Pasos:

1. **Abrir terminal en proyecto**
   ```powershell
   cd C:\Users\juand\Desktop\Proyecto
   ```

2. **Ver qué cambió**
   ```bash
   git status
   ```

3. **Agregar archivos**
   ```bash
   git add .
   ```
   O específico:
   ```bash
   git add public_html/pqr/upload/portal-pqr.php
   ```

4. **Crear commit**
   ```bash
   git commit -m "Descripción de tus cambios"
   ```
   Ejemplo:
   ```bash
   git commit -m "Mejorado diseño del portal PQR"
   ```

5. **Subir a GitHub**
   ```bash
   git push origin main
   ```

6. **Verificar en GitHub**
   - Ve a: https://github.com/Juanda099/konectado
   - Verifica que se subió correctamente

---

## 🎯 ESCENARIO 4: Bajar cambios de GitHub a local

### Cuándo usar:
- Trabajaste en otra computadora
- Alguien más hizo cambios
- Quieres la versión más reciente

### Pasos:

1. **Descargar cambios**
   ```bash
   cd C:\Users\juand\Desktop\Proyecto
   git pull origin main
   ```

2. **Sincronizar a Laragon**
   ```
   Doble clic en: SINCRONIZAR-A-LARAGON.bat
   ```

3. **Ver en navegador**
   ```
   http://localhost/proditel/
   ```

---

## 📊 FLUJO COMPLETO (Resumen Visual)

```
┌─────────────────────────────────────────────────────────┐
│  EDITAR                                                 │
│  ------                                                 │
│  📝 VS Code (C:\Users\juand\Desktop\Proyecto)          │
│      ↓                                                  │
│  1. Editas archivo .php                                │
│  2. Guardas (Ctrl+S)                                   │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│  PROBAR                                                 │
│  ------                                                 │
│  🔄 Ejecutar: SINCRONIZAR-A-LARAGON.bat                │
│      ↓                                                  │
│  🌐 Navegador: http://localhost/proditel/              │
│  3. Ver cambios (Ctrl+F5)                              │
│  4. ¿Te gusta? → Continúa                              │
│     ¿No te gusta? → Vuelve a EDITAR                    │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│  GUARDAR EN GITHUB                                      │
│  -----------------                                      │
│  💾 Terminal:                                           │
│  5. git add .                                           │
│  6. git commit -m "Mensaje"                             │
│  7. git push origin main                                │
│      ↓                                                  │
│  ☁️  GitHub actualizado                                 │
└─────────────────────────────────────────────────────────┘
                          ↓
┌─────────────────────────────────────────────────────────┐
│  PRODUCCIÓN                                             │
│  ----------                                             │
│  🚀 Hosting (co.cloud):                                │
│  8. Conectar GitHub con hosting                        │
│  9. Auto-deploy cuando haces push                      │
│  10. Actualizar credenciales de producción             │
└─────────────────────────────────────────────────────────┘
```

---

## ⚡ ATAJOS RÁPIDOS

### Para pruebas rápidas:
1. Edita en VS Code
2. `SINCRONIZAR-A-LARAGON.bat`
3. F5 en navegador

### Para guardar en GitHub:
1. Verifica que todo funciona en localhost
2. `git add .`
3. `git commit -m "Mensaje"`
4. `git push origin main`

---

## 🎯 SCRIPTS DISPONIBLES

### En tu carpeta de proyecto:

1. **`SINCRONIZAR-A-LARAGON.bat`**
   - Copia: Proyecto → Laragon
   - Usar: Antes de probar cambios en localhost

2. **`GUARDAR-DE-LARAGON.bat`**
   - Copia: Laragon → Proyecto
   - Usar: Si editaste directamente en Laragon

3. **`GUIA_SUBIR_A_GITHUB.md`**
   - Instrucciones detalladas para Git

4. **`.gitignore`**
   - Protege tus credenciales automáticamente

---

## ❓ PREGUNTAS FRECUENTES

### ❓ ¿Puedo editar directamente en Laragon?
✅ **SÍ**, pero recuerda ejecutar `GUARDAR-DE-LARAGON.bat` después para copiar al proyecto.

### ❓ ¿Qué pasa si olvido sincronizar?
⚠️ Los cambios en un lado NO se reflejan en el otro automáticamente.

### ❓ ¿Cuál es la mejor práctica?
✅ **Siempre editar en VS Code** (Proyecto), luego sincronizar a Laragon para probar.

### ❓ ¿Puedo automatizar la sincronización?
🔧 Sí, pero por seguridad es mejor manual. Los scripts `.bat` ya lo hacen fácil.

---

## 📝 EJEMPLO PRÁCTICO

**Quiero cambiar el color del portal PQR:**

1. ✏️ Abro en VS Code:
   ```
   C:\Users\juand\Desktop\Proyecto\public_html\pqr\upload\portal-pqr.php
   ```

2. 🎨 Cambio la línea del color:
   ```php
   background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
   ```

3. 💾 Guardo (Ctrl+S)

4. 🔄 Doble clic en `SINCRONIZAR-A-LARAGON.bat`

5. 🌐 Abro navegador: `http://localhost/proditel/pqr/upload/portal-pqr.php`

6. ✅ Me gusta el cambio

7. 📤 Subo a GitHub:
   ```bash
   cd C:\Users\juand\Desktop\Proyecto
   git add public_html/pqr/upload/portal-pqr.php
   git commit -m "Cambio color portal PQR a rojo"
   git push origin main
   ```

8. 🎉 **¡Listo!** Cambio guardado en GitHub

---

**Fecha:** 22 de octubre de 2025  
**Proyecto:** Konectando Internet Rural  
**Repositorio:** github.com/Juanda099/konectado
