-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: db_fotoclass
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.31-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `lieux`
--

DROP TABLE IF EXISTS `lieux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lieux` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `ville` varchar(125) NOT NULL,
  `pays` enum('SUISSE','FRANCE') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lieux`
--

LOCK TABLES `lieux` WRITE;
/*!40000 ALTER TABLE `lieux` DISABLE KEYS */;
INSERT INTO `lieux` VALUES (1,'Salève','Rue de Genève','1200','Genève','SUISSE'),(2,'Lac de Genève','Rue de Genève','1200','Genève','SUISSE'),(3,'CFPT','Rue de Genève','1200','Genève','SUISSE'),(4,'Cathédrale Saint-Pierre','Rue de Genève','1200','Genève','SUISSE'),(5,'Place de la sardaigne','Rue de Genève','1200','Genève','SUISSE'),(6,'Boulangerie du quartier','Rue de Genève','1200','Genève','SUISSE'),(7,'Tour-Eiffel','Rue de Paris','90','Paris','FRANCE'),(8,'La Seine','Rue de Paris','90','Paris','FRANCE'),(9,'Accor hotel arena','Rue de Paris','90','Paris','FRANCE'),(10,'Rhône','Rue de Genève','1200','Genève','SUISSE'),(11,'Ecole du Seujet','Rue de Genève','1200','Genève','SUISSE');
/*!40000 ALTER TABLE `lieux` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motsclefs`
--

DROP TABLE IF EXISTS `motsclefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motsclefs` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(125) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motsclefs`
--

LOCK TABLES `motsclefs` WRITE;
/*!40000 ALTER TABLE `motsclefs` DISABLE KEYS */;
INSERT INTO `motsclefs` VALUES (1,'Animal'),(2,'Montagne'),(3,'Monument'),(4,'Espace'),(5,'Paysage'),(6,'Dessin'),(7,'Ciel'),(8,'Humain'),(9,'Eau'),(10,'Ville');
/*!40000 ALTER TABLE `motsclefs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productions`
--

DROP TABLE IF EXISTS `productions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` mediumint(9) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `lieux_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IND_utilisateurs_id` (`utilisateurs_id`) USING BTREE,
  KEY `IND_lieux_id` (`lieux_id`),
  CONSTRAINT `productions_ibfk_1` FOREIGN KEY (`utilisateurs_id`) REFERENCES `utilisateurs` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `productions_ibfk_2` FOREIGN KEY (`lieux_id`) REFERENCES `lieux` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productions`
--

LOCK TABLES `productions` WRITE;
/*!40000 ALTER TABLE `productions` DISABLE KEYS */;
INSERT INTO `productions` VALUES (1,1,'Un rat pendant ma randonée','Il n&#39;avait rien à faire là.','IMG_6336a6ed59ce4.rat-gd9f7da9d4_1920.jpg','2020-04-16',1),(2,1,'Le tableau de ma tante','Elle a du talent','IMG_6336a7680fd52.forest-g90b22a10c_1920.jpg','2022-05-12',2),(3,1,'Projection sur l&#39;écran géant','Le réalisme est incroyable !','IMG_6336a8020ce0c.earth-g31bbaa006_1920.jpg','2019-06-12',9),(4,1,'Mon ami Whiskas','Il est trop mignon.','IMG_6336a873ad9c0.animal-g0bab89f5c_1920.jpg','2021-01-12',10),(5,1,'Le Salève tôt le matin','J&#39;étais fatigué.','IMG_6336a8da196df.mountains-g9702b5f5c_1920.jpg','2020-09-16',1),(6,1,'Le joli pont','','IMG_6336ac0a58e35.bridge-g23698ccaf_1920.jpg','2022-01-04',8),(7,1,'Balade avec Lucky','Grand soleil !','IMG_6336ad5eb06d5.no-suffer-society-g1caaa25cb_1920.jpg','2022-09-12',6),(8,1,'Carouge dans 20 ans','Incroyable  ces grattes-ciel !','IMG_6336aedee14b4.new-york-ge7a523d05_1920.jpg','2042-10-22',5),(9,1,'Une toile d&#39;araignée en montagne','Vais-je devenir spiderman ?','IMG_6336afaf97c16.spider-web-6677845.jpg','2023-09-05',1),(10,1,'Au dessus des nuages','','IMG_6336afdfee996.spaceship-g6a7a5b52f_1920.jpg','2022-04-12',4),(11,1,'Long couloir','On en a jamais fini.','IMG_6336b0180efc1.image1.jpg','2022-03-08',3),(12,1,'Le monastère','','IMG_6336b04e78cee.monastery-ge50561038_1920.jpg','2022-02-16',2),(14,1,'La lune depuis le lac','C&#39;est magnifique !','../uploads/IMG_6336b10168cf5.moon-g21b9b99eb_1920.jpg','2022-06-23',2);
/*!40000 ALTER TABLE `productions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productions_has_motsclefs`
--

DROP TABLE IF EXISTS `productions_has_motsclefs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productions_has_motsclefs` (
  `productions_id` int(11) NOT NULL,
  `motsclefs_id` smallint(6) NOT NULL,
  PRIMARY KEY (`productions_id`,`motsclefs_id`),
  KEY `IND_productions_id` (`productions_id`),
  KEY `IND_motsclefs_id` (`motsclefs_id`),
  CONSTRAINT `productions_has_motsclefs_ibfk_1` FOREIGN KEY (`productions_id`) REFERENCES `productions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `productions_has_motsclefs_ibfk_2` FOREIGN KEY (`motsclefs_id`) REFERENCES `motsclefs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productions_has_motsclefs`
--

LOCK TABLES `productions_has_motsclefs` WRITE;
/*!40000 ALTER TABLE `productions_has_motsclefs` DISABLE KEYS */;
INSERT INTO `productions_has_motsclefs` VALUES (1,1),(1,2),(2,1),(2,6),(2,8),(3,4),(4,1),(5,2),(5,5),(6,5),(6,9),(7,1),(7,5),(7,8),(7,10),(8,5),(8,7),(8,10),(9,2),(9,5),(10,7),(11,8),(12,3),(12,5),(14,4),(14,7),(14,9);
/*!40000 ALTER TABLE `productions_has_motsclefs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `login` varchar(125) NOT NULL,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'User','e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_fotoclass'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-30 11:10:56
