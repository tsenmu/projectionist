-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2014 at 06:24 AM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projectionist`
--

-- --------------------------------------------------------

--
-- Table structure for table `chains`
--

CREATE TABLE IF NOT EXISTS `chains` (
  `chain_id` int(11) NOT NULL AUTO_INCREMENT,
  `chain_name` text NOT NULL,
  `chain_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`chain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `chains`
--

INSERT INTO `chains` (`chain_id`, `chain_name`, `chain_available`) VALUES
(1, 'ä¸‡è¾¾é™¢çº¿', 1),
(2, 'ä¿åˆ©é™¢çº¿', 1),
(3, 'å›½å®¶å¹¿ç”µæ€»å±€', 1);

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `film_id` int(11) NOT NULL AUTO_INCREMENT,
  `film_userdefine_id` int(11) NOT NULL,
  `film_name` text NOT NULL,
  `film_path` text NOT NULL,
  `chain_id` int(11) NOT NULL,
  `film_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`film_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`film_id`, `film_userdefine_id`, `film_name`, `film_path`, `chain_id`, `film_available`) VALUES
(1, 1, 'å¤§è„‘å¤©å®«', 'ä¸çŸ¥é“', 1, 1),
(2, 2, 'æ˜¯ä¸‡ä¸ªä¸ºä»€ä¹ˆ', 'ä¸çŸ¥é“', 1, 1),
(3, 21, 'æˆ‘æ˜¯è°', 'ä¸çŸ¥é“', 1, 1),
(4, 21, 'æˆ‘æ˜¯è°', 'ä¸çŸ¥é“', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `record_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `chain_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `location` text NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`record_id`, `user_id`, `film_id`, `chain_id`, `date_time`, `location`) VALUES
(1, 16, 4, 3, '2014-04-03 07:35:00', 'æŸæŸåœ°æ–¹'),
(2, 18, 3, 1, '2014-04-03 07:35:00', 'æŸæŸåœ°æ–¹ä¸€äºŒä¸‰');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` text NOT NULL,
  `user_password` text NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_type`, `user_available`) VALUES
(8, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 1),
(14, 'æŸåŽ¿', '2195eeff4e5020387865caf0dfe6eef6', 1, 1),
(15, 'æŸæŸåŽ¿', 'ee254ba2c7d0f59b188328886ea7f1bf', 1, 1),
(16, 'æ”¾æ˜ å‘˜', '749bc4facdefd1ffcec60c179ba4d25c', 2, 1),
(17, 'æ”¾æ˜ å‘˜-1', '749bc4facdefd1ffcec60c179ba4d25c', 1, 0),
(18, 'æ”¾æ˜ å‘˜-2', '749bc4facdefd1ffcec60c179ba4d25c', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_tree`
--

CREATE TABLE IF NOT EXISTS `user_tree` (
  `parent_user_id` int(11) NOT NULL,
  `child_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_tree`
--

INSERT INTO `user_tree` (`parent_user_id`, `child_user_id`) VALUES
(8, 14),
(8, 15),
(15, 16),
(8, 17),
(15, 18);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
