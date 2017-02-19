-- MySQL dump 10.13  Distrib 5.5.42, for osx10.6 (i386)
--
-- Host: localhost    Database: hawksales_io
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_12_19_121831_create_organisations_table',2),(4,'2016_12_19_124858_create_tenants_table',2),(7,'2016_12_19_133419_create_tenant_comments_table',3),(8,'2016_12_21_081804_update_users_table',4),(9,'2016_12_21_103600_create_reserved_keywords',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserved_keywords`
--

DROP TABLE IF EXISTS `reserved_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserved_keywords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserved_keywords`
--

LOCK TABLES `reserved_keywords` WRITE;
/*!40000 ALTER TABLE `reserved_keywords` DISABLE KEYS */;
INSERT INTO `reserved_keywords` VALUES (1,'smackcoders'),(2,'google'),(3,'facebook'),(4,'manohara'),(5,'twitter'),(6,'oracle'),(7,'microsoft'),(8,'linkedin');
/*!40000 ALTER TABLE `reserved_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenant_comments`
--

DROP TABLE IF EXISTS `tenant_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenant_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `comment_description` longtext COLLATE utf8_unicode_ci,
  `tenant_id` int(10) unsigned NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tenant_comments_added_by_foreign` (`added_by`),
  KEY `tenant_comments_tenant_id_foreign` (`tenant_id`),
  CONSTRAINT `tenant_comments_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  CONSTRAINT `tenant_comments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenant_comments`
--

LOCK TABLES `tenant_comments` WRITE;
/*!40000 ALTER TABLE `tenant_comments` DISABLE KEYS */;
INSERT INTO `tenant_comments` VALUES (1,3,'Due to payment',1,1,'2016-12-21 04:22:20','2016-12-21 04:22:20'),(2,1,NULL,3,2,'2016-12-21 05:36:34','2016-12-21 05:36:34'),(3,3,'No payment yet',3,1,'2016-12-21 06:46:25','2016-12-21 06:46:25'),(4,2,'Got the payment from customer',3,1,'2016-12-21 07:15:48','2016-12-21 07:15:48'),(5,1,NULL,4,1,'2016-12-21 07:40:30','2016-12-21 07:40:30');
/*!40000 ALTER TABLE `tenant_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenants`
--

DROP TABLE IF EXISTS `tenants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tenants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organisation_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organisation_unique_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenants`
--

LOCK TABLES `tenants` WRITE;
/*!40000 ALTER TABLE `tenants` DISABLE KEYS */;
INSERT INTO `tenants` VALUES (1,'Rajkumar M','Hotel Manohara','manohara','rajkumar.gohan@gmail.com',3,'2016-12-19 09:53:16','2016-12-21 04:22:20',NULL),(2,'Raja','Manohara Stores','manoharastores','raja@gmail.com',3,'2016-12-19 10:52:18','2016-12-19 10:52:36',NULL),(3,'Chinna Raja','Chinna Contructions','chinna','chinnaraja@gmail.com',2,'2016-12-21 05:36:34','2016-12-21 07:15:48',NULL),(4,'Mark zuckerberg','Facebook','face','mark@facebook.com',2,'2016-12-21 07:40:30','2016-12-21 07:40:30',NULL);
/*!40000 ALTER TABLE `tenants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `is_super_admin` int(11) NOT NULL DEFAULT '0',
  `organisation_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_organisation_id_foreign` (`organisation_id`),
  CONSTRAINT `users_organisation_id_foreign` FOREIGN KEY (`organisation_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Rajkumar','rajkumarm@smackcoders.com','$2y$10$q1n73ovULmXpl6d9O6yfx.5MP.Z8Ved7.1MTe083vpDbCbsXHh1Mi','DrM9DSkcSMdclvUjWcXk2PZOQ5evLLd5hcIL2H3oPbziIxG5alJqU9C7kNfy','2016-12-19 01:58:14','2016-12-21 05:38:27',0,1,1),(2,'Rajkumar','rajkumar.gohan@gmail.com','$2y$10$CEqAB1GVZgWV977VGiynaeKwm38LPPGEv/DVlukRBkeZ9FDw9ys/6','UpDGhmtE0qJiC7aKm1Sa3YBY0XAUr4PVamVWnAYewoDQe46BUUIe1c89qlBX','2016-12-21 04:21:39','2016-12-21 06:45:56',1,0,1),(3,'Chinna Raja','chinnaraja@gmail.com','$2y$10$7u3xZCeLIILzAwrvJjDgIe5pLP7uZAQ6kRLPP406GIPGCpjFBkTxy','mERJTLgMd9WLdztVtalg8j6un5ZuHVfxQ33gAgtHB7JJkRZsj0APikq6Guwd','2016-12-21 05:37:40','2016-12-21 07:54:55',1,0,3),(4,'Mark zuckerberg','mark@facebook.com','$2y$10$Gk./JWyJDfq4EwpqQKm/g.OqXC3Nids281lW5VNRoLvkWSmm4esKq',NULL,'2016-12-21 07:54:41','2016-12-21 07:54:41',1,0,4);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-22 12:59:43
