-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2016 at 10:58 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mywallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `role` varchar(60) COLLATE utf8_bin NOT NULL,
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

INSERT INTO `accounts` (`id`, `user_id`, `email`, `role`, `account_no`, `debit`, `credit`, `amount`, `points_mode`, `challan`, `used`, `paid_to`, `pay_type`, `tranx_id`, `active`, `created_at`, `modified_at`) VALUES
(1, '43', '', '22', '555000999000777', 0, 25000, 25000, 'wallet', 'no_invoice.jpg', 'yes', '', '63', 'Transactions Type .withdraw for the Challan No''.for personal use''', 0, 1478432459, 1478432459),
(2, '43', '', '22', '555000999000777', 0, 25000, 25000, 'wallet', 'no_invoice.jpg', 'no', '', '63', 'Transactions Type .withdraw for the  Challan No''.for personal use''', 0, 1478432459, 1478432459),
(3, '79', '', '9', '1111111111111111', 200000, 0, 200000, 'wallet', 'no_invoice1_thumb.jpg', 'yes', '', '63', 'Transactions Type .deposit for the Challan No''.testing on 6th Nov''', 0, 1478432947, 1478432947),
(4, '54', '', '23', '709288403656429', 200000, 0, 200000, 'wallet', 'no_invoice1_thumb.jpg', 'no', '', '63', 'Transactions Type .deposit for the  Challan No''.testing on 6th Nov''', 0, 1478432947, 1478432947),
(5, '79', '', '9', '1111111111111111', 0, 500000, 500000, 'wallet', 'no_invoice1_thumb.jpg', 'yes', '', '63', 'Transactions Type .deposit for the Challan No''.My savings''', 0, 1478433136, 1478433136),
(6, '54', '', '23', '709288403656429', 500000, 0, 500000, 'wallet', 'no_invoice1_thumb.jpg', 'no', '', '63', 'Transactions Type .deposit for the  Challan No''.My savings''', 0, 1478433136, 1478433136),
(7, '79', '', '9', '1111111111111111', 125000, 0, 125000, 'wallet', 'no_invoice.jpg', 'yes', '', '63', 'Transactions Type .withdraw for the Challan No''.Want immediate cash''', 0, 1478433239, 1478433239),
(8, '54', '', '23', '709288403656429', 0, 125000, 125000, 'wallet', 'no_invoice.jpg', 'no', '', '63', 'Transactions Type .withdraw for the  Challan No''.Want immediate cash''', 0, 1478433239, 1478433239),
(9, '79', '', '9', '1111111111111111', 500, 0, 500, 'wallet', 'no_invoice.jpg', 'yes', '', '63', 'Transactions Type .withdraw for the remarks''.need it''', 0, 1478433419, 1478433419),
(10, '54', '', '23', '709288403656429', 0, 500, 500, 'wallet', 'no_invoice.jpg', 'no', '', '63', 'Transactions Type .withdraw for the remarks''.need it''', 0, 1478433419, 1478433419),
(11, '54', '', '23', '709288403656429', 10, 0, 10, 'wallet', '', 'no', '00', '50', 'Referral Bonus', 0, 1478440031, 1478440031),
(12, '117', '', '23', '741467618095203', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus', 0, 1478440031, 1478440031),
(13, '117', '', '23', '741467618095203', 0, 1200, 1200, 'wallet', '', 'yes', '00', '50', 'Sponsorship Fees for Referral ', 0, 1478440031, 1478440031),
(14, '54', '', '23', '709288403656429', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus for $email ', 0, 1478453959, 1478453959),
(15, '118', '', '23', '841761250675934', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus for $email ', 0, 1478453959, 1478453959),
(16, '54', '', '23', '709288403656429', 0, 1020, 1020, 'wallet', '', 'yes', '00', '50', 'Sponsorship Fees for Referral of $email  ', 0, 1478453959, 1478453959),
(17, '54', '', '23', '709288403656429', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus for $email ', 0, 1478454349, 1478454349),
(18, '118', '', '23', '841761250675934', 20, 0, 20, 'wallet', '', 'no', '00', '50', 'Referral Bonus for new978102@gmail.com', 0, 1478454349, 1478454349),
(19, '54', '', '23', '709288403656429', 0, 1020, 1020, 'wallet', '', 'yes', '00', '50', 'Sponsorship Fees for Referral new978102@gmail.com', 0, 1478454349, 1478454349),
(20, '90', '', '24', '001846198739735', 35, 0, 35, 'wallet', '', 'yes', '118', '57', 'Recieved Payment from ''978102'' for the Invoice ID-40', 0, 1478455368, 1478455368),
(21, '118', '', '24', '841761250675934', 0, 35, 35, 'wallet', '', 'yes', '90', '57', 'Paid to ''415360'' for the Invoice ID-40', 0, 1478455368, 1478455368),
(22, '90', '', '24', '001846198739735', 10000, 0, 10000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''861203'' for the Invoice ID-41', 0, 1478455685, 1478455685),
(23, '54', '', '24', '709288403656429', 0, 10000, 10000, 'wallet', '', 'yes', '90', '17', 'Paid to ''415360'' for the Invoice ID-41', 0, 1478455686, 1478455686),
(24, '90', '', '24', '001846198739735', 0, 0, 0, 'wallet', '', 'no', '54', '17', 'Added Benefits/loyality For The Purchase Invoice ID - 41 ', 0, 1478455686, 1478455686),
(25, '54', '', '24', '709288403656429', 0, 0, 0, 'wallet', '', 'no', '90', '17', 'Seller Benefits for Invoice ID-41', 0, 1478455686, 1478455686),
(26, '54', '', 'user', '709288403656429', 0, 10000, 10000, 'wallet', 'no_invoice.jpg', 'no', '90', '17', 'Paid wallet to 415360 for the Invoice ID - 41', 0, 1478455686, 1478455686),
(27, '54', '', 'user', '709288403656429', 1500, 0, 1500, 'wallet', 'no_invoice.jpg', 'no', '90', '17', 'Business Transaction Commision for Purchase Invoice ID - 41', 0, 1478455686, 1478455686),
(28, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-42', 0, 1478456272, 1478456272),
(29, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-42', 0, 1478456272, 1478456272),
(30, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-43', 0, 1478456569, 1478456569),
(31, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-43', 0, 1478456569, 1478456569),
(32, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-44', 0, 1478456702, 1478456702),
(33, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-44', 0, 1478456702, 1478456702),
(34, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-45', 0, 1478456830, 1478456830),
(35, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-45', 0, 1478456830, 1478456830),
(36, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-46', 0, 1478457104, 1478457104),
(37, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-46', 0, 1478457104, 1478457104),
(38, '33', '', '22', '55500009991777', 10, 0, 10, 'wallet', '', 'no', '33', '17', 'Cleint-Referrals Business loyalty for Invoice ID-46', 0, 1478457104, 1478457104),
(39, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-47', 0, 1478457447, 1478457447),
(40, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-47', 0, 1478457447, 1478457447),
(41, '33', '', '22', '55500009991777', 10, 0, 10, 'wallet', '', 'no', '33', '17', 'Cleint-Referrals Business loyalty for Invoice ID-47', 0, 1478457447, 1478457447),
(42, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-48', 0, 1478458538, 1478458538),
(43, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-48', 0, 1478458538, 1478458538),
(44, '33', '', '22', '55500009991777', 10, 0, 10, 'wallet', '', 'no', '33', '17', 'Cleint-Referrals Business loyalty for Invoice ID-48', 0, 1478458538, 1478458538),
(45, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-49', 0, 1478483999, 1478483999),
(46, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-49', 0, 1478483999, 1478483999),
(47, '33', '', '22', '55500009991777', 10, 0, 10, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-49', 0, 1478483999, 1478483999),
(48, '90', '', '22', '001846198739735', 0, 0, 0, 'wallet', '', 'no', '54', '17', 'Added Benefits/loyality For The Purchase Invoice ID - 49 ', 0, 1478483999, 1478483999),
(49, '54', '', '22', '709288403656429', 0, 0, 0, 'wallet', '', 'no', '90', '17', 'Seller Benefits for Invoice ID-49', 0, 1478483999, 1478483999),
(50, '54', '', 'user', '709288403656429', 0, 1000, 1000, 'wallet', 'no_invoice.jpg', 'no', '90', '17', 'Paid wallet to 415360 for the Invoice ID - 49', 0, 1478483999, 1478483999),
(51, '54', '', 'user', '709288403656429', 10, 0, 10, 'wallet', 'no_invoice.jpg', 'no', '90', '17', 'Business Transaction Commision for Purchase Invoice ID - 49', 0, 1478483999, 1478483999),
(52, '90', '', '24', '001846198739735', 2000, 0, 2000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-50', 0, 1478486826, 1478486826),
(53, '54', '', '24', '709288403656429', 0, 2000, 2000, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-50', 0, 1478486826, 1478486826),
(54, '33', '', '22', '55500009991777', 20, 0, 20, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-50', 0, 1478486826, 1478486826),
(55, '90', '', '22', '001846198739735', 22, 0, 22, 'wallet', '', 'no', '54', '68', 'Added Benefits For The Purchase Invoice ID - 50 ', 0, 1478486826, 1478486826),
(56, '54', '', '22', '709288403656429', 10, 0, 10, 'wallet', '', 'no', '90', '68', 'Seller Benefits for Invoice ID-50', 0, 1478486827, 1478486827),
(57, '90', '', '22', '001846198739735', 0, 60, 60, 'wallet', '', 'yes', '54', '17', 'Commission For The Purchase Invoice ID - 50 ', 0, 1478486827, 1478486827),
(58, '54', '', '22', '709288403656429', 0, 20, 20, 'wallet', '', 'yes', '90', '17', 'Seller Benefits for Invoice ID-50', 0, 1478486827, 1478486827),
(59, '90', '', '24', '001846198739735', 100, 0, 100, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from ''Customer'' for the Invoice ID-51', 0, 1478487607, 1478487607),
(60, '54', '', '24', '709288403656429', 0, 100, 100, 'wallet', '', 'yes', '90', '17', 'Paid to ''Agent Satish'' for the Invoice ID-51', 0, 1478487607, 1478487607),
(61, '33', '', '22', '55500009991777', 1, 0, 1, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-51', 0, 1478487607, 1478487607),
(62, '90', '', '24', '001846198739735', 1.1, 0, 1.1, 'wallet', '', 'no', '54', '68', 'Added Benefits For The Purchase Invoice ID - 51 ', 0, 1478487607, 1478487607),
(63, '54', '', '23', '709288403656429', 0.5, 0, 0.5, 'wallet', '', 'no', '90', '68', '$seller_role Benefits for Invoice ID-51', 0, 1478487607, 1478487607),
(64, '90', '', '24', '001846198739735', 0, 3, 3, 'wallet', '', 'yes', '54', '17', 'Commission from 24 for Invoice ID - 51 ', 0, 1478487607, 1478487607),
(65, '54', '', '23', '709288403656429', 0, 1, 1, 'wallet', '', 'yes', '90', '17', '$seller_role Benefits for Invoice ID-51', 0, 1478487607, 1478487607),
(66, '90', '', '24', '001846198739735', 100, 0, 100, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from agent-Customer for the Invoice ID-52', 0, 1478489031, 1478489031),
(67, '54', '', '24', '709288403656429', 0, 100, 100, 'wallet', '', 'yes', '90', '17', 'Paid to ''customer-Agent Satish'' for the Invoice ID-52', 0, 1478489031, 1478489031),
(68, '33', '', '22', '55500009991777', 1, 0, 1, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-52', 0, 1478489031, 1478489031),
(69, '90', '', '24', '001846198739735', 100, 0, 100, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from agent-Customer for the Invoice ID-53', 0, 1478489054, 1478489054),
(70, '54', '', '24', '709288403656429', 0, 100, 100, 'wallet', '', 'yes', '90', '17', 'Paid to ''customer-Agent Satish'' for the Invoice ID-53', 0, 1478489054, 1478489054),
(71, '33', '', '22', '55500009991777', 1, 0, 1, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-53', 0, 1478489054, 1478489054),
(72, '90', '', '24', '001846198739735', 1.1, 0, 1.1, 'wallet', '', 'no', '54', '68', 'agentCommission for Invoice ID -53', 0, 1478489054, 1478489054),
(73, '54', '', '23', '709288403656429', 0.5, 0, 0.5, 'wallet', '', 'no', '90', '68', 'customer commission for Invoice ID-53', 0, 1478489054, 1478489054),
(74, '90', '', '24', '001846198739735', 0, 3, 3, 'wallet', '', 'yes', '54', '17', 'Commission fromagentfor Invoice ID -53', 0, 1478489054, 1478489054),
(75, '54', '', '23', '709288403656429', 0, 1, 1, 'wallet', '', 'yes', '90', '17', 'customer commission for the Invoice ID-53', 0, 1478489054, 1478489054),
(76, '90', '', '24', '001846198739735', 100, 0, 100, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from customer-Customer for the Invoice ID-54', 0, 1478489375, 1478489375),
(77, '54', '', '24', '709288403656429', 0, 100, 100, 'wallet', '', 'yes', '90', '17', 'Paid to ''agent-Agent Satish'' for the Invoice ID-54', 0, 1478489375, 1478489375),
(78, '33', '', '22', '55500009991777', 1, 0, 1, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-54', 0, 1478489375, 1478489375),
(79, '90', '', '24', '001846198739735', 1.1, 0, 1.1, 'wallet', '', 'no', '54', '68', 'agentCommission for Invoice ID -54', 0, 1478489375, 1478489375),
(80, '54', '', '23', '709288403656429', 0.5, 0, 0.5, 'wallet', '', 'no', '90', '68', 'customer commission for Invoice ID-54', 0, 1478489376, 1478489376),
(81, '90', '', '24', '001846198739735', 0, 3, 3, 'wallet', '', 'yes', '54', '17', 'Commission from -agent-for Invoice ID -54', 0, 1478489376, 1478489376),
(82, '54', '', '23', '709288403656429', 0, 1, 1, 'wallet', '', 'yes', '90', '17', 'Commission from -customer-for Invoice ID -54', 0, 1478489376, 1478489376),
(83, '90', '', '24', '001846198739735', 1000, 0, 1000, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from customer-Customer for the Invoice ID-55', 0, 1478489612, 1478489612),
(84, '54', '', '24', '709288403656429', 0, 1000, 1000, 'wallet', '', 'yes', '90', '17', 'Paid to ''agent-Agent Satish'' for the Invoice ID-55', 0, 1478489612, 1478489612),
(85, '33', '', '22', '55500009991777', 10, 0, 10, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-55', 0, 1478489612, 1478489612),
(86, '90', '', '24', '001846198739735', 11, 0, 11, 'wallet', '', 'no', '54', '68', 'agent- commission for Invoice ID -55', 0, 1478489612, 1478489612),
(87, '54', '', '23', '709288403656429', 5, 0, 5, 'wallet', '', 'no', '90', '68', 'customer- commission for Invoice ID-55', 0, 1478489612, 1478489612),
(88, '90', '', '24', '001846198739735', 0, 30, 30, 'wallet', '', 'yes', '54', '17', 'Commission from -agent-for Invoice ID -55', 0, 1478489612, 1478489612),
(89, '54', '', '23', '709288403656429', 0, 10, 10, 'wallet', '', 'yes', '90', '17', 'Commission from -customer-for Invoice ID -55', 0, 1478489612, 1478489612),
(90, '90', '', '24', '001846198739735', 100, 0, 100, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from customer-Customer for the Invoice ID-56', 0, 1478575950, 1478575950),
(91, '54', '', '24', '709288403656429', 0, 100, 100, 'wallet', '', 'yes', '90', '17', 'Paid to ''agent-Agent Satish'' for the Invoice ID-56', 0, 1478575950, 1478575950),
(92, '33', '', '22', '55500009991777', 1, 0, 1, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-56', 0, 1478575950, 1478575950),
(93, '90', '', '24', '001846198739735', 1.1, 0, 1.1, 'wallet', '', 'no', '54', '68', 'agent- commission for Invoice ID -56', 0, 1478575950, 1478575950),
(94, '54', '', '23', '709288403656429', 0.5, 0, 0.5, 'wallet', '', 'no', '90', '68', 'customer- commission for Invoice ID-56', 0, 1478575950, 1478575950),
(95, '90', '', '24', '001846198739735', 0, 3, 3, 'wallet', '', 'yes', '54', '17', 'Commission from -agent-for Invoice ID -56', 0, 1478575950, 1478575950),
(96, '54', '', '23', '709288403656429', 0, 1, 1, 'wallet', '', 'yes', '90', '17', 'Commission from -customer-for Invoice ID -56', 0, 1478575950, 1478575950),
(97, '90', '', '24', '001846198739735', 200, 0, 200, 'wallet', '', 'yes', '54', '17', 'Recieved Payment from customer-Customer for the Invoice ID-57', 0, 1478576102, 1478576102),
(98, '54', '', '24', '709288403656429', 0, 200, 200, 'wallet', '', 'yes', '90', '17', 'Paid to ''agent-Agent Satish'' for the Invoice ID-57', 0, 1478576102, 1478576102),
(99, '33', '', '22', '55500009991777', 2, 0, 2, 'wallet', '', 'no', '33', '17', 'Referrals Business benefits for Invoice ID-57', 0, 1478576102, 1478576102),
(100, '90', '', '24', '001846198739735', 2.2, 0, 2.2, 'wallet', '', 'no', '54', '68', 'agent- commission for Invoice ID -57', 0, 1478576102, 1478576102),
(101, '54', '', '23', '709288403656429', 1, 0, 1, 'wallet', '', 'no', '90', '68', 'customer- commission for Invoice ID-57', 0, 1478576102, 1478576102),
(102, '90', '', '24', '001846198739735', 0, 6, 6, 'wallet', '', 'yes', '54', '17', 'Commission from -agent-for Invoice ID -57', 0, 1478576103, 1478576103),
(103, '54', '', '23', '709288403656429', 0, 2, 2, 'wallet', '', 'yes', '90', '17', 'Commission from -customer-for Invoice ID -57', 0, 1478576103, 1478576103),
(104, '00', '', '23', '809214326086791', 100, 0, 100, 'wallet', '', 'no', '00', '69', 'New member welcome offer', 0, 1478577298, 1478577298),
(105, '00', '', '23', '329640328550946', 100, 0, 100, 'wallet', '', 'no', '00', '69', 'New member welcome offer', 0, 1478577347, 1478577347),
(106, '00', '', '23', '570547362980832', 100, 0, 100, 'wallet', '', 'no', '00', '69', 'New member welcome offer', 0, 1478577423, 1478577423);

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
(63, 'SBI-Basavanagar Branch', 59, 'sub', 0, 43, 1476899614, 1476899614),
(64, 'Ledger Accounts Conversions', 0, 'main', 0, 43, 1476983728, 1476983728),
(65, 'Wallet to Cash Conversions', 64, 'sub', 0, 43, 1476983764, 1476983764),
(66, 'Cash to Wallet Conversions', 64, 'sub', 0, 43, 1476983791, 1476983791),
(67, 'Parking fees', 64, 'sub', 0, 43, 1478329027, 1478329027),
(68, 'Commissions to All Pay wallet Transactions', 24, 'sub', 0, 43, 1478484556, 1478484556),
(69, 'New member welcome offer', 24, 'sub', 0, 43, 1478576773, 1478576773);

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
(1, 43, 'Added Anand Sagar as agent', 1477759170),
(2, 43, 'Added  ledger', 1477759656),
(3, 43, 'Blocked Bhavya test from Agent', 1477763038),
(4, 43, 'Unblocked Bhavya test from Agent', 1477763050),
(5, 43, 'Added Agri-sales Commission setup commissions', 1477840974),
(6, 43, 'Added Retailors Commission commissions', 1477841387),
(7, 43, 'Updated Retailors Commission commissions', 1477841411),
(8, 43, 'Blocked Bhavya test from Agent', 1477841667),
(9, 43, 'Unblocked Bhavya test from Agent', 1477841671),
(10, 43, 'Blocked Bhavya test from Agent', 1477841798),
(11, 43, 'Unblocked Bhavya test from Agent', 1477841801),
(12, 43, 'Added Agent doing pay wallet Transaction commissions', 1477937659),
(13, 43, 'Added Testing Agent Commissions commissions', 1478257344),
(14, 43, 'Updated Testing Agent Commissions2 commissions', 1478258263),
(15, 43, 'Updated Testing Agent Commissions2 commissions', 1478258276),
(16, 43, 'Added Warehousing as User-Role', 1478278809),
(17, 43, 'Added test sales POS commissions', 1478328464),
(18, 43, 'Added Parking_operator as User-Role', 1478328736),
(19, 43, 'Added Parking fees Category', 1478329028),
(20, 43, 'Added testref new name as agent', 1478335802),
(21, 43, 'Added Supplier Sagar as agent', 1478336694),
(22, 43, 'Added Retailor Rustum as agent', 1478337363),
(23, 54, 'Added Retailor Rustum as agent', 1478337838),
(24, 54, 'Added Retailor Rustum as agent', 1478339181),
(25, 122, 'Added Bhavya test as agent', 1478339451),
(26, 43, 'Added Stationery Items as User-Role', 1478416856),
(27, 43, 'Added Stationery Items as User-Role', 1478416972),
(28, 43, 'Added Personal Use as User-Role', 1478423725),
(29, 43, 'Added Anand Sagar as agent', 1478424944),
(30, 43, 'Added Anand Sagar as agent', 1478425089),
(31, 43, 'Added Anand Sagar as agent', 1478430301),
(32, 43, 'Added Anand Sagar as agent', 1478430570),
(33, 43, 'Added Anand Sagar as agent', 1478430720),
(34, 43, 'Added Anand Sagar as agent', 1478430742),
(35, 43, 'Added Anand Sagar as agent', 1478430790),
(36, 43, 'Added  ledger', 1478432459),
(37, 54, 'Added Customer Sagar as agent', 1478432669),
(38, 54, 'Added Customer Sagar as agent', 1478432825),
(39, 54, 'Added Customer Sagar as agent', 1478432927),
(40, 79, 'Added  ledger', 1478432948),
(41, 54, 'Added Customer Sagar as agent', 1478433115),
(42, 79, 'Added  ledger', 1478433136),
(43, 54, 'Added Customer Sagar as agent', 1478433177),
(44, 79, 'Added  ledger', 1478433239),
(45, 54, 'Added Customer Sagar as agent', 1478433374),
(46, 79, 'Added  ledger', 1478433419),
(47, 54, 'Added Murthy22 Last Name2 as agent', 1478440032),
(48, 54, 'Added testref new name as agent', 1478453959),
(49, 54, 'Added testref new name as agent', 1478454349),
(50, 118, 'Added testref new name as agent', 1478454796),
(51, 43, 'Updated Testing Agent Commissions2 commissions', 1478456197),
(52, 43, 'Added Commissions to All Pay wallet Transactions Category', 1478484556),
(53, 43, 'Added New member welcome offer Category', 1478576773),
(54, 43, 'Added New Member welcome offer deduction purpose ledger', 1478576820),
(55, 54, 'Unblocked newmember 6 from Agent', 1478577470);

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

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `first_name`, `last_name`, `email`, `tranx_id`, `transaction_type`, `ifsc_code`, `transaction_date`, `postal_code`, `adhaar_no`, `passport_no`, `rolename`, `active`, `referral_code`, `account_no`, `amount`, `referredByCode`, `challan`, `created_by`, `created_at`, `modified_at`) VALUES
(1, 'Anand', 'Sagar', 'anandsagar007@gmail.com', 'deposit through RTGS', 'withdraw', 'SBIN0016336', '1478430720', 0, '', '', '22', 'Pending for Approval', 'ADMIN1001', '555000999000777', 500000, '378045', 'no_invoice1_thumb.jpg', 43, 1478430720, 1478430720),
(2, 'Anand', 'Sagar', 'anandsagar007@gmail.com', 'for personal use', 'withdraw', '', '1478430742', 0, '', '', '22', 'Approved', 'ADMIN1001', '555000999000777', 25000, '378045', 'no_invoice.jpg', 43, 1478430742, 1478432459),
(3, 'Anand', 'Sagar', 'anandsagar007@gmail.com', 'new deposit', 'deposit', 'SBIN0016336', '1478430790', 0, '', '', '22', 'Pending for Approval', 'ADMIN1001', '555000999000777', 12000, '378045', 'no_invoice1_thumb.jpg', 43, 1478430790, 1478430790),
(4, 'Customer', 'Sagar', 'csagar@gmail.com', 'testing', 'withdraw', '', '1478432669', 570018, '474304506900', '', '23', 'Pending for Approval', '861203', '709288403656429', 2500, 'RNWUJ3QC', 'no_invoice.jpg', 54, 1478432669, 1478432669),
(5, 'Customer', 'Sagar', 'csagar@gmail.com', 'jhgvhj', 'withdraw', '', '1478432825', 570018, '474304506900', '', '23', 'Pending for Approval', '861203', '709288403656429', 100, 'RNWUJ3QC', 'no_invoice.jpg', 54, 1478432825, 1478432825),
(6, 'Customer', 'Sagar', 'csagar@gmail.com', 'testing on 6th Nov', 'deposit', 'SBIN0016336', '1478432927', 570018, '474304506900', '', '23', 'Approved', '861203', '709288403656429', 200000, 'RNWUJ3QC', 'no_invoice1_thumb.jpg', 54, 1478432927, 1478432948),
(7, 'Customer', 'Sagar', 'csagar@gmail.com', 'My savings', 'deposit', 'SBIN0016336', '1478433115', 570018, '474304506900', '', '23', 'Approved', '861203', '709288403656429', 500000, 'RNWUJ3QC', 'no_invoice1_thumb.jpg', 54, 1478433115, 1478433136),
(8, 'Customer', 'Sagar', 'csagar@gmail.com', 'Want immediate cash', 'withdraw', '', '1478433177', 570018, '474304506900', '', '23', 'Approved', '861203', '709288403656429', 125000, 'RNWUJ3QC', 'no_invoice.jpg', 54, 1478433177, 1478433239),
(9, 'Customer', 'Sagar', 'csagar@gmail.com', 'need it', 'withdraw', '', '1478433374', 570018, '474304506900', '', '23', 'Approved', '861203', '709288403656429', 500, 'RNWUJ3QC', 'no_invoice.jpg', 54, 1478433374, 1478433419),
(10, 'testref', 'new name', 'testref2@gmail.com', 'tets', 'withdraw', '', '1478454796', 0, '', '', '23', 'Pending for Approval', '978102', '841761250675934', 1, 'ADMIN1001', 'no_invoice.jpg', 118, 1478454796, 1478454796);

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
('00bf2ab4961db411c77a68df0b0826e81cbca0e1', '127.0.0.1', 1478489620, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438393631393b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('01638e760c1ea203c6c3ef70cb91985007526c9e', '127.0.0.1', 1478485360, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438353336303b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('0324b1c1e62cd11b0c11d147bf19c890a59113c9', '127.0.0.1', 1478576740, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363733393b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('083128d98723de03199b3addd95c4e51c5c81478', '::1', 1478489652, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438333831313b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223433223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('0994727ad24aa561e7e90c738374d558aed9d876', '127.0.0.1', 1478576777, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363737373b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('14e80895abc4f417a8ff9e85a82c289a8f324774', '127.0.0.1', 1478579436, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537393433353b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('1575dfc5bd0eb033a341ded737890156c8dcd9bb', '127.0.0.1', 1478577986, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537373938353b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('288579dab73cdb84dabce4cb315e9a5e48149110', '127.0.0.1', 1478484045, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343034343b72656469726563745f617574685f7572697c733a32383a226163636f756e742f62616c616e636573686565745f766965772f3437223b),
('3c618b6b2ddfb794c2b52ccb60d11a6dc1047b67', '127.0.0.1', 1478484493, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343439323b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('45a422e83fb26893c07a996ec19a71935cc3f36a', '127.0.0.1', 1478576598, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363539373b72656469726563745f617574685f7572697c733a32393a2261646d696e5f73657474696e67732f617574686f72697a6174696f6e73223b),
('480e52c8c2793625360d23390a9defb0af381fc4', '127.0.0.1', 1478579328, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537393332373b72656469726563745f617574685f7572697c733a373a2270726f64756374223b),
('4a4f980ed23ffc1dcba0e6631b7787dfeffc196c', '127.0.0.1', 1478483817, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438333831363b),
('5f442e2c34d182b6283d434fc10252ec314967a2', '127.0.0.1', 1478489181, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438393138303b72656469726563745f617574685f7572697c733a32383a226163636f756e742f62616c616e636573686565745f766965772f3732223b),
('606ae4a16930fdcfe7831ffa1f6a6adb3983f46f', '127.0.0.1', 1478487058, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438373035373b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3535223b),
('60c2efb55e9f15fddf3a4c3d2b467552e8c744fb', '127.0.0.1', 1478581759, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383538313735393b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('72f1e4dcd77d23e43afccea52951a16160446c48', '127.0.0.1', 1478484473, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343437323b72656469726563745f617574685f7572697c733a31373a226c65646765722f6164645f6c6564676572223b),
('75d20de8f57bbfd1840ca560d5a420597869fe44', '127.0.0.1', 1478489655, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438393635353b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('762fb8618a485503138949457618af6402523101', '127.0.0.1', 1478579439, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537393433393b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3834223b),
('7779ccec603fe6c9e76a512c0c418f6b4bf69410', '127.0.0.1', 1478575968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537353936373b72656469726563745f617574685f7572697c733a32393a2261646d696e5f73657474696e67732f617574686f72697a6174696f6e73223b),
('7a74b0d59f1d07cec2627b53ded8dc79070180f0', '127.0.0.1', 1478487054, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438373035333b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3536223b),
('7f744682e3d54c7d71d0ef6d06da91deb30a8597', '127.0.0.1', 1478581750, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383538313734393b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3834223b),
('837f748e292f82274f3efa3a084d15e87ad8c0dc', '127.0.0.1', 1478487075, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438373037353b72656469726563745f617574685f7572697c733a32353a226c65646765722f636f6d6d697373696f6e735f766965772f39223b),
('853d67c4bba2524895a7e9d74a3fcbd7aa6c38dc', '127.0.0.1', 1478581856, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383538313835363b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('9560f11c2ca2f7145352e11a8127192c86f184b3', '127.0.0.1', 1478569638, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383536393633373b72656469726563745f617574685f7572697c733a31343a2261646d696e5f73657474696e6773223b),
('957b67a0456510d07b069aa854849fa81794a26b', '127.0.0.1', 1478577495, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537353837313b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32303a226e65776d656d6265723640676d61696c2e636f6d223b733a373a22757365725f6964223b733a333a22313333223b733a343a22726f6c65223b733a343a2275736572223b733a393a226c6f676765645f696e223b623a313b7d),
('9974c0178d4257b71e2e768ff19c6948f51e3873', '127.0.0.1', 1478581852, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383538313835323b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3832223b),
('9bc86864f8406439fca196609fa506a0ca2d6d0c', '127.0.0.1', 1478569647, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383536393634373b72656469726563745f617574685f7572697c733a32393a2261646d696e5f73657474696e67732f617574686f72697a6174696f6e73223b),
('9d9129beab45568ac52991bde57150843c2207c2', '127.0.0.1', 1478487166, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438373136353b72656469726563745f617574685f7572697c733a32333a226c65646765722f706179737065635f6163636f756e7473223b),
('a86aeef2d88fa413f6d8d5185676a4008fada0fe', '127.0.0.1', 1478576831, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363833303b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3832223b),
('af0bb5344afd108def57348b52a3106ee3fe0acb', '127.0.0.1', 1478487029, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438373032383b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('af687fe8e04db61db03bbaf17bc78efb82f181d4', '127.0.0.1', 1478489612, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438333935343b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a31363a2263736167617240676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223534223b733a343a22726f6c65223b733a343a2275736572223b733a393a226c6f676765645f696e223b623a313b7d),
('b631e3980ffb0b32bd3621d4dcdcb72e315c73ee', '127.0.0.1', 1478484479, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343437393b72656469726563745f617574685f7572697c733a32343a226c65646765722f6164645f616363745f63617465676f7279223b),
('b7445539902afbd4c1c9b22f718957e32dda0313', '127.0.0.1', 1478585342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383538353334323b72656469726563745f617574685f7572697c733a32323a226c65646765722f706179737065635f766965772f3834223b),
('b83fd355002b2b82ee33b5009618bb833b81c95c', '127.0.0.1', 1478581859, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383538313835393b72656469726563745f617574685f7572697c733a32323a226c65646765722f706179737065635f766965772f3834223b),
('b97af492643167bce99312a909369c9544039c31', '127.0.0.1', 1478484463, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343436333b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('b9ea4e92821b88ee6cd87c50d2cfe7819e87d756', '127.0.0.1', 1478577980, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537373938303b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3830223b),
('c33964e1c8b18fc82138d4fd513b6ac529fd41c2', '127.0.0.1', 1478487072, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438373037313b72656469726563745f617574685f7572697c733a32333a226c65646765722f636f6d6d697373696f6e5f696e646578223b),
('c3429e95e280d5222de7177cfea778126af1878b', '127.0.0.1', 1478486980, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438363937393b72656469726563745f617574685f7572697c733a32383a226163636f756e742f62616c616e636573686565745f766965772f3537223b),
('c52ee4c8f80b940347f4a06831002fee95dfddab', '127.0.0.1', 1478576753, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363735323b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('c9c0d2f54f371a0705878ac97535d596232e5b4a', '127.0.0.1', 1478577525, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537373532353b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3834223b),
('cdce0cc2e3bd4416237969bb03132e2b83a4e21f', '127.0.0.1', 1478576756, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363735363b72656469726563745f617574685f7572697c733a31373a226c65646765722f6164645f6c6564676572223b),
('d896796670ea7148b47bdbdda41cc7972c168c6f', '127.0.0.1', 1478484560, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343536303b72656469726563745f617574685f7572697c733a363a226c6564676572223b),
('d98f701a5f1c9fd9366ba83731ca33bb1ce06729', '127.0.0.1', 1478484483, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343438323b72656469726563745f617574685f7572697c733a32383a226c65646765722f6164645f616363745f7375625f63617465676f7279223b),
('daa4b1304bc75ec4254fd20e66b34ede941c83bf', '127.0.0.1', 1478578931, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537383933313b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3833223b),
('db374bd0fdf529d2e46fb62c685b2634bded1a4c', '127.0.0.1', 1478487171, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438373137313b72656469726563745f617574685f7572697c733a32323a226c65646765722f706179737065635f766965772f3534223b),
('dc6d0d15237092d9343270701f3f1c4da6c501db', '127.0.0.1', 1478483850, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438333834383b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('e28375f9b115fc282bf66c1e99d1f9773976a425', '127.0.0.1', 1478581763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383538313736323b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3831223b),
('e3564b71c8d467d30f8bfa7f5974073c09c2325c', '127.0.0.1', 1478577531, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537373533303b72656469726563745f617574685f7572697c733a32313a226c65646765722f6c65646765725f766965772f3833223b),
('e821a636446a80a14c94d0ad77962fda289c4be6', '127.0.0.1', 1478484013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343031333b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('ea59d109fe2a9a320ec377e0a7f368e8a0942a24', '127.0.0.1', 1478489327, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438393332373b),
('ea7059c9c08aefd4a29c3828681d2bc8ca27ba45', '127.0.0.1', 1478576793, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363739323b72656469726563745f617574685f7572697c733a32333a226c65646765722f7472616e736665725f6361706974616c223b),
('efbe57b8e3347c122ec370e9055c5d7aec780e89', '127.0.0.1', 1478576760, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363735393b72656469726563745f617574685f7572697c733a32383a226c65646765722f6164645f616363745f7375625f63617465676f7279223b),
('f19a8c5d82dddb57d9534065e5a78003f6146efc', '127.0.0.1', 1478484460, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438343435393b72656469726563745f617574685f7572697c733a373a226163636f756e74223b),
('f3e351505d5258d2db97b4ea3113b9fded0a0966', '::1', 1478581852, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383536393334303b6c6f676765645f757365727c613a343a7b733a353a22656d61696c223b733a32333a22616e616e64736167617230303740676d61696c2e636f6d223b733a373a22757365725f6964223b733a323a223433223b733a343a22726f6c65223b733a353a2261646d696e223b733a393a226c6f676765645f696e223b623a313b7d),
('f6bd66a644ab55620c9f996f1f72506cee63a0b3', '127.0.0.1', 1478569625, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383536393632343b72656469726563745f617574685f7572697c733a393a2264617368626f617264223b),
('f9cf593b1e745f55acce23dd4f4a789344ce887b', '127.0.0.1', 1478576749, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383537363734383b72656469726563745f617574685f7572697c733a32323a226c65646765722f6164645f636f6d6d697373696f6e73223b),
('fe28c524085ad66daa629ebb896bb02f985e4e95', '127.0.0.1', 1478487617, 0x5f5f63695f6c6173745f726567656e65726174657c693a313437383438373631373b72656469726563745f617574685f7572697c733a373a226163636f756e74223b);

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

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `identity`, `identity_id`, `type`, `remarks`, `start_date`, `end_date`, `acct_id`, `sub_acct_id`, `amount`, `loy_amt`, `dis_amt`, `from_role`, `to_role`, `commission`, `benefits`, `slr_ref_level1`, `slr_ref_level2`, `slr_ref_level3`, `slr_ref_level4`, `slr_ref_level5`, `clt_ref_level1`, `clt_ref_level2`, `clt_ref_level3`, `clt_ref_level4`, `clt_ref_level5`, `points_mode`, `seller_profit`, `client_profit`, `seller_deduction`, `client_deduction`, `transferrable`, `period`, `tenure`, `modified_by`, `modified_at`, `created_at`, `created_by`, `visible`) VALUES
(1, 'Commission', '', '1', 'Introducer Commission', '0000-00-00', '0000-00-00', '48', '51', 0, 0, 0, '24', '23', 10, 0, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, '', 0.5, 0.1, 0, 0, '', 0, 0, '', 1477359064, 1477359064, 43, 0),
(2, 'Commission', '', '1', 'Introducer Commission', '0000-00-00', '0000-00-00', '48', '51', 0, 0, 0, '22', '23', 10, 0, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, '', 0.5, 0.1, 0, 0, '', 0, 0, '', 1477359064, 1477359064, 43, 0),
(3, 'Commission', '', '', 'Customer''s Referral for Distributor Sponsorship Commission', '0000-00-00', '0000-00-00', '48', '50', 0, 0, 0, '23', '25', 20, 0, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, 0.1, '', 5, 10, 0, 0, '', 0, 0, '', 1477406899, 1477406899, 43, 0),
(4, 'Commission', '', '', 'Admin to Cash Dispatcher', '0000-00-00', '0000-00-00', '59', '47', 0, 0, 0, '22', '9', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0.1, 0.1, 0, 0, '', 0, 0, '', 1477468062, 1477468062, 43, 0),
(5, 'Commission', '', '', 'Cash Dispatcher Commission', '0000-00-00', '0000-00-00', '33', '47', 0, 0, 0, '9', '24', 2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0.1, 0.1, 0, 0, '', 0, 0, '', 1477484493, 1477484493, 43, 0),
(6, 'Commission', '', '', 'Agri-sales Commission setup', '0000-00-00', '0000-00-00', '39', '14', 0, 0, 0, '22', '24', 10, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '', 0.1, 0.2, 0, 0, '', 0, 0, '', 1477840974, 1477840974, 43, 0),
(7, 'Commission', '', '', 'Retailors Commission', '0000-00-00', '0000-00-00', '11', '15', 0, 0, 0, '22', '6', 10, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, 1, 0, 0, '', 0, 0, '43', 1477841411, 1477841411, 43, 0),
(8, 'Commission', '', '', 'Agent doing pay wallet Transaction', '0000-00-00', '0000-00-00', '11', '14', 0, 0, 0, '24', '22', 15, 10, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '', 1, 1, 0, 0, '', 0, 0, '', 1477937659, 1477937659, 43, 0),
(9, 'Commission', '', '', 'Testing Agent Commissions2', '0000-00-00', '0000-00-00', '16', '17', 0, 0, 0, '23', '24', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'wallet', 0.5, 1.1, 1, 3, '', 0, 0, '43', 1478456197, 1478456197, 43, 0),
(10, 'Commission', '', '', 'test sales POS', '0000-00-00', '0000-00-00', '24', '57', 0, 0, 0, '22', '24', 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'loyality', 0.1, 0.2, 10, 0, '', 0, 0, '', 1478328464, 1478328464, 43, 0);

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

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `total_product`, `total_price`, `customer_id`, `customer_referral_id`, `sales_by`, `created_at`, `modified_at`) VALUES
(1, 1, '', 90, '415360', 54, 1477834579, 1477834579),
(2, 1, '', 54, '861203', 90, 1477836212, 1477836212),
(3, 1, '', 90, '415360', 43, 1477839491, 1477839491),
(4, 1, '', 90, '415360', 43, 1477936896, 1477936896),
(5, 1, '', 43, 'ADMIN1001', 90, 1477937461, 1477937461),
(6, 1, '', 43, 'ADMIN1001', 90, 1477937693, 1477937693),
(7, 1, '', 43, 'ADMIN1001', 90, 1477937917, 1477937917),
(8, 1, '', 43, 'ADMIN1001', 90, 1477937957, 1477937957),
(9, 1, '', 43, 'ADMIN1001', 90, 1477937972, 1477937972),
(10, 1, '', 43, 'ADMIN1001', 90, 1477937975, 1477937975),
(11, 1, '', 43, 'ADMIN1001', 90, 1477938072, 1477938072),
(12, 1, '', 43, 'ADMIN1001', 90, 1477938212, 1477938212),
(13, 1, '', 43, 'ADMIN1001', 90, 1477938260, 1477938260),
(14, 1, '', 43, 'ADMIN1001', 90, 1477938510, 1477938510),
(15, 1, '', 43, 'ADMIN1001', 90, 1477938549, 1477938549),
(16, 1, '', 90, '415360', 43, 1477938649, 1477938649),
(17, 1, '', 90, '415360', 43, 1477938689, 1477938689),
(18, 1, '', 90, '415360', 43, 1477938719, 1477938719),
(19, 1, '', 90, '415360', 43, 1477938963, 1477938963),
(20, 1, '', 90, '415360', 43, 1477938983, 1477938983),
(21, 1, '', 90, '415360', 43, 1477939008, 1477939008),
(22, 1, '', 115, '645973', 43, 1477939261, 1477939261),
(23, 1, '', 114, '801654', 43, 1477939374, 1477939374),
(24, 1, '', 114, '801654', 43, 1477939535, 1477939535),
(25, 1, '', 114, '801654', 43, 1477939606, 1477939606),
(26, 1, '', 90, '415360', 43, 1477939727, 1477939727),
(27, 1, '', 113, '641087', 90, 1477939803, 1477939803),
(28, 1, '', 90, '415360', 43, 1477939817, 1477939817),
(29, 1, '', 99, '714953', 54, 1478261044, 1478261044),
(30, 1, '', 99, '714953', 54, 1478261139, 1478261139),
(31, 1, '', 99, '714953', 54, 1478261240, 1478261240),
(32, 1, '', 99, '714953', 54, 1478261361, 1478261361),
(33, 1, '', 99, '714953', 54, 1478261462, 1478261462),
(34, 1, '', 99, '714953', 54, 1478261532, 1478261532),
(35, 1, '', 99, '714953', 54, 1478261563, 1478261563),
(36, 1, '', 99, '714953', 54, 1478265116, 1478265116),
(37, 1, '', 99, '714953', 54, 1478265219, 1478265219),
(38, 1, '', 99, '714953', 54, 1478265376, 1478265376),
(39, 1, '', 115, '645973', 54, 1478265852, 1478265852),
(40, 1, '', 90, '415360', 118, 1478455368, 1478455368),
(41, 1, '', 90, '415360', 54, 1478455685, 1478455685),
(42, 1, '', 90, '415360', 54, 1478456272, 1478456272),
(43, 1, '', 90, '415360', 54, 1478456569, 1478456569),
(44, 1, '', 90, '415360', 54, 1478456702, 1478456702),
(45, 1, '', 90, '415360', 54, 1478456830, 1478456830),
(46, 1, '', 90, '415360', 54, 1478457104, 1478457104),
(47, 1, '', 90, '415360', 54, 1478457447, 1478457447),
(48, 1, '', 90, '415360', 54, 1478458538, 1478458538),
(49, 1, '', 90, '415360', 54, 1478483999, 1478483999),
(50, 1, '', 90, '415360', 54, 1478486826, 1478486826),
(51, 1, '', 90, '415360', 54, 1478487607, 1478487607),
(52, 1, '', 90, '415360', 54, 1478489030, 1478489030),
(53, 1, '', 90, '415360', 54, 1478489054, 1478489054),
(54, 1, '', 90, '415360', 54, 1478489375, 1478489375),
(55, 1, '', 90, '415360', 54, 1478489611, 1478489611),
(56, 1, '', 90, '415360', 54, 1478575949, 1478575949),
(57, 1, '', 90, '415360', 54, 1478576102, 1478576102);

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

INSERT INTO `ledger` (`id`, `user_id`, `email`, `pay_type`, `account_no`, `rolename`, `debit`, `credit`, `amount`, `points_mode`, `capital`, `liabilities`, `cash`, `invoice_id`, `remarks`, `transaction`, `start_date`, `created_at`, `modified_at`, `modified_by`, `count`, `challan`) VALUES
(1, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 29, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478261045, 1478261045, 0, '', 'no_invoice.jpg'),
(2, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 29, 'Seller Benefits deduction for Invoice ID-29', '', '0000-00-00', 1478261045, 1478261045, 0, '', 'no_invoice.jpg'),
(3, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 29, 'Business Transaction Commission For payspec ID-17 against Invoice ID-29', '', '0000-00-00', 1478261045, 1478261045, 0, '', 'no_invoice.jpg'),
(4, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 31, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478261240, 1478261240, 0, '', 'no_invoice.jpg'),
(5, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 31, 'Seller Benefits deduction for Invoice ID-31', '', '0000-00-00', 1478261240, 1478261240, 0, '', 'no_invoice.jpg'),
(6, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 31, 'Business Transaction Commission For payspec ID-17 against Invoice ID-31', '', '0000-00-00', 1478261240, 1478261240, 0, '', 'no_invoice.jpg'),
(7, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 32, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478261361, 1478261361, 0, '', 'no_invoice.jpg'),
(8, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 32, 'Seller Benefits deduction for Invoice ID-32', '', '0000-00-00', 1478261361, 1478261361, 0, '', 'no_invoice.jpg'),
(9, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 32, 'Business Transaction Commission For payspec ID-17 against Invoice ID-32', '', '0000-00-00', 1478261361, 1478261361, 0, '', 'no_invoice.jpg'),
(10, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 33, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478261462, 1478261462, 0, '', 'no_invoice.jpg'),
(11, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 33, 'Seller Benefits deduction for Invoice ID-33', '', '0000-00-00', 1478261463, 1478261463, 0, '', 'no_invoice.jpg'),
(12, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 33, 'Business Transaction Commission For payspec ID-17 against Invoice ID-33', '', '0000-00-00', 1478261463, 1478261463, 0, '', 'no_invoice.jpg'),
(13, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 34, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478261532, 1478261532, 0, '', 'no_invoice.jpg'),
(14, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 34, 'Seller Benefits deduction for Invoice ID-34', '', '0000-00-00', 1478261532, 1478261532, 0, '', 'no_invoice.jpg'),
(15, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 34, 'Business Transaction Commission For payspec ID-17 against Invoice ID-34', '', '0000-00-00', 1478261532, 1478261532, 0, '', 'no_invoice.jpg'),
(16, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 35, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478261563, 1478261563, 0, '', 'no_invoice.jpg'),
(17, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 35, 'Seller Benefits deduction for Invoice ID-35', '', '0000-00-00', 1478261563, 1478261563, 0, '', 'no_invoice.jpg'),
(18, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 35, 'Business Transaction Commission For payspec ID-17 against Invoice ID-35', '', '0000-00-00', 1478261563, 1478261563, 0, '', 'no_invoice.jpg'),
(19, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 36, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478265116, 1478265116, 0, '', 'no_invoice.jpg'),
(20, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 36, 'Seller Benefits deduction for Invoice ID-36', '', '0000-00-00', 1478265116, 1478265116, 0, '', 'no_invoice.jpg'),
(21, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 36, 'Business Transaction Commission For payspec ID-17 against Invoice ID-36', '', '0000-00-00', 1478265117, 1478265117, 0, '', 'no_invoice.jpg'),
(22, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 37, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478265219, 1478265219, 0, '', 'no_invoice.jpg'),
(23, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 37, 'Seller Benefits deduction for Invoice ID-37', '', '0000-00-00', 1478265219, 1478265219, 0, '', 'no_invoice.jpg'),
(24, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 37, 'Business Transaction Commission For payspec ID-17 against Invoice ID-37', '', '0000-00-00', 1478265219, 1478265219, 0, '', 'no_invoice.jpg'),
(25, 99, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 38, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478265376, 1478265376, 0, '', 'no_invoice.jpg'),
(26, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 38, 'Seller Benefits deduction for Invoice ID-38', '', '0000-00-00', 1478265376, 1478265376, 0, '', 'no_invoice.jpg'),
(27, 54, '', 17, '0', '0', 3750, 0, 3750, '', 0, 0, 0, 38, 'Business Transaction Commission For payspec ID-17 against Invoice ID-38', '', '0000-00-00', 1478265376, 1478265376, 0, '', 'no_invoice.jpg'),
(28, 43, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478335521, 1478335521, 0, 'no', 'no_invoice.jpg'),
(29, 43, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478335649, 1478335649, 0, 'no', 'no_invoice.jpg'),
(30, 43, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478335741, 1478335741, 0, 'no', 'no_invoice.jpg'),
(31, 43, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478335745, 1478335745, 0, 'no', 'no_invoice.jpg'),
(32, 43, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478335802, 1478335802, 0, 'no', 'no_invoice.jpg'),
(33, 43, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478336694, 1478336694, 0, 'no', 'no_invoice.jpg'),
(34, 43, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478337363, 1478337363, 0, 'no', 'no_invoice.jpg'),
(35, 54, '', 50, '0', '0', 1300, 0, 1300, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478337797, 1478337797, 0, 'no', 'no_invoice.jpg'),
(36, 54, '', 50, '0', '0', 1300, 0, 1300, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478337838, 1478337838, 0, 'no', 'no_invoice.jpg'),
(37, 54, '', 50, '0', '0', 1200, 0, 1200, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478339181, 1478339181, 0, 'no', 'no_invoice.jpg'),
(38, 122, '', 50, '0', '0', 500, 0, 500, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-05', 1478339451, 1478339451, 0, 'no', 'no_invoice.jpg'),
(39, 43, '', 63, '0', '0', 0, 25000, 25000, 'wallet', 0, 0, 0, 0, 'Approved by my credit', 'Transactions Type .withdraw to Pay Spec by A/C No 555000999000777', '0000-00-00', 1478432459, 1478432459, 43, 'yes', 'no_invoice.jpg'),
(40, 79, '', 63, '0', '0', 200000, 0, 200000, 'wallet', 0, 0, 0, 0, 'Approved by my credit', 'Transactions Type .deposit to Pay Spec by A/C No 709288403656429', '0000-00-00', 1478432947, 1478432947, 79, 'yes', 'no_invoice1_thumb.jpg'),
(41, 79, '', 63, '0', '0', 500000, 0, 500000, 'wallet', 0, 0, 0, 0, 'Approved by my credit', 'Transactions Type .deposit to Pay Spec by A/C No 709288403656429', '0000-00-00', 1478433136, 1478433136, 79, 'yes', 'no_invoice1_thumb.jpg'),
(42, 79, '', 63, '0', '0', 0, 125000, 125000, 'wallet', 0, 0, 0, 0, 'Approved and transfered amount through NEFT no 56739 on 25th oct 2016', 'Transactions Type .withdraw to Pay Spec by A/C No 709288403656429', '0000-00-00', 1478433239, 1478433239, 79, 'yes', 'no_invoice.jpg'),
(43, 79, '', 63, '0', '0', 0, 500, 500, 'wallet', 0, 0, 0, 0, 'ok', 'Transactions Type .withdraw to Pay Spec by A/C No 709288403656429', '0000-00-00', 1478433419, 1478433419, 79, 'yes', 'no_invoice.jpg'),
(44, 54, '', 50, '0', '0', 1200, 0, 1200, '', 0, 0, 0, 0, 'Pay type -50Sponsorship', '', '2016-11-06', 1478440031, 1478440031, 0, 'no', 'no_invoice.jpg'),
(45, 54, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship of $email', '', '2016-11-06', 1478453959, 1478453959, 0, 'no', 'no_invoice.jpg'),
(46, 54, '', 50, '0', '0', 1020, 0, 1020, '', 0, 0, 0, 0, 'Pay type -50Sponsorship of new978102@gmail.com', '', '2016-11-06', 1478454349, 1478454349, 0, 'no', 'no_invoice.jpg'),
(47, 90, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 41, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478455686, 1478455686, 0, '', 'no_invoice.jpg'),
(48, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 41, 'Seller Benefits deduction for Invoice ID-41', '', '0000-00-00', 1478455686, 1478455686, 0, '', 'no_invoice.jpg'),
(49, 54, '', 17, '0', '0', 1500, 0, 1500, '', 0, 0, 0, 41, 'Business Transaction Commission For payspec ID-17 against Invoice ID-41', '', '0000-00-00', 1478455686, 1478455686, 0, '', 'no_invoice.jpg'),
(50, 90, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 49, 'Benefits Deducted from Pay Spec No -17Seller-23Client-24', '', '0000-00-00', 1478483999, 1478483999, 0, '', 'no_invoice.jpg'),
(51, 54, '', 17, '0', '0', 0, 0, 0, '', 0, 0, 0, 49, 'Seller Benefits deduction for Invoice ID-49', '', '0000-00-00', 1478483999, 1478483999, 0, '', 'no_invoice.jpg'),
(52, 54, '', 17, '0', '0', 10, 0, 10, '', 0, 0, 0, 49, 'Business Transaction Commission For payspec ID-17 against Invoice ID-49', '', '0000-00-00', 1478483999, 1478483999, 0, '', 'no_invoice.jpg'),
(53, 90, '', 68, '0', '0', 0, 22, 22, 'wallet', 0, 0, 0, 50, 'Benefits Deducted from Pay Spec No -68', '', '0000-00-00', 1478486826, 1478486826, 0, '', 'no_invoice.jpg'),
(54, 54, '', 68, '0', '0', 0, 10, 10, 'wallet', 0, 0, 0, 50, 'Benefits Deducted from Pay Spec No -68', '', '0000-00-00', 1478486827, 1478486827, 0, '', 'no_invoice.jpg'),
(55, 90, '', 17, '0', '0', 60, 0, 60, 'wallet', 0, 0, 0, 50, 'Commission from Pay Spec No -17', '', '0000-00-00', 1478486827, 1478486827, 0, '', 'no_invoice.jpg'),
(56, 54, '', 17, '0', '0', 20, 0, 20, 'wallet', 0, 0, 0, 50, 'Commission from Pay Spec No -17', '', '0000-00-00', 1478486827, 1478486827, 0, '', 'no_invoice.jpg'),
(57, 90, '', 68, '0', '0', 0, 1.1, 1.1, 'wallet', 0, 0, 0, 51, 'Benefits Deducted from Pay Spec No -68', '', '0000-00-00', 1478487607, 1478487607, 0, '', 'no_invoice.jpg'),
(58, 54, '', 68, '0', '0', 0, 0.5, 0.5, 'wallet', 0, 0, 0, 51, 'Benefits Deducted from Pay Spec No -68', '', '0000-00-00', 1478487607, 1478487607, 0, '', 'no_invoice.jpg'),
(59, 90, '', 17, '0', '0', 3, 0, 3, 'wallet', 0, 0, 0, 51, 'Commission from 23 to Pay Spec No -17', '', '0000-00-00', 1478487607, 1478487607, 0, '', 'no_invoice.jpg'),
(60, 54, '', 17, '0', '0', 1, 0, 1, 'wallet', 0, 0, 0, 51, 'Commission from 23 to Pay Spec No -17', '', '0000-00-00', 1478487607, 1478487607, 0, '', 'no_invoice.jpg'),
(61, 90, '', 68, '0', '0', 0, 1.1, 1.1, 'wallet', 0, 0, 0, 53, 'agentCommission for Invoice ID -53', '', '0000-00-00', 1478489054, 1478489054, 0, '', 'no_invoice.jpg'),
(62, 54, '', 68, '0', '0', 0, 0.5, 0.5, 'wallet', 0, 0, 0, 53, 'customer commission for Invoice ID-53', '', '0000-00-00', 1478489054, 1478489054, 0, '', 'no_invoice.jpg'),
(63, 90, '', 17, '0', '0', 3, 0, 3, 'wallet', 0, 0, 0, 53, 'Commission fromagentfor Invoice ID -53', '', '0000-00-00', 1478489054, 1478489054, 0, '', 'no_invoice.jpg'),
(64, 54, '', 17, '0', '0', 1, 0, 1, 'wallet', 0, 0, 0, 53, 'customer commission for the Invoice ID-53', '', '0000-00-00', 1478489054, 1478489054, 0, '', 'no_invoice.jpg'),
(65, 90, '', 68, '0', '0', 0, 1.1, 1.1, 'wallet', 0, 0, 0, 54, 'agentCommission for Invoice ID -54', '', '0000-00-00', 1478489375, 1478489375, 0, '', 'no_invoice.jpg'),
(66, 54, '', 68, '0', '0', 0, 0.5, 0.5, 'wallet', 0, 0, 0, 54, 'customer commission for Invoice ID-54', '', '0000-00-00', 1478489376, 1478489376, 0, '', 'no_invoice.jpg'),
(67, 90, '', 17, '0', '0', 3, 0, 3, 'wallet', 0, 0, 0, 54, 'Commission from -agent-for Invoice ID -54', '', '0000-00-00', 1478489376, 1478489376, 0, '', 'no_invoice.jpg'),
(68, 54, '', 17, '0', '0', 1, 0, 1, 'wallet', 0, 0, 0, 54, 'Commission from -customer-for Invoice ID -54', '', '0000-00-00', 1478489376, 1478489376, 0, '', 'no_invoice.jpg'),
(69, 90, '', 68, '0', '0', 0, 11, 11, 'wallet', 0, 0, 0, 55, 'agent- commission for Invoice ID -55', '', '0000-00-00', 1478489612, 1478489612, 0, '', 'no_invoice.jpg'),
(70, 54, '', 68, '0', '0', 0, 5, 5, 'wallet', 0, 0, 0, 55, 'customer- commission for Invoice ID-55', '', '0000-00-00', 1478489612, 1478489612, 0, '', 'no_invoice.jpg'),
(71, 90, '', 17, '0', '0', 30, 0, 30, 'wallet', 0, 0, 0, 55, 'Commission from -agent-for Invoice ID -55', '', '0000-00-00', 1478489612, 1478489612, 0, '', 'no_invoice.jpg'),
(72, 54, '', 17, '0', '0', 10, 0, 10, 'wallet', 0, 0, 0, 55, 'Commission from -customer-for Invoice ID -55', '', '0000-00-00', 1478489612, 1478489612, 0, '', 'no_invoice.jpg'),
(73, 90, '', 68, '2147483647', '24', 0, 1.1, 1.1, 'wallet', 0, 0, 0, 56, 'agent- commission for Invoice ID -56', '', '0000-00-00', 1478575950, 1478575950, 0, '', 'no_invoice.jpg'),
(74, 54, '', 68, '2147483647', '23', 0, 0.5, 0.5, 'wallet', 0, 0, 0, 56, 'customer- commission for Invoice ID-56', '', '0000-00-00', 1478575950, 1478575950, 0, '', 'no_invoice.jpg'),
(75, 90, '', 17, '2147483647', '24', 3, 0, 3, 'wallet', 0, 0, 0, 56, 'Commission from -agent-for Invoice ID -56', '', '0000-00-00', 1478575950, 1478575950, 0, '', 'no_invoice.jpg'),
(76, 54, '', 17, '2147483647', '23', 1, 0, 1, 'wallet', 0, 0, 0, 56, 'Commission from -customer-for Invoice ID -56', '', '0000-00-00', 1478575950, 1478575950, 0, '', 'no_invoice.jpg'),
(77, 90, '', 68, '001846198739735', '24', 0, 2.2, 2.2, 'wallet', 0, 0, 0, 57, 'agent- commission for Invoice ID -57', '', '0000-00-00', 1478576102, 1478576102, 0, '', 'no_invoice.jpg'),
(78, 54, '', 68, '709288403656429', '23', 0, 1, 1, 'wallet', 0, 0, 0, 57, 'customer- commission for Invoice ID-57', '', '0000-00-00', 1478576103, 1478576103, 0, '', 'no_invoice.jpg'),
(79, 90, '', 17, '001846198739735', '24', 6, 0, 6, 'wallet', 0, 0, 0, 57, 'Commission from -agent-for Invoice ID -57', '', '0000-00-00', 1478576103, 1478576103, 0, '', 'no_invoice.jpg'),
(80, 54, '', 17, '709288403656429', '23', 2, 0, 2, 'wallet', 0, 0, 0, 57, 'Commission from -customer-for Invoice ID -57', '', '0000-00-00', 1478576103, 1478576103, 0, '', 'no_invoice.jpg'),
(81, 43, '', 45, '', '', 0, 200000, 200000, 'wallet', 0, 0, 0, 0, 'New Member welcome offer deduction purpose', '', '0000-00-00', 1478576820, 1478576820, 0, 'no', ''),
(82, 43, '', 69, '', '', 200000, 0, 200000, 'wallet', 0, 0, 0, 0, 'New Member welcome offer deduction purpose', '', '0000-00-00', 1478576820, 1478576820, 0, 'no', ''),
(83, 0, '', 69, '329640328550946', '23', 100, 0, 100, 'wallet', 0, 0, 0, 0, 'New member welcome offer', '', '0000-00-00', 1478577347, 1478577347, 0, '', 'no_invoice.jpg'),
(84, 0, '', 69, '570547362980832', '23', 100, 0, 100, 'wallet', 0, 0, 0, 0, 'New member welcome offer', '', '0000-00-00', 1478577423, 1478577423, 0, '', 'no_invoice.jpg');

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
(192, 79, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476971152),
(193, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476976784),
(194, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476985328),
(195, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476985810),
(196, 90, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1476985853),
(197, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1476987363),
(198, 31, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477317331),
(199, 31, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477328268),
(200, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477357494),
(201, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477357584),
(202, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477396397),
(203, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477398676),
(204, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477448502),
(205, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477448565),
(206, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477454214),
(207, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477456172),
(208, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477459843),
(209, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477460900),
(210, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477461613),
(211, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477462109),
(212, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477462198),
(213, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477462330),
(214, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477462435),
(215, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477462811),
(216, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477463394),
(217, 90, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477467872),
(218, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477468114),
(219, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477475192),
(220, 43, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477475213),
(221, 54, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477475918),
(222, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477477153),
(223, 43, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477481631),
(224, 90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477481649),
(225, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477481728),
(226, 114, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477483377),
(227, 114, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477483888),
(228, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477484382),
(229, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477487924),
(230, 114, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477502578),
(231, 115, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477504182),
(232, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36', 1477504553),
(233, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477504659),
(234, 115, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477504733),
(235, 114, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477505322),
(236, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477532311),
(237, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477532333),
(238, 79, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477532361),
(239, 115, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477532524),
(240, 114, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477533524),
(241, 115, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477539507),
(242, 114, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477539626),
(243, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477541197),
(244, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477541624),
(245, 115, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477542602),
(246, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477568643),
(247, 114, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477571026),
(248, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477571801),
(249, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477587422),
(250, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477588123),
(251, 115, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477588242),
(252, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477588572),
(253, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477590135),
(254, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477621057),
(255, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477623702),
(256, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477624824),
(257, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477625123),
(258, 84, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477625410),
(259, 114, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477639844),
(260, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477639958),
(261, 114, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477640033),
(262, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477640383),
(263, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477721735),
(264, 117, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477722436),
(265, 117, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477723256),
(266, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477726358),
(267, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477726795),
(268, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477728251),
(269, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477728440),
(270, 43, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477729546),
(271, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477744400),
(272, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477744422),
(273, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477744436),
(274, 90, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477744461),
(275, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477746364),
(276, 43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1477749178),
(277, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477763294),
(278, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477834005),
(279, 54, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477834497),
(280, 90, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477834599),
(281, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477836842),
(282, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477839518),
(283, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1477935827),
(284, 90, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1477937399),
(285, 90, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478006466),
(286, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478255059),
(287, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478260765),
(288, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478277534),
(289, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478326845),
(290, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478328778),
(291, 122, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1478339272),
(292, 124, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1478339475),
(293, 116, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1478339553),
(294, 123, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478343542),
(295, 121, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478343702),
(296, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478344726),
(297, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478393378),
(298, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478412077),
(299, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478432542),
(300, 79, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478432554),
(301, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478433639),
(302, 118, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:46.0) Gecko/20100101 Firefox/46.0', 1478454499),
(303, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478455659),
(304, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478483841),
(305, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478483973),
(306, 43, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36', 1478569352),
(307, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478575923),
(308, 54, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478577450),
(309, 133, '127.0.0.1', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)', 1478577490);

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
(2, 50, 'bank', '', 'usd', 'John Doe', '34345', '34546', 'Dutch bangla bank limited', 'Chowmuhoni, noakhali', 'Chowmuhoni', 'Noakhali', 'Bangladesh', 'approve', 4, 1442659933, 1442659933);

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
(1, 'Super Admin', 0, 0, 1, 0, 'role_name', 0, 0, 0, 0, 0),
(6, 'Retailor/Reseller', 1200, 0, 1, 0, 'role_name', 0, 0, 0, 0, 0),
(8, 'Test_New_User Role', 0, 0, 0, 0, 'role_name', 0, 0, 43, 1465322017, 1465322017),
(9, 'Assistant_Accountant', 0, 0, 1, 0, 'role_name', 0, 0, 43, 1466011013, 1466011013),
(19, 'System Administrator', 0, 0, 1, 0, 'role_name', 0, 0, 43, 1467466622, 1467466622),
(21, 'Recurring Account', 0, 0, 1, 0, 'account_type', 0, 0, 43, 1467490012, 1467490012),
(22, 'admin', 0, 0, 1, 0, 'role_name', 0, 0, 43, 1468132123, 1468132123),
(23, 'customer', 0, 0, 1, 0, 'role_name', 0, 0, 43, 1468132134, 1468132134),
(24, 'agent', 0, 0, 1, 0, 'role_name', 0, 0, 43, 1468132143, 1468132143),
(25, 'Distributor', 1020, 0, 1, 0, 'role_name', 0, 0, 43, 1471196986, 1471196986),
(26, 'Credit Based on Request', 0, 0, 1, 0, 'loan_type', 0, 0, 43, 1472260941, 1472260941),
(27, 'Credit From Agent', 0, 0, 1, 0, 'loan_type', 0, 0, 43, 1472261019, 1472261019),
(28, 'Credit From Referrer', 0, 0, 1, 0, 'loan_type', 0, 0, 43, 1472261033, 1472261033),
(29, 'Credit For Highest Transaction', 0, 0, 1, 0, 'loan_type', 0, 0, 43, 1472261045, 1472261045),
(30, 'Daily Credit', 0, 0, 1, 0, 'loan_type', 0, 0, 43, 1472261110, 1472261110),
(31, 'Split', 0, 0, 1, 0, 'voucher_type', 0, 0, 43, 1472489567, 1472489567),
(32, 'Warehousing', 1300, 0, 1, 0, 'role_name', 0, 0, 43, 1478278809, 1478278809),
(33, 'Parking_operator', 500, 0, 1, 0, 'role_name', 0, 0, 43, 1478328736, 1478328736),
(34, 'Stationery Items', 5000, 0, 1, 0, 'withdraw', 0, 0, 43, 1478416856, 1478416856),
(35, 'Refreshment', 1000, 0, 1, 0, 'withdraw', 0, 0, 43, 1478416972, 1478416972),
(36, 'Personal Use', 20000, 0, 1, 0, 'withdraw', 0, 0, 43, 1478423725, 1478423725);

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
(1, 17, 'test retailor', 29, 1, '25000', '25000', '0', 0, 1478261045, 1478261045),
(2, 17, 'test retailor', 30, 1, '25000', '25000', '0', 0, 1478261139, 1478261139),
(3, 17, 'test retailor', 31, 1, '25000', '25000', '0', 0, 1478261240, 1478261240),
(4, 17, 'test retailor', 32, 1, '25000', '25000', '0', 0, 1478261361, 1478261361),
(5, 17, 'test retailor', 33, 1, '25000', '25000', '0', 0, 1478261462, 1478261462),
(6, 17, 'test retailor', 34, 1, '25000', '25000', '0', 0, 1478261532, 1478261532),
(7, 17, 'test retailor', 35, 1, '25000', '25000', '0', 0, 1478261563, 1478261563),
(8, 17, 'test retailor', 36, 1, '25000', '25000', '0', 0, 1478265116, 1478265116),
(9, 17, 'test retailor', 37, 1, '25000', '25000', '0', 0, 1478265219, 1478265219),
(10, 17, 'test retailor', 38, 1, '25000', '25000', '0', 0, 1478265376, 1478265376),
(11, 17, 'test', 39, 1, '12000', '12000', '0', 0, 1478265852, 1478265852),
(12, 57, 'test', 40, 1, '35', '35', '0', 0, 1478455368, 1478455368),
(13, 17, 'test', 41, 1, '10000', '10000', '0', 0, 1478455685, 1478455685),
(14, 17, 'test', 42, 1, '1000', '1000', '0', 0, 1478456272, 1478456272),
(15, 17, 'test', 43, 1, '1000', '1000', '0', 0, 1478456569, 1478456569),
(16, 17, 'test', 44, 1, '1000', '1000', '0', 0, 1478456702, 1478456702),
(17, 17, 'test', 45, 1, '1000', '1000', '0', 0, 1478456830, 1478456830),
(18, 17, 'test', 46, 1, '1000', '1000', '0', 0, 1478457104, 1478457104),
(19, 17, 'test', 47, 1, '1000', '1000', '0', 0, 1478457447, 1478457447),
(20, 17, 'test', 48, 1, '1000', '1000', '0', 0, 1478458538, 1478458538),
(21, 17, 'test', 49, 1, '1000', '1000', '0', 0, 1478483999, 1478483999),
(22, 17, 'test', 50, 1, '2000', '2000', '0', 0, 1478486826, 1478486826),
(23, 17, 'test', 51, 1, '100', '100', '0', 0, 1478487607, 1478487607),
(24, 17, 'final test', 52, 1, '100', '100', '0', 0, 1478489030, 1478489030),
(25, 17, 'final test', 53, 1, '100', '100', '0', 0, 1478489054, 1478489054),
(26, 17, 'test', 54, 1, '100', '100', '0', 0, 1478489375, 1478489375),
(27, 17, 'final test', 55, 1, '1000', '1000', '0', 0, 1478489611, 1478489611),
(28, 17, 'test', 56, 1, '100', '100', '0', 0, 1478575949, 1478575949),
(29, 17, 'test', 57, 1, '200', '200', '0', 0, 1478576102, 1478576102);

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

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `row_pass`, `email`, `contactno`, `gender`, `date_of_birth`, `profession`, `street_address`, `area_name`, `area_id`, `city`, `city_id`, `country`, `country_id`, `postal_code`, `adhaar_no`, `passport_no`, `role`, `rolename`, `active`, `online_status`, `user_lastlogin`, `referral_code`, `account_no`, `referredByCode`, `photo`, `created_by`, `created_at`, `modified_at`, `modified_by`) VALUES
(1, 'Super', 'Administrator', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'admin@example.com', '01814726811', 'male', '1989-12-12', 'Software Engineer', 'Bengaluru', '', 0, 'Bengaluru', '0', '', 0, 0, '', '', 'admin', '1', 1, 0, 1466928762, 'IBVJORTP', '1111111111111111', 'AAAAAAAAAAA', 'mhshohel_thumb.png', 0, 1430499629, 1431080604, 0),
(4, 'Feroz', 'Ahmed', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'agent@example.com', '01815181584', 'male', '2032-03-04', 'Job Holder', '184/D asad avenue, mohammadpur, dhaka', '', 0, 'Bengaluru', '0', 'Bangladesh', 19, 0, '', '', 'agent', '24', 1, 0, 1442649102, 'GFPV7BS0', '234235423532534523', 'IBVJORTP', 'avatar_thumb.jpg', 1, 1430675701, 1430675701, 0),
(28, 'John', 'Doe', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'wefd@bu.edu', '4534456', 'male', '1989-05-04', 'Web Developer', '184/D asad avenue, mohammadpur, dhaka', '', 0, 'Bengaluru', '0', 'Bangladesh', 19, 0, '', '', 'agent', '24', 1, 1, 1439915582, 'BEFVVAG0', '', 'GFPV7BS0', 'avatar1_thumb.jpg', 1, 1430676050, 1431078100, 0),
(29, 'Mr Apu', 'Sarkar', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'api@nai.com', '3454356', 'male', '2032-12-23', 'Student', 'Mirpur, Dhaka', '', 0, 'Nanjangud', '0', 'Bangladesh', 19, 0, '', '', 'user', '23', 1, 1, 1466135834, 'JOMPWVZT', '12342134123', 'BEFVVAG0', '', 0, 1431022664, 1431080559, 0),
(31, 'Developer', 'Test', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'user@example.com', '01815181584', 'male', '2010-02-04', 'Software Engineer', 'Bengaluru', '', 0, 'Nanjangud', '0', 'India', 19, 0, '', '', 'user', '23', 1, 1, 1477328268, '405972', '', 'IBVJORTP', '', 0, 1440004508, 1440004508, 0),
(32, 'Andrew', 'Alexander', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'andrew@gmail.com', '354645', 'male', '1934-03-05', 'Software Engineer', '234, Aladin Road, Barlin', '', 0, 'Gadaga', '0', 'Germany', 57, 0, '', '', 'agent', '24', 1, 0, 0, '198564', '', '', '', 4, 1441470244, 1441470244, 0),
(33, 'C & F', 'Karnataka', 'ac00cc63325cc130174bd4ce3ac9d38751896af2', 'candfkarnataka@gmail.com', 'candfkarnataka@gmail.com', '9980569960', 'male', '1982-09-29', 'Top Manager', 'Marathalli', 'Karnataka', 0, 'Bengaluru, Karnataka', '10', 'India', 105, 560010, '', '', 'admin', '22', 1, 0, 1466133824, 'SRDUZXDX', '55500009991777', 'Anand', 'IMG_6005_thumb.JPG', 1, 1460192464, 1462113262, 0),
(34, 'Distributor', 'APRIL', '396ab3db11da08e04c6756b9e5402acfe986deb2', 'Test1234$', 'info@myfairservice.com', '9980569960', 'male', '1990-01-01', 'Distributor', 'Chamraj Nagar', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 1, 1463749755, '430176', '', '', '', 33, 1460288161, 1471178411, 0),
(35, 'New User', 'Chamraj Nagar', '9bc34549d565d9505b287de0cd20ac77be1d3f2c', 'test1234', 'chamraj@gmail.com', '9980569960', 'male', '1990-01-01', 'chamraj User', 'chamraj nagar', '', 0, 'Chandakawadi, chamraj nagar', '0', 'India', 105, 0, '', '', 'user', '23', 1, 0, 1460290711, '646853925480', '596965430177328', '198564', '', 0, 1460288292, 1462113591, 0),
(36, 'Chamu', 'Raju', '9bc34549d565d9505b287de0cd20ac77be1d3f2c', 'test1234', 'cham2@gmail.com', '9980569960', 'male', '1990-01-01', 'Engineer', 'Mandya', '', 0, 'Mandya', '0', 'India', 105, 570015, '12345 3343 19283', 'J123102938', 'user', '23', 1, 0, 1461977458, '721405463997', '372416998506712', '646853925480', '', 0, 1460289823, 1462113554, 0),
(38, 'Narendra', 'Modi', '9c5f407a3010e03cdc9973baa198bfe0027fb5b9', 'naren@gmail.com', 'naren@gmail.com', '9980569960', 'male', '1990-01-01', 'Politician', 'Gujrat', '', 0, 'Gandinagar', '0', 'India', 105, 0, '', '', 'user', '23', 1, 0, 1464977182, '157894', '555000999123459', '721405463997', '', 0, 1461979195, 1462113534, 0),
(39, 'Agent', 'Amarnath', '43342678b9b9cfdb053397537186f6117c923a7b', 'amarnath@gmail.com', 'amarnath@gmail.com', '9980569960', 'male', '1990-01-01', 'Agent Amarnath', 'Chennai', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 1476852001, '473519', '13566734234543634543', '157894', 'bentley640_640x480_thumb.jpg', 33, 1462025992, 1462025992, 0),
(40, 'User', 'Amarnath', 'e3bb8f76248bc66945469a1c562d9c812019d4ff', 'useramar@gmail.com', 'useramar@gmail.com', '9980569960', 'male', '1990-01-01', 'Public', 'Gadaga', '', 0, 'Gadaga, Karnataka', '0', 'India', 105, 0, '', '', 'user', '23', 1, 0, 1476851691, '432810', '555000999123458', 'SRDUZXDX', '', 0, 1462026289, 1462113485, 0),
(41, 'Sharan', 'Actor', '7cf82eda089bbf6770342cc9738f08e9a3642da6', 'sharan@gmail.com', 'sharan@gmail.com', '9980569960', 'male', '1990-01-01', 'Actor under agent ref code', 'Hubbali', '', 0, 'Hubbali', '0', 'Bangladesh', 19, 0, '', '', 'user', '23', 1, 0, 1462114550, '539481', '555000999123457', '432810', '', 0, 1462026965, 1462026965, 0),
(42, 'Shruthi', 'Actor', 'ebcd2410402d6a6609bf2847ab6cff406ad29b29', 'Shruthi@gmail.com', 'Shruthi@gmail.com', '9980569960', 'female', '1990-01-01', 'Actor', 'Kerala', '', 0, 'Hubbali', '0', 'Kerala', 105, 0, '', '', 'user', '23', 1, 0, 1476852158, '378045', '555000999123456', '473519', '', 0, 1462027114, 1462027114, 0),
(43, 'Anand', 'Sagar', '5fba61a8c7a2240fc28f6e5a621696ffb39221da', '', 'anandsagar007@gmail.com', '9980569960', 'male', '1990-01-01', 'Super Power Administrator', 'Bengaluru', '', 0, 'Bengaluru', '0', 'India', 105, 0, '', '', 'admin', '22', 1, 1, 1478569352, 'ADMIN1001', '555000999000777', '378045', 'IMG_6089_thumb.JPG', 33, 1462070784, 1462071131, 0),
(44, 'Distributor', 'Anand', '3d53074b8ceb455f1c0aa0b0acbdc4caffa2956b', 'danand@gmail.com', 'danand@gmail.com', '9980569960', 'male', '1990-01-01', 'Distributor', 'India', '', 0, 'Bengaluru', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '608459', '', '', '', 43, 1462072918, 1462072918, 0),
(45, 'Retailor', 'Anand', '38e8f3c7ee0e911fb96285a34c477aca6fc94849', 'ranand@gmail.com', 'ranand@gmail.com', '9980569960', 'female', '1990-01-01', 'Retailor', 'Hubbali', '', 0, 'Bengaluru', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '196834', '', '', '', 43, 1462073078, 1462073078, 0),
(46, 'Retailor', 'Sukumar', '78bedf1202385fac6831539a9a6beb18ce762880', 'esukumar@gmail.com', 'esukumar@gmail.com', '9980569960', 'male', '1990-01-01', 'Retailor', 'Davanagere', 'Bengaluru', 0, 'Davanagere', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '287435', '', '', '', 43, 1462079373, 1462079373, 0),
(47, 'Retailor', 'Ramu', '627201b27b15a661e22dd7c21d66c50006e2709a', 'rramu@gmail.com', 'rramu@gmail.com', '990', 'female', '1990-01-01', 'Retailor', 'Mysuru', '', 0, 'Mysuru', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 1462114078, '418503', '', '', '', 43, 1462079472, 1462079472, 0),
(48, 'Disributor', 'Dhanush', '0d1a16102d57adff7912fc0dc631ac563df1fb49', 'ddhanush@gmail.com', 'ddhanush@gmail.com', '9', 'male', '1990-01-01', 'ddhanush@gmail.com', 'ddhanush@gmail.com', '', 0, '', '0', 'India', 105, 0, '', '', 'user', '23', 1, 1, 1466133601, '645079', '', 'RNWUJ3QC', '', 43, 1462079947, 1462079947, 0),
(49, 'C&F', 'Kumar', '75fc39bd36f32528e1808155228c4cffc129438c', 'c&fkumar@gmail.com', 'c&fkumar@gmail.com', '99', 'male', '1990-09-09', 'C and F', 'Mangaluru', '', 0, '', '0', 'India', 105, 0, '', '', 'admin', '22', 1, 0, 1462082790, '487356', '', '123456', '', 43, 1462081329, 1462081329, 0),
(50, 'Agent', 'Kumar', '11f9dfadce70cb74f54b6cfdf320efadc0db8c68', 'akumar@gmail.com', 'akumar@gmail.com', '9980569960', 'male', '1990-01-01', 'Agent Kumar', 'Hassan', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', 'Retailor/Reseller', 1, 0, 1468086751, '749685', '085316792044637', '12311233', '', 43, 1462081596, 1466971597, 0),
(51, 'Vivek', 'Anand', '8fd3a049e1e38db868bcc572e5625d7dbe5c82ef', 'vivek@gmail.com', 'vivek@gmail.com', '9980569960', 'male', '1990-01-01', 'pos_outlets', 'Mysuru', '', 0, '', '0', 'India', 105, 0, '', '', 'user', '23', 1, 1, 1476849563, '864903', '601179964725450', '378045', '', 0, 1462568220, 1463625187, 0),
(52, 'Warehouse', 'Sagar', 'f27b53da9eb3a8b21f8765a7b9c719d34a2d227a', 'whsagar@gmail.com', 'whsagar@gmail.com', '9980569960', 'male', '1990-01-01', 'warehouse', 'Kalburgi', '', 0, 'Basavakalyan', '0', 'India', 105, 0, '', '', 'admin', '22', 1, 1, 1466928856, '082967', '872924115856730', '864903', '', 0, 1463544052, 1463544524, 0),
(53, 'Retailer', 'Sagar', '5a38e3f26af04db3a9a2072c85e4b533b1c8073e', 'rsagar@gmail.com', 'rsagar@gmail.com', '9980569960', 'female', '1990-01-01', 'retailor', 'Gadaga', '', 0, 'Gadaga, Karnataka', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 1470223728, '329164', '848656337290954', '082967', '', 0, 1463621496, 1464027780, 0),
(54, 'Customer', 'Sagar', '247197bcea389dd9def60d55a44959609464f792', 'csagar@gmail.com', 'csagar@gmail.com', '9980569960', 'male', '1990-01-01', 'customer', 'Water Tank', 'Vijayanagar', 2, 'Mysuru', 'KA-09', 'India', 105, 570018, '474304506900', 'm1665840', 'user', '23', 1, 0, 1478577450, '861203', '709288403656429', 'RNWUJ3QC', 'Chrysanthemum_thumb.jpg', 0, 1463623369, 1477728490, 0),
(55, 'Supplier', 'Sagar', '57cca5b2951795125a4336281b7da7725e7ad11c', 'ssagar@gmail.com', 'ssagar@gmail.com', '9980569960', 'male', '1990-01-01', 'supplier', 'Karwara', '', 0, 'Dhakshina Kannada', '0', 'India', 105, 0, '', '', 'user', '23', 1, 0, 1466966494, '693705', '416382982507304', '082967', '', 0, 1463624382, 1464027888, 0),
(75, 'Assets', 'Company', 'a5a2e953554e3045a44ff082e20e9361fbd83fa7', '', 'assets@myfairservice.com', '', 'male', NULL, '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'admin', '22', 1, 1, 1464671618, 'RJMQQDUY', '555555555555555', '', '', 43, 1464626391, 1464626391, 0),
(76, 'Liabilities', 'Company', '3abca94f45675c675388ef13fb4c55e11cee5547', '', 'liabilities@myfairservice.com', '', 'male', NULL, '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'admin', '22', 1, 0, 0, '8DS6HD2E', '444444444444444', '', '', 43, 1464627032, 1464627032, 0),
(77, 'Cashier', 'Company', '7e8f844c0e5697cf83783d9c87253e954a11ee11', '', 'cashier@myfairservice.com', '', 'male', NULL, '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'admin', '22', 1, 0, 0, 'UN2MNT6B', '333333333333333', '', '', 43, 1464627074, 1464627074, 0),
(78, 'Capital', 'Company', 'c0736bf8e263d7ca74888a32aae4637c8271acf3', '', 'capital@myfairservice.com', '9980569960', 'male', '', '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'admin', '9', 1, 0, 0, 'I0LFYVSK', '222222222222222', '', '', 43, 1464627106, 1466971418, 0),
(79, 'Cash Dispatcher', 'Company', 'f713cb77a57236c4b20d66baf99243fee592bdab', 'cash_dispatcher@myfairservice.com', 'cash_dispatcher@myfairservice.com', '9980569960', 'male', '', 'Cash Dispatcher', 'Consumer1st', 'Corporate Office', 0, '', '0', 'India', 105, 0, '', '', 'admin', '9', 1, 0, 1478432553, 'AAAAAAAA', '1111111111111111', '', '', 43, 1464627172, 1466971440, 0),
(83, 'Sahukar', 'chennaiyya', 'e7ee86c219365c3096913c2bb58945928ca1431a', 'sahukar3@gmail.com', 'sahukar3@gmail.com', '9980569960', 'male', '1990-01-01', 'customer', 'Indra Nagar', '', 0, '', '0', 'India', 105, 0, '', '', 'user', '23', 1, 1, 1466134028, '723586', '974932018185273', '473519', '', 0, 1464976565, 1464976565, 0),
(84, 'Doddanna', 'Distributor', 'cbbf44ff2763e5cc6aa8a0caa7709a56ab7a8f79', 'dd@gmail.com', 'dd@gmail.com', '9980569960', 'male', '1990-01-01', 'distributor', 'Channaraya Patna', '', 0, 'test', '0', 'India', 105, 0, '', '', 'user', '25', 1, 0, 1477625410, '974851', '439769101230488', '723586', '', 0, 1464976773, 1468132266, 0),
(86, 'New Sagr', 'Test Role', '25bb17c1b0f71c56af4629727a34d9877c05fcca', '', 'testanand@gmail.com', '', 'male', NULL, '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'user', '23', 1, 0, 0, 'AXGYM0RS', '', '', '', 43, 1465323669, 1465323669, 0),
(87, 'Again test', 'Sagar', '3477a87ceab4b8f2f03a2104d4f9649f9ad431b6', '', 'again@gmail.com', '88756475857', 'male', '', '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'user', '23', 1, 0, 0, '17JZVIYK', '', '', '', 43, 1465324834, 1465325727, 0),
(88, 'New', 'Gen', 'da85d919def9f927c06748c59c5ee2da2767ae03', 'newgen@gmail.com', 'newgen@gmail.com', '9980569960', 'male', '1990-01-01', 'customer', 'Bengaluru', '', 0, '', '0', 'India', 105, 0, '', '', 'user', '23', 1, 1, 1466136095, '251438', '678422013768515', '861203', '', 0, 1466134523, 1466968891, 0),
(89, 'Satish', 'Patils', 'e031c8c2707ce55f449935e3cd2068d84d10b0fc', '', 'sp@gmail.com', '9980569960', 'male', '', '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'user', '23', 1, 1, 1476822453, 'MKGO9H5O', '5593182788888888', '778273', '', 43, 1466557520, 1466971386, 0),
(90, 'Agent Satish', 'Patil2', 'a6973779db1f5f4cc2867fb64f5f49cc6f42a6e7', 'asp@gmail.com', 'asp@gmail.com', '9980569960', 'male', '2010-01-01', 'Agent/Vendor', 'Kalaburgi', '', 0, 'Kalaburgi', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 1, 1478006466, '415360', '001846198739735', 'SRDUZXDX', 'Penguins1_thumb.jpg', 89, 1466558185, 1477836795, 0),
(91, 'TestChamu', 'Agent chandra', 'e11c03a0b462b0aeb482741ee40bf2f8d3e2952f', 'aTestChamu@gmail.com', 'aTestChamu@gmail.com', '1212121212', 'male', '2001-01-01', 'ok', 'ij', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', 'Assistant_Accountant', 1, 1, 1466966125, '420659', '659438317289751', 'SRDUZXDX', '', 43, 1466965441, 1466968015, 0),
(92, 'TestMobile', 'Mobile lastname', '92be91f6a2cc7df67d5b6ead9e312f5c1e671e90', 'myfair@gmail.com', 'myfair@gmail.com', '9980569960', 'male', '2010-01-01', 'distributor', 'Hebbal', '', 0, '', '0', 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '051239', '829138429660075', '082967', '', 0, 1467538846, 1467538846, 0),
(96, 'Bhavya', 'Sagar', '5f7e014d32ddb2a963fa8d43564d03b45bfa7d3e', 'b@gmail.com', 'b@gmail.com', '9008103576', 'female', '2010-01-01', 'stockpoints', 'Mandya', '', 0, 'Pandavapura', '0', 'India', 105, 0, '', '', 'user', '23', 2, 0, 0, '789326', '953168149307254', '749685', '', 0, 1467543432, 1474201983, 0),
(97, 'Distributor', 'Dinesh', 'adfbe12e43054614d71196ef80e1931fc18a240b', 'ddinesh@gmail.com', 'ddinesh@gmail.com', '998029838929', 'male', '1990-01-01', 'Retailor', 'Mandya', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '257463', '950218984536314', 'SRDUZXDX', 'MS4_thumb.jpg', 43, 1471205929, 1471205929, 0),
(98, 'Retailor', 'Rustum', 'b61598b9d6e91ebddf763d3b10cf483e061388d1', 'rrustum@gmail.com', 'rrustum@gmail.com', '234234', 'male', '1990-06-08', 'Shop Keeper', 'Mangaluru', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 0, '164379', '973014805628796', 'SRDUZXDX', 'MS1_thumb.jpg', 43, 1471206319, 1471206319, 0),
(99, 'Retail', 'Manju', '34dd33e7c6bf81aaac78f247bf7dd8850ddefbc2', 'rmanju@gmail.com', 'rmanju@gmail.com', '7656756758', 'male', '2001-01-01', 'Tailor', 'Davanagere', '', 0, 'Babuji Nagara', '0', 'India', 105, 0, '', '', 'agent', '24', 1, 0, 1471209244, '714953', '017569243288164', 'RNWUJ3QC', 'services_event-planning_thumb.jpg', 43, 1471208336, 1472408326, 0),
(113, 'Bhavya', 'Sagar', '45f402e161f7ded0ad844a59fb10c141431f9922', 'bhavya.r.sagar@gmail.com', 'bhavya.r.sagar@gmail.com', 'bhavya.r.sagar@gmail', 'female', '1990-01-01', '2343245254', 'Pandavapura', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '25', 1, 0, 0, '641087', '514199867743682', '861203', '', 0, 1477409354, 1477409354, 0),
(114, 'Satish', 'Patil', '244caed91d8ae3b82f9faa71da0eb616526f9b54', 'satishspatil21@gmail.com', 'satishspatil21@gmail.com', '8904977234', 'male', '1990-01-01', '', '', '', 0, '', 'ka30', 'India', 105, 0, '182938475634', '', 'agent', '24', 1, 0, 1477640033, '801654', '420541338650877', 'ADMIN1001', '', 0, 1477483291, 1477483291, 0),
(115, 'Vasanth', 'Bharamappa', '14b5328f717f1479d51d959c627601852a3275d7', 'vasanth.b@gmail.com', 'vasanth.b@gmail.com', '9980569960', '', NULL, '', '', '', 0, '', '', 'India', 105, 0, '', '', 'user', '23', 1, 0, 1477588242, '645973', '655040719629824', '801654', '', 0, 1477502533, 1477502533, 0),
(116, 'Bhavya', 'test', '1309834eb8f6e3265eaff6a4c272433ed1637716', 'btest@gmail.com', 'btest@gmail.com', '9980569960', 'female', '2000-01-01', '', '', '', 0, '', 'KA04', 'India', 105, 0, '43245235', '', 'agent', '6', 1, 1, 1478339553, '352640', '886907147035149', 'ADMIN1001', '', 0, 1477622190, 1477622190, 0),
(117, 'Murthy22', 'Last Name2', 'a1bded69d256ac25cc65a1a6b8e18c73346ece50', 'murthy.l@gmail.com', 'murthy.l@gmail.com', '9980569960', 'female', '2000-01-01', '2323', 'wsdfwsdfsdfs', '', 0, 'sdfsd', '', 'India', 105, 0, '', '', 'user', '23', 1, 1, 1477723256, '936827', '741467618095203', '974851', '', 1, 1477623326, 1477724163, 117),
(118, 'testref', 'new name', '74afe5bfe53992d45d778b447c2187cf2ba9bbb3', 'testref2@gmail.com', 'testref2@gmail.com', '9980569960', '', '20100101', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'user', '23', 1, 1, 1478454499, '978102', '841761250675934', 'ADMIN1001', '', 1, 1477841782, 1477841782, 0),
(119, 'testref', 'new name', '23ae95a29f63f94d4dd0424d0c3e89361b8fc7f7', 'newchain1@gmail.com', 'newchain1@gmail.com', '9980569960', '', '20100101', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'agent', '33', 1, 0, 0, '908137', '841761250675934', 'ADMIN1001', '', 43, 1478335802, 1478335802, 0),
(120, 'Supplier', 'Sagar', 'e1c469e236c0969714fc78261131f41c1ce5fc3d', 'parking_sagar@gmail.com', 'parking_sagar@gmail.com', '9980569960', 'male', '1990-01-01', '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '32', 1, 0, 0, '853426', '416382982507304', 'ADMIN1001', '', 43, 1478336694, 1478336694, 0),
(121, 'Retailor', 'Rustum', '27274db1fd65ff5bd3795320d07a01237c26dee1', 'rustum_p@gmail.com', 'rustum_p@gmail.com', '8904977234', 'male', '1990-06-08', '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '33', 1, 1, 1478343702, '460271', '973014805628796', 'ADMIN1001', 'MS1_thumb.jpg', 43, 1478337363, 1478337363, 0),
(122, 'Retailor', 'Rustum', '89001b206abf89a8e5f1f66359a56ed201277281', 'new_460271@gmail.com', 'new_460271@gmail.com', '9980569960', 'male', '1990-06-08', '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '32', 1, 0, 1478339272, '947263', '973014805628796', '861203', 'MS1_thumb.jpg', 54, 1478337838, 1478337838, 0),
(123, 'Retailor', 'Rustum', '02ea35ddc4542911358b0c96d2aebab30b96ede6', 'new_947263@gmail.com', 'new_947263@gmail.com', '9980569960', 'male', '1990-06-08', '', '', '', 0, '', '0', 'India', 105, 0, '', '', 'agent', '6', 1, 0, 1478343542, '947350', '973014805628796', '861203', 'MS1_thumb.jpg', 54, 1478339181, 1478339181, 0),
(124, 'Bhavya', 'test', '713909cee975f7ae86adf03273e6cbc575203cd0', 'new_352640@gmail.com', 'new_352640@gmail.com', '9980569960', 'female', '2000-01-01', '', '', '', 0, '', 'KA04', 'India', 105, 0, '43245235', '', 'agent', '33', 1, 0, 1478339475, '345697', '886907147035149', '947263', '', 122, 1478339451, 1478339451, 0),
(125, 'Murthy22', 'Last Name2', '86fe407dbe9a6067855d6065b5f301189572335a', '936827@gmail.com', '936827@gmail.com', '895119916', 'female', '2000-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'agent', '6', 1, 0, 0, '476319', '741467618095203', '861203', '', 54, 1478440032, 1478440032, 0),
(126, 'testref', 'new name', '5fe655f9da57a17532d55c4dc8dca1bbdc9558f2', '978102@gmail.com', '978102@gmail.com', '988', '', '20100101', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'agent', '25', 1, 0, 0, '240397', '841761250675934', '861203', '', 54, 1478453959, 1478453959, 0),
(127, 'testref', 'new name', '7213eb02aa06930e0a97a965be2b9d8291d37379', 'new978102@gmail.com', 'new978102@gmail.com', '777', '', '20100101', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'agent', '25', 1, 0, 0, '316908', '841761250675934', '861203', '', 54, 1478454349, 1478454349, 0),
(128, 'newmember', '1', 'd8061304e2f6132e6365eb26f9640382ad29d3a7', 'newmember1@gmail.com', 'newmember1@gmail.com', '9980569960', '', '2016-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '280514', '439739847556186', '861203', '', 1, 1478576992, 1478576992, 0),
(129, 'newmember', '2', '179d702b92c0de3007da4f165b3d5823ba3d6e43', 'newmember2@gmail.com', 'newmember2@gmail.com', '9980569960', '', '2016-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '712608', '662881957170953', '861203', '', 1, 1478577129, 1478577129, 0),
(130, 'newmember', '3', '8bc953b2eb93a6f9d88a4f9938582e472ade12d5', 'newmember3@gmail.com', 'newmember3@gmail.com', '9980569960', '', '2016-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '597061', '386492145276510', '861203', '', 1, 1478577193, 1478577193, 0),
(131, 'newmember', '4', '5221cf8408eb0cd348b2108d36bc6f13f0410c37', 'newmember4@gmail.com', 'newmember4@gmail.com', '9980569960', '', '2016-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '396815', '809214326086791', '861203', '', 1, 1478577298, 1478577298, 0),
(132, 'newmember', '5', '1a294e7210f6b6bee4faed95481ce24ebc64ca92', 'newmember5@gmail.com', 'newmember5@gmail.com', '9980569960', '', '2016-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'user', '23', 0, 0, 0, '280716', '329640328550946', '861203', '', 1, 1478577347, 1478577347, 0),
(133, 'newmember', '6', 'f9b5bb0b4189feb7c465df26cacb6ab83a2b3d0f', 'newmember6@gmail.com', 'newmember6@gmail.com', '9980569960', '', '2016-01-01', '', '', '', 0, '', '', 'India', 105, 0, '', '', 'user', '23', 1, 1, 1478577490, '509634', '570547362980832', '861203', '', 1, 1478577423, 1478577423, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `acct_categories`
--
ALTER TABLE `acct_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
