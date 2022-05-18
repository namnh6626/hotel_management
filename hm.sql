-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2022 at 11:07 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `management_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `bill_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_payment` datetime DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cus_id` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `deposit` decimal(7,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`bill_id`, `bill_name`, `date_payment`, `user_id`, `cus_id`, `note`, `created_at`, `updated_at`, `is_paid`, `deposit`) VALUES
(1, 'TTP1', '2021-12-06 14:18:23', 1, 2, 'Ghi chú', NULL, NULL, 1, '0'),
(2, 'TTP2', '2021-12-06 14:18:23', 2, 1, 'Ghi chú', NULL, NULL, 1, '0'),
(3, 'TTP3', '2021-12-14 21:09:41', 1, 1, 'Ghi chú', NULL, NULL, 1, '0'),
(4, 'TTP4', '2021-12-14 21:09:41', 2, 2, 'Ghi chú', NULL, NULL, 1, '0'),
(5, 'TTP5', '2022-01-21 17:45:03', 3, 2, 'Ghi chú', '2022-01-03 08:54:12', '2022-01-21 03:54:39', 1, '0'),
(6, 'TTP6', '2022-02-02 23:04:42', 1, 2, 'Ghi chú', '2022-01-03 08:55:08', '2022-01-03 08:55:08', 0, '0'),
(7, 'TTP7', '2022-01-31 16:38:20', 1, 2, 'Ghi chú', '2022-01-03 08:55:32', '2022-01-03 08:55:32', 1, '0'),
(8, 'TTP8', '2022-02-03 23:04:51', 3, 155, 'Ghi chú', '2022-01-17 08:55:00', '2022-01-17 08:55:00', 0, '0'),
(9, 'TTP9', '2022-02-09 23:04:55', 3, 155, 'Ghi chú', '2022-01-17 08:56:08', '2022-01-17 08:56:08', 0, '1000000'),
(10, 'TTP10', '2022-02-15 20:30:49', 3, 32, 'Ghi chú', '2022-01-21 10:03:01', '2022-01-21 10:03:01', 1, '1000000'),
(23, 'TTP23', '2022-02-01 23:05:09', 3, 2, 'Ghi chú', '2022-02-14 17:57:46', '2022-02-14 17:57:46', 0, '0'),
(24, 'TTP24', '2022-02-15 23:04:58', 3, 2, 'Ghi chú', '2022-02-14 18:08:41', '2022-02-14 18:08:41', 0, '0'),
(25, 'TTP25', '2022-02-03 23:05:01', 3, 2, 'Ghi chú', '2022-02-15 13:30:21', '2022-02-15 13:30:21', 0, '0'),
(26, 'TTP26', '2022-02-15 20:56:07', 3, 2, 'Ghi chú', '2022-02-15 13:55:54', '2022-02-15 13:55:54', 1, '0'),
(27, 'TTP27', '2022-02-15 20:57:17', 3, 2, 'Ghi chú', '2022-02-15 13:56:24', '2022-02-15 13:56:24', 1, '0'),
(28, 'TTP28', NULL, 3, 10, 'Ghi chú', '2022-02-15 14:10:46', '2022-02-15 14:10:46', 0, '1000000'),
(29, 'TTP29', NULL, 3, 2, 'Ghi chú', '2022-02-15 14:12:43', '2022-02-15 14:12:43', 0, '0'),
(30, 'TTP30', NULL, 3, 17, 'Ghi chú', '2022-02-15 14:29:47', '2022-02-15 14:29:47', 0, '500000'),
(31, 'TTP31', NULL, 3, 17, 'Ghi chú', '2022-02-15 14:39:29', '2022-02-15 14:39:29', 0, '0'),
(32, 'TTP32', NULL, 3, 153, 'Ghi chú', '2022-02-15 14:59:57', '2022-02-15 14:59:57', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `cus_id` bigint(20) UNSIGNED NOT NULL,
  `is_checkin` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_booking` datetime DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` decimal(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `cus_id`, `is_checkin`, `user_id`, `date_booking`, `note`, `deposit`) VALUES
(1, 1, 1, 3, '2022-01-04 09:24:38', NULL, '0'),
(2, 1, 1, 1, '2022-01-05 09:24:44', NULL, '0'),
(3, 3, 1, 2, '2022-01-02 09:24:48', NULL, '0'),
(4, 2, 1, 2, '2022-01-01 09:24:51', NULL, '0'),
(6, 2, 1, 2, '2022-01-04 09:24:57', NULL, '0'),
(7, 2, 1, 2, '2022-01-06 09:25:00', NULL, '0'),
(8, 2, 1, 2, '2022-01-09 09:25:03', NULL, '0'),
(9, 2, 1, 3, '2022-01-10 09:25:05', NULL, '0'),
(16, 2, 1, 3, '2022-01-14 21:16:43', NULL, '0'),
(18, 32, 0, 3, '2022-02-15 22:05:58', NULL, '0'),
(19, 53, 0, 3, '2022-02-15 22:07:20', 'note', '500000'),
(20, 201, 0, 3, '2022-02-15 22:09:43', 'note', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `budget_id` bigint(20) UNSIGNED NOT NULL,
  `budget_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`budget_id`, `budget_name`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'Tiền mặt', '99000000', '2022-01-06 03:20:44', '2022-01-06 03:29:24'),
(2, 'Tài khoản ngân hàng', '110000000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budget_invoices`
--

CREATE TABLE `budget_invoices` (
  `budget_invoice_id` bigint(20) UNSIGNED NOT NULL,
  `budget_invoice_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_of_money` decimal(9,0) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `budget_id` bigint(20) UNSIGNED NOT NULL,
  `date_created_invoice` datetime NOT NULL,
  `invoice_note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `budget_invoice_type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_invoices`
--

INSERT INTO `budget_invoices` (`budget_invoice_id`, `budget_invoice_name`, `amount_of_money`, `user_id`, `budget_id`, `date_created_invoice`, `invoice_note`, `created_at`, `updated_at`, `budget_invoice_type_id`) VALUES
(1, 'PNQ1', '1000000', 3, 1, '2022-01-06 16:29:04', 'Ghi chu', '2022-01-06 09:29:04', '2022-01-06 09:29:04', 1),
(2, 'PNQ2', '1000000', 1, 1, '2022-01-06 16:30:19', 'Ghi chu', '2022-01-06 09:30:19', '2022-01-06 13:44:38', 1),
(3, 'PNQ3', '10000000', 3, 1, '2022-01-29 16:14:43', 'noteeeee', '2022-01-29 09:14:43', '2022-01-29 09:14:43', 1),
(4, 'PXQ4', '1000000', 3, 1, '2022-01-29 20:33:23', 'noteeeeeeeee', '2022-01-29 13:33:23', '2022-01-29 13:33:23', 2),
(5, 'PNQ5', '1000000', 3, 1, '2022-01-29 20:49:20', 'noteeeeeee', '2022-01-29 13:49:20', '2022-01-29 13:49:20', 1),
(6, 'PNQ6', '12000000', 2, 2, '2022-01-29 20:49:34', 'noteeeeeee', '2022-01-29 13:49:34', '2022-01-29 16:20:44', 1),
(7, 'PNQ7', '1000000', 3, 1, '2022-01-31 20:50:43', 'noteeeeeee', '2022-01-29 13:50:43', '2022-01-29 13:50:43', 1),
(8, 'PXQ8', '1000000', 3, 1, '2022-02-11 16:37:57', 'chi sửa phòng 203', '2022-02-11 09:37:57', '2022-02-11 09:37:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `budget_invoice_types`
--

CREATE TABLE `budget_invoice_types` (
  `budget_invoice_type_id` bigint(20) UNSIGNED NOT NULL,
  `budget_invoice_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_invoice_types`
--

INSERT INTO `budget_invoice_types` (`budget_invoice_type_id`, `budget_invoice_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Hóa đơn nhập quỹ', '2022-01-06 03:39:11', '2022-01-06 03:39:11'),
(2, 'Hóa đơn xuất quỹ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` bigint(20) UNSIGNED NOT NULL,
  `cus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `citizen_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `genre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_name`, `phone`, `cus_email`, `citizen_id`, `created_at`, `updated_at`, `genre_id`, `address`, `date_of_birth`) VALUES
(1, 'customer 1', '515462213', 'A@hmail.com', '2235569', NULL, '2022-01-04 14:47:30', 2, 'ADFEWQ', '1990-10-23'),
(2, 'cus 2', '1235', 'd@hn.com', '963258', NULL, NULL, 1, 'ADFEWQ', '1990-10-23'),
(3, 'Ramona Schneider DDS', '540.229.9089', 'alessandra.bosco@example.org', '203', '2021-12-12 02:13:56', '2022-01-05 02:36:02', 2, 'ADFEWQ', '1990-10-23'),
(4, 'Quentin Ortiz', '+1-201-838-9896', 'ywiegand@example.net', '518', '2021-12-12 02:13:56', '2021-12-12 02:13:56', 1, 'ADFEWQ', '1990-10-23'),
(6, 'Dr. Lucinda Bechtelar DDS', '601.743.8290', 'vita.robel@example.net', '624', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(7, 'Jaydon Kuhn I', '(806) 950-1959', 'rhiannon.feeney@example.org', '353', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 2, 'ADFEWQ', '1990-10-23'),
(8, 'Mr. Michael Schuppe', '+1 (413) 795-1758', 'rice.foster@example.com', '515', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(9, 'Nicola Cruickshank', '484-251-8295', 'tcruickshank@example.org', '919', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 2, 'ADFEWQ', '1990-10-23'),
(10, 'Ms. Lavinia Turcotte Jr.', '740-463-8612', 'halle.jones@example.com', '922', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(11, 'Dr. Kelley Gulgowski PhD', '1-518-940-8170', 'johnson.ricardo@example.org', '789', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 2, 'ADFEWQ', '1990-10-23'),
(12, 'Myrna Hodkiewicz', '689-380-4519', 'madie.gutkowski@example.com', '958', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(13, 'Ryan Kris', '+1.386.755.5566', 'bonita.parisian@example.net', '419', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 2, 'ADFEWQ', '1990-10-23'),
(14, 'Prof. Kirk Langworth', '434.274.3165', 'hammes.charity@example.org', '604', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(15, 'Erin Lubowitz', '910.296.6296', 'melvin09@example.com', '914', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 2, 'ADFEWQ', '1990-10-23'),
(16, 'Dr. Torrance Stark', '1-445-726-0042', 'gschulist@example.net', '152', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(17, 'Annie Gibson DDS', '+1 (712) 862-3879', 'wiegand.liam@example.net', '949', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 2, 'ADFEWQ', '1990-10-23'),
(18, 'Dr. Lexus Witting MD', '864.956.0894', 'john.ondricka@example.org', '158', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(19, 'Tristian Tromp', '1-283-687-3378', 'blockman@example.net', '348', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 2, 'ADFEWQ', '1990-10-23'),
(20, 'Ashton Prohaska', '+1.678.385.0347', 'kris.callie@example.com', '335', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(21, 'Prof. Brennon Vandervort V', '+15397836144', 'wilderman.gene@example.net', '038', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 2, 'ADFEWQ', '1990-10-23'),
(22, 'Hank Jacobs', '1-972-957-0487', 'jconn@example.com', '425', '2021-12-12 02:13:57', '2021-12-12 02:13:57', 1, 'ADFEWQ', '1990-10-23'),
(23, 'Ashtyn McCullough', '303.876.6868', 'orlo.schuster@example.org', '609', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(24, 'Mark Becker', '1-561-357-7188', 'agerlach@example.net', '435', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(25, 'Horace Jenkins', '1-445-863-6642', 'quigley.felton@example.com', '723', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(26, 'Dr. Tod Pfeffer II', '678-256-2093', 'zsenger@example.org', '279', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(27, 'Aniya Bradtke', '480-655-9840', 'idare@example.com', '073', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(28, 'Bonnie Funk', '+1.351.882.4702', 'leonora.lemke@example.net', '734', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(29, 'Dr. Johnnie Goodwin', '1-562-913-8497', 'brenden95@example.com', '254', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(30, 'Ms. Litzy Ratke DVM', '+1 (413) 958-8327', 'kenneth53@example.net', '306', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(31, 'Hoyt Schimmel', '364-793-3478', 'kling.priscilla@example.net', '102', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(32, 'Barton Mayert', '530-966-4121', 'ccremin@example.net', '325', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(33, 'Mr. Wilfrid Lemke', '+1-818-558-4449', 'ned.dickens@example.net', '640', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(34, 'Prof. Michel Little Sr.', '276.880.7120', 'romaguera.warren@example.net', '312', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(35, 'Marlen Armstrong DDS', '+1-820-961-7834', 'bayer.kaleigh@example.net', '031', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(36, 'Margarette Zboncak Jr.', '678.891.8144', 'vcollins@example.net', '537', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(37, 'Celestino Prohaska', '+1 (580) 552-6421', 'kertzmann.brielle@example.org', '305', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(38, 'Breanne Anderson I', '830-921-8289', 'kwaelchi@example.org', '746', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(39, 'Marlee Crooks', '+16065332350', 'dusty.durgan@example.net', '887', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(40, 'Mrs. Alysa McGlynn I', '(520) 603-7804', 'emory83@example.com', '018', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(41, 'Mr. Blake Kassulke', '828-779-2645', 'emmett28@example.org', '658', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(42, 'Ms. Larissa Koelpin PhD', '(540) 935-9584', 'shaniya71@example.com', '006', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(43, 'Samara Thiel', '551.553.4022', 'cbalistreri@example.net', '570', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(44, 'Mittie Wilderman', '1-351-498-4548', 'janice07@example.org', '218', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 1, 'ADFEWQ', '1990-10-23'),
(45, 'Beulah Medhurst', '458.289.6323', 'zemlak.linnie@example.net', '636', '2021-12-12 02:13:58', '2021-12-12 02:13:58', 2, 'ADFEWQ', '1990-10-23'),
(46, 'Prof. Jarrett Orn I', '1-386-949-1934', 'tessie.pfannerstill@example.com', '759', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(47, 'Mr. Wilfredo Aufderhar', '+1-650-666-5701', 'pzboncak@example.net', '718', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(48, 'Luna Sawayn', '520-385-5507', 'tiffany.conn@example.org', '344', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(49, 'Rosemarie Ernser', '1-857-472-2923', 'jadyn31@example.org', '720', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(50, 'Anthony Stanton', '(941) 901-1333', 'uruecker@example.net', '853', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(51, 'Clifton Armstrong', '+1 (754) 239-1963', 'jewel.heidenreich@example.org', '315', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(52, 'Ms. Cheyenne Feil DVM', '865-909-6342', 'cormier.crystal@example.com', '678', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(53, 'Joshua Hill', '682-460-9548', 'marcellus.dooley@example.com', '358', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(54, 'Quincy Runte PhD', '1-929-727-0293', 'rmarquardt@example.org', '556', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(55, 'Tia Barton', '+1-785-267-2813', 'justice.abbott@example.net', '766', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(56, 'Toby Kreiger', '1-458-345-5398', 'bgraham@example.org', '820', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(57, 'Molly Langosh Sr.', '(612) 701-9695', 'helena.west@example.org', '590', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(58, 'Ms. Desiree Witting DVM', '+1 (754) 325-1568', 'idell.wuckert@example.net', '450', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(59, 'Donny Lakin', '667-757-2913', 'oconnell.estrella@example.org', '839', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(60, 'Providenci Lehner', '1-757-735-1584', 'ostanton@example.net', '863', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(61, 'Randall O\'Hara MD', '1-801-485-2699', 'bettye.beier@example.net', '968', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(62, 'Ryley O\'Hara', '334.417.7451', 'will.hassie@example.com', '011', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(63, 'Dr. Brayan Durgan', '254.210.0712', 'brody.wyman@example.net', '148', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 2, 'ADFEWQ', '1990-10-23'),
(64, 'Trever Dare', '(216) 441-1082', 'yroberts@example.org', '998', '2021-12-12 02:13:59', '2021-12-12 02:13:59', 1, 'ADFEWQ', '1990-10-23'),
(65, 'Prof. Sarina Emmerich', '+1-415-480-2820', 'imelda50@example.net', '161', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(66, 'Ms. Allison Lind', '+14322176265', 'keeling.alfred@example.com', '104', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(67, 'Mr. Jaquan Rutherford', '341-574-9709', 'doyle.zaria@example.net', '682', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(68, 'Eli Okuneva', '1-740-510-4796', 'rowan01@example.net', '996', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(69, 'Myah King', '+1.305.944.7220', 'rebekah14@example.net', '548', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(70, 'Stacey Abshire', '848-956-7932', 'bashirian.marley@example.org', '094', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(71, 'Ada Dickens', '786-536-1387', 'bethel.beier@example.com', '601', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(72, 'Linda Morissette', '(657) 332-8381', 'howell.arvel@example.com', '905', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(73, 'Brooks Kassulke', '682-695-6150', 'avis10@example.org', '901', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(74, 'Prof. Jerry Stoltenberg V', '+1-731-550-6227', 'corene.koss@example.org', '091', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(75, 'Mr. Ulices Tillman Jr.', '850-944-8640', 'amelie.quitzon@example.com', '009', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(76, 'Ola Williamson', '540.524.6758', 'labadie.chris@example.org', '259', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(77, 'Katlyn Braun', '380-568-4057', 'nasir.leffler@example.com', '404', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(78, 'Jermaine Hegmann', '463.233.0662', 'alayna31@example.net', '433', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(79, 'Jay Dach', '(760) 573-8963', 'jast.charlotte@example.com', '049', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(80, 'Prof. Kali Stark', '+1-564-673-7923', 'cronin.mable@example.com', '319', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(81, 'Camila D\'Amore', '+1-972-377-5822', 'raynor.evans@example.com', '911', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 2, 'ADFEWQ', '1990-10-23'),
(82, 'Dr. Anissa Tillman I', '1-979-995-0445', 'hzulauf@example.org', '930', '2021-12-12 02:14:00', '2021-12-12 02:14:00', 1, 'ADFEWQ', '1990-10-23'),
(83, 'Rahsaan Murphy', '(445) 666-2677', 'allen.littel@example.org', '179', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(84, 'Prof. Jennie Steuber', '+1.947.398.7813', 'laron78@example.net', '409', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(85, 'Cristal Sporer', '(410) 868-0762', 'jaylon01@example.org', '727', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(86, 'Jedidiah Lindgren', '469.335.7418', 'ernser.willy@example.com', '704', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(87, 'Ms. Dina Wiegand Jr.', '+1 (661) 983-9273', 'collier.eleanora@example.com', '912', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(88, 'Dr. Sadie Gorczany', '+1 (240) 479-2043', 'willms.anahi@example.net', '115', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(89, 'Ines Shields', '+1-951-253-1219', 'ylangworth@example.net', '827', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(90, 'Miss Angeline Hegmann', '364-464-3098', 'lbechtelar@example.org', '080', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(91, 'Carlotta Heaney', '(832) 269-8360', 'mkris@example.net', '193', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(92, 'Lenora Borer', '(352) 924-5440', 'reta.auer@example.com', '916', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(93, 'Miss Marianna Lemke', '(380) 625-9999', 'maeve.hahn@example.net', '593', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(94, 'Trenton Haag I', '(214) 995-3082', 'dena14@example.net', '327', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(95, 'Dr. Alberta Rutherford V', '+19196444750', 'coralie.langworth@example.net', '588', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(96, 'Lee Carroll', '+1.812.718.0401', 'reynolds.ahmad@example.org', '378', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(97, 'Muhammad Gulgowski IV', '202-784-8388', 'godfrey.oreilly@example.org', '787', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(98, 'Mr. Ahmed Luettgen DVM', '346.895.7087', 'tomas18@example.net', '363', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(99, 'Leonora Heller III', '+1.330.701.6705', 'susanna.johnson@example.com', '087', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(100, 'Carolyn Marks', '+1.272.738.4521', 'mann.aidan@example.com', '264', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(101, 'Lue Cremin', '762-691-3613', 'mpaucek@example.org', '126', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(102, 'Prof. Makenna Fadel', '+1-432-792-9400', 'shoppe@example.com', '526', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(103, 'Ms. Loma Dooley DVM', '+1-512-846-6732', 'arnulfo65@example.net', '954', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(104, 'Carolina Runolfsdottir', '+1-520-697-5152', 'rowe.virgie@example.org', '118', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(105, 'Miss Alysha Schulist II', '+1-520-302-6955', 'wtorp@example.org', '933', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(106, 'Susanna Bashirian', '1-612-599-5663', 'marshall61@example.net', '213', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(107, 'Carmela Leannon III', '612-986-1165', 'psipes@example.org', '665', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(108, 'Anthony Prosacco', '726.864.6604', 'maria52@example.com', '724', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 1, 'ADFEWQ', '1990-10-23'),
(109, 'Prof. Giles Beier', '+1 (984) 685-0186', 'brandyn.cartwright@example.net', '717', '2021-12-12 02:14:01', '2021-12-12 02:14:01', 2, 'ADFEWQ', '1990-10-23'),
(110, 'Edgar Conroy', '(540) 677-2556', 'yasmeen.mcclure@example.org', '017', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(111, 'Mozell Wintheiser', '(910) 913-4749', 'vbartoletti@example.net', '976', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 2, 'ADFEWQ', '1990-10-23'),
(112, 'Gerardo Sawayn', '(574) 705-1099', 'zskiles@example.com', '163', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(113, 'Mr. Sofia Kuhlman', '341-876-1887', 'arden71@example.com', '878', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 2, 'ADFEWQ', '1990-10-23'),
(114, 'Eudora Legros', '1-435-515-9997', 'malvina.bauch@example.com', '002', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(115, 'Miss Nannie Stamm Jr.', '1-501-640-4531', 'gabriel29@example.com', '332', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 2, 'ADFEWQ', '1990-10-23'),
(116, 'Dr. Rickey Zboncak', '+1 (571) 805-1580', 'quinton87@example.net', '962', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(117, 'Stephon Runolfsdottir', '+16786750366', 'nienow.wilford@example.net', '877', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 2, 'ADFEWQ', '1990-10-23'),
(118, 'Dr. Clementine Kunde V', '351-226-8280', 'albina.pfeffer@example.org', '231', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(119, 'Dr. Carmelo Mosciski', '(726) 398-7969', 'eli37@example.net', '683', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 2, 'ADFEWQ', '1990-10-23'),
(120, 'Liza Lang', '1-631-499-7553', 'francesca.koch@example.com', '917', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(121, 'Breanna Fadel', '(949) 261-1537', 'ressie92@example.net', '040', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 2, 'ADFEWQ', '1990-10-23'),
(122, 'Arch Kuphal', '757-841-4998', 'cecelia31@example.net', '773', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(123, 'Earl Padberg', '1-269-269-1590', 'laverne.toy@example.org', '298', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 2, 'ADFEWQ', '1990-10-23'),
(124, 'Otto Mante', '+1.308.333.3325', 'ibeier@example.org', '106', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(125, 'Mrs. Lelia Gislason', '(909) 661-2947', 'eichmann.elenor@example.org', '650', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 2, 'ADFEWQ', '1990-10-23'),
(126, 'Pinkie Murray', '678.448.4931', 'ncasper@example.org', '947', '2021-12-12 02:14:02', '2021-12-12 02:14:02', 1, 'ADFEWQ', '1990-10-23'),
(127, 'Mary Langosh', '630-963-0853', 'istokes@example.com', '062', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(128, 'Mrs. Adaline Paucek DVM', '1-913-538-8135', 'reyna.lowe@example.com', '278', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 1, 'ADFEWQ', '1990-10-23'),
(129, 'Dr. Barton Dietrich', '534-851-5997', 'brook.wisoky@example.org', '252', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(130, 'Winifred Ruecker', '870.510.4791', 'elmo.lockman@example.org', '648', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 1, 'ADFEWQ', '1990-10-23'),
(131, 'Kendra Hintz DVM', '+1.763.273.6215', 'amara26@example.com', '815', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(132, 'Fleta Fisher II', '+1.651.757.9224', 'dillan43@example.org', '240', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 1, 'ADFEWQ', '1990-10-23'),
(133, 'Carroll Bartoletti', '832-950-4586', 'wabshire@example.com', '632', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(134, 'Josiane Von', '(703) 569-5990', 'mcclure.anjali@example.com', '858', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 1, 'ADFEWQ', '1990-10-23'),
(135, 'Willy Mills', '564.679.2628', 'frank50@example.com', '795', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(136, 'Hollie Labadie', '+1.620.639.6848', 'marcia.gaylord@example.net', '744', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 1, 'ADFEWQ', '1990-10-23'),
(137, 'Jazmin Grady', '971-772-9446', 'rodriguez.glennie@example.com', '981', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(138, 'Marley Leffler', '+1-260-254-2612', 'mark17@example.org', '626', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 1, 'ADFEWQ', '1990-10-23'),
(139, 'Meda Toy', '972.610.3276', 'felicity44@example.org', '956', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(140, 'Miss Lysanne Sawayn', '1-848-955-6568', 'banderson@example.com', '146', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 1, 'ADFEWQ', '1990-10-23'),
(141, 'Yoshiko Beahan', '(440) 562-6987', 'christ54@example.net', '044', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(142, 'Angus Grimes', '1-272-796-1484', 'lhermiston@example.net', '921', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 1, 'ADFEWQ', '1990-10-23'),
(143, 'Claudia Daniel', '731-785-3797', 'delilah41@example.org', '205', '2021-12-12 02:14:03', '2021-12-12 02:14:03', 2, 'ADFEWQ', '1990-10-23'),
(144, 'Clara Kessler', '+12486218357', 'rahul.wehner@example.net', '039', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(145, 'Maximillia Spinka I', '+1.843.254.5844', 'donato.bashirian@example.net', '395', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(146, 'Leola Douglas', '669.287.0432', 'maynard62@example.net', '485', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(147, 'Marie Ferry', '+1-267-618-9727', 'delbert01@example.net', '596', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(148, 'Tomas Franecki', '1-337-731-2730', 'lkuhn@example.org', '292', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(149, 'Dr. Art Johnston', '256-398-9354', 'wiegand.greyson@example.org', '082', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(150, 'Cordelia McClure V', '+1-914-396-3969', 'hwilliamson@example.org', '539', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(151, 'Carlee Okuneva', '757-289-4975', 'zemlak.alessandra@example.com', '206', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(152, 'Bethel Will', '+1-872-538-1455', 'guiseppe11@example.com', '010', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(153, 'Branson Lowe', '254-378-9809', 'bosco.zena@example.com', '123', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(154, 'Mrs. Laurine Little PhD', '(762) 853-8460', 'darien27@example.org', '140', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(155, 'Timothy Feeney', '+15748972359', 'qrodriguez@example.net', '774', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(156, 'Merle Nader V', '+16783060585', 'emmy.zulauf@example.net', '555', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(157, 'Mrs. Ramona Corkery', '(202) 732-1792', 'brice66@example.org', '672', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(158, 'Prof. Hilton Zboncak Sr.', '+1-361-962-5736', 'rlittel@example.net', '513', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(159, 'Prof. Toney Gutmann', '+17758743358', 'barney57@example.net', '408', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(160, 'Shaun Lubowitz', '+1-947-422-1222', 'labadie.mercedes@example.org', '966', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(161, 'Moshe Schoen', '620.786.6015', 'pablo.stehr@example.org', '036', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 2, 'ADFEWQ', '1990-10-23'),
(162, 'Dangelo Goodwin II', '+1.651.627.3977', 'lynch.seamus@example.org', '056', '2021-12-12 02:14:04', '2021-12-12 02:14:04', 1, 'ADFEWQ', '1990-10-23'),
(164, 'Bella O\'Connell', '845.910.6680', 'emard.winifred@example.com', '847', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(165, 'Anabelle Becker', '325.608.7699', 'meda.gulgowski@example.net', '350', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(166, 'Antwon Gerlach DVM', '623.509.5370', 'fred.daugherty@example.org', '321', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(167, 'Reymundo Heidenreich', '1-281-813-8489', 'nhartmann@example.com', '415', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(168, 'Dr. Elton Stehr I', '+13478132366', 'khudson@example.org', '467', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(169, 'Dr. Eldora Boyle II', '+1-740-871-6941', 'armstrong.jaiden@example.net', '227', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(170, 'Hortense Skiles', '253-880-9295', 'marlen34@example.net', '829', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(171, 'Anais Runolfsson III', '(936) 266-3894', 'karolann71@example.org', '068', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(172, 'Prof. Heaven Reichert IV', '949.249.9656', 'mraz.gloria@example.org', '782', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(173, 'Emmett Rau', '938-588-6491', 'kiehn.sabryna@example.com', '769', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(174, 'Billy Nitzsche', '+1-928-427-7269', 'yeichmann@example.org', '157', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(175, 'Pierce Mann Sr.', '657-539-1265', 'kylie.reichel@example.org', '995', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(176, 'Baby Rodriguez DDS', '1-346-991-9347', 'saige.kutch@example.net', '994', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(177, 'Prof. Melvina Haag MD', '(458) 495-8378', 'francisca19@example.com', '410', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(178, 'Dortha Franecki', '+14257131791', 'caroline.konopelski@example.org', '198', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(179, 'Mrs. Antonina Goldner', '+1-334-947-4633', 'aaliyah75@example.org', '251', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(180, 'Miss Adrianna Kohler', '531-364-1876', 'schinner.fern@example.com', '622', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(181, 'Quinton Koch', '352-897-2397', 'bartell.leilani@example.org', '137', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(182, 'Alyson Morar', '1-754-679-3642', 'mozelle.daniel@example.org', '143', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(183, 'Emerson Kunze Sr.', '(325) 953-6927', 'mikel.boehm@example.com', '613', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(184, 'Teagan Kulas', '805-546-4800', 'lindsey59@example.net', '543', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(185, 'Alvis Gaylord', '717.971.3409', 'brody.eichmann@example.com', '753', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(186, 'Anais Ebert', '650-991-1713', 'kuhlman.catherine@example.net', '833', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(187, 'Amie Botsford', '+1-726-529-7675', 'stamm.urban@example.org', '301', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 2, 'ADFEWQ', '1990-10-23'),
(188, 'Noemi Smitham', '812.708.4229', 'travis.mraz@example.net', '003', '2021-12-12 02:14:05', '2021-12-12 02:14:05', 1, 'ADFEWQ', '1990-10-23'),
(189, 'Adolf Funk Jr.', '989-898-6900', 'lyric25@example.net', '033', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 2, 'ADFEWQ', '1990-10-23'),
(190, 'Prof. Earnestine Osinski', '680.466.0287', 'zstamm@example.com', '749', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 1, 'ADFEWQ', '1990-10-23'),
(191, 'Ms. Cassandra Barton', '+1-469-294-4516', 'florencio82@example.com', '465', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 2, 'ADFEWQ', '1990-10-23'),
(192, 'Mr. Rey Sauer', '+1-838-954-3388', 'vabernathy@example.org', '442', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 1, 'ADFEWQ', '1990-10-23'),
(193, 'Cynthia Carter', '+13852344272', 'lakin.florida@example.com', '225', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 2, 'ADFEWQ', '1990-10-23'),
(194, 'Dora Lehner', '323-659-6332', 'dee84@example.com', '338', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 1, 'ADFEWQ', '1990-10-23'),
(195, 'Ms. Kallie Greenholt', '678-471-5372', 'jerde.chase@example.com', '267', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 2, 'ADFEWQ', '1990-10-23'),
(196, 'Keyshawn Ledner', '+19596992989', 'brenden.grady@example.net', '437', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 1, 'ADFEWQ', '1990-10-23'),
(197, 'Benny Champlin', '1-651-839-5534', 'boyle.scotty@example.com', '405', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 2, 'ADFEWQ', '1990-10-23'),
(198, 'Hazel Dickinson', '1-614-818-7205', 'quinn04@example.com', '303', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 1, 'ADFEWQ', '1990-10-23'),
(199, 'Nikolas Collins Sr.', '734-438-1479', 'bvon@example.net', '184', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 2, 'ADFEWQ', '1990-10-23'),
(200, 'Ms. Wanda Simonis', '651.236.1613', 'loraine47@example.com', '884', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 1, 'ADFEWQ', '1990-10-23'),
(201, 'Cleora Gislason', '+1-727-294-4899', 'fmonahan@example.com', '135', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 2, 'ADFEWQ', '1990-10-23'),
(202, 'Haley Shields Jr.', '341-517-4823', 'uwolff@example.com', '623', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 1, 'ADFEWQ', '1990-10-23'),
(203, 'Mr. Brown Hudson', '678-460-0476', 'talia63@example.com', '509', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 2, 'ADFEWQ', '1990-10-23'),
(204, 'Erich Shanahan', '573.419.5086', 'alysa.schoen@example.com', '985', '2021-12-12 02:14:06', '2021-12-12 02:14:06', 1, 'ADFEWQ', '1990-10-23'),
(205, 'Ruth Zulauf', '+1 (806) 466-3204', 'evalyn06@example.com', '183', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 2, 'ADFEWQ', '1990-10-23'),
(206, 'Cheyanne Murphy', '1-205-680-6663', 'jkautzer@example.org', '549', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 1, 'ADFEWQ', '1990-10-23'),
(207, 'Abagail McDermottttt', '+13646888610', 'mwhite@example.org', '772', '2021-12-12 02:14:07', '2022-02-10 16:59:20', 1, 'ADFEWQ', '1990-10-23'),
(208, 'Jennings Green', '+12097978498', 'jskiles@example.com', '418', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 1, 'ADFEWQ', '1990-10-23'),
(209, 'Ila Walsh', '650.819.8040', 'scotty.murphy@example.net', '571', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 2, 'ADFEWQ', '1990-10-23'),
(210, 'Tatyana Pfannerstill', '+1-984-650-0747', 'patricia.beier@example.org', '058', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 1, 'ADFEWQ', '1990-10-23'),
(211, 'Mr. Adriel Nolan', '(765) 201-6808', 'norbert.rath@example.com', '874', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 2, 'ADFEWQ', '1990-10-23'),
(212, 'Ona Crooks', '(435) 904-3556', 'yskiles@example.net', '185', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 1, 'ADFEWQ', '1990-10-23'),
(213, 'Ryan Rutherford V', '1-913-460-2585', 'uking@example.org', '992', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 2, 'ADFEWQ', '1990-10-23'),
(214, 'Ms. Juana Deckow', '1-850-585-7610', 'monahan.baylee@example.net', '655', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 1, 'ADFEWQ', '1990-10-23'),
(215, 'Jake Borer', '1-754-791-7869', 'enos08@example.com', '740', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 2, 'ADFEWQ', '1990-10-23'),
(216, 'Jevon Bailey', '+1-470-431-7708', 'nboyle@example.org', '505', '2021-12-12 02:14:07', '2021-12-12 02:14:07', 1, 'ADFEWQ', '1990-10-23'),
(217, 'Dr. Marcel Raynor', '(858) 924-2046', 'kaya81@example.org', '638', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(218, 'Jerald Prosacco MD', '754-407-5451', 'teresa30@example.com', '520', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(219, 'Prof. Luella Konopelski', '1-743-801-5024', 'verdie92@example.com', '850', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(220, 'Mr. Casper Lehner', '914-979-6399', 'jeromy.lemke@example.net', '999', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(221, 'Sophie Tremblay', '(854) 669-8837', 'dee22@example.com', '989', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(222, 'Mr. Ellsworth Rice', '919.732.8916', 'aaron.macejkovic@example.com', '886', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(223, 'Dr. Emmet Ledner V', '+1 (458) 452-8447', 'robert.jenkins@example.net', '803', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(224, 'Monica Marquardt', '(801) 439-0740', 'arthur91@example.org', '339', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(225, 'Cheyenne Jerde', '+19599401258', 'arielle73@example.org', '078', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(226, 'Nathen Boehm IV', '+1-551-301-0303', 'uhickle@example.net', '263', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(227, 'Jennie Schmidt', '862.289.5070', 'bauch.berneice@example.org', '176', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(228, 'Prof. Tyson Stehr', '336-299-9315', 'kilback.sandy@example.org', '014', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(229, 'Theo Champlin DVM', '808-979-9367', 'felicia63@example.net', '367', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(230, 'Victor Stoltenberg', '1-316-844-7099', 'orie87@example.net', '819', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(231, 'Ari Daugherty V', '253-300-8880', 'donna.goyette@example.org', '529', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(232, 'Hayley Mosciski V', '(520) 644-5553', 'vicenta93@example.org', '454', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(233, 'Sierra Parker', '269-558-2581', 'hipolito.abernathy@example.net', '074', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(234, 'Prudence Mante', '+1 (956) 947-6603', 'alexis.nienow@example.net', '154', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(235, 'Halie Ortiz', '(484) 738-0309', 'vmetz@example.net', '237', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(236, 'Emilie Skiles', '+1-240-955-9783', 'carrie53@example.com', '814', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 1, 'ADFEWQ', '1990-10-23'),
(237, 'Dr. Billy Rogahn DDS', '1-614-802-7319', 'larkin.lenora@example.net', '285', '2021-12-12 02:14:08', '2021-12-12 02:14:08', 2, 'ADFEWQ', '1990-10-23'),
(238, 'Prof. Jayda Wehner', '(773) 981-7806', 'keven.daugherty@example.org', '215', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(239, 'Carey Beatty Jr.', '1-680-492-1725', 'daren55@example.com', '691', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 2, 'ADFEWQ', '1990-10-23'),
(240, 'Imogene Collier', '1-773-401-2129', 'vhills@example.com', '799', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(241, 'Monserrat Price', '+1.830.797.9053', 'vandervort.sarah@example.net', '633', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 2, 'ADFEWQ', '1990-10-23'),
(242, 'Miss Jackeline Wisozk IV', '+1.712.415.2977', 'qbergnaum@example.org', '760', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(243, 'Miss Tania Quitzon DDS', '269.291.2418', 'flegros@example.net', '608', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 2, 'ADFEWQ', '1990-10-23'),
(244, 'Jaylen Murray MD', '682-766-3363', 'jaeden59@example.net', '487', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(245, 'Alexandrine Hodkiewicz', '(814) 213-4029', 'vwehner@example.net', '669', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 2, 'ADFEWQ', '1990-10-23'),
(246, 'Hellen Bauch', '320-579-0673', 'vhuel@example.com', '423', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(247, 'Prof. Lance Will DDS', '+1.754.746.0460', 'dillon73@example.net', '076', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 2, 'ADFEWQ', '1990-10-23'),
(248, 'Leopold Schimmel', '(571) 448-8407', 'skuhic@example.com', '430', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(249, 'Mallie Kovacek', '1-934-715-7710', 'isidro62@example.org', '984', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 2, 'ADFEWQ', '1990-10-23'),
(250, 'Mrs. Lori Bernier IV', '614-535-4806', 'adrian.williamson@example.net', '383', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(251, 'Mabel Crona', '813.651.7702', 'aurelio.schinner@example.org', '805', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 2, 'ADFEWQ', '1990-10-23'),
(252, 'Prof. Herbert Legros II', '+1.678.789.3446', 'abner.bayer@example.org', '885', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(253, 'Kari Leuschke MD', '786.677.3363', 'tamia76@example.org', '441', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 2, 'ADFEWQ', '1990-10-23'),
(254, 'Giovanna Hammes', '636-980-5822', 'sherman@example.net', '097', '2021-12-12 02:14:09', '2021-12-12 02:14:09', 1, 'ADFEWQ', '1990-10-23'),
(255, 'Mrs. Jermaine King I', '(351) 963-5194', 'schamberger.alva@example.org', '684', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(256, 'Asha Boyer DDS', '630.805.2386', 'valentina98@example.org', '385', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(257, 'Prof. Randy Prosacco', '321-480-4453', 'daugherty.rebeka@example.org', '092', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(258, 'Juanita Abshire', '661-722-8802', 'evelyn.miller@example.net', '302', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(259, 'Dr. Cole Will IV', '1-283-788-3475', 'brock91@example.net', '807', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(260, 'Mrs. Tatyana Pollich V', '1-520-224-8734', 'dickens.esther@example.com', '330', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(261, 'Prof. Zella Volkman III', '970.760.5264', 'johnathan58@example.org', '562', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(262, 'Kendrick Gibson', '334-942-9177', 'cleta64@example.net', '416', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(263, 'America Botsford', '+1 (484) 319-4905', 'rashawn55@example.net', '219', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(264, 'Mr. Jayson Powlowski II', '+1-540-383-0958', 'helene17@example.org', '160', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(265, 'Elsa Kris', '+1-662-667-5652', 'nleffler@example.com', '271', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(266, 'Josephine Bartell II', '(817) 638-1179', 'lrempel@example.net', '258', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(267, 'Braulio Bosco III', '+1-727-783-0717', 'johnnie.ward@example.net', '169', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(268, 'Prof. Alisha Hartmann', '+12255303974', 'tromp.karl@example.net', '938', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(269, 'Zack Nader', '+1-283-499-9894', 'haag.kirstin@example.org', '698', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(270, 'Edgardo Wehner IV', '+1-870-783-1020', 'joanie.feil@example.net', '022', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(271, 'Godfrey Champlin', '+1.973.240.0979', 'dedric.hand@example.org', '042', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(272, 'Tyson Ernser', '1-281-565-1569', 'mabel69@example.org', '615', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(273, 'Emmie Bechtelar', '1-718-331-3038', 'cruickshank.tanner@example.org', '832', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(274, 'Dr. Foster Wolf', '+1-872-939-4489', 'amber34@example.com', '473', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(275, 'Mr. Monserrate Wuckert', '+1 (283) 943-0674', 'ivah.rippin@example.net', '192', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(276, 'Nikolas Becker', '+14257493857', 'icronin@example.com', '762', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(277, 'Payton Kuhlman', '+1-503-667-3365', 'ratke.alyce@example.net', '977', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 2, 'ADFEWQ', '1990-10-23'),
(278, 'Mr. Garrett Kohler', '1-561-326-8789', 'cole.herman@example.net', '229', '2021-12-12 02:14:10', '2021-12-12 02:14:10', 1, 'ADFEWQ', '1990-10-23'),
(279, 'Vivian Hane', '504.451.4340', 'preinger@example.org', '574', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 2, 'ADFEWQ', '1990-10-23'),
(280, 'Prof. Albert Rolfson Jr.', '1-585-217-8739', 'zoie44@example.org', '164', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 1, 'ADFEWQ', '1990-10-23'),
(281, 'Miss Citlalli Shanahan Sr.', '(267) 595-1269', 'anabelle.shields@example.org', '653', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 2, 'ADFEWQ', '1990-10-23'),
(282, 'Mr. Johnathon Jenkins', '+1-947-864-8346', 'rdooley@example.com', '579', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 1, 'ADFEWQ', '1990-10-23'),
(283, 'Daphney Schamberger', '+1-650-405-3881', 'eldridge89@example.com', '844', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 2, 'ADFEWQ', '1990-10-23'),
(284, 'Tressie Ritchie', '1-573-302-5209', 'lehner.shayna@example.org', '043', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 1, 'ADFEWQ', '1990-10-23'),
(285, 'Brandon Greenholt', '+1-623-437-1989', 'ullrich.fern@example.net', '403', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 2, 'ADFEWQ', '1990-10-23'),
(286, 'Mrs. Elta Deckow', '+1 (903) 658-5238', 'fisher.lina@example.com', '297', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 1, 'ADFEWQ', '1990-10-23'),
(287, 'Giuseppe Mills', '248-766-2621', 'kub.geo@example.net', '794', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 2, 'ADFEWQ', '1990-10-23'),
(288, 'Scarlett Gorczany', '1-480-545-2740', 'wmayer@example.net', '889', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 1, 'ADFEWQ', '1990-10-23'),
(289, 'Marina Zemlak', '657.564.0886', 'jwiza@example.com', '731', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 2, 'ADFEWQ', '1990-10-23'),
(290, 'Buster Pfannerstill', '1-848-422-9309', 'koss.jarod@example.org', '482', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 1, 'ADFEWQ', '1990-10-23'),
(291, 'Prof. Merritt Stoltenberg I', '313-886-6719', 'clemmie28@example.org', '504', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 2, 'ADFEWQ', '1990-10-23'),
(292, 'Mr. Owen O\'Reilly', '754-681-1029', 'epredovic@example.com', '242', '2021-12-12 02:14:11', '2021-12-12 02:14:11', 1, 'ADFEWQ', '1990-10-23'),
(293, 'Dr. Victor Blanda', '305-978-4498', 'taylor.brakus@example.com', '558', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 2, 'ADFEWQ', '1990-10-23'),
(294, 'Mertie Raynor', '+1-281-404-3710', 'jorge21@example.org', '226', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 1, 'ADFEWQ', '1990-10-23'),
(295, 'Giles Marquardt', '(925) 421-3138', 'dangelo.cremin@example.net', '151', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 2, 'ADFEWQ', '1990-10-23'),
(296, 'Corbin Mohr', '(743) 529-8127', 'christine01@example.org', '846', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 1, 'ADFEWQ', '1990-10-23'),
(297, 'Miss Haylee Christiansen I', '+18783253880', 'emily98@example.com', '174', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 2, 'ADFEWQ', '1990-10-23'),
(298, 'Peter Padberg II', '+1.727.478.4859', 'bdietrich@example.org', '758', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 1, 'ADFEWQ', '1990-10-23'),
(299, 'Mr. Lyric Schaefer', '+1.361.395.1548', 'samir27@example.com', '825', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 2, 'ADFEWQ', '1990-10-23'),
(300, 'Mr. Bailey Mayert PhD', '+1 (352) 341-8137', 'austen32@example.com', '387', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 1, 'ADFEWQ', '1990-10-23'),
(301, 'Lauriane Kulas', '(332) 214-7623', 'velda.hintz@example.org', '575', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 2, 'ADFEWQ', '1990-10-23'),
(302, 'Ms. Aida Huel DDS', '+1 (986) 848-9999', 'vgraham@example.com', '563', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 1, 'ADFEWQ', '1990-10-23'),
(303, 'Alvena Sawayn', '+1-475-763-3386', 'corine.kling@example.com', '951', '2021-12-12 02:14:12', '2021-12-12 02:14:12', 2, 'ADFEWQ', '1990-10-23'),
(304, 'Vicente Sanford IV', '+1.678.908.5870', 'enrico.hackett@example.com', '452', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(305, 'Prof. Rosario Kuhlman IV', '1-478-983-5469', 'jeramy.mills@example.net', '644', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(306, 'Lesly Toy', '(743) 429-6171', 'bryana.nienow@example.com', '471', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(307, 'Okey Parisian PhD', '(361) 954-5334', 'nyost@example.net', '392', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(308, 'Kristina Hammes', '+1.571.873.5079', 'ltoy@example.net', '725', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(309, 'Jacynthe Larson', '+1-706-402-6369', 'vena16@example.org', '681', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(310, 'Lora Mann', '+1.559.387.8031', 'hand.obie@example.net', '866', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(311, 'Alexandro Sipes', '629-204-1676', 'frederick89@example.org', '107', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(312, 'Dr. Alvis Anderson II', '667-319-2061', 'labadie.marcos@example.net', '380', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(313, 'Leonel Becker IV', '1-248-214-5631', 'kschroeder@example.com', '974', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(314, 'Eleanore Walker', '661-345-0117', 'clarissa77@example.org', '035', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(315, 'Zaria Stark', '863-930-0601', 'shakira73@example.net', '456', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(316, 'Gaylord Dicki', '1-602-767-7208', 'kblock@example.com', '475', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(317, 'Mrs. Rozella Schuster V', '786-416-6484', 'everett.ritchie@example.org', '445', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(318, 'Donnie Fay', '470-809-2921', 'upton.camylle@example.com', '089', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(319, 'Dianna Prosacco V', '+1-667-426-0496', 'hamill.muriel@example.com', '852', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(320, 'Raquel Halvorson III', '+1-956-478-8317', 'wrodriguez@example.com', '546', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(321, 'Palma Bartoletti', '283-634-8118', 'grimes.gabrielle@example.org', '767', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(322, 'Dejon Douglas', '(386) 423-9832', 'patricia43@example.com', '997', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(323, 'Gudrun Crona', '+1-479-978-7324', 'myrtle.gottlieb@example.org', '580', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(324, 'Melissa Barton PhD', '+1.513.852.7439', 'bbartoletti@example.org', '687', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(325, 'Dr. Malika Mayer Sr.', '+19522960928', 'fredrick11@example.net', '127', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 2, 'ADFEWQ', '1990-10-23'),
(326, 'Leslie Macejkovic I', '651.816.7140', 'vanessa54@example.com', '553', '2021-12-12 02:14:13', '2021-12-12 02:14:13', 1, 'ADFEWQ', '1990-10-23'),
(327, 'Tyrell Ryan', '+1-475-930-9912', 'mraynor@example.com', '488', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 2, 'ADFEWQ', '1990-10-23'),
(328, 'Dr. Amelie Stoltenberg', '+14252224008', 'julio.king@example.org', '396', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 1, 'ADFEWQ', '1990-10-23'),
(329, 'Hailee Hoppe', '(210) 318-9359', 'jailyn.muller@example.net', '934', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 2, 'ADFEWQ', '1990-10-23'),
(330, 'Macy Batz', '+12405186514', 'kylee.lesch@example.org', '811', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 1, 'ADFEWQ', '1990-10-23'),
(331, 'Petra Nader MD', '1-212-378-5458', 'stracke.gregg@example.net', '162', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 2, 'ADFEWQ', '1990-10-23'),
(332, 'Charlie Swaniawski', '737.736.7046', 'aubrey89@example.org', '661', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 1, 'ADFEWQ', '1990-10-23'),
(333, 'Gregg Casper', '567.931.2538', 'romaguera.shana@example.org', '369', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 2, 'ADFEWQ', '1990-10-23'),
(334, 'Gregg Schinner', '(540) 925-6153', 'stroman.carli@example.net', '438', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 1, 'ADFEWQ', '1990-10-23'),
(335, 'Finn Grimes', '314.542.1456', 'loraine70@example.net', '651', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 2, 'ADFEWQ', '1990-10-23'),
(336, 'Concepcion Olson DDS', '914.604.0623', 'gracie21@example.net', '190', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 1, 'ADFEWQ', '1990-10-23'),
(337, 'Zita Harvey', '(580) 974-2562', 'kraig.gutmann@example.org', '862', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 2, 'ADFEWQ', '1990-10-23');
INSERT INTO `customers` (`cus_id`, `cus_name`, `phone`, `cus_email`, `citizen_id`, `created_at`, `updated_at`, `genre_id`, `address`, `date_of_birth`) VALUES
(338, 'Prof. Gregorio Streich', '+1.650.442.1021', 'nicholaus40@example.org', '427', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 1, 'ADFEWQ', '1990-10-23'),
(339, 'Prof. Brisa Ward', '+1-762-487-3877', 'bahringer.dejon@example.com', '544', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 2, 'ADFEWQ', '1990-10-23'),
(340, 'Nella Roob IV', '1-973-722-1113', 'cartwright.marjorie@example.org', '864', '2021-12-12 02:14:14', '2021-12-12 02:14:14', 1, 'ADFEWQ', '1990-10-23'),
(341, 'Giovani Rohan', '425.309.1015', 'lstrosin@example.org', '455', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 2, 'ADFEWQ', '1990-10-23'),
(342, 'Jammie King', '1-612-677-5215', 'luna48@example.net', '458', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 1, 'ADFEWQ', '1990-10-23'),
(343, 'Hanna Lemke', '(617) 300-0817', 'taya.williamson@example.org', '025', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 2, 'ADFEWQ', '1990-10-23'),
(344, 'Quincy Kemmer', '707-671-0802', 'twilkinson@example.org', '899', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 1, 'ADFEWQ', '1990-10-23'),
(345, 'Amara Olson III', '1-305-215-1768', 'hdaugherty@example.net', '781', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 2, 'ADFEWQ', '1990-10-23'),
(346, 'Emmie Rogahn', '463-667-8663', 'kris.brooke@example.net', '394', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 1, 'ADFEWQ', '1990-10-23'),
(347, 'Cristopher Braun', '+1.865.712.8066', 'zoie11@example.com', '105', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 2, 'ADFEWQ', '1990-10-23'),
(348, 'Barry Padberg', '+1.507.688.8083', 'dasia.hegmann@example.net', '882', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 1, 'ADFEWQ', '1990-10-23'),
(349, 'Twila Lang Jr.', '1-346-767-7049', 'galtenwerth@example.org', '703', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 2, 'ADFEWQ', '1990-10-23'),
(350, 'Prof. Mikel Feest Sr.', '+1-737-447-7945', 'gmills@example.net', '121', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 1, 'ADFEWQ', '1990-10-23'),
(351, 'Prof. Ida Runte', '+1-458-504-4838', 'israel86@example.net', '461', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 2, 'ADFEWQ', '1990-10-23'),
(352, 'Dr. Oral Littel I', '1-303-542-0088', 'elsa57@example.org', '569', '2021-12-12 02:14:15', '2021-12-12 02:14:15', 1, 'ADFEWQ', '1990-10-23'),
(353, 'Nelson Feeney', '620.693.3529', 'margarita76@example.org', '818', '2021-12-12 02:14:16', '2021-12-12 02:14:16', 2, 'ADFEWQ', '1990-10-23'),
(354, 'Jerod Braun', '1-231-763-8892', 'newell.huel@example.org', '697', '2021-12-12 02:14:16', '2021-12-12 02:14:16', 1, 'ADFEWQ', '1990-10-23'),
(355, 'Vern Daugherty', '240-632-2667', 'spencer.rozella@example.com', '573', '2021-12-12 02:14:16', '2021-12-12 02:14:16', 2, 'ADFEWQ', '1990-10-23'),
(356, 'Rosella Little I', '+18435886364', 'grady.mustafa@example.org', '493', '2021-12-12 02:14:16', '2021-12-12 02:14:16', 1, 'ADFEWQ', '1990-10-23'),
(357, 'Dr. Meredith Erdman', '+1-785-857-7363', 'adrienne.nicolas@example.com', '132', '2021-12-12 02:14:16', '2021-12-12 02:14:16', 2, 'ADFEWQ', '1990-10-23'),
(358, 'Malinda Purdy MD', '1-915-467-4466', 'ophelia.ortiz@example.net', '238', '2021-12-12 02:14:16', '2021-12-12 02:14:16', 1, 'ADFEWQ', '1990-10-23'),
(359, 'Norma Adams MD', '+1 (743) 505-6104', 'pagac.birdie@example.net', '621', '2021-12-12 02:14:16', '2021-12-12 02:14:16', 2, 'ADFEWQ', '1990-10-23'),
(360, 'Manley Treutel', '(309) 963-9744', 'warren.bosco@example.net', '249', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 1, 'ADFEWQ', '1990-10-23'),
(361, 'Emmanuelle Schinner', '231-223-0206', 'werner.powlowski@example.net', '810', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 2, 'ADFEWQ', '1990-10-23'),
(362, 'Stanford Ratke', '+1 (660) 557-8170', 'powlowski.dorothy@example.com', '019', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 1, 'ADFEWQ', '1990-10-23'),
(363, 'Dr. Gordon Grant', '+1.231.382.4091', 'brayan80@example.net', '393', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 2, 'ADFEWQ', '1990-10-23'),
(364, 'Dr. Ressie Wiegand', '641-968-9816', 'kaelyn88@example.net', '838', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 1, 'ADFEWQ', '1990-10-23'),
(365, 'Nikita Will', '423.781.1944', 'weimann.gerson@example.net', '786', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 2, 'ADFEWQ', '1990-10-23'),
(366, 'Enrico Zulauf', '610.647.4213', 'muller.barton@example.org', '618', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 1, 'ADFEWQ', '1990-10-23'),
(367, 'Mrs. Claire Denesik II', '610-512-4885', 'ahintz@example.net', '428', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 2, 'ADFEWQ', '1990-10-23'),
(368, 'Vito Armstrong', '346.562.8906', 'brandi.prosacco@example.net', '952', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 1, 'ADFEWQ', '1990-10-23'),
(369, 'Ms. Lupe Ondricka', '1-713-571-4546', 'donnelly.john@example.net', '243', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 2, 'ADFEWQ', '1990-10-23'),
(370, 'Dr. Rosalee Stroman', '+1.724.664.8368', 'rwindler@example.com', '524', '2021-12-12 02:14:17', '2021-12-12 02:14:17', 1, 'ADFEWQ', '1990-10-23'),
(371, 'Zena Bartoletti', '+1-734-223-9089', 'turcotte.grayson@example.org', '530', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 2, 'ADFEWQ', '1990-10-23'),
(372, 'Karen Carroll', '+1 (947) 999-2893', 'gorczany.vivienne@example.org', '918', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 1, 'ADFEWQ', '1990-10-23'),
(373, 'Prof. Tiara Raynor II', '+1.762.401.5903', 'oheaney@example.org', '317', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 2, 'ADFEWQ', '1990-10-23'),
(374, 'Jillian Weber', '651.293.9507', 'harold.douglas@example.org', '007', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 1, 'ADFEWQ', '1990-10-23'),
(375, 'Tanya Swift', '(908) 679-3870', 'justus.trantow@example.com', '983', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 2, 'ADFEWQ', '1990-10-23'),
(376, 'Ms. Andreanne Champlin', '+1-918-612-5479', 'cgoodwin@example.net', '208', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 1, 'ADFEWQ', '1990-10-23'),
(377, 'Everette Becker', '(781) 399-1158', 'prohaska.ryley@example.org', '090', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 2, 'ADFEWQ', '1990-10-23'),
(378, 'Prof. Mekhi Douglas Jr.', '805.414.5740', 'uriah15@example.net', '139', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 1, 'ADFEWQ', '1990-10-23'),
(379, 'Aniya Kirlin', '762.350.6030', 'unique.reichert@example.com', '817', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 2, 'ADFEWQ', '1990-10-23'),
(380, 'Delphine Senger', '(480) 398-2505', 'destiney.kuphal@example.org', '748', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 1, 'ADFEWQ', '1990-10-23'),
(381, 'Deja Feest MD', '1-478-360-1538', 'mikayla.ferry@example.com', '560', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 2, 'ADFEWQ', '1990-10-23'),
(382, 'Pink Swift', '(713) 683-5665', 'ckris@example.net', '081', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 1, 'ADFEWQ', '1990-10-23'),
(383, 'Hildegard Cartwright III', '+1-678-548-3413', 'kurtis14@example.com', '178', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 2, 'ADFEWQ', '1990-10-23'),
(384, 'Jackson Hyatt', '+1-478-888-5170', 'tyra33@example.com', '341', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 1, 'ADFEWQ', '1990-10-23'),
(385, 'Austin Fadel', '726.639.5792', 'bauch.jaclyn@example.org', '119', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 2, 'ADFEWQ', '1990-10-23'),
(386, 'Ms. Cheyenne Sporer III', '+1.762.286.6987', 'npouros@example.net', '170', '2021-12-12 02:14:18', '2021-12-12 02:14:18', 1, 'ADFEWQ', '1990-10-23'),
(387, 'Kendall Greenholt', '+1-862-462-2823', 'vivien.goodwin@example.org', '207', '2021-12-12 02:14:19', '2021-12-12 02:14:19', 2, 'ADFEWQ', '1990-10-23'),
(388, 'Zaria Boehm', '+1.347.704.1512', 'stroman.ross@example.org', '030', '2021-12-12 02:14:19', '2021-12-12 02:14:19', 1, 'ADFEWQ', '1990-10-23'),
(389, 'Green Eichmann', '1-616-513-6541', 'jamaal03@example.org', '869', '2021-12-12 02:14:19', '2021-12-12 02:14:19', 2, 'ADFEWQ', '1990-10-23'),
(390, 'Nia Ondricka', '+14192059363', 'terry60@example.com', '125', '2021-12-12 02:14:19', '2021-12-12 02:14:19', 1, 'ADFEWQ', '1990-10-23'),
(391, 'Dr. Kitty Haag', '575-476-0961', 'lehner.timmothy@example.org', '449', '2021-12-12 02:14:19', '2021-12-12 02:14:19', 2, 'ADFEWQ', '1990-10-23'),
(392, 'Prof. Shirley Volkman Sr.', '+17733234714', 'alexane.kautzer@example.org', '331', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 1, 'ADFEWQ', '1990-10-23'),
(393, 'Bradley Rogahn', '732-909-6825', 'rebekah.becker@example.org', '733', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 2, 'ADFEWQ', '1990-10-23'),
(394, 'Prof. Enrico Durgan Jr.', '534-278-2623', 'mara45@example.net', '876', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 1, 'ADFEWQ', '1990-10-23'),
(395, 'Miss Alexanne Berge', '814-301-8675', 'sadye.zulauf@example.com', '200', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 2, 'ADFEWQ', '1990-10-23'),
(396, 'Pattie Sporer I', '+1-640-820-9041', 'ureilly@example.org', '873', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 1, 'ADFEWQ', '1990-10-23'),
(397, 'Adaline Hagenes', '651.929.9303', 'van96@example.org', '643', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 2, 'ADFEWQ', '1990-10-23'),
(398, 'Dr. Jonatan Schaden PhD', '904-466-7852', 'omer.steuber@example.com', '324', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 1, 'ADFEWQ', '1990-10-23'),
(399, 'Davonte Cummings', '1-870-373-9279', 'bart98@example.net', '514', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 2, 'ADFEWQ', '1990-10-23'),
(400, 'Eliane Fadel', '971.236.2765', 'thompson.uriah@example.com', '780', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 1, 'ADFEWQ', '1990-10-23'),
(401, 'Ed Weber', '+1 (341) 448-6811', 'mills.gail@example.org', '182', '2021-12-12 02:14:20', '2021-12-12 02:14:20', 2, 'ADFEWQ', '1990-10-23'),
(402, 'Buck Mraz I', '616.826.0634', 'blick.laney@example.org', '173', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 1, 'ADFEWQ', '1990-10-23'),
(403, 'Demarco Emmerich', '305-390-2557', 'csmitham@example.net', '114', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 2, 'ADFEWQ', '1990-10-23'),
(404, 'Miss Estel Kuhlman', '425-313-4223', 'ayla.vandervort@example.net', '686', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 1, 'ADFEWQ', '1990-10-23'),
(405, 'Merritt Ankunding', '657.938.5518', 'lexi21@example.net', '677', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 2, 'ADFEWQ', '1990-10-23'),
(406, 'Alvah Jacobi', '1-847-986-3471', 'vita22@example.net', '610', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 1, 'ADFEWQ', '1990-10-23'),
(407, 'Miss Trisha Simonis V', '(332) 230-1045', 'raynor.elinore@example.net', '079', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 2, 'ADFEWQ', '1990-10-23'),
(408, 'Kaleb Adams I', '+1 (785) 717-7314', 'vkessler@example.org', '957', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 1, 'ADFEWQ', '1990-10-23'),
(409, 'Leon Bechtelar', '220.373.5305', 'walsh.shanon@example.org', '676', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 2, 'ADFEWQ', '1990-10-23'),
(410, 'Maximilian Stanton', '1-772-860-7067', 'atorphy@example.com', '602', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 1, 'ADFEWQ', '1990-10-23'),
(411, 'Dr. Juwan Leffler', '(754) 757-8281', 'sheridan50@example.com', '587', '2021-12-12 02:14:21', '2021-12-12 02:14:21', 2, 'ADFEWQ', '1990-10-23'),
(412, 'Ashtyn Auer', '1-854-805-4297', 'kaela30@example.org', '112', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 1, 'ADFEWQ', '1990-10-23'),
(413, 'Prof. Tito Runolfsson', '1-283-845-8342', 'xnikolaus@example.org', '400', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 2, 'ADFEWQ', '1990-10-23'),
(414, 'Devon Schulist', '626.883.2544', 'kemmer.deanna@example.org', '147', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 1, 'ADFEWQ', '1990-10-23'),
(415, 'Winifred Ziemann DDS', '+1-985-332-2044', 'ila.rowe@example.com', '988', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 2, 'ADFEWQ', '1990-10-23'),
(416, 'Wilfredo Carroll', '810.873.1390', 'rosenbaum.hailey@example.org', '936', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 1, 'ADFEWQ', '1990-10-23'),
(417, 'Waino Carter PhD', '1-434-240-7930', 'xquigley@example.com', '494', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 2, 'ADFEWQ', '1990-10-23'),
(418, 'Gordon Cummerata', '559.617.1679', 'brad54@example.org', '204', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 1, 'ADFEWQ', '1990-10-23'),
(419, 'Mr. Jovani Bogan V', '617-850-5336', 'verla.kilback@example.net', '209', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 2, 'ADFEWQ', '1990-10-23'),
(420, 'Mr. Haley Bergstrom', '1-862-745-2395', 'kkulas@example.com', '436', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 1, 'ADFEWQ', '1990-10-23'),
(421, 'Mrs. Beatrice Zulauf PhD', '+1 (562) 420-7037', 'dhill@example.org', '791', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 2, 'ADFEWQ', '1990-10-23'),
(422, 'Cora Muller', '+1-407-480-2341', 'grant.kris@example.com', '155', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 1, 'ADFEWQ', '1990-10-23'),
(423, 'Mrs. Dolores Koch IV', '+1-601-203-0698', 'dora14@example.com', '008', '2021-12-12 02:14:22', '2021-12-12 02:14:22', 2, 'ADFEWQ', '1990-10-23'),
(424, 'Dr. Annabel Daniel DVM', '+1 (614) 562-9791', 'eddie62@example.org', '077', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 1, 'ADFEWQ', '1990-10-23'),
(425, 'Monica Mann', '(480) 274-4243', 'romaine.weber@example.org', '831', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 2, 'ADFEWQ', '1990-10-23'),
(426, 'Morris Boyer', '253.215.6733', 'yhammes@example.com', '388', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 1, 'ADFEWQ', '1990-10-23'),
(427, 'Larry Nitzsche V', '+1-878-476-0612', 'imarvin@example.com', '232', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 2, 'ADFEWQ', '1990-10-23'),
(428, 'Morgan Senger DVM', '+1 (838) 202-6689', 'clara82@example.net', '051', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 1, 'ADFEWQ', '1990-10-23'),
(429, 'Wilfred Spinka PhD', '804-530-5180', 'xmckenzie@example.com', '906', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 2, 'ADFEWQ', '1990-10-23'),
(430, 'Ima Stanton', '386-300-3719', 'gabriel98@example.com', '376', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 1, 'ADFEWQ', '1990-10-23'),
(431, 'Prof. Lonzo Hills', '+1-279-717-7566', 'toy.chloe@example.org', '421', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 2, 'ADFEWQ', '1990-10-23'),
(432, 'Prof. Luther Kunde', '380-833-3330', 'ziemann.garth@example.org', '848', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 1, 'ADFEWQ', '1990-10-23'),
(433, 'Maureen Durgan', '754-812-3687', 'pbayer@example.net', '752', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 2, 'ADFEWQ', '1990-10-23'),
(434, 'Mr. Jamaal Sporer', '+15206598612', 'brooks65@example.com', '291', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 1, 'ADFEWQ', '1990-10-23'),
(435, 'Emory Renner V', '(309) 780-7112', 'geovanny.funk@example.com', '501', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 2, 'ADFEWQ', '1990-10-23'),
(436, 'Isaiah Carter', '564.927.9871', 'larkin.price@example.net', '099', '2021-12-12 02:14:23', '2021-12-12 02:14:23', 1, 'ADFEWQ', '1990-10-23'),
(437, 'Claudia Pacocha', '+1.646.738.0725', 'zeffertz@example.org', '460', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 2, 'ADFEWQ', '1990-10-23'),
(438, 'Mrs. Bette O\'Reilly', '1-480-890-5985', 'baron.spinka@example.org', '391', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 1, 'ADFEWQ', '1990-10-23'),
(439, 'Eduardo Wunsch DDS', '+13805599879', 'walker.matilda@example.org', '480', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 2, 'ADFEWQ', '1990-10-23'),
(440, 'Sedrick Koelpin', '+1.463.970.1574', 'legros.lucas@example.net', '816', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 1, 'ADFEWQ', '1990-10-23'),
(441, 'Beau Hudson', '+1-910-354-5328', 'abartell@example.com', '565', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 2, 'ADFEWQ', '1990-10-23'),
(442, 'Jayda O\'Conner', '803.756.3818', 'ckerluke@example.com', '386', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 1, 'ADFEWQ', '1990-10-23'),
(443, 'Kenyon Bauch', '650.779.6607', 'sdubuque@example.com', '541', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 2, 'ADFEWQ', '1990-10-23'),
(444, 'Dr. Jannie Smith Jr.', '+15404073920', 'njacobi@example.com', '923', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 1, 'ADFEWQ', '1990-10-23'),
(445, 'Delia Gleason I', '1-419-969-2272', 'holden.reichert@example.org', '065', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 2, 'ADFEWQ', '1990-10-23'),
(446, 'Charlotte Batz', '918.455.7873', 'sankunding@example.net', '641', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 1, 'ADFEWQ', '1990-10-23'),
(447, 'Orion Mante', '765.905.5007', 'anabelle.nader@example.org', '478', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 2, 'ADFEWQ', '1990-10-23'),
(448, 'Jerrod Kuhn', '+1.863.712.5423', 'zachary51@example.com', '880', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 1, 'ADFEWQ', '1990-10-23'),
(449, 'Hulda Kemmer MD', '985-364-9933', 'sibyl04@example.org', '809', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 2, 'ADFEWQ', '1990-10-23'),
(450, 'Miss Catalina Romaguera Jr.', '1-508-352-5199', 'otreutel@example.org', '444', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 1, 'ADFEWQ', '1990-10-23'),
(451, 'Aliyah Kris', '+13524902720', 'taurean99@example.net', '702', '2021-12-12 02:14:24', '2021-12-12 02:14:24', 2, 'ADFEWQ', '1990-10-23'),
(452, 'Dorthy Wehner', '+19255356097', 'graham.johnathan@example.com', '694', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(453, 'Fiona Mante', '1-781-898-7609', 'loraine32@example.com', '016', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(454, 'Pierce Hills IV', '929-742-0750', 'fzieme@example.com', '594', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(455, 'Mr. Vito Okuneva IV', '+17316201878', 'willow74@example.org', '370', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(456, 'Elian Cormier', '(607) 719-8536', 'okey.ondricka@example.com', '757', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(457, 'Frankie Harris', '1-774-768-3682', 'maiya.kilback@example.net', '365', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(458, 'Prof. Efren Thompson', '+1 (862) 801-6034', 'eloise.kovacek@example.org', '375', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(459, 'Nicolette O\'Reilly', '520.260.8191', 'mac.kris@example.org', '098', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(460, 'Kennith Lowe', '718.457.6186', 'alexander73@example.com', '284', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(461, 'Denis Heller', '302-223-0876', 'srussel@example.net', '247', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(462, 'Lora Wuckert', '+1-484-452-4985', 'zelma24@example.com', '567', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(463, 'Prof. Robb Treutel', '669-519-2360', 'carolanne13@example.org', '771', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(464, 'Loyce Bogan', '1-313-938-8051', 'jeff.bednar@example.com', '806', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(465, 'Jocelyn Farrell', '1-203-330-4741', 'prince16@example.net', '666', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(466, 'Armando Kohler', '+1-551-236-9626', 'willis62@example.org', '629', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(467, 'Kellen Legros', '1-469-724-8898', 'hswaniawski@example.com', '289', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(468, 'Zackary Braun', '+1-854-829-1331', 'finn.wintheiser@example.net', '189', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(469, 'Aron Barton', '+1-520-969-9984', 'metz.natalie@example.net', '420', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(470, 'Prof. Shemar Simonis', '+1 (423) 436-7840', 'donavon81@example.org', '855', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(471, 'Deonte Wehner', '1-501-589-9882', 'dach.brendan@example.org', '262', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(472, 'Dr. Ian Wilkinson', '+1-305-588-8646', 'rlangosh@example.net', '000', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(473, 'Bella Quigley', '+1-726-995-0058', 'sigmund41@example.com', '399', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(474, 'Claudine Little', '+1.704.706.9340', 'philip.monahan@example.net', '870', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(475, 'Barbara Grant', '724.237.9733', 'maggie73@example.com', '888', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(476, 'Meredith Halvorson', '+1 (832) 687-3166', 'isobel41@example.com', '652', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 1, 'ADFEWQ', '1990-10-23'),
(477, 'Emmy Gleason', '283-248-7588', 'gina.konopelski@example.net', '005', '2021-12-12 02:14:25', '2021-12-12 02:14:25', 2, 'ADFEWQ', '1990-10-23'),
(478, 'Carson Stiedemann', '1-325-429-2515', 'eleanore.von@example.net', '614', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 1, 'ADFEWQ', '1990-10-23'),
(479, 'Kendra Gibson', '+1.620.767.9265', 'cary91@example.com', '313', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 2, 'ADFEWQ', '1990-10-23'),
(480, 'Abel Lebsack Jr.', '334-739-4055', 'kayleigh.hirthe@example.net', '523', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 1, 'ADFEWQ', '1990-10-23'),
(481, 'Prof. Montana Nienow II', '+1 (307) 830-4147', 'michelle67@example.net', '224', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 2, 'ADFEWQ', '1990-10-23'),
(482, 'Caleigh Becker', '(484) 870-6304', 'addison97@example.net', '635', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 1, 'ADFEWQ', '1990-10-23'),
(483, 'Prof. Morgan Murazik', '1-831-843-1042', 'fmarquardt@example.com', '688', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 2, 'ADFEWQ', '1990-10-23'),
(484, 'Mrs. Shany Buckridge', '+1 (223) 444-1875', 'mnienow@example.com', '857', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 1, 'ADFEWQ', '1990-10-23'),
(485, 'Dr. Murl Satterfield', '+16284062956', 'cierra.bogan@example.com', '843', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 2, 'ADFEWQ', '1990-10-23'),
(486, 'Baylee Upton', '+1.740.520.1668', 'kristy03@example.com', '397', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 1, 'ADFEWQ', '1990-10-23'),
(487, 'Miss Lonie Corwin', '1-283-914-2007', 'adolph99@example.com', '492', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 2, 'ADFEWQ', '1990-10-23'),
(488, 'Breanna Goldner', '(607) 844-2847', 'delphia.borer@example.com', '296', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 1, 'ADFEWQ', '1990-10-23'),
(489, 'Lillian Crona', '+1-636-226-4609', 'schuster.belle@example.com', '662', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 2, 'ADFEWQ', '1990-10-23'),
(490, 'Leola Monahan', '520-865-4577', 'geraldine43@example.net', '462', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 1, 'ADFEWQ', '1990-10-23'),
(491, 'Dr. Walker Gutkowski IV', '+1.810.521.0207', 'treutel.kelvin@example.net', '581', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 2, 'ADFEWQ', '1990-10-23'),
(492, 'Dr. Mose Harber', '(316) 980-9642', 'mante.leda@example.com', '646', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 1, 'ADFEWQ', '1990-10-23'),
(493, 'Rolando Conn', '+1 (820) 455-8762', 'maximillian00@example.org', '001', '2021-12-12 02:14:26', '2021-12-12 02:14:26', 2, 'ADFEWQ', '1990-10-23'),
(494, 'Gerard Hoppe DDS', '(606) 667-9422', 'hailie.mills@example.com', '755', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(495, 'Jeremie Larkin PhD', '1-989-824-8511', 'ibayer@example.net', '768', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(496, 'Ms. Carmen Hansen', '(562) 935-8568', 'xdubuque@example.org', '253', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(497, 'Samantha Howell Jr.', '224-918-3673', 'qlarkin@example.com', '245', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(498, 'Van Hyatt', '260.828.0542', 'nikolaus.tyrique@example.com', '499', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(499, 'Dr. Colby Emard', '(574) 272-8494', 'damore.jaida@example.net', '256', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(500, 'Chaim Kilback', '+1-325-438-0366', 'amie22@example.org', '770', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(501, 'Maxime Stoltenberg', '(269) 536-3532', 'hhills@example.net', '798', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(502, 'Ms. Lempi Skiles', '+1-785-445-8395', 'yundt.treva@example.com', '945', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(503, 'Melba Mills', '1-540-624-4538', 'golda59@example.org', '180', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(504, 'Destiny Wisozk III', '539.662.1765', 'kkautzer@example.org', '946', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(505, 'Erika Lang', '325-481-2855', 'nitzsche.kasandra@example.com', '716', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(506, 'Beryl Maggio', '1-517-271-6995', 'pkshlerin@example.net', '100', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(507, 'Dr. Fabian Emard', '419-816-5701', 'uconroy@example.org', '589', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(508, 'Lowell Maggio MD', '657.949.9032', 'wuckert.renee@example.com', '925', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(509, 'Candace Rowe', '585.451.8685', 'heidenreich.trent@example.net', '028', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(510, 'Dylan Hodkiewicz', '520-645-4420', 'evert16@example.net', '023', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(511, 'Regan Fisher', '(337) 665-0686', 'kathryne68@example.com', '122', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(512, 'Irving Ondricka', '734-829-4168', 'marc25@example.net', '680', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(513, 'Mr. Darion Jakubowski III', '307.760.4750', 'osinski.abelardo@example.org', '797', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(514, 'Wilton Turner', '1-704-326-8541', 'tjacobs@example.org', '576', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 1, 'ADFEWQ', '1990-10-23'),
(515, 'Mr. Torey Altenwerth DVM', '1-283-761-0699', 'esta30@example.org', '411', '2021-12-12 02:14:27', '2021-12-12 02:14:27', 2, 'ADFEWQ', '1990-10-23'),
(516, 'Damien Sanford DVM', '+1.386.794.0900', 'hammes.elijah@example.com', '903', '2021-12-12 02:14:28', '2021-12-12 02:14:28', 1, 'ADFEWQ', '1990-10-23'),
(517, 'Stacy Roberts', '(407) 797-4927', 'pamela03@example.com', '057', '2021-12-12 02:14:28', '2021-12-12 02:14:28', 2, 'ADFEWQ', '1990-10-23'),
(518, 'fqef', '413413', 'x@gmail.com', '412412412', '2022-02-10 17:01:26', '2022-02-10 17:01:26', 1, 'FEFEFAEFE', '2022-11-02'),
(519, 'fqfq', '133134134', 'f@gmaol.com', '1442134124', '2022-02-10 17:03:04', '2022-02-10 17:03:04', 1, 'DFKDFJKXXX', '2022-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_service_bills`
--

CREATE TABLE `customer_service_bills` (
  `cs_bill_id` bigint(20) UNSIGNED NOT NULL,
  `cs_bill_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created_bill` datetime NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `floor_id` bigint(20) UNSIGNED NOT NULL,
  `floor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`floor_id`, `floor_name`) VALUES
(1, 'Tầng 1'),
(2, 'Tầng 2'),
(3, 'Tầng 3'),
(4, 'Tầng 4'),
(5, 'Tầng 5');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` bigint(20) UNSIGNED NOT NULL,
  `genre_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`) VALUES
(1, 'Nam'),
(2, 'Nữ');

-- --------------------------------------------------------

--
-- Table structure for table `measures`
--

CREATE TABLE `measures` (
  `measure_id` bigint(20) UNSIGNED NOT NULL,
  `measure_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measures`
--

INSERT INTO `measures` (`measure_id`, `measure_name`, `created_at`, `updated_at`) VALUES
(1, 'kg', '2022-01-07 02:51:52', '2022-01-07 02:52:05'),
(4, 'thùng', '2022-02-09 16:31:03', '2022-02-09 16:31:03'),
(5, 'Cái', NULL, NULL);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_22_143221_create_user_roles_table', 1),
(6, '2021_11_22_143450_update_users_table', 1),
(7, '2021_11_22_143523_create_statuses_table', 1),
(8, '2021_11_22_143603_create_room_types_table', 1),
(9, '2021_11_22_143617_create_rooms_table', 1),
(10, '2021_11_22_143723_create_customers_table', 1),
(11, '2021_11_22_143749_create_services_table', 1),
(12, '2021_11_22_143804_create_bills_table', 1),
(13, '2021_11_22_143817_create_room_bills_table', 1),
(14, '2021_11_22_143849_create_shift_types_table', 1),
(15, '2021_11_22_143906_create_shifts_table', 1),
(16, '2021_11_22_143932_create_budgets_table', 1),
(17, '2021_11_22_143953_create_budget_invoices_table', 1),
(18, '2021_11_22_144009_create_suppliers_table', 1),
(19, '2021_11_22_144027_create_product_types_table', 1),
(20, '2021_11_22_144039_create_products_table', 1),
(21, '2021_11_22_144103_create_warehouse_receipts_table', 1),
(22, '2021_11_22_144123_create_product_warehouse_receipts_table', 1),
(23, '2021_11_26_101039_create_service_types_table', 1),
(24, '2021_11_26_101326_update_service_table', 1),
(25, '2021_11_26_205250_create_customer_service_bills_table', 1),
(26, '2021_11_26_210056_create_service_bills_table', 1),
(27, '2021_11_28_150044_create_warehouse_receipt_types_table', 1),
(28, '2021_11_28_150251_update_warehouse_receipts_table', 1),
(29, '2021_11_28_150839_create_budget_invoice_types_table', 1),
(30, '2021_11_28_150959_update_budget_invoices_table', 1),
(31, '2021_11_28_153745_create_measures_table', 1),
(32, '2021_11_28_154110_update_products_table', 1),
(35, '2021_12_14_153503_update_room_table', 2),
(36, '2021_12_14_205053_update_table_service_bills', 2),
(39, '2021_12_15_153119_create_bookings_table', 3),
(40, '2022_01_04_220724_create_genres_table', 4),
(41, '2022_01_04_220929_update_table_customers', 5),
(49, '2022_01_04_222044_update_table_customers1', 6),
(50, '2022_01_05_105036_create_floors_table', 6),
(51, '2022_01_05_105115_update_table_rooms', 6),
(52, '2022_01_06_145945_update_table_bookings', 7),
(53, '2022_01_06_150300_update_table_users', 7),
(56, '2022_01_12_083558_create_room_bookings_table', 8),
(58, '2022_01_16_091245_update_table_bookings_1', 9);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `import_price` decimal(9,0) NOT NULL,
  `quantity` decimal(7,0) NOT NULL DEFAULT 0,
  `product_type_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `measure_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `import_price`, `quantity`, `product_type_id`, `supplier_id`, `created_at`, `updated_at`, `measure_id`) VALUES
(1, 'Thịt lợn', '100000', '13', 1, 1, '2022-01-07 08:04:27', '2022-01-07 08:17:30', 1),
(2, 'Thịt bò', '100000', '114', 1, 2, NULL, NULL, 1),
(3, 'Thịt gà', '100000', '111', 1, 1, NULL, NULL, 1),
(4, 'Khăn', '20000', '61', 2, 3, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `product_type_id` bigint(20) UNSIGNED NOT NULL,
  `product_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`product_type_id`, `product_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Thực phẩm', '2022-01-07 01:55:03', '2022-01-07 02:07:19'),
(2, 'Đồ dùng', '2022-01-07 02:09:52', '2022-01-07 02:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouse_receipts`
--

CREATE TABLE `product_warehouse_receipts` (
  `warehouse_receipt_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(6,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_warehouse_receipts`
--

INSERT INTO `product_warehouse_receipts` (`warehouse_receipt_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(4, 1, '2', '2022-01-09 10:25:27', '2022-01-09 10:25:27'),
(4, 2, '1', '2022-01-09 10:25:27', '2022-01-09 10:25:27'),
(3, 1, '5', NULL, NULL),
(3, 2, '6', NULL, NULL),
(2, 1, '20', NULL, NULL),
(1, 1, '3', '2022-02-09 16:57:25', '2022-02-09 16:57:25'),
(6, 1, '10', '2022-02-10 16:44:08', '2022-02-10 16:44:08'),
(6, 3, '10', '2022-02-10 16:44:08', '2022-02-10 16:44:08'),
(5, 1, '10', NULL, NULL),
(7, 3, '10', '2022-02-10 17:08:26', '2022-02-10 17:08:26'),
(7, 4, '10', '2022-02-10 17:08:26', '2022-02-10 17:08:26'),
(8, 3, '1', '2022-02-10 17:18:58', '2022-02-10 17:18:58'),
(8, 4, '1', '2022-02-10 17:18:58', '2022-02-10 17:18:58'),
(9, 3, '10', '2022-02-10 17:20:19', '2022-02-10 17:20:19'),
(9, 4, '10', '2022-02-10 17:20:20', '2022-02-10 17:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `room_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `floor_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `room_type_id`, `status_id`, `created_at`, `updated_at`, `floor_id`) VALUES
(1, '101', 1, 1, NULL, NULL, 1),
(2, '203', 1, 3, NULL, NULL, 2),
(3, '204', 2, 2, NULL, NULL, 2),
(4, '206', 1, 1, NULL, NULL, 2),
(5, '305', 1, 3, NULL, NULL, 3),
(6, '302', 1, 2, NULL, NULL, 3),
(7, '307', 1, 3, '2022-01-05 07:37:53', '2022-01-05 07:37:53', 3),
(8, '401', 3, 2, NULL, NULL, 4),
(9, '402', 3, 3, NULL, NULL, 4),
(10, '501', 4, 1, NULL, NULL, 5),
(11, '502', 4, 1, NULL, NULL, 5),
(12, '503', 3, 1, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `room_bills`
--

CREATE TABLE `room_bills` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `date_checkin` datetime NOT NULL,
  `date_checkout` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_bills`
--

INSERT INTO `room_bills` (`room_id`, `bill_id`, `date_checkin`, `date_checkout`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-12-05 14:00:00', '2021-12-06 12:00:00', NULL, NULL),
(2, 1, '2021-12-02 00:00:00', '2021-12-09 00:00:00', NULL, NULL),
(4, 3, '2021-12-15 00:00:00', '2021-12-22 00:00:00', NULL, NULL),
(3, 3, '2021-12-15 00:00:00', '2021-12-22 00:00:00', NULL, NULL),
(6, 4, '2021-12-14 00:00:00', '2021-12-23 00:00:00', NULL, NULL),
(5, 4, '2021-12-14 00:00:00', '2021-12-23 00:00:00', NULL, NULL),
(2, 6, '2022-01-05 00:00:00', '2022-01-14 00:00:00', '2022-01-03 08:55:08', '2022-01-03 08:55:08'),
(4, 6, '2022-01-05 00:00:00', '2022-01-14 00:00:00', '2022-01-03 08:55:08', '2022-01-03 08:55:08'),
(5, 7, '2022-01-03 00:00:00', '2022-01-04 00:00:00', '2022-01-03 08:55:32', '2022-01-03 08:55:32'),
(6, 7, '2022-01-03 00:00:00', '2022-01-04 00:00:00', '2022-01-03 08:55:32', '2022-01-03 08:55:32'),
(1, 5, '2022-01-18 10:00:00', '2022-01-20 13:00:00', '2022-01-21 07:43:07', '2022-01-21 07:43:07'),
(3, 5, '2022-01-18 10:00:00', '2022-01-20 12:00:00', '2022-01-21 07:43:07', '2022-01-21 07:43:07'),
(2, 10, '2022-01-21 12:00:00', '2022-01-28 21:15:00', '2022-01-24 14:08:00', '2022-01-24 14:08:00'),
(11, 10, '2022-01-21 12:00:00', '2022-01-28 21:15:00', '2022-01-24 14:08:01', '2022-01-24 14:08:01'),
(2, 9, '2022-02-05 12:30:00', '2022-02-10 17:45:00', '2022-02-09 17:34:47', '2022-02-09 17:34:47'),
(4, 9, '2022-02-10 12:45:00', '2022-02-11 00:30:00', '2022-02-09 17:34:47', '2022-02-09 17:34:47'),
(8, 23, '2022-01-15 09:00:00', '2022-01-17 15:00:00', '2022-02-14 17:57:46', '2022-02-14 17:57:46'),
(4, 24, '2022-01-16 09:00:00', '2022-01-17 12:00:00', '2022-02-14 18:08:41', '2022-02-14 18:08:41'),
(5, 24, '2022-01-16 09:00:00', '2022-01-18 15:00:00', '2022-02-14 18:08:42', '2022-02-14 18:08:42'),
(8, 25, '2022-01-18 11:00:00', '2022-02-01 12:00:00', '2022-02-15 13:34:36', '2022-02-15 13:34:36'),
(7, 27, '2022-01-29 09:00:00', '2022-01-31 22:00:00', '2022-02-15 13:56:24', '2022-02-15 13:56:24'),
(2, 26, '2022-01-26 10:00:00', '2022-02-27 21:17:00', '2022-02-15 14:17:52', '2022-02-15 14:17:52'),
(3, 30, '2022-02-15 12:00:00', '2022-02-17 12:00:00', '2022-02-15 14:29:48', '2022-02-15 14:29:48'),
(6, 31, '2022-02-15 12:00:00', '2022-02-16 12:00:00', '2022-02-15 14:39:29', '2022-02-15 14:39:29'),
(8, 32, '2022-02-15 12:00:00', '2022-02-17 12:00:00', '2022-02-15 14:59:57', '2022-02-15 14:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `room_bookings`
--

CREATE TABLE `room_bookings` (
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `checkin` datetime NOT NULL,
  `checkout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_bookings`
--

INSERT INTO `room_bookings` (`booking_id`, `room_id`, `checkin`, `checkout`) VALUES
(1, 1, '2022-01-02 09:38:37', '2022-01-03 09:38:37'),
(2, 2, '2022-01-02 09:38:37', '2022-01-03 09:38:37'),
(3, 1, '2022-01-04 09:39:36', '2022-01-05 09:39:36'),
(4, 4, '2022-01-16 09:00:00', '2022-01-17 12:00:00'),
(4, 5, '2022-01-16 09:00:00', '2022-01-18 15:00:00'),
(6, 8, '2022-01-15 09:00:00', '2022-01-17 15:00:00'),
(7, 8, '2022-01-18 11:00:00', '2022-01-12 14:00:00'),
(8, 2, '2022-01-26 10:00:00', '2022-01-28 09:42:44'),
(9, 7, '2022-01-29 09:00:00', '2022-01-31 22:00:00'),
(16, 5, '2022-01-14 00:30:00', '2022-01-19 17:15:00'),
(16, 7, '2022-01-14 00:30:00', '2022-01-19 17:15:00'),
(18, 2, '2022-02-15 12:00:00', '2022-02-17 12:00:00'),
(19, 7, '2022-02-19 12:00:00', '2022-02-24 12:00:00'),
(19, 9, '2022-02-19 12:00:00', '2022-02-24 12:00:00'),
(20, 5, '2022-02-26 12:00:00', '2022-02-28 12:00:00'),
(20, 7, '2022-02-26 12:00:00', '2022-02-28 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(9,0) NOT NULL,
  `guest_number` decimal(2,0) NOT NULL,
  `room_des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`room_type_id`, `type_name`, `price`, `guest_number`, `room_des`, `created_at`, `updated_at`) VALUES
(1, 'Suite ', '5000000', '2', 'Room type 1 des', NULL, NULL),
(2, 'Deluxe ', '3000000', '2', 'ddddddddd', NULL, NULL),
(3, 'Superior ', '2000000', '2', 'DDDAACCDFWQEFWQ', '2022-01-05 08:25:44', '2022-01-05 08:25:44'),
(4, 'Standard ', '1000000', '2', 'RECDVVDAAFEW', '2022-01-05 08:36:10', '2022-01-05 08:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_price` decimal(7,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_price`, `created_at`, `updated_at`, `service_type_id`) VALUES
(1, 'Nước khoáng', '10000', NULL, NULL, 1),
(3, 'Giặt là', '10000', NULL, NULL, 4),
(4, 'Xe đưa đón', '100000', NULL, NULL, 4),
(5, 'Karaoke', '200000', NULL, NULL, 4),
(6, 'Spa', '200000', NULL, NULL, 4),
(7, 'Phòng họp', '1000000', '0000-00-00 00:00:00', NULL, 4),
(8, 'Bia', '15000', '2022-01-05 09:10:05', '2022-01-05 09:25:46', 1),
(10, 'Coca', '11000', '2022-02-10 16:51:36', '2022-02-10 16:51:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_bills`
--

CREATE TABLE `service_bills` (
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(6,0) NOT NULL,
  `date_use_service` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `room_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_bills`
--

INSERT INTO `service_bills` (`bill_id`, `service_id`, `quantity`, `date_use_service`, `created_at`, `updated_at`, `room_id`) VALUES
(1, 1, '2', '2021-12-06 14:21:00', NULL, NULL, 1),
(1, 3, '2', '2021-12-06 14:21:00', NULL, NULL, 1),
(3, 1, '2', '2021-12-14 21:12:29', NULL, NULL, 3),
(3, 1, '3', '2021-12-14 21:12:29', NULL, NULL, 4),
(3, 7, '4', '2021-12-14 21:12:29', NULL, NULL, 3),
(4, 1, '6', '2021-12-14 21:14:10', NULL, NULL, 6),
(4, 4, '7', '2021-12-14 21:14:10', NULL, NULL, 5),
(5, 3, '1', NULL, '2022-01-21 07:43:07', '2022-01-21 07:43:07', 3),
(5, 5, '1', NULL, '2022-01-21 07:43:07', '2022-01-21 07:43:07', 1),
(7, 5, '5', '2022-02-09 18:00:00', NULL, NULL, 5),
(7, 6, '1', '2022-02-08 18:00:05', NULL, NULL, 5),
(10, 3, '3', NULL, '2022-01-24 14:08:01', '2022-01-24 14:08:01', 11),
(10, 5, '2', NULL, '2022-01-24 14:08:01', '2022-01-24 14:08:01', 11),
(9, 8, '10', NULL, '2022-02-09 17:34:47', '2022-02-09 17:34:47', 2);

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `service_type_id` bigint(20) UNSIGNED NOT NULL,
  `service_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`service_type_id`, `service_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Đồ uống', NULL, NULL),
(2, 'Đồ ăn', NULL, NULL),
(4, 'Dịch vụ khác', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `date_start` datetime NOT NULL,
  `date_finish` datetime NOT NULL,
  `shift_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`shift_id`, `date_start`, `date_finish`, `shift_type_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2022-01-21 07:00:00', '2022-01-22 15:00:00', 1, 4, NULL, NULL),
(2, '2022-01-22 07:00:00', '2022-01-22 15:00:00', 1, 2, NULL, NULL),
(3, '2022-02-08 15:00:00', '2022-02-08 23:00:00', 2, 3, '2022-02-08 16:27:23', '2022-02-08 16:27:23'),
(4, '2022-02-08 15:00:00', '2022-02-08 23:00:00', 2, 2, '2022-02-08 16:29:02', '2022-02-08 16:29:02'),
(5, '2022-02-11 15:00:00', '2022-02-11 23:00:00', 2, 3, '2022-02-11 09:19:41', '2022-02-11 09:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `shift_types`
--

CREATE TABLE `shift_types` (
  `shift_type_id` bigint(20) UNSIGNED NOT NULL,
  `shift_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` time NOT NULL,
  `time_finish` time NOT NULL,
  `is_tomorrow` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shift_types`
--

INSERT INTO `shift_types` (`shift_type_id`, `shift_type_name`, `time_start`, `time_finish`, `is_tomorrow`, `created_at`, `updated_at`) VALUES
(1, 'Ca sáng', '07:00:00', '15:00:00', 0, '2022-01-05 13:45:35', '2022-01-05 13:45:35'),
(2, 'Ca tối', '15:00:00', '23:00:00', 0, '2022-01-22 15:18:03', '2022-01-22 15:18:44'),
(3, 'Ca đêm', '23:00:00', '07:00:00', 1, '2022-01-22 15:19:22', '2022-01-22 15:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `status_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'Phòng trống', NULL, NULL),
(2, 'Đang thuê', NULL, NULL),
(3, 'Đặt trước', NULL, NULL),
(4, 'Phòng bẩn', NULL, NULL),
(5, 'Đang sửa', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_phone`, `supplier_address`, `created_at`, `updated_at`) VALUES
(1, 'NCC 1', '01259955553', 'ADE-EFC-BBBBBBBBBBBBB', '2022-01-05 14:39:25', '2022-01-07 02:32:31'),
(2, 'Đại lý 3', '05562166', 'EDGE-GFGE-DDDVDD', '2022-01-07 02:20:54', '2022-01-07 02:22:12'),
(3, 'Dai ly 4', '285963416', 'EREWW-RWQRWER', '2022-01-07 02:36:40', '2022-01-07 02:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `phone`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `role_id`, `is_active`) VALUES
(1, 'nam', 'nam@email.com', '0123456789', '$2y$10$QwnaIurhn5ji7B1FHK/m4.hZ1Bklm.bUvotI2XbqQ8az.9qaqZahy', NULL, NULL, '2021-12-06 00:13:23', '2021-12-06 00:13:23', 1, 1),
(2, 'fceboy', 'qwer01234567098@gmail.com', '556555', '$2y$10$eMkkO1P.d2KSYizHXHw8Qud1KNAbYE9Wlbu0/XLBB/tnGqlPCQ5MO', NULL, NULL, '2021-12-06 00:13:42', '2021-12-06 00:13:42', 2, 1),
(3, 'hai nam', 'n@gmail.com', '0912345678', '$2y$10$FN/U9O.EIxAVOWS/mLFMd.H.G/FV5A/6ZnMyasKGqwHyWy7/NbLIy', NULL, NULL, '2022-01-06 07:43:58', '2022-01-06 07:43:58', 1, 1),
(4, 'Long', 'l@gmail.com', '1563331', '$2y$10$aTxANU5f5FNB.QbIJ2x87ukkM.W1B6fzaRqSNHE1JE2Wp5pUYT5Au', NULL, NULL, '2022-01-07 12:39:05', '2022-01-07 12:50:27', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Quản lý', NULL, NULL),
(2, 'Lễ tân', NULL, '2022-01-07 13:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_receipts`
--

CREATE TABLE `warehouse_receipts` (
  `warehouse_receipt_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_receipt_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_created_at` datetime NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `warehouse_receipt_type_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_receipts`
--

INSERT INTO `warehouse_receipts` (`warehouse_receipt_id`, `warehouse_receipt_name`, `receipt_created_at`, `note`, `user_id`, `created_at`, `updated_at`, `warehouse_receipt_type_id`) VALUES
(1, 'Hoa don 1', '2022-01-07 21:19:23', 'FAWWWW-FWFQW', 1, NULL, NULL, 1),
(2, 'hoa don 1', '2022-01-09 17:18:50', 'Note 2', 2, '2022-01-09 10:18:51', '2022-01-09 10:18:51', 1),
(3, 'hd2', '2022-01-09 17:24:20', 'rwqrw', 4, '2022-01-09 10:24:20', '2022-01-09 10:24:20', 1),
(4, 'hd2', '2022-01-31 17:25:27', 'rwqrw', 3, '2022-01-09 10:25:27', '2022-01-09 10:25:27', 1),
(5, 'PNK5', '2022-02-10 23:43:41', 'noteeeee', 3, '2022-02-10 16:43:41', '2022-02-10 16:43:41', 2),
(6, 'PNK6', '2022-02-10 23:44:07', 'noteeeee', 3, '2022-02-10 16:44:07', '2022-02-10 16:44:08', 2),
(7, 'PNK7', '2022-02-11 00:08:26', 'noteeeeeee', 3, '2022-02-10 17:08:26', '2022-02-10 17:08:26', 2),
(8, 'PNK8', '2022-02-11 00:18:58', NULL, 3, '2022-02-10 17:18:58', '2022-02-10 17:18:58', 2),
(9, 'PXK9', '2022-02-11 00:20:19', NULL, 3, '2022-02-10 17:20:19', '2022-02-10 17:20:19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_receipt_types`
--

CREATE TABLE `warehouse_receipt_types` (
  `warehouse_receipt_type_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_receipt_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_receipt_types`
--

INSERT INTO `warehouse_receipt_types` (`warehouse_receipt_type_id`, `warehouse_receipt_type_name`, `created_at`, `updated_at`) VALUES
(1, 'Hóa đơn nhập kho', '2022-01-07 08:50:54', '2022-01-07 08:51:55'),
(2, 'Hóa đơn xuất kho', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bills_user_id_foreign` (`user_id`),
  ADD KEY `bills_cus_id_foreign` (`cus_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `bookings_cus_id_foreign` (`cus_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`budget_id`);

--
-- Indexes for table `budget_invoices`
--
ALTER TABLE `budget_invoices`
  ADD PRIMARY KEY (`budget_invoice_id`),
  ADD KEY `budget_invoices_user_id_foreign` (`user_id`),
  ADD KEY `budget_invoices_budget_id_foreign` (`budget_id`),
  ADD KEY `budget_invoices_budget_invoice_type_id_foreign` (`budget_invoice_type_id`);

--
-- Indexes for table `budget_invoice_types`
--
ALTER TABLE `budget_invoice_types`
  ADD PRIMARY KEY (`budget_invoice_type_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`),
  ADD KEY `customers_genre_id_foreign` (`genre_id`);

--
-- Indexes for table `customer_service_bills`
--
ALTER TABLE `customer_service_bills`
  ADD PRIMARY KEY (`cs_bill_id`),
  ADD KEY `customer_service_bills_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`floor_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `measures`
--
ALTER TABLE `measures`
  ADD PRIMARY KEY (`measure_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_product_type_id_foreign` (`product_type_id`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`),
  ADD KEY `products_measure_id_foreign` (`measure_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `product_warehouse_receipts`
--
ALTER TABLE `product_warehouse_receipts`
  ADD KEY `product_warehouse_receipts_warehouse_receipt_id_foreign` (`warehouse_receipt_id`),
  ADD KEY `product_warehouse_receipts_product_id_foreign` (`product_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `rooms_room_type_id_foreign` (`room_type_id`),
  ADD KEY `rooms_status_id_foreign` (`status_id`),
  ADD KEY `rooms_floor_id_foreign` (`floor_id`);

--
-- Indexes for table `room_bills`
--
ALTER TABLE `room_bills`
  ADD KEY `room_bills_room_id_foreign` (`room_id`),
  ADD KEY `room_bills_bill_id_foreign` (`bill_id`);

--
-- Indexes for table `room_bookings`
--
ALTER TABLE `room_bookings`
  ADD KEY `room_bookings_booking_id_foreign` (`booking_id`),
  ADD KEY `room_bookings_room_id_foreign` (`room_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `services_service_type_id_foreign` (`service_type_id`);

--
-- Indexes for table `service_bills`
--
ALTER TABLE `service_bills`
  ADD KEY `service_bills_bill_id_foreign` (`bill_id`),
  ADD KEY `service_bills_service_id_foreign` (`service_id`),
  ADD KEY `service_bills_room_id_foreign` (`room_id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`service_type_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`shift_id`),
  ADD KEY `shifts_shift_type_id_foreign` (`shift_type_id`),
  ADD KEY `shifts_user_id_foreign` (`user_id`);

--
-- Indexes for table `shift_types`
--
ALTER TABLE `shift_types`
  ADD PRIMARY KEY (`shift_type_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_user_email_unique` (`user_email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `warehouse_receipts`
--
ALTER TABLE `warehouse_receipts`
  ADD PRIMARY KEY (`warehouse_receipt_id`),
  ADD KEY `warehouse_receipts_user_id_foreign` (`user_id`),
  ADD KEY `warehouse_receipts_warehouse_receipt_type_id_foreign` (`warehouse_receipt_type_id`);

--
-- Indexes for table `warehouse_receipt_types`
--
ALTER TABLE `warehouse_receipt_types`
  ADD PRIMARY KEY (`warehouse_receipt_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `budget_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `budget_invoices`
--
ALTER TABLE `budget_invoices`
  MODIFY `budget_invoice_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `budget_invoice_types`
--
ALTER TABLE `budget_invoice_types`
  MODIFY `budget_invoice_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=521;

--
-- AUTO_INCREMENT for table `customer_service_bills`
--
ALTER TABLE `customer_service_bills`
  MODIFY `cs_bill_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `floor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `measures`
--
ALTER TABLE `measures`
  MODIFY `measure_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `product_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `room_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `service_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `shift_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shift_types`
--
ALTER TABLE `shift_types`
  MODIFY `shift_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse_receipts`
--
ALTER TABLE `warehouse_receipts`
  MODIFY `warehouse_receipt_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouse_receipt_types`
--
ALTER TABLE `warehouse_receipt_types`
  MODIFY `warehouse_receipt_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_cus_id_foreign` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`),
  ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_cus_id_foreign` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `budget_invoices`
--
ALTER TABLE `budget_invoices`
  ADD CONSTRAINT `budget_invoices_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`budget_id`),
  ADD CONSTRAINT `budget_invoices_budget_invoice_type_id_foreign` FOREIGN KEY (`budget_invoice_type_id`) REFERENCES `budget_invoice_types` (`budget_invoice_type_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `budget_invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON UPDATE CASCADE;

--
-- Constraints for table `customer_service_bills`
--
ALTER TABLE `customer_service_bills`
  ADD CONSTRAINT `customer_service_bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_measure_id_foreign` FOREIGN KEY (`measure_id`) REFERENCES `measures` (`measure_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`product_type_id`),
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `product_warehouse_receipts`
--
ALTER TABLE `product_warehouse_receipts`
  ADD CONSTRAINT `product_warehouse_receipts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_warehouse_receipts_warehouse_receipt_id_foreign` FOREIGN KEY (`warehouse_receipt_id`) REFERENCES `warehouse_receipts` (`warehouse_receipt_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_floor_id_foreign` FOREIGN KEY (`floor_id`) REFERENCES `floors` (`floor_id`),
  ADD CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`room_type_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON UPDATE CASCADE;

--
-- Constraints for table `room_bills`
--
ALTER TABLE `room_bills`
  ADD CONSTRAINT `room_bills_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`),
  ADD CONSTRAINT `room_bills_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `room_bookings`
--
ALTER TABLE `room_bookings`
  ADD CONSTRAINT `room_bookings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `room_bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_service_type_id_foreign` FOREIGN KEY (`service_type_id`) REFERENCES `service_types` (`service_type_id`) ON UPDATE CASCADE;

--
-- Constraints for table `service_bills`
--
ALTER TABLE `service_bills`
  ADD CONSTRAINT `service_bills_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `service_bills_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `service_bills_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON UPDATE CASCADE;

--
-- Constraints for table `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `shifts_shift_type_id_foreign` FOREIGN KEY (`shift_type_id`) REFERENCES `shift_types` (`shift_type_id`),
  ADD CONSTRAINT `shifts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`role_id`) ON UPDATE CASCADE;

--
-- Constraints for table `warehouse_receipts`
--
ALTER TABLE `warehouse_receipts`
  ADD CONSTRAINT `warehouse_receipts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `warehouse_receipts_warehouse_receipt_type_id_foreign` FOREIGN KEY (`warehouse_receipt_type_id`) REFERENCES `warehouse_receipt_types` (`warehouse_receipt_type_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
