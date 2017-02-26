-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2017 at 07:54 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assistone`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `display_picture` varchar(45) DEFAULT 'img.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `fullname`, `display_picture`) VALUES
(1, 'HCB', '46f94c8de14fb36680850768ff1b7f2a', 'Harris Baldon', 'fb19cef5cfa396de34060134d70fdb9f.jpg'),
(2, 'remoh111', 'a8f5f167f44f4964e6c998dee827110c', 'Homer Baldon', '0c07a9faa07c52df2d839c96c72e69b3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
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
  `display_picture` varchar(45) DEFAULT 'img.jpg',
  `complete_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `firstname`, `middlename`, `lastname`, `mobilenumber`, `address`, `registered`, `guarantor_customers_id`, `deleted_at`, `display_picture`, `complete_name`) VALUES
(1, '16-0001', 'Harris', 'Cabacog', 'Baldon', '0922 834 9101', 'Bunga Mar, Jagna, Bohol', '2016-05-21 16:17:31', 0, '2016-05-22 02:08:46', '8c73e79f7447f3364c6b9a49b496bb05.gif', '16-0001 | Harris Cabacog Baldon'),
(2, '16-0002', 'Almira', 'Heredia', 'Pelingon', '0922 222 2222', 'Nasipit, Talamban, Cebu City, Cebu', '2016-05-22 02:10:56', 0, '2016-05-23 05:30:37', '35627d6690438927cd3fd89378af3641.jpg', '16-0002 | Almira Heredia Pelingon'),
(3, '16-0003', 'Myrna', 'None', 'Pao', '9999 999 9999', 'None', '2016-05-23 05:31:17', 0, NULL, NULL, '16-0003 | Myrna None Pao'),
(4, '16-0004', 'Raineria', 'Cabacog', 'Salabsab', '9999 999 9999', 'Bunga Mar, Jagna, Bohol', '2016-05-23 05:31:45', 0, NULL, NULL, '16-0004 | Raineria Cabacog Salabsab'),
(5, '16-0005', 'Maria', 'None', 'Sajul', '9999 999 9999', 'None', '2016-05-23 05:32:19', 0, NULL, NULL, '16-0005 | Maria None Sajul'),
(6, '16-0006', 'Yolly', 'None', 'Estapia', '9999 999 9999', 'Bunga Mar, Jagna, Bohol', '2016-05-23 05:33:50', 0, NULL, NULL, '16-0006 | Yolly None Estapia'),
(7, '16-0007', 'Haydee/G', 'None', 'Baldon', '9999 999 9999', 'Bunga Mar, Jagna, Bohol', '2016-05-23 05:34:12', 0, NULL, NULL, '16-0007 | Haydee/G None Baldon'),
(8, '16-0008', 'Chocho', 'None', 'Nalasa', '9999 999 9999', 'Bunga Mar, Jagna, Bohol', '2016-05-23 05:34:30', 0, '2016-05-23 14:01:23', NULL, '16-0008 | Chocho None Nalasa'),
(9, '16-0009', 'Haydee/Dakki', 'None', 'Baldon', '9999 999 9999', 'Bunga Mar, Jagna, Bohol', '2016-05-23 05:34:49', 0, NULL, NULL, '16-0009 | Haydee/Dakki None Baldon'),
(10, '16-0010', 'Aning', 'Cabacog', 'Dabatos', '9999 999 9999', 'Bunga Mar, Jagna, Bohol', '2016-05-23 05:35:05', 0, NULL, NULL, '16-0010 | Aning Cabacog Dabatos'),
(11, '16-0011', 'Jongoy', 'None', 'Tan', '9999 999 9999', 'Canjulao, Jagna, Bohol', '2016-05-23 05:35:32', 0, NULL, NULL, '16-0011 | Jongoy None Tan'),
(12, '16-0012', 'Wilfredo', 'None', 'Matunhay', '9999 999 9999', 'None', '2016-05-23 05:35:57', 0, NULL, '12a36f8b1d769b76c8ebfada89199518.jpg', '16-0012 | Wilfredo None Matunhay'),
(13, '16-0013', 'Carlos', 'None', 'Galamiton', '9999 999 9999', 'Bunga Mar, Jagna, Bohol', '2016-05-23 05:36:13', 0, NULL, NULL, '16-0013 | Carlos None Galamiton'),
(14, '16-0014', 'Fe / Bugoy', 'None', 'Abe-abe', '9999 999 9999', 'Bunga Mar, Jagna, Bohol', '2016-05-23 05:36:33', 0, NULL, NULL, '16-0014 | Fe / Bugoy None Abe-abe'),
(15, '16-0015', 'Necy', 'Cabacog', 'Galia', '9999 999 9999', 'Tubod Monte, Jagna, Bohol', '2016-05-23 05:36:53', 0, '2016-05-23 13:57:26', NULL, '16-0015 | Necy Cabacog Galia'),
(16, '16-0016', 'Graymon', 'None', 'None', '9999 999 9999', 'Pangdan, Jagna, Bohol', '2016-05-23 05:37:12', 0, NULL, NULL, '16-0016 | Graymon None None'),
(17, '16-0017', 'Exal / Tata', 'None', 'Acha', '9999 999 9999', 'None', '2016-05-23 05:37:49', 0, NULL, NULL, '16-0017 | Exal / Tata None Acha'),
(18, '16-0018', 'Arlyn / Grace', 'None', 'Abrau', '9999 999 9999', 'None', '2016-05-23 05:38:16', 0, NULL, NULL, '16-0018 | Arlyn / Grace None Abrau'),
(19, '16-0019', 'Arlyn / Grace Arban', 'None', 'Lloa', '9999 999 9999', 'None', '2016-05-23 05:38:48', 0, NULL, NULL, '16-0019 | Arlyn / Grace Arban None Lloa'),
(20, '16-0020', 'Sheryl', 'Salazar', 'Dalmacio', '9999 999 9999', 'Digos, Davao Del Sur', '2016-05-23 05:39:10', 0, NULL, NULL, '16-0020 | Sheryl Salazar Dalmacio'),
(21, '16-0021', 'Betsy / Flor', 'None', 'None', '9999 999 9999', 'None', '2016-05-23 05:39:25', 0, '2016-05-23 14:01:20', NULL, '16-0021 | Betsy / Flor None None'),
(22, '16-0022', 'William / Mayor', 'None', 'None', '9999 999 9999', 'None', '2016-05-23 05:39:42', 0, NULL, NULL, '16-0022 | William / Mayor None None'),
(23, '16-0023', 'Jovy', 'None', 'None', '9999 999 9999', 'None', '2016-05-23 05:40:02', 0, NULL, NULL, '16-0023 | Jovy None None'),
(24, '16-0024', 'Fe / Flo', 'None', 'None', '9999 999 9999', 'Digos, Davao Del Sur', '2016-05-23 05:40:19', 0, NULL, NULL, '16-0024 | Fe / Flo None None'),
(25, '16-0025', 'Tata', 'None', 'Acha', '9999 999 9999', 'None', '2016-05-23 05:40:36', 0, '2016-06-26 13:03:42', NULL, '16-0025 | Tata None Acha'),
(26, '16-0026', 'Graziella', 'Salazar', 'Lingo', '0910 533 4901', 'Digos, Davao Del Sur', '2016-05-23 05:41:06', 0, '2016-06-26 11:42:09', NULL, '16-0026 | Graziella Salazar Lingo'),
(27, '16-0027', 'Wilfredo', 'None', 'Matunhay', '1234 567 8900', 'None', '2016-07-01 12:30:42', 3, NULL, 'img.jpg', '16-0027 | Wilfredo None Matunhay'),
(28, '16-0028', 'Popoy', 'One', 'Basha', '1111 111 1111', 'None', '2016-07-01 12:37:45', 0, NULL, 'img.jpg', '16-0028 | Popoy One Basha'),
(29, '16-0029', 'Xcvxcvxcv', 'Xcvxcvxcv', 'Xcvxcvxcv', '1111 111 1111', 'Sdfsdfsdfs', '2016-07-01 12:50:16', 6, '2016-10-21 02:29:16', 'img.jpg', '16-0029 | Xcvxcvxcv Xcvxcvxcv Xcvxcvxcv');

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` int(11) NOT NULL,
  `investor_id` varchar(10) DEFAULT NULL,
  `firstname` varchar(45) NOT NULL,
  `middlename` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) NOT NULL,
  `mobilenumber` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `display_picture` varchar(50) NOT NULL DEFAULT 'img.jpg',
  `complete_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `investor_id`, `firstname`, `middlename`, `lastname`, `mobilenumber`, `address`, `registered`, `deleted_at`, `display_picture`, `complete_name`) VALUES
(1, '17-0001', 'Harris', 'Cabacog', 'Baldon', '0111 111 1111', 'Secret', '2017-02-26 05:16:48', NULL, 'img.jpg', '17-0001 | Harris Cabacog Baldon'),
(2, '17-0002', 'Haydee', 'Cabacog', 'Baldon', '1111 111 1111', 'Secret', '2017-02-26 05:17:03', NULL, 'img.jpg', '17-0002 | Haydee Cabacog Baldon'),
(3, '17-0003', 'Homer', 'Cabacog', 'Baldon', '1111 111 1111', 'Secret', '2017-02-26 05:17:20', NULL, 'img.jpg', '17-0003 | Homer Cabacog Baldon');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `loan_id` varchar(10) NOT NULL,
  `date_of_application` date DEFAULT NULL,
  `date_of_release` date DEFAULT NULL,
  `amount_loan` decimal(10,2) NOT NULL,
  `interest_rate` decimal(10,2) NOT NULL,
  `number_of_terms` int(11) NOT NULL,
  `total_interest_amount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `loans_id` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `due_amount` decimal(10,2) NOT NULL,
  `actual_paid_date` date DEFAULT NULL,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `running_balance` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `id` int(11) NOT NULL,
  `payments_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(100) NOT NULL DEFAULT ' ',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `loans_id` int(11) NOT NULL,
  `payments_id` int(11) NOT NULL,
  `investors_id` int(11) NOT NULL,
  `transactions_id` int(11) NOT NULL,
  `returns` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(10) NOT NULL,
  `investor_id` int(11) NOT NULL,
  `date_of_transaction` date NOT NULL,
  `amount_transaction` decimal(10,2) NOT NULL,
  `type_transaction` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
