-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2012 at 05:00 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manila`
--
CREATE DATABASE `manila` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `manila`;

-- --------------------------------------------------------

--
-- Table structure for table `buildingtype`
--

CREATE TABLE IF NOT EXISTS `buildingtype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `buildingtype`
--


-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contact`
--


-- --------------------------------------------------------

--
-- Table structure for table `households`
--

CREATE TABLE IF NOT EXISTS `households` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district` int(11) NOT NULL,
  `date` date NOT NULL,
  `lat` decimal(8,6) NOT NULL,
  `lon` decimal(9,6) NOT NULL,
  `buildingtype_id` tinyint(10) NOT NULL,
  `stories` tinyint(10) NOT NULL,
  `raised` text NOT NULL,
  `HHLDsize` tinyint(4) NOT NULL,
  `age1` tinyint(4) NOT NULL,
  `age2` tinyint(4) NOT NULL,
  `age3` tinyint(4) NOT NULL,
  `age4` tinyint(4) NOT NULL,
  `age5` tinyint(4) NOT NULL,
  `females` tinyint(100) NOT NULL,
  `income` mediumint(9) unsigned NOT NULL,
  `prepare_id` tinyint(10) NOT NULL,
  `ngo_id` tinyint(100) NOT NULL,
  `contact_id` tinyint(10) NOT NULL,
  `HOHgender` text NOT NULL,
  `HOHage` tinyint(110) NOT NULL,
  `dependents` tinyint(100) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `raised` (`raised`,`HOHgender`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `households`
--


-- --------------------------------------------------------

--
-- Table structure for table `ngo`
--

CREATE TABLE IF NOT EXISTS `ngo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ngo`
--


-- --------------------------------------------------------

--
-- Table structure for table `prepare`
--

CREATE TABLE IF NOT EXISTS `prepare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `prepare`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `lname` text NOT NULL,
  `role` tinyint(10) NOT NULL,
  `email` text NOT NULL,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lname`, `role`, `email`, `password`) VALUES
(1, 'Kaarin', 'Hoff', 3, 'kaarin.hoff@gmail.com', 'superadmin'),
(3, 'Fname', 'Lname', 1, 'testemail', NULL),
(4, 'Olivia', 'Lau', 3, 'olau@umich.edu', 'si572');
