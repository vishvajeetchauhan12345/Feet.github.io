-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2018 at 03:48 AM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tammana1_fleet_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `acquisition`
--

CREATE TABLE `acquisition` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `exp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exp_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acquisition`
--

INSERT INTO `acquisition` (`id`, `vehicle_id`, `exp_name`, `exp_amount`, `details`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'test', '1000', NULL, 2, '2018-04-26 14:51:39', '2018-04-26 14:51:39'),
(2, 2, 'service', '3000', NULL, 2, '2018-04-26 14:51:39', '2018-04-26 14:51:39'),
(3, 3, 'Asset', '9000000', NULL, 1, '2018-04-27 03:22:05', '2018-04-27 03:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `pickup` timestamp NULL DEFAULT NULL,
  `dropoff` timestamp NULL DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `pickup_addr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dest_addr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `travellers` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_id`, `user_id`, `vehicle_id`, `driver_id`, `pickup`, `dropoff`, `duration`, `pickup_addr`, `dest_addr`, `note`, `travellers`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, '2018-04-06 07:25:42', '2018-04-06 21:00:01', 2880, '6426 Huels Mountain Suite 787', '6426 Huels Mountain Suite 787', 'sample note', 2, 0, '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 2, 1, 1, 1, '2018-04-23 15:44:24', '2018-04-24 20:11:48', 2880, '35755 Velda Mountain', '35755 Velda Mountain', 'sample note', 3, 0, '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_income`
--

CREATE TABLE `booking_income` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(11) NOT NULL,
  `income_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address1`, `address2`, `city`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Diana Mills', 'alfonzo.hettinger@example.com', '+7040372672114', '6426 Huels Mountain Suite 787', '5885 Isac Lodge\nPort Tristin, IA 03413-4093', 'Port Abraham', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 'Prof. Christine Romaguera DVM', 'mckenzie.lucious@example.net', '+3548576641959', '35755 Velda Mountain', '10445 Annette Circles\nStantonshire, GA 18140', 'Gulgowskichester', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) NOT NULL,
  `expense_type` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `vehicle_id`, `amount`, `user_id`, `expense_type`, `comment`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 42500.00, 2, 1, 'Sample Comment', '2018-04-25', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 2, 1000.00, 3, 4, 'Sample Comment', '2018-04-21', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_cat`
--

CREATE TABLE `expense_cat` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `frequancy` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense_cat`
--

INSERT INTO `expense_cat` (`id`, `name`, `user_id`, `cost`, `type`, `created_at`, `updated_at`, `deleted_at`, `frequancy`) VALUES
(1, 'Insurance', 1, 42500.00, 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 'Monthly'),
(2, 'Patente', 1, 60000.00, 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 'Quarterly'),
(3, 'Mechanics', 1, 30000.00, 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 'Monthly'),
(4, 'Car wash', 1, 1000.00, 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 'Weekly'),
(5, 'Vignette', 1, 3000.00, 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 'Yearly'),
(6, 'Maintenance', 14, 5678.00, 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 'Daily'),
(7, 'Parking', 14, 18000.00, 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 'Yearly'),
(8, 'Fuel', 15, 1000.00, 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 'Daily');

-- --------------------------------------------------------

--
-- Table structure for table `fuel`
--

CREATE TABLE `fuel` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_meter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_meter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `vendor_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mileage_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `fuel_from` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_per_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `consumption` int(11) DEFAULT NULL,
  `complete` int(11) DEFAULT '0',
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fuel`
--

INSERT INTO `fuel` (`id`, `vehicle_id`, `user_id`, `start_meter`, `end_meter`, `reference`, `province`, `note`, `vendor_name`, `mileage_type`, `qty`, `fuel_from`, `cost_per_unit`, `consumption`, `complete`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '1000', '2000', NULL, NULL, 'sample note', NULL, NULL, 10, 'fuel tank', '50', 100, 0, '2018-04-24', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 1, 2, '2000', '0', NULL, NULL, 'sample note', NULL, NULL, 10, 'fuel tank', '50', 0, 0, '2018-05-06', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) NOT NULL,
  `income_cat` int(11) NOT NULL,
  `mileage` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `vehicle_id`, `amount`, `user_id`, `income_cat`, `mileage`, `date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 15000.00, 2, 2, NULL, '2018-05-01', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 2, 18000.00, 3, 3, NULL, '2018-04-27', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `income_cat`
--

CREATE TABLE `income_cat` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `income_cat`
--

INSERT INTO `income_cat` (`id`, `name`, `user_id`, `cost`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ragular Day', 1, '17000.00', 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 'Holiday', 1, '15000.00', 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(3, 'Sunday', 1, '18000.00', 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(4, 'Booking', 1, '0.00', 'd', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `ins_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ins_exp_date` date NOT NULL,
  `documents` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`id`, `vehicle_id`, `ins_number`, `ins_exp_date`, `documents`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '70651', '2019-01-01', NULL, NULL, '2018-04-26 09:21:39', '2018-04-26 09:21:39'),
(2, 2, '50878', '2019-04-26', NULL, NULL, '2018-04-26 09:21:39', '2018-04-26 09:21:39'),
(3, 3, '3456', '2019-04-30', NULL, NULL, '2018-04-26 21:51:23', '2018-04-26 21:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `maintanance`
--

CREATE TABLE `maintanance` (
  `id` int(10) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_06_03_134304_create_acquisition_table', 1),
(2, '2017_06_03_134331_create_expense_table', 1),
(3, '2017_06_03_134332_create_expense_cat_table', 1),
(4, '2017_06_03_134332_create_income_table', 1),
(5, '2017_06_03_134333_create_income_cat_table', 1),
(6, '2017_06_03_134333_create_maintanance_table', 1),
(7, '2017_06_03_134334_create_mileage_table', 1),
(8, '2017_06_03_134334_create_part_trans_table', 1),
(9, '2017_06_03_134335_create_parts_stock_table', 1),
(10, '2017_06_03_134335_create_parts_table', 1),
(11, '2017_06_03_134336_create_password_resets_table', 1),
(12, '2017_06_03_134337_create_user_meta_table', 1),
(13, '2017_06_03_134337_create_users_table', 1),
(14, '2017_06_03_134338_create_vehicles_table', 1),
(15, '2017_07_24_080439_create_customer_table', 1),
(16, '2017_07_24_080537_create_booking_table', 1),
(17, '2017_07_24_080643_create_settings_table', 1),
(18, '2017_08_01_073926_create_booking_income_table', 1),
(19, '2017_10_30_064357_create_notifications_table', 1),
(20, '2017_10_30_094858_create_fuel_table', 1),
(21, '2017_11_15_120956_create_insurance_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mileage`
--

CREATE TABLE `mileage` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `mileage` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tp_ref` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parts_stock`
--

CREATE TABLE `parts_stock` (
  `id` int(10) UNSIGNED NOT NULL,
  `part_id` int(11) DEFAULT NULL,
  `price_eur` decimal(10,2) DEFAULT NULL,
  `price_local` decimal(10,2) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transport` double NOT NULL,
  `customs` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `part_trans`
--

CREATE TABLE `part_trans` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `cost` double(10,2) NOT NULL DEFAULT '0.00',
  `date` date DEFAULT NULL,
  `part_serial` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mileage` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `total` double(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `label`, `name`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Website Name', 'app_name', 'Fleet Manager', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 'Business Name', 'business_name', 'Fleet Company', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(3, 'Business Address 1', 'badd1', 'Company Address 1', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(4, 'Business Address 2', 'badd2', 'Company Address 2', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(5, 'Email Address', 'email', 'master@admin.com', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(6, 'City', 'city', 'Bhavnagar', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(7, 'State', 'state', 'Gujarat', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(8, 'Country', 'country', 'India', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(9, 'Language', 'language', 'en', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(10, 'Currency', 'currency', '₹', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(11, 'TAX NO', 'tax_no', 'ABCD8735XXX', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(12, 'SMALL LOGO', 'icon_img', 'logo-40.png', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(13, 'MAIN LOGO', 'logo_img', 'logo.png', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Administrator', 'master@admin.com', '$2y$10$J4.PFWyuAxulzaFzv.O1p.1LKbIbLTba5Whqc4rZ176/.YGw8vLde', 'S', 'gnqPZ4Mp2r6CvCvydTlLo1Ju9N0hAa5pnaqVmQhHyFisvt56FjQPqneC4nzZ', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 'User One', 'user1@admin.com', '$2y$10$wATgl5jC/AdvdWvhC8Sm4OcueYtWzarK2Bbhmq0dFlzdXK3tLryoi', 'O', NULL, '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(3, 'User Two', 'user2@admin.com', '$2y$10$hdh7bO0Cp88UOLg/H4u3U.IeoA7eV0FrLwG/pq3pQ.vUHuV9Hf52q', 'O', NULL, '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(4, 'Coleman VonRueden', 'graham.sabina@example.net', '$2y$10$VE2oT1KOOH6uVHJQdiZRL./W2wvbLXzgwFgoAJQPscFSL5C7FlPSi', 'D', 'yRF3LXwg6o', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(5, 'Bernice Howe', 'braun.dario@example.net', '$2y$10$VE2oT1KOOH6uVHJQdiZRL./W2wvbLXzgwFgoAJQPscFSL5C7FlPSi', 'D', 'NI10RJzdNz', '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(6, 'Caleb Otieno', 'cotieno01@gmail.com', '$2y$10$bv4tojQU1CK5vrUQfGbSte/TPlrTAMQTOb75aoX7Wc8gtgS8EkyD2', 'D', NULL, '2018-04-26 21:47:15', '2018-04-26 21:47:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `license_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `emp_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contract_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documents` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `econtact` text COLLATE utf8_unicode_ci,
  `license_image` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_image` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`id`, `user_id`, `first_name`, `last_name`, `middle_name`, `address`, `phone`, `issue_date`, `license_number`, `exp_date`, `start_date`, `end_date`, `emp_id`, `contract_number`, `documents`, `econtact`, `license_image`, `profile_image`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'Coleman', 'VonRueden', NULL, '28577 Cassandre Stream Apt. 272\nPredovicport, FL 08726-2332', '+6457823381280', '2018-04-26', '722360', '2019-04-26', '2018-04-26', '2018-05-26', '135569', '3490', NULL, NULL, NULL, NULL, 1, '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(2, 5, 'Bernice', 'Howe', NULL, '588 Lempi Rest\nNorth Evalyntown, VT 37858-4632', '+7751609667748', '2018-04-26', '842678', '2019-04-26', '2018-04-26', '2018-05-26', '79735592', '5997', NULL, NULL, NULL, NULL, 1, '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL),
(3, 6, 'Caleb', 'Otieno', 'Oduor', '39486-00623 Park Suites opp Parklands Police', '0722569204', '2018-04-01', '24702381', '2018-06-30', '2018-04-01', '2018-05-31', '2334', '900', NULL, NULL, NULL, NULL, 1, '2018-04-26 21:47:15', '2018-04-26 21:47:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `make` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lic_exp_date` date NOT NULL,
  `reg_exp_date` date NOT NULL,
  `vehicle_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engine_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `horse_power` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `license_plate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mileage` int(11) DEFAULT NULL,
  `in_service` tinyint(4) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `int_mileage` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `make`, `model`, `type`, `year`, `lic_exp_date`, `reg_exp_date`, `vehicle_image`, `engine_type`, `horse_power`, `color`, `vin`, `license_plate`, `mileage`, `in_service`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `int_mileage`) VALUES
(1, 'Honda', 'Jazz', 'TESDF', '2015', '2019-01-01', '2018-09-23', NULL, 'Petrol', '190', 'black', '2342342', '9191bh', 45464, 1, 1, '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 50),
(2, 'Tata', 'NANO', 'car', '2012', '2019-04-26', '2018-07-25', NULL, 'Petrol', '150', 'red', '124578', '1245ab', 45464, 1, 1, '2018-04-26 09:21:39', '2018-04-26 09:21:39', NULL, 40),
(3, 'Mercedes', 'Actros', 'Tarailer', '2010', '2018-08-31', '2018-08-31', NULL, 'Diesel', '500', 'White', '6767', 'KCN 505Y', NULL, 1, 1, '2018-04-26 21:51:23', '2018-04-26 21:51:23', NULL, 1500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acquisition`
--
ALTER TABLE `acquisition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_income`
--
ALTER TABLE `booking_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_cat`
--
ALTER TABLE `expense_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income_cat`
--
ALTER TABLE `income_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintanance`
--
ALTER TABLE `maintanance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mileage`
--
ALTER TABLE `mileage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts_stock`
--
ALTER TABLE `parts_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_trans`
--
ALTER TABLE `part_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acquisition`
--
ALTER TABLE `acquisition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_income`
--
ALTER TABLE `booking_income`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_cat`
--
ALTER TABLE `expense_cat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fuel`
--
ALTER TABLE `fuel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income_cat`
--
ALTER TABLE `income_cat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `maintanance`
--
ALTER TABLE `maintanance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mileage`
--
ALTER TABLE `mileage`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parts_stock`
--
ALTER TABLE `parts_stock`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `part_trans`
--
ALTER TABLE `part_trans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
