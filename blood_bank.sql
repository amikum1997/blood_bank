-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2020 at 07:00 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_doner_record`
--

CREATE TABLE `blood_doner_record` (
  `bloodID` int(11) NOT NULL,
  `hospitalName` varchar(256) NOT NULL,
  `donerName` varchar(100) NOT NULL,
  `donerBloodGroup` varchar(10) NOT NULL,
  `donerSex` varchar(50) NOT NULL,
  `donerPhNo` int(12) NOT NULL,
  `donerAddress` varchar(256) NOT NULL,
  `donatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_doner_record`
--

INSERT INTO `blood_doner_record` (`bloodID`, `hospitalName`, `donerName`, `donerBloodGroup`, `donerSex`, `donerPhNo`, `donerAddress`, `donatedOn`) VALUES
(1, '', 'amit', 'B+', 'male', 1234567890, '5A/9E mubarakpur kotwa allahabad,up,India, Mundera chungi,Allahabad,up,India', '2020-10-18 16:06:43'),
(2, 'abcs', 'amit', 'B+', 'male', 2147483647, 'Bunglo E-1 East colony Behind passenger reservation office\r\nEast railway colony,sultanpur railway station', '2020-10-18 20:43:15'),
(3, 'demo', 'amit', 'B+', 'male', 2147483647, 'Bunglo E-1 East colony Behind passenger reservation office\r\nEast railway colony,sultanpur railway station', '2020-10-18 20:13:37'),
(4, 'demo', 'hema', 'O+', 'male', 2147483647, 'GLA UNIVERSITY MATHURA', '2020-10-18 20:16:00'),
(5, 'demo', 'hema', 'O+', 'male', 2147483647, 'GLA UNIVERSITY MATHURA', '2020-10-18 20:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `blood_request`
--

CREATE TABLE `blood_request` (
  `reqID` int(10) NOT NULL,
  `hospitalName` varchar(256) NOT NULL,
  `requesterName` varchar(256) NOT NULL,
  `requesterBloodGroup` varchar(10) NOT NULL,
  `requestDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_request`
--

INSERT INTO `blood_request` (`reqID`, `hospitalName`, `requesterName`, `requesterBloodGroup`, `requestDate`) VALUES
(14, 'demo', 'demo', 'O+', '2020-10-19 04:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hospital`
--

CREATE TABLE `tbl_hospital` (
  `userID` int(11) NOT NULL,
  `hospitalName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userType` varchar(100) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hospital`
--

INSERT INTO `tbl_hospital` (`userID`, `hospitalName`, `userEmail`, `userPass`, `userType`, `userStatus`, `tokenCode`) VALUES
(2, 'amikum', 'ams281997@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', 'N', 'a2c83cbd64f62fc29e58dadf3957e405'),
(3, 'demo', 'demo@a.com', 'e10adc3949ba59abbe56e057f20f883e', '', 'N', '33a00659a6b8807d36f9e57a62c88ff0'),
(4, 'demo', 'demo@demo.com', 'e10adc3949ba59abbe56e057f20f883e', 'hospital', 'N', '830ece9526839c6455967b2d11d06a11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userType` varchar(100) NOT NULL,
  `userBloodGroup` varchar(20) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `userName`, `userEmail`, `userPass`, `userType`, `userBloodGroup`, `userStatus`, `tokenCode`) VALUES
(1, 'amikum', 'ams281997@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', 'N', 'a3e4f0d34a02967f1d877ed8971bbacb'),
(2, 'demo', 'demo@demo.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', '', 'N', '26d66f3a13ee242cdfb16a5aa786fd9e'),
(3, 'demo', 'demo@d.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'B+', 'N', '3e2c2e5024f6b9b8d18002cf2a718f3b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_doner_record`
--
ALTER TABLE `blood_doner_record`
  ADD PRIMARY KEY (`bloodID`);

--
-- Indexes for table `blood_request`
--
ALTER TABLE `blood_request`
  ADD PRIMARY KEY (`reqID`);

--
-- Indexes for table `tbl_hospital`
--
ALTER TABLE `tbl_hospital`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_doner_record`
--
ALTER TABLE `blood_doner_record`
  MODIFY `bloodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blood_request`
--
ALTER TABLE `blood_request`
  MODIFY `reqID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_hospital`
--
ALTER TABLE `tbl_hospital`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
