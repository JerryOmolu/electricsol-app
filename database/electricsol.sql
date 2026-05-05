-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2026 at 08:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electricsol`
--

-- --------------------------------------------------------

--
-- Table structure for table `artisan`
--

CREATE TABLE `artisan` (
  `artisan_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `lga` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `skills` varchar(5000) NOT NULL,
  `certificate` varchar(5000) NOT NULL,
  `years` varchar(255) NOT NULL,
  `added_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artisan`
--

INSERT INTO `artisan` (`artisan_id`, `name`, `gender`, `date_of_birth`, `email`, `phone`, `state`, `lga`, `address`, `skills`, `certificate`, `years`, `added_on`) VALUES
(3, 'Jerry Omolu', 'Male', '1990-06-14', 'jerryomoh63@gmail.com', '08034861141', 'Edo', 'Etsako East', '18 Abdullahi Adamu Street, Abuja', 'Electrical Appliances Installation,Solar Panel Installation and Maintenance,Circuit breaker installation and maintenance,Electrical panel upgrades,Industrial electrical maintenance,Reading and interpreting blueprints & schematics,Electrical wiring and installations,', 'Electrical Technician Certificate,Licensed Electrician,Occupational Safety and Health Administration (OSHA) Certification,Solar Installation Training Certification,Apprenticeship Training Programs,First Aid/CPR Certification,', '5-10 Years', '2024-08-21'),
(10, 'Jerry Steve', 'Male', '1987-07-20', 'jerry_steve2007@yahoo.com', '08175233283', 'Edo', 'Etsako East', '18 Abdullahi Adamu Street, Mararaba', 'Solar Panel Installation and Maintenance,Circuit breaker installation and maintenance,Reading and interpreting blueprints & schematics,', 'Licensed Electrician,Occupational Safety and Health Administration (OSHA) Certification,First Aid/CPR Certification,', '5 Years', '2024-09-02'),
(15, 'Tranverse Business', 'Female', '1983-07-20', 'tranversebusiness@gmail.com', '09024500011', 'Edo', 'Etsako East', '18 Abdullahi Adamu Street', 'Electrical Appliances Installation,Circuit breaker installation and maintenance,Electrical panel upgrades,Reading and interpreting blueprints & schematics,', 'Occupational Safety and Health Administration (OSHA) Certification,Apprenticeship Training Programs,NEMSA,', '5-10 Years', '2024-10-24'),
(20, 'Jason Oshoke', 'Male', '1984-10-23', 'jasonoshoke24@gmail.com', '07083242888', 'Edo', 'Etsako Central', '18 Abdullahi Adamu Street', 'Electrical Appliances Installation,Circuit breaker installation and maintenance,Electrical panel upgrades,Reading and interpreting blueprints & schematics,', 'Electrical Technician Certificate,Licensed Electrician,Solar Installation Training Certification,Apprenticeship Training Programs,', 'Less Than 5 Yrs', '2025-09-23');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `image_one` text NOT NULL,
  `price` int(11) NOT NULL,
  `stock_level` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `date_ordered` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`order_id`, `customer_name`, `product_name`, `product_number`, `image_one`, `price`, `stock_level`, `quantity`, `amount`, `order_number`, `payment_status`, `date_ordered`) VALUES
(208, 'Jerry Omolu', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 29, 1, 390000, '4307857', 'Paid', '2024-10-02 16:37:37'),
(209, 'Jerry Omolu', 'LG Refrigerator', '6732999', 'front.png', 275000, 28, 1, 275000, '9524516', 'Paid', '2024-10-02 16:37:37'),
(211, 'Jason Oshoke', 'LG Refrigerator', '6732999', 'front.png', 275000, 28, 1, 275000, '5510999', 'Paid', '2024-10-03 12:21:28'),
(212, 'Jason Oshoke', 'Samsung Washing Machine', '328901', 'washing-machine-side.png', 870000, 6, 1, 870000, '7806892', 'Paid', '2024-10-03 12:21:28'),
(213, 'Jason Oshoke', 'LG Refrigerator', '6732999', 'front.png', 275000, 28, 1, 275000, '3749135', 'Paid', '2024-10-10 10:13:14'),
(214, 'Jason Oshoke', 'Samsung Washing Machine', '328901', 'washing-machine-side.png', 870000, 6, 1, 870000, '2570796', 'Paid', '2024-10-10 10:13:14'),
(215, 'Jerry Omolu', 'LG Refrigerator', '6732999', 'front.png', 275000, 28, 1, 275000, '6158923', 'Paid', '2024-10-10 10:08:40'),
(216, 'Jerry Omolu', 'Samsung Washing Machine', '328901', 'washing-machine-side.png', 870000, 6, 1, 870000, '9855388', 'Paid', '2024-10-10 10:08:40'),
(217, 'Jerry Omolu', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 28, 1, 390000, '2276834', 'Paid', '2024-10-10 10:08:40'),
(220, 'Mercy Igwe Ezinne', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 0, 2, 780000, '6109862', 'Paid', '2024-10-09 19:26:43'),
(221, 'Mercy Igwe Ezinne', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 28, 1, 390000, '7308259', 'Paid', '2024-10-10 09:22:32'),
(222, 'Mercy Igwe Ezinne', 'LG Refrigerator', '6732999', 'front.png', 275000, 0, 2, 550000, '1705318', 'Paid', '2024-10-10 09:22:32'),
(223, 'Mercy Igwe Ezinne', 'LG Refrigerator', '6732999', 'front.png', 275000, 28, 1, 275000, '1521115', 'Paid', '2024-10-10 09:23:35'),
(224, 'Mercy Igwe Ezinne', 'LG Refrigerator', '6732999', 'front.png', 275000, 27, 1, 275000, '2605255', 'Paid', '2024-10-10 09:24:34'),
(225, 'Mercy Igwe Ezinne', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 28, 1, 390000, '4227643', 'Paid', '2024-10-10 09:24:34'),
(226, 'Mercy Igwe Ezinne', 'LG Refrigerator', '6732999', 'front.png', 275000, 26, 1, 275000, '9541096', 'Paid', '2024-10-10 09:27:28'),
(228, 'Mercy Igwe Ezinne', 'Samsung Washing Machine', '328901', 'washing-machine-side.png', 870000, 6, 1, 870000, '4217006', 'Paid', '2024-10-10 09:29:13'),
(231, 'Mercy Igwe Ezinne', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 28, 1, 390000, '6490815', 'Paid', '2024-10-10 10:06:35'),
(232, 'Jerry Omolu', 'Samsung Washing Machine', '21890934', 'washing-machine.png', 650000, 65, 1, 650000, '7734866', 'Paid', '2024-10-10 12:19:56'),
(234, 'Jerry Omolu', 'Black Cable Long Range', '563242', 'ac.png', 40000, 0, 2, 80000, '2122030', 'Paid', '2024-10-10 12:19:56'),
(235, 'Jerry Omolu', 'Black Cable Long Range', '563242', 'ac.png', 40000, 28, 1, 40000, '1011875', 'Paid', '2024-10-10 12:21:08'),
(236, 'Jerry Omolu', 'Samsung Washing Machine', '21890934', 'washing-machine.png', 650000, 64, 1, 650000, '9530617', 'Paid', '2024-10-10 12:21:08'),
(237, 'Jerry Omolu', 'LG Refrigerator', '6732999', 'front.png', 275000, 40, 1, 275000, '4078447', 'Paid', '2024-10-10 12:21:08'),
(238, 'Jerry Omolu', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 30, 1, 390000, '2150396', 'Paid', '2024-10-10 12:21:08'),
(257, 'Jerry Omolu', 'Binatone Vaccuum Cleaner', '46763564', 'vacuum.png', 120000, 23, 1, 120000, '1636305', 'Paid', '2024-10-15 05:18:08'),
(263, 'Jerry Omolu', 'Electric Kettle', '3278942', 'kettle.png', 35000, 23, 1, 35000, '1244729', 'Paid', '2025-09-22 14:19:45'),
(264, 'Jerry Omolu', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 29, 1, 390000, '6867517', 'Paid', '2025-09-22 14:19:45'),
(265, 'Jerry Omolu', 'Electric Kettle', '3278942', 'kettle.png', 35000, 22, 1, 35000, '8181812', 'Paid', '2025-09-23 01:26:58'),
(267, 'Jerry Omolu', 'Binatone Vaccuum Cleaner', '46763564', 'vacuum.png', 120000, 22, 1, 120000, '8892998', 'Paid', '2025-09-23 01:29:25'),
(270, 'Jerry Omolu', 'Electric Kettle', '3278942', 'kettle.png', 35000, 21, 2, 70000, '9958347', 'Paid', '2025-09-23 02:09:24'),
(271, 'Jerry Omolu', 'Binatone Vaccuum Cleaner', '46763564', 'vacuum.png', 120000, 21, 2, 240000, '6788159', 'Paid', '2025-09-23 02:09:24'),
(272, 'Jerry Omolu', 'Haier Thermocool Washing Machine', '3289000', 'washing-machine.png', 390000, 28, 1, 390000, '6969575', 'Paid', '2025-09-23 02:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `device_id` int(11) NOT NULL,
  `device_owner_id` int(11) NOT NULL,
  `device_owner_name` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `device_name_one` varchar(255) NOT NULL,
  `device_name_two` varchar(255) NOT NULL,
  `power` int(100) NOT NULL,
  `usage_time` int(11) NOT NULL,
  `remaining_time` int(11) NOT NULL,
  `added_on` date NOT NULL,
  `energy_consumed` decimal(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `device_owner_id`, `device_owner_name`, `phone`, `device_name_one`, `device_name_two`, `power`, `usage_time`, `remaining_time`, `added_on`, `energy_consumed`) VALUES
(45, 0, 'Jerry Omolu', '08034861141', 'Refrigerator', '', 350, 25200, 0, '2024-09-23', 2.450),
(46, 0, 'Jerry Omolu', '08034861141', '', 'Water Heater', 400, 36000, 0, '2024-09-23', 4.000),
(47, 0, 'Jason Oshoke', '07083242888', 'Washing Machine', '', 350, 32400, 0, '2024-10-03', 3.150),
(48, 0, 'Mercy Igwe Ezinne', '09024500011', 'Game', '', 250, 36000, 0, '2024-10-09', 2.500),
(49, 0, 'Mercy Igwe Ezinne', '09024500011', '', 'Water Heater', 250, 18000, 0, '2024-10-10', 1.250),
(50, 0, 'Jerry Omolu', '08034861141', 'Blender', '', 125, 7200, 0, '2024-10-17', 0.250);

-- --------------------------------------------------------

--
-- Table structure for table `disco`
--

CREATE TABLE `disco` (
  `disco_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `disco` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disco`
--

INSERT INTO `disco` (`disco_id`, `name`, `location`, `phone`, `disco`, `message`, `date`, `status`) VALUES
(2, 'Mercy Igwe Ezinne', '18 Abdullahi Adamu Street', '07083242888', 'AEDC - Abuja Electricity Distribution Company', 'There ia a problem', '2024-09-11', 'Handled'),
(4, 'Jerry', '18 Abdullahi Adamu Street', '08034861141', 'EKEDC - Eko Electricity Distribution Company', 'Thank You', '2024-09-11', 'Handled'),
(5, 'Oshokha Daniel', '7 Andy Elland Street', '08027531893', 'BEDC - Benin Electricity Distribution Company ', 'Thank You', '2024-09-11', 'Handled'),
(6, 'Mercy Igwe Ezinne', '7 Andy Elland Street', '09024500011', 'KEDCO - Kano Electricity Distribution Company', 'Thank You', '2024-09-11', 'Handled'),
(7, 'Michael Okpara', 'Jos Street Garki Area 3, Abuja', '08034861141', 'IBEDC - Ibadan Electricity Distribution Company', 'Thank You', '2024-09-11', 'Handled'),
(9, 'Mercy Igwe Ezinne', '7 Andy Elland Street', '08034474448', 'BEDC - Benin Electricity Distribution Company ', 'This is not Good', '2024-09-11', 'Handled');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_name`, `customer_email`, `phone_number`, `amount`, `reference`, `status`, `payment_date`) VALUES
(58, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '31500000', 'EM678502319', 'success', '2024-09-08 13:39:05'),
(59, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '31500000', 'EM678502319', 'success', '2024-09-08 23:00:00'),
(60, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '31500000', 'EM678502319', 'success', '2024-09-06 23:00:00'),
(61, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '114500000', 'EM788974837', 'success', '0000-00-00 00:00:00'),
(62, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '114500000', 'EM407436576', 'success', '0000-00-00 00:00:00'),
(63, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '114500000', 'EM966087568', 'success', '0000-00-00 00:00:00'),
(64, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '43000000', 'EM98343660', 'success', '0000-00-00 00:00:00'),
(65, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '43000000', 'EM315074128', 'success', '0000-00-00 00:00:00'),
(66, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '43000000', 'EM177839234', 'success', '0000-00-00 00:00:00'),
(67, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '43000000', 'EM703725475', 'success', '0000-00-00 00:00:00'),
(68, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '70500000', 'EM17663295', 'success', '0000-00-00 00:00:00'),
(69, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '39000000', 'EM40867848', 'success', '0000-00-00 00:00:00'),
(70, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '39000000', 'EM410339344', 'success', '0000-00-00 00:00:00'),
(71, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '39000000', 'EM257686411', 'success', '0000-00-00 00:00:00'),
(72, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '39000000', 'EM294403725', 'success', '0000-00-00 00:00:00'),
(73, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '39000000', 'EM680994878', 'success', '0000-00-00 00:00:00'),
(74, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '156000000', 'EM610499820', 'success', '2024-09-10 13:44:22'),
(75, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '211000000', 'EM395940722', 'success', '2024-09-20 14:53:13'),
(76, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '66500000', 'EM803466600', 'success', '2024-10-02 16:37:37'),
(77, 'Jason Oshoke', 'jasonoshoke24@gmail.com', '07083242888', '118500000', 'EM376038214', 'success', '2024-10-03 12:21:28'),
(78, 'Mercy Igwe Ezinne', 'mercyjerry85@gmail.com', '09024500011', '82000000', 'EM474001388', 'success', '2024-10-09 19:26:43'),
(79, 'Mercy Igwe Ezinne', 'mercyjerry85@gmail.com', '09024500011', '94000000', 'EM167409034', 'success', '2024-10-10 09:22:32'),
(80, 'Mercy Igwe Ezinne', 'mercyjerry85@gmail.com', '09024500011', '27500000', 'EM747600419', 'success', '2024-10-10 09:23:35'),
(81, 'Mercy Igwe Ezinne', 'mercyjerry85@gmail.com', '09024500011', '66500000', 'EM406100995', 'success', '2024-10-10 09:24:34'),
(82, 'Mercy Igwe Ezinne', 'mercyjerry85@gmail.com', '09024500011', '31500000', 'EM366456548', 'success', '2024-10-10 09:27:28'),
(83, 'Mercy Igwe Ezinne', 'mercyjerry85@gmail.com', '09024500011', '91000000', 'EM87344624', 'success', '2024-10-10 09:29:13'),
(84, 'Mercy Igwe Ezinne', 'mercyjerry85@gmail.com', '09024500011', '43000000', 'EM198676051', 'success', '2024-10-10 10:06:35'),
(85, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '157500000', 'EM120126029', 'success', '2024-10-10 10:08:39'),
(86, 'Jason Oshoke', 'jasonoshoke24@gmail.com', '07083242888', '114500000', 'EM82753775', 'success', '2024-10-10 10:13:14'),
(87, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '73000000', 'EM16694639', 'success', '2024-10-10 12:19:55'),
(88, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '135500000', 'EM380824137', 'success', '2024-10-10 12:21:07'),
(89, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '4500000', 'EM203857397', 'success', '2024-10-10 12:41:26'),
(90, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '15600000', 'EM629019588', 'success', '2024-10-14 17:43:55'),
(91, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '38000', 'EM92214187', 'success', '2024-10-15 04:57:48'),
(92, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '120000', 'EM707063516', 'success', '2024-10-15 05:01:00'),
(93, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '38000', 'EM424113518', 'success', '2024-10-15 05:10:39'),
(94, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '38000', 'EM147131011', 'success', '2024-10-15 05:15:41'),
(95, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '12500000', 'EM29404301', 'success', '2024-10-15 05:18:08'),
(96, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '3600000', 'EM532172887', 'success', '2024-10-15 05:20:43'),
(97, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '3600000', 'EM775860777', 'success', '2025-09-12 20:54:22'),
(98, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '42500000', 'EM626184379', 'success', '2025-09-22 14:19:45'),
(99, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '3600000', 'EM142397224', 'success', '2025-09-23 01:26:58'),
(100, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '12000000', 'EM695692996', 'success', '2025-09-23 01:29:25'),
(101, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '100000', 'EM221917939', 'success', '2025-09-23 01:35:39'),
(102, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '70000000', 'EM354216122', 'success', '2025-09-23 02:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_details` text NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `image_one` text NOT NULL,
  `image_two` text NOT NULL,
  `image_three` text NOT NULL,
  `stock_level` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_details`, `product_number`, `category`, `price`, `keywords`, `image_one`, `image_two`, `image_three`, `stock_level`, `added_on`, `added_by`) VALUES
(13, 'Haier Thermocool Washing Machine', 'Selecting a washing machine that you can trust with clothes is just as important as the detergent you use. All Haier Thermocool washing machines are built to the highest standards, making any choice you make a smart choice. Smart Water & Power Usage 360C Smart Wash Technology automatically measures the weight of your laundry and sets the appropriate washing time. Stop & Reload.\\\\r\\\\n\\\\r\\\\nEver started your front-load washing machine and forgotten a few items? No need to worry just Stop and Reload.', '3289000', 'Home Appliances', 390000, 'thermocool, washing machine, front', 'washing-machine.png', 'washing-machine-back.png', 'washing-machine-side.png', 27, '2025-09-23 02:09:23', 'Jerry Omolu'),
(16, 'LG Refrigerator', 'A Smart Energy Saving Refrigerator', '6732999', 'Consumer Electronics', 275000, 'LG, Refrigerator, Fridge, Single Door', 'front.png', 'side.png', 'back.png', 39, '2024-10-10 12:21:07', 'Jerry Omolu'),
(18, 'Samsung Washing Machine', 'Samsung Washing Machine Front Load with Dryer and Spinner', '21890934', 'Home Appliances', 650000, 'front, washing, load, spinner', 'washing-machine.png', 'washing-machine-back.png', 'washing-machine-side.png', 63, '2024-10-10 12:21:07', 'Jerry Omolu'),
(19, 'Light Bulb', 'Metro 2.5 watt Energy Saving Bulb', '123123', 'Lighting', 1000, 'light, bulb, energy, saving', 'light.jpg', 'light.jpg', 'light.jpg', 171, '2025-09-23 01:35:39', 'Jerry Omolu'),
(20, 'Electric Kettle', 'Sencor Electric Kettle silver coat', '3278942', 'Home Appliances', 35000, 'electric, kettle, silver, boiler', 'kettle.png', 'kettle.png', 'kettle.png', 19, '2025-09-23 02:09:23', 'Jerry Omolu'),
(21, 'Binatone Vaccuum Cleaner', 'A King sized binatone vacuumm cleaner with enhanced functionality', '46763564', 'Home Appliances', 120000, 'vaccuum, cleaner, binatone', 'vacuum.png', 'vacuum.png', 'vacuum.png', 19, '2025-09-23 02:09:23', 'Jerry Omolu');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `fullname`, `email`, `phone`, `password`, `verify_token`, `remember_token`, `verify_status`, `date`, `address`) VALUES
(18, 'Jerry Omolu', 'jerryomoh63@gmail.com', '08034861141', '$2y$10$sPbIZbXTyIyUAMV2/sYLSexxCEOiWAFddt2g1BkRyCAJxYlJpOUta', '0d8d439be4b1a25418a2063ced32f62a', 'c40cca8419f29bce14a13e5800c02b1f', 1, '2024-08-10', '18 Abdullahi Adamu Street'),
(26, 'Mercy Igwe Ezinne', 'mercyjerry85@gmail.com', '09024500011', '$2y$10$EsqrnRN2BvnY9nm.cxuwZuV3.fxBDghn1Iv6UO.6rkO/PViQ7wVvy', 'afba872d74318f7437c41cdab7207606electricsol', '', 1, '2024-10-09', '18 Abdullahi Adamu Street'),
(39, 'Jerry Steven', 'jerry_steve2007@yahoo.com', '07083242888', '$2y$10$5rw5Zz.wcXmpN74V8yxm4.nzjw46IRKMvxzWrB0IAg/IritxWl2kK', 'fa887b0d15c603d91bab0fad502bf485electricsol', '', 1, '2025-02-25', ''),
(54, 'Jason Oshoke', 'jasonoshoke24@gmail.com', '08175233283', '$2y$10$iGS06HtdQSZnnuvI04jbi.H4VRrwF4JP9XBs9bzkUUjuhr9/hAJEy', '143cc5a0ac47f4cf793cce2be86d8330electricsol', 'ad0392e529acf2f07aeccb7718f6987b', 1, '2025-09-23', '');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `review_author` varchar(255) NOT NULL,
  `review_content` text NOT NULL,
  `review_rating` int(11) NOT NULL DEFAULT 0,
  `review_date` date NOT NULL,
  `review_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_author`, `review_content`, `review_rating`, `review_date`, `review_status`) VALUES
(1, 'Imhoesi Omolu', 'I have been using this app for a few months now, and it has quickly become my go-to for online shopping for energy saving products', 4, '2024-08-19', 'Approved'),
(5, 'Queeneth Udensi', 'I absolutely love this app! The interface is clean and easy to navigate, making it a breeze to find what I am looking for.', 0, '2024-08-19', 'Approved'),
(13, 'Engr Mike Gregory', 'The game changer with this App is the Artisan feature. As an electrical engineer, it\\\'s a job hub where I can get jobs based on my skills.', 5, '2024-10-15', 'Approved'),
(14, 'Hyacinth Alapa', 'I like the Electricsol APP. It solves my energy problem fast. The fact that I can calculate my energy consumption is super great.', 4, '2024-10-15', 'Approved'),
(15, 'Sheila Dashung', 'Interestingly, this solves a lot of problems relating to the energy sector. For the first time, I can tap on a button in an app to call the fire department during a fire emergency. I am pleased with this innovation. Thanks Electricsol', 5, '2024-10-15', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE `stars` (
  `id` int(11) NOT NULL,
  `rateIndex` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`id`, `rateIndex`) VALUES
(4, 3),
(5, 4),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_number` varchar(255) NOT NULL,
  `quantity_purchased` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `product_name`, `product_number`, `quantity_purchased`) VALUES
(1, 'Samsung Washing Machine', '328901', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `added_on` date NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `username`, `email`, `phone`, `gender`, `password`, `role`, `added_on`, `added_by`, `verify_token`, `verify_status`) VALUES
(2, 'Jerry Omolu', 'jerry', 'jerryomoh63@gmail.com', '08034861141', 'Male', '$2y$10$nGypjeEnKO8qEiHCgzEBZ..xWyoT4ztJslK7jijMJhvbRR7TPS2sK', 'Admin', '2024-08-30', '', 'd01f5ef34a7a6c7a5fbdc6871382f64b', 1),
(4, 'Mercy Jerry', 'mercy', 'igwemercye@gmail.com', '08034474448', 'Female', '$2y$10$8poNkwlaGv8EDGcBv/AbU.2eiNW33uSMtTecyU8lY8xu4tpOcl5QG', 'Operator', '2024-08-30', 'Mercy Jerry', '0f2cef44213cdc2590df48cf51b03563', 1),
(8, 'Jerry Steve', 'steve01', 'jerry_steve2007@yahoo.com', '08175233283', 'Male', '$2y$10$q0AwsYbCs.wNli7J5VKyY.Ze1EKFo7/jR1IdTJKmPtaIC9lqD9uhu', 'Operator', '2024-08-30', 'Jerry Steve', '1a0a0c7b8339e88fe00df07423528430', 1),
(14, 'Mercy Jerry Omolu', 'mercy01', 'mercyjerry141@gmail.com', '08027531893', 'Female', '$2y$10$kiLqrIUyJlPUWaJR4W3mCuiE7pTbxKCDs4kcrZj2U/iR0VeXAytey', 'Operator', '2024-10-12', 'Jerry Omolu', 'd686f610e2fe64333e6ecad531761fde', 1),
(18, 'Jason Oshoke', 'jason', 'jasonoshoke24@gmail.com', '07083242888', 'Male', '$2y$10$rshWB8KVovTfE.wJwbJLWufp86gog1kZKlrKaXcQVPMT434yJXqxK', 'Operator', '2025-09-23', 'Jerry Omolu', 'cc05fcfb8f0efaef1108feeef7a26aeb', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artisan`
--
ALTER TABLE `artisan`
  ADD PRIMARY KEY (`artisan_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `disco`
--
ALTER TABLE `disco`
  ADD PRIMARY KEY (`disco_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artisan`
--
ALTER TABLE `artisan`
  MODIFY `artisan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `disco`
--
ALTER TABLE `disco`
  MODIFY `disco_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stars`
--
ALTER TABLE `stars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
