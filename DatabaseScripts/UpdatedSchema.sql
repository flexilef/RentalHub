-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2016 at 03:10 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `USER_ID` varchar(30) NOT NULL,
  `PROP_TYPE_ID` int(11) NOT NULL,
  `COUNTRY_ID` int(11) DEFAULT NULL,
  `CITY_ID` int(11) DEFAULT NULL,
  `MIN_AREA` varchar(10) DEFAULT NULL,
  `MAX_AREA` varchar(10) DEFAULT NULL,
  `MIN_BUDGET` int(11) DEFAULT NULL,
  `MAX_BUDGET` int(11) DEFAULT NULL,
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `defination_type`
--

CREATE TABLE `defination_type` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(30) NOT NULL,
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `defination_type`
--

INSERT INTO `defination_type` (`ID`, `DESCRIPTION`, `ACTIVE`) VALUES
(1, 'PROPERTY_TYPE', 'Y'),
(2, 'USER_TYPE', 'Y'),
(3, 'STATUS', 'Y'),
(4, 'COUNTRY', 'Y'),
(5, 'CITY', 'Y'),
(7, 'STATE', 'Y'),
(0, 'NOT DEFINE', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `defination_type_detail`
--

CREATE TABLE `defination_type_detail` (
  `ID` int(11) NOT NULL,
  `DEF_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(30) NOT NULL,
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `defination_type_detail`
--

INSERT INTO `defination_type_detail` (`ID`, `DEF_ID`, `DESCRIPTION`, `ACTIVE`) VALUES
(1, 1, 'APARTMENT', 'Y'),
(2, 1, 'HOUSE', 'Y'),
(3, 2, 'ADMINISTRATOR', 'Y'),
(4, 2, 'STUDENT', 'Y'),
(5, 3, 'AVAILABLE', 'Y'),
(6, 3, 'SOLD', 'Y'),
(7, 3, 'N/A', 'Y'),
(8, 4, 'AMERICA', 'Y'),
(9, 4, 'GERMANY', 'Y'),
(10, 5, 'SFS', 'Y'),
(11, 5, 'FULDA', 'Y'),
(12, 6, 'SAN FRANCISCO', 'Y'),
(13, 1, 'BEDROOM', 'Y'),
(0, 0, 'N/A', 'Y'),
(15, 2, 'LANDLORD', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `image_uploads`
--

CREATE TABLE `image_uploads` (
  `ID` int(11) NOT NULL,
  `PROPERTY_ID` int(11) NOT NULL,
  `IMAGE_NAME` varchar(500) NOT NULL,
  `IMAGE_TYPE` varchar(50) NOT NULL,
  `IMAGE_SIZE` varchar(20) NOT NULL,
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY` varchar(30) NOT NULL DEFAULT 'ADMIN'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `ID` int(11) NOT NULL,
  `USER_ID` varchar(30) NOT NULL DEFAULT 'ADMIN',
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `PROP_TYPE_ID` int(11) NOT NULL,
  `ADDRESS` varchar(400) DEFAULT NULL,
  `TOTAL_ROOMS` int(11) DEFAULT NULL,
  `NUMBER_OCCUPANTS` int(11) DEFAULT NULL,
  `PRICE` int(11) NOT NULL DEFAULT '0',
  `IS_PET_ALLOWED` char(1) DEFAULT 'Y',
  `STATUS_ID` int(11) NOT NULL DEFAULT '5',
  `COMMENTS` varchar(100) DEFAULT NULL,
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY` varchar(30) NOT NULL DEFAULT 'ADMIN'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) NOT NULL,
  `FULL_NAME` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(250) NOT NULL,
  `PASSWORD` varchar(40) NOT NULL,
  `USER_TYPE_ID` int(10) DEFAULT '4',
  `ACTIVE` char(1) NOT NULL DEFAULT 'Y',
  `PHONE` varchar(50) DEFAULT NULL,
  `MOBILE` varchar(50) DEFAULT NULL,
  `LOCATION` varchar(150) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `COUNTRY_ID` (`COUNTRY_ID`);

--
-- Indexes for table `defination_type`
--
ALTER TABLE `defination_type`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `defination_type_detail`
--
ALTER TABLE `defination_type_detail`
  ADD PRIMARY KEY (`ID`,`DEF_ID`),
  ADD KEY `DEF_ID` (`DEF_ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `image_uploads`
--
ALTER TABLE `image_uploads`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `ID_2` (`ID`),
  ADD KEY `IMAGE_NAME` (`IMAGE_NAME`),
  ADD KEY `PROPERTY_ID` (`PROPERTY_ID`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD UNIQUE KEY `ID_2` (`ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `PROP_TYPE_ID` (`PROP_TYPE_ID`),
  ADD KEY `STATUS_ID` (`STATUS_ID`),
  ADD KEY `CREATED_DATE` (`CREATED_DATE`),
  ADD KEY `ADDRESS` (`ADDRESS`),
  ADD KEY `PRICE` (`PRICE`),
  ADD KEY `DESCRIPTION` (`DESCRIPTION`),
  ADD KEY `TITLE` (`TITLE`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `id` (`ID`,`EMAIL`),
  ADD UNIQUE KEY `email` (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `defination_type`
--
ALTER TABLE `defination_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `defination_type_detail`
--
ALTER TABLE `defination_type_detail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `image_uploads`
--
ALTER TABLE `image_uploads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
