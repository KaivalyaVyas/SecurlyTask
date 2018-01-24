-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: securly_school
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club` (
  `clubId` int(11) NOT NULL,
  `schoolId` int(11) NOT NULL,
  `clubName` varchar(45) NOT NULL,
  PRIMARY KEY (`clubId`),
  KEY `schoolId_idx` (`schoolId`),
  CONSTRAINT `schoolId` FOREIGN KEY (`schoolId`) REFERENCES `school` (`SchoolId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club`
--

LOCK TABLES `club` WRITE;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
INSERT INTO `club` VALUES (1,1,'Rubin Soccer'),(2,1,'Rubin BaseBall'),(3,1,'Rubin Softball'),(4,1,'Rubin Tennis'),(5,2,'Chelsey Football'),(6,2,'Chelsey Hockey'),(7,3,'Berkeley Squash'),(8,3,'Berkeley Swimming'),(9,3,'Berkeley Polo'),(10,4,'Stanford Tennis'),(11,4,'Stanford Poker');
/*!40000 ALTER TABLE `club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `district` (
  `DistrictID` int(11) NOT NULL,
  `DistrictName` varchar(45) NOT NULL,
  `DistrictOfficer_name` varchar(45) NOT NULL,
  PRIMARY KEY (`DistrictID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'Charlotte','KV'),(2,'Boon','SK');
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `officer_authantication`
--

DROP TABLE IF EXISTS `officer_authantication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `officer_authantication` (
  `district_officer_id` int(11) NOT NULL,
  `district_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dis_id` int(11) NOT NULL,
  PRIMARY KEY (`district_officer_id`),
  KEY `dist_id_idx` (`dis_id`),
  CONSTRAINT `dis_id` FOREIGN KEY (`dis_id`) REFERENCES `district` (`DistrictID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `officer_authantication`
--

LOCK TABLES `officer_authantication` WRITE;
/*!40000 ALTER TABLE `officer_authantication` DISABLE KEYS */;
INSERT INTO `officer_authantication` VALUES (1,'charlotte','charlotte',1),(2,'boon','boon',2);
/*!40000 ALTER TABLE `officer_authantication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `query_history`
--

DROP TABLE IF EXISTS `query_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `query_history` (
  `queryid` int(11) NOT NULL AUTO_INCREMENT,
  `queryType` enum('q1','q2','q3') DEFAULT NULL,
  `param1` varchar(200) DEFAULT NULL,
  `param2` varchar(200) DEFAULT NULL,
  `adminid` int(11) NOT NULL,
  PRIMARY KEY (`queryid`),
  KEY `adminid_idx` (`adminid`),
  CONSTRAINT `adminid` FOREIGN KEY (`adminid`) REFERENCES `district` (`DistrictID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `query_history`
--

LOCK TABLES `query_history` WRITE;
/*!40000 ALTER TABLE `query_history` DISABLE KEYS */;
INSERT INTO `query_history` VALUES (1,'q1','kjon@gmail.com','',1),(2,'q1','cbaker@gmail.com','',1),(3,'q1','cbaker@gmail.com','',1),(4,'q2','Berkeley Swimming','',1),(5,'q3','jwalter@gmail.com','cjohny@gmail.com',1),(6,'q3','kjon@gmail.com','cjohny@gmail.com',1),(7,'q3','kjon@gmail.com','rchase@gmail.com',1),(8,'q3','kjon@gmail.com','kjon@gmail.com',1),(9,'q3','kjon@gmail.com','kjon@gmail.com',1),(10,'q3','kjon@gmail.com','rchase@gmail.com',1);
/*!40000 ALTER TABLE `query_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school` (
  `SchoolId` int(11) NOT NULL,
  `DistrictID` int(11) NOT NULL,
  `SchoolName` varchar(45) NOT NULL,
  PRIMARY KEY (`SchoolId`),
  KEY `DistrictId_idx` (`DistrictID`),
  CONSTRAINT `DistrictId` FOREIGN KEY (`DistrictID`) REFERENCES `district` (`DistrictID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` VALUES (1,1,'Rubin Elementary'),(2,1,'Chelsey High'),(3,1,'Berkeley Middle'),(4,1,'Stanford School');
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `schoolId` int(11) NOT NULL,
  `Email` varchar(45) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `schoolid_idx` (`schoolId`),
  CONSTRAINT `school_id` FOREIGN KEY (`schoolId`) REFERENCES `school` (`SchoolId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'Joseph Walter',1,'jwalter@gmail.com'),(2,'John Ken',1,'jken@gmail.com'),(3,'Jeevan Bal',1,'jbal@gmail.com'),(4,'Arun Bal',1,'abal@gmail.com'),(5,'Shameer Roy',1,'sroy@gmail.com'),(6,'Chico Johny',1,'cjohny@gmail.com'),(7,'Drew Bart',1,'dbart@gmail.com'),(8,'Ram Rahim',2,'rrahim@gmail.com'),(9,'Joe Shaw',2,'jshaw@gmail.com'),(10,'Vamsee Krishna',2,'vkrishna@gmail.com'),(11,'Cho Wu',2,'cwu@gmail.com'),(12,'Charley Baker',3,'cbaker@gmail.com'),(13,'Vaishnavi',3,'vaish@gmail.com'),(14,'Ram Patel',3,'rpatel@gmail.com'),(15,'Mike Joe',3,'mjoe@gmail.com'),(16,'Kim Jong',4,'kjon@gmail.com'),(17,'Robert Chase',4,'rchase@gmail.com');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_club_relation`
--

DROP TABLE IF EXISTS `student_club_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_club_relation` (
  `relationid` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`relationid`),
  KEY `club_id_idx` (`club_id`),
  KEY `student_id_idx` (`student_id`),
  CONSTRAINT `club_id` FOREIGN KEY (`club_id`) REFERENCES `club` (`clubId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_club_relation`
--

LOCK TABLES `student_club_relation` WRITE;
/*!40000 ALTER TABLE `student_club_relation` DISABLE KEYS */;
INSERT INTO `student_club_relation` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,1,2),(6,2,2),(7,5,2),(8,1,3),(9,6,3),(10,6,4),(11,7,4),(12,8,5),(13,9,5),(14,10,6),(15,11,6),(16,12,7),(17,13,8),(18,14,8),(19,15,9),(20,16,10),(21,17,11);
/*!40000 ALTER TABLE `student_club_relation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-23 19:03:23
