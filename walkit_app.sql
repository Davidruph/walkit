-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2021 at 06:53 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

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

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `other_details` json DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `names`, `password`, `email`, `other_details`, `role`, `registered_on`) VALUES
(1, 'David junior', '$2y$10$e4pTRoSzOjSdKA9/qUmlXuN67MvsXzGK6O/v3xCyU76T.cpfY1LAC', 'jun@gmail.com', NULL, 'admin', '2021-09-18 17:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `tblmail`
--

DROP TABLE IF EXISTS `tblmail`;
CREATE TABLE IF NOT EXISTS `tblmail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `PostingDate` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(255) NOT NULL,
  `country` varchar(200) DEFAULT NULL,
  `mobile_code` varchar(11) DEFAULT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `names`, `country`, `mobile_code`, `mobile_no`, `email`, `company_name`, `logo`, `address`, `role`, `password`, `registered_on`) VALUES
(1, 'David junior', 'Australia', NULL, '61984747484', 'jun@gmail.com', NULL, NULL, NULL, 'admin', '$2y$10$SUrPkRtjegADhkbmL0I0ye8wo35BmyF3uPu5c38JuPlgr4Ou.c94W', '2021-09-19 20:05:59'),
(3, 'David', 'Nigeria', '234', '0903334355', 'sun@gmail.com', 'jjjj.kj.osddd', '', 'kingstown estate', 'admin', '$2y$10$JP/ZUaYRWxUUrTlMxxzDc.wa6oAasIuotQNbMQFDriKDTJvsst/Qy', '2021-09-19 18:26:33'),
(4, 'retrtet', NULL, NULL, NULL, 'bam@gmail.com', NULL, NULL, NULL, 'super_admin', '$2y$10$5n4XVLXOvyAC7aMIgd5gT.sw5rdSnmw4gkyhG.qgcIBOW/qyvrsIC', '2021-09-20 08:49:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
