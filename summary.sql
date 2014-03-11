-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2014 at 02:15 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.21

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mining_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE IF NOT EXISTS `summary` (
  `Hostname` varchar(30) NOT NULL,
  `When` datetime NOT NULL,
  `Summary` varchar(30) NOT NULL,
  `Elapsed` time NOT NULL,
  `MHsAVG` decimal(10,2) NOT NULL,
  `MHs5s` decimal(10,2) NOT NULL,
  `FoundBlocks` int(30) NOT NULL,
  `GetWorks` int(255) NOT NULL,
  `Accepted` int(255) NOT NULL,
  `Rejected` int(255) NOT NULL,
  `HardwareErrors` int(255) NOT NULL,
  `Utility` decimal(10,2) NOT NULL,
  `Discarded` int(255) NOT NULL,
  `Stale` int(255) NOT NULL,
  `GetFailures` int(255) NOT NULL,
  `LocalWork` int(255) NOT NULL,
  `RemoteFailures` int(255) NOT NULL,
  `NetworkBlocks` int(255) NOT NULL,
  `TotalMH` decimal(65,4) NOT NULL,
  `WorkUtility` decimal(10,2) NOT NULL,
  `DifficultyAccepted` decimal(65,8) NOT NULL,
  `DifficultyRejected` decimal(65,8) NOT NULL,
  `DifficultyStale` decimal(65,8) NOT NULL,
  `BestShare` int(255) NOT NULL,
  `DeviceHardware%` decimal(10,4) NOT NULL,
  `DeviceRejected%` decimal(10,4) NOT NULL,
  `PoolRejected%` decimal(10,4) NOT NULL,
  `PoolStale%` decimal(10,4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
