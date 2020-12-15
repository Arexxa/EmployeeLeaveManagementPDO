-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2019 at 04:56 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', '2019-10-14 03:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `headadmin`
--

CREATE TABLE `headadmin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `headadmin`
--

INSERT INTO `headadmin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'headadmin', '3ff4613e3f2c264f243a4e225fd040d5', '2019-12-01 04:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(5, 'Computer Science and Mathematics(CS)', 'CS', 'CS110', '2019-12-01 14:21:23'),
(6, 'Computer Science and Mathematics(QS)', 'QS', 'CS143', '2019-12-01 14:21:49'),
(7, 'Information Management', 'IM', 'IM110', '2019-12-01 14:40:43'),
(8, 'Accounts', 'ACC', 'AC110', '2019-12-01 14:42:03'),
(9, 'Business ', 'BM', 'BM112', '2019-12-01 14:43:18'),
(10, 'Investment', 'BM', 'BM114', '2019-12-01 14:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `EmpId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Country` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`id`, `EmpId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Position`, `Address`, `City`, `Country`, `Phonenumber`, `Status`, `RegDate`) VALUES
(3, 'EM123456789', 'Shahrul', 'Nizam', 'shahrulayol31@gmail.com', 'afc4843f555fb39ac55619c55ad18412', 'Male', '', 'Computer Science and Mathematics(CS)', 'lecturer', 'No.45, Jalan Temenggong', 'Johor Bahru', 'Malaysia', '0177443123', 1, '2019-09-03 06:33:35'),
(4, 'EM201432354', 'Nazman', 'Hakim', 'nazmanhakim@gmail.com', 'e00b7012cb541c4dc60c9b7b2052a073', 'Male', '1987-06-17', 'Computer Science and Mathematics(CS)', 'lecturer', 'No.6, Jalan Tabung Haji', 'Muar ', 'Malaysia', '0167879611', 1, '2019-09-16 13:51:01'),
(5, 'EM312856386', 'Sarah', 'Huszri', 'sarahhuszri@gmail.com', '9e9d7a08e048e9d604b79460b54969c3', 'Female', '1986-10-10', 'Accounts', 'lecturer', 'No.4/5, Jalan Tebuan, Taman Scientex', 'Pasir Gudang, Johor', 'Malaysia', '0112224456', 1, '2019-09-16 14:00:54'),
(6, 'EM491700215', 'Muhammad', 'Haziq', 'haziq12@gmail.com', 'b822366e15e32e329c24ca5e190f0c09', 'Male', '1987-06-15', 'Information Management', 'lecturer', 'No.2/3, Jalan Abu Bakar', 'Bandar Tenggara, Kota Tinggi', 'Malaysia', '0197876521', 1, '2019-09-16 14:06:07'),
(7, 'EM575218301', 'Nuratiqah', 'Syahira', 'atiqahsyahira@gmail.com', '5913e612d3c4c24a75fb80b5b44b2e24', 'Female', '1985-04-12', 'Business ', 'lecturer', 'No.32, Jalan Tembakau, Taman Daya', 'Mersing', 'Malaysia', '0111625364', 1, '2019-09-16 14:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` mediumtext,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `StatusHead` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `IsReadHead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`id`, `LeaveType`, `ToDate`, `FromDate`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `StatusHead`, `IsRead`, `IsReadHead`, `empid`) VALUES
(24, 'Medical Leave test', '14/8/2019', '20/08/2019', 'sesaja cuti. Nak enjoy', '2019-12-01 14:47:43', 'huhuhu', '2019-12-01 20:52:21 ', 1, 1, 1, 1, 4),
(25, 'Casual Leave', '02/09/2019', '05/09/2019', 'Emergency leaves', '2019-12-01 14:48:46', 'hahahah', '2019-12-01 20:52:06 ', 1, 1, 1, 1, 6),
(26, '', '20/08/2019', '20/08/2019', 'dedede', '2019-12-01 15:18:34', 'not allowed!', '2019-12-03 8:49:17 ', 2, 2, 1, 1, 5),
(27, 'Medical Leave test', '03/12/2019', '03/12/2019', 'medical check up appointment', '2019-12-03 02:58:29', '', '2019-12-03 8:46:37 ', 1, 1, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'Casual Leave', 'Casual Leave ', '2017-11-01 12:07:56'),
(2, 'Medical Leave test', 'Medical Leave  test', '2017-11-06 13:16:09'),
(3, 'Restricted Holiday(RH)', 'Restricted Holiday(RH)', '2017-11-06 13:16:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headadmin`
--
ALTER TABLE `headadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `headadmin`
--
ALTER TABLE `headadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
