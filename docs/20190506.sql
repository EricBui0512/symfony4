-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: api
-- ------------------------------------------------------
-- Server version	5.6.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'name3','description3');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `capabilities`
--

DROP TABLE IF EXISTS `capabilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `capabilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D3B2DFD5E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `capabilities`
--

LOCK TABLES `capabilities` WRITE;
/*!40000 ALTER TABLE `capabilities` DISABLE KEYS */;
INSERT INTO `capabilities` VALUES (1,'ADDUSER',NULL),(2,'DELETEUSER',NULL),(3,'CREATEGROUP',NULL),(4,'DELETEGROUP',NULL),(5,'ADDUSERTOGROUP',NULL),(6,'REMOVEUSERFROMGROUP',NULL);
/*!40000 ALTER TABLE `capabilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_group`
--

DROP TABLE IF EXISTS `chat_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_group`
--

LOCK TABLES `chat_group` WRITE;
/*!40000 ALTER TABLE `chat_group` DISABLE KEYS */;
INSERT INTO `chat_group` VALUES (4,'firstGroup','2018-05-09 00:00:00',1);
/*!40000 ALTER TABLE `chat_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `context`
--

DROP TABLE IF EXISTS `context`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `context` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `context_level_id_id` int(11) NOT NULL,
  `intance` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E25D857ED8C74602` (`context_level_id_id`),
  CONSTRAINT `FK_E25D857ED8C74602` FOREIGN KEY (`context_level_id_id`) REFERENCES `context_levels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `context`
--

LOCK TABLES `context` WRITE;
/*!40000 ALTER TABLE `context` DISABLE KEYS */;
INSERT INTO `context` VALUES (1,1,0);
/*!40000 ALTER TABLE `context` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `context_levels`
--

DROP TABLE IF EXISTS `context_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `context_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `database_table` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_28C62F4E5E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `context_levels`
--

LOCK TABLES `context_levels` WRITE;
/*!40000 ALTER TABLE `context_levels` DISABLE KEYS */;
INSERT INTO `context_levels` VALUES (1,'SYSTEM','system admin','0'),(2,'GROUP','group context','GROUP');
/*!40000 ALTER TABLE `context_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190505054404','2019-05-05 05:47:18'),('20190505110029','2019-05-05 11:01:29'),('20190506023924','2019-05-06 02:40:46'),('20190506051815','2019-05-06 05:18:58'),('20190506074041','2019-05-06 07:41:36');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_57698A6A5E237E06` (`name`),
  UNIQUE KEY `UNIQ_57698A6A3EE4B093` (`short_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'SYSTEMADMIN','SA','this is system admin'),(2,'GROUPADMIN','GA',NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_assignment`
--

DROP TABLE IF EXISTS `role_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id_id` int(11) NOT NULL,
  `context_id_id` int(11) NOT NULL,
  `user_id_id` int(11) NOT NULL,
  `time_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_end` datetime DEFAULT NULL,
  `time_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BFF12E9688987678` (`role_id_id`),
  KEY `IDX_BFF12E962E53F229` (`context_id_id`),
  KEY `IDX_BFF12E969D86650F` (`user_id_id`),
  CONSTRAINT `FK_BFF12E962E53F229` FOREIGN KEY (`context_id_id`) REFERENCES `context` (`id`),
  CONSTRAINT `FK_BFF12E9688987678` FOREIGN KEY (`role_id_id`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_BFF12E969D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_assignment`
--

LOCK TABLES `role_assignment` WRITE;
/*!40000 ALTER TABLE `role_assignment` DISABLE KEYS */;
INSERT INTO `role_assignment` VALUES (1,1,1,1,'2019-05-05 14:44:03',NULL,'2019-05-05 14:44:03',1);
/*!40000 ALTER TABLE `role_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_capabilities`
--

DROP TABLE IF EXISTS `role_capabilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_capabilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `context_level_id_id` int(11) NOT NULL,
  `role_id_id` int(11) NOT NULL,
  `capability_id_id` int(11) NOT NULL,
  `time_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_896D4121D8C74602` (`context_level_id_id`),
  KEY `IDX_896D412188987678` (`role_id_id`),
  KEY `IDX_896D4121FF420C64` (`capability_id_id`),
  CONSTRAINT `FK_896D412188987678` FOREIGN KEY (`role_id_id`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_896D4121D8C74602` FOREIGN KEY (`context_level_id_id`) REFERENCES `context_levels` (`id`),
  CONSTRAINT `FK_896D4121FF420C64` FOREIGN KEY (`capability_id_id`) REFERENCES `capabilities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_capabilities`
--

LOCK TABLES `role_capabilities` WRITE;
/*!40000 ALTER TABLE `role_capabilities` DISABLE KEYS */;
INSERT INTO `role_capabilities` VALUES (1,1,1,1,'2019-05-05 14:43:12',1),(2,1,1,2,'2019-05-05 17:31:16',1),(3,1,1,3,'2019-05-05 17:31:16',1),(4,1,1,4,'2019-05-05 17:31:16',1),(5,1,1,5,'0000-00-00 00:00:00',1),(6,1,1,6,'2019-05-06 04:30:55',0);
/*!40000 ALTER TABLE `role_capabilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_salt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'SuperAdmin','admin','234234234','23423534543','2019-05-05 14:37:19'),(2,'eric bui','eric','8e1a0688ac72cf034f1d08d373afda74e64e7205036964833a95256fad0942c5','8e1a0688ac72cf034f1d08d373afda74e64e7205036964833a95256fad0942c5','2018-05-09 00:00:00'),(4,'eric bui','eric1','bd4e5c2fda7293b624f955bc264ce29f45b9f334b930a594198da27cf87afdc6','bd4e5c2fda7293b624f955bc264ce29f45b9f334b930a594198da27cf87afdc6','2018-05-09 00:00:00');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_group`
--

DROP TABLE IF EXISTS `users_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id_id` int(11) NOT NULL,
  `user_id_id` int(11) NOT NULL,
  `time_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_end` datetime DEFAULT NULL,
  `modifier_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8AB7E08C2F68B530` (`group_id_id`),
  KEY `IDX_8AB7E08C9D86650F` (`user_id_id`),
  CONSTRAINT `FK_8AB7E08C2F68B530` FOREIGN KEY (`group_id_id`) REFERENCES `chat_group` (`id`),
  CONSTRAINT `FK_8AB7E08C9D86650F` FOREIGN KEY (`user_id_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_group`
--

LOCK TABLES `users_group` WRITE;
/*!40000 ALTER TABLE `users_group` DISABLE KEYS */;
INSERT INTO `users_group` VALUES (4,4,2,'2018-05-09 00:00:00',NULL,1);
/*!40000 ALTER TABLE `users_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-06 20:38:18
