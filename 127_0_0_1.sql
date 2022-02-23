-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 16, 2021 at 08:47 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdp`
--
CREATE DATABASE IF NOT EXISTS `sdp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `sdp`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Admin_ID` int NOT NULL AUTO_INCREMENT,
  `Admin_Name` varchar(255) NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Name`, `Password`) VALUES
(1, 'John', '123456'),
(10, 'Jasmine', '234567'),
(9, 'Abu', '123456'),
(8, 'Ali', '123456'),
(7, 'Micheal', '123456'),
(6, 'Ming', '123456'),
(5, 'Vincent', '123456'),
(4, 'Tyler', '123456'),
(3, 'Ron', '123456'),
(2, 'Ryan', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `AttendanceID` int NOT NULL AUTO_INCREMENT,
  `ClassID` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `OTP_Number` int NOT NULL,
  `Status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Created_At` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AttendanceID`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendanceID`, `ClassID`, `Date`, `Start_Time`, `End_Time`, `OTP_Number`, `Status`, `Created_At`) VALUES
(76, 'CL06', '2021-03-18', '16:40:00', '17:41:00', 719, 'Ended', '2021-03-16 16:41:03'),
(75, 'CL01', '2021-03-16', '16:38:00', '17:38:00', 157, 'Ended', '2021-03-16 16:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_detail`
--

DROP TABLE IF EXISTS `attendance_detail`;
CREATE TABLE IF NOT EXISTS `attendance_detail` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `StudentTP` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Attend_Status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `AttendanceID` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance_detail`
--

INSERT INTO `attendance_detail` (`ID`, `StudentTP`, `Attend_Status`, `AttendanceID`) VALUES
(211, 'TP0010', 'Present', 76),
(210, 'TP0009', 'Present', 76),
(209, 'TP0008', 'Absent', 76),
(208, 'TP0007', 'Present', 76),
(207, 'TP0001', 'Present', 76),
(206, 'TP0004', 'Present', 76),
(205, 'TP0005', 'Absent', 76),
(204, 'TP0006', 'Absent', 76),
(203, 'TP0010', 'Absent', 75),
(202, 'TP0009', 'Absent', 75),
(201, 'TP0008', 'Absent', 75),
(200, 'TP0007', 'Absent', 75),
(199, 'TP0001', 'Present', 75),
(198, 'TP0004', 'Present', 75),
(197, 'TP0005', 'Absent', 75),
(196, 'TP0006', 'Absent', 75);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `ClassID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CourseID` varchar(255) NOT NULL,
  `ModuleID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `LecturerID` varchar(255) NOT NULL,
  PRIMARY KEY (`ClassID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ClassID`, `CourseID`, `ModuleID`, `LecturerID`) VALUES
('CL05', 'DIP_ICT(SE)', 'SEJ-01', 'LT0001'),
('CL04', 'DIP_ICT(SE)', 'Eng-02', 'LT0004'),
('CL03', 'DIP_ICT(SE)', 'Eng-01', 'LT0002'),
('CL02', 'DIP_ICT(SE)', 'Math-02', 'LT0001'),
('CL01', 'DIP_ICT(SE)', 'Math-01', 'LT0001'),
('CL06', 'DIP_ICT(SE)', 'Math-03', 'LT0001');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `CourseID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`CourseID`, `CourseName`) VALUES
('DIP_ICT(SE)', 'Diploma Engineers'),
('DIP_ICT(DA)', 'Diploma Data Analysis Part1'),
('DIP_ICT(Net)', 'Diploma in Networking'),
('DIP_ICT(IT)', 'Diploma in IT'),
('DIP_ICT(SEC)', 'Diploma in Security'),
('DIP_ICT(BUS)', 'Diploma in Business'),
('DIP_ICT(HM)', 'Diploma in Hotel Management');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `StudentTP` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `LecturerID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Staff_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Bug` text NOT NULL,
  `Details` text NOT NULL,
  `Created_At` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Admin_Reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `StudentTP`, `LecturerID`, `Staff_ID`, `Bug`, `Details`, `Created_At`, `Admin_Reply`) VALUES
(37, '', '', 'ST0001', 'PDF Bugs', 'Failed to generate pdf file!', '2021-03-16 16:45:16', 'Fixed'),
(36, 'TP0001', '', '', 'Lagging bug', 'The delay in the website is terrible. Please help!', '2021-03-16 16:43:30', 'Pending(We are trying to find a solution on this bug)'),
(34, '', 'LT0001', '', 'Attendance Issue', 'Failed to generate attendance.', '2021-03-16 16:37:20', 'Pending'),
(35, '', 'LT0001', '', 'Attendance issue', 'My class does not exist in my list.', '2021-03-16 16:38:04', 'Pending'),
(33, 'TP0001', '', '', 'Attendance issue', 'I cannot take attendance please help thank you.', '2021-03-16 16:31:55', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
CREATE TABLE IF NOT EXISTS `lecturer` (
  `LecturerID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `LecturerName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL,
  PRIMARY KEY (`LecturerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`LecturerID`, `LecturerName`, `Password`, `Department`) VALUES
('LT0001', 'Ku', '123456', 'School of IT'),
('LT0002', 'kira', '223333', 'School of Engineering'),
('LT0003', 'Ryan', '123456', 'School of IT'),
('LT0004', 'Ron', '123456', 'School of IT'),
('LT0005', 'Tyler', '123456', 'School of Business'),
('LT0006', 'John', '123456', 'School of IT'),
('LT0007', 'Vincent', '123456', 'School of IT'),
('LT0008', 'Ming', '123456', 'School of IT'),
('LT0009', 'Jasmine', '123456', 'School of IT');

-- --------------------------------------------------------

--
-- Table structure for table `management_staff`
--

DROP TABLE IF EXISTS `management_staff`;
CREATE TABLE IF NOT EXISTS `management_staff` (
  `Staff_ID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Staff_Name` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`Staff_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `management_staff`
--

INSERT INTO `management_staff` (`Staff_ID`, `Staff_Name`, `Password`) VALUES
('ST0001', 'Ku', '123456'),
('ST0002', 'Kira', '123456'),
('ST0008', 'Brandon', '123456'),
('ST0007', 'Tyler', '123456'),
('ST0006', 'Ron', '123456'),
('ST0005', 'Chris', '123456'),
('ST0004', 'John', '123456'),
('ST0003', 'ryan', '123456'),
('ST0009', 'Vincent', '123456'),
('ST0010', 'Ming', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `ModuleID` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ModuleName` varchar(255) NOT NULL,
  PRIMARY KEY (`ModuleID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`ModuleID`, `ModuleName`) VALUES
('Math-01', 'Easy Maths'),
('Math-02', 'Starter Math'),
('Math-03', 'Hard Math'),
('Eng-01', 'Easy English'),
('Eng-02', 'Starter English'),
('Eng-03', 'Hard English'),
('SEJ-01', 'Basic Sejarah');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `StudentTP` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `StudentName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CourseID` varchar(255) NOT NULL,
  PRIMARY KEY (`StudentTP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentTP`, `StudentName`, `Password`, `CourseID`) VALUES
('TP0006', 'John', '123456', 'DIP_ICT(SE)'),
('TP0005', 'Lim', '123456', 'DIP_ICT(SE)'),
('TP0004', 'Ming', '123456', 'DIP_ICT(SE)'),
('TP0003', 'Tyler', '123456', 'DIP_ICT(Net)'),
('TP0002', 'Ryan', '123456', 'DIP_ICT(DA)'),
('TP0001', 'Ku', '123456', 'DIP_ICT(SE)'),
('TP0007', 'Micheal', '123456', 'DIP_ICT(SE)'),
('TP0008', 'Vincent', '123456', 'DIP_ICT(SE)'),
('TP0009', 'Chris', '123456', 'DIP_ICT(SE)'),
('TP0010', 'Ron', '123456', 'DIP_ICT(SE)');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
