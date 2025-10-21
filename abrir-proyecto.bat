@echo off
echo.
echo ========================================
echo   🚀 INICIANDO PRODITEL
echo ========================================
echo.
echo Verificando Laragon...
echo.

REM Verificar si Laragon está corriendo
tasklist /FI "IMAGENAME eq nginx.exe" 2>NUL | find /I /N "nginx.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo ✅ Laragon está corriendo
    echo.
    echo 🌐 Abriendo navegador...
    start http://localhost/proditel/index.php
    echo.
    echo ✅ Proyecto abierto en tu navegador!
) else (
    echo ⚠️  Laragon NO está corriendo
    echo.
    echo Por favor, inicia Laragon primero:
    echo 1. Busca "Laragon" en el menú de inicio
    echo 2. Haz clic en "Start All"
    echo 3. Ejecuta este script de nuevo
    echo.
    pause
)

echo.
pause
