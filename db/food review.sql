-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2014 at 08:29 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `wangyiqidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `a6_Customer`
--

CREATE TABLE IF NOT EXISTS `a6_Customer` (
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `username` char(200) DEFAULT NULL,
  `password` char(200) DEFAULT NULL,
  `regi_date` date DEFAULT NULL,
  `firstname` char(200) DEFAULT NULL,
  `lastname` char(200) DEFAULT NULL,
  `middlename` char(200) DEFAULT NULL,
  `email` char(200) DEFAULT NULL,
  `cellphone1` char(200) DEFAULT NULL,
  `cellphone2` char(200) DEFAULT NULL,
  `address` text,
  `city` char(200) DEFAULT NULL,
  `state` char(200) DEFAULT NULL,
  `zipcode` char(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a6_Customer`
--

INSERT INTO `a6_Customer` (`customer_id`, `username`, `password`, `regi_date`, `firstname`, `lastname`, `middlename`, `email`, `cellphone1`, `cellphone2`, `address`, `city`, `state`, `zipcode`) VALUES
(1, 'comp', 'comp426', '2014-12-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `a6_Food`
--

CREATE TABLE IF NOT EXISTS `a6_Food` (
`food_id` int(11) NOT NULL,
  `food_name` char(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a6_Food`
--

INSERT INTO `a6_Food` (`food_id`, `food_name`) VALUES
(1, 'Crab Rangoon'),
(2, 'Crispy Noodle'),
(3, 'Orange Chicken'),
(4, 'Fried Chicken Wings'),
(5, 'Beef with Broccoli'),
(6, 'Pork Fried Rice');

-- --------------------------------------------------------

--
-- Table structure for table `a6_Food_Review`
--

CREATE TABLE IF NOT EXISTS `a6_Food_Review` (
`food_review_id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text,
  `email` char(200) DEFAULT NULL,
  `Reviewimage` char(200) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a6_Food_Review`
--

INSERT INTO `a6_Food_Review` (`food_review_id`, `menu_id`, `customer_id`, `rating`, `comment`, `email`, `Reviewimage`) VALUES
(1, 1, 1, 5, NULL, NULL, NULL),
(2, 2, 1, 4, NULL, NULL, NULL),
(3, 3, 1, 4, NULL, NULL, NULL),
(4, 4, 1, 2, NULL, NULL, NULL),
(5, 5, 1, 2, NULL, NULL, NULL),
(6, 0, 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a6_Customer`
--
ALTER TABLE `a6_Customer`
 ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `a6_Food`
--
ALTER TABLE `a6_Food`
 ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `a6_Food_Review`
--
ALTER TABLE `a6_Food_Review`
 ADD PRIMARY KEY (`food_review_id`), ADD KEY `fk_Food_Review` (`menu_id`), ADD KEY `fk_Food_Review1` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a6_Food`
--
ALTER TABLE `a6_Food`
MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `a6_Food_Review`
--
ALTER TABLE `a6_Food_Review`
MODIFY `food_review_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;