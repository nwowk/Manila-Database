
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `manila`
--
DROP DATABASE IF EXISTS manila;

CREATE DATABASE `manila` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `manila`;

GRANT ALL ON manila.* TO 'gisis'@'localhost' IDENTIFIED BY 'cool';

CREATE TABLE IF NOT EXISTS `buildingtype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `households` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district` int(11) NOT NULL,
  `date` date NOT NULL,
  `lat` decimal(8,6) NOT NULL,
  `lon` decimal(9,6) NOT NULL,
  `buildingtype_id` tinyint(10) NOT NULL,
  `stories` tinyint(10) NOT NULL,
  `raised_id` tinyint(10) NOT NULL,
  `roof_id` tinyint(10) NOT NULL,
  `HHLDsize` tinyint(4) NOT NULL,
  `young` tinyint(4) NOT NULL,
  `old` tinyint(4) NOT NULL,
  `dependents` tinyint(100) NOT NULL,
  `income_id` mediumint(9) unsigned NOT NULL,
  `disaster` tinyint(10) NOT NULL,
  `waste_id` tinyint(10) NOT NULL,
  `water_id` tinyint(10) NOT NULL,
  `contact_id` tinyint(10) NOT NULL,
  `HOHgender` text NOT NULL,
  `HOHage` tinyint(110) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `raised` (`raised`,`HOHgender`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

CREATE TABLE IF NOT EXISTS `raised` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `roof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `waste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `water` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `lname` text NOT NULL,
  `role` tinyint(10) NOT NULL,
  `email` text NOT NULL,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `users` (`id`, `name`, `lname`, `role`, `email`, `password`) VALUES
(1, 'Kaarin', 'Hoff', 3, 'kaarin.hoff@gmail.com', 'superadmin'),
(3, 'Fname', 'Lname', 1, 'testemail', NULL),
(4, 'Olivia', 'Lau', 3, 'olau@umich.edu', 'si572');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


