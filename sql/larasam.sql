-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 05:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larasam`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(100) NOT NULL,
  `user_id` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `activity` longtext NOT NULL,
  `date_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `name`, `email`, `activity`, `date_time`, `created_at`, `updated_at`) VALUES
(1, '1', 'Administrator', 'admin@samvicktech.com', 'Logged in to own account.', '2022-04-12 18:26:43', NULL, NULL),
(2, '1', 'Administrator', 'admin@samvicktech.com', 'Logged in to own account.', '2022-04-12 18:26:44', NULL, NULL),
(3, '1', 'Administrator', 'admin@samvicktech.com', 'Logged in to own account.', '2022-04-18 12:17:23', NULL, NULL),
(4, '1', 'Administrator', 'admin@samvicktech.com', 'Logged in to own account.', '2022-04-18 15:07:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_messages`
--

CREATE TABLE `admin_messages` (
  `id` int(100) NOT NULL,
  `ticket_id` varchar(20) NOT NULL DEFAULT '',
  `sender_name` varchar(50) NOT NULL DEFAULT '',
  `sender_email` varchar(50) NOT NULL DEFAULT '',
  `sender_phone` varchar(50) NOT NULL DEFAULT '',
  `recipient_name` varchar(50) NOT NULL DEFAULT '',
  `recipient_email` varchar(50) NOT NULL DEFAULT '',
  `subject` varchar(200) NOT NULL DEFAULT '',
  `message` longtext NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `inbox` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `sent` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `date_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries_codes`
--

CREATE TABLE `countries_codes` (
  `id` int(11) UNSIGNED NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(50) NOT NULL DEFAULT '',
  `payment_page` varchar(50) NOT NULL DEFAULT 'us-payment',
  `how_to_pay` varchar(100) NOT NULL DEFAULT 'how-to-pay-usd'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries_codes`
--

INSERT INTO `countries_codes` (`id`, `country`, `code`, `payment_page`, `how_to_pay`) VALUES
(1, 'Afghanistan', '93', 'us-payment', 'how-to-pay-usd'),
(2, 'Albania', '355', 'us-payment', 'how-to-pay-usd'),
(3, 'Algeria', '213', 'us-payment', 'how-to-pay-usd'),
(4, 'American Samoa', '1-684', 'us-payment', 'how-to-pay-usd'),
(5, 'Andorra', '376', 'us-payment', 'how-to-pay-usd'),
(6, 'Angola', '244', 'us-payment', 'how-to-pay-usd'),
(7, 'Anguilla', '1-264', 'us-payment', 'how-to-pay-usd'),
(8, 'Antarctica', '672', 'us-payment', 'how-to-pay-usd'),
(9, 'Antigua and Barbuda', '1-268', 'us-payment', 'how-to-pay-usd'),
(10, 'Argentina', '54', 'us-payment', 'how-to-pay-usd'),
(11, 'Armenia', '374', 'us-payment', 'how-to-pay-usd'),
(12, 'Aruba', '297', 'us-payment', 'how-to-pay-usd'),
(13, 'Australia', '61', 'us-payment', 'how-to-pay-usd'),
(14, 'Austria', '43', 'us-payment', 'how-to-pay-usd'),
(15, 'Azerbaijan', '994', 'us-payment', 'how-to-pay-usd'),
(16, 'Bahamas', '1-242', 'us-payment', 'how-to-pay-usd'),
(17, 'Bahrain', '973', 'us-payment', 'how-to-pay-usd'),
(18, 'Bangladesh', '880', 'us-payment', 'how-to-pay-usd'),
(19, 'Barbados', '1-246', 'us-payment', 'how-to-pay-usd'),
(20, 'Belarus', '375', 'us-payment', 'how-to-pay-usd'),
(21, 'Belgium', '32', 'us-payment', 'how-to-pay-usd'),
(22, 'Belize', '501', 'us-payment', 'how-to-pay-usd'),
(23, 'Benin', '229', 'us-payment', 'how-to-pay-usd'),
(24, 'Bermuda', '1-441', 'us-payment', 'how-to-pay-usd'),
(25, 'Bhutan', '975', 'us-payment', 'how-to-pay-usd'),
(26, 'Bolivia', '591', 'us-payment', 'how-to-pay-usd'),
(27, 'Bosnia and Herzegovina', '387', 'us-payment', 'how-to-pay-usd'),
(28, 'Botswana', '267', 'us-payment', 'how-to-pay-usd'),
(29, 'Brazil', '55', 'us-payment', 'how-to-pay-usd'),
(30, 'British Indian Ocean Territory', '246', 'us-payment', 'how-to-pay-usd'),
(31, 'British Virgin Islands', '1-284', 'us-payment', 'how-to-pay-usd'),
(32, 'Brunei', '673', 'us-payment', 'how-to-pay-usd'),
(33, 'Bulgaria', '359', 'us-payment', 'how-to-pay-usd'),
(34, 'Burkina Faso', '226', 'us-payment', 'how-to-pay-usd'),
(35, 'Burundi', '257', 'us-payment', 'how-to-pay-usd'),
(36, 'Cambodia', '855', 'us-payment', 'how-to-pay-usd'),
(37, 'Cameroon', '237', 'us-payment', 'how-to-pay-usd'),
(38, 'Canada', '1', 'us-payment', 'how-to-pay-usd'),
(39, 'Cape Verde', '238', 'us-payment', 'how-to-pay-usd'),
(40, 'Cayman Islands', '1-345', 'us-payment', 'how-to-pay-usd'),
(41, 'Central African Republic', '236', 'us-payment', 'how-to-pay-usd'),
(42, 'Chad', '235', 'us-payment', 'how-to-pay-usd'),
(43, 'Chile', '56', 'us-payment', 'how-to-pay-usd'),
(44, 'China', '86', 'us-payment', 'how-to-pay-usd'),
(45, 'Christmas Island', '61', 'us-payment', 'how-to-pay-usd'),
(46, 'Cocos Islands', '61', 'us-payment', 'how-to-pay-usd'),
(47, 'Colombia', '57', 'us-payment', 'how-to-pay-usd'),
(48, 'Comoros', '269', 'us-payment', 'how-to-pay-usd'),
(49, 'Cook Islands', '682', 'us-payment', 'how-to-pay-usd'),
(50, 'Costa Rica', '506', 'us-payment', 'how-to-pay-usd'),
(51, 'Croatia', '385', 'us-payment', 'how-to-pay-usd'),
(52, 'Cuba', '53', 'us-payment', 'how-to-pay-usd'),
(53, 'Curacao', '599', 'us-payment', 'how-to-pay-usd'),
(54, 'Cyprus', '357', 'us-payment', 'how-to-pay-usd'),
(55, 'Czech Republic', '420', 'us-payment', 'how-to-pay-usd'),
(56, 'Democratic Republic of the Congo', '243', 'us-payment', 'how-to-pay-usd'),
(57, 'Denmark', '45', 'us-payment', 'how-to-pay-usd'),
(58, 'Djibouti', '253', 'us-payment', 'how-to-pay-usd'),
(59, 'Dominica', '1-767', 'us-payment', 'how-to-pay-usd'),
(60, 'Dominican Republic', '1-809, 1-829, 1-849', 'us-payment', 'how-to-pay-usd'),
(61, 'East Timor', '670', 'us-payment', 'how-to-pay-usd'),
(62, 'Ecuador', '593', 'us-payment', 'how-to-pay-usd'),
(63, 'Egypt', '20', 'us-payment', 'how-to-pay-usd'),
(64, 'El Salvador', '503', 'us-payment', 'how-to-pay-usd'),
(65, 'Equatorial Guinea', '240', 'us-payment', 'how-to-pay-usd'),
(66, 'Eritrea', '291', 'us-payment', 'how-to-pay-usd'),
(67, 'Estonia', '372', 'us-payment', 'how-to-pay-usd'),
(68, 'Ethiopia', '251', 'us-payment', 'how-to-pay-usd'),
(69, 'Falkland Islands', '500', 'us-payment', 'how-to-pay-usd'),
(70, 'Faroe Islands', '298', 'us-payment', 'how-to-pay-usd'),
(71, 'Fiji', '679', 'us-payment', 'how-to-pay-usd'),
(72, 'Finland', '358', 'us-payment', 'how-to-pay-usd'),
(73, 'France', '33', 'us-payment', 'how-to-pay-usd'),
(74, 'French Polynesia', '689', 'us-payment', 'how-to-pay-usd'),
(75, 'Gabon', '241', 'us-payment', 'how-to-pay-usd'),
(76, 'Gambia', '220', 'us-payment', 'how-to-pay-usd'),
(77, 'Georgia', '995', 'us-payment', 'how-to-pay-usd'),
(78, 'Germany', '49', 'us-payment', 'how-to-pay-usd'),
(79, 'Ghana', '233', 'us-payment', 'how-to-pay-usd'),
(80, 'Gibraltar', '350', 'us-payment', 'how-to-pay-usd'),
(81, 'Greece', '30', 'us-payment', 'how-to-pay-usd'),
(82, 'Greenland', '299', 'us-payment', 'how-to-pay-usd'),
(83, 'Grenada', '1-473', 'us-payment', 'how-to-pay-usd'),
(84, 'Guam', '1-671', 'us-payment', 'how-to-pay-usd'),
(85, 'Guatemala', '502', 'us-payment', 'how-to-pay-usd'),
(86, 'Guernsey', '44-1481', 'us-payment', 'how-to-pay-usd'),
(87, 'Guinea', '224', 'us-payment', 'how-to-pay-usd'),
(88, 'Guinea-Bissau', '245', 'us-payment', 'how-to-pay-usd'),
(89, 'Guyana', '592', 'us-payment', 'how-to-pay-usd'),
(90, 'Haiti', '509', 'us-payment', 'how-to-pay-usd'),
(91, 'Honduras', '504', 'us-payment', 'how-to-pay-usd'),
(92, 'Hong Kong', '852', 'us-payment', 'how-to-pay-usd'),
(93, 'Hungary', '36', 'us-payment', 'how-to-pay-usd'),
(94, 'Iceland', '354', 'us-payment', 'how-to-pay-usd'),
(95, 'India', '91', 'us-payment', 'how-to-pay-usd'),
(96, 'Indonesia', '62', 'us-payment', 'how-to-pay-usd'),
(97, 'Iran', '98', 'us-payment', 'how-to-pay-usd'),
(98, 'Iraq', '964', 'us-payment', 'how-to-pay-usd'),
(99, 'Ireland', '353', 'us-payment', 'how-to-pay-usd'),
(100, 'Isle of Man', '44-1624', 'us-payment', 'how-to-pay-usd'),
(101, 'Israel', '972', 'us-payment', 'how-to-pay-usd'),
(102, 'Italy', '39', 'us-payment', 'how-to-pay-usd'),
(103, 'Ivory Coast', '225', 'us-payment', 'how-to-pay-usd'),
(104, 'Jamaica', '1-876', 'us-payment', 'how-to-pay-usd'),
(105, 'Japan', '81', 'us-payment', 'how-to-pay-usd'),
(106, 'Jersey', '44-1534', 'us-payment', 'how-to-pay-usd'),
(107, 'Jordan', '962', 'us-payment', 'how-to-pay-usd'),
(108, 'Kazakhstan', '7', 'us-payment', 'how-to-pay-usd'),
(109, 'Kenya', '254', 'us-payment', 'how-to-pay-usd'),
(110, 'Kiribati', '686', 'us-payment', 'how-to-pay-usd'),
(111, 'Kosovo', '383', 'us-payment', 'how-to-pay-usd'),
(112, 'Kuwait', '965', 'us-payment', 'how-to-pay-usd'),
(113, 'Kyrgyzstan', '996', 'us-payment', 'how-to-pay-usd'),
(114, 'Laos', '856', 'us-payment', 'how-to-pay-usd'),
(115, 'Latvia', '371', 'us-payment', 'how-to-pay-usd'),
(116, 'Lebanon', '961', 'us-payment', 'how-to-pay-usd'),
(117, 'Lesotho', '266', 'us-payment', 'how-to-pay-usd'),
(118, 'Liberia', '231', 'us-payment', 'how-to-pay-usd'),
(119, 'Libya', '218', 'us-payment', 'how-to-pay-usd'),
(120, 'Liechtenstein', '423', 'us-payment', 'how-to-pay-usd'),
(121, 'Lithuania', '370', 'us-payment', 'how-to-pay-usd'),
(122, 'Luxembourg', '352', 'us-payment', 'how-to-pay-usd'),
(123, 'Macau', '853', 'us-payment', 'how-to-pay-usd'),
(124, 'Macedonia', '389', 'us-payment', 'how-to-pay-usd'),
(125, 'Madagascar', '261', 'us-payment', 'how-to-pay-usd'),
(126, 'Malawi', '265', 'us-payment', 'how-to-pay-usd'),
(127, 'Malaysia', '60', 'us-payment', 'how-to-pay-usd'),
(128, 'Maldives', '960', 'us-payment', 'how-to-pay-usd'),
(129, 'Mali', '223', 'us-payment', 'how-to-pay-usd'),
(130, 'Malta', '356', 'us-payment', 'how-to-pay-usd'),
(131, 'Marshall Islands', '692', 'us-payment', 'how-to-pay-usd'),
(132, 'Mauritania', '222', 'us-payment', 'how-to-pay-usd'),
(133, 'Mauritius', '230', 'us-payment', 'how-to-pay-usd'),
(134, 'Mayotte', '262', 'us-payment', 'how-to-pay-usd'),
(135, 'Mexico', '52', 'us-payment', 'how-to-pay-usd'),
(136, 'Micronesia', '691', 'us-payment', 'how-to-pay-usd'),
(137, 'Moldova', '373', 'us-payment', 'how-to-pay-usd'),
(138, 'Monaco', '377', 'us-payment', 'how-to-pay-usd'),
(139, 'Mongolia', '976', 'us-payment', 'how-to-pay-usd'),
(140, 'Montenegro', '382', 'us-payment', 'how-to-pay-usd'),
(141, 'Montserrat', '1-664', 'us-payment', 'how-to-pay-usd'),
(142, 'Morocco', '212', 'us-payment', 'how-to-pay-usd'),
(143, 'Mozambique', '258', 'us-payment', 'how-to-pay-usd'),
(144, 'Myanmar', '95', 'us-payment', 'how-to-pay-usd'),
(145, 'Namibia', '264', 'us-payment', 'how-to-pay-usd'),
(146, 'Nauru', '674', 'us-payment', 'how-to-pay-usd'),
(147, 'Nepal', '977', 'us-payment', 'how-to-pay-usd'),
(148, 'Netherlands', '31', 'us-payment', 'how-to-pay-usd'),
(149, 'Netherlands Antilles', '599', 'us-payment', 'how-to-pay-usd'),
(150, 'New Caledonia', '687', 'us-payment', 'how-to-pay-usd'),
(151, 'New Zealand', '64', 'us-payment', 'how-to-pay-usd'),
(152, 'Nicaragua', '505', 'us-payment', 'how-to-pay-usd'),
(153, 'Niger', '227', 'us-payment', 'how-to-pay-usd'),
(154, 'Nigeria', '234', 'ng-payment', 'how-to-pay-ngn'),
(155, 'Niue', '683', 'us-payment', 'how-to-pay-usd'),
(156, 'North Korea', '850', 'us-payment', 'how-to-pay-usd'),
(157, 'Northern Mariana Islands', '1-670', 'us-payment', 'how-to-pay-usd'),
(158, 'Norway', '47', 'us-payment', 'how-to-pay-usd'),
(159, 'Oman', '968', 'us-payment', 'how-to-pay-usd'),
(160, 'Pakistan', '92', 'us-payment', 'how-to-pay-usd'),
(161, 'Palau', '680', 'us-payment', 'how-to-pay-usd'),
(162, 'Palestine', '970', 'us-payment', 'how-to-pay-usd'),
(163, 'Panama', '507', 'us-payment', 'how-to-pay-usd'),
(164, 'Papua New Guinea', '675', 'us-payment', 'how-to-pay-usd'),
(165, 'Paraguay', '595', 'us-payment', 'how-to-pay-usd'),
(166, 'Peru', '51', 'us-payment', 'how-to-pay-usd'),
(167, 'Philippines', '63', 'us-payment', 'how-to-pay-usd'),
(168, 'Pitcairn', '64', 'us-payment', 'how-to-pay-usd'),
(169, 'Poland', '48', 'us-payment', 'how-to-pay-usd'),
(170, 'Portugal', '351', 'us-payment', 'how-to-pay-usd'),
(171, 'Puerto Rico', '1-787, 1-939', 'us-payment', 'how-to-pay-usd'),
(172, 'Qatar', '974', 'us-payment', 'how-to-pay-usd'),
(173, 'Republic of the Congo', '242', 'us-payment', 'how-to-pay-usd'),
(174, 'Reunion', '262', 'us-payment', 'how-to-pay-usd'),
(175, 'Romania', '40', 'us-payment', 'how-to-pay-usd'),
(176, 'Russia', '7', 'us-payment', 'how-to-pay-usd'),
(177, 'Rwanda', '250', 'us-payment', 'how-to-pay-usd'),
(178, 'Saint Barthelemy', '590', 'us-payment', 'how-to-pay-usd'),
(179, 'Saint Helena', '290', 'us-payment', 'how-to-pay-usd'),
(180, 'Saint Kitts and Nevis', '1-869', 'us-payment', 'how-to-pay-usd'),
(181, 'Saint Lucia', '1-758', 'us-payment', 'how-to-pay-usd'),
(182, 'Saint Martin', '590', 'us-payment', 'how-to-pay-usd'),
(183, 'Saint Pierre and Miquelon', '508', 'us-payment', 'how-to-pay-usd'),
(184, 'Saint Vincent and the Grenadines', '1-784', 'us-payment', 'how-to-pay-usd'),
(185, 'Samoa', '685', 'us-payment', 'how-to-pay-usd'),
(186, 'San Marino', '378', 'us-payment', 'how-to-pay-usd'),
(187, 'Sao Tome and Principe', '239', 'us-payment', 'how-to-pay-usd'),
(188, 'Saudi Arabia', '966', 'us-payment', 'how-to-pay-usd'),
(189, 'Senegal', '221', 'us-payment', 'how-to-pay-usd'),
(190, 'Serbia', '381', 'us-payment', 'how-to-pay-usd'),
(191, 'Seychelles', '248', 'us-payment', 'how-to-pay-usd'),
(192, 'Sierra Leone', '232', 'us-payment', 'how-to-pay-usd'),
(193, 'Singapore', '65', 'us-payment', 'how-to-pay-usd'),
(194, 'Sint Maarten', '1-721', 'us-payment', 'how-to-pay-usd'),
(195, 'Slovakia', '421', 'us-payment', 'how-to-pay-usd'),
(196, 'Slovenia', '386', 'us-payment', 'how-to-pay-usd'),
(197, 'Solomon Islands', '677', 'us-payment', 'how-to-pay-usd'),
(198, 'Somalia', '252', 'us-payment', 'how-to-pay-usd'),
(199, 'South Africa', '27', 'us-payment', 'how-to-pay-usd'),
(200, 'South Korea', '82', 'us-payment', 'how-to-pay-usd'),
(201, 'South Sudan', '211', 'us-payment', 'how-to-pay-usd'),
(202, 'Spain', '34', 'us-payment', 'how-to-pay-usd'),
(203, 'Sri Lanka', '94', 'us-payment', 'how-to-pay-usd'),
(204, 'Sudan', '249', 'us-payment', 'how-to-pay-usd'),
(205, 'Suriname', '597', 'us-payment', 'how-to-pay-usd'),
(206, 'Svalbard and Jan Mayen', '47', 'us-payment', 'how-to-pay-usd'),
(207, 'Swaziland', '268', 'us-payment', 'how-to-pay-usd'),
(208, 'Sweden', '46', 'us-payment', 'how-to-pay-usd'),
(209, 'Switzerland', '41', 'us-payment', 'how-to-pay-usd'),
(210, 'Syria', '963', 'us-payment', 'how-to-pay-usd'),
(211, 'Taiwan', '886', 'us-payment', 'how-to-pay-usd'),
(212, 'Tajikistan', '992', 'us-payment', 'how-to-pay-usd'),
(213, 'Tanzania', '255', 'us-payment', 'how-to-pay-usd'),
(214, 'Thailand', '66', 'us-payment', 'how-to-pay-usd'),
(215, 'Togo', '228', 'us-payment', 'how-to-pay-usd'),
(216, 'Tokelau', '690', 'us-payment', 'how-to-pay-usd'),
(217, 'Tonga', '676', 'us-payment', 'how-to-pay-usd'),
(218, 'Trinidad and Tobago', '1-868', 'us-payment', 'how-to-pay-usd'),
(219, 'Tunisia', '216', 'us-payment', 'how-to-pay-usd'),
(220, 'Turkey', '90', 'us-payment', 'how-to-pay-usd'),
(221, 'Turkmenistan', '993', 'us-payment', 'how-to-pay-usd'),
(222, 'Turks and Caicos Islands', '1-649', 'us-payment', 'how-to-pay-usd'),
(223, 'Tuvalu', '688', 'us-payment', 'how-to-pay-usd'),
(224, 'U.S. Virgin Islands', '1-340', 'us-payment', 'how-to-pay-usd'),
(225, 'Uganda', '256', 'us-payment', 'how-to-pay-usd'),
(226, 'Ukraine', '380', 'us-payment', 'how-to-pay-usd'),
(227, 'United Arab Emirates', '971', 'us-payment', 'how-to-pay-usd'),
(228, 'United Kingdom', '44', 'us-payment', 'how-to-pay-usd'),
(229, 'United States', '1', 'us-payment', 'how-to-pay-usd'),
(230, 'Uruguay', '598', 'us-payment', 'how-to-pay-usd'),
(231, 'Uzbekistan', '998', 'us-payment', 'how-to-pay-usd'),
(232, 'Vanuatu', '678', 'us-payment', 'how-to-pay-usd'),
(233, 'Vatican', '379', 'us-payment', 'how-to-pay-usd'),
(234, 'Venezuela', '58', 'us-payment', 'how-to-pay-usd'),
(235, 'Vietnam', '84', 'us-payment', 'how-to-pay-usd'),
(236, 'Wallis and Futuna', '681', 'us-payment', 'how-to-pay-usd'),
(237, 'Western Sahara', '212', 'us-payment', 'how-to-pay-usd'),
(238, 'Yemen', '967', 'us-payment', 'how-to-pay-usd'),
(239, 'Zambia', '260', 'us-payment', 'how-to-pay-usd'),
(240, 'Zimbabwe', '263', 'us-payment', 'how-to-pay-usd'),
(241, 'Congo', '242', 'us-payment', 'how-to-pay-usd');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_governments`
--

CREATE TABLE `local_governments` (
  `id` int(20) NOT NULL,
  `state` varchar(200) NOT NULL,
  `local_government` varchar(200) NOT NULL,
  `local_government_slug` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `local_governments`
--

INSERT INTO `local_governments` (`id`, `state`, `local_government`, `local_government_slug`) VALUES
(1, '9', 'Abadam', 'abadam'),
(2, '2', 'Abaji', 'abaji'),
(3, '4', 'Abak', 'abak'),
(4, '12', 'Abakaliki', 'abakaliki'),
(5, '1', 'Aba North', 'aba-north'),
(6, '1', 'Aba South', 'aba-south'),
(7, '28', 'Abeokuta North', 'abeokuta-north'),
(8, '28', 'Abeokuta South', 'abeokuta-south'),
(9, '10', 'Abi', 'abi'),
(10, '17', 'Aboh Mbaise', 'aboh-mbaise'),
(11, '33', 'Abua/Odual', 'abua-odual'),
(12, '23', 'Adavi', 'adavi'),
(13, '14', 'Ado Ekiti', 'ado-ekiti'),
(14, '28', 'Ado-Odo/Ota', 'ado-odo-ota'),
(15, '31', 'Afijio', 'afijio'),
(16, '12', 'Afikpo North', 'afikpo-north'),
(17, '12', 'Afikpo South', 'afikpo-south'),
(18, '27', 'Agaie', 'agaie'),
(19, '8', 'Agatu', 'agatu'),
(20, '27', 'Agwara', 'agwara'),
(21, '25', 'Agege', 'agege'),
(22, '5', 'Aguata', 'aguata'),
(23, '17', 'Ahiazu Mbaise', 'ahiazu-mbaise'),
(24, '33', 'Ahoada East', 'ahoada-east'),
(25, '33', 'Ahoada West', 'ahoada-west'),
(26, '23', 'Ajaokuta', 'ajaokuta'),
(27, '25', 'Ajeromi-Ifelodun', 'ajeromi-ifelodun'),
(28, '20', 'Ajingi', 'ajingi'),
(29, '10', 'Akamkpa', 'akamkpa'),
(30, '31', 'Akinyele', 'akinyele'),
(31, '16', 'Akko', 'akko'),
(32, '13', 'Akoko-Edo', 'akoko-edo'),
(33, '29', 'Akoko North-East', 'akoko-north-east'),
(34, '29', 'Akoko North-West', 'akoko-north-west'),
(35, '29', 'Akoko South-West', 'akoko-south-west'),
(36, '29', 'Akoko South-East', 'akoko-south-east'),
(37, '10', 'Akpabuyo', 'akpabuyo'),
(38, '33', 'Akuku-Toru', 'akuku-toru'),
(39, '29', 'Akure North', 'akure-north'),
(40, '29', 'Akure South', 'akure-south'),
(41, '26', 'Akwanga', 'akwanga'),
(42, '20', 'Albasu', 'albasu'),
(43, '22', 'Aleiro', 'aleiro'),
(44, '25', 'Alimosho', 'alimosho'),
(45, '6', 'Alkaleri', 'alkaleri'),
(46, '25', 'Amuwo-Odofin', 'amuwo-odofin'),
(47, '5', 'Anambra East', 'anambra-east'),
(48, '5', 'Anambra West', 'anambra-west'),
(49, '5', 'Anaocha', 'anaocha'),
(50, '33', 'Andoni', 'andoni'),
(51, '15', 'Aninri', 'aninri'),
(52, '11', 'Aniocha North', 'aniocha-north'),
(53, '11', 'Aniocha South', 'aniocha-south'),
(54, '37', 'Anka', 'anka'),
(55, '23', 'Ankpa', 'ankpa'),
(56, '8', 'Apa', 'apa'),
(57, '25', 'Apapa', 'apapa'),
(58, '8', 'Ado', 'ado'),
(59, '35', 'Ardo Kola', 'ardo-kola'),
(60, '22', 'Arewa Dandi', 'arewa-dandi'),
(61, '22', 'Argungu', 'argungu'),
(62, '1', 'Arochukwu', 'arochukwu'),
(63, '24', 'Asa', 'asa'),
(64, '33', 'Asari-Toru', 'asari-toru'),
(65, '9', 'Askira/Uba', 'askira-uba'),
(66, '30', 'Atakunmosa East', 'atakunmosa-east'),
(67, '30', 'Atakunmosa West', 'atakunmosa-west'),
(68, '31', 'Atiba', 'atiba'),
(69, '31', 'Atisbo', 'atisbo'),
(70, '22', 'Augie', 'augie'),
(71, '18', 'Auyo', 'auyo'),
(72, '26', 'Awe', 'awe'),
(73, '15', 'Awgu', 'awgu'),
(74, '5', 'Awka North', 'awka-north'),
(75, '5', 'Awka South', 'awka-south'),
(76, '5', 'Ayamelum', 'ayamelum'),
(77, '30', 'Aiyedaade', 'aiyedaade'),
(78, '30', 'Aiyedire', 'aiyedire'),
(79, '18', 'Babura', 'babura'),
(80, '25', 'Badagry', 'badagry'),
(81, '22', 'Bagudo', 'bagudo'),
(82, '20', 'Bagwai', 'bagwai'),
(83, '10', 'Bakassi', 'bakassi'),
(84, '32', 'Bokkos', 'bokkos'),
(85, '21', 'Bakori', 'bakori'),
(86, '37', 'Bakura', 'bakura'),
(87, '16', 'Balanga', 'balanga'),
(88, '35', 'Bali', 'bali'),
(89, '9', 'Bama', 'bama'),
(90, '36', 'Bade', 'bade'),
(91, '32', 'Barkin Ladi', 'barkin-ladi'),
(92, '24', 'Baruten', 'baruten'),
(93, '23', 'Bassa', 'bassa'),
(94, '32', 'Bassa', 'bassa'),
(95, '21', 'Batagarawa', 'batagarawa'),
(96, '21', 'Batsari', 'batsari'),
(97, '6', 'Bauchi', 'bauchi'),
(98, '21', 'Baure', 'baure'),
(99, '9', 'Bayo', 'bayo'),
(100, '20', 'Bebeji', 'bebeji'),
(101, '10', 'Bekwarra', 'bekwarra'),
(102, '1', 'Bende', 'bende'),
(103, '10', 'Biase', 'biase'),
(104, '20', 'Bichi', 'bichi'),
(105, '27', 'Bida', 'bida'),
(106, '16', 'Billiri', 'billiri'),
(107, '21', 'Bindawa', 'bindawa'),
(108, '34', 'Binji', 'binji'),
(109, '18', 'Biriniwa', 'biriniwa'),
(110, '19', 'Birnin Gwari', 'birnin-gwari'),
(111, '22', 'Birnin Kebbi', 'birnin-kebbi'),
(112, '18', 'Birnin Kudu', 'birnin-kudu'),
(113, '37', 'Birnin Magaji/Kiyaw', 'birnin-magaji-kiyaw'),
(114, '9', 'Biu', 'biu'),
(115, '34', 'Bodinga', 'bodinga'),
(116, '6', 'Bogoro', 'bogoro'),
(117, '10', 'Boki', 'boki'),
(118, '30', 'Boluwaduro', 'boluwaduro'),
(119, '11', 'Bomadi', 'bomadi'),
(120, '33', 'Bonny', 'bonny'),
(121, '27', 'Borgu', 'borgu'),
(122, '30', 'Boripe', 'boripe'),
(123, '36', 'Bursari', 'bursari'),
(124, '27', 'Bosso', 'bosso'),
(125, '7', 'Brass', 'brass'),
(126, '18', 'Buji', 'buji'),
(127, '37', 'Bukkuyum', 'bukkuyum'),
(128, '8', 'Buruku', 'buruku'),
(129, '37', 'Bungudu', 'bungudu'),
(130, '20', 'Bunkure', 'bunkure'),
(131, '22', 'Bunza', 'bunza'),
(132, '11', 'Burutu', 'burutu'),
(133, '2', 'Bwari', 'bwari'),
(134, '10', 'Calabar Municipal', 'calabar-municipal'),
(135, '10', 'Calabar South', 'calabar-south'),
(136, '27', 'Chanchaga', 'chanchaga'),
(137, '21', 'Charanchi', 'charanchi'),
(138, '9', 'Chibok', 'chibok'),
(139, '19', 'Chikun', 'chikun'),
(140, '20', 'Dala', 'dala'),
(141, '36', 'Damaturu', 'damaturu'),
(142, '6', 'Damban', 'damban'),
(143, '20', 'Dambatta', 'dambatta'),
(144, '9', 'Damboa', 'damboa'),
(145, '22', 'Dandi', 'dandi'),
(146, '21', 'Dandume', 'dandume'),
(147, '34', 'Dange Shuni', 'dange-shuni'),
(148, '21', 'Danja', 'danja'),
(149, '21', 'Dan Musa', 'dan-musa'),
(150, '6', 'Darazo', 'darazo'),
(151, '6', 'Dass', 'dass'),
(152, '21', 'Daura', 'daura'),
(153, '20', 'Dawakin Kudu', 'dawakin-kudu'),
(154, '20', 'Dawakin Tofa', 'dawakin-tofa'),
(155, '33', 'Degema', 'degema'),
(156, '23', 'Dekina', 'dekina'),
(157, '3', 'Demsa', 'demsa'),
(158, '9', 'Dikwa', 'dikwa'),
(159, '20', 'Doguwa', 'doguwa'),
(160, '26', 'Doma', 'doma'),
(161, '35', 'Donga', 'donga'),
(162, '16', 'Dukku', 'dukku'),
(163, '5', 'Dunukofia', 'dunukofia'),
(164, '18', 'Dutse', 'dutse'),
(165, '21', 'Dutsi', 'dutsi'),
(166, '21', 'Dutsin Ma', 'dutsin-ma'),
(167, '4', 'Eastern Obolo', 'eastern-obolo'),
(168, '12', 'Ebonyi', 'ebonyi'),
(169, '27', 'Edati', 'edati'),
(170, '30', 'Ede North', 'ede-north'),
(171, '30', 'Ede South', 'ede-south'),
(172, '24', 'Edu', 'edu'),
(173, '30', 'Ife Central', 'ife-central'),
(174, '30', 'Ife East', 'ife-east'),
(175, '30', 'Ife North', 'ife-north'),
(176, '30', 'Ife South', 'ife-south'),
(177, '14', 'Efon', 'efon'),
(178, '28', 'Egbado North', 'egbado-north'),
(179, '28', 'Egbado South', 'egbado-south'),
(180, '31', 'Egbeda', 'egbeda'),
(181, '30', 'Egbedore', 'egbedore'),
(182, '13', 'Egor', 'egor'),
(183, '17', 'Ehime Mbano', 'ehime-mbano'),
(184, '30', 'Ejigbo', 'ejigbo'),
(185, '7', 'Ekeremor', 'ekeremor'),
(186, '4', 'Eket', 'eket'),
(187, '24', 'Ekiti', 'ekiti'),
(188, '14', 'Ekiti East', 'ekiti-east'),
(189, '14', 'Ekiti South-West', 'ekiti-south-west'),
(190, '14', 'Ekiti West', 'ekiti-west'),
(191, '5', 'Ekwusigo', 'ekwusigo'),
(192, '33', 'Eleme', 'eleme'),
(193, '33', 'Emuoha', 'emuoha'),
(194, '14', 'Emure', 'emure'),
(195, '15', 'Enugu East', 'enugu-east'),
(196, '15', 'Enugu North', 'enugu-north'),
(197, '15', 'Enugu South', 'enugu-south'),
(198, '25', 'Epe', 'epe'),
(199, '13', 'Esan Central', 'esan-central'),
(200, '13', 'Esan North-East', 'esan-north-east'),
(201, '13', 'Esan South-East', 'esan-south-east'),
(202, '13', 'Esan West', 'esan-west'),
(203, '29', 'Ese Odo', 'ese-odo'),
(204, '4', 'Esit Eket', 'esit-eket'),
(205, '4', 'Essien Udim', 'essien-udim'),
(206, '33', 'Etche', 'etche'),
(207, '11', 'Ethiope East', 'ethiope-east'),
(208, '11', 'Ethiope West', 'ethiope-west'),
(209, '4', 'Etim Ekpo', 'etim-ekpo'),
(210, '4', 'Etinan', 'etinan'),
(211, '25', 'Eti Osa', 'eti-osa'),
(212, '13', 'Etsako Central', 'etsako-central'),
(213, '13', 'Etsako East', 'etsako-east'),
(214, '13', 'Etsako West', 'etsako-west'),
(215, '10', 'Etung', 'etung'),
(216, '28', 'Ewekoro', 'ewekoro'),
(217, '15', 'Ezeagu', 'ezeagu'),
(218, '17', 'Ezinihitte', 'ezinihitte'),
(219, '12', 'Ezza North', 'ezza-north'),
(220, '12', 'Ezza South', 'ezza-south'),
(221, '20', 'Fagge', 'fagge'),
(222, '22', 'Fakai', 'fakai'),
(223, '21', 'Faskari', 'faskari'),
(224, '36', 'Fika', 'fika'),
(225, '3', 'Fufure', 'fufure'),
(226, '16', 'Funakaye', 'funakaye'),
(227, '36', 'Fune', 'fune'),
(228, '21', 'Funtua', 'funtua'),
(229, '20', 'Gabasawa', 'gabasawa'),
(230, '34', 'Gada', 'gada'),
(231, '18', 'Gagarawa', 'gagarawa'),
(232, '6', 'Gamawa', 'gamawa'),
(233, '6', 'Ganjuwa', 'ganjuwa'),
(234, '3', 'Ganye', 'ganye'),
(235, '18', 'Garki', 'garki'),
(236, '20', 'Garko', 'garko'),
(237, '20', 'Garun Mallam', 'garun-mallam'),
(238, '35', 'Gashaka', 'gashaka'),
(239, '35', 'Gassol', 'gassol'),
(240, '20', 'Gaya', 'gaya'),
(241, '3', 'Gayuk', 'gayuk'),
(242, '20', 'Gezawa', 'gezawa'),
(243, '27', 'Gbako', 'gbako'),
(244, '8', 'Gboko', 'gboko'),
(245, '14', 'Gbonyin', 'gbonyin'),
(246, '36', 'Geidam', 'geidam'),
(247, '6', 'Giade', 'giade'),
(248, '19', 'Giwa', 'giwa'),
(249, '33', 'Gokana', 'gokana'),
(250, '16', 'Gombe', 'gombe'),
(251, '3', 'Gombi', 'gombi'),
(252, '34', 'Goronyo', 'goronyo'),
(253, '3', 'Grie', 'grie'),
(254, '9', 'Gubio', 'gubio'),
(255, '34', 'Gudu', 'gudu'),
(256, '36', 'Gujba', 'gujba'),
(257, '36', 'Gulani', 'gulani'),
(258, '8', 'Guma', 'guma'),
(259, '18', 'Gumel', 'gumel'),
(260, '37', 'Gummi', 'gummi'),
(261, '27', 'Gurara', 'gurara'),
(262, '18', 'Guri', 'guri'),
(263, '37', 'Gusau', 'gusau'),
(264, '9', 'Guzamala', 'guzamala'),
(265, '34', 'Gwadabawa', 'gwadabawa'),
(266, '2', 'Gwagwalada', 'gwagwalada'),
(267, '20', 'Gwale', 'gwale'),
(268, '22', 'Gwandu', 'gwandu'),
(269, '18', 'Gwaram', 'gwaram'),
(270, '20', 'Gwarzo', 'gwarzo'),
(271, '8', 'Gwer East', 'gwer-east'),
(272, '8', 'Gwer West', 'gwer-west'),
(273, '18', 'Gwiwa', 'gwiwa'),
(274, '9', 'Gwoza', 'gwoza'),
(275, '18', 'Hadejia', 'hadejia'),
(276, '9', 'Hawul', 'hawul'),
(277, '3', 'Hong', 'hong'),
(278, '31', 'Ibadan North', 'ibadan-north'),
(279, '31', 'Ibadan North-East', 'ibadan-north-east'),
(280, '31', 'Ibadan North-West', 'ibadan-north-west'),
(281, '31', 'Ibadan South-East', 'ibadan-south-east'),
(282, '31', 'Ibadan South-West', 'ibadan-south-west'),
(283, '23', 'Ibaji', 'ibaji'),
(284, '31', 'Ibarapa Central', 'ibarapa-central'),
(285, '31', 'Ibarapa East', 'ibarapa-east'),
(286, '31', 'Ibarapa North', 'ibarapa-north'),
(287, '25', 'Ibeju-Lekki', 'ibeju-lekki'),
(288, '4', 'Ibeno', 'ibeno'),
(289, '4', 'Ibesikpo Asutan', 'ibesikpo-asutan'),
(290, '35', 'Ibi', 'ibi'),
(291, '4', 'Ibiono-Ibom', 'ibiono-ibom'),
(292, '23', 'Idah', 'idah'),
(293, '29', 'Idanre', 'idanre'),
(294, '17', 'Ideato North', 'ideato-north'),
(295, '17', 'Ideato South', 'ideato-south'),
(296, '5', 'Idemili North', 'idemili-north'),
(297, '5', 'Idemili South', 'idemili-south'),
(298, '31', 'Ido', 'ido'),
(299, '14', 'Ido Osi', 'ido-osi'),
(300, '25', 'Ifako-Ijaiye', 'ifako-ijaiye'),
(301, '30', 'Ifedayo', 'ifedayo'),
(302, '29', 'Ifedore', 'ifedore'),
(303, '24', 'Ifelodun', 'ifelodun'),
(304, '30', 'Ifelodun', 'ifelodun'),
(305, '28', 'Ifo', 'ifo'),
(306, '19', 'Igabi', 'igabi'),
(307, '23', 'Igalamela Odolu', 'igalamela-odolu'),
(308, '15', 'Igbo Etiti', 'igbo-etiti'),
(309, '15', 'Igbo Eze North', 'igbo-eze-north'),
(310, '15', 'Igbo Eze South', 'igbo-eze-south'),
(311, '13', 'Igueben', 'igueben'),
(312, '5', 'Ihiala', 'ihiala'),
(313, '17', 'Ihitte/Uboma', 'ihitte-uboma'),
(314, '29', 'Ilaje', 'ilaje'),
(315, '28', 'Ijebu East', 'ijebu-east'),
(316, '28', 'Ijebu North', 'ijebu-north'),
(317, '28', 'Ijebu North East', 'ijebu-north-east'),
(318, '28', 'Ijebu Ode', 'ijebu-ode'),
(319, '14', 'Ijero', 'ijero'),
(320, '23', 'Ijumu', 'ijumu'),
(321, '4', 'Ika', 'ika'),
(322, '11', 'Ika North East', 'ika-north-east'),
(323, '19', 'Ikara', 'ikara'),
(324, '11', 'Ika South', 'ika-south'),
(325, '17', 'Ikeduru', 'ikeduru'),
(326, '25', 'Ikeja', 'ikeja'),
(327, '28', 'Ikenne', 'ikenne'),
(328, '14', 'Ikere', 'ikere'),
(329, '14', 'Ikole', 'ikole'),
(330, '10', 'Ikom', 'ikom'),
(331, '4', 'Ikono', 'ikono'),
(332, '25', 'Ikorodu', 'ikorodu'),
(333, '4', 'Ikot Abasi', 'ikot-abasi'),
(334, '4', 'Ikot Ekpene', 'ikot-ekpene'),
(335, '13', 'Ikpoba Okha', 'ikpoba-okha'),
(336, '33', 'Ikwerre', 'ikwerre'),
(337, '12', 'Ikwo', 'ikwo'),
(338, '1', 'Ikwuano', 'ikwuano'),
(339, '30', 'Ila', 'ila'),
(340, '14', 'Ilejemeje', 'ilejemeje'),
(341, '29', 'Ile Oluji/Okeigbo', 'ile-oluji-okeigbo'),
(342, '30', 'Ilesa East', 'ilesa-east'),
(343, '30', 'Ilesa West', 'ilesa-west'),
(344, '34', 'Illela', 'illela'),
(345, '24', 'Ilorin East', 'ilorin-east'),
(346, '24', 'Ilorin South', 'ilorin-south'),
(347, '24', 'Ilorin West', 'ilorin-west'),
(348, '28', 'Imeko Afon', 'imeko-afon'),
(349, '21', 'Ingawa', 'ingawa'),
(350, '4', 'Ini', 'ini'),
(351, '28', 'Ipokia', 'ipokia'),
(352, '29', 'Irele', 'irele'),
(353, '31', 'Irepo', 'irepo'),
(354, '24', 'Irepodun', 'irepodun'),
(355, '30', 'Irepodun', 'irepodun'),
(356, '14', 'Irepodun/Ifelodun', 'irepodun-ifelodun'),
(357, '30', 'Irewole', 'irewole'),
(358, '34', 'Isa', 'isa'),
(359, '14', 'Ise/Orun', 'ise-orun'),
(360, '31', 'Iseyin', 'iseyin'),
(361, '12', 'Ishielu', 'ishielu'),
(362, '17', 'Isiala Mbano', 'isiala-mbano'),
(363, '1', 'Isiala Ngwa North', 'isiala-ngwa-north'),
(364, '1', 'Isiala Ngwa South', 'isiala-ngwa-south'),
(365, '24', 'Isin', 'isin'),
(366, '15', 'Isi Uzo', 'isi-uzo'),
(367, '30', 'Isokan', 'isokan'),
(368, '11', 'Isoko North', 'isoko-north'),
(369, '11', 'Isoko South', 'isoko-south'),
(370, '17', 'Isu', 'isu'),
(371, '1', 'Isuikwuato', 'isuikwuato'),
(372, '6', 'Itas/Gadau', 'itas-gadau'),
(373, '31', 'Itesiwaju', 'itesiwaju'),
(374, '4', 'Itu', 'itu'),
(375, '12', 'Ivo', 'ivo'),
(376, '31', 'Iwajowa', 'iwajowa'),
(377, '30', 'Iwo', 'iwo'),
(378, '12', 'Izzi', 'izzi'),
(379, '19', 'Jaba', 'jaba'),
(380, '3', 'Jada', 'jada'),
(381, '18', 'Jahun', 'jahun'),
(382, '36', 'Jakusko', 'jakusko'),
(383, '35', 'Jalingo', 'jalingo'),
(384, '6', 'Jama&#039;are', 'jama&#039;are'),
(385, '22', 'Jega', 'jega'),
(386, '19', 'Jema&#039;a', 'jema&#039;a'),
(387, '9', 'Jere', 'jere'),
(388, '21', 'Jibia', 'jibia'),
(389, '32', 'Jos East', 'jos-east'),
(390, '32', 'Jos North', 'jos-north'),
(391, '32', 'Jos South', 'jos-south'),
(392, '23', 'Kabba/Bunu', 'kabba-bunu'),
(393, '20', 'Kabo', 'kabo'),
(394, '19', 'Kachia', 'kachia'),
(395, '19', 'Kaduna North', 'kaduna-north'),
(396, '19', 'Kaduna South', 'kaduna-south'),
(397, '18', 'Kafin Hausa', 'kafin-hausa'),
(398, '21', 'Kafur', 'kafur'),
(399, '9', 'Kaga', 'kaga'),
(400, '19', 'Kagarko', 'kagarko'),
(401, '24', 'Kaiama', 'kaiama'),
(402, '21', 'Kaita', 'kaita'),
(403, '31', 'Kajola', 'kajola'),
(404, '19', 'Kajuru', 'kajuru'),
(405, '9', 'Kala/Balge', 'kala-balge'),
(406, '22', 'Kalgo', 'kalgo'),
(407, '16', 'Kaltungo', 'kaltungo'),
(408, '32', 'Kanam', 'kanam'),
(409, '21', 'Kankara', 'kankara'),
(410, '32', 'Kanke', 'kanke'),
(411, '21', 'Kankia', 'kankia'),
(412, '20', 'Kano Municipal', 'kano-municipal'),
(413, '36', 'Karasuwa', 'karasuwa'),
(414, '20', 'Karaye', 'karaye'),
(415, '35', 'Karim Lamido', 'karim-lamido'),
(416, '26', 'Karu', 'karu'),
(417, '6', 'Katagum', 'katagum'),
(418, '27', 'Katcha', 'katcha'),
(419, '21', 'Katsina', 'katsina'),
(420, '8', 'Katsina-Ala', 'katsina-ala'),
(421, '19', 'Kaura', 'kaura'),
(422, '37', 'Kaura Namoda', 'kaura-namoda'),
(423, '19', 'Kauru', 'kauru'),
(424, '18', 'Kazaure', 'kazaure'),
(425, '26', 'Keana', 'keana'),
(426, '34', 'Kebbe', 'kebbe'),
(427, '26', 'Keffi', 'keffi'),
(428, '33', 'Khana', 'khana'),
(429, '20', 'Kibiya', 'kibiya'),
(430, '6', 'Kirfi', 'kirfi'),
(431, '18', 'Kiri Kasama', 'kiri-kasama'),
(432, '20', 'Kiru', 'kiru'),
(433, '18', 'Kiyawa', 'kiyawa'),
(434, '23', 'Kogi', 'kogi'),
(435, '22', 'Koko/Besse', 'koko-besse'),
(436, '26', 'Kokona', 'kokona'),
(437, '7', 'Kolokuma/Opokuma', 'kolokuma-opokuma'),
(438, '9', 'Konduga', 'konduga'),
(439, '8', 'Konshisha', 'konshisha'),
(440, '27', 'Kontagora', 'kontagora'),
(441, '25', 'Kosofe', 'kosofe'),
(442, '18', 'Kaugama', 'kaugama'),
(443, '19', 'Kubau', 'kubau'),
(444, '19', 'Kudan', 'kudan'),
(445, '2', 'Kuje', 'kuje'),
(446, '9', 'Kukawa', 'kukawa'),
(447, '20', 'Kumbotso', 'kumbotso'),
(448, '35', 'Kumi', 'kumi'),
(449, '20', 'Kunchi', 'kunchi'),
(450, '20', 'Kura', 'kura'),
(451, '21', 'Kurfi', 'kurfi'),
(452, '21', 'Kusada', 'kusada'),
(453, '2', 'Kwali', 'kwali'),
(454, '8', 'Kwande', 'kwande'),
(455, '16', 'Kwami', 'kwami'),
(456, '34', 'Kware', 'kware'),
(457, '9', 'Kwaya Kusar', 'kwaya-kusar'),
(458, '26', 'Lafia', 'lafia'),
(459, '31', 'Lagelu', 'lagelu'),
(460, '25', 'Lagos Island', 'lagos-island'),
(461, '25', 'Lagos Mainland', 'lagos-mainland'),
(462, '32', 'Langtang South', 'langtang-south'),
(463, '32', 'Langtang North', 'langtang-north'),
(464, '27', 'Lapai', 'lapai'),
(465, '3', 'Lamurde', 'lamurde'),
(466, '35', 'Lau', 'lau'),
(467, '27', 'Lavun', 'lavun'),
(468, '19', 'Lere', 'lere'),
(469, '8', 'Logo', 'logo'),
(470, '23', 'Lokoja', 'lokoja'),
(471, '36', 'Machina', 'machina'),
(472, '3', 'Madagali', 'madagali'),
(473, '20', 'Madobi', 'madobi'),
(474, '9', 'Mafa', 'mafa'),
(475, '27', 'Magama', 'magama'),
(476, '9', 'Magumeri', 'magumeri'),
(477, '21', 'Mai&#039;Adua', 'mai&#039;adua'),
(478, '9', 'Maiduguri', 'maiduguri'),
(479, '18', 'Maigatari', 'maigatari'),
(480, '3', 'Maiha', 'maiha'),
(481, '22', 'Maiyama', 'maiyama'),
(482, '19', 'Makarfi', 'makarfi'),
(483, '20', 'Makoda', 'makoda'),
(484, '18', 'Malam Madori', 'malam-madori'),
(485, '21', 'Malumfashi', 'malumfashi'),
(486, '32', 'Mangu', 'mangu'),
(487, '21', 'Mani', 'mani'),
(488, '37', 'Maradun', 'maradun'),
(489, '27', 'Mariga', 'mariga'),
(490, '8', 'Makurdi', 'makurdi'),
(491, '9', 'Marte', 'marte'),
(492, '37', 'Maru', 'maru'),
(493, '27', 'Mashegu', 'mashegu'),
(494, '21', 'Mashi', 'mashi'),
(495, '21', 'Matazu', 'matazu'),
(496, '3', 'Mayo Belwa', 'mayo-belwa'),
(497, '17', 'Mbaitoli', 'mbaitoli'),
(498, '4', 'Mbo', 'mbo'),
(499, '3', 'Michika', 'michika'),
(500, '18', 'Miga', 'miga'),
(501, '32', 'Mikang', 'mikang'),
(502, '20', 'Minjibir', 'minjibir'),
(503, '6', 'Misau', 'misau'),
(504, '14', 'Moba', 'moba'),
(505, '9', 'Mobbar', 'mobbar'),
(506, '3', 'Mubi North', 'mubi-north'),
(507, '3', 'Mubi South', 'mubi-south'),
(508, '27', 'Mokwa', 'mokwa'),
(509, '9', 'Monguno', 'monguno'),
(510, '23', 'Mopa Muro', 'mopa-muro'),
(511, '24', 'Moro', 'moro'),
(512, '27', 'Moya', 'moya'),
(513, '4', 'Mkpat-Enin', 'mkpat-enin'),
(514, '2', 'Municipal Area Council', 'municipal-area-council'),
(515, '21', 'Musawa', 'musawa'),
(516, '25', 'Mushin', 'mushin'),
(517, '16', 'Nafada', 'nafada'),
(518, '36', 'Nangere', 'nangere'),
(519, '20', 'Nasarawa', 'nasarawa'),
(520, '26', 'Nasarawa', 'nasarawa'),
(521, '26', 'Nasarawa Egon', 'nasarawa-egon'),
(522, '11', 'Ndokwa East', 'ndokwa-east'),
(523, '11', 'Ndokwa West', 'ndokwa-west'),
(524, '7', 'Nembe', 'nembe'),
(525, '9', 'Ngala', 'ngala'),
(526, '9', 'Nganzai', 'nganzai'),
(527, '22', 'Ngaski', 'ngaski'),
(528, '17', 'Ngor Okpala', 'ngor-okpala'),
(529, '36', 'Nguru', 'nguru'),
(530, '6', 'Ningi', 'ningi'),
(531, '17', 'Njaba', 'njaba'),
(532, '5', 'Njikoka', 'njikoka'),
(533, '15', 'Nkanu East', 'nkanu-east'),
(534, '15', 'Nkanu West', 'nkanu-west'),
(535, '17', 'Nkwerre', 'nkwerre'),
(536, '5', 'Nnewi North', 'nnewi-north'),
(537, '5', 'Nnewi South', 'nnewi-south'),
(538, '4', 'Nsit-Atai', 'nsit-atai'),
(539, '4', 'Nsit-Ibom', 'nsit-ibom'),
(540, '4', 'Nsit-Ubium', 'nsit-ubium'),
(541, '15', 'Nsukka', 'nsukka'),
(542, '3', 'Numan', 'numan'),
(543, '17', 'Nwangele', 'nwangele'),
(544, '28', 'Obafemi Owode', 'obafemi-owode'),
(545, '10', 'Obanliku', 'obanliku'),
(546, '8', 'Obi', 'obi'),
(547, '26', 'Obi', 'obi'),
(548, '1', 'Obi Ngwa', 'obi-ngwa'),
(549, '33', 'Obio/Akpor', 'obio-akpor'),
(550, '30', 'Obokun', 'obokun'),
(551, '4', 'Obot Akara', 'obot-akara'),
(552, '17', 'Obowo', 'obowo'),
(553, '10', 'Obubra', 'obubra'),
(554, '10', 'Obudu', 'obudu'),
(555, '28', 'Odeda', 'odeda'),
(556, '29', 'Odigbo', 'odigbo'),
(557, '28', 'Odogbolu', 'odogbolu'),
(558, '30', 'Odo Otin', 'odo-otin'),
(559, '10', 'Odukpani', 'odukpani'),
(560, '24', 'Offa', 'offa'),
(561, '23', 'Ofu', 'ofu'),
(562, '33', 'Ogba/Egbema/Ndoni', 'ogba-egbema-ndoni'),
(563, '8', 'Ogbadibo', 'ogbadibo'),
(564, '5', 'Ogbaru', 'ogbaru'),
(565, '7', 'Ogbia', 'ogbia'),
(566, '31', 'Ogbomosho North', 'ogbomosho-north'),
(567, '31', 'Ogbomosho South', 'ogbomosho-south'),
(568, '33', 'Ogu/Bolo', 'ogu-bolo'),
(569, '10', 'Ogoja', 'ogoja'),
(570, '31', 'Ogo Oluwa', 'ogo-oluwa'),
(571, '23', 'Ogori/Magongo', 'ogori-magongo'),
(572, '28', 'Ogun Waterside', 'ogun-waterside'),
(573, '17', 'Oguta', 'oguta'),
(574, '1', 'Ohafia', 'ohafia'),
(575, '17', 'Ohaji/Egbema', 'ohaji-egbema'),
(576, '12', 'Ohaozara', 'ohaozara'),
(577, '12', 'Ohaukwu', 'ohaukwu'),
(578, '8', 'Ohimini', 'ohimini'),
(579, '13', 'Orhionmwon', 'orhionmwon'),
(580, '15', 'Oji River', 'oji-river'),
(581, '25', 'Ojo', 'ojo'),
(582, '8', 'Oju', 'oju'),
(583, '23', 'Okehi', 'okehi'),
(584, '23', 'Okene', 'okene'),
(585, '24', 'Oke Ero', 'oke-ero'),
(586, '17', 'Okigwe', 'okigwe'),
(587, '29', 'Okitipupa', 'okitipupa'),
(588, '4', 'Okobo', 'okobo'),
(589, '11', 'Okpe', 'okpe'),
(590, '33', 'Okrika', 'okrika'),
(591, '23', 'Olamaboro', 'olamaboro'),
(592, '30', 'Ola Oluwa', 'ola-oluwa'),
(593, '30', 'Olorunda', 'olorunda'),
(594, '31', 'Olorunsogo', 'olorunsogo'),
(595, '31', 'Oluyole', 'oluyole'),
(596, '23', 'Omala', 'omala'),
(597, '33', 'Omuma', 'omuma'),
(598, '31', 'Ona Ara', 'ona-ara'),
(599, '29', 'Ondo East', 'ondo-east'),
(600, '29', 'Ondo West', 'ondo-west'),
(601, '12', 'Onicha', 'onicha'),
(602, '5', 'Onitsha North', 'onitsha-north'),
(603, '5', 'Onitsha South', 'onitsha-south'),
(604, '4', 'Onna', 'onna'),
(605, '8', 'Okpokwu', 'okpokwu'),
(606, '33', 'Opobo/Nkoro', 'opobo-nkoro'),
(607, '13', 'Oredo', 'oredo'),
(608, '31', 'Orelope', 'orelope'),
(609, '30', 'Oriade', 'oriade'),
(610, '31', 'Ori Ire', 'ori-ire'),
(611, '17', 'Orlu', 'orlu'),
(612, '30', 'Orolu', 'orolu'),
(613, '4', 'Oron', 'oron'),
(614, '17', 'Orsu', 'orsu'),
(615, '17', 'Oru East', 'oru-east'),
(616, '4', 'Oruk Anam', 'oruk-anam'),
(617, '5', 'Orumba North', 'orumba-north'),
(618, '5', 'Orumba South', 'orumba-south'),
(619, '17', 'Oru West', 'oru-west'),
(620, '29', 'Ose', 'ose'),
(621, '11', 'Oshimili North', 'oshimili-north'),
(622, '11', 'Oshimili South', 'oshimili-south'),
(623, '25', 'Oshodi-Isolo', 'oshodi-isolo'),
(624, '1', 'Osisioma', 'osisioma'),
(625, '30', 'Osogbo', 'osogbo'),
(626, '8', 'Oturkpo', 'oturkpo'),
(627, '13', 'Ovia North-East', 'ovia-north-east'),
(628, '13', 'Ovia South-West', 'ovia-south-west'),
(629, '13', 'Owan East', 'owan-east'),
(630, '13', 'Owan West', 'owan-west'),
(631, '17', 'Owerri Municipal', 'owerri-municipal'),
(632, '17', 'Owerri North', 'owerri-north'),
(633, '17', 'Owerri West', 'owerri-west'),
(634, '29', 'Owo', 'owo'),
(635, '14', 'Oye', 'oye'),
(636, '5', 'Oyi', 'oyi'),
(637, '33', 'Oyigbo', 'oyigbo'),
(638, '31', 'Oyo', 'oyo'),
(639, '31', 'Oyo East', 'oyo-east'),
(640, '24', 'Oyun', 'oyun'),
(641, '27', 'Paikoro', 'paikoro'),
(642, '32', 'Pankshin', 'pankshin'),
(643, '11', 'Patani', 'patani'),
(644, '24', 'Pategi', 'pategi'),
(645, '33', 'Port Harcourt', 'port-harcourt'),
(646, '36', 'Potiskum', 'potiskum'),
(647, '32', 'Qua&#039;an Pan', 'qua&#039;an-pan'),
(648, '34', 'Rabah', 'rabah'),
(649, '27', 'Rafi', 'rafi'),
(650, '20', 'Rano', 'rano'),
(651, '28', 'Remo North', 'remo-north'),
(652, '27', 'Rijau', 'rijau'),
(653, '21', 'Rimi', 'rimi'),
(654, '20', 'Rimin Gado', 'rimin-gado'),
(655, '18', 'Ringim', 'ringim'),
(656, '32', 'Riyom', 'riyom'),
(657, '20', 'Rogo', 'rogo'),
(658, '18', 'Roni', 'roni'),
(659, '34', 'Sabon Birni', 'sabon-birni'),
(660, '19', 'Sabon Gari', 'sabon-gari'),
(661, '21', 'Sabuwa', 'sabuwa'),
(662, '21', 'Safana', 'safana'),
(663, '7', 'Sagbama', 'sagbama'),
(664, '22', 'Sakaba', 'sakaba'),
(665, '31', 'Saki East', 'saki-east'),
(666, '31', 'Saki West', 'saki-west'),
(667, '21', 'Sandamu', 'sandamu'),
(668, '19', 'Sanga', 'sanga'),
(669, '11', 'Sapele', 'sapele'),
(670, '35', 'Sardauna', 'sardauna'),
(671, '28', 'Shagamu', 'shagamu'),
(672, '34', 'Shagari', 'shagari'),
(673, '22', 'Shanga', 'shanga'),
(674, '9', 'Shani', 'shani'),
(675, '20', 'Shanono', 'shanono'),
(676, '3', 'Shelleng', 'shelleng'),
(677, '32', 'Shendam', 'shendam'),
(678, '37', 'Shinkafi', 'shinkafi'),
(679, '6', 'Shira', 'shira'),
(680, '27', 'Shiroro', 'shiroro'),
(681, '16', 'Shongom', 'shongom'),
(682, '25', 'Shomolu', 'shomolu'),
(683, '34', 'Silame', 'silame'),
(684, '19', 'Soba', 'soba'),
(685, '34', 'Sokoto North', 'sokoto-north'),
(686, '34', 'Sokoto South', 'sokoto-south'),
(687, '3', 'Song', 'song'),
(688, '7', 'Southern Ijaw', 'southern-ijaw'),
(689, '27', 'Suleja', 'suleja'),
(690, '18', 'Sule Tankarkar', 'sule-tankarkar'),
(691, '20', 'Sumaila', 'sumaila'),
(692, '22', 'Suru', 'suru'),
(693, '31', 'Surulere', 'surulere'),
(694, '25', 'Surulere', 'surulere'),
(695, '27', 'Tafa', 'tafa'),
(696, '6', 'Tafawa Balewa', 'tafawa-balewa'),
(697, '33', 'Tai', 'tai'),
(698, '20', 'Takai', 'takai'),
(699, '35', 'Takum', 'takum'),
(700, '37', 'Talata Mafara', 'talata-mafara'),
(701, '34', 'Tambuwal', 'tambuwal'),
(702, '34', 'Tangaza', 'tangaza'),
(703, '20', 'Tarauni', 'tarauni'),
(704, '8', 'Tarka', 'tarka'),
(705, '36', 'Tarmuwa', 'tarmuwa'),
(706, '18', 'Taura', 'taura'),
(707, '3', 'Toungo', 'toungo'),
(708, '20', 'Tofa', 'tofa'),
(709, '6', 'Toro', 'toro'),
(710, '26', 'Toto', 'toto'),
(711, '37', 'Chafe', 'chafe'),
(712, '20', 'Tsanyawa', 'tsanyawa'),
(713, '20', 'Tudun Wada', 'tudun-wada'),
(714, '34', 'Tureta', 'tureta'),
(715, '15', 'Udenu', 'udenu'),
(716, '15', 'Udi', 'udi'),
(717, '11', 'Udu', 'udu'),
(718, '4', 'Udung-Uko', 'udung-uko'),
(719, '11', 'Ughelli North', 'ughelli-north'),
(720, '11', 'Ughelli South', 'ughelli-south'),
(721, '1', 'Ugwunagbo', 'ugwunagbo'),
(722, '13', 'Uhunmwonde', 'uhunmwonde'),
(723, '4', 'Ukanafun', 'ukanafun'),
(724, '8', 'Ukum', 'ukum'),
(725, '1', 'Ukwa East', 'ukwa-east'),
(726, '1', 'Ukwa West', 'ukwa-west'),
(727, '11', 'Ukwuani', 'ukwuani'),
(728, '1', 'Umuahia North', 'umuahia-north'),
(729, '1', 'Umuahia South', 'umuahia-south'),
(730, '1', 'Umu Nneochi', 'umu-nneochi'),
(731, '20', 'Ungogo', 'ungogo'),
(732, '17', 'Unuimo', 'unuimo'),
(733, '4', 'Uruan', 'uruan'),
(734, '4', 'Urue-Offong/Oruko', 'urue-offong-oruko'),
(735, '8', 'Ushongo', 'ushongo'),
(736, '35', 'Ussa', 'ussa'),
(737, '11', 'Uvwie', 'uvwie'),
(738, '4', 'Uyo', 'uyo'),
(739, '15', 'Uzo Uwani', 'uzo-uwani'),
(740, '8', 'Vandeikya', 'vandeikya'),
(741, '34', 'Wamako', 'wamako'),
(742, '26', 'Wamba', 'wamba'),
(743, '20', 'Warawa', 'warawa'),
(744, '6', 'Warji', 'warji'),
(745, '11', 'Warri North', 'warri-north'),
(746, '11', 'Warri South', 'warri-south'),
(747, '11', 'Warri South West', 'warri-south-west'),
(748, '22', 'Wasagu/Danko', 'wasagu-danko'),
(749, '32', 'Wase', 'wase'),
(750, '20', 'Wudil', 'wudil'),
(751, '35', 'Wukari', 'wukari'),
(752, '34', 'Wurno', 'wurno'),
(753, '27', 'Wushishi', 'wushishi'),
(754, '34', 'Yabo', 'yabo'),
(755, '23', 'Yagba East', 'yagba-east'),
(756, '23', 'Yagba West', 'yagba-west'),
(757, '10', 'Yakuur', 'yakuur'),
(758, '10', 'Yala', 'yala'),
(759, '16', 'Yamaltu/Deba', 'yamaltu-deba'),
(760, '18', 'Yankwashi', 'yankwashi'),
(761, '22', 'Yauri', 'yauri'),
(762, '7', 'Yenagoa', 'yenagoa'),
(763, '3', 'Yola North', 'yola-north'),
(764, '3', 'Yola South', 'yola-south'),
(765, '35', 'Yorro', 'yorro'),
(766, '36', 'Yunusari', 'yunusari'),
(767, '36', 'Yusufari', 'yusufari'),
(768, '6', 'Zaki', 'zaki'),
(769, '21', 'Zango', 'zango'),
(770, '19', 'Zangon Kataf', 'zangon-kataf'),
(771, '19', 'Zaria', 'zaria'),
(772, '35', 'Zing', 'zing'),
(773, '37', 'Zurmi', 'zurmi'),
(774, '22', 'Zuru', 'zuru');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `date_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` int(11) UNSIGNED NOT NULL,
  `role_title` varchar(50) NOT NULL DEFAULT '',
  `role_text` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `role_title`, `role_text`) VALUES
(1, 'make_admin_user', 'Make Admin User'),
(2, 'manage_admin_users', 'Manage Admin Users'),
(3, 'edit_admin_users', 'Edit Admin Users'),
(4, 'change_admin_picture', 'Change Admin Picture'),
(5, 'assign_admin_role', 'Assign Admin Role'),
(6, 'remove_admin_user', 'Remove Admin User'),
(7, 'create_admin_user', 'Create Admin User'),
(8, 'manage_registered_users', 'Manage Registered Users'),
(9, 'activate_registered_users', 'Activate Registered Users'),
(10, 'block_registered_users', 'Block Registered Users'),
(11, 'edit_registered_users', 'Edit Registered Users'),
(12, 'change_registered_users_picture', 'Change Registered Users Picture'),
(13, 'manage_newsletter_subscribers', 'Manage Newsletter Subscribers'),
(14, 'role_management', 'Role Management'),
(15, 'manage_categories', 'Manage Categories'),
(16, 'manage_items', 'Manage Items'),
(17, 'transaction_log', 'Transaction Log'),
(18, 'payment_notifications', 'Payment Notifications'),
(19, 'manage_pending_orders', 'Manage Pending Orders'),
(20, 'manage_confirmed_orders', 'Manage Confirmed Orders'),
(21, 'manage_delivered_orders', 'Manage Delivered Orders'),
(22, 'manage_cancelled_orders', 'Manage Cancelled Orders'),
(23, 'manage_general_inbox', 'Manage General Inbox'),
(24, 'send_emails', 'Send Emails'),
(25, 'manage_project_photos', 'Manage Project Photos');

-- --------------------------------------------------------

--
-- Table structure for table `project_photos`
--

CREATE TABLE `project_photos` (
  `id` int(20) UNSIGNED NOT NULL,
  `project_date` date NOT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `title_slug` varchar(250) NOT NULL DEFAULT '',
  `location` varchar(250) NOT NULL DEFAULT '',
  `details` longtext DEFAULT NULL,
  `date_posted` datetime NOT NULL,
  `posted_by` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `date_updated` datetime DEFAULT NULL,
  `updated_by` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_photos`
--

INSERT INTO `project_photos` (`id`, `project_date`, `title`, `title_slug`, `location`, `details`, `date_posted`, `posted_by`, `date_updated`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2022-03-01', 'Emergency Exit Stair Case', 'emergency-exit-stair-case-1650281574983', 'PCL', '', '2022-04-18 12:32:54', 1, '0000-00-00 00:00:00', 0, NULL, '2023-01-13 22:57:21'),
(2, '2022-03-02', 'Extension Of Chiller Platform', 'extension-of-chiller-platform-1650281829181', 'PCL', '', '2022-04-18 12:37:09', 1, '0000-00-00 00:00:00', 0, NULL, '2023-01-13 22:57:21'),
(3, '2022-02-01', 'Diesel Line Connection', 'diesel-line-connection-1650282050597', 'PCL', '', '2022-04-18 12:40:50', 1, '0000-00-00 00:00:00', 0, NULL, '2023-01-13 22:57:21'),
(4, '2022-03-09', 'Installation of Micron Filter Tank', 'installation-of-micron-filter-tank-1650282259859', 'Lacasera company', '', '2022-04-18 12:44:19', 1, '2022-04-18 12:44:57', 1, NULL, '2023-01-13 22:57:21'),
(5, '2021-11-02', 'Running of Inlet and Outlet Water Line on Syrup Tank', 'running-of-inlet-and-outlet-water-line-on-syrup-tank-1650282426436', 'Pending', '', '2022-04-18 12:47:06', 1, '0000-00-00 00:00:00', 0, NULL, '2023-01-13 22:57:21'),
(6, '2021-12-16', 'Circulation Pump Installation', 'circulation-pump-installation-1650282578676', 'Pending', '', '2022-04-18 12:49:38', 1, '0000-00-00 00:00:00', 0, NULL, '2023-01-13 22:57:21'),
(7, '2021-11-03', 'Sliding Gate', 'sliding-gate-1650282674440', 'PRIMA', '', '2022-04-18 12:51:14', 1, '2022-04-18 12:51:48', 1, NULL, '2023-01-13 22:57:21'),
(8, '2022-01-12', 'Construction of Offloading Table', 'construction-of-offloading-table-1650283076215', 'Prima', '', '2022-04-18 12:57:55', 1, '0000-00-00 00:00:00', 0, NULL, '2023-01-13 22:57:21'),
(9, '2022-02-16', 'Sugar Loading Bay', 'sugar-loading-bay-1650283171527', 'TLCC PLANT', '', '2022-04-18 12:59:31', 1, '2022-04-18 13:10:27', 1, NULL, '2023-01-13 22:57:21'),
(10, '2021-11-17', 'Construction of Exhaust Hood', 'construction-of-exhaust-hood-1650283292569', 'TLCC Blowing Machine', '', '2022-04-18 13:01:32', 1, '0000-00-00 00:00:00', 0, NULL, '2023-01-13 22:57:21'),
(11, '2021-11-15', 'Scrap Yard Building Construction', 'scrap-yard-building-construction', 'TLCC PLANT', NULL, '2022-04-18 13:05:10', 1, '2023-01-13 23:12:12', 1, NULL, '2023-01-13 22:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `role_management`
--

CREATE TABLE `role_management` (
  `id` int(11) UNSIGNED NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT '',
  `make_admin_user` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_admin_users` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `edit_admin_users` tinyint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT 0,
  `change_admin_picture` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `assign_admin_role` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `remove_admin_user` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `create_admin_user` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_registered_users` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `activate_registered_users` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `block_registered_users` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `edit_registered_users` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `change_registered_users_picture` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_newsletter_subscribers` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `role_management` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_categories` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_items` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `transaction_log` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `payment_notifications` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_pending_orders` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_confirmed_orders` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_delivered_orders` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_cancelled_orders` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_general_inbox` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `send_emails` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `manage_project_photos` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `date_created` varchar(30) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `date_updated` varchar(30) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_management`
--

INSERT INTO `role_management` (`id`, `role`, `make_admin_user`, `manage_admin_users`, `edit_admin_users`, `change_admin_picture`, `assign_admin_role`, `remove_admin_user`, `create_admin_user`, `manage_registered_users`, `activate_registered_users`, `block_registered_users`, `edit_registered_users`, `change_registered_users_picture`, `manage_newsletter_subscribers`, `role_management`, `manage_categories`, `manage_items`, `transaction_log`, `payment_notifications`, `manage_pending_orders`, `manage_confirmed_orders`, `manage_delivered_orders`, `manage_cancelled_orders`, `manage_general_inbox`, `send_emails`, `manage_project_photos`, `date_created`, `created_by`, `date_updated`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Finance Manager', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '2023-05-21 21:17:36', 1, '0000-00-00 00:00:00', 0, '2023-05-21 20:17:36', '2023-05-21 20:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `saved_items`
--

CREATE TABLE `saved_items` (
  `id` int(20) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `item_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `date_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_items`
--

INSERT INTO `saved_items` (`id`, `user_id`, `item_id`, `date_time`, `created_at`, `updated_at`) VALUES
(3, 1, 1, '2021-08-03 02:20:52', NULL, NULL),
(4, 1, 3, '2021-08-11 15:57:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) UNSIGNED NOT NULL,
  `state` varchar(100) NOT NULL DEFAULT '',
  `state_slug` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`, `state_slug`) VALUES
(1, 'Abia', 'abia'),
(2, 'Abuja', 'abuja'),
(3, 'Adamawa', 'adamawa'),
(4, 'Akwa Ibom', 'akwa-ibom'),
(5, 'Anambra', 'anambra'),
(6, 'Bauchi', 'bauchi'),
(7, 'Bayelsa', 'bayelsa'),
(8, 'Benue', 'benue'),
(9, 'Borno', 'borno'),
(10, 'Cross River', 'cross-river'),
(11, 'Delta', 'delta'),
(12, 'Ebonyi', 'ebonyi'),
(13, 'Edo', 'edo'),
(14, 'Ekiti', 'ekiti'),
(15, 'Enugu', 'enugu'),
(16, 'Gombe', 'gombe'),
(17, 'Imo', 'imo'),
(18, 'Jigawa', 'jigawa'),
(19, 'Kaduna', 'kaduna'),
(20, 'Kano', 'kano'),
(21, 'Katsina', 'katsina'),
(22, 'Kebbi', 'kebbi'),
(23, 'Kogi', 'kogi'),
(24, 'Kwara', 'kwara'),
(25, 'Lagos', 'lagos'),
(26, 'Nasarawa', 'nasarawa'),
(27, 'Niger', 'niger'),
(28, 'Ogun', 'ogun'),
(29, 'Ondo', 'ondo'),
(30, 'Osun', 'osun'),
(31, 'Oyo', 'oyo'),
(32, 'Plateau', 'plateau'),
(33, 'Rivers', 'rivers'),
(34, 'Sokoto', 'sokoto'),
(35, 'Taraba', 'taraba'),
(36, 'Yobe', 'yobe'),
(37, 'Zamfara', 'zamfara');

-- --------------------------------------------------------

--
-- Table structure for table `sub_project_photos`
--

CREATE TABLE `sub_project_photos` (
  `id` int(20) UNSIGNED NOT NULL,
  `project_id` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `file_session_no` varchar(30) NOT NULL DEFAULT '',
  `picture_description` varchar(250) NOT NULL DEFAULT '',
  `date_posted` date NOT NULL,
  `posted_by` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `date_updated` date DEFAULT NULL,
  `updated_by` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_project_photos`
--

INSERT INTO `sub_project_photos` (`id`, `project_id`, `file_session_no`, `picture_description`, `date_posted`, `posted_by`, `date_updated`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, '20220418123042', 'EMERGENCY EXIT STAIR CASE AT PCL 1', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(2, 1, '20220418123052', 'EMERGENCY EXIT STAIR CASE AT PCL 2', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(3, 1, '20220418123107', 'EMERGENCY EXIT STAIR CASE AT PCL 3', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(4, 2, '20220418123521', 'EXTENSION OF CHILLER PLATFORM 1', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(5, 2, '20220418123546', 'EXTENSION OF CHILLER PLATFORM 2', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(6, 2, '20220418123621', 'EXTENSION OF CHILLER PLATFORM 3', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(7, 2, '20220418123643', 'EXTENSION OF CHILLER PLATFORM 4', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(8, 3, '20220418123928', 'DIESEL LINE CONNECTION 1', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(9, 3, '20220418123949', 'DIESEL LINE CONNECTION 2', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(10, 3, '20220418124010', 'DIESEL LINE CONNECTION 3', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(11, 3, '20220418124029', 'DIESEL LINE CONNECTION 4', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(12, 4, '20220418124454', 'Installation of Micron Filter Tank', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(13, 5, '20220418124655', 'Running of inlet and outlet water line on syrup tank', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(14, 6, '20220418124918', 'Circulation pump installation 1', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(15, 6, '20220418124930', 'Circulation pump installation 2', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(16, 7, '20220418125144', 'Sliding Gate', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(17, 8, '20220418125752', 'Construction of Offloading Table', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(18, 9, '20220418125926', 'SUGAR LOADING BAY', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(19, 10, '20220418130128', 'Construction of Exhaust Hood', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(20, 11, '20220418130422', 'SCRAP YARD BUILDING CONSTRUCTION 1', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(21, 11, '20220418130435', 'SCRAP YARD BUILDING CONSTRUCTION 2', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09'),
(22, 11, '20220418130501', 'SCRAP YARD BUILDING CONSTRUCTION 3', '2022-04-18', 1, '0000-00-00', 0, NULL, '2023-01-13 22:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email_verified_at` timestamp(6) NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `dob` date DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `date_registered` datetime DEFAULT NULL,
  `registered_by` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_via` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `logged_in` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `logged_in_via` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `blocked` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `date_time` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `updated_by` int(20) UNSIGNED NOT NULL DEFAULT 0,
  `admin` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `controller` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `gender`, `dob`, `address`, `country`, `date_registered`, `registered_by`, `created_via`, `logged_in`, `logged_in_via`, `active`, `blocked`, `date_time`, `last_login`, `last_update`, `updated_by`, `admin`, `controller`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Wasiu Ishola', 'admin@larasam.loc', NULL, '$2y$10$eY42ifp7NkPG11hx07JHaedvSi5DnxX0M0mOIx6ofvW1dTOONh/Ya', '08088811560', 'Male', '2000-12-01', '7, Wosilat Aina Street, Orile Iganmu', 154, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 1, 1, 0, '', '2022-11-28 15:24:22', '2023-09-10 22:00:55'),
(2, 'Wale Ayo', 'wasionline@yahoo.com', NULL, '$2y$10$O/Yay.PLCl8SwAAoppqW2eDwWs3SOGvp/mna0z.OK3nVpeRK74XGO', '08085698745', 'Male', '2023-01-09', 'Sample Address', 159, NULL, 0, 0, 0, 0, 0, 0, NULL, NULL, '2023-01-28 12:28:06', 1, 1, 0, 0, '', '2023-01-23 15:52:24', '2023-01-28 11:28:06'),
(3, 'Olayinka Bolatito', 'olayinka@gmail.com', NULL, '$2y$10$m4Uaz.goB0Uc2/68f9k9BOPwzrK59GLowroREn0ipvEyqQolD8ZXO', '09152698741', 'Male', '2022-05-04', 'This is a sample address', 18, '2023-01-29 10:16:00', 1, 0, 0, 0, 1, 0, NULL, NULL, '2023-01-29 10:53:51', 1, 0, 0, 0, '', '2023-01-29 09:16:00', '2023-01-29 09:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `users_messages`
--

CREATE TABLE `users_messages` (
  `id` int(100) NOT NULL,
  `ticket_id` varchar(20) NOT NULL DEFAULT '',
  `sender_name` varchar(50) NOT NULL DEFAULT '',
  `sender_email` varchar(50) NOT NULL DEFAULT '',
  `sender_phone` varchar(50) NOT NULL DEFAULT '',
  `recipient_name` varchar(50) NOT NULL DEFAULT '',
  `recipient_email` varchar(50) NOT NULL DEFAULT '',
  `subject` varchar(200) NOT NULL DEFAULT '',
  `message` longtext NOT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `inbox` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `sent` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `date_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_messages`
--

INSERT INTO `users_messages` (`id`, `ticket_id`, `sender_name`, `sender_email`, `sender_phone`, `recipient_name`, `recipient_email`, `subject`, `message`, `viewed`, `inbox`, `sent`, `date_time`, `created_at`, `updated_at`) VALUES
(1, '20190202231543', 'Castle And Retail', 'contact@reliancewisdom.com', '', 'Ishola Wasiu', 'wasiuonline@gmail.com', 'New Order [#INV1]', '&lt;p&gt;Dear Ishola Wasiu,&lt;p&gt; &lt;p&gt;Thank you for making an order. Your order is under review and we will get back to you soon.&lt;/p&gt; &lt;p&gt;Your order has a total amount of &lt;b&gt;&amp;#8358;137,000.00&lt;/b&gt; with invoice no. &lt;b&gt;#INV1&lt;/b&gt;&lt;/p&gt;', 0, 1, 0, '2019-02-02 23:15:43', NULL, NULL),
(2, '20200626115053', 'Castle And Retail', 'contact@castleandretail.com', '', 'Ishola Wasiu', 'wasiuonline@gmail.com', 'New Order [#INV2]', '&lt;p&gt;Dear Ishola Wasiu,&lt;p&gt; &lt;p&gt;Thank you for making an order. Your order is under review and we will get back to you soon.&lt;/p&gt; &lt;p&gt;Your order has a total amount of &lt;b&gt;&amp;#8358;41,000.00&lt;/b&gt; with invoice no. &lt;b&gt;#INV2&lt;/b&gt;&lt;/p&gt;', 0, 1, 0, '2020-06-26 11:50:53', NULL, NULL),
(3, '20210609121705', 'Castle And Retail', 'contact@castleandretail.com', '', 'Ishola Wasiu', 'wasiuonline@gmail.com', 'New Order [#INV3]', '&lt;p&gt;Dear Ishola Wasiu,&lt;p&gt; &lt;p&gt;Thank you for making an order. Your order is under review and we will get back to you soon.&lt;/p&gt; &lt;p&gt;Your order has a total amount of &lt;b&gt;&amp;#8358;76,000.00&lt;/b&gt; with invoice no. &lt;b&gt;#INV3&lt;/b&gt;&lt;/p&gt;', 0, 1, 0, '2021-06-09 12:17:05', NULL, NULL),
(4, '20210803014330', 'Ajoke Elewu', 'info@ajokeelewu.com', '', 'Administrator', 'admin@ajokeelewu.com', 'New Order [#INV4]', '&lt;p&gt;Dear Administrator,&lt;p&gt; &lt;p&gt;Thank you for making an order. Your order is under review and we will get back to you soon.&lt;/p&gt; &lt;p&gt;Your order has a total amount of &lt;b&gt;&amp;#8358;146,000.00&lt;/b&gt; with invoice no. &lt;b&gt;#INV4&lt;/b&gt;&lt;/p&gt;', 1, 1, 0, '2021-08-03 01:43:30', NULL, NULL),
(5, '20210811154218', 'Ajoke Elewu', 'info@ajokeelewu.com', '', 'Administrator', 'admin@ajokeelewu.com', 'New Order [#INV5]', '&lt;p&gt;Dear Administrator,&lt;p&gt; &lt;p&gt;Thank you for making an order. Your order is under review and we will get back to you soon.&lt;/p&gt; &lt;p&gt;Your order has a total amount of &lt;b&gt;&amp;#8358;28,500.00&lt;/b&gt; with invoice no. &lt;b&gt;#INV5&lt;/b&gt;&lt;/p&gt;', 1, 1, 0, '2021-08-11 15:42:18', NULL, NULL),
(6, '20210811165340', 'Ajoke Elewu', 'info@ajokeelewu.com', '', '0', '0', 'Successful Payment - ReliancePay [#cas1623237427348ret]', '<p>Dear 0,</p>\r\n<p>This is to inform you that your payment of <b>&#8358;76,000.00</b> for items order with transaction reference no. <b>#cas1623237427348ret</b> was successful and your order with invoice no. <b>#INV3</b> has been confirmed.</p>\r\n<p>Kindly login to your profile on ajokeelewu.com.</p>', 0, 0, 0, '2021-08-11 16:53:40', NULL, NULL),
(7, '20210901145411', 'Ajoke Elewu', 'info@ajokeelewu.com', '', 'Wasiu Ishola', 'wasiuonline@gmail.com', 'New Order [#INV6]', '&lt;p&gt;Dear Wasiu Ishola,&lt;p&gt; &lt;p&gt;Thank you for making an order. Your order is under review and we will get back to you soon.&lt;/p&gt; &lt;p&gt;Your order has a total amount of &lt;b&gt;&amp;#8358;61,000.00&lt;/b&gt; with invoice no. &lt;b&gt;#INV6&lt;/b&gt;&lt;/p&gt;', 1, 1, 0, '2021-09-01 14:54:11', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_messages`
--
ALTER TABLE `admin_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries_codes`
--
ALTER TABLE `countries_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `local_governments`
--
ALTER TABLE `local_governments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_photos`
--
ALTER TABLE `project_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_management`
--
ALTER TABLE `role_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_items`
--
ALTER TABLE `saved_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_project_photos`
--
ALTER TABLE `sub_project_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_messages`
--
ALTER TABLE `users_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_messages`
--
ALTER TABLE `admin_messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries_codes`
--
ALTER TABLE `countries_codes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_governments`
--
ALTER TABLE `local_governments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `project_photos`
--
ALTER TABLE `project_photos`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role_management`
--
ALTER TABLE `role_management`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saved_items`
--
ALTER TABLE `saved_items`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sub_project_photos`
--
ALTER TABLE `sub_project_photos`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_messages`
--
ALTER TABLE `users_messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
