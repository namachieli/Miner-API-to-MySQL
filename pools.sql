-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2014 at 01:46 PM
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
-- Table structure for table `pools`
--

CREATE TABLE IF NOT EXISTS `pools` (
  `Hostname` varchar(30) NOT NULL,
  `When` datetime NOT NULL,
  `POOL` int(5) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Status` char(30) NOT NULL,
  `Priority` int(10) NOT NULL,
  `Quota` int(10) DEFAULT NULL,
  `LongPoll` char(5) NOT NULL,
  `GetWorks` int(30) NOT NULL,
  `Accepted` int(255) NOT NULL,
  `Rejected` int(255) NOT NULL,
  `Works` int(255) NOT NULL,
  `Discarded` int(255) NOT NULL,
  `Stale` int(255) NOT NULL,
  `GetFailures` int(255) NOT NULL,
  `RemoteFailures` int(255) NOT NULL,
  `User` varchar(255) NOT NULL,
  `LastShareTime` int(30) NOT NULL,
  `Diff1Shares` int(255) NOT NULL,
  `ProxyType` varchar(255) DEFAULT NULL,
  `Proxy` varchar(255) DEFAULT NULL,
  `DifficultyAccepted` decimal(65,8) NOT NULL,
  `DifficultyRejected` decimal(65,8) NOT NULL,
  `DifficultyStale` decimal(65,8) NOT NULL,
  `LastShareDifficulty` decimal(65,8) NOT NULL,
  `HasStratum` varchar(30) DEFAULT NULL,
  `StratumActive` varchar(30) DEFAULT NULL,
  `StratumURL` varchar(255) DEFAULT NULL,
  `HasGBT` varchar(30) NOT NULL,
  `BestShare` int(30) NOT NULL,
  `PoolRejected%` decimal(10,4) NOT NULL,
  `PoolStale%` decimal(10,4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
