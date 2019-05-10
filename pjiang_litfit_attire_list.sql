-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 10, 2019 at 07:01 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1819playground`
--

-- --------------------------------------------------------

--
-- Table structure for table `pjiang_litfit_attire_list`
--

CREATE TABLE `pjiang_litfit_attire_list` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `subtype` varchar(50) NOT NULL,
  `subsubtype` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `formality` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pjiang_litfit_attire_list`
--

INSERT INTO `pjiang_litfit_attire_list` (`id`, `type`, `subtype`, `subsubtype`, `weight`, `formality`) VALUES
(1, 'Top', 'Jacket', 'Blazer/Suit', 'Medium', 5),
(2, 'Top', 'Jacket', 'Bomber', 'Light', 2),
(3, 'Top', 'Jacket', 'Denim', 'Medium', 1),
(4, 'Top', 'Jacket', 'Down', 'Heavy', 2),
(5, 'Top', 'Jacket', 'Hoodie', 'Medium', 1),
(6, 'Top', 'Jacket', 'Leather', 'Medium', 2),
(7, 'Top', 'Jacket', 'Overcoat', 'Heavy', 3),
(8, 'Top', 'Jacket', 'Parka', 'Heavy', 2),
(9, 'Top', 'Jacket', 'Peacoat', 'Heavy', 3),
(10, 'Top', 'Jacket', 'Shearling', 'Heavy', 2),
(11, 'Top', 'Jacket', 'Track', 'Light', 1),
(12, 'Top', 'Jacket', 'Trench coat', 'Heavy', 3),
(13, 'Top', 'Jacket', 'Windbreaker', 'Light', 2),
(14, 'Top', 'Shirt', 'Short-sleeve Tee', '', 1),
(15, 'Top', 'Shirt', 'Long-sleeve Tee', '', 1),
(16, 'Top', 'Shirt', 'Short-sleeve Button-down', '', 2),
(17, 'Top', 'Shirt', 'Long-sleeve Button-down', '', 2),
(18, 'Top', 'Shirt', 'Polo', '', 2),
(19, 'Top', 'Sweater', 'Crew-neck', '', 2),
(20, 'Top', 'Sweater', 'Quarter-zip', '', 1),
(21, 'Top', 'Sweater', 'Turtleneck', '', 2),
(22, 'Top', 'Sweater', 'V-neck', '', 2),
(23, 'Bottom', 'Pants', 'Cargo', '', 1),
(24, 'Bottom', 'Pants', 'Chinos', '', 3),
(25, 'Bottom', 'Pants', 'Corduroy', '', 2),
(26, 'Bottom', 'Pants', 'Dress', '', 5),
(27, 'Bottom', 'Pants', 'Jeans', '', 2),
(28, 'Bottom', 'Pants', 'Khakis', '', 3),
(29, 'Bottom', 'Pants', 'Sweats', '', 1),
(30, 'Bottom', 'Pants', 'Track', '', 1),
(31, 'Bottom', 'Shorts', 'Athletic', '', 1),
(32, 'Bottom', 'Shorts', 'Board/Swim', '', 1),
(33, 'Bottom', 'Shorts', 'Cargo', '', 1),
(34, 'Bottom', 'Shorts', 'Chino', '', 2),
(35, 'Bottom', 'Shorts', 'Jorts', '', 1),
(36, 'Footwear', 'Boots', 'Chelsea', '', 3),
(37, 'Footwear', 'Boots', 'Chukka/Suede', '', 3),
(38, 'Footwear', 'Boots', 'Combat/Work', '', 1),
(39, 'Footwear', 'Boots', 'Cowboy', '', 1),
(40, 'Footwear', 'Boots', 'Hiking', '', 1),
(41, 'Footwear', 'Boots', 'Wingtip', '', 4),
(42, 'Footwear', 'Dress', 'Loafers', '', 4),
(43, 'Footwear', 'Dress', 'Oxfords', '', 5),
(44, 'Footwear', 'Sneakers', 'Basketball', '', 1),
(45, 'Footwear', 'Sneakers', 'High-tops', '', 1),
(46, 'Footwear', 'Sneakers', 'Low-tops/Minimalist', '', 2),
(47, 'Footwear', 'Sneakers', 'Running', '', 1),
(48, 'Footwear', 'Sneakers', 'Slip-ons', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pjiang_litfit_attire_list`
--
ALTER TABLE `pjiang_litfit_attire_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pjiang_litfit_attire_list`
--
ALTER TABLE `pjiang_litfit_attire_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
