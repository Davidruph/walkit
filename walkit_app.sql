-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 25, 2023 at 08:27 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `walkit_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `names` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `other_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`other_details`)),
  `role` varchar(50) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `names`, `password`, `email`, `other_details`, `role`, `registered_on`) VALUES
(1, 'David junior', '$2y$10$e4pTRoSzOjSdKA9/qUmlXuN67MvsXzGK6O/v3xCyU76T.cpfY1LAC', 'jun@gmail.com', NULL, 'admin', '2021-09-18 17:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `data_accumulator`
--

CREATE TABLE `data_accumulator` (
  `id` int(11) NOT NULL,
  `company_user_id` varchar(10) NOT NULL,
  `user_home_address` text NOT NULL,
  `ref` varchar(200) NOT NULL,
  `km_saved` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `device` varchar(200) NOT NULL,
  `os` varchar(200) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `submitted_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblmail`
--

CREATE TABLE `tblmail` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmail`
--

INSERT INTO `tblmail` (`id`, `email`, `name`, `message`, `PostingDate`) VALUES
(1, 'test@gmail.com', 'David Junior', 'an email from homepage contact form', '2021-01-22 23:00:18'),
(2, 'dave@gmail.com', 'david Manny', 'i will like a tutorial on how to make pastery', '2021-01-22 23:03:54'),
(3, 'dave@gmail.com', 'david Manny', 'i will like a tutorial on how to make pastery', '2021-01-22 23:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `names` varchar(255) NOT NULL,
  `country` varchar(200) DEFAULT NULL,
  `mobile_code` varchar(11) DEFAULT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `url` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `names`, `country`, `mobile_code`, `mobile_no`, `email`, `company_name`, `logo`, `address`, `role`, `url`, `password`, `registered_on`) VALUES
(1, 'David junior', 'Australia', NULL, '61984747484', 'jun@gmail.com', NULL, NULL, NULL, 'admin', NULL, '$2y$10$SUrPkRtjegADhkbmL0I0ye8wo35BmyF3uPu5c38JuPlgr4Ou.c94W', '2021-09-19 20:05:59'),
(3, 'David', 'Nigeria', '234', '0903334355', 'sun@gmail.com', 'jjjj.kj.osddd', '', 'kingstown estate', 'admin', NULL, '$2y$10$JP/ZUaYRWxUUrTlMxxzDc.wa6oAasIuotQNbMQFDriKDTJvsst/Qy', '2021-09-19 18:26:33'),
(4, 'retrtet', NULL, NULL, NULL, 'bam@gmail.com', NULL, NULL, NULL, 'super_admin', NULL, '$2y$10$5n4XVLXOvyAC7aMIgd5gT.sw5rdSnmw4gkyhG.qgcIBOW/qyvrsIC', '2021-09-20 08:49:00'),
(5, 'David Manny', 'Nigeria', '+234', '90336446763', 'customer@botble.com', NULL, NULL, NULL, 'admin', NULL, '$2y$10$IRFfji4MZ7nOe8UXMP3fE.m8k6eVcs.B0pxDXkQ3gk.ZWyqnkN8/m', '2023-06-24 00:00:12'),
(6, 'David Manny', 'Nigeria', '+234', '90336446763', 'jun2@gmail.com', NULL, NULL, NULL, 'admin', NULL, '$2y$10$Af..gddypNHgopbtTjswqumTJqzxkzIK/Rn4rUa9034bpFKqI/3Si', '2023-06-25 07:26:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `data_accumulator`
--
ALTER TABLE `data_accumulator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmail`
--
ALTER TABLE `tblmail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_accumulator`
--
ALTER TABLE `data_accumulator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmail`
--
ALTER TABLE `tblmail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
