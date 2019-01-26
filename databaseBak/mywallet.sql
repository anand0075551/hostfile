-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2016 at 05:00 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wallet2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_bin NOT NULL,
  `role` varchar(60) COLLATE utf8_bin NOT NULL,
  `account_no` varchar(50) COLLATE utf8_bin NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `amount` double NOT NULL,
  `points_mode` varchar(20) COLLATE utf8_bin NOT NULL,
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

INSERT INTO `accounts` (`id`, `user_id`, `role`, `account_no`, `debit`, `credit`, `amount`, `points_mode`, `used`, `paid_to`, `pay_type`, `tranx_id`, `active`, `created_at`, `modified_at`) VALUES
(1, '43', 'admin', '555000999000777', 0, 0, 0, 'wallet', 'no', '', 'wallet_Converted', 'sdfd', 0, 1476970498, 1476970498);

-- --------------------------------------------------------

--
-- Table structure for table `acct_categories`
--

CREATE TABLE `acct_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parentid` int(11) NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `visible` int(2) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acct_categories`
--

INSERT INTO `acct_categories` (`id`, `name`, `parentid`, `category_type`, `visible`, `added_by`, `created_at`, `modified_at`) VALUES
(5, 'Testing', 0, 'Main', 0, 43, 1465125727, 1465125727),
(8, 'Liabilities', 0, 'Main', 0, 43, 1465127610, 1465127610),
(9, 'Expenses in salary', 8, 'Sub', 0, 43, 1465127626, 1465127626),
(10, 'Sales', 0, 'Main', 0, 43, 1465136815, 1465136815),
(11, 'Purchase', 0, 'Main', 0, 43, 1465136837, 1465136837),
(12, 'Product Sales', 10, 'Sub', 0, 43, 1465136852, 1465136852),
(13, 'Purchase Agricultural Products', 11, 'Sub', 0, 43, 1465138004, 1465138004),
(14, 'Agricultural Sales Products', 10, 'Sub', 0, 43, 1465138042, 1465138042),
(15, 'Groceries Products', 11, 'Sub', 0, 43, 1465141347, 1465141347),
(16, 'Goods', 0, 'Main', 0, 43, 1465141611, 1465141611),
(17, 'Food Transports', 16, 'Sub', 0, 43, 1465141693, 1465141693),
(18, 'Liabilities - Business Advertisement', 8, 'Sub', 0, 43, 1465147800, 1465147800),
(19, 'Mens ware', 2, 'sub', 0, 43, 1465214422, 1465214422),
(20, 'Kids', 2, '', 0, 43, 1465214435, 1465214435),
(21, 'Expenditure', 0, 'Main', 0, 43, 1465214616, 1465214616),
(22, 'Expenditure', 0, 'Main', 0, 43, 1465214639, 1465214639),
(23, 'Sales Commision', 21, '', 0, 43, 1465214662, 1465214662),
(24, 'Expenditure in Company', 0, 'Main', 0, 43, 1465214743, 1465214743),
(25, 'Sales Commision', 24, '', 0, 43, 1465214766, 1465214766),
(26, 'Goods Transfer', 24, '', 0, 43, 1465214787, 1465214787),
(27, 'Loyalty Bonus', 24, '', 0, 43, 1465214808, 1465214808),
(28, 'Referral Bonus', 24, '', 0, 43, 1465214845, 1465214845),
(29, 'Direct Sales Commision', 24, '', 0, 43, 1465214864, 1465214864),
(30, 'Wallet Recharge Bonus', 24, '', 0, 43, 1465214890, 1465214890),
(31, 'Discount Points Convertion', 24, '', 0, 43, 1465214976, 1465214976),
(32, 'POS Sales Commision', 24, '', 0, 43, 1465215020, 1465215020),
(33, 'Test No', 0, 'Main', 0, 43, 1465722584, 1465722584),
(34, 'test yes', 0, 'Main', 0, 43, 1465722701, 1465722701),
(35, 'test yes', 0, 'Main', 0, 43, 1465722851, 1465722851),
(36, 'check Yes', 0, 'Main', 0, 43, 1465722966, 1465722966),
(37, 'check No', 0, 'Main', 1, 43, 1465722977, 1465722977),
(38, 'ok', 37, '', 0, 43, 1466391931, 1466391931),
(39, 'Vouchers', 0, 'Main', 0, 43, 1468950509, 1468950509),
(40, 'Sub-Account Sales', 10, '', 0, 43, 1470109282, 1470109282),
(41, 'Anand Purchase', 11, 'Sub', 0, 43, 1470111554, 1470111554),
(42, 'Anand Purchase2', 11, 'Sub', 0, 43, 1470111659, 1470111659),
(43, 'Customer Deposit Amount', 0, 'main', 0, 43, 1471113151, 1471113151),
(44, 'Online Deposit', 43, 'sub', 0, 43, 1471113172, 1471113172),
(45, 'Bank Deposit', 43, 'sub', 0, 43, 1471113188, 1471113188),
(46, 'Wallet Recharge', 0, 'main', 0, 43, 1471177835, 1471177835),
(47, 'Wallet Recharge', 46, 'sub', 0, 43, 1471177853, 1471177853),
(48, 'Sponsorship', 0, 'main', 0, 43, 1471179918, 1471179918),
(49, 'Retailer Sponsorship', 48, 'sub', 0, 43, 1471179933, 1471179933),
(50, 'Distributor Sponsorship', 48, 'sub', 0, 43, 1471179950, 1471179950),
(51, 'Customer Sponsorship', 48, 'sub', 0, 43, 1471179964, 1471179964),
(52, 'Festival Vouchers', 0, 'main', 0, 43, 1471182966, 1471182966),
(53, 'Ganesha Chaturti', 52, 'sub', 0, 43, 1471182979, 1471182979),
(54, 'Deepawali Festival Vouchers', 52, 'sub', 0, 43, 1471183017, 1471183017),
(55, 'Dasara Festival', 52, 'sub', 0, 43, 1471183033, 1471183033),
(56, 'Global POS sales', 0, 'main', 0, 43, 1472946265, 1472946265),
(57, 'Local POS sales', 56, 'sub', 0, 43, 1472946307, 1472946307),
(58, 'Loyalty Points', 0, 'main', 1, 43, 1476811631, 1476811631),
(59, 'Bank Accounts', 0, 'main', 0, 43, 1476811697, 1476811697),
(60, 'Seller Loyality', 58, 'sub', 0, 43, 1476816697, 1476816697),
(61, 'Client Loyality', 58, 'sub', 0, 43, 1476816717, 1476816717),
(62, 'ChequeBook Request', 59, 'sub', 0, 43, 1476899556, 1476899556),
(63, 'SBI-HAL Account Transactions', 59, 'sub', 0, 43, 1476899614, 1476899614);

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
(1, 43, 'Added Initial ledger', 1468131887),
(2, 43, 'Added user as User-Role', 1468132123),
(3, 43, 'Added admin as User-Role', 1468132135),
(4, 43, 'Added agent as User-Role', 1468132143),
(5, 43, 'Deleted  role', 1468132214),
(6, 43, 'Added commission setup commissions', 1468133364),
(7, 43, 'Blocked  from Agent', 1468164785),
(8, 43, 'Blocked  from Agent', 1468164853),
(9, 43, 'Blocked  from Agent', 1468165272),
(10, 43, 'Unblocked Bhavya Sagar from Agent', 1468165284),
(11, 43, 'Blocked Bhavya Sagar from Agent', 1468165327),
(12, 43, 'Blocked C & F Karnataka from Agent', 1468166379),
(13, 43, 'Blocked C & F Karnataka from Agent', 1468167987),
(14, 43, 'Added Sagar Last Name as agent', 1468168189),
(15, 54, 'Added  Vouchers', 1468862186),
(16, 43, 'Added  Vouchers', 1468862455),
(17, 43, 'Updated Anand Admin Voucher Vouchers', 1468862786),
(18, 43, 'Updated Dodanna Voucher Vouchers', 1468862823),
(19, 43, 'sell out product, amount : 999', 1468862871),
(20, 43, 'sell out product, amount : 999', 1468863032),
(21, 90, 'Updated Dodanna Voucher Vouchers', 1468901706),
(22, 43, 'Added  Vouchers', 1468902224),
(23, 90, 'Updated Test creation Vouchers', 1468902249),
(24, 90, 'Updated Anand Admin Voucher Vouchers', 1468904480),
(25, 90, 'Added  Vouchers', 1468904525),
(26, 90, 'Updated Anand Admin Voucher Vouchers', 1468904614),
(27, 90, 'Updated Anand Admin Voucher Vouchers', 1468905084),
(28, 43, 'Updated test2 Vouchers', 1468905110),
(29, 43, 'Updated test2 Vouchers', 1468905162),
(30, 43, 'Updated test2 Vouchers', 1468905212),
(31, 90, 'Updated Test creation Vouchers', 1468905240),
(32, 90, 'Updated Dodanna Voucher Vouchers', 1468906557),
(33, 43, 'Added  Vouchers', 1468942782),
(34, 90, 'Added  Vouchers', 1468943306),
(35, 43, 'Added Vegetable Category', 1468949931),
(36, 43, 'Added Vouchers acct_categories', 1468950509),
(37, 54, 'Added  Vouchers', 1468985292),
(38, 43, 'Added  Vouchers', 1469023994),
(39, 43, 'Added Groceries Offer vouchers', 1469024743),
(40, 43, 'Added Cloths Package vouchers', 1469031226),
(41, 43, 'Added Groceries Offer vouchers', 1469031389),
(42, 43, 'Added Festival Offer vouchers', 1469031850),
(43, 43, 'Added Groceries Offer commissions', 1469035929),
(44, 43, 'Added Cloths Package commissions', 1469035980),
(45, 43, 'Added testing commissions', 1469036387),
(46, 43, 'Added Company Bonus commissions', 1469038376),
(47, 43, 'Added Package Food commissions', 1469107813),
(48, 43, 'Updated Package Food commissions', 1469108728),
(49, 43, 'Updated Groceries Offer commissions', 1469112410),
(50, 43, 'Updated Cloths Package commissions', 1469112568),
(51, 43, 'Deleted  vouchers', 1469112659),
(52, 43, 'Deleted  vouchers', 1469112663),
(53, 43, 'Added Ginger commissions', 1469112703),
(54, 43, 'Deleted  vouchers', 1469112718),
(55, 43, 'Deleted  vouchers', 1469112722),
(56, 43, 'Deleted  commissions', 1469112861),
(57, 43, 'Deleted  commissions', 1469112867),
(58, 43, 'Added Sagar festival commissions', 1469112907),
(59, 43, 'Updated Sagar festival commissions', 1469112927),
(60, 43, 'Updated Sagar festival2 commissions', 1469112939),
(61, 43, 'Updated Sagar festival2 commissions', 1469118642),
(62, 43, 'Updated Company Bonus commissions', 1469118702),
(63, 43, 'Updated Cloths Package commissions', 1469119466),
(64, 43, 'Updated Cloths Package commissions', 1469119848),
(65, 43, 'Added Adds Mgt ledger', 1469286978),
(66, 43, 'Added paid up ledger', 1469340691),
(67, 43, 'Added test ledger', 1469340746),
(68, 43, 'Added tyst ledger', 1469340828),
(69, 43, 'Added test ledger', 1469340933),
(70, 43, 'Added test ledger', 1469340973),
(71, 43, 'Added ok ledger', 1469341732),
(72, 43, 'Added test ledger', 1469342482),
(73, 43, 'Added test ledger', 1469342508),
(74, 43, 'Added deposit ledger', 1469342673),
(75, 43, 'Added test ledger', 1469342698),
(76, 43, 'Added test ledger', 1469345000),
(77, 43, 'Added test ledger', 1469345040),
(78, 43, 'Added anand ledger', 1469345119),
(79, 43, 'Added Requested credit ledger', 1469350244),
(80, 43, 'Added testing sir ledger', 1469350775),
(81, 43, 'Added test ledger', 1469351177),
(82, 43, 'Added dofiun ledger', 1469351238),
(83, 43, 'Added khsdnhsdbusd ledger', 1469351413),
(84, 43, 'Added jniuuj ledger', 1469351493),
(85, 43, 'Added sdgfsdgds ledger', 1469351754),
(86, 43, 'Added xcgbdfgfd ledger', 1469351811),
(87, 43, 'Added test ledger', 1469355078),
(88, 43, 'Added jhbhhb ledger', 1469356192),
(89, 43, 'Added KJNJ ledger', 1469356262),
(90, 43, 'Updated 0 ledger', 1469358687),
(91, 43, 'Updated  ledger', 1469359959),
(92, 43, 'Deleted  ledger', 1469359998),
(93, 43, 'Updated  ledger', 1469360751),
(94, 43, 'Deleted  ledger', 1469360767),
(95, 43, 'Added test ledger', 1469360809),
(96, 43, 'Added test ledger', 1469361283),
(97, 43, 'Added test ledger', 1469373505),
(98, 43, 'Added test ledger', 1469373877),
(99, 43, 'Added uhbuhb ledger', 1469373900),
(100, 43, 'Added test ledger', 1469374766),
(101, 43, 'Added Free Voucher to Public commissions', 1469417673),
(102, 43, 'Updated Sagar festival2 commissions', 1469453117),
(103, 43, 'Updated Free Voucher to Public commissions', 1469454487),
(104, 43, 'Added New Pin Anand Voucher commissions', 1469459385),
(105, 43, 'Added New Pin Anand VoucherVouchers', 1469459573),
(106, 43, 'Added New Pin Anand Voucher2Vouchers', 1469459729),
(107, 43, 'Added Groceries Offer*****Vouchers', 1469459847),
(108, 43, 'Updated New Pin Anand Voucher commissions', 1469464184),
(109, 43, 'Updated  commissions', 1469464552),
(110, 43, 'Updated Anand Sagar commissions', 1469464714),
(111, 43, 'Updated  commissions', 1469464725),
(112, 43, 'Updated Anand Sagar commissions', 1469464896),
(113, 43, 'Added Anand Sagar2Vouchers', 1469465489),
(114, 43, 'Added Sagar festival2Vouchers', 1469465862),
(115, 43, 'Added New Pin Anand VoucherVouchers', 1469507341),
(116, 43, 'Added Deepawali festival commissions', 1469507912),
(117, 43, 'Added Christmas Festival Offer commissions', 1469508388),
(118, 43, 'Added Groceries Offer commissions', 1469508841),
(119, 43, 'Added Groceries Offer222 commissions', 1469509585),
(120, 43, 'Added Cloths Package333 commissions', 1469509633),
(121, 43, 'Added Groceries Offer222Vouchers', 1469514861),
(122, 43, 'Added Cloths Package333Vouchers', 1469515296),
(123, 43, 'Added Cloths Package333Vouchers', 1469515462),
(124, 43, 'Added Vocuher Transaction accounts', 1469522516),
(125, 43, 'Added Vocuher Transaction accounts', 1469525851),
(126, 43, 'Added Vocuher Transaction accounts', 1469525979),
(127, 43, 'Added Vocuher Transaction accounts', 1469526018),
(128, 43, 'Added Vocuher Transaction accounts', 1469526360),
(129, 43, 'Added Vocuher Transaction accounts', 1469526472),
(130, 43, 'Added Vocuher Transaction accounts', 1469526623),
(131, 43, 'Added Management Decision for Ratio change points_ratio', 1469582605),
(132, 43, 'Added New change points_ratio', 1469583189),
(133, 43, 'Deleted Electronics Category', 1469627665),
(134, 43, 'Deleted Management Decision for Ratio change points_ratio', 1469627871),
(135, 43, 'Added Anand Ratio points_ratio', 1469627904),
(136, 43, 'Updated New changepoints_ratio', 1469676714),
(137, 43, 'Updated Anand Ratio2points_ratio', 1469677123),
(138, 43, 'Updated New change17points_ratio', 1469677142),
(139, 43, 'Updated Anand Ratio3points_ratio', 1469677159),
(140, 43, 'Deleted New change17 points_ratio', 1469677273),
(141, 43, 'Updated Anand Ratio3points_ratio', 1469677285),
(142, 43, 'Updated Anand Ratio3points_ratio', 1469677383),
(143, 43, 'Updated Anand Ratio3points_ratio', 1469677436),
(144, 43, 'Updated Anand Ratio3points_ratio', 1469679377),
(145, 43, 'Updated Anand Ratio3points_ratio', 1469679701),
(146, 43, 'Updated Anand Ratio3points_ratio', 1469679779),
(147, 43, 'Updated Anand Ratio3points_ratio', 1469679823),
(148, 43, 'Updated Anand Ratio3points_ratio', 1469679858),
(149, 43, 'Updated Anand Ratio3points_ratio', 1469718252),
(150, 43, 'Added Converted cash toloyalitypoints accounts', 1469722374),
(151, 43, 'Added Converted cash todiscountpoints accounts', 1469722421),
(152, 43, 'Added Converted cash toloyalitypoints accounts', 1469726766),
(153, 43, 'Added Converted cash todiscountpoints accounts', 1469726863),
(154, 43, 'Updated Anand Ratio3points_ratio', 1469726989),
(155, 43, 'Added Converted cash todiscountpoints accounts', 1469727096),
(156, 43, 'Added Converted cash toloyalitypoints accounts', 1469727147),
(157, 43, 'Added Converted cash toloyalitypoints accounts', 1469727803),
(158, 43, 'Updated Anand Ratio3points_ratio', 1469727837),
(159, 43, 'Added Converted cash toloyalitypoints accounts', 1469727939),
(160, 43, 'Added Converted cash todiscountpoints accounts', 1469727957),
(161, 43, 'Added Converted cash toloyalitypoints accounts', 1469729032),
(162, 43, 'Added Vocuher Transaction accounts', 1469729831),
(163, 43, 'Added Vocuher Transaction accounts', 1469729885),
(164, 43, 'Added Converted cash toloyalitypoints accounts', 1469778138),
(165, 43, 'Added Converted cash todiscountpoints accounts', 1469780689),
(166, 43, 'Added Vocuher Transaction accounts', 1469781177),
(167, 43, 'Added Vocuher Transaction accounts', 1469785238),
(168, 43, 'Transaction of   accounts', 1469786226),
(169, 43, 'Transaction of   accounts', 1469786475),
(170, 43, 'Transaction of   accounts', 1469786530),
(171, 43, 'Transaction of   accounts', 1469787606),
(172, 43, 'Transaction of   vouchers', 1469794131),
(173, 43, 'Transaction of   vouchers', 1469794299),
(174, 43, 'Transaction of   vouchers', 1469794501),
(175, 43, 'Added Food Coupon commissions', 1469871582),
(176, 43, 'Transaction of   accounts', 1469874033),
(177, 43, 'Transaction of   vouchers', 1469874812),
(178, 43, 'Transaction of   vouchers', 1469875039),
(179, 43, 'sell out product, amount : 400', 1469887711),
(180, 43, 'sell out product, amount : 400', 1469887905),
(181, 43, 'sell out product, amount : 400', 1469887931),
(182, 43, 'sell out product, amount : 400', 1469887989),
(183, 43, 'sell out product, amount : 400', 1469887997),
(184, 43, 'sell out product, amount : 400', 1469888007),
(185, 43, 'sell out product, amount : 400', 1469888046),
(186, 43, 'sell out product, amount : 400', 1469888119),
(187, 43, 'sell out product, amount : 400', 1469888210),
(188, 43, 'sell out product, amount : 400', 1469888267),
(189, 43, 'sell out product, amount : 400', 1469888341),
(190, 43, 'sell out product, amount : 50000', 1469888387),
(191, 43, 'Deleted  ledger', 1470099879),
(192, 43, 'Deleted  ledger', 1470099883),
(193, 43, 'Deleted  ledger', 1470099887),
(194, 43, 'Deleted  ledger', 1470099890),
(195, 43, 'Deleted  ledger', 1470099894),
(196, 43, 'Deleted  ledger', 1470099898),
(197, 43, 'Added Sub-Account Sales Category', 1470109282),
(198, 43, 'Added test anand ledger', 1470110443),
(199, 43, 'Added Anand Purchase Category', 1470111554),
(200, 43, 'Added Anand Purchase2 Category', 1470111659),
(201, 43, 'Added test ledger', 1470112031),
(202, 54, 'Added Customer Sagar as agent', 1470154534),
(203, 54, 'Added PayUmoney accounts', 1470157724),
(204, 54, 'Added PayUmoney accounts', 1470158097),
(205, 54, 'Added PayUmoney accounts', 1470158125),
(206, 54, 'Added PayUmoney accounts', 1470158146),
(207, 54, 'Added PayUmoney accounts', 1470158304),
(208, 43, 'Added PayUmoney accounts', 1470158754),
(209, 43, 'Added PayUmoney accounts', 1470158823),
(210, 43, 'Added PayUmoney accounts', 1470158855),
(211, 43, 'Added PayUmoney accounts', 1470164017),
(212, 43, 'Added PayUmoney accounts', 1470164086),
(213, 43, 'Added PayUmoney accounts', 1470164228),
(214, 43, 'Added PayUmoney accounts', 1470164395),
(215, 43, 'Added PayUmoney accounts', 1470164455),
(216, 43, 'Transaction of   vouchers', 1470196298),
(217, 43, 'Added Converted cash toloyalitypoints accounts', 1470197371),
(218, 43, 'Added Converted cash todiscountpoints accounts', 1470197409),
(219, 43, 'Added Converted cash toloyalitypoints accounts', 1470197497),
(220, 43, 'sell out product, amount : 100', 1470197911),
(221, 43, 'sell out product, amount : 100', 1470197992),
(222, 43, 'sell out product, amount : 110', 1470198115),
(223, 43, 'sell out product, amount : 110', 1470198189),
(224, 43, 'Added Converted cash todiscountpoints accounts', 1470199369),
(225, 43, 'Added Converted cash toloyalitypoints accounts', 1470199627),
(226, 43, 'Added New commission Set Up commissions', 1470201477),
(227, 43, 'Added New commission Set Up2 commissions', 1470201691),
(228, 43, 'Added New change3 commissions', 1470201762),
(229, 43, 'sell out product, amount : 0', 1470218524),
(230, 43, 'sell out product, amount : 100', 1470218623),
(231, 43, 'sell out product, amount : 100', 1470218681),
(232, 43, 'sell out product, amount : 100', 1470218845),
(233, 43, 'sell out product, amount : 100', 1470218978),
(234, 43, 'sell out product, amount : 100', 1470219022),
(235, 43, 'sell out product, amount : 100', 1470219042),
(236, 43, 'sell out product, amount : 100', 1470219079),
(237, 43, 'sell out product, amount : 100', 1470219179),
(238, 43, 'sell out product, amount : 1', 1470219212),
(239, 43, 'sell out product, amount : 1', 1470219768),
(240, 43, 'Deleted  commissions', 1470228778),
(241, 43, 'Deleted  commissions', 1470228784),
(242, 43, 'Deleted  commissions', 1470228788),
(243, 43, 'Deleted  commissions', 1470228795),
(244, 43, 'Updated Deepawali festival commissions', 1470228836),
(245, 43, 'Updated Groceries Offer commissions', 1470228855),
(246, 43, 'Deleted  commissions', 1470228864),
(247, 90, 'Transaction of   vouchers', 1470229931),
(248, 54, 'Transaction of   vouchers', 1470230448),
(249, 54, 'Deleted  commissions', 1470230973),
(250, 43, 'Updated New commission Set Up commissions', 1470232303),
(251, 43, 'Updated New commission Set Up commissions', 1470232321),
(252, 54, 'Transaction of   vouchers', 1470232368),
(253, 90, 'Transaction of   vouchers', 1470237836),
(254, 90, 'Transaction of   vouchers', 1470238909),
(255, 90, 'Transaction of   vouchers', 1470243969),
(256, 90, 'Transaction of   vouchers', 1470244093),
(257, 43, 'Added consumer festival commissions', 1470244772),
(258, 54, 'Transaction of   vouchers', 1470245015),
(259, 43, 'Added Admin Festival commissions', 1470245071),
(260, 90, 'Transaction of   vouchers', 1470245125),
(261, 90, 'Transaction of   vouchers', 1470245199),
(262, 43, 'Added test ledger', 1470714874),
(263, 43, 'Added Importing Foriegn Foods ledger', 1470916517),
(264, 43, 'Added test ledger', 1470916617),
(265, 43, 'Added Testing commissions', 1470917128),
(266, 43, 'Updated Testing commissions', 1470936100),
(267, 43, 'Updated Testing_ANAND commissions', 1470936174),
(268, 43, 'Updated Testing_ANAND commissions', 1470936284),
(269, 54, 'Added Customer Sagar as agent', 1471000441),
(270, 54, 'Added Customer Sagar as agent', 1471001723),
(271, 43, 'sell out product, amount : ', 1471007782),
(272, 43, 'Added  accounts', 1471015998),
(273, 43, 'Added  accounts', 1471016358),
(274, 43, 'Added  accounts', 1471019839),
(275, 43, 'Added  accounts', 1471019959),
(276, 43, 'Added  accounts', 1471020788),
(277, 43, 'Added  accounts', 1471026080),
(278, 54, 'Added Customer Sagar as agent', 1471098203),
(279, 43, 'Added  accounts', 1471098480),
(280, 43, 'Added  accounts', 1471098577),
(281, 54, 'Unblocked  from Agent', 1471099085),
(282, 54, 'Unblocked Assets Company from Agent', 1471099086),
(283, 43, 'Added  accounts', 1471112383),
(284, 43, 'Added  accounts', 1471113033),
(285, 43, 'Added Customer Deposit Amount acct_categories', 1471113151),
(286, 43, 'Added Online Deposit Category', 1471113172),
(287, 43, 'Added Bank Deposit Category', 1471113188),
(288, 43, 'Added  ledger', 1471114626),
(289, 43, 'Added  ledger', 1471115198),
(290, 43, 'Added  ledger', 1471115355),
(291, 43, 'Added  ledger', 1471115589),
(292, 43, 'Added  ledger', 1471115710),
(293, 43, 'Added  ledger', 1471115816),
(294, 43, 'Added  ledger', 1471116039),
(295, 43, 'Added  ledger', 1471117902),
(296, 43, 'Added  ledger', 1471118331),
(297, 43, 'Added Deposit Fund release commission for ADMIN commissions', 1471118455),
(298, 43, 'Added  ledger', 1471121966),
(299, 43, 'Added  ledger', 1471122203),
(300, 43, 'Added  ledger', 1471122270),
(301, 43, 'Added  ledger', 1471122637),
(302, 43, 'Added  ledger', 1471122721),
(303, 43, 'Added  ledger', 1471123018),
(304, 43, 'Added Online Commission Setup commissions', 1471156795),
(305, 43, 'Added Test2 commissions', 1471156838),
(306, 43, 'Deleted  ledger', 1471161167),
(307, 43, 'Deleted  ledger', 1471161172),
(308, 43, 'Deleted  ledger', 1471161182),
(309, 43, 'Deleted  ledger', 1471161185),
(310, 43, 'Deleted  ledger', 1471161193),
(311, 43, 'Deleted  ledger', 1471161210),
(312, 43, 'Deleted  ledger', 1471161212),
(313, 43, 'Deleted  ledger', 1471161214),
(314, 43, 'Deleted  ledger', 1471161218),
(315, 43, 'Deleted  ledger', 1471161221),
(316, 43, 'Deleted  ledger', 1471161227),
(317, 43, 'Deleted  ledger', 1471161229),
(318, 43, 'Added Benefits and Commission Deposit ledger', 1471162375),
(319, 43, 'Added Agents Commission Setup commissions', 1471163965),
(320, 43, 'Added Agent and Admin Commission commissions', 1471164497),
(321, 43, 'Added  ledger', 1471166637),
(322, 90, 'Added Agent Satish Patil as agent', 1471176575),
(323, 43, 'Added  ledger', 1471176722),
(324, 43, 'Added Wallet Recharge acct_categories', 1471177836),
(325, 43, 'Added Wallet Recharge Category', 1471177853),
(326, 43, 'Added Benefits and Commission Deposit for Wallet Recharge commissions', 1471177974),
(327, 43, 'Added Sponsorship acct_categories', 1471179918),
(328, 43, 'Added Retailer Sponsorship Category', 1471179934),
(329, 43, 'Added Distributor Sponsorship Category', 1471179950),
(330, 43, 'Added Customer Sponsorship Category', 1471179964),
(331, 43, 'Added Budget fix for  Retailor Sponsorship ledger', 1471180360),
(332, 43, 'Deleted  commissions', 1471182762),
(333, 43, 'Deleted  commissions', 1471182766),
(334, 43, 'Added Festival Vouchers acct_categories', 1471182966),
(335, 43, 'Added Ganesha Chaturti Category', 1471182979),
(336, 43, 'Added Deepawali Festival Vouchers Category', 1471183017),
(337, 43, 'Added Dasara Festival Category', 1471183033),
(338, 43, 'Added Chauti Offer commissions', 1471183164),
(339, 54, 'Transaction of   vouchers', 1471183573),
(340, 54, 'Transaction of   vouchers', 1471183631),
(341, 54, 'Transaction of   vouchers', 1471183704),
(342, 43, 'Added Festival Points points_ratio', 1471183939),
(343, 43, 'Deleted Anand Ratio3 points_ratio', 1471184055),
(344, 54, 'Added Converted cash toloyalitypoints accounts', 1471185408),
(345, 54, 'Added Converted cash todiscountpoints accounts', 1471185453),
(346, 43, 'Deleted  role', 1471196948),
(347, 43, 'Added Distributor as User-Role', 1471196986),
(348, 43, 'Added Setting commission and loyalty for Distributor Sponsorship commissions', 1471197090),
(349, 43, 'Updated Setting commission and loyalty for Distributor Sponsorship commissions', 1471197548),
(350, 43, 'Deleted  ledger', 1471197560),
(351, 43, 'Deleted 30 commissions', 1471197903),
(352, 43, 'Updated Agents Commission Setup commissions', 1471197954),
(353, 43, 'Updated Agents Commission Setup commissions', 1471198052),
(354, 43, 'Added test CS to DFV ledger', 1471199100),
(355, 43, 'Added Sagar ledger', 1471199150),
(356, 43, 'Added ok ledger', 1471199252),
(357, 43, 'Added New Chauti Offer222444 commissions', 1471203381),
(358, 43, 'Transaction of   vouchers', 1471203963),
(359, 43, 'Added Distributor Dinesh as agent', 1471205929),
(360, 43, 'Added Retailor Rustum as agent', 1471206320),
(361, 43, 'Added Retail Manju as agent', 1471208336),
(362, 43, 'Added Deewali Advance Voucher commissions', 1471245628),
(363, 43, 'Added Converted cash toloyalitypoints accounts', 1471270839),
(364, 43, 'Added Converted cash todiscountpoints accounts', 1471271250),
(365, 43, 'Added Converted cash todiscountpoints accounts', 1471271311),
(366, 43, 'Added Converted cash toloyalitypoints accounts', 1471271513),
(367, 43, 'Added Converted cash todiscountpoints accounts', 1471271620),
(368, 43, 'Added Converted cash todiscountpoints accounts', 1471271672),
(369, 43, 'Added Converted cash to discount points accounts', 1471271753),
(370, 43, 'Added Converted cash to discount points accounts', 1471272468),
(371, 43, 'Added Converted cash to discount points accounts', 1471272600),
(372, 43, 'Added Converted cash to discount points accounts', 1471272718),
(373, 43, 'Added Converted cash to wallet points accounts', 1471272789),
(374, 43, 'Added Converted cash to wallet points accounts', 1471272823),
(375, 43, 'Added Converted cash to wallet points accounts', 1471273255),
(376, 43, 'Added Converted cash to wallet points accounts', 1471273607),
(377, 43, 'Added Converted cash to wallet points accounts', 1471273869),
(378, 43, 'Added Converted cash to wallet points accounts', 1471275069),
(379, 43, 'Added Converted cash to wallet points accounts', 1471278337),
(380, 43, 'Added Converted cash to loyality points accounts', 1471278695),
(381, 43, 'Added Converted cash to loyality points accounts', 1471278762),
(382, 43, 'Added Converted cash to loyality points accounts', 1471278875),
(383, 43, 'Added Converted cash to wallet points accounts', 1471278927),
(384, 43, 'Added Loyality to wallet points accounts', 1471279465),
(385, 43, 'Added Wallet to Discount points accounts', 1471279667),
(386, 43, 'Added Wallet to Discount points accounts', 1471279710),
(387, 43, 'Added Wallet to Loyality points accounts', 1471279785),
(388, 43, 'Added Wallet to Discount points accounts', 1471279814),
(389, 43, 'Added Wallet to Discount points accounts', 1471279889),
(390, 43, 'Added Discount to Wallet points accounts', 1471279943),
(391, 43, 'Added Loyality to Wallet points accounts', 1471279990),
(392, 43, 'Added Discount to Wallet points accounts', 1471280033),
(393, 43, 'Added Loyality to Discount points accounts', 1471280073),
(394, 43, 'Added Discount to Loyality points accounts', 1471280363),
(395, 43, 'Added Discount to Loyality points accounts', 1471280421),
(396, 43, 'Added Discount to Loyality points accounts', 1471280476),
(397, 43, 'Added Wallet to all 3 ratio conversions points_ratio', 1471284534),
(398, 43, 'Added Loyality Ratios points_ratio', 1471285128),
(399, 43, 'Added Discount Ratios for Conversion Points points_ratio', 1471285181),
(400, 43, 'Added Bonus Ratios. Will Consider for Later Enhancements points_ratio', 1471285214),
(401, 43, 'Added Wallet to Loyality points accounts', 1471285989),
(402, 43, 'Added Discount to Loyality points accounts', 1471286041),
(403, 43, 'Added Loyality to Discount points accounts', 1471286100),
(404, 43, 'Added Loyality to Discount points accounts', 1471286293),
(405, 43, 'Added Loyality to Discount points accounts', 1471286353),
(406, 54, 'Transaction of   vouchers', 1471513751),
(407, 43, 'Deleted  commissions', 1471623219),
(408, 43, 'Deleted  commissions', 1471623229),
(409, 43, 'Deleted  commissions', 1471623233),
(410, 43, 'Deleted  commissions', 1471623236),
(411, 43, 'Deleted  commissions', 1471623241),
(412, 43, 'Deleted  commissions', 1471623251),
(413, 43, 'Deleted  commissions', 1471623256),
(414, 43, 'Deleted  commissions', 1471623259),
(415, 43, 'Deleted  commissions', 1471623280),
(416, 43, 'Deleted  commissions', 1471623283),
(417, 43, 'Deleted  commissions', 1471623285),
(418, 43, 'Deleted  commissions', 1471623298),
(419, 43, 'Deleted  commissions', 1471623301),
(420, 43, 'Deleted  commissions', 1471623304),
(421, 43, 'Deleted  commissions', 1471623307),
(422, 43, 'Deleted  commissions', 1471623310),
(423, 43, 'Deleted  commissions', 1471623312),
(424, 43, 'Deleted  commissions', 1471623314),
(425, 43, 'Added Splitting Voucher for School Fees commissions', 1471624966),
(426, 43, 'Deleted  commissions', 1471625127),
(427, 43, 'Added Dasara Split Vouchers commissions', 1471625170),
(428, 43, 'Added NEW SPLIT VOUCHERS commissions', 1471626225),
(429, 43, 'Added NEW SPLIT VOUCHERS commissions', 1471626334),
(430, 43, 'Added new trading voucher commissions', 1471626882),
(431, 43, 'Added Deewali Split Voucher commissions', 1471674523),
(432, 43, 'Added Trading Voucher for Festival commissions', 1471675770),
(433, 43, 'Transaction of   vouchers', 1471676586),
(434, 43, 'Transaction of   vouchers', 1471676667),
(435, 54, 'Transaction of   vouchers', 1471676875),
(436, 43, 'Transaction of   vouchers', 1472058292),
(437, 43, 'Transaction of   vouchers', 1472058493),
(438, 43, 'Transaction of   vouchers', 1472058558),
(439, 43, 'Added test commissions', 1472060348),
(440, 43, 'Added Commissions with Levels commissions', 1472062793),
(441, 43, 'Added New test for Levels add commissions', 1472063230),
(442, 43, 'Added TEST LEVELS commissions', 1472063400),
(443, 43, 'Deleted 42 commissions', 1472063421),
(444, 43, 'Updated TEST LEVELS commissions', 1472063716),
(445, 43, 'Added Loan from Agent to Customer commissions', 1472073041),
(446, 43, 'Added Loan from Agent to Customer commissions', 1472073076),
(447, 43, 'Added Loan from Agent to Customer commissions', 1472073146),
(448, 43, 'Added Loan from Agent to Customer2 commissions', 1472073200),
(449, 43, 'Added New Tenure Scheme commissions', 1472075310),
(450, 43, 'Added New Tenure Scheme2 commissions', 1472075515),
(451, 43, 'Added Credit Based on Request as User-Role', 1472260941),
(452, 43, 'Added Credit From Agent as User-Role', 1472261020),
(453, 43, 'Added Credit From Referrer as User-Role', 1472261033),
(454, 43, 'Added Credit For Highest Transaction as User-Role', 1472261045),
(455, 43, 'Added Daily Credit as User-Role', 1472261110),
(456, 43, 'Added Loan from Agent to Customer2 commissions', 1472275173),
(457, 43, 'Updated Bonus Ratios. Will Consider for Later Enhancementspoints_ratio', 1472486294),
(458, 43, 'Added Daily Credit Loan commissions', 1472489001),
(459, 43, 'Added Split as User-Role', 1472489567),
(460, 43, 'Updated Loan from Agent to Customer2 commissions', 1472533327),
(461, 43, 'Updated Loan from Agent to Customer2 commissions', 1472533340),
(462, 43, 'Updated Loan from Agent to Customer2 commissions', 1472533510),
(463, 43, 'Added Agent Loan Scheme commissions', 1472577343),
(464, 43, 'Added Loan scheme for Agent commissions', 1472584804),
(465, 43, 'Added Loan name testloans', 1472621099),
(466, 43, 'Added Loan name testloans', 1472622002),
(467, 43, 'Added Loan name testloans', 1472622084),
(468, 43, 'Added Loan name testloans', 1472622103),
(469, 43, 'Updated  authorizations', 1472787327),
(470, 43, 'Updated  authorizations', 1472787405),
(471, 43, 'Updated  authorizations', 1472795826),
(472, 43, 'Added Loan name testloans', 1472802064),
(473, 43, 'Deleted Retailor Sukumar from Agent', 1472816448),
(474, 43, 'Added Loan name testloans', 1472816542),
(475, 43, 'Added Global POS sales acct_categories', 1472946265),
(476, 43, 'Added Local POS sales Category', 1472946307),
(477, 43, 'Added Loan name testloans', 1472947966),
(478, 43, 'Added Wallet to Loyality points accounts', 1472950493),
(479, 43, 'Added  ledger', 1472950912),
(480, 43, 'Added Wallet to Loyality points accounts', 1473239814),
(481, 43, 'Createdrecharge', 1473240875),
(482, 43, 'Createdrecharge', 1473240890),
(483, 43, 'Createdrecharge', 1473241340),
(484, 43, 'Createdrecharge', 1473241389),
(485, 43, 'Createdrecharge', 1473241476),
(486, 43, 'Createdrecharge', 1473242055),
(487, 43, 'Createdrecharge', 1473242120),
(488, 43, 'Createdrecharge', 1473242130),
(489, 43, 'Createdrecharge', 1473242159),
(490, 54, 'Createdrecharge', 1473242316),
(491, 54, 'Createdrecharge', 1473248761),
(492, 54, 'Createdrecharge', 1473329718),
(493, 54, 'Createdrecharge', 1473329798),
(494, 54, 'Createdrecharge', 1473329856),
(495, 54, 'Createdrecharge', 1473329926),
(496, 43, 'Createdrecharge', 1473330033),
(497, 54, 'Createdrecharge', 1473340708),
(498, 54, 'Createdrecharge', 1473343345),
(499, 54, 'Createdrecharge', 1473343525),
(500, 54, 'Createdrecharge', 1473353541),
(501, 54, 'Createdrecharge', 1473353735),
(502, 54, 'Createdrecharge', 1473396027),
(503, 54, 'Createdrecharge', 1473396380),
(504, 54, 'Createdrecharge', 1474104843),
(505, 54, 'Createdrecharge', 1474107474),
(506, 54, 'Createdrecharge', 1474132012),
(507, 54, 'Createdrecharge', 1474132913),
(508, 54, 'Createdrecharge', 1474133189),
(509, 54, 'Added loans', 1474200963),
(510, 43, 'Added test1234 ledger', 1474204233),
(511, 54, 'Transaction of   vouchers', 1474224018),
(512, 43, 'Transaction of   vouchers', 1474225590),
(513, 43, 'Transaction of   vouchers', 1474226645),
(514, 43, 'Transaction of   vouchers', 1474226692),
(515, 43, 'Transaction of   vouchers', 1474226839),
(516, 43, 'Transaction of   vouchers', 1474227110),
(517, 43, 'Transaction of   vouchers', 1474227184),
(518, 43, 'Transaction of   vouchers', 1474227450),
(519, 43, 'Transaction of   vouchers', 1474227531),
(520, 43, 'Transaction of   vouchers', 1474227676),
(521, 43, 'Transaction of   vouchers', 1474227978),
(522, 43, 'Transaction of   vouchers', 1474228039),
(523, 43, 'Transaction of   vouchers', 1474228218),
(524, 43, 'Transaction of   vouchers', 1474228305),
(525, 43, 'Transaction of   vouchers', 1474228373),
(526, 43, 'Transaction of   vouchers', 1474228830),
(527, 43, 'Transaction of   vouchers', 1474229010),
(528, 43, 'Unblocked Liabilities Company from Agent', 1474229170),
(529, 43, 'Added  ledger', 1474229317),
(530, 43, 'Added Best Scheme for referrer commissions', 1474230125),
(531, 43, 'Added Loan EMI testloans', 1474233384),
(532, 43, 'Added Loan EMI testloans', 1474233498),
(533, 43, 'Added Loan EMI testloans', 1474233584),
(534, 43, 'Added Loan EMI testloans', 1474234473),
(535, 43, 'Added Loan EMI testloans', 1474234675),
(536, 43, 'Added Loan EMI testloans', 1474234814),
(537, 43, 'Added Loan EMI testloans', 1474235152),
(538, 43, 'Added Loan EMI testloans', 1474235336),
(539, 43, 'Added Loan EMI testloans', 1474235441),
(540, 43, 'Added Loan EMI testloans', 1474235538),
(541, 43, 'Added Loan EMI testloans', 1474235724),
(542, 43, 'Added Loan EMI testloans', 1474235810),
(543, 43, 'Added Loan EMI testloans', 1474236063),
(544, 43, 'Added Loan EMI testloans', 1474236208),
(545, 43, 'Added Loan EMI testloans', 1474236348),
(546, 43, 'Added Loan EMI testloans', 1474236413),
(547, 43, 'Added Loan EMI testloans', 1474236456),
(548, 43, 'Added Loan EMI testloans', 1474236628),
(549, 43, 'Added Loan EMI testloans', 1474236740),
(550, 43, 'Added Loan EMI testloans', 1474236777),
(551, 43, 'Added Loan EMI testloans', 1474236824),
(552, 43, 'Added Loan EMI testloans', 1474236911),
(553, 54, 'Createdrecharge', 1474290248),
(554, 43, 'Added loans', 1474382033),
(555, 43, 'Added loans', 1474382149),
(556, 43, 'Added Agricultural sales product commission setup fro Admin and Agent commissions', 1476761821),
(557, 43, 'Updated Agricultural sales product commission setup from Admin to Agent commissions', 1476769294),
(558, 43, 'Updated Agricultural sales product commission setup from Admin to Agent commissions', 1476783744),
(559, 43, 'Updated Agricultural sales product commission setup from Admin to Agent commissions', 1476792141),
(560, 43, 'Updated Agricultural sales product commission setup from Admin to Agent commissions', 1476803236),
(561, 43, 'Added test commissions', 1476808255),
(562, 43, 'Added Loyalty Points acct_categories', 1476811631),
(563, 43, 'Added Bank Accounts acct_categories', 1476811698),
(564, 43, 'Added Seller Loyality Category', 1476816697),
(565, 43, 'Added Client Loyality Category', 1476816717),
(566, 43, 'Added Test Ref benefits commissions', 1476848065),
(567, 43, 'Updated Test Ref benefits commissions', 1476848603),
(568, 43, 'Updated Test Ref benefits commissions', 1476848833),
(569, 43, 'Updated Test Ref benefits commissions', 1476855157),
(570, 43, 'Added Account Opening Initial Deposit ledger', 1476899505),
(571, 43, 'Added ChequeBook Request Category', 1476899556),
(572, 43, 'Added Bank charges for Transactions Category', 1476899614),
(573, 43, 'Added cheque book charges 38976288 ledger', 1476899675),
(574, 43, 'Added CASH DEPOSIT SELF by SP ledger', 1476899726),
(575, 43, 'Added CASH HANDLING CHARGES  for 85k ledger', 1476899967),
(576, 43, 'Added BY TRANSFER  RTGS UTR NO: UBINR52016100500209467  VASANT BHARAMAPPA DYAVAKKALAVAR ledger', 1476900123),
(577, 43, 'Added CASH WITHDRAWAL BY CHEQUE  18453 ledger', 1476900159),
(578, 43, 'Added NEFT account not valid charges from SBI ledger', 1476900281),
(579, 43, 'Added sdfd accounts', 1476970498);

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
  `password` varchar(200) NOT NULL,
  `row_pass` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  `acc_type` varchar(20) NOT NULL,
  `date_of_birth` varchar(30) DEFAULT NULL,
  `bank_name` varchar(200) NOT NULL,
  `street_address` varchar(500) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `area_id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `country` varchar(200) NOT NULL,
  `country_id` int(11) NOT NULL,
  `postal_code` int(20) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `passport_no` varchar(255) NOT NULL,
  `role` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `online_status` tinyint(1) NOT NULL,
  `user_lastlogin` int(11) NOT NULL,
  `referral_code` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `amount` double NOT NULL,
  `referredByCode` varchar(50) NOT NULL,
  `photo` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `first_name`, `last_name`, `password`, `row_pass`, `email`, `contactno`, `acc_type`, `date_of_birth`, `bank_name`, `street_address`, `area_name`, `area_id`, `city`, `city_id`, `country`, `country_id`, `postal_code`, `national_id`, `passport_no`, `role`, `active`, `online_status`, `user_lastlogin`, `referral_code`, `account_no`, `amount`, `referredByCode`, `photo`, `created_by`, `created_at`, `modified_at`) VALUES
(33, 'C & F', 'Karnataka', 'ac00cc63325cc130174bd4ce3ac9d38751896af2', 'candfkarnataka@gmail.com', '', '9980569960', 'male', '1982-09-29', 'Top Manager', 'Marathalli', 'Karnataka', 0, 'Bengaluru, Karnataka', 10, 'India', 105, 560010, '', '', 'admin', 2, 1, 1463894129, 'SRDUZXDX', '55500009991777', 0, 'Anand', 'IMG_6005_thumb.JPG', 1, 1460192464, 1464018224),
(65, 'Navin Nayak2', 'Nayak2', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '', '9980569960', 'current', '2019-01-01', 'State bank Of Mysuru', 'Yadava Giri', 'SBM0005656', 0, '', 0, 'India', 105, 0, '', '', 'agent', 1, 0, 0, '', '112266454567', 0, '', '', 43, 1464105174, 1464105174),
(66, 'Sharath', 'Pawar', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '', '1234434543', 'current', '2010-01-01', 'HDFC', 'ok', 'kjnjkn098', 0, '', 0, 'India', 105, 0, '', '', 'agent', 1, 0, 0, '', '12193812', 0, '', '', 43, 1464148796, 1464148796),
(67, 'Mahadev', 'Swamy', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1234', '', '23442343', 'savings', '2010-01-01', 'SBI', 'Mandya', 'ICIC0012345888', 0, '', 0, 'India', 105, 571156, '', '', 'agent', 1, 0, 0, '', '6647938289222', 0, '', '', 43, 1464150152, 1464206235),
(68, 'Sagar', 'Last Name', '618dcdfb0cd9ae4481164961c4796dd8e3930c8d', '1212', '', '9980569960', 'current', '2010-01-01', 'HDFC', 'Branch add', 'bah888394', 0, '', 0, 'India', 105, 2910293, '', '', 'agent', 1, 0, 0, '', '1111222111222121', 0, '', '', 43, 1468168189, 1468168189),
(69, 'Customer', 'Sagar', '1234', '1234', '', '9980569960', '', NULL, '', '709288403656429', 'Net Banking', 0, '', 0, '', 0, 0, '', '', 'user', 1, 0, 0, '', '709288403656429', 0, '', '', 54, 1470154534, 1470154534),
(70, 'Customer', 'Sagar', '', '', '', '', 'savings', '2016-08-01', 'SBI', 'Bengaluru', 'ICIC003456', 0, '', 0, '', 0, 560056, '', '', '', 1, 0, 0, '', '1192883748', 5000, '', '', 54, 1471000440, 1471000440),
(74, 'Customer', 'Sagar', '', '', '', '', 'savings', '2016-08-08', 'ICICI', 'Gulbarga', 'ICIC003456', 0, '', 0, '', 0, 2147483647, '', '', '', 1, 0, 0, '', '48574389549485439', 25000, '', '', 54, 1471001723, 1471001723),
(75, 'Customer', 'Sagar', '', '', '', '', 'current', '2016-01-01', 'Vijaya Bank', 'Gadaga', 'VIJ001928374', 0, '', 0, '', 0, 7878744, '', '', '', 1, 0, 0, '', '2234234223434355', 30000, '', '', 54, 1471098203, 1471098203),
(76, 'Agent Satish', 'Patil', '', '', '', '', 'savings', '2016-01-01', 'SBI', 'Gadaga', 'SBI001234', 0, '', 0, '', 0, 56007, '', '', '', 1, 0, 0, '', '1128327436545999', 10000, '', 'MS6_thumb.jpg', 90, 1471176575, 1471176575);

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

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `unique_id`, `sub_acct_id`, `commission_percent`, `added_by`, `created_at`, `modified_at`, `modified_by`) VALUES
(3, 'Fashion', '', 0, 10, 1, 1432142049, 1432142049, 0),
(4, 'Education', '', 0, 1, 43, 1464458311, 1464458311, 0),
(5, 'Automobile 2 wheelers workshop', '', 0, 25, 33, 1462025824, 1462025824, 0),
(6, 'Cash Deposit', '', 0, 0, 79, 1464975758, 1464975758, 0),
(7, 'Sales consumer Products', '', 0, 1, 79, 1464975805, 1464975805, 0),
(8, 'Purchase of Consumer Products', '', 0, 1, 79, 1464975820, 1464975820, 0),
(9, 'Income', '', 0, 0, 43, 1465118638, 1465118638, 0),
(10, 'Agricultural Purchase Products', '', 0, 1, 43, 1465138087, 1465138087, 0),
(11, 'Vegetable', '', 0, 10, 43, 1468949931, 1468949931, 0);

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
('0075062e587a55b1d48613c40b0be41db63470da', '127.0.0.1', 1476851086, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313038363b72656469726563745f617574685f7572697c733a32393a226163636f756e742f62616c616e636573686565745f766965772f393730223b),
('01a3dce4501f814ebef938caa1c91d6c883a2757', '127.0.0.1', 1476852147, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323134373b),
('04c82fdaf6acd92bf0f93df947db9e750864f505', '127.0.0.1', 1476879753, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837393735323b72656469726563745f617574685f7572697c733a32373a2263617465676f72792f77616c6c65745f746f5f646973636f756e74223b),
('06e46176e3c6e99866e22c78d6a408ecc274face', '127.0.0.1', 1476880399, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303339393b),
('0bfbd5ed7eb81742fbba96f44b1e8ec4f8624215', '127.0.0.1', 1476875735, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837353733343b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('0ceee5f17bc81a45958eb284f1406891c154b62b', '127.0.0.1', 1476875725, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837353732343b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('126926d8a58a46d5528768902639133f17b21e60', '127.0.0.1', 1476863378, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363836333337373b),
('1696076b11f4a11510d5815ff88e73d1084a1573', '127.0.0.1', 1476878166, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837383136363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('169ac7181b8ddb9f6525c0cf2564f6d36ede2a8c', '127.0.0.1', 1476880523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303532333b72656469726563745f617574685f7572697c733a31393a2270726f647563742f626f6f6b696e675f627573223b),
('17274711feca6cae17b82ac0ce7a0169fc785930', '127.0.0.1', 1476851559, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313535383b72656469726563745f617574685f7572697c733a32393a226163636f756e742f62616c616e636573686565745f766965772f393831223b),
('198dae0535f4f082c78f3ab25dab5d4e8b9a6afc', '127.0.0.1', 1476881238, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838313233383b72656469726563745f617574685f7572697c733a343a2275736572223b),
('19d9cd5d848c86917c06fb041ac6364c41d976cd', '127.0.0.1', 1476853496, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835333439353b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('1b03f8698c32ccdf2775b82ac18ef16c36340253', '127.0.0.1', 1476880614, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303631333b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('1b4555fbebb7eb2535fac86cf33bb72af05a17f9', '127.0.0.1', 1476881291, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837383133373b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a31333a2261737040676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223930223b733a343a22726f6c65223b733a353a226167656e74223b733a393a226c6f676765645f696e223b623a313b7d),
('1b8c8e17b4cbae00a3344531a3182cad3d93638b', '127.0.0.1', 1476855191, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835353139303b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('1c6959565c31149016c46f903446fbd492042810', '127.0.0.1', 1476852211, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323231303b72656469726563745f617574685f7572697c733a32393a226163636f756e742f62616c616e636573686565745f766965772f393836223b),
('1c98afbf7172d0ba684866859abe3db1441ac787', '127.0.0.1', 1476880535, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303533343b72656469726563745f617574685f7572697c733a32343a2270726f647563742f73657276696365735f70726570616964223b),
('1de4cb95a4a23fabeacbb23bae5e459e07273860', '::1', 1476896222, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363839353939323b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a31333a2261737040676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223930223b733a343a22726f6c65223b733a353a226167656e74223b733a393a226c6f676765645f696e223b623a313b7d),
('213e013778e8f257d2c4175210e2338d0662f29f', '127.0.0.1', 1476855186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835353138363b72656469726563745f617574685f7572697c733a31393a2270726f647563742f696e766f6963652f323232223b),
('219729db9f96a6b23e92bca20c64ec90e6fef5dc', '127.0.0.1', 1476881223, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838313232333b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('21ed5b2bf5304c6c2fc90636682fef0dc8f7a651', '127.0.0.1', 1476857130, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835373132393b72656469726563745f617574685f7572697c733a32363a226c65646765722f636f6d6d697373696f6e735f766965772f3537223b),
('23c8f98ce49c1371d6aff3f5b1e9ca14241f6259', '127.0.0.1', 1476876627, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363632373b72656469726563745f617574685f7572697c733a32333a226c65646765722f7472616e736665725f6361706974616c223b),
('23e93250c8bc5728a42d9bcf7939a56f9bdc3245', '127.0.0.1', 1476879891, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837393839313b),
('241e95fa8f334a3f2c2da76542d6742719b0054b', '127.0.0.1', 1476876819, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363831393b72656469726563745f617574685f7572697c733a383a22766f756368657273223b),
('2440347ae53660585b6bf41cdb57fd6b458b4718', '127.0.0.1', 1476851549, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313534393b72656469726563745f617574685f7572697c733a32393a226163636f756e742f62616c616e636573686565745f766965772f393830223b),
('26d4d624a7eda799199e7c004acdafee45d1b751', '127.0.0.1', 1476878142, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837383134323b),
('27d04447f960e29e32d80db7e31193ff5fd392bf', '127.0.0.1', 1476875858, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837353835383b72656469726563745f617574685f7572697c733a32333a2270726f647563742f72656368617267655f6d6f62696c65223b),
('27de7e4c26487c095b765fafae295e7e494d0946', '127.0.0.1', 1476881254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838313235343b72656469726563745f617574685f7572697c733a32303a226163636f756e742f6d795f726566657272616c73223b),
('2911f01b8eee58b82db6971f50d449f87de72907', '127.0.0.1', 1476876831, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363833303b72656469726563745f617574685f7572697c733a32373a2263617465676f72792f77616c6c65745f746f5f646973636f756e74223b),
('29a1dfdb935c36834b15ceafb29f0cfc6462cfb5', '127.0.0.1', 1476854429, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835343432393b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('2ce75020657cfa2c11f1d32a911ca0b7f017ef11', '127.0.0.1', 1476852203, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323230333b72656469726563745f617574685f7572697c733a32393a226163636f756e742f62616c616e636573686565745f766965772f393835223b),
('2f5929611646957c677fc34f6839f9363555fe08', '127.0.0.1', 1476876854, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363835333b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('359ef2273bfcd4996dddacf5e92415515fadbe76', '127.0.0.1', 1476880395, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303339353b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('392350e02bdc2106c0c8ad474e4ecfe48e977ce3', '127.0.0.1', 1476880479, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303437383b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('3b123599c54308deee5a6403dbd1cab1bf553809', '127.0.0.1', 1476857207, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835373230373b72656469726563745f617574685f7572697c733a31393a2270726f647563742f696e766f6963652f323234223b),
('3c5594fda757d84eae7a48c07ddb1f36f6bf2bfe', '127.0.0.1', 1476880512, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303531323b72656469726563745f617574685f7572697c733a373a2270726f64756374223b),
('3e5287599d051d4182bd3c4bca3232cf108df4f5', '127.0.0.1', 1476851532, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313533313b72656469726563745f617574685f7572697c733a31393a2270726f647563742f696e766f6963652f323138223b),
('4279e7b9a68f319a1cab35b682df3827db26c473', '127.0.0.1', 1476865297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363836353239363b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('43444e962b693207ec24401eb4d4a6415343a687', '::1', 1476857409, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363834363337323b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223433223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('4743b5b917f03feac513288a977ff1a4aaabbc21', '127.0.0.1', 1476853206, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835333230353b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('4e4e9d9dd0e58e2223ed427a9ff9736a79f66f16', '127.0.0.1', 1476851622, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313632313b72656469726563745f617574685f7572697c733a32393a226163636f756e742f62616c616e636573686565745f766965772f393832223b),
('503ca5b84ffce09967496ca8aac30edcadf51c3e', '127.0.0.1', 1476851540, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313534303b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('5384576526e45c3796f5cee1dae18ff9973ce30d', '127.0.0.1', 1476851092, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313039313b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('563c470c2c74e8a5a528a64f84cc935e163f0b5c', '127.0.0.1', 1476880531, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303533303b72656469726563745f617574685f7572697c733a32333a2270726f647563742f72656368617267655f6d6f62696c65223b),
('58d6ed1d4ea717d6aceff0aa9d7a6eea5dbc73ce', '127.0.0.1', 1476854838, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835343833383b72656469726563745f617574685f7572697c733a32363a226c65646765722f656469745f636f6d6d697373696f6e732f3537223b),
('59fddf8c4ccc0ac998fdf4b9faa50d6412be4898', '127.0.0.1', 1476876099, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363039393b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('5a79925e6d3f32b6033762a74caf6b05abce0a77', '127.0.0.1', 1476865426, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363836353432353b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('5c90c2bed515267e93b10d25bd2906bede6b9edd', '127.0.0.1', 1476878269, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837383236383b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('5ee97e3988065bbc2cf923157575f3b83677ef5b', '127.0.0.1', 1476879835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837373532353b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a31363a2263736167617240676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223534223b733a343a22726f6c65223b733a343a2275736572223b733a393a226c6f676765645f696e223b623a313b7d),
('60be2432094489a7e72f3bec2a689d450e05e567', '127.0.0.1', 1476851657, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313635363b),
('676838d1c30db7a8ac25e41b944edf39d8f7e532', '127.0.0.1', 1476857392, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835373339323b72656469726563745f617574685f7572697c733a31393a2270726f647563742f696e766f6963652f323235223b),
('6c391ed00a20c4b95963f06e411cd608d2e7d816', '127.0.0.1', 1476854510, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835343531303b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('6f6bce7b7653fa4cea306f9d446010dca01c0539', '127.0.0.1', 1476878156, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837383135363b),
('703aa0b7482f6e3c1bb913c4f18daecd96bad34c', '127.0.0.1', 1476853201, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835333230313b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('7a44d9fd4b8ecfa6bf25a30975db9a13766ab3b5', '127.0.0.1', 1476852192, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323139323b72656469726563745f617574685f7572697c733a32393a226163636f756e742f62616c616e636573686565745f766965772f393834223b),
('7f96ee5d3ccc18bd3438ea04146dd9e25fe5a325', '127.0.0.1', 1476875685, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837353638353b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('80a15ad5a5b4800c7a493985de97002fa7bcfd39', '127.0.0.1', 1476881275, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838313237353b),
('813757a635a989a8dc244694195b4edf689c3b64', '127.0.0.1', 1476880387, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303338363b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('855ea3a12d7d6643de2a13f74b8e268a94c80c58', '127.0.0.1', 1476854831, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835343833303b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('868137ef0253959dd296f044f9ae95c78c6e2c35', '127.0.0.1', 1476857211, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835373231313b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('882cf8435a921a5d4da6d4dd83c65f077e831b55', '127.0.0.1', 1476879862, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837393836323b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('8a85d28f214c0d0e8420651002d597b9fcbc4449', '127.0.0.1', 1476852891, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323839313b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('8cc4b043f0d21699857784b37b992f4c81c35bca', '127.0.0.1', 1476852158, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313635333b72656469726563745f617574685f7572697c733a31363a2264617368626f6172642f6c6f676f7574223b),
('907dd4b57f4f0c234d74615bb283c9f6c685f4e3', '::1', 1476900592, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363839353934393b72656469726563745f617574685f7572697c733a363a226c6564676572223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223433223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('9213e2c4334eaef19915b62106bcdeb94e8cd6ea', '127.0.0.1', 1476852183, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323138323b72656469726563745f617574685f7572697c733a32393a226163636f756e742f62616c616e636573686565745f766965772f393833223b),
('92eefaf2dcbc61a2a3763944e989772d7a51b553', '127.0.0.1', 1476875863, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837353836333b72656469726563745f617574685f7572697c733a31373a2270726f647563742f6164645f73616c6573223b),
('94a71a5ec85f2c9c0d926ce9245cb4523811f39b', '127.0.0.1', 1476879859, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837393835383b72656469726563745f617574685f7572697c733a343a2275736572223b),
('997636531a12d939380dde717a1e66e552ea571a', '127.0.0.1', 1476853215, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835333231353b72656469726563745f617574685f7572697c733a32363a226c65646765722f636f6d6d697373696f6e735f766965772f3537223b),
('99d91f69952b85ca1de4404efdcdfacff904b2ff', '127.0.0.1', 1476876814, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363831343b72656469726563745f617574685f7572697c733a33313a22766f7563686572732f627573696e6573735f766f75636865725f696e646578223b),
('a23e1a79924c8af016e8b9d09ed7dcc1c70f579d', '127.0.0.1', 1476876588, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363538383b72656469726563745f617574685f7572697c733a383a2263617465676f7279223b),
('a3d6b79700e39620d6be493346adc5ab209d41f3', '127.0.0.1', 1476875988, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837353938373b),
('a3fb599f61d5d78d85c5c9a4f09be07e6546866f', '127.0.0.1', 1476852945, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323934353b72656469726563745f617574685f7572697c733a32323a226c65646765722f6c65646765725f766965772f333833223b),
('a4307f87763b135cabe1fe57baa0e81d29ddadc2', '127.0.0.1', 1476881247, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838313234363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('a70baa5fde651a620a9216554c302517b136f0a6', '127.0.0.1', 1476854835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835343833343b72656469726563745f617574685f7572697c733a32363a226c65646765722f636f6d6d697373696f6e735f766965772f3537223b),
('a820129bcc9dd92aa8d0f412bf06fef81a5ac125', '::1', 1476881235, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363836333337343b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223433223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('a91206e8576ae050c8cdf3e60b0d8eb98a3689de', '127.0.0.1', 1476857374, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835373337343b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('b056c711e418cfb1a49592f91a1ea3b64c091287', '127.0.0.1', 1476852812, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323831323b72656469726563745f617574685f7572697c733a32323a226c65646765722f6c65646765725f766965772f333738223b),
('b1c2e38277dee77596551b52ea5b611d45d66cd8', '127.0.0.1', 1476880637, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303633363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('b22448dc0cad02b5c9a1ec76ae9d07007864b273', '127.0.0.1', 1476852907, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323930373b72656469726563745f617574685f7572697c733a31393a2270726f647563742f696e766f6963652f323139223b),
('b24269e10d92e96b555ed83765311e61dab4bcf8', '127.0.0.1', 1476876029, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363032393b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('b3561f299d4222f1074c4a3a1a333efb30474dfb', '127.0.0.1', 1476854507, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835343530363b72656469726563745f617574685f7572697c733a31393a2270726f647563742f696e766f6963652f323231223b),
('ba38d85b6ac1dc7c29960d4cedc3d799f91453f2', '127.0.0.1', 1476865287, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363836353238363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('c68b4b5e0a142bf29bda91f2da969639870f1d42', '127.0.0.1', 1476856826, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835363832363b72656469726563745f617574685f7572697c733a31393a2270726f647563742f696e766f6963652f323233223b),
('c7ecd1b30feb434e70b9996b6b3fb1da46d2e4d3', '127.0.0.1', 1476852951, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323935303b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('cb70b33c2f17c399e5cc1062bedd93c113d6fa30', '127.0.0.1', 1476851653, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835313635323b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('cc20736bda8fa95a408075c41fd9657fd92b8cb6', '127.0.0.1', 1476880382, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303338323b72656469726563745f617574685f7572697c733a383a2263617465676f7279223b),
('cd00304811a80f44adeab1c72ee6f987a90baf76', '127.0.0.1', 1476878180, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837383137393b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('ce328d7b204ae249b0cbfb5b04ae3a78c225085f', '127.0.0.1', 1476881230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838313233303b72656469726563745f617574685f7572697c733a32343a2261646d696e5f73657474696e67732f616c6c5f726f6c6573223b),
('d005b69db2dc7170de2fd15194b15b3bb4968da9', '127.0.0.1', 1476879631, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837393633313b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('d021eeddd1ea1db56ff634572b62df5794575e23', '127.0.0.1', 1476852245, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323234353b),
('d18b0675ed924e18c9884ba90c32402382ee06f3', '127.0.0.1', 1476856806, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835363830353b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('d3f882bf8812c2f7f3a2e139d4291b0539b40b87', '127.0.0.1', 1476852173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323137323b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('d60d37671f98453a07f4f53b6f3e41066ec2fa9f', '127.0.0.1', 1476876656, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837363635353b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('d8c32b8d3cf86ab690c69f21c1d2826e18b9072e', '127.0.0.1', 1476853197, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835333139373b72656469726563745f617574685f7572697c733a31393a2270726f647563742f696e766f6963652f323230223b),
('d9e0664b4b468f3daea3ef494d4c1e87067d0a8a', '127.0.0.1', 1476852954, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323935343b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f766965772f333833223b),
('dcfd866d7008ff3fd8ee992a65c7eeb51ceb14d5', '127.0.0.1', 1476852232, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835323233313b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('de0f60d32ed394f8fde3f8ad45b0eabfe5773081', '127.0.0.1', 1476879846, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837393834353b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('de98a097a3854d69688b2058984b279caa50a2a9', '127.0.0.1', 1476857126, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363835373132353b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('f4253d632d5a9eb6afa2576cbc57be71608d6bca', '127.0.0.1', 1476880597, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363838303539363b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('f626f1d8a1f5ff19036e61ad641662b3c7959242', '127.0.0.1', 1476865282, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363836353238323b),
('f83fe4a9e9f7e8e3b47ce27f8c5f0f596910f8c4', '127.0.0.1', 1476875867, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363837353836373b72656469726563745f617574685f7572697c733a31383a2270726f647563742f7061795f77616c6c6574223b),
('fbe62d83e6a5d77bd656fe31c36c928b9a32123f', '::1', 1476940890, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363933383835303b72656469726563745f617574685f7572697c733a363a226c6564676572223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223433223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('ffc3455e4e913b70c0c1091574e50047a8e6b1ef', '::1', 1476975571, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437363936373533313b72656469726563745f617574685f7572697c733a363a226c6564676572223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a33333a22636173685f64697370617463686572406d7966616972736572766963652e636f6d223b733a373a22757365725f6964223b733a323a223739223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d);

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(10) NOT NULL,
  `identity` varchar(30) NOT NULL,
  `identity_id` varchar(255) NOT NULL,
  `type` text NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `acct_id` varchar(255) NOT NULL,
  `sub_acct_id` varchar(255) NOT NULL,
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
  `seller_loyality` float NOT NULL,
  `client_loyality` float NOT NULL,
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

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`id`, `user_id`, `amount`, `invoice_id`, `income_type`, `income_for`, `created_at`, `modified_at`) VALUES
(1, 43, 1, 1, 'onSales', 'agent', 1468862871, 1468862871),
(2, 90, 1, 1, 'onPurchase', 'user', 1468862871, 1468862871),
(3, 1, 1, 1, 'admin', 'admin', 1468862872, 1468862872),
(4, 90, 1, 1, 'referral', 'referralUser', 1468862872, 1468862872),
(5, 43, 1, 2, 'onSales', 'agent', 1468863032, 1468863032),
(6, 54, 1, 2, 'onPurchase', 'user', 1468863032, 1468863032),
(7, 1, 1, 2, 'admin', 'admin', 1468863032, 1468863032),
(8, 54, 1, 2, 'referral', 'referralUser', 1468863032, 1468863032),
(9, 43, 0, 4, 'onSales', 'agent', 1469887711, 1469887711),
(10, 90, 0, 4, 'onPurchase', 'user', 1469887711, 1469887711),
(11, 1, 0, 4, 'admin', 'admin', 1469887711, 1469887711),
(12, 90, 0, 4, 'referral', 'referralUser', 1469887711, 1469887711),
(13, 43, 0, 5, 'onSales', 'agent', 1469887905, 1469887905),
(14, 90, 0, 5, 'onPurchase', 'user', 1469887905, 1469887905),
(15, 1, 0, 5, 'admin', 'admin', 1469887905, 1469887905),
(16, 90, 0, 5, 'referral', 'referralUser', 1469887905, 1469887905),
(17, 43, 0, 6, 'onSales', 'agent', 1469887931, 1469887931),
(18, 90, 0, 6, 'onPurchase', 'user', 1469887931, 1469887931),
(19, 1, 0, 6, 'admin', 'admin', 1469887931, 1469887931),
(20, 90, 0, 6, 'referral', 'referralUser', 1469887931, 1469887931),
(21, 43, 0, 7, 'onSales', 'agent', 1469887989, 1469887989),
(22, 90, 0, 7, 'onPurchase', 'user', 1469887989, 1469887989),
(23, 1, 0, 7, 'admin', 'admin', 1469887990, 1469887990),
(24, 90, 0, 7, 'referral', 'referralUser', 1469887990, 1469887990),
(25, 43, 0, 8, 'onSales', 'agent', 1469887997, 1469887997),
(26, 90, 0, 8, 'onPurchase', 'user', 1469887997, 1469887997),
(27, 1, 0, 8, 'admin', 'admin', 1469887997, 1469887997),
(28, 90, 0, 8, 'referral', 'referralUser', 1469887997, 1469887997),
(29, 43, 0, 9, 'onSales', 'agent', 1469888007, 1469888007),
(30, 90, 0, 9, 'onPurchase', 'user', 1469888007, 1469888007),
(31, 1, 0, 9, 'admin', 'admin', 1469888007, 1469888007),
(32, 90, 0, 9, 'referral', 'referralUser', 1469888007, 1469888007),
(33, 43, 0, 10, 'onSales', 'agent', 1469888046, 1469888046),
(34, 90, 0, 10, 'onPurchase', 'user', 1469888046, 1469888046),
(35, 1, 0, 10, 'admin', 'admin', 1469888046, 1469888046),
(36, 90, 0, 10, 'referral', 'referralUser', 1469888046, 1469888046),
(37, 43, 0, 11, 'onSales', 'agent', 1469888119, 1469888119),
(38, 90, 0, 11, 'onPurchase', 'user', 1469888119, 1469888119),
(39, 1, 0, 11, 'admin', 'admin', 1469888120, 1469888120),
(40, 90, 0, 11, 'referral', 'referralUser', 1469888120, 1469888120),
(41, 43, 0, 12, 'onSales', 'agent', 1469888210, 1469888210),
(42, 90, 0, 12, 'onPurchase', 'user', 1469888210, 1469888210),
(43, 1, 0, 12, 'admin', 'admin', 1469888210, 1469888210),
(44, 90, 0, 12, 'referral', 'referralUser', 1469888211, 1469888211),
(45, 43, 0, 13, 'onSales', 'agent', 1469888267, 1469888267),
(46, 91, 0, 13, 'onPurchase', 'user', 1469888267, 1469888267),
(47, 1, 0, 13, 'admin', 'admin', 1469888267, 1469888267),
(48, 91, 0, 13, 'referral', 'referralUser', 1469888267, 1469888267),
(49, 43, 0, 14, 'onSales', 'agent', 1469888341, 1469888341),
(50, 90, 0, 14, 'onPurchase', 'user', 1469888341, 1469888341),
(51, 1, 0, 14, 'admin', 'admin', 1469888341, 1469888341),
(52, 90, 0, 14, 'referral', 'referralUser', 1469888341, 1469888341),
(53, 43, 50, 15, 'onSales', 'agent', 1469888387, 1469888387),
(54, 89, 50, 15, 'onPurchase', 'user', 1469888387, 1469888387),
(55, 1, 50, 15, 'admin', 'admin', 1469888387, 1469888387),
(56, 89, 50, 15, 'referral', 'referralUser', 1469888387, 1469888387),
(57, 43, 0, 16, 'onSales', 'agent', 1470197911, 1470197911),
(58, 54, 0, 16, 'onPurchase', 'user', 1470197911, 1470197911),
(59, 1, 0, 16, 'admin', 'admin', 1470197911, 1470197911),
(60, 54, 0, 16, 'referral', 'referralUser', 1470197911, 1470197911),
(61, 43, 3, 17, 'onSales', 'agent', 1470197992, 1470197992),
(62, 54, 3, 17, 'onPurchase', 'user', 1470197992, 1470197992),
(63, 1, 3, 17, 'admin', 'admin', 1470197992, 1470197992),
(64, 54, 3, 17, 'referral', 'referralUser', 1470197992, 1470197992),
(65, 43, 0, 18, 'onSales', 'agent', 1470198116, 1470198116),
(66, 54, 0, 18, 'onPurchase', 'user', 1470198116, 1470198116),
(67, 1, 0, 18, 'admin', 'admin', 1470198116, 1470198116),
(68, 54, 0, 18, 'referral', 'referralUser', 1470198116, 1470198116),
(69, 43, 0, 19, 'onSales', 'agent', 1470198189, 1470198189),
(70, 54, 0, 19, 'onPurchase', 'user', 1470198189, 1470198189),
(71, 1, 0, 19, 'admin', 'admin', 1470198189, 1470198189),
(72, 54, 0, 19, 'referral', 'referralUser', 1470198189, 1470198189),
(73, 43, 0, 70, 'onSales', 'agent', 1471007782, 1471007782),
(74, 90, 0, 70, 'onPurchase', 'user', 1471007782, 1471007782),
(75, 1, 0, 70, 'admin', 'admin', 1471007782, 1471007782),
(76, 90, 0, 70, 'referral', 'referralUser', 1471007782, 1471007782);

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
  `pay_type` double NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `amount` double NOT NULL,
  `capital` double NOT NULL,
  `liabilities` double NOT NULL,
  `cash` double NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `transaction` varchar(250) NOT NULL,
  `start_date` date NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `count` text NOT NULL,
  `challan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `user_id`, `pay_type`, `debit`, `credit`, `amount`, `capital`, `liabilities`, `cash`, `invoice_id`, `remarks`, `transaction`, `start_date`, `created_at`, `modified_at`, `modified_by`, `count`, `challan`) VALUES
(1, 43, 45, 11000, 0, 11000, 0, 0, 0, 0, 'Account Opening Initial Deposit', '', '2016-10-19', 1476899505, 1476899505, 0, 'yes', 'test image'),
(2, 43, 63, 0, 115, 115, 0, 0, 0, 0, 'cheque book charges 38976288', '', '2016-10-19', 1476899675, 1476899675, 0, 'yes', 'test image'),
(3, 43, 63, 85000, 0, 85000, 0, 0, 0, 0, 'CASH DEPOSIT SELF by SP', '', '2016-10-19', 1476899726, 1476899726, 0, 'yes', 'test image'),
(4, 43, 63, 0, 73.31, 73.31, 0, 0, 0, 0, 'CASH HANDLING CHARGES  for 85k', '', '2016-10-19', 1476899967, 1476899967, 0, 'yes', 'test image'),
(5, 43, 63, 500000, 0, 500000, 0, 0, 0, 0, 'BY TRANSFER  RTGS UTR NO: UBINR52016100500209467  VASANT BHARAMAPPA DYAVAKKALAVAR', '', '2016-10-19', 1476900123, 1476900123, 0, 'yes', 'test image'),
(6, 43, 63, 0, 200000, 200000, 0, 0, 0, 0, 'CASH WITHDRAWAL BY CHEQUE  18453', '', '2016-10-19', 1476900159, 1476900159, 0, 'yes', 'test image'),
(7, 43, 63, 0, 2.3, 2.3, 0, 0, 0, 0, 'NEFT account not valid charges from SBI', '', '2016-10-19', 1476900281, 1476900281, 0, 'yes', 'test image');

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

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `loan_name`, `identity_id`, `user_id`, `account_no`, `acct_id`, `sub_acct_id`, `amount`, `emi`, `deduct_date`, `bal_amt`, `paid`, `start_date`, `end_date`, `tenure`, `period`, `to_role`, `created_by`, `created_at`, `modified_at`, `modified_by`) VALUES
(193, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 200, 1, '19-10-2016', 1800, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236910, 1474236910, '43'),
(194, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 400, 2, '19-11-2016', 1600, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236910, 1474236910, '43'),
(195, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 600, 3, '19-12-2016', 1400, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236910, 1474236910, '43'),
(196, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 800, 4, '19-01-2017', 1200, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236910, 1474236910, '43'),
(197, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 1000, 5, '19-02-2017', 1000, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236911, 1474236911, '43'),
(198, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 1200, 6, '19-03-2017', 800, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236911, 1474236911, '43'),
(199, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 1400, 7, '19-04-2017', 600, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236911, 1474236911, '43'),
(200, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 1600, 8, '19-05-2017', 400, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236911, 1474236911, '43'),
(201, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 1800, 9, '19-06-2017', 200, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236911, 1474236911, '43'),
(202, 'Loan EMI test', 'LOAN_0986427315', 96, '953168149307254', 24, 51, 2000, 10, '19-07-2017', 0, 'no', '2016-09-19', '9999-12-31', 10, 30, 0, 43, 1474236911, 1474236911, '43');

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
(1, 50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1468086752),
(2, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1468131846),
(3, 84, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1468134874),
(4, 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1468156807),
(5, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1468861901),
(6, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1468862093),
(7, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1468862221),
(8, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1468862280),
(9, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1468897303),
(10, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1468900075),
(11, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1468936141),
(12, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1468936190),
(13, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1468936206),
(14, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1468985254),
(15, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1468985592),
(16, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469017926),
(17, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469107421),
(18, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469284953),
(19, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469335481),
(20, 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1469355180),
(21, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469380974),
(22, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469414064),
(23, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1469414109),
(24, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1469414142),
(25, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469451891),
(26, 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1469454207),
(27, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469505852),
(28, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469525286),
(29, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469578774),
(30, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469623000),
(31, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469673856),
(32, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469718197),
(33, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469762550),
(34, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469854514),
(35, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1469979173),
(36, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470098466),
(37, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470136306),
(38, 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1470147645),
(39, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470194730),
(40, 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1470197034),
(41, 53, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470223344),
(42, 53, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470223728),
(43, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470223950),
(44, 90, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470223995),
(45, 43, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1470224850),
(46, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470229237),
(47, 90, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470229403),
(48, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470245382),
(49, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470312739),
(50, 31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1470678304),
(51, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470714569),
(52, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1470743123),
(53, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1470743385),
(54, 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1470747005),
(55, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1470916459),
(56, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1470939521),
(57, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1470990979),
(58, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1470993060),
(59, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1470996070),
(60, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1471003275),
(61, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1471020823),
(62, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471025965),
(63, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471028003),
(64, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1471098122),
(65, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1471098407),
(66, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1471098770),
(67, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1471151794),
(68, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1471161263),
(69, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471163837),
(70, 99, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471208708),
(71, 99, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1471209245),
(72, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471210212),
(73, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471237164),
(74, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1471244476),
(75, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471458633),
(76, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471459659),
(77, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471462558),
(78, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471496085),
(79, 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471513489),
(80, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471536375),
(81, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471568521),
(82, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1471670796),
(83, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1471675819),
(84, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1471769377),
(85, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1471769639),
(86, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1472058118),
(87, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1472061000),
(88, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1472069610),
(89, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1472256596),
(90, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472292745),
(91, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472294029),
(92, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472300418),
(93, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472300641),
(94, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472301367),
(95, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1472318777),
(96, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472348764),
(97, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472348995),
(98, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472349251),
(99, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1472349938),
(100, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472350364),
(101, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472350411),
(102, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472362199),
(103, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472362503),
(104, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1472371300),
(105, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472404155),
(106, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1472408427),
(107, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472439302),
(108, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472476734),
(109, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472527496),
(110, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472527523),
(111, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472574817),
(112, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472613518),
(113, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472726883),
(114, 31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472732968),
(115, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472733981),
(116, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1472737900),
(117, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472782849),
(118, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472796437),
(119, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472810722),
(120, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1472946169),
(121, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1472950960),
(122, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1473224053),
(123, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1473224095),
(124, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1473239484),
(125, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1473242189),
(126, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1473242272),
(127, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1473329030),
(128, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1473330027),
(129, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1473341075),
(130, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1473341352),
(131, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1473395927),
(132, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1473854741),
(133, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1473951901),
(134, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36', 1473951938),
(135, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474093311),
(136, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1474113189),
(137, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1474175123),
(138, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1474199783),
(139, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1474200475),
(140, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474221603),
(141, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474229126),
(142, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1474269852),
(143, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474275952),
(144, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474282527),
(145, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586', 1474285816),
(146, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1474290024),
(147, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1474290043),
(148, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474290094),
(149, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474290116),
(150, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474290226),
(151, 54, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474292440),
(152, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36', 1474373994),
(153, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', 1474460478),
(154, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1474510105),
(155, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1475429632),
(156, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1475430203),
(157, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1476632822),
(158, 90, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476637187),
(159, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1476703937),
(160, 90, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476704041),
(161, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.25.2661.78 Safari/537.36', 1476704630),
(162, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476758372),
(163, 90, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476759074),
(164, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476762688),
(165, 89, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476822288),
(166, 89, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476822335),
(167, 89, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476822453),
(168, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476822488),
(169, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476846381),
(170, 90, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476849110),
(171, 51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476849563),
(172, 40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476851685),
(173, 40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476851691),
(174, 39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476851727),
(175, 39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476851944),
(176, 39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476852001),
(177, 42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476852143),
(178, 42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476852158),
(179, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476865281),
(180, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476876025),
(181, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476877537),
(182, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476878162),
(183, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476879889),
(184, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476880407),
(185, 54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476880425),
(186, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476880475),
(187, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1476881283),
(188, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476895951),
(189, 90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.79 Safari/537.36 Edge/14.14393', 1476895999),
(190, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476938853),
(191, 43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476967546),
(192, 79, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476971152);

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
(1, 'company_name', 'Myfair''s Wallet '),
(2, 'default_email', 'anand007555@gmail.com'),
(3, 'contact_address', '<pre>Thank you for purchasing product form our store, you will get some extra commission based on your purchasing amount on your account, please check your account from dashboard. &lt;br&gt; Below are your purchasing details.</pre><br>'),
(4, 'agent_commision', '10'),
(5, 'user_commision', '10'),
(6, 'referral_commision', '10'),
(7, 'admin_commision', '10'),
(8, 'invoice_information', 'Your all payment will be calculate soon, payment details are on your profile. '),
(9, 'invoice_terms', 'Invoice terms and condition'),
(10, 'email_text_product_sales', '<pre>Thank you for purchasing product form our store, you will get some extra commission based on your purchasing amount on your account, please check your account from dashboard. <br> Below are your purchasing details.</pre><br>'),
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

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `amount`, `payment_method`, `payment_method_email`, `currency`, `account_name`, `iban`, `swift`, `bank_name`, `bank_address`, `bank_branch_name`, `bank_provenance`, `bank_country`, `status`, `request_by`, `created_at`, `updated_at`) VALUES
(1, 30, 'paypal', 'none@none.com', 'usd', '', '', '', '', '', '', '', '', 'approve', 4, 0, 0),
(2, 50, 'bank', '', 'usd', 'John Doe', '34345', '34546', 'Dutch bangla bank limited', 'Chowmuhoni, noakhali', 'Chowmuhoni', 'Noakhali', 'Bangladesh', 'decline', 4, 1442659933, 1442659933);

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

--
-- Dumping data for table `recharge`
--

INSERT INTO `recharge` (`id`, `recharge_type`, `recharge_no`, `recharge_date`, `user_id`, `account_no`, `amount`, `acct_id`, `sub_acct_id`, `to_role`, `created_by`, `created_at`, `modified_at`, `email`) VALUES
(32, 'mobile', '99807654', '0000-00-00', 43, '555000999000777', 121212, 43, 13, 11, 43, 1473240875, 1473240875, 'anandsagar007@gmail.com'),
(33, 'mobile', '1212122121', '0000-00-00', 43, '555000999000777', 21212121212, 43, 13, 11, 43, 1473240890, 1473240890, 'anandsagar007@gmail.com'),
(34, 'dth', '2147483647', '0000-00-00', 43, '555000999000777', 12344, 43, 13, 11, 43, 1473241340, 1473241340, 'anandsagar007@gmail.com'),
(35, 'mobile', '242342', '0000-00-00', 43, '555000999000777', 55555555, 43, 13, 11, 43, 1473241389, 1473241389, 'anandsagar007@gmail.com'),
(36, 'mobile', '242342', '0000-00-00', 43, '555000999000777', 55555555, 43, 13, 11, 43, 1473241476, 1473241476, 'anandsagar007@gmail.com'),
(37, 'datacard', '1111', '0000-00-00', 43, '555000999000777', 2222222, 43, 13, 11, 43, 1473242055, 1473242055, 'anandsagar007@gmail.com'),
(38, 'mobile', '1111', '0000-00-00', 43, '555000999000777', 22222, 43, 13, 11, 43, 1473242120, 1473242120, 'anandsagar007@gmail.com'),
(39, 'mobile', '22222', '0000-00-00', 43, '555000999000777', 3333333, 43, 13, 11, 43, 1473242130, 1473242130, 'anandsagar007@gmail.com'),
(40, 'mobile', '3434344', '0000-00-00', 43, '555000999000777', 55555555, 43, 13, 11, 43, 1473242159, 1473242159, 'anandsagar007@gmail.com'),
(41, 'datacard', '2147483647', '0000-00-00', 54, '709288403656429', 3525, 43, 13, 11, 54, 1473242316, 1473242316, 'csagar@gmail.com'),
(42, 'mobile', '112364748', '0000-00-00', 54, '709288403656429', 2110, 43, 13, 11, 54, 1473248761, 1473248761, 'csagar@gmail.com'),
(43, 'mobile', '2147483647', '0000-00-00', 54, '709288403656429', 112, 43, 13, 11, 54, 1473329718, 1473329718, 'csagar@gmail.com'),
(44, 'mobile', '2147483647', '0000-00-00', 54, '709288403656429', 4, 43, 13, 11, 54, 1473329798, 1473329798, 'csagar@gmail.com'),
(45, 'mobile', '2147483647', '0000-00-00', 54, '709288403656429', 60, 43, 13, 11, 54, 1473329856, 1473329856, 'csagar@gmail.com'),
(46, 'mobile', '4', '0000-00-00', 54, '709288403656429', 4, 43, 13, 11, 54, 1473329926, 1473329926, 'csagar@gmail.com'),
(47, 'mobile', '2', '0000-00-00', 43, '555000999000777', 2, 43, 13, 11, 43, 1473330033, 1473330033, 'anandsagar007@gmail.com'),
(48, 'mobile', '2147483647', '0000-00-00', 54, '709288403656429', 10, 43, 13, 11, 54, 1473340708, 1473340708, 'csagar@gmail.com'),
(49, 'mobile', '2147483647', '0000-00-00', 54, '709288403656429', 13, 43, 13, 11, 54, 1473343345, 1473343345, 'csagar@gmail.com'),
(50, 'mobile', '2147483647', '0000-00-00', 54, '709288403656429', 6, 43, 13, 11, 54, 1473343525, 1473343525, 'csagar@gmail.com'),
(51, 'mobile', '2147483647', '0000-00-00', 54, '709288403656429', 54, 43, 13, 11, 54, 1473353541, 1473353541, 'csagar@gmail.com'),
(52, 'dth', '2147483647', '0000-00-00', 54, '709288403656429', 89, 43, 13, 11, 54, 1473353735, 1473353735, 'csagar@gmail.com'),
(53, 'dth', '67', '0000-00-00', 54, '709288403656429', 7, 43, 13, 11, 54, 1473396027, 1473396027, 'csagar@gmail.com'),
(54, 'dth', '99989897788', '0000-00-00', 54, '709288403656429', 1, 43, 13, 11, 54, 1473396380, 1473396380, 'csagar@gmail.com'),
(55, 'dth', '9985986999', '0000-00-00', 54, '709288403656429', 10, 43, 13, 11, 54, 1474104843, 1474104843, 'csagar@gmail.com'),
(56, 'mobile', '998888', '0000-00-00', 54, '709288403656429', 10, 43, 13, 11, 54, 1474107474, 1474107474, 'csagar@gmail.com'),
(57, 'dth', '786567567', '0000-00-00', 54, '709288403656429', 1, 43, 13, 11, 54, 1474132012, 1474132012, 'csagar@gmail.com'),
(58, 'mobile', '78656756999', '0000-00-00', 54, '709288403656429', 10, 43, 13, 11, 54, 1474132912, 1474132912, 'csagar@gmail.com'),
(59, 'mobile', '9008103576', '0000-00-00', 54, '709288403656429', 10, 43, 13, 11, 54, 1474133188, 1474133188, 'csagar@gmail.com'),
(60, 'dth', '9008103576', '0000-00-00', 54, '709288403656429', 10, 43, 13, 11, 54, 1474290248, 1474290248, 'csagar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `rolename` varchar(255) NOT NULL,
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

INSERT INTO `role` (`id`, `rolename`, `parent`, `active`, `permission_id`, `type`, `edit`, `default`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 'Super Admin', 0, 1, 0, 'role_name', 0, 0, 0, 0, 0),
(6, 'Retailor/Reseller', 0, 1, 0, 'role_name', 0, 0, 0, 0, 0),
(8, 'Test_New_User Role', 0, 0, 0, 'role_name', 0, 0, 43, 1465322017, 1465322017),
(9, 'Assistant_Accountant', 0, 1, 0, 'role_name', 0, 0, 43, 1466011013, 1466011013),
(19, 'System Administrator', 0, 1, 0, 'role_name', 0, 0, 43, 1467466622, 1467466622),
(21, 'Recurring Account', 0, 1, 0, 'account_type', 0, 0, 43, 1467490012, 1467490012),
(22, 'admin', 0, 1, 0, 'role_name', 0, 0, 43, 1468132123, 1468132123),
(23, 'customer', 0, 1, 0, 'role_name', 0, 0, 43, 1468132134, 1468132134),
(24, 'agent', 0, 1, 0, 'role_name', 0, 0, 43, 1468132143, 1468132143),
(25, 'Distributor', 0, 1, 0, 'role_name', 0, 0, 43, 1471196986, 1471196986),
(26, 'Credit Based on Request', 0, 1, 0, 'loan_type', 0, 0, 43, 1472260941, 1472260941),
(27, 'Credit From Agent', 0, 1, 0, 'loan_type', 0, 0, 43, 1472261019, 1472261019),
(28, 'Credit From Referrer', 0, 1, 0, 'loan_type', 0, 0, 43, 1472261033, 1472261033),
(29, 'Credit For Highest Transaction', 0, 1, 0, 'loan_type', 0, 0, 43, 1472261045, 1472261045),
(30, 'Daily Credit', 0, 1, 0, 'loan_type', 0, 0, 43, 1472261110, 1472261110),
(31, 'Split', 0, 1, 0, 'voucher_type', 0, 0, 43, 1472489567, 1472489567);

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
  `city_id` int(11) NOT NULL,
  `country` varchar(200) NOT NULL,
  `country_id` int(11) NOT NULL,
  `postal_code` int(20) NOT NULL,
  `national_id` varchar(255) NOT NULL,
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
  `modified_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `row_pass`, `email`, `contactno`, `gender`, `date_of_birth`, `profession`, `street_address`, `area_name`, `area_id`, `city`, `city_id`, `country`, `country_id`, `postal_code`, `national_id`, `passport_no`, `role`, `rolename`, `active`, `online_status`, `user_lastlogin`, `referral_code`, `account_no`, `referredByCode`, `photo`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 'Super', 'Administrator', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'admin@example.com', '01814726811', 'male', '1989-12-12', 'Software Engineer', 'Bengaluru', '', 0, 'Bengaluru', 0, '', 0, 0, '', '', 'admin', '1', 1, 0, 1466928762, 'IBVJORTP', '1111111111111111', 'AAAAAAAAAAA', 'mhshohel_thumb.png', 0, 1430499629, 1431080604),
(4, 'Feroz', 'Ahmed', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'agent@example.com', '01815181584', 'male', '2032-03-04', 'Job Holder', '184/D asad avenue, mohammadpur, dhaka', '', 0, 'Bengaluru', 0, 'Bangladesh', 19, 0, '', '', 'agent', '24', 1, 0, 1442649102, 'GFPV7BS0', '234235423532534523', 'IBVJORTP', 'avatar_thumb.jpg', 1, 1430675701, 1430675701),
(28, 'John', 'Doe', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'wefd@bu.edu', '4534456', 'male', '1989-05-04', 'Web Developer', '184/D asad avenue, mohammadpur, dhaka', '', 0, 'Bengaluru', 0, 'Bangladesh', 19, 0, '', '', 'agent', '24', 1, 1, 1439915582, 'BEFVVAG0', '', 'GFPV7BS0', 'avatar1_thumb.jpg', 1, 1430676050, 1431078100),
(29, 'Mr Apu', 'Sarkar', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'api@nai.com', '3454356', 'male', '2032-12-23', 'Student', 'Mirpur, Dhaka', '', 0, 'Nanjangud', 0, 'Bangladesh', 19, 0, '', '', 'user', '23', 1, 1, 1466135834, 'JOMPWVZT', '12342134123', 'BEFVVAG0', '', 0, 1431022664, 1431080559),
(31, 'Developer', 'Test', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'user@example.com', '01815181584', 'male', '2010-02-04', 'Software Engineer', 'Bengaluru', '', 0, 'Nanjangud', 0, 'India', 19, 0, '', '', 'user', '23', 1, 0, 1472732968, '405972', '', 'IBVJORTP', '', 0, 1440004508, 1440004508),
(32, 'Andrew', 'Alexander', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'andrew@gmail.com', '354645', 'male', '1934-03-05', 'Software Engineer', '234, Aladin Road, Barlin', '', 0, 'Gadaga', 0, 'Germany', 57, 0, '', '', 'agent', '24', 1, 0, 0, '198564', '', '', '', 4, 1441470244, 1441470244),
(33, 'C & F', 'Karnataka', 'ac00cc63325cc130174bd4ce3ac9d38751896af2', 'candfkarnataka@gmail.com', 'candfkarnataka@gmail.com', '9980569960', 'male', '1982-09-29', 'Top Manager', 'Marathalli', 'Karnataka', 0, 'Bengaluru, Karnataka', 10, 'India', 105, 560010, '', '', 'admin', '22', 1, 0, 1466133824, 'SRDUZXDX', '55500009991777', 'Anand', 'IMG_6005_thumb.JPG', 1, 1460192464, 1462113262),
(34, 'Distributor', 'APRIL', '396ab3db11da08e04c6756b9e5402acfe986deb2', 'Test1234$', 'info@myfairservice.com', '9980569960', 'male', '1990-01-01', 'Distributor', 'Chamraj Nagar', '', 0, '', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 1, 1463749755, '430176', '', '', '', 33, 1460288161, 1471178411),
(35, 'New User', 'Chamraj Nagar', '9bc34549d565d9505b287de0cd20ac77be1d3f2c', 'test1234', 'chamraj@gmail.com', '9980569960', 'male', '1990-01-01', 'chamraj User', 'chamraj nagar', '', 0, 'Chandakawadi, chamraj nagar', 0, 'India', 105, 0, '', '', 'user', '23', 1, 0, 1460290711, '646853925480', '596965430177328', '198564', '', 0, 1460288292, 1462113591),
(36, 'Chamu', 'Raju', '9bc34549d565d9505b287de0cd20ac77be1d3f2c', 'test1234', 'cham2@gmail.com', '9980569960', 'male', '1990-01-01', 'Engineer', 'Mandya', '', 0, 'Mandya', 0, 'India', 105, 570015, '12345 3343 1928374', 'J123102938', 'user', '23', 1, 0, 1461977458, '721405463997', '372416998506712', '646853925480', '', 0, 1460289823, 1462113554),
(38, 'Narendra', 'Modi', '9c5f407a3010e03cdc9973baa198bfe0027fb5b9', 'naren@gmail.com', 'naren@gmail.com', '9980569960', 'male', '1990-01-01', 'Politician', 'Gujrat', '', 0, 'Gandinagar', 0, 'India', 105, 0, '', '', 'user', '23', 1, 0, 1464977182, '157894', '555000999123459', '721405463997', '', 0, 1461979195, 1462113534),
(39, 'Agent', 'Amarnath', '43342678b9b9cfdb053397537186f6117c923a7b', 'amarnath@gmail.com', 'amarnath@gmail.com', '9980569960', 'male', '1990-01-01', 'Agent Amarnath', 'Chennai', '', 0, '', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 1476852001, '473519', '13566734234543634543', '157894', 'bentley640_640x480_thumb.jpg', 33, 1462025992, 1462025992),
(40, 'User', 'Amarnath', 'e3bb8f76248bc66945469a1c562d9c812019d4ff', 'useramar@gmail.com', 'useramar@gmail.com', '9980569960', 'male', '1990-01-01', 'Public', 'Gadaga', '', 0, 'Gadaga, Karnataka', 0, 'India', 105, 0, '', '', 'user', '23', 1, 0, 1476851691, '432810', '555000999123458', 'SRDUZXDX', '', 0, 1462026289, 1462113485),
(41, 'Sharan', 'Actor', '7cf82eda089bbf6770342cc9738f08e9a3642da6', 'sharan@gmail.com', 'sharan@gmail.com', '9980569960', 'male', '1990-01-01', 'Actor under agent ref code', 'Hubbali', '', 0, 'Hubbali', 0, 'Bangladesh', 19, 0, '', '', 'user', '23', 1, 0, 1462114550, '539481', '555000999123457', '432810', '', 0, 1462026965, 1462026965),
(42, 'Shruthi', 'Actor', 'ebcd2410402d6a6609bf2847ab6cff406ad29b29', 'Shruthi@gmail.com', 'Shruthi@gmail.com', '9980569960', 'female', '1990-01-01', 'Actor', 'Kerala', '', 0, 'Hubbali', 0, 'Kerala', 105, 0, '', '', 'user', '23', 1, 0, 1476852158, '378045', '555000999123456', '473519', '', 0, 1462027114, 1462027114),
(43, 'Anand', 'Sagar', '5fba61a8c7a2240fc28f6e5a621696ffb39221da', '', 'anandsagar007@gmail.com', '9980569960', 'male', '1990-01-01', 'Super Power Administrator', 'Bengaluru', '', 0, 'Bengaluru', 0, 'India', 105, 0, '', '', 'admin', '22', 1, 0, 1476967546, 'RNWUJ3QC', '555000999000777', '378045', 'IMG_6089_thumb.JPG', 33, 1462070784, 1462071131),
(44, 'Distributor', 'Anand', '3d53074b8ceb455f1c0aa0b0acbdc4caffa2956b', 'danand@gmail.com', 'danand@gmail.com', '9980569960', 'male', '1990-01-01', 'Distributor', 'India', '', 0, 'Bengaluru', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '608459', '', '', '', 43, 1462072918, 1462072918),
(45, 'Retailor', 'Anand', '38e8f3c7ee0e911fb96285a34c477aca6fc94849', 'ranand@gmail.com', 'ranand@gmail.com', '9980569960', 'female', '1990-01-01', 'Retailor', 'Hubbali', '', 0, 'Bengaluru', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '196834', '', '', '', 43, 1462073078, 1462073078),
(46, 'Retailor', 'Sukumar', '78bedf1202385fac6831539a9a6beb18ce762880', 'esukumar@gmail.com', 'esukumar@gmail.com', '9980569960', 'male', '1990-01-01', 'Retailor', 'Davanagere', 'Bengaluru', 0, 'Davanagere', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '287435', '', '', '', 43, 1462079373, 1462079373),
(47, 'Retailor', 'Ramu', '627201b27b15a661e22dd7c21d66c50006e2709a', 'rramu@gmail.com', 'rramu@gmail.com', '990', 'female', '1990-01-01', 'Retailor', 'Mysuru', '', 0, 'Mysuru', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 1462114078, '418503', '', '', '', 43, 1462079472, 1462079472),
(48, 'Disributor', 'Dhanush', '0d1a16102d57adff7912fc0dc631ac563df1fb49', 'ddhanush@gmail.com', 'ddhanush@gmail.com', '9', 'male', '1990-01-01', 'ddhanush@gmail.com', 'ddhanush@gmail.com', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 1, 1, 1466133601, '645079', '', 'RNWUJ3QC', '', 43, 1462079947, 1462079947),
(49, 'C&F', 'Kumar', '75fc39bd36f32528e1808155228c4cffc129438c', 'c&fkumar@gmail.com', 'c&fkumar@gmail.com', '99', 'male', '1990-09-09', 'C and F', 'Mangaluru', '', 0, '', 0, 'India', 105, 0, '', '', 'admin', '22', 1, 0, 1462082790, '487356', '', '123456', '', 43, 1462081329, 1462081329),
(50, 'Agent', 'Kumar', '11f9dfadce70cb74f54b6cfdf320efadc0db8c68', 'akumar@gmail.com', 'akumar@gmail.com', '9980569960', 'male', '1990-01-01', 'Agent Kumar', 'Hassan', '', 0, '', 0, 'India', 105, 0, '', '', 'agent', 'Retailor/Reseller', 1, 0, 1468086751, '749685', '085316792044637', '12311233', '', 43, 1462081596, 1466971597),
(51, 'Vivek', 'Anand', '8fd3a049e1e38db868bcc572e5625d7dbe5c82ef', 'vivek@gmail.com', 'vivek@gmail.com', '9980569960', 'male', '1990-01-01', 'pos_outlets', 'Mysuru', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 1, 1, 1476849563, '864903', '601179964725450', '378045', '', 0, 1462568220, 1463625187),
(52, 'Warehouse', 'Sagar', 'f27b53da9eb3a8b21f8765a7b9c719d34a2d227a', 'whsagar@gmail.com', 'whsagar@gmail.com', '9980569960', 'male', '1990-01-01', 'warehouse', 'Kalburgi', '', 0, 'Basavakalyan', 0, 'India', 105, 0, '', '', 'admin', '22', 1, 1, 1466928856, '082967', '872924115856730', '864903', '', 0, 1463544052, 1463544524),
(53, 'Retailer', 'Sagar', '5a38e3f26af04db3a9a2072c85e4b533b1c8073e', 'rsagar@gmail.com', 'rsagar@gmail.com', '9980569960', 'female', '1990-01-01', 'retailor', 'Gadaga', '', 0, 'Gadaga, Karnataka', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 1470223728, '329164', '848656337290954', '082967', '', 0, 1463621496, 1464027780),
(54, 'Customer', 'Sagar', '247197bcea389dd9def60d55a44959609464f792', 'csagar@gmail.com', 'csagar@gmail.com', '9980569960', 'male', '1990-01-01', 'customer', 'Bengaluru', '', 0, 'Kormangla', 0, 'India', 105, 0, '', '', 'user', '23', 1, 0, 1476880425, '861203', '709288403656429', 'RNWUJ3QC', '', 0, 1463623369, 1464027476),
(55, 'Supplier', 'Sagar', '57cca5b2951795125a4336281b7da7725e7ad11c', 'ssagar@gmail.com', 'ssagar@gmail.com', '9980569960', 'male', '1990-01-01', 'supplier', 'Karwara', '', 0, 'Dhakshina Kannada', 0, 'India', 105, 0, '', '', 'user', '23', 1, 0, 1466966494, '693705', '416382982507304', '082967', '', 0, 1463624382, 1464027888),
(75, 'Assets', 'Company', 'a5a2e953554e3045a44ff082e20e9361fbd83fa7', '', 'assets@myfairservice.com', '', 'male', NULL, '', '', '', 0, '', 0, 'India', 105, 0, '', '', 'admin', '22', 1, 1, 1464671618, 'RJMQQDUY', '555555555555555', '', '', 43, 1464626391, 1464626391),
(76, 'Liabilities', 'Company', '3abca94f45675c675388ef13fb4c55e11cee5547', '', 'liabilities@myfairservice.com', '', 'male', NULL, '', '', '', 0, '', 0, 'India', 105, 0, '', '', 'admin', '22', 1, 0, 0, '8DS6HD2E', '444444444444444', '', '', 43, 1464627032, 1464627032),
(77, 'Cashier', 'Company', '7e8f844c0e5697cf83783d9c87253e954a11ee11', '', 'cashier@myfairservice.com', '', 'male', NULL, '', '', '', 0, '', 0, 'India', 105, 0, '', '', 'admin', '22', 1, 0, 0, 'UN2MNT6B', '333333333333333', '', '', 43, 1464627074, 1464627074),
(78, 'Capital', 'Company', 'c0736bf8e263d7ca74888a32aae4637c8271acf3', '', 'capital@myfairservice.com', '9980569960', 'male', '', '', '', '', 0, '', 0, 'India', 105, 0, '', '', 'admin', 'Assistant_Accountant', 1, 0, 0, 'I0LFYVSK', '222222222222222', '', '', 43, 1464627106, 1466971418),
(79, 'Cash Dispatcher', 'Company', 'f713cb77a57236c4b20d66baf99243fee592bdab', 'cash_dispatcher@myfairservice.com', 'cash_dispatcher@myfairservice.com', '9980569960', 'male', '', 'Cash Dispatcher', 'Consumer1st', 'Corporate Office', 0, '', 0, 'India', 105, 0, '', '', 'admin', 'Assistant_Accountant', 1, 1, 1476971152, 'AAAAAAAA', '1111111111111111', '', '', 43, 1464627172, 1466971440),
(83, 'Sahukar', 'chennaiyya', 'e7ee86c219365c3096913c2bb58945928ca1431a', 'sahukar3@gmail.com', 'sahukar3@gmail.com', '9980569960', 'male', '1990-01-01', 'customer', 'Indra Nagar', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 1, 1, 1466134028, '723586', '974932018185273', '473519', '', 0, 1464976565, 1464976565),
(84, 'Doddanna', 'Distributor', 'cbbf44ff2763e5cc6aa8a0caa7709a56ab7a8f79', 'dd@gmail.com', 'dd@gmail.com', '9980569960', 'male', '1990-01-01', 'distributor', 'Channaraya Patna', '', 0, 'test', 0, 'India', 105, 0, '', '', 'user', 'Retailor/Reseller', 1, 1, 1468134874, '974851', '439769101230488', '723586', '', 0, 1464976773, 1468132266),
(86, 'New Sagr', 'Test Role', '25bb17c1b0f71c56af4629727a34d9877c05fcca', '', 'testanand@gmail.com', '', 'male', NULL, '', '', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 1, 0, 0, 'AXGYM0RS', '', '', '', 43, 1465323669, 1465323669),
(87, 'Again test', 'Sagar', '3477a87ceab4b8f2f03a2104d4f9649f9ad431b6', '', 'again@gmail.com', '88756475857', 'male', '', '', '', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 1, 0, 0, '17JZVIYK', '', '', '', 43, 1465324834, 1465325727),
(88, 'New', 'Gen', 'da85d919def9f927c06748c59c5ee2da2767ae03', 'newgen@gmail.com', 'newgen@gmail.com', '9980569960', 'male', '1990-01-01', 'customer', 'Bengaluru', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 1, 1, 1466136095, '251438', '678422013768515', '861203', '', 0, 1466134523, 1466968891),
(89, 'Satish', 'Patils', 'e031c8c2707ce55f449935e3cd2068d84d10b0fc', '', 'sp@gmail.com', '9980569960', 'male', '', '', '', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 1, 1, 1476822453, 'MKGO9H5O', '5593182788888888', '778273', '', 43, 1466557520, 1466971386),
(90, 'Agent Satish', 'Patil', 'a6973779db1f5f4cc2867fb64f5f49cc6f42a6e7', 'asp@gmail.com', 'asp@gmail.com', '9980569960', 'male', '2010-01-01', 'Agent/Vendor', 'Kalaburgi', '', 0, '', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 1, 1476895999, '415360', '001846198739735', 'SRDUZXDX', '', 89, 1466558185, 1471164196),
(91, 'TestChamu', 'Agent chandra', 'e11c03a0b462b0aeb482741ee40bf2f8d3e2952f', 'aTestChamu@gmail.com', 'aTestChamu@gmail.com', '1212121212', 'male', '2001-01-01', 'ok', 'ij', '', 0, '', 0, 'India', 105, 0, '', '', 'agent', 'Assistant_Accountant', 1, 1, 1466966125, '420659', '659438317289751', 'SRDUZXDX', '', 43, 1466965441, 1466968015),
(92, 'TestMobile', 'Mobile lastname', '92be91f6a2cc7df67d5b6ead9e312f5c1e671e90', 'myfair@gmail.com', 'myfair@gmail.com', '9980569960', 'male', '2010-01-01', 'distributor', 'Hebbal', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '051239', '829138429660075', '082967', '', 0, 1467538846, 1467538846),
(96, 'Bhavya', 'Sagar', '5f7e014d32ddb2a963fa8d43564d03b45bfa7d3e', 'b@gmail.com', 'b@gmail.com', '9008103576', 'female', '2010-01-01', 'stockpoints', 'Mandya', '', 0, 'Pandavapura', 0, 'India', 105, 0, '', '', 'user', '23', 2, 0, 0, '789326', '953168149307254', '749685', '', 0, 1467543432, 1474201983),
(97, 'Distributor', 'Dinesh', 'adfbe12e43054614d71196ef80e1931fc18a240b', 'ddinesh@gmail.com', 'ddinesh@gmail.com', '998029838929', 'male', '1990-01-01', 'Retailor', 'Mandya', '', 0, '', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '257463', '950218984536314', 'SRDUZXDX', 'MS4_thumb.jpg', 43, 1471205929, 1471205929),
(98, 'Retailor', 'Rustum', 'b61598b9d6e91ebddf763d3b10cf483e061388d1', 'rrustum@gmail.com', 'rrustum@gmail.com', '234234', 'male', '1990-06-08', 'Shop Keeper', 'Mangaluru', '', 0, '', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '164379', '973014805628796', 'SRDUZXDX', 'MS1_thumb.jpg', 43, 1471206319, 1471206319),
(99, 'Retail', 'Manju', '34dd33e7c6bf81aaac78f247bf7dd8850ddefbc2', 'rmanju@gmail.com', 'rmanju@gmail.com', '7656756758', 'male', '2001-01-01', 'Tailor', 'Davanagere', '', 0, 'Babuji Nagara', 0, 'India', 105, 0, '', '', 'agent', '24', 1, 0, 1471209244, '714953', '017569243288164', 'RNWUJ3QC', 'services_event-planning_thumb.jpg', 43, 1471208336, 1472408326),
(103, 'Chamundi', 'Tayi', 'f46e5d802384c85043042c014a471c186d0c8331', 'consumerfirst.services@gmail.com', 'consumerfirst.services@gmail.com', '9008103576', 'female', '1990-01-01', 'warehouse', 'Pandavapura', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '251497', '184124670929383', 'RNWUJ3QC', '', 0, 1475431714, 1475431714),
(105, 'Sudha', 'Murthy', '30ee16f2593911dea78dc3cac47673009d331c63', 'consumerfirst.technoservices@gmail.com', 'consumerfirst.technoservices@gmail.com', '9980569960', 'female', '1990-01-01', 'warehouse', 'Dharwad', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '420768', '819475357984026', 'RNWUJ3QC', '', 0, 1475434460, 1475434460),
(108, 'Narayan', 'Murthy', '84d1a9b73c181294a25febe806716b10d642dd0a', 'noreply.consumer1st@gmail.com', 'noreply.consumer1st@gmail.com', '9980569960', 'male', '1909-01-01', 'warehouse', 'ok', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '847062', '742137125596698', 'RNWUJ3QC', '', 0, 1475435588, 1475435588),
(111, 'Narayan', 'Murthy', 'fad28f0eac6e63943812a4b745f1e003d575628d', 'mr.anandsagar@ymail.com', 'mr.anandsagar@ymail.com', '9980569960', 'male', '1909-01-01', 'warehouse', 'ok', '', 0, '', 0, 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '421873', '710870233165964', 'RNWUJ3QC', '', 0, 1475436108, 1475436108);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `voucher_name` varchar(255) NOT NULL,
  `identity_id` varchar(255) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `acct_id` int(11) NOT NULL,
  `sub_acct_id` int(11) NOT NULL,
  `amount` double NOT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `acct_categories`
--
ALTER TABLE `acct_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=580;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
