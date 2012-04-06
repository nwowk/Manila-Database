
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `manila`
--
DROP DATABASE IF EXISTS manila;

CREATE DATABASE `manila` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `manila`;

GRANT ALL ON manila.* TO 'gisis'@'localhost' IDENTIFIED BY 'cool';
--
-- Table structure for table `buildingtype`
--

CREATE TABLE IF NOT EXISTS `buildingtype` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `buildingtype`
--

INSERT INTO `buildingtype` (`id`, `value`) VALUES
(1, 'Light materials'),
(2, 'Semi-concrete'),
(3, 'All concrete');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `value`) VALUES
(1, 'sms/text'),
(2, 'email/facebook'),
(3, 'radio'),
(4, 'TV');

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
  `raised_id` tinyint(10) NOT NULL,
  `roof_id` tinyint(10) NOT NULL,
  `HHLDsize` tinyint(4) NOT NULL,
  `young` tinyint(4) NOT NULL,
  `old` tinyint(4) NOT NULL,
  `dependents` tinyint(100) NOT NULL,
  `income_id` mediumint(9) unsigned NOT NULL,
  `evacuation` tinyint(10) NOT NULL,
  `training` tinyint(10) NOT NULL,
  `waste_id` tinyint(10) NOT NULL,
  `water_id` tinyint(10) NOT NULL,
  `contact_id` tinyint(10) NOT NULL,
  `HOHgender` tinyint(10) NOT NULL,
  `HOHage` tinyint(110) NOT NULL,
  `users_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `households`
--

INSERT INTO `households` (`id`, `district`, `date`, `lat`, `lon`, `buildingtype_id`, `stories`, `raised_id`, `roof_id`, `HHLDsize`, `young`, `old`, `dependents`, `income_id`, `evacuation`, `training`, `waste_id`, `water_id`, `contact_id`, `HOHgender`, `HOHage`, `users_id`, `project_id`) VALUES
(1, 3050, '0000-00-00', 0.000000, 0.000000, 1, 2, 1, 1, 6, 2, 1, 0, 2, 1, 1, 1, 1, 1, 1, 31, 0, 2),
(2, 3050, '0000-00-00', 0.000000, 0.000000, 1, 2, 0, 1, 5, 2, 1, 1, 2, 1, 1, 3, 3, 3, 0, 46, 0, 2),
(3, 3050, '0000-00-00', 0.000000, 0.000000, 2, 2, 0, 1, 4, 2, 1, 1, 2, 1, 1, 2, 2, 3, 0, 39, 0, 2),
(4, 22, '2012-03-24', 0.000000, 0.000000, 1, 3, 2, 4, 29, 12, 15, 6, 5, 0, 1, 3, 3, 3, 0, 48, 0, 19),
(5, 22, '2012-03-24', 0.000000, 0.000000, 2, 5, 4, 2, 69, 19, 39, 28, 5, 1, 1, 3, 3, 1, 0, 65, 0, 19),
(6, 48, '2012-03-24', 0.000000, 0.000000, 2, 3, 6, 2, 46, 18, 12, 10, 5, 1, 1, 4, 1, 3, 0, 64, 0, 3),
(7, 42, '2012-03-24', 0.000000, 0.000000, 1, 5, 6, 2, 46, 24, 12, 8, 5, 0, 0, 2, 2, 3, 0, 46, 0, 10),
(8, 65, '2012-03-24', 0.000000, 0.000000, 1, 54, 2, 4, 44, 12, 12, 12, 1, 1, 1, 1, 1, 1, 0, 44, 0, 9),
(9, 65, '2012-03-24', 0.000000, 0.000000, 1, 6, 0, 2, 55, 12, 12, 12, 1, 1, 0, 3, 2, 1, 0, 55, 0, 9),
(10, 65, '2012-03-24', 0.000000, 0.000000, 1, 5, 1, 2, 34, 12, 12, 12, 1, 0, 0, 2, 2, 1, 1, 51, 0, 9),
(11, 65, '2012-03-24', 0.000000, 0.000000, 1, 1, 0, 2, 4, 1, 0, 0, 1, 0, 1, 4, 4, 1, 0, 31, 0, 9),
(12, 42, '2012-03-25', 0.000000, 0.000000, 2, 36, 5, 3, 13, 2, 4, 2, 4, 0, 0, 3, 5, 1, 1, 42, 0, 10),
(13, 34, '2012-03-27', 0.000000, 0.000000, 1, 23, 2, 3, 32, 12, 5, 4, 3, 0, 1, 3, 2, 2, 0, 35, 0, 6),
(14, 65, '2012-03-27', 0.000000, 0.000000, 1, 23, 6, 4, 54, 54, 2, 1, 5, 0, 0, 4, 2, 4, 0, 43, 0, 14),
(15, 34, '2012-03-27', 0.000000, 0.000000, 2, 41, 1, 3, 14, 3, 4, 2, 5, 0, 0, 2, 4, 2, 1, 21, 0, 6),
(16, 3050, '2012-03-27', 0.000000, 0.000000, 1, 23, 1, 4, 32, 12, 9, 4, 5, 1, 0, 3, 3, 3, 1, 42, 0, 2),
(17, 34, '2012-03-27', 0.000000, 0.000000, 3, 32, 2, 2, 8, 2, 2, 1, 3, 1, 1, 2, 1, 1, 1, 31, 0, 6),
(18, 22, '2012-03-27', 0.000000, 0.000000, 1, 1, 3, 4, 6, 2, 0, 0, 1, 0, 1, 2, 1, 3, 1, 23, 0, 5),
(19, 22, '2012-03-27', 0.000000, 0.000000, 2, 2, 5, 2, 6, 1, 0, 1, 3, 1, 1, 4, 3, 1, 0, 42, 0, 5),
(20, 22, '2012-03-27', 0.000000, 0.000000, 3, 0, 2, 4, 2, 0, 0, 0, 5, 0, 0, 2, 3, 2, 1, 21, 0, 5),
(21, 22, '2012-03-27', 0.000000, 0.000000, 1, 2, 6, 3, 5, 2, 1, 1, 3, 1, 1, 1, 1, 2, 0, 34, 0, 5),
(22, 22, '2012-03-27', 0.000000, 0.000000, 2, 0, 5, 2, 3, 1, 0, 0, 1, 0, 1, 1, 4, 2, 0, 19, 0, 5),
(23, 22, '2012-03-27', 0.000000, 0.000000, 2, 1, 3, 1, 3, 1, 0, 0, 2, 1, 0, 3, 4, 3, 1, 19, 0, 7),
(24, 22, '2012-03-27', 0.000000, 0.000000, 1, 3, 1, 1, 5, 2, 1, 1, 4, 1, 0, 2, 3, 2, 0, 44, 0, 7),
(25, 3050, '2012-03-27', 0.000000, 0.000000, 3, 2, 2, 2, 4, 2, 0, 0, 4, 0, 0, 4, 1, 1, 0, 36, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE IF NOT EXISTS `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `value`) VALUES
(1, 'under 2,000 pesos'),
(2, '2,001-3,000 pesos'),
(3, '3,001-5,000 pesos'),
(4, '5,001-10,000 pesos'),
(5, 'more than 10,000 pesos'),
(6, 'Don''t know or no answer');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `startdate`, `enddate`) VALUES
(1, 'Wall-E', 'Search for life', '2012-01-01', '2012-03-30'),
(2, 'Lumpia', 'Led by Inspector Gadget. New lumpia vendor changes profile of district', '2011-10-10', '2012-06-30'),
(3, 'Where in the World?', 'Searching for Carmen Sandiego and her villians', '2012-02-03', '0000-00-00'),
(4, 'Local feedback', 'Health evaluation led by Wall-E', '2012-02-01', '0000-00-00'),
(5, 'Housing', 'Building investigation. Led by Cookie Monster', '2011-11-30', '0000-00-00'),
(6, 'Santorum', 'voter fraud', '2011-10-10', '0000-00-00'),
(7, 'Moby Dick', 'Starbucks ', '2012-01-11', '0000-00-00'),
(8, 'Survivor', 'Manila style', '2012-01-04', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `raised`
--

CREATE TABLE IF NOT EXISTS `raised` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `raised`
--

INSERT INTO `raised` (`id`, `value`) VALUES
(1, 'No'),
(2, 'Yes, with a concrete slab'),
(3, 'Yes, with bamboo'),
(4, 'Yes, with wood'),
(5, 'Yes, with a steel platform'),
(6, 'Yes, with cinder blocks'),
(7, 'Yes, with something else not listed here');

-- --------------------------------------------------------

--
-- Table structure for table `roof`
--

CREATE TABLE IF NOT EXISTS `roof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roof`
--

INSERT INTO `roof` (`id`, `value`) VALUES
(1, 'Concrete'),
(2, 'Light materials'),
(3, 'Metal'),
(4, 'Mixed');

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
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lname`, `role`, `email`, `password`) VALUES
(1, 'Bob', 'Builder', 3, 'builder@umich.edu', '202cb962ac59075b964b07152d234b70');


-- --------------------------------------------------------

--
-- Table structure for table `waste`
--

CREATE TABLE IF NOT EXISTS `waste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `waste`
--

INSERT INTO `waste` (`id`, `value`) VALUES
(1, 'garbage collector'),
(2, 'burning'),
(3, 'dumping in a public place'),
(4, 'dumping in water or vicinity');

-- --------------------------------------------------------

--
-- Table structure for table `water`
--

CREATE TABLE IF NOT EXISTS `water` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `water`
--

INSERT INTO `water` (`id`, `value`) VALUES
(1, 'communal well'),
(2, 'private faucet'),
(3, 'river/stream'),
(4, 'communal water pipe'),
(5, 'private water seller'),
(6, 'other');

