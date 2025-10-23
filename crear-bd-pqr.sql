-- =====================================================
-- SCRIPT PARA CREAR LA BASE DE DATOS PQR
-- =====================================================
-- Ejecuta este script en phpMyAdmin o SQL Shell
-- =====================================================

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS `pqr` CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Crear el usuario
CREATE USER IF NOT EXISTS 'proditelsas'@'localhost' IDENTIFIED BY 'HjArR3in';

-- Otorgar todos los privilegios
GRANT ALL PRIVILEGES ON `pqr`.* TO 'proditelsas'@'localhost';

-- Aplicar cambios
FLUSH PRIVILEGES;

-- Seleccionar la base de datos
USE `pqr`;

-- Verificar que todo está correcto
SELECT 'Base de datos creada correctamente!' AS Resultado;
SHOW DATABASES LIKE 'pqr';
SELECT User, Host FROM mysql.user WHERE User='proditelsas';

-- =====================================================
-- LISTO! La base de datos está configurada
-- =====================================================
-- Ahora puedes importar tu archivo SQL si lo tienes
-- o acceder a http://localhost/proditel/pqr/upload/
-- =====================================================
