-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2020 at 01:11 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magma`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `State` varchar(2) DEFAULT NULL,
  `Zipcode` varchar(5) DEFAULT NULL,
  `Phone` varchar(10) DEFAULT NULL,
  `HostName` varchar(255) DEFAULT NULL,
  `HostEmail` varchar(255) DEFAULT NULL,
  `DateofEvent` date DEFAULT NULL,
  `LengthOfEvent` decimal(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Name`, `Address`, `State`, `Zipcode`, `Phone`, `HostName`, `HostEmail`, `DateofEvent`, `LengthOfEvent`) VALUES
(1, 'Comic-Con', 'San Diego Convention Center 111 W. Harbor Drive San Diego', 'CA', '92101', '6195255000', 'Shel Dorf', 'founder@detroitcomics.com', '2020-07-18', '6.0'),
(2, 'E3', 'Los Angeles Convention Center 1202 S. Figueroa Street Los Angeles', 'CA', '90015', '2137411151', 'Stanley Pierre-Louis', 'ceo@esa.com', '2020-07-09', '5.0'),
(3, 'MegaCon', 'Orange County Convention Center 9800 International Drive Orlando', 'FL', '32819', '4076859800', 'Stan Lee', 'superhero@marvel.com', '2020-07-05', '2.0'),
(4, 'PAX West', 'Washington State Convention Center 705 Pike Street Seattle', 'WA', '98101', '2066945000', 'Jerry Holkins', 'jerryh@pennyarcade.org', '2020-07-20', '3.0'),
(5, 'Playlist Live', 'World Center Mariott 8701 World Center Driver Orlando', 'FL', '32821', '4072394200', 'Steve Chen', 'chen@youtube.com', '2020-07-26', '5.0'),
(6, 'VidCon', 'Anaheim Convention Center 800 W. Katella Avenue Anaheim', 'CA', '92802', '7147658950', 'Bill Gates', 'wmgates@microsoft.com', '2020-07-01', '4.0'),
(7, 'WOAHX TikTok Conference', 'Rio All-Suites Hotel and Casino 3700 W. Flamingo Road Las Vegas', 'NV', '89103', '6195460621', 'Zhang Yiming', 'founder@tiktok.com', '2020-07-15', '3.5');

-- --------------------------------------------------------

--
-- Table structure for table `eventstaff`
--

CREATE TABLE `eventstaff` (
  `EventStaffid` int(11) NOT NULL,
  `EventID` int(11) DEFAULT NULL,
  `PersonID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eventstaff`
--

INSERT INTO `eventstaff` (`EventStaffid`, `EventID`, `PersonID`) VALUES
(2, 1, 5),
(3, 1, 8),
(4, 1, 9),
(5, 1, 11),
(6, 1, 13),
(7, 1, 16),
(8, 1, 20),
(9, 1, 21),
(12, 2, 8),
(13, 2, 9),
(14, 2, 11),
(15, 2, 13),
(16, 2, 17),
(17, 2, 19),
(18, 2, 20),
(19, 3, 3),
(20, 3, 4),
(21, 3, 7),
(22, 3, 10),
(23, 3, 11),
(24, 3, 12),
(25, 3, 15),
(26, 3, 16),
(27, 3, 21),
(28, 4, 3),
(29, 4, 4),
(30, 4, 5),
(31, 4, 6),
(32, 4, 7),
(33, 4, 13),
(34, 4, 16),
(35, 4, 19),
(36, 4, 20),
(37, 5, 2),
(38, 5, 4),
(39, 5, 8),
(40, 5, 10),
(41, 5, 12),
(42, 5, 13),
(43, 5, 14),
(44, 5, 17),
(45, 5, 21),
(46, 6, 2),
(47, 6, 5),
(48, 6, 6),
(49, 6, 9),
(50, 6, 10),
(51, 6, 12),
(52, 6, 14),
(53, 6, 17),
(54, 6, 18),
(55, 7, 3),
(56, 7, 6),
(57, 7, 7),
(58, 7, 9),
(59, 7, 10),
(60, 7, 11),
(61, 7, 14),
(62, 7, 15),
(63, 7, 18),
(69, 2, 2),
(70, 2, 4),
(73, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `PersonID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `UserName` varchar(15) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Usertype` varchar(30) DEFAULT NULL,
  `PayRate` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`PersonID`, `FirstName`, `LastName`, `Phone`, `UserName`, `Password`, `Usertype`, `PayRate`) VALUES
(1, 'Vint', 'Cerf', '212555000', 'vc0000', 'M4gm4.Adm1n', 'admin', NULL),
(2, 'David', 'Dobrik', '6105552222', 'dd2222', 'S3r:v3r5', 'server', '11.03'),
(3, 'Jimmy', 'Donaldson', '6105555463', 'jd5463', 'S3r:v3r5', 'server', '9.45'),
(4, 'Tanner', 'Eacott', '4845558495', 'te8495', 'S3r:v3r5', 'server', '10.43'),
(5, 'Felix', 'Kjelberg', '2155559008', 'fk9008', 'S3r:v3r5', 'server', '11.23'),
(6, 'Liza', 'Koshy', '2125553392', 'lk3392', 'S3r:v3r5', 'server', '11.50'),
(7, 'James', 'Vietch', '6095550948', 'jv0948', 'S3r:v3r5', 'server', '11.04'),
(8, 'Jenna', 'Marbles', '4845555445', 'jm5445', 'S3r:v3r5', 'server', '10.61'),
(9, 'Rhett', 'McLaughlin', '2485554476', 'rm4476', 'S3r:v3r5', 'server', '10.22'),
(10, 'John', 'Mulaney', '7175553245', 'km3245', 'S3r:v3r5', 'server', '9.87'),
(11, 'Link', 'Neal', '2675553333', 'ln3333', 'S3r:v3r5', 'server', '9.55'),
(12, 'Lindsey', 'Stirling', '2155552313', 'ls2313', 'S3r:v3r5', 'server', '10.54'),
(13, 'Tyler', 'Toney', '2155551111', 'tt1111', 'S3r:v3r5', 'server', '10.25'),
(14, 'Charli', 'D\'Amelio', '2675551323', 'cd1323', 'Pr3-p4r3rs', 'preparer', '15.37'),
(15, 'Loren', 'Gray', '2125551123', 'lg1123', 'Pr3-p4r3rs', 'preparer', '15.78'),
(16, 'Kristen', 'Hancher', '4845550448', 'kh0448', 'Pr3-p4r3rs', 'preparer', '15.25'),
(17, 'Chase', 'Hudson', '2155554223', 'ch4223', 'Pr3-p4r3rs', 'preparer', '16.02'),
(18, 'Zach', 'King', '6095556672', 'zk6672', 'Pr3-p4r3rs', 'preparer', '14.55'),
(19, 'Spencer', 'Knight', '6105553340', 'sk3340', 'Pr3-p4r3rs', 'preparer', '15.10'),
(20, 'Ariel', 'Martin', '2675558790', 'am8790', 'Pr3-p4r3rs', 'preparer', '15.44'),
(21, 'Addison', 'Rae', '6105553524', 'ar3524', 'Pr3-p4r3rs', 'preparer', '14.68');

-- --------------------------------------------------------

--
-- Table structure for table `vacations`
--

CREATE TABLE `vacations` (
  `Vacationid` int(11) NOT NULL,
  `Dates` date DEFAULT NULL,
  `PersonID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacations`
--

INSERT INTO `vacations` (`Vacationid`, `Dates`, `PersonID`) VALUES
(1, '2020-07-20', 2),
(2, '2020-07-21', 2),
(3, '2020-07-22', 2),
(4, '2020-07-01', 3),
(5, '2020-07-02', 3),
(6, '2020-07-03', 3),
(7, '2020-07-16', 4),
(8, '2020-07-17', 4),
(9, '2020-07-18', 4),
(10, '2020-07-19', 4),
(11, '2020-07-02', 5),
(12, '2020-07-15', 5),
(13, '2020-07-26', 5),
(14, '2020-07-06', 6),
(15, '2020-07-09', 6),
(16, '2020-07-18', 6),
(17, '2020-07-21', 7),
(18, '2020-07-22', 7),
(19, '2020-07-23', 7),
(20, '2020-07-24', 7),
(21, '2020-07-25', 7),
(22, '2020-07-26', 7),
(23, '2020-07-27', 7),
(24, '2020-07-15', 8),
(25, '2020-07-04', 9),
(26, '2020-07-05', 9),
(27, '2020-07-06', 9),
(28, '2020-07-07', 9),
(29, '2020-07-08', 9),
(30, '2020-07-17', 10),
(31, '2020-07-19', 10),
(32, '2020-07-20', 10),
(33, '2020-07-15', 11),
(34, '2020-07-01', 13),
(35, '2020-07-02', 13),
(36, '2020-07-03', 13),
(37, '2020-07-04', 13),
(38, '2020-07-05', 13),
(39, '2020-07-03', 14),
(40, '2020-07-04', 14),
(41, '2020-07-05', 14),
(42, '2020-07-06', 14),
(43, '2020-07-12', 15),
(44, '2020-07-16', 15),
(45, '2020-07-20', 15),
(46, '2020-07-26', 16),
(47, '2020-07-27', 16),
(48, '2020-07-28', 16),
(49, '2020-07-29', 16),
(50, '2020-07-30', 16),
(51, '2020-07-31', 16),
(52, '2020-07-15', 17),
(53, '2020-07-16', 17),
(54, '2020-07-17', 17),
(55, '2020-07-18', 17),
(56, '2020-07-19', 17),
(57, '2020-07-20', 17),
(58, '2020-07-22', 19),
(59, '2020-07-23', 19),
(60, '2020-07-24', 19),
(61, '2020-07-25', 19),
(62, '2020-07-26', 19),
(63, '2020-07-26', 20),
(64, '2020-07-07', 21),
(65, '2020-07-08', 21),
(66, '2020-07-09', 21),
(67, '2020-07-10', 21),
(68, '2020-07-11', 21),
(69, '2113-02-12', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `eventstaff`
--
ALTER TABLE `eventstaff`
  ADD PRIMARY KEY (`EventStaffid`),
  ADD KEY `PersonID` (`PersonID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`PersonID`);

--
-- Indexes for table `vacations`
--
ALTER TABLE `vacations`
  ADD PRIMARY KEY (`Vacationid`),
  ADD KEY `par_ind` (`PersonID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eventstaff`
--
ALTER TABLE `eventstaff`
  MODIFY `EventStaffid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `vacations`
--
ALTER TABLE `vacations`
  MODIFY `Vacationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventstaff`
--
ALTER TABLE `eventstaff`
  ADD CONSTRAINT `eventstaff_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `users` (`PersonID`) ON DELETE CASCADE,
  ADD CONSTRAINT `eventstaff_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `events` (`EventID`) ON DELETE CASCADE;

--
-- Constraints for table `vacations`
--
ALTER TABLE `vacations`
  ADD CONSTRAINT `vacations_ibfk_1` FOREIGN KEY (`PersonID`) REFERENCES `users` (`PersonID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
