-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2018 at 04:22 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cow_farm_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `or_cattle_breed`
--

CREATE TABLE `or_cattle_breed` (
  `cattle_breed_id` int(11) NOT NULL,
  `cattle_breed_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cattle_breed_description` tinytext COLLATE utf8_unicode_ci,
  `cattle_breed_insertDate` date NOT NULL,
  `cattle_breed_updateDate` date DEFAULT NULL,
  `cattle_breed_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `or_cattle_breed`
--

INSERT INTO `or_cattle_breed` (`cattle_breed_id`, `cattle_breed_name`, `cattle_breed_description`, `cattle_breed_insertDate`, `cattle_breed_updateDate`, `cattle_breed_status`) VALUES
(1, 'Brown Swiss', 'Second largest amount of milk produced of any dairy cattle breed. ', '2018-08-07', NULL, 1),
(2, 'Illawarra cattle', 'no Description', '2018-08-07', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `or_cow_eaten_foods`
--

CREATE TABLE `or_cow_eaten_foods` (
  `cowEF_id` int(11) NOT NULL,
  `cowEF_cowId` int(11) NOT NULL,
  `cowEF_foodCatId` int(11) NOT NULL,
  `cowEF_foodQuantity` float NOT NULL,
  `cowEF_foodCost` int(11) NOT NULL,
  `cowEF_Date` date NOT NULL,
  `cowEF_Time` time NOT NULL,
  `cowEF_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `or_cow_eaten_foods`
--

INSERT INTO `or_cow_eaten_foods` (`cowEF_id`, `cowEF_cowId`, `cowEF_foodCatId`, `cowEF_foodQuantity`, `cowEF_foodCost`, `cowEF_Date`, `cowEF_Time`, `cowEF_status`) VALUES
(1, 1, 4, 5, 200, '2018-09-02', '01:00:05', 0),
(2, 1, 5, 10, 2000, '2018-09-02', '01:00:05', 0),
(3, 1, 6, 15, 1500, '2018-09-02', '01:00:05', 0),
(4, 1, 4, 5, 200, '2018-09-02', '01:04:20', 0),
(5, 1, 5, 1.5, 300, '2018-09-02', '13:02:38', 0),
(6, 1, 5, 1.6, 320, '2018-09-02', '13:04:29', 0),
(7, 2, 6, 5, 500, '2018-09-02', '16:04:54', 0),
(11, 2, 5, 2, 400, '2018-09-02', '20:48:59', 0),
(12, 2, 4, 5, 200, '2018-09-02', '20:55:07', 0),
(13, 1, 6, 15, 1500, '2018-09-02', '20:55:20', 0),
(14, 1, 5, 0.9, 180, '2018-09-02', '20:55:34', 0),
(15, 1, 4, 10, 400, '2018-09-02', '20:56:27', 0),
(16, 1, 5, 4, 800, '2018-09-03', '00:44:19', 0),
(17, 1, 4, 12, 480, '2018-09-03', '00:45:59', 0),
(18, 1, 5, 4, 800, '2018-09-03', '00:47:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `or_cow_foods`
--

CREATE TABLE `or_cow_foods` (
  `cow_foods_id` int(11) NOT NULL,
  `cow_foods_cat_id` int(11) NOT NULL,
  `cow_foods_quantity` float NOT NULL,
  `cow_foods_cost` int(11) NOT NULL,
  `cow_foods_description` tinytext COLLATE utf8_unicode_ci,
  `cow_foods_addedUser_id` int(11) NOT NULL,
  `cow_foods_addTime` time NOT NULL,
  `cow_foods_insertDate` date NOT NULL,
  `cow_foods_updateUser_id` int(11) DEFAULT NULL,
  `cow_foods_updateTime` time DEFAULT NULL,
  `cow_foods_updateDate` date DEFAULT NULL,
  `cow_foods_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `or_cow_foods`
--

INSERT INTO `or_cow_foods` (`cow_foods_id`, `cow_foods_cat_id`, `cow_foods_quantity`, `cow_foods_cost`, `cow_foods_description`, `cow_foods_addedUser_id`, `cow_foods_addTime`, `cow_foods_insertDate`, `cow_foods_updateUser_id`, `cow_foods_updateTime`, `cow_foods_updateDate`, `cow_foods_status`) VALUES
(1, 4, 20, 800, NULL, 1, '21:36:44', '2018-08-10', NULL, NULL, NULL, 0),
(2, 4, 20, 800, NULL, 1, '21:37:31', '2018-08-10', NULL, NULL, NULL, 0),
(3, 6, 50, 5000, 'buy this for indian cow', 1, '21:38:59', '2018-08-10', NULL, NULL, NULL, 0),
(4, 5, 20, 4000, 'sdfw', 1, '19:24:33', '2018-08-16', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `or_cow_food_category`
--

CREATE TABLE `or_cow_food_category` (
  `cow_foodCat_id` int(11) NOT NULL,
  `cow_foodCat_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cow_foodCat_insertDate` date NOT NULL,
  `cow_foodCat_updateDate` date DEFAULT NULL,
  `cow_foodCat_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `or_cow_food_category`
--

INSERT INTO `or_cow_food_category` (`cow_foodCat_id`, `cow_foodCat_name`, `cow_foodCat_insertDate`, `cow_foodCat_updateDate`, `cow_foodCat_status`) VALUES
(4, 'Food-4', '2018-08-10', NULL, 1),
(5, 'Food-1', '2018-08-10', NULL, 1),
(6, 'Food-7', '2018-08-10', '2018-08-10', 1),
(7, 'Food-1asd', '2018-08-16', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `or_cow_info`
--

CREATE TABLE `or_cow_info` (
  `cow_id` int(11) NOT NULL,
  `cow_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cattle_breed` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cow_description` text COLLATE utf8_unicode_ci,
  `cow_image1` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cow_image2` text COLLATE utf8_unicode_ci,
  `cow_insertStatus` int(11) NOT NULL,
  `cow_preCost` int(11) NOT NULL,
  `cow_fareCost` int(11) NOT NULL,
  `cow_insertDate` date NOT NULL,
  `cow_updateDate` date DEFAULT NULL,
  `cow_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `or_cow_info`
--

INSERT INTO `or_cow_info` (`cow_id`, `cow_name`, `cattle_breed`, `cow_description`, `cow_image1`, `cow_image2`, `cow_insertStatus`, `cow_preCost`, `cow_fareCost`, `cow_insertDate`, `cow_updateDate`, `cow_status`) VALUES
(1, 'Putu', '1', 'The cow is good one', 'images/cowImage/5b69cdc0adee6.jpg', '', 2, 35000, 550, '2018-08-07', NULL, 1),
(2, 'Bholu', '2', 'this is a indian cow.... it buy from barishal division', 'images/cowImage/5b70764a6eaf5.jpg', 'images/cowImage/5b70764a6ef74.png', 2, 30000, 600, '2018-08-13', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `or_cow_medical_cost`
--

CREATE TABLE `or_cow_medical_cost` (
  `cow_MC_id` int(11) NOT NULL,
  `cow_MC_cowId` int(11) NOT NULL,
  `cow_MC_illnessName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cow_MC_cost` float NOT NULL,
  `cow_MC_userId` int(11) NOT NULL,
  `cow_MC_insertTime` time NOT NULL,
  `cow_MC_insertDate` date NOT NULL,
  `cow_MC_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `or_cow_medical_cost`
--

INSERT INTO `or_cow_medical_cost` (`cow_MC_id`, `cow_MC_cowId`, `cow_MC_illnessName`, `cow_MC_cost`, `cow_MC_userId`, `cow_MC_insertTime`, `cow_MC_insertDate`, `cow_MC_status`) VALUES
(1, 1, 'Decentry', 550.55, 1, '13:32:48', '2018-09-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `or_remaining_cow_food`
--

CREATE TABLE `or_remaining_cow_food` (
  `remaining_cf_id` int(11) NOT NULL,
  `remaining_cf_cat_id` int(11) NOT NULL,
  `remaining_cf_quantity` float NOT NULL,
  `remaining_cf_cost` int(11) NOT NULL,
  `remaining_cf_addTime` time NOT NULL,
  `remaining_cf_insertDate` date NOT NULL,
  `remaining_cf_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `or_remaining_cow_food`
--

INSERT INTO `or_remaining_cow_food` (`remaining_cf_id`, `remaining_cf_cat_id`, `remaining_cf_quantity`, `remaining_cf_cost`, `remaining_cf_addTime`, `remaining_cf_insertDate`, `remaining_cf_status`) VALUES
(1, 4, 15, 600, '00:43:49', '2018-09-03', 1),
(2, 5, 4, 800, '00:43:49', '2018-09-03', 0),
(3, 6, 15, 1500, '00:43:49', '2018-09-03', 1),
(6, 5, 0, 0, '00:47:47', '2018-09-03', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `or_cattle_breed`
--
ALTER TABLE `or_cattle_breed`
  ADD PRIMARY KEY (`cattle_breed_id`);

--
-- Indexes for table `or_cow_eaten_foods`
--
ALTER TABLE `or_cow_eaten_foods`
  ADD PRIMARY KEY (`cowEF_id`);

--
-- Indexes for table `or_cow_foods`
--
ALTER TABLE `or_cow_foods`
  ADD PRIMARY KEY (`cow_foods_id`);

--
-- Indexes for table `or_cow_food_category`
--
ALTER TABLE `or_cow_food_category`
  ADD PRIMARY KEY (`cow_foodCat_id`);

--
-- Indexes for table `or_cow_info`
--
ALTER TABLE `or_cow_info`
  ADD PRIMARY KEY (`cow_id`);

--
-- Indexes for table `or_cow_medical_cost`
--
ALTER TABLE `or_cow_medical_cost`
  ADD PRIMARY KEY (`cow_MC_id`);

--
-- Indexes for table `or_remaining_cow_food`
--
ALTER TABLE `or_remaining_cow_food`
  ADD PRIMARY KEY (`remaining_cf_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `or_cattle_breed`
--
ALTER TABLE `or_cattle_breed`
  MODIFY `cattle_breed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `or_cow_eaten_foods`
--
ALTER TABLE `or_cow_eaten_foods`
  MODIFY `cowEF_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `or_cow_foods`
--
ALTER TABLE `or_cow_foods`
  MODIFY `cow_foods_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `or_cow_food_category`
--
ALTER TABLE `or_cow_food_category`
  MODIFY `cow_foodCat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `or_cow_info`
--
ALTER TABLE `or_cow_info`
  MODIFY `cow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `or_cow_medical_cost`
--
ALTER TABLE `or_cow_medical_cost`
  MODIFY `cow_MC_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `or_remaining_cow_food`
--
ALTER TABLE `or_remaining_cow_food`
  MODIFY `remaining_cf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
