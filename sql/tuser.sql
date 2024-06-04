-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 06:52 AM
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
-- Table structure for table `tuser`
--

CREATE TABLE `tuser` (
  `id` int(22) NOT NULL COMMENT 'id for users',
  `uname` varchar(22) NOT NULL COMMENT 'uname of  users',
  `uemail` varchar(22) NOT NULL COMMENT 'email of users',
  `pass` varchar(22) NOT NULL COMMENT 'pass of users',
  `register_date` date NOT NULL DEFAULT current_timestamp() COMMENT 'create date of user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`id`, `uname`, `uemail`, `pass`, `register_date`) VALUES
(1, 'siddhesh', 'emaiil@d.co', '12345', '2024-06-04'),
(2, 'sas', 'sas@d', 'sas', '2024-06-04'),
(3, 'sasd', 'dssssssssss@gmain.com', 'saAS', '2024-06-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT COMMENT 'id for users', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
