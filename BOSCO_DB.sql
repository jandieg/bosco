-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2017 at 02:01 AM
-- Server version: 5.6.35-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `BOSCO_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_located`
--

CREATE TABLE IF NOT EXISTS `history_located` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `history_location_id` bigint(20) unsigned NOT NULL,
  `pet_id` bigint(20) unsigned NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `history_locations`
--

CREATE TABLE IF NOT EXISTS `history_locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double(10,8) NOT NULL,
  `longitude` double(10,8) NOT NULL,
  `ubigeo_id` int(11) NOT NULL,
  `level` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `address`, `latitude`, `longitude`, `ubigeo_id`, `level`, `created_at`, `updated_at`) VALUES
(1, '524, Pedro Paulet, Distrito de Lima, Provincia de Lima', -12.02680674, -77.05652374, 1, '', '2017-05-25 01:50:51', '2017-05-25 01:50:51'),
(2, '585-665, Veracruz, Distrito de Lima, Provincia de Lima', -12.03322859, -77.06793922, 2, '', '2017-05-25 01:54:11', '2017-05-25 01:54:11'),
(3, '363-389, Avenida Jhon F Kennedy, Distrito de Lima, Provincia de Lima', -12.02571543, -77.06583637, 3, '', '2017-05-25 02:00:08', '2017-05-25 02:00:08'),
(4, '190, Huambo, Distrito de Lima, Provincia de Lima', -12.03910466, -77.04884189, 4, '', '2017-05-25 02:06:59', '2017-05-25 02:06:59'),
(5, ', Chalhuanca, Distrito de Lima, Provincia de Lima', -12.03767762, -77.06356186, 5, '', '2017-05-25 05:15:31', '2017-05-25 05:15:31'),
(6, '448, Ecuador, Distrito de Lima, Provincia de Lima', -12.04044774, -77.05665249, 18, '', '2017-05-26 01:47:07', '2017-05-31 07:39:23'),
(7, ', Rincon, Distrito de Lima, Provincia de Lima', -12.03885283, -77.06012863, 7, '', '2017-05-27 03:00:53', '2017-05-27 03:00:53'),
(8, '493, Avenida Augusto B. Leguia, Distrito de Lima, Provincia de Lima', -12.03436184, -77.05888408, 8, '', '2017-05-27 03:03:18', '2017-05-27 03:03:18'),
(9, '744, Riobamba, Distrito de Lima, Provincia de Lima', -12.03501241, -77.06036466, 9, '', '2017-05-29 16:17:24', '2017-05-29 16:17:24'),
(10, '273, Eloy Ureta, Distrito de Lima, Provincia de Lima', -12.03617451, -77.05357063, 10, '', '2017-05-29 16:22:26', '2017-05-29 16:22:26'),
(11, '1068, Avenida Caceres, Distrito de Lima, Provincia de Lima', -12.03523276, -77.05818671, 11, '', '2017-05-29 16:28:12', '2017-05-30 04:52:07'),
(12, '1449, T Amaru, Distrito de Lima, Provincia de Lima', -12.04139288, -77.06106663, 13, '', '2017-05-30 04:54:02', '2017-05-30 05:05:39'),
(13, '210, Santa Fe, Distrito de Lima, Provincia de Lima', -12.11981527, -76.98959705, 16, '', '2017-05-30 05:06:59', '2017-05-30 15:28:49'),
(14, '16, Calle 1, Callao, Callao', -12.05395720, -77.12244900, 17, '', '2017-05-30 15:31:32', '2017-05-30 15:34:41'),
(15, 'Otuzco, Distrito de Lima, Provincia de Lima', -12.03786310, -77.05654770, 18, '', '2017-05-30 21:51:21', '2017-05-30 21:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE IF NOT EXISTS `pets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `race` enum('cat','dog') COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `owner_id`, `name`, `race`, `gender`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jemma', 'dog', 'male', 'I love Jemma', '2017-05-25 01:50:51', NULL),
(2, 1, '', 'dog', 'male', '', '2017-05-25 01:54:11', NULL),
(3, 1, 'Jimma', 'dog', 'male', 'I love Jimma', '2017-05-25 02:00:08', NULL),
(4, 1, 'Catty', 'dog', 'male', 'I love Catty', '2017-05-25 02:06:59', NULL),
(5, 1, '', 'cat', 'female', 'I found a cat and it is she', '2017-05-25 05:15:31', NULL),
(6, 3, 'Pepe', 'dog', 'male', '', '2017-05-26 01:47:07', '2017-05-31 07:39:23'),
(7, 3, '', 'dog', 'male', '', '2017-05-27 03:00:53', NULL),
(8, 1, 'I lost a cat', 'dog', 'male', '', '2017-05-27 03:03:18', NULL),
(9, 1, 'Catty', 'cat', 'male', 'I lost a catty', '2017-05-29 16:17:24', NULL),
(10, 1, 'Cat', 'cat', 'male', 'I lost a cat', '2017-05-29 16:22:26', NULL),
(11, 1, '', 'dog', 'male', '', '2017-05-29 16:28:12', '2017-05-30 04:52:07'),
(12, 1, 'Baby', 'cat', 'male', '', '2017-05-30 04:54:02', '2017-05-30 05:05:39'),
(13, 1, 'Buddy', 'dog', 'male', '', '2017-05-30 05:06:59', '2017-05-30 15:28:49'),
(14, 1, 'Lovely', 'dog', 'male', '', '2017-05-30 15:31:32', '2017-05-30 15:34:41'),
(15, 5, 'Bibby', 'dog', 'male', '', '2017-05-30 21:51:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pet_id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `width` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `pet_id`, `url`, `width`, `height`, `created_at`, `updated_at`) VALUES
(1, 1, '1.jpg', '', '', '2017-05-25 01:50:51', '2017-05-25 01:50:51'),
(2, 2, '2.jpg', '', '', '2017-05-25 01:54:11', '2017-05-25 01:54:11'),
(3, 3, '3.jpg', '', '', '2017-05-25 02:00:08', '2017-05-25 02:00:08'),
(4, 4, '4.jpg', '', '', '2017-05-25 02:06:59', '2017-05-25 02:06:59'),
(5, 5, '5.jpg', '', '', '2017-05-25 05:15:31', '2017-05-25 05:15:31'),
(6, 6, '6.jpg', '', '', '2017-05-26 01:47:07', '2017-05-26 01:47:07'),
(7, 7, '7.jpg', '', '', '2017-05-27 03:00:53', '2017-05-27 03:00:53'),
(8, 8, '8.jpg', '', '', '2017-05-27 03:03:18', '2017-05-27 03:03:18'),
(9, 9, '9.jpg', '', '', '2017-05-29 16:17:24', '2017-05-29 16:17:24'),
(10, 10, '10.jpg', '', '', '2017-05-29 16:22:26', '2017-05-29 16:22:26'),
(11, 11, '11.jpg', '', '', '2017-05-29 16:28:12', '2017-05-29 16:28:12'),
(12, 12, '12.png', '', '', '2017-05-30 04:54:02', '2017-05-30 05:05:39'),
(13, 13, '13.jpg', '', '', '2017-05-30 05:06:59', '2017-05-30 05:06:59'),
(14, 14, '14.png', '', '', '2017-05-30 15:31:32', '2017-05-30 15:34:41'),
(15, 15, '15.jpg', '', '', '2017-05-30 21:51:21', '2017-05-30 21:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pet_id` bigint(20) unsigned NOT NULL,
  `last_location_id` bigint(20) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `reward` int(11) NOT NULL,
  `code_qr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `pet_id`, `last_location_id`, `date`, `description`, `status`, `reward`, `code_qr`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-05-25 09:50:27', 'I lost him at the street', 'lost', 100, '', '2017-05-25 01:50:51', '2017-05-25 01:50:51'),
(2, 2, 2, '2017-05-25 09:53:49', 'I found a dog at the street', 'found', 100, '', '2017-05-25 01:54:11', '2017-05-25 01:54:11'),
(3, 3, 3, '2017-05-25 09:59:25', 'I lost him at the Av Jhon F Kenedy', 'lost', 200, '', '2017-05-25 02:00:08', '2017-05-25 02:00:08'),
(4, 4, 4, '2017-05-25 10:06:41', 'I lost her at home', 'lost', 200, '', '2017-05-25 02:06:59', '2017-05-25 02:06:59'),
(7, 7, 7, '2017-05-10 21:59:58', 'weewe', 'found', 23, '', '2017-05-27 03:00:53', '2017-05-27 03:00:53'),
(6, 6, 6, '2017-05-24 07:00:00', 'Descripcion', 'lost', 0, '', '2017-05-26 01:47:07', '2017-05-31 07:39:23'),
(8, 8, 8, '2017-05-27 11:03:14', '', 'found', 200, '', '2017-05-27 03:03:18', '2017-05-27 03:03:18'),
(9, 9, 9, '2017-05-30 00:16:00', 'I lost a catty at the street', 'lost', 100, '', '2017-05-29 16:17:24', '2017-05-29 16:17:24'),
(10, 10, 10, '2017-05-30 00:19:00', 'I lost a cat at the street', 'lost', 100, '', '2017-05-29 16:22:26', '2017-05-29 16:22:26'),
(11, 11, 11, '2017-05-31 02:58:00', '', 'lost', 100, '', '2017-05-29 16:28:12', '2017-05-30 04:52:07'),
(12, 12, 12, '2017-05-30 12:52:00', '', 'lost', 100, '', '2017-05-30 04:54:02', '2017-05-30 05:05:39'),
(13, 13, 13, '2017-05-30 13:06:00', '', 'lost', 20, '', '2017-05-30 05:06:59', '2017-05-30 15:28:49'),
(14, 14, 14, '2017-05-30 23:30:00', '', 'lost', 30, '', '2017-05-30 15:31:32', '2017-05-30 15:34:41'),
(15, 15, 15, '2017-05-31 05:50:00', '', 'lost', 100, '', '2017-05-30 21:51:21', '2017-05-30 21:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `ubigeos`
--

CREATE TABLE IF NOT EXISTS `ubigeos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ubigeo_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ubigeos`
--

INSERT INTO `ubigeos` (`id`, `department`, `city`, `district`, `ubigeo_code`, `created_at`, `updated_at`) VALUES
(1, 'Provincia de Lima', 'Distrito de Lima', 'Pedro Paulet', '15102', '2017-05-25 01:50:51', '2017-05-25 01:50:51'),
(2, 'Provincia de Lima', 'Distrito de Lima', 'Veracruz', '15101', '2017-05-25 01:54:11', '2017-05-25 01:54:11'),
(3, 'Provincia de Lima', 'Distrito de Lima', 'Avenida Jhon F Kennedy', '15103', '2017-05-25 02:00:08', '2017-05-25 02:00:08'),
(4, 'Provincia de Lima', 'Distrito de Lima', 'Huambo', '15079', '2017-05-25 02:06:59', '2017-05-25 02:06:59'),
(5, 'Provincia de Lima', 'Distrito de Lima', 'Chalhuanca', '15079', '2017-05-25 05:15:31', '2017-05-25 05:15:31'),
(6, 'Provincia de Lima', 'Distrito de Lima', 'Ecuador', '15079', '2017-05-26 01:47:07', '2017-05-26 01:47:07'),
(7, 'Provincia de Lima', 'Distrito de Lima', 'Rincon', '15079', '2017-05-27 03:00:53', '2017-05-27 03:00:53'),
(8, 'Provincia de Lima', 'Distrito de Lima', 'Avenida Augusto B. Leguia', '15101', '2017-05-27 03:03:18', '2017-05-27 03:03:18'),
(9, 'Provincia de Lima', 'Distrito de Lima', 'Riobamba', '15101', '2017-05-29 16:17:24', '2017-05-29 16:17:24'),
(10, 'Provincia de Lima', 'Distrito de Lima', 'Eloy Ureta', '15101', '2017-05-29 16:22:26', '2017-05-29 16:22:26'),
(11, 'Provincia de Lima', 'Distrito de Lima', 'Avenida Caceres', '15101', '2017-05-30 04:49:23', '2017-05-30 04:49:23'),
(12, 'Provincia de Lima', 'Distrito de Lima', 'Enrique Meiggs', '15079', '2017-05-30 04:54:02', '2017-05-30 04:54:02'),
(13, 'Provincia de Lima', 'Distrito de Lima', 'T Amaru', '15079', '2017-05-30 05:05:39', '2017-05-30 05:05:39'),
(14, 'Provincia de Lima', 'Distrito de Lima', 'Jr. Crespo Y Castillo', '15079', '2017-05-30 05:06:59', '2017-05-30 05:06:59'),
(15, 'Provincia de Lima', 'Santiago de Surco', 'Santa Fe', '15038', '2017-05-30 15:24:34', '2017-05-30 15:24:34'),
(16, 'Provincia de Lima', 'Distrito de Lima', 'Santa Fe', '15038', '2017-05-30 15:28:49', '2017-05-30 15:28:49'),
(17, 'Callao', 'Callao', 'Calle 1', '07001', '2017-05-30 15:31:32', '2017-05-30 15:31:32'),
(18, 'Provincia de Lima', 'Distrito de Lima', 'Otuzco', '15079', '2017-05-30 21:51:21', '2017-05-30 21:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `api_token` (`api_token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `phone`, `email`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Shanbo', 'Liang', '13224116419', 'shanboliang@mail.com', '$2y$10$R7dG8BxsWgdjS44q7BxIT.PAA4wsc.dCweodkq6o7yRkjR8uGvhVC', 'cjqspliIO36cem6MLQ67pPzVSdEICQM8lFox4GqcFIdZVskVbD3n75G52Gc2', 'F3eESpfVvAT1gG6xm9pmmjdfhzY3SRnvy3lsFtQ5TR6h6loaalK0iLbPJnb6', '2017-05-25 01:49:25', '2017-06-01 13:47:38'),
(2, 'Haolin', 'Ming', '12356487498', 'haolinming@mail.com', '$2y$10$Ij6fu1mVhtMgl9jnDCDbe.WsmzbqEuPeGoyfdoILcAKDyvIeQm9v6', 'sHzeOmVWpPa1UtCfCD56sLRcNZmuOUo0gdciwTeQoS1ROwDxBOQv44bAcpVH', 'F3eESpfVvAT1gG6xm9pmmjdfhzY3SRnvy3lsFtQ5TR6h6loaalK0iLbPJnb3', '2017-05-26 01:31:53', '2017-05-30 22:28:07'),
(3, 'Juan Diego', 'Barclay', '994694284', 'jandieg@outlook.com', '$2y$10$klTUp75jOI.Lyc/nXDEnLOx6Q8LITR/fyJz3XvHd0S4/O0l90E5XW', 'GJLut9mvrfDNMNWY5rNUAGZRbQgGBVtnlDeYcibWzjo6ForoN96IxvVT47Av', 'pb0nI6FetwNqgd2dqW6fOakLjmLCuj9Ni5hgJaMSj0x25dShZAB5HFQksuTv', '2017-05-26 01:45:48', '2017-06-01 10:20:06'),
(4, 'Jalak', 'James', '46511614798', 'jalajames@kkk.com', '$2y$10$oeXrV8r5l70/lL5snXzTzO/Y3CrqoDyPpntKzAkBvM7QMYvn4Zibq', '2Eh35ZNNJTetB65DtUK7tisyKNYNcCXxNIdsMwfnDYLeTxrFmkTPjavy0GU8', 'AakcaENM3YI07ZmLMN5XB4GuPP4cVRgjc4Z7tiDyTWtacTU5HcKbvrTSlB8c', '2017-05-27 04:28:12', '2017-05-27 06:21:56'),
(5, 'Paul', 'Albert', '', 'paulalbert1982@gmail.com', '$2y$10$x4P6jrmQZqMZ6ZLvv7f8beEr52BU3pECPEtmIaLEyG78z6xjsLt7y', 'HWImEWrwBPmjRnscVT6EM0rZUPIrTTjNY38Locbs2Leed9qQRd0j5ZkczZxH', '', '2017-05-30 21:29:52', '2017-06-01 13:48:01'),
(6, 'Sun', 'Set', '', 'sunset1115@yahoo.com', '$2y$10$qE9WtXnJrTsq2nOL2PjY/OLQsXmpQtSk3bXiE/IZLV3M4aquByKli', NULL, 'Rl1NGJw4a9d3qb52gw2G5HmPfwqcOmed2qAsvjOVFKSdn2XbOKYzD6EhNdjF', '2017-05-30 23:23:23', '2017-05-30 23:23:23'),
(7, 'Jin', 'JinRu', '', 'jin.jinru840430@gmail.com', '$2y$10$bfIJDzY0qdpUq.A/n4/kQ.89yy3J8fAVr9/1U7BgCp4X4V4oywb5O', NULL, 'f7kbbu7xNgY7ebQSC59MPHzWOQ7HQqqN2jAgUoxnshnWAaFJrqXlskqWHDXi', '2017-05-30 23:25:08', '2017-05-30 23:25:08'),
(8, 'Alejandro', 'Ausejo', '', 'alejandroausejo@hotmail.com', '$2y$10$sxkpPRg0kwI1nMCugDywRecxA0X2neOZk81ZlAJIMQ23qYVoVa3s.', NULL, 'vxAvJpzrOBXmNdiyKGI9hE35uGRDLzVh7vb3FmIQj77JI8tmfzp5rpX1FEMi', '2017-05-30 23:33:44', '2017-05-30 23:33:44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
