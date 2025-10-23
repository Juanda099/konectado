-- Crear formulario de usuario (User Form) para clientes no autenticados
-- Este formulario permite que cualquier persona cree un ticket sin iniciar sesión

-- Insertar formulario de usuario
INSERT INTO ost_form (id, type, title, instructions, notes, created, updated) 
VALUES (3, 'U', 'Información de Usuario', 'Por favor complete su información de contacto', '', NOW(), NOW());

-- Insertar campos del formulario de usuario
INSERT INTO ost_form_field (form_id, flags, type, label, name, required, hint, sort, configuration) VALUES
(3, 489395, 'text', 'Nombre Completo', 'name', '1', '', 1, '{"size":40,"length":128,"validator":"","validator-error":"Ingrese un nombre válido","placeholder":""}'),
(3, 489395, 'text', 'Correo Electrónico', 'email', '1', 'Recibirá actualizaciones del ticket', 2, '{"size":40,"length":64,"validator":"","validator-error":"Ingrese un email válido","placeholder":"correo@ejemplo.com"}'),
(3, 489395, 'phone', 'Teléfono', 'phone', '0', 'Opcional', 3, '{"ext":false,"validator":"","validator-error":""}');

