INSERT INTO ost_form_field (form_id, flags, type, label, name, hint, sort, configuration, created, updated) 
VALUES 
(3, 489395, 'text', 'Nombre Completo', 'name', '', 1, '{"size":40,"length":128}', NOW(), NOW()),
(3, 489395, 'text', 'Correo Electrónico', 'email', 'Recibirá actualizaciones del ticket', 2, '{"size":40,"length":64}', NOW(), NOW()),
(3, 489395, 'phone', 'Teléfono', 'phone', 'Opcional', 3, '{"ext":false}', NOW(), NOW());
