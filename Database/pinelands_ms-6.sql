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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'','34','Main','road','Caboolture','4510','QLD'),(2,NULL,'1','George St','street','Brisbane','4000','QLD'),(3,'1','42','Main','street','Bentley','2480','NSW'),(4,'23','1','Gray','street','New Farm','4006','QLD');
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
  `instrument` varchar(100) NOT NULL,
  PRIMARY KEY (`contractID`),
  KEY `FK_contracts_idx` (`teacherID`,`studentID`),
  KEY `fk_users_idx` (`teacherID`,`studentID`),
  KEY `fk_teacher_idx` (`teacherID`),
  KEY `fk_student_idx` (`studentID`),
  CONSTRAINT `fk_student` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_teacher` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (1,2,3,'2016-09-08','2016-10-26','12:00:00','Thursday','30','Violin'),(2,2,3,'2016-09-05','2016-10-31','14:00:00','Monday','60','Piano'),(3,2,3,'2016-09-07','2016-10-26','11:00:00','Wednesday','60','Chello'),(4,2,3,'2016-09-06','2016-10-25','12:00:00','Tuesday','60','Stuff'),(7,3,2,'2016-09-07','2016-09-14','10:00:00','Wednesday','60','Chello'),(8,3,3,'2016-09-07','2016-09-14','09:00:00','Monday','60','Violin'),(9,3,3,'2016-09-07','2016-09-14','10:00:00','Thursday','60','Chello'),(10,3,3,'2016-09-07','2016-09-14','10:00:00','Monday','60','Chello'),(11,3,3,'2016-09-07','2016-09-14','10:00:00','Monday','60','Chello'),(12,3,3,'2016-09-07','2016-09-14','10:00:00','Monday','60','Chello'),(13,3,3,'2016-09-07','2016-09-14','10:00:00','Monday','60','Chello'),(14,3,3,'2016-09-07','2016-09-14','13:00:00','Tuesday','60','Violin');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forgotpassword`
--

LOCK TABLES `forgotpassword` WRITE;
/*!40000 ALTER TABLE `forgotpassword` DISABLE KEYS */;
INSERT INTO `forgotpassword` VALUES (1,2,'1e28ca5de9ca99d320fc34525ea9be09','/pages/forgotpassword.php?email=pschwartz914@gmail.com&emailCode=1e28ca5de9ca99d320fc34525ea9be09'),(2,2,'910a0c3b3784f4a2d2e06ea212ecea04','http://localhost/MusicSchool/pages/forgotpassword.php?email=pschwartz914@gmail.com&emailCode=910a0c3b3784f4a2d2e06ea212ecea04'),(3,2,'9658da46cabbd5512a424d564de72d43','http://localhost/MusicSchool/pages/resetpassword.php?email=pschwartz914@gmail.com&emailCode=9658da46cabbd5512a424d564de72d43');
/*!40000 ALTER TABLE `forgotpassword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instruments`
--

DROP TABLE IF EXISTS `instruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instruments` (
  `userID` int(11) NOT NULL,
  `instrument` varchar(100) NOT NULL,
  PRIMARY KEY (`userID`,`instrument`),
  CONSTRAINT `FK_lang` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instruments`
--

LOCK TABLES `instruments` WRITE;
/*!40000 ALTER TABLE `instruments` DISABLE KEYS */;
INSERT INTO `instruments` VALUES (2,'Chello'),(2,'Violin'),(3,'Chello'),(3,'Violin'),(4,'Bass'),(4,'Chello'),(4,'Guitar'),(4,'Violin'),(5,'Clarinet'),(5,'Flute'),(5,'Guitar'),(5,'Pan Flute'),(5,'Trumbone'),(5,'Trumpet'),(6,'Bass'),(6,'Drums'),(6,'Electric Guitar'),(6,'Keyboard'),(6,'Piano'),(6,'Saxiphone');
/*!40000 ALTER TABLE `instruments` ENABLE KEYS */;
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
INSERT INTO `phonenumbers` VALUES (2,'0414573180'),(2,'0754000000'),(3,'0414573180'),(3,'05000000'),(4,'0401444444'),(5,'0400000000'),(6,'0423232332');
/*!40000 ALTER TABLE `phonenumbers` ENABLE KEYS */;
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
  `reviewComment` varchar(300) NOT NULL,
  `reviewRating` int(1) NOT NULL,
  PRIMARY KEY (`reviewID`),
  KEY `fk_teachers_idx` (`teacherID`),
  KEY `fk_students_idx` (`studentID`),
  CONSTRAINT `fk_students` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_teachers` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacherreviews`
--

LOCK TABLES `teacherreviews` WRITE;
/*!40000 ALTER TABLE `teacherreviews` DISABLE KEYS */;
INSERT INTO `teacherreviews` VALUES (1,4,2,'Great lesson',5),(2,5,2,'Pretty good',4),(3,6,2,'Nice teacher',4),(4,4,2,'Learnt a lot',5),(5,5,2,'Loved it',5),(6,6,2,'Fairly average',3),(7,4,3,'Lots of fun',4),(8,5,3,'Love this teacher',4),(9,6,3,'Challenging but learned a lot',4),(10,4,3,'Thank you',4),(11,5,3,'Perfect',5),(12,6,3,'Great class',5),(13,6,5,'Best teacher at this school',5);
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
INSERT INTO `useraddress` VALUES (3,1),(4,2),(5,3),(6,4);
/*!40000 ALTER TABLE `useraddress` ENABLE KEYS */;
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
  CONSTRAINT `fk_users_phoneNumbers` FOREIGN KEY (`UserID`) REFERENCES `phonenumbers` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_userAddress` FOREIGN KEY (`UserID`) REFERENCES `useraddress` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'Peter','Schwartz','1980-09-06','Male',NULL,'pschwartz914@gmail.com','358452b4ec13a0371aa46c2c2817d7752cd1e6c41c84b57120bd45fbe68af04e','d41d8cd98f00b204e9800998ecf8427e','Student',NULL,NULL,NULL),(3,'Peter','Schwartz','1980-09-06','Male','','peter@email.com','40534c99afc016e41814f822387b39f5a1afb1b131de5863fd2658cc55b09099','6e1a63c99810f63b81da8a9d66392559','Admin',NULL,'test',''),(4,'John','Smith','1995-08-06','Male','100000294232924','john@pinelandmusic.com','303033212cb2d7e424e486c83fcd42aaff55c2f6be6db1c1b3e409922ff8eaf3','c0191b30afd9ddef7152c5dc8bcdb3fc','Teacher',NULL,NULL,NULL),(5,'Samantha','Henderson','1995-08-06','Female','100000294232924','samantha@pinelandmusic.com','9474487bd182d8baccd34f313b327898e12c57025e70fb0c18cbc99c8e6d4550','632d66e14b08cc43b6d37b17d8614b9e','StudentAndTeacher',NULL,NULL,NULL),(6,'Mary','Jane','1996-07-12','Female','100000294232924','mary@pinelandmusic.com','2e1d238e143e6eacd1c6539fed7f09eb7013a69bb46d41e2900a6e15a200cf55','b03a261899ec8c063b069ddb5bab0de4','Teacher',NULL,NULL,NULL);
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

-- Dump completed on 2016-09-05 22:17:54
