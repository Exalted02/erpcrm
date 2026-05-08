-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 10:53 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `state_code`) VALUES
(1, 'ANDAMAN AND NICOBAR ISLANDS', 35),
(2, 'ANDHRA PRADESH', 28),
(3, 'ARUNACHAL PRADESH', 12),
(4, 'ASSAM', 18),
(5, 'BIHAR', 10),
(6, 'CHANDIGARH', 4),
(7, 'CHHATTISGARH', 22),
(8, 'DADRA AND NAGAR HAVELI', 26),
(9, 'DAMAN AND DIU', 25),
(10, 'DELHI', 7),
(11, 'GOA', 30),
(12, 'GUJARAT', 24),
(13, 'HARYANA', 6),
(14, 'HIMACHAL PRADESH', 2),
(15, 'JAMMU AND KASHMIR', 1),
(16, 'JHARKHAND', 20),
(17, 'KARNATAKA', 29),
(18, 'KERALA', 32),
(19, 'LADAKH', 37),
(20, 'LAKSHADWEEP', 31),
(21, 'MADHYA PRADESH', 23),
(22, 'MAHARASHTRA', 27),
(23, 'MANIPUR', 14),
(24, 'MEGHALAYA', 17),
(25, 'MIZORAM', 15),
(26, 'NAGALAND', 13),
(27, 'ODISHA', 21),
(28, 'PUDUCHERRY', 34),
(29, 'PUNJAB', 3),
(30, 'RAJASTHAN', 8),
(31, 'SIKKIM', 11),
(32, 'TAMIL NADU', 33),
(33, 'TELANGANA', 36),
(34, 'TRIPURA', 16),
(35, 'UTTARAKHAND', 5),
(36, 'UTTAR PRADESH', 9),
(37, 'WEST BENGAL', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
