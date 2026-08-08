-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 08, 2026 at 01:03 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

DROP TABLE IF EXISTS `admin_accounts`;
CREATE TABLE IF NOT EXISTS `admin_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `series_id` varchar(60) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `admin_type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `user_name`, `password`, `series_id`, `remember_token`, `expires`, `admin_type`) VALUES
(4, 'superadmin', '$2y$10$eo7.w0Ttuy8mOBMvDlGqDeewQERkXu//7qO3jXp5NC76LwfAZpNrO', 'rvuWJHMd5LTxLC2J', '$2y$10$LDUi4w/UAM2PgfMoKkLo4.igJX39G5/WQOEDHRaDy3y2KZeIxXggm', '2019-02-16 22:39:57', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Car'),
(2, 'SUV'),
(3, 'Pickup Truck'),
(4, 'Microbus'),
(6, 'Van'),
(7, 'Motorcycle'),
(8, 'Custom'),
(9, 'Scooter'),
(10, 'Electric Vehicle (EV)'),
(11, 'Sports Car'),
(12, 'Motorcycle'),
(13, 'Tractor'),
(14, 'Classic / Vintage Car'),
(15, 'CNG / Auto Rickshaw'),
(16, 'Off-Road Vehicle'),
(17, 'Under Construction');

-- --------------------------------------------------------

--
-- Table structure for table `password_generator`
--

DROP TABLE IF EXISTS `password_generator`;
CREATE TABLE IF NOT EXISTS `password_generator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_generator`
--

INSERT INTO `password_generator` (`id`, `user_id`, `password`, `status`) VALUES
(23, '', 'vote520811', '0'),
(22, '', 'vote460848', '0'),
(21, '', 'vote420839', '0'),
(20, '', 'vote250810', '0');

-- --------------------------------------------------------

--
-- Table structure for table `password_used`
--

DROP TABLE IF EXISTS `password_used`;
CREATE TABLE IF NOT EXISTS `password_used` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `voted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_used`
--

INSERT INTO `password_used` (`id`, `vehicle_id`, `password`, `voted_at`) VALUES
(1, '9', 'vote040716', '2024-02-07 18:30:29'),
(2, '11', 'vote131229', '2026-07-30 13:51:40'),
(3, '12', 'vote113027', '2026-07-30 14:14:35'),
(4, '12', 'vote020737', '2026-07-30 14:14:44'),
(5, '12', 'vote030703', '2026-07-30 14:14:56'),
(6, '13', 'vote131229', '2026-07-30 14:19:10'),
(7, '13', 'vote131223', '2026-07-30 14:20:13'),
(8, '13', 'vote131219', '2026-07-30 14:20:21'),
(9, '13', 'vote040716', '2026-07-30 14:21:04'),
(10, '15', 'vote460848', '2026-08-08 10:49:15'),
(11, '15', 'vote250810', '2026-08-08 10:49:36'),
(12, '15', 'vote520811', '2026-08-08 11:04:29'),
(13, '15', 'vote520811', '2026-08-08 11:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`) VALUES
(1, 'logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vehicle_maker` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vehicle_model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vehicle_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `vote_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `checkbox` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qrcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `address`, `phone`, `vehicle_maker`, `vehicle_model`, `vehicle_year`, `vote_status`, `category`, `checkbox`, `qrcode`, `created_date`) VALUES
(15, 'Pritom', 'Dhaka Khilkhat Bottola', '01889231992', 'Toyota', 'Cross', '2023', '4', 'Car', 'yes', '1786184880.png', '2026-08-08 10:28:00');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE IF NOT EXISTS `vote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`id`, `vehicle_id`, `password`) VALUES
(1, '4', 'ddddd'),
(2, '4', '9581'),
(3, '4', 'd18a'),
(4, '4', '04a5'),
(5, '4', '8c5b'),
(6, '4', '4sdf'),
(7, '4', 'sdfsdf'),
(8, '4', 'aaaa'),
(9, '6', 'e715'),
(10, '7', '0af2'),
(11, '7', '0af2'),
(12, '7', '0af2'),
(13, '4', 'e831'),
(14, '9', 'vote040716'),
(15, '11', 'vote131229'),
(16, '12', 'vote113027'),
(17, '12', 'vote020737'),
(18, '12', 'vote030703'),
(19, '13', 'vote131229'),
(20, '13', 'vote131223'),
(21, '13', 'vote131219'),
(22, '13', 'vote040716'),
(23, '15', 'vote460848'),
(24, '15', 'vote250810'),
(25, '15', 'vote520811'),
(26, '15', 'vote520811');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
