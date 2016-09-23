-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2016 at 09:05 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinelands_music_school`
--
CREATE DATABASE IF NOT EXISTS `pinelands_music_school` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pinelands_music_school`;

-- --------------------------------------------------------

--
-- Table structure for table `accesslevels`
--

DROP TABLE IF EXISTS `accesslevels`;
CREATE TABLE `accesslevels` (
  `ID` int(2) NOT NULL,
  `accessLevel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `accesslevels`:
--

--
-- Dumping data for table `accesslevels`
--

INSERT INTO `accesslevels` (`ID`, `accessLevel`) VALUES
(1, 'Guest'),
(2, 'Parent'),
(3, 'Student'),
(4, 'Teacher'),
(5, 'Student/Teacher'),
(6, 'Admin'),
(7, 'Owner');

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `AddressID` int(11) NOT NULL,
  `unitNumber` varchar(45) DEFAULT NULL,
  `streetNumber` varchar(45) NOT NULL,
  `streetName` varchar(45) NOT NULL,
  `streetType` varchar(45) NOT NULL,
  `suburb` varchar(45) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `addresses`:
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowedinstruments`
--

DROP TABLE IF EXISTS `borrowedinstruments`;
CREATE TABLE `borrowedinstruments` (
  `studentID` int(11) NOT NULL,
  `instrumentID` int(11) NOT NULL,
  `date` date NOT NULL,
  `startTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `borrowedinstruments`:
--   `studentID`
--       `users` -> `userID`
--   `instrumentID`
--       `instruments` -> `instrumentID`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `teacherID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `classes`:
--

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE `classrooms` (
  `ID` int(11) NOT NULL,
  `roomName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `classrooms`:
--

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE `contracts` (
  `contractID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `contractDuration` varchar(45) NOT NULL COMMENT 'Left as VACHAR as the they duration may be days, months, weeks, or years'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `contracts`:
--

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

DROP TABLE IF EXISTS `instruments`;
CREATE TABLE `instruments` (
  `instrumentID` int(11) NOT NULL,
  `equipmentName` varchar(45) NOT NULL,
  `instrumentCondition` enum('Poor','Decent','Good','Excellent') NOT NULL,
  `hireCost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `instruments`:
--

-- --------------------------------------------------------

--
-- Table structure for table `instrumentskill`
--

DROP TABLE IF EXISTS `instrumentskill`;
CREATE TABLE `instrumentskill` (
  `instrumentSkillID` int(11) NOT NULL,
  `skillName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `instrumentskill`:
--

-- --------------------------------------------------------

--
-- Table structure for table `instrumentsplayed`
--

DROP TABLE IF EXISTS `instrumentsplayed`;
CREATE TABLE `instrumentsplayed` (
  `userID` int(11) NOT NULL,
  `instrumentSkillID` int(11) NOT NULL,
  `skillLevel` int(2) NOT NULL COMMENT 'up to skill level 99'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `instrumentsplayed`:
--   `userID`
--       `users` -> `userID`
--   `instrumentSkillID`
--       `instrumentskill` -> `instrumentSkillID`
--

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `ID` int(11) NOT NULL,
  `language` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `languages`:
--

-- --------------------------------------------------------

--
-- Table structure for table `studentparent`
--

DROP TABLE IF EXISTS `studentparent`;
CREATE TABLE `studentparent` (
  `studentID` int(11) NOT NULL,
  `parentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `studentparent`:
--   `studentID`
--       `users` -> `userID`
--   `parentID`
--       `users` -> `userID`
--

-- --------------------------------------------------------

--
-- Table structure for table `teacheravailability`
--

DROP TABLE IF EXISTS `teacheravailability`;
CREATE TABLE `teacheravailability` (
  `teacherID` int(11) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `teacheravailability`:
--

-- --------------------------------------------------------

--
-- Table structure for table `useraddresses`
--

DROP TABLE IF EXISTS `useraddresses`;
CREATE TABLE `useraddresses` (
  `userID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `useraddresses`:
--   `addressID`
--       `addresses` -> `AddressID`
--   `userID`
--       `users` -> `userID`
--

-- --------------------------------------------------------

--
-- Table structure for table `userlanguages`
--

DROP TABLE IF EXISTS `userlanguages`;
CREATE TABLE `userlanguages` (
  `userID` int(11) NOT NULL,
  `languageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `userlanguages`:
--

-- --------------------------------------------------------

--
-- Table structure for table `userphonenumbers`
--

DROP TABLE IF EXISTS `userphonenumbers`;
CREATE TABLE `userphonenumbers` (
  `userID` int(11) NOT NULL,
  `phoneNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `userphonenumbers`:
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `password` varchar(12) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `facebookID` int(11) DEFAULT NULL,
  `accessID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `users`:
--   `accessID`
--       `accesslevels` -> `ID`
--   `userID`
--       `userphonenumbers` -> `userID`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevels`
--
ALTER TABLE `accesslevels`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`AddressID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`AddressID`);

--
-- Indexes for table `borrowedinstruments`
--
ALTER TABLE `borrowedinstruments`
  ADD PRIMARY KEY (`studentID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`studentID`),
  ADD KEY `instrumentID` (`instrumentID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`teacherID`,`studentID`,`roomID`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`ID`,`roomName`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`),
  ADD UNIQUE KEY `roomName_UNIQUE` (`roomName`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contractID`);

--
-- Indexes for table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`instrumentID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`instrumentID`);

--
-- Indexes for table `instrumentskill`
--
ALTER TABLE `instrumentskill`
  ADD PRIMARY KEY (`instrumentSkillID`,`skillName`),
  ADD UNIQUE KEY `ID_UNIQUE` (`instrumentSkillID`),
  ADD UNIQUE KEY `skillName_UNIQUE` (`skillName`);

--
-- Indexes for table `instrumentsplayed`
--
ALTER TABLE `instrumentsplayed`
  ADD PRIMARY KEY (`userID`,`instrumentSkillID`),
  ADD KEY `instrumentSkillID` (`instrumentSkillID`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`ID`,`language`),
  ADD UNIQUE KEY `ID_UNIQUE` (`ID`),
  ADD UNIQUE KEY `language_UNIQUE` (`language`);

--
-- Indexes for table `studentparent`
--
ALTER TABLE `studentparent`
  ADD PRIMARY KEY (`studentID`,`parentID`),
  ADD KEY `parentID` (`parentID`);

--
-- Indexes for table `teacheravailability`
--
ALTER TABLE `teacheravailability`
  ADD PRIMARY KEY (`teacherID`,`time`);

--
-- Indexes for table `useraddresses`
--
ALTER TABLE `useraddresses`
  ADD PRIMARY KEY (`userID`,`addressID`),
  ADD KEY `addressID` (`addressID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `userlanguages`
--
ALTER TABLE `userlanguages`
  ADD PRIMARY KEY (`userID`,`languageID`);

--
-- Indexes for table `userphonenumbers`
--
ALTER TABLE `userphonenumbers`
  ADD PRIMARY KEY (`userID`,`phoneNumber`),
  ADD UNIQUE KEY `userID_UNIQUE` (`userID`),
  ADD UNIQUE KEY `phoneNumber_UNIQUE` (`phoneNumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `ID_UNIQUE` (`userID`),
  ADD KEY `AccessID` (`accessID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevels`
--
ALTER TABLE `accesslevels`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `borrowedinstruments`
--
ALTER TABLE `borrowedinstruments`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `instrumentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `instrumentskill`
--
ALTER TABLE `instrumentskill`
  MODIFY `instrumentSkillID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowedinstruments`
--
ALTER TABLE `borrowedinstruments`
  ADD CONSTRAINT `borrowedinstruments_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `users` (`userID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowedinstruments_ibfk_2` FOREIGN KEY (`instrumentID`) REFERENCES `instruments` (`instrumentID`);

--
-- Constraints for table `instrumentsplayed`
--
ALTER TABLE `instrumentsplayed`
  ADD CONSTRAINT `instrumentsplayed_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `instrumentsplayed_ibfk_2` FOREIGN KEY (`instrumentSkillID`) REFERENCES `instrumentskill` (`instrumentSkillID`) ON UPDATE CASCADE;

--
-- Constraints for table `studentparent`
--
ALTER TABLE `studentparent`
  ADD CONSTRAINT `studentparent_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `studentparent_ibfk_2` FOREIGN KEY (`parentID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `useraddresses`
--
ALTER TABLE `useraddresses`
  ADD CONSTRAINT `useraddresses_ibfk_1` FOREIGN KEY (`addressID`) REFERENCES `addresses` (`AddressID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `useraddresses_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`accessID`) REFERENCES `accesslevels` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `userphonenumbers` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
