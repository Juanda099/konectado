@echo off
echo ================================================
echo   INSTALADOR AUTOMATICO PHP 7.4 PARA LARAGON
echo ================================================
echo.

REM Verificar si existe la carpeta de Laragon
if not exist "C:\laragon\bin\php" (
    echo ERROR: No se encuentra Laragon en C:\laragon
    echo Por favor verifica que Laragon este instalado correctamente.
    pause
    exit
)

echo [1/4] Verificando carpeta de PHP en Laragon...
if exist "C:\laragon\bin\php\php-7.4.33" (
    echo.
    echo ¡PHP 7.4.33 ya esta instalado!
    echo Ubicacion: C:\laragon\bin\php\php-7.4.33
    echo.
    goto CONFIGURAR
) else (
    echo PHP 7.4.33 no esta instalado aun.
    echo.
)

echo [2/4] Descargando PHP 7.4.33...
echo.
echo ATENCION: Necesitas descargar PHP 7.4 manualmente
echo.
echo 1. Abre tu navegador
echo 2. Ve a: https://windows.php.net/downloads/releases/archives/
echo 3. Busca: php-7.4.33-Win32-vc15-x64.zip
echo 4. Descarga el archivo
echo 5. Extrae el contenido en: C:\laragon\bin\php\php-7.4.33\
echo.
echo Presiona cualquier tecla cuando hayas terminado...
pause >nul

:CONFIGURAR
echo.
echo [3/4] Configurando php.ini...
echo.

if not exist "C:\laragon\bin\php\php-7.4.33\php.ini" (
    if exist "C:\laragon\bin\php\php-7.4.33\php.ini-development" (
        echo Creando php.ini desde php.ini-development...
        copy "C:\laragon\bin\php\php-7.4.33\php.ini-development" "C:\laragon\bin\php\php-7.4.33\php.ini"
        echo php.ini creado exitosamente!
    ) else (
        echo ADVERTENCIA: No se encontro php.ini-development
        echo Verifica que PHP 7.4 este correctamente extraido.
        pause
        exit
    )
) else (
    echo php.ini ya existe.
)

echo.
echo [4/4] Configuracion completa!
echo.
echo ================================================
echo   PROXIMOS PASOS:
echo ================================================
echo.
echo 1. Edita el archivo php.ini:
echo    C:\laragon\bin\php\php-7.4.33\php.ini
echo.
echo 2. Habilita las extensiones (quita el ; al inicio):
echo    - extension=mysqli
echo    - extension=pdo_mysql
echo    - extension=mbstring
echo    - extension=curl
echo    - extension=openssl
echo    - extension=gd
echo.
echo 3. En Laragon:
echo    - Click derecho en el icono
echo    - PHP -^> Version -^> php-7.4.33
echo    - Stop All
echo    - Start All
echo.
echo 4. Verifica en: http://localhost/proditel/info.php
echo.
echo ================================================
echo.
pause
