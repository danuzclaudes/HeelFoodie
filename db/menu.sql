-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2014 at 01:55 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `wangyiqidb`
--

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
(1, 1, 1, NULL, 'Crab-Rangoon.jpeg', '4.95', NULL),
(2, 2, 1, NULL, 'crispy-noodle.jpg', '8.50', NULL),
(3, 3, 1, NULL, 'Orange-Chicken.jpg', '8.95', NULL),
(4, 4, 1, NULL, 'chickenwings.jpg', '6.95', NULL),
(5, 5, 1, NULL, 'beef-broccoli.jpg', '9.25', NULL),
(6, 6, 1, NULL, 'pork-fried-rice.jpg', '7.50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a6_Menu`
--
ALTER TABLE `a6_Menu`
 ADD PRIMARY KEY (`menu_id`), ADD KEY `fk_Menu` (`food_id`), ADD KEY `fk_Menu1` (`restaurant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a6_Menu`
--
ALTER TABLE `a6_Menu`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;