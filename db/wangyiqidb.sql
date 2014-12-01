-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2014 at 11:28 PM
-- Server version: 5.6.21
-- PHP Version: 5.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wangyiqidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `a6_Admin`
--

CREATE TABLE IF NOT EXISTS `a6_Admin` (
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `admin_name` char(200) DEFAULT NULL,
  `password` char(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a6_Category`
--

CREATE TABLE IF NOT EXISTS `a6_Category` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `category_name` char(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a6_Customer`
--

CREATE TABLE IF NOT EXISTS `a6_Customer` (
  `customer_id` int(7) NOT NULL DEFAULT '0',
  `username` char(200) DEFAULT NULL,
  `password` char(200) DEFAULT NULL,
  `regi_date` date DEFAULT NULL,
  `firstname` char(200) DEFAULT NULL,
  `lastname` char(200) DEFAULT NULL,
  `middlename` char(200) DEFAULT NULL,
  `email` char(200) DEFAULT NULL,
  `cellphone1` char(200) DEFAULT NULL,
  `cellphone2` char(200) DEFAULT NULL,
  `addr_l1` text,
  `addr_l2` text,
  `city` char(200) DEFAULT NULL,
  `state` char(200) DEFAULT NULL,
  `zipcode` char(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a6_Customer`
--

INSERT INTO `a6_Customer` (`customer_id`, `username`, `password`, `regi_date`, `firstname`, `lastname`, `middlename`, `email`, `cellphone1`, `cellphone2`, `addr_l1`, `addr_l2`, `city`, `state`, `zipcode`) VALUES
(1, 'comp', 'comp426', '2014-12-01', '17', 'Wang', '', '', '3128104716', '', '300 NC 54', 'Apt 8G', 'Chapel Hill', 'Hawaii', '27510');

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
-- Table structure for table `a6_Food_Category`
--

CREATE TABLE IF NOT EXISTS `a6_Food_Category` (
  `food_category_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `title` char(200) DEFAULT NULL,
  `reviewimage` char(200) DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a6_Food_Review`
--

INSERT INTO `a6_Food_Review` (`food_review_id`, `menu_id`, `customer_id`, `rating`, `comment`, `title`, `reviewimage`, `comment_date`) VALUES
(1, 1, 1, 5, 'I like it!', 'Good restaurant!', NULL, '2014-11-12 00:00:00'),
(2, 2, 1, 4, 'A little expensive!', 'A little expensive!', NULL, '2012-08-13 00:00:00'),
(3, 3, 1, 4, NULL, NULL, NULL, '0000-00-00 00:00:00'),
(4, 4, 1, 2, NULL, NULL, NULL, '0000-00-00 00:00:00'),
(5, 5, 1, 2, NULL, NULL, NULL, '0000-00-00 00:00:00'),
(6, 1, 5, 5, 'Food is good.', 'Good experience', NULL, '0000-00-00 00:00:00'),
(7, 3, 2, 5, 'Good', 'Best', NULL, '2014-11-19 00:00:00'),
(8, 4, 1, 4, 'bad comment', 'bad title', NULL, NULL),
(9, 2, 1, 3, 'normal comment', 'normoal title', NULL, NULL),
(10, 1, 0, 4, 'Been going to Dr. Goldberg for over 10 years. I think I was one of his 1st patients when he started at MHMG. He''s been great over the years and is really all about the big picture. It is because of him, not my now former gyn Dr. Markoff, that I found out I have fibroids. He explores all options with you and is very patient and understanding. He doesn''t judge and asks all the right questions. Very thorough and wants to be kept in the loop on every aspect of your medical health and your life.', 'Worth', NULL, '2013-12-08 00:00:00'),
(11, 1, 0, 4, 'dr. goldberg offers everything i look for in a general practitioner.  he''s nice and easy to talk to without being patronizing; he''s always on time in seeing his patients; he''s affiliated with a top-notch hospital (nyu) which my parents have explained to me is very important in case something happens and you need surgery; and you can get referrals to see specialists without having to see him first.  really, what more do you need?  i''m sitting here trying to think of any complaints i have about him, but i''m really drawing a blank.', 'Good', NULL, '2014-12-15 00:00:00'),
(12, 1, 0, 5, 'I love the food', 'Nice', NULL, '2014-04-14 00:00:00'),
(13, 3, 0, 4, 'UNC', 'Tarheel', NULL, NULL),
(14, 3, 0, 4, 'pppppppp', 'alalal', NULL, '2014-12-01 00:00:00'),
(15, 1, 0, 5, 'I like the environment!', 'Delicious Food', NULL, '2014-12-01 23:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `a6_Menu`
--

CREATE TABLE IF NOT EXISTS `a6_Menu` (
`menu_id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `item_image` char(200) DEFAULT NULL,
  `item_thumb_image` char(200) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `is_recommended` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a6_Menu`
--

INSERT INTO `a6_Menu` (`menu_id`, `food_id`, `restaurant_id`, `item_image`, `item_thumb_image`, `price`, `is_recommended`) VALUES
(1, 1, 1, NULL, NULL, '4.95', NULL),
(2, 2, 1, NULL, NULL, '8.50', NULL),
(3, 3, 1, NULL, NULL, '8.95', NULL),
(4, 4, 1, NULL, NULL, '6.95', NULL),
(5, 5, 1, NULL, NULL, '9.25', NULL),
(6, 6, 1, NULL, NULL, '7.50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `a6_Menu_Order`
--

CREATE TABLE IF NOT EXISTS `a6_Menu_Order` (
  `menu_order_id` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a6_Order`
--

CREATE TABLE IF NOT EXISTS `a6_Order` (
  `order_id` int(11) NOT NULL DEFAULT '0',
  `customer_id` int(11) DEFAULT NULL,
  `order_phone` char(200) DEFAULT NULL,
  `order_address` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `a6_Restaurant`
--

CREATE TABLE IF NOT EXISTS `a6_Restaurant` (
`restaurant_id` int(11) NOT NULL,
  `restaurant_name` char(60) DEFAULT NULL,
  `regis_date` date DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `zipcode` varchar(20) DEFAULT NULL,
  `work_phone` varchar(20) DEFAULT NULL,
  `open_hour` time DEFAULT NULL,
  `closed_hour` time DEFAULT NULL,
  `min_order` decimal(5,2) DEFAULT NULL,
  `delivery_fee` decimal(5,2) DEFAULT NULL,
  `latitude` float(10,6) DEFAULT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a6_Restaurant`
--

INSERT INTO `a6_Restaurant` (`restaurant_id`, `restaurant_name`, `regis_date`, `address`, `city`, `state`, `zipcode`, `work_phone`, `open_hour`, `closed_hour`, `min_order`, `delivery_fee`, `latitude`, `longitude`, `logo`) VALUES
(1, 'Asian Cafe', '2014-11-23', '118 E Franklin St', 'Chapel Hill', 'NC', '27514', '919-000-0000', '08:00:00', '20:00:00', '5.00', '2.00', 35.913239, -79.055840, ''),
(2, 'Top of Hill', '2014-11-24', '100 E Franklin St #3, Chapel Hill, NC 27514', 'Chapel Hill', 'NC', '27513', '(919) 929-8676', '14:00:00', '02:00:00', NULL, NULL, 35.914021, -79.056740, NULL),
(3, 'Sweet Frog', '2014-11-26', '105 E Franklin St, Chapel Hill, NC 27514', '', '', '', '(919) 537-8616', '00:08:00', '23:00:00', '0.00', '0.00', 35.913132, -79.055466, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a6_Admin`
--
ALTER TABLE `a6_Admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `a6_Category`
--
ALTER TABLE `a6_Category`
 ADD PRIMARY KEY (`category_id`);

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
-- Indexes for table `a6_Food_Category`
--
ALTER TABLE `a6_Food_Category`
 ADD PRIMARY KEY (`food_category_id`), ADD KEY `fk_Food_Cate` (`category_id`), ADD KEY `fk_Food_Cate1` (`food_id`);

--
-- Indexes for table `a6_Food_Review`
--
ALTER TABLE `a6_Food_Review`
 ADD PRIMARY KEY (`food_review_id`), ADD KEY `fk_Food_Review` (`menu_id`), ADD KEY `fk_Food_Review1` (`customer_id`);

--
-- Indexes for table `a6_Location`
--
ALTER TABLE `a6_Location`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `a6_Menu`
--
ALTER TABLE `a6_Menu`
 ADD PRIMARY KEY (`menu_id`), ADD KEY `fk_Menu` (`food_id`), ADD KEY `fk_Menu1` (`restaurant_id`);

--
-- Indexes for table `a6_Menu_Order`
--
ALTER TABLE `a6_Menu_Order`
 ADD PRIMARY KEY (`menu_order_id`), ADD KEY `fk_Menu_Order` (`order_id`), ADD KEY `fk_Menu_Order1` (`menu_id`);

--
-- Indexes for table `a6_Order`
--
ALTER TABLE `a6_Order`
 ADD PRIMARY KEY (`order_id`), ADD KEY `fk_Order` (`customer_id`);

--
-- Indexes for table `a6_Restaurant`
--
ALTER TABLE `a6_Restaurant`
 ADD PRIMARY KEY (`restaurant_id`);

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
MODIFY `food_review_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `a6_Menu`
--
ALTER TABLE `a6_Menu`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `a6_Restaurant`
--
ALTER TABLE `a6_Restaurant`
MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
