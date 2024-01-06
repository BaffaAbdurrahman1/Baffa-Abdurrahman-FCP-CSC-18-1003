-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 04:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `approval_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `emp_num` varchar(20) NOT NULL,
  `approval_date` varchar(15) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(45) NOT NULL,
  `fact_id` int(11) NOT NULL,
  `dept_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `fact_id`, `dept_status`) VALUES
(1, 'Computer science', 1, 1),
(2, 'Psychology', 3, 1),
(4, 'Software Engineering', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fact_id` int(11) NOT NULL,
  `fact_name` varchar(45) NOT NULL,
  `fact_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fact_id`, `fact_name`, `fact_status`) VALUES
(1, 'Science', 1),
(5, 'Social Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `store_qty` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `item_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item`, `store_qty`, `date`, `item_status`) VALUES
(1, 'Computer', 30, '2023-12-14', 1),
(2, 'Chairs', 9, '2023-12-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `log_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `log_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`log_id`, `username`, `password`, `role`, `log_status`) VALUES
(1, 'admin', 'admin', 'Admin', 1),
(2, 'fud/001', 'fud/001', '4', 1),
(3, 'fud/002', 'fud/002', '3', 1),
(4, 'fud/003', 'fud/003', '4', 1),
(5, 'fud/004', 'fud/004', '1', 1),
(6, 'fud/005', 'fud/005', '5', 1),
(7, 'fud/006', 'fud/006', '7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `post_id` int(11) NOT NULL,
  `post_name` varchar(20) NOT NULL,
  `post_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`post_id`, `post_name`, `post_status`) VALUES
(1, 'Dean', 1),
(3, 'Vice chancellor', 1),
(4, 'Head of department', 1),
(5, 'Bursary', 1),
(7, 'Store Keeper', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `emp_num` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `request_date` varchar(20) NOT NULL,
  `collection_date` varchar(20) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `fact_id` int(11) NOT NULL,
  `request_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `item_id`, `emp_num`, `qty`, `request_date`, `collection_date`, `dept_id`, `fact_id`, `request_status`) VALUES
(1, 2, 'fud/001', 6, '20-12-2023', '23-12-2023', 1, 1, 5),
(2, 1, 'fud/003', 4, '23-12-2023', '', 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `pnum` varchar(11) NOT NULL,
  `email` text NOT NULL,
  `emp_num` varchar(20) NOT NULL,
  `post_id` int(11) NOT NULL,
  `fact_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `full_name`, `gender`, `pnum`, `email`, `emp_num`, `post_id`, `fact_id`, `dept_id`, `status`) VALUES
(2, 'Ameh Joseph Onyeke', 'Male', '08131294018', 'josephameh41@gmail.com', 'fud/001', 4, 1, 1, 1),
(3, 'Mercy Michael', 'Female', '09011111111', 'mercy@gmail.com', 'fud/002', 3, 0, 0, 1),
(4, 'Peter Ona', 'Male', '09022222222', 'peter@gmail.com', 'fud/003', 4, 1, 4, 1),
(5, 'Elizabeth Ameh', 'Female', '08130728532', 'lizzy@gmail.com', 'fud/004', 1, 1, 0, 1),
(6, 'Clemen', 'Male', '07011111111', 'clement@gmail.com', 'fud/005', 5, 0, 0, 1),
(7, 'Endurance Kayode', 'Female', '07011111111', 'end@gmail.com', 'fud/006', 7, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fact_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
