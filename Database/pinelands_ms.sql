-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2016 at 05:21 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

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
(2, '0754000000');

-- --------------------------------------------------------

--
-- Table structure for table `studentparent`
--

DROP TABLE IF EXISTS `studentparent`;
CREATE TABLE `studentparent` (
  `studentParentID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `parentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `useraddress`
--

DROP TABLE IF EXISTS `useraddress`;
CREATE TABLE `useraddress` (
  `userID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `accountType` enum('Guest','Student','Teacher','Student/Teacher','Admin','Owner') NOT NULL DEFAULT 'Guest',
  `comCode` varchar(64) DEFAULT NULL,
  `parentName` varchar(100) DEFAULT NULL,
  `parentEmail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstName`, `lastName`, `DOB`, `gender`, `facebookId`, `email`, `password`, `salt`, `accountType`, `comCode`, `parentName`, `parentEmail`) VALUES
(2, 'Peter', 'Schwartz', '1980-09-06', 'Male', NULL, 'pschwartz914@gmail.com', '358452b4ec13a0371aa46c2c2817d7752cd1e6c41c84b57120bd45fbe68af04e', 'd41d8cd98f00b204e9800998ecf8427e', 'Guest', NULL, NULL, NULL);

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
-- Indexes for table `phonenumbers`
--
ALTER TABLE `phonenumbers`
  ADD PRIMARY KEY (`userID`,`phoneNumber`);

--
-- Indexes for table `studentparent`
--
ALTER TABLE `studentparent`
  ADD PRIMARY KEY (`studentParentID`),
  ADD KEY `FK_studentParent_users_idx` (`studentID`),
  ADD KEY `FK_studentparent_users2_idx` (`parentID`);

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
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentparent`
--
ALTER TABLE `studentparent`
  ADD CONSTRAINT `FK_studentParent_users` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_studentparent_users2` FOREIGN KEY (`parentID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
