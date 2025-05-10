-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 12:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `aid` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `teach_id` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `batch_id` int(10) NOT NULL,
  `did` int(10) NOT NULL,
  `batch_name` varchar(100) NOT NULL,
  `current_sem` varchar(10) NOT NULL,
  `year` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`batch_id`, `did`, `batch_name`, `current_sem`, `year`) VALUES
(1, 1, 'BSc /CS/2020-23', '1', 2020),
(2, 1, 'BSc /CS/2021-24', '2', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(10) NOT NULL,
  `department` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `department`) VALUES
(1, 'BSc Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `username`, `password`, `type`, `status`) VALUES
(1, 'AJ001', '9635782145', 'teacher', 0),
(2, 'AJ002', '8796523144', 'teacher', 0),
(3, 'AJ003', '8752456936', 'teacher', 0),
(4, 'AJ004', '4587963211', 'teacher', 0);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `mid` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `assignment` int(11) NOT NULL,
  `seminar` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `sem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_id` int(10) NOT NULL,
  `admission_no` varchar(50) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `batch_id` int(10) NOT NULL,
  `roll_no` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `current_address` varchar(500) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `subject_title` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `dept_id`, `semester`, `subject_title`, `type`) VALUES
(1, 1, 1, 'English1', 'Theory'),
(2, 1, 1, 'Introduction to progrmming', 'Theory'),
(3, 1, 1, 'cfo', 'Theory'),
(4, 1, 1, 'Digital Electronics', 'Theory'),
(5, 1, 1, 'Maths', 'Theory'),
(6, 1, 1, 'Introduction to progrmming lab', 'Lab'),
(7, 1, 1, 'Digital Electronics lab', 'Lab'),
(8, 1, 2, ' descrete maths', 'Theory'),
(9, 1, 2, 'English 2', 'Theory'),
(10, 1, 2, 'Data Structure', 'Theory'),
(11, 1, 2, 'EVS', 'Theory'),
(12, 1, 2, 'web progrmming', 'Theory'),
(13, 1, 2, 'Data stucture lab', 'Lab'),
(14, 1, 2, 'web Progrmming lab', 'Lab'),
(15, 1, 3, 'software engineering', 'Theory'),
(16, 1, 3, 'java', 'Theory'),
(17, 1, 3, 'value education', 'Theory'),
(18, 1, 3, 'dbms', 'Theory'),
(19, 1, 3, 'java lab', 'Lab'),
(20, 1, 3, 'dbms lab', 'Lab');

-- --------------------------------------------------------

--
-- Table structure for table `subject_assigned`
--

CREATE TABLE `subject_assigned` (
  `id` int(10) NOT NULL,
  `dept_id` int(10) NOT NULL,
  `batch_id` int(10) NOT NULL,
  `sem` int(10) NOT NULL,
  `teach_id` int(10) NOT NULL,
  `sub_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `emp_id` int(11) NOT NULL,
  `staff_code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dep_id` int(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(300) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`emp_id`, `staff_code`, `name`, `dep_id`, `phone`, `address`, `status`) VALUES
(1, 'AJ001', 'Venketesh', 1, '9635782145', 'ammu bhavan balaramapuram p.o', 0),
(2, 'AJ002', 'Arun A', 1, '8796523144', 'arun nivas pothencode p.o', 0),
(3, 'AJ003', 'Kumar k', 1, '8752456936', 'kumar bhavn kumrapuram p.o', 0),
(4, 'AJ004', 'Divya S', 1, '4587963211', 'divya bhavan attingal p.o', 0),
(7, 'AJ005', 'Pradeepa s', 1, '6589231478', 'pradeepa nivas valland p.o', 0),
(8, 'AJ006', 'Ajinu A', 1, '6235469870', 'Chinnu vilasam tvm p.o', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_assigned`
--
ALTER TABLE `subject_assigned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `batch_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subject_assigned`
--
ALTER TABLE `subject_assigned`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
