-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2017 at 08:07 PM
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
(1, 'HCB', '46f94c8de14fb36680850768ff1b7f2a', 'Harris Baldon', 'img.jpg'),
(2, 'hbaldon', '46f94c8de14fb36680850768ff1b7f2a', 'Homer Baldon', '924a9f9d16d480949419daeab6e743d1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `buckets`
--

CREATE TABLE `buckets` (
  `id` int(11) NOT NULL,
  `bucket_name` varchar(100) NOT NULL,
  `percentage` decimal(10,2) NOT NULL,
  `effectivities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buckets`
--

INSERT INTO `buckets` (`id`, `bucket_name`, `percentage`, `effectivities_id`) VALUES
(1, 'Investors', '70.00', 1),
(2, 'Operations Fund', '10.00', 1),
(3, 'Secret Fund', '20.00', 1),
(4, 'Investors', '90.00', 2),
(5, 'Operations Fund', '10.00', 2);

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
(1, '17-0001', 'Boy', 'Pala', 'Utang', '0910 234 5789', 'Loan St., Utang City', '2017-03-04 18:04:01', 0, NULL, '8bd912157cf34a2f5088f10f6768618e.jpg', '17-0001 | Boy Pala Utang'),
(2, '17-0002', 'Gurl', 'Alyas', 'Utang', '1111 111 1111', 'Bunga Mar, Jagna, Bohol', '2017-03-07 14:13:58', 1, NULL, 'img.jpg', '17-0002 | Gurl Alyas Utang');

-- --------------------------------------------------------

--
-- Table structure for table `effectivities`
--

CREATE TABLE `effectivities` (
  `id` int(11) NOT NULL,
  `effectivity_date` datetime NOT NULL,
  `submitted_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `effectivities`
--

INSERT INTO `effectivities` (`id`, `effectivity_date`, `submitted_date`, `status`) VALUES
(1, '2017-04-23 00:00:00', '2017-04-23 21:46:46', 'inactive'),
(2, '2017-04-24 00:00:00', '2017-04-24 23:36:15', 'active');

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
(1, '17-0001', 'Harris', 'Cabacog', 'Baldon', '0932 101 0135', 'Bunga Mar, Jagna, Bohol', '2017-04-23 15:04:15', NULL, 'img.jpg', '17-0001 | Harris Cabacog Baldon'),
(2, '17-0002', 'Homer', 'Cabacog', 'Baldon', '0932 101 0135', 'Bunga Mar, Jagna, Bohol', '2017-04-23 15:13:23', NULL, 'img.jpg', '17-0002 | Homer Cabacog Baldon');

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
  `balance` decimal(10,2) NOT NULL,
  `status` enum('reserved','approved') NOT NULL DEFAULT 'reserved'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `customer_id`, `loan_id`, `date_of_application`, `date_of_release`, `amount_loan`, `interest_rate`, `number_of_terms`, `total_interest_amount`, `balance`, `status`) VALUES
(1, 2, '17-02-0001', '2017-04-29', '2017-04-29', '30000.00', '2.00', 30, '9000.00', '29900.00', 'approved'),
(2, 2, '17-02-0002', '2017-04-27', '2017-04-30', '5000.00', '2.00', 5, '250.00', '3150.00', 'approved'),
(3, 1, '17-01-0003', '2017-04-29', '2017-07-01', '1000000.00', '2.00', 72, '720000.00', '1600555.00', 'approved'),
(4, 1, '17-01-0004', '2017-05-01', '2017-05-20', '50000.00', '2.00', 30, '15000.00', '65000.00', 'reserved'),
(5, 2, '17-02-0005', '2017-05-01', '2017-05-12', '20000.00', '2.00', 24, '4800.00', '24800.00', 'reserved'),
(6, 2, '17-02-0006', '2017-04-01', '0000-00-00', '10000.00', '2.00', 30, '3000.00', '13000.00', 'reserved');

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
(1, 1, '2017-05-15', '1300.00', '2017-05-15', '1300.00', '0.00', '37700.00'),
(2, 1, '2017-05-31', '1300.00', '2017-05-31', '1300.00', '0.00', '36400.00'),
(3, 1, '2017-06-15', '1300.00', '2017-06-15', '1300.00', '0.00', '35100.00'),
(4, 1, '2017-06-30', '1300.00', '2017-06-30', '1300.00', '0.00', '33800.00'),
(5, 1, '2017-07-15', '1300.00', '2017-07-15', '1300.00', '0.00', '32500.00'),
(6, 1, '2017-07-31', '1300.00', '2017-07-31', '1300.00', '0.00', '31200.00'),
(7, 1, '2017-08-15', '1300.00', '2017-08-15', '1300.00', '0.00', '29900.00'),
(8, 1, '2017-08-31', '1300.00', NULL, '0.00', '0.00', '0.00'),
(9, 1, '2017-09-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(10, 1, '2017-09-30', '1300.00', NULL, '0.00', '0.00', '0.00'),
(11, 1, '2017-10-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(12, 1, '2017-10-31', '1300.00', NULL, '0.00', '0.00', '0.00'),
(13, 1, '2017-11-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(14, 1, '2017-11-30', '1300.00', NULL, '0.00', '0.00', '0.00'),
(15, 1, '2017-12-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(16, 1, '2017-12-31', '1300.00', NULL, '0.00', '0.00', '0.00'),
(17, 1, '2018-01-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(18, 1, '2018-01-31', '1300.00', NULL, '0.00', '0.00', '0.00'),
(19, 1, '2018-02-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(20, 1, '2018-02-28', '1300.00', NULL, '0.00', '0.00', '0.00'),
(21, 1, '2018-03-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(22, 1, '2018-03-31', '1300.00', NULL, '0.00', '0.00', '0.00'),
(23, 1, '2018-04-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(24, 1, '2018-04-30', '1300.00', NULL, '0.00', '0.00', '0.00'),
(25, 1, '2018-05-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(26, 1, '2018-05-31', '1300.00', NULL, '0.00', '0.00', '0.00'),
(27, 1, '2018-06-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(28, 1, '2018-06-30', '1300.00', NULL, '0.00', '0.00', '0.00'),
(29, 1, '2018-07-15', '1300.00', NULL, '0.00', '0.00', '0.00'),
(30, 1, '2018-07-31', '1300.00', NULL, '0.00', '0.00', '0.00'),
(31, 2, '2017-05-15', '1050.00', '2017-05-15', '1050.00', '0.00', '4200.00'),
(32, 2, '2017-05-31', '1050.00', '2017-05-31', '1050.00', '0.00', '3150.00'),
(33, 2, '2017-06-15', '1050.00', NULL, '0.00', '0.00', '0.00'),
(34, 2, '2017-06-30', '1050.00', NULL, '0.00', '0.00', '0.00'),
(35, 2, '2017-07-15', '1050.00', NULL, '0.00', '0.00', '0.00'),
(36, 3, '2017-07-15', '23889.00', '2017-07-15', '23889.00', '0.00', '1696111.00'),
(37, 3, '2017-07-31', '23889.00', '2017-07-31', '23889.00', '0.00', '1672222.00'),
(38, 3, '2017-08-15', '23889.00', '2017-08-15', '23889.00', '0.00', '1648333.00'),
(39, 3, '2017-08-31', '23889.00', '2017-08-31', '23889.00', '0.00', '1624444.00'),
(40, 3, '2017-09-15', '23889.00', '2017-09-15', '23889.00', '0.00', '1600555.00'),
(41, 3, '2017-09-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(42, 3, '2017-10-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(43, 3, '2017-10-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(44, 3, '2017-11-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(45, 3, '2017-11-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(46, 3, '2017-12-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(47, 3, '2017-12-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(48, 3, '2018-01-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(49, 3, '2018-01-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(50, 3, '2018-02-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(51, 3, '2018-02-28', '23889.00', NULL, '0.00', '0.00', '0.00'),
(52, 3, '2018-03-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(53, 3, '2018-03-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(54, 3, '2018-04-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(55, 3, '2018-04-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(56, 3, '2018-05-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(57, 3, '2018-05-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(58, 3, '2018-06-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(59, 3, '2018-06-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(60, 3, '2018-07-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(61, 3, '2018-07-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(62, 3, '2018-08-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(63, 3, '2018-08-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(64, 3, '2018-09-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(65, 3, '2018-09-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(66, 3, '2018-10-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(67, 3, '2018-10-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(68, 3, '2018-11-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(69, 3, '2018-11-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(70, 3, '2018-12-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(71, 3, '2018-12-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(72, 3, '2019-01-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(73, 3, '2019-01-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(74, 3, '2019-02-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(75, 3, '2019-02-28', '23889.00', NULL, '0.00', '0.00', '0.00'),
(76, 3, '2019-03-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(77, 3, '2019-03-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(78, 3, '2019-04-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(79, 3, '2019-04-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(80, 3, '2019-05-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(81, 3, '2019-05-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(82, 3, '2019-06-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(83, 3, '2019-06-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(84, 3, '2019-07-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(85, 3, '2019-07-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(86, 3, '2019-08-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(87, 3, '2019-08-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(88, 3, '2019-09-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(89, 3, '2019-09-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(90, 3, '2019-10-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(91, 3, '2019-10-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(92, 3, '2019-11-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(93, 3, '2019-11-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(94, 3, '2019-12-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(95, 3, '2019-12-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(96, 3, '2020-01-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(97, 3, '2020-01-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(98, 3, '2020-02-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(99, 3, '2020-02-29', '23889.00', NULL, '0.00', '0.00', '0.00'),
(100, 3, '2020-03-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(101, 3, '2020-03-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(102, 3, '2020-04-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(103, 3, '2020-04-30', '23889.00', NULL, '0.00', '0.00', '0.00'),
(104, 3, '2020-05-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(105, 3, '2020-05-31', '23889.00', NULL, '0.00', '0.00', '0.00'),
(106, 3, '2020-06-15', '23889.00', NULL, '0.00', '0.00', '0.00'),
(107, 3, '2020-06-30', '23881.00', NULL, '0.00', '0.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `id` int(11) NOT NULL,
  `loans_id` int(11) NOT NULL,
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
  `buckets_id` int(11) NOT NULL,
  `percentage` decimal(10,4) NOT NULL,
  `returns` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `loans_id`, `payments_id`, `investors_id`, `transactions_id`, `buckets_id`, `percentage`, `returns`) VALUES
(1, 1, 1, 0, 0, 3, '0.2000', '60.00'),
(2, 1, 1, 0, 0, 2, '0.1000', '30.00'),
(3, 1, 1, 2, 4, 1, '0.3100', '64.62'),
(4, 1, 1, 2, 3, 1, '0.1200', '24.23'),
(5, 1, 1, 1, 2, 1, '0.1900', '40.38'),
(6, 1, 1, 1, 1, 1, '0.3800', '80.77'),
(7, 1, 2, 0, 0, 3, '0.2000', '60.00'),
(8, 1, 2, 0, 0, 2, '0.1000', '30.00'),
(9, 1, 2, 2, 4, 1, '0.3077', '64.62'),
(10, 1, 2, 2, 3, 1, '0.1154', '24.23'),
(11, 1, 2, 1, 2, 1, '0.1923', '40.38'),
(12, 1, 2, 1, 1, 1, '0.3846', '80.77'),
(13, 1, 3, 0, 0, 3, '0.2000', '60.00'),
(14, 1, 3, 0, 0, 2, '0.1000', '30.00'),
(15, 1, 3, 2, 4, 1, '0.3077', '64.62'),
(16, 1, 3, 2, 3, 1, '0.1154', '24.23'),
(17, 1, 3, 1, 2, 1, '0.1923', '40.38'),
(18, 1, 3, 1, 1, 1, '0.3846', '80.77'),
(19, 1, 4, 0, 0, 5, '0.1000', '30.00'),
(20, 1, 4, 2, 4, 4, '0.3077', '83.08'),
(21, 1, 4, 2, 3, 4, '0.1154', '31.15'),
(22, 1, 4, 1, 2, 4, '0.1923', '51.92'),
(23, 1, 4, 1, 1, 4, '0.3846', '103.85'),
(24, 3, 36, 0, 0, 5, '0.1000', '1000.00'),
(25, 3, 36, 1, 8, 4, '0.6569', '5912.41'),
(26, 3, 36, 2, 7, 4, '0.0438', '394.16'),
(27, 3, 36, 1, 6, 4, '0.0365', '328.47'),
(28, 3, 36, 2, 5, 4, '0.0730', '656.93'),
(29, 3, 36, 2, 4, 4, '0.0584', '525.55'),
(30, 3, 36, 2, 3, 4, '0.0219', '197.08'),
(31, 3, 36, 1, 2, 4, '0.0365', '328.47'),
(32, 3, 36, 1, 1, 4, '0.0730', '656.93'),
(33, 1, 5, 0, 0, 5, '0.1000', '30.00'),
(34, 1, 5, 2, 7, 4, '0.1875', '50.63'),
(35, 1, 5, 2, 4, 4, '0.2500', '67.50'),
(36, 1, 5, 2, 3, 4, '0.0938', '25.31'),
(37, 1, 5, 1, 2, 4, '0.1563', '42.19'),
(38, 1, 5, 1, 1, 4, '0.3125', '84.38'),
(39, 1, 6, 0, 0, 5, '0.1000', '30.00'),
(40, 1, 6, 2, 7, 4, '0.1875', '50.63'),
(41, 1, 6, 2, 4, 4, '0.2500', '67.50'),
(42, 1, 6, 2, 3, 4, '0.0938', '25.31'),
(43, 1, 6, 1, 2, 4, '0.1563', '42.19'),
(44, 1, 6, 1, 1, 4, '0.3125', '84.38'),
(45, 2, 31, 0, 0, 5, '0.1000', '5.00'),
(46, 2, 31, 2, 7, 4, '0.1875', '8.44'),
(47, 2, 31, 2, 4, 4, '0.2500', '11.25'),
(48, 2, 31, 2, 3, 4, '0.0938', '4.22'),
(49, 2, 31, 1, 2, 4, '0.1563', '7.03'),
(50, 2, 31, 1, 1, 4, '0.3125', '14.06'),
(51, 2, 32, 0, 0, 5, '0.1000', '5.00'),
(52, 2, 32, 2, 7, 4, '0.1875', '8.44'),
(53, 2, 32, 2, 4, 4, '0.2500', '11.25'),
(54, 2, 32, 2, 3, 4, '0.0938', '4.22'),
(55, 2, 32, 1, 2, 4, '0.1563', '7.03'),
(56, 2, 32, 1, 1, 4, '0.3125', '14.06'),
(57, 1, 7, 0, 0, 5, '0.1000', '30.00'),
(58, 1, 7, 2, 7, 4, '0.1875', '50.63'),
(59, 1, 7, 2, 4, 4, '0.2500', '67.50'),
(60, 1, 7, 2, 3, 4, '0.0938', '25.31'),
(61, 1, 7, 1, 2, 4, '0.1563', '42.19'),
(62, 1, 7, 1, 1, 4, '0.3125', '84.38'),
(63, 3, 37, 0, 0, 5, '0.1000', '1000.00'),
(64, 3, 37, 1, 8, 4, '0.6569', '5912.41'),
(65, 3, 37, 2, 7, 4, '0.0438', '394.16'),
(66, 3, 37, 1, 6, 4, '0.0365', '328.47'),
(67, 3, 37, 2, 5, 4, '0.0730', '656.93'),
(68, 3, 37, 2, 4, 4, '0.0584', '525.55'),
(69, 3, 37, 2, 3, 4, '0.0219', '197.08'),
(70, 3, 37, 1, 2, 4, '0.0365', '328.47'),
(71, 3, 37, 1, 1, 4, '0.0730', '656.93'),
(72, 3, 38, 0, 0, 5, '0.1000', '1000.00'),
(73, 3, 38, 1, 8, 4, '0.6569', '5912.41'),
(74, 3, 38, 2, 7, 4, '0.0438', '394.16'),
(75, 3, 38, 1, 6, 4, '0.0365', '328.47'),
(76, 3, 38, 2, 5, 4, '0.0730', '656.93'),
(77, 3, 38, 2, 4, 4, '0.0584', '525.55'),
(78, 3, 38, 2, 3, 4, '0.0219', '197.08'),
(79, 3, 38, 1, 2, 4, '0.0365', '328.47'),
(80, 3, 38, 1, 1, 4, '0.0730', '656.93'),
(81, 3, 39, 0, 0, 5, '0.1000', '1000.00'),
(82, 3, 39, 1, 8, 4, '0.6569', '5912.41'),
(83, 3, 39, 2, 7, 4, '0.0438', '394.16'),
(84, 3, 39, 1, 6, 4, '0.0365', '328.47'),
(85, 3, 39, 2, 5, 4, '0.0730', '656.93'),
(86, 3, 39, 2, 4, 4, '0.0584', '525.55'),
(87, 3, 39, 2, 3, 4, '0.0219', '197.08'),
(88, 3, 39, 1, 2, 4, '0.0365', '328.47'),
(89, 3, 39, 1, 1, 4, '0.0730', '656.93'),
(90, 3, 40, 0, 0, 5, '0.1000', '1000.00'),
(91, 3, 40, 1, 8, 4, '0.6569', '5912.41'),
(92, 3, 40, 2, 7, 4, '0.0438', '394.16'),
(93, 3, 40, 1, 6, 4, '0.0365', '328.47'),
(94, 3, 40, 2, 5, 4, '0.0730', '656.93'),
(95, 3, 40, 2, 4, 4, '0.0584', '525.55'),
(96, 3, 40, 2, 3, 4, '0.0219', '197.08'),
(97, 3, 40, 1, 2, 4, '0.0365', '328.47'),
(98, 3, 40, 1, 1, 4, '0.0730', '656.93');

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
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `investor_id`, `date_of_transaction`, `amount_transaction`, `type_transaction`) VALUES
(1, '17-1-0001', 1, '2017-04-23', '1000000.00', 'I'),
(2, '17-1-0002', 1, '2017-04-24', '500000.00', 'I'),
(3, '17-2-0003', 2, '2017-04-23', '300000.00', 'I'),
(4, '17-2-0004', 2, '2017-04-24', '800000.00', 'I'),
(5, '17-2-0005', 2, '2017-05-01', '1000000.00', 'I'),
(6, '17-1-0006', 1, '2017-05-04', '500000.00', 'I'),
(7, '17-2-0007', 2, '2017-04-29', '600000.00', 'W'),
(8, '17-1-0008', 1, '2017-06-03', '9000000.00', 'I');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buckets`
--
ALTER TABLE `buckets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `effectivities`
--
ALTER TABLE `effectivities`
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
-- AUTO_INCREMENT for table `buckets`
--
ALTER TABLE `buckets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `effectivities`
--
ALTER TABLE `effectivities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
