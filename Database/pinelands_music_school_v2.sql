-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: pinelands_music_school
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
-- Table structure for table `accessLevels`
--

DROP TABLE IF EXISTS `accessLevels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessLevels` (
  `ID` int(2) NOT NULL,
  `accessLevel` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `accessLevel_UNIQUE` (`accessLevel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessLevels`
--

LOCK TABLES `accessLevels` WRITE;
/*!40000 ALTER TABLE `accessLevels` DISABLE KEYS */;
/*!40000 ALTER TABLE `accessLevels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `unitNumber` varchar(45) DEFAULT NULL,
  `streetNumber` varchar(45) NOT NULL,
  `streetName` varchar(45) NOT NULL,
  `streetType` varchar(45) NOT NULL,
  `suburb` varchar(45) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` int(4) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrowedInstruments`
--

DROP TABLE IF EXISTS `borrowedInstruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrowedInstruments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `instrumentID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrowedInstruments`
--

LOCK TABLES `borrowedInstruments` WRITE;
/*!40000 ALTER TABLE `borrowedInstruments` DISABLE KEYS */;
/*!40000 ALTER TABLE `borrowedInstruments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classRooms`
--

DROP TABLE IF EXISTS `classRooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classRooms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `roomName` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`,`roomName`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `roomName_UNIQUE` (`roomName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classRooms`
--

LOCK TABLES `classRooms` WRITE;
/*!40000 ALTER TABLE `classRooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `classRooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `teacherID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  PRIMARY KEY (`teacherID`,`studentID`,`roomID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
  `contractID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `contractDuration` varchar(45) NOT NULL COMMENT 'Left as VACHAR as the they duration may be days, months, weeks, or years',
  PRIMARY KEY (`contractID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipmentConditons`
--

DROP TABLE IF EXISTS `equipmentConditons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipmentConditons` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL COMMENT 'Brand New, New, Used, Customised, Faded, Vintage, Faulty etc',
  PRIMARY KEY (`ID`,`description`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipmentConditons`
--

LOCK TABLES `equipmentConditons` WRITE;
/*!40000 ALTER TABLE `equipmentConditons` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipmentConditons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instruments`
--

DROP TABLE IF EXISTS `instruments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instruments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentName` varchar(45) NOT NULL,
  `conditionID` int(11) NOT NULL,
  `hireCost` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instruments`
--

LOCK TABLES `instruments` WRITE;
/*!40000 ALTER TABLE `instruments` DISABLE KEYS */;
/*!40000 ALTER TABLE `instruments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`,`language`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `language_UNIQUE` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parentPhoneNumbers`
--

DROP TABLE IF EXISTS `parentPhoneNumbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parentPhoneNumbers` (
  `parentID` int(11) NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  PRIMARY KEY (`parentID`,`phoneNumber`),
  UNIQUE KEY `parentID_UNIQUE` (`parentID`),
  UNIQUE KEY `phoneNumber_UNIQUE` (`phoneNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parentPhoneNumbers`
--

LOCK TABLES `parentPhoneNumbers` WRITE;
/*!40000 ALTER TABLE `parentPhoneNumbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `parentPhoneNumbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parents`
--

DROP TABLE IF EXISTS `parents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parents` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `facbookID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parents`
--

LOCK TABLES `parents` WRITE;
/*!40000 ALTER TABLE `parents` DISABLE KEYS */;
/*!40000 ALTER TABLE `parents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `skillName` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`,`skillName`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `skillName_UNIQUE` (`skillName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacherAvailability`
--

DROP TABLE IF EXISTS `teacherAvailability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacherAvailability` (
  `teacherID` int(11) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`teacherID`,`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacherAvailability`
--

LOCK TABLES `teacherAvailability` WRITE;
/*!40000 ALTER TABLE `teacherAvailability` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacherAvailability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userAddresses`
--

DROP TABLE IF EXISTS `userAddresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userAddresses` (
  `userID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`addressID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userAddresses`
--

LOCK TABLES `userAddresses` WRITE;
/*!40000 ALTER TABLE `userAddresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `userAddresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userLanguages`
--

DROP TABLE IF EXISTS `userLanguages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userLanguages` (
  `userID` int(11) NOT NULL,
  `languageID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`languageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userLanguages`
--

LOCK TABLES `userLanguages` WRITE;
/*!40000 ALTER TABLE `userLanguages` DISABLE KEYS */;
/*!40000 ALTER TABLE `userLanguages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userParents`
--

DROP TABLE IF EXISTS `userParents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userParents` (
  `userID` int(11) NOT NULL,
  `parentID` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`parentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userParents`
--

LOCK TABLES `userParents` WRITE;
/*!40000 ALTER TABLE `userParents` DISABLE KEYS */;
/*!40000 ALTER TABLE `userParents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userPhoneNumbers`
--

DROP TABLE IF EXISTS `userPhoneNumbers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userPhoneNumbers` (
  `userID` int(11) NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  PRIMARY KEY (`userID`,`phoneNumber`),
  UNIQUE KEY `userID_UNIQUE` (`userID`),
  UNIQUE KEY `phoneNumber_UNIQUE` (`phoneNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userPhoneNumbers`
--

LOCK TABLES `userPhoneNumbers` WRITE;
/*!40000 ALTER TABLE `userPhoneNumbers` DISABLE KEYS */;
/*!40000 ALTER TABLE `userPhoneNumbers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userSkills`
--

DROP TABLE IF EXISTS `userSkills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userSkills` (
  `userID` int(11) NOT NULL,
  `skillID` int(11) NOT NULL,
  `skillLevel` int(2) NOT NULL COMMENT 'up to skill level 99',
  PRIMARY KEY (`userID`,`skillID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userSkills`
--

LOCK TABLES `userSkills` WRITE;
/*!40000 ALTER TABLE `userSkills` DISABLE KEYS */;
/*!40000 ALTER TABLE `userSkills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(24) NOT NULL,
  `password` varchar(12) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `facbookID` int(11) DEFAULT NULL,
  `accessID` int(2) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `userName_UNIQUE` (`userName`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2016-08-05 14:40:03
