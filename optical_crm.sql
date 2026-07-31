-- MySQL dump 10.13  Distrib 8.4.10, for Linux (x86_64)
--
-- Host: localhost    Database: optical_crm
-- ------------------------------------------------------
-- Server version	8.4.10

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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Oakley','Kiribati',NULL,'Quidem vitae odio iusto.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(2,'Vogue','Niger',NULL,'In non culpa vel non amet.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(3,'Dior','Colombia',NULL,NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(4,'Carrera','Philippines',NULL,NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(5,'Gucci','Philippines',NULL,NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(6,'Prada',NULL,NULL,'Fuga dignissimos sint doloremque officiis.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(7,'Polaroid',NULL,NULL,NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(8,'Ray-Ban','Palestinian Territories',NULL,'Sapiente vero animi minima impedit autem.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(9,'Persol',NULL,NULL,NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(10,'Arnette','Western Sahara',NULL,NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(11,'Oakley',NULL,NULL,'Dolorem possimus ducimus officiis consequatur iste eum cumque.','2026-07-29 15:35:22','2026-07-29 15:35:22'),(12,'Dior',NULL,NULL,'Deserunt nihil dolores voluptatem labore.','2026-07-29 15:35:22','2026-07-29 15:35:22'),(13,'Gucci',NULL,NULL,'Dolores eligendi aut quam autem laboriosam veritatis.','2026-07-29 15:35:22','2026-07-29 15:35:22'),(14,'Ray-Ban',NULL,NULL,'Praesentium et odio magni.','2026-07-29 15:35:22','2026-07-29 15:35:22'),(15,'Prada',NULL,NULL,'At a reiciendis veniam qui.','2026-07-29 15:35:22','2026-07-29 15:35:22'),(16,'Polaroid','United States of America',NULL,'Quia est repellat voluptas et inventore fugiat animi.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(17,'Vogue',NULL,NULL,'Nisi est veniam ut voluptatem placeat autem nisi.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(18,'Persol','United States Virgin Islands',NULL,NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(19,'Carrera',NULL,NULL,NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(20,'Arnette','Latvia',NULL,'Esse rem sunt expedita.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(21,'Carrera','Guyana',NULL,'Sed quia debitis maiores neque.','2026-07-29 15:36:45','2026-07-29 15:36:45');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('optical-crm-cache-spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:96:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"view customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"create customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:14:\"edit customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:16:\"delete customers\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"view products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"create products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:13:\"edit products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"delete products\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"view categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:17:\"create categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"edit categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:17:\"delete categories\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:11:\"view brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:13:\"create brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:11:\"edit brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:13:\"delete brands\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:18:\"view prescriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:20:\"create prescriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:18:\"edit prescriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:20:\"delete prescriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:11:\"view orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:13:\"create orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"edit orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"delete orders\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:17:\"view reservations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:19:\"create reservations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:17:\"edit reservations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:19:\"delete reservations\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:13:\"view payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:15:\"create payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:13:\"edit payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"delete payments\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:14:\"view inventory\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:16:\"manage inventory\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:12:\"view reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:12:\"manage roles\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:15:\"manage settings\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:14:\"customers.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:16:\"customers.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:14:\"customers.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:16:\"customers.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:13:\"products.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:15:\"products.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:13:\"products.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:15:\"products.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:15:\"categories.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:17:\"categories.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:15:\"categories.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:17:\"categories.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:18:\"prescriptions.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:20:\"prescriptions.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:18:\"prescriptions.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:20:\"prescriptions.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:11:\"orders.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:13:\"orders.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:11:\"orders.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:13:\"orders.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:15:\"payments.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:17:\"reservations.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:19:\"reservations.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:17:\"reservations.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:19:\"reservations.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:10:\"stock.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:12:\"stock.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:13:\"invoices.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:15:\"invoices.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:12:\"reports.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:12:\"users.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:13:\"view invoices\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:11:\"brands.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:13:\"brands.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:11:\"brands.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:13:\"brands.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:20:\"stock-movements.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:22:\"stock-movements.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:20:\"stock-movements.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:22:\"stock-movements.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:14:\"suppliers.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:79;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:16:\"suppliers.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:80;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:14:\"suppliers.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:81;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:16:\"suppliers.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:82;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:20:\"purchase-orders.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:83;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:22:\"purchase-orders.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:84;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:20:\"purchase-orders.edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:85;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:22:\"purchase-orders.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:86;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:15:\"invoices.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:87;a:4:{s:1:\"a\";i:88;s:1:\"b\";s:15:\"invoices.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:88;a:4:{s:1:\"a\";i:89;s:1:\"b\";s:13:\"payments.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:89;a:4:{s:1:\"a\";i:90;s:1:\"b\";s:15:\"payments.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:90;a:4:{s:1:\"a\";i:91;s:1:\"b\";s:15:\"payments.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:91;a:4:{s:1:\"a\";i:92;s:1:\"b\";s:14:\"inventory.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:92;a:4:{s:1:\"a\";i:93;s:1:\"b\";s:16:\"inventory.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:93;a:4:{s:1:\"a\";i:94;s:1:\"b\";s:12:\"view-reports\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:94;a:4:{s:1:\"a\";i:95;s:1:\"b\";s:12:\"roles.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:95;a:4:{s:1:\"a\";i:96;s:1:\"b\";s:15:\"settings.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"Manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:8:\"Employee\";s:1:\"c\";s:3:\"web\";}}}',1785576259);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (161,'ray air',NULL,'2026-07-13 09:27:13','2026-07-13 09:27:13'),(182,'nostrum Accessoires',NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `birth_date` date DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_cin_unique` (`cin`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Mohamed','El Alami','AB123456','+212612345678','mohamed.elalami@gmail.com','12 Rue Hassan II, Rabat','1985-05-14','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00'),(2,'Fatima','Benani','CD234567','+212623456789','fatima.benani@gmail.com','45 Ave Mohammed V, Casablanca','1990-08-22','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00'),(3,'Youssef','Tazi','EF345678','+212634567890','youssef.tazi@gmail.com','8 Bd Zerktouni, Marrakech','1978-11-30','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00'),(4,'Aicha','Fassi','GH456789','+212645678901','aicha.fassi@gmail.com','23 Rue de Fès, Meknès','1995-02-18','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00'),(5,'Ahmed','Alaoui','IJ567890','+212656789012','ahmed.alaoui@gmail.com','56 Ave des FAR, Tanger','1982-07-05','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00'),(6,'Khadija','Chraibi','KL678901','+212667890123','khadija.chraibi@gmail.com','14 Rue Ibn Sina, Agadir','1988-04-12','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00'),(7,'Omar','Berrada','MN789012','+212678901234','omar.berrada@gmail.com','78 Bd Anfa, Casablanca','1975-09-25','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00'),(8,'Salma','Squalli','OP890123','+212689012345','salma.squalli@gmail.com','34 Ave Moulay Youssef, Rabat','1992-12-08','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00'),(9,'Karim','Kettani','QR901234','+212690123456','karim.kettani@gmail.com','9 Rue Al Massira, Fès','1980-03-19','',NULL,'2024-01-01 00:00:00','2024-01-01 00:00:00');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `tax_rate` decimal(5,2) NOT NULL DEFAULT '20.00',
  `total_ht` decimal(10,2) NOT NULL,
  `total_ttc` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_order_id_unique` (`order_id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  CONSTRAINT `invoices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (2,7,'FAC-2026-0002','2026-07-14',20.00,83.33,100.00,'2026-07-14 13:20:30','2026-07-14 13:20:30'),(3,9,'FAC-2026-0003','2026-07-15',20.00,250.00,300.00,'2026-07-15 14:02:21','2026-07-15 14:02:21'),(4,10,'FAC-2026-0004','2026-07-31',20.00,250.00,300.00,'2026-07-31 15:08:27','2026-07-31 15:08:27');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_07_02_141055_create_customers_table',1),(5,'2026_07_06_094515_create_categories_table',1),(6,'2026_07_06_095112_create_products_table',1),(7,'2026_07_06_133354_create_brands_table',1),(8,'2026_07_06_133624_add_brand_id_to_products_table',1),(9,'2026_07_07_082856_create_prescriptions_table',1),(10,'2026_07_07_093411_create_orders_table',1),(11,'2026_07_07_093736_create_order_items_table',1),(12,'2026_07_07_100000_remove_brand_column_from_products_table',1),(13,'2026_07_08_090007_create_payments_table',1),(14,'2026_07_08_101802_create_invoices_table',1),(15,'2026_07_08_120000_add_cin_to_customers_table',1),(16,'2026_07_08_123000_create_reservations_table',1),(17,'2026_07_08_133412_create_stock_movements_table',1),(18,'2026_07_13_092533_create_permission_tables',2),(19,'2026_07_14_090934_create_settings_table',3),(20,'2026_07_14_112108_create_prescription_history_table',4),(21,'2026_07_15_094341_create_notifications_table',5),(22,'2026_07_15_104313_create_suppliers_table',6),(23,'2026_07_15_104315_create_purchase_orders_table',6),(24,'2026_07_15_104318_create_purchase_order_items_table',6),(25,'2026_07_28_000001_add_ready_status_to_orders',7),(26,'2026_07_29_153542_add_prescription_date_to_prescriptions_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
INSERT INTO `model_has_permissions` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',1),(3,'App\\Models\\User',1),(4,'App\\Models\\User',1),(5,'App\\Models\\User',1),(6,'App\\Models\\User',1),(7,'App\\Models\\User',1),(8,'App\\Models\\User',1),(9,'App\\Models\\User',1),(10,'App\\Models\\User',1),(11,'App\\Models\\User',1),(12,'App\\Models\\User',1),(13,'App\\Models\\User',1),(14,'App\\Models\\User',1),(15,'App\\Models\\User',1),(16,'App\\Models\\User',1),(17,'App\\Models\\User',1),(18,'App\\Models\\User',1),(19,'App\\Models\\User',1),(20,'App\\Models\\User',1),(21,'App\\Models\\User',1),(22,'App\\Models\\User',1),(23,'App\\Models\\User',1),(24,'App\\Models\\User',1),(25,'App\\Models\\User',1),(26,'App\\Models\\User',1),(27,'App\\Models\\User',1),(28,'App\\Models\\User',1),(29,'App\\Models\\User',1),(30,'App\\Models\\User',1),(31,'App\\Models\\User',1),(32,'App\\Models\\User',1),(33,'App\\Models\\User',1),(34,'App\\Models\\User',1),(35,'App\\Models\\User',1),(36,'App\\Models\\User',1),(37,'App\\Models\\User',1),(38,'App\\Models\\User',1),(39,'App\\Models\\User',1),(40,'App\\Models\\User',1),(41,'App\\Models\\User',1),(42,'App\\Models\\User',1),(43,'App\\Models\\User',1),(44,'App\\Models\\User',1),(45,'App\\Models\\User',1),(46,'App\\Models\\User',1),(47,'App\\Models\\User',1),(48,'App\\Models\\User',1),(49,'App\\Models\\User',1),(50,'App\\Models\\User',1),(51,'App\\Models\\User',1),(52,'App\\Models\\User',1),(53,'App\\Models\\User',1),(54,'App\\Models\\User',1),(55,'App\\Models\\User',1),(56,'App\\Models\\User',1),(57,'App\\Models\\User',1),(58,'App\\Models\\User',1),(59,'App\\Models\\User',1),(60,'App\\Models\\User',1),(61,'App\\Models\\User',1),(62,'App\\Models\\User',1),(63,'App\\Models\\User',1),(64,'App\\Models\\User',1),(65,'App\\Models\\User',1),(66,'App\\Models\\User',1),(67,'App\\Models\\User',1),(68,'App\\Models\\User',1),(69,'App\\Models\\User',1),(70,'App\\Models\\User',1),(1,'App\\Models\\User',2),(2,'App\\Models\\User',2),(3,'App\\Models\\User',2),(4,'App\\Models\\User',2),(5,'App\\Models\\User',2),(6,'App\\Models\\User',2),(7,'App\\Models\\User',2),(8,'App\\Models\\User',2),(9,'App\\Models\\User',2),(10,'App\\Models\\User',2),(11,'App\\Models\\User',2),(12,'App\\Models\\User',2),(13,'App\\Models\\User',2),(14,'App\\Models\\User',2),(15,'App\\Models\\User',2),(16,'App\\Models\\User',2),(17,'App\\Models\\User',2),(18,'App\\Models\\User',2),(19,'App\\Models\\User',2),(20,'App\\Models\\User',2),(21,'App\\Models\\User',2),(22,'App\\Models\\User',2),(23,'App\\Models\\User',2),(24,'App\\Models\\User',2),(25,'App\\Models\\User',2),(26,'App\\Models\\User',2),(27,'App\\Models\\User',2),(28,'App\\Models\\User',2),(29,'App\\Models\\User',2),(30,'App\\Models\\User',2),(31,'App\\Models\\User',2),(32,'App\\Models\\User',2),(33,'App\\Models\\User',2),(34,'App\\Models\\User',2),(35,'App\\Models\\User',2),(36,'App\\Models\\User',2),(37,'App\\Models\\User',2),(38,'App\\Models\\User',2),(39,'App\\Models\\User',2),(40,'App\\Models\\User',2),(41,'App\\Models\\User',2),(42,'App\\Models\\User',2),(43,'App\\Models\\User',2),(44,'App\\Models\\User',2),(45,'App\\Models\\User',2),(46,'App\\Models\\User',2),(47,'App\\Models\\User',2),(48,'App\\Models\\User',2),(49,'App\\Models\\User',2),(50,'App\\Models\\User',2),(51,'App\\Models\\User',2),(52,'App\\Models\\User',2),(53,'App\\Models\\User',2),(54,'App\\Models\\User',2),(55,'App\\Models\\User',2),(56,'App\\Models\\User',2),(57,'App\\Models\\User',2),(58,'App\\Models\\User',2),(59,'App\\Models\\User',2),(60,'App\\Models\\User',2),(61,'App\\Models\\User',2),(62,'App\\Models\\User',2),(63,'App\\Models\\User',2),(64,'App\\Models\\User',2),(65,'App\\Models\\User',2),(66,'App\\Models\\User',2),(67,'App\\Models\\User',2),(68,'App\\Models\\User',2),(69,'App\\Models\\User',2),(70,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\User',2),(2,'App\\Models\\User',9),(3,'App\\Models\\User',10);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('42ac31eb-767a-4f19-89a9-7f1cf92c6415','App\\Notifications\\NewOrderNotification','App\\Models\\User',2,'{\"message\":\"\\ud83d\\uded2 Nouvelle commande #ORD-20260731150816 cr\\u00e9\\u00e9e par Fatima Benani.\",\"icon\":\"cart\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/orders\",\"color\":\"indigo\"}',NULL,'2026-07-31 15:08:16','2026-07-31 15:08:16'),('468be99b-d985-4b16-b8dd-b4c0165c5bab','App\\Notifications\\NewOrderNotification','App\\Models\\User',2,'{\"message\":\"\\ud83d\\uded2 Nouvelle commande #ORD-20260715150136 cr\\u00e9\\u00e9e par Aicha Fassi.\",\"icon\":\"cart\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/orders\",\"color\":\"indigo\"}','2026-07-15 14:09:03','2026-07-15 14:01:36','2026-07-15 14:09:03'),('6b4a6268-9692-4390-912f-06071be824d4','App\\Notifications\\NewOrderNotification','App\\Models\\User',2,'{\"message\":\"\\ud83d\\uded2 Nouvelle commande #ORD-20260715134935 cr\\u00e9\\u00e9e par Karim Kettani.\",\"icon\":\"cart\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/orders\",\"color\":\"indigo\"}','2026-07-15 12:49:46','2026-07-15 12:49:35','2026-07-15 12:49:46'),('a8520818-ae8a-4230-86f5-2c5767efc020','App\\Notifications\\LowStockNotification','App\\Models\\User',2,'{\"message\":\"\\u26a0\\ufe0f Alerte Stock: Le produit \'sunglass\' est en rupture (Reste: 9).\",\"icon\":\"alert\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/products\",\"color\":\"rose\"}','2026-07-15 12:48:46','2026-07-15 12:48:39','2026-07-15 12:48:46'),('e27dd9d3-51f8-46a7-83c5-820efabbcf5b','App\\Notifications\\NewReservationNotification','App\\Models\\User',2,'{\"message\":\"\\ud83d\\udcc5 Nouveau rendez-vous pour Aicha Fassi le 03\\/07\\/2026.\",\"icon\":\"calendar\",\"link\":\"http:\\/\\/127.0.0.1:8000\\/reservations\",\"color\":\"cyan\"}','2026-07-15 09:09:42','2026-07-15 09:09:31','2026-07-15 09:09:42');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (3,7,1001,3,100.00,300.00,'2026-07-15 08:13:38','2026-07-15 08:13:38'),(4,8,1205,1,300.00,300.00,'2026-07-15 12:49:35','2026-07-15 12:49:35'),(6,9,1001,3,100.00,300.00,'2026-07-22 13:01:00','2026-07-22 13:01:00'),(7,10,1001,3,100.00,300.00,'2026-07-31 15:08:16','2026-07-31 15:08:16');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `status` enum('Pending','Processing','Ready','Completed','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (7,9,2,'ORD-20260713114942','2026-07-15','Pending',300.00,NULL,'2026-07-13 10:49:42','2026-07-15 08:13:38'),(8,9,2,'ORD-20260715134935','2026-07-15','Processing',300.00,NULL,'2026-07-15 12:49:35','2026-07-15 12:49:35'),(9,4,2,'ORD-20260715150136','2026-07-22','Processing',300.00,NULL,'2026-07-15 14:01:36','2026-07-22 13:01:00'),(10,2,2,'ORD-20260731150816','2026-07-31','Pending',300.00,NULL,'2026-07-31 15:08:16','2026-07-31 15:08:16');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('especes','carte','virement','cheque') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'especes',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (2,9,100.00,'2026-07-15','especes',NULL,'2026-07-15 14:02:08','2026-07-15 14:02:08');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view customers','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(2,'create customers','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(3,'edit customers','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(4,'delete customers','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(5,'view products','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(6,'create products','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(7,'edit products','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(8,'delete products','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(9,'view categories','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(10,'create categories','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(11,'edit categories','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(12,'delete categories','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(13,'view brands','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(14,'create brands','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(15,'edit brands','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(16,'delete brands','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(17,'view prescriptions','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(18,'create prescriptions','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(19,'edit prescriptions','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(20,'delete prescriptions','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(21,'view orders','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(22,'create orders','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(23,'edit orders','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(24,'delete orders','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(25,'view reservations','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(26,'create reservations','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(27,'edit reservations','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(28,'delete reservations','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(29,'view payments','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(30,'create payments','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(31,'edit payments','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(32,'delete payments','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(33,'view inventory','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(34,'manage inventory','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(35,'view reports','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(36,'manage users','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(37,'manage roles','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(38,'manage settings','web','2026-07-13 08:37:02','2026-07-13 08:37:02'),(39,'customers.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(40,'customers.create','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(41,'customers.edit','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(42,'customers.delete','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(43,'products.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(44,'products.create','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(45,'products.edit','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(46,'products.delete','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(47,'categories.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(48,'categories.create','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(49,'categories.edit','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(50,'categories.delete','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(51,'prescriptions.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(52,'prescriptions.create','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(53,'prescriptions.edit','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(54,'prescriptions.delete','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(55,'orders.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(56,'orders.create','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(57,'orders.edit','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(58,'orders.delete','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(59,'payments.manage','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(60,'reservations.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(61,'reservations.create','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(62,'reservations.edit','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(63,'reservations.delete','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(64,'stock.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(65,'stock.manage','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(66,'invoices.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(67,'invoices.manage','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(68,'reports.view','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(69,'users.manage','web','2026-07-13 09:07:13','2026-07-13 09:07:13'),(70,'view invoices','web','2026-07-13 09:52:02','2026-07-13 09:52:02'),(71,'brands.view','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(72,'brands.create','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(73,'brands.edit','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(74,'brands.delete','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(75,'stock-movements.view','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(76,'stock-movements.create','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(77,'stock-movements.edit','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(78,'stock-movements.delete','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(79,'suppliers.view','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(80,'suppliers.create','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(81,'suppliers.edit','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(82,'suppliers.delete','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(83,'purchase-orders.view','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(84,'purchase-orders.create','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(85,'purchase-orders.edit','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(86,'purchase-orders.delete','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(87,'invoices.create','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(88,'invoices.delete','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(89,'payments.view','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(90,'payments.create','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(91,'payments.delete','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(92,'inventory.view','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(93,'inventory.manage','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(94,'view-reports','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(95,'roles.manage','web','2026-07-29 15:32:37','2026-07-29 15:32:37'),(96,'settings.manage','web','2026-07-29 15:32:37','2026-07-29 15:32:37');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescription_history`
--

DROP TABLE IF EXISTS `prescription_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prescription_history` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `examination_date` date NOT NULL,
  `od_sphere` decimal(5,2) DEFAULT NULL,
  `od_cylinder` decimal(5,2) DEFAULT NULL,
  `od_axis` int DEFAULT NULL,
  `od_addition` decimal(4,2) DEFAULT NULL,
  `od_pd` decimal(4,1) DEFAULT NULL,
  `og_sphere` decimal(5,2) DEFAULT NULL,
  `og_cylinder` decimal(5,2) DEFAULT NULL,
  `og_axis` int DEFAULT NULL,
  `og_addition` decimal(4,2) DEFAULT NULL,
  `og_pd` decimal(4,1) DEFAULT NULL,
  `pd_total` decimal(4,1) DEFAULT NULL,
  `vision_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'distance',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `diagnosis` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prescription_history_customer_id_foreign` (`customer_id`),
  KEY `prescription_history_user_id_foreign` (`user_id`),
  CONSTRAINT `prescription_history_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prescription_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription_history`
--

LOCK TABLES `prescription_history` WRITE;
/*!40000 ALTER TABLE `prescription_history` DISABLE KEYS */;
INSERT INTO `prescription_history` VALUES (1,1,2,'2026-07-14',4.25,1.75,4,NULL,NULL,0.75,0.75,NULL,NULL,NULL,NULL,'near',NULL,NULL,'2026-07-14 10:30:57','2026-07-14 10:30:57'),(2,1,2,'2026-07-14',1.75,0.50,2,NULL,NULL,0.75,0.25,1,NULL,NULL,NULL,'distance',NULL,NULL,'2026-07-14 10:32:00','2026-07-14 10:32:00'),(3,2,2,'2026-07-15',0.75,NULL,NULL,NULL,NULL,0.75,NULL,NULL,NULL,NULL,NULL,'distance',NULL,NULL,'2026-07-15 14:07:29','2026-07-15 14:07:29');
/*!40000 ALTER TABLE `prescription_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prescriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `doctor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prescription_date` date DEFAULT NULL,
  `right_sphere` decimal(5,2) DEFAULT NULL,
  `right_cylinder` decimal(5,2) DEFAULT NULL,
  `right_axis` int DEFAULT NULL,
  `left_sphere` decimal(5,2) DEFAULT NULL,
  `left_cylinder` decimal(5,2) DEFAULT NULL,
  `left_axis` int DEFAULT NULL,
  `pd` decimal(5,2) DEFAULT NULL,
  `addition` decimal(5,2) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prescriptions_customer_id_foreign` (`customer_id`),
  CONSTRAINT `prescriptions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescriptions`
--

LOCK TABLES `prescriptions` WRITE;
/*!40000 ALTER TABLE `prescriptions` DISABLE KEYS */;
INSERT INTO `prescriptions` VALUES (31,3,'Ona Rogahn','2026-06-19',-2.33,NULL,169,3.40,NULL,NULL,65.10,1.53,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20'),(32,8,'Percy Brown','2026-03-12',NULL,-0.89,NULL,NULL,NULL,132,NULL,2.44,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20'),(33,1,'Nia Reichert II','2026-03-25',-2.07,-0.78,107,-3.14,-0.42,78,72.90,1.15,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20'),(34,3,'Dr. Corene Hamill I','2026-06-17',-3.43,NULL,NULL,-5.40,-2.26,NULL,61.80,NULL,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20'),(35,8,'Eldred Rowe','2026-02-05',2.73,NULL,NULL,-2.56,-1.05,24,54.50,2.06,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20'),(36,8,'Keenan Nader PhD','2026-03-23',-4.73,NULL,44,-2.42,-2.81,NULL,NULL,3.32,'Omnis velit eligendi fugit.','2026-07-29 15:36:20','2026-07-29 15:36:20'),(37,2,'Miss Carissa Volkman','2026-02-23',2.49,NULL,NULL,-0.33,NULL,89,NULL,NULL,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20'),(38,8,'Sophia Batz','2026-04-25',-5.26,-0.30,106,2.87,NULL,NULL,69.90,NULL,'Ab in aut doloribus maxime eum cupiditate.','2026-07-29 15:36:20','2026-07-29 15:36:20'),(39,6,'Miss Lurline Brekke','2026-07-16',1.88,NULL,56,NULL,NULL,NULL,63.20,NULL,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20'),(40,7,'Glennie Lubowitz IV','2026-01-30',1.17,NULL,13,0.36,-2.30,NULL,NULL,1.64,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20'),(41,4,'Mr. Colton Keeling','2026-02-14',-0.16,NULL,161,0.89,-0.63,NULL,69.90,NULL,'Qui molestias inventore nisi est.','2026-07-29 15:36:20','2026-07-29 15:36:20'),(42,4,'Alysa McGlynn','2026-03-29',3.54,-0.61,NULL,-5.47,-0.88,18,65.90,NULL,NULL,'2026-07-29 15:36:20','2026-07-29 15:36:20');
/*!40000 ALTER TABLE `prescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `cost_price` decimal(10,2) DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `alert_threshold` int NOT NULL DEFAULT '5',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brand_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1206 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1001,'newone',161,100.00,0.14,8,5,'products/f9EkapsFL0SEIUDfEUdZOa8SGY4VCDbjKa7JgJd7.png',NULL,NULL,'2026-07-13 09:27:39','2026-07-14 12:52:07',NULL),(1202,'test1',161,120.00,NULL,2,5,NULL,'NEW ONE',NULL,'2026-07-14 12:48:42','2026-07-14 12:48:42',NULL),(1203,'test2',161,300.00,50.00,3,2,'products/9AvPfGhv4zobaFEB3LYcHTiajS4BH1AbIbGkJf0S.png',NULL,NULL,'2026-07-14 12:52:50','2026-07-15 09:01:32',NULL),(1204,'test4',161,120.00,50.00,18,3,NULL,NULL,NULL,'2026-07-15 09:02:00','2026-07-15 09:02:00',NULL),(1205,'sunglass',161,300.00,150.00,9,14,NULL,NULL,NULL,'2026-07-15 12:48:02','2026-07-15 12:48:37',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_order_items`
--

DROP TABLE IF EXISTS `purchase_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  KEY `purchase_order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `purchase_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_order_items`
--

LOCK TABLES `purchase_order_items` WRITE;
/*!40000 ALTER TABLE `purchase_order_items` DISABLE KEYS */;
INSERT INTO `purchase_order_items` VALUES (1,2,1204,60,115.78,6946.80,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(2,2,1202,10,282.96,2829.60,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(3,2,1204,87,72.60,6316.20,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(4,3,1001,27,101.69,2745.63,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(5,3,1001,17,223.18,3794.06,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(6,4,1001,90,142.26,12803.40,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(7,4,1202,14,410.99,5753.86,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(8,4,1204,13,31.10,404.30,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(9,5,1202,40,108.99,4359.60,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(10,5,1001,80,130.73,10458.40,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(11,5,1205,43,66.38,2854.34,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(12,5,1202,65,69.49,4516.85,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(13,6,1001,92,418.48,38500.16,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(14,6,1001,9,107.67,969.03,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(15,6,1204,8,483.56,3868.48,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(16,7,1205,81,453.72,36751.32,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(17,7,1203,47,341.80,16064.60,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(18,7,1001,45,28.84,1297.80,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(19,8,1205,45,153.28,6897.60,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(20,8,1205,22,266.59,5864.98,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(21,9,1204,12,243.49,2921.88,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(22,9,1204,95,66.30,6298.50,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(23,9,1204,9,32.85,295.65,'2026-07-29 15:35:23','2026-07-29 15:35:23');
/*!40000 ALTER TABLE `purchase_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `expected_date` date DEFAULT NULL,
  `status` enum('pending','received','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_orders_order_number_unique` (`order_number`),
  KEY `purchase_orders_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_orders`
--

LOCK TABLES `purchase_orders` WRITE;
/*!40000 ALTER TABLE `purchase_orders` DISABLE KEYS */;
INSERT INTO `purchase_orders` VALUES (1,11,'PO-20260729-8451','2026-05-13','2026-08-06','received',0.00,'Fuga libero dolor ipsum doloremque voluptatibus repellendus voluptate.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(2,2,'PO-20260729-0001','2026-07-28',NULL,'received',0.00,NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(3,13,'PO-20260729-0002','2026-06-13',NULL,'pending',0.00,'Rerum rerum eum ex ex recusandae.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(4,23,'PO-20260729-0003','2026-05-26','2026-08-05','received',0.00,'Sint odit amet aut.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(5,28,'PO-20260729-0004','2026-05-25','2026-09-19','received',0.00,'Nam aut vel voluptatem similique magni.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(6,2,'PO-20260729-0005','2026-06-07',NULL,'pending',0.00,NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(7,18,'PO-20260729-0006','2026-06-23',NULL,'pending',0.00,NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(8,14,'PO-20260729-0007','2026-07-09','2026-08-10','pending',0.00,'Consequatur et nulla aut et qui cumque commodi doloremque.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(9,26,'PO-20260729-0008','2026-06-30',NULL,'pending',0.00,'Sequi impedit molestiae est sed.','2026-07-29 15:35:23','2026-07-29 15:35:23');
/*!40000 ALTER TABLE `purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_customer_id_foreign` (`customer_id`),
  CONSTRAINT `reservations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,5,'2005-12-12','01:01:00',NULL,'completed',NULL,'2026-07-13 09:31:05','2026-07-13 09:31:05'),(2,7,'2020-01-04','01:59:00',NULL,'cancelled',NULL,'2026-07-13 13:36:11','2026-07-13 13:36:11'),(3,3,'2026-07-14','11:52:00',NULL,'confirmed',NULL,'2026-07-14 07:52:38','2026-07-14 07:52:38'),(4,6,'2026-07-15','09:55:00',NULL,'pending',NULL,'2026-07-14 07:55:07','2026-07-14 07:55:07'),(5,4,'2026-07-15','09:55:00',NULL,'pending',NULL,'2026-07-14 07:55:31','2026-07-14 07:55:31'),(6,4,'2026-07-03','02:01:00',NULL,'cancelled',NULL,'2026-07-15 09:07:57','2026-07-15 09:07:57'),(7,4,'2026-07-03','02:01:00',NULL,'cancelled',NULL,'2026-07-15 09:09:29','2026-07-15 09:09:29');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1),(95,1),(96,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,2),(49,2),(50,2),(51,2),(52,2),(53,2),(54,2),(55,2),(56,2),(57,2),(58,2),(59,2),(60,2),(61,2),(62,2),(63,2),(64,2),(65,2),(66,2),(67,2),(68,2),(69,2),(70,2),(71,2),(72,2),(73,2),(74,2),(75,2),(76,2),(77,2),(78,2),(79,2),(80,2),(81,2),(82,2),(83,2),(84,2),(85,2),(86,2),(87,2),(88,2),(89,2),(90,2),(91,2),(92,2),(93,2),(94,2),(39,3),(40,3),(41,3),(43,3),(47,3),(51,3),(52,3),(53,3),(55,3),(56,3),(57,3),(60,3),(61,3),(62,3),(66,3),(71,3),(89,3),(90,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2026-07-13 08:34:31','2026-07-13 08:34:31'),(2,'Manager','web','2026-07-13 08:41:46','2026-07-13 08:41:46'),(3,'Employee','web','2026-07-13 08:41:46','2026-07-13 08:41:46');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('8Pwp905uvMgE3XDVln92Db6nld4nz1uhRsLUkOJS',NULL,'172.18.0.1','curl/8.18.0','eyJfdG9rZW4iOiJ2b2taT0hoZkxBQlZRRWQ0NFE5SnpUVEU5SHZESkJ0cnRIU3h2QTVzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1785508006),('eRVZRtRMRznptP6yyLGgwWh658jqxkKD5gTQxcik',NULL,'172.18.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:149.0) Gecko/20100101 Firefox/149.0','eyJfdG9rZW4iOiI3UmRXSGx6SHIySDJaUUNpblhaR09WVU4ycGhTQ0JPWVZ1WXA1OUlnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1785509747),('gRMNfC9F9JcnP0S2oz756m3YuqMJW3kiuYelW5gc',NULL,'172.18.0.1','curl/8.18.0','eyJfdG9rZW4iOiJROFVXOUZkaUZ2RXdUaGg4WTFzODFKb01zNVR5cTBYdGoydEhWa0Z1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1785508369),('H58iRJ1GKFxz9csimhJdASQYdOoHgXuYDcfiOxoF',2,'172.18.0.1','curl/8.18.0','eyJfdG9rZW4iOiI4c2pxY2Uwc1NRbncxeHRpWHEzUUtXSDlGZ3R4bzFRUlRGRXRCMlV5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9icmFuZHNcLzEiLCJyb3V0ZSI6ImJyYW5kcy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsImxvY2FsZSI6ImFyIn0=',1785508194),('JX77zaeFdDPAc7F3daUq41peDTNYQgDgWMAPUrkG',2,'172.18.0.1','curl/8.18.0','eyJfdG9rZW4iOiJoUDlQd084NURLeVpYQ1NWVlRiMWtEaVlneHZVWnJkMHUzbkpjRmdkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jdXN0b21lcnNcLzEiLCJyb3V0ZSI6ImN1c3RvbWVycy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsImxvY2FsZSI6ImFyIn0=',1785509933),('oIhrzuA6K7yDhn0VA9IqeywHZHW4XF97ed6lLP24',2,'172.18.0.1','curl/8.18.0','eyJfdG9rZW4iOiJ1R0szU2hvdHNBcXZ3cWxJQWVBYkhZR3pyTlhmOXBSRm90QlFDWjRXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Mn0=',1785508018),('oZWbOJEdTAwW2JLv7sLXH75TSFcApZxJMmOV5Drk',NULL,'127.0.0.1','Symfony','eyJfdG9rZW4iOiJFVVN2VXhQaHVTVHVXdUJlOTZzam9wYTRsMkE2dDVPYWdTbW9abXFFIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0XC9jdXN0b21lcnNcLzEifSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvY3VzdG9tZXJzXC8xIiwicm91dGUiOiJjdXN0b21lcnMuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1785509928),('TDBRd5xy5ibtciXopS9HpQV7R4LdZDI2V0n3U5TZ',NULL,'172.18.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:149.0) Gecko/20100101 Firefox/149.0','eyJfdG9rZW4iOiJnNWQ0UU1kNWtnQkpxT3Fndjk0bkk0V0VYNWIycVBuMUFNcGo4UHFzIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2N1c3RvbWVycyJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2N1c3RvbWVycyIsInJvdXRlIjoiY3VzdG9tZXJzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1785509746),('z10sAVXWlxmkEtN0Aym0n1ZBHClPz7v3W5U90qkB',NULL,'172.18.0.1','curl/8.18.0','eyJfdG9rZW4iOiJnT0tZWUxDOVM3ajVscFhCWnVVU1o5aGw2clphakJXTjlOeWxjb0I2IiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2Rhc2hib2FyZCJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1785508007),('zHNcPYuHtZXeCreglAJmuXFmeVI9Ktux894G4opm',NULL,'172.18.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:149.0) Gecko/20100101 Firefox/149.0','eyJfdG9rZW4iOiJKOU1Pc1huTmF5ZmJORGZLa29zeHBTYm95d25OM215SXVrbW9INWVsIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==',1785510929);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'store_name','Optical Store','2026-07-14 08:25:11','2026-07-14 08:25:11'),(2,'store_address',NULL,'2026-07-14 08:25:11','2026-07-14 08:25:11'),(3,'store_phone',NULL,'2026-07-14 08:25:11','2026-07-14 08:25:11'),(4,'store_email','admin@optical.com','2026-07-14 08:25:11','2026-07-14 08:25:11'),(5,'tax_rate','20','2026-07-14 08:25:11','2026-07-14 08:25:11'),(6,'currency','MAD','2026-07-14 08:25:11','2026-07-14 08:25:11'),(7,'low_stock_threshold','10','2026-07-14 08:25:11','2026-07-14 08:25:11'),(8,'appointment_reminder_hours','24','2026-07-14 08:25:11','2026-07-14 08:25:11'),(9,'enable_sms_notifications','0','2026-07-14 08:25:11','2026-07-14 08:25:11'),(10,'enable_email_notifications','1','2026-07-14 08:25:11','2026-07-14 08:25:11'),(11,'opening_hours','{\"monday\":{\"start\":\"09:00\",\"end\":\"18:00\",\"open\":\"1\"},\"tuesday\":{\"start\":\"09:00\",\"end\":\"18:00\",\"open\":\"1\"},\"wednesday\":{\"start\":\"09:00\",\"end\":\"18:00\",\"open\":\"1\"},\"thursday\":{\"start\":\"09:00\",\"end\":\"18:00\",\"open\":\"1\"},\"friday\":{\"start\":\"09:00\",\"end\":\"18:00\",\"open\":\"1\"},\"saturday\":{\"start\":\"10:00\",\"end\":\"17:00\",\"open\":\"1\"},\"sunday\":{\"start\":\"09:00\",\"end\":\"18:00\",\"open\":\"1\"}}','2026-07-14 08:25:11','2026-07-14 08:25:24');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_movements`
--

DROP TABLE IF EXISTS `stock_movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_movements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `type` enum('IN','OUT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int unsigned NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_movements_product_id_foreign` (`product_id`),
  KEY `stock_movements_user_id_foreign` (`user_id`),
  KEY `stock_movements_type_index` (`type`),
  KEY `stock_movements_created_at_index` (`created_at`),
  CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stock_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_movements`
--

LOCK TABLES `stock_movements` WRITE;
/*!40000 ALTER TABLE `stock_movements` DISABLE KEYS */;
INSERT INTO `stock_movements` VALUES (1,1001,2,'IN',3,NULL,NULL,'2026-07-13 14:25:41','2026-07-13 14:25:41');
/*!40000 ALTER TABLE `stock_movements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'McDermott, Breitenberg and Davis','Bret Orn','skiles.serena@altenwerth.com','+18453038585','490 Therese Parkway\nLake Kelton, WY 42866-2779',NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(2,'Toy, O\'Conner and Ritchie','Nels Beer IV','xzavier52@gottlieb.com','+15418028094','120 O\'Kon Fields\nLoweville, VA 23422','Soluta rerum aut non unde quis rerum officia suscipit.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(3,'Waelchi Inc','Andreane Wiegand','hill.murl@schmidt.com','646-687-2977','1724 Deven Gardens\nNorth Judd, CT 32511-1182','Consequatur voluptatem quo reprehenderit incidunt.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(4,'Johnston-Glover','Rebeca Christiansen','adams.karine@friesen.com','1-973-914-8359','2771 Stoltenberg Crossroad Suite 999\nKuhnville, MD 62950','Nulla odit in dolorem ab id cumque.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(5,'Muller Group','Marion Moen Jr.','wolff.alfred@rodriguez.net','(440) 451-4859','13047 Myron Ridges\nLake Greysonton, HI 85336','Nesciunt eos et quaerat quis.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(6,'Kutch, Brekke and Bruen','Mrs. Kiara Green Sr.','katarina87@schumm.com','484.548.3783','840 Haleigh Roads\nJastfort, TN 88064','Quis vel dolor ex natus impedit.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(7,'Effertz and Sons','Trenton Sipes','zoconnell@howell.com','+1 (707) 517-4541','22542 Brian Manor Apt. 222\nEstelfurt, CT 18480',NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(8,'Ullrich-Fisher','Retha Heathcote','daugherty.daisy@ruecker.com','1-283-499-5082','64231 Deckow Square\nQuinnburgh, KS 99582','Laborum ipsam consectetur tempore.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(9,'Gutkowski, Hintz and Nikolaus','Matilda Dare','dspinka@marks.net','+1.302.246.5620','72360 McDermott Bypass\nStreichtown, AL 19327',NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(10,'Bernier-Leffler','Gertrude Carter','cormier.armand@schamberger.com','+1-256-368-5607','6522 Muller Islands Apt. 809\nShanahanfurt, IN 07426-9768',NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(11,'Lesch, Baumbach and Shanahan','Justine Murray','jupton@muller.com','+12097726172','2069 Dickinson Plains Suite 598\nTedton, HI 03942',NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(12,'Hyatt Inc','Citlalli Carter','daniella87@quigley.info','(361) 599-2596','11855 Reva Points Suite 192\nEast Rasheedland, MA 28452-0149',NULL,'2026-07-29 15:35:08','2026-07-29 15:35:08'),(13,'Lindgren Ltd','Delbert Willms','pward@kris.org','+1 (386) 977-9307','66266 Nienow Terrace Apt. 838\nEast Ellafort, HI 93656-5217','Sed iusto non sed nisi.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(14,'Padberg Ltd','Carissa Kerluke','eva.rempel@effertz.com','+1-678-592-0473','8597 Jordan Center\nThielville, MD 97383-1026','Deleniti nulla ab nulla quasi.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(15,'Walter Inc','Delilah Tromp','nparker@mclaughlin.com','+1.772.484.9862','276 Hessel Stream\nAlenehaven, OK 30037-4351','Qui quasi officiis quia quis quasi doloribus aut iure.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(16,'Smith, Wiegand and Oberbrunner','Mr. Ethan Friesen I','metz.lottie@swaniawski.com','+1-469-926-7524','913 Flavie Run\nMarisaside, VA 37693','Accusantium qui suscipit laborum quis vel est vitae.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(17,'Robel, Sanford and Conn','Prof. Oma Farrell MD','watsica.mireille@waelchi.com','458.216.5979','83678 Kirlin Keys\nColtberg, WA 43877','Numquam ut sunt unde rem.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(18,'Mills Group','Dr. Amely Goldner V','annetta.shanahan@murray.info','+1 (870) 856-0398','41810 Abigail Creek Apt. 507\nTrentchester, CT 31366-2381','Est fugiat ut nesciunt ducimus corporis aperiam praesentium.','2026-07-29 15:35:08','2026-07-29 15:35:08'),(19,'Nolan Group','Dr. Enid Hodkiewicz Sr.','leonie.harber@conroy.com','+1-480-405-8324','3281 Robel Roads Suite 487\nNorth Howellhaven, TX 68056-9191',NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(20,'Gleichner Inc','Herman Leuschke DVM','bhills@bechtelar.com','+17347252923','3564 Jacobson Road Apt. 835\nPollichborough, SC 92963','Consequatur harum dolore sed occaecati reiciendis ea.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(21,'Lehner, Ward and Stoltenberg','Prof. Adonis Reynolds','xwyman@mante.com','+1.252.828.1422','606 Everett Neck Suite 919\nOlafland, NE 77471','Aut distinctio harum vel.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(22,'Wolf, Yost and Pfannerstill','Prof. Bruce Toy','toreilly@rath.com','+1 (346) 706-5440','97642 Adela Points Apt. 340\nNew Eudora, AZ 12259','Iste voluptas minus dolore et.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(23,'Bayer Ltd','Prof. Flossie Wilderman','maverick17@robel.org','725.763.3799','755 Ramona Street\nNorth Marisabury, IA 37321-6279',NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(24,'Marks PLC','Ms. Janie Murray PhD','moore.chloe@stark.info','(314) 428-1372','74976 Cremin Knolls\nAmericaberg, SC 79144-0591','Dignissimos qui perferendis incidunt ut aut officiis dolores.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(25,'Lehner-Spinka','Catherine Dickinson DDS','rodriguez.iva@feest.com','954.742.9697','669 Tristian Plaza Suite 771\nWest Amelie, RI 31803','Amet nemo laudantium ad.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(26,'Okuneva-Conn','Violette Murray','kmante@langosh.com','(940) 702-6875','9361 Bartell Motorway\nSouth Darren, NY 03886',NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23'),(27,'Connelly, Franecki and Lang','Dr. Jannie Schuster','kuphal.luis@koss.com','820-833-4087','5821 Murazik Divide Apt. 402\nMaiyafort, NH 90941-3250','Eos aspernatur ut consequuntur consequatur qui ipsam.','2026-07-29 15:35:23','2026-07-29 15:35:23'),(28,'Hansen Inc','Maci Oberbrunner','sandy.mayer@stark.org','+1-305-480-0017','4970 Terry Motorway\nPort Josephineshire, AR 56667-1195',NULL,'2026-07-29 15:35:23','2026-07-29 15:35:23');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Admin User','admin@optical.com',NULL,'$2y$12$FZCK/G66ScQ3me9nzOCogunZBmPc/OS616X/m2J3s2Aq/enPXxOHm','o2lXbYN4Wex3w7YfVdWVX6w9hJzCTPxXXom6cd5J3by90Efr9UlHDOO0z430','2026-07-13 10:02:06','2026-07-29 15:32:37'),(9,'Manager User','manager@optical.com',NULL,'$2y$12$pcicS.SiAI46Zu1KfLdRGuFsQ6Dw0.n26omGBFhPPUrqEWRmO7fLG',NULL,'2026-07-29 15:32:38','2026-07-29 15:32:38'),(10,'Employee User','employee@optical.com',NULL,'$2y$12$ak.jPRN06KrslFz26VdPhOK90rWDRWao63NTzWHUtHJCEg76YEVZe',NULL,'2026-07-29 15:32:38','2026-07-29 15:32:38');
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

-- Dump completed on 2026-07-31 16:02:07
