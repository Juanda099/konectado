-- Tablas de formularios dinámicos para osTicket

-- Tabla principal de formularios
CREATE TABLE IF NOT EXISTS `ost_form` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT NULL,
  `type` varchar(8) NOT NULL DEFAULT 'G',
  `flags` int(10) unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `instructions` text,
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabla de campos de formulario
CREATE TABLE IF NOT EXISTS `ost_form_field` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) unsigned NOT NULL,
  `flags` int(10) unsigned DEFAULT '1',
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `label` varchar(255) NOT NULL,
  `name` varchar(64) NOT NULL,
  `configuration` text,
  `sort` int(11) NOT NULL,
  `hint` varchar(512),
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabla de entradas de formulario (respuestas)
CREATE TABLE IF NOT EXISTS `ost_form_entry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned DEFAULT NULL,
  `object_type` char(1) NOT NULL DEFAULT 'T',
  `sort` int(11) NOT NULL DEFAULT '1',
  `extra` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_lookup` (`object_type`,`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tabla de valores de respuesta
CREATE TABLE IF NOT EXISTS `ost_form_entry_values` (
  `entry_id` int(11) unsigned NOT NULL,
  `field_id` int(11) unsigned NOT NULL,
  `value` text,
  `value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`entry_id`,`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insertar formulario de contacto por defecto
INSERT INTO `ost_form` (`id`, `type`, `flags`, `title`, `instructions`, `created`, `updated`) VALUES
(1, 'C', 1, 'Información de Contacto', 'Detalles del usuario', NOW(), NOW()),
(2, 'T', 1, 'Información del Ticket', 'Detalles de la solicitud', NOW(), NOW());

-- Campos del formulario de contacto (Form 1)
INSERT INTO `ost_form_field` (`form_id`, `type`, `label`, `name`, `configuration`, `sort`, `hint`, `created`, `updated`) VALUES
(1, 'text', 'Correo Electrónico', 'email', '{"size":40,"length":64,"validator":"email"}', 1, 'Correo electrónico de contacto', NOW(), NOW()),
(1, 'text', 'Nombre Completo', 'name', '{"size":40,"length":64}', 2, 'Nombre y apellido', NOW(), NOW()),
(1, 'phone', 'Número de Teléfono', 'phone', '{"ext":false}', 3, 'Teléfono de contacto', NOW(), NOW());

-- Campos del formulario de ticket (Form 2)
INSERT INTO `ost_form_field` (`form_id`, `type`, `label`, `name`, `configuration`, `sort`, `hint`, `created`, `updated`) VALUES
(2, 'text', 'Asunto del Ticket', 'subject', '{"size":40,"length":50}', 1, 'Resumen breve del problema', NOW(), NOW()),
(2, 'thread', 'Descripción', 'message', '{"rows":8,"cols":40,"length":0,"html":false}', 2, 'Descripción detallada', NOW(), NOW()),
(2, 'priority', 'Prioridad', 'priority', '{}', 3, NULL, NOW(), NOW());

-- Verificación
SELECT 'Formularios creados exitosamente' as resultado;
SELECT COUNT(*) as total_forms FROM ost_form;
SELECT COUNT(*) as total_fields FROM ost_form_field;
