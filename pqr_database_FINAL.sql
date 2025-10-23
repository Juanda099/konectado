-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: pqr
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ost__search`
--

DROP TABLE IF EXISTS `ost__search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost__search` (
  `object_type` varchar(8) NOT NULL,
  `object_id` int unsigned NOT NULL,
  `title` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  PRIMARY KEY (`object_type`,`object_id`),
  FULLTEXT KEY `search` (`title`,`content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost__search`
--

LOCK TABLES `ost__search` WRITE;
/*!40000 ALTER TABLE `ost__search` DISABLE KEYS */;
INSERT INTO `ost__search` VALUES ('H',2,'','ayudame'),('H',3,'','ayuyida'),('H',4,'','ayudsa'),('H',5,'','adasasa'),('H',7,'','Este es un ticket de prueba creado desde el panel de administración. Por favor confirmar que todo funciona correctamente.'),('H',8,'','qwqwq'),('H',9,'','ayuda'),('H',10,'','qwqwq'),('O',1,'osTicket','420 Desoto Street Alexandria, LA 71301\n(318) 290-3674\nhttp://osticket.com\nNot only do we develop the software, we also use it to manage support for osTicket. Let us help you quickly implement and leverage the full potential of osTicket\'s features and functionality. Contact us for professional support or visit our website for documentation and community support.'),('T',1,'100000',''),('T',2,'100001 ',''),('T',3,'100002 ',''),('T',4,'100003 ',''),('T',5,'100004 ',''),('T',7,'100005 ',''),('T',8,'100006 ',''),('T',9,'100007 ',''),('T',10,'100008 ',''),('U',1,'juan david Ramirez','juandavidramirezcalderon@gmail.com\n(315) 223-1488'),('U',101,'Juan',' nuevo@gmial.com\nnuevo@gmial.com'),('U',102,'juanda',' jdaramirezc@poligran.edu.co\njdaramirezc@poligran.edu.co');
/*!40000 ALTER TABLE `ost__search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_api_key`
--

DROP TABLE IF EXISTS `ost_api_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_api_key` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `ipaddr` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `apikey` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `can_create_tickets` tinyint unsigned NOT NULL DEFAULT '1',
  `can_exec_cron` tinyint unsigned NOT NULL DEFAULT '1',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apikey` (`apikey`),
  KEY `ipaddr` (`ipaddr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_api_key`
--

LOCK TABLES `ost_api_key` WRITE;
/*!40000 ALTER TABLE `ost_api_key` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_api_key` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_attachment`
--

DROP TABLE IF EXISTS `ost_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_attachment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL,
  `file_id` int unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `inline` tinyint unsigned NOT NULL DEFAULT '0',
  `lang` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `object` (`object_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_attachment`
--

LOCK TABLES `ost_attachment` WRITE;
/*!40000 ALTER TABLE `ost_attachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_attachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_canned_response`
--

DROP TABLE IF EXISTS `ost_canned_response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_canned_response` (
  `canned_id` int unsigned NOT NULL AUTO_INCREMENT,
  `dept_id` int unsigned NOT NULL DEFAULT '0',
  `isenabled` tinyint unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `response` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lang` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'en_US',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`canned_id`),
  KEY `dept_id` (`dept_id`),
  KEY `active` (`isenabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_canned_response`
--

LOCK TABLES `ost_canned_response` WRITE;
/*!40000 ALTER TABLE `ost_canned_response` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_canned_response` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_config`
--

DROP TABLE IF EXISTS `ost_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_config` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `namespace` varchar(64) NOT NULL DEFAULT '',
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `namespace` (`namespace`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_config`
--

LOCK TABLES `ost_config` WRITE;
/*!40000 ALTER TABLE `ost_config` DISABLE KEYS */;
INSERT INTO `ost_config` VALUES (1,'core','admin_email','admin@localhost','2025-10-22 14:33:01'),(2,'core','helpdesk_url','http://localhost/proditel/pqr/upload/','2025-10-22 14:33:01'),(3,'core','helpdesk_title','Sistema PQR - Soporte','2025-10-22 14:33:01'),(4,'core','schema_signature','98ad7d550c26ac44340350912296e673','2025-10-22 15:00:48'),(5,'core','time_format','HH:mm','2025-10-22 14:33:01'),(6,'core','date_format','dd/MM/yyyy','2025-10-22 14:33:01'),(7,'core','datetime_format','dd/MM/yyyy HH:mm','2025-10-22 14:33:01'),(8,'core','daydatetime_format','EEE, MMM d y HH:mm','2025-10-22 14:33:01'),(9,'core','default_timezone','America/Bogota','2025-10-22 14:33:01'),(10,'core','enable_daylight_saving','0','2025-10-22 14:33:01'),(11,'core','reply_separator','-- reply above this line --','2025-10-22 14:33:01'),(12,'core','isonline','1','2025-10-22 14:33:01'),(13,'core','staff_ip_binding','0','2025-10-22 14:33:01'),(14,'core','staff_max_logins','4','2025-10-22 14:33:01'),(15,'core','staff_login_timeout','2','2025-10-22 14:33:01'),(16,'core','staff_session_timeout','30','2025-10-22 14:33:01'),(17,'core','passwd_reset_period','0','2025-10-22 14:33:01'),(18,'core','client_max_logins','4','2025-10-22 14:33:01'),(19,'core','client_login_timeout','2','2025-10-22 14:33:01'),(20,'core','client_session_timeout','30','2025-10-22 14:33:01'),(21,'core','max_page_size','25','2025-10-22 14:33:01'),(22,'core','max_open_tickets','0','2025-10-22 14:33:01'),(23,'core','autolock_minutes','3','2025-10-22 14:33:01'),(24,'core','default_priority_id','2','2025-10-22 14:33:01'),(25,'core','default_dept_id','1','2025-10-22 14:33:01'),(26,'core','default_sla_id','1','2025-10-22 14:33:01'),(27,'core','default_email_id','1','2025-10-22 14:33:01'),(28,'core','default_smtp_id','0','2025-10-22 14:33:01'),(29,'core','use_email_priority','0','2025-10-22 14:33:01'),(30,'core','enable_kb','0','2025-10-22 14:33:01'),(31,'core','enable_captcha','0','2025-10-22 14:33:01'),(32,'core','enable_auto_cron','0','2025-10-22 14:33:01'),(33,'core','enable_mail_polling','0','2025-10-22 14:33:01'),(34,'core','send_sys_errors','1','2025-10-22 14:33:01'),(35,'core','send_sql_errors','1','2025-10-22 14:33:01'),(36,'core','send_login_errors','1','2025-10-22 14:33:01'),(37,'core','save_email_headers','1','2025-10-22 14:33:01'),(38,'core','strip_quoted_reply','1','2025-10-22 14:33:01'),(39,'core','ticket_autoresponder','0','2025-10-22 14:33:01'),(40,'core','message_autoresponder','0','2025-10-22 14:33:01'),(41,'core','ticket_notice_active','1','2025-10-22 14:33:01'),(42,'core','ticket_alert_active','1','2025-10-22 14:33:01'),(43,'core','ticket_alert_admin','1','2025-10-22 14:33:01'),(44,'core','ticket_alert_dept_manager','1','2025-10-22 14:33:01'),(45,'core','ticket_alert_dept_members','0','2025-10-22 14:33:01'),(46,'core','message_alert_active','1','2025-10-22 14:33:01'),(47,'core','message_alert_laststaff','1','2025-10-22 14:33:01'),(48,'core','message_alert_assigned','1','2025-10-22 14:33:01'),(49,'core','message_alert_dept_manager','0','2025-10-22 14:33:01'),(50,'core','note_alert_active','0','2025-10-22 14:33:01'),(51,'core','note_alert_laststaff','1','2025-10-22 14:33:01'),(52,'core','note_alert_assigned','1','2025-10-22 14:33:01'),(53,'core','note_alert_dept_manager','0','2025-10-22 14:33:01'),(54,'core','transfer_alert_active','0','2025-10-22 14:33:01'),(55,'core','transfer_alert_assigned','0','2025-10-22 14:33:01'),(56,'core','transfer_alert_dept_manager','1','2025-10-22 14:33:01'),(57,'core','transfer_alert_dept_members','0','2025-10-22 14:33:01'),(58,'core','overdue_alert_active','1','2025-10-22 14:33:01'),(59,'core','overdue_alert_assigned','1','2025-10-22 14:33:01'),(60,'core','overdue_alert_dept_manager','1','2025-10-22 14:33:01'),(61,'core','overdue_alert_dept_members','0','2025-10-22 14:33:01'),(62,'core','assigned_alert_active','1','2025-10-22 14:33:01'),(63,'core','assigned_alert_staff','1','2025-10-22 14:33:01'),(64,'core','assigned_alert_team_lead','0','2025-10-22 14:33:01'),(65,'core','assigned_alert_team_members','0','2025-10-22 14:33:01'),(66,'core','auto_claim_tickets','1','2025-10-22 14:33:01'),(67,'core','auto_refer_closed','1','2025-10-22 14:33:01'),(68,'core','collaborator_ticket_visibility','1','2025-10-22 14:33:01'),(69,'core','require_topic_to_close','0','2025-10-22 14:33:01'),(70,'core','show_related_tickets','1','2025-10-22 14:33:01'),(71,'core','show_assigned_tickets','0','2025-10-22 14:33:01'),(72,'core','show_answered_tickets','0','2025-10-22 14:33:01'),(73,'core','hide_staff_name','0','2025-10-22 14:33:01'),(74,'core','disable_agent_collabs','0','2025-10-22 14:33:01'),(75,'core','overlimit_notice_active','0','2025-10-22 14:33:01'),(76,'core','email_attachments','1','2025-10-22 14:33:01'),(77,'core','ticket_number_format','######','2025-10-22 14:33:01'),(78,'core','ticket_sequence_id','1','2025-10-22 14:33:01'),(79,'core','queue_bucket_counts','0','2025-10-22 14:33:01'),(80,'core','task_number_format','#','2025-10-22 14:33:01'),(81,'core','task_sequence_id','1','2025-10-22 14:33:01'),(82,'core','log_level','2','2025-10-22 14:33:01'),(83,'core','log_graceperiod','12','2025-10-22 14:33:01'),(84,'core','client_registration','0','2025-10-22 14:33:01'),(85,'core','client_email_verification','0','2025-10-22 14:33:01'),(86,'core','default_ticket_queue','1','2025-10-22 14:33:01'),(87,'core','ostversion','v1.10.1','2025-10-22 14:59:28'),(88,'mysqlsearch','reindex','0','2025-10-22 15:12:42');
/*!40000 ALTER TABLE `ost_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_content`
--

DROP TABLE IF EXISTS `ost_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_content` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `isactive` tinyint unsigned NOT NULL DEFAULT '0',
  `type` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'other',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lang` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'en_US',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup` (`name`,`lang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_content`
--

LOCK TABLES `ost_content` WRITE;
/*!40000 ALTER TABLE `ost_content` DISABLE KEYS */;
INSERT INTO `ost_content` VALUES (1,1,'landing','P??gina de Inicio','<h1>Sistema de Soporte</h1><p>Bienvenido a nuestro sistema de soporte. Por favor, cree un ticket para reportar problemas o hacer consultas.</p>','es_ES',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(2,1,'offline','Sistema Fuera de L??nea','<h1>Sistema en Mantenimiento</h1><p>El sistema de soporte est?? temporalmente fuera de l??nea. Por favor, intente m??s tarde.</p>','es_ES',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(3,1,'thank-you','Gracias','<h1>??Ticket Creado!</h1><p>Gracias por contactarnos. Recibir?? una copia de su ticket por correo electr??nico.</p>','es_ES',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01');
/*!40000 ALTER TABLE `ost_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_department`
--

DROP TABLE IF EXISTS `ost_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_department` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `pid` int unsigned DEFAULT NULL,
  `tpl_id` int unsigned NOT NULL DEFAULT '0',
  `sla_id` int unsigned NOT NULL DEFAULT '0',
  `schedule_id` int unsigned NOT NULL DEFAULT '0',
  `email_id` int unsigned NOT NULL DEFAULT '0',
  `autoresp_email_id` int unsigned NOT NULL DEFAULT '0',
  `manager_id` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `signature` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ispublic` tinyint unsigned NOT NULL DEFAULT '1',
  `group_membership` tinyint(1) NOT NULL DEFAULT '0',
  `ticket_auto_response` tinyint(1) NOT NULL DEFAULT '1',
  `message_auto_response` tinyint(1) NOT NULL DEFAULT '0',
  `path` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '/',
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`pid`),
  KEY `manager_id` (`manager_id`),
  KEY `autoresp_email_id` (`autoresp_email_id`),
  KEY `email_id` (`email_id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_department`
--

LOCK TABLES `ost_department` WRITE;
/*!40000 ALTER TABLE `ost_department` DISABLE KEYS */;
INSERT INTO `ost_department` VALUES (1,NULL,0,1,0,1,0,0,4,'Soporte','Equipo de Soporte',1,0,1,0,'/Soporte/','2025-10-22 09:33:01','2025-10-22 09:33:01'),(2,NULL,0,0,0,0,0,0,4,'Atenci??n al Cliente','Equipo de Atenci??n al Cliente',1,0,1,0,'/Atenci??n al Cliente/','2025-10-22 09:33:01','2025-10-22 09:33:01'),(3,NULL,0,0,0,0,0,0,4,'Facturaci??n','Equipo de Facturaci??n',1,0,1,0,'/Facturaci??n/','2025-10-22 09:33:01','2025-10-22 09:33:01');
/*!40000 ALTER TABLE `ost_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_draft`
--

DROP TABLE IF EXISTS `ost_draft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_draft` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int unsigned NOT NULL,
  `namespace` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `staff_draft` (`staff_id`,`namespace`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_draft`
--

LOCK TABLES `ost_draft` WRITE;
/*!40000 ALTER TABLE `ost_draft` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_draft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_email`
--

DROP TABLE IF EXISTS `ost_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_email` (
  `email_id` int unsigned NOT NULL AUTO_INCREMENT,
  `noautoresp` tinyint unsigned NOT NULL DEFAULT '0',
  `priority_id` int unsigned NOT NULL DEFAULT '0',
  `dept_id` int unsigned NOT NULL DEFAULT '0',
  `topic_id` int unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `userid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `userpass` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `mail_host` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `mail_protocol` enum('POP','IMAP') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'POP',
  `mail_encryption` enum('NONE','SSL','TLS') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mail_port` int DEFAULT NULL,
  `mail_fetchfreq` tinyint NOT NULL DEFAULT '5',
  `mail_fetchmax` tinyint NOT NULL DEFAULT '30',
  `mail_archivefolder` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mail_delete` tinyint(1) DEFAULT '0',
  `mail_errors` int NOT NULL DEFAULT '0',
  `mail_lasterror` datetime DEFAULT NULL,
  `mail_lastfetch` datetime DEFAULT NULL,
  `smtp_host` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `smtp_port` int DEFAULT NULL,
  `smtp_secure` tinyint(1) NOT NULL DEFAULT '1',
  `smtp_auth` tinyint(1) NOT NULL DEFAULT '1',
  `smtp_spoofing` tinyint unsigned NOT NULL DEFAULT '0',
  `lastupdate` timestamp NULL DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`email_id`),
  UNIQUE KEY `email` (`email`),
  KEY `priority_id` (`priority_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_email`
--

LOCK TABLES `ost_email` WRITE;
/*!40000 ALTER TABLE `ost_email` DISABLE KEYS */;
INSERT INTO `ost_email` VALUES (1,0,2,1,0,'soporte@localhost','Sistema de Soporte','','','','POP','NONE',NULL,5,30,NULL,0,0,NULL,NULL,'localhost',25,0,0,0,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01');
/*!40000 ALTER TABLE `ost_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_email_account`
--

DROP TABLE IF EXISTS `ost_email_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_email_account` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `host` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `port` int DEFAULT NULL,
  `username` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `protocol` enum('IMAP','POP3') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'IMAP',
  `encryption` enum('NONE','SSL','TLS','AUTO') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'AUTO',
  `fetchfreq` tinyint unsigned NOT NULL DEFAULT '5',
  `fetchmax` tinyint NOT NULL DEFAULT '20',
  `postfetch` enum('archive','delete','nothing') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'nothing',
  `archivefolder` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mail_errors` int unsigned NOT NULL DEFAULT '0',
  `last_error_msg` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `last_error` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_email_account`
--

LOCK TABLES `ost_email_account` WRITE;
/*!40000 ALTER TABLE `ost_email_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_email_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_email_template`
--

DROP TABLE IF EXISTS `ost_email_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_email_template` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `tpl_id` int NOT NULL DEFAULT '0',
  `code_name` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `subject` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `template_lookup` (`tpl_id`,`code_name`),
  KEY `tpl_id` (`tpl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_email_template`
--

LOCK TABLES `ost_email_template` WRITE;
/*!40000 ALTER TABLE `ost_email_template` DISABLE KEYS */;
INSERT INTO `ost_email_template` VALUES (1,1,'ticket.autoresp','Ticket Recibido [#%{ticket.number}]','<p>Estimado/a %{recipient.name},</p><p>Hemos recibido su solicitud. Un miembro de nuestro equipo le responder?? pronto.</p><p><strong>N??mero de Ticket:</strong> %{ticket.number}<br /><strong>Asunto:</strong> %{ticket.topic.name} - %{ticket.subject}<br /><strong>Estado:</strong> %{ticket.status}</p><p>Si tiene informaci??n adicional, por favor responda a este correo.</p><p>Saludos,<br />Equipo de Soporte</p>',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(2,1,'ticket.reply','Respuesta a Ticket [#%{ticket.number}]','<p>Estimado/a %{ticket.name},</p><p>Hemos respondido a su solicitud:</p><hr />%{response}<hr /><p><strong>N??mero de Ticket:</strong> %{ticket.number}<br /><strong>Asunto:</strong> %{ticket.subject}<br /><strong>Estado:</strong> %{ticket.status}</p><p>Para responder, conteste directamente a este correo.</p><p>Saludos,<br />%{staff.name}</p>',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(3,1,'ticket.alert','Nuevo Ticket [#%{ticket.number}]','<p><strong>Nuevo ticket creado</strong></p><p><strong>N??mero:</strong> %{ticket.number}<br /><strong>De:</strong> %{ticket.name} &lt;%{ticket.email}&gt;<br /><strong>Departamento:</strong> %{ticket.dept.name}<br /><strong>Asunto:</strong> %{ticket.subject}</p><hr />%{message}<hr /><p>Ver ticket: %{ticket.url}</p>',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(4,1,'message.alert','Nuevo Mensaje en Ticket [#%{ticket.number}]','<p><strong>Nueva respuesta del cliente</strong></p><p><strong>N??mero de Ticket:</strong> %{ticket.number}<br /><strong>Asunto:</strong> %{ticket.subject}<br /><strong>De:</strong> %{ticket.name}</p><hr />%{message}<hr /><p>Ver ticket: %{ticket.url}</p>',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(5,1,'ticket.notice','Ticket Cerrado [#%{ticket.number}]','<p>Estimado/a %{ticket.name},</p><p>Su solicitud ha sido marcada como cerrada.</p><p><strong>N??mero de Ticket:</strong> %{ticket.number}<br /><strong>Asunto:</strong> %{ticket.subject}<br /><strong>Estado:</strong> %{ticket.status}</p><p>Si considera que su problema no ha sido resuelto, puede reabrir este ticket respondiendo a este correo.</p><p>Gracias por usar nuestro sistema de soporte.</p><p>Saludos,<br />Equipo de Soporte</p>',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01');
/*!40000 ALTER TABLE `ost_email_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_email_template_group`
--

DROP TABLE IF EXISTS `ost_email_template_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_email_template_group` (
  `tpl_id` int NOT NULL AUTO_INCREMENT,
  `isactive` tinyint unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `lang` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'en_US',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tpl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_email_template_group`
--

LOCK TABLES `ost_email_template_group` WRITE;
/*!40000 ALTER TABLE `ost_email_template_group` DISABLE KEYS */;
INSERT INTO `ost_email_template_group` VALUES (1,1,'Plantillas por Defecto','es_ES',NULL,'2025-10-22 09:33:01','2025-10-22 14:33:01');
/*!40000 ALTER TABLE `ost_email_template_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_event`
--

DROP TABLE IF EXISTS `ost_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_event` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_event`
--

LOCK TABLES `ost_event` WRITE;
/*!40000 ALTER TABLE `ost_event` DISABLE KEYS */;
INSERT INTO `ost_event` VALUES (1,'created',NULL),(2,'closed',NULL),(3,'reopened',NULL),(4,'assigned',NULL),(5,'released',NULL),(6,'transferred',NULL),(7,'referred',NULL),(8,'overdue',NULL),(9,'edited',NULL),(10,'view',NULL),(11,'note',NULL),(12,'deleted',NULL),(13,'merged',NULL),(14,'unlinked',NULL),(15,'linked',NULL),(16,'login',NULL),(17,'logout',NULL),(18,'message',NULL),(19,'collab',NULL);
/*!40000 ALTER TABLE `ost_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_faq`
--

DROP TABLE IF EXISTS `ost_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_faq` (
  `faq_id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned NOT NULL DEFAULT '0',
  `ispublished` tinyint unsigned NOT NULL DEFAULT '0',
  `question` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `keywords` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`faq_id`),
  UNIQUE KEY `question` (`question`),
  KEY `category_id` (`category_id`),
  KEY `ispublished` (`ispublished`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_faq`
--

LOCK TABLES `ost_faq` WRITE;
/*!40000 ALTER TABLE `ost_faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_faq_category`
--

DROP TABLE IF EXISTS `ost_faq_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_faq_category` (
  `category_id` int unsigned NOT NULL AUTO_INCREMENT,
  `ispublic` tinyint unsigned NOT NULL DEFAULT '0',
  `name` varchar(125) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notes` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_faq_category`
--

LOCK TABLES `ost_faq_category` WRITE;
/*!40000 ALTER TABLE `ost_faq_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_faq_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_faq_topic`
--

DROP TABLE IF EXISTS `ost_faq_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_faq_topic` (
  `faq_id` int unsigned NOT NULL,
  `topic_id` int unsigned NOT NULL,
  PRIMARY KEY (`faq_id`,`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_faq_topic`
--

LOCK TABLES `ost_faq_topic` WRITE;
/*!40000 ALTER TABLE `ost_faq_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_faq_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_file`
--

DROP TABLE IF EXISTS `ost_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ft` char(1) NOT NULL DEFAULT 'T',
  `bk` char(1) NOT NULL DEFAULT 'D',
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `size` bigint unsigned NOT NULL DEFAULT '0',
  `key` varchar(86) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `signature` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `attrs` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ft` (`ft`),
  KEY `key` (`key`),
  KEY `signature` (`signature`),
  KEY `created` (`created`),
  KEY `size` (`size`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_file`
--

LOCK TABLES `ost_file` WRITE;
/*!40000 ALTER TABLE `ost_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_file_chunk`
--

DROP TABLE IF EXISTS `ost_file_chunk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_file_chunk` (
  `file_id` int NOT NULL,
  `chunk_id` int NOT NULL,
  `filedata` longblob NOT NULL,
  PRIMARY KEY (`file_id`,`chunk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_file_chunk`
--

LOCK TABLES `ost_file_chunk` WRITE;
/*!40000 ALTER TABLE `ost_file_chunk` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_file_chunk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_filter`
--

DROP TABLE IF EXISTS `ost_filter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_filter` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `execorder` int unsigned NOT NULL DEFAULT '99',
  `isactive` tinyint unsigned NOT NULL DEFAULT '1',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `status` int unsigned NOT NULL DEFAULT '0',
  `match_all_rules` tinyint unsigned NOT NULL DEFAULT '0',
  `stop_onmatch` tinyint unsigned NOT NULL DEFAULT '0',
  `target` enum('Any','Web','Email','API') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Any',
  `email_id` int unsigned NOT NULL DEFAULT '0',
  `priority_id` int unsigned NOT NULL DEFAULT '0',
  `dept_id` int unsigned NOT NULL DEFAULT '0',
  `topic_id` int unsigned NOT NULL DEFAULT '0',
  `staff_id` int unsigned NOT NULL DEFAULT '0',
  `team_id` int unsigned NOT NULL DEFAULT '0',
  `sla_id` int unsigned NOT NULL DEFAULT '0',
  `page_id` int unsigned NOT NULL DEFAULT '0',
  `sequence_id` int unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `target` (`target`),
  KEY `email_id` (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_filter`
--

LOCK TABLES `ost_filter` WRITE;
/*!40000 ALTER TABLE `ost_filter` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_filter_action`
--

DROP TABLE IF EXISTS `ost_filter_action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_filter_action` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `filter_id` int unsigned NOT NULL,
  `sort` int unsigned NOT NULL DEFAULT '0',
  `type` varchar(24) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `configuration` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `updated` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filter_id` (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_filter_action`
--

LOCK TABLES `ost_filter_action` WRITE;
/*!40000 ALTER TABLE `ost_filter_action` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_filter_action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_filter_rule`
--

DROP TABLE IF EXISTS `ost_filter_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_filter_rule` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `filter_id` int unsigned NOT NULL DEFAULT '0',
  `what` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `how` enum('equal','not_equal','contains','dn_contain','starts','ends','match','not_match') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `val` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `isactive` tinyint unsigned NOT NULL DEFAULT '1',
  `notes` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filter` (`filter_id`,`what`,`how`,`val`),
  KEY `filter_id` (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_filter_rule`
--

LOCK TABLES `ost_filter_rule` WRITE;
/*!40000 ALTER TABLE `ost_filter_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_filter_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_form`
--

DROP TABLE IF EXISTS `ost_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_form` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `pid` int unsigned DEFAULT NULL,
  `type` varchar(8) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'G',
  `flags` int unsigned NOT NULL DEFAULT '1',
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `instructions` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_form`
--

LOCK TABLES `ost_form` WRITE;
/*!40000 ALTER TABLE `ost_form` DISABLE KEYS */;
INSERT INTO `ost_form` VALUES (1,NULL,'C',1,'Informaci??n de Contacto',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(2,NULL,'T',1,'Detalles del Ticket',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(3,NULL,'U',1,'Informaci??n de Usuario',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(4,NULL,'O',1,'Organization Information','Details on user organization',NULL,'2025-10-22 09:36:58','2025-10-22 09:36:58');
/*!40000 ALTER TABLE `ost_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_form_entry`
--

DROP TABLE IF EXISTS `ost_form_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_form_entry` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int unsigned NOT NULL,
  `object_id` int unsigned DEFAULT NULL,
  `object_type` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'T',
  `sort` int unsigned NOT NULL DEFAULT '1',
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_lookup` (`object_type`,`object_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_form_entry`
--

LOCK TABLES `ost_form_entry` WRITE;
/*!40000 ALTER TABLE `ost_form_entry` DISABLE KEYS */;
INSERT INTO `ost_form_entry` VALUES (1,4,1,'O',1,NULL,'2025-10-22 09:36:58','2025-10-22 09:36:58'),(2,3,1,'U',1,NULL,'2025-10-22 09:36:58','2025-10-22 09:36:58'),(3,2,1,'T',0,'{\"disable\":[]}','2025-10-22 09:36:59','2025-10-22 09:36:59'),(4,2,2,'T',0,'{\"disable\":[]}','2025-10-22 10:05:39','2025-10-22 10:05:39'),(5,2,3,'T',0,'{\"disable\":[]}','2025-10-22 10:12:14','2025-10-22 10:12:14'),(6,2,4,'T',0,'{\"disable\":[]}','2025-10-22 10:14:41','2025-10-22 10:14:41'),(7,2,5,'T',0,'{\"disable\":[]}','2025-10-22 10:16:15','2025-10-22 10:16:15'),(8,2,7,'T',0,'{\"disable\":[]}','2025-10-22 10:53:28','2025-10-22 10:53:28'),(9,3,101,'U',1,NULL,'2025-10-22 11:37:10','2025-10-22 11:37:10'),(10,2,8,'T',0,'{\"disable\":[]}','2025-10-22 11:37:10','2025-10-22 11:37:10'),(11,3,102,'U',1,NULL,'2025-10-22 11:39:14','2025-10-22 11:39:14'),(12,2,9,'T',0,'{\"disable\":[]}','2025-10-22 11:39:14','2025-10-22 11:39:14'),(13,2,10,'T',0,'{\"disable\":[]}','2025-10-22 11:42:15','2025-10-22 11:42:15'),(17,2,14,'T',1,NULL,'2025-10-22 12:15:52','2025-10-22 12:15:52'),(18,2,15,'T',1,NULL,'2025-10-22 12:16:13','2025-10-22 12:16:13'),(19,2,16,'T',1,NULL,'2025-10-22 12:17:39','2025-10-22 12:17:39'),(20,2,17,'T',1,NULL,'2025-10-22 12:20:49','2025-10-22 12:20:49'),(21,2,18,'T',1,NULL,'2025-10-22 12:58:30','2025-10-22 12:58:30'),(22,2,19,'T',1,NULL,'2025-10-22 12:59:16','2025-10-22 12:59:16');
/*!40000 ALTER TABLE `ost_form_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_form_entry_values`
--

DROP TABLE IF EXISTS `ost_form_entry_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_form_entry_values` (
  `entry_id` int unsigned NOT NULL,
  `field_id` int unsigned NOT NULL,
  `value` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `value_id` int DEFAULT NULL,
  PRIMARY KEY (`entry_id`,`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_form_entry_values`
--

LOCK TABLES `ost_form_entry_values` WRITE;
/*!40000 ALTER TABLE `ost_form_entry_values` DISABLE KEYS */;
INSERT INTO `ost_form_entry_values` VALUES (1,11,'420 Desoto Street\nAlexandria, LA 71301',NULL),(1,12,'3182903674',NULL),(1,13,'http://osticket.com',NULL),(1,14,'Not only do we develop the software, we also use it to manage support for osTicket. Let us help you quickly implement and leverage the full potential of osTicket\'s features and functionality. Contact us for professional support or visit our website for documentation and community support.',NULL),(2,9,'3152231488',NULL),(3,6,'Normal',2),(4,6,'Alta',3),(5,6,'Normal',2),(6,6,'Normal',2),(7,6,'Alta',3),(8,6,NULL,2),(9,9,'23121212',NULL),(10,6,'Normal',2),(11,9,'315231484',NULL),(12,6,'Normal',2),(13,6,'Normal',2),(17,4,'internet',NULL),(17,5,'jhjjkghlkjjk',NULL),(17,6,'3',NULL),(18,4,'internet',NULL),(18,5,'31321',NULL),(18,6,'2',NULL),(19,4,'internet',NULL),(19,5,'ghkgghhjk',NULL),(19,6,'2',NULL),(20,4,'internet',NULL),(20,5,'123456',NULL),(20,6,'2',NULL),(21,4,'internet',NULL),(21,5,'Ayuda con esto por favor',NULL),(21,6,'2',NULL),(22,4,'internet',NULL),(22,5,'Ayuda por favor',NULL),(22,6,'2',NULL);
/*!40000 ALTER TABLE `ost_form_entry_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_form_field`
--

DROP TABLE IF EXISTS `ost_form_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_form_field` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int unsigned NOT NULL,
  `flags` int unsigned DEFAULT '1',
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'text',
  `label` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `configuration` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `sort` int unsigned NOT NULL,
  `hint` varchar(512) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_form_field`
--

LOCK TABLES `ost_form_field` WRITE;
/*!40000 ALTER TABLE `ost_form_field` DISABLE KEYS */;
INSERT INTO `ost_form_field` VALUES (1,1,489395,'text','Direcci??n de Email','email','{\"size\":40,\"length\":64,\"validator\":\"email\"}',1,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(2,1,489395,'text','Nombre completo','name','{\"size\":40,\"length\":64}',2,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(3,1,489393,'phone','N??mero de Tel??fono','phone','{\"ext\":false}',3,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(4,2,489395,'text','Resumen del problema','subject','{\"size\":40,\"length\":50}',1,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(5,2,480547,'thread','Descripci??n detallada','message','{}',2,'Detalles','2025-10-22 09:33:01','2025-10-22 09:33:01'),(6,2,274609,'priority','Nivel de Prioridad','priority','{}',3,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(7,3,489395,'text','Nombre','name','{\"size\":40,\"length\":128}',1,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(8,3,489395,'text','Email','email','{\"size\":40,\"length\":255,\"validator\":\"email\"}',2,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(9,3,489393,'phone','Tel??fono','phone','{\"ext\":false}',3,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(10,4,489379,'text','Name','name','{\"size\":40,\"length\":64}',1,NULL,'2025-10-22 09:36:58','2025-10-22 09:36:58'),(11,4,13057,'memo','Address','address','{\"rows\":2,\"cols\":40,\"length\":100,\"html\":false}',2,NULL,'2025-10-22 09:36:58','2025-10-22 09:36:58'),(12,4,13057,'phone','Phone','phone',NULL,3,NULL,'2025-10-22 09:36:58','2025-10-22 09:36:58'),(13,4,13057,'text','Website','website','{\"size\":40,\"length\":0}',4,NULL,'2025-10-22 09:36:58','2025-10-22 09:36:58'),(14,4,12289,'memo','Internal Notes','notes','{\"rows\":4,\"cols\":40}',5,NULL,'2025-10-22 09:36:58','2025-10-22 09:36:58');
/*!40000 ALTER TABLE `ost_form_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_help_topic`
--

DROP TABLE IF EXISTS `ost_help_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_help_topic` (
  `topic_id` int unsigned NOT NULL AUTO_INCREMENT,
  `topic_pid` int unsigned NOT NULL DEFAULT '0',
  `isactive` tinyint unsigned NOT NULL DEFAULT '1',
  `ispublic` tinyint unsigned NOT NULL DEFAULT '1',
  `noautoresp` tinyint unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `status_id` int unsigned NOT NULL DEFAULT '0',
  `priority_id` int unsigned NOT NULL DEFAULT '0',
  `dept_id` int unsigned NOT NULL DEFAULT '0',
  `staff_id` int unsigned NOT NULL DEFAULT '0',
  `team_id` int unsigned NOT NULL DEFAULT '0',
  `sla_id` int unsigned NOT NULL DEFAULT '0',
  `page_id` int unsigned NOT NULL DEFAULT '0',
  `sequence_id` int unsigned NOT NULL DEFAULT '0',
  `sort` int unsigned NOT NULL DEFAULT '0',
  `topic` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `number_format` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
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
  KEY `page_id` (`page_id`),
  KEY `sequence_id` (`sequence_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_help_topic`
--

LOCK TABLES `ost_help_topic` WRITE;
/*!40000 ALTER TABLE `ost_help_topic` DISABLE KEYS */;
INSERT INTO `ost_help_topic` VALUES (1,0,1,1,0,2,0,2,1,0,0,0,0,0,1,'Consulta General',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(2,0,1,1,0,2,0,2,1,0,0,0,0,0,2,'Problema T??cnico',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(3,0,1,1,0,2,0,3,1,0,0,0,0,0,3,'Petici??n',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(4,0,1,1,0,2,0,2,2,0,0,0,0,0,4,'Queja',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(5,0,1,1,0,2,0,2,2,0,0,0,0,0,5,'Reclamo',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(6,0,1,1,0,2,0,1,2,0,0,0,0,0,6,'Sugerencia',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(7,0,1,1,0,2,0,2,3,0,0,0,0,0,7,'Facturaci??n',NULL,NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01'),(8,0,1,1,0,0,0,4,1,0,0,0,0,0,8,'Incidente de Seguridad',NULL,NULL,'2025-10-22 13:10:12','2025-10-22 13:10:12');
/*!40000 ALTER TABLE `ost_help_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_help_topic_form`
--

DROP TABLE IF EXISTS `ost_help_topic_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_help_topic_form` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` int unsigned NOT NULL DEFAULT '0',
  `form_id` int unsigned NOT NULL DEFAULT '0',
  `sort` int unsigned NOT NULL DEFAULT '1',
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `topic-form` (`topic_id`,`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_help_topic_form`
--

LOCK TABLES `ost_help_topic_form` WRITE;
/*!40000 ALTER TABLE `ost_help_topic_form` DISABLE KEYS */;
INSERT INTO `ost_help_topic_form` VALUES (1,1,2,1,NULL),(2,2,2,1,NULL),(3,3,2,1,NULL),(4,4,2,1,NULL),(5,5,2,1,NULL),(6,6,2,1,NULL),(7,7,2,1,NULL);
/*!40000 ALTER TABLE `ost_help_topic_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_list`
--

DROP TABLE IF EXISTS `ost_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_list` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name_plural` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sort_mode` enum('Alpha','-Alpha','SortCol') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Alpha',
  `masks` int unsigned NOT NULL DEFAULT '0',
  `type` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `configuration` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_list`
--

LOCK TABLES `ost_list` WRITE;
/*!40000 ALTER TABLE `ost_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_list_items`
--

DROP TABLE IF EXISTS `ost_list_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_list_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `list_id` int DEFAULT NULL,
  `status` int unsigned NOT NULL DEFAULT '1',
  `value` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `extra` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `sort` int NOT NULL DEFAULT '1',
  `properties` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `list_item_lookup` (`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_list_items`
--

LOCK TABLES `ost_list_items` WRITE;
/*!40000 ALTER TABLE `ost_list_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_list_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_lock`
--

DROP TABLE IF EXISTS `ost_lock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_lock` (
  `lock_id` int unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int unsigned NOT NULL DEFAULT '0',
  `expire` datetime NOT NULL,
  `code` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`lock_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_lock`
--

LOCK TABLES `ost_lock` WRITE;
/*!40000 ALTER TABLE `ost_lock` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_lock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_organization`
--

DROP TABLE IF EXISTS `ost_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_organization` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `manager` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `status` int unsigned NOT NULL DEFAULT '0',
  `domain` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_organization`
--

LOCK TABLES `ost_organization` WRITE;
/*!40000 ALTER TABLE `ost_organization` DISABLE KEYS */;
INSERT INTO `ost_organization` VALUES (1,'osTicket','',8,'',NULL,'2025-10-22 09:36:58','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ost_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_organization__cdata`
--

DROP TABLE IF EXISTS `ost_organization__cdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_organization__cdata` (
  `org_id` int unsigned NOT NULL,
  `name` mediumtext,
  `address` mediumtext,
  `phone` varchar(24) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_organization__cdata`
--

LOCK TABLES `ost_organization__cdata` WRITE;
/*!40000 ALTER TABLE `ost_organization__cdata` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_organization__cdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_plugin`
--

DROP TABLE IF EXISTS `ost_plugin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_plugin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `install_path` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `isphar` tinyint(1) NOT NULL DEFAULT '0',
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `version` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `installed` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `install_path` (`install_path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_plugin`
--

LOCK TABLES `ost_plugin` WRITE;
/*!40000 ALTER TABLE `ost_plugin` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_plugin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_plugin_instance`
--

DROP TABLE IF EXISTS `ost_plugin_instance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_plugin_instance` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `plugin_id` int unsigned NOT NULL,
  `flags` int NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_plugin_instance`
--

LOCK TABLES `ost_plugin_instance` WRITE;
/*!40000 ALTER TABLE `ost_plugin_instance` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_plugin_instance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_queue`
--

DROP TABLE IF EXISTS `ost_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_queue` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned NOT NULL DEFAULT '0',
  `columns_id` int unsigned DEFAULT NULL,
  `sort_id` int unsigned DEFAULT NULL,
  `flags` int unsigned NOT NULL DEFAULT '0',
  `staff_id` int unsigned NOT NULL DEFAULT '0',
  `sort` int unsigned NOT NULL DEFAULT '0',
  `title` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `config` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `filter` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `root` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `path` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '/',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_queue`
--

LOCK TABLES `ost_queue` WRITE;
/*!40000 ALTER TABLE `ost_queue` DISABLE KEYS */;
INSERT INTO `ost_queue` VALUES (7,0,NULL,NULL,3,0,1,'Open',NULL,NULL,'Open','/','2025-10-22 11:26:21','2025-10-22 11:26:21');
/*!40000 ALTER TABLE `ost_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_queue_column`
--

DROP TABLE IF EXISTS `ost_queue_column`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_queue_column` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `flags` int unsigned NOT NULL DEFAULT '0',
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `primary` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `secondary` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `filter` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `truncate` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `annotations` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `conditions` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_queue_column`
--

LOCK TABLES `ost_queue_column` WRITE;
/*!40000 ALTER TABLE `ost_queue_column` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_queue_column` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_queue_columns`
--

DROP TABLE IF EXISTS `ost_queue_columns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_queue_columns` (
  `queue_id` int unsigned NOT NULL,
  `column_id` int unsigned NOT NULL,
  `staff_id` int unsigned NOT NULL,
  `bits` int unsigned NOT NULL DEFAULT '0',
  `sort` int unsigned NOT NULL DEFAULT '1',
  `width` int unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`queue_id`,`column_id`,`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_queue_columns`
--

LOCK TABLES `ost_queue_columns` WRITE;
/*!40000 ALTER TABLE `ost_queue_columns` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_queue_columns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_queue_sort`
--

DROP TABLE IF EXISTS `ost_queue_sort`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_queue_sort` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `root` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `columns` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_queue_sort`
--

LOCK TABLES `ost_queue_sort` WRITE;
/*!40000 ALTER TABLE `ost_queue_sort` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_queue_sort` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_queue_sorts`
--

DROP TABLE IF EXISTS `ost_queue_sorts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_queue_sorts` (
  `queue_id` int unsigned NOT NULL,
  `sort_id` int unsigned NOT NULL,
  PRIMARY KEY (`queue_id`,`sort_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_queue_sorts`
--

LOCK TABLES `ost_queue_sorts` WRITE;
/*!40000 ALTER TABLE `ost_queue_sorts` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_queue_sorts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_role`
--

DROP TABLE IF EXISTS `ost_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `flags` int unsigned NOT NULL DEFAULT '1',
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `permissions` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_role`
--

LOCK TABLES `ost_role` WRITE;
/*!40000 ALTER TABLE `ost_role` DISABLE KEYS */;
INSERT INTO `ost_role` VALUES (1,1,'Super Administrador','{\"ticket.assign\":1,\"ticket.close\":1,\"ticket.create\":1,\"ticket.delete\":1,\"ticket.edit\":1,\"ticket.link\":1,\"ticket.markanswered\":1,\"ticket.merge\":1,\"ticket.reply\":1,\"ticket.transfer\":1,\"ticket.view\":1,\"task.assign\":1,\"task.close\":1,\"task.create\":1,\"task.delete\":1,\"task.edit\":1,\"task.reply\":1,\"task.transfer\":1,\"task.view\":1,\"canned.manage\":1,\"faq.manage\":1,\"visibility.agents\":1,\"emails.banlist\":1,\"staff.manage\":1,\"dept.manage\":1,\"org.manage\":1,\"user.manage\":1}','Acceso total al sistema','2025-10-22 09:33:01','2025-10-22 09:33:01'),(2,1,'Agente','{\"ticket.assign\":1,\"ticket.close\":1,\"ticket.create\":1,\"ticket.edit\":1,\"ticket.reply\":1,\"task.assign\":1,\"task.close\":1,\"task.create\":1,\"task.reply\":1}','Agente de soporte est??ndar','2025-10-22 09:33:01','2025-10-22 09:33:01');
/*!40000 ALTER TABLE `ost_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_schedule`
--

DROP TABLE IF EXISTS `ost_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_schedule` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `flags` int unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `timezone` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_schedule`
--

LOCK TABLES `ost_schedule` WRITE;
/*!40000 ALTER TABLE `ost_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_schedule_entry`
--

DROP TABLE IF EXISTS `ost_schedule_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_schedule_entry` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `sort` tinyint unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `repeats` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'never',
  `starts_on` date DEFAULT NULL,
  `starts_at` time DEFAULT NULL,
  `ends_on` date DEFAULT NULL,
  `ends_at` time DEFAULT NULL,
  `stops_on` datetime DEFAULT NULL,
  `day` tinyint DEFAULT NULL,
  `week` tinyint DEFAULT NULL,
  `month` tinyint DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schedule_id` (`schedule_id`),
  KEY `repeats` (`repeats`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_schedule_entry`
--

LOCK TABLES `ost_schedule_entry` WRITE;
/*!40000 ALTER TABLE `ost_schedule_entry` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_schedule_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_sequence`
--

DROP TABLE IF EXISTS `ost_sequence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_sequence` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `flags` int unsigned DEFAULT NULL,
  `next` bigint unsigned NOT NULL DEFAULT '1',
  `increment` int DEFAULT '1',
  `padding` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_sequence`
--

LOCK TABLES `ost_sequence` WRITE;
/*!40000 ALTER TABLE `ost_sequence` DISABLE KEYS */;
INSERT INTO `ost_sequence` VALUES (1,'Ticket Sequence',NULL,100015,1,'0','2025-10-22 12:59:16'),(2,'Task Sequence',NULL,1,1,'0','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ost_sequence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_session`
--

DROP TABLE IF EXISTS `ost_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_session` (
  `session_id` varchar(255) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT '',
  `session_data` blob,
  `session_expire` datetime DEFAULT NULL,
  `session_updated` datetime DEFAULT NULL,
  `user_id` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0' COMMENT 'osTicket staff/client ID',
  `user_ip` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `updated` (`session_updated`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_session`
--

LOCK TABLES `ost_session` WRITE;
/*!40000 ALTER TABLE `ost_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_sla`
--

DROP TABLE IF EXISTS `ost_sla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_sla` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `schedule_id` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `grace_period` int unsigned NOT NULL DEFAULT '0',
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_sla`
--

LOCK TABLES `ost_sla` WRITE;
/*!40000 ALTER TABLE `ost_sla` DISABLE KEYS */;
INSERT INTO `ost_sla` VALUES (1,0,3,18,'SLA por Defecto',NULL,'2025-10-22 09:33:01','2025-10-22 09:33:01');
/*!40000 ALTER TABLE `ost_sla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_staff`
--

DROP TABLE IF EXISTS `ost_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_staff` (
  `staff_id` int unsigned NOT NULL AUTO_INCREMENT,
  `dept_id` int unsigned NOT NULL DEFAULT '0',
  `role_id` int unsigned NOT NULL DEFAULT '0',
  `username` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `firstname` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `lastname` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `passwd` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `backend` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(24) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `phone_ext` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mobile` varchar(24) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `signature` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `timezone` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `lang` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `locale` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `isvisible` tinyint unsigned NOT NULL DEFAULT '1',
  `onvacation` tinyint unsigned NOT NULL DEFAULT '0',
  `assigned_only` tinyint unsigned NOT NULL DEFAULT '0',
  `show_assigned_tickets` tinyint unsigned NOT NULL DEFAULT '0',
  `change_passwd` tinyint unsigned NOT NULL DEFAULT '0',
  `max_page_size` int unsigned NOT NULL DEFAULT '0',
  `auto_refresh_rate` int unsigned NOT NULL DEFAULT '0',
  `default_signature_type` enum('none','mine','dept') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'none',
  `default_paper_size` enum('Letter','Legal','Ledger','A4','A3') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Letter',
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `permissions` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_staff`
--

LOCK TABLES `ost_staff` WRITE;
/*!40000 ALTER TABLE `ost_staff` DISABLE KEYS */;
INSERT INTO `ost_staff` VALUES (1,1,1,'admin','Administrador','Sistema','$2a$08$dj6CuxfE.bOlR79bZYmgH.AORHgDhfSL6mHKlRlq9hQPgv2QJ1YLm',NULL,'admin@localhost','',NULL,'','Equipo de Soporte',NULL,'es_ES',NULL,1,1,1,0,0,0,0,25,0,'none','Letter','{\"browser_lang\":\"en_US\"}',NULL,'2025-10-22 09:33:01','2025-10-22 11:27:36','2025-10-22 09:33:01','2025-10-22 11:27:36');
/*!40000 ALTER TABLE `ost_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_staff_dept_access`
--

DROP TABLE IF EXISTS `ost_staff_dept_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_staff_dept_access` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` int unsigned NOT NULL DEFAULT '0',
  `dept_id` int unsigned NOT NULL DEFAULT '0',
  `role_id` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_dept` (`staff_id`,`dept_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_staff_dept_access`
--

LOCK TABLES `ost_staff_dept_access` WRITE;
/*!40000 ALTER TABLE `ost_staff_dept_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_staff_dept_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_syslog`
--

DROP TABLE IF EXISTS `ost_syslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_syslog` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `log_type` enum('Debug','Warning','Error') NOT NULL,
  `title` varchar(255) NOT NULL,
  `log` text NOT NULL,
  `logger` varchar(64) NOT NULL,
  `ip_address` varchar(64) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `log_type` (`log_type`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_syslog`
--

LOCK TABLES `ost_syslog` WRITE;
/*!40000 ALTER TABLE `ost_syslog` DISABLE KEYS */;
INSERT INTO `ost_syslog` VALUES (1,'Error','DB Error #1054','[INSERT INTO `ost_user__cdata` SET `phone`=3152231488, `user_id`= 1 ON DUPLICATE KEY UPDATE `phone`=3152231488] Unknown column \'phone\' in \'field list\'<br /> <br /> ---- Backtrace ----<br /> #0 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\mysqli.php(205): osTicket-&gt;logDBError(\'DB Error #1054\', \'[INSERT INTO `o...\')<br /> #1 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.dynamic_forms.php(327): db_query(\'INSERT INTO `os...\')<br /> #2 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.dynamic_forms.php(343): DynamicForm::updateDynamicDataView(Object(DynamicFormEntryAnswer), NULL)<br /> #3 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.signal.php(98): DynamicForm::updateDynamicFormEntryAnswer(Object(DynamicFormEntryAnswer), NULL)<br /> #4 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.orm.php(619): Signal::send(\'model.created\', Object(DynamicFormEntryAnswer))<br /> #5 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.dynamic_forms.php(1431): VerySimpleModel-&gt;save(false)<br /> #6 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.dynamic_forms.php(1273): DynamicFormEntryAnswer-&gt;save(false)<br /> #7 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.user.php(316): DynamicFormEntry-&gt;save()<br /> #8 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.user.php(366): User-&gt;addForm(Object(UserForm), 1, Array)<br /> #9 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.user.php(228): User-&gt;addDynamicData(Array)<br /> #10 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.ticket.php(3230): User::fromVars(Array, true)<br /> #11 C:\\laragon\\www\\proditel\\pqr\\upload\\open.php(42): Ticket::create(Array, Array, \'Web\')<br /> #12 {main}','','::1','2025-10-22 09:36:59','2025-10-22 09:36:59'),(2,'Error','DB Error #1054','[INSERT INTO `ost_thread_event` SET `dept_id` = 1, `topic_id` = 1, `timestamp` = NOW(), `uid_type` = \'U\', `uid` = 1, `username` = \'SYSTEM\', `state` = \'created\', `thread_id` = 1] Unknown column \'uid_type\' in \'field list\'<br /> <br /> ---- Backtrace ----<br /> #0 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\mysqli.php(205): osTicket-&gt;logDBError(\'DB Error #1054\', \'[INSERT INTO `o...\')<br /> #1 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.orm.php(3133): db_query(\'INSERT INTO `os...\', true, true)<br /> #2 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.orm.php(597): MySqlExecutor-&gt;execute()<br /> #3 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.thread.php(1818): VerySimpleModel-&gt;save()<br /> #4 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.ticket.php(2593): ThreadEvents-&gt;log(Object(Ticket), \'created\', NULL, Object(User), NULL)<br /> #5 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\class.ticket.php(3400): Ticket-&gt;logEvent(\'created\', NULL, Object(User))<br /> #6 C:\\laragon\\www\\proditel\\pqr\\upload\\open.php(42): Ticket::create(Array, Array, \'Web\')<br /> #7 {main}','','::1','2025-10-22 09:36:59','2025-10-22 09:36:59'),(3,'Warning','Failed agent login attempt (admin)','Username: admin IP: ::1 Time: Oct 22, 2025, 2:43 pm UTC Attempts: 3','','::1','2025-10-22 09:43:37','2025-10-22 09:43:37'),(4,'Error','DB Error #1054','[SELECT log.* FROM ost_syslog log WHERE 1 ORDER BY log.log_id DESC LIMIT 0,25] Unknown column \'log.log_id\' in \'order clause\'<br /> <br /> ---- Backtrace ----<br /> #0 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\mysqli.php(205): osTicket-&gt;logDBError(\'DB Error #1054\', \'[SELECT log.* ...\')<br /> #1 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\staff\\syslogs.inc.php(80): db_query(\'SELECT log.* ...\')<br /> #2 C:\\laragon\\www\\proditel\\pqr\\upload\\scp\\logs.php(56): require(\'C:\\\\laragon\\\\www\\\\...\')<br /> #3 {main}','','::1','2025-10-22 09:50:01','2025-10-22 09:50:01'),(5,'Error','DB Error #1054','[SELECT log.* FROM ost_syslog log WHERE 1 ORDER BY log.log_id DESC LIMIT 0,25] Unknown column \'log.log_id\' in \'order clause\'<br /> <br /> ---- Backtrace ----<br /> #0 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\mysqli.php(205): osTicket-&gt;logDBError(\'DB Error #1054\', \'[SELECT log.* ...\')<br /> #1 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\staff\\syslogs.inc.php(80): db_query(\'SELECT log.* ...\')<br /> #2 C:\\laragon\\www\\proditel\\pqr\\upload\\scp\\logs.php(56): require(\'C:\\\\laragon\\\\www\\\\...\')<br /> #3 {main}','','::1','2025-10-22 09:50:14','2025-10-22 09:50:14'),(6,'Error','DB Error #1054','[SELECT log.* FROM ost_syslog log WHERE 1 ORDER BY log.log_id DESC LIMIT 0,25] Unknown column \'log.log_id\' in \'order clause\'<br /> <br /> ---- Backtrace ----<br /> #0 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\mysqli.php(205): osTicket-&gt;logDBError(\'DB Error #1054\', \'[SELECT log.* ...\')<br /> #1 C:\\laragon\\www\\proditel\\pqr\\upload\\include\\staff\\syslogs.inc.php(80): db_query(\'SELECT log.* ...\')<br /> #2 C:\\laragon\\www\\proditel\\pqr\\upload\\scp\\logs.php(56): require(\'C:\\\\laragon\\\\www\\\\...\')<br /> #3 {main}','','::1','2025-10-22 09:50:22','2025-10-22 09:50:22'),(7,'Warning','Invalid CSRF Token __CSRFToken__','Invalid CSRF token [f7d0ff01f15be7ddb7f74f31f064e10ac229da99] on http://localhost/proditel/pqr/upload/open.php','','::1','2025-10-22 10:16:05','2025-10-22 10:16:05');
/*!40000 ALTER TABLE `ost_syslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_task`
--

DROP TABLE IF EXISTS `ost_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_task` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int NOT NULL DEFAULT '0',
  `object_type` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dept_id` int unsigned NOT NULL DEFAULT '0',
  `staff_id` int unsigned NOT NULL DEFAULT '0',
  `team_id` int unsigned NOT NULL DEFAULT '0',
  `lock_id` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `duedate` datetime DEFAULT NULL,
  `closed` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dept_id` (`dept_id`),
  KEY `staff_id` (`staff_id`),
  KEY `team_id` (`team_id`),
  KEY `created` (`created`),
  KEY `object` (`object_id`,`object_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_task`
--

LOCK TABLES `ost_task` WRITE;
/*!40000 ALTER TABLE `ost_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_task__cdata`
--

DROP TABLE IF EXISTS `ost_task__cdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_task__cdata` (
  `task_id` int unsigned NOT NULL,
  `title` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_task__cdata`
--

LOCK TABLES `ost_task__cdata` WRITE;
/*!40000 ALTER TABLE `ost_task__cdata` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_task__cdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_team`
--

DROP TABLE IF EXISTS `ost_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_team` (
  `team_id` int unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '1',
  `name` varchar(125) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `notes` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`team_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_team`
--

LOCK TABLES `ost_team` WRITE;
/*!40000 ALTER TABLE `ost_team` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_team_member`
--

DROP TABLE IF EXISTS `ost_team_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_team_member` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `team_id` int unsigned NOT NULL DEFAULT '0',
  `staff_id` int unsigned NOT NULL,
  `flags` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_staff` (`team_id`,`staff_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_team_member`
--

LOCK TABLES `ost_team_member` WRITE;
/*!40000 ALTER TABLE `ost_team_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_team_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_thread`
--

DROP TABLE IF EXISTS `ost_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_thread` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int unsigned NOT NULL,
  `object_type` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `lastresponse` datetime DEFAULT NULL,
  `lastmessage` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `object_type` (`object_type`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_thread`
--

LOCK TABLES `ost_thread` WRITE;
/*!40000 ALTER TABLE `ost_thread` DISABLE KEYS */;
INSERT INTO `ost_thread` VALUES (1,1,'T',NULL,NULL,'2025-10-22 09:36:59','2025-10-22 09:36:59'),(2,2,'T',NULL,NULL,'2025-10-22 10:05:39','2025-10-22 10:05:39'),(3,3,'T',NULL,NULL,'2025-10-22 10:12:14','2025-10-22 10:12:14'),(4,4,'T',NULL,NULL,'2025-10-22 10:14:41','2025-10-22 10:14:41'),(5,5,'T',NULL,NULL,'2025-10-22 10:16:15','2025-10-22 10:16:15'),(7,7,'T',NULL,NULL,'2025-10-22 10:53:28','2025-10-22 10:53:28'),(8,8,'T',NULL,NULL,'2025-10-22 11:37:10','2025-10-22 11:37:10'),(9,9,'T',NULL,NULL,'2025-10-22 11:39:14','2025-10-22 11:39:14'),(10,10,'T',NULL,NULL,'2025-10-22 11:42:15','2025-10-22 11:42:15'),(14,14,'T',NULL,NULL,'2025-10-22 12:15:52','2025-10-22 12:15:52'),(15,15,'T',NULL,NULL,'2025-10-22 12:16:13','2025-10-22 12:16:13'),(16,16,'T',NULL,NULL,'2025-10-22 12:17:39','2025-10-22 12:17:39'),(17,17,'T',NULL,NULL,'2025-10-22 12:20:49','2025-10-22 12:20:49'),(18,18,'T',NULL,NULL,'2025-10-22 12:58:30','2025-10-22 12:58:30'),(19,19,'T',NULL,NULL,'2025-10-22 12:59:16','2025-10-22 12:59:16');
/*!40000 ALTER TABLE `ost_thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_thread_collaborator`
--

DROP TABLE IF EXISTS `ost_thread_collaborator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_thread_collaborator` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `flags` int unsigned NOT NULL DEFAULT '1',
  `thread_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `role` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'M',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `collab` (`thread_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_thread_collaborator`
--

LOCK TABLES `ost_thread_collaborator` WRITE;
/*!40000 ALTER TABLE `ost_thread_collaborator` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_thread_collaborator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_thread_entry`
--

DROP TABLE IF EXISTS `ost_thread_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_thread_entry` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `pid` int unsigned NOT NULL DEFAULT '0',
  `thread_id` int unsigned NOT NULL DEFAULT '0',
  `staff_id` int unsigned NOT NULL DEFAULT '0',
  `user_id` int unsigned NOT NULL DEFAULT '0',
  `type` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `flags` int unsigned NOT NULL DEFAULT '0',
  `poster` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `editor` int unsigned DEFAULT NULL,
  `source` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `body` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `format` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'html',
  `ip_address` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `recipients` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `thread_id` (`thread_id`),
  KEY `staff_id` (`staff_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_thread_entry`
--

LOCK TABLES `ost_thread_entry` WRITE;
/*!40000 ALTER TABLE `ost_thread_entry` DISABLE KEYS */;
INSERT INTO `ost_thread_entry` VALUES (1,0,1,0,1,'M',65,'juan david Ramirez',NULL,'',NULL,'ver fotos','html','::1',NULL,NULL,'2025-10-22 09:36:59','0000-00-00 00:00:00'),(2,0,2,0,1,'M',65,'juan david Ramirez',NULL,'',NULL,'ayudame','html','::1',NULL,NULL,'2025-10-22 10:05:39','0000-00-00 00:00:00'),(3,0,3,0,1,'M',65,'juan david Ramirez',NULL,'',NULL,'ayuyida','html','::1',NULL,NULL,'2025-10-22 10:12:14','0000-00-00 00:00:00'),(4,0,4,0,1,'M',65,'juan david Ramirez',NULL,'',NULL,'ayudsa','html','::1',NULL,NULL,'2025-10-22 10:14:41','0000-00-00 00:00:00'),(5,0,5,0,1,'M',65,'juan david Ramirez',NULL,'',NULL,'adasasa','html','::1',NULL,NULL,'2025-10-22 10:16:15','0000-00-00 00:00:00'),(7,0,7,0,1,'M',65,'juan david Ramirez',NULL,'Phone',NULL,'Este es un ticket de prueba creado desde el panel de administración.<br /><br />Por favor confirmar que todo funciona correctamente.<br />','html','::1',NULL,NULL,'2025-10-22 10:53:28','0000-00-00 00:00:00'),(8,0,8,0,101,'M',65,'Juan ',NULL,'',NULL,'qwqwq','html','::1',NULL,NULL,'2025-10-22 11:37:10','0000-00-00 00:00:00'),(9,0,9,0,102,'M',65,'juanda',NULL,'',NULL,'ayuda','html','::1',NULL,NULL,'2025-10-22 11:39:14','0000-00-00 00:00:00'),(10,0,10,0,101,'M',65,'Juan ',NULL,'',NULL,'qwqwq','html','::1',NULL,NULL,'2025-10-22 11:42:15','0000-00-00 00:00:00'),(11,0,7,1,0,'R',0,'Staff',NULL,'Web',NULL,'Solucionado','html','::1',NULL,NULL,'2025-10-22 11:46:11','2025-10-22 11:46:11'),(15,0,14,0,103,'M',0,'Juan Ramírez',NULL,'Web','internet','jhjjkghlkjjk','html','::1',NULL,NULL,'2025-10-22 12:15:52','2025-10-22 12:15:52'),(16,0,15,0,103,'M',0,'Juan Ramírez',NULL,'Web','internet','31321','html','::1',NULL,NULL,'2025-10-22 12:16:13','2025-10-22 12:16:13'),(17,0,16,0,103,'M',0,'Juan Ramírez',NULL,'Web','internet','ghkgghhjk','html','::1',NULL,NULL,'2025-10-22 12:17:39','2025-10-22 12:17:39'),(18,0,16,1,0,'R',0,'Staff',NULL,'Web',NULL,'jklñkj','html','::1',NULL,NULL,'2025-10-22 12:18:16','2025-10-22 12:18:16'),(19,0,17,0,103,'M',0,'Juan Ramírez',NULL,'Web','internet','123456','html','::1',NULL,NULL,'2025-10-22 12:20:49','2025-10-22 12:20:49'),(20,0,17,1,0,'R',0,'Staff',NULL,'Web',NULL,'solucionado','html','::1',NULL,NULL,'2025-10-22 12:21:35','2025-10-22 12:21:35'),(21,0,18,0,1,'M',0,'Juan_David_RC',NULL,'Web','internet','Ayuda con esto por favor','html','::1',NULL,NULL,'2025-10-22 12:58:30','2025-10-22 12:58:30'),(22,0,19,0,1,'M',0,'Juan_David_RC',NULL,'Web','internet','Ayuda por favor','html','::1',NULL,NULL,'2025-10-22 12:59:16','2025-10-22 12:59:16'),(23,0,19,1,0,'R',0,'Staff',NULL,'Web',NULL,'Vale ya te ayudamos a resolver este tikect','html','::1',NULL,NULL,'2025-10-22 13:01:46','2025-10-22 13:01:46');
/*!40000 ALTER TABLE `ost_thread_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_thread_entry_email`
--

DROP TABLE IF EXISTS `ost_thread_entry_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_thread_entry_email` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `thread_entry_id` int unsigned NOT NULL,
  `email_id` int unsigned DEFAULT NULL,
  `mid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `headers` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `thread_entry_id` (`thread_entry_id`),
  KEY `mid` (`mid`),
  KEY `email_id` (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_thread_entry_email`
--

LOCK TABLES `ost_thread_entry_email` WRITE;
/*!40000 ALTER TABLE `ost_thread_entry_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_thread_entry_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_thread_entry_merge`
--

DROP TABLE IF EXISTS `ost_thread_entry_merge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_thread_entry_merge` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `thread_entry_id` int unsigned NOT NULL,
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `thread_entry_id` (`thread_entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_thread_entry_merge`
--

LOCK TABLES `ost_thread_entry_merge` WRITE;
/*!40000 ALTER TABLE `ost_thread_entry_merge` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_thread_entry_merge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_thread_event`
--

DROP TABLE IF EXISTS `ost_thread_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_thread_event` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int unsigned NOT NULL DEFAULT '0',
  `staff_id` int unsigned NOT NULL,
  `team_id` int unsigned NOT NULL,
  `dept_id` int unsigned NOT NULL,
  `topic_id` int unsigned NOT NULL,
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `timestamp` datetime NOT NULL,
  `event_id` int unsigned DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thread_id` (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_thread_event`
--

LOCK TABLES `ost_thread_event` WRITE;
/*!40000 ALTER TABLE `ost_thread_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_thread_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_thread_referral`
--

DROP TABLE IF EXISTS `ost_thread_referral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_thread_referral` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `thread_id` int unsigned NOT NULL,
  `object_id` int unsigned NOT NULL,
  `object_type` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thread_id` (`thread_id`),
  KEY `object` (`object_id`,`object_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_thread_referral`
--

LOCK TABLES `ost_thread_referral` WRITE;
/*!40000 ALTER TABLE `ost_thread_referral` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_thread_referral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_ticket`
--

DROP TABLE IF EXISTS `ost_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_ticket` (
  `ticket_id` int unsigned NOT NULL AUTO_INCREMENT,
  `ticket_pid` int unsigned DEFAULT NULL,
  `number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` int unsigned NOT NULL DEFAULT '0',
  `user_email_id` int unsigned NOT NULL DEFAULT '0',
  `status_id` int unsigned NOT NULL DEFAULT '0',
  `dept_id` int unsigned NOT NULL DEFAULT '0',
  `sla_id` int unsigned NOT NULL DEFAULT '0',
  `topic_id` int unsigned NOT NULL DEFAULT '0',
  `staff_id` int unsigned NOT NULL DEFAULT '0',
  `team_id` int unsigned NOT NULL DEFAULT '0',
  `email_id` int unsigned NOT NULL DEFAULT '0',
  `lock_id` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `source` enum('Web','Email','Phone','API','Other') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Other',
  `source_extra` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `isanswered` tinyint unsigned NOT NULL DEFAULT '0',
  `isoverdue` tinyint unsigned NOT NULL DEFAULT '0',
  `isreopen` tinyint unsigned NOT NULL DEFAULT '0',
  `reopened` datetime DEFAULT NULL,
  `duedate` datetime DEFAULT NULL,
  `est_duedate` datetime DEFAULT NULL,
  `closed` datetime DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `user_id` (`user_id`),
  KEY `dept_id` (`dept_id`),
  KEY `staff_id` (`staff_id`),
  KEY `team_id` (`team_id`),
  KEY `status_id` (`status_id`),
  KEY `created` (`created`),
  KEY `closed` (`closed`),
  KEY `duedate` (`duedate`),
  KEY `topic_id` (`topic_id`),
  KEY `sla_id` (`sla_id`),
  KEY `isoverdue` (`isoverdue`),
  KEY `isanswered` (`isanswered`),
  KEY `ticket_pid` (`ticket_pid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_ticket`
--

LOCK TABLES `ost_ticket` WRITE;
/*!40000 ALTER TABLE `ost_ticket` DISABLE KEYS */;
INSERT INTO `ost_ticket` VALUES (1,NULL,'100000',1,1,1,1,1,1,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,'2025-10-23 03:36:59',NULL,'2025-10-22 09:36:59','2025-10-22 09:36:59','2025-10-22 09:36:59'),(2,NULL,'100001',1,1,1,1,1,3,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,'2025-10-23 04:05:39',NULL,'2025-10-22 10:05:39','2025-10-22 10:05:39','2025-10-22 10:05:39'),(3,NULL,'100002',1,1,1,1,1,1,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,'2025-10-23 04:12:14',NULL,'2025-10-22 10:12:14','2025-10-22 10:12:14','2025-10-22 10:12:14'),(4,NULL,'100003',1,1,1,1,1,1,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,'2025-10-23 04:14:41',NULL,'2025-10-22 10:14:41','2025-10-22 10:14:41','2025-10-22 10:14:41'),(5,NULL,'100004',1,1,1,1,1,3,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,'2025-10-23 04:16:15',NULL,'2025-10-22 10:16:15','2025-10-22 10:16:15','2025-10-22 10:16:15'),(7,NULL,'100005',1,1,3,1,1,2,0,0,0,0,0,'::1','Phone',NULL,1,0,0,NULL,NULL,'2025-10-23 04:53:28',NULL,'2025-10-22 10:53:28','2025-10-22 10:53:28','2025-10-22 11:46:18'),(8,NULL,'100006',101,3,1,1,1,2,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,'2025-10-23 05:37:10',NULL,'2025-10-22 11:37:10','2025-10-22 11:37:10','2025-10-22 11:37:10'),(9,NULL,'100007',102,4,1,3,1,7,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,'2025-10-23 05:39:14',NULL,'2025-10-22 11:39:14','2025-10-22 11:39:14','2025-10-22 11:39:14'),(10,NULL,'100008',101,0,1,1,1,2,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,'2025-10-23 05:42:15',NULL,'2025-10-22 11:42:15','2025-10-22 11:42:15','2025-10-22 11:42:15'),(14,NULL,'100009',103,5,1,1,1,2,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,NULL,NULL,'2025-10-22 12:15:52','2025-10-22 12:15:52','2025-10-22 12:15:52'),(15,NULL,'100010',103,5,1,1,1,2,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,NULL,NULL,'2025-10-22 12:16:13','2025-10-22 12:16:13','2025-10-22 12:16:13'),(16,NULL,'100011',103,5,3,1,1,2,0,0,0,0,0,'::1','Web',NULL,1,0,0,NULL,NULL,NULL,NULL,'2025-10-22 12:17:39','2025-10-22 12:17:39','2025-10-22 12:19:24'),(17,NULL,'100012',103,5,3,1,1,7,0,0,0,0,0,'::1','Web',NULL,1,0,0,NULL,NULL,NULL,NULL,'2025-10-22 12:20:49','2025-10-22 12:20:49','2025-10-22 12:21:39'),(18,NULL,'100013',1,1,1,1,1,3,0,0,0,0,0,'::1','Web',NULL,0,0,0,NULL,NULL,NULL,NULL,'2025-10-22 12:58:30','2025-10-22 12:58:30','2025-10-22 12:58:30'),(19,NULL,'100014',1,1,3,1,1,2,0,0,0,0,0,'::1','Web',NULL,1,0,0,NULL,NULL,NULL,NULL,'2025-10-22 12:59:16','2025-10-22 12:59:16','2025-10-22 13:01:51');
/*!40000 ALTER TABLE `ost_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_ticket__cdata`
--

DROP TABLE IF EXISTS `ost_ticket__cdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_ticket__cdata` (
  `ticket_id` int unsigned NOT NULL DEFAULT '0',
  `subject` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `priority` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_ticket__cdata`
--

LOCK TABLES `ost_ticket__cdata` WRITE;
/*!40000 ALTER TABLE `ost_ticket__cdata` DISABLE KEYS */;
INSERT INTO `ost_ticket__cdata` VALUES (1,'Ticket #1','2'),(2,'Ticket #2','3'),(3,'Ticket #3','2'),(4,'Ticket #4','2'),(5,'Ticket #5','3'),(7,'Ticket #7','2'),(8,NULL,'2'),(9,NULL,'2'),(10,NULL,'2'),(14,'internet','3'),(15,'internet','2'),(16,'internet','2'),(17,'internet','2'),(18,'internet','2'),(19,'internet','2');
/*!40000 ALTER TABLE `ost_ticket__cdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_ticket_priority`
--

DROP TABLE IF EXISTS `ost_ticket_priority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_ticket_priority` (
  `priority_id` tinyint NOT NULL AUTO_INCREMENT,
  `priority` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `priority_desc` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `priority_color` varchar(7) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `priority_urgency` tinyint unsigned NOT NULL DEFAULT '0',
  `ispublic` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`priority_id`),
  UNIQUE KEY `priority` (`priority`),
  KEY `priority_urgency` (`priority_urgency`),
  KEY `ispublic` (`ispublic`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_ticket_priority`
--

LOCK TABLES `ost_ticket_priority` WRITE;
/*!40000 ALTER TABLE `ost_ticket_priority` DISABLE KEYS */;
INSERT INTO `ost_ticket_priority` VALUES (1,'Baja','Baja','#DDFFDD',4,1),(2,'Normal','Normal','#FFFFF0',3,1),(3,'Alta','Alta','#FFEDD2',2,1),(4,'Urgente','Urgente','#FEE7E7',1,1);
/*!40000 ALTER TABLE `ost_ticket_priority` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_ticket_status`
--

DROP TABLE IF EXISTS `ost_ticket_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_ticket_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `state` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `mode` int unsigned NOT NULL DEFAULT '0',
  `flags` int unsigned NOT NULL DEFAULT '0',
  `sort` int unsigned NOT NULL DEFAULT '0',
  `properties` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `state` (`state`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_ticket_status`
--

LOCK TABLES `ost_ticket_status` WRITE;
/*!40000 ALTER TABLE `ost_ticket_status` DISABLE KEYS */;
INSERT INTO `ost_ticket_status` VALUES (1,'Abierto','open',3,0,1,'{\"description\":\"Tickets abiertos\"}','2025-10-22 09:33:01','2025-10-22 09:33:01'),(2,'Resuelto','closed',3,0,2,'{\"description\":\"Tickets resueltos\"}','2025-10-22 09:33:01','2025-10-22 09:33:01'),(3,'Cerrado','closed',3,0,3,'{\"description\":\"Tickets cerrados\"}','2025-10-22 09:33:01','2025-10-22 09:33:01'),(4,'Archivado','archived',3,0,4,'{\"description\":\"Tickets archivados\"}','2025-10-22 09:33:01','2025-10-22 09:33:01'),(5,'Eliminado','deleted',3,0,5,'{\"description\":\"Tickets eliminados\"}','2025-10-22 09:33:01','2025-10-22 09:33:01');
/*!40000 ALTER TABLE `ost_ticket_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_translation`
--

DROP TABLE IF EXISTS `ost_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_translation` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `object_hash` char(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `type` enum('phrase','article') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `flags` int unsigned NOT NULL DEFAULT '0',
  `revision` int unsigned DEFAULT NULL,
  `agent_id` int unsigned NOT NULL DEFAULT '0',
  `lang` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'en_US',
  `text` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`lang`,`object_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_translation`
--

LOCK TABLES `ost_translation` WRITE;
/*!40000 ALTER TABLE `ost_translation` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_user`
--

DROP TABLE IF EXISTS `ost_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `org_id` int unsigned NOT NULL DEFAULT '0',
  `default_email_id` int NOT NULL,
  `status` int unsigned NOT NULL DEFAULT '0',
  `name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `org_id` (`org_id`),
  KEY `default_email_id` (`default_email_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_user`
--

LOCK TABLES `ost_user` WRITE;
/*!40000 ALTER TABLE `ost_user` DISABLE KEYS */;
INSERT INTO `ost_user` VALUES (1,0,1,0,'juan david Ramirez','2025-10-22 09:36:58','2025-10-22 09:36:58'),(100,0,0,0,'Usuario de Prueba','2025-10-22 10:31:26','2025-10-22 10:31:26'),(101,0,3,0,'Juan ','2025-10-22 11:37:10','2025-10-22 11:37:10'),(102,0,4,0,'juanda','2025-10-22 11:39:14','2025-10-22 11:39:14'),(103,0,0,0,'Juan Ramírez','2025-10-22 12:15:43','2025-10-22 12:15:43');
/*!40000 ALTER TABLE `ost_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_user__cdata`
--

DROP TABLE IF EXISTS `ost_user__cdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_user__cdata` (
  `user_id` int unsigned NOT NULL,
  `name` mediumtext,
  `phone` varchar(24) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_user__cdata`
--

LOCK TABLES `ost_user__cdata` WRITE;
/*!40000 ALTER TABLE `ost_user__cdata` DISABLE KEYS */;
INSERT INTO `ost_user__cdata` VALUES (101,NULL,'23121212',NULL),(102,NULL,'315231484',NULL);
/*!40000 ALTER TABLE `ost_user__cdata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_user_account`
--

DROP TABLE IF EXISTS `ost_user_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_user_account` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `status` int unsigned NOT NULL DEFAULT '0',
  `extra` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `username` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `passwd` varchar(128) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `backend` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_user_account`
--

LOCK TABLES `ost_user_account` WRITE;
/*!40000 ALTER TABLE `ost_user_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `ost_user_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ost_user_email`
--

DROP TABLE IF EXISTS `ost_user_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ost_user_email` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `flags` int unsigned NOT NULL DEFAULT '0',
  `address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `address` (`address`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ost_user_email`
--

LOCK TABLES `ost_user_email` WRITE;
/*!40000 ALTER TABLE `ost_user_email` DISABLE KEYS */;
INSERT INTO `ost_user_email` VALUES (1,1,0,'juandavidramirezcalderon@gmail.com'),(2,100,0,'prueba@test.com'),(3,101,0,'nuevo@gmial.com'),(4,102,0,'jdaramirezc@poligran.edu.co'),(5,103,0,'juandayamm@hotmail.com');
/*!40000 ALTER TABLE `ost_user_email` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-22 20:15:58
