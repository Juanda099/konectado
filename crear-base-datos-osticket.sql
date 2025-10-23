-- ============================================
-- SCRIPT DE CREACIÓN DE BASE DE DATOS OSTICKET
-- Sistema PQR (Peticiones, Quejas y Reclamos)
-- Versión: osTicket 1.x compatible
-- ============================================

-- Crear base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS `pqr` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `pqr`;

-- ============================================
-- TABLA: ost_config
-- Configuración general del sistema
-- ============================================
DROP TABLE IF EXISTS `ost_config`;
CREATE TABLE `ost_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `namespace` varchar(64) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `namespace` (`namespace`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar configuración básica
INSERT INTO `ost_config` (`namespace`, `key`, `value`) VALUES
('core', 'admin_email', 'admin@proditelsas.com'),
('core', 'helpdesk_title', 'Sistema PQR - Proditel SAS'),
('core', 'helpdesk_url', 'http://localhost/proditel/pqr/upload/'),
('core', 'schema_signature', 'osticket-1.0'),
('core', 'time_format', 'd/m/Y h:i a'),
('core', 'date_format', 'd/m/Y'),
('core', 'datetime_format', 'd/m/Y h:i a'),
('core', 'default_priority_id', '2'),
('core', 'enable_captcha', '0'),
('core', 'enable_auto_cron', '1'),
('core', 'default_dept_id', '1'),
('core', 'default_email_id', '1');

-- ============================================
-- TABLA: ost_staff
-- Usuarios administrativos del sistema
-- ============================================
DROP TABLE IF EXISTS `ost_staff`;
CREATE TABLE `ost_staff` (
  `staff_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(32) NOT NULL DEFAULT '',
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `passwd` varchar(128) DEFAULT NULL,
  `backend` varchar(32) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(24) NOT NULL DEFAULT '',
  `phone_ext` varchar(6) DEFAULT NULL,
  `mobile` varchar(24) NOT NULL DEFAULT '',
  `signature` text,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `isvisible` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `onvacation` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `assigned_only` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `show_assigned_tickets` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `change_passwd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `max_page_size` int(11) unsigned NOT NULL DEFAULT '0',
  `auto_refresh_rate` int(10) unsigned NOT NULL DEFAULT '0',
  `default_signature_type` enum('none','mine','dept') NOT NULL DEFAULT 'none',
  `default_paper_size` enum('Letter','Legal','Ledger','A4','A3') NOT NULL DEFAULT 'Letter',
  `extra` text,
  `notes` text,
  `created` datetime NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `passwdreset` datetime DEFAULT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `username` (`username`),
  KEY `dept_id` (`dept_id`),
  KEY `issuperuser` (`isadmin`),
  KEY `isactive` (`isactive`),
  KEY `onvacation` (`onvacation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar usuario administrador
-- Usuario: admin / Contraseña: admin123 (cambiar después)
INSERT INTO `ost_staff` (`staff_id`, `dept_id`, `role_id`, `username`, `firstname`, `lastname`, `passwd`, `email`, `isactive`, `isadmin`, `isvisible`, `created`, `updated`) VALUES
(1, 1, 1, 'admin', 'Administrador', 'Sistema', '$2a$08$VivXhKcxKjUvj5dS5RvGEu7g8WZcxBRdH5x6pNWqWWH1N3gPMpyNu', 'admin@proditelsas.com', 1, 1, 1, NOW(), NOW());

-- ============================================
-- TABLA: ost_department
-- Departamentos del sistema
-- ============================================
DROP TABLE IF EXISTS `ost_department`;
CREATE TABLE `ost_department` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned DEFAULT NULL,
  `schedule_id` int(10) unsigned NOT NULL DEFAULT '0',
  `email_id` int(11) unsigned NOT NULL DEFAULT '0',
  `autoresp_email_id` int(10) unsigned NOT NULL DEFAULT '0',
  `manager_id` int(10) unsigned NOT NULL DEFAULT '0',
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL DEFAULT '',
  `signature` text,
  `ispublic` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `group_membership` tinyint(1) NOT NULL DEFAULT '0',
  `ticket_auto_response` tinyint(1) NOT NULL DEFAULT '1',
  `message_auto_response` tinyint(1) NOT NULL DEFAULT '0',
  `path` varchar(128) NOT NULL DEFAULT '/',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`pid`),
  KEY `manager_id` (`manager_id`),
  KEY `autoresp_email_id` (`autoresp_email_id`),
  KEY `pid` (`pid`),
  KEY `email_id` (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar departamentos básicos
INSERT INTO `ost_department` (`id`, `pid`, `name`, `ispublic`, `ticket_auto_response`, `created`, `updated`) VALUES
(1, NULL, 'Soporte Técnico', 1, 1, NOW(), NOW()),
(2, NULL, 'Atención al Cliente', 1, 1, NOW(), NOW()),
(3, NULL, 'Ventas', 1, 1, NOW(), NOW()),
(4, NULL, 'Facturación', 1, 1, NOW(), NOW());

-- ============================================
-- TABLA: ost_ticket
-- Tickets/casos del sistema
-- ============================================
DROP TABLE IF EXISTS `ost_ticket`;
CREATE TABLE `ost_ticket` (
  `ticket_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_pid` int(11) unsigned DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_email_id` int(11) unsigned NOT NULL DEFAULT '0',
  `status_id` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_id` int(11) unsigned NOT NULL DEFAULT '0',
  `sla_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(10) unsigned NOT NULL DEFAULT '0',
  `team_id` int(10) unsigned NOT NULL DEFAULT '0',
  `email_id` int(11) unsigned NOT NULL DEFAULT '0',
  `lock_id` int(11) unsigned NOT NULL DEFAULT '0',
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(64) NOT NULL DEFAULT '',
  `source` enum('Web','Email','Phone','API','Other') NOT NULL DEFAULT 'Other',
  `source_extra` varchar(40) DEFAULT NULL,
  `isoverdue` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isanswered` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `duedate` datetime DEFAULT NULL,
  `est_duedate` datetime DEFAULT NULL,
  `reopened` datetime DEFAULT NULL,
  `closed` datetime DEFAULT NULL,
  `lastupdate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`ticket_id`),
  UNIQUE KEY `number` (`number`),
  KEY `user_id` (`user_id`),
  KEY `dept_id` (`dept_id`),
  KEY `staff_id` (`staff_id`),
  KEY `team_id` (`team_id`),
  KEY `status_id` (`status_id`),
  KEY `created` (`created`),
  KEY `closed` (`closed`),
  KEY `duedate` (`duedate`),
  KEY `topic_id` (`topic_id`),
  KEY `sla_id` (`sla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_ticket_status
-- Estados de los tickets
-- ============================================
DROP TABLE IF EXISTS `ost_ticket_status`;
CREATE TABLE `ost_ticket_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `state` varchar(16) DEFAULT NULL,
  `mode` int(11) unsigned NOT NULL DEFAULT '0',
  `flags` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `properties` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar estados básicos
INSERT INTO `ost_ticket_status` (`id`, `name`, `state`, `mode`, `flags`, `sort`, `properties`, `created`, `updated`) VALUES
(1, 'Abierto', 'open', 3, 0, 1, '{"description":"Ticket abierto y sin asignar"}', NOW(), NOW()),
(2, 'Resuelto', 'closed', 3, 0, 2, '{"description":"Ticket resuelto"}', NOW(), NOW()),
(3, 'Cerrado', 'closed', 3, 0, 3, '{"description":"Ticket cerrado"}', NOW(), NOW()),
(4, 'Archivado', 'archived', 3, 0, 4, '{"description":"Ticket archivado"}', NOW(), NOW()),
(5, 'Eliminado', 'deleted', 3, 0, 5, '{"description":"Ticket eliminado"}', NOW(), NOW());

-- ============================================
-- TABLA: ost_ticket__cdata
-- Datos personalizados del ticket
-- ============================================
DROP TABLE IF EXISTS `ost_ticket__cdata`;
CREATE TABLE `ost_ticket__cdata` (
  `ticket_id` int(11) unsigned NOT NULL,
  `subject` mediumtext,
  `priority` mediumtext,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_ticket_priority
-- Prioridades de tickets
-- ============================================
DROP TABLE IF EXISTS `ost_ticket_priority`;
CREATE TABLE `ost_ticket_priority` (
  `priority_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `priority` varchar(60) NOT NULL DEFAULT '',
  `priority_desc` varchar(30) NOT NULL DEFAULT '',
  `priority_color` varchar(7) NOT NULL DEFAULT '',
  `priority_urgency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ispublic` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`priority_id`),
  UNIQUE KEY `priority` (`priority`),
  KEY `priority_urgency` (`priority_urgency`),
  KEY `ispublic` (`ispublic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar prioridades
INSERT INTO `ost_ticket_priority` (`priority_id`, `priority`, `priority_desc`, `priority_color`, `priority_urgency`, `ispublic`) VALUES
(1, 'Baja', 'Baja', '#DDFFDD', 4, 1),
(2, 'Normal', 'Normal', '#FFFFDD', 3, 1),
(3, 'Alta', 'Alta', '#FFDDDD', 2, 1),
(4, 'Urgente', 'Urgente', '#FF0000', 1, 1);

-- ============================================
-- TABLA: ost_thread
-- Hilos de conversación de tickets
-- ============================================
DROP TABLE IF EXISTS `ost_thread`;
CREATE TABLE `ost_thread` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL,
  `object_type` char(1) NOT NULL,
  `extra` text,
  `lastresponse` datetime DEFAULT NULL,
  `lastmessage` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `object_type` (`object_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_thread_entry
-- Entradas/mensajes en los hilos
-- ============================================
DROP TABLE IF EXISTS `ost_thread_entry`;
CREATE TABLE `ost_thread_entry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `thread_id` int(11) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '',
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `poster` varchar(128) NOT NULL DEFAULT '',
  `editor` int(10) unsigned DEFAULT NULL,
  `source` varchar(32) NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `format` varchar(16) NOT NULL DEFAULT 'html',
  `ip_address` varchar(64) NOT NULL DEFAULT '',
  `extra` text,
  `recipients` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thread_id` (`thread_id`),
  KEY `staff_id` (`staff_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_user
-- Usuarios del sistema (clientes)
-- ============================================
DROP TABLE IF EXISTS `ost_user`;
CREATE TABLE `ost_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `org_id` int(11) unsigned NOT NULL,
  `default_email_id` int(10) NOT NULL,
  `status` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `org_id` (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_user_email
-- Emails de usuarios
-- ============================================
DROP TABLE IF EXISTS `ost_user_email`;
CREATE TABLE `ost_user_email` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `flags` int(11) unsigned NOT NULL DEFAULT '0',
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `address` (`address`),
  KEY `user_email_lookup` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_user__cdata
-- Datos personalizados del usuario
-- ============================================
DROP TABLE IF EXISTS `ost_user__cdata`;
CREATE TABLE `ost_user__cdata` (
  `user_id` int(11) unsigned NOT NULL,
  `name` mediumtext,
  `email` mediumtext,
  `phone` mediumtext,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_organization
-- Organizaciones
-- ============================================
DROP TABLE IF EXISTS `ost_organization`;
CREATE TABLE `ost_organization` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `manager` varchar(64) NOT NULL DEFAULT '',
  `status` int(11) unsigned NOT NULL DEFAULT '0',
  `domain` varchar(256) NOT NULL DEFAULT '',
  `extra` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar organización por defecto
INSERT INTO `ost_organization` (`id`, `name`, `status`, `created`, `updated`) VALUES
(1, 'Proditel SAS', 8, NOW(), NOW());

-- ============================================
-- TABLA: ost_help_topic
-- Temas de ayuda / Categorías
-- ============================================
DROP TABLE IF EXISTS `ost_help_topic`;
CREATE TABLE `ost_help_topic` (
  `topic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `topic_pid` int(10) unsigned NOT NULL DEFAULT '0',
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ispublic` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `noautoresp` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `status_id` int(10) unsigned NOT NULL DEFAULT '0',
  `priority_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
  `staff_id` int(10) unsigned NOT NULL DEFAULT '0',
  `team_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sla_id` int(10) unsigned NOT NULL DEFAULT '0',
  `page_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sequence_id` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `topic` varchar(32) NOT NULL DEFAULT '',
  `number_format` varchar(32) DEFAULT NULL,
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`topic_id`),
  UNIQUE KEY `topic` (`topic`,`topic_pid`),
  KEY `topic_pid` (`topic_pid`),
  KEY `priority_id` (`priority_id`),
  KEY `dept_id` (`dept_id`),
  KEY `staff_id` (`staff_id`),
  KEY `team_id` (`team_id`),
  KEY `sla_id` (`sla_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar temas de ayuda
INSERT INTO `ost_help_topic` (`topic_id`, `topic`, `isactive`, `ispublic`, `dept_id`, `priority_id`, `sort`, `created`, `updated`) VALUES
(1, 'Consulta General', 1, 1, 1, 2, 1, NOW(), NOW()),
(2, 'Problema Técnico', 1, 1, 1, 3, 2, NOW(), NOW()),
(3, 'Petición', 1, 1, 2, 2, 3, NOW(), NOW()),
(4, 'Queja', 1, 1, 2, 3, 4, NOW(), NOW()),
(5, 'Reclamo', 1, 1, 2, 4, 5, NOW(), NOW()),
(6, 'Sugerencia', 1, 1, 2, 1, 6, NOW(), NOW()),
(7, 'Facturación', 1, 1, 4, 2, 7, NOW(), NOW());

-- ============================================
-- TABLA: ost_email
-- Configuración de emails
-- ============================================
DROP TABLE IF EXISTS `ost_email`;
CREATE TABLE `ost_email` (
  `email_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `noautoresp` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `priority_id` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `userid` varchar(255) NOT NULL,
  `userpass` varchar(255) DEFAULT NULL,
  `mail_active` tinyint(1) NOT NULL DEFAULT '0',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_protocol` enum('POP','IMAP') DEFAULT NULL,
  `mail_encryption` enum('NONE','SSL','TLS') DEFAULT NULL,
  `mail_port` int(6) DEFAULT NULL,
  `mail_fetchfreq` tinyint(3) NOT NULL DEFAULT '5',
  `mail_fetchmax` tinyint(4) NOT NULL DEFAULT '30',
  `mail_archivefolder` varchar(255) DEFAULT NULL,
  `mail_delete` tinyint(1) DEFAULT '0',
  `mail_errors` int(11) NOT NULL DEFAULT '0',
  `mail_lasterror` datetime DEFAULT NULL,
  `mail_lastfetch` datetime DEFAULT NULL,
  `smtp_active` tinyint(1) NOT NULL DEFAULT '0',
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` int(6) DEFAULT NULL,
  `smtp_secure` tinyint(1) NOT NULL DEFAULT '1',
  `smtp_auth` tinyint(1) NOT NULL DEFAULT '1',
  `smtp_spoofing` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `smtp_userid` varchar(255) DEFAULT NULL,
  `smtp_userpass` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `email` (`email`),
  KEY `priority_id` (`priority_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar email por defecto
INSERT INTO `ost_email` (`email_id`, `email`, `name`, `userid`, `dept_id`, `priority_id`, `created`, `updated`) VALUES
(1, 'soporte@proditelsas.com', 'Soporte Proditel', 'soporte@proditelsas.com', 1, 2, NOW(), NOW());

-- ============================================
-- TABLA: ost_attachment
-- Archivos adjuntos
-- ============================================
DROP TABLE IF EXISTS `ost_attachment`;
CREATE TABLE `ost_attachment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `inline` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `type` (`type`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_file
-- Archivos del sistema
-- ============================================
DROP TABLE IF EXISTS `ost_file`;
CREATE TABLE `ost_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT '',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0',
  `key` varchar(86) NOT NULL,
  `signature` varchar(86) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `attrs` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `created` (`created`),
  KEY `size` (`size`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_file_chunk
-- Fragmentos de archivos
-- ============================================
DROP TABLE IF EXISTS `ost_file_chunk`;
CREATE TABLE `ost_file_chunk` (
  `file_id` int(11) NOT NULL,
  `chunk_id` int(11) NOT NULL,
  `filedata` longblob NOT NULL,
  PRIMARY KEY (`file_id`,`chunk_id`),
  KEY `chunk_id` (`chunk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_sla
-- Service Level Agreements
-- ============================================
DROP TABLE IF EXISTS `ost_sla`;
CREATE TABLE `ost_sla` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int(10) unsigned NOT NULL DEFAULT '0',
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `grace_period` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL DEFAULT '',
  `notes` text,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar SLA por defecto
INSERT INTO `ost_sla` (`id`, `name`, `grace_period`, `flags`, `notes`, `created`, `updated`) VALUES
(1, 'SLA Estándar', 18, 3, 'Acuerdo de nivel de servicio estándar', NOW(), NOW());

-- ============================================
-- TABLA: ost_session
-- Sesiones de usuarios
-- ============================================
DROP TABLE IF EXISTS `ost_session`;
CREATE TABLE `ost_session` (
  `session_id` varchar(255) NOT NULL DEFAULT '',
  `session_data` blob,
  `session_expire` datetime DEFAULT NULL,
  `session_updated` datetime DEFAULT NULL,
  `user_id` varchar(16) NOT NULL DEFAULT '0',
  `user_ip` varchar(64) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `updated` (`session_updated`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_lock
-- Bloqueos de tickets
-- ============================================
DROP TABLE IF EXISTS `ost_lock`;
CREATE TABLE `ost_lock` (
  `lock_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) unsigned NOT NULL DEFAULT '0',
  `expire` datetime DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`lock_id`),
  KEY `staff_id` (`staff_id`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_note
-- Notas internas
-- ============================================
DROP TABLE IF EXISTS `ost_note`;
CREATE TABLE `ost_note` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT NULL,
  `staff_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ext_id` varchar(10) DEFAULT NULL,
  `body` text,
  `status_id` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ext_id` (`ext_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- TABLA: ost_event
-- Eventos del sistema
-- ============================================
DROP TABLE IF EXISTS `ost_event`;
CREATE TABLE `ost_event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insertar eventos básicos
INSERT INTO `ost_event` (`id`, `name`, `description`) VALUES
(1, 'created', 'Ticket creado'),
(2, 'closed', 'Ticket cerrado'),
(3, 'reopened', 'Ticket reabierto'),
(4, 'assigned', 'Ticket asignado'),
(5, 'transferred', 'Ticket transferido'),
(6, 'referred', 'Ticket referido'),
(7, 'overdue', 'Ticket vencido'),
(8, 'edited', 'Ticket editado'),
(9, 'message', 'Nuevo mensaje'),
(10, 'note', 'Nueva nota');

-- ============================================
-- ÍNDICES Y OPTIMIZACIONES ADICIONALES
-- ============================================

-- Optimizar tablas
OPTIMIZE TABLE `ost_ticket`;
OPTIMIZE TABLE `ost_thread`;
OPTIMIZE TABLE `ost_thread_entry`;
OPTIMIZE TABLE `ost_user`;
OPTIMIZE TABLE `ost_staff`;
OPTIMIZE TABLE `ost_department`;

-- ============================================
-- SCRIPT COMPLETADO
-- ============================================

SELECT 'Base de datos osTicket creada exitosamente!' AS mensaje;
SELECT COUNT(*) AS total_departamentos FROM ost_department;
SELECT COUNT(*) AS total_prioridades FROM ost_ticket_priority;
SELECT COUNT(*) AS total_estados FROM ost_ticket_status;
SELECT COUNT(*) AS total_temas FROM ost_help_topic;
SELECT COUNT(*) AS total_staff FROM ost_staff;

-- Mostrar información del usuario admin
SELECT 'Usuario administrador creado:' AS info;
SELECT username, firstname, lastname, email, isadmin FROM ost_staff WHERE staff_id = 1;
