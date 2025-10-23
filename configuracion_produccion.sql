-- Script de Configuración Rápida para Producción
-- Ejecutar después de importar la base de datos completa

-- 1. LIMPIAR DATOS DE PRUEBA (OPCIONAL)
-- Descomenta si quieres empezar sin tickets de prueba:
-- DELETE FROM ost_ticket WHERE ticket_id > 0;
-- DELETE FROM ost_ticket__cdata WHERE ticket_id > 0;
-- DELETE FROM ost_thread WHERE object_type = 'T';
-- DELETE FROM ost_thread_entry WHERE thread_id NOT IN (SELECT thread_id FROM ost_thread);

-- 2. ACTUALIZAR CONFIGURACIONES IMPORTANTES
UPDATE ost_config SET value = 'Konectando Internet Rural' WHERE namespace = 'core' AND key = 'helpdesk_title';
UPDATE ost_config SET value = 'konectandointernetrural@gmail.com' WHERE namespace = 'core' AND key = 'admin_email';
UPDATE ost_config SET value = 'konectandointernetrural@gmail.com' WHERE namespace = 'core' AND key = 'default_email';

-- 3. ACTUALIZAR URL DEL SISTEMA (CAMBIAR POR TU DOMINIO REAL)
-- UPDATE ost_config SET value = 'https://tudominio.co.cloud/pqr/upload/' WHERE namespace = 'core' AND key = 'helpdesk_url';

-- 4. CAMBIAR CONTRASEÑA DEL ADMIN (RECOMENDADO EN PRODUCCIÓN)
-- Cambiar 'NuevaContraseñaSegura123' por tu contraseña deseada
-- UPDATE ost_staff SET passwd = MD5('NuevaContraseñaSegura123') WHERE username = 'admin';

-- 5. VERIFICAR QUE EL HELP TOPIC DE SEGURIDAD EXISTE
-- Si no existe, crearlo:
INSERT IGNORE INTO ost_help_topic (topic_id, topic, isactive, ispublic, noautoresp, dept_id, priority_id, sort, created, updated)
VALUES (8, 'Incidente de Seguridad', 1, 1, 0, 1, 4, 8, NOW(), NOW());

-- 6. RESETEAR SECUENCIA DE TICKETS (OPCIONAL - SOLO SI QUIERES EMPEZAR DESDE 100000)
-- UPDATE ost_sequence SET next = 100000 WHERE name = 'Ticket Sequence';

-- 7. VERIFICAR CONFIGURACIONES
SELECT 
    'Título del Sistema' AS Configuracion,
    value AS Valor
FROM ost_config 
WHERE namespace = 'core' AND key = 'helpdesk_title'

UNION ALL

SELECT 
    'Email Admin' AS Configuracion,
    value AS Valor
FROM ost_config 
WHERE namespace = 'core' AND key = 'admin_email'

UNION ALL

SELECT 
    'Próximo Número de Ticket' AS Configuracion,
    CAST(next AS CHAR) AS Valor
FROM ost_sequence 
WHERE name = 'Ticket Sequence';

-- 8. LISTO! Configuración completada
