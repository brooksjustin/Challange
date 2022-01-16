-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2022 at 06:16 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinsystdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(7) DEFAULT NULL,
  `nametitle` varchar(5) DEFAULT NULL,
  `namefirst` varchar(20) NOT NULL,
  `namelast` varchar(20) NOT NULL,
  `streetnumber` int(30) DEFAULT NULL,
  `streetname` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `latitude` varchar(40) DEFAULT NULL,
  `longitude` varchar(40) DEFAULT NULL,
  `timezoneoffset` varchar(6) DEFAULT NULL,
  `timezonedescription` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `dobdate` varchar(30) DEFAULT NULL,
  `dobage` int(11) DEFAULT NULL,
  `registereddate` varchar(30) DEFAULT NULL,
  `registeredage` int(11) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `cell` varchar(14) DEFAULT NULL,
  `picturelarge` varchar(60) DEFAULT NULL,
  `picturemedium` varchar(60) DEFAULT NULL,
  `picturethumbnail` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
