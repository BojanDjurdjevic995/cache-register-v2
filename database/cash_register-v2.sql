-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 06, 2020 at 09:26 AM
-- Server version: 5.7.26
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cash_register-v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `calculation`
--

DROP TABLE IF EXISTS `calculation`;
CREATE TABLE IF NOT EXISTS `calculation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_value` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `nf_value` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `excise` float DEFAULT NULL,
  `customs` float DEFAULT NULL,
  `other_taxable_expenses` float DEFAULT NULL,
  `non_taxable_expenses` float DEFAULT NULL,
  `purchase_value` float DEFAULT NULL,
  `basis_for_pdv` float DEFAULT NULL,
  `input_pdv` float DEFAULT NULL,
  `price_difference` float DEFAULT NULL,
  `calculated_pdv` float DEFAULT NULL,
  `sales_value` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calculation`
--

INSERT INTO `calculation` (`id`, `name`, `object`, `date`, `document`, `invoice_value`, `discount`, `nf_value`, `tax`, `excise`, `customs`, `other_taxable_expenses`, `non_taxable_expenses`, `purchase_value`, `basis_for_pdv`, `input_pdv`, `price_difference`, `calculated_pdv`, `sales_value`, `created_at`, `updated_at`) VALUES
(1, 'Prodavnica Pečeneg Ilova', '247 - VELEPRODAJA', '2020-07-27', 'FAKTURA IF19+/44930', 1715, 0, 1715, 1, 2, 3, 15, 2, 17, 3, 17, 9, 17, 27, '2020-07-28 06:47:33', '2020-07-28 06:47:33'),
(5, 'Infomedia', 'Banja Luka', '2020-07-14', 'FAKTURA IF77+/223589', 2590, 30, 1, 55, 3, 0.17, 99, 145, 350, 17, 17, 1356, 78, 780, '2020-07-29 10:08:44', '2020-07-29 10:08:44'),
(4, 'Velika Ilova', 'Objekat Ilova', '2020-07-16', 'Dokument Ilova', 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, '2020-07-29 10:04:34', '2020-07-29 10:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `calculation_details`
--

DROP TABLE IF EXISTS `calculation_details`;
CREATE TABLE IF NOT EXISTS `calculation_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calculation_id` int(11) DEFAULT NULL,
  `code` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_name` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` float DEFAULT NULL,
  `purchase_value` float DEFAULT NULL,
  `unit_of_measure` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `input_pdv` float DEFAULT NULL,
  `price_invoice` float DEFAULT NULL,
  `ruc_perc` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `discount_value` float DEFAULT NULL,
  `ruc` float DEFAULT NULL,
  `nf_value` float DEFAULT NULL,
  `calculated_pdv` float DEFAULT NULL,
  `tac` float DEFAULT NULL,
  `value` float DEFAULT NULL,
  `zt` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calculation_details`
--

INSERT INTO `calculation_details` (`id`, `calculation_id`, `code`, `article_name`, `purchase_price`, `purchase_value`, `unit_of_measure`, `quantity`, `input_pdv`, `price_invoice`, `ruc_perc`, `discount`, `discount_value`, `ruc`, `nf_value`, `calculated_pdv`, `tac`, `value`, `zt`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, '8FF73EA', 'ARTIKAL', 1715, 1715, 'KOM', 1, 0, 1715, 0, 0, 0, 0, 1, 85, 0, 1, 85, 1800, '2020-07-28 08:47:14', '2020-07-28 08:47:14'),
(2, 1, '8FF73EA', 'ARTIKAL 2', 1715, 1715, 'KOM', 2, 0, 1715, 0, 0, 0, 0, 1, 85, 0, 1, 85, 1800, '2020-07-28 08:47:15', '2020-07-28 08:47:15'),
(3, 1, '39TR45', 'Coca Cola', 0.9, 0.9, 'KOM', 95, 0.17, 1.3, 3, 2, 22, 14, 7, 17, 3, 9, 7, 1.2, '2020-07-28 09:42:45', '2020-07-28 09:42:45'),
(4, 4, 'Sifra 1', 'Napolitanke', 4, 3, 'KOM', 10, 3, 1, 1, 1, 1, 1, 1, 1, 1, 13, 3, 43, '2020-07-29 10:04:34', '2020-07-29 10:04:34'),
(5, 4, 'Sifra 2', 'Takovo', 3, 4, 'KOM', 400, 4, 4, 4, 4, 4, 4, 4, 4, 4, 34, 4, 8, '2020-07-29 10:04:34', '2020-07-29 10:04:34'),
(6, 5, 'HFR4324', 'Monitor', 35, 35, 'KOM', 15, 17, 33, 2, 3, 17, 2, 25, 15, 2, 17, 3, 258, '2020-07-29 10:08:44', '2020-07-29 10:08:44'),
(7, 5, 'NMIU8342', 'Tastatura', 38, 33, 'KOM', 20, 2, 2, 2, 3, 41, 23, 5, 6, 7, 5, 2, 28, '2020-07-29 10:08:44', '2020-07-29 10:08:44'),
(8, 5, 'CCDF342', 'Mis', 17, 14, 'KOM', 40, 17, 13, 43, 22, 45, 98, 43, 19, 30, 17, 3, 18, '2020-07-29 10:08:44', '2020-07-29 10:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_pib` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_jib` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice` int(11) DEFAULT NULL,
  `delivery note` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dpo` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery date` timestamp NULL DEFAULT NULL,
  `delivery place` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

DROP TABLE IF EXISTS `sale_details`;
CREATE TABLE IF NOT EXISTS `sale_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_of_measure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float DEFAULT NULL,
  `excise` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `value` float DEFAULT NULL,
  `pdv` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Bojan Djurdjevic', 'djurdjevicbojan12@gmail.com', '$2y$10$jM3vqXKADzc5oM2/oaQLzu4eDdTobHKmOkwfNGw39PdGkb.YQ/EUK', '2019-10-28 06:32:36', '2019-10-28 06:32:36');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
