-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 22, 2019 at 06:11 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `billdetail`
--

DROP TABLE IF EXISTS `billdetail`;
CREATE TABLE IF NOT EXISTS `billdetail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bill_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `taka_no` int(10) DEFAULT NULL,
  `rate` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=405 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billdetail`
--

INSERT INTO `billdetail` (`id`, `bill_id`, `product_id`, `quantity`, `taka_no`, `rate`) VALUES
(222, 17, 2, '8', NULL, '36'),
(221, 17, 2, '8', NULL, '36'),
(220, 16, 4, '10', NULL, '56'),
(219, 16, 4, '10', NULL, '56'),
(218, 16, 4, '10', NULL, '56'),
(217, 16, 4, '10', NULL, '56'),
(216, 15, 3, '10', NULL, '63.00'),
(215, 15, 3, '10', NULL, '63.00'),
(214, 15, 3, '10', NULL, '63.00'),
(213, 15, 3, '10', NULL, '63.00'),
(212, 15, 3, '10', NULL, '63.00'),
(211, 14, 3, '10', NULL, '63.00'),
(210, 14, 3, '10', NULL, '63.00'),
(209, 14, 3, '10', NULL, '63.00'),
(208, 14, 3, '10', NULL, '63.00'),
(207, 14, 3, '10', NULL, '63.00'),
(206, 14, 3, '10', NULL, '63.00'),
(205, 13, 5, '8', NULL, '55'),
(204, 13, 1, '26.3', 56, '21.62'),
(203, 13, 6, '9', 99, '99.99'),
(223, 17, 2, '8', NULL, '36'),
(224, 17, 2, '8', NULL, '36'),
(225, 18, 2, '8', NULL, '36'),
(226, 18, 2, '8', NULL, '36'),
(227, 18, 2, '8', NULL, '36'),
(228, 18, 2, '8', NULL, '36'),
(229, 19, 2, '8', NULL, '36'),
(230, 19, 2, '8', NULL, '36'),
(231, 19, 2, '8', NULL, '36'),
(232, 19, 2, '8', NULL, '36'),
(233, 20, 5, '6', NULL, '59'),
(234, 20, 2, '8', NULL, '12'),
(235, 20, 2, '8', NULL, '12'),
(236, 20, 2, '8', NULL, '12'),
(237, 20, 3, '8', NULL, '63.00'),
(238, 20, 3, '8', NULL, '63.00'),
(239, 20, 3, '8', NULL, '63.00'),
(240, 20, 3, '8', NULL, '63.00'),
(241, 21, 2, '6', 8, '36'),
(242, 21, 2, '6', 8, '36'),
(243, 21, 2, '6', 8, '36'),
(244, 21, 2, '6', 8, '36'),
(245, 22, 2, '6', 8, '36'),
(246, 22, 2, '6', 8, '36'),
(247, 22, 2, '6', 8, '36'),
(248, 22, 2, '6', 8, '36'),
(249, 23, 2, '8', 8, '36'),
(250, 23, 2, '8', 8, '36'),
(251, 23, 2, '8', 8, '36'),
(252, 23, 2, '8', 8, '36'),
(253, 23, 2, '8', 8, '36'),
(254, 24, 2, '8', 8, '36'),
(255, 24, 2, '8', 8, '36'),
(256, 24, 2, '8', 8, '36'),
(257, 24, 2, '8', 8, '36'),
(258, 24, 2, '8', 8, '36'),
(259, 24, 2, '8', 8, '36'),
(260, 24, 2, '8', 8, '36'),
(261, 25, 2, '8', 8, '36'),
(262, 25, 2, '8', 8, '36'),
(263, 25, 2, '8', 8, '36'),
(264, 25, 2, '8', 8, '36'),
(265, 25, 2, '8', 8, '36'),
(266, 25, 2, '8', 8, '36'),
(267, 26, 2, '11', NULL, '3'),
(268, 26, 2, '5', NULL, '36.5'),
(269, 26, 2, '5', NULL, '36.5'),
(270, 26, 2, '5', NULL, '36.5'),
(271, 26, 2, '5', NULL, '36.5'),
(272, 26, 2, '5', NULL, '36.5'),
(273, 26, 2, '5', NULL, '36.5'),
(274, 26, 2, '5', NULL, '36.5'),
(275, 26, 2, '5', NULL, '36.5'),
(276, 26, 2, '5', NULL, '36.5'),
(277, 27, 2, '6', NULL, '36'),
(278, 27, 2, '6', NULL, '36'),
(279, 27, 2, '6', NULL, '36'),
(280, 27, 2, '6', NULL, '36'),
(281, 27, 2, '6', NULL, '36'),
(282, 27, 2, '6', NULL, '36'),
(283, 27, 2, '6', NULL, '36'),
(284, 27, 2, '6', NULL, '36'),
(285, 28, 6, '2', NULL, '12.5'),
(286, 29, 5, '6', NULL, '59'),
(287, 29, 5, '6', NULL, '59'),
(288, 30, 2, '6', 8, '12.6'),
(289, 30, 2, '6', 8, '12.6'),
(290, 30, 2, '6', 8, '12.6'),
(291, 30, 2, '6', 8, '12.6'),
(292, 30, 2, '6', 8, '12.6'),
(293, 31, 3, '6', NULL, '63.00'),
(294, 31, 3, '6', NULL, '63.00'),
(295, 31, 3, '6', NULL, '63.00'),
(296, 32, 2, '6', NULL, '12'),
(297, 32, 2, '6', NULL, '12'),
(298, 32, 2, '6', NULL, '12'),
(300, 34, 2, '6', NULL, '36'),
(404, 54, 2, '7', NULL, '12'),
(305, 36, 5, '6', NULL, '59'),
(306, 37, 4, '8', NULL, '56'),
(307, 37, 4, '8', NULL, '56'),
(308, 37, 4, '8', NULL, '56'),
(309, 37, 4, '8', NULL, '56'),
(310, 37, 4, '8', NULL, '56'),
(311, 37, 4, '8', NULL, '56'),
(312, 37, 4, '8', NULL, '56'),
(313, 37, 4, '8', NULL, '56'),
(314, 37, 4, '8', NULL, '56'),
(315, 37, 4, '8', NULL, '56'),
(316, 37, 4, '8', NULL, '56'),
(317, 37, 4, '8', NULL, '56'),
(318, 37, 4, '8', NULL, '56'),
(319, 37, 4, '8', NULL, '56'),
(320, 37, 4, '8', NULL, '56'),
(321, 37, 4, '8', NULL, '56'),
(322, 37, 4, '8', NULL, '56'),
(323, 37, 4, '8', NULL, '56'),
(324, 37, 4, '8', NULL, '56'),
(325, 37, 4, '8', NULL, '56'),
(326, 37, 4, '8', NULL, '56'),
(327, 37, 4, '8', NULL, '56'),
(328, 37, 4, '8', NULL, '56'),
(329, 37, 4, '8', NULL, '56'),
(330, 37, 4, '8', NULL, '56'),
(403, 54, 2, '7', NULL, '12'),
(333, 39, 3, '8', NULL, '63.00'),
(334, 39, 3, '8', NULL, '63.00'),
(335, 40, 2, '6', NULL, '12'),
(336, 40, 2, '6', NULL, '12'),
(337, 40, 2, '6', NULL, '12'),
(338, 41, 1, '6', NULL, '21'),
(339, 42, 4, '6', NULL, '56'),
(340, 42, 4, '6', NULL, '56'),
(341, 42, 4, '6', NULL, '56'),
(342, 42, 4, '6', NULL, '56'),
(343, 43, 6, '8', NULL, '12.5'),
(344, 43, 6, '8', NULL, '12.5'),
(345, 43, 6, '8', NULL, '12.5'),
(346, 44, 2, '6', NULL, '36'),
(347, 44, 2, '6', NULL, '36'),
(348, 44, 2, '6', NULL, '36'),
(349, 44, 2, '6', NULL, '36'),
(350, 44, 2, '6', NULL, '36'),
(351, 45, 2, '6', NULL, '36'),
(352, 45, 2, '6', NULL, '36'),
(353, 45, 2, '6', NULL, '36'),
(354, 45, 2, '6', NULL, '36'),
(355, 45, 2, '6', NULL, '36'),
(356, 45, 2, '6', NULL, '36'),
(357, 46, 2, '6', NULL, '36'),
(358, 46, 2, '6', NULL, '36'),
(359, 46, 2, '6', NULL, '36'),
(360, 46, 2, '6', NULL, '36'),
(361, 46, 2, '6', NULL, '36'),
(362, 46, 2, '6', NULL, '36'),
(363, 47, 2, '8', NULL, '36'),
(364, 47, 2, '8', NULL, '36'),
(365, 47, 2, '8', NULL, '36'),
(366, 47, 2, '8', NULL, '36'),
(367, 47, 2, '8', NULL, '36'),
(368, 47, 2, '8', NULL, '36'),
(369, 48, 2, '2', 8, '36'),
(370, 48, 2, '2', NULL, '36'),
(371, 48, 2, '2', NULL, '36'),
(372, 48, 2, '2', NULL, '36'),
(373, 49, 2, '8', NULL, '12'),
(374, 49, 2, '8', NULL, '12'),
(375, 50, 1, '6', NULL, '21'),
(376, 50, 1, '6', NULL, '21'),
(377, 50, 1, '6', NULL, '21'),
(378, 50, 2, '6', NULL, '12'),
(379, 50, 2, '6', NULL, '12'),
(380, 50, 2, '6', NULL, '12'),
(381, 50, 2, '6', NULL, '12');

-- --------------------------------------------------------

--
-- Table structure for table `bill_data`
--

DROP TABLE IF EXISTS `bill_data`;
CREATE TABLE IF NOT EXISTS `bill_data` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `taka_no` int(10) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `rate` varchar(10) NOT NULL,
  `cust_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_list`
--

DROP TABLE IF EXISTS `bill_list`;
CREATE TABLE IF NOT EXISTS `bill_list` (
  `bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `invoice_no` varchar(10) NOT NULL,
  `sub_total` varchar(10) NOT NULL,
  `grand_total` varchar(10) NOT NULL,
  `round_off` varchar(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `place_of_supply` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_list`
--

INSERT INTO `bill_list` (`bill_id`, `username`, `invoice_no`, `sub_total`, `grand_total`, `round_off`, `cust_id`, `place_of_supply`, `date`, `time`) VALUES
(13, 'abc', 'AA002', '1908.52', '2004', '0.06', 1, '364002', '2019-05-11', '11:45:52'),
(14, 'abc', 'AA003', '3780', '3969', '0', 6, '', '2019-06-07', '11:48:35'),
(15, 'abc', 'AA004', '3150', '3308', '0.5', 5, '', '2019-06-07', '11:49:21'),
(16, 'abc', 'AA005', '2240', '2352', '0', 6, '', '2019-06-07', '11:50:27'),
(17, 'admin', 'AA001', '1152', '1210', '0.4', 1, '', '2019-06-07', '11:51:28'),
(18, 'admin', 'AA002', '1152', '1210', '0.4', 1, '', '2019-06-07', '11:53:16'),
(19, 'admin', 'AA003', '1152', '1210', '0.4', 1, '', '2019-06-07', '11:54:57'),
(20, 'abc', 'AA006', '2658', '2791', '0.1', 5, 'hiii', '2019-06-07', '11:56:58'),
(21, 'admin', 'AA004', '864', '907', '0.2', 1, '', '2019-06-07', '11:59:32'),
(22, 'admin', 'AA005', '864', '907', '0.2', 1, '122', '2019-06-07', '12:00:35'),
(23, 'admin', 'AA006', '1440', '1512', '0', 1, '', '2019-06-07', '12:04:56'),
(24, 'admin', 'AA007', '2016', '2117', '0.2', 1, '', '2019-06-07', '12:05:40'),
(25, 'admin', 'AA008', '1728', '1814', '0.4', 1, '', '2019-06-07', '12:07:31'),
(26, 'admin', 'AA009', '1675.5', '1759', '0.28', 1, '', '2019-06-07', '12:08:17'),
(27, 'admin', 'AA010', '1728', '1814', '0.4', 1, '', '2019-06-07', '12:10:12'),
(28, 'abc', 'AA007', '25', '26', '0.26', 5, '', '2019-06-07', '12:15:30'),
(29, 'abc', 'AA008', '708', '743', '0.4', 1, '', '2019-06-07', '12:16:23'),
(30, 'abc', 'AA009', '378', '397', '0.1', 6, '', '2019-06-07', '12:18:08'),
(31, 'abc', 'AA010', '1134', '1191', '0.3', 5, '', '2019-06-07', '12:20:26'),
(32, 'abc', 'AA011', '216', '227', '0.2', 5, '', '2019-06-07', '12:25:02'),
(34, 'admin', 'AA011', '216', '227', '0.2', 1, '', '2019-06-07', '12:31:03'),
(54, 'abc', 'AA024', '168', '176', '0.4', 1, '', '2019-06-10', '14:17:48'),
(36, 'abc', 'AA014', '354', '372', '0.3', 6, '', '2019-06-07', '12:43:11'),
(37, 'abc', 'AA015', '11200', '11760', '0', 1, '', '2019-06-07', '12:44:50'),
(39, 'abc', 'AA017', '1008', '1058', '0.4', 6, '', '2019-06-07', '12:50:23'),
(40, 'abc', 'AA018', '216', '227', '0.2', 5, '', '2019-06-07', '12:51:09'),
(41, 'abc', 'AA019', '126', '132', '0.3', 5, '', '2019-06-07', '12:56:45'),
(42, 'abc', 'AA020', '1344', '1411', '0.2', 5, '', '2019-06-07', '13:21:16'),
(43, 'abc', 'AA021', '300', '315', '0', 5, '', '2019-06-07', '13:34:28'),
(44, 'admin', 'AA012', '1080', '1134', '0', 1, '', '2019-06-07', '14:41:49'),
(45, 'admin', 'AA013', '1296', '1361', '0.2', 1, '', '2019-06-07', '14:42:21'),
(46, 'admin', 'AA014', '1296', '1361', '0.2', 1, '', '2019-06-07', '14:45:23'),
(47, 'admin', 'AA015', '1728', '1814', '0.4', 1, '', '2019-06-07', '14:48:20'),
(48, 'admin', 'AA016', '288', '302', '0.4', 1, 'fsgtg', '2019-06-07', '14:53:38'),
(49, 'abc', 'AA022', '192', '202', '0.4', 5, '', '2019-06-08', '13:49:31'),
(50, 'abc', 'AA023', '666', '699', '0.3', 5, '', '2019-06-09', '17:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `cust_id` varchar(10) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `addr` varchar(100) DEFAULT NULL,
  `gstin_no` varchar(15) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `phone_no` varchar(10) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`cust_id`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `customer_name`, `addr`, `gstin_no`, `pan_no`, `phone_no`, `username`) VALUES
('1', 'nimesh', 'bhavnagar', '12DG31523652369', 'RT553T1236', '8511033395', 'abc'),
('1', 'Nimesh', 'c- 2058/ ocean parkfcb gknknsfdkgnjbkjn blfljfknc kl afdljk knvnxknlfdbksn dnskdkfm ndnbdx.', 'ABCDE1234567899', '123555ABCD', '8511033392', 'admin'),
('5', 'Nimesh Italiya', 'ITALIYA NIMESHKUMAR RAJESHBHAI, C-2058,STREET NO.3,OCEANPARK, KALIYABID, Gujarat, pincode: 364002', 'ABCD123444', '123455S', '8511033392', 'abc'),
('6', 'Sonani Aakash', 'C-2062/A', '123455ACV', '123455', '8460159924', 'abc'),
('7', 'ITALIYA NIMESH RAJUBHAI', 'ITALIYA NIMESHKUMAR RAJESHBHAI,\r\nC-2058,STREET NO.3,OCEANPARK,K', 'ABCD123456', '123455ABCD', '8511033392', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `keys_`
--

DROP TABLE IF EXISTS `keys_`;
CREATE TABLE IF NOT EXISTS `keys_` (
  `id_no` int(11) NOT NULL,
  `key_val` varchar(19) NOT NULL,
  `valid` int(1) NOT NULL,
  PRIMARY KEY (`id_no`),
  UNIQUE KEY `key_val` (`key_val`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keys_`
--

INSERT INTO `keys_` (`id_no`, `key_val`, `valid`) VALUES
(1, '1234-5678-9101-1213', 0),
(2, 'abcd-efgh-ijkl-mnop', 0),
(3, 'abcd-efgh-1234-mnop', 1),
(4, 'abcd-2568-1234-mnop', 1),
(5, '1234-abcd-9101-1213', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(10) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `available_quantity` varchar(10) DEFAULT '0',
  `hsn_no` int(10) DEFAULT NULL,
  `rate` varchar(10) NOT NULL,
  `dealer_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`username`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `available_quantity`, `hsn_no`, `rate`, `dealer_name`, `username`) VALUES
(1, 'xyz', '18.5', 365, '21', 'Nimesh', 'abc'),
(2, 'ABC', '18', NULL, '12', 'Italiya', 'abc'),
(2, 'xyz', '100', 256, '36', 'Nimesh', 'admin'),
(3, 'fdsfhd', '3455', 5, '63.00', 'dfdbghm rn', 'abc'),
(4, 'jbrtbgf', '6620', 5404, '56', 'ebss', 'abc'),
(5, 'nims', '24.5', NULL, '59', 'mkl', 'abc'),
(6, 'Hiii Nimesh', '123', 125, '12.5', 'rygh', 'abc'),
(3, 'njjhbhu', '36', NULL, '21', 'fybvfytu', 'admin'),
(4, 'gyuybj', '', 25, '', 'vfgddvfre', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `key_id` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `key_id` (`key_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `pass`, `key_id`) VALUES
('17CE036', '17CE036@charusat.edu.in', '040100', 1),
('admin', 'abc@gmail.com', 'admin', 2),
('abc', 'italiyanimesh333@gmail.com', '1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

DROP TABLE IF EXISTS `user_detail`;
CREATE TABLE IF NOT EXISTS `user_detail` (
  `username` varchar(30) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `addr` varchar(100) NOT NULL,
  `phone_no_1` varchar(10) NOT NULL,
  `phone_no_2` varchar(10) DEFAULT NULL,
  `gstin_no` varchar(15) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `bank_branch_name` varchar(50) DEFAULT NULL,
  `bank_ac_number` varchar(30) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `gstin_no` (`gstin_no`),
  UNIQUE KEY `pan_no` (`pan_no`),
  UNIQUE KEY `gstin_no_2` (`gstin_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`username`, `company_name`, `addr`, `phone_no_1`, `phone_no_2`, `gstin_no`, `pan_no`, `email`, `bank_name`, `bank_branch_name`, `bank_ac_number`, `ifsc_code`) VALUES
('abc', 'Abc Company', 'C-2058/ ocean- park 3, kaliyabid, bhavnagar 364002', '9825575889', '8511033392', '2356897410ABCDE', '1245789630', '17ce036@gmail.com', 'IDBI', 'bhavnagar', '123456780', '124578'),
('admin', 'Admin Fashion', 'C-2062/A, street No 3, ocean park , kaliyabid , Bhavnagar', '8460159923', '', 'ABCDE1234567890', '123455ABCD', 'nitaliya.2000@gmail.com', 'SBI', 'BHAGVATI', '1234567892', 'SBIN1234');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
