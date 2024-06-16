-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 08:18 PM
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
(5, 'suyash', 'sa', '2024-06-16'),
(6, 'hello world', '123', '2024-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id` int(22) NOT NULL COMMENT 'id for users',
  `uname` varchar(22) NOT NULL COMMENT 'uname of  users',
  `uemail` varchar(22) NOT NULL COMMENT 'email of users',
  `pass` varchar(22) NOT NULL COMMENT 'pass of users',
  `register_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'create date of user',
  `block_unblock` int(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id`, `uname`, `uemail`, `pass`, `register_date`, `block_unblock`) VALUES
(10, 'siddhuu', 'sid@more.com', '123', '2024-06-09', 0),
(13, 'hello', 'dssssssssss@gmain.com', '123', '2024-06-13', 0),
(14, 'siddhesh', 'sid@in.co', '123', '2024-06-13', 0),
(16, 'sid', 'sid@more.coma', '123', '2024-06-13', 0),
(17, 'suyash', 'sid@more.cosasa', 'sa', '2024-06-16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT COMMENT 'id for users', AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
