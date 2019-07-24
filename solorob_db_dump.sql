-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: 10.10.20.20    Database: solorob_db
-- ------------------------------------------------------
-- Server version	8.0.17

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--



--
-- Table structure for table `tbl_benutzer`
--

DROP TABLE IF EXISTS `tbl_benutzer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_benutzer` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` varchar(45) NOT NULL,
  `b_vorname` varchar(45) NOT NULL,
  `b_nickname` varchar(45) NOT NULL,
  `b_password` varchar(100) NOT NULL,
  `b_rechte_rolle_id` int(11) NOT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_nickname` (`b_nickname`),
  KEY `fk_benutzer_rechte` (`b_rechte_rolle_id`),
  CONSTRAINT `fk_benutzer_rechte` FOREIGN KEY (`b_rechte_rolle_id`) REFERENCES `tbl_rechte_rolle` (`rr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_benutzer`
--

LOCK TABLES `tbl_benutzer` WRITE;
/*!40000 ALTER TABLE `tbl_benutzer` DISABLE KEYS */;
INSERT INTO `tbl_benutzer` VALUES (1,'admin','admin','admin','$2y$10$asYVvykhqIdLAwWZN72Dd.E2JQeviaf88uHr4DXEPyCTpS8hjWxeK',1),(3,'updatename','update vorname','updateNick','$2y$10$QWYwbg3t.xClunaeQe4ER.Z7v6jRIfwjZGQM6XuxrGO7Sx0RMTJy2',2),(5,'Lurchman','Johannes','Lurchi22','$2y$10$OXD3cUXjbXVjBWmlXc0AWO1j4yCPeaQGgIrK1FeotTx4USPoAMyim',4),(8,'Schweizer','Jochen','Jochen_Schweizer77','$2y$10$/lb84z9fjeCkHza3WXFNEOAxo8N0frn1Plc.WM/n5kNVCCVUotny.',3),(9,'Braun','Eva','Brownie','$2y$10$X1J7UKgVpDmgn7xuHdTMxOeT7u8zUPTTQtwbCQZbevFj9UXJ246N2',3),(10,'Lustig','Peter','Rofl12','$2y$10$DirurTtnUvNdtzs2OvhhVOFqeTzVB3dMLEtsVfBusuQUjAcSh153.',2),(11,'Database','Drop','Drop Database Benutzer;','$2y$10$CiokPCXUn2GyVqm6nRFGne2iSeARSdrMDJdroE68Anfgy4hw47QMa',2),(15,'Holy','Jesus','DerHeiler12','$2y$10$wPwzQyxJ4g4KIpXwLEcYJejarwtMRyrJyDr90Cf3x/T/mDwRBpgAC',4),(16,'Elmo','Weißer','Weißer Elmo','$2y$10$fJy7cXrV6wdS9R5PV/pmg.ysPvbXMjFpYnanU1d/82M.f7Wy.s5RS',2);
/*!40000 ALTER TABLE `tbl_benutzer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_komponente_hat_attribute`
--

DROP TABLE IF EXISTS `tbl_komponente_hat_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_komponente_hat_attribute` (
  `kha_id` int(11) NOT NULL AUTO_INCREMENT,
  `komponenten_k_id` int(11) NOT NULL,
  `komponentenattribute_kat_id` int(11) DEFAULT NULL,
  `khkat_wert` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`kha_id`),
  KEY `fk_komponente_hat_attribute__komponentenattribute` (`komponentenattribute_kat_id`),
  KEY `fk_komponente_hat_attribute__komponenten_k_id` (`komponenten_k_id`),
  CONSTRAINT `fk_komponente_hat_attribute__komponenten_k_id` FOREIGN KEY (`komponenten_k_id`) REFERENCES `tbl_komponenten` (`k_id`),
  CONSTRAINT `fk_komponente_hat_attribute__komponentenattribute` FOREIGN KEY (`komponentenattribute_kat_id`) REFERENCES `tbl_komponentenattribute` (`kat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_komponente_hat_attribute`
--

LOCK TABLES `tbl_komponente_hat_attribute` WRITE;
/*!40000 ALTER TABLE `tbl_komponente_hat_attribute` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_komponente_hat_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_komponenten`
--

DROP TABLE IF EXISTS `tbl_komponenten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_komponenten` (
  `k_id` int(11) NOT NULL AUTO_INCREMENT,
  `k_bezeichnung` varchar(100) DEFAULT NULL,
  `raeume_r_id` int(11) DEFAULT NULL,
  `lieferant_l_id` int(11) DEFAULT NULL,
  `k_einkaufsdatum` date DEFAULT NULL,
  `k_gewaehrleistungsdauer` int(11) DEFAULT NULL,
  `k_notiz` varchar(1024) DEFAULT NULL,
  `k_hersteller` varchar(45) DEFAULT NULL,
  `komponentenarten_ka_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`k_id`),
  KEY `fk_komponenten__raeume_id` (`raeume_r_id`),
  KEY `fk_komponenten__lieferant_id` (`lieferant_l_id`),
  KEY `fk_komponenten__komponentenarten_id` (`komponentenarten_ka_id`),
  CONSTRAINT `fk_komponenten__komponentenarten_id` FOREIGN KEY (`komponentenarten_ka_id`) REFERENCES `tbl_komponentenarten` (`ka_id`),
  CONSTRAINT `fk_komponenten__lieferant_id` FOREIGN KEY (`lieferant_l_id`) REFERENCES `tbl_lieferant` (`l_id`),
  CONSTRAINT `fk_komponenten__raeume_id` FOREIGN KEY (`raeume_r_id`) REFERENCES `tbl_raeume` (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_komponenten`
--

LOCK TABLES `tbl_komponenten` WRITE;
/*!40000 ALTER TABLE `tbl_komponenten` DISABLE KEYS */;
INSERT INTO `tbl_komponenten` VALUES (187,'komp bezeichn 1',39,2,'2000-04-04',365,'super notiz1','hersteller 1',4),(188,'komp bezeichn 2',39,2,'2000-05-05',365,'super notiz2','hersteller 2',4),(189,'komp bezeichn 3',39,2,'2000-06-06',365,'super notiz3','hersteller 3',4),(190,'komp bezeichn 4',39,2,'2000-07-07',365,'super notiz4','hersteller 4',4),(191,'komp bezeichn 5',39,2,'2000-08-08',365,'super notiz5','hersteller 5',4),(192,'komp bezeichn 6',39,2,'2000-09-09',365,'super notiz6','hersteller 6',4),(193,'komp bezeichn 7',39,2,'2000-10-10',365,'super notiz7','hersteller 7',4),(194,'komp bezeichn 8',39,2,'2000-11-11',365,'super notiz7','hersteller 7',4);
/*!40000 ALTER TABLE `tbl_komponenten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_komponentenarten`
--

DROP TABLE IF EXISTS `tbl_komponentenarten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_komponentenarten` (
  `ka_id` int(11) NOT NULL AUTO_INCREMENT,
  `ka_komponentenart` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ka_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_komponentenarten`
--

LOCK TABLES `tbl_komponentenarten` WRITE;
/*!40000 ALTER TABLE `tbl_komponentenarten` DISABLE KEYS */;
INSERT INTO `tbl_komponentenarten` VALUES (2,'updated komponentenart'),(3,'Switches'),(4,'PC'),(5,'Router');
/*!40000 ALTER TABLE `tbl_komponentenarten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_komponentenattribute`
--

DROP TABLE IF EXISTS `tbl_komponentenattribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_komponentenattribute` (
  `kat_id` int(11) NOT NULL AUTO_INCREMENT,
  `kat_bezeichnung` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`kat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_komponentenattribute`
--

LOCK TABLES `tbl_komponentenattribute` WRITE;
/*!40000 ALTER TABLE `tbl_komponentenattribute` DISABLE KEYS */;
INSERT INTO `tbl_komponentenattribute` VALUES (2,'updated komp attr'),(8,'Hersteller'),(9,'Bezeichnung'),(10,'Raum'),(11,'Gewährleistungsdauer'),(12,'Kaufbeleg'),(14,'Lieferant'),(15,'Notiz'),(16,'Seriennummer'),(17,'Versionsnummer'),(18,'RAM Größe'),(19,'RAM Größe'),(20,'CPU Bezeichnung'),(21,'Festplatte Größe'),(22,'Festplatten Typ'),(23,'Grafikausgang'),(24,'Anzahl Ports'),(25,'Uplinktype'),(26,'Uplinktype'),(27,'IP1'),(28,'IP2'),(29,'IP3'),(30,'IP4'),(31,'WLAN-Standard'),(32,'Druckertyp'),(33,'Drucker Art'),(34,'Druckformat'),(35,'Beidseitig'),(36,'ANSI-Lumen'),(37,'Eingang'),(38,'Lautsprecher'),(39,'Grafikanschluss'),(40,'Lizenztyp'),(41,'Lizenanzahl'),(42,'Lizenzlaufzeit'),(43,'Lizentinformationen'),(44,'Installationshinweis');
/*!40000 ALTER TABLE `tbl_komponentenattribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lieferant`
--

DROP TABLE IF EXISTS `tbl_lieferant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lieferant` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_firmenname` varchar(45) DEFAULT NULL,
  `l_strasse` varchar(45) DEFAULT NULL,
  `l_plz` varchar(5) DEFAULT NULL,
  `l_ort` varchar(45) DEFAULT NULL,
  `l_tel` varchar(20) DEFAULT NULL,
  `l_mobil` varchar(20) DEFAULT NULL,
  `l_fax` varchar(20) DEFAULT NULL,
  `l_email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lieferant`
--

LOCK TABLES `tbl_lieferant` WRITE;
/*!40000 ALTER TABLE `tbl_lieferant` DISABLE KEYS */;
INSERT INTO `tbl_lieferant` VALUES (2,'updateFirma','update strasse','9716','entenhausen','90020','51982743','723598724','update@mail.com'),(3,'Bertram','Gasweg','87495','Einschwitz','0800 666 666','0160 57486214','0800 6969 69','Venti.Lator@blasen.de'),(4,'Holga','Strenstraße','91835','Kaff','08002010230','020340596869','02039458600','h.olga@hotmail.com'),(5,'Braun Gastechnik GmbH','Gasweg 88','87415','Dachau','092 884269','0160 941875','092 694288','Duschen@Gastechnik.de'),(6,'Ouzo&Jäger GmbH','Altdorferradweg 27','91183','Poppenreuth','01000994300','77723894132131','haben wir keine','Wir_machen_ekeligen@Alk.de'),(7,'Jackie&Cola ','Alkistraße 23','12945','Münchhausen','09123848569','0192389485856','120304589','Jack@cola@hotmail.com'),(8,'Schlaeger','Hagelstraße','03958','Bayreuth','21349057','7834723847','37284723','Schlaeger@web.de'),(9,'Liefrando','Überallalee 2','34509','Überall','245697805','2349053745','343900053','Lieferando@hotmail.com'),(10,'?','?','?','?‍♀️','??','?','?','?');
/*!40000 ALTER TABLE `tbl_lieferant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_raeume`
--

DROP TABLE IF EXISTS `tbl_raeume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_raeume` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `r_nr` varchar(20) DEFAULT NULL,
  `r_bezeichnung` varchar(45) DEFAULT NULL,
  `r_notiz` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_raeume`
--

LOCK TABLES `tbl_raeume` WRITE;
/*!40000 ALTER TABLE `tbl_raeume` DISABLE KEYS */;
INSERT INTO `tbl_raeume` VALUES (1,'000','Ausmusterung','Hierhin werden ausgemusterte Komponenten verschoben.'),(38,'10','Raum 10','Sport, nix für Fabian'),(39,'11','Raum 11','Technik'),(40,'29','Raum 29','Lan-Party'),(42,'15','Pause','Ein Raum zum Speißen und Entspannen'),(43,'69','Pekingente','Küche'),(44,'156','Experiementalraum','Hulk'),(45,'88','Raucher','Raucherraum'),(46,'123','123','123'),(47,'1337','Schämdichraum','Der Raum wo der ganze Abschaum sich trifft'),(48,'2043253','Chefzimmer','Viktorianisches Reich'),(49,'2043253','Chefzimmer','Viktorianisches Reich'),(50,'3737','Pausenraum',''),(51,'2043','Chefzimmer','Viktorianisches Reich'),(52,'99','Viktor','Ein Raum um ordentlich Viktor zu schlagen'),(53,'3737','Pausenraum',''),(54,'','',''),(55,'878','Software','Hier passiert nicht viel'),(56,'872','Hardware','Hier passiert viel'),(57,'741','Justin','Hier kann Justin alleine sein'),(58,'089','Klassenzimmer 089','Klassenzimmer'),(59,'090','Lehrerzimmer 01','Lehrerzimmer'),(60,'091','Computerzimmer 11','Computerzimmer'),(61,'092','Klassenzimmer 092','Klassenzimmer');
/*!40000 ALTER TABLE `tbl_raeume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rechte_funktion`
--

DROP TABLE IF EXISTS `tbl_rechte_funktion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rechte_funktion` (
  `rf_id` int(11) NOT NULL AUTO_INCREMENT,
  `rf_name` varchar(45) NOT NULL,
  PRIMARY KEY (`rf_id`),
  UNIQUE KEY `rf_name` (`rf_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rechte_funktion`
--

LOCK TABLES `tbl_rechte_funktion` WRITE;
/*!40000 ALTER TABLE `tbl_rechte_funktion` DISABLE KEYS */;
INSERT INTO `tbl_rechte_funktion` VALUES (3,'Ausmusterung'),(1,'Neubeschaffung'),(5,'Reporting'),(2,'Stammdatenverwaltung'),(4,'Wartung');
/*!40000 ALTER TABLE `tbl_rechte_funktion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rechte_rolle`
--

DROP TABLE IF EXISTS `tbl_rechte_rolle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rechte_rolle` (
  `rr_id` int(11) NOT NULL AUTO_INCREMENT,
  `rr_name` varchar(45) NOT NULL,
  PRIMARY KEY (`rr_id`),
  UNIQUE KEY `rr_name` (`rr_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rechte_rolle`
--

LOCK TABLES `tbl_rechte_rolle` WRITE;
/*!40000 ALTER TABLE `tbl_rechte_rolle` DISABLE KEYS */;
INSERT INTO `tbl_rechte_rolle` VALUES (2,'Azubis'),(4,'Lehrkraft'),(1,'Systembetreuung'),(3,'Verwaltung');
/*!40000 ALTER TABLE `tbl_rechte_rolle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rechte_zuordnung`
--

DROP TABLE IF EXISTS `tbl_rechte_zuordnung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rechte_zuordnung` (
  `rz_id` int(11) NOT NULL AUTO_INCREMENT,
  `rz_rolle_id` int(11) NOT NULL,
  `rz_funktion_id` int(11) NOT NULL,
  PRIMARY KEY (`rz_id`),
  KEY `fk_zuordnung_rolle_id` (`rz_rolle_id`),
  KEY `fk_zuordnung_funktion_id` (`rz_funktion_id`),
  CONSTRAINT `fk_zuordnung_funktion_id` FOREIGN KEY (`rz_funktion_id`) REFERENCES `tbl_rechte_funktion` (`rf_id`),
  CONSTRAINT `fk_zuordnung_rolle_id` FOREIGN KEY (`rz_rolle_id`) REFERENCES `tbl_rechte_rolle` (`rr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rechte_zuordnung`
--

LOCK TABLES `tbl_rechte_zuordnung` WRITE;
/*!40000 ALTER TABLE `tbl_rechte_zuordnung` DISABLE KEYS */;
INSERT INTO `tbl_rechte_zuordnung` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,2,1),(7,2,2),(8,2,3),(9,2,4),(10,2,5),(11,3,5),(12,4,5);
/*!40000 ALTER TABLE `tbl_rechte_zuordnung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_software_in_raum`
--

DROP TABLE IF EXISTS `tbl_software_in_raum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_software_in_raum` (
  `sir_id` int(11) NOT NULL AUTO_INCREMENT,
  `sir_k_id` int(11) DEFAULT NULL,
  `sir_r_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`sir_id`),
  KEY `fk_software_in_raum__komponenten_id` (`sir_k_id`),
  KEY `fk_software_in_raum__raeume_id` (`sir_r_id`),
  CONSTRAINT `fk_software_in_raum__komponenten_id` FOREIGN KEY (`sir_k_id`) REFERENCES `tbl_komponenten` (`k_id`),
  CONSTRAINT `fk_software_in_raum__raeume_id` FOREIGN KEY (`sir_r_id`) REFERENCES `tbl_raeume` (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_software_in_raum`
--

LOCK TABLES `tbl_software_in_raum` WRITE;
/*!40000 ALTER TABLE `tbl_software_in_raum` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_software_in_raum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_wird_beschrieben_durch`
--

DROP TABLE IF EXISTS `tbl_wird_beschrieben_durch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_wird_beschrieben_durch` (
  `wbd_id` int(11) NOT NULL AUTO_INCREMENT,
  `komponentenarten_ka_id` int(11) NOT NULL,
  `komponentenattribute_kat_id` int(11) NOT NULL,
  PRIMARY KEY (`wbd_id`),
  KEY `fk_wird_beschrieben_durch__komponentenarten` (`komponentenarten_ka_id`),
  KEY `fk_wird_beschrieben_durch__komponentenattribute` (`komponentenattribute_kat_id`),
  CONSTRAINT `fk_wird_beschrieben_durch__komponentenarten` FOREIGN KEY (`komponentenarten_ka_id`) REFERENCES `tbl_komponentenarten` (`ka_id`),
  CONSTRAINT `fk_wird_beschrieben_durch__komponentenattribute` FOREIGN KEY (`komponentenattribute_kat_id`) REFERENCES `tbl_komponentenattribute` (`kat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_wird_beschrieben_durch`
--

LOCK TABLES `tbl_wird_beschrieben_durch` WRITE;
/*!40000 ALTER TABLE `tbl_wird_beschrieben_durch` DISABLE KEYS */;
INSERT INTO `tbl_wird_beschrieben_durch` VALUES (1,2,16),(2,2,24),(3,2,25);
/*!40000 ALTER TABLE `tbl_wird_beschrieben_durch` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-24 13:11:08
