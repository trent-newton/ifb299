-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2016 at 06:00 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinelands_ms`
--
CREATE DATABASE IF NOT EXISTS `pinelands_ms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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
(1, '', '34', 'Main', 'road', 'Caboolture', '4510', 'QLD'),
(2, NULL, '1', 'George St', 'street', 'Brisbane', '4000', 'QLD'),
(3, '1', '42', 'Main', 'street', 'Bentley', '2480', 'NSW'),
(4, '23', '1', 'Gray', 'street', 'New Farm', '4006', 'QLD'),
(5, NULL, '4', 'Main', 'street', 'Hervey Bay', '4008', 'QLD'),
(6, NULL, '5', 'Street', 'close', 'Hervey Bay', '2005', 'QLD');

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
  `instrumentTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contractID`, `teacherID`, `studentID`, `startDate`, `endDate`, `time`, `day`, `length`, `instrumentTypeID`) VALUES
(1, 2, 3, '2016-09-08', '2016-10-26', '12:00:00', 'Thursday', '30', 1),
(2, 2, 3, '2016-09-05', '2016-10-31', '14:00:00', 'Monday', '60', 2),
(3, 2, 3, '2016-09-07', '2016-10-26', '11:00:00', 'Wednesday', '60', 3),
(4, 2, 3, '2016-09-06', '2016-10-25', '12:00:00', 'Tuesday', '60', 4),
(7, 3, 2, '2016-09-07', '2016-09-14', '10:00:00', 'Wednesday', '60', 5),
(8, 3, 2, '2016-09-07', '2016-09-14', '09:00:00', 'Monday', '60', 6),
(9, 6, 3, '2016-09-07', '2016-09-14', '10:00:00', 'Thursday', '60', 7),
(10, 3, 3, '2016-09-07', '2016-09-14', '10:00:00', 'Monday', '60', 8),
(11, 6, 2, '2016-09-07', '2016-09-14', '12:00:00', 'Monday', '60', 9),
(12, 3, 2, '2016-09-07', '2016-09-14', '10:00:00', 'Monday', '60', 1),
(13, 6, 2, '2016-09-07', '2016-09-14', '10:00:00', 'Monday', '60', 2),
(14, 3, 3, '2016-09-07', '2016-09-14', '13:00:00', 'Tuesday', '60', 2),
(15, 3, 2, '2016-09-07', '2016-09-14', '11:00:00', 'Monday', '60', 3),
(17, 3, 2, '2016-09-07', '2016-09-14', '14:00:00', 'Tuesday', '60', 4),
(18, 3, 2, '2016-09-07', '2016-12-30', '16:00:00', 'Tuesday', '60', 2),
(19, 3, 2, '2016-09-07', '2016-12-30', '13:00:00', 'Tuesday', '60', 7),
(21, 3, 7, '2016-09-07', '2016-12-30', '10:00:00', 'Monday', '60', 4),
(24, 3, 5, '2016-09-07', '2016-12-30', '10:00:00', 'Monday', '60', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forgotpassword`
--

DROP TABLE IF EXISTS `forgotpassword`;
CREATE TABLE `forgotpassword` (
  `forgotID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `emailCode` varchar(32) NOT NULL,
  `link` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `instrumenthire`
--

DROP TABLE IF EXISTS `instrumenthire`;
CREATE TABLE `instrumenthire` (
  `instrumentHireID` int(11) NOT NULL,
  `contractID` int(11) NOT NULL,
  `schoolInstrumentID` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `adminApproved` bit(1) NOT NULL DEFAULT b'0',
  `archived` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instrumenthire`
--

INSERT INTO `instrumenthire` (`instrumentHireID`, `contractID`, `schoolInstrumentID`, `startDate`, `endDate`, `adminApproved`, `archived`) VALUES
(10, 24, 1, '2016-09-07', '2016-09-07', b'0', b'0'),
(11, 24, 2, '2016-09-07', '2016-09-07', b'0', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `instrumentnames`
--

DROP TABLE IF EXISTS `instrumentnames`;
CREATE TABLE `instrumentnames` (
  `instrumentTypeID` int(11) NOT NULL,
  `instrumentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `instrumentnames`
--

INSERT INTO `instrumentnames` (`instrumentTypeID`, `instrumentName`) VALUES
(1, 'Cello'),
(3, 'Clarinet'),
(10, 'Drums'),
(4, 'Flute'),
(9, 'Guitar'),
(8, 'Harp'),
(7, 'Piano'),
(11, 'Saxophone'),
(2, 'Trombone'),
(6, 'Trumpet'),
(5, 'Violin');

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
(3, 'English'),
(4, 'English'),
(4, 'Japanese'),
(4, 'Spanish'),
(5, 'English'),
(6, 'English'),
(6, 'German'),
(6, 'Malay'),
(6, 'Mandarin');

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
(3, '05000000'),
(4, '0401444444'),
(4, '075000'),
(5, '0400000000'),
(6, '0423232332'),
(7, '0414573180');

-- --------------------------------------------------------

--
-- Table structure for table `schoolinstruments`
--

DROP TABLE IF EXISTS `schoolinstruments`;
CREATE TABLE `schoolinstruments` (
  `schoolInstrumentID` int(11) NOT NULL,
  `instrumentTypeID` int(11) NOT NULL,
  `instrumentCondition` enum('New','Excellent','Good','Repair','Discard') NOT NULL,
  `hireCost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schoolinstruments`
--

INSERT INTO `schoolinstruments` (`schoolInstrumentID`, `instrumentTypeID`, `instrumentCondition`, `hireCost`) VALUES
(1, 1, 'Excellent', 40),
(2, 1, 'Good', 20);

-- --------------------------------------------------------

--
-- Table structure for table `teacherreviews`
--

DROP TABLE IF EXISTS `teacherreviews`;
CREATE TABLE `teacherreviews` (
  `reviewID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `contractID` int(11) NOT NULL,
  `reviewComment` varchar(300) NOT NULL,
  `reviewRating` int(1) NOT NULL,
  `reviewDate` date NOT NULL,
  `reviewStatus` enum('Public','Private','Pending','Invalid') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacherreviews`
--

INSERT INTO `teacherreviews` (`reviewID`, `teacherID`, `studentID`, `contractID`, `reviewComment`, `reviewRating`, `reviewDate`, `reviewStatus`) VALUES
(1, 4, 2, 0, 'Great lesson', 5, '2016-09-12', 'Private'),
(2, 5, 2, 0, 'Pretty good', 4, '2016-09-12', 'Public'),
(3, 6, 2, 0, 'Nice teacher', 4, '2016-09-12', 'Public'),
(4, 4, 2, 0, 'Learnt a lot', 5, '2016-09-12', 'Public'),
(5, 5, 2, 0, 'Loved it', 5, '2016-09-12', 'Public'),
(6, 6, 2, 0, 'Fairly average', 3, '2016-09-12', 'Public'),
(7, 4, 3, 0, 'Lots of fun', 4, '2016-09-12', 'Public'),
(8, 5, 3, 0, 'Love this teacher', 4, '2016-09-12', 'Private'),
(9, 6, 3, 0, 'Challenging but learned a lot', 4, '2016-09-12', 'Public'),
(10, 4, 3, 0, 'Thank you', 4, '2016-09-12', 'Public'),
(11, 5, 3, 0, 'Perfect', 5, '2016-09-12', 'Public'),
(12, 6, 3, 0, 'Great class', 5, '2016-09-12', 'Public'),
(13, 6, 5, 0, 'Best teacher at this school', 5, '2016-09-12', 'Public'),
(17, 6, 2, 0, 'Wrost teacher - don''t like you', 1, '2016-09-12', 'Invalid'),
(20, 6, 2, 0, 'Hate you', 1, '2016-09-12', 'Private'),
(21, 6, 2, 0, 'Great teacher', 5, '2016-09-12', 'Public');

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
(2, 5),
(3, 1),
(4, 2),
(5, 3),
(6, 4),
(7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `userinstrument`
--

DROP TABLE IF EXISTS `userinstrument`;
CREATE TABLE `userinstrument` (
  `userID` int(11) NOT NULL,
  `InstrumentTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userinstrument`
--

INSERT INTO `userinstrument` (`userID`, `InstrumentTypeID`) VALUES
(2, 5),
(3, 4),
(4, 2),
(4, 6),
(5, 1),
(5, 10),
(6, 8),
(6, 11);

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
(2, 'Peter', 'Schwartz', '1980-09-06', 'Male', NULL, 'pschwartz914@gmail.com', 'e4e9c28a37e8104de97636f94a2d34f53285e0015bf5ef722b5f702e7dece218', 'c9d6c368cda770ec8dd69e4e59d0b972', 'Owner', NULL, NULL, NULL),
(3, 'Peter', 'Schwartz', '1980-09-06', 'Male', '', 'peter@email.com', '40534c99afc016e41814f822387b39f5a1afb1b131de5863fd2658cc55b09099', '6e1a63c99810f63b81da8a9d66392559', 'Admin', NULL, 'test', ''),
(4, 'John', 'Smith', '1995-08-06', 'Female', '100000294232924', 'john@pinelandmusic.com', '303033212cb2d7e424e486c83fcd42aaff55c2f6be6db1c1b3e409922ff8eaf3', 'c0191b30afd9ddef7152c5dc8bcdb3fc', 'Teacher', NULL, NULL, NULL),
(5, 'Samantha', 'Henderson', '1995-08-06', 'Female', '100000294232924', 'samantha@pinelandmusic.com', '9474487bd182d8baccd34f313b327898e12c57025e70fb0c18cbc99c8e6d4550', '632d66e14b08cc43b6d37b17d8614b9e', 'StudentAndTeacher', NULL, NULL, NULL),
(6, 'Mary', 'Jane', '1996-07-12', 'Female', '100000294232924', 'mary@pinelandmusic.com', '2e1d238e143e6eacd1c6539fed7f09eb7013a69bb46d41e2900a6e15a200cf55', 'b03a261899ec8c063b069ddb5bab0de4', 'Teacher', NULL, NULL, NULL),
(7, 'John', 'Smith', '2010-09-09', 'Male', NULL, 'John@email.com', '1249e5d35c8ad742a05aa431d024b5050444ed9cf33c234db5c0dfbd53749530', '5080ea18eb416f8975c6e727acc25bf9', 'Guest', NULL, 'John', 'John@senior.com');

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
  ADD KEY `fk_student_idx` (`studentID`),
  ADD KEY `FK_instrument_idx` (`instrumentTypeID`);

--
-- Indexes for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`forgotID`),
  ADD KEY `fk_userID_idx` (`userID`);

--
-- Indexes for table `instrumenthire`
--
ALTER TABLE `instrumenthire`
  ADD PRIMARY KEY (`instrumentHireID`),
  ADD KEY `fk_contractID-Hire_idx` (`contractID`),
  ADD KEY `fk_schoolinstrumentID-hire_idx` (`schoolInstrumentID`);

--
-- Indexes for table `instrumentnames`
--
ALTER TABLE `instrumentnames`
  ADD PRIMARY KEY (`instrumentTypeID`),
  ADD UNIQUE KEY `name` (`instrumentName`);

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
-- Indexes for table `schoolinstruments`
--
ALTER TABLE `schoolinstruments`
  ADD PRIMARY KEY (`schoolInstrumentID`),
  ADD KEY `fk_instrumenttype-instru_idx` (`instrumentTypeID`);

--
-- Indexes for table `teacherreviews`
--
ALTER TABLE `teacherreviews`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `fk_teachers_idx` (`teacherID`),
  ADD KEY `fk_students_idx` (`studentID`);

--
-- Indexes for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD PRIMARY KEY (`userID`,`addressID`),
  ADD KEY `FK_useraddress_address_idx` (`addressID`);

--
-- Indexes for table `userinstrument`
--
ALTER TABLE `userinstrument`
  ADD PRIMARY KEY (`userID`,`InstrumentTypeID`),
  ADD KEY `fk_instrumentID-instru_idx` (`InstrumentTypeID`);

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
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `availabilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contractID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `forgotID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `instrumenthire`
--
ALTER TABLE `instrumenthire`
  MODIFY `instrumentHireID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `instrumentnames`
--
ALTER TABLE `instrumentnames`
  MODIFY `instrumentTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `schoolinstruments`
--
ALTER TABLE `schoolinstruments`
  MODIFY `schoolInstrumentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teacherreviews`
--
ALTER TABLE `teacherreviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  ADD CONSTRAINT `fk_instrumentTypeID` FOREIGN KEY (`instrumentTypeID`) REFERENCES `instrumentnames` (`instrumentTypeID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instrumenthire`
--
ALTER TABLE `instrumenthire`
  ADD CONSTRAINT `fk_contractID-Hire` FOREIGN KEY (`contractID`) REFERENCES `contracts` (`contractID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_schoolinstrumentID-hire` FOREIGN KEY (`schoolInstrumentID`) REFERENCES `schoolinstruments` (`schoolInstrumentID`) ON UPDATE CASCADE;

--
-- Constraints for table `languages`
--
ALTER TABLE `languages`
  ADD CONSTRAINT `FK` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schoolinstruments`
--
ALTER TABLE `schoolinstruments`
  ADD CONSTRAINT `fk_instrumenttype-instru` FOREIGN KEY (`instrumentTypeID`) REFERENCES `instrumentnames` (`instrumentTypeID`) ON UPDATE CASCADE;

--
-- Constraints for table `teacherreviews`
--
ALTER TABLE `teacherreviews`
  ADD CONSTRAINT `fk_students` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_teachers` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `useraddress`
--
ALTER TABLE `useraddress`
  ADD CONSTRAINT `FK_useraddress_address` FOREIGN KEY (`addressID`) REFERENCES `address` (`addressId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userinstrument`
--
ALTER TABLE `userinstrument`
  ADD CONSTRAINT `fk_instrumentID-instru` FOREIGN KEY (`InstrumentTypeID`) REFERENCES `instrumentnames` (`instrumentTypeID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userID-instru` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_userAddress` FOREIGN KEY (`UserID`) REFERENCES `useraddress` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
