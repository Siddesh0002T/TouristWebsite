-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 08:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--
INSERT INTO
  `admin` (`id`, `auname`, `apass`, `date`)
VALUES
  (1, 'admin', 'admin@123', '2024-06-11'),
  (2, 'sid', '123', '2024-06-16'),
  (3, 'rubby', '123', '2024-06-16'),
  (5, 'suyash', 'sa', '2024-06-16'),
  (6, 'hello world', '123', '2024-06-16');

--
-- Indexes for dumped tables
--
--
-- Indexes for table `admin`
--
ALTER TABLE
  `admin`
ADD
  PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE
  `admin`
MODIFY
  `id` int(22) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;