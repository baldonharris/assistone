-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2017 at 03:39 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

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
(1, 'HCB', '46f94c8de14fb36680850768ff1b7f2a', 'Harris Baldon', '0f581d2a1e78760f80cbffc814f65b02.jpg'),
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
(1, 28, '16-28-0001', '2016-10-24', '2016-10-24', '10000.00', '4.00', 5, '1000.00', '11000.00'),
(2, 28, '16-28-0002', '2016-10-31', '2016-11-01', '20000.00', '1.00', 5, '500.00', '20500.00'),
(3, 27, '16-27-0003', '2016-10-24', '2016-10-24', '10000.00', '5.00', 5, '1250.00', '11250.00'),
(4, 22, '16-22-0004', '2016-12-14', '2016-12-16', '10000.00', '2.00', 6, '600.00', '10600.00'),
(5, 27, '16-27-0005', '2016-12-30', '2016-12-30', '1100.00', '2.00', 6, '66.00', '1166.00'),
(6, 23, '16-23-0006', '2016-12-30', '2016-12-30', '20000.00', '2.00', 6, '1200.00', '21200.00'),
(7, 23, '16-23-0007', '2016-12-30', '2016-12-30', '20000.00', '2.00', 7, '1400.00', '21400.00'),
(8, 23, '16-23-0008', '2016-12-30', '2016-12-30', '20000.00', '2.00', 10, '2000.00', '22000.00'),
(9, 23, '16-23-0009', '2016-12-30', '2016-12-30', '20000.00', '2.00', 7, '1400.00', '21400.00'),
(10, 16, '16-16-0010', '2016-12-30', '2016-12-30', '20000.00', '2.00', 7, '1400.00', '21400.00'),
(11, 17, '16-17-0011', '2016-12-30', '2016-12-30', '20000.00', '2.00', 7, '1400.00', '21400.00'),
(12, 18, '16-18-0012', '2016-12-30', '2016-12-30', '20000.00', '2.00', 7, '1400.00', '21400.00'),
(13, 24, '16-24-0013', '2016-12-30', '2016-12-30', '1050.00', '2.00', 3, '31.50', '1081.50'),
(14, 23, '16-23-0014', '2016-12-31', '2016-12-31', '20000.00', '2.00', 10, '2000.00', '22000.00');

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
(1, 1, '2016-10-31', '2200.00', '2016-10-24', '2200.00', '0.00', '8800.00'),
(2, 1, '2016-11-15', '2200.00', '2016-11-10', '2200.00', '0.00', '6600.00'),
(3, 1, '2016-11-30', '2200.00', '2016-11-29', '2200.00', '0.00', '4400.00'),
(4, 1, '2016-12-15', '2200.00', '2016-12-15', '2200.00', '0.00', '2200.00'),
(5, 1, '2016-12-31', '2200.00', '2016-12-30', '2200.00', '0.00', '0.00'),
(6, 2, '2016-11-15', '4100.00', '2016-10-24', '2000.00', '2100.00', '18500.00'),
(7, 2, '2016-11-30', '4100.00', '2016-10-24', '4100.00', '0.00', '14400.00'),
(8, 2, '2016-12-15', '4100.00', '2016-10-24', '4100.00', '0.00', '10300.00'),
(9, 2, '2016-12-31', '4100.00', '2016-12-30', '4100.00', '0.00', '6200.00'),
(10, 2, '2017-01-15', '4100.00', '0000-00-00', '0.00', '0.00', '0.00'),
(11, 3, '2016-10-31', '2250.00', '2016-12-30', '2250.00', '0.00', '0.00'),
(12, 3, '2016-11-15', '2250.00', NULL, '0.00', '0.00', '9000.00'),
(13, 3, '2016-11-30', '2250.00', NULL, '0.00', '0.00', '0.00'),
(14, 3, '2016-12-15', '2250.00', NULL, '0.00', '0.00', '0.00'),
(15, 3, '2016-12-31', '2250.00', NULL, '0.00', '0.00', '0.00'),
(16, 4, '2016-12-31', '1767.00', NULL, '0.00', '0.00', '10600.00'),
(17, 4, '2017-01-15', '1767.00', NULL, '0.00', '0.00', '0.00'),
(18, 4, '2017-01-31', '1767.00', NULL, '0.00', '0.00', '0.00'),
(19, 4, '2017-02-15', '1767.00', NULL, '0.00', '0.00', '0.00'),
(20, 4, '2017-02-28', '1767.00', NULL, '0.00', '0.00', '0.00'),
(21, 4, '2017-03-15', '1765.00', NULL, '0.00', '0.00', '0.00'),
(22, 5, '2017-01-15', '194.00', '0000-00-00', '0.00', '0.00', '0.00'),
(23, 5, '2017-01-31', '194.00', '2016-12-29', '10.00', '184.00', '-10.00'),
(24, 5, '2017-02-15', '194.00', NULL, '0.00', '0.00', '-10.00'),
(25, 5, '2017-02-28', '194.00', NULL, '0.00', '0.00', '0.00'),
(26, 5, '2017-03-15', '194.00', NULL, '0.00', '0.00', '0.00'),
(27, 5, '2017-03-31', '196.00', NULL, '0.00', '0.00', '0.00'),
(28, 6, '2017-01-15', '3533.00', NULL, '0.00', '0.00', '21200.00'),
(29, 6, '2017-01-31', '3533.00', NULL, '0.00', '0.00', '0.00'),
(30, 6, '2017-02-15', '3533.00', NULL, '0.00', '0.00', '0.00'),
(31, 6, '2017-02-28', '3533.00', NULL, '0.00', '0.00', '0.00'),
(32, 6, '2017-03-15', '3533.00', NULL, '0.00', '0.00', '0.00'),
(33, 6, '2017-03-31', '3535.00', NULL, '0.00', '0.00', '0.00'),
(34, 7, '2017-01-15', '3057.00', NULL, '0.00', '0.00', '21400.00'),
(35, 7, '2017-01-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(36, 7, '2017-02-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(37, 7, '2017-02-28', '3057.00', NULL, '0.00', '0.00', '0.00'),
(38, 7, '2017-03-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(39, 7, '2017-03-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(40, 7, '2017-04-15', '3058.00', NULL, '0.00', '0.00', '0.00'),
(41, 8, '2017-01-15', '2200.00', NULL, '0.00', '0.00', '22000.00'),
(42, 8, '2017-01-31', '2200.00', NULL, '0.00', '0.00', '0.00'),
(43, 8, '2017-02-15', '2200.00', NULL, '0.00', '0.00', '0.00'),
(44, 8, '2017-02-28', '2200.00', NULL, '0.00', '0.00', '0.00'),
(45, 8, '2017-03-15', '2200.00', NULL, '0.00', '0.00', '0.00'),
(46, 8, '2017-03-31', '2200.00', NULL, '0.00', '0.00', '0.00'),
(47, 8, '2017-04-15', '2200.00', NULL, '0.00', '0.00', '0.00'),
(48, 8, '2017-04-30', '2200.00', NULL, '0.00', '0.00', '0.00'),
(49, 8, '2017-05-15', '2200.00', NULL, '0.00', '0.00', '0.00'),
(50, 8, '2017-05-31', '2200.00', NULL, '0.00', '0.00', '0.00'),
(51, 9, '2017-01-15', '3057.00', NULL, '0.00', '0.00', '21400.00'),
(52, 9, '2017-01-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(53, 9, '2017-02-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(54, 9, '2017-02-28', '3057.00', NULL, '0.00', '0.00', '0.00'),
(55, 9, '2017-03-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(56, 9, '2017-03-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(57, 9, '2017-04-15', '3058.00', NULL, '0.00', '0.00', '0.00'),
(58, 10, '2017-01-15', '3057.00', NULL, '0.00', '0.00', '21400.00'),
(59, 10, '2017-01-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(60, 10, '2017-02-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(61, 10, '2017-02-28', '3057.00', NULL, '0.00', '0.00', '0.00'),
(62, 10, '2017-03-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(63, 10, '2017-03-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(64, 10, '2017-04-15', '3058.00', NULL, '0.00', '0.00', '0.00'),
(65, 11, '2017-01-15', '3058.00', NULL, '0.00', '0.00', '21400.00'),
(66, 11, '2017-01-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(67, 11, '2017-02-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(68, 11, '2017-02-28', '3057.00', NULL, '0.00', '0.00', '0.00'),
(69, 11, '2017-03-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(70, 11, '2017-03-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(71, 11, '2017-04-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(72, 12, '2017-01-15', '3058.00', NULL, '0.00', '0.00', '21400.00'),
(73, 12, '2017-01-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(74, 12, '2017-02-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(75, 12, '2017-02-28', '3057.00', NULL, '0.00', '0.00', '0.00'),
(76, 12, '2017-03-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(77, 12, '2017-03-31', '3057.00', NULL, '0.00', '0.00', '0.00'),
(78, 12, '2017-04-15', '3057.00', NULL, '0.00', '0.00', '0.00'),
(79, 13, '2017-01-15', '359.50', '0000-00-00', '50.00', '309.50', '1031.50'),
(80, 13, '2017-01-31', '361.00', '2016-12-31', '50.00', '311.00', '981.50'),
(81, 13, '2017-02-15', '361.00', '2016-12-31', '50.00', '311.00', '931.50'),
(82, 14, '2017-01-15', '2200.00', NULL, '0.00', '0.00', '22000.00'),
(83, 14, '2017-01-31', '2200.00', NULL, '0.00', '0.00', '0.00'),
(84, 14, '2017-02-15', '2200.00', NULL, '0.00', '0.00', '0.00'),
(85, 14, '2017-02-28', '2200.00', NULL, '0.00', '0.00', '0.00'),
(86, 14, '2017-03-15', '2200.00', NULL, '0.00', '0.00', '0.00'),
(87, 14, '2017-03-31', '2200.00', NULL, '0.00', '0.00', '0.00'),
(88, 14, '2017-04-15', '2200.00', NULL, '0.00', '0.00', '0.00'),
(89, 14, '2017-04-30', '2200.00', NULL, '0.00', '0.00', '0.00'),
(90, 14, '2017-05-15', '2200.00', NULL, '0.00', '0.00', '0.00'),
(91, 14, '2017-05-31', '2200.00', NULL, '0.00', '0.00', '0.00');

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
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
