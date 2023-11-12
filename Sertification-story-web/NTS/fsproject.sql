CREATE DATABASE  IF NOT EXISTS `fsproject` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `fsproject`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fsproject
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.37-MariaDB

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
-- Table structure for table `cerita`
--

DROP TABLE IF EXISTS `cerita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cerita` (
  `idcerita` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `idusers_pembuat_awal` varchar(40) NOT NULL,
  PRIMARY KEY (`idcerita`),
  KEY `fk_cerita_users1_idx` (`idusers_pembuat_awal`),
  CONSTRAINT `fk_cerita_users1` FOREIGN KEY (`idusers_pembuat_awal`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cerita`
--

LOCK TABLES `cerita` WRITE;
/*!40000 ALTER TABLE `cerita` DISABLE KEYS */;
/*!40000 ALTER TABLE `cerita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paragraf`
--

DROP TABLE IF EXISTS `paragraf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paragraf` (
  `idparagraf` int(11) NOT NULL AUTO_INCREMENT,
  `idusers` varchar(40) NOT NULL,
  `idcerita` int(11) NOT NULL,
  `isi_paragraf` varchar(3000) DEFAULT NULL,
  `tanggal_buat` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idparagraf`),
  KEY `fk_paragraf_users_idx` (`idusers`),
  KEY `fk_paragraf_cerita1_idx` (`idcerita`),
  CONSTRAINT `fk_paragraf_cerita1` FOREIGN KEY (`idcerita`) REFERENCES `cerita` (`idcerita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_paragraf_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paragraf`
--

LOCK TABLES `paragraf` WRITE;
/*!40000 ALTER TABLE `paragraf` DISABLE KEYS */;
/*!40000 ALTER TABLE `paragraf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `idusers` varchar(40) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('160421148','Brithney','e223d5be7e719da173c3ca4aacdebac6f7c018b9f8a3633ae3634c02246cb3b2','7f1e7fd1f73ac67b1ba7'),('160721003','Irvan','576faf75fc1edbcfda1ab8a46ee1bc265ddee7543943eed1450a4cad6db30066','38476028e249ba7d90f2');
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

-- Dump completed on 2023-11-12 12:06:03
