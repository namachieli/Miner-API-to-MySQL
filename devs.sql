-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2014 at 10:25 PM
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
-- Table structure for table `devs`
--

CREATE TABLE IF NOT EXISTS `devs` (
  `Hostname` varchar(30) NOT NULL,
  `When` datetime NOT NULL,
  `GPU` smallint(1) NOT NULL,
  `Enabled` char(1) NOT NULL,
  `Status` char(30) NOT NULL,
  `TemperatureC` int(10) NOT NULL,
  `FanSpeed` int(10) NOT NULL,
  `FanPercent` int(3) NOT NULL,
  `GPUClock` int(10) NOT NULL,
  `MemClock` int(10) NOT NULL,
  `Voltage` decimal(10,3) NOT NULL,
  `Activity` int(3) NOT NULL,
  `Powertune` int(2) NOT NULL,
  `MHsAVG` decimal(10,2) NOT NULL,
  `MHs5s` decimal(10,2) NOT NULL,
  `Accepted` int(255) NOT NULL,
  `Rejected` int(255) NOT NULL,
  `HWErrors` int(255) NOT NULL,
  `Utility` decimal(10,2) NOT NULL,
  `Intensity` int(10) NOT NULL,
  `LastSharePool` int(255) NOT NULL,
  `LastShareTime` int(30) NOT NULL,
  `TotalMH` decimal(50,4) NOT NULL,
  `Diff1Work` int(255) NOT NULL,
  `DifficultyAccepted` decimal(65,8) NOT NULL,
  `DifficultyRejected` decimal(65,8) NOT NULL,
  `LastShareDifficulty` decimal(65,8) NOT NULL,
  `LastValidWorkTime` int(30) NOT NULL,
  `DeviceHW%` decimal(10,4) NOT NULL,
  `DeviceRejected%` decimal(10,4) NOT NULL,
  `DeviceElapsedTime` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
