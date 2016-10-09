-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2016 at 03:14 AM
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
-- RELATIONS FOR TABLE `address`:
--

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `unitNumber`, `streetNumber`, `streetName`, `streetType`, `suburb`, `postCode`, `state`) VALUES
(1, '', '34', 'Main', 'road', 'Caboolture', '4510', 'QLD'),
(2, NULL, '1', 'George St', 'street', 'Brisbane', '4000', 'QLD'),
(3, '1', '42', 'Main', 'street', 'Bentley', '2480', 'NSW'),
(4, '23', '1', 'Gray', 'street', 'New Farm', '4006', 'QLD');

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
-- RELATIONS FOR TABLE `availability`:
--   `teacherID`
--       `users` -> `UserID`
--

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
-- RELATIONS FOR TABLE `contracts`:
--   `studentID`
--       `users` -> `UserID`
--   `teacherID`
--       `users` -> `UserID`
--

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`contractID`, `teacherID`, `studentID`, `startDate`, `endDate`, `time`, `day`, `length`, `instrument`) VALUES
(1, 2, 3, '2016-09-08', '2016-10-26', '12:00:00', 'Thursday', '30', 'Violin'),
(2, 2, 3, '2016-09-05', '2016-10-31', '14:00:00', 'Monday', '60', 'Piano'),
(3, 2, 3, '2016-09-07', '2016-10-26', '11:00:00', 'Wednesday', '60', 'Chello'),
(4, 2, 3, '2016-09-06', '2016-10-25', '12:00:00', 'Tuesday', '60', 'Stuff'),
(7, 3, 2, '2016-09-07', '2016-09-14', '10:00:00', 'Wednesday', '60', 'Chello'),
(8, 3, 2, '2016-09-07', '2016-09-14', '09:00:00', 'Monday', '60', 'Violin'),
(9, 6, 3, '2016-09-07', '2016-09-14', '10:00:00', 'Thursday', '60', 'Chello'),
(10, 3, 3, '2016-09-07', '2016-09-14', '10:00:00', 'Monday', '60', 'Chello'),
(11, 6, 2, '2016-09-07', '2016-09-14', '12:00:00', 'Monday', '60', 'Chello'),
(12, 3, 2, '2016-09-07', '2016-09-14', '10:00:00', 'Monday', '60', 'Chello'),
(13, 6, 2, '2016-09-07', '2016-09-14', '10:00:00', 'Monday', '60', 'Chello'),
(14, 3, 3, '2016-09-07', '2016-09-14', '13:00:00', 'Tuesday', '60', 'Violin');

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

--
-- RELATIONS FOR TABLE `forgotpassword`:
--   `userID`
--       `users` -> `UserID`
--

--
-- Dumping data for table `forgotpassword`
--

INSERT INTO `forgotpassword` (`forgotID`, `userID`, `emailCode`, `link`) VALUES
(1, 2, '1e28ca5de9ca99d320fc34525ea9be09', '/pages/forgotpassword.php?email=pschwartz914@gmail.com&emailCode=1e28ca5de9ca99d320fc34525ea9be09'),
(2, 2, '910a0c3b3784f4a2d2e06ea212ecea04', 'http://localhost/MusicSchool/pages/forgotpassword.php?email=pschwartz914@gmail.com&emailCode=910a0c3b3784f4a2d2e06ea212ecea04'),
(3, 2, '9658da46cabbd5512a424d564de72d43', 'http://localhost/MusicSchool/pages/resetpassword.php?email=pschwartz914@gmail.com&emailCode=9658da46cabbd5512a424d564de72d43');

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
-- RELATIONS FOR TABLE `instruments`:
--   `userID`
--       `users` -> `UserID`
--

--
-- Dumping data for table `instruments`
--

INSERT INTO `instruments` (`userID`, `instrument`) VALUES
(2, 'Chello'),
(2, 'Violin'),
(3, 'Chello'),
(3, 'Violin'),
(4, 'Bass'),
(4, 'Chello'),
(4, 'Guitar'),
(4, 'Violin'),
(5, 'Clarinet'),
(5, 'Flute'),
(5, 'Guitar'),
(5, 'Pan Flute'),
(5, 'Trumbone'),
(5, 'Trumpet'),
(6, 'Bass'),
(6, 'Drums'),
(6, 'Electric Guitar'),
(6, 'Keyboard'),
(6, 'Piano'),
(6, 'Saxiphone');

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
-- RELATIONS FOR TABLE `languages`:
--   `userID`
--       `users` -> `UserID`
--

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
-- RELATIONS FOR TABLE `phonenumbers`:
--

--
-- Dumping data for table `phonenumbers`
--

INSERT INTO `phonenumbers` (`userID`, `phoneNumber`) VALUES
(2, '0414573180'),
(2, '0754000000'),
(3, '05000000'),
(4, '0401444444'),
(5, '0400000000'),
(6, '0423232332');

-- --------------------------------------------------------

--
-- Table structure for table `teacherreviews`
--

DROP TABLE IF EXISTS `teacherreviews`;
CREATE TABLE `teacherreviews` (
  `reviewID` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `reviewComment` varchar(300) NOT NULL,
  `reviewRating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONS FOR TABLE `teacherreviews`:
--   `studentID`
--       `users` -> `UserID`
--   `teacherID`
--       `users` -> `UserID`
--

--
-- Dumping data for table `teacherreviews`
--

INSERT INTO `teacherreviews` (`reviewID`, `teacherID`, `studentID`, `reviewComment`, `reviewRating`) VALUES
(1, 4, 2, 'Great lesson', 5),
(2, 5, 2, 'Pretty good', 4),
(3, 6, 2, 'Nice teacher', 4),
(4, 4, 2, 'Learnt a lot', 5),
(5, 5, 2, 'Loved it', 5),
(6, 6, 2, 'Fairly average', 3),
(7, 4, 3, 'Lots of fun', 4),
(8, 5, 3, 'Love this teacher', 4),
(9, 6, 3, 'Challenging but learned a lot', 4),
(10, 4, 3, 'Thank you', 4),
(11, 5, 3, 'Perfect', 5),
(12, 6, 3, 'Great class', 5),
(13, 6, 5, 'Best teacher at this school', 5);

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
-- RELATIONS FOR TABLE `useraddress`:
--   `addressID`
--       `address` -> `addressId`
--

--
-- Dumping data for table `useraddress`
--

INSERT INTO `useraddress` (`userID`, `addressID`) VALUES
(3, 1),
(4, 2),
(5, 3),
(6, 4);

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
-- RELATIONS FOR TABLE `users`:
--   `UserID`
--       `useraddress` -> `userID`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstName`, `lastName`, `DOB`, `gender`, `facebookId`, `email`, `password`, `salt`, `accountType`, `comCode`, `parentName`, `parentEmail`) VALUES
(2, 'Peter', 'Schwartz', '1980-09-06', 'Male', NULL, 'pschwartz914@gmail.com', '358452b4ec13a0371aa46c2c2817d7752cd1e6c41c84b57120bd45fbe68af04e', 'd41d8cd98f00b204e9800998ecf8427e', 'StudentAndTeacher', NULL, NULL, NULL),
(3, 'Peter', 'Schwartz', '1980-09-06', 'Male', '', 'peter@email.com', '40534c99afc016e41814f822387b39f5a1afb1b131de5863fd2658cc55b09099', '6e1a63c99810f63b81da8a9d66392559', 'Admin', NULL, 'test', ''),
(4, 'John', 'Smith', '1995-08-06', 'Male', '100000294232924', 'john@pinelandmusic.com', '303033212cb2d7e424e486c83fcd42aaff55c2f6be6db1c1b3e409922ff8eaf3', 'c0191b30afd9ddef7152c5dc8bcdb3fc', 'Teacher', NULL, NULL, NULL),
(5, 'Samantha', 'Henderson', '1995-08-06', 'Female', '100000294232924', 'samantha@pinelandmusic.com', '9474487bd182d8baccd34f313b327898e12c57025e70fb0c18cbc99c8e6d4550', '632d66e14b08cc43b6d37b17d8614b9e', 'StudentAndTeacher', NULL, NULL, NULL),
(6, 'Mary', 'Jane', '1996-07-12', 'Female', '100000294232924', 'mary@pinelandmusic.com', '2e1d238e143e6eacd1c6539fed7f09eb7013a69bb46d41e2900a6e15a200cf55', 'b03a261899ec8c063b069ddb5bab0de4', 'Teacher', NULL, NULL, NULL);

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
-- Indexes for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`forgotID`),
  ADD KEY `fk_userID_idx` (`userID`);

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
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `availabilityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `contractID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `forgotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `teacherreviews`
--
ALTER TABLE `teacherreviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`studentID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teacher` FOREIGN KEY (`teacherID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD CONSTRAINT `fk_userID` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_userAddress` FOREIGN KEY (`UserID`) REFERENCES `useraddress` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
