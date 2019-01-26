-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2016 at 08:30 AM
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
(1, '1', '', '1', '1111111111111111', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus for $email ', 0, 1479016891, 1479016891),
(2, '1', '', '1', '1111111111111111', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus for info@consumer1st.in', 0, 1479016891, 1479016891),
(3, '1', '', '1', '1111111111111111', 0, 100000, 100000, 'wallet', '', 'yes', '00', '50', 'Sponsorship Fees for Referral info@consumer1st.in', 0, 1479016891, 1479016891),
(4, '00', '', '23', '822059735301679', 100, 0, 100, 'wallet', '', 'no', '00', '69', 'New member welcome offer', 0, 1479018217, 1479018217),
(5, '5', '', '23', '067179522538146', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus for $email ', 0, 1479019977, 1479019977),
(6, '6', '', '23', '822059735301679', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus for spremainder@gmail.com', 0, 1479019977, 1479019977),
(7, '6', '', '23', '822059735301679', 0, 1000, 1000, 'wallet', '', 'yes', '00', '50', 'Referral Sponsorship Fees for spremainder@gmail.com', 0, 1479019977, 1479019977);

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
(11, 1, 'Added Customer as User-Role', 1479020280);

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
('133d7ebf1a131464f7cb77c78da614bd766c1ba0', '127.0.0.1', 1479018565, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031383536353b72656469726563745f617574685f7572697c733a343a2275736572223b),
('1e2a2fec0523e5d57f07411b06f392536642afa0', '127.0.0.1', 1479017393, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373339323b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('25c3df9e767a8692c78002b3c9e5775cc2f50810', '127.0.0.1', 1479017524, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373532343b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('2e0620a6e6b01b46959de4553d5d7fccb628fe1c', '127.0.0.1', 1479020993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393032303939333b72656469726563745f617574685f7572697c733a32373a226163636f756e742f62616c616e636573686565745f766965772f33223b),
('3ec8c5db171b6457396a52ada1475d8a20163dc0', '127.0.0.1', 1479021428, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373432383b72656469726563745f617574685f7572697c733a373a226163636f756e74223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a226d722e616e616e64736167617240676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2235223b733a343a22726f6c65223b733a343a2275736572223b733a393a226c6f676765645f696e223b623a313b7d),
('44d4609444a94f777ceb244e72180b3613df0037', '127.0.0.1', 1479020637, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393032303633373b72656469726563745f617574685f7572697c733a353a226167656e74223b),
('46111df83e6cc9eb114cbc1747ded51ce08a2ab5', '127.0.0.1', 1479017401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373430303b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('4fb71372514356aaf76cd4b6466ecfbf062b5f70', '127.0.0.1', 1479017540, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373533393b72656469726563745f617574685f7572697c733a343a2262616e6b223b),
('5270c141807e6eee96686bfe846e390651efc256', '127.0.0.1', 1479017498, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373434353b72656469726563745f617574685f7572697c733a373a226163636f756e74223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2231223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('53515432807195715b0c06ad46650ee513aef06b', '127.0.0.1', 1479017485, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373438343b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('588fe6801d495d68234a6657e26595a87f2ed578', '127.0.0.1', 1479018264, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031383236343b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('5b0f3c1f030b270cc4e9d33a5e0626fbf391aeed', '127.0.0.1', 1479017506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373530363b72656469726563745f617574685f7572697c733a32373a226163636f756e742f62616c616e636573686565745f766965772f33223b),
('62f7302d6273293db5390903eee107eb533d32ce', '127.0.0.1', 1479020958, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393032303935373b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('80f0d5c98381218b4f760486e2069e673bdc499b', '127.0.0.1', 1479020383, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393032303338323b72656469726563745f617574685f7572697c733a343a2275736572223b),
('81618e2ec4ae41d2fefcdbf8bcc53e5e63883603', '127.0.0.1', 1479018274, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031383237333b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('84e283ef728b2f984c55ff75cfb2c9322321c770', '127.0.0.1', 1479018908, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031383930373b72656469726563745f617574685f7572697c733a31353a226167656e742f6164645f6167656e74223b),
('86e2c428d31410f88530653c97ff29fadb13b55e', '127.0.0.1', 1479018895, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031383839353b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('885f37dde7654f20f1b13ff18d5688697fbfbea6', '127.0.0.1', 1479017397, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373339363b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('950e6e7d26afb889109bb4c11a397016bb380935', '127.0.0.1', 1479018254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031383235343b),
('9568f8e54c64e2964ef9d4446e7c05eb410de199', '127.0.0.1', 1479018579, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031383537383b72656469726563745f617574685f7572697c733a353a226167656e74223b),
('a3a19bb7b50d7ae82a5904c0f1fe83b8ce50b9b8', '127.0.0.1', 1479020371, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393032303337313b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f61646d696e223b),
('a3dba8abd0782b0d016a8cb23144251db9891907', '127.0.0.1', 1479019923, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031393932323b72656469726563745f617574685f7572697c733a31353a22726f6c65732f6164645f726f6c6573223b),
('ac7c1ab2f45ea937b543bcebf56cd1f97024e2f7', '127.0.0.1', 1479021877, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393032313837363b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('b3536aaae71fb29ece4df73f60aadf1b9cfeefd5', '127.0.0.1', 1479017387, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373338373b),
('cc35af1add4a52e9bf7cbf34714761dc8501b219', '127.0.0.1', 1479017454, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031373435333b),
('db70f81b3717ff937df03a958f78dcaf4d4744c8', '127.0.0.1', 1479020295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393032303239343b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('dcd64190b9f8a94a2bbba39e37313656eade0d66', '::1', 1479021394, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437393031333836393b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a313a2231223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d);

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
  `slr_ref_level1` float NOT NULL,
  `slr_ref_level2` float NOT NULL,
  `slr_ref_level3` float NOT NULL,
  `slr_ref_level4` float NOT NULL,
  `slr_ref_level5` float NOT NULL,
  `clt_ref_level1` float NOT NULL,
  `clt_ref_level2` float NOT NULL,
  `clt_ref_level3` float NOT NULL,
  `clt_ref_level4` float NOT NULL,
  `clt_ref_level5` float NOT NULL,
  `points_mode` varchar(30) NOT NULL,
  `seller_profit` float NOT NULL,
  `client_profit` float NOT NULL,
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
(105, 'IN', 'India', 'INR', 'Asia', 'AS', 'en-IN,hi,bn,te,mr,ta,ur,gu,kn,'),
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
(1, 1, 'info@consumer1st.in', 50, '', '', 100000, 0, 100000, '', 0, 'no', 0, 0, 0, 'Pay type -50Sponsorship of info@consumer1st.in', '', '2016-11-13', 1479016891, 1479016891, 0, 'no_invoice.jpg'),
(2, 0, '', 69, '822059735301679', '23', 0, 100, 100, 'wallet', 0, '', 0, 0, 0, 'New member welcome offer', '', '0000-00-00', 1479018217, 1479018217, 0, 'no_invoice.jpg'),
(3, 5, 'spremainder@gmail.com', 50, '', '', 1000, 0, 1000, '', 0, 'no', 0, 0, 0, 'Pay type -50Sponsorship of spremainder@gmail.com', '', '2016-11-13', 1479019977, 1479019977, 0, 'no_invoice.jpg');

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
(6, 5, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1479019453);

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
  `fees` int(11) NOT NULL,
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

INSERT INTO `role` (`id`, `rolename`, `fees`, `parent`, `active`, `permission_id`, `type`, `edit`, `default`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 'Administrator', 0, 0, 1, 0, 'role_name', 1, 1, 1, 1, 1),
(2, 'Manager Finance', 100000, 0, 1, 0, 'role_name', 0, 0, 1, 1479016341, 1479016341),
(3, 'Cash Dispatcher', 100000, 0, 1, 0, 'role_name', 0, 0, 1, 1479016379, 1479016379),
(4, 'Retailor', 1000, 0, 1, 0, 'role_name', 0, 0, 1, 1479019937, 1479019937),
(5, 'Customer', 0, 0, 1, 0, 'role_name', 0, 0, 1, 1479020280, 1479020280);

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
  `postal_code` int(20) NOT NULL,
  `adhaar_no` varchar(16) NOT NULL,
  `pan_no` varchar(20) NOT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `bank_account` int(20) NOT NULL,
  `bank_address` varchar(300) NOT NULL,
  `passport_no` varchar(255) NOT NULL,
  `role` varchar(200) NOT NULL,
  `rolename` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `online_status` tinyint(1) NOT NULL,
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

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `row_pass`, `email`, `contactno`, `gender`, `date_of_birth`, `profession`, `street_address`, `area_name`, `area_id`, `city`, `city_id`, `country`, `country_id`, `postal_code`, `adhaar_no`, `pan_no`, `ifsc_code`, `bank_account`, `bank_address`, `passport_no`, `role`, `rolename`, `active`, `online_status`, `user_lastlogin`, `referral_code`, `account_no`, `referredByCode`, `photo`, `created_by`, `created_at`, `modified_at`, `modified_by`) VALUES
(1, 'Supreme', 'Administrator', '5fba61a8c7a2240fc28f6e5a621696ffb39221da', 'anandsagar007@gmail.com', 'anandsagar007@gmail.com', '9980569960', '', '1990-01-01', 'Supreme Administrator', 'Old Airport', 'HAL', 560037, 'Bengaluru', '560037', 'India', 105, 560037, '1111222244446666', '1111111111', '1111111111', 123456789, 'HAL', 'B2222222', 'admin', '1', 1, 1, 1479018259, 'ADMIN1001', '1111111111111111', 'ADMIN1000', '', 0, 0, 0, 0),
(3, 'Supreme', 'Administrator', 'b31e3488b1cae9a12408f5084b6f8486543d33ae', 'info@consumer1st.in', 'info@consumer1st.in', '895119916', '', '1990-01-01', '', '', '', 0, '', '560037', 'India', 105, 0, '1111222244446666', '', '', 0, '', '', 'agent', '2', 1, 0, 0, '489537', '1111111111111111', 'ADMIN1001', '', 1, 1479016891, 1479016891, 0),
(4, 'Accounts', 'Manager', '836b904eda2ccbf8ce855cf4878feb3875a23ba5', '', 'anand007555@gmail.com', '', '', NULL, '', '', '', 0, '', '', 'India', 105, 0, '', '', '', 0, '', '', 'admin', '', 1, 0, 1479017388, 'BQ5KLXCI', '', '', '', 1, 1479017366, 1479017366, 0),
(5, 'Anand', 'Sagar', '2b70b91f972ecfe1e61d8eb2dfc4121f200dc635', 'mr.anandsagar@gmail.com', 'mr.anandsagar@gmail.com', '9980569960', '', '1982-09-29', '', '', '', 0, '', '', 'India', 105, 0, '', '', '', 0, '', '', 'user', '5', 1, 1, 1479019453, '912385', '067179522538146', 'admin1001', '', 1, 1479017898, 1479017898, 0),
(6, 'Satish', 'Patil', '244caed91d8ae3b82f9faa71da0eb616526f9b54', 'satishspatil21@gmail.com', 'satishspatil21@gmail.com', '9980569960', '', '1990-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', '', 0, '', '', 'user', '5', 1, 0, 0, '367108', '822059735301679', '912385', '', 1, 1479018217, 1479018217, 0),
(7, 'Satish', 'Patil', '62d5d12a3e50d05f2b97bf9138ebcb599c95f79a', 'spremainder@gmail.com', 'spremainder@gmail.com', '890279455', '', '1990-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', '', 0, '', '', 'agent', '4', 1, 0, 0, '891465', '822059735301679', '912385', '', 5, 1479019977, 1479019977, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `acct_categories`
--
ALTER TABLE `acct_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
