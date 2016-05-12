-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2016 at 04:13 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assistone`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `display_picture` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `display_picture`) VALUES
(1, 'baldonharris', '46f94c8de14fb36680850768ff1b7f2a', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`id` int(11) NOT NULL,
  `customer_id` varchar(10) DEFAULT NULL,
  `firstname` varchar(45) NOT NULL,
  `middlename` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) NOT NULL,
  `mobilenumber` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guarantor_customers_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `display_picture` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `firstname`, `middlename`, `lastname`, `mobilenumber`, `address`, `registered`, `guarantor_customers_id`, `deleted_at`, `display_picture`) VALUES
(1, '16-0001', 'Myrna', NULL, 'Pao', '999999', 'None', '2016-05-10 02:24:28', NULL, NULL, ''),
(2, '16-0002', 'Raineria', 'Cabacog', 'Salabsab', '999999', 'Bunga Mar, Jagna, Bohol', '2016-05-10 15:03:52', 1, NULL, ''),
(3, '16-0003', 'Maria', NULL, 'Sajul', '9999999', 'None', '2016-05-10 15:05:19', NULL, NULL, ''),
(4, '16-0004', 'Yolly', NULL, 'Estapia', '9999999', 'Bunga Mar, Jagna, Bohol', '2016-05-10 15:05:19', NULL, NULL, ''),
(5, '16-0005', 'Haydee/G', NULL, 'Baldon', '999999999', 'Bunga Mar, Jagna, Bohol', '2016-05-10 15:10:16', NULL, NULL, ''),
(6, '16-0006', 'Chocho', NULL, 'Nalasa', '999999', 'Bunga Mar, Jagna, Bohol', '2016-05-10 15:10:16', NULL, NULL, ''),
(7, '16-0007', 'Haydee/Dakki', NULL, 'Baldon', '99999', 'Bunga Mar, Jagna, Bohol', '2016-05-10 15:10:16', NULL, NULL, ''),
(8, '16-0008', 'Aning', 'Cabacog', 'Dabatos', '999999', 'Bunga Mar, Jagna, Bohol', '2016-05-10 15:10:16', NULL, NULL, ''),
(9, '16-0009', 'Jongoy', NULL, 'Tan', '99999', 'Canjulao, Jagna, Bohol', '2016-05-10 15:10:16', NULL, NULL, ''),
(10, '16-0010', 'Wilfredo', NULL, 'Matunhay', '999999', 'None', '2016-05-11 05:21:13', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
