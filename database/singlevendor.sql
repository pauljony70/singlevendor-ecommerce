-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2024 at 04:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `singlevendor`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `user_id` int(11) NOT NULL,
  `addressarray` mediumtext NOT NULL,
  `defaultaddress` int(11) NOT NULL,
  `org_addressarray` mediumtext DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`user_id`, `addressarray`, `defaultaddress`, `org_addressarray`, `pincode`) VALUES
(10003, '[{\"address_id\":1,\"fullname\":\"Jony Paul\",\"email\":\"paul.jony0606@gmail.com\",\"phone\":\"9874627973\",\"address\":\"Ichapur Bidhanpally West\",\"pincode\":\"743144\",\"state_id\":\"36\",\"state\":\"West Bengal\",\"city_id\":\"1475\",\"city\":\"Kolkata\"}]', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_img` mediumtext NOT NULL,
  `brand_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_img`, `brand_order`) VALUES
(1, 'Arrow', '2024/01/02/40234e90d6e9e44d3c80e1e03ab5b79c_1704180878.webp', 0),
(2, 'Allen Solly', '', 0),
(3, 'ARTICALE', '', 0),
(4, 'Bewakoof', '', 0),
(5, 'Being Human', '', 0),
(6, 'boohooMAN', '', 0),
(7, 'bigbanana', '', 0),
(8, 'COLOR CAPITAL', '', 0),
(9, 'CONFIDENCE', '', 0),
(10, 'Chennis', '', 0),
(11, 'C9 AIRWEAR', '', 0),
(12, 'DILLINGER', '', 0),
(13, 'Dollar', '', 0),
(14, 'Eyebogler', '', 0),
(15, 'Friskers', '', 0),
(16, 'French Connection', '', 0),
(17, 'FRENCH FLEXIOUS', '', 0),
(18, 'FURO by Red Chief', '', 0),
(19, 'GRITSTONES', '', 0),
(20, 'GRACIT', '', 0),
(21, 'Genius18', '', 0),
(22, 'HRX by Hrithik Roshan', '', 0),
(23, 'HERE&NOW', '', 0),
(24, 'H&M', '', 0),
(25, 'HIGHLANDER', '', 0),
(26, 'HiFlyers', '', 0),
(27, 'HJ HASASI', '', 0),
(28, 'HOUSE OF S', '', 0),
(29, 'Harry Potter', '', 0),
(30, 'INVICTUS', '', 0),
(31, 'Imsa Moda', '', 0),
(32, 'Jack & Jones', '', 0),
(33, 'Jockey', '', 0),
(34, 'JADE BLUE', '', 0),
(35, 'JUMP USA', '', 0),
(36, 'Joven', '', 0),
(37, 'Johnny Bravo by Kook N Keech', '', 0),
(38, 'KAEZRI', '', 0),
(39, 'KAJARU', '', 0),
(40, 'KOFFY', '', 0),
(41, 'KOFFY', '', 0),
(42, 'KRAASA', '', 0),
(43, 'KINGDOM OF WHITE', '', 0),
(44, 'Kushi Flyer', '', 0),
(45, 'Kook N Keech Toons', '', 0),
(46, 'Kook N Keech Harry Potter', '', 0),
(47, 'Kook N Keech Garfield', '', 0),
(48, 'Levis', '', 0),
(49, 'LUX NITRO', '', 0),
(50, 'Lee', '', 0),
(51, 'Louis Philippe Sport', '', 0),
(52, 'Louis Philippe', '', 0),
(53, 'LOCOMOTIVE', '', 0),
(54, 'Louis Philippe Jeans', '', 0),
(55, 'Lux Cozi', '', 0),
(56, 'LE BOURGEOIS', '', 0),
(57, 'Louis Philippe ATHPLAY', '', 0),
(58, 'LOUIS STITCH', '', 0),
(59, 'Louis Philippe Ath.Work', '', 0),
(60, 'Nautica', '', 0),
(61, 'Nike', '', 0),
(62, 'New Balance', '', 0),
(63, 'ONN', '', 0),
(64, 'one8 x PUMA', '', 0),
(65, 'one8 by Virat Kohli', '', 0),
(66, 'Puma', '', 0),
(67, 'Pepe Jeans', '', 0),
(68, 'Peter England Casuals', '', 0),
(69, 'People', '', 0),
(70, 'Parx', '', 0),
(71, 'Park Avenue', '', 0),
(72, 'PUNK', '', 0),
(73, 'Peter England', '', 0),
(74, 'PUMA Motorsport', '', 0),
(75, 'PORTBLAIR', '', 0),
(76, 'Pantaloons', '', 0),
(77, 'Peter England Better Jeans Company', '', 0),
(78, 'Purple State', '', 0),
(79, 'PETER ENGLAND UNIVERSITY', '', 0),
(80, 'Pepe', '', 0),
(81, 'Peter England Elite', '', 0),
(82, 'PUMA Hoops', '', 0),
(83, 'PSG', '', 0),
(84, 'PORTOBELLO', '', 0),
(85, 'RARE RABBIT', '', 0),
(86, 'R&B', '', 0),
(87, 'Red Tape', '', 0),
(88, 'Reebok', '', 0),
(89, 'Royal Enfield', '', 0),
(90, 'R.Code by The Roadster Life Co.', '', 0),
(91, 'Raymond', '', 0),
(92, 'Reebok Classic', '', 0),
(93, 'RUG WOODS', '', 0),
(94, 'Status Quo', '', 0),
(95, 'SPYKAR', '', 0),
(96, 'Sztori', '', 0),
(97, 'Snitch', '', 0),
(98, 'Tommy Hilfiger', '', 0),
(99, 'Trendyol', '', 0),
(100, 'Trends Tower', '', 0),
(101, 'U.S. Polo Assn.', '', 0),
(102, 'U.S. Polo Assn. Denim Co.', '', 0),
(103, 'United Colors of Benetton', '', 0),
(104, 'Undercolors of Benetton', '', 0),
(105, 'VIMAL JONNEY', '', 0),
(106, 'Van Heusen', '', 0),
(107, 'VERO AMORE', '', 0),
(108, 'Van Heusen ACADEMY', '', 0),
(109, 'WROGN', '', 0),
(110, 'Wrangler', '', 0),
(111, 'WROGN ACTIVE', '', 0),
(112, 'XYXX', '', 0),
(113, 'Xtep', '', 0),
(114, 'Xohy', '', 0),
(115, 'YOLOCLAN', '', 0),
(116, 'Y&I', '', 0),
(117, 'YWC', '', 0),
(118, 'ZEDD', '', 0),
(119, 'ZALORA BASICS', '', 0),
(120, 'Zarlin', '', 0),
(121, 'ZAMS', '', 0),
(122, 'Ziera', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cartdetails`
--

CREATE TABLE `cartdetails` (
  `user_id` int(11) NOT NULL,
  `prod_id` mediumtext NOT NULL,
  `qoute_id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cartdetails`
--

INSERT INTO `cartdetails` (`user_id`, `prod_id`, `qoute_id`) VALUES
(10005, '[{\"index\":0,\"prod_id\":\"2\",\"qty\":\"1\",\"config_attr\":\"[{\\\"attr_id\\\":\\\"5\\\",\\\"attr_name\\\":\\\"Size\\\",\\\"attr_value\\\":\\\"M\\\"}]\",\"date\":\"2024-02-27\"},{\"index\":1,\"prod_id\":\"3\",\"qty\":\"1\",\"config_attr\":\"[{\\\"attr_id\\\":\\\"5\\\",\\\"attr_name\\\":\\\"Size\\\",\\\"attr_value\\\":\\\"XL\\\"}]\",\"date\":\"2024-02-27\"}]', 0),
(10003, '[{\"index\":0,\"prod_id\":\"3\",\"qty\":\"1\",\"config_attr\":\"[{\\\"attr_id\\\":\\\"5\\\",\\\"attr_name\\\":\\\"Size\\\",\\\"attr_value\\\":\\\"XL\\\"}]\",\"date\":\"2024-02-27\"}]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(80) NOT NULL,
  `cat_name_ar` varchar(80) DEFAULT NULL,
  `cat_img` mediumtext NOT NULL,
  `parent_id` int(11) NOT NULL,
  `cat_order` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_name_ar`, `cat_img`, `parent_id`, `cat_order`) VALUES
(1, 'Women', NULL, '2023/12/31/1f028373b479562ecb87ee7f37324f6b_1703967772.webp', 0, 0),
(2, 'Girls', NULL, '2023/12/31/f088188c2910632eeeda672e83dfcd68_1703967989.webp', 0, 0),
(3, 'Clothing', NULL, '', 1, 0),
(4, 'Accessories', NULL, '', 1, 0),
(5, 'Collections', NULL, '', 1, 0),
(6, 'rECOgnise', NULL, '', 1, 0),
(7, 'Dresses', NULL, '', 3, 0),
(8, 'Co-ords Sets', NULL, '', 3, 0),
(9, 'Tops', NULL, '', 3, 0),
(10, 'Bottoms', NULL, '', 3, 0),
(11, 'Jackets', NULL, '', 3, 0),
(12, 'Jumpsuits', NULL, '', 3, 0),
(13, 'Jewellery', NULL, '', 4, 0),
(14, 'Bags', NULL, '', 4, 0),
(15, 'Belts', NULL, '', 4, 0),
(16, 'Footwear', NULL, '', 4, 0),
(17, 'Hair Accessories', NULL, '', 4, 0),
(18, 'Scarves & Stoles', NULL, '', 4, 0),
(19, 'Fragrances', NULL, '', 4, 0),
(20, 'Season\'s Pick', NULL, '', 5, 0),
(21, 'Bestseller', NULL, '', 5, 0),
(22, 'Fall Winter 23', NULL, '', 5, 0),
(23, 'Everyday Essentials', NULL, '', 5, 0),
(24, 'Evening Wear', NULL, '', 5, 0),
(25, 'Work Wear', NULL, '', 5, 0),
(26, 'Casual Wear', NULL, '', 5, 0),
(27, 'Winter Wear', NULL, '', 5, 0),
(28, 'Gifting', NULL, '', 5, 0),
(29, 'Dopamine Dressing', NULL, '', 5, 0),
(37, 'Co-Ord Sets', NULL, '', 6, 0),
(36, 'Dresses', NULL, '', 6, 0),
(38, 'Tops', NULL, '', 6, 0),
(39, 'Bottoms', NULL, '', 6, 0),
(40, 'Jumpsuits', NULL, '', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(80) NOT NULL,
  `state_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `state_code`) VALUES
(1, 'Kolhapur', 21),
(2, 'Port Blair', 1),
(3, 'Adilabad', 2),
(4, 'Adoni', 2),
(5, 'Amadalavalasa', 2),
(6, 'Amalapuram', 2),
(7, 'Anakapalle', 2),
(8, 'Anantapur', 2),
(9, 'Badepalle', 2),
(10, 'Banganapalle', 2),
(11, 'Bapatla', 2),
(12, 'Bellampalle', 2),
(13, 'Bethamcherla', 2),
(14, 'Bhadrachalam', 2),
(15, 'Bhainsa', 2),
(16, 'Bheemunipatnam', 2),
(17, 'Bhimavaram', 2),
(18, 'Bhongir', 2),
(19, 'Bobbili', 2),
(20, 'Bodhan', 2),
(21, 'Chilakaluripet', 2),
(22, 'Chirala', 2),
(23, 'Chittoor', 2),
(24, 'Cuddapah', 2),
(25, 'Devarakonda', 2),
(26, 'Dharmavaram', 2),
(27, 'Eluru', 2),
(28, 'Farooqnagar', 2),
(29, 'Gadwal', 2),
(30, 'Gooty', 2),
(31, 'Gudivada', 2),
(32, 'Gudur', 2),
(33, 'Guntakal', 2),
(34, 'Guntur', 2),
(35, 'Hanuman Junction', 2),
(36, 'Hindupur', 2),
(37, 'Hyderabad', 2),
(38, 'Ichchapuram', 2),
(39, 'Jaggaiahpet', 2),
(40, 'Jagtial', 2),
(41, 'Jammalamadugu', 2),
(42, 'Jangaon', 2),
(43, 'Kadapa', 2),
(44, 'Kadiri', 2),
(45, 'Kagaznagar', 2),
(46, 'Kakinada', 2),
(47, 'Kalyandurg', 2),
(48, 'Kamareddy', 2),
(49, 'Kandukur', 2),
(50, 'Karimnagar', 2),
(51, 'Kavali', 2),
(52, 'Khammam', 2),
(53, 'Koratla', 2),
(54, 'Kothagudem', 2),
(55, 'Kothapeta', 2),
(56, 'Kovvur', 2),
(57, 'Kurnool', 2),
(58, 'Kyathampalle', 2),
(59, 'Macherla', 2),
(60, 'Machilipatnam', 2),
(61, 'Madanapalle', 2),
(62, 'Mahbubnagar', 2),
(63, 'Mancherial', 2),
(64, 'Mandamarri', 2),
(65, 'Mandapeta', 2),
(66, 'Manuguru', 2),
(67, 'Markapur', 2),
(68, 'Medak', 2),
(69, 'Miryalaguda', 2),
(70, 'Mogalthur', 2),
(71, 'Nagari', 2),
(72, 'Nagarkurnool', 2),
(73, 'Nandyal', 2),
(74, 'Narasapur', 2),
(75, 'Narasaraopet', 2),
(76, 'Narayanpet', 2),
(77, 'Narsipatnam', 2),
(78, 'Nellore', 2),
(79, 'Nidadavole', 2),
(80, 'Nirmal', 2),
(81, 'Nizamabad', 2),
(82, 'Nuzvid', 2),
(83, 'Ongole', 2),
(84, 'Palacole', 2),
(85, 'Palasa Kasibugga', 2),
(86, 'Palwancha', 2),
(87, 'Parvathipuram', 2),
(88, 'Pedana', 2),
(89, 'Peddapuram', 2),
(90, 'Pithapuram', 2),
(91, 'Pondur', 2),
(92, 'Ponnur', 2),
(93, 'Proddatur', 2),
(94, 'Punganur', 2),
(95, 'Puttur', 2),
(96, 'Rajahmundry', 2),
(97, 'Rajam', 2),
(98, 'Ramachandrapuram', 2),
(99, 'Ramagundam', 2),
(100, 'Rayachoti', 2),
(101, 'Rayadurg', 2),
(102, 'Renigunta', 2),
(103, 'Repalle', 2),
(104, 'Sadasivpet', 2),
(105, 'Salur', 2),
(106, 'Samalkot', 2),
(107, 'Sangareddy', 2),
(108, 'Sattenapalle', 2),
(109, 'Siddipet', 2),
(110, 'Singapur', 2),
(111, 'Sircilla', 2),
(112, 'Srikakulam', 2),
(113, 'Srikalahasti', 2),
(115, 'Suryapet', 2),
(116, 'Tadepalligudem', 2),
(117, 'Tadpatri', 2),
(118, 'Tandur', 2),
(119, 'Tanuku', 2),
(120, 'Tenali', 2),
(121, 'Tirupati', 2),
(122, 'Tuni', 2),
(123, 'Uravakonda', 2),
(124, 'Venkatagiri', 2),
(125, 'Vicarabad', 2),
(126, 'Vijayawada', 2),
(127, 'Vinukonda', 2),
(128, 'Visakhapatnam', 2),
(129, 'Vizianagaram', 2),
(130, 'Wanaparthy', 2),
(131, 'Warangal', 2),
(132, 'Yellandu', 2),
(133, 'Yemmiganur', 2),
(134, 'Yerraguntla', 2),
(135, 'Zahirabad', 2),
(136, 'Rajampet', 2),
(137, 'Along', 3),
(138, 'Bomdila', 3),
(139, 'Itanagar', 3),
(140, 'Naharlagun', 3),
(141, 'Pasighat', 3),
(142, 'Abhayapuri', 4),
(143, 'Amguri', 4),
(144, 'Anandnagaar', 4),
(145, 'Barpeta', 4),
(146, 'Barpeta Road', 4),
(147, 'Bilasipara', 4),
(148, 'Bongaigaon', 4),
(149, 'Dhekiajuli', 4),
(150, 'Dhubri', 4),
(151, 'Dibrugarh', 4),
(152, 'Digboi', 4),
(153, 'Diphu', 4),
(154, 'Dispur', 4),
(156, 'Gauripur', 4),
(157, 'Goalpara', 4),
(158, 'Golaghat', 4),
(159, 'Guwahati', 4),
(160, 'Haflong', 4),
(161, 'Hailakandi', 4),
(162, 'Hojai', 4),
(163, 'Jorhat', 4),
(164, 'Karimganj', 4),
(165, 'Kokrajhar', 4),
(166, 'Lanka', 4),
(167, 'Lumding', 4),
(168, 'Mangaldoi', 4),
(169, 'Mankachar', 4),
(170, 'Margherita', 4),
(171, 'Mariani', 4),
(172, 'Marigaon', 4),
(173, 'Nagaon', 4),
(174, 'Nalbari', 4),
(175, 'North Lakhimpur', 4),
(176, 'Rangia', 4),
(177, 'Sibsagar', 4),
(178, 'Silapathar', 4),
(179, 'Silchar', 4),
(180, 'Tezpur', 4),
(181, 'Tinsukia', 4),
(182, 'Amarpur', 5),
(183, 'Araria', 5),
(184, 'Areraj', 5),
(185, 'Arrah', 5),
(186, 'Asarganj', 5),
(187, 'Aurangabad', 5),
(188, 'Bagaha', 5),
(189, 'Bahadurganj', 5),
(190, 'Bairgania', 5),
(191, 'Bakhtiarpur', 5),
(192, 'Banka', 5),
(193, 'Banmankhi Bazar', 5),
(194, 'Barahiya', 5),
(195, 'Barauli', 5),
(196, 'Barbigha', 5),
(197, 'Barh', 5),
(198, 'Begusarai', 5),
(199, 'Behea', 5),
(200, 'Bettiah', 5),
(201, 'Bhabua', 5),
(202, 'Bhagalpur', 5),
(203, 'Bihar Sharif', 5),
(204, 'Bikramganj', 5),
(205, 'Bodh Gaya', 5),
(206, 'Buxar', 5),
(207, 'Chandan Bara', 5),
(208, 'Chanpatia', 5),
(209, 'Chhapra', 5),
(210, 'Colgong', 5),
(211, 'Dalsinghsarai', 5),
(212, 'Darbhanga', 5),
(213, 'Daudnagar', 5),
(214, 'Dehri-on-Sone', 5),
(215, 'Dhaka', 5),
(216, 'Dighwara', 5),
(217, 'Dumraon', 5),
(218, 'Fatwah', 5),
(219, 'Forbesganj', 5),
(220, 'Gaya', 5),
(221, 'Gogri Jamalpur', 5),
(222, 'Gopalganj', 5),
(223, 'Hajipur', 5),
(224, 'Hilsa', 5),
(225, 'Hisua', 5),
(226, 'Islampur', 5),
(227, 'Jagdispur', 5),
(228, 'Jamalpur', 5),
(229, 'Jamui', 5),
(230, 'Jehanabad', 5),
(231, 'Jhajha', 5),
(232, 'Jhanjharpur', 5),
(233, 'Jogabani', 5),
(234, 'Kanti', 5),
(235, 'Katihar', 5),
(236, 'Khagaria', 5),
(237, 'Kharagpur', 5),
(238, 'Kishanganj', 5),
(239, 'Lakhisarai', 5),
(240, 'Lalganj', 5),
(241, 'Madhepura', 5),
(242, 'Madhubani', 5),
(243, 'Maharajganj', 5),
(244, 'Mahnar Bazar', 5),
(245, 'Makhdumpur', 5),
(246, 'Maner', 5),
(247, 'Manihari', 5),
(248, 'Marhaura', 5),
(249, 'Masaurhi', 5),
(250, 'Mirganj', 5),
(251, 'Mokameh', 5),
(252, 'Motihari', 5),
(253, 'Motipur', 5),
(254, 'Munger', 5),
(255, 'Murliganj', 5),
(256, 'Muzaffarpur', 5),
(257, 'Narkatiaganj', 5),
(258, 'Naugachhia', 5),
(259, 'Nawada', 5),
(260, 'Nokha', 5),
(261, 'Patna', 5),
(262, 'Piro', 5),
(263, 'Purnia', 5),
(264, 'Rafiganj', 5),
(265, 'Rajgir', 5),
(266, 'Ramnagar', 5),
(267, 'Raxaul Bazar', 5),
(268, 'Revelganj', 5),
(269, 'Rosera', 5),
(270, 'Saharsa', 5),
(271, 'Samastipur', 5),
(272, 'Sasaram', 5),
(273, 'Sheikhpura', 5),
(274, 'Sheohar', 5),
(275, 'Sherghati', 5),
(276, 'Silao', 5),
(277, 'Sitamarhi', 5),
(278, 'Siwan', 5),
(279, 'Sonepur', 5),
(280, 'Sugauli', 5),
(281, 'Sultanganj', 5),
(282, 'Supaul', 5),
(283, 'Warisaliganj', 5),
(284, 'Ahiwara', 7),
(285, 'Akaltara', 7),
(286, 'Ambagarh Chowki', 7),
(287, 'Ambikapur', 7),
(288, 'Arang', 7),
(289, 'Bade Bacheli', 7),
(290, 'Balod', 7),
(291, 'Baloda Bazar', 7),
(292, 'Bemetra', 7),
(293, 'Bhatapara', 7),
(294, 'Bilaspur', 7),
(295, 'Birgaon', 7),
(296, 'Champa', 7),
(297, 'Chirmiri', 7),
(298, 'Dalli-Rajhara', 7),
(299, 'Dhamtari', 7),
(300, 'Dipka', 7),
(301, 'Dongargarh', 7),
(302, 'Durg-Bhilai Nagar', 7),
(303, 'Gobranawapara', 7),
(304, 'Jagdalpur', 7),
(305, 'Janjgir', 7),
(306, 'Jashpurnagar', 7),
(307, 'Kanker', 7),
(308, 'Kawardha', 7),
(309, 'Kondagaon', 7),
(310, 'Korba', 7),
(311, 'Mahasamund', 7),
(312, 'Mahendragarh', 7),
(313, 'Mungeli', 7),
(314, 'Naila Janjgir', 7),
(315, 'Raigarh', 7),
(316, 'Raipur', 7),
(317, 'Rajnandgaon', 7),
(318, 'Sakti', 7),
(319, 'Tilda Newra', 7),
(320, 'Amli', 8),
(321, 'Silvassa', 8),
(322, 'Daman and Diu', 9),
(323, 'Daman and Diu', 9),
(324, 'Asola', 10),
(325, 'Delhi', 10),
(326, 'Aldona', 11),
(327, 'Curchorem Cacora', 11),
(328, 'Madgaon', 11),
(329, 'Mapusa', 11),
(330, 'Margao', 11),
(331, 'Marmagao', 11),
(332, 'Panaji', 11),
(333, 'Ahmedabad', 12),
(334, 'Amreli', 12),
(335, 'Anand', 12),
(336, 'Ankleshwar', 12),
(337, 'Bharuch', 12),
(338, 'Bhavnagar', 12),
(339, 'Bhuj', 12),
(340, 'Cambay', 12),
(341, 'Dahod', 12),
(342, 'Deesa', 12),
(344, 'Dholka', 12),
(345, 'Gandhinagar', 12),
(346, 'Godhra', 12),
(347, 'Himatnagar', 12),
(348, 'Idar', 12),
(349, 'Jamnagar', 12),
(350, 'Junagadh', 12),
(351, 'Kadi', 12),
(352, 'Kalavad', 12),
(353, 'Kalol', 12),
(354, 'Kapadvanj', 12),
(355, 'Karjan', 12),
(356, 'Keshod', 12),
(357, 'Khambhalia', 12),
(358, 'Khambhat', 12),
(359, 'Kheda', 12),
(360, 'Khedbrahma', 12),
(361, 'Kheralu', 12),
(362, 'Kodinar', 12),
(363, 'Lathi', 12),
(364, 'Limbdi', 12),
(365, 'Lunawada', 12),
(366, 'Mahesana', 12),
(367, 'Mahuva', 12),
(368, 'Manavadar', 12),
(369, 'Mandvi', 12),
(370, 'Mangrol', 12),
(371, 'Mansa', 12),
(372, 'Mehmedabad', 12),
(373, 'Modasa', 12),
(374, 'Morvi', 12),
(375, 'Nadiad', 12),
(376, 'Navsari', 12),
(377, 'Padra', 12),
(378, 'Palanpur', 12),
(379, 'Palitana', 12),
(380, 'Pardi', 12),
(381, 'Patan', 12),
(382, 'Petlad', 12),
(383, 'Porbandar', 12),
(384, 'Radhanpur', 12),
(385, 'Rajkot', 12),
(386, 'Rajpipla', 12),
(387, 'Rajula', 12),
(388, 'Ranavav', 12),
(389, 'Rapar', 12),
(390, 'Salaya', 12),
(391, 'Sanand', 12),
(392, 'Savarkundla', 12),
(393, 'Sidhpur', 12),
(394, 'Sihor', 12),
(395, 'Songadh', 12),
(396, 'Surat', 12),
(397, 'Talaja', 12),
(398, 'Thangadh', 12),
(399, 'Tharad', 12),
(400, 'Umbergaon', 12),
(401, 'Umreth', 12),
(402, 'Una', 12),
(403, 'Unjha', 12),
(404, 'Upleta', 12),
(405, 'Vadnagar', 12),
(406, 'Vadodara', 12),
(407, 'Valsad', 12),
(408, 'Vapi', 12),
(409, 'Vapi', 12),
(410, 'Veraval', 12),
(411, 'Vijapur', 12),
(412, 'Viramgam', 12),
(413, 'Visnagar', 12),
(414, 'Vyara', 12),
(415, 'Wadhwan', 12),
(416, 'Wankaner', 12),
(417, 'Adalaj', 12),
(418, 'Adityana', 12),
(419, 'Alang', 12),
(420, 'Ambaji', 12),
(421, 'Ambaliyasan', 12),
(422, 'Andada', 12),
(423, 'Anjar', 12),
(424, 'Anklav', 12),
(425, 'Antaliya', 12),
(426, 'Arambhada', 12),
(427, 'Atul', 12),
(428, 'Ballabhgarh', 13),
(429, 'Ambala', 13),
(430, 'Ambala', 13),
(431, 'Asankhurd', 13),
(432, 'Assandh', 13),
(433, 'Ateli', 13),
(434, 'Babiyal', 13),
(435, 'Bahadurgarh', 13),
(436, 'Barwala', 13),
(437, 'Bhiwani', 13),
(438, 'Charkhi Dadri', 13),
(439, 'Cheeka', 13),
(440, 'Ellenabad 2', 13),
(441, 'Faridabad', 13),
(442, 'Fatehabad', 13),
(443, 'Ganaur', 13),
(444, 'Gharaunda', 13),
(445, 'Gohana', 13),
(446, 'Gurgaon', 13),
(447, 'Haibat(Yamuna Nagar)', 13),
(448, 'Hansi', 13),
(449, 'Hisar', 13),
(450, 'Hodal', 13),
(451, 'Jhajjar', 13),
(452, 'Jind', 13),
(453, 'Kaithal', 13),
(454, 'Kalan Wali', 13),
(455, 'Kalka', 13),
(456, 'Karnal', 13),
(457, 'Ladwa', 13),
(458, 'Mahendragarh', 13),
(459, 'Mandi Dabwali', 13),
(460, 'Narnaul', 13),
(461, 'Narwana', 13),
(462, 'Palwal', 13),
(463, 'Panchkula', 13),
(464, 'Panipat', 13),
(465, 'Pehowa', 13),
(466, 'Pinjore', 13),
(467, 'Rania', 13),
(468, 'Ratia', 13),
(469, 'Rewari', 13),
(470, 'Rohtak', 13),
(471, 'Safidon', 13),
(472, 'Samalkha', 13),
(473, 'Shahbad', 13),
(474, 'Sirsa', 13),
(475, 'Sohna', 13),
(476, 'Sonipat', 13),
(477, 'Taraori', 13),
(478, 'Thanesar', 13),
(479, 'Tohana', 13),
(480, 'Yamunanagar', 13),
(481, 'Arki', 14),
(482, 'Baddi', 14),
(483, 'Bilaspur', 14),
(484, 'Chamba', 14),
(485, 'Dalhousie', 14),
(486, 'Dharamsala', 14),
(487, 'Hamirpur', 14),
(488, 'Mandi', 14),
(489, 'Nahan', 14),
(490, 'Shimla', 14),
(491, 'Solan', 14),
(492, 'Sundarnagar', 14),
(493, 'Jammu', 15),
(494, 'Achabbal', 15),
(495, 'Akhnoor', 15),
(496, 'Anantnag', 15),
(497, 'Arnia', 15),
(498, 'Awantipora', 15),
(499, 'Bandipore', 15),
(500, 'Baramula', 15),
(501, 'Kathua', 15),
(502, 'Leh', 15),
(503, 'Punch', 15),
(504, 'Rajauri', 15),
(505, 'Sopore', 15),
(506, 'Srinagar', 15),
(507, 'Udhampur', 15),
(508, 'Amlabad', 16),
(509, 'Ara', 16),
(510, 'Barughutu', 16),
(511, 'Bokaro Steel City', 16),
(512, 'Chaibasa', 16),
(513, 'Chakradharpur', 16),
(514, 'Chandrapura', 16),
(515, 'Chatra', 16),
(516, 'Chirkunda', 16),
(517, 'Churi', 16),
(518, 'Daltonganj', 16),
(519, 'Deoghar', 16),
(520, 'Dhanbad', 16),
(521, 'Dumka', 16),
(522, 'Garhwa', 16),
(523, 'Ghatshila', 16),
(524, 'Giridih', 16),
(525, 'Godda', 16),
(526, 'Gomoh', 16),
(527, 'Gumia', 16),
(528, 'Gumla', 16),
(529, 'Hazaribag', 16),
(530, 'Hussainabad', 16),
(531, 'Jamshedpur', 16),
(532, 'Jamtara', 16),
(533, 'Jhumri Tilaiya', 16),
(534, 'Khunti', 16),
(535, 'Lohardaga', 16),
(536, 'Madhupur', 16),
(537, 'Mihijam', 16),
(538, 'Musabani', 16),
(539, 'Pakaur', 16),
(540, 'Patratu', 16),
(541, 'Phusro', 16),
(542, 'Ramngarh', 16),
(543, 'Ranchi', 16),
(544, 'Sahibganj', 16),
(545, 'Saunda', 16),
(546, 'Simdega', 16),
(547, 'Tenu Dam-cum- Kathhara', 16),
(548, 'Arasikere', 17),
(549, 'Bangalore', 17),
(550, 'Belgaum', 17),
(551, 'Bellary', 17),
(552, 'Chamrajnagar', 17),
(553, 'Chikkaballapur', 17),
(554, 'Chintamani', 17),
(555, 'Chitradurga', 17),
(556, 'Gulbarga', 17),
(557, 'Gundlupet', 17),
(558, 'Hassan', 17),
(559, 'Hospet', 17),
(560, 'Hubli', 17),
(561, 'Karkala', 17),
(562, 'Karwar', 17),
(563, 'Kolar', 17),
(564, 'Kota', 17),
(565, 'Lakshmeshwar', 17),
(566, 'Lingsugur', 17),
(567, 'Maddur', 17),
(568, 'Madhugiri', 17),
(569, 'Madikeri', 17),
(570, 'Magadi', 17),
(571, 'Mahalingpur', 17),
(572, 'Malavalli', 17),
(573, 'Malur', 17),
(574, 'Mandya', 17),
(575, 'Mangalore', 17),
(576, 'Manvi', 17),
(577, 'Mudalgi', 17),
(578, 'Mudbidri', 17),
(579, 'Muddebihal', 17),
(580, 'Mudhol', 17),
(581, 'Mulbagal', 17),
(582, 'Mundargi', 17),
(583, 'Mysore', 17),
(584, 'Nanjangud', 17),
(585, 'Pavagada', 17),
(586, 'Puttur', 17),
(587, 'Rabkavi Banhatti', 17),
(588, 'Raichur', 17),
(589, 'Ramanagaram', 17),
(590, 'Ramdurg', 17),
(591, 'Ranibennur', 17),
(592, 'Robertson Pet', 17),
(593, 'Ron', 17),
(594, 'Sadalgi', 17),
(595, 'Sagar', 17),
(596, 'Sakleshpur', 17),
(597, 'Sandur', 17),
(598, 'Sankeshwar', 17),
(599, 'Saundatti-Yellamma', 17),
(600, 'Savanur', 17),
(601, 'Sedam', 17),
(602, 'Shahabad', 17),
(603, 'Shahpur', 17),
(604, 'Shiggaon', 17),
(605, 'Shikapur', 17),
(606, 'Shimoga', 17),
(607, 'Shorapur', 17),
(608, 'Shrirangapattana', 17),
(609, 'Sidlaghatta', 17),
(610, 'Sindgi', 17),
(611, 'Sindhnur', 17),
(612, 'Sira', 17),
(613, 'Sirsi', 17),
(614, 'Siruguppa', 17),
(615, 'Srinivaspur', 17),
(616, 'Talikota', 17),
(617, 'Tarikere', 17),
(618, 'Tekkalakota', 17),
(619, 'Terdal', 17),
(620, 'Tiptur', 17),
(621, 'Tumkur', 17),
(622, 'Udupi', 17),
(623, 'Vijayapura', 17),
(624, 'Wadi', 17),
(625, 'Yadgir', 17),
(626, 'Adoor', 18),
(627, 'Akathiyoor', 18),
(628, 'Alappuzha', 18),
(629, 'Ancharakandy', 18),
(630, 'Aroor', 18),
(631, 'Ashtamichira', 18),
(632, 'Attingal', 18),
(633, 'Avinissery', 18),
(634, 'Chalakudy', 18),
(635, 'Changanassery', 18),
(636, 'Chendamangalam', 18),
(637, 'Chengannur', 18),
(638, 'Cherthala', 18),
(639, 'Cheruthazham', 18),
(640, 'Chittur-Thathamangalam', 18),
(641, 'Chockli', 18),
(642, 'Erattupetta', 18),
(643, 'Guruvayoor', 18),
(644, 'Irinjalakuda', 18),
(645, 'Kadirur', 18),
(646, 'Kalliasseri', 18),
(647, 'Kalpetta', 18),
(648, 'Kanhangad', 18),
(649, 'Kanjikkuzhi', 18),
(650, 'Kannur', 18),
(651, 'Kasaragod', 18),
(652, 'Kayamkulam', 18),
(653, 'Kochi', 18),
(654, 'Kodungallur', 18),
(655, 'Kollam', 18),
(656, 'Koothuparamba', 18),
(657, 'Kothamangalam', 18),
(658, 'Kottayam', 18),
(659, 'Kozhikode', 18),
(660, 'Kunnamkulam', 18),
(661, 'Malappuram', 18),
(662, 'Mattannur', 18),
(663, 'Mavelikkara', 18),
(664, 'Mavoor', 18),
(665, 'Muvattupuzha', 18),
(666, 'Nedumangad', 18),
(667, 'Neyyattinkara', 18),
(668, 'Ottappalam', 18),
(669, 'Palai', 18),
(670, 'Palakkad', 18),
(671, 'Panniyannur', 18),
(672, 'Pappinisseri', 18),
(673, 'Paravoor', 18),
(674, 'Pathanamthitta', 18),
(675, 'Payyannur', 18),
(676, 'Peringathur', 18),
(677, 'Perinthalmanna', 18),
(678, 'Perumbavoor', 18),
(679, 'Ponnani', 18),
(680, 'Punalur', 18),
(681, 'Quilandy', 18),
(682, 'Shoranur', 18),
(683, 'Taliparamba', 18),
(684, 'Thiruvalla', 18),
(685, 'Thiruvananthapuram', 18),
(686, 'Thodupuzha', 18),
(687, 'Thrissur', 18),
(688, 'Tirur', 18),
(689, 'Vadakara', 18),
(690, 'Vaikom', 18),
(691, 'Varkala', 18),
(692, 'Kavaratti', 19),
(693, 'Ashok Nagar', 20),
(694, 'Balaghat', 20),
(695, 'Betul', 20),
(696, 'Bhopal', 20),
(697, 'Burhanpur', 20),
(698, 'Chhatarpur', 20),
(699, 'Dabra', 20),
(700, 'Datia', 20),
(701, 'Dewas', 20),
(702, 'Dhar', 20),
(703, 'Fatehabad', 20),
(704, 'Gwalior', 20),
(705, 'Indore', 20),
(706, 'Itarsi', 20),
(707, 'Jabalpur', 20),
(708, 'Katni', 20),
(709, 'Kotma', 20),
(710, 'Lahar', 20),
(711, 'Lundi', 20),
(712, 'Maharajpur', 20),
(713, 'Mahidpur', 20),
(714, 'Maihar', 20),
(715, 'Malajkhand', 20),
(716, 'Manasa', 20),
(717, 'Manawar', 20),
(718, 'Mandideep', 20),
(719, 'Mandla', 20),
(720, 'Mandsaur', 20),
(721, 'Mauganj', 20),
(722, 'Mhow Cantonment', 20),
(723, 'Mhowgaon', 20),
(724, 'Morena', 20),
(725, 'Multai', 20),
(726, 'Murwara', 20),
(727, 'Nagda', 20),
(728, 'Nainpur', 20),
(729, 'Narsinghgarh', 20),
(730, 'Narsinghgarh', 20),
(731, 'Neemuch', 20),
(732, 'Nepanagar', 20),
(733, 'Niwari', 20),
(734, 'Nowgong', 20),
(735, 'Nowrozabad', 20),
(736, 'Pachore', 20),
(737, 'Pali', 20),
(738, 'Panagar', 20),
(739, 'Pandhurna', 20),
(740, 'Panna', 20),
(741, 'Pasan', 20),
(742, 'Pipariya', 20),
(743, 'Pithampur', 20),
(744, 'Porsa', 20),
(745, 'Prithvipur', 20),
(746, 'Raghogarh-Vijaypur', 20),
(747, 'Rahatgarh', 20),
(748, 'Raisen', 20),
(749, 'Rajgarh', 20),
(750, 'Ratlam', 20),
(751, 'Rau', 20),
(752, 'Rehli', 20),
(753, 'Rewa', 20),
(754, 'Sabalgarh', 20),
(755, 'Sagar', 20),
(756, 'Sanawad', 20),
(757, 'Sarangpur', 20),
(758, 'Sarni', 20),
(759, 'Satna', 20),
(760, 'Sausar', 20),
(761, 'Sehore', 20),
(762, 'Sendhwa', 20),
(763, 'Seoni', 20),
(764, 'Seoni-Malwa', 20),
(765, 'Shahdol', 20),
(766, 'Shajapur', 20),
(767, 'Shamgarh', 20),
(768, 'Sheopur', 20),
(769, 'Shivpuri', 20),
(770, 'Shujalpur', 20),
(771, 'Sidhi', 20),
(772, 'Sihora', 20),
(773, 'Singrauli', 20),
(774, 'Sironj', 20),
(775, 'Sohagpur', 20),
(776, 'Tarana', 20),
(777, 'Tikamgarh', 20),
(778, 'Ujhani', 20),
(779, 'Ujjain', 20),
(780, 'Umaria', 20),
(781, 'Vidisha', 20),
(782, 'Wara Seoni', 20),
(783, 'Ahmednagar', 21),
(784, 'Akola', 21),
(785, 'Amravati', 21),
(786, 'Aurangabad', 21),
(787, 'Baramati', 21),
(788, 'Chalisgaon', 21),
(789, 'Chinchani', 21),
(790, 'Devgarh', 21),
(791, 'Dhule', 21),
(792, 'Dombivli', 21),
(793, 'Durgapur', 21),
(794, 'Ichalkaranji', 21),
(795, 'Jalna', 21),
(796, 'Kalyan', 21),
(797, 'Latur', 21),
(798, 'Loha', 21),
(799, 'Lonar', 21),
(800, 'Lonavla', 21),
(801, 'Mahad', 21),
(802, 'Mahuli', 21),
(803, 'Malegaon', 21),
(804, 'Malkapur', 21),
(805, 'Manchar', 21),
(806, 'Mangalvedhe', 21),
(807, 'Mangrulpir', 21),
(808, 'Manjlegaon', 21),
(809, 'Manmad', 21),
(810, 'Manwath', 21),
(811, 'Mehkar', 21),
(812, 'Mhaswad', 21),
(813, 'Miraj', 21),
(814, 'Morshi', 21),
(815, 'Mukhed', 21),
(816, 'Mul', 21),
(817, 'Mumbai', 21),
(818, 'Murtijapur', 21),
(819, 'Nagpur', 21),
(820, 'Nalasopara', 21),
(821, 'Nanded-Waghala', 21),
(822, 'Nandgaon', 21),
(823, 'Nandura', 21),
(824, 'Nandurbar', 21),
(825, 'Narkhed', 21),
(826, 'Nashik', 21),
(827, 'Navi Mumbai', 21),
(828, 'Nawapur', 21),
(829, 'Nilanga', 21),
(830, 'Osmanabad', 21),
(831, 'Ozar', 21),
(832, 'Pachora', 21),
(833, 'Paithan', 21),
(834, 'Palghar', 21),
(835, 'Pandharkaoda', 21),
(836, 'Pandharpur', 21),
(837, 'Panvel', 21),
(838, 'Parbhani', 21),
(839, 'Parli', 21),
(840, 'Parola', 21),
(841, 'Partur', 21),
(842, 'Pathardi', 21),
(843, 'Pathri', 21),
(844, 'Patur', 21),
(845, 'Pauni', 21),
(846, 'Pen', 21),
(847, 'Phaltan', 21),
(848, 'Pulgaon', 21),
(849, 'Pune', 21),
(850, 'Purna', 21),
(851, 'Pusad', 21),
(852, 'Rahuri', 21),
(853, 'Rajura', 21),
(854, 'Ramtek', 21),
(855, 'Ratnagiri', 21),
(856, 'Raver', 21),
(857, 'Risod', 21),
(858, 'Sailu', 21),
(859, 'Sangamner', 21),
(860, 'Sangli', 21),
(861, 'Sangole', 21),
(862, 'Sasvad', 21),
(863, 'Satana', 21),
(864, 'Satara', 21),
(865, 'Savner', 21),
(866, 'Sawantwadi', 21),
(867, 'Shahade', 21),
(868, 'Shegaon', 21),
(869, 'Shendurjana', 21),
(870, 'Shirdi', 21),
(871, 'Shirpur-Warwade', 21),
(872, 'Shirur', 21),
(873, 'Shrigonda', 21),
(874, 'Shrirampur', 21),
(875, 'Sillod', 21),
(876, 'Sinnar', 21),
(877, 'Solapur', 21),
(878, 'Soyagaon', 21),
(879, 'Talegaon Dabhade', 21),
(880, 'Talode', 21),
(881, 'Tasgaon', 21),
(882, 'Tirora', 21),
(883, 'Tuljapur', 21),
(884, 'Tumsar', 21),
(885, 'Uran', 21),
(886, 'Uran Islampur', 21),
(887, 'Wadgaon Road', 21),
(888, 'Wai', 21),
(889, 'Wani', 21),
(890, 'Wardha', 21),
(891, 'Warora', 21),
(892, 'Warud', 21),
(893, 'Washim', 21),
(894, 'Yevla', 21),
(895, 'Uchgaon', 21),
(896, 'Udgir', 21),
(897, 'Umarga', 21),
(898, 'Umarkhed', 21),
(899, 'Umred', 21),
(900, 'Vadgaon Kasba', 21),
(901, 'Vaijapur', 21),
(902, 'Vasai', 21),
(903, 'Virar', 21),
(904, 'Vita', 21),
(905, 'Yavatmal', 21),
(906, 'Yawal', 21),
(907, 'Imphal', 22),
(908, 'Kakching', 22),
(909, 'Lilong', 22),
(910, 'Mayang Imphal', 22),
(911, 'Thoubal', 22),
(912, 'Jowai', 23),
(913, 'Nongstoin', 23),
(914, 'Shillong', 23),
(915, 'Tura', 23),
(916, 'Aizawl', 24),
(917, 'Champhai', 24),
(918, 'Lunglei', 24),
(919, 'Saiha', 24),
(920, 'Dimapur', 25),
(921, 'Kohima', 25),
(922, 'Mokokchung', 25),
(923, 'Tuensang', 25),
(924, 'Wokha', 25),
(925, 'Zunheboto', 25),
(950, 'Anandapur', 26),
(951, 'Anugul', 26),
(952, 'Asika', 26),
(953, 'Balangir', 26),
(954, 'Balasore', 26),
(955, 'Baleshwar', 26),
(956, 'Bamra', 26),
(957, 'Barbil', 26),
(958, 'Bargarh', 26),
(959, 'Bargarh', 26),
(960, 'Baripada', 26),
(961, 'Basudebpur', 26),
(962, 'Belpahar', 26),
(963, 'Bhadrak', 26),
(964, 'Bhawanipatna', 26),
(965, 'Bhuban', 26),
(966, 'Bhubaneswar', 26),
(967, 'Biramitrapur', 26),
(968, 'Brahmapur', 26),
(969, 'Brajrajnagar', 26),
(970, 'Byasanagar', 26),
(971, 'Cuttack', 26),
(972, 'Debagarh', 26),
(973, 'Dhenkanal', 26),
(974, 'Gunupur', 26),
(975, 'Hinjilicut', 26),
(976, 'Jagatsinghapur', 26),
(977, 'Jajapur', 26),
(978, 'Jaleswar', 26),
(979, 'Jatani', 26),
(980, 'Jeypur', 26),
(981, 'Jharsuguda', 26),
(982, 'Joda', 26),
(983, 'Kantabanji', 26),
(984, 'Karanjia', 26),
(985, 'Kendrapara', 26),
(986, 'Kendujhar', 26),
(987, 'Khordha', 26),
(988, 'Koraput', 26),
(989, 'Malkangiri', 26),
(990, 'Nabarangapur', 26),
(991, 'Paradip', 26),
(992, 'Parlakhemundi', 26),
(993, 'Pattamundai', 26),
(994, 'Phulabani', 26),
(995, 'Puri', 26),
(996, 'Rairangpur', 26),
(997, 'Rajagangapur', 26),
(998, 'Raurkela', 26),
(999, 'Rayagada', 26),
(1000, 'Sambalpur', 26),
(1001, 'Soro', 26),
(1002, 'Sunabeda', 26),
(1003, 'Sundargarh', 26),
(1004, 'Talcher', 26),
(1005, 'Titlagarh', 26),
(1006, 'Umarkote', 26),
(1007, 'Karaikal', 27),
(1008, 'Mahe', 27),
(1009, 'Puducherry', 27),
(1010, 'Yanam', 27),
(1011, 'Ahmedgarh', 28),
(1012, 'Amritsar', 28),
(1013, 'Barnala', 28),
(1014, 'Batala', 28),
(1015, 'Bathinda', 28),
(1016, 'Bhagha Purana', 28),
(1017, 'Budhlada', 28),
(1018, 'Chandigarh', 28),
(1019, 'Dasua', 28),
(1020, 'Dhuri', 28),
(1021, 'Dinanagar', 28),
(1022, 'Faridkot', 28),
(1023, 'Fazilka', 28),
(1024, 'Firozpur', 28),
(1025, 'Firozpur Cantt.', 28),
(1026, 'Giddarbaha', 28),
(1027, 'Gobindgarh', 28),
(1028, 'Gurdaspur', 28),
(1029, 'Hoshiarpur', 28),
(1030, 'Jagraon', 28),
(1031, 'Jaitu', 28),
(1032, 'Jalalabad', 28),
(1033, 'Jalandhar', 28),
(1034, 'Jalandhar Cantt.', 28),
(1035, 'Jandiala', 28),
(1036, 'Kapurthala', 28),
(1037, 'Karoran', 28),
(1038, 'Kartarpur', 28),
(1039, 'Khanna', 28),
(1040, 'Kharar', 28),
(1041, 'Kot Kapura', 28),
(1042, 'Kurali', 28),
(1043, 'Longowal', 28),
(1044, 'Ludhiana', 28),
(1045, 'Malerkotla', 28),
(1046, 'Malout', 28),
(1047, 'Mansa', 28),
(1048, 'Maur', 28),
(1049, 'Moga', 28),
(1050, 'Mohali', 28),
(1051, 'Morinda', 28),
(1052, 'Mukerian', 28),
(1053, 'Muktsar', 28),
(1054, 'Nabha', 28),
(1055, 'Nakodar', 28),
(1056, 'Nangal', 28),
(1057, 'Nawanshahr', 28),
(1058, 'Pathankot', 28),
(1059, 'Patiala', 28),
(1060, 'Patran', 28),
(1061, 'Patti', 28),
(1062, 'Phagwara', 28),
(1063, 'Phillaur', 28),
(1064, 'Qadian', 28),
(1065, 'Raikot', 28),
(1066, 'Rajpura', 28),
(1067, 'Rampura Phul', 28),
(1068, 'Rupnagar', 28),
(1069, 'Samana', 28),
(1070, 'Sangrur', 28),
(1071, 'Sirhind Fatehgarh Sahib', 28),
(1072, 'Sujanpur', 28),
(1073, 'Sunam', 28),
(1074, 'Talwara', 28),
(1075, 'Tarn Taran', 28),
(1076, 'Urmar Tanda', 28),
(1077, 'Zira', 28),
(1078, 'Zirakpur', 28),
(1079, 'Bali', 29),
(1080, 'Banswara', 29),
(1081, 'Ajmer', 29),
(1082, 'Alwar', 29),
(1083, 'Bandikui', 29),
(1084, 'Baran', 29),
(1085, 'Barmer', 29),
(1086, 'Bikaner', 29),
(1087, 'Fatehpur', 29),
(1088, 'Jaipur', 29),
(1089, 'Jaisalmer', 29),
(1090, 'Jodhpur', 29),
(1091, 'Kota', 29),
(1092, 'Lachhmangarh', 29),
(1093, 'Ladnu', 29),
(1094, 'Lakheri', 29),
(1095, 'Lalsot', 29),
(1096, 'Losal', 29),
(1097, 'Makrana', 29),
(1098, 'Malpura', 29),
(1099, 'Mandalgarh', 29),
(1100, 'Mandawa', 29),
(1101, 'Mangrol', 29),
(1102, 'Merta City', 29),
(1103, 'Mount Abu', 29),
(1104, 'Nadbai', 29),
(1105, 'Nagar', 29),
(1106, 'Nagaur', 29),
(1107, 'Nargund', 29),
(1108, 'Nasirabad', 29),
(1109, 'Nathdwara', 29),
(1110, 'Navalgund', 29),
(1111, 'Nawalgarh', 29),
(1112, 'Neem-Ka-Thana', 29),
(1113, 'Nelamangala', 29),
(1114, 'Nimbahera', 29),
(1115, 'Nipani', 29),
(1116, 'Niwai', 29),
(1117, 'Nohar', 29),
(1118, 'Nokha', 29),
(1119, 'Pali', 29),
(1120, 'Phalodi', 29),
(1121, 'Phulera', 29),
(1122, 'Pilani', 29),
(1123, 'Pilibanga', 29),
(1124, 'Pindwara', 29),
(1125, 'Pipar City', 29),
(1126, 'Prantij', 29),
(1127, 'Pratapgarh', 29),
(1128, 'Raisinghnagar', 29),
(1129, 'Rajakhera', 29),
(1130, 'Rajaldesar', 29),
(1131, 'Rajgarh (Alwar)', 29),
(1132, 'Rajgarh (Churu', 29),
(1133, 'Rajsamand', 29),
(1134, 'Ramganj Mandi', 29),
(1135, 'Ramngarh', 29),
(1136, 'Ratangarh', 29),
(1137, 'Rawatbhata', 29),
(1138, 'Rawatsar', 29),
(1139, 'Reengus', 29),
(1140, 'Sadri', 29),
(1141, 'Sadulshahar', 29),
(1142, 'Sagwara', 29),
(1143, 'Sambhar', 29),
(1144, 'Sanchore', 29),
(1145, 'Sangaria', 29),
(1146, 'Sardarshahar', 29),
(1147, 'Sawai Madhopur', 29),
(1148, 'Shahpura', 29),
(1149, 'Shahpura', 29),
(1150, 'Sheoganj', 29),
(1151, 'Sikar', 29),
(1152, 'Sirohi', 29),
(1153, 'Sojat', 29),
(1154, 'Sri Madhopur', 29),
(1155, 'Sujangarh', 29),
(1156, 'Sumerpur', 29),
(1157, 'Suratgarh', 29),
(1158, 'Taranagar', 29),
(1159, 'Todabhim', 29),
(1160, 'Todaraisingh', 29),
(1161, 'Tonk', 29),
(1162, 'Udaipur', 29),
(1163, 'Udaipurwati', 29),
(1164, 'Vijainagar', 29),
(1165, 'Gangtok', 30),
(1166, 'Calcutta', 36),
(1167, 'Arakkonam', 31),
(1168, 'Arcot', 31),
(1169, 'Aruppukkottai', 31),
(1170, 'Bhavani', 31),
(1171, 'Chengalpattu', 31),
(1172, 'Chennai', 31),
(1173, 'Chinna salem', 31),
(1174, 'Coimbatore', 31),
(1175, 'Coonoor', 31),
(1176, 'Cuddalore', 31),
(1177, 'Dharmapuri', 31),
(1178, 'Dindigul', 31),
(1179, 'Erode', 31),
(1180, 'Gudalur', 31),
(1181, 'Gudalur', 31),
(1182, 'Gudalur', 31),
(1183, 'Kanchipuram', 31),
(1184, 'Karaikudi', 31),
(1185, 'Karungal', 31),
(1186, 'Karur', 31),
(1187, 'Kollankodu', 31),
(1188, 'Lalgudi', 31),
(1189, 'Madurai', 31),
(1190, 'Nagapattinam', 31),
(1191, 'Nagercoil', 31),
(1192, 'Namagiripettai', 31),
(1193, 'Namakkal', 31),
(1194, 'Nandivaram-Guduvancheri', 31),
(1195, 'Nanjikottai', 31),
(1196, 'Natham', 31),
(1197, 'Nellikuppam', 31),
(1198, 'Neyveli', 31),
(1199, 'O\' Valley', 31),
(1200, 'Oddanchatram', 31),
(1201, 'P.N.Patti', 31),
(1202, 'Pacode', 31),
(1203, 'Padmanabhapuram', 31),
(1204, 'Palani', 31),
(1205, 'Palladam', 31),
(1206, 'Pallapatti', 31),
(1207, 'Pallikonda', 31),
(1208, 'Panagudi', 31),
(1209, 'Panruti', 31),
(1210, 'Paramakudi', 31),
(1211, 'Parangipettai', 31),
(1212, 'Pattukkottai', 31),
(1213, 'Perambalur', 31),
(1214, 'Peravurani', 31),
(1215, 'Periyakulam', 31),
(1216, 'Periyasemur', 31),
(1217, 'Pernampattu', 31),
(1218, 'Pollachi', 31),
(1219, 'Polur', 31),
(1220, 'Ponneri', 31),
(1221, 'Pudukkottai', 31),
(1222, 'Pudupattinam', 31),
(1223, 'Puliyankudi', 31),
(1224, 'Punjaipugalur', 31),
(1225, 'Rajapalayam', 31),
(1226, 'Ramanathapuram', 31),
(1227, 'Rameshwaram', 31),
(1228, 'Rasipuram', 31),
(1229, 'Salem', 31),
(1230, 'Sankarankoil', 31),
(1231, 'Sankari', 31),
(1232, 'Sathyamangalam', 31),
(1233, 'Sattur', 31),
(1234, 'Shenkottai', 31),
(1235, 'Sholavandan', 31),
(1236, 'Sholingur', 31),
(1237, 'Sirkali', 31),
(1238, 'Sivaganga', 31),
(1239, 'Sivagiri', 31),
(1240, 'Sivakasi', 31),
(1241, 'Srivilliputhur', 31),
(1242, 'Surandai', 31),
(1243, 'Suriyampalayam', 31),
(1244, 'Tenkasi', 31),
(1245, 'Thammampatti', 31),
(1246, 'Thanjavur', 31),
(1247, 'Tharamangalam', 31),
(1248, 'Tharangambadi', 31),
(1249, 'Theni Allinagaram', 31),
(1250, 'Thirumangalam', 31),
(1251, 'Thirunindravur', 31),
(1252, 'Thiruparappu', 31),
(1253, 'Thirupuvanam', 31),
(1254, 'Thiruthuraipoondi', 31),
(1255, 'Thiruvallur', 31),
(1256, 'Thiruvarur', 31),
(1257, 'Thoothukudi', 31),
(1258, 'Thuraiyur', 31),
(1259, 'Tindivanam', 31),
(1260, 'Tiruchendur', 31),
(1261, 'Tiruchengode', 31),
(1262, 'Tiruchirappalli', 31),
(1263, 'Tirukalukundram', 31),
(1264, 'Tirukkoyilur', 31),
(1265, 'Tirunelveli', 31),
(1266, 'Tirupathur', 31),
(1267, 'Tirupathur', 31),
(1268, 'Tiruppur', 31),
(1269, 'Tiruttani', 31),
(1270, 'Tiruvannamalai', 31),
(1271, 'Tiruvethipuram', 31),
(1272, 'Tittakudi', 31),
(1273, 'Udhagamandalam', 31),
(1274, 'Udumalaipettai', 31),
(1275, 'Unnamalaikadai', 31),
(1276, 'Usilampatti', 31),
(1277, 'Uthamapalayam', 31),
(1278, 'Uthiramerur', 31),
(1279, 'Vadakkuvalliyur', 31),
(1280, 'Vadalur', 31),
(1281, 'Vadipatti', 31),
(1282, 'Valparai', 31),
(1283, 'Vandavasi', 31),
(1284, 'Vaniyambadi', 31),
(1285, 'Vedaranyam', 31),
(1286, 'Vellakoil', 31),
(1287, 'Vellore', 31),
(1288, 'Vikramasingapuram', 31),
(1289, 'Viluppuram', 31),
(1290, 'Virudhachalam', 31),
(1291, 'Virudhunagar', 31),
(1292, 'Viswanatham', 31),
(1293, 'Agartala', 33),
(1294, 'Badharghat', 33),
(1295, 'Dharmanagar', 33),
(1296, 'Indranagar', 33),
(1297, 'Jogendranagar', 33),
(1298, 'Kailasahar', 33),
(1299, 'Khowai', 33),
(1300, 'Pratapgarh', 33),
(1301, 'Udaipur', 33),
(1302, 'Achhnera', 34),
(1303, 'Adari', 34),
(1304, 'Agra', 34),
(1305, 'Aligarh', 34),
(1306, 'Allahabad', 34),
(1307, 'Amroha', 34),
(1308, 'Azamgarh', 34),
(1309, 'Bahraich', 34),
(1310, 'Ballia', 34),
(1311, 'Balrampur', 34),
(1312, 'Banda', 34),
(1313, 'Bareilly', 34),
(1314, 'Chandausi', 34),
(1315, 'Dadri', 34),
(1316, 'Deoria', 34),
(1317, 'Etawah', 34),
(1318, 'Fatehabad', 34),
(1319, 'Fatehpur', 34),
(1320, 'Fatehpur', 34),
(1321, 'Greater Noida', 34),
(1322, 'Hamirpur', 34),
(1323, 'Hardoi', 34),
(1324, 'Jajmau', 34),
(1325, 'Jaunpur', 34),
(1326, 'Jhansi', 34),
(1327, 'Kalpi', 34),
(1328, 'Kanpur', 34),
(1329, 'Kota', 34),
(1330, 'Laharpur', 34),
(1331, 'Lakhimpur', 34),
(1332, 'Lal Gopalganj Nindaura', 34),
(1333, 'Lalganj', 34),
(1334, 'Lalitpur', 34),
(1335, 'Lar', 34),
(1336, 'Loni', 34),
(1337, 'Lucknow', 34),
(1338, 'Mathura', 34),
(1339, 'Meerut', 34),
(1340, 'Modinagar', 34),
(1341, 'Muradnagar', 34),
(1342, 'Nagina', 34),
(1343, 'Najibabad', 34),
(1344, 'Nakur', 34),
(1345, 'Nanpara', 34),
(1346, 'Naraura', 34),
(1347, 'Naugawan Sadat', 34),
(1348, 'Nautanwa', 34),
(1349, 'Nawabganj', 34),
(1350, 'Nehtaur', 34),
(1351, 'NOIDA', 34),
(1352, 'Noorpur', 34),
(1353, 'Obra', 34),
(1354, 'Orai', 34),
(1355, 'Padrauna', 34),
(1356, 'Palia Kalan', 34),
(1357, 'Parasi', 34),
(1358, 'Phulpur', 34),
(1359, 'Pihani', 34),
(1360, 'Pilibhit', 34),
(1361, 'Pilkhuwa', 34),
(1362, 'Powayan', 34),
(1363, 'Pukhrayan', 34),
(1364, 'Puranpur', 34),
(1365, 'Purquazi', 34),
(1366, 'Purwa', 34),
(1367, 'Rae Bareli', 34),
(1368, 'Rampur', 34),
(1369, 'Rampur Maniharan', 34),
(1370, 'Rasra', 34),
(1371, 'Rath', 34),
(1372, 'Renukoot', 34),
(1373, 'Reoti', 34),
(1374, 'Robertsganj', 34),
(1375, 'Rudauli', 34),
(1376, 'Rudrapur', 34),
(1377, 'Sadabad', 34),
(1378, 'Safipur', 34),
(1379, 'Saharanpur', 34),
(1380, 'Sahaspur', 34),
(1381, 'Sahaswan', 34),
(1382, 'Sahawar', 34),
(1383, 'Sahjanwa', 34),
(1385, 'Sambhal', 34),
(1386, 'Samdhan', 34),
(1387, 'Samthar', 34),
(1388, 'Sandi', 34),
(1389, 'Sandila', 34),
(1390, 'Sardhana', 34),
(1391, 'Seohara', 34),
(1394, 'Shahganj', 34),
(1395, 'Shahjahanpur', 34),
(1396, 'Shamli', 34),
(1399, 'Sherkot', 34),
(1401, 'Shikohabad', 34),
(1402, 'Shishgarh', 34),
(1403, 'Siana', 34),
(1404, 'Sikanderpur', 34),
(1405, 'Sikandra Rao', 34),
(1406, 'Sikandrabad', 34),
(1407, 'Sirsaganj', 34),
(1408, 'Sirsi', 34),
(1409, 'Sitapur', 34),
(1410, 'Soron', 34),
(1411, 'Suar', 34),
(1412, 'Sultanpur', 34),
(1413, 'Sumerpur', 34),
(1414, 'Tanda', 34),
(1415, 'Tanda', 34),
(1416, 'Tetri Bazar', 34),
(1417, 'Thakurdwara', 34),
(1418, 'Thana Bhawan', 34),
(1419, 'Tilhar', 34),
(1420, 'Tirwaganj', 34),
(1421, 'Tulsipur', 34),
(1422, 'Tundla', 34),
(1423, 'Unnao', 34),
(1424, 'Utraula', 34),
(1425, 'Varanasi', 34),
(1426, 'Vrindavan', 34),
(1427, 'Warhapur', 34),
(1428, 'Zaidpur', 34),
(1429, 'Zamania', 34),
(1430, 'Almora', 35),
(1431, 'Bazpur', 35),
(1432, 'Chamba', 35),
(1433, 'Dehradun', 35),
(1434, 'Haldwani', 35),
(1435, 'Haridwar', 35),
(1436, 'Jaspur', 35),
(1437, 'Kashipur', 35),
(1438, 'kichha', 35),
(1439, 'Kotdwara', 35),
(1440, 'Manglaur', 35),
(1441, 'Mussoorie', 35),
(1442, 'Nagla', 35),
(1443, 'Nainital', 35),
(1444, 'Pauri', 35),
(1445, 'Pithoragarh', 35),
(1446, 'Ramnagar', 35),
(1447, 'Rishikesh', 35),
(1448, 'Roorkee', 35),
(1449, 'Rudrapur', 35),
(1450, 'Sitarganj', 35),
(1451, 'Tehri', 35),
(1452, 'Muzaffarnagar', 34),
(1454, 'Alipurduar', 36),
(1455, 'Arambagh', 36),
(1456, 'Asansol', 36),
(1457, 'Baharampur', 36),
(1458, 'Bally', 36),
(1459, 'Balurghat', 36),
(1460, 'Bankura', 36),
(1461, 'Barakar', 36),
(1462, 'Barasat', 36),
(1463, 'Bardhaman', 36),
(1464, 'Bidhan Nagar', 36),
(1465, 'Chinsura', 36),
(1466, 'Contai', 36),
(1467, 'Cooch Behar', 36),
(1468, 'Darjeeling', 36),
(1469, 'Durgapur', 36),
(1470, 'Haldia', 36),
(1471, 'Howrah', 36),
(1472, 'Islampur', 36),
(1473, 'Jhargram', 36),
(1474, 'Kharagpur', 36),
(1475, 'Kolkata', 36),
(1476, 'Mainaguri', 36),
(1477, 'Mal', 36),
(1478, 'Mathabhanga', 36),
(1479, 'Medinipur', 36),
(1480, 'Memari', 36),
(1481, 'Monoharpur', 36),
(1482, 'Murshidabad', 36),
(1483, 'Nabadwip', 36),
(1484, 'Naihati', 36),
(1485, 'Panchla', 36),
(1486, 'Pandua', 36),
(1487, 'Paschim Punropara', 36),
(1488, 'Purulia', 36),
(1489, 'Raghunathpur', 36),
(1490, 'Raiganj', 36),
(1491, 'Rampurhat', 36),
(1492, 'Ranaghat', 36),
(1493, 'Sainthia', 36),
(1494, 'Santipur', 36),
(1495, 'Siliguri', 36),
(1496, 'Sonamukhi', 36),
(1497, 'Srirampore', 36),
(1498, 'Suri', 36),
(1499, 'Taki', 36),
(1500, 'Tamluk', 36),
(1501, 'Tarakeswar', 36),
(1502, 'Chikmagalur', 17),
(1503, 'Davanagere', 17),
(1504, 'Dharwad', 17),
(1505, 'Gadag', 17),
(1506, 'Chennai', 31),
(1507, 'Coimbatore', 31),
(1508, 'Chandigarh', 6),
(1509, 'Leh', 37),
(1510, 'Amman', 38),
(1511, 'Zarqa', 38),
(1512, 'Vikasnagar', 35),
(1513, 'Az-Zarqa', 38),
(1514, 'Abdali', 38),
(1515, 'abdoun', 38),
(1516, 'Abdali', 38),
(1517, 'Abdoun', 38),
(1518, 'Abdullah Ghosheh Street', 38),
(1519, 'Abu Alia', 38),
(1520, 'Abu Nseir', 38),
(1521, 'AL Bayader', 38),
(1522, 'Al Bnayyat', 38),
(1523, 'AL Fuhais', 38),
(1524, 'AL Jubeiha', 38),
(1525, 'AL Hummar', 38),
(1526, 'AL Kursi', 38),
(1527, 'Bader AL Jadeda', 38),
(1528, 'Dahiet AL Ameer Hasan', 38),
(1529, 'Deir Ghbar', 38),
(1530, 'Hay Al Baraka', 38),
(1531, 'Jabal Amman', 38),
(1532, 'Khalda', 38),
(1533, 'Marka', 38),
(1534, 'Mahis', 38),
(1535, 'Mecca Street', 38),
(1536, 'Naour', 38),
(1537, 'Ras El Ain', 38),
(1538, 'Seventh Circle', 38),
(1539, 'Shafa Badran', 38),
(1540, 'Sports City', 38),
(1541, 'Swelieh', 38),
(1542, 'Tabarbour', 38),
(1543, 'Tla Al Ali', 38),
(1544, 'Um El Summaq', 38),
(1545, 'Um Sous', 38),
(1546, 'Wadi El Seer', 38);

-- --------------------------------------------------------

--
-- Table structure for table `custom_navigations`
--

CREATE TABLE `custom_navigations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_navigations`
--

INSERT INTO `custom_navigations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(9, 'Blog', '2024-02-01 10:31:06', '2024-02-01 10:31:06'),
(12, 'Collections', '2024-02-02 21:09:12', '2024-02-02 21:09:12'),
(14, 'End Of Session Sale', '2024-03-18 08:27:38', '2024-03-18 08:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `custom_navigation_products`
--

CREATE TABLE `custom_navigation_products` (
  `id` int(11) NOT NULL,
  `navigation_id` int(11) NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `products` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_id` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_navigation_products`
--

INSERT INTO `custom_navigation_products` (`id`, `navigation_id`, `banner`, `products`, `created_at`, `updated_id`) VALUES
(19, 12, '2024/02/03/4901ee183604d0403922ed96b0fd8ee0_1706908200.webp', '{\"0\":\"1\",\"1\":\"4\",\"4\":\"3\",\"5\":\"2\",\"6\":\"5\"}', '2024-02-02 21:09:12', '2024-02-03 07:27:20'),
(20, 12, '2024/02/03/cb51691d1ec76113b135b947e7958a0e_1706908202.webp', '[\"5\",\"4\",\"3\",\"2\",\"1\"]', '2024-02-02 21:09:12', '2024-02-02 21:10:02'),
(21, 12, '2024/02/03/42cb29db3cafb535d33fdf2a55e29862_1706908204.webp', '[\"5\",\"4\",\"2\",\"1\",\"3\"]', '2024-02-02 21:09:12', '2024-02-02 21:10:04'),
(22, 12, '2024/02/03/f6deb7fc9add23e424d9506e0c5f24c2_1706908206.webp', '[\"5\",\"4\",\"3\",\"2\"]', '2024-02-02 21:09:12', '2024-02-02 21:10:06'),
(27, 14, NULL, '[\"6\",\"7\"]', '2024-03-18 08:27:38', '2024-03-18 08:27:54'),
(28, 14, NULL, NULL, '2024-03-18 08:27:38', '2024-03-18 08:27:38'),
(29, 14, NULL, NULL, '2024-03-18 08:27:38', '2024-03-18 08:27:38'),
(30, 14, NULL, NULL, '2024-03-18 08:27:38', '2024-03-18 08:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `deliverytime`
--

CREATE TABLE `deliverytime` (
  `sno` int(11) NOT NULL,
  `timevalue` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliverytime`
--

INSERT INTO `deliverytime` (`sno`, `timevalue`) VALUES
(1, '4 to 5 Business Days');

-- --------------------------------------------------------

--
-- Table structure for table `discountprod`
--

CREATE TABLE `discountprod` (
  `sno` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `prodname` varchar(300) NOT NULL,
  `orderid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homecat`
--

CREATE TABLE `homecat` (
  `sno` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `catname` varchar(100) NOT NULL,
  `catorder` int(11) NOT NULL,
  `layout_type` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `clicktype` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(300) NOT NULL,
  `img_url` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homepage_banner`
--

CREATE TABLE `homepage_banner` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `link` text NOT NULL,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepage_banner`
--

INSERT INTO `homepage_banner` (`id`, `type`, `image`, `link`, `section`) VALUES
(1, 'topbar', 'AND It\'s a wrap 2024', 'https://reshamdhaage.com/', 'topbar_section'),
(2, 'top_video', '2023/12/09/d32ab901b28d2428846717777a933e58_1702115912.mp4', 'https://reshamdhaage.com/', 'top_video'),
(3, 'top_link_1', 'New Arrivals', 'https://reshamdhaage.com/', 'top_link_section'),
(4, 'top_link_2', 'AND It\'s a wrap 2023', 'https://reshamdhaage.com/', 'top_link_section'),
(5, 'top_link_3', 'Winter Wear', 'https://reshamdhaage.com/', 'top_link_section'),
(6, 'cat_1', '2023/12/09/a442d545bed573a2ae4deeaf0b713225_1702115938.webp', 'https://reshamdhaage.com/', 'top_category'),
(7, 'cat_2', '2023/12/09/1fa5930f4df318c89e52d860dc654266_1702116043.webp', 'https://reshamdhaage.com/', 'top_category'),
(8, 'cat_3', '2023/12/09/db376d4bb858f6add38d77c3cf33ee15_1702116052.webp', 'https://reshamdhaage.com/', 'top_category'),
(9, 'cat_4', '2023/12/09/3112fa1c82f8b2ad521deb701abe53e8_1702116061.webp', 'https://reshamdhaage.com/', 'top_category'),
(10, 'trend_1', '2023/12/09/c061318daac1e1ca4c497ab0d64375c8_1702134743.webp', 'https://reshamdhaage.com/', 'trending_section'),
(11, 'trend_2', '2023/12/09/111d5e367123df63a7a64d737a00f466_1702134860.webp', 'https://reshamdhaage.com/', 'trending_section'),
(12, 'trend_3', '2023/12/09/ef81c7806c2ee869ef16f141f6b57f7c_1702134867.webp', 'https://reshamdhaage.com/', 'trending_section'),
(13, 'promo_1', '2023/12/09/079b907deeaec7a1476cb61139723e16_1702135590.webp', 'https://reshamdhaage.com/', 'promotion_section'),
(14, 'promo_2', '2023/12/09/edd0c8fbbcb25f1cb43399658ea76424_1702135598.webp', 'https://reshamdhaage.com/', 'promotion_section'),
(15, 'promo_3', '2023/12/09/48e03f2d75a49efa1625b982fdedfa4b_1702135604.webp', 'https://reshamdhaage.com/', 'promotion_section'),
(16, 'bottom_link_1', 'Shop Jwelleries', 'https://reshamdhaage.com/', 'bottom_link_section'),
(17, 'bottom_link_2', 'Shop Bags', 'https://reshamdhaage.com/', 'bottom_link_section'),
(18, 'bottom_link_3', 'Shop Footwears', 'https://reshamdhaage.com/', 'bottom_link_section'),
(19, 'bottom_link_4', 'Shop Scraves', 'https://reshamdhaage.com/', 'bottom_link_section');

-- --------------------------------------------------------

--
-- Table structure for table `home_banner`
--

CREATE TABLE `home_banner` (
  `home_banner_id` int(11) NOT NULL,
  `title` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `img_url` mediumtext NOT NULL,
  `datetime` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_custom_banner`
--

CREATE TABLE `home_custom_banner` (
  `id` int(11) NOT NULL,
  `img_url` text NOT NULL,
  `banner_id` varchar(100) NOT NULL,
  `clicktype` int(11) NOT NULL,
  `banner_for` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knet_payment`
--

CREATE TABLE `knet_payment` (
  `sno` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` mediumtext NOT NULL,
  `order_no` mediumtext NOT NULL,
  `result` mediumtext NOT NULL,
  `gateway_response` mediumtext NOT NULL,
  `reference_number` mediumtext NOT NULL,
  `customer_email` mediumtext NOT NULL,
  `cmp_res` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `latestprod`
--

CREATE TABLE `latestprod` (
  `sno` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `prodname` varchar(300) NOT NULL,
  `orderid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layoutsection`
--

CREATE TABLE `layoutsection` (
  `sno` int(11) NOT NULL,
  `name` mediumtext NOT NULL,
  `type` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layoutsection`
--

INSERT INTO `layoutsection` (`sno`, `name`, `type`) VALUES
(1, 'section1', 'top1'),
(2, 'section1', 'top2'),
(3, 'section1', 'top3'),
(4, 'section2', 'cat1'),
(5, 'section2', 'cat2'),
(6, 'section2', 'cat3'),
(7, 'section4', 'img1'),
(8, 'section4', 'img2'),
(9, 'section5', 'bottom1'),
(10, 'section5', 'bottom4');

-- --------------------------------------------------------

--
-- Table structure for table `notifyme`
--

CREATE TABLE `notifyme` (
  `sno` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `createby` datetime NOT NULL,
  `updateby` datetime NOT NULL,
  `action` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offerzone`
--

CREATE TABLE `offerzone` (
  `sno` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `prodname` varchar(300) NOT NULL,
  `orderid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `sno` int(11) NOT NULL,
  `order_id` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `prod_details` mediumtext DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(12) NOT NULL,
  `customer_address` mediumtext NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_state` varchar(255) NOT NULL,
  `customer_pincode` varchar(12) NOT NULL,
  `total_price` float DEFAULT NULL,
  `payment_orderid` mediumtext DEFAULT NULL,
  `payment_id` mediumtext DEFAULT NULL,
  `payment_mode` enum('cod','online') DEFAULT NULL,
  `delivery_mode` varchar(20) DEFAULT NULL,
  `qoute_id` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `curriername` varchar(100) DEFAULT NULL,
  `trackid` mediumtext DEFAULT NULL,
  `deliveryid` varchar(100) DEFAULT NULL,
  `walletcoins` int(11) DEFAULT NULL,
  `discountid` int(11) DEFAULT NULL,
  `discountvalue` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`sno`, `order_id`, `user_id`, `status`, `prod_details`, `address_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `customer_city`, `customer_state`, `customer_pincode`, `total_price`, `payment_orderid`, `payment_id`, `payment_mode`, `delivery_mode`, `qoute_id`, `create_date`, `update_date`, `curriername`, `trackid`, `deliveryid`, `walletcoins`, `discountid`, `discountvalue`) VALUES
(2, '100001', 10003, 'Completed', NULL, NULL, 'Jony Paul', 'paul.jony70@gmail.com', '9874627973', 'KOLKATA', 'Anakapalle', 'Andhra Pradesh', '743144', 3999, NULL, 'Pay12345', 'cod', NULL, NULL, '2024-01-16 03:51:57', '2024-02-26 02:25:16', NULL, NULL, NULL, NULL, NULL, 0.00),
(3, '100002', 10003, 'Placed', NULL, NULL, 'Jony Paul', 'paul.jony70@gmail.com', '9874627973', 'KOLKATA', 'Kolkata', 'West Bengal', '743144', 7998, NULL, 'Pay12345', 'cod', NULL, NULL, '2024-01-17 01:57:43', '2024-02-26 02:25:19', NULL, NULL, NULL, NULL, NULL, 0.00),
(30, '100003', 10003, 'Cancelled', NULL, NULL, 'Jony Paul', 'paul.jony0606@gmail.com', '9836872040', 'Ichapur Bidhanpally West', 'Ichapur', 'West Bengal', '743144', 10397, NULL, 'Pay_12345', 'cod', NULL, NULL, '2024-02-07 19:31:47', '2024-02-26 02:25:22', NULL, NULL, NULL, NULL, NULL, 0.00),
(36, '100004', 10005, 'Dispatch', NULL, NULL, 'kamal bunkar', 'kamal.bunkar07@gmail.com', '9144040888', 'flat o3', 'Bhopal', 'Madhya Pradesh', '462026', 5898, NULL, 'Pay12345', 'cod', NULL, NULL, '2024-02-27 07:42:20', '2024-04-06 20:45:01', NULL, NULL, NULL, NULL, NULL, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `deliveryid` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(300) NOT NULL,
  `prod_img` mediumtext NOT NULL,
  `prod_attr` mediumtext DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `org_qty` int(11) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `prod_mrp` decimal(10,2) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `cgst` float DEFAULT NULL,
  `sgst` float DEFAULT NULL,
  `igst` float DEFAULT NULL,
  `shipping` float DEFAULT NULL,
  `total` float NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(15) DEFAULT NULL,
  `status_date` datetime DEFAULT NULL,
  `refund_amt` int(11) DEFAULT NULL,
  `refund_txnno` varchar(20) DEFAULT NULL,
  `refund_date` datetime DEFAULT NULL,
  `pickup_date` datetime DEFAULT NULL,
  `return_status` int(11) DEFAULT NULL,
  `return_reason` mediumtext DEFAULT NULL,
  `return_updateby` datetime DEFAULT NULL,
  `sellername` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `deliveryid`, `user_id`, `prod_id`, `prod_name`, `prod_img`, `prod_attr`, `qty`, `org_qty`, `unit`, `prod_mrp`, `prod_price`, `cgst`, `sgst`, `igst`, `shipping`, `total`, `create_date`, `update_date`, `status`, `status_date`, `refund_amt`, `refund_txnno`, `refund_date`, `pickup_date`, `return_status`, `return_reason`, `return_updateby`, `sellername`) VALUES
(2, '100001', NULL, 10003, 1, 'Lune Love Maxi', '[\"2024\\/01\\/18\\/e9837ec0bc56df3e02a43015804fdc01_1705519982.webp\",\"2024\\/01\\/18\\/a47edfd0d648885e2ed8eafaf5896e4e_1705519982.webp\",\"2024\\/01\\/18\\/2f1b6a5f72b3c978a1e9021dffaff1f4_1705519982.webp\"]', '\"\"', 1, NULL, NULL, 3999.00, 3999.00, NULL, NULL, NULL, NULL, 3999, '2024-01-16 03:51:57', '2024-01-18 17:32:07', '', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '100002', NULL, 10003, 2, 'Abby Printed Dress', '[\"2024\\/01\\/02\\/1918209e48a1c7154e26191bca0c8cf6_1704191275.webp\",\"2024\\/01\\/02\\/aeaf9bfd23490e29699aca0e63dadfd2_1704191275.webp\",\"2024\\/01\\/02\\/4add26187f35060e6e0c88d6b64a31c2_1704191275.webp\"]', '[{\"attr_id\":\"5\",\"attr_name\":\"Size\",\"attr_value\":\"XL\"}]', 1, NULL, NULL, 3999.00, 1999.00, NULL, NULL, NULL, NULL, 0, '2024-01-17 01:57:43', '2024-01-18 16:01:44', '', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '100002', NULL, 10003, 3, 'Oasis Dress', '[\"2024\\/01\\/02\\/3bc38a9998162e21ed0489aacbe866fd_1704191651.webp\",\"2024\\/01\\/02\\/7173b305fce83b1d1a045f0af1be6a82_1704191651.webp\",\"2024\\/01\\/02\\/48b99d9b9797dcf24596e3938959522f_1704191651.webp\"]', '[{\"attr_id\":\"5\",\"attr_name\":\"Size\",\"attr_value\":\"XL\"}]', 1, NULL, NULL, 3999.00, 3999.00, NULL, NULL, NULL, NULL, 3999, '2024-01-17 01:57:43', '2024-01-17 02:47:42', '', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '100003', NULL, 10003, 3, 'Oasis Dress', '[\"2024\\/01\\/02\\/3bc38a9998162e21ed0489aacbe866fd_1704191651.webp\",\"2024\\/01\\/02\\/7173b305fce83b1d1a045f0af1be6a82_1704191651.webp\",\"2024\\/01\\/02\\/48b99d9b9797dcf24596e3938959522f_1704191651.webp\"]', '[{\"attr_id\":\"5\",\"attr_name\":\"Size\",\"attr_value\":\"XL\"}]', 1, NULL, NULL, 3999.00, 3899.00, NULL, NULL, NULL, NULL, 3899, '2024-02-07 19:31:47', '2024-02-07 19:31:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '100003', NULL, 10003, 2, 'Abby Printed Dress', '[\"2024\\/01\\/02\\/1918209e48a1c7154e26191bca0c8cf6_1704191275.webp\",\"2024\\/01\\/02\\/aeaf9bfd23490e29699aca0e63dadfd2_1704191275.webp\",\"2024\\/01\\/02\\/4add26187f35060e6e0c88d6b64a31c2_1704191275.webp\"]', '[{\"attr_id\":\"5\",\"attr_name\":\"Size\",\"attr_value\":\"M\"}]', 1, NULL, NULL, 3999.00, 1999.00, NULL, NULL, NULL, NULL, 1999, '2024-02-07 19:31:47', '2024-02-07 19:31:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '100003', NULL, 10003, 5, 'Satin Sway Set', '[\"2024\\/01\\/02\\/7076613d8a249f70da2ab1c9b4366daa_1704191862.webp\",\"2024\\/01\\/02\\/753e417fdd0401fe9a34f8ad9d8d3021_1704191862.webp\",\"2024\\/01\\/02\\/fb5c2f342e0d05f186ecf820156acf64_1704191862.webp\"]', '[{\"attr_id\":\"4\",\"attr_name\":\"Color\",\"attr_value\":\"#b9aee8\"},{\"attr_id\":\"5\",\"attr_name\":\"Size\",\"attr_value\":\"S\"}]', 1, NULL, NULL, 4599.00, 4499.00, NULL, NULL, NULL, NULL, 4499, '2024-02-07 19:31:47', '2024-02-07 19:31:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '100004', NULL, 10005, 2, 'Abby Printed Dress', '[\"2024\\/01\\/02\\/1918209e48a1c7154e26191bca0c8cf6_1704191275.webp\",\"2024\\/01\\/02\\/aeaf9bfd23490e29699aca0e63dadfd2_1704191275.webp\",\"2024\\/01\\/02\\/4add26187f35060e6e0c88d6b64a31c2_1704191275.webp\"]', '[{\"attr_id\":\"5\",\"attr_name\":\"Size\",\"attr_value\":\"XL\"}]', 1, NULL, NULL, 3999.00, 1999.00, NULL, NULL, NULL, NULL, 1999, '2024-02-27 07:42:20', '2024-02-27 07:42:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '100004', NULL, 10005, 3, 'Oasis Dress', '[\"2024\\/01\\/02\\/3bc38a9998162e21ed0489aacbe866fd_1704191651.webp\",\"2024\\/01\\/02\\/7173b305fce83b1d1a045f0af1be6a82_1704191651.webp\",\"2024\\/01\\/02\\/48b99d9b9797dcf24596e3938959522f_1704191651.webp\"]', '[{\"attr_id\":\"5\",\"attr_name\":\"Size\",\"attr_value\":\"XL\"}]', 1, NULL, NULL, 3999.00, 3899.00, NULL, NULL, NULL, NULL, 3899, '2024-02-27 07:42:20', '2024-02-27 07:42:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `email`, `otp`, `expired_at`) VALUES
(3, 'paul.jony70@gmail.com', '498810', '2024-02-04 17:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `pincode`
--

CREATE TABLE `pincode` (
  `pincode` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `shippingfee` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pincode`
--

INSERT INTO `pincode` (`pincode`, `name`, `shippingfee`) VALUES
(110030, 'Paryavaran complex/ saidulajab ', 0),
(462420, 'Bhopal', 100);

-- --------------------------------------------------------

--
-- Table structure for table `popularprod`
--

CREATE TABLE `popularprod` (
  `sno` int(11) NOT NULL,
  `prodid` int(11) NOT NULL,
  `prodname` varchar(300) NOT NULL,
  `orderid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popularprod`
--

INSERT INTO `popularprod` (`sno`, `prodid`, `prodname`, `orderid`) VALUES
(9, 46, 'Babaji mustard oil 1 ltr', 0),
(10, 261, 'Maanik kachi ghani mustard oil 1 ltr', 0),
(11, 10, 'Fortune Mustard oil 1 Ltr', 0),
(12, 7, 'Fortune Soyabean oil 1 ltr', 0),
(13, 116, 'Atta Bag 10 kg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `popular_product`
--

CREATE TABLE `popular_product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popular_product`
--

INSERT INTO `popular_product` (`id`, `product_id`, `type`, `created_at`) VALUES
(1, '12', 'New', '2023-09-16 04:09:11'),
(2, '14', 'New', '2023-09-11 05:13:00'),
(3, '21', 'New', '2023-09-16 04:09:27'),
(4, '14', 'Offers', '2023-09-11 05:13:05'),
(5, '22', 'Offers', '2023-09-16 04:10:20'),
(6, '31', 'Offers', '2023-09-16 04:10:25'),
(7, '23', 'Popular', '2023-09-16 04:10:34'),
(8, '32', 'Popular', '2023-09-16 04:10:37'),
(9, '19', 'Popular', '2023-09-16 04:10:41'),
(10, '18', 'Recommended', '2023-09-16 04:10:45'),
(11, '43', 'New', '2023-09-16 04:10:48'),
(12, '101', 'New', '2023-09-16 04:10:50'),
(13, '58', 'Recommended', '2023-09-16 04:10:45'),
(14, '57', 'New', '2023-09-16 04:10:48'),
(15, '54', 'New', '2023-09-16 04:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(300) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `prod_brand_id` int(11) NOT NULL,
  `prod_cat_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_stock`, `prod_brand_id`, `prod_cat_id`, `status`) VALUES
(1, 'Lune Love Maxi', 100, 2, 7, 'active'),
(2, 'Abby Printed Dress', 80, 2, 2, 'active'),
(3, 'Oasis Dress', 0, 8, 2, 'active'),
(4, 'Pitch Black Dress', 0, 6, 2, 'active'),
(5, 'Satin Sway Set', 1, 10, 2, 'active'),
(6, 'Brooke Trench Coat', 8, 2, 2, 'active'),
(7, 'Sand Hues Viscose Set', 20, 4, 2, 'active'),
(8, 'Red One Piece Long Full Sleeve Dress', 6, 6, 2, 'active'),
(9, 'Green gown for girls', 2, 7, 2, 'active'),
(10, 'white tshirt', 20, 5, 2, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE `productdetails` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(300) NOT NULL,
  `prod_desc` mediumtext NOT NULL,
  `prod_fulldetail` mediumtext NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `short_ar` mediumtext NOT NULL,
  `desc_ar` mediumtext NOT NULL,
  `prod_mrp` decimal(10,2) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `cgst` float NOT NULL,
  `sgst` float NOT NULL,
  `igst` float NOT NULL,
  `shipping` float NOT NULL,
  `hsn_code` varchar(50) NOT NULL,
  `w_price` float NOT NULL,
  `w_qty` int(11) NOT NULL,
  `other_attribute` mediumtext NOT NULL,
  `stock` int(11) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `prod_rating` int(11) NOT NULL,
  `prod_rating_count` int(11) NOT NULL,
  `prod_img_url` mediumtext NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `create_by` date NOT NULL,
  `update_by` date NOT NULL,
  `coins` int(11) DEFAULT NULL,
  `discount_coins` int(11) DEFAULT NULL,
  `pricearray` mediumtext DEFAULT NULL,
  `displaystock` int(11) DEFAULT NULL,
  `sellername` varchar(80) DEFAULT NULL,
  `prod_remark` varchar(200) DEFAULT NULL,
  `freeship` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`prod_id`, `prod_name`, `prod_desc`, `prod_fulldetail`, `name_ar`, `short_ar`, `desc_ar`, `prod_mrp`, `prod_price`, `cgst`, `sgst`, `igst`, `shipping`, `hsn_code`, `w_price`, `w_qty`, `other_attribute`, `stock`, `unit`, `prod_rating`, `prod_rating_count`, `prod_img_url`, `cat_id`, `brand_id`, `review_id`, `create_by`, `update_by`, `coins`, `discount_coins`, `pricearray`, `displaystock`, `sellername`, `prod_remark`, `freeship`) VALUES
(1, 'Lune Love Maxi', '', '&lt;p&gt;Our Lune Love maxi comes with full sleeves and a wrap silhouette. It also features a front slit and an A-line overlap style - so chic, it\'ll make heads turn.&lt;/p&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Occasion&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;Evening Wear&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Top And Dress Style&lt;/strong&gt;&amp;nbsp; &amp;nbsp;&lt;/span&gt;Fit and Flare&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Fit&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;Comfort&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Print Type&amp;nbsp; &amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;Solid&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Product Length&amp;nbsp; &amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;Full Length&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Neck Collar&amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;V-Neck&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Sleeve length&amp;nbsp; &amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;Long&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Hemline&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;Asymmetric&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Closure&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;Slip-On&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Country of Origin&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;India&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;strong&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;Name and Address of Manufacturer&lt;/span&gt;Manufactured by&lt;/strong&gt; - Ochre &amp;amp; Black Private Limited, Plot No R 847/1/1, TTC Ind. Area, MIDC, Rabale, Navi Mumbai, India - 400701.&lt;/div&gt;', '', '', '&lt;p&gt;Our Lune Love maxi comes with full sleeves and a wrap silhouette. It also features a front slit and an A-line overlap style - so chic, it\'ll make heads turn.&lt;/p&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Occasion&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;Evening Wear&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Top And Dress Style&lt;/strong&gt;&amp;nbsp; &amp;nbsp;&lt;/span&gt;Fit and Flare&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Fit&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;Comfort&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Print Type&amp;nbsp; &amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;Solid&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Product Length&amp;nbsp; &amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;/span&gt;Full Length&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Neck Collar&amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;V-Neck&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Sleeve length&amp;nbsp; &amp;nbsp;&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;Long&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Hemline&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;Asymmetric&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Closure&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/span&gt;Slip-On&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;&lt;strong&gt;Country of Origin&lt;/strong&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;/span&gt;India&lt;/div&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;strong&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;Name and Address of Manufacturer&lt;/span&gt;Manufactured by&lt;/strong&gt; - Ochre &amp;amp; Black Private Limited, Plot No R 847/1/1, TTC Ind. Area, MIDC, Rabale, Navi Mumbai, India - 400701.&lt;/div&gt;', 3999.00, 3499.00, 0, 0, 0, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 100, '0', 0, 0, '[\"2024\\/01\\/18\\/e9837ec0bc56df3e02a43015804fdc01_1705519982.webp\",\"2024\\/01\\/18\\/a47edfd0d648885e2ed8eafaf5896e4e_1705519982.webp\",\"2024\\/01\\/18\\/2f1b6a5f72b3c978a1e9021dffaff1f4_1705519982.webp\"]', 7, 5, 0, '2024-01-02', '2024-01-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Abby Printed Dress', '', '&lt;p&gt;Perfect for your next dinner party, this mini dress has an eye-catching abstract print all over. It features a V-neckline and tie-up detailing at the waist.&lt;/p&gt;', '', '', '&lt;p&gt;Perfect for your next dinner party, this mini dress has an eye-catching abstract print all over. It features a V-neckline and tie-up detailing at the waist.&lt;/p&gt;', 3999.00, 1999.00, 0, 0, 0, 0, '200', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 80, '0', 5, 10, '[\"2024\\/01\\/02\\/1918209e48a1c7154e26191bca0c8cf6_1704191275.webp\",\"2024\\/01\\/02\\/aeaf9bfd23490e29699aca0e63dadfd2_1704191275.webp\",\"2024\\/01\\/02\\/4add26187f35060e6e0c88d6b64a31c2_1704191275.webp\"]', 2, 2, 0, '2024-01-02', '2024-01-18', NULL, NULL, NULL, NULL, NULL, '200 Sold In 3 Hours', NULL),
(3, 'Oasis Dress', '', '&lt;p&gt;This long sleeve dress features an all-over abstract print and a straight fit. It ends right above the knees and has a wrap detail at the waist, making it the perfect party ensemble.&lt;/p&gt;', '', '', '', 3999.00, 2999.00, 0, 0, 0, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 0, '', 0, 0, '[\n    \"2024\\/01\\/02\\/3bc38a9998162e21ed0489aacbe866fd_1704191651.webp\",\n    \"2024\\/01\\/02\\/7173b305fce83b1d1a045f0af1be6a82_1704191651.webp\",\n    \"2024\\/01\\/02\\/48b99d9b9797dcf24596e3938959522f_1704191651.webp\"\n]', 2, 8, 0, '2024-01-02', '2024-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Pitch Black Dress', '', '&lt;p&gt;This chic tube dress is just the statement dress you need for to be the party-starter at your next social gala. It features a drape detail with a wrapped silhouette and an asymmetric hemline.&lt;/p&gt;', '', '', '', 2999.00, 2999.00, 0, 0, 0, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 0, '', 0, 0, '[\n    \"2024\\/01\\/02\\/0be5289d4093b61e506443dde5fecb80_1704191730.webp\",\n    \"2024\\/01\\/02\\/d020d75a950f8f33e86e8e2124b6b1b9_1704191730.webp\",\n    \"2024\\/01\\/02\\/2d31fde766606b425f11f3bc72eb5f6c_1704191730.webp\"\n]', 2, 6, 0, '2024-01-02', '2024-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Satin Sway Set', '', '&lt;p&gt;This satin finish set features a high-shine shirt and a draped skirt with a knot detail. The colour and wrap silhouette add the perfect blend of glitz and elegance to your next celebration.&lt;/p&gt;', '', '', '', 4699.00, 4699.00, 0, 0, 0, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 0, '', 0, 0, '[\n    \"2024\\/01\\/02\\/7076613d8a249f70da2ab1c9b4366daa_1704191862.webp\",\n    \"2024\\/01\\/02\\/753e417fdd0401fe9a34f8ad9d8d3021_1704191862.webp\",\n    \"2024\\/01\\/02\\/fb5c2f342e0d05f186ecf820156acf64_1704191862.webp\"\n]', 2, 10, 0, '2024-01-02', '2024-01-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Brooke Trench Coat', '', '&lt;p&gt;This trench coat has a long length, a straight fit, and features a lapel collar. The cinching fabric belt gives dimension to the sihouette. Wear it over a dress on the weekend, or over a shirt and relaxed jeans during the week.&lt;/p&gt;\r\n&lt;table style=&quot;height: 97px;&quot; width=&quot;343&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;\r\n&lt;p class=&quot;attribute-key css-1ij3tdp&quot;&gt;&lt;span style=&quot;color: #999999;&quot;&gt;Pattern&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;Solid/Plain&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;\r\n&lt;p class=&quot;attribute-key css-1ij3tdp&quot;&gt;&lt;span style=&quot;color: #999999;&quot;&gt;Type&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;Overcoats&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;\r\n&lt;p class=&quot;attribute-key css-1ij3tdp&quot;&gt;&lt;span style=&quot;color: #999999;&quot;&gt;Neckline Type&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;Notched Lapel&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;\r\n&lt;p class=&quot;attribute-key css-1ij3tdp&quot;&gt;&lt;span style=&quot;color: #999999;&quot;&gt;Sleeve Type&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;Full Sleeves&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '', '', '&lt;p&gt;This trench coat has a long length, a straight fit, and features a lapel collar. The cinching fabric belt gives dimension to the sihouette. Wear it over a dress on the weekend, or over a shirt and relaxed jeans during the week.&lt;/p&gt;\r\n&lt;table style=&quot;height: 97px;&quot; width=&quot;343&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;\r\n&lt;p class=&quot;attribute-key css-1ij3tdp&quot;&gt;&lt;span style=&quot;color: #999999;&quot;&gt;Pattern&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;Solid/Plain&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;\r\n&lt;p class=&quot;attribute-key css-1ij3tdp&quot;&gt;&lt;span style=&quot;color: #999999;&quot;&gt;Type&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;Overcoats&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;\r\n&lt;p class=&quot;attribute-key css-1ij3tdp&quot;&gt;&lt;span style=&quot;color: #999999;&quot;&gt;Neckline Type&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;Notched Lapel&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;\r\n&lt;p class=&quot;attribute-key css-1ij3tdp&quot;&gt;&lt;span style=&quot;color: #999999;&quot;&gt;Sleeve Type&lt;/span&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 163.5px;&quot;&gt;Full Sleeves&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 2999.00, 2499.00, 2.5, 2.5, 5, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 8, '0', 4, 278, '[\"2024\\/03\\/17\\/de06c3d2fd3164b5b2b573e735892e47_1710674333.webp\",\"2024\\/03\\/17\\/57e0bd47f5dc80b258428f47d0fdef07_1710674333.webp\",\"2024\\/03\\/17\\/ae5c9d724cb0392a2f76100a82dbe2ed_1710674333.webp\",\"2024\\/03\\/17\\/291e0e6523f3c6cf66cb2278a448f61a_1710674333.webp\"]', 2, 2, 0, '2024-03-17', '2024-03-17', NULL, NULL, NULL, NULL, NULL, '', NULL),
(7, 'Sand Hues Viscose Set', '', '&lt;p&gt;Jumping on the waistcoat bandwagon - this neutral set is all you need to add versatility to your capsule wardrobe. It comes with a sleeveless, V-neck waistcoat-style top and a pair of straight-fit trousers with pockets. Made with a blend of viscose and linen.&lt;/p&gt;\r\n&lt;table style=&quot;height: 159px;&quot; width=&quot;372&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 178px;&quot;&gt;\r\n&lt;div class=&quot;cms-generic-copy flex mb-1&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;Occasion&lt;/span&gt;Casual&amp;nbsp;&lt;/div&gt;\r\n&lt;/td&gt;\r\n&lt;td style=&quot;width: 178px;&quot;&gt;Wear&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 178px;&quot;&gt;&lt;span class=&quot;pdp__details-description-label&quot;&gt;Fit&lt;/span&gt;Tapered&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 178px;&quot;&gt;Fit&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 178px;&quot;&gt;Print type&lt;/td&gt;\r\n&lt;td style=&quot;width: 178px;&quot;&gt;Solid&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td style=&quot;width: 178px;&quot;&gt;Product Length&lt;/td&gt;\r\n&lt;td style=&quot;width: 178px;&quot;&gt;Full Length&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '', '', '', 1999.00, 1699.00, 2.5, 2.5, 5, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 20, '', 4, 698, '[\n    \"2024\\/03\\/17\\/63abcf5a71d336b63a80b3c8c0223075_1710675242.webp\",\n    \"2024\\/03\\/17\\/5bd135400346cceabb561bdec155f7ee_1710675242.webp\",\n    \"2024\\/03\\/17\\/90c0cf7a325983ffc06103c93ee6bacd_1710675242.webp\"\n]', 2, 4, 0, '2024-03-17', '2024-03-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Red One Piece Long Full Sleeve Dress', '', '&lt;p&gt;Red One Piece Long Full Sleeve Dress&lt;/p&gt;\r\n&lt;p&gt;Amp up your closet with this red one piece logn full sleeve dress&amp;nbsp;By Sonal Shirt Dress with Front Drape. Made with the finest material, it is designed to perfection. Style it with footwear to complete the look.&lt;/p&gt;', '', '', '', 1149.00, 899.00, 6, 6, 12, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 6, '', 3, 183, '[\n    \"2024\\/03\\/17\\/3ad1a172b7d093dd3578bc86fac92e5c_1710676487.webp\",\n    \"2024\\/03\\/17\\/b057716183de90e178fc4ab860c411d6_1710676487.webp\",\n    \"2024\\/03\\/17\\/cdeae65847a683dd2b07b7cbb50b42f5_1710676487.webp\",\n    \"2024\\/03\\/17\\/445f147c422fc09d6aac683534d75479_1710676487.webp\"\n]', 2, 6, 0, '2024-03-17', '2024-03-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Green gown for girls', '', '&lt;p&gt;&lt;em&gt;This garment contains recycled polyester, which reuses existing plastic material. This reduces reliance on virgin materials.&lt;/em&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;A gorgeous maxi dress with trending detailing that will help you make an entrance at your next event&lt;/li&gt;\r\n&lt;li&gt;Length: 132.3cm (Size 8)&lt;/li&gt;\r\n&lt;li&gt;Regular fit&lt;/li&gt;\r\n&lt;li&gt;Lightweight woven fabrication&lt;/li&gt;\r\n&lt;li&gt;Low v-neckline&lt;/li&gt;\r\n&lt;li&gt;Ruffle shoulder straps&lt;/li&gt;\r\n&lt;li&gt;Cross waist detail&lt;/li&gt;\r\n&lt;li&gt;Full, flowing maxi skirt&lt;/li&gt;\r\n&lt;li&gt;Subtle high-low hem&lt;/li&gt;\r\n&lt;li&gt;Open back&lt;/li&gt;\r\n&lt;li&gt;Back band with button fastening&lt;/li&gt;\r\n&lt;li&gt;Concealed zip&lt;/li&gt;\r\n&lt;li&gt;Lined&lt;/li&gt;\r\n&lt;li&gt;Main/Lining: 100% Polyester&lt;/li&gt;\r\n&lt;li&gt;Cold hand wash separately or cold delicate machine wash in garment bag.&lt;/li&gt;\r\n&lt;li&gt;Our model is wearing size AU 8/XS&lt;/li&gt;\r\n&lt;/ul&gt;', '', '', '', 1899.00, 1199.00, 6, 6, 12, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 2, '', 3, 437, '[\n    \"2024\\/03\\/17\\/06a5351475d325ec61725526754f2392_1710676858.webp\",\n    \"2024\\/03\\/17\\/7f19ed9ddfc60885bf49636954789f58_1710676858.webp\",\n    \"2024\\/03\\/17\\/af66fb9cc86da896cae3b5d3774a238d_1710676858.webp\"\n]', 2, 7, 0, '2024-03-17', '2024-03-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'white tshirt', '', '&lt;p&gt;white tshirt for gilrd&lt;/p&gt;', '', '', '&lt;p&gt;white tshirt for gilrd&lt;/p&gt;', 499.00, 399.00, 5, 5, 10, 0, '', 0, 0, '{\"size\":\"\",\"color\":\"\",\"weight\":\"\"}', 20, '0', 0, 0, '[\"2024\\/03\\/19\\/869017330afdffff5ebd6662965eac89_1710827354.webp\"]', 2, 5, 0, '2024-03-18', '2024-03-19', NULL, NULL, NULL, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL,
  `prod_attr_id` int(11) NOT NULL,
  `prod_id` varchar(100) NOT NULL,
  `attr_value` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`id`, `prod_attr_id`, `prod_id`, `attr_value`) VALUES
(3, 5, '3', '{\"0\":\"L\",\"1\":\"XL\"}'),
(4, 5, '4', '{\"0\":\"L\",\"1\":\"M\"}'),
(5, 4, '5', '{\"0\":\"#b9aee8\"}'),
(6, 5, '5', '{\"0\":\"M\",\"1\":\"S\"}'),
(8, 5, '2', '{\"0\":\"L\",\"1\":\"M\",\"2\":\"S\",\"3\":\"XL\"}'),
(9, 4, '6', '{\"0\":\"#CF8878\",\"1\":\"#E4C5AC\"}');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_conf`
--

CREATE TABLE `product_attributes_conf` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes_conf`
--

INSERT INTO `product_attributes_conf` (`id`, `attribute_id`, `attribute_value`) VALUES
(8, 4, '#483794'),
(9, 4, '#b9aee8'),
(10, 5, 'S'),
(11, 5, 'M'),
(12, 5, 'L'),
(13, 5, 'XL'),
(14, 4, '#d17bc4'),
(15, 4, '#ff6600'),
(16, 4, '#ffffff'),
(17, 4, '#000000'),
(18, 5, 'XLL'),
(19, 4, '#E4C5AC'),
(20, 4, '#CF8878');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_set`
--

CREATE TABLE `product_attributes_set` (
  `id` int(11) NOT NULL,
  `attribute` varchar(200) NOT NULL,
  `attribute_ar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes_set`
--

INSERT INTO `product_attributes_set` (`id`, `attribute`, `attribute_ar`, `created_at`, `updated_at`) VALUES
(4, 'Color', 'null', '2023-12-21 16:26:48', '2023-12-21 10:56:52'),
(5, 'Size', 'null', '2023-12-21 16:26:59', '2023-12-21 10:56:59'),
(10, 'Storage', '', '2023-12-21 16:31:07', '2023-12-21 11:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_value`
--

CREATE TABLE `product_attribute_value` (
  `id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `prod_attr_value` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `mrp` float NOT NULL,
  `stock` int(11) NOT NULL,
  `conf_image` mediumtext NOT NULL,
  `notify_on_stock_below` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attribute_value`
--

INSERT INTO `product_attribute_value` (`id`, `product_id`, `prod_attr_value`, `price`, `mrp`, `stock`, `conf_image`, `notify_on_stock_below`, `created_at`, `updated_at`) VALUES
(5, '3', '{\"0\":\"L\"}', 3799, 3999, 222, '', 1, '2024-01-02 10:34:11', '2024-02-06 13:54:40'),
(6, '3', '{\"0\":\"XL\"}', 3899, 3999, 220, '', 1, '2024-01-02 10:34:11', '2024-02-27 07:42:20'),
(7, '4', '{\"0\":\"L\"}', 2999, 2999, 222, '', 1, '2024-01-02 10:35:30', '2024-01-02 10:35:30'),
(8, '4', '{\"0\":\"M\"}', 2999, 2999, 222, '', 1, '2024-01-02 10:35:30', '2024-01-02 10:35:30'),
(9, '5', '{\"0\":\"#b9aee8\",\"1\":\"M\"}', 4699, 4799, 5, '2024/01/02/daaebc696d3b0d629052ecdd98632fc4_1704191862.webp', 1, '2024-01-02 10:37:42', '2024-01-06 12:57:53'),
(10, '5', '{\"0\":\"#b9aee8\",\"1\":\"S\"}', 4499, 4599, 222, '2024/01/02/6584c8c0ef8e5fa8e429433be804912a_1704191862.webp', 1, '2024-01-02 10:37:42', '2024-01-12 23:05:34'),
(15, '2', '{\"0\":\"L\"}', 1999, 3999, 20, '', 1, '2024-01-17 20:43:25', '2024-01-17 20:43:25'),
(16, '2', '{\"0\":\"M\"}', 1999, 3999, 20, '', 1, '2024-01-17 20:43:25', '2024-01-17 20:43:25'),
(17, '2', '{\"0\":\"S\"}', 1999, 3999, 20, '', 1, '2024-01-17 20:43:25', '2024-01-17 20:43:25'),
(18, '2', '{\"0\":\"XL\"}', 1999, 3999, 19, '', 1, '2024-01-17 20:43:25', '2024-02-27 07:42:20'),
(19, '6', '{\"0\":\"#CF8878\"}', 2499, 2999, 3, '[\"2024/03/17/2bc33226488b434823b9aadb2328c539_1710674333.webp\"]', 1, '2024-03-17 11:18:54', '2024-03-17 11:18:54'),
(20, '6', '{\"0\":\"#E4C5AC\"}', 2049, 2999, 5, '[\"2024/03/17/d92da5a8c8014dc44537a7ec5557a131_1710674333.webp\"]', 1, '2024-03-17 11:18:54', '2024-03-17 11:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_variant_cat`
--

CREATE TABLE `product_variant_cat` (
  `variant_id` int(11) NOT NULL,
  `variant_name` varchar(150) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `variant_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variant_cat`
--

INSERT INTO `product_variant_cat` (`variant_id`, `variant_name`, `parent_id`, `variant_order`) VALUES
(34, 'Colour', 0, 0),
(35, '#ff6600', 34, 0),
(36, '#4287f5', 34, 0),
(37, '#c416b9', 34, 0),
(39, 'Ram', 0, 0),
(40, 'Storage', 0, 0),
(41, '500 MB', 39, 0),
(42, '1 GB', 39, 0),
(43, '1.5 GB', 39, 0),
(45, 'Size', 0, 0),
(46, '1 GB', 40, 0),
(48, '2 GB', 40, 0),
(49, '4 GB', 40, 0),
(50, '8 GB', 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `review_array` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_array`) VALUES
(1, '[{\"title\":\"good\",\"feedback\":\"good\",\"rating\":\"5\",\"username\":\"cks\",\"userid\":\"10001\",\"date\":\"02\\/01\\/2023\"}]'),
(2, '[{\"title\":\"good\",\"feedback\":\"good\",\"rating\":\"4\",\"username\":\"ravi\",\"userid\":\"10001\",\"date\":\"02\\/01\\/2023\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `sectionvalue`
--

CREATE TABLE `sectionvalue` (
  `id` int(11) NOT NULL,
  `layoutsection_id` int(11) NOT NULL,
  `title` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `image` mediumtext NOT NULL,
  `button` mediumtext NOT NULL,
  `onclick_url` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sectionvalue`
--

INSERT INTO `sectionvalue` (`id`, `layoutsection_id`, `title`, `description`, `image`, `button`, `onclick_url`) VALUES
(2, 1, '', '', '2023-02-23/Screenshot_2023-02-23-00-13-55-59_680d03679600f7af0b4c700c6b270fe7~2.jpg', 'test', '#'),
(3, 2, 'test1', 'test1', '2022-12-29/online-grocery-store-in-delhi-ncr.png', 'test1', '#'),
(4, 3, 'test2', 'test2', '2022-12-29/3712e4921086beef88529eccdd522a0a.png', 'test2', '#'),
(5, 4, 'BORGES Extra Light Olive Oil', '', '2022-12-31/2-extra-light-plastic-bottle-1-olive-oil-borges-original-imagg574rh9mdvfb.png', '', '#'),
(6, 5, 'Saffola Gold Refined Cooking oil', '', '2022-12-31/4-gold-refined-cooking-oil-blended-rice-bran-corn-oil-helps-keep-original-imagfyagjkhjdsk4.png', '', '#'),
(7, 6, 'Mahakosh Refined Soyabean Oil', '', '2022-12-31/-original-imagahyv8ap4sfaa.png', '', '#'),
(8, 7, '', '', '2022-12-31/64a419c14d778bf1559b1b6063ee8676.jpg', '', '#'),
(9, 8, '', '', '2022-12-31/Why_20Ensure_201064_20x_20960.png', '', '#'),
(10, 9, 'test1', 'test1', '2022-12-29/banner-for-supermarkets-and-grocery-image_csp42487071.png', 'test1', '#'),
(11, 10, 'test1', 'test1', '2022-12-29/130cafb9ec2f9cc60f7c0586e6cfe16f.png', 'test1', '#');

-- --------------------------------------------------------

--
-- Table structure for table `seller_login`
--

CREATE TABLE `seller_login` (
  `seller_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` mediumtext NOT NULL,
  `status` varchar(10) NOT NULL,
  `roll` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seller_login`
--

INSERT INTO `seller_login` (`seller_id`, `fname`, `lname`, `phone`, `email`, `password`, `address`, `status`, `roll`, `date`) VALUES
(1, 'BlueApp', '', '9144040888', 'demo@gmail.com', 'Admin@123', 'address : abc', 'active', 'admin', '2022-05-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL,
  `type` mediumtext NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'gtag_manager', ''),
(2, 'facebook_pixel', ''),
(3, 'topbar_offer', 'Free Shipping on All Orders | Get Extra ₹100 OFF on Spent of ₹1499 Use Code: BLUEAPP19985 2'),
(4, 'theme_color', '#929B76'),
(5, 'system_currency_symbol', '₹'),
(6, 'smtp_host', 'smtp.hostinger.com'),
(7, 'smtp_port', '587'),
(8, 'smtp_user', 'alert@blueappsoftware.com'),
(9, 'smtp_password', '0Lg37!!raS@UB*QeC2Fr');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `countryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateid`, `name`, `countryid`) VALUES
(1, 'Andaman & Nicobar Islands', 1),
(2, 'Andhra Pradesh', 1),
(3, 'Arunachal Pradesh', 1),
(4, 'Assam', 1),
(5, 'Bihar', 1),
(6, 'Chandigarh', 1),
(7, 'Chhattisgarh', 1),
(8, 'Dadra & Nagar Haveli', 1),
(9, 'Daman & Diu', 1),
(10, 'Delhi', 1),
(11, 'Goa', 1),
(12, 'Gujarat', 1),
(13, 'Haryana', 1),
(14, 'Himachal Pradesh', 1),
(15, 'Jammu & Kashmir', 1),
(16, 'Jharkhand', 1),
(17, 'Karnataka', 1),
(18, 'Kerala', 1),
(19, 'Lakshadweep', 1),
(20, 'Madhya Pradesh', 1),
(21, 'Maharashtra', 1),
(22, 'Manipur', 1),
(23, 'Meghalaya', 1),
(24, 'Mizoram', 1),
(25, 'Nagaland', 1),
(26, 'Odisha', 1),
(27, 'Puducherry', 1),
(28, 'Punjab', 1),
(29, 'Rajasthan', 1),
(30, 'Sikkim', 1),
(31, 'Tamil Nadu', 1),
(32, 'Telangana', 1),
(33, 'Tripura', 1),
(34, 'Uttar Pradesh', 1),
(35, 'Uttarakhand', 1),
(36, 'West Bengal', 1),
(37, 'Ladakh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_config`
--

CREATE TABLE `store_config` (
  `sno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `other` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_config`
--

INSERT INTO `store_config` (`sno`, `name`, `value`, `other`) VALUES
(1, 'newuser_coins', '10', ''),
(2, 'coins_discount_percent', '5', ''),
(3, 'minorder', '800', ''),
(4, 'allindia_ship', '65', ''),
(5, 'freeship', '800', ''),
(6, 'cashondelivery', 'enable', ''),
(7, 'showcgst', 'false', ''),
(8, 'mh_ship', '65', ''),
(9, 'working_hour_start', '', ''),
(10, 'working_hour_end', '', ''),
(11, 'store_open_status', '0', '0 means open 1 means store is off');

-- --------------------------------------------------------

--
-- Table structure for table `store_setting`
--

CREATE TABLE `store_setting` (
  `seller_id` int(11) NOT NULL,
  `store_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `tax_no` varchar(30) NOT NULL,
  `logo` mediumtext NOT NULL,
  `web_url` mediumtext NOT NULL,
  `email` varchar(60) NOT NULL,
  `whatsappno` varchar(14) NOT NULL,
  `termcondition` mediumtext NOT NULL,
  `aboutus` mediumtext NOT NULL,
  `youtubeurl` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_setting`
--

INSERT INTO `store_setting` (`seller_id`, `store_name`, `address`, `phone`, `tax_no`, `logo`, `web_url`, `email`, `whatsappno`, `termcondition`, `aboutus`, `youtubeurl`) VALUES
(1, 'Single Vendor Demo', 'Delhi', '9144040888', '', '', '', 'hello@blueappsoftware.com', '+919144040888', 'TERMS AND CONDITIONS :\n', 'Demo Single vendor eCommerce website', '');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `quarterly_amount1` decimal(10,2) NOT NULL,
  `quarterly_amount2` decimal(10,2) NOT NULL,
  `quarterly_amount3` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) DEFAULT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `sno` int(11) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `address` mediumtext DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone_no` varchar(12) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `user_id` int(20) NOT NULL,
  `display_name` varchar(60) DEFAULT NULL,
  `interestid` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`sno`, `full_name`, `address`, `email`, `phone_no`, `password`, `user_id`, `display_name`, `interestid`, `created_at`, `updated_at`) VALUES
(32, 'Yuvraj ', '', 'yuvraj@gmail.com', '7354570394', '7354570394', 10001, 'Yuvraj ', 0, '2024-02-04 08:56:32', '2024-02-04 16:50:03'),
(33, 'yuvraj', '', '', '9302650674', '9302650674', 10002, NULL, 0, '2024-02-04 08:56:32', '2024-02-04 08:56:32'),
(38, 'Jony Paul', '', 'paul.jony0606@gmail.com', '', '', 10003, 'Jony', 0, '2024-02-04 08:56:32', '2024-02-04 08:56:32'),
(42, 'Jony Paul', NULL, 'paul.jony70@gmail.com', NULL, NULL, 10004, 'Jony', NULL, '2024-02-04 17:32:40', '2024-02-04 17:32:40'),
(43, 'kama bb', NULL, 'kamal.bunkar07@gmail.com', NULL, NULL, 10005, 'kama', NULL, '2024-02-27 06:58:40', '2024-02-27 06:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 10003, 532.00, '1', '2024-02-24 10:37:45', '2024-02-25 21:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `payment_type` enum('cr','dr') NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `user_id`, `amount`, `balance`, `payment_type`, `remarks`, `created_at`) VALUES
(1, 10003, 10.00, 10.00, 'cr', 'Daily Spin Bonus', '2024-02-24 11:01:39'),
(2, 10003, 5.00, 15.00, 'cr', 'Daily Spin Bonus', '2024-02-24 11:01:54'),
(3, 10003, 5.00, 20.00, 'cr', 'Daily Spin Bonus/ Place Order Bonus', '2024-02-25 21:06:51'),
(4, 10003, 5.00, 25.00, 'cr', 'Daily Spin Bonus/ Place Order Bonus', '2024-02-25 21:07:30'),
(5, 10003, 25000.00, 25025.00, 'cr', 'Daily Spin Bonus/ Place Order Bonus', '2024-02-25 21:14:53'),
(6, 10003, 24493.00, 532.00, 'dr', 'Place Order', '2024-02-25 21:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `prod_id` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `prod_id`) VALUES
(10003, '{\"1\":{\"index\":1,\"prod_id\":\"3\",\"date\":\"2024-01-16\"}}'),
(10005, '[{\"index\":0,\"prod_id\":\"2\",\"date\":\"2024-02-27\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cartdetails`
--
ALTER TABLE `cartdetails`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `custom_navigations`
--
ALTER TABLE `custom_navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_navigation_products`
--
ALTER TABLE `custom_navigation_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliverytime`
--
ALTER TABLE `deliverytime`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `discountprod`
--
ALTER TABLE `discountprod`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `homecat`
--
ALTER TABLE `homecat`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `homepage_banner`
--
ALTER TABLE `homepage_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banner`
--
ALTER TABLE `home_banner`
  ADD PRIMARY KEY (`home_banner_id`);

--
-- Indexes for table `knet_payment`
--
ALTER TABLE `knet_payment`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `latestprod`
--
ALTER TABLE `latestprod`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `layoutsection`
--
ALTER TABLE `layoutsection`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `notifyme`
--
ALTER TABLE `notifyme`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `offerzone`
--
ALTER TABLE `offerzone`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pincode`
--
ALTER TABLE `pincode`
  ADD PRIMARY KEY (`pincode`);

--
-- Indexes for table `popularprod`
--
ALTER TABLE `popularprod`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `popular_product`
--
ALTER TABLE `popular_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes_conf`
--
ALTER TABLE `product_attributes_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes_set`
--
ALTER TABLE `product_attributes_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variant_cat`
--
ALTER TABLE `product_variant_cat`
  ADD PRIMARY KEY (`variant_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `sectionvalue`
--
ALTER TABLE `sectionvalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_login`
--
ALTER TABLE `seller_login`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `store_config`
--
ALTER TABLE `store_config`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `store_setting`
--
ALTER TABLE `store_setting`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1547;

--
-- AUTO_INCREMENT for table `custom_navigations`
--
ALTER TABLE `custom_navigations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `custom_navigation_products`
--
ALTER TABLE `custom_navigation_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `deliverytime`
--
ALTER TABLE `deliverytime`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discountprod`
--
ALTER TABLE `discountprod`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homecat`
--
ALTER TABLE `homecat`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `homepage_banner`
--
ALTER TABLE `homepage_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `home_banner`
--
ALTER TABLE `home_banner`
  MODIFY `home_banner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `knet_payment`
--
ALTER TABLE `knet_payment`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `latestprod`
--
ALTER TABLE `latestprod`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layoutsection`
--
ALTER TABLE `layoutsection`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifyme`
--
ALTER TABLE `notifyme`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offerzone`
--
ALTER TABLE `offerzone`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `popularprod`
--
ALTER TABLE `popularprod`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `popular_product`
--
ALTER TABLE `popular_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_attributes_conf`
--
ALTER TABLE `product_attributes_conf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_attributes_set`
--
ALTER TABLE `product_attributes_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_attribute_value`
--
ALTER TABLE `product_attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_variant_cat`
--
ALTER TABLE `product_variant_cat`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sectionvalue`
--
ALTER TABLE `sectionvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `seller_login`
--
ALTER TABLE `seller_login`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `store_config`
--
ALTER TABLE `store_config`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
