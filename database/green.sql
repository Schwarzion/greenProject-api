-- MariaDB dump 10.17  Distrib 10.5.5-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: greenDB
-- ------------------------------------------------------
-- Server version	10.5.5-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `levelExpAmount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` VALUES (1,'Debutant1','Débutant niveau 1',30),(2,'Debutant2','Débutant niveau 2',60),(3,'Debutant3','Débutant niveau 3',90),(4,'Debutant4','Débutant niveau 4',120),(5,'Debutant5','Débutant niveau 5',150),(6,'Intermediaire1','Intermédiaire niveau 1',200),(7,'Intermediaire2','Intermédiaire niveau 2',250),(8,'Intermediaire3','Intermédiaire niveau 3',300),(9,'Intermediaire4','Intermédiaire niveau 4',350),(10,'Intermediaire5','Intermédiaire niveau 5',400),(11,'Avance1','Avancé niveau 1',470),(12,'Avance2','Avancé niveau 2',540),(13,'Avance3','Avancé niveau 3',610),(14,'Avance4','Avancé niveau 4',680),(15,'Avance5','Avancé niveau 5',750),(16,'Confirme1','Confirmé niveau 1',840),(17,'Confirme2','Confirmé niveau 2',930),(18,'Confirme3','Confirmé niveau 3',1020),(19,'Confirme4','Confirmé niveau 4',1110),(20,'Confirme5','Confirmé niveau 5',1200),(21,'Expert1','Expert niveau 1',1310),(22,'Expert2','Expert niveau 2',1420),(23,'Expert3','Expert niveau 3',1530),(24,'Expert4','Expert niveau 4',1640),(25,'Expert5','Expert niveau 5',1750);
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quest`
--

DROP TABLE IF EXISTS `quest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expAmount` int(11) NOT NULL,
  `minLevel` int(11) NOT NULL,
  `timeForQuest` int(11) DEFAULT NULL,
  `endDate` date NOT NULL,
  `questStatus` smallint(6) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quest`
--

LOCK TABLES `quest` WRITE;
/*!40000 ALTER TABLE `quest` DISABLE KEYS */;
INSERT INTO `quest` VALUES (1,'testQuest','Choppe ta bouteille',100,1,100000,'2030-12-31',1),(2,'Gourde','Achète une gourde ',5,2,100000,'2020-07-21',1),(4,'Gourde2','test',5,2,100000,'2020-07-21',1),(5,'Concert\'eau','Ramène ton ecocup au concert',20,2,100000,'2020-07-21',1),(6,'Courses en sac','Stop aux sacs platisques',30,2,100000,'2020-07-21',1),(7,'Dolce Vita','Jette ta machine à dosette, place à l\'itallienne',5,2,100000,'2020-07-21',1);
/*!40000 ALTER TABLE `quest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'admin','Admin privileges');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roleUser`
--

DROP TABLE IF EXISTS `roleUser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roleUser` (
  `userId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`roleId`),
  KEY `fkIdx_userId` (`userId`),
  KEY `fkIdx_role_id` (`roleId`),
  CONSTRAINT `FK_role_user` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_role` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roleUser`
--

LOCK TABLES `roleUser` WRITE;
/*!40000 ALTER TABLE `roleUser` DISABLE KEYS */;
INSERT INTO `roleUser` VALUES (1,1);
/*!40000 ALTER TABLE `roleUser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tip`
--

DROP TABLE IF EXISTS `tip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipStatus` smallint(6) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip`
--

LOCK TABLES `tip` WRITE;
/*!40000 ALTER TABLE `tip` DISABLE KEYS */;
INSERT INTO `tip` VALUES (1,'L\'eau de là','Adieu les bouteilles d\'eau, le charbon actif permet d\'assainir l\'eau du robinet!',1),(2,'Marc de café','Le marc de café peux servir a plein de fonctions : gommage, engrasi, absorbeur de mauvaise odeur ...etc',1),(3,'Nouvelle vie','Ne jettes pas ton pain s\'il est dur, tu peux toujours en faire du pain perdu ou même le donner aux animaux',1),(4,'Non à la pub ! ','Met un autocollant \"Stop Pub\" sur ta boite aux lettres si tu es contre la production intensive de papier',1),(5,'Que faire de mes fruits trop mûrs ? ','Si tu as des fruits trop mûrs, fait des compotes ou des confitures!',1),(6,'Liquide vaisselle','Y\'en a encore ! Ton flacon de liquide vaisselle est pratiquement terminé? Ajoutes-y de l\'eau',1);
/*!40000 ALTER TABLE `tip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `userStatus` smallint(6) NOT NULL DEFAULT 1,
  `address` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postalCode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(89) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` smallint(6) NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `exp` int(11) NOT NULL DEFAULT 0,
  `temporaryPassword` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temparyPasswordValid` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user` (`email`,`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Joe','Mama','test@mail.com',1,1,'420 Marble Street','Lille','59000','test@mail.com',1,'0752627592','1995-11-20',0,NULL,'$2y$10$ogL1nHZhVaRXpu1Z.vG3DOyT8iZyvnIN.WmDF9pUYd6xvrfOITowq',NULL),(12,'testName','testLastName','testmail@test.fr',1,1,'42 Rue du Test','testCity','75000','testmail@test.fr',1,'0123456789','2000-01-01',0,NULL,'$2y$10$8K976/XC.tSjmKKOTRD/9e1bgsYf0M/wkwRq0VLgaptNQcSw29fF2',NULL),(13,'Joe','Mama','testmai2l@test.fr',1,0,'420 Marble Street','Lille','59000','testmai2l@test.fr',1,'0752627592','1995-11-20',0,NULL,'$2y$10$7tAqL3luTFVVdxIpuxE0ru.MN6mo49qsawClI08xSzSZGZNCTwJEW',NULL),(14,'toto','vivi','tovi',1,1,'1 rue des papillons','Kiwi','80000','tototest@mail.com',0,'0192837465','1998-01-01',0,NULL,'$2y$10$vFyxaHq/zRLcBU7f8nqBQerW.GyryVQ/teDRtVD7J0f6K8YP/ab2y',NULL),(15,'Joe','Mama','test',1,1,'420 Marble Street','Lille','59000','jean@mail.com',1,'0752627592','1995-11-20',0,NULL,'$2y$10$SwRcSztYJb8647ZfPcLM0eX4RDXkP19sN5.GEJlzczWdp1gVXkGo2',NULL),(16,'Joe','Mama','testhg',1,1,'420 Marble Street','Lille','59000','jean@mail.comht',1,'0752627592','1995-11-20',0,NULL,'$2y$10$RNx5zPexO0YzjZu7bEkYs.Jzucxp0/oBoqHymmEJmZRG3Kn/nSuO.',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userQuest`
--

DROP TABLE IF EXISTS `userQuest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userQuest` (
  `questId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `expire` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  PRIMARY KEY (`questId`,`userId`),
  KEY `fkIdx_questId` (`questId`),
  KEY `fkIdx_userId` (`userId`),
  CONSTRAINT `FK_quest_user` FOREIGN KEY (`questId`) REFERENCES `quest` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_quest` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userQuest`
--

LOCK TABLES `userQuest` WRITE;
/*!40000 ALTER TABLE `userQuest` DISABLE KEYS */;
INSERT INTO `userQuest` VALUES (5,1,'2020-12-31 00:00:00',1),(6,1,'2020-12-31 00:00:00',1),(6,12,'2020-12-31 00:00:00',1),(7,1,'2020-12-31 00:00:00',1),(7,12,'2020-12-31 00:00:00',1);
/*!40000 ALTER TABLE `userQuest` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-09 18:33:15
