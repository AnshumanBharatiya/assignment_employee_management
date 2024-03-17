-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 08:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL COMMENT '1 : active, 0 : inactive',
  `role` varchar(20) NOT NULL,
  `join_date` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `full_name`, `username`, `email`, `password`, `status`, `role`, `join_date`, `last_login`) VALUES
(1, 'Aditya Sahoo', 'aditya001', 'aditya10@gmail.com', '$2y$10$rygkOq1X2ld874a3vjQ2J.e0s1MaulAF7QXkQqrTp95p8p61p.I.e', '1', 'admin', '2024-03-16 21:41:19', '2024-03-18 00:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_task_tbl`
--

CREATE TABLE `user_task_tbl` (
  `task_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `notes` text NOT NULL,
  `description` text NOT NULL,
  `start_time` datetime NOT NULL,
  `stop_time` datetime NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_task_tbl`
--

INSERT INTO `user_task_tbl` (`task_id`, `user_id`, `notes`, `description`, `start_time`, `stop_time`, `entry_date`, `update_date`) VALUES
(1, '5', 'Testing the app', 'Testing the app', '2023-12-07 09:44:00', '2024-03-17 21:44:00', '2024-03-17 16:14:36', '2024-03-17 16:14:36'),
(2, '5', 'Testing 3', 'Testing 3', '2024-03-01 09:45:00', '2024-03-15 00:45:00', '2024-03-17 16:17:40', '2024-03-17 16:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `new_user_status` varchar(10) DEFAULT NULL COMMENT 'if the user created by admin the status should be 1 other wise null or empty',
  `last_password_change` timestamp NULL DEFAULT NULL,
  `entrydate` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `password`, `new_user_status`, `last_password_change`, `entrydate`, `last_login`) VALUES
(4, 'Anshuman', 'Bharatiya', 'bharatiyaa101@gmail.com', '07077514451', '$2y$10$JvK/XnPFJRPytwd0cXzOn.gv31xzKuVH5sa8iGqs1RDeMIpOJ5J92', '0', '2024-03-17 19:07:25', '2024-03-16 18:21:42', '2024-03-17 19:07:25'),
(5, 'Roshan', 'Kumar', 'kumar123@gmail.com', '9098763421', '$2y$10$tR4mszM.dp9CT0c9rvlSruOZTW6UjlVAf/62e8jOJIZ.0Xbt78c3u', '1', '2024-03-17 16:12:30', '2024-03-17 16:12:30', '2024-03-17 16:14:06'),
(6, 'sudhansu', 'mishra', 'mishra@example.com', '7077514451', '$2y$10$DV1D74uDK57cmnRDA/Nt9uReMOwhtAnhwIXEFluNMMh3urgGvlwLG', '1', '2024-03-17 17:56:52', '2024-03-17 17:56:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_task_tbl`
--
ALTER TABLE `user_task_tbl`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_task_tbl`
--
ALTER TABLE `user_task_tbl`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
