-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: pinelands_ms
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `addressId` int(11) NOT NULL AUTO_INCREMENT,
  `unitNumber` varchar(11) DEFAULT NULL,
  `streetNumber` varchar(10) NOT NULL,
  `streetName` varchar(40) NOT NULL,
  `streetType` enum('street','close','road','chase') NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `postCode` varchar(10) NOT NULL,
  `state` enum('QLD','NSW','VIC','TAS','WA','SA','NT') NOT NULL,
  PRIMARY KEY (`addressId`),
  KEY `adddressId` (`addressId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'','34','Main','road','Caboolture','4510','QLD'),(2,NULL,'1','George St','street','Brisbane','4000','QLD'),(3,'1','42','Main','street','Bentley','2480','NSW'),(4,'23','1','Gray','street','New Farm','4006','QLD'),(5,NULL,'4','Main','street','Hervey Bay','4008','QLD'),(6,NULL,'5','Street','close','Hervey Bay','2005','QLD');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `availability`
--

DROP TABLE IF EXISTS `availability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `availability` (
  `availabilityID` int(11) NOT NULL AUTO_INCREMENT,
  `teacherID` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`availabilityID`),
  KEY `fk_teacherid_idx` (`teacherID`),
  CONSTRAINT `fk_teacherid` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `availability`
--

LOCK TABLES `availability` WRITE;
/*!40000 ALTER TABLE `availability` DISABLE KEYS */;
INSERT INTO `availability` VALUES (1,3,'Monday','09:00:00','18:00:00'),(2,3,'Tuesday','09:00:00','17:00:00');
/*!40000 ALTER TABLE `availability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
  `contractID` int(11) NOT NULL AUTO_INCREMENT,
  `teacherID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `time` time NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `length` enum('30','60') NOT NULL,
  `instrumentTypeID` int(11) NOT NULL,
  PRIMARY KEY (`contractID`),
  KEY `FK_contracts_idx` (`teacherID`,`studentID`),
  KEY `fk_users_idx` (`teacherID`,`studentID`),
  KEY `fk_teacher_idx` (`teacherID`),
  KEY `fk_student_idx` (`studentID`),
  KEY `FK_instrument_idx` (`instrumentTypeID`),
  CONSTRAINT `fk_instrumentTypeID` FOREIGN KEY (`instrumentTypeID`) REFERENCES `instrumentnames` (`instrumentTypeID`) ON UPDATE CASCADE,
  CONSTRAINT `fk_student` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (1,2,3,'2016-09-08','2016-10-26','12:00:00','Thursday','30',1),(2,2,3,'2016-09-05','2016-10-31','14:00:00','Monday','60',2),(3,2,3,'2016-09-07','2016-10-26','11:00:00','Wednesday','60',3),(4,2,3,'2016-09-06','2016-10-25','12:00:00','Tuesday','60',4),(7,3,2,'2016-09-07','2016-09-14','10:00:00','Wednesday','60',5),(8,3,2,'2016-09-07','2016-09-14','09:00:00','Monday','60',6),(9,6,3,'2016-09-07','2016-09-14','10:00:00','Thursday','60',7),(10,3,3,'2016-09-07','2016-09-14','10:00:00','Monday','60',8),(11,6,2,'2016-09-07','2016-09-14','12:00:00','Monday','60',9),(12,3,2,'2016-09-07','2016-09-14','10:00:00','Monday','60',1),(13,6,2,'2016-09-07','2016-09-14','10:00:00','Monday','60',2),(14,3,3,'2016-09-07','2016-09-14','13:00:00','Tuesday','60',2),(15,3,2,'2016-09-07','2016-09-14','11:00:00','Monday','60',3),(17,3,2,'2016-09-07','2016-09-14','14:00:00','Tuesday','60',4),(18,3,2,'2016-09-07','2016-12-30','16:00:00','Tuesday','60',2),(19,3,2,'2016-09-07','2016-12-30','13:00:00','Tuesday','60',7),(21,3,7,'2016-09-07','2016-12-30','10:00:00','Monday','60',4),(24,3,5,'2016-09-07','2016-12-30','10:00:00','Monday','60',1),(25,3,5,'2016-09-07','2016-12-30','10:00:00','Tuesday','60',1);
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forgotpassword`
--

DROP TABLE IF EXISTS `forgotpassword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forgotpassword` (
  `forgotID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `emailCode` varchar(32) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`forgotID`),
  KEY `fk_userID_idx` (`userID`),
  CONSTRAINT `fk_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forgotpassword`
--

LOCK TABLES `forgotpassword` WRITE;
/*!40000 ALTER TABLE `forgotpassword` DISABLE KEYS */;
/*!40000 ALTER TABLE `forgotpassword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instrumenthire`
--

DROP TABLE IF EXISTS `instrumenthire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instrumenthire` (
  `instrumentHireID` int(11) NOT NULL AUTO_INCREMENT,
  `contractID` int(11) NOT NULL,
  `schoolInstrumentID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `adminApproved` enum('Yes','No') DEFAULT NULL,
  `archived` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`instrumentHireID`),
  KEY `fk_contractID-Hire_idx` (`contractID`),
  KEY `fk_schoolinstrumentID-hire_idx` (`schoolInstrumentID`),
  CONSTRAINT `fk_contractID-Hire` FOREIGN KEY (`contractID`) REFERENCES `contracts` (`contractID`) ON UPDATE CASCADE,
  CONSTRAINT `fk_schoolinstrumentID-hire` FOREIGN KEY (`schoolInstrumentID`) REFERENCES `schoolinstruments` (`schoolInstrumentID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instrumenthire`
--

LOCK TABLES `instrumenthire` WRITE;
/*!40000 ALTER TABLE `instrumenthire` DISABLE KEYS */;
INSERT INTO `instrumenthire` VALUES (10,24,1,'2016-09-07','2016-09-07','No','\0'),(11,24,2,'2016-09-07','2016-09-07','Yes','\0');
/*!40000 ALTER TABLE `instrumenthire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instrumentnames`
--

DROP TABLE IF EXISTS `instrumentnames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instrumentnames` (
  `instrumentTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `instrumentName` varchar(50) NOT NULL,
  PRIMARY KEY (`instrumentTypeID`),
  UNIQUE KEY `name` (`instrumentName`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instrumentnames`
--

LOCK TABLES `instrumentnames` WRITE;
/*!40000 ALTER TABLE `instrumentnames` DISABLE KEYS */;
INSERT INTO `instrumentnames` VALUES (1,'Cello'),(3,'Clarinet'),(10,'Drums'),(4,'Flute'),(9,'Guitar'),(8,'Harp'),(7,'Piano'),(11,'Saxophone'),(2,'Trombone'),(6,'Trumpet'),(5,'Violin');
/*!40000 ALTER TABLE `instrumentnames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `userID` int(11) NOT NULL,
  `language` varchar(100) NOT NULL,
  PRIMARY KEY (`userID`,`language`),
  CONSTRAINT `FK` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (2,'English'),(3,'English'),(4,'English'),(4,'Japanese'),(4,'Spanish'),(5,'English'),(6,'English'),(6,'German'),(6,'Malay'),(6,'Mandarin');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leaverequests`
--

DROP TABLE IF EXISTS `leaverequests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leaverequests` (
  `leaveID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` enum('Pending','Approved','Denied') NOT NULL DEFAULT 'Pending',
  `requestDate` date NOT NULL,
  `reason` varchar(300) NOT NULL,
  PRIMARY KEY (`leaveID`),
  KEY `FK_userID_idx` (`userID`),
  KEY `FK_userID_leave` (`userID`),
  CONSTRAINT `FK_userID_leave` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leaverequests`
--

LOCK TABLES `leaverequests` WRITE;
/*!40000 ALTER TABLE `leaverequests` DISABLE KEYS */;
INSERT INTO `leaverequests` VALUES (1,5,'2016-08-01','2016-08-01','Denied','2016-10-11','dev'),(2,5,'2016-08-01','2016-08-03','Pending','2016-10-11','Because I am going to be sick those days'),(3,5,'2016-08-03','2016-08-03','Approved','2016-10-11','I have a job interview at another place'),(4,5,'2016-08-01','2016-08-01','Denied','2016-10-11','pdf'),(5,5,'2016-08-04','2016-08-03','Denied','2016-10-11','sdfdsfs'),(6,5,'2016-08-04','2016-08-03','Denied','2016-10-11','sdfdsfs');
/*!40000 ALTER TABLE `leaverequests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phonenumbers`
--

DROP TABLE IF EXISTS `phonenumbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phonenumbers` (
  `userID` int(11) NOT NULL,
  `phoneNumber` varchar(12) NOT NULL,
  PRIMARY KEY (`userID`,`phoneNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phonenumbers`
--

LOCK TABLES `phonenumbers` WRITE;
/*!40000 ALTER TABLE `phonenumbers` DISABLE KEYS */;
INSERT INTO `phonenumbers` VALUES (2,'0414573180'),(2,'0754000000'),(3,'05000000'),(4,'0401444444'),(4,'075000'),(5,'0400000000'),(6,'0423232332'),(7,'0414573180');
/*!40000 ALTER TABLE `phonenumbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schoolinstruments`
--

DROP TABLE IF EXISTS `schoolinstruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schoolinstruments` (
  `schoolInstrumentID` int(11) NOT NULL AUTO_INCREMENT,
  `instrumentTypeID` int(11) NOT NULL,
  `instrumentCondition` enum('New','Excellent','Good','Repair','Discard') NOT NULL,
  `hireCost` int(11) NOT NULL,
  PRIMARY KEY (`schoolInstrumentID`),
  KEY `fk_instrumenttype-instru_idx` (`instrumentTypeID`),
  CONSTRAINT `fk_instrumenttype-instru` FOREIGN KEY (`instrumentTypeID`) REFERENCES `instrumentnames` (`instrumentTypeID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schoolinstruments`
--

LOCK TABLES `schoolinstruments` WRITE;
/*!40000 ALTER TABLE `schoolinstruments` DISABLE KEYS */;
INSERT INTO `schoolinstruments` VALUES (1,1,'Excellent',40),(2,1,'Good',20),(3,10,'Excellent',500);
/*!40000 ALTER TABLE `schoolinstruments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacherreviews`
--

DROP TABLE IF EXISTS `teacherreviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacherreviews` (
  `reviewID` int(11) NOT NULL AUTO_INCREMENT,
  `teacherID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `contractID` int(11) NOT NULL,
  `reviewComment` varchar(300) NOT NULL,
  `reviewRating` int(1) NOT NULL,
  `reviewDate` date NOT NULL,
  `reviewStatus` enum('Public','Private','Pending','Invalid') NOT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `fk_teachers_idx` (`teacherID`),
  KEY `fk_students_idx` (`studentID`),
  CONSTRAINT `fk_students` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_teachers` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacherreviews`
--

LOCK TABLES `teacherreviews` WRITE;
/*!40000 ALTER TABLE `teacherreviews` DISABLE KEYS */;
INSERT INTO `teacherreviews` VALUES (1,4,2,0,'Great lesson',5,'2016-09-12','Private'),(2,5,2,0,'Pretty good',4,'2016-09-12','Public'),(3,6,2,0,'Nice teacher',4,'2016-09-12','Public'),(4,4,2,0,'Learnt a lot',5,'2016-09-12','Public'),(5,5,2,0,'Loved it',5,'2016-09-12','Public'),(6,6,2,0,'Fairly average',3,'2016-09-12','Public'),(7,4,3,0,'Lots of fun',4,'2016-09-12','Public'),(8,5,3,0,'Love this teacher',4,'2016-09-12','Private'),(9,6,3,0,'Challenging but learned a lot',4,'2016-09-12','Public'),(10,4,3,0,'Thank you',4,'2016-09-12','Public'),(11,5,3,0,'Perfect',5,'2016-09-12','Public'),(12,6,3,0,'Great class',5,'2016-09-12','Public'),(13,6,5,0,'Best teacher at this school',5,'2016-09-12','Public'),(17,6,2,0,'Wrost teacher - don\'t like you',1,'2016-09-12','Invalid'),(20,6,2,0,'Hate you',1,'2016-09-12','Private'),(21,6,2,0,'Great teacher',5,'2016-09-12','Public');
/*!40000 ALTER TABLE `teacherreviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useraddress`
--

DROP TABLE IF EXISTS `useraddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useraddress` (
  `userID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`addressID`),
  KEY `FK_useraddress_address_idx` (`addressID`),
  CONSTRAINT `FK_useraddress_address` FOREIGN KEY (`addressID`) REFERENCES `address` (`addressId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraddress`
--

LOCK TABLES `useraddress` WRITE;
/*!40000 ALTER TABLE `useraddress` DISABLE KEYS */;
INSERT INTO `useraddress` VALUES (3,1),(4,2),(5,3),(6,4),(2,5),(7,6);
/*!40000 ALTER TABLE `useraddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinstrument`
--

DROP TABLE IF EXISTS `userinstrument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinstrument` (
  `userID` int(11) NOT NULL,
  `InstrumentTypeID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`InstrumentTypeID`),
  KEY `fk_instrumentID-instru_idx` (`InstrumentTypeID`),
  CONSTRAINT `fk_instrumentID-instru` FOREIGN KEY (`InstrumentTypeID`) REFERENCES `instrumentnames` (`instrumentTypeID`) ON UPDATE CASCADE,
  CONSTRAINT `fk_userID-instru` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinstrument`
--

LOCK TABLES `userinstrument` WRITE;
/*!40000 ALTER TABLE `userinstrument` DISABLE KEYS */;
INSERT INTO `userinstrument` VALUES (5,1),(4,2),(3,4),(2,5),(4,6),(6,8),(5,10),(6,11);
/*!40000 ALTER TABLE `userinstrument` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `DOB` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `facebookId` varchar(80) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `accountType` enum('Guest','Student','Teacher','StudentAndTeacher','Admin','Owner') NOT NULL DEFAULT 'Guest',
  `comCode` varchar(64) DEFAULT NULL,
  `parentName` varchar(100) DEFAULT NULL,
  `parentEmail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `email` (`email`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `fk_users_userAddress` FOREIGN KEY (`UserID`) REFERENCES `useraddress` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Peter','Schwartz','1980-09-06','Male',NULL,'pschwartz914@gmail.com','e4e9c28a37e8104de97636f94a2d34f53285e0015bf5ef722b5f702e7dece218','c9d6c368cda770ec8dd69e4e59d0b972','Owner',NULL,NULL,NULL),(3,'Peter','Schwartz','1980-09-06','Male','','peter@email.com','40534c99afc016e41814f822387b39f5a1afb1b131de5863fd2658cc55b09099','6e1a63c99810f63b81da8a9d66392559','Admin',NULL,'test',''),(4,'John','Smith','1995-08-06','Female','100000294232924','john@pinelandmusic.com','303033212cb2d7e424e486c83fcd42aaff55c2f6be6db1c1b3e409922ff8eaf3','c0191b30afd9ddef7152c5dc8bcdb3fc','Teacher',NULL,NULL,NULL),(5,'Samantha','Henderson','1995-08-06','Female','100000294232924','samantha@pinelandmusic.com','9474487bd182d8baccd34f313b327898e12c57025e70fb0c18cbc99c8e6d4550','632d66e14b08cc43b6d37b17d8614b9e','StudentAndTeacher',NULL,NULL,NULL),(6,'Mary','Jane','1996-07-12','Female','100000294232924','mary@pinelandmusic.com','2e1d238e143e6eacd1c6539fed7f09eb7013a69bb46d41e2900a6e15a200cf55','b03a261899ec8c063b069ddb5bab0de4','Teacher',NULL,NULL,NULL),(7,'John','Smith','2010-09-09','Male',NULL,'John@email.com','1249e5d35c8ad742a05aa431d024b5050444ed9cf33c234db5c0dfbd53749530','5080ea18eb416f8975c6e727acc25bf9','Guest',NULL,'John','John@senior.com');
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

-- Dump completed on 2016-10-14 12:41:46
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pinelands_ms
-- ------------------------------------------------------
-- Server version	5.7.14-log

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
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `idapplications` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `language` varchar(200) DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `instrument` int(11) DEFAULT NULL,
  PRIMARY KEY (`idapplications`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-16 10:40:57
