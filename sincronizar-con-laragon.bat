@echo off
echo ====================================
echo  SINCRONIZANDO CAMBIOS CON LARAGON
echo ====================================
echo.

echo Copiando archivos al servidor Laragon...
echo.

REM Copiar logo
copy /Y "logo_Konet.png" "C:\laragon\www\proditel\img\logo_konet.png"

REM Copiar archivos PHP principales
copy /Y "public_html\*.php" "C:\laragon\www\proditel\"

REM Copiar carpeta CSS
xcopy /Y /E /I "public_html\css" "C:\laragon\www\proditel\css"

REM Copiar carpeta JS
xcopy /Y /E /I "public_html\js" "C:\laragon\www\proditel\js"

REM Copiar carpeta IMG (excepto el logo que ya se copió)
xcopy /Y /E /I "public_html\img" "C:\laragon\www\proditel\img"

echo.
echo ====================================
echo  SINCRONIZACION COMPLETADA!
echo ====================================
echo.
echo Ahora recarga tu navegador (Ctrl+F5) en:
echo http://localhost/proditel
echo.
pause
