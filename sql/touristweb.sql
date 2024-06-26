-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 12:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `touristweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(22) NOT NULL,
  `auname` varchar(50) NOT NULL,
  `apass` varchar(22) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `auname`, `apass`, `date`) VALUES
(1, 'admin', 'admin@123', '2024-06-11'),
(2, 'sid', '123', '2024-06-16'),
(3, 'rubby', '123', '2024-06-16'),
(5, 'suyash', 'sa', '2024-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `emp_id` int(22) NOT NULL,
  `emp_name` varchar(70) NOT NULL,
  `emp_email` varchar(70) NOT NULL,
  `emp_phone` varchar(10) NOT NULL,
  `emp_type` varchar(70) NOT NULL,
  `emp_age` varchar(2) NOT NULL,
  `emp_gender` varchar(22) NOT NULL,
  `emp_pass` varchar(250) NOT NULL,
  `emp_date` date NOT NULL DEFAULT current_timestamp(),
  `is_free` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`emp_id`, `emp_name`, `emp_email`, `emp_phone`, `emp_type`, `emp_age`, `emp_gender`, `emp_pass`, `emp_date`, `is_free`) VALUES
(5, 'Siddhesh More', 'siddeshmore145@gmail.com', '9527024172', 'Full-time', '17', 'Male', '$2y$10$mTlXkp8BkmKxSWC6dWnCjeNH4kL6HfZXhaLXiyy3lrEBKuLLkTHUu', '2024-06-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tour_assignments`
--

CREATE TABLE `tour_assignments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `tour_date` date DEFAULT NULL,
  `status` int(250) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_assignments`
--

INSERT INTO `tour_assignments` (`id`, `user_id`, `emp_id`, `tour_date`, `status`) VALUES
(3, 23, 5, '2024-06-28', 1),
(4, 23, 5, '2024-06-28', 1),
(5, 23, 5, '2024-06-28', 1),
(6, 10, 5, '2024-06-29', 1),
(7, 10, 5, '2024-06-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id` int(250) NOT NULL COMMENT 'id for users',
  `uname` varchar(250) NOT NULL COMMENT 'uname of  users',
  `uemail` varchar(250) NOT NULL COMMENT 'email of users',
  `pass` varchar(250) NOT NULL COMMENT 'pass of users',
  `register_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'create date of user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id`, `uname`, `uemail`, `pass`, `register_date`) VALUES
(10, 'siddhuu', 'sid@more.com', '123', '2024-06-09'),
(14, 'siddhesh', 'sid@in.co', '123', '2024-06-13'),
(16, 'sid', 'sid@more.coma', '123', '2024-06-13'),
(17, 'suyash', 'sid@more.cosasa', 'sa', '2024-06-16'),
(19, 'sid@m.ce', 'sid@m.c', '123', '2024-06-20'),
(21, 'Siddhesh More', 'siddeshmore145@gmaiil.', '123', '2024-06-25'),
(22, 'Siddhesh More', 'siddeshmore145@gmaiil.com', '123', '2024-06-25'),
(23, 'Rubby', 'rubby@com', '123', '2024-06-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `1` (`emp_email`);

--
-- Indexes for table `tour_assignments`
--
ALTER TABLE `tour_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uemail` (`uemail`),
  ADD UNIQUE KEY `uemail_2` (`uemail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `emp_id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tour_assignments`
--
ALTER TABLE `tour_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT COMMENT 'id for users', AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tour_assignments`
--
ALTER TABLE `tour_assignments`
  ADD CONSTRAINT `tour_assignments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tuser` (`id`),
  ADD CONSTRAINT `tour_assignments_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `emp` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
