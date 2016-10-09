-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2016 at 02:26 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinelands_ms`
--
CREATE DATABASE IF NOT EXISTS `pinelands_ms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pinelands_ms`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `addressId` int(11) NOT NULL,
  `unitNumber` varchar(11) DEFAULT NULL,
  `streetNumber` varchar(10) NOT NULL,
  `streetName` varchar(40) NOT NULL,
  `streetType` enum('street','close','road','chase') NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `postCode` varchar(10) NOT NULL,
  `state` enum('QLD','NSW','VIC','TAS','WA','SA','NT') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `unitNumber`, `streetNumber`, `streetName`, `streetType`, `suburb`, `postCode`, `state`) VALUES
(1, '', '34', 'Main', 'road', 'Caboolture', '4510', 'QLD');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

DROP TABLE IF EXISTS `availability`;
CREATE TABLE `availability` (
  `availabilityID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`availabilityID`, `teacherID`, `day`, `startTime`, `endTime`) VALUES
(1, 3, 'Monday', '09:00:00', '18:00:00'),
(2, 3, 'Tuesday', '09:00:00', '17:00:00');

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
  `endDate` date NOT NULL,
  `time` time NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `length` enum('30','60') NOT NULL,
  `instrument` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contractID`, `teacherID`, `studentID`, `startDate`, `endDate`, `time`, `day`, `length`, `instrument`) VALUES
(1, 2, 3, '2016-09-08', '2016-10-26', '12:00:00', 'Thursday', '30', 'Violin'),
(2, 2, 3, '2016-09-05', '2016-10-31', '14:00:00', 'Monday', '60', 'Piano'),
(3, 2, 3, '2016-09-07', '2016-10-26', '11:00:00', 'Wednesday', '60', 'Chello'),
(4, 2, 3, '2016-09-06', '2016-10-25', '12:00:00', 'Tuesday', '60', 'Stuff'),
(7, 3, 2, '2016-09-07', '2016-09-14', '10:00:00', 'Wednesday', '60', 'Chello'),
(8, 3, 3, '2016-09-07', '2016-09-14', '09:00:00', 'Monday', '60', 'Violin'),
(9, 3, 3, '2016-09-07', '2016-09-14', '10:00:00', 'Thursday', '60', 'Chello');

-- --------------------------------------------------------

--
-- Table structure for table `instruments`
--

DROP TABLE IF EXISTS `instruments`;
CREATE TABLE `instruments` (
  `userID` int(11) NOT NULL,
  `instrument` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instruments`
--

INSERT INTO `instruments` (`userID`, `instrument`) VALUES
(2, 'Chello'),
(2, 'Violin'),
(3, 'Chello'),
(3, 'Violin');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `userID` int(11) NOT NULL,
  `language` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`userID`, `language`) VALUES
(2, 'English'),
(3, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `phonenumbers`
--

DROP TABLE IF EXISTS `phonenumbers`;
CREATE TABLE `phonenumbers` (
  `userID` int(11) NOT NULL,
  `phoneNumber` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phonenumbers`
--

INSERT INTO `phonenumbers` (`userID`, `phoneNumber`) VALUES
(2, '0414573180'),
(2, '0754000000'),
(3, '0414573180');

-- --------------------------------------------------------

--
-- Table structure for table `useraddress`
--

DROP TABLE IF EXISTS `useraddress`;
CREATE TABLE `useraddress` (
  `userID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `useraddress`
--

INSERT INTO `useraddress` (`userID`, `addressID`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
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
  `parentEmail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstName`, `lastName`, `DOB`, `gender`, `facebookId`, `email`, `password`, `salt`, `accountType`, `comCode`, `parentName`, `parentEmail`) VALUES
(2, 'Peter', 'Schwartz', '1980-09-06', 'Male', NULL, 'pschwartz914@gmail.com', '358452b4ec13a0371aa46c2c2817d7752cd1e6c41c84b57120bd45fbe68af04e', 'd41d8cd98f00b204e9800998ecf8427e', 'Student', NULL, NULL, NULL),
(3, 'Peter', 'Schwartz', '1980-09-06', 'Male', '', 'peter@email.com', '40534c99afc016e41814f822387b39f5a1afb1b131de5863fd2658cc55b09099', '6e1a63c99810f63b81da8a9d66392559', 'Admin', NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `adddressId` (`addressId`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`availabilityID`),
  ADD KEY `fk_teacherid_idx` (`teacherID`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`contractID`),
  ADD KEY `FK_contracts_idx` (`teacherID`,`studentID`),
  ADD KEY `fk_users_idx` (`teacherID`,`studentID`),
  ADD KEY `fk_teacher_idx` (`teacherID`),
  ADD KEY `fk_student_idx` (`studentID`);

--
-- Indexes for table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`userID`,`instrument`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`userID`,`language`);

--
-- Indexes for table `phonenumbers`
--
ALTER TABLE `phonenumbers`
  ADD PRIMARY KEY (`userID`,`phoneNumber`);

--
-- Indexes for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD PRIMARY KEY (`userID`,`addressID`),
  ADD KEY `FK_useraddress_address_idx` (`addressID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `UserID` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `availabilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contractID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `fk_teacherid` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `instruments`
--
ALTER TABLE `instruments`
  ADD CONSTRAINT `FK_lang` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `FK` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD CONSTRAINT `FK_useraddress_address` FOREIGN KEY (`addressID`) REFERENCES `address` (`addressId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_phoneNumbers` FOREIGN KEY (`UserID`) REFERENCES `phonenumbers` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_userAddress` FOREIGN KEY (`UserID`) REFERENCES `useraddress` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
