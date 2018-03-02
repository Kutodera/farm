-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2018 at 08:58 AM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `farmer`
--

-- --------------------------------------------------------

--
-- Table structure for table `crop`
--

CREATE TABLE IF NOT EXISTS `crop` (
  `crop_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `altitude` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`crop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `crop`
--

INSERT INTO `crop` (`crop_id`, `name`, `altitude`, `method`, `time`) VALUES
(2, 'maize', '30c', 'crop rotation', 'jan - may'),
(3, 'Wheat', '40c', 'Division', 'feb - jun'),
(4, ' Barley', '25c', 'Micropropagation', 'Mar - Sep');

-- --------------------------------------------------------

--
-- Table structure for table `crop_disease`
--

CREATE TABLE IF NOT EXISTS `crop_disease` (
  `dis_id` int(11) NOT NULL AUTO_INCREMENT,
  `crop_id` int(11) NOT NULL,
  `disease_name` varchar(50) NOT NULL,
  PRIMARY KEY (`dis_id`),
  KEY `crop_id` (`crop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `crop_disease`
--

INSERT INTO `crop_disease` (`dis_id`, `crop_id`, `disease_name`) VALUES
(2, 2, 'Testing');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
