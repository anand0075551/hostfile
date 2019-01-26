-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2016 at 05:26 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `rolename` varchar(60) COLLATE utf8_bin NOT NULL,
  `account_no` varchar(50) COLLATE utf8_bin NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `amount` double NOT NULL,
  `points_mode` varchar(20) COLLATE utf8_bin NOT NULL,
  `challan` varchar(60) COLLATE utf8_bin NOT NULL,
  `used` text COLLATE utf8_bin NOT NULL,
  `paid_to` varchar(50) COLLATE utf8_bin NOT NULL,
  `pay_type` varchar(255) COLLATE utf8_bin NOT NULL,
  `tranx_id` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `email`, `rolename`, `account_no`, `debit`, `credit`, `amount`, `points_mode`, `challan`, `used`, `paid_to`, `pay_type`, `tranx_id`, `active`, `created_at`, `modified_at`) VALUES
(1, '00', 'mr.anandsagar@gmail.com', '12', '105570017125559990001', 20, 0, 20, 'wallet', '', 'no', '00', '3', 'New member welcome offer', 0, 1479465634, 1479465634),
(2, '1', 'anandsagar007@gmail.com', '11', '1111111111111111', 10, 0, 10, 'wallet', '', 'no', '00', '2', 'New member welcome offer', 0, 1479465634, 1479465634),
(3, '00', 'bhavya.r.sagar@gmail.com', '12', '105560037129955995599', 20, 0, 20, 'wallet', '', 'no', '00', '3', 'New member Sponsorship', 0, 1479466869, 1479466869),
(4, '2', 'mr.anandsagar@gmail.com', '12', '105570017125559990001', 10, 0, 10, 'wallet', '', 'no', '00', '2', 'Joining offer', 0, 1479466869, 1479466869),
(5, '00', 'satishspatil21@gmail.com', '12', '105560001121234512345', 20, 0, 20, 'wallet', '', 'no', '00', '3', 'New member Sponsorship', 0, 1479467515, 1479467515),
(6, '2', 'mr.anandsagar@gmail.com', '12', '105570017125559990001', 10, 0, 10, 'wallet', '', 'no', '00', '2', 'Joining offer', 0, 1479467516, 1479467516),
(7, '4', 'satishspatil21@gmail.com', '12', '105560001121234512345', 0, 0, 0, 'wallet', '', 'yes', '00', '3', 'One time Sponsorship Charges Deduction', 0, 1479468234, 1479468234),
(8, '2', 'mr.anandsagar@gmail.com', '12', '105570017125559990001', 100, 0, 100, 'wallet', '', 'no', '00', '4', 'Sponsorship Commission', 0, 1479468234, 1479468234),
(9, '5', 'spremainder@gmail.com', '13', '105560001131122334455', 50, 0, 50, 'wallet', '', 'yes', '2', '34', 'Recieved Payment from Volunteer/Consumer-Anand for the Invoice ID-5', 0, 1479472426, 1479472426),
(10, '2', 'mr.anandsagar@gmail.com', '13', '105570017125559990001', 0, 50, 50, 'wallet', '', 'yes', '5', '34', 'Paid to ''Retailer-Satish'' for the Invoice ID-5', 0, 1479472426, 1479472426),
(11, '1', 'anandsagar007@gmail.com', '11', '1111111111111111', 0.1, 0, 0.1, 'loyality', '', 'no', '1', '36', 'Referrals Business benefits for Invoice ID-5', 0, 1479472426, 1479472426),
(12, '2', 'mr.anandsagar@gmail.com', '12', '105570017125559990001', 50, 0, 50, 'wallet', '', 'no', '5', '34', 'Volunteer/Consumer- commission for Invoice ID-5', 0, 1479472426, 1479472426),
(13, '5', 'spremainder@gmail.com', '13', '105560001131122334455', 50, 0, 50, 'wallet', '', 'no', '2', '34', 'Retailer- commission for Invoice ID -5', 0, 1479472426, 1479472426),
(14, '2', 'mr.anandsagar@gmail.com', '12', '105570017125559990001', 0, 0, 0, 'wallet', '', 'yes', '5', '34', 'Commission deduction from -Volunteer/Consumer-for Invoice ID -5', 0, 1479472426, 1479472426),
(15, '5', 'spremainder@gmail.com', '13', '105560001131122334455', 0, 0.5, 0.5, 'wallet', '', 'yes', '2', '34', 'Commission deduction from -Retailer-for Invoice ID -5', 0, 1479472427, 1479472427);

-- --------------------------------------------------------

--
-- Table structure for table `acct_categories`
--

CREATE TABLE `acct_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parentid` int(11) NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `ledger_type` int(2) NOT NULL,
  `visible` int(2) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acct_categories`
--

INSERT INTO `acct_categories` (`id`, `name`, `parentid`, `category_type`, `ledger_type`, `visible`, `added_by`, `created_at`, `modified_at`) VALUES
(1, 'Expenditures Registration', 0, 'main', 0, 0, 1, 1479030445, 1479030445),
(2, 'Customer/Volunteer Sponsorships', 1, 'sub', 0, 0, 1, 1479030624, 1479030624),
(3, 'Joining Offers(Consumers)', 1, 'sub', 0, 0, 1, 1479031615, 1479031615),
(4, 'Sponsorship offers For Retailer', 1, 'sub', 0, 0, 1, 1479236385, 1479236385),
(5, 'Sponsorship offers For Distributors', 1, 'sub', 0, 0, 1, 1479236400, 1479236400),
(6, 'Sponsorship offers For Area Manager ID', 1, 'sub', 0, 0, 1, 1479291026, 1479291026),
(7, 'Income Registration', 0, 'main', 1, 0, 1, 1479041370, 1479041370),
(8, 'Sponsorship For Retailer (Income)', 0, 'main', 0, 0, 1, 1479233884, 1479233884),
(9, 'Sponsorship For Distributor (Income)', 0, 'main', 0, 0, 1, 1479233937, 1479233937),
(10, 'Registration fees For Retailer ID', 7, 'sub', 1, 0, 1, 1479290958, 1479290958),
(11, 'Registration fees For Distributor Id', 7, 'sub', 1, 0, 1, 1479290891, 1479290891),
(12, 'Registration fees For Area Manager ID', 0, 'main', 1, 0, 1, 1479291069, 1479291069),
(13, 'Registration fees For Area Manager ID', 7, 'sub', 1, 0, 1, 1479291139, 1479291139),
(14, 'Exp. Legal Charges', 0, 'main', 0, 0, 1, 1479291360, 1479291360),
(15, 'Stationery(Consumables)', 19, 'sub', 0, 0, 1, 1479291412, 1479291412),
(16, 'Legal charges', 14, 'sub', 0, 0, 1, 1479291520, 1479291520),
(17, 'Company Assets', 0, 'main', 0, 0, 1, 1479292299, 1479292299),
(18, 'Electronic Devices', 17, 'sub', 0, 0, 1, 1479292346, 1479292346),
(19, 'Exp-All Stationaries', 0, 'main', 1, 0, 1, 1479292529, 1479292529),
(20, 'Payments(Goods)', 0, 'main', 1, 0, 1, 1479292879, 1479292879),
(21, 'Stationery(Printing)', 19, 'sub', 1, 0, 1, 1479292904, 1479292904),
(22, 'Electronics', 20, 'sub', 1, 0, 1, 1479292978, 1479292978),
(23, 'Bank Transactions', 0, 'main', 0, 0, 1, 1479293852, 1479293852),
(24, 'All Deposit to SBI HAL Branch-SBIN0016336', 23, 'sub', 0, 0, 1, 1479293961, 1479293961),
(25, 'Consumer Deposit to Corporation Bank', 23, 'sub', 0, 0, 1, 1479293991, 1479293991),
(26, 'Company Expenditure', 0, 'main', 1, 0, 1, 1479294040, 1479294040),
(27, 'Company Laptop EMI', 26, 'sub', 1, 0, 1, 1479294067, 1479294067),
(28, 'Bank Cash withdrawl', 0, 'main', 1, 0, 1, 1479294107, 1479294107),
(29, 'Cash Withdrawal at SBI HAL Branch IFSCode-SBIN016336', 28, 'sub', 1, 0, 1, 1479294159, 1479294159),
(30, 'EMI Payment through Cheque', 28, 'sub', 1, 0, 1, 1479294194, 1479294194),
(31, 'Transactions', 0, 'main', 0, 0, 1, 1479295461, 1479295461),
(32, 'Wallet Exchange', 31, 'sub', 0, 2, 1, 1479295501, 1479295501),
(33, 'Customer/Retailer Transactions', 0, 'main', 0, 0, 1, 1479296846, 1479296846),
(34, 'Purchase of products', 33, 'sub', 0, 2, 1, 1479296898, 1479296898),
(35, 'Commissions to All Pay wallet Transactions', 0, 'main', 0, 0, 1, 1479297209, 1479297209),
(36, 'From Retailer Commission', 35, 'sub', 0, 0, 1, 1479297242, 1479297242),
(37, 'Exp-All Allowances', 0, 'main', 0, 0, 1, 1479459101, 1479459101),
(38, 'From Promoters Allowances', 37, 'sub', 0, 0, 1, 1479459117, 1479459117),
(39, 'From Agents Allowances', 37, 'sub', 0, 0, 1, 1479459530, 1479459530),
(40, 'From Employee Allowances', 37, 'sub', 0, 0, 1, 1479459542, 1479459542),
(41, 'From Consumer''s Loyalty Amount', 35, 'sub', 0, 0, 1, 1479470809, 1479470809),
(42, 'From Agent''s Loyalty Amount', 35, 'sub', 0, 0, 1, 1479470843, 1479470843),
(43, 'From Area Manager''s Loyalty Amount', 35, 'sub', 0, 0, 1, 1479470913, 1479470913);

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(300) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `activity`, `created_at`) VALUES
(1, 1, 'Added Manager Finanace as User-Role', 1479016341),
(2, 1, 'Added Cash Dispatcher as User-Role', 1479016379),
(3, 1, 'Added Supreme Administrator as agent', 1479016891),
(4, 1, 'Added Accounts Manager as admin', 1479017366),
(5, 1, 'Unblocked Anand Sagar from Agent', 1479019443),
(6, 1, 'Blocked Supreme Administrator from Agent', 1479019859),
(7, 1, 'Unblocked Supreme Administrator from Agent', 1479019865),
(8, 1, 'Unblocked Satish Patil from Agent', 1479019873),
(9, 1, 'Added Retailor as User-Role', 1479019937),
(10, 5, 'Added Satish Patil as agent', 1479019977),
(11, 1, 'Added Customer as User-Role', 1479020280),
(12, 1, 'Added Expenditures Category', 1479030445),
(13, 1, 'Added Joining Offers(Consumers) Category', 1479030625),
(14, 1, 'Added Customer Sponsorships Category', 1479031615),
(15, 6, 'Unblocked Raghavendra S Atadavar from Agent', 1479033442),
(16, 1, 'Unblocked Girsh Patil from Agent', 1479035942),
(17, 1, 'Unblocked Girish R Kashyap from Agent', 1479036442),
(18, 1, 'Unblocked Hema P from Agent', 1479037556),
(19, 1, 'Unblocked Mehreilahi Dastgirsab Mulla from Agent', 1479037562),
(20, 11, 'Added Girish R Kashyap as agent', 1479039257),
(21, 1, 'Added Sponsorship For Retailor Category', 1479041251),
(22, 1, 'Added Sponsorship For Distributors Category', 1479041309),
(23, 1, 'Added Sponsorship For Area Manager Category', 1479041323),
(24, 1, 'Added Income Registration Category', 1479041370),
(25, 12, 'Added Wallet to Loyality points accounts', 1479042044),
(26, 1, 'Updated Sponsorship For Area Manager2 acct_categories', 1479061233),
(27, 1, 'Updated Sponsorship For Area Manager acct_categories', 1479061245),
(28, 5, 'Added   as agent', 1479133209),
(29, 5, 'Added   as agent', 1479133264),
(30, 5, 'Added   as agent', 1479133509),
(31, 1, 'Added   as agent', 1479133770),
(32, 1, 'Added   as agent', 1479134242),
(33, 5, 'Added   as agent', 1479137642),
(34, 5, 'Added   as agent', 1479137764),
(35, 5, 'Added   as agent', 1479137828),
(36, 5, 'Added   as agent', 1479137859),
(37, 5, 'Added   as agent', 1479139075),
(38, 5, 'Added   as agent', 1479139533),
(39, 1, 'Added   as agent', 1479140661),
(40, 1, 'Added   as agent', 1479140837),
(41, 1, 'Added   as agent', 1479141691),
(42, 5, 'Added Anand Sagar as agent', 1479174398),
(43, 5, 'Added   as agent', 1479178967),
(44, 1, 'Unblocked Harish Patil from Agent', 1479179316),
(45, 21, 'Added   as agent', 1479179378),
(46, 21, 'Added   as agent', 1479179710),
(47, 21, 'Added   as agent', 1479179998),
(48, 21, 'Added Harish Patil as agent', 1479181380),
(49, 21, 'Added   as agent', 1479184779),
(50, 21, 'Added   as agent', 1479185792),
(51, 5, 'Added Anand Sagar as agent', 1479186446),
(52, 1, 'Added  ledger', 1479186556),
(53, 5, 'Added  as Agent- Referral', 1479222218),
(54, 5, 'Added  as Agent- Referral', 1479222579),
(55, 5, 'Added  as Agent- Referral', 1479222736),
(56, 5, 'Added  as Agent- Referral', 1479223016),
(57, 5, 'Added  as Agent- Referral', 1479223826),
(58, 5, 'Added  as Agent- Referral', 1479232815),
(59, 1, 'Added Sponsorship For Retailor (Income) Category', 1479233884),
(60, 1, 'Added Sponsorship For Distributor (Income) Category', 1479233937),
(61, 1, 'Added Sponsorship fees collection For Retailor Category', 1479235058),
(62, 1, 'Added Sponsorship fees collection For Distributor Category', 1479235128),
(63, 1, 'Updated Sponsorship fees collection For Distributor acct_categories', 1479235481),
(64, 1, 'Updated Sponsorship For Area Manager acct_categories', 1479235496),
(65, 1, 'Updated Sponsorship Commission For Retailor acct_categories', 1479236385),
(66, 1, 'Updated Sponsorship Commission For Distributors acct_categories', 1479236400),
(67, 1, 'Added Distributor as User-Role', 1479238210),
(68, 1, 'Added Area Manager as User-Role', 1479238368),
(69, 1, 'Added C&F Manager as User-Role', 1479239100),
(70, 1, 'Added Clerical as User-Role', 1479239173),
(71, 1, 'Added Division Supervisor as User-Role', 1479239341),
(72, 5, 'Added  as Agent- Referral', 1479241983),
(73, 5, 'Added karate@gmail.com as agent', 1479244397),
(74, 5, 'Added karate@gmail.com as agent', 1479244804),
(75, 5, 'Added kstores@gmail.com as agent', 1479245206),
(76, 5, 'Added Anand Sagar as agent', 1479245496),
(77, 1, 'Added  ledger', 1479245533),
(78, 5, 'Added karate@gmail.com as agent', 1479245644),
(79, 5, 'Added karate@gmail.com as agent', 1479245868),
(80, 6, 'Added  as Agent- Referral', 1479282038),
(81, 5, 'Added sagar@gmail.com as agent', 1479282169),
(82, 5, 'Added  as Agent- Referral', 1479282484),
(83, 5, 'Added sstores@gmail.com as agent', 1479282538),
(84, 1, 'Added Opterator-Computer as User-Role', 1479283429),
(85, 6, 'Added  as Agent- Referral', 1479283587),
(86, 6, 'Added cdp11@gmail.com as agent', 1479283700),
(87, 1, 'Updated Registration fees For Distributor Id acct_categories', 1479290891),
(88, 1, 'Updated Registration fees For Retailer ID acct_categories', 1479290958),
(89, 1, 'Updated Registration fees For Area Manager ID acct_categories', 1479290978),
(90, 1, 'Updated Sponsorship Commission For Area Manager ID acct_categories', 1479291026),
(91, 1, 'Added Registration fees For Area Manager ID Category', 1479291069),
(92, 1, 'Added Registration fees For Area Manager ID Category', 1479291139),
(93, 1, 'Added Exp. Stationery(Head Office) Category', 1479291360),
(94, 1, 'Added Stationery Consumables Category', 1479291412),
(95, 1, 'Added Exp. Legal charges Category', 1479291520),
(96, 1, 'Added Company Assets Category', 1479292299),
(97, 1, 'Added Electronic Devices Category', 1479292347),
(98, 1, 'Added Payments Category', 1479292529),
(99, 1, 'Added Payments Category', 1479292879),
(100, 1, 'Added Salary Category', 1479292905),
(101, 1, 'Added Electronics Category', 1479292978),
(102, 1, 'Added Bank Cash Deposit Category', 1479293852),
(103, 1, 'Added Consumer Deposit to SBI HAL Branch Category', 1479293884),
(104, 1, 'Updated Consumer Deposit to SBI HAL Branch-SBIN0016336 acct_categories', 1479293961),
(105, 1, 'Added Consumer Deposit to Corporation Bank Category', 1479293991),
(106, 1, 'Added Company Expenditure Category', 1479294040),
(107, 1, 'Added Company Laptop EMI Category', 1479294067),
(108, 1, 'Added Bank Cash withdrawl Category', 1479294107),
(109, 1, 'Added Cash Withdrawal at SBI HAL Branch IFSCode-SBIN016336 Category', 1479294159),
(110, 1, 'Added EMI Payment through Cheque Category', 1479294194),
(111, 1, 'Unblocked Vasnath B from Agent', 1479294627),
(112, 5, 'Added Anand Sagar as agent', 1479294706),
(113, 1, 'Added  ledger', 1479294790),
(114, 32, 'Added Vasnath B as agent', 1479295077),
(115, 1, 'Added  ledger', 1479295215),
(116, 1, 'Added Transactions Category', 1479295461),
(117, 1, 'Added Wallet Exchange Category', 1479295502),
(118, 1, 'Added Cash withdrawal as User-Role', 1479295989),
(119, 6, 'Added Satish Patil as agent', 1479296069),
(120, 1, 'Added  ledger', 1479296246),
(121, 1, 'Added Customer/Retailer Transactions Category', 1479296847),
(122, 1, 'Added Purchase of products Category', 1479296898),
(123, 1, 'Added Commissions to All Pay wallet Transactions Category', 1479297209),
(124, 1, 'Added From Retailer Commission Category', 1479297242),
(125, 1, 'Added Consumer Retailer Commission setup commissions', 1479297508),
(126, 6, 'Unblocked New Small from Agent', 1479395633),
(127, 1, 'Added Stationary Branch Manager as User-Role', 1479404332),
(128, 6, 'Added  as Agent- Referral', 1479405907),
(129, 6, 'Added vkrice@gmail.com as agent', 1479406055),
(130, 6, 'Added vkrice@gmail.com as agent', 1479406427),
(131, 6, 'Added  as Agent- Referral', 1479407492),
(132, 6, 'Added icecream@gmail.com as agent', 1479407531),
(133, 6, 'Added  as Agent- Referral', 1479408852),
(134, 6, 'Added asade@gmail.com as agent', 1479408886),
(135, 6, 'Added  as Agent- Referral', 1479409268),
(136, 6, 'Added  as Agent- Referral', 1479409335),
(137, 6, 'Added cycle1@gmail.com as agent', 1479409399),
(138, 6, 'Added  as Agent- Referral', 1479409668),
(139, 6, 'Added shopers@gmail.com as agent', 1479409695),
(140, 6, 'Added  as Agent- Referral', 1479410284),
(141, 6, 'Added scoot@gmail.com as agent', 1479410322),
(142, 1, 'Added Area Manager(Lead) as User-Role', 1479457740),
(143, 1, 'Added Exp-All Allowances Category', 1479459101),
(144, 1, 'Added From Promoters Allowances Category', 1479459117),
(145, 1, 'Added From Agents Allowances Category', 1479459530),
(146, 1, 'Added From Employee Allowances Category', 1479459542),
(147, 1, 'Unblocked Anand Sagar from Agent', 1479466086),
(148, 2, 'Unblocked Bhavya Sagar from Agent', 1479467041),
(149, 2, 'Unblocked Satish Patil from Agent', 1479467583),
(150, 2, 'Added  as Agent- Referral', 1479468060),
(151, 4, 'Added spremainder@gmail.com as agent', 1479468234),
(152, 1, 'Added From Consumer''s Loyalty Amount Category', 1479470809),
(153, 1, 'Added From Agent''s Loyalty Amount Category', 1479470843),
(154, 1, 'Added From Area Manager''s Loyalty Amount Category', 1479470914),
(155, 1, 'Added Consumer Retailer Commission setup commissions', 1479471152),
(156, 1, 'Added Retailer/Distributors Commission commissions', 1479471449),
(157, 1, 'Added Comm setup commissions', 1479493073),
(158, 1, 'Updated Comm setup commissions', 1479493577),
(159, 1, 'Updated Comm setup commissions', 1479494477),
(160, 1, 'Updated Comm setup commissions', 1479494534),
(161, 1, 'Updated Comm setup commissions', 1479494569);

-- --------------------------------------------------------

--
-- Table structure for table `admin_settings`
--

CREATE TABLE `admin_settings` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `default_email` varchar(200) NOT NULL,
  `agent_commision` float NOT NULL,
  `user_commision` float NOT NULL,
  `referral_commision` float NOT NULL,
  `admin_commision` float NOT NULL,
  `contact_address` text NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_settings`
--

INSERT INTO `admin_settings` (`id`, `company_name`, `default_email`, `agent_commision`, `user_commision`, `referral_commision`, `admin_commision`, `contact_address`, `updated_by`, `updated_at`) VALUES
(1, '', 'anand007555@gmail.com', 8, 4, 3, 25, '', 0, 0),
(3, 'Company Name', 'anand007555@gmail.com', 12, 9, 7, 25, '', 1, 1430937873),
(4, '', 'anand007555@gmail.com', 12, 9, 7, 25, '', 1, 1440005264),
(5, '', 'anand007555@gmail.com', 12, 9, 7, 25, '', 1, 1440005269),
(6, 'Company Name', 'anand007555@gmail.com', 12, 9, 7, 25, '', 1, 1440005369),
(7, 'Myfair''s Wallet Application Technology (My WAT)', 'anand007555@gmail.com', 30, 100, 200, 50, '', 43, 1464457770),
(8, 'Myfair''s Wallet Application Technology (My WAT)', 'anand007555@gmail.com', 30, 100, 200, 50, '', 43, 1464457831);

-- --------------------------------------------------------

--
-- Table structure for table `authorizations`
--

CREATE TABLE `authorizations` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `rolename` varchar(255) NOT NULL,
  `page_id` int(3) NOT NULL,
  `access` int(2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `modified_by` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authorizations`
--

INSERT INTO `authorizations` (`id`, `role`, `rolename`, `page_id`, `access`, `created_by`, `created_at`, `modified_at`, `modified_by`) VALUES
(65, 'admin', '1', 1, 1, 43, 1474382148, 1474382148, '43'),
(66, 'admin', '1', 2, 1, 43, 1474382148, 1474382148, '43'),
(67, 'admin', '1', 3, 1, 43, 1474382148, 1474382148, '43'),
(68, 'admin', '1', 4, 1, 43, 1474382148, 1474382148, '43'),
(69, 'admin', '1', 5, 1, 43, 1474382148, 1474382148, '43'),
(70, 'admin', '1', 6, 1, 43, 1474382148, 1474382148, '43'),
(71, 'admin', '1', 7, 1, 43, 1474382148, 1474382148, '43'),
(72, 'admin', '1', 8, 1, 43, 1474382148, 1474382148, '43'),
(73, 'admin', '1', 9, 1, 43, 1474382148, 1474382148, '43'),
(74, 'admin', '1', 10, 1, 43, 1474382148, 1474382148, '43'),
(75, 'admin', '1', 11, 1, 43, 1474382148, 1474382148, '43'),
(76, 'admin', '1', 12, 1, 43, 1474382148, 1474382148, '43'),
(77, 'admin', '1', 13, 1, 43, 1474382148, 1474382148, '43'),
(78, 'admin', '1', 14, 1, 43, 1474382148, 1474382148, '43'),
(79, 'admin', '1', 15, 1, 43, 1474382148, 1474382148, '43'),
(80, 'admin', '1', 16, 1, 43, 1474382148, 1474382148, '43'),
(81, 'admin', '1', 17, 1, 43, 1474382148, 1474382148, '43'),
(82, 'admin', '1', 18, 1, 43, 1474382148, 1474382148, '43'),
(83, 'admin', '1', 19, 1, 43, 1474382148, 1474382148, '43'),
(84, 'admin', '1', 20, 1, 43, 1474382148, 1474382148, '43'),
(85, 'admin', '1', 21, 1, 43, 1474382148, 1474382148, '43'),
(86, 'admin', '1', 22, 1, 43, 1474382148, 1474382148, '43'),
(87, 'admin', '1', 23, 1, 43, 1474382148, 1474382148, '43'),
(88, 'admin', '1', 24, 1, 43, 1474382148, 1474382148, '43'),
(89, 'admin', '1', 25, 1, 43, 1474382148, 1474382148, '43'),
(90, 'admin', '1', 26, 1, 43, 1474382148, 1474382148, '43'),
(91, 'admin', '1', 27, 1, 43, 1474382148, 1474382148, '43'),
(92, 'admin', '1', 28, 1, 43, 1474382148, 1474382148, '43'),
(93, 'admin', '1', 29, 1, 43, 1474382148, 1474382148, '43'),
(94, 'admin', '1', 30, 1, 43, 1474382148, 1474382148, '43'),
(95, 'admin', '1', 31, 1, 43, 1474382148, 1474382148, '43'),
(96, 'admin', '1', 32, 1, 43, 1474382149, 1474382149, '43'),
(97, 'admin', '1', 33, 1, 43, 1474382149, 1474382149, '43'),
(98, 'admin', '1', 34, 1, 43, 1474382149, 1474382149, '43'),
(99, 'admin', '1', 35, 1, 43, 1474382149, 1474382149, '43'),
(100, 'admin', '1', 36, 1, 43, 1474382149, 1474382149, '43'),
(101, 'admin', '1', 37, 1, 43, 1474382149, 1474382149, '43'),
(102, 'admin', '1', 38, 1, 43, 1474382149, 1474382149, '43'),
(103, 'admin', '1', 39, 1, 43, 1474382149, 1474382149, '43'),
(104, 'admin', '1', 40, 1, 43, 1474382149, 1474382149, '43'),
(105, 'admin', '1', 41, 1, 43, 1474382149, 1474382149, '43'),
(106, 'admin', '1', 42, 1, 43, 1474382149, 1474382149, '43'),
(107, 'admin', '1', 43, 1, 43, 1474382149, 1474382149, '43'),
(108, 'admin', '1', 44, 1, 43, 1474382149, 1474382149, '43'),
(109, 'admin', '1', 45, 1, 43, 1474382149, 1474382149, '43'),
(110, 'admin', '1', 46, 1, 43, 1474382149, 1474382149, '43'),
(111, 'admin', '1', 47, 1, 43, 1474382149, 1474382149, '43'),
(112, 'admin', '1', 48, 1, 43, 1474382149, 1474382149, '43'),
(113, 'admin', '1', 49, 1, 43, 1474382149, 1474382149, '43'),
(114, 'admin', '1', 50, 1, 43, 1474382149, 1474382149, '43'),
(115, 'admin', '1', 51, 1, 43, 1474382149, 1474382149, '43'),
(116, 'admin', '1', 52, 1, 43, 1474382149, 1474382149, '43'),
(117, 'admin', '1', 53, 1, 43, 1474382149, 1474382149, '43'),
(118, 'admin', '1', 54, 1, 43, 1474382149, 1474382149, '43'),
(119, 'admin', '1', 55, 1, 43, 1474382149, 1474382149, '43'),
(120, 'admin', '1', 56, 1, 43, 1474382149, 1474382149, '43'),
(121, 'admin', '1', 57, 1, 43, 1474382149, 1474382149, '43'),
(122, 'admin', '1', 58, 1, 43, 1474382149, 1474382149, '43'),
(123, 'admin', '1', 59, 1, 43, 1474382149, 1474382149, '43'),
(124, 'admin', '1', 60, 1, 43, 1474382149, 1474382149, '43');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tranx_id` varchar(20) NOT NULL,
  `transaction_type` varchar(30) NOT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `transaction_date` varchar(30) DEFAULT NULL,
  `postal_code` int(20) NOT NULL,
  `adhaar_no` varchar(255) NOT NULL,
  `passport_no` varchar(255) NOT NULL,
  `rolename` varchar(200) NOT NULL,
  `active` varchar(100) NOT NULL,
  `referral_code` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `referredByCode` varchar(50) NOT NULL,
  `challan` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `sub_acct_id` int(11) NOT NULL,
  `commission_percent` float NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('002cfbdfa6c286e58c987bddb92c85deca4a3794', '127.0.0.1', 1479523193, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393532333139333b),
('018fdb5a8692e26c0e2d91eda1afe98b9ca5b97c', '127.0.0.1', 1479407593, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430373539333b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('019d1fb22ce516430ec0806b4be1e6d20320d7e8', '127.0.0.1', 1479438757, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393433383735363b),
('04951a928ae5f7f59ed758f3122bb1d777abb939', '127.0.0.1', 1479441975, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393434313937343b72656469726563745f617574685f7572697c733a32363a2263617465676f72792f6164645f616363745f63617465676f7279223b),
('073206e73839571743dd0f29ff50e275ad8b15d3', '127.0.0.1', 1479472611, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323631303b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('08f369335b311013e147635dd19090f5c4514329', '127.0.0.1', 1479468413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383431333b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('0bb9a0be3844f3dee47e68cbed37d2361a258482', '127.0.0.1', 1479454877, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343837373b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('0c8fe2ef3afb41914286ba3b36f646c3163a32a9', '127.0.0.1', 1479374898, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337343437363b),
('0cb745a1f292d96d49cc1a2f97e9f20b1755c183', '127.0.0.1', 1479379924, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393932343b),
('0d2a9af00b48112a5ee4b9a5137decb1bb89341b', '127.0.0.1', 1479296047, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363034373b72656469726563745f617574685f7572697c733a31383a226167656e742f7665726966795f6167656e74223b),
('0e1439fd99bb8bd83ba93bf8845b318b058739b2', '127.0.0.1', 1479493077, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439333037373b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('0edb6177a46e35122936cb2cb464648990ddeb16', '127.0.0.1', 1479466904, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436363930333b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('0fbada2c2ffdb81f0879bcc12a047c6a085c783e', '127.0.0.1', 1479298165, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383136353b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('1032daca045ccc22d964b59a0c123b92ac2842e8', '127.0.0.1', 1479381920, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338313932303b),
('1052dbde87a4ed18cfef2e9f71bdd8c2289e421e', '127.0.0.1', 1479456793, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435363739323b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('1081501ed004dbf311308081c7a5fa5e33520a79', '127.0.0.1', 1479398137, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339383133373b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('1232a4fc932c4efa0e6cb976633a333269d27460', '127.0.0.1', 1479470727, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303732363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('12f0c4447bc71a6ddbcbf5f3e32cdd44a8fa94ee', '127.0.0.1', 1479469615, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436393631353b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('12f6b9647e6644f5401bb3b8c5365900352b27b8', '127.0.0.1', 1479380663, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338303636333b),
('1340f202ce4a0f1d6b79962d3ad1b2fdef2b560e', '127.0.0.1', 1479374924, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337343932343b),
('13e54da3fa67e4a391d7c128e75c9a8de9bdb74b', '127.0.0.1', 1479407579, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430373537393b72656469726563745f617574685f7572697c733a32383a226163636f756e742f62616c616e636573686565745f766965772f3435223b),
('14afc1d714ace2a8e5801f0eb3a7c3d195f14383', '127.0.0.1', 1479468515, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383531343b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('176ca1ce50a23460071c9ffb3820a201405b9902', '127.0.0.1', 1479462369, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436323336383b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('17ad1fdf48083c5dae717e2e7cb8e2cc3e7dc23a', '127.0.0.1', 1479393800, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339333830303b),
('192683607c2934eaa87f02c09b11ee50d1f0f3a2', '127.0.0.1', 1479493570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439333537303b72656469726563745f617574685f7572697c733a32353a226c65646765722f656469745f636f6d6d697373696f6e732f34223b),
('192f692d69d2cecf7ad6affab247f1f18e68bedb', '127.0.0.1', 1479297185, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373138343b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('1974ec926df92528ccdb328a24e7c240cc767ae9', '127.0.0.1', 1479468276, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383237363b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('1ac4a2823ac4dd6bc0bd800b22048fa18d270dbf', '127.0.0.1', 1479394064, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339343036333b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3336223b),
('1d4e6a811c7df7d1baf95385741337749ae9e660', '127.0.0.1', 1479494588, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343538373b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('1ddc13d421cffdc2fe7bff05fca1fec28a0d5431', '127.0.0.1', 1479296069, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393238313635353b72656469726563745f617574685f7572697c733a31383a226167656e742f7665726966795f6167656e74223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32343a2273617469736873706174696c323140676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2236223b733a343a22726f6c65223b733a343a2275736572223b733a393a226c6f676765645f696e223b623a313b7d),
('1e1fc2290e90d8a18746c9eda8dec01804198452', '127.0.0.1', 1479377728, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337373732383b),
('1e2632b185a966707cfe00f9029c741edc6cbfc6', '127.0.0.1', 1479295993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239353939333b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('1e673087153b053d50147889a52c126a57e78205', '127.0.0.1', 1479379352, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393335323b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('1ec2dff2996172729c0b9184faf8c54122b7154e', '127.0.0.1', 1479454145, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343134343b),
('1ff27502a6a21a7200ccd2beb0178064cb4a0925', '127.0.0.1', 1479470225, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303232343b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('205c1358f8eaecb59553e717b293aa8deda0df6d', '127.0.0.1', 1479467263, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373236323b72656469726563745f617574685f7572697c733a31323a22757365722f70726f66696c65223b),
('2067b1c04465e4434cc103ed3a7658a9f2b99da1', '127.0.0.1', 1479297684, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373638343b72656469726563745f617574685f7572697c733a383a2263617465676f7279223b),
('20e0d7661aa58a6a095c24b212bc790a77d7243c', '127.0.0.1', 1479494752, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343735313b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('23de3a47c762b64a25baabdf0a561c17892d82cb', '127.0.0.1', 1479472555, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323535343b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('249960529f1a0b4e5b7b9bd6724ed85601405ebc', '127.0.0.1', 1479470884, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303838333b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('2503e036c3aa9f74e214233eda20c24b38bbcacf', '127.0.0.1', 1479298062, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383036313b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('25cc7bd9bda5bcb2f6fa64e81feac79d5b0287c4', '127.0.0.1', 1479462261, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436323236303b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('26dda0d5f27ecc126bd50412bbab99a78204628b', '127.0.0.1', 1479297952, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373935313b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('26ecdf7f6e04ce8339d899ebc3ba91ca9a970d0a', '127.0.0.1', 1479441979, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393434313937393b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('27624914ca6f772a3044540d166a2993e67170f2', '127.0.0.1', 1479438993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393433383939333b72656469726563745f617574685f7572697c733a32363a2263617465676f72792f6164645f616363745f63617465676f7279223b),
('278647cd890dbb6d3a854f340373eb4963a840a5', '127.0.0.1', 1479298900, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383839393b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('278cefe3dc652f85417ac4d6f1328921ad917495', '127.0.0.1', 1479472580, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323537393b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('28ba48539368b0e2cfca79a23b3b51feee79a33a', '127.0.0.1', 1479470185, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303138343b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('2948eabe98508795481129e949c9b226446b393f', '127.0.0.1', 1479410358, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431303335383b72656469726563745f617574685f7572697c733a32323a226c65646765722f706179737065635f766965772f3531223b),
('2c0f7a630a8cc7ea6a92858ebe050c4b91d8c49f', '127.0.0.1', 1479472588, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323538373b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('2cb3b6e97e1aafb5d1e3b6cba7d0de78e3903c84', '127.0.0.1', 1479454195, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343139353b72656469726563745f617574685f7572697c733a32363a2263617465676f72792f6164645f616363745f63617465676f7279223b),
('2d54eb6a83b16199354dde6769a341c97be88285', '127.0.0.1', 1479471631, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313633313b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('2e4b77f5d41956aeb0617be963c9410670bccf92', '127.0.0.1', 1479438781, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393433383738303b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('2ec0b318c31095c7e9f3fb32ec5a931d371a6311', '127.0.0.1', 1479296324, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363332343b72656469726563745f617574685f7572697c733a32313a226c65646765722f706179737065635f766965772f35223b),
('2ef70f41d4c2e9d006bb9705157fefc451d505ae', '127.0.0.1', 1479296338, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363333383b72656469726563745f617574685f7572697c733a32313a226c65646765722f706179737065635f766965772f34223b),
('2f515d8f180d1c52a83265b36d59900fd6fee041', '127.0.0.1', 1479298066, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383036353b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('2fb02eae7895be3c3bd1ee737ad6e2ea88a8fe51', '127.0.0.1', 1479406562, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363536313b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('306bf8fa676703435d6d9859b41f19ac5cb71e56', '127.0.0.1', 1479488160, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393438383136303b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('30a1dd0c6371f33b27190ff06235c796ff48680e', '127.0.0.1', 1479296259, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363235383b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('30aae633542497bc12faacc01c35bf14e75c70d7', '127.0.0.1', 1479297511, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373531313b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('31d123ba173d0d75e049e99cf4fb02078606cd8c', '127.0.0.1', 1479468254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383235343b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('3327ae7444be0764dc3d7a95691ea9f3658a40bb', '127.0.0.1', 1479379239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393233383b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('3356a4cd49c8035b5c905ef52f46e490742ab21c', '127.0.0.1', 1479400767, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430303736363b72656469726563745f617574685f7572697c733a32353a226c65646765722f656469745f636f6d6d697373696f6e732f31223b),
('341842c2e87346df1ccd4bd7914e2e505889cb8f', '127.0.0.1', 1479405412, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353431323b72656469726563745f617574685f7572697c733a32333a226167656e742f726566657272616c5f7061796d656e7473223b),
('348112129e00c6a13fa1d55fa2fe172bed669a76', '127.0.0.1', 1479462548, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436323534373b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('349dfb67323c3502016fdadfdbd23bedd82c6d43', '127.0.0.1', 1479400763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430303736323b72656469726563745f617574685f7572697c733a32353a226c65646765722f636f6d6d697373696f6e735f766965772f31223b),
('38f9d15d78245b7e789af4ee403dee39e249b0d9', '127.0.0.1', 1479454842, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343834323b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('3a094e4761c1198afb97a1e073c1584d734dd14e', '127.0.0.1', 1479298069, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383036393b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('3ab75e86817235f19923aa9adb2c09046d8d2fed', '127.0.0.1', 1479296059, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363035393b72656469726563745f617574685f7572697c733a31393a2262616e6b2f636173685f77697468647261776c223b),
('3af3950666fa9d00142746fe23eed37a45b87093', '127.0.0.1', 1479470880, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303837393b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('3bc3a945b1af84c16ed81f6eda70812909bf3d4a', '127.0.0.1', 1479379191, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393139313b),
('3d4ef3c5cf30e7aebfebab8f44f50612dca0c284', '127.0.0.1', 1479454929, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343932393b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('3ed54d89e8e95488f27ed39900fdfdc67ea6de96', '127.0.0.1', 1479471211, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313231313b72656469726563745f617574685f7572697c733a32353a226c65646765722f636f6d6d697373696f6e735f766965772f32223b),
('3f7db5402192293dd0ad0376dd5a4de746ffd1bb', '127.0.0.1', 1479379246, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393234353b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('3faa07e73a420a961dd760b9c7a2bea8af667f03', '127.0.0.1', 1479472751, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323735303b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('4025e94cacc698601dfd05c39e717d66a5a7dca9', '127.0.0.1', 1479405417, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353431373b72656469726563745f617574685f7572697c733a31383a226167656e742f6164645f6167656e742f3238223b),
('41e5c6df50d971dced0e131255a8e510a70d8cda', '127.0.0.1', 1479454228, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343232383b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('439965737fc77da725cd05a8d326f21b332677a3', '127.0.0.1', 1479297534, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373533333b72656469726563745f617574685f7572697c733a32353a226c65646765722f636f6d6d697373696f6e735f766965772f31223b),
('44408bd2c2c4b4af94fef26558abeb608f880ff8', '127.0.0.1', 1479468314, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383331333b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('44a92ea6acd083573dedeb2564782b0fa7644fc4', '127.0.0.1', 1479494699, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343639383b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('4632b7ceb4b34281754156043a5851f96cdab77f', '127.0.0.1', 1479408700, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430383639393b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('46ac50521fe39feffa45ebb858a13ecbf87472b9', '127.0.0.1', 1479394346, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339343334353b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('4785c02bb699e61a218ff915136b99773b9447de', '127.0.0.1', 1479406006, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363030353b72656469726563745f617574685f7572697c733a31373a2270726f647563742f696e766f6963652f33223b),
('48abaeaa654de5ffe7eec5740eca5aaac3964c8d', '127.0.0.1', 1479405659, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353635383b72656469726563745f617574685f7572697c733a32333a226167656e742f726566657272616c5f7061796d656e7473223b),
('48fbf4a7a5e1e46382cef0814bb49e6b36c22646', '127.0.0.1', 1479406333, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363333333b72656469726563745f617574685f7572697c733a32333a226167656e742f726566657272616c5f7061796d656e7473223b),
('48fed810a7afba7170b2846e74b64b70870ef0c8', '127.0.0.1', 1479472689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323638383b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('4914b30cd56fb647a8b2db2b74a33fdbf118a1c1', '127.0.0.1', 1479471199, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313139383b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('49238f2eff1e8578c3dcbde220eda6281f0080f2', '127.0.0.1', 1479378146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337383134363b),
('493a577b474985a9084438eda3841026589b2171', '127.0.0.1', 1479296480, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363438303b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('4b0779d081cc4b3465bdb208d4b48727bdf15cd4', '127.0.0.1', 1479469277, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436393237373b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('4b2dbadd070234b0d3fce01d288575ba2d0d5278', '127.0.0.1', 1479403244, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430333234343b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('4b4f75c5127826746933971b319b6402b4dfc9ed', '127.0.0.1', 1479394168, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339343136373b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('4be4e08862a86b7c92265c910de7ac175f7c415c', '127.0.0.1', 1479373249, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337333234393b),
('4c372d5dd18dafc7a8f026bee9b64502929cb5fd', '127.0.0.1', 1479296440, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363434303b72656469726563745f617574685f7572697c733a32333a226c65646765722f7472616e736665725f6361706974616c223b),
('4c47814bdb2ef8656fb433b7d9a00bcb4e0b25bf', '127.0.0.1', 1479409354, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430393335343b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('4d1bf0a324592d0b1b72b93406d45856235d57d2', '127.0.0.1', 1479470731, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303733303b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('4edc2b0bb5a93d61cb04e1b5ccb23f78f5ae9810', '127.0.0.1', 1479487300, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393438373239393b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('4f6fa80c59364ed5c5f7b951f77ffc264528513e', '127.0.0.1', 1479463022, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436333032323b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('4f7415a2c6c61a87227664267184bed381d38338', '127.0.0.1', 1479393810, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339333831303b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('4fcee58838c4a3401f57f80f204d601756b2e6fa', '127.0.0.1', 1479488174, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393438383137333b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('50991f8f848fbafc1a27bbfd0b664d5df490dfa2', '127.0.0.1', 1479411394, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431313339343b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('5170dd20e7a2411e222376c291fedd70fbf25bd1', '127.0.0.1', 1479471453, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313435333b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('51eb4f67c5453f392b9ac4c53859a9105269b538', '127.0.0.1', 1479407556, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430373535363b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('5511c7afca2de353537a813e201a5e16d6bbc10e', '::1', 1479494955, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393438373238363b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2231223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('5677cdf0e59b0c386d39cf30ca5efd52c1dd9493', '127.0.0.1', 1479468467, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383436363b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('572a7571934d4f296c28914de145b0750afc2221', '127.0.0.1', 1479523226, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393532333232353b72656469726563745f617574685f7572697c733a32343a2270726f647563742f73657276696365735f70726570616964223b),
('58fe1099068d6b5f23ed00715fbea4523d14063e', '127.0.0.1', 1479406400, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363430303b72656469726563745f617574685f7572697c733a31373a2270726f647563742f696e766f6963652f34223b),
('5a2c1ccca2e081cc5c52bdadcb45342be401dcb3', '127.0.0.1', 1479410344, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431303334343b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3531223b),
('5aa4055d6491f379cf5117ade9f937c45090e597', '127.0.0.1', 1479467136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373133353b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('5b7170d504d208d6c8e79d512a939f6dd145ab57', '127.0.0.1', 1479297098, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373039383b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('5b98d7c891b1aee4d8b9d2ee9e8fbda05688117e', '127.0.0.1', 1479295888, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239353838373b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('5d2c809f8b1f0c5816dfc217ddeaf7ab94ac0312', '127.0.0.1', 1479463019, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436333031383b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('5d4ad6c5609ed5bcf0b258a6f36c554f86f04ac7', '127.0.0.1', 1479375169, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337353136383b),
('5eb7d2739f19cfcef679849b7dd31d14d120f2fe', '127.0.0.1', 1479468262, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383236323b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('6087b5ef74ace531c8c18612d3f7c316171006dd', '127.0.0.1', 1479295891, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239353839313b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('609a31ff6f54b9d588ac27542d80c1581880d6f3', '127.0.0.1', 1479468656, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383635363b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('6105fc745ec0f7118b923ba554e11b3cc66a5ddd', '127.0.0.1', 1479494767, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343736373b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('62ba6d3f45afbd2b3cc56e3210680de00e6f976a', '127.0.0.1', 1479471604, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313630343b72656469726563745f617574685f7572697c733a32353a226c65646765722f636f6d6d697373696f6e735f766965772f33223b),
('62cc4038b77638a5839be19a15da2a89149cbb0d', '127.0.0.1', 1479382858, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323835373b),
('6355da4417d2ac16ededb4c2ca75b1a6de798b85', '127.0.0.1', 1479382884, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338303831333b),
('67308dd246f669e64818c1f491bb77d2c9ad1d3b', '127.0.0.1', 1479472616, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323631363b72656469726563745f617574685f7572697c733a32353a226c65646765722f636f6d6d697373696f6e735f766965772f32223b),
('67b7746c03c2cc7f01ebf1da14a47f449bb4ba20', '127.0.0.1', 1479379334, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393333343b),
('67d5b5e57a1a45298dfd1839c0a4fdce544585cc', '127.0.0.1', 1479296318, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363331383b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('68493109c0624154b9d19848761843428dfc945b', '127.0.0.1', 1479466118, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436363131373b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('685a5e48969840037a3db55fb675f0dc35842490', '127.0.0.1', 1479454171, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343137303b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('685a76ea6c4bc2aeb9404c08c03fad362b3a1edb', '127.0.0.1', 1479405936, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353933353b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('68b18f891c3f1ad3264805865b805001970abea0', '127.0.0.1', 1479470769, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303736393b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('6986161fcb958c626d38e3c6b06b4a0129d67d5f', '127.0.0.1', 1479394327, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339343332373b),
('69e956894413f08a6f9c2245de1416178e904081', '127.0.0.1', 1479298937, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239343233303b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a31363a2274657374313240676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223134223b733a343a22726f6c65223b733a353a226167656e74223b733a393a226c6f676765645f696e223b623a313b7d),
('6a74be75d63b8e2710810a69f3e8e4bec2b97dfb', '127.0.0.1', 1479299107, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239393130373b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('6b0624d427eb087b46ada5164b6b7cd36deb09db', '127.0.0.1', 1479438970, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393433383936393b72656469726563745f617574685f7572697c733a32343a2263617465676f72792f656469745f706179737065632f3336223b),
('6c36246a209819c61e59fbe90b46baa2a0e623db', '127.0.0.1', 1479394171, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339343137313b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3337223b),
('6c9e850dbe224d4a09d13cfb0e30ccc266b0544e', '127.0.0.1', 1479296073, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363037323b72656469726563745f617574685f7572697c733a343a2262616e6b223b),
('6cac59a80324386be0b44f8f8cc909618b8e4cb4', '127.0.0.1', 1479466909, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436363930383b72656469726563745f617574685f7572697c733a31393a22757365722f70726f66696c655f766965772f33223b),
('6cfbcfcd3d06db92d3a71831f295708e87ab452d', '127.0.0.1', 1479454257, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343235363b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3437223b),
('6e3f1991b386344e365428cccb940a3478341f1a', '127.0.0.1', 1479494648, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343634383b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('6e74da6f53517660b8cf2bf3aecd3593a1d6c1e3', '127.0.0.1', 1479457193, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435373139323b72656469726563745f617574685f7572697c733a31353a22726f6c65732f6164645f726f6c6573223b),
('6fb02c00dd4265c695be0e1516ddbf2fea3d60e6', '127.0.0.1', 1479404186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430343138363b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('708fe38c61cba3ffbaf425a52f1924dbd475688e', '127.0.0.1', 1479296485, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363438353b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('714b7b65fb0e98b9259cc79e9f7110b531877304', '127.0.0.1', 1479471727, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313732363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('720f343052f20171c666be42bf2a009850b631d2', '127.0.0.1', 1479468310, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383331303b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('721fcfaca995477b9a592ddc4b3ed2adf931d296', '127.0.0.1', 1479296013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363031323b72656469726563745f617574685f7572697c733a31393a2262616e6b2f636173685f77697468647261776c223b),
('74a475150fb29800a6354e8192066c8f0a442149', '127.0.0.1', 1479494885, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343838343b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('7538848e090b298dd2e2a284193185bde3f5c79b', '127.0.0.1', 1479472522, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436333238373b6c6f67676564496e5f6661696c7c733a32353a2257726f6e6720656d61696c206f722070617373776f72642021223b5f5f63695f766172737c613a313a7b733a31333a226c6f67676564496e5f6661696c223b733a333a226f6c64223b7d),
('754e64c1cef92242fe0e8d8a7682df889f677fcb', '127.0.0.1', 1479472658, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323635383b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('77fe8aec6613b2c61a06697c678219a2aeb5cf15', '127.0.0.1', 1479408744, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430383734343b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('795b3daab407924a725a6402515f1a9db94a73aa', '::1', 1479441976, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393433383735333b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2231223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('798c5e06df943dd3374f2711918d0f7ff0188445', '127.0.0.1', 1479458320, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435383332303b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('79a570440c31d8b0c4fe0dd026800c6692966c90', '127.0.0.1', 1479523197, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393532333139373b),
('79c02ec0f26bb6a2b28c75f88899b9bcb6876d15', '127.0.0.1', 1479459107, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435393130373b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('79cd5e64a5ce4e5b40f79a0d111135b35070a42e', '127.0.0.1', 1479494772, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343737313b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('7a9810310cd9cf303b5742ad95d96cf2ebd468f2', '127.0.0.1', 1479296085, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363038343b72656469726563745f617574685f7572697c733a343a2262616e6b223b),
('7aa619951258fb7f3b32109aa2186e55bed521fb', '127.0.0.1', 1479457188, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435373138373b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('7b5805665db166153ac3da81cfd5baaa513624d9', '127.0.0.1', 1479295950, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239353934393b72656469726563745f617574685f7572697c733a32313a226c65646765722f706179737065635f766965772f34223b),
('7ccc3fcdeccfe0d3ef8ebfcb304cfa80926059c2', '::1', 1479299107, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393237383935373b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2231223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('7cf4cdc19d5911e402d62dca36c4f9727b7467a2', '127.0.0.1', 1479381809, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338313830393b),
('7cfba51c51773a38985313d04439211961742f0c', '127.0.0.1', 1479382590, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323539303b),
('7d6a6941ea0e80b71634efc731327fbfbf4fc681', '127.0.0.1', 1479394349, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339343334393b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3338223b),
('7d876b9c6f1e4ac01eb66698e2afb70649809076', '127.0.0.1', 1479403674, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430333637333b),
('7e2130264dace885cf24f263520ae2f3ff7289b6', '127.0.0.1', 1479381768, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338313736383b),
('7ec411dfec7ebc0d1357fbbee1064ecdee8dafdd', '127.0.0.1', 1479467132, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373133323b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('7ef5b1132b557df9c6345f3c7e8e57d8a31d7d9e', '127.0.0.1', 1479494763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343736333b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('7fa22eafdc81c6793b321212648d84346fd56d79', '127.0.0.1', 1479468522, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383532313b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('80b11de3a4a746244c38f4df04c06f8e12480cbf', '127.0.0.1', 1479409920, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430393932303b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('81fd281d8373584509fa015b60a6acde39e383a2', '127.0.0.1', 1479297681, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373638303b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('82581d0e6355bc24b10dba03560cf28eed74ea78', '127.0.0.1', 1479472549, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323534393b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('826f613b6dcc5e9098523fac661a614d5ff0cef2', '127.0.0.1', 1479401899, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430313839383b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('8451e8dc728bd5d38c8633454993cfc544d04229', '127.0.0.1', 1479382594, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323539333b),
('879fbacb0ef8419e040f1feb7af4fa8a02849b92', '127.0.0.1', 1479470723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303732323b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('894b0f1b2da95f7cd1d63cfcd84c18ac100ad133', '127.0.0.1', 1479406373, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363337323b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('8a615e775fdedd334e12e028311fdd715f9e818f', '127.0.0.1', 1479467731, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373733313b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('8a8d6313bd046f5ef92bf33d5d2a3a92fe1e5237', '127.0.0.1', 1479472649, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323634393b72656469726563745f617574685f7572697c733a32353a226c65646765722f656469745f636f6d6d697373696f6e732f32223b),
('8af179a2b27a45ad41d7758d0937c7d8fb6f3494', '127.0.0.1', 1479457184, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435373138343b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('8bcb373b5bd02904e7e4d77cee75fff08f52a5c8', '127.0.0.1', 1479472431, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323433303b72656469726563745f617574685f7572697c733a31373a2270726f647563742f696e766f6963652f35223b),
('8cb10fe4f7fb3771a4216bff4bbc618ecebdd916', '127.0.0.1', 1479463293, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436333239323b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('8dd61e3ad092e0dccd26faef148966dbc8d3a36d', '127.0.0.1', 1479454165, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343136353b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('8e215460bac66159e981943ca88d49d8f4b6db03', '127.0.0.1', 1479324453, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393332343435333b),
('8e66185cee919a3d4c81b79dd5b9a191d7f72396', '127.0.0.1', 1479381993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338313939333b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3334223b),
('90fd5277311b470e70881d76715feeddd93d6397', '127.0.0.1', 1479297935, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373933353b72656469726563745f617574685f7572697c733a32373a2263617465676f72792f77616c6c65745f746f5f646973636f756e74223b),
('919f0f0620bdf3d95819ebf4258810e3a6c9a2ec', '127.0.0.1', 1479472592, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323539323b),
('91b8b2a10e3c3745417845bd2538eb22d4fd4864', '127.0.0.1', 1479459576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435393537353b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('92958e822a3b65c37bedf0cce8c1e543380f4c06', '127.0.0.1', 1479410352, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431303335313b72656469726563745f617574685f7572697c733a32323a226c65646765722f706179737065635f766965772f3530223b),
('92a5c366fc7cdbf273e33dac303d58f8e2323af1', '127.0.0.1', 1479439051, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393433393035313b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('93cff324fa74aac3882e5a84933f4f80c12f0052', '127.0.0.1', 1479296364, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363336343b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('942f5930c62ba8d7b143b639ecb4f5592318c121', '127.0.0.1', 1479467571, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373537313b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('94a59fd4e8fb21b1e712faed205ce402448e33d5', '127.0.0.1', 1479405564, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353536333b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('9535df1202df2b466e4fdd8772531e25fb7239db', '127.0.0.1', 1479396047, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339363034373b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3339223b),
('95740bf6b0e3eee4b06291fc552fdc1eb225795e', '127.0.0.1', 1479394328, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393138323b),
('980ab499b11614838ba3224c2a28e3dc888a3781', '127.0.0.1', 1479467235, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373233353b),
('98922bf239252dbfa01a4172e38d36a5a5046d58', '127.0.0.1', 1479493256, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439333235363b72656469726563745f617574685f7572697c733a32353a226c65646765722f636f6d6d697373696f6e735f766965772f34223b),
('98dbc34055ad38efb2b0b42fcf018eb0bf0a5caf', '127.0.0.1', 1479377466, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337373436363b),
('990cdf21b58371e0de45f685dd3e40c3525daf97', '127.0.0.1', 1479467124, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373132343b),
('992fd6072e69d09cf58e50bfca7c2a98de3e12de', '127.0.0.1', 1479381268, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338313236383b),
('9a8f976f5982c45dcd86e1425db619587c802181', '127.0.0.1', 1479406567, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363536373b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f61646d696e223b),
('9aad156ba6dd16f7a7fbf6e539e907baef57f5e1', '127.0.0.1', 1479296820, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363832303b72656469726563745f617574685f7572697c733a32363a2263617465676f72792f6164645f616363745f63617465676f7279223b),
('9af18305f023d913815c4e08b0d60aba3bd19f72', '127.0.0.1', 1479380808, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338303830383b),
('9e05c0ec39d749b28bf814f6c5be58f906c7dab8', '127.0.0.1', 1479454865, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343836343b72656469726563745f617574685f7572697c733a31373a226c65646765722f6164645f6c6564676572223b),
('9e50268dee1f4c36e12bcca29cee729b89103dbb', '127.0.0.1', 1479382172, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323137313b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3334223b),
('9eac995db75660475b141edffea4a97a44402e0d', '127.0.0.1', 1479459082, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435393038323b72656469726563745f617574685f7572697c733a32363a2263617465676f72792f6164645f616363745f63617465676f7279223b),
('9efbf35b2565a64ffdb46b21d623467b74b471ea', '127.0.0.1', 1479438763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393433383736323b),
('9fa10dea0adde486b772c1708db05669c76d3cf1', '127.0.0.1', 1479407567, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430373536363b72656469726563745f617574685f7572697c733a32383a226163636f756e742f62616c616e636573686565745f766965772f3434223b),
('a06acb64e36ca95ed082ecb35de408d58e00576d', '127.0.0.1', 1479406558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363535373b72656469726563745f617574685f7572697c733a31373a2270726f647563742f696e766f6963652f33223b),
('a09096cf296bc1fa12ba8c5d879ff128c938ac86', '127.0.0.1', 1479379544, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393534343b),
('a0ac0ccad97df99138eb940fa79b0fdcfd98063e', '127.0.0.1', 1479297594, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373539343b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('a2faba9d97463acc2b7d5b6381b6881403a1c794', '127.0.0.1', 1479298542, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383534313b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('a40c6e25edff04cd86023903fb3091819e5f4859', '127.0.0.1', 1479296076, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363037363b72656469726563745f617574685f7572697c733a31393a2262616e6b2f636173685f77697468647261776c223b),
('a6126e8f5ac06edd67e5e838b07317cbcd5db674', '127.0.0.1', 1479403772, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430333737323b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('a709e971955b299e16bb5a62a8916c4ec2a65c99', '127.0.0.1', 1479395519, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339353531383b72656469726563745f617574685f7572697c733a31373a2261637469766974792f75736572732f3338223b),
('a841c190b962949f37c4622e6b49f8eabe7e555c', '::1', 1479523276, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393532333139303b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a226d722e616e616e64736167617240676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2232223b733a343a22726f6c65223b733a343a2275736572223b733a393a226c6f676765645f696e223b623a313b7d),
('a847865f3c43f45dbf6faab55977cf9e0b498659', '127.0.0.1', 1479472747, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323734373b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('a853f799ab27f8d416ad191cca8bee65bab32ed4', '127.0.0.1', 1479296088, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363038383b72656469726563745f617574685f7572697c733a31363a2262616e6b2f62616e6b5f766965772f37223b),
('a9da5a70d2570e2852094cec657c63c4e3f7b756', '127.0.0.1', 1479468273, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383237323b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('aa4e5fa150488289283cb8167704c0222d333ce8', '127.0.0.1', 1479468437, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383433373b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('aae8ad8aa959a8ca1f666f015aa3333e60e4f6cd', '127.0.0.1', 1479466121, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436363132313b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('ac24fa906c4462a8b588843a140c8eb68b0a33eb', '127.0.0.1', 1479454918, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343931383b72656469726563745f617574685f7572697c733a353a226167656e74223b),
('ad83a76c224a307de2220acdf876424369eba1b5', '127.0.0.1', 1479298073, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383037323b72656469726563745f617574685f7572697c733a32313a226c65646765722f706179737065635f766965772f37223b),
('ada8e89ee1d66d7219c9a43fad74c1387baeb2de', '127.0.0.1', 1479496000, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439323235313b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a226d722e616e616e64736167617240676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2232223b733a343a22726f6c65223b733a343a2275736572223b733a393a226c6f676765645f696e223b623a313b7d),
('ae312a4f365dcd513e7490de3e40bdc0efbbb97d', '127.0.0.1', 1479487290, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393438373238393b),
('af922ca8d262e0114ea8434bf03f40f6be9aff10', '127.0.0.1', 1479386756, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338363735363b),
('b0038bebccf7f397a8625ecfef5be1787648a44e', '127.0.0.1', 1479296960, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363935393b72656469726563745f617574685f7572697c733a353a226167656e74223b),
('b01ad479e497236a51ab0c03e76e9b7f492f8ad2', '127.0.0.1', 1479469577, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436393537363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('b0e352b097f9f291977518cdc835c3fb48cc450e', '127.0.0.1', 1479404157, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430343135373b72656469726563745f617574685f7572697c733a31353a22726f6c65732f6164645f726f6c6573223b),
('b1996bbff9f5f879a2d60b3d1505e982f73c75c6', '127.0.0.1', 1479469581, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436393538303b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('b1a128e2a3bce142d535c6664ea656f3b28f1086', '127.0.0.1', 1479472536, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323533353b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('b23caed9befec9261fad9e9e64449626d7708770', '127.0.0.1', 1479382865, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323836353b),
('b23e1ce5a4ec88f165b4f03b8d4f0f5af4629429', '127.0.0.1', 1479494759, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343735393b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('b256dfa7bebfa15bda92d2f9a8e3010f1f6e08ce', '127.0.0.1', 1479396044, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339363034333b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('b3999768777a4cfa0478565bd0959686405b542a', '127.0.0.1', 1479468526, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383532353b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('b3cf3beded613b483c9dfac40b6499455a5fef55', '127.0.0.1', 1479297190, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373138393b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('b4205787ad27c3b9d6aa3de6dd0ddf711254edb9', '127.0.0.1', 1479523220, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393532333232303b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('b4323b7c0692040bbd3642e39f6bb612ed3f9fdb', '127.0.0.1', 1479494959, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343935393b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('b4f1805a5e2915f71f427adfab4c20fb71826dc9', '127.0.0.1', 1479465896, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436353839363b),
('b53c57e93893536e1204625fe311ad26cfb3620c', '127.0.0.1', 1479403233, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430333233333b72656469726563745f617574685f7572697c733a31353a22726f6c65732f6164645f726f6c6573223b),
('b5e8f1cd4e968e604dd74a6c234118c6ae39988b', '127.0.0.1', 1479407636, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430373633363b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3433223b),
('b689f6cd17d43f7236e6f72a8a4918845a9ed1b4', '127.0.0.1', 1479410440, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431303433393b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('b6972416f0d23e43946e16332ed82816aae319f8', '127.0.0.1', 1479462521, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436323532303b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('b77589774543dfd1d2d96059f3d2b19741e8ef96', '127.0.0.1', 1479465892, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436353839323b72656469726563745f617574685f7572697c733a343a2262616e6b223b),
('b77fe54a38c599c24f460c9f16c7881c182189dc', '127.0.0.1', 1479472452, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323435313b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('b7eee2145777baf76739bea4038792424cc38359', '127.0.0.1', 1479472029, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323032383b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('b7f84c2bd269c0330d8239c5211d0154f7af0ac2', '127.0.0.1', 1479468451, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383435313b),
('b8294bbd6798fadce026692540074a3b325e40e5', '127.0.0.1', 1479393492, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339333439323b),
('b9292850048ccf16219807c808500c4a3fd39a43', '127.0.0.1', 1479494714, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343731333b72656469726563745f617574685f7572697c733a32333a226c65646765722f7472616e736665725f6361706974616c223b),
('ba19792f9a477be310b267d032aca5506ed74728', '127.0.0.1', 1479296511, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363531303b72656469726563745f617574685f7572697c733a32343a2263617465676f72792f656469745f706179737065632f3332223b),
('ba4c26cbb3c18355c4e0e426b1fedbeb3e7b34ee', '127.0.0.1', 1479458335, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435383333343b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('bb42c30d8a17f991ecec5ef4446205b9aa3a6277', '127.0.0.1', 1479381848, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338313834383b),
('bc378635a4fd59d49baaf950427d94a2c19b3372', '127.0.0.1', 1479387450, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338373434393b),
('bce6f926002544b076258f1ffd21c836622c1a1f', '127.0.0.1', 1479406971, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363937313b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('bcea03f030424e0d0065cf46b79bc5801dd23156', '127.0.0.1', 1479462449, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436323434393b),
('bd3e02d80332219ff1f9523f3b23c9274dbccebd', '127.0.0.1', 1479471156, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313135353b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('bdfa8662d4b3640bb354f68bf9bb8477ca874af5', '127.0.0.1', 1479295968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239353936383b72656469726563745f617574685f7572697c733a31353a22726f6c65732f6164645f726f6c6573223b),
('be4c98b325aa86ced09dd123ca0523a3de6beff8', '127.0.0.1', 1479298169, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383136383b72656469726563745f617574685f7572697c733a32353a226c65646765722f636f6d6d697373696f6e735f766965772f31223b),
('c14b2ae1ac1db6d5e248c98084694f93b1d4f93a', '127.0.0.1', 1479398130, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339383133303b),
('c156edcff6631cec19daff1efa2ee587a201ecb2', '127.0.0.1', 1479406967, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363936373b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('c1bb9530879f11b28be6e3b1b1754728abeff435', '127.0.0.1', 1479492161, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439323136303b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('c261d01f3cd7ebf8b35147d939d4280fd47b3450', '127.0.0.1', 1479401904, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430313930333b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('c2fdd2823d6771848fe720fcee40df7946d95139', '127.0.0.1', 1479296504, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363530343b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('c3e359fb8d54e50b963c90fefcadcaa0d6960560', '127.0.0.1', 1479406571, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430363537303b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('c526444aefb2bb835067aac280a27c26e40926c4', '127.0.0.1', 1479410751, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353430313b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32343a2273617469736873706174696c323140676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2236223b733a343a22726f6c65223b733a343a2275736572223b733a393a226c6f676765645f696e223b623a313b7d),
('c5a0100d0cdcbaa464cb4dff74df04b31db8436d', '127.0.0.1', 1479382862, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323836323b),
('c5a546b07a7f7460941af1421541133c8a77fe2a', '127.0.0.1', 1479411513, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431313531333b),
('c5ae79c9edf49a1f68c61ce7371cd12f2b97900a', '127.0.0.1', 1479470734, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303733343b72656469726563745f617574685f7572697c733a32343a2263617465676f72792f656469745f706179737065632f3430223b),
('c5c295a5e49df8772f0d78fb07937f71e00d8497', '::1', 1479411436, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337343932303b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2231223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('c5e4cbaec827ebafb2a18abf65b1e9f725e73a7b', '127.0.0.1', 1479400926, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430303932363b72656469726563745f617574685f7572697c733a32353a226c65646765722f656469745f636f6d6d697373696f6e732f31223b),
('c5f2821fbafbfbdc2af9354879f5c40c2373f99d', '127.0.0.1', 1479487280, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393438373238303b),
('c70abeb87644dacb8f99ef5a0bce9e840392265e', '127.0.0.1', 1479468779, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383737383b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('cad32dbb4da5143799d5e6f784e6f91ea54c5f54', '127.0.0.1', 1479379230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393232393b),
('cb3b706f9413c04e234a88b911d3b3e95774f2f9', '127.0.0.1', 1479467225, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373232343b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('cc18b7e5e077e5ce2398ceb921b47f82bc95b0b3', '127.0.0.1', 1479456940, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435363934303b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('cdbea2fda53a940936cc1b15b031c8798e8c3139', '127.0.0.1', 1479470870, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303837303b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('cdf1b970fce952c7c19942ec27103ed1bbf48bf7', '127.0.0.1', 1479296344, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363334333b72656469726563745f617574685f7572697c733a32313a226c65646765722f706179737065635f766965772f37223b),
('d11460d29c8ca1acee31f46a5c7f6ede3f72ec31', '127.0.0.1', 1479468297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383239373b),
('d21974fa498bae0763142bebf0c391039e7557fc', '127.0.0.1', 1479296179, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363137383b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('d225a9418acd2d3ebab551b7b34a31e14b754031', '127.0.0.1', 1479399657, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339393635373b72656469726563745f617574685f7572697c733a31353a22726f6c65732f6164645f726f6c6573223b),
('d2823cc6b36987c356840c65878b7fd5c7ef03d4', '127.0.0.1', 1479395554, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339353535343b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('d30cf67e7b61c593268c0c95fb3875d39f0ae964', '127.0.0.1', 1479494755, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343735353b72656469726563745f617574685f7572697c733a31373a226c65646765722f6164645f6c6564676572223b),
('d42e5b24f12f1e08e05e3d03cf921936164f404d', '127.0.0.1', 1479468652, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383635323b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('d49698f21c71576ea701e4834f480f322b2fe7f2', '127.0.0.1', 1479297213, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373231323b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('d5043084adefe3d3a8d5574c6e5b39ed775da5ce', '127.0.0.1', 1479469179, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436393137393b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('d58304725052dc1dcf17d8c9c879d1ec2ab2624e', '127.0.0.1', 1479382012, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323031313b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3333223b),
('d5dde6160bb0b07211226e602e66a5f69e9bdd79', '127.0.0.1', 1479400930, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430303932393b72656469726563745f617574685f7572697c733a31353a22726f6c65732f6164645f726f6c6573223b),
('d7bd8f6af80d2f771049efa69f8acfa798be016e', '127.0.0.1', 1479410348, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431303334383b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('d7f7ed57c46bc00b7ecfd39d418dce545b4b0ac8', '127.0.0.1', 1479403011, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430333031303b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('d93d19177a39d3d0763437d62fbd53d3893219f4', '127.0.0.1', 1479382586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323538363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('da63738f7a43486c8091d6ab01404986602fdc34', '127.0.0.1', 1479468660, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383635393b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('dbd5097c1ea5ee0360726a62ff8839568c20c7fd', '127.0.0.1', 1479405475, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353437343b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('dc41321134807ab30f2592e21704d8bb14b725fa', '127.0.0.1', 1479379356, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393335363b),
('dce82e364057965e7089be143094b801d3c869b5', '127.0.0.1', 1479379338, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393333373b),
('ddc228cc26f35a350973b84eb9e8a611684d171d', '127.0.0.1', 1479296022, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363032313b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('dddd07fad5f56e1559f18b4b1e81f5c3a6af3901', '127.0.0.1', 1479396326, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338363733323b737563636573734d73677c733a3237323a22526567697374726174696f6e205375636365737366756c6c7920436f6d706c657465642e2e2e2121212c2062656c6f7720617265207468652063726564656e7469616c733c6272202f3e456d61696c203a206f6b736167617240676d61696c2e636f6d3c6272202f3e50617373776f7264203a206f6b736167617240676d61696c2e636f6d3c6272202f3e596f757220556e6971756520526566657272616c204944203a20564f4c393037363534383332313c6272202f3e203c6872202f3e506c656173652066696e6420656d61696c206f6e20796f7572203c7374726f6e673e496e626f783c2f7374726f6e673e206f7220203c7374726f6e673e5370616d3c2f7374726f6e673e20666f6c646572223b5f5f63695f766172737c613a313a7b733a31303a22737563636573734d7367223b733a333a226f6c64223b7d),
('de1c87eaca0ea37339fe2dcfcb43a74b458fdf1e', '127.0.0.1', 1479407036, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430373033363b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('de591b8556dcd86866b54c8b74d6ca664077a979', '127.0.0.1', 1479381986, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338313938353b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('df324be9357f1e8733d03cb48480e986e8d78a5f', '127.0.0.1', 1479454873, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343837333b72656469726563745f617574685f7572697c733a32363a2263617465676f72792f6164645f616363745f63617465676f7279223b),
('dff5421dcff18adb6fbade4b08873ab22b268373', '127.0.0.1', 1479393819, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339333831383b72656469726563745f617574685f7572697c733a32303a22757365722f70726f66696c655f766965772f3336223b),
('e00816fd2b89376c9f1d265fd41a8d391ff981a7', '127.0.0.1', 1479297899, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373839393b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f766965775f726174696f2f38223b),
('e00dd741d3a8b58d29f05fdb661ac1a3f7e12fb1', '127.0.0.1', 1479462485, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436323438353b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('e05f4570161bb928cf425bb157883ea6f9cbf2dc', '127.0.0.1', 1479386761, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338363736303b),
('e09dd30e1572655e1049c14dec8b45e897e62a16', '127.0.0.1', 1479405941, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353934313b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('e1586c20f0693acc5d0a65078e9fff09341f298f', '127.0.0.1', 1479463033, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436333033333b72656469726563745f617574685f7572697c733a343a2262616e6b223b),
('e1a27831b8b911737bef7bd4968c589d68af5135', '127.0.0.1', 1479405408, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430353430373b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('e1fb2410725b297ff275aa8cf4855ce91de453ab', '127.0.0.1', 1479297677, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373637363b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('e2918dd8971e0a5436ce75d6749c29c25ad91064', '127.0.0.1', 1479467243, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373234323b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('e380a83fda0ea34d240e0c4fbbd17decc29cfa5b', '127.0.0.1', 1479382159, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323135383b),
('e3adf0edca4a750e2eaef2331c0d2f8e7de23bdb', '127.0.0.1', 1479381990, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338313938393b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('e4fb533830d1fbb4146c0be3f4c22731c56e7733', '127.0.0.1', 1479296025, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363032353b),
('e52585f9bf6a6c95633bbd8a37c7cfc0c39f6800', '127.0.0.1', 1479379359, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337393335393b),
('e562f1bc0e34bce8df4d88beda5fbcbf3756c189', '127.0.0.1', 1479296092, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239363039313b72656469726563745f617574685f7572697c733a32353a226163636f756e742f61646462616e6b5f62616c616e63652f37223b),
('e62d900af74369c4365fa319746abbe1aca22b8c', '127.0.0.1', 1479393815, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339333831353b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('e751e63de06d797621c3e8b96c3bf3dcfec11ff0', '127.0.0.1', 1479467230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436373233303b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('e882b9d617964409ac8e23e79ead5b092120b7b4', '127.0.0.1', 1479410392, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431303339323b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('e883c639bcccf6706d83abfdac2708aa2de39a52', '127.0.0.1', 1479470918, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437303931373b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('ea24f18857e4b08128a6f782059aa63a21a62812', '127.0.0.1', 1479297216, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239373231363b72656469726563745f617574685f7572697c733a33303a2263617465676f72792f6164645f616363745f7375625f63617465676f7279223b),
('ea4ad1810fbceda39c5ee73210fcf2b7c16d0d86', '127.0.0.1', 1479494703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393439343730323b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('eb53169637b3d3b01fd9833c3faca95028349aac', '127.0.0.1', 1479472540, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437323534303b),
('ed24d37dc6e0d21f52dfc1d42bc88fe74df1324f', '127.0.0.1', 1479438771, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393433383737313b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('ed282390170c9e0df403c66ee3fab16d3c9ab130', '127.0.0.1', 1479410337, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393431303333373b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('ef13a22a50f39b113fd50c47097a574c8c5545e4', '127.0.0.1', 1479395283, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339353238323b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('efc1f85226c0b3651cafb7db8bd1f30b97e1a2f4', '127.0.0.1', 1479382648, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393338323634383b),
('f0022b2d56798b836d0888106abbb3505ae62872', '127.0.0.1', 1479463030, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436333032393b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('f2fab2323047bf09ebf168bfeac8c848edb227a4', '127.0.0.1', 1479373322, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393337333332323b),
('f37ab4e31f946b8d5200543fec86a4668f501fbe', '127.0.0.1', 1479400759, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393430303735393b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('f49fe05e1f2c26352ec29ff48aff0920fb397b1c', '127.0.0.1', 1479454253, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343235333b72656469726563745f617574685f7572697c733a343a2275736572223b),
('f4dd2d5b14470ea940901d8486190699484a867b', '127.0.0.1', 1479298663, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393239383636323b72656469726563745f617574685f7572697c733a343a2262616e6b223b),
('f4f30ced2bd93d2fa9a452527d7b9f4fcfb51b1d', '::1', 1479472745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393435343134393b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2231223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('f7835b9d64c4b8256c8054060b08b10cbe7ef36f', '127.0.0.1', 1479398146, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393339383134353b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('f7cddf36293732a002e08f6988e1c1dd3f3a5584', '127.0.0.1', 1479471701, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313730313b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('f988c09e24f48c85926450c6402f1a68358c9da1', '127.0.0.1', 1479472551, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436323434353b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32313a22737072656d61696e64657240676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2235223b733a343a22726f6c65223b733a353a226167656e74223b733a393a226c6f676765645f696e223b623a313b7d),
('fe0939349ceb86e9bae64b747d833e44d2a878b7', '127.0.0.1', 1479468693, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393436383639333b72656469726563745f617574685f7572697c733a32313a2263617465676f72792f706179737065635f6c697374223b),
('ff7534322bc326073eb30f13ec28faf292f56d7c', '127.0.0.1', 1479471229, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313232393b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('ff8ebd6cc40f63478017ce6db9d92f1b8f35294c', '127.0.0.1', 1479471714, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393437313731343b);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(10) NOT NULL,
  `identity` varchar(30) NOT NULL,
  `identity_id` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `acct_id` varchar(255) NOT NULL,
  `sub_acct_id` varchar(255) NOT NULL,
  `ded_paytype` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `loy_amt` double NOT NULL,
  `dis_amt` double NOT NULL,
  `from_role` varchar(255) NOT NULL,
  `to_role` varchar(255) NOT NULL,
  `commission` int(2) NOT NULL,
  `benefits` int(2) NOT NULL,
  `slr_ref_pm` varchar(10) NOT NULL,
  `slr_ref_level1` float NOT NULL,
  `slr_ref_level2` float NOT NULL,
  `slr_ref_level3` float NOT NULL,
  `slr_ref_level4` float NOT NULL,
  `slr_ref_level5` float NOT NULL,
  `clt_ref_pm` varchar(10) NOT NULL,
  `clt_ref_level1` float NOT NULL,
  `clt_ref_level2` float NOT NULL,
  `clt_ref_level3` float NOT NULL,
  `clt_ref_level4` float NOT NULL,
  `clt_ref_level5` float NOT NULL,
  `points_mode` varchar(30) NOT NULL,
  `profit_pm` varchar(10) NOT NULL,
  `seller_profit` float NOT NULL,
  `client_profit` float NOT NULL,
  `deduction_pm` varchar(10) NOT NULL,
  `seller_deduction` float NOT NULL,
  `client_deduction` float NOT NULL,
  `transferrable` varchar(10) NOT NULL,
  `period` int(2) NOT NULL,
  `tenure` int(2) NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `visible` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `identity`, `identity_id`, `type`, `remarks`, `start_date`, `end_date`, `acct_id`, `sub_acct_id`, `ded_paytype`, `amount`, `loy_amt`, `dis_amt`, `from_role`, `to_role`, `commission`, `benefits`, `slr_ref_pm`, `slr_ref_level1`, `slr_ref_level2`, `slr_ref_level3`, `slr_ref_level4`, `slr_ref_level5`, `clt_ref_pm`, `clt_ref_level1`, `clt_ref_level2`, `clt_ref_level3`, `clt_ref_level4`, `clt_ref_level5`, `points_mode`, `profit_pm`, `seller_profit`, `client_profit`, `deduction_pm`, `seller_deduction`, `client_deduction`, `transferrable`, `period`, `tenure`, `modified_by`, `modified_at`, `created_at`, `created_by`, `visible`) VALUES
(2, 'Commission', '', '', 'Consumer Retailer Commission setup', '0000-00-00', '0000-00-00', '20', '34', '36', 0, 0, 0, '12', '13', 0, 0, '', 0.2, 0.2, 0.2, 0.2, 0.2, '', 0, 0, 0, 0, 0, 'loyality', '', 100, 100, '', 0, 1, '', 0, 0, '', 1479471151, 1479471151, 1, 0),
(3, 'Commission', '', '', 'Retailer/Distributors Commission', '0000-00-00', '0000-00-00', '31', '34', '42', 0, 0, 0, '13', '14', 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 'discount', '', 2, 3, '', 0, 0, '', 0, 0, '', 1479471449, 1479471449, 1, 0),
(4, 'Commission', '', '', 'Comm setup', '2016-11-18', '2016-11-30', '31', '38', '29', 0, 0, 0, '15', '18', 2, 2, 'discount', 0.1, 0.1, 0.1, 0.1, 0.1, 'loyality', 0.1, 0.1, 0.1, 0.1, 0.1, 'discount', 'discount', 0.1, 0.1, 'loyality', 2, 2, '', 0, 0, '1', 1479494569, 1479494569, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(5) NOT NULL,
  `country_code` char(2) NOT NULL DEFAULT '',
  `country_name` varchar(45) NOT NULL DEFAULT '',
  `currency_code` char(3) DEFAULT NULL,
  `continent_name` varchar(15) DEFAULT NULL,
  `continent` char(2) DEFAULT NULL,
  `languages` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `currency_code`, `continent_name`, `continent`, `languages`) VALUES
(2, 'AE', 'United Arab Emirates', 'AED', 'Asia', 'AS', 'ar-AE,fa,en,hi,ur'),
(12, 'AT', 'Austria', 'EUR', 'Europe', 'EU', 'de-AT,hr,hu,sl'),
(13, 'AU', 'Australia', 'AUD', 'Oceania', 'OC', 'en-AU'),
(14, 'AW', 'Aruba', 'AWG', 'North America', 'NA', 'nl-AW,es,en'),
(19, 'BD', 'Bangladesh', 'BDT', 'Asia', 'AS', 'bn-BD,en'),
(20, 'BE', 'Belgium', 'EUR', 'Europe', 'EU', 'nl-BE,fr-BE,de-BE'),
(21, 'BF', 'Burkina Faso', 'XOF', 'Africa', 'AF', 'fr-BF'),
(22, 'BG', 'Bulgaria', 'BGN', 'Europe', 'EU', 'bg,tr-BG'),
(23, 'BH', 'Bahrain', 'BHD', 'Asia', 'AS', 'ar-BH,en,fa,ur'),
(24, 'BI', 'Burundi', 'BIF', 'Africa', 'AF', 'fr-BI,rn'),
(25, 'BJ', 'Benin', 'XOF', 'Africa', 'AF', 'fr-BJ'),
(31, 'BR', 'Brazil', 'BRL', 'South America', 'SA', 'pt-BR,es,en,fr'),
(33, 'BT', 'Bhutan', 'BTN', 'Asia', 'AS', 'dz'),
(35, 'BW', 'Botswana', 'BWP', 'Africa', 'AF', 'en-BW,tn-BW'),
(36, 'BY', 'Belarus', 'BYR', 'Europe', 'EU', 'be,ru'),
(41, 'CF', 'Central African Republic', 'XAF', 'Africa', 'AF', 'fr-CF,sg,ln,kg'),
(43, 'CH', 'Switzerland', 'CHF', 'Europe', 'EU', 'de-CH,fr-CH,it-CH,rm'),
(44, 'CI', 'Ivory Coast', 'XOF', 'Africa', 'AF', 'fr-CI'),
(45, 'CK', 'Cook Islands', 'NZD', 'Oceania', 'OC', 'en-CK,mi'),
(50, 'CR', 'Costa Rica', 'CRC', 'North America', 'NA', 'es-CR,en'),
(51, 'CU', 'Cuba', 'CUP', 'North America', 'NA', 'es-CU'),
(52, 'CV', 'Cape Verde', 'CVE', 'Africa', 'AF', 'pt-CV'),
(53, 'CW', 'Curacao', 'ANG', 'North America', 'NA', 'nl,pap'),
(54, 'CX', 'Christmas Island', 'AUD', 'Asia', 'AS', 'en,zh,ms-CC'),
(55, 'CY', 'Cyprus', 'EUR', 'Europe', 'EU', 'el-CY,tr-CY,en'),
(56, 'CZ', 'Czech Republic', 'CZK', 'Europe', 'EU', 'cs,sk'),
(57, 'DE', 'Germany', 'EUR', 'Europe', 'EU', 'de'),
(58, 'DJ', 'Djibouti', 'DJF', 'Africa', 'AF', 'fr-DJ,ar,so-DJ,aa'),
(59, 'DK', 'Denmark', 'DKK', 'Europe', 'EU', 'da-DK,en,fo,de-DK'),
(60, 'DM', 'Dominica', 'XCD', 'North America', 'NA', 'en-DM'),
(61, 'DO', 'Dominican Republic', 'DOP', 'North America', 'NA', 'es-DO'),
(62, 'DZ', 'Algeria', 'DZD', 'Africa', 'AF', 'ar-DZ'),
(63, 'EC', 'Ecuador', 'USD', 'South America', 'SA', 'es-EC'),
(64, 'EE', 'Estonia', 'EUR', 'Europe', 'EU', 'et,ru'),
(65, 'EG', 'Egypt', 'EGP', 'Africa', 'AF', 'ar-EG,en,fr'),
(66, 'EH', 'Western Sahara', 'MAD', 'Africa', 'AF', 'ar,mey'),
(67, 'ER', 'Eritrea', 'ERN', 'Africa', 'AF', 'aa-ER,ar,tig,kun,ti-ER'),
(68, 'ES', 'Spain', 'EUR', 'Europe', 'EU', 'es-ES,ca,gl,eu,oc'),
(69, 'ET', 'Ethiopia', 'ETB', 'Africa', 'AF', 'am,en-ET,om-ET,ti-ET,so-ET,sid'),
(70, 'FI', 'Finland', 'EUR', 'Europe', 'EU', 'fi-FI,sv-FI,smn'),
(71, 'FJ', 'Fiji', 'FJD', 'Oceania', 'OC', 'en-FJ,fj'),
(72, 'FK', 'Falkland Islands', 'FKP', 'South America', 'SA', 'en-FK'),
(73, 'FM', 'Micronesia', 'USD', 'Oceania', 'OC', 'en-FM,chk,pon,yap,kos,uli,woe,'),
(74, 'FO', 'Faroe Islands', 'DKK', 'Europe', 'EU', 'fo,da-FO'),
(75, 'FR', 'France', 'EUR', 'Europe', 'EU', 'fr-FR,frp,br,co,ca,eu,oc'),
(76, 'GA', 'Gabon', 'XAF', 'Africa', 'AF', 'fr-GA'),
(77, 'GB', 'United Kingdom', 'GBP', 'Europe', 'EU', 'en-GB,cy-GB,gd'),
(78, 'GD', 'Grenada', 'XCD', 'North America', 'NA', 'en-GD'),
(79, 'GE', 'Georgia', 'GEL', 'Asia', 'AS', 'ka,ru,hy,az'),
(80, 'GF', 'French Guiana', 'EUR', 'South America', 'SA', 'fr-GF'),
(81, 'GG', 'Guernsey', 'GBP', 'Europe', 'EU', 'en,fr'),
(82, 'GH', 'Ghana', 'GHS', 'Africa', 'AF', 'en-GH,ak,ee,tw'),
(83, 'GI', 'Gibraltar', 'GIP', 'Europe', 'EU', 'en-GI,es,it,pt'),
(84, 'GL', 'Greenland', 'DKK', 'North America', 'NA', 'kl,da-GL,en'),
(85, 'GM', 'Gambia', 'GMD', 'Africa', 'AF', 'en-GM,mnk,wof,wo,ff'),
(86, 'GN', 'Guinea', 'GNF', 'Africa', 'AF', 'fr-GN'),
(87, 'GP', 'Guadeloupe', 'EUR', 'North America', 'NA', 'fr-GP'),
(88, 'GQ', 'Equatorial Guinea', 'XAF', 'Africa', 'AF', 'es-GQ,fr'),
(89, 'GR', 'Greece', 'EUR', 'Europe', 'EU', 'el-GR,en,fr'),
(90, 'GS', 'South Georgia and the South Sandwich Islands', 'GBP', 'Antarctica', 'AN', 'en'),
(91, 'GT', 'Guatemala', 'GTQ', 'North America', 'NA', 'es-GT'),
(92, 'GU', 'Guam', 'USD', 'Oceania', 'OC', 'en-GU,ch-GU'),
(93, 'GW', 'Guinea-Bissau', 'XOF', 'Africa', 'AF', 'pt-GW,pov'),
(94, 'GY', 'Guyana', 'GYD', 'South America', 'SA', 'en-GY'),
(95, 'HK', 'Hong Kong', 'HKD', 'Asia', 'AS', 'zh-HK,yue,zh,en'),
(96, 'HM', 'Heard Island and McDonald Islands', 'AUD', 'Antarctica', 'AN', ''),
(97, 'HN', 'Honduras', 'HNL', 'North America', 'NA', 'es-HN'),
(98, 'HR', 'Croatia', 'HRK', 'Europe', 'EU', 'hr-HR,sr'),
(99, 'HT', 'Haiti', 'HTG', 'North America', 'NA', 'ht,fr-HT'),
(100, 'HU', 'Hungary', 'HUF', 'Europe', 'EU', 'hu-HU'),
(101, 'ID', 'Indonesia', 'IDR', 'Asia', 'AS', 'id,en,nl,jv'),
(102, 'IE', 'Ireland', 'EUR', 'Europe', 'EU', 'en-IE,ga-IE'),
(103, 'IL', 'Israel', 'ILS', 'Asia', 'AS', 'he,ar-IL,en-IL,'),
(104, 'IM', 'Isle of Man', 'GBP', 'Europe', 'EU', 'en,gv'),
(105, 'IN', 'Bharath(India)', 'INR', 'Asia', 'AS', 'en-IN,hi,bn,te,mr,ta,ur,gu,kn,'),
(106, 'IO', 'British Indian Ocean Territory', 'USD', 'Asia', 'AS', 'en-IO'),
(107, 'IQ', 'Iraq', 'IQD', 'Asia', 'AS', 'ar-IQ,ku,hy'),
(108, 'IR', 'Iran', 'IRR', 'Asia', 'AS', 'fa-IR,ku'),
(109, 'IS', 'Iceland', 'ISK', 'Europe', 'EU', 'is,en,de,da,sv,no'),
(110, 'IT', 'Italy', 'EUR', 'Europe', 'EU', 'it-IT,de-IT,fr-IT,sc,ca,co,sl'),
(111, 'JE', 'Jersey', 'GBP', 'Europe', 'EU', 'en,pt'),
(112, 'JM', 'Jamaica', 'JMD', 'North America', 'NA', 'en-JM'),
(113, 'JO', 'Jordan', 'JOD', 'Asia', 'AS', 'ar-JO,en'),
(114, 'JP', 'Japan', 'JPY', 'Asia', 'AS', 'ja'),
(115, 'KE', 'Kenya', 'KES', 'Africa', 'AF', 'en-KE,sw-KE'),
(116, 'KG', 'Kyrgyzstan', 'KGS', 'Asia', 'AS', 'ky,uz,ru'),
(117, 'KH', 'Cambodia', 'KHR', 'Asia', 'AS', 'km,fr,en'),
(118, 'KI', 'Kiribati', 'AUD', 'Oceania', 'OC', 'en-KI,gil'),
(119, 'KM', 'Comoros', 'KMF', 'Africa', 'AF', 'ar,fr-KM'),
(120, 'KN', 'Saint Kitts and Nevis', 'XCD', 'North America', 'NA', 'en-KN'),
(121, 'KP', 'North Korea', 'KPW', 'Asia', 'AS', 'ko-KP'),
(122, 'KR', 'South Korea', 'KRW', 'Asia', 'AS', 'ko-KR,en'),
(123, 'KW', 'Kuwait', 'KWD', 'Asia', 'AS', 'ar-KW,en'),
(124, 'KY', 'Cayman Islands', 'KYD', 'North America', 'NA', 'en-KY'),
(125, 'KZ', 'Kazakhstan', 'KZT', 'Asia', 'AS', 'kk,ru'),
(126, 'LA', 'Laos', 'LAK', 'Asia', 'AS', 'lo,fr,en'),
(127, 'LB', 'Lebanon', 'LBP', 'Asia', 'AS', 'ar-LB,fr-LB,en,hy'),
(128, 'LC', 'Saint Lucia', 'XCD', 'North America', 'NA', 'en-LC'),
(129, 'LI', 'Liechtenstein', 'CHF', 'Europe', 'EU', 'de-LI'),
(130, 'LK', 'Sri Lanka', 'LKR', 'Asia', 'AS', 'si,ta,en'),
(131, 'LR', 'Liberia', 'LRD', 'Africa', 'AF', 'en-LR'),
(132, 'LS', 'Lesotho', 'LSL', 'Africa', 'AF', 'en-LS,st,zu,xh'),
(133, 'LT', 'Lithuania', 'LTL', 'Europe', 'EU', 'lt,ru,pl'),
(134, 'LU', 'Luxembourg', 'EUR', 'Europe', 'EU', 'lb,de-LU,fr-LU'),
(135, 'LV', 'Latvia', 'EUR', 'Europe', 'EU', 'lv,ru,lt'),
(136, 'LY', 'Libya', 'LYD', 'Africa', 'AF', 'ar-LY,it,en'),
(137, 'MA', 'Morocco', 'MAD', 'Africa', 'AF', 'ar-MA,fr'),
(138, 'MC', 'Monaco', 'EUR', 'Europe', 'EU', 'fr-MC,en,it'),
(139, 'MD', 'Moldova', 'MDL', 'Europe', 'EU', 'ro,ru,gag,tr'),
(140, 'ME', 'Montenegro', 'EUR', 'Europe', 'EU', 'sr,hu,bs,sq,hr,rom'),
(141, 'MF', 'Saint Martin', 'EUR', 'North America', 'NA', 'fr'),
(142, 'MG', 'Madagascar', 'MGA', 'Africa', 'AF', 'fr-MG,mg'),
(143, 'MH', 'Marshall Islands', 'USD', 'Oceania', 'OC', 'mh,en-MH'),
(144, 'MK', 'Macedonia', 'MKD', 'Europe', 'EU', 'mk,sq,tr,rmm,sr'),
(145, 'ML', 'Mali', 'XOF', 'Africa', 'AF', 'fr-ML,bm'),
(146, 'MM', 'Myanmar [Burma]', 'MMK', 'Asia', 'AS', 'my'),
(147, 'MN', 'Mongolia', 'MNT', 'Asia', 'AS', 'mn,ru'),
(148, 'MO', 'Macao', 'MOP', 'Asia', 'AS', 'zh,zh-MO,pt'),
(149, 'MP', 'Northern Mariana Islands', 'USD', 'Oceania', 'OC', 'fil,tl,zh,ch-MP,en-MP'),
(150, 'MQ', 'Martinique', 'EUR', 'North America', 'NA', 'fr-MQ'),
(151, 'MR', 'Mauritania', 'MRO', 'Africa', 'AF', 'ar-MR,fuc,snk,fr,mey,wo'),
(152, 'MS', 'Montserrat', 'XCD', 'North America', 'NA', 'en-MS'),
(153, 'MT', 'Malta', 'EUR', 'Europe', 'EU', 'mt,en-MT'),
(154, 'MU', 'Mauritius', 'MUR', 'Africa', 'AF', 'en-MU,bho,fr'),
(155, 'MV', 'Maldives', 'MVR', 'Asia', 'AS', 'dv,en'),
(156, 'MW', 'Malawi', 'MWK', 'Africa', 'AF', 'ny,yao,tum,swk'),
(157, 'MX', 'Mexico', 'MXN', 'North America', 'NA', 'es-MX'),
(158, 'MY', 'Malaysia', 'MYR', 'Asia', 'AS', 'ms-MY,en,zh,ta,te,ml,pa,th'),
(159, 'MZ', 'Mozambique', 'MZN', 'Africa', 'AF', 'pt-MZ,vmw'),
(160, 'NA', 'Namibia', 'NAD', 'Africa', 'AF', 'en-NA,af,de,hz,naq'),
(161, 'NC', 'New Caledonia', 'XPF', 'Oceania', 'OC', 'fr-NC'),
(162, 'NE', 'Niger', 'XOF', 'Africa', 'AF', 'fr-NE,ha,kr,dje'),
(163, 'NF', 'Norfolk Island', 'AUD', 'Oceania', 'OC', 'en-NF'),
(164, 'NG', 'Nigeria', 'NGN', 'Africa', 'AF', 'en-NG,ha,yo,ig,ff'),
(165, 'NI', 'Nicaragua', 'NIO', 'North America', 'NA', 'es-NI,en'),
(166, 'NL', 'Netherlands', 'EUR', 'Europe', 'EU', 'nl-NL,fy-NL'),
(167, 'NO', 'Norway', 'NOK', 'Europe', 'EU', 'no,nb,nn,se,fi'),
(168, 'NP', 'Nepal', 'NPR', 'Asia', 'AS', 'ne,en'),
(169, 'NR', 'Nauru', 'AUD', 'Oceania', 'OC', 'na,en-NR'),
(170, 'NU', 'Niue', 'NZD', 'Oceania', 'OC', 'niu,en-NU'),
(171, 'NZ', 'New Zealand', 'NZD', 'Oceania', 'OC', 'en-NZ,mi'),
(172, 'OM', 'Oman', 'OMR', 'Asia', 'AS', 'ar-OM,en,bal,ur'),
(173, 'PA', 'Panama', 'PAB', 'North America', 'NA', 'es-PA,en'),
(174, 'PE', 'Peru', 'PEN', 'South America', 'SA', 'es-PE,qu,ay'),
(175, 'PF', 'French Polynesia', 'XPF', 'Oceania', 'OC', 'fr-PF,ty'),
(176, 'PG', 'Papua New Guinea', 'PGK', 'Oceania', 'OC', 'en-PG,ho,meu,tpi'),
(177, 'PH', 'Philippines', 'PHP', 'Asia', 'AS', 'tl,en-PH,fil'),
(178, 'PK', 'Pakistan', 'PKR', 'Asia', 'AS', 'ur-PK,en-PK,pa,sd,ps,brh'),
(179, 'PL', 'Poland', 'PLN', 'Europe', 'EU', 'pl'),
(180, 'PM', 'Saint Pierre and Miquelon', 'EUR', 'North America', 'NA', 'fr-PM'),
(181, 'PN', 'Pitcairn Islands', 'NZD', 'Oceania', 'OC', 'en-PN'),
(182, 'PR', 'Puerto Rico', 'USD', 'North America', 'NA', 'en-PR,es-PR'),
(183, 'PS', 'Palestine', 'ILS', 'Asia', 'AS', 'ar-PS'),
(184, 'PT', 'Portugal', 'EUR', 'Europe', 'EU', 'pt-PT,mwl'),
(185, 'PW', 'Palau', 'USD', 'Oceania', 'OC', 'pau,sov,en-PW,tox,ja,fil,zh'),
(186, 'PY', 'Paraguay', 'PYG', 'South America', 'SA', 'es-PY,gn'),
(187, 'QA', 'Qatar', 'QAR', 'Asia', 'AS', 'ar-QA,es'),
(188, 'RE', 'Réunion', 'EUR', 'Africa', 'AF', 'fr-RE'),
(189, 'RO', 'Romania', 'RON', 'Europe', 'EU', 'ro,hu,rom'),
(190, 'RS', 'Serbia', 'RSD', 'Europe', 'EU', 'sr,hu,bs,rom'),
(191, 'RU', 'Russia', 'RUB', 'Europe', 'EU', 'ru,tt,xal,cau,ady,kv,ce,tyv,cv'),
(192, 'RW', 'Rwanda', 'RWF', 'Africa', 'AF', 'rw,en-RW,fr-RW,sw'),
(193, 'SA', 'Saudi Arabia', 'SAR', 'Asia', 'AS', 'ar-SA'),
(194, 'SB', 'Solomon Islands', 'SBD', 'Oceania', 'OC', 'en-SB,tpi'),
(195, 'SC', 'Seychelles', 'SCR', 'Africa', 'AF', 'en-SC,fr-SC'),
(196, 'SD', 'Sudan', 'SDG', 'Africa', 'AF', 'ar-SD,en,fia'),
(197, 'SE', 'Sweden', 'SEK', 'Europe', 'EU', 'sv-SE,se,sma,fi-SE'),
(198, 'SG', 'Singapore', 'SGD', 'Asia', 'AS', 'cmn,en-SG,ms-SG,ta-SG,zh-SG'),
(199, 'SH', 'Saint Helena', 'SHP', 'Africa', 'AF', 'en-SH'),
(200, 'SI', 'Slovenia', 'EUR', 'Europe', 'EU', 'sl,sh'),
(201, 'SJ', 'Svalbard and Jan Mayen', 'NOK', 'Europe', 'EU', 'no,ru'),
(202, 'SK', 'Slovakia', 'EUR', 'Europe', 'EU', 'sk,hu'),
(203, 'SL', 'Sierra Leone', 'SLL', 'Africa', 'AF', 'en-SL,men,tem'),
(204, 'SM', 'San Marino', 'EUR', 'Europe', 'EU', 'it-SM'),
(205, 'SN', 'Senegal', 'XOF', 'Africa', 'AF', 'fr-SN,wo,fuc,mnk'),
(206, 'SO', 'Somalia', 'SOS', 'Africa', 'AF', 'so-SO,ar-SO,it,en-SO'),
(207, 'SR', 'Suriname', 'SRD', 'South America', 'SA', 'nl-SR,en,srn,hns,jv'),
(208, 'SS', 'South Sudan', 'SSP', 'Africa', 'AF', 'en'),
(209, 'ST', 'São Tomé and Príncipe', 'STD', 'Africa', 'AF', 'pt-ST'),
(210, 'SV', 'El Salvador', 'USD', 'North America', 'NA', 'es-SV'),
(211, 'SX', 'Sint Maarten', 'ANG', 'North America', 'NA', 'nl,en'),
(212, 'SY', 'Syria', 'SYP', 'Asia', 'AS', 'ar-SY,ku,hy,arc,fr,en'),
(213, 'SZ', 'Swaziland', 'SZL', 'Africa', 'AF', 'en-SZ,ss-SZ'),
(214, 'TC', 'Turks and Caicos Islands', 'USD', 'North America', 'NA', 'en-TC'),
(215, 'TD', 'Chad', 'XAF', 'Africa', 'AF', 'fr-TD,ar-TD,sre'),
(216, 'TF', 'French Southern Territories', 'EUR', 'Antarctica', 'AN', 'fr'),
(217, 'TG', 'Togo', 'XOF', 'Africa', 'AF', 'fr-TG,ee,hna,kbp,dag,ha'),
(218, 'TH', 'Thailand', 'THB', 'Asia', 'AS', 'th,en'),
(219, 'TJ', 'Tajikistan', 'TJS', 'Asia', 'AS', 'tg,ru'),
(220, 'TK', 'Tokelau', 'NZD', 'Oceania', 'OC', 'tkl,en-TK'),
(221, 'TL', 'East Timor', 'USD', 'Oceania', 'OC', 'tet,pt-TL,id,en'),
(222, 'TM', 'Turkmenistan', 'TMT', 'Asia', 'AS', 'tk,ru,uz'),
(223, 'TN', 'Tunisia', 'TND', 'Africa', 'AF', 'ar-TN,fr'),
(224, 'TO', 'Tonga', 'TOP', 'Oceania', 'OC', 'to,en-TO'),
(225, 'TR', 'Turkey', 'TRY', 'Asia', 'AS', 'tr-TR,ku,diq,az,av'),
(226, 'TT', 'Trinidad and Tobago', 'TTD', 'North America', 'NA', 'en-TT,hns,fr,es,zh'),
(227, 'TV', 'Tuvalu', 'AUD', 'Oceania', 'OC', 'tvl,en,sm,gil'),
(228, 'TW', 'Taiwan', 'TWD', 'Asia', 'AS', 'zh-TW,zh,nan,hak'),
(229, 'TZ', 'Tanzania', 'TZS', 'Africa', 'AF', 'sw-TZ,en,ar'),
(230, 'UA', 'Ukraine', 'UAH', 'Europe', 'EU', 'uk,ru-UA,rom,pl,hu'),
(231, 'UG', 'Uganda', 'UGX', 'Africa', 'AF', 'en-UG,lg,sw,ar'),
(232, 'UM', 'U.S. Minor Outlying Islands', 'USD', 'Oceania', 'OC', 'en-UM'),
(233, 'US', 'United States', 'USD', 'North America', 'NA', 'en-US,es-US,haw,fr'),
(234, 'UY', 'Uruguay', 'UYU', 'South America', 'SA', 'es-UY'),
(235, 'UZ', 'Uzbekistan', 'UZS', 'Asia', 'AS', 'uz,ru,tg'),
(236, 'VA', 'Vatican City', 'EUR', 'Europe', 'EU', 'la,it,fr'),
(237, 'VC', 'Saint Vincent and the Grenadines', 'XCD', 'North America', 'NA', 'en-VC,fr'),
(238, 'VE', 'Venezuela', 'VEF', 'South America', 'SA', 'es-VE'),
(239, 'VG', 'British Virgin Islands', 'USD', 'North America', 'NA', 'en-VG'),
(240, 'VI', 'U.S. Virgin Islands', 'USD', 'North America', 'NA', 'en-VI'),
(241, 'VN', 'Vietnam', 'VND', 'Asia', 'AS', 'vi,en,fr,zh,km'),
(242, 'VU', 'Vanuatu', 'VUV', 'Oceania', 'OC', 'bi,en-VU,fr-VU'),
(243, 'WF', 'Wallis and Futuna', 'XPF', 'Oceania', 'OC', 'wls,fud,fr-WF'),
(244, 'WS', 'Samoa', 'WST', 'Oceania', 'OC', 'sm,en-WS'),
(245, 'XK', 'Kosovo', 'EUR', 'Europe', 'EU', 'sq,sr'),
(246, 'YE', 'Yemen', 'YER', 'Asia', 'AS', 'ar-YE'),
(247, 'YT', 'Mayotte', 'EUR', 'Africa', 'AF', 'fr-YT'),
(248, 'ZA', 'South Africa', 'ZAR', 'Africa', 'AF', 'zu,xh,af,nso,en-ZA,tn,st,ts,ss'),
(249, 'ZM', 'Zambia', 'ZMW', 'Africa', 'AF', 'en-ZM,bem,loz,lun,lue,ny,toi'),
(250, 'ZW', 'Zimbabwe', 'ZWL', 'Africa', 'AF', 'en-ZW,sn,nr,nd'),
(251, 'AD', 'Andorra', 'EUR', 'Europe', 'EU', 'ca'),
(252, 'AE', 'United Arab Emirates', 'AED', 'Asia', 'AS', 'ar-AE,fa,en,hi,ur'),
(253, 'AF', 'Afghanistan', 'AFN', 'Asia', 'AS', 'fa-AF,ps,uz-AF,tk'),
(254, 'AG', 'Antigua and Barbuda', 'XCD', 'North America', 'NA', 'en-AG'),
(255, 'AI', 'Anguilla', 'XCD', 'North America', 'NA', 'en-AI'),
(256, 'AL', 'Albania', 'ALL', 'Europe', 'EU', 'sq,el'),
(257, 'AM', 'Armenia', 'AMD', 'Asia', 'AS', 'hy'),
(258, 'AO', 'Angola', 'AOA', 'Africa', 'AF', 'pt-AO'),
(259, 'AQ', 'Antarctica', '', 'Antarctica', 'AN', ''),
(260, 'AR', 'Argentina', 'ARS', 'South America', 'SA', 'es-AR,en,it,de,fr,gn'),
(261, 'AS', 'American Samoa', 'USD', 'Oceania', 'OC', 'en-AS,sm,to'),
(262, 'AT', 'Austria', 'EUR', 'Europe', 'EU', 'de-AT,hr,hu,sl'),
(263, 'AU', 'Australia', 'AUD', 'Oceania', 'OC', 'en-AU'),
(264, 'AW', 'Aruba', 'AWG', 'North America', 'NA', 'nl-AW,es,en'),
(265, 'AX', 'Åland', 'EUR', 'Europe', 'EU', 'sv-AX'),
(266, 'AZ', 'Azerbaijan', 'AZN', 'Asia', 'AS', 'az,ru,hy'),
(267, 'BA', 'Bosnia and Herzegovina', 'BAM', 'Europe', 'EU', 'bs,hr-BA,sr-BA'),
(268, 'BB', 'Barbados', 'BBD', 'North America', 'NA', 'en-BB'),
(269, 'BD', 'Bangladesh', 'BDT', 'Asia', 'AS', 'bn-BD,en'),
(270, 'BE', 'Belgium', 'EUR', 'Europe', 'EU', 'nl-BE,fr-BE,de-BE'),
(271, 'BF', 'Burkina Faso', 'XOF', 'Africa', 'AF', 'fr-BF'),
(272, 'BG', 'Bulgaria', 'BGN', 'Europe', 'EU', 'bg,tr-BG'),
(273, 'BH', 'Bahrain', 'BHD', 'Asia', 'AS', 'ar-BH,en,fa,ur'),
(274, 'BI', 'Burundi', 'BIF', 'Africa', 'AF', 'fr-BI,rn'),
(275, 'BJ', 'Benin', 'XOF', 'Africa', 'AF', 'fr-BJ'),
(276, 'BL', 'Saint Barthélemy', 'EUR', 'North America', 'NA', 'fr'),
(277, 'BM', 'Bermuda', 'BMD', 'North America', 'NA', 'en-BM,pt'),
(278, 'BN', 'Brunei', 'BND', 'Asia', 'AS', 'ms-BN,en-BN'),
(279, 'BO', 'Bolivia', 'BOB', 'South America', 'SA', 'es-BO,qu,ay'),
(280, 'BQ', 'Bonaire', 'USD', 'North America', 'NA', 'nl,pap,en'),
(281, 'BR', 'Brazil', 'BRL', 'South America', 'SA', 'pt-BR,es,en,fr'),
(282, 'BS', 'Bahamas', 'BSD', 'North America', 'NA', 'en-BS'),
(283, 'BT', 'Bhutan', 'BTN', 'Asia', 'AS', 'dz'),
(284, 'BV', 'Bouvet Island', 'NOK', 'Antarctica', 'AN', ''),
(285, 'BW', 'Botswana', 'BWP', 'Africa', 'AF', 'en-BW,tn-BW'),
(286, 'BY', 'Belarus', 'BYR', 'Europe', 'EU', 'be,ru'),
(287, 'BZ', 'Belize', 'BZD', 'North America', 'NA', 'en-BZ,es'),
(288, 'CA', 'Canada', 'CAD', 'North America', 'NA', 'en-CA,fr-CA,iu'),
(289, 'CC', 'Cocos [Keeling] Islands', 'AUD', 'Asia', 'AS', 'ms-CC,en'),
(290, 'CD', 'Democratic Republic of the Congo', 'CDF', 'Africa', 'AF', 'fr-CD,ln,kg'),
(291, 'CF', 'Central African Republic', 'XAF', 'Africa', 'AF', 'fr-CF,sg,ln,kg'),
(292, 'CG', 'Republic of the Congo', 'XAF', 'Africa', 'AF', 'fr-CG,kg,ln-CG'),
(293, 'CH', 'Switzerland', 'CHF', 'Europe', 'EU', 'de-CH,fr-CH,it-CH,rm'),
(294, 'CI', 'Ivory Coast', 'XOF', 'Africa', 'AF', 'fr-CI'),
(295, 'CK', 'Cook Islands', 'NZD', 'Oceania', 'OC', 'en-CK,mi'),
(296, 'CL', 'Chile', 'CLP', 'South America', 'SA', 'es-CL'),
(297, 'CM', 'Cameroon', 'XAF', 'Africa', 'AF', 'en-CM,fr-CM'),
(298, 'CN', 'China', 'CNY', 'Asia', 'AS', 'zh-CN,yue,wuu,dta,ug,za'),
(299, 'CO', 'Colombia', 'COP', 'South America', 'SA', 'es-CO'),
(300, 'CR', 'Costa Rica', 'CRC', 'North America', 'NA', 'es-CR,en'),
(301, 'CU', 'Cuba', 'CUP', 'North America', 'NA', 'es-CU'),
(302, 'CV', 'Cape Verde', 'CVE', 'Africa', 'AF', 'pt-CV'),
(303, 'CW', 'Curacao', 'ANG', 'North America', 'NA', 'nl,pap'),
(304, 'CX', 'Christmas Island', 'AUD', 'Asia', 'AS', 'en,zh,ms-CC'),
(305, 'CY', 'Cyprus', 'EUR', 'Europe', 'EU', 'el-CY,tr-CY,en'),
(306, 'CZ', 'Czech Republic', 'CZK', 'Europe', 'EU', 'cs,sk'),
(307, 'DE', 'Germany', 'EUR', 'Europe', 'EU', 'de'),
(308, 'DJ', 'Djibouti', 'DJF', 'Africa', 'AF', 'fr-DJ,ar,so-DJ,aa'),
(309, 'DK', 'Denmark', 'DKK', 'Europe', 'EU', 'da-DK,en,fo,de-DK'),
(310, 'DM', 'Dominica', 'XCD', 'North America', 'NA', 'en-DM'),
(311, 'DO', 'Dominican Republic', 'DOP', 'North America', 'NA', 'es-DO'),
(312, 'DZ', 'Algeria', 'DZD', 'Africa', 'AF', 'ar-DZ'),
(313, 'EC', 'Ecuador', 'USD', 'South America', 'SA', 'es-EC'),
(314, 'EE', 'Estonia', 'EUR', 'Europe', 'EU', 'et,ru'),
(315, 'EG', 'Egypt', 'EGP', 'Africa', 'AF', 'ar-EG,en,fr'),
(316, 'EH', 'Western Sahara', 'MAD', 'Africa', 'AF', 'ar,mey'),
(317, 'ER', 'Eritrea', 'ERN', 'Africa', 'AF', 'aa-ER,ar,tig,kun,ti-ER'),
(318, 'ES', 'Spain', 'EUR', 'Europe', 'EU', 'es-ES,ca,gl,eu,oc'),
(319, 'ET', 'Ethiopia', 'ETB', 'Africa', 'AF', 'am,en-ET,om-ET,ti-ET,so-ET,sid'),
(320, 'FI', 'Finland', 'EUR', 'Europe', 'EU', 'fi-FI,sv-FI,smn'),
(321, 'FJ', 'Fiji', 'FJD', 'Oceania', 'OC', 'en-FJ,fj'),
(322, 'FK', 'Falkland Islands', 'FKP', 'South America', 'SA', 'en-FK'),
(323, 'FM', 'Micronesia', 'USD', 'Oceania', 'OC', 'en-FM,chk,pon,yap,kos,uli,woe,'),
(324, 'FO', 'Faroe Islands', 'DKK', 'Europe', 'EU', 'fo,da-FO'),
(325, 'FR', 'France', 'EUR', 'Europe', 'EU', 'fr-FR,frp,br,co,ca,eu,oc'),
(326, 'GA', 'Gabon', 'XAF', 'Africa', 'AF', 'fr-GA'),
(327, 'GB', 'United Kingdom', 'GBP', 'Europe', 'EU', 'en-GB,cy-GB,gd'),
(328, 'GD', 'Grenada', 'XCD', 'North America', 'NA', 'en-GD'),
(329, 'GE', 'Georgia', 'GEL', 'Asia', 'AS', 'ka,ru,hy,az'),
(330, 'GF', 'French Guiana', 'EUR', 'South America', 'SA', 'fr-GF'),
(331, 'GG', 'Guernsey', 'GBP', 'Europe', 'EU', 'en,fr'),
(332, 'GH', 'Ghana', 'GHS', 'Africa', 'AF', 'en-GH,ak,ee,tw'),
(333, 'GI', 'Gibraltar', 'GIP', 'Europe', 'EU', 'en-GI,es,it,pt'),
(334, 'GL', 'Greenland', 'DKK', 'North America', 'NA', 'kl,da-GL,en'),
(335, 'GM', 'Gambia', 'GMD', 'Africa', 'AF', 'en-GM,mnk,wof,wo,ff'),
(336, 'GN', 'Guinea', 'GNF', 'Africa', 'AF', 'fr-GN'),
(337, 'GP', 'Guadeloupe', 'EUR', 'North America', 'NA', 'fr-GP'),
(338, 'GQ', 'Equatorial Guinea', 'XAF', 'Africa', 'AF', 'es-GQ,fr'),
(339, 'GR', 'Greece', 'EUR', 'Europe', 'EU', 'el-GR,en,fr'),
(340, 'GS', 'South Georgia and the South Sandwich Islands', 'GBP', 'Antarctica', 'AN', 'en'),
(341, 'GT', 'Guatemala', 'GTQ', 'North America', 'NA', 'es-GT'),
(342, 'GU', 'Guam', 'USD', 'Oceania', 'OC', 'en-GU,ch-GU'),
(343, 'GW', 'Guinea-Bissau', 'XOF', 'Africa', 'AF', 'pt-GW,pov'),
(344, 'GY', 'Guyana', 'GYD', 'South America', 'SA', 'en-GY'),
(345, 'HK', 'Hong Kong', 'HKD', 'Asia', 'AS', 'zh-HK,yue,zh,en'),
(346, 'HM', 'Heard Island and McDonald Islands', 'AUD', 'Antarctica', 'AN', ''),
(347, 'HN', 'Honduras', 'HNL', 'North America', 'NA', 'es-HN'),
(348, 'HR', 'Croatia', 'HRK', 'Europe', 'EU', 'hr-HR,sr'),
(349, 'HT', 'Haiti', 'HTG', 'North America', 'NA', 'ht,fr-HT'),
(350, 'HU', 'Hungary', 'HUF', 'Europe', 'EU', 'hu-HU'),
(351, 'ID', 'Indonesia', 'IDR', 'Asia', 'AS', 'id,en,nl,jv'),
(352, 'IE', 'Ireland', 'EUR', 'Europe', 'EU', 'en-IE,ga-IE'),
(353, 'IL', 'Israel', 'ILS', 'Asia', 'AS', 'he,ar-IL,en-IL,'),
(354, 'IM', 'Isle of Man', 'GBP', 'Europe', 'EU', 'en,gv'),
(355, 'IN', 'India', 'INR', 'Asia', 'AS', 'en-IN,hi,bn,te,mr,ta,ur,gu,kn,'),
(356, 'IO', 'British Indian Ocean Territory', 'USD', 'Asia', 'AS', 'en-IO'),
(357, 'IQ', 'Iraq', 'IQD', 'Asia', 'AS', 'ar-IQ,ku,hy'),
(358, 'IR', 'Iran', 'IRR', 'Asia', 'AS', 'fa-IR,ku'),
(359, 'IS', 'Iceland', 'ISK', 'Europe', 'EU', 'is,en,de,da,sv,no'),
(360, 'IT', 'Italy', 'EUR', 'Europe', 'EU', 'it-IT,de-IT,fr-IT,sc,ca,co,sl'),
(361, 'JE', 'Jersey', 'GBP', 'Europe', 'EU', 'en,pt'),
(362, 'JM', 'Jamaica', 'JMD', 'North America', 'NA', 'en-JM'),
(363, 'JO', 'Jordan', 'JOD', 'Asia', 'AS', 'ar-JO,en'),
(364, 'JP', 'Japan', 'JPY', 'Asia', 'AS', 'ja'),
(365, 'KE', 'Kenya', 'KES', 'Africa', 'AF', 'en-KE,sw-KE'),
(366, 'KG', 'Kyrgyzstan', 'KGS', 'Asia', 'AS', 'ky,uz,ru'),
(367, 'KH', 'Cambodia', 'KHR', 'Asia', 'AS', 'km,fr,en'),
(368, 'KI', 'Kiribati', 'AUD', 'Oceania', 'OC', 'en-KI,gil'),
(369, 'KM', 'Comoros', 'KMF', 'Africa', 'AF', 'ar,fr-KM'),
(370, 'KN', 'Saint Kitts and Nevis', 'XCD', 'North America', 'NA', 'en-KN'),
(371, 'KP', 'North Korea', 'KPW', 'Asia', 'AS', 'ko-KP'),
(372, 'KR', 'South Korea', 'KRW', 'Asia', 'AS', 'ko-KR,en'),
(373, 'KW', 'Kuwait', 'KWD', 'Asia', 'AS', 'ar-KW,en'),
(374, 'KY', 'Cayman Islands', 'KYD', 'North America', 'NA', 'en-KY'),
(375, 'KZ', 'Kazakhstan', 'KZT', 'Asia', 'AS', 'kk,ru'),
(376, 'LA', 'Laos', 'LAK', 'Asia', 'AS', 'lo,fr,en'),
(377, 'LB', 'Lebanon', 'LBP', 'Asia', 'AS', 'ar-LB,fr-LB,en,hy'),
(378, 'LC', 'Saint Lucia', 'XCD', 'North America', 'NA', 'en-LC'),
(379, 'LI', 'Liechtenstein', 'CHF', 'Europe', 'EU', 'de-LI'),
(380, 'LK', 'Sri Lanka', 'LKR', 'Asia', 'AS', 'si,ta,en'),
(381, 'LR', 'Liberia', 'LRD', 'Africa', 'AF', 'en-LR'),
(382, 'LS', 'Lesotho', 'LSL', 'Africa', 'AF', 'en-LS,st,zu,xh'),
(383, 'LT', 'Lithuania', 'LTL', 'Europe', 'EU', 'lt,ru,pl'),
(384, 'LU', 'Luxembourg', 'EUR', 'Europe', 'EU', 'lb,de-LU,fr-LU'),
(385, 'LV', 'Latvia', 'EUR', 'Europe', 'EU', 'lv,ru,lt'),
(386, 'LY', 'Libya', 'LYD', 'Africa', 'AF', 'ar-LY,it,en'),
(387, 'MA', 'Morocco', 'MAD', 'Africa', 'AF', 'ar-MA,fr'),
(388, 'MC', 'Monaco', 'EUR', 'Europe', 'EU', 'fr-MC,en,it'),
(389, 'MD', 'Moldova', 'MDL', 'Europe', 'EU', 'ro,ru,gag,tr'),
(390, 'ME', 'Montenegro', 'EUR', 'Europe', 'EU', 'sr,hu,bs,sq,hr,rom'),
(391, 'MF', 'Saint Martin', 'EUR', 'North America', 'NA', 'fr'),
(392, 'MG', 'Madagascar', 'MGA', 'Africa', 'AF', 'fr-MG,mg'),
(393, 'MH', 'Marshall Islands', 'USD', 'Oceania', 'OC', 'mh,en-MH'),
(394, 'MK', 'Macedonia', 'MKD', 'Europe', 'EU', 'mk,sq,tr,rmm,sr'),
(395, 'ML', 'Mali', 'XOF', 'Africa', 'AF', 'fr-ML,bm'),
(396, 'MM', 'Myanmar [Burma]', 'MMK', 'Asia', 'AS', 'my'),
(397, 'MN', 'Mongolia', 'MNT', 'Asia', 'AS', 'mn,ru'),
(398, 'MO', 'Macao', 'MOP', 'Asia', 'AS', 'zh,zh-MO,pt'),
(399, 'MP', 'Northern Mariana Islands', 'USD', 'Oceania', 'OC', 'fil,tl,zh,ch-MP,en-MP'),
(400, 'MQ', 'Martinique', 'EUR', 'North America', 'NA', 'fr-MQ'),
(401, 'MR', 'Mauritania', 'MRO', 'Africa', 'AF', 'ar-MR,fuc,snk,fr,mey,wo'),
(402, 'MS', 'Montserrat', 'XCD', 'North America', 'NA', 'en-MS'),
(403, 'MT', 'Malta', 'EUR', 'Europe', 'EU', 'mt,en-MT'),
(404, 'MU', 'Mauritius', 'MUR', 'Africa', 'AF', 'en-MU,bho,fr'),
(405, 'MV', 'Maldives', 'MVR', 'Asia', 'AS', 'dv,en'),
(406, 'MW', 'Malawi', 'MWK', 'Africa', 'AF', 'ny,yao,tum,swk'),
(407, 'MX', 'Mexico', 'MXN', 'North America', 'NA', 'es-MX'),
(408, 'MY', 'Malaysia', 'MYR', 'Asia', 'AS', 'ms-MY,en,zh,ta,te,ml,pa,th'),
(409, 'MZ', 'Mozambique', 'MZN', 'Africa', 'AF', 'pt-MZ,vmw'),
(410, 'NA', 'Namibia', 'NAD', 'Africa', 'AF', 'en-NA,af,de,hz,naq'),
(411, 'NC', 'New Caledonia', 'XPF', 'Oceania', 'OC', 'fr-NC'),
(412, 'NE', 'Niger', 'XOF', 'Africa', 'AF', 'fr-NE,ha,kr,dje'),
(413, 'NF', 'Norfolk Island', 'AUD', 'Oceania', 'OC', 'en-NF'),
(414, 'NG', 'Nigeria', 'NGN', 'Africa', 'AF', 'en-NG,ha,yo,ig,ff'),
(415, 'NI', 'Nicaragua', 'NIO', 'North America', 'NA', 'es-NI,en'),
(416, 'NL', 'Netherlands', 'EUR', 'Europe', 'EU', 'nl-NL,fy-NL'),
(417, 'NO', 'Norway', 'NOK', 'Europe', 'EU', 'no,nb,nn,se,fi'),
(418, 'NP', 'Nepal', 'NPR', 'Asia', 'AS', 'ne,en'),
(419, 'NR', 'Nauru', 'AUD', 'Oceania', 'OC', 'na,en-NR'),
(420, 'NU', 'Niue', 'NZD', 'Oceania', 'OC', 'niu,en-NU'),
(421, 'NZ', 'New Zealand', 'NZD', 'Oceania', 'OC', 'en-NZ,mi'),
(422, 'OM', 'Oman', 'OMR', 'Asia', 'AS', 'ar-OM,en,bal,ur'),
(423, 'PA', 'Panama', 'PAB', 'North America', 'NA', 'es-PA,en'),
(424, 'PE', 'Peru', 'PEN', 'South America', 'SA', 'es-PE,qu,ay'),
(425, 'PF', 'French Polynesia', 'XPF', 'Oceania', 'OC', 'fr-PF,ty'),
(426, 'PG', 'Papua New Guinea', 'PGK', 'Oceania', 'OC', 'en-PG,ho,meu,tpi'),
(427, 'PH', 'Philippines', 'PHP', 'Asia', 'AS', 'tl,en-PH,fil'),
(428, 'PK', 'Pakistan', 'PKR', 'Asia', 'AS', 'ur-PK,en-PK,pa,sd,ps,brh'),
(429, 'PL', 'Poland', 'PLN', 'Europe', 'EU', 'pl'),
(430, 'PM', 'Saint Pierre and Miquelon', 'EUR', 'North America', 'NA', 'fr-PM'),
(431, 'PN', 'Pitcairn Islands', 'NZD', 'Oceania', 'OC', 'en-PN'),
(432, 'PR', 'Puerto Rico', 'USD', 'North America', 'NA', 'en-PR,es-PR'),
(433, 'PS', 'Palestine', 'ILS', 'Asia', 'AS', 'ar-PS'),
(434, 'PT', 'Portugal', 'EUR', 'Europe', 'EU', 'pt-PT,mwl'),
(435, 'PW', 'Palau', 'USD', 'Oceania', 'OC', 'pau,sov,en-PW,tox,ja,fil,zh'),
(436, 'PY', 'Paraguay', 'PYG', 'South America', 'SA', 'es-PY,gn'),
(437, 'QA', 'Qatar', 'QAR', 'Asia', 'AS', 'ar-QA,es'),
(438, 'RE', 'Réunion', 'EUR', 'Africa', 'AF', 'fr-RE'),
(439, 'RO', 'Romania', 'RON', 'Europe', 'EU', 'ro,hu,rom'),
(440, 'RS', 'Serbia', 'RSD', 'Europe', 'EU', 'sr,hu,bs,rom'),
(441, 'RU', 'Russia', 'RUB', 'Europe', 'EU', 'ru,tt,xal,cau,ady,kv,ce,tyv,cv'),
(442, 'RW', 'Rwanda', 'RWF', 'Africa', 'AF', 'rw,en-RW,fr-RW,sw'),
(443, 'SA', 'Saudi Arabia', 'SAR', 'Asia', 'AS', 'ar-SA'),
(444, 'SB', 'Solomon Islands', 'SBD', 'Oceania', 'OC', 'en-SB,tpi'),
(445, 'SC', 'Seychelles', 'SCR', 'Africa', 'AF', 'en-SC,fr-SC'),
(446, 'SD', 'Sudan', 'SDG', 'Africa', 'AF', 'ar-SD,en,fia'),
(447, 'SE', 'Sweden', 'SEK', 'Europe', 'EU', 'sv-SE,se,sma,fi-SE'),
(448, 'SG', 'Singapore', 'SGD', 'Asia', 'AS', 'cmn,en-SG,ms-SG,ta-SG,zh-SG'),
(449, 'SH', 'Saint Helena', 'SHP', 'Africa', 'AF', 'en-SH'),
(450, 'SI', 'Slovenia', 'EUR', 'Europe', 'EU', 'sl,sh'),
(451, 'SJ', 'Svalbard and Jan Mayen', 'NOK', 'Europe', 'EU', 'no,ru'),
(452, 'SK', 'Slovakia', 'EUR', 'Europe', 'EU', 'sk,hu'),
(453, 'SL', 'Sierra Leone', 'SLL', 'Africa', 'AF', 'en-SL,men,tem'),
(454, 'SM', 'San Marino', 'EUR', 'Europe', 'EU', 'it-SM'),
(455, 'SN', 'Senegal', 'XOF', 'Africa', 'AF', 'fr-SN,wo,fuc,mnk'),
(456, 'SO', 'Somalia', 'SOS', 'Africa', 'AF', 'so-SO,ar-SO,it,en-SO'),
(457, 'SR', 'Suriname', 'SRD', 'South America', 'SA', 'nl-SR,en,srn,hns,jv'),
(458, 'SS', 'South Sudan', 'SSP', 'Africa', 'AF', 'en'),
(459, 'ST', 'São Tomé and Príncipe', 'STD', 'Africa', 'AF', 'pt-ST'),
(460, 'SV', 'El Salvador', 'USD', 'North America', 'NA', 'es-SV'),
(461, 'SX', 'Sint Maarten', 'ANG', 'North America', 'NA', 'nl,en'),
(462, 'SY', 'Syria', 'SYP', 'Asia', 'AS', 'ar-SY,ku,hy,arc,fr,en'),
(463, 'SZ', 'Swaziland', 'SZL', 'Africa', 'AF', 'en-SZ,ss-SZ'),
(464, 'TC', 'Turks and Caicos Islands', 'USD', 'North America', 'NA', 'en-TC'),
(465, 'TD', 'Chad', 'XAF', 'Africa', 'AF', 'fr-TD,ar-TD,sre'),
(466, 'TF', 'French Southern Territories', 'EUR', 'Antarctica', 'AN', 'fr'),
(467, 'TG', 'Togo', 'XOF', 'Africa', 'AF', 'fr-TG,ee,hna,kbp,dag,ha'),
(468, 'TH', 'Thailand', 'THB', 'Asia', 'AS', 'th,en'),
(469, 'TJ', 'Tajikistan', 'TJS', 'Asia', 'AS', 'tg,ru'),
(470, 'TK', 'Tokelau', 'NZD', 'Oceania', 'OC', 'tkl,en-TK'),
(471, 'TL', 'East Timor', 'USD', 'Oceania', 'OC', 'tet,pt-TL,id,en'),
(472, 'TM', 'Turkmenistan', 'TMT', 'Asia', 'AS', 'tk,ru,uz'),
(473, 'TN', 'Tunisia', 'TND', 'Africa', 'AF', 'ar-TN,fr'),
(474, 'TO', 'Tonga', 'TOP', 'Oceania', 'OC', 'to,en-TO'),
(475, 'TR', 'Turkey', 'TRY', 'Asia', 'AS', 'tr-TR,ku,diq,az,av'),
(478, 'TW', 'Taiwan', 'TWD', 'Asia', 'AS', 'zh-TW,zh,nan,hak'),
(479, 'TZ', 'Tanzania', 'TZS', 'Africa', 'AF', 'sw-TZ,en,ar'),
(480, 'UA', 'Ukraine', 'UAH', 'Europe', 'EU', 'uk,ru-UA,rom,pl,hu'),
(481, 'UG', 'Uganda', 'UGX', 'Africa', 'AF', 'en-UG,lg,sw,ar'),
(483, 'US', 'United States', 'USD', 'North America', 'NA', 'en-US,es-US,haw,fr');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(20) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `income_type` varchar(50) NOT NULL,
  `income_for` varchar(50) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `total_product` int(11) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_referral_id` varchar(20) NOT NULL,
  `sales_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `total_product`, `total_price`, `customer_id`, `customer_referral_id`, `sales_by`, `created_at`, `modified_at`) VALUES
(1, 1, '', 6, '223334', 32, 1479295572, 1479295572),
(2, 1, '', 14, '312650', 6, 1479298216, 1479298216),
(3, 1, '', 6, '223334', 1, 1479406001, 1479406001),
(4, 1, '', 6, '223334', 1, 1479406395, 1479406395),
(5, 1, '', 5, '1122334455', 2, 1479472426, 1479472426);

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pay_type` double NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `rolename` varchar(50) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `amount` double NOT NULL,
  `points_mode` varchar(30) NOT NULL,
  `capital` double NOT NULL,
  `count` text NOT NULL,
  `liabilities` double NOT NULL,
  `cash` double NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `transaction` varchar(250) NOT NULL,
  `start_date` date NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `challan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `user_id`, `email`, `pay_type`, `account_no`, `rolename`, `debit`, `credit`, `amount`, `points_mode`, `capital`, `count`, `liabilities`, `cash`, `invoice_id`, `remarks`, `transaction`, `start_date`, `created_at`, `modified_at`, `modified_by`, `challan`) VALUES
(1, 0, 'mr.anandsagar@gmail.com', 3, '10557001751359602748', '5', 0, 20, 20, 'wallet', 0, '', 0, 0, 0, 'New member welcome offer', '', '0000-00-00', 1479465634, 1479465634, 0, 'no_invoice.jpg'),
(2, 1, 'anandsagar007@gmail.com', 2, '1111111111111111', '11', 0, 10, 10, 'wallet', 0, '', 0, 0, 0, 'New member welcome offer', '', '0000-00-00', 1479465634, 1479465634, 0, 'no_invoice.jpg'),
(3, 0, 'bhavya.r.sagar@gmail.com', 3, '105560037120476593281', '12', 0, 20, 20, 'wallet', 0, '', 0, 0, 0, 'New member Sponsorship', '', '0000-00-00', 1479466869, 1479466869, 0, 'no_invoice.jpg'),
(4, 2, 'mr.anandsagar@gmail.com', 2, '105570017125559990001', '12', 0, 10, 10, 'wallet', 0, '', 0, 0, 0, 'Joining offer', '', '0000-00-00', 1479466869, 1479466869, 0, 'no_invoice.jpg'),
(5, 0, 'satishspatil21@gmail.com', 3, '105560001123016428597', '12', 0, 20, 20, 'wallet', 0, '', 0, 0, 0, 'New member Sponsorship', '', '0000-00-00', 1479467515, 1479467515, 0, 'no_invoice.jpg'),
(6, 2, 'mr.anandsagar@gmail.com', 2, '105570017125559990001', '12', 0, 10, 10, 'wallet', 0, '', 0, 0, 0, 'Joining offer', '', '0000-00-00', 1479467516, 1479467516, 0, 'no_invoice.jpg'),
(7, 4, 'satishspatil21@gmail.com', 3, '105560001121234512345', '12', 0, 0, 0, 'wallet', 0, 'yes', 0, 0, 0, 'One time Sponsorship Charges Deduction', '', '2016-11-18', 1479468234, 1479468234, 0, 'no_invoice.jpg'),
(8, 2, 'mr.anandsagar@gmail.com', 4, '105570017125559990001', '12', 0, 100, 100, 'wallet', 0, 'yes', 0, 0, 0, 'Sponsorship Commission to Consumer', '', '2016-11-18', 1479468234, 1479468234, 0, 'no_invoice.jpg'),
(9, 5, 'spremainder@gmail.com', 34, '105560001131122334455', '13', 50, 0, 50, 'wallet', 0, 'yes', 0, 0, 5, 'Ledger Update: Recieved Payment from Volunteer/Consumer-Anand for the Invoice ID-5', '', '0000-00-00', 1479472426, 1479472426, 0, 'no_invoice.jpg'),
(10, 2, 'mr.anandsagar@gmail.com', 34, '105570017125559990001', '12', 0, 50, 50, 'wallet', 0, 'no', 0, 0, 5, 'Ledger Update: Paid to ''Retailer-Satish'' for the Invoice ID-5', '', '0000-00-00', 1479472426, 1479472426, 0, 'no_invoice.jpg'),
(11, 1, 'anandsagar007@gmail.com', 36, '1111111111111111', '11', 0, 0.1, 0.1, 'loyality', 0, '', 0, 0, 5, 'Ledger Update: Referrals Business benefits for Invoice ID-5', '', '0000-00-00', 1479472426, 1479472426, 0, 'no_invoice.jpg'),
(12, 2, 'mr.anandsagar@gmail.com', 36, '105570017125559990001', '12', 0, 50, 50, 'wallet', 0, '', 0, 0, 5, 'Volunteer/Consumer- commission for Invoice ID-5', '', '0000-00-00', 1479472426, 1479472426, 0, 'no_invoice.jpg'),
(13, 5, 'spremainder@gmail.com', 36, '105560001131122334455', '13', 0, 50, 50, 'wallet', 0, '', 0, 0, 5, 'Retailer- commission for Invoice ID -5', '', '0000-00-00', 1479472426, 1479472426, 0, 'no_invoice.jpg'),
(14, 2, 'mr.anandsagar@gmail.com', 34, '105570017125559990001', '12', 0, 0, 0, 'wallet', 0, '', 0, 0, 5, 'Commission deduction from -Volunteer/Consumer-for Invoice ID -5', '', '0000-00-00', 1479472427, 1479472427, 0, 'no_invoice.jpg'),
(15, 5, 'spremainder@gmail.com', 34, '105560001131122334455', '13', 0.5, 0, 0.5, 'wallet', 0, '', 0, 0, 5, 'Commission deduction from -Retailer-for Invoice ID -5', '', '0000-00-00', 1479472427, 1479472427, 0, 'no_invoice.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `loan_name` varchar(255) NOT NULL,
  `identity_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `acct_id` int(11) NOT NULL,
  `sub_acct_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `emi` double NOT NULL,
  `deduct_date` varchar(20) NOT NULL,
  `bal_amt` double NOT NULL,
  `paid` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `tenure` int(2) NOT NULL,
  `period` int(2) NOT NULL,
  `to_role` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `modified_by` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `device_info` varchar(500) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user_id`, `ip`, `device_info`, `created_at`) VALUES
(1, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479014406),
(2, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479014729),
(3, 4, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479017388),
(4, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479017476),
(5, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479018259),
(6, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479019453),
(7, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479029870),
(8, 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479029973),
(9, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479031115),
(10, 6, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479033395),
(11, 8, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479033532),
(12, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479038017),
(13, 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479038148),
(14, 12, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479038229),
(15, 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479039293),
(16, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479039593),
(17, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479098529),
(18, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479100002),
(19, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479110213),
(20, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479110324),
(21, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479110875),
(22, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479130649),
(23, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479137148),
(24, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479138565),
(25, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479173661),
(26, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479174363),
(27, 21, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479179324),
(28, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479185936),
(29, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1479210419),
(30, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479210500),
(31, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479222289),
(32, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479232743),
(33, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479233334),
(34, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479278992),
(35, 6, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479281611),
(36, 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479281672),
(37, 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479283816),
(38, 32, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479294640),
(39, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479295424),
(40, 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479296043),
(41, 6, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479296999),
(42, 14, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479298707),
(43, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479379234),
(44, 6, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479380828),
(45, 6, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479381982),
(46, 6, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479393805),
(47, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479398132),
(48, 6, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479405442),
(49, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479438765),
(50, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479454160),
(51, 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479462481),
(52, 6, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479463474),
(53, 1, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479465737),
(54, 2, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479466113),
(55, 3, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479467066),
(56, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479467128),
(57, 2, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479467239),
(58, 4, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479467593),
(59, 2, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479467917),
(60, 4, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479468119),
(61, 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479468306),
(62, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479468455),
(63, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479468844),
(64, 4, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479468876),
(65, 2, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479471722),
(66, 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1479472545),
(67, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479472594),
(68, 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479487295),
(69, 1, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479492286),
(70, 2, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479495869),
(71, 2, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36', 1479523215);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `option` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option`, `value`) VALUES
(1, 'company_name', 'Consumerfirst'),
(2, 'default_email', 'anand007555@gmail.com'),
(3, 'contact_address', '<pre>Thank you for purchasing product form our store, you will get some extra commission based on your purchasing amount on your account, please check your account from dashboard. &lt;br&gt; Below are your purchasing details.</pre><br>'),
(4, 'agent_commision', '10'),
(5, 'user_commision', '10'),
(6, 'referral_commision', '10'),
(7, 'admin_commision', '10'),
(8, 'invoice_information', 'Your all payment details are available at My Account section. '),
(9, 'invoice_terms', 'Invoice terms and condition'),
(10, 'email_text_product_sales', '<pre>Thank you for doing transaction with Consumer-1st, you will get more benefits/commission based on your transactions.\r\nplease check your My Account details for any detail Information.</pre><br>'),
(11, 'default_currency', 'Rs');

-- --------------------------------------------------------

--
-- Table structure for table `otp_transactions`
--

CREATE TABLE `otp_transactions` (
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `referral_code` varchar(12) COLLATE utf8_bin NOT NULL,
  `referredByCode` varchar(12) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `key_id` varchar(10) COLLATE utf8_bin NOT NULL,
  `otp` varchar(15) COLLATE utf8_bin NOT NULL,
  `sms_no` varchar(10) COLLATE utf8_bin NOT NULL,
  `company_name` varchar(60) COLLATE utf8_bin NOT NULL,
  `rolename` varchar(10) COLLATE utf8_bin NOT NULL,
  `sponsor_role` varchar(10) COLLATE utf8_bin NOT NULL,
  `account_no` varchar(50) COLLATE utf8_bin NOT NULL,
  `pay_by` varchar(50) COLLATE utf8_bin NOT NULL,
  `fname` varchar(50) COLLATE utf8_bin NOT NULL,
  `amount` double NOT NULL,
  `points_mode` varchar(20) COLLATE utf8_bin NOT NULL,
  `licence` varchar(60) COLLATE utf8_bin NOT NULL,
  `from_cell` varchar(15) COLLATE utf8_bin NOT NULL,
  `to_cell` varchar(15) COLLATE utf8_bin NOT NULL,
  `used` text COLLATE utf8_bin NOT NULL,
  `pay_type` varchar(255) COLLATE utf8_bin NOT NULL,
  `ded_paytype` int(10) NOT NULL,
  `commission` double NOT NULL,
  `tranx_id` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `otp_transactions`
--

INSERT INTO `otp_transactions` (`id`, `active`, `referral_code`, `referredByCode`, `email`, `key_id`, `otp`, `sms_no`, `company_name`, `rolename`, `sponsor_role`, `account_no`, `pay_by`, `fname`, `amount`, `points_mode`, `licence`, `from_cell`, `to_cell`, `used`, `pay_type`, `ded_paytype`, `commission`, `tranx_id`, `created_at`, `modified_at`) VALUES
(1, 1, '1234512345', '5559990001', 'spremainder@gmail.com', 'retailer', '16947850', '9980569960', 'Satish Traders', '12', '13', '105560001121234512345', '1234512345', 'Satish', 0, 'wallet', 'KAR12345', '9980569960', '9902518232', 'yes', '3', 0, 100, 'Referral OTP', 1479468060, 1479468234);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `payee_id` int(11) NOT NULL,
  `payee_referralCode` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `pay_by` int(11) NOT NULL,
  `pay_for` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('requested','approved') NOT NULL,
  `payment_for_date` datetime NOT NULL,
  `payment_make_date` datetime NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` enum('paypal','skrill','payoneer','bank') NOT NULL,
  `payment_method_email` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `iban` varchar(100) NOT NULL,
  `swift` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_address` varchar(100) NOT NULL,
  `bank_branch_name` varchar(100) NOT NULL,
  `bank_provenance` varchar(100) NOT NULL,
  `bank_country` varchar(100) NOT NULL,
  `status` enum('pending','approve','decline') NOT NULL,
  `request_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission_grp`
--

CREATE TABLE `permission_grp` (
  `id` int(10) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_grp`
--

INSERT INTO `permission_grp` (`id`, `group_name`, `parent`, `active`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 'C & F', 0, 0, 0, 0, 0),
(2, 'Warehouse', 0, 0, 0, 0, 0),
(3, 'Stock Point\r\n', 0, 0, 0, 0, 0),
(4, 'Agent\r\n', 0, 0, 0, 0, 0),
(5, 'Outlet\r\n', 0, 0, 0, 0, 0),
(6, 'Retailor/Reseller', 0, 1, 0, 0, 0),
(7, 'Customer\r\n', 0, 0, 0, 0, 0),
(8, 'Test New User Role', 0, 1, 43, 1465322017, 1465322017),
(9, 'Assistant Accountant', 0, 1, 43, 1466011013, 1466011013);

-- --------------------------------------------------------

--
-- Table structure for table `points_ratio`
--

CREATE TABLE `points_ratio` (
  `id` int(10) NOT NULL,
  `identity` varchar(30) NOT NULL,
  `identity_id` varchar(255) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `alpha` float NOT NULL,
  `beta` float NOT NULL,
  `gamma` float NOT NULL,
  `modified_by` varchar(60) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `visible` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points_ratio`
--

INSERT INTO `points_ratio` (`id`, `identity`, `identity_id`, `remarks`, `start_date`, `end_date`, `alpha`, `beta`, `gamma`, `modified_by`, `modified_at`, `created_at`, `created_by`, `visible`) VALUES
(5, 'Ratio Conversions', 'wallet', 'Wallet to all 3 ratio conversions', '2016-08-15', '9999-12-31', 10, 20, 30, 'Administrator', 1471284534, 1471284534, 43, 0),
(6, 'Ratio Conversions', 'loyality', 'Loyality Ratios', '2016-08-15', '9999-12-31', 15, 25, 35, 'Administrator', 1471285128, 1471285128, 43, 0),
(7, 'Ratio Conversions', 'discount', 'Discount Ratios for Conversion Points', '2016-08-01', '9999-12-31', 20, 25, 35, 'Administrator', 1471285181, 1471285181, 43, 0),
(8, 'Ratio Conversions', 'bonus', 'Bonus Ratios. Will Consider for Later Enhancements', '2016-08-01', '9999-12-31', 39, 95, 0, '43', 1472486294, 1471285214, 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recharge`
--

CREATE TABLE `recharge` (
  `id` int(11) NOT NULL,
  `recharge_type` varchar(10) NOT NULL,
  `recharge_no` varchar(40) NOT NULL,
  `recharge_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `acct_id` int(11) NOT NULL,
  `sub_acct_id` int(11) NOT NULL,
  `to_role` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `email` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `rolename` varchar(255) NOT NULL,
  `roleid` int(2) NOT NULL,
  `fees` int(11) NOT NULL,
  `dedfees_payspec` int(2) NOT NULL,
  `comfees_payspec` int(2) NOT NULL,
  `com_per` double NOT NULL,
  `parent` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `edit` int(11) NOT NULL,
  `default` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `rolename`, `roleid`, `fees`, `dedfees_payspec`, `comfees_payspec`, `com_per`, `parent`, `active`, `permission_id`, `type`, `edit`, `default`, `created_by`, `created_at`, `modified_at`) VALUES
(11, 'Administrator', 11, 0, 0, 0, 0, 0, 1, 0, 'role_name', 1, 1, 1, 1, 1),
(12, 'Volunteer/Consumer', 15, 0, 0, 0, 0, 0, 1, 1, 'role_name', 0, 0, 1, 1479020280, 1479020280),
(13, 'Retailer', 14, 0, 3, 4, 0, 0, 1, 1, 'role_name', 0, 0, 1, 1479019937, 1479019937),
(14, 'Distributor', 16, 50000, 11, 5, 20, 0, 1, 1, 'role_name', 0, 0, 1, 1479238210, 1479238210),
(15, 'Area Manager', 17, 100000, 13, 6, 20, 0, 1, 1, 'role_name', 0, 0, 1, 1479238368, 1479238368),
(16, 'C&F Manager', 18, 0, 0, 0, 0, 0, 1, 1, 'role_name', 0, 0, 1, 1479239100, 1479239100),
(17, 'Division Supervisor', 20, 0, 0, 0, 7, 0, 1, 1, 'role_name', 0, 0, 1, 1479239341, 1479239341),
(18, 'Area Manager(Lead)', 0, 0, 10, 12, 20, 0, 1, 1, 'role_name', 0, 0, 1, 1479457740, 1479457740),
(19, 'Clerical', 19, 0, 0, 0, 0, 0, 1, 0, 'role_name', 0, 0, 1, 1479239173, 1479239173),
(20, 'Opterator-Computer', 21, 0, 1, 0, 0, 0, 1, 1, 'role_name', 0, 0, 1, 1479283429, 1479283429),
(21, 'Manager Finance', 12, 0, 0, 0, 0, 0, 1, 0, 'role_name', 0, 0, 1, 1479016341, 1479016341),
(22, 'Cash Dispatcher', 13, 0, 0, 0, 5, 0, 1, 0, 'role_name', 0, 0, 1, 1479016379, 1479016379),
(23, 'Stationary Branch Manager', 23, 0, 15, 36, 10, 0, 1, 1, 'role_name', 0, 0, 1, 1479404332, 1479404332),
(24, 'Cash withdrawal', 22, 0, 3, 0, 5, 0, 1, 0, 'withdraw', 0, 0, 1, 1479295989, 1479295989);

-- --------------------------------------------------------

--
-- Table structure for table `sales_item`
--

CREATE TABLE `sales_item` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_price` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `commission` varchar(20) NOT NULL,
  `benefits` int(2) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_item`
--

INSERT INTO `sales_item` (`id`, `category_id`, `product_name`, `invoice_id`, `qty`, `item_price`, `price`, `commission`, `benefits`, `created_at`, `modified_at`) VALUES
(1, 32, 'Exchanges points', 1, 1, '200000', '200000', '0', 0, 1479295572, 1479295572),
(2, 34, 'Purchase tooth paste Bill no 44567', 2, 1, '1000', '1000', '0', 0, 1479298216, 1479298216),
(3, 32, 'Hand loan', 3, 1, '200000', '200000', '0', 0, 1479406001, 1479406001),
(4, 32, 'test', 4, 1, '10000', '10000', '0', 0, 1479406395, 1479406395),
(5, 34, 'Biscuit Purchase', 5, 1, '50', '50', '0', 0, 1479472426, 1479472426);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `opt_id` varchar(10) NOT NULL,
  `opt_name` varchar(255) NOT NULL,
  `service_type` varchar(200) NOT NULL,
  `service_category` varchar(200) NOT NULL,
  `country` varchar(50) NOT NULL,
  `region` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `email` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `opt_id`, `opt_name`, `service_type`, `service_category`, `country`, `region`, `description`, `created_by`, `created_at`, `modified_at`, `email`) VALUES
(1, '1', 'Airtel', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'airtel prepaid', 43, 33, 33, 'test@email.com'),
(2, '2', 'Vodafone', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'Vodafone prepaid', 43, 33, 33, 'test@email.com'),
(3, '3', 'BSNL Topup', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'BSNL prepaid', 43, 33, 33, 'test@email.com'),
(4, '4', 'BSNL 2G/3G', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'BSNL 2G/3G prepaid', 43, 33, 33, 'test@email.com'),
(5, '5', 'BSNL Special Vouchers (STV)', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'BSNL Special Topup Vouchers prepaid', 43, 33, 33, 'test@email.com'),
(6, '6', 'Reliance-CDMA', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'Reliance CDMA prepaid', 43, 33, 33, 'test@email.com'),
(7, '7', 'Reliance-GSM', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'Reliance GSM prepaid', 43, 33, 33, 'test@email.com'),
(8, '8', 'Aircel', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'Aircel prepaid', 43, 33, 33, 'test@email.com'),
(9, '9', 'MTNL Delhi', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'MTNL Delhi prepaid', 43, 33, 33, 'test@email.com'),
(10, '10', 'MTNL Delhi Special', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'MTNL Delhi Special prepaid', 43, 33, 33, 'test@email.com'),
(11, '11', 'Idea', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'Idea prepaid', 43, 33, 33, 'test@email.com'),
(12, '12', 'Tata Indicom', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'Tata Indicom prepaid', 43, 33, 33, 'test@email.com'),
(13, '13', 'Tata Docomo', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'Tata Docomo prepaid', 43, 33, 33, 'test@email.com'),
(14, '14', 'Tata Docomo Special', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'Tata Docomo Special prepaid', 43, 33, 33, 'test@email.com'),
(15, '15', 'MTS', 'Prepaid Mobile', 'recharge prepaid', 'india (IN)', 'pan india', 'MTS prepaid', 43, 33, 33, 'test@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `payee_id` int(11) NOT NULL,
  `ledger_type` varchar(50) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('requested','approved') NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `row_pass` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_birth` varchar(30) DEFAULT NULL,
  `profession` varchar(200) NOT NULL,
  `street_address` varchar(500) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `area_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `city_id` varchar(11) NOT NULL,
  `country` varchar(200) NOT NULL,
  `country_id` int(11) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `adhaar_no` varchar(16) NOT NULL,
  `pan_no` varchar(20) NOT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `bank_account` int(20) NOT NULL,
  `bank_address` varchar(300) NOT NULL,
  `passport_no` varchar(255) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `licence` varchar(50) NOT NULL,
  `role` varchar(200) NOT NULL,
  `rolename` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `online_status` tinyint(1) NOT NULL,
  `time` varchar(50) NOT NULL,
  `cash` varchar(50) NOT NULL,
  `others` varchar(50) NOT NULL,
  `user_lastlogin` int(11) NOT NULL,
  `referral_code` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `referredByCode` varchar(50) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `row_pass`, `email`, `contactno`, `gender`, `date_of_birth`, `profession`, `street_address`, `area_name`, `area_id`, `city`, `city_id`, `country`, `country_id`, `postal_code`, `adhaar_no`, `pan_no`, `ifsc_code`, `bank_account`, `bank_address`, `passport_no`, `company_name`, `licence`, `role`, `rolename`, `active`, `online_status`, `time`, `cash`, `others`, `user_lastlogin`, `referral_code`, `account_no`, `referredByCode`, `photo`, `created_by`, `created_at`, `modified_at`, `modified_by`) VALUES
(1, 'Supreme', 'Administrator', '5fba61a8c7a2240fc28f6e5a621696ffb39221da', 'anandsagar007@gmail.com', 'anandsagar007@gmail.com', '9980569960', '', '1990-01-01', 'Admin', 'Old Airport', 'HAL', 10, 'Bengaluru', '10', 'Bharath', 105, '560037', '1111222233334444', 'akaqw1123p', '1234567', 1919191919, 'HAL', '1111', 'Consumer1st', 'Consumer1st', 'admin', '11', 1, 0, '', '', '', 1479492286, 'ADMIN1001', '1111111111111111', 'ADMIN1000', '', 1, 1, 1, 1),
(2, 'Anand', 'Sagar', '2b70b91f972ecfe1e61d8eb2dfc4121f200dc635', 'mr.anandsagar@gmail.com', 'mr.anandsagar@gmail.com', '9980569960', '', '1982-09-29', '', '', '', 0, '', '', 'Bharath(India)', 105, '570017', '123452436273', '', '', 0, '', '', '', '', 'user', '12', 1, 1, '24', '1000', 'cloths, food', 1479523214, '5559990001', '105570017125559990001', 'admin1001', '', 1, 1479465634, 1479465634, 0),
(3, 'Bhavya', 'Sagar', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'bhavya.r.sagar@gmail.com', '9008103576', '', '1990-04-17', '', '', '', 0, '', '', 'Bharath(India)', 105, '560037', '234415243726', '', '', 0, '', '', '', '', 'user', '12', 1, 0, '50', '1000', 'cloths, food', 1479467066, '9955995599', '105560037129955995599', '5559990001', '', 1, 1479466869, 1479466869, 0),
(4, 'Satish', 'Patil', '244caed91d8ae3b82f9faa71da0eb616526f9b54', 'satishspatil21@gmail.com', 'satishspatil21@gmail.com', '9902518232', '', '1976-02-10', '', '', '', 0, '', '', 'Bharath(India)', 105, '560001', '123121345678', '', '', 0, '', '', '', '', 'user', '12', 1, 0, '4', '1000', 'food', 1479468876, '1234512345', '105560001121234512345', '5559990001', '', 1, 1479467515, 1479467515, 0),
(5, 'Satish', 'Patil', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', 'spremainder@gmail.com', '9902518232', '', '1976-02-10', '', '', '', 0, '', '', 'Bharath(India)', 105, '560001', '123121345678', '', '', 0, '', '', 'Satish Traders', 'KAR12345', 'agent', '13', 1, 1, '', '', '', 1479472545, '1122334455', '105560001131122334455', '5559990001', '', 4, 1479468234, 1479468234, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `voucher_name` varchar(255) NOT NULL,
  `identity_id` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `acct_id` int(11) NOT NULL,
  `sub_acct_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `points_mode` varchar(20) NOT NULL,
  `loy_amt` double NOT NULL,
  `dis_amt` double NOT NULL,
  `used` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `commission` int(2) NOT NULL,
  `benefits` int(2) NOT NULL,
  `to_role` int(11) NOT NULL,
  `epin` varchar(50) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `transferrable` varchar(4) NOT NULL,
  `modified_by` varchar(120) NOT NULL
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
-- Indexes for table `acct_categories`
--
ALTER TABLE `acct_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authorizations`
--
ALTER TABLE `authorizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`,`acct_id`,`sub_acct_id`,`from_role`,`to_role`),
  ADD UNIQUE KEY `id` (`id`,`acct_id`,`sub_acct_id`,`from_role`,`to_role`,`commission`,`remarks`,`modified_at`,`created_at`,`created_by`),
  ADD UNIQUE KEY `id_2` (`id`,`acct_id`,`sub_acct_id`,`from_role`,`to_role`,`commission`,`remarks`,`modified_at`,`created_at`,`created_by`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_transactions`
--
ALTER TABLE `otp_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_request`
--
ALTER TABLE `payment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_grp`
--
ALTER TABLE `permission_grp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points_ratio`
--
ALTER TABLE `points_ratio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`remarks`,`modified_at`,`created_at`,`created_by`),
  ADD UNIQUE KEY `id_2` (`id`,`remarks`,`modified_at`,`created_at`,`created_by`);

--
-- Indexes for table `recharge`
--
ALTER TABLE `recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_item`
--
ALTER TABLE `sales_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `epin` (`epin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `acct_categories`
--
ALTER TABLE `acct_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `admin_settings`
--
ALTER TABLE `admin_settings`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `authorizations`
--
ALTER TABLE `authorizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501;
--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `otp_transactions`
--
ALTER TABLE `otp_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission_grp`
--
ALTER TABLE `permission_grp`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `points_ratio`
--
ALTER TABLE `points_ratio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `recharge`
--
ALTER TABLE `recharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
