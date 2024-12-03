-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2024 at 07:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentidsystem_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`Id`, `firstName`, `lastName`, `emailAddress`, `password`) VALUES
(1, 'Admin', '', 'admin@mail.com', 'D00F5D5217896FB7FD601412CB890830');

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `Id` int(10) NOT NULL,
  `admissionNo` varchar(255) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmId` varchar(10) NOT NULL,
  `sessionTermId` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `dateTimeTaken` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblattendance`
--

INSERT INTO `tblattendance` (`Id`, `admissionNo`, `classId`, `classArmId`, `sessionTermId`, `status`, `dateTimeTaken`) VALUES
(203, '223342424', '10', '30', '6', '1', '2024-01-29'),
(202, '444', '6', '17', '6', '0', '2024-01-29'),
(200, '444', '6', '17', '4', '1', '2024-01-28'),
(201, '20111332', '6', '17', '6', '0', '2024-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `Id` int(10) NOT NULL,
  `className` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`Id`, `className`) VALUES
(17, 'Bachelor of Science in Information Technology'),
(8, 'Bachelor of Science in Criminology'),
(9, 'Bachelor of Science in Education'),
(10, 'Bachelor of Science in Psychology'),
(11, 'Bachelor of Science in Business Management'),
(12, 'Bachelor of Science in Hospitality Management');

-- --------------------------------------------------------

--
-- Table structure for table `tblclassarchive`
--

CREATE TABLE `tblclassarchive` (
  `id` int(10) NOT NULL,
  `className` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblclassarms`
--

CREATE TABLE `tblclassarms` (
  `Id` int(10) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmName` varchar(255) NOT NULL,
  `isAssigned` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclassarms`
--

INSERT INTO `tblclassarms` (`Id`, `classId`, `classArmName`, `isAssigned`) VALUES
(9, '6', '1-3', '0'),
(8, '6', '1-2', '0'),
(7, '6', '1-1', '0'),
(22, '7', '1-1', '1'),
(10, '6', '1-4', '0'),
(11, '6', '1-5', '0'),
(12, '6', '2-1', '0'),
(13, '6', '2-2', '0'),
(14, '6', '2-3', '0'),
(15, '6', '2-4', '0'),
(16, '6', '2-5', '0'),
(17, '6', '2-6', '1'),
(18, '6', '3-1', '0'),
(19, '6', '3-2', '0'),
(20, '6', '3-3', '0'),
(21, '6', '4-1', '0'),
(23, '8', '1-1', '1'),
(24, '8', '1-2', '1'),
(25, '8', '1-3', '0'),
(26, '8', '1-4', '0'),
(32, '14', '1-1', '0'),
(28, '9', '1-1', '0'),
(29, '12', '1-1', '0'),
(30, '10', '1-1', '1'),
(31, '11', '1-1', '0'),
(33, '14', '1-2', '0'),
(34, '14', '2-1', '0'),
(35, '8', '2-1', '0'),
(36, '8', '1-5', '0'),
(37, '17', '1-1', '0'),
(38, '18', '1-1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblclassteacher`
--

CREATE TABLE `tblclassteacher` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNo` varchar(50) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmId` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclassteacher`
--

INSERT INTO `tblclassteacher` (`Id`, `firstName`, `lastName`, `emailAddress`, `password`, `phoneNo`, `classId`, `classArmId`, `dateCreated`) VALUES
(10, 'Rowell', 'Daganio', 'elle@mail.com', '32250170a0dca92d53ec9624f336ca24', '12112233', '8', '23', '2024-01-29'),
(9, 'Dee', 'Will', 'will@mail.com', '32250170a0dca92d53ec9624f336ca24', '1111112', '10', '30', '2024-01-29'),
(7, 'John', 'Doe', 'john@mail.com', '32250170a0dca92d53ec9624f336ca24', '1234567', '6', '17', '2024-01-27'),
(11, 'Hello', 'Hi', 'hello@mail.com', '32250170a0dca92d53ec9624f336ca24', '222222', '7', '22', '2024-01-29'),
(12, 'd', 'd', 'd@mail.com', '32250170a0dca92d53ec9624f336ca24', 'da', '8', '24', '2024-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `tblqrscanned`
--

CREATE TABLE `tblqrscanned` (
  `id` int(11) NOT NULL,
  `qrExists` varchar(50) NOT NULL,
  `handler` varchar(255) NOT NULL,
  `qrinfo` varchar(200) NOT NULL,
  `date_scanned` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblqrscanned`
--

INSERT INTO `tblqrscanned` (`id`, `qrExists`, `handler`, `qrinfo`, `date_scanned`) VALUES
(26, 'VALID', '202119334', '000_file_ad332beab541be1f68b7bb3c2904d0b9.png', '2024-02-02 14:39:00'),
(27, 'INVALID', 'not_found', ' ', '2024-02-02 14:40:09'),
(28, 'INVALID', 'not_found', ' ', '2024-02-02 14:40:25'),
(29, 'INVALID', 'not_found', 'Hello world', '2024-02-02 14:40:44'),
(30, 'VALID', '202119334', '000_file_ad332beab541be1f68b7bb3c2904d0b9.png', '2024-02-02 14:41:51'),
(31, 'VALID', '21313', '000_file_6d4d4ed433e4e2f87afb6c8197f5b0d8.png', '2024-06-03 18:30:18'),
(32, 'INVALID', 'not_found', 'Hello', '2024-06-03 18:36:54'),
(33, 'INVALID', 'not_found', '000_file_ad332beab541be1f68b7bb3c2904d0b9.png', '2024-06-04 11:41:26'),
(34, 'VALID', '202110318', '000_file_9ee64c7caf149bc3e77e2f70ea4525fd.png', '2024-06-04 11:42:12'),
(35, 'INVALID', 'not_found', 'Hello', '2024-06-08 08:48:22'),
(36, 'VALID', '21313', '000_file_6d4d4ed433e4e2f87afb6c8197f5b0d8.png', '2024-06-08 08:48:33'),
(37, 'INVALID', 'not_found', '000_file_6d4d4ed433e4e2f87afb6c8197f5b0d8.png', '2024-06-08 08:49:09'),
(38, 'VALID', '123434543', '000_file_94af75f72f5acca8b60a471149f908c8.png', '2024-06-08 11:25:11'),
(39, 'INVALID', 'not_found', 'Hello world', '2024-06-10 09:34:19'),
(40, 'VALID', '203321333', '000_file_0c7f98e316b29ccdebf895ff3d34f166.png', '2024-06-10 12:05:56'),
(41, 'VALID', '203321333', '000_file_0c7f98e316b29ccdebf895ff3d34f166.png', '2024-06-10 12:05:58'),
(42, 'INVALID', 'not_found', '000_file_0c7f98e316b29ccdebf895ff3d34f166.png', '2024-06-10 12:06:35'),
(43, 'INVALID', 'not_found', '000_file_0c7f98e316b29ccdebf895ff3d34f166.png', '2024-06-10 12:06:37'),
(44, 'INVALID', 'not_found', '000_file_0c7f98e316b29ccdebf895ff3d34f166.png', '2024-06-10 12:45:27'),
(45, 'VALID', '112233445566', '000_file_a6c83ec482919fa0c60a116974ccf871.png', '2024-06-10 13:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `tblsessionterm`
--

CREATE TABLE `tblsessionterm` (
  `Id` int(10) NOT NULL,
  `sessionName` varchar(50) NOT NULL,
  `termId` varchar(50) NOT NULL,
  `isActive` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsessionterm`
--

INSERT INTO `tblsessionterm` (`Id`, `sessionName`, `termId`, `isActive`, `dateCreated`) VALUES
(6, '2023-to-2024', '2', '0', '2024-01-28'),
(4, '2023-to-2024', '1', '1', '2024-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentarchive`
--

CREATE TABLE `tblstudentarchive` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `admissionNumber` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `classId` varchar(50) NOT NULL,
  `classArmId` varchar(50) NOT NULL,
  `dateCreated` varchar(50) NOT NULL,
  `guardian` varchar(100) NOT NULL,
  `guardianNo` varchar(100) NOT NULL,
  `homeaddress` varchar(100) NOT NULL,
  `qrHashPath` varchar(500) NOT NULL,
  `studentimg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentimg`
--

CREATE TABLE `tblstudentimg` (
  `id` int(11) NOT NULL,
  `admissionno` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `Id` int(10) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `admissionNumber` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `classId` varchar(10) NOT NULL,
  `classArmId` varchar(10) NOT NULL,
  `dateCreated` varchar(50) NOT NULL,
  `guardian` varchar(100) NOT NULL,
  `guardianNo` varchar(100) NOT NULL,
  `homeaddress` varchar(100) NOT NULL,
  `qrHashPath` varchar(500) NOT NULL,
  `studentimg` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`Id`, `firstName`, `lastName`, `otherName`, `admissionNumber`, `password`, `classId`, `classArmId`, `dateCreated`, `guardian`, `guardianNo`, `homeaddress`, `qrHashPath`, `studentimg`) VALUES
(58, 'Rams', 'Gallo', '', '202110318', '12345', '6', '18', '2024-06-08', 'Gallo', '12121213', 'La Joya', '000_file_7e56c23b1ff2ded8e5f538688341b13b.png', 'Gallo202110318.png'),
(59, 'amlakmd', 'lkadmwlm', 'dmwamd', '111232d', '12345', '11', '31', '2024-06-08', 'awdwa', 'dakmladlk', 'lkdwkawdkml', '000_file_2a70d5ffba54e49f796505eba1382851.png', ''),
(51, 'Jayson', 'Diaz', 'JayD', '201223144', '12345', '8', '24', '2024-06-08', 'Johnson Diaz', '093343344', 'Calamba, Laguna', '000_file_ac6bc4ab185ac79b87dcfac7241f3284.png', '20200902_184449.jpg'),
(47, 'johnson', 'james', 'JJ', '8988881', '12345', '12', '29', '2024-06-03', 'Jamerson', '12333323', 'La joya', '000_file_2aa0dc28183090e16984d6cf6e7076bc.png', ''),
(48, 'Patty', 'Hamburg', 'Patter', '34102304', '12345', '9', '28', '2024-06-03', 'Jamerson', '1233333', 'Firenze', '000_file_7a63440f1ed8aace1d8b66861bc0eccd.png', 'cvsu.png'),
(50, 'hello', 'dawdwada', 'addawadwwf', '26906843', '12345', '10', '30', '2024-06-03', 'awfowa', '1111111', 'dwa', '000_file_02ba010825a6ba2844d5e47c1b97f348.png', 'ACS logo transparentV2.png'),
(68, 'dal,al,dqw', 'lse;mfe;m', 'd;md;ms;m', 'ekmsekmsefklm', '12345', '8', '23', '2024-06-08', 'kmsfeklmsfemk', 'mksfekme;l', 'klsegmefm', '000_file_c2da83eb7ef7d9dd17082962b5fda355.png', '000_file_c2da83eb7ef7d9dd17082962b5fda355.png'),
(53, 'felkfellef', 'lnfselkeflk', 'lnfelkeflk', 'lknfsenklfelkn', '12345', '12', '29', '2024-06-08', 'klnfelnelknsefkln', 'knlfelnefln', 'lnelneflkce', '000_file_da6aac00ea61d2048d5e8a5d57a190e0.png', 'CoR.jpg'),
(54, 'ddalkmdkl', 'kladwklawk', 'kndlakwndl', 'ndlaklwnd', '12345', '6', '19', '2024-06-08', 'klndwlaknd', 'ldnawlkn', 'dwadaw', '000_file_bd3d26b1b1903d397f1df70933732999.png', ''),
(55, 'dmkmkml', 'dfthpokfp', 'kgmrlkgmdr', 'gmrdlkgml', '12345', '10', '30', '2024-06-08', 'fksm;g,', 'flkmeslfkm', 'elkfmslkfm', '000_file_954bac3cdbb4c03704a926a2b0e64fe5.png', ''),
(61, 'ddwadd', 'ddwwadwad', 'dddawdwa', '1111111', '12345', '8', '26', '2024-06-08', 'daddww', 'awddwadwdadd', 'awdawdadw', '000_file_b360584de035e4a9d58e5d07a78bcd03.png', 'Screenshot 2022-10-27 6.36.35 PM.png'),
(62, 'new', 'awdad', 'dwadaw', '123434543', '12345', '12', '29', '2024-06-08', 'laawda', 'dadwwdmawd', 'ajkjsenfkje', '000_file_94af75f72f5acca8b60a471149f908c8.png', 'user-icn.png'),
(63, 'Rams', 'Gallo', 'awd', '112233445566', '12345', '6', '18', '2024-06-10', 'jawdjwdjndw', 'kjffrkjfse', 'djlnsefkj', '000_file_a6c83ec482919fa0c60a116974ccf871.png', 'Gallo202110317.png'),
(65, 'Hello', 'Hi', 'Wassup', '20333342', '12345', '7', '22', '2024-06-10', 'Greetings', '12230944', 'Gday', '000_file_ace94c3f684dd2a18061b37fe7ef5d4c.png', 'Screenshot 2022-10-12 5.50.16 PM.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblterm`
--

CREATE TABLE `tblterm` (
  `Id` int(10) NOT NULL,
  `termName` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblterm`
--

INSERT INTO `tblterm` (`Id`, `termName`) VALUES
(1, 'First'),
(2, 'Second'),
(3, 'Third');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblclassarchive`
--
ALTER TABLE `tblclassarchive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclassarms`
--
ALTER TABLE `tblclassarms`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblclassteacher`
--
ALTER TABLE `tblclassteacher`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblqrscanned`
--
ALTER TABLE `tblqrscanned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsessionterm`
--
ALTER TABLE `tblsessionterm`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblstudentarchive`
--
ALTER TABLE `tblstudentarchive`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblstudentimg`
--
ALTER TABLE `tblstudentimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblterm`
--
ALTER TABLE `tblterm`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblclassarchive`
--
ALTER TABLE `tblclassarchive`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblclassarms`
--
ALTER TABLE `tblclassarms`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tblclassteacher`
--
ALTER TABLE `tblclassteacher`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblqrscanned`
--
ALTER TABLE `tblqrscanned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tblsessionterm`
--
ALTER TABLE `tblsessionterm`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblstudentarchive`
--
ALTER TABLE `tblstudentarchive`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tblstudentimg`
--
ALTER TABLE `tblstudentimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tblterm`
--
ALTER TABLE `tblterm`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
