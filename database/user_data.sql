-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 02:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE `login_info` (
  `reg_no` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `login_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`reg_no`, `username`, `login_timestamp`) VALUES
(NULL, 'admin', '2023-11-02 08:37:06'),
(NULL, 'admin', '2023-11-02 09:38:33'),
(NULL, 'admin', '2023-11-02 10:15:13'),
(NULL, 'admin', '2023-11-22 08:46:40'),
(NULL, 'admin', '2023-11-22 09:23:09'),
(NULL, 'admin', '2023-11-22 10:04:41'),
(NULL, 'admin', '2023-11-22 10:15:24'),
(NULL, 'admin', '2023-11-22 10:16:36'),
(NULL, 'admin', '2023-11-22 13:42:40'),
(NULL, 'admin', '2023-11-22 14:17:05'),
(NULL, 'admin', '2023-11-22 14:21:44'),
(NULL, 'admin', '2023-11-22 14:22:18'),
(NULL, 'admin', '2023-11-22 16:11:29'),
(NULL, 'admin', '2023-11-22 16:52:47'),
(NULL, 'admin', '2023-11-22 17:40:06'),
(NULL, 'admin', '2023-11-22 17:45:25'),
(NULL, 'admin', '2023-11-23 08:31:49'),
(NULL, 'admin', '2023-11-23 08:35:01'),
(NULL, 'admin', '2023-11-23 08:35:33'),
(NULL, 'admin', '2023-11-23 09:09:20'),
(NULL, 'admin', '2023-11-23 10:29:04'),
(NULL, 'admin', '2023-11-23 10:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `reg_no` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `balance` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`reg_no`, `name`, `balance`) VALUES
(1234, 'admin', 19552),
(12345, 'Kanishk', 100),
(51333, 'udfakvbkiudbv', 100),
(123456, 'Kanishk', 200),
(220901273, 'Gaurang Noob', 100),
(229310363, 'Swar', 100),
(229310409, 'Kanishk', 200),
(339213444, 'kuljeet', 20202);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `reg_no` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`reg_no`, `amount`, `time`) VALUES
(123456, 200, '2023-11-22 17:43:43'),
(1234, -50, '2023-11-22 17:44:35'),
(1234, -50, '2023-11-23 08:32:09'),
(1234, -50, '2023-11-23 09:09:30'),
(51333, 100, '2023-11-23 09:09:46'),
(1234, -50, '2023-11-23 10:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `reg_no` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'student',
  `Time of Registration` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`reg_no`, `name`, `email`, `username`, `password`, `user_type`, `Time of Registration`) VALUES
(1, 'admin', 'admin@jj.com', 'admin', '$2y$10$nxDcBOi4nP6DDHFQ6bkHAuLmqKn..ygcOTEKRk6sUFHfoDh/kHany', 'admin', '2023-11-02 08:17:39.996218');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_info`
--
ALTER TABLE `login_info`
  ADD KEY `reg_no` (`reg_no`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`reg_no`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `reg_no` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_info`
--
ALTER TABLE `login_info`
  ADD CONSTRAINT `login_info_ibfk_1` FOREIGN KEY (`reg_no`) REFERENCES `user_form` (`reg_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
