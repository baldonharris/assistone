-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2017 at 05:08 PM
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
(1, '17-0001', 'Harris', 'Cabacog', 'Baldon', '0932 101 0135', 'Bunga Mar, Jagna, Bohol', '2017-01-18 03:10:16', NULL, 'img.jpg', '17-0001 | Harris Cabacog Baldon'),
(2, '17-0002', 'Homer', 'Cabacog', 'Baldon', '8475 029 6771', 'Bohol', '2017-01-18 03:21:15', NULL, 'img.jpg', '17-0002 | Homer Cabacog Baldon'),
(3, '17-0003', 'Asdasd', 'Asdasd', 'Asdasd', '1231 231 2312', 'Asdasdasd', '2017-01-19 08:40:02', NULL, 'img.jpg', '17-0003 | Asdasd Asdasd Asdasd'),
(4, '17-0004', 'Asdasdasd', 'Asdasdasdasd', 'Asdasdasdasdasd', '1231 231 2312', 'Asdasdasdasdasd', '2017-01-19 08:40:12', NULL, 'img.jpg', '17-0004 | Asdasdasd Asdasdasdasd Asdasdasdasdasd'),
(5, '17-0005', 'Asdasdasd', 'Asdasdasd', 'Asdasdasd', '1231 231 2312', 'Sdasdasdasd', '2017-01-19 08:41:08', NULL, 'img.jpg', '17-0005 | Asdasdasd Asdasdasd Asdasdasd'),
(6, '17-0006', 'Dfgdfgdfg', 'Dfgdfg', 'Dfgdfg', '1231 231 2312', 'Dsfgdfgdfgdfg', '2017-01-19 08:41:15', NULL, 'img.jpg', '17-0006 | Dfgdfgdfg Dfgdfg Dfgdfg'),
(7, '17-0007', 'Dfgdfgdfg', 'Dfgdfgdfg', 'Dfgdfgdfg', '2312 312 3123', 'Dfgdfgdfgdfg', '2017-01-19 08:41:23', NULL, 'img.jpg', '17-0007 | Dfgdfgdfg Dfgdfgdfg Dfgdfgdfg'),
(8, '17-0008', 'Fdghfgh', 'Fghfghfgh', 'Fghfghfgh', '1231 231 2312', 'Dfghfghfgh', '2017-01-19 08:41:31', NULL, 'img.jpg', '17-0008 | Fdghfgh Fghfghfgh Fghfghfgh'),
(9, '17-0009', 'Fghfghfgh', 'Fghfghfgh', 'Fghfghfgh', '1231 231 2312', 'Dfgdfgdfgdfgdfg', '2017-01-19 08:41:41', NULL, 'img.jpg', '17-0009 | Fghfghfgh Fghfghfgh Fghfghfgh'),
(10, '17-0010', 'Dfgdfgdfg', 'Dfgdfgdfg', 'Dfgdfgdfg', '1231 231 2312', 'Dfgdfgdfgdfgdfg', '2017-01-19 08:41:48', NULL, 'img.jpg', '17-0010 | Dfgdfgdfg Dfgdfgdfg Dfgdfgdfg'),
(11, '17-0011', 'Dfgdfgdfgdfg', 'Dfgdfgdfg', 'Dfgdfgdfg', '1231 231 2312', 'Dfgdfgdfg', '2017-01-19 08:41:56', NULL, 'img.jpg', '17-0011 | Dfgdfgdfgdfg Dfgdfgdfg Dfgdfgdfg');

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

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `customer_id`, `loan_id`, `date_of_application`, `date_of_release`, `amount_loan`, `interest_rate`, `number_of_terms`, `total_interest_amount`, `balance`) VALUES
(1, 28, '17-28-0001', '2017-01-17', '2017-01-17', '1000.00', '2.00', 6, '60.00', '1060.00'),
(2, 28, '17-28-0002', '2017-02-17', '2017-02-19', '8000.00', '1.00', 12, '480.00', '8480.00'),
(3, 28, '17-28-0003', '2017-02-17', '2017-02-19', '8000.00', '2.00', 12, '960.00', '8960.00'),
(4, 28, '17-28-0004', '2017-02-17', '2017-02-19', '8000.00', '3.00', 12, '1440.00', '9440.00');

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

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `loans_id`, `due_date`, `due_amount`, `actual_paid_date`, `amount_paid`, `payment_balance`, `running_balance`) VALUES
(1, 1, '2017-01-31', '177.00', NULL, '0.00', '0.00', '1060.00'),
(2, 1, '2017-02-15', '177.00', NULL, '0.00', '0.00', '0.00'),
(3, 1, '2017-02-28', '177.00', NULL, '0.00', '0.00', '0.00'),
(4, 1, '2017-03-15', '177.00', NULL, '0.00', '0.00', '0.00'),
(5, 1, '2017-03-31', '177.00', NULL, '0.00', '0.00', '0.00'),
(6, 1, '2017-04-15', '175.00', NULL, '0.00', '0.00', '0.00'),
(7, 2, '2017-02-28', '707.00', NULL, '0.00', '0.00', '8480.00'),
(8, 2, '2017-03-15', '707.00', NULL, '0.00', '0.00', '0.00'),
(9, 2, '2017-03-31', '707.00', NULL, '0.00', '0.00', '0.00'),
(10, 2, '2017-04-15', '707.00', NULL, '0.00', '0.00', '0.00'),
(11, 2, '2017-04-30', '707.00', NULL, '0.00', '0.00', '0.00'),
(12, 2, '2017-05-15', '707.00', NULL, '0.00', '0.00', '0.00'),
(13, 2, '2017-05-31', '707.00', NULL, '0.00', '0.00', '0.00'),
(14, 2, '2017-06-15', '707.00', NULL, '0.00', '0.00', '0.00'),
(15, 2, '2017-06-30', '707.00', NULL, '0.00', '0.00', '0.00'),
(16, 2, '2017-07-15', '707.00', NULL, '0.00', '0.00', '0.00'),
(17, 2, '2017-07-31', '707.00', NULL, '0.00', '0.00', '0.00'),
(18, 2, '2017-08-15', '703.00', NULL, '0.00', '0.00', '0.00'),
(19, 3, '2017-02-28', '747.00', NULL, '0.00', '0.00', '8960.00'),
(20, 3, '2017-03-15', '747.00', NULL, '0.00', '0.00', '0.00'),
(21, 3, '2017-03-31', '747.00', NULL, '0.00', '0.00', '0.00'),
(22, 3, '2017-04-15', '747.00', NULL, '0.00', '0.00', '0.00'),
(23, 3, '2017-04-30', '747.00', NULL, '0.00', '0.00', '0.00'),
(24, 3, '2017-05-15', '747.00', NULL, '0.00', '0.00', '0.00'),
(25, 3, '2017-05-31', '747.00', NULL, '0.00', '0.00', '0.00'),
(26, 3, '2017-06-15', '747.00', NULL, '0.00', '0.00', '0.00'),
(27, 3, '2017-06-30', '747.00', NULL, '0.00', '0.00', '0.00'),
(28, 3, '2017-07-15', '747.00', NULL, '0.00', '0.00', '0.00'),
(29, 3, '2017-07-31', '747.00', NULL, '0.00', '0.00', '0.00'),
(30, 3, '2017-08-15', '743.00', NULL, '0.00', '0.00', '0.00'),
(31, 4, '2017-02-28', '787.00', NULL, '0.00', '0.00', '9440.00'),
(32, 4, '2017-03-15', '787.00', NULL, '0.00', '0.00', '0.00'),
(33, 4, '2017-03-31', '787.00', NULL, '0.00', '0.00', '0.00'),
(34, 4, '2017-04-15', '787.00', NULL, '0.00', '0.00', '0.00'),
(35, 4, '2017-04-30', '787.00', NULL, '0.00', '0.00', '0.00'),
(36, 4, '2017-05-15', '787.00', NULL, '0.00', '0.00', '0.00'),
(37, 4, '2017-05-31', '787.00', NULL, '0.00', '0.00', '0.00'),
(38, 4, '2017-06-15', '787.00', NULL, '0.00', '0.00', '0.00'),
(39, 4, '2017-06-30', '787.00', NULL, '0.00', '0.00', '0.00'),
(40, 4, '2017-07-15', '787.00', NULL, '0.00', '0.00', '0.00'),
(41, 4, '2017-07-31', '787.00', NULL, '0.00', '0.00', '0.00'),
(42, 4, '2017-08-15', '783.00', NULL, '0.00', '0.00', '0.00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
