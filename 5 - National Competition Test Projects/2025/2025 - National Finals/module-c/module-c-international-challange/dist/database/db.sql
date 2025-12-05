-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2025 at 09:55 PM
-- Server version: 8.0.41
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wsuk25_module_c_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int UNSIGNED NOT NULL,
  `cat_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Graduation'),
(2, 'Festival'),
(3, 'Competition'),
(4, 'Private Session'),
(5, 'Wedding/Engagement'),
(6, 'Birthday'),
(7, 'School Events'),
(8, 'Charity'),
(9, 'Corporate'),
(10, 'Pet Events'),
(11, 'Seasonal'),
(12, 'Photography Walks'),
(13, 'Community');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int UNSIGNED NOT NULL,
  `cust_fname` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_lname` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_addr1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_addr2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cust_postcode` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cust_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_fname`, `cust_lname`, `cust_email`, `cust_phone`, `cust_addr1`, `cust_addr2`, `cust_postcode`, `cust_password`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Doe', 'john.doe@mail.com', '07123456689', '123 Street', NULL, 'AB12CD', '$2y$12$bSrsykljuXJ2ia57yrPOU.bI0ydq0P9K0qlVgdJW5hCr1jA1JRtWG', '2025-09-18 20:53:32', '2025-09-18 20:53:32'),
(2, 'Alice', 'Smith', 'alice.smith@mail.com', '07111222333', '456 Avenue', NULL, 'CD34EF', '$2y$12$O/TkeSQMCKfio/NyFWZda..Z5kSq9dN0jiGfXeTdpN7K7aYzf7UKO', '2025-09-18 20:53:32', '2025-09-18 20:53:32'),
(3, 'Michael', 'Brown', 'michael.brown@mail.com', '07987654321', '789 Boulevard', NULL, 'EF56GH', '$2y$12$MqhHGvEM0lO3Eba6oyXjXu16.Az85cAIr5JGD6s5dfTzsE/kgEp1G', '2025-09-18 20:53:32', '2025-09-18 20:53:32'),
(4, 'Emily', 'Davis', 'emily.davis@mail.com', '07456789123', '22 Green Lane', 'Flat 3A', 'GH78IJ', '$2y$12$j6KYMYZIj1/33KDwPl2y1uY50SjsojGGneWfDX.ezMyeEaJV5/N9y', '2025-09-18 20:53:33', '2025-09-18 20:53:33'),
(5, 'Olivia', 'Wilson', 'olivia.wilson@mail.com', '07555667788', '10 Kings Road', NULL, 'JK90LM', '$2y$12$p7DQa6za6hHF6U2nuoI3PO0NgXA5fJ8XNJN81rXheq7P8klJXUCba', '2025-09-18 20:53:33', '2025-09-18 20:53:33'),
(6, 'Sophie', 'Taylor', 'sophie.taylor@mail.com', '07711223344', '5 Orchard View', NULL, 'MN12OP', '$2y$12$87FSyAZmAtuvcGOFTL62Ye5UJC4xJ1RC7IyG6RXAcf5j7eHhtKlia', '2025-09-18 20:53:33', '2025-09-18 20:53:33'),
(7, 'David', 'Smith', 'david.smith@mail.com', '07741283244', '2 Paddington Street', NULL, 'SW12EP', '$2y$12$f5GewIb/vNmyaAeH.D4lG.V6GQwzmAVG9dWHJ2br8PBbuOou5mHzu', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(8, 'Marcus', 'Wilson', 'marcus.wilson@mail.com', '07515647758', '10 Kings Road', NULL, 'JK90LM', '$2y$12$dh.vzz40vmy5tsu.VvvTL.mwoc7BsLtCmifT/h/Ea0E6R0PBg.YM6', '2025-09-18 20:53:34', '2025-09-18 20:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int UNSIGNED NOT NULL,
  `cat_id` int UNSIGNED NOT NULL,
  `event_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_type` enum('PUBLIC','PRIVATE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `event_note` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_folder_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `cat_id`, `event_name`, `event_type`, `event_city`, `event_date`, `event_time`, `event_note`, `event_folder_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Portsmouth Graduation 2025', 'PUBLIC', 'Portsmouth', '2025-07-01', '14:00:00', 'Open to public. Photos available by student name.', 'public_events/portsmouth_graduation_2025', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(2, 10, 'Summer Dog Show', 'PUBLIC', 'Chichester', '2025-08-10', '12:00:00', 'Open event. Pet owners can search by dog name.', 'public_events/summer_dog_show', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(3, 3, 'Bournemouth Dance Finals', 'PUBLIC', 'Bournemouth', '2025-09-03', '16:00:00', NULL, 'public_events/bournemouth_dance_finals', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(4, 2, 'Vintage Car Rally', 'PUBLIC', 'Brighton', '2025-08-05', '13:00:00', 'Free for all. Classics and modern cars.', 'public_events/vintage_car_rally', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(5, 2, 'Community Art Festival', 'PUBLIC', 'Portsmouth', '2025-07-22', '10:00:00', 'Local artists exhibit works.', 'public_events/community_art_festival', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(6, 13, 'Hastings Beach BBQ', 'PUBLIC', 'Hastings', '2025-07-19', '18:00:00', NULL, 'public_events/hastings_beach_bbq', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(7, 13, 'Public Open Mic Night', 'PUBLIC', 'Reading', '2025-07-12', '20:00:00', 'Singers and poets welcome.', 'public_events/public_open_mic_night', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(8, 2, 'Science Expo', 'PUBLIC', 'Oxford', '2025-08-15', '11:00:00', NULL, 'public_events/science_expo', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(9, 2, 'Food Truck Fiesta', 'PUBLIC', 'Southampton', '2025-07-28', '12:00:00', 'Try 20+ food vendors.', 'public_events/food_truck_fiesta', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(10, 3, 'Marathon Finish Line', 'PUBLIC', 'London', '2025-10-01', '14:00:00', 'Public cheering area and photos.', 'public_events/marathon_finish_line', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(11, 12, 'Photography Walk', 'PUBLIC', 'Bath', '2025-06-30', '09:00:00', NULL, 'public_events/photography_walk', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(12, 11, 'Community Fireworks Night', 'PUBLIC', 'Exeter', '2025-11-05', '19:00:00', 'Free entry, bring blankets.', 'public_events/community_fireworks_night', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(13, 2, 'Portsmouth Food Festival', 'PUBLIC', 'Portsmouth', '2025-07-18', '12:00:00', 'Open to all. Food stalls and live music.', 'public_events/portsmouth_food_festival', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(14, 7, 'University Open Day', 'PUBLIC', 'Southampton', '2025-09-14', '10:00:00', 'For prospective students and families.', 'public_events/university_open_day', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(15, 8, 'Charity Fun Run', 'PUBLIC', 'Guildford', '2025-08-20', '09:30:00', NULL, 'public_events/charity_fun_run', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(16, 4, 'Smith Family Portraits', 'PRIVATE', 'Southampton', '2025-06-15', '10:30:00', 'Private booking. Access restricted to family.', 'private_events/smith_family_portraits', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(17, 5, 'Olivia & Marcus Wedding', 'PRIVATE', 'Winchester', '2025-06-28', '15:00:00', NULL, 'private_events/olivia_marcus_wedding', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(18, 7, 'St. Mary’s Year 11 Prom', 'PRIVATE', 'Guildford', '2025-07-05', '19:00:00', 'Private school prom. Code required to access photos.', 'private_events/st_marys_year_11_prom', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(19, 4, 'Jones Family Reunion', 'PRIVATE', 'Oxford', '2025-07-14', '13:30:00', NULL, 'private_events/jones_family_reunion', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(20, 9, 'Corporate Headshots', 'PRIVATE', 'London', '2025-08-01', '09:00:00', 'Photoshoot for internal use only.', 'private_events/corporate_headshots', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(21, 4, 'Lucy’s 18th Birthday', 'PRIVATE', 'Reading', '2025-09-10', '18:00:00', 'Private garden party celebration.', 'private_events/lucys_18th_birthday', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(22, 5, 'Wilson Engagement Party', 'PRIVATE', 'Bath', '2025-08-12', '17:00:00', NULL, 'private_events/wilson_engagement_party', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(23, 4, 'Model Portfolio Shoot', 'PRIVATE', 'Brighton', '2025-07-25', '14:00:00', 'Booked model sessions only.', 'private_events/model_portfolio_shoot', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(24, 4, 'Harris Baby Shower', 'PRIVATE', 'Bristol', '2025-06-27', '15:00:00', 'Photos shared only with attendees.', 'private_events/harris_baby_shower', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(25, 11, 'Studio Christmas Session', 'PRIVATE', 'Southampton', '2025-12-12', '11:00:00', NULL, 'private_events/studio_christmas_session', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(26, 10, 'Pet Portraits Day', 'PRIVATE', 'Portsmouth', '2025-07-03', '10:00:00', 'Private bookings only.', 'private_events/pet_portraits_day', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(27, 1, 'Graduation Photos Retake', 'PRIVATE', 'Guildford', '2025-07-15', '14:00:00', 'Only for students who missed main event.', 'private_events/graduation_photos_retake', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(28, 9, 'Client Branding Session', 'PRIVATE', 'Oxford', '2025-09-03', '09:00:00', NULL, 'private_events/client_branding_session', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(29, 11, 'Family Christmas Portraits', 'PRIVATE', 'Chichester', '2025-12-03', '13:00:00', 'Access via family login only.', 'private_events/family_christmas_portraits', '2025-09-18 20:53:34', '2025-09-18 20:53:34'),
(30, 5, 'Engagement Shoot – Priya & Jay', 'PRIVATE', 'Winchester', '2025-10-12', '15:00:00', NULL, 'private_events/engagement_shoot_priya_jay', '2025-09-18 20:53:34', '2025-09-18 20:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `event_accesses`
--

CREATE TABLE `event_accesses` (
  `event_id` int UNSIGNED NOT NULL,
  `cust_id` int UNSIGNED NOT NULL,
  `access_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_granted_date` timestamp NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_accesses`
--

INSERT INTO `event_accesses` (`event_id`, `cust_id`, `access_code`, `access_granted_date`, `is_active`) VALUES
(19, 1, 'uPf4azx152', '2025-09-18 20:53:34', 1),
(21, 1, 'uSE0gd1P5j', '2025-09-18 20:53:34', 1),
(22, 1, 'k9jrEKLlFs', '2025-09-18 20:53:34', 1),
(24, 1, 'izWOCQgjpg', '2025-09-18 20:53:34', 1),
(26, 1, 'MqDPnCgcfm', '2025-09-18 20:53:34', 1),
(30, 1, 'pWJu8Ccy0b', '2025-09-18 20:53:34', 1),
(16, 2, 'E92HOfuZGk', '2025-09-18 20:53:34', 1),
(26, 2, 'ra0UHnEZjC', '2025-09-18 20:53:34', 1),
(29, 2, 'HoNvc0yn8z', '2025-09-18 20:53:34', 1),
(18, 3, 'IOF83FN5cn', '2025-09-18 20:53:34', 1),
(21, 3, 'M9sA46rSO0', '2025-09-18 20:53:34', 1),
(23, 3, 'c1jTjiULFf', '2025-09-18 20:53:34', 1),
(25, 3, 'zzHrVgNCzV', '2025-09-18 20:53:34', 1),
(26, 3, 'J7P7OudHYM', '2025-09-18 20:53:34', 1),
(30, 3, 'MxZgNs76pu', '2025-09-18 20:53:34', 1),
(17, 4, 'Kyd83CIBSD', '2025-09-18 20:53:34', 1),
(18, 4, 's1Au3uuTNZ', '2025-09-18 20:53:34', 1),
(21, 4, 'va6hRtNbcG', '2025-09-18 20:53:34', 1),
(25, 4, 'ZVeUPRvClO', '2025-09-18 20:53:34', 1),
(26, 4, 'N5EqewUVlL', '2025-09-18 20:53:34', 1),
(28, 4, 'Hb39BO17J1', '2025-09-18 20:53:34', 1),
(30, 4, 'tN7xUXonyA', '2025-09-18 20:53:34', 1),
(17, 5, 'N6BzwcNy5T', '2025-09-18 20:53:34', 1),
(19, 5, 's2vZjzKTtj', '2025-09-18 20:53:34', 1),
(22, 5, 'qT3Qh6astn', '2025-09-18 20:53:34', 1),
(24, 5, 'OuFz9CQWY3', '2025-09-18 20:53:34', 1),
(26, 5, 'Z4LlmHZ9ZY', '2025-09-18 20:53:34', 1),
(27, 5, 'aMTSmffKtC', '2025-09-18 20:53:34', 1),
(18, 6, 'hCTNaY8l5Q', '2025-09-18 20:53:34', 1),
(20, 6, 'lGD9wGQrE0', '2025-09-18 20:53:34', 1),
(21, 6, 'j98pNu2dsL', '2025-09-18 20:53:34', 1),
(22, 6, 'Z0OLNtJYBC', '2025-09-18 20:53:34', 1),
(23, 6, 'pv7F1W9pLB', '2025-09-18 20:53:34', 1),
(24, 6, 'rsqqZu0VKe', '2025-09-18 20:53:34', 1),
(26, 6, 'xSEY48Sqr4', '2025-09-18 20:53:34', 1),
(28, 6, 'acKIhnUcDX', '2025-09-18 20:53:34', 1),
(30, 6, '60QVGUCFLn', '2025-09-18 20:53:34', 1),
(16, 7, 'UneNty3xVr', '2025-09-18 20:53:34', 1),
(24, 7, 'uUkSdrKKCp', '2025-09-18 20:53:34', 1),
(26, 7, 'sRnCBf8Xc1', '2025-09-18 20:53:34', 1),
(29, 7, 't8xkx4EcrV', '2025-09-18 20:53:34', 1),
(17, 8, '3UkgqGVTI8', '2025-09-18 20:53:34', 1),
(19, 8, 'K7LIielo0m', '2025-09-18 20:53:34', 1),
(22, 8, 'ghpq7Kkk55', '2025-09-18 20:53:34', 1),
(24, 8, 'fLEYyqwFe6', '2025-09-18 20:53:34', 1),
(26, 8, 'IyrhSeDEZg', '2025-09-18 20:53:34', 1),
(28, 8, 'zBfv5MQEPW', '2025-09-18 20:53:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_21_115420_create_personal_access_tokens_table', 1),
(5, '2025_06_22_104405_create_orders_table', 1),
(6, '2025_06_22_105600_create_picture_sizes_table', 1),
(7, '2025_06_22_105901_create_categories_table', 1),
(8, '2025_06_22_110123_create_events_table', 1),
(9, '2025_06_22_121958_create_pictures_table', 1),
(10, '2025_06_22_124322_create_event_accesses_table', 1),
(11, '2025_06_22_124652_create_order_pictures_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int UNSIGNED NOT NULL,
  `cust_id` int UNSIGNED NOT NULL,
  `order_date` date NOT NULL,
  `order_note` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` enum('confirmed','paid','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'confirmed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cust_id`, `order_date`, `order_note`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-09-18', NULL, 'confirmed', '2025-09-18 20:53:35', '2025-09-18 20:53:35'),
(2, 1, '2025-08-29', 'Ut ea dolor ut et.', 'confirmed', '2025-09-18 20:53:35', '2025-09-18 20:53:35'),
(3, 1, '2025-10-02', NULL, 'paid', '2025-09-18 20:53:35', '2025-09-18 20:53:35'),
(4, 1, '2025-10-08', 'Aut consectetur velit error consequatur iure.', 'paid', '2025-09-18 20:53:35', '2025-09-18 20:53:35'),
(5, 1, '2025-07-18', NULL, 'cancelled', '2025-09-18 20:53:35', '2025-09-18 20:53:35'),
(6, 1, '2025-10-12', 'Et enim incidunt culpa vero.', 'cancelled', '2025-09-18 20:53:35', '2025-09-18 20:53:35'),
(7, 1, '2025-09-13', NULL, 'confirmed', '2025-09-18 20:53:35', '2025-09-18 20:53:35'),
(8, 1, '2025-09-28', 'Harum voluptatibus asperiores illum qui voluptas.', 'paid', '2025-09-18 20:53:35', '2025-09-18 20:53:35'),
(9, 1, '2025-09-03', NULL, 'cancelled', '2025-09-18 20:53:35', '2025-09-18 20:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_pictures`
--

CREATE TABLE `order_pictures` (
  `order_id` int UNSIGNED NOT NULL,
  `pic_id` int UNSIGNED NOT NULL,
  `pic_size_id` int UNSIGNED NOT NULL,
  `pic_qty` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_pictures`
--

INSERT INTO `order_pictures` (`order_id`, `pic_id`, `pic_size_id`, `pic_qty`) VALUES
(1, 1, 1, 2),
(1, 5, 3, 2),
(2, 9, 4, 10),
(2, 15, 4, 5),
(3, 5, 3, 2),
(3, 7, 1, 10),
(3, 16, 3, 1),
(4, 20, 7, 10),
(5, 7, 1, 10),
(5, 13, 6, 1),
(5, 15, 5, 5),
(6, 24, 3, 12),
(7, 8, 2, 3),
(8, 12, 4, 6),
(9, 3, 2, 4),
(9, 10, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `pic_id` int UNSIGNED NOT NULL,
  `event_id` int UNSIGNED NOT NULL,
  `cat_id` int UNSIGNED NOT NULL,
  `pic_name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_upload_date` timestamp NOT NULL,
  `pic_locator` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_upload_note` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `pic_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`pic_id`, `event_id`, `cat_id`, `pic_name`, `pic_upload_date`, `pic_locator`, `pic_upload_note`, `pic_is_active`, `pic_path`) VALUES
(1, 1, 1, 'event_1_pic_1.jpg', '2025-07-01 23:00:00', 'E1P1', 'Eaque nisi quia perferendis.', 1, 'public_events/portsmouth_graduation_2025/event_1_pic_1.jpg'),
(2, 1, 1, 'event_1_pic_2.jpg', '2025-07-01 23:00:00', 'E1P2', 'Iure itaque aut quia eos blanditiis.', 1, 'public_events/portsmouth_graduation_2025/event_1_pic_2.jpg'),
(3, 1, 1, 'event_1_pic_3.jpg', '2025-07-01 23:00:00', 'E1P3', 'Dolorem beatae voluptatibus sit eos rerum.', 1, 'public_events/portsmouth_graduation_2025/event_1_pic_3.jpg'),
(4, 1, 1, 'event_1_pic_4.jpg', '2025-07-01 23:00:00', 'E1P4', NULL, 1, 'public_events/portsmouth_graduation_2025/event_1_pic_4.jpg'),
(5, 2, 10, 'event_2_pic_1.jpg', '2025-08-10 23:00:00', 'E2P5', 'Et dolorem nemo voluptas nemo dolorem natus et.', 1, 'public_events/summer_dog_show/event_2_pic_1.jpg'),
(6, 2, 10, 'event_2_pic_2.jpg', '2025-08-10 23:00:00', 'E2P6', 'Et rerum illo neque.', 1, 'public_events/summer_dog_show/event_2_pic_2.jpg'),
(7, 2, 10, 'event_2_pic_3.jpg', '2025-08-10 23:00:00', 'E2P7', NULL, 1, 'public_events/summer_dog_show/event_2_pic_3.jpg'),
(8, 2, 10, 'event_2_pic_4.jpg', '2025-08-10 23:00:00', 'E2P8', 'Ut ratione atque blanditiis provident.', 1, 'public_events/summer_dog_show/event_2_pic_4.jpg'),
(9, 2, 10, 'event_2_pic_5.jpg', '2025-08-10 23:00:00', 'E2P9', NULL, 1, 'public_events/summer_dog_show/event_2_pic_5.jpg'),
(10, 3, 3, 'event_3_pic_1.jpg', '2025-09-03 23:00:00', 'E3P10', NULL, 1, 'public_events/bournemouth_dance_finals/event_3_pic_1.jpg'),
(11, 3, 3, 'event_3_pic_2.jpg', '2025-09-03 23:00:00', 'E3P11', NULL, 1, 'public_events/bournemouth_dance_finals/event_3_pic_2.jpg'),
(12, 3, 3, 'event_3_pic_3.jpg', '2025-09-03 23:00:00', 'E3P12', 'Iure quis aut dolorum qui sunt.', 1, 'public_events/bournemouth_dance_finals/event_3_pic_3.jpg'),
(13, 3, 3, 'event_3_pic_4.jpg', '2025-09-03 23:00:00', 'E3P13', NULL, 1, 'public_events/bournemouth_dance_finals/event_3_pic_4.jpg'),
(14, 4, 2, 'event_4_pic_1.jpg', '2025-08-05 23:00:00', 'E4P14', 'Officia et excepturi at accusamus facere ea.', 1, 'public_events/vintage_car_rally/event_4_pic_1.jpg'),
(15, 4, 2, 'event_4_pic_2.jpg', '2025-08-05 23:00:00', 'E4P15', NULL, 1, 'public_events/vintage_car_rally/event_4_pic_2.jpg'),
(16, 4, 2, 'event_4_pic_3.jpg', '2025-08-05 23:00:00', 'E4P16', 'Eum porro dolorem omnis illo.', 1, 'public_events/vintage_car_rally/event_4_pic_3.jpg'),
(17, 4, 2, 'event_4_pic_4.jpg', '2025-08-05 23:00:00', 'E4P17', NULL, 1, 'public_events/vintage_car_rally/event_4_pic_4.jpg'),
(18, 4, 2, 'event_4_pic_5.jpg', '2025-08-05 23:00:00', 'E4P18', NULL, 1, 'public_events/vintage_car_rally/event_4_pic_5.jpg'),
(19, 4, 2, 'event_4_pic_6.jpg', '2025-08-05 23:00:00', 'E4P19', NULL, 1, 'public_events/vintage_car_rally/event_4_pic_6.jpg'),
(20, 4, 2, 'event_4_pic_7.jpg', '2025-08-05 23:00:00', 'E4P20', 'Nam amet eum officia enim dolorem laboriosam.', 1, 'public_events/vintage_car_rally/event_4_pic_7.jpg'),
(21, 5, 2, 'event_5_pic_1.jpg', '2025-07-22 23:00:00', 'E5P21', 'Qui adipisci cumque at delectus.', 1, 'public_events/community_art_festival/event_5_pic_1.jpg'),
(22, 5, 2, 'event_5_pic_2.jpg', '2025-07-22 23:00:00', 'E5P22', 'Consectetur temporibus ut mollitia et dolores.', 1, 'public_events/community_art_festival/event_5_pic_2.jpg'),
(23, 5, 2, 'event_5_pic_3.jpg', '2025-07-22 23:00:00', 'E5P23', 'Suscipit numquam ut magnam incidunt nihil cum.', 1, 'public_events/community_art_festival/event_5_pic_3.jpg'),
(24, 5, 2, 'event_5_pic_4.jpg', '2025-07-22 23:00:00', 'E5P24', NULL, 1, 'public_events/community_art_festival/event_5_pic_4.jpg'),
(25, 6, 13, 'event_6_pic_1.jpg', '2025-07-19 23:00:00', 'E6P25', 'Quae ea hic dolorum ducimus beatae quo non.', 1, 'public_events/hastings_beach_bbq/event_6_pic_1.jpg'),
(26, 6, 13, 'event_6_pic_2.jpg', '2025-07-19 23:00:00', 'E6P26', 'Quo repellendus rerum voluptatibus sed.', 1, 'public_events/hastings_beach_bbq/event_6_pic_2.jpg'),
(27, 6, 13, 'event_6_pic_3.jpg', '2025-07-19 23:00:00', 'E6P27', NULL, 1, 'public_events/hastings_beach_bbq/event_6_pic_3.jpg'),
(28, 7, 13, 'event_7_pic_1.jpg', '2025-07-12 23:00:00', 'E7P28', 'Quos maiores dolor qui et omnis est fugit.', 1, 'public_events/public_open_mic_night/event_7_pic_1.jpg'),
(29, 7, 13, 'event_7_pic_2.jpg', '2025-07-12 23:00:00', 'E7P29', 'Aut quis nisi dolores illum est eaque.', 1, 'public_events/public_open_mic_night/event_7_pic_2.jpg'),
(30, 7, 13, 'event_7_pic_3.jpg', '2025-07-12 23:00:00', 'E7P30', NULL, 1, 'public_events/public_open_mic_night/event_7_pic_3.jpg'),
(31, 7, 13, 'event_7_pic_4.jpg', '2025-07-12 23:00:00', 'E7P31', NULL, 1, 'public_events/public_open_mic_night/event_7_pic_4.jpg'),
(32, 8, 2, 'event_8_pic_1.jpg', '2025-08-15 23:00:00', 'E8P32', NULL, 1, 'public_events/science_expo/event_8_pic_1.jpg'),
(33, 8, 2, 'event_8_pic_2.jpg', '2025-08-15 23:00:00', 'E8P33', 'Et ea cum aliquid.', 1, 'public_events/science_expo/event_8_pic_2.jpg'),
(34, 8, 2, 'event_8_pic_3.jpg', '2025-08-15 23:00:00', 'E8P34', 'Sed et a sit qui id vel totam.', 1, 'public_events/science_expo/event_8_pic_3.jpg'),
(35, 9, 2, 'event_9_pic_1.jpg', '2025-07-28 23:00:00', 'E9P35', 'Vel et veniam eum explicabo minus accusamus.', 1, 'public_events/food_truck_fiesta/event_9_pic_1.jpg'),
(36, 9, 2, 'event_9_pic_2.jpg', '2025-07-28 23:00:00', 'E9P36', NULL, 1, 'public_events/food_truck_fiesta/event_9_pic_2.jpg'),
(37, 9, 2, 'event_9_pic_3.jpg', '2025-07-28 23:00:00', 'E9P37', NULL, 1, 'public_events/food_truck_fiesta/event_9_pic_3.jpg'),
(38, 9, 2, 'event_9_pic_4.jpg', '2025-07-28 23:00:00', 'E9P38', 'Sapiente nam voluptatem magnam fugiat.', 1, 'public_events/food_truck_fiesta/event_9_pic_4.jpg'),
(39, 10, 3, 'event_10_pic_1.jpg', '2025-10-01 23:00:00', 'E10P39', NULL, 1, 'public_events/marathon_finish_line/event_10_pic_1.jpg'),
(40, 10, 3, 'event_10_pic_2.jpg', '2025-10-01 23:00:00', 'E10P40', 'Qui quae quia dolore deserunt magnam.', 1, 'public_events/marathon_finish_line/event_10_pic_2.jpg'),
(41, 10, 3, 'event_10_pic_3.jpg', '2025-10-01 23:00:00', 'E10P41', 'Rerum amet qui voluptatem aut.', 1, 'public_events/marathon_finish_line/event_10_pic_3.jpg'),
(42, 10, 3, 'event_10_pic_4.jpg', '2025-10-01 23:00:00', 'E10P42', 'Mollitia illum et eum cupiditate.', 1, 'public_events/marathon_finish_line/event_10_pic_4.jpg'),
(43, 10, 3, 'event_10_pic_5.jpg', '2025-10-01 23:00:00', 'E10P43', NULL, 1, 'public_events/marathon_finish_line/event_10_pic_5.jpg'),
(44, 11, 12, 'event_11_pic_1.jpg', '2025-06-30 23:00:00', 'E11P44', 'Quam voluptatem velit iusto vel.', 1, 'public_events/photography_walk/event_11_pic_1.jpg'),
(45, 11, 12, 'event_11_pic_2.jpg', '2025-06-30 23:00:00', 'E11P45', NULL, 1, 'public_events/photography_walk/event_11_pic_2.jpg'),
(46, 11, 12, 'event_11_pic_3.jpg', '2025-06-30 23:00:00', 'E11P46', 'Sit beatae molestiae nobis omnis.', 1, 'public_events/photography_walk/event_11_pic_3.jpg'),
(47, 12, 11, 'event_12_pic_1.jpg', '2025-11-06 00:00:00', 'E12P47', NULL, 1, 'public_events/community_fireworks_night/event_12_pic_1.jpg'),
(48, 12, 11, 'event_12_pic_2.jpg', '2025-11-06 00:00:00', 'E12P48', 'Quidem ad aliquid culpa est dolor voluptas.', 1, 'public_events/community_fireworks_night/event_12_pic_2.jpg'),
(49, 12, 11, 'event_12_pic_3.jpg', '2025-11-06 00:00:00', 'E12P49', NULL, 1, 'public_events/community_fireworks_night/event_12_pic_3.jpg'),
(50, 13, 2, 'event_13_pic_1.jpg', '2025-07-18 23:00:00', 'E13P50', 'Quos similique ut suscipit vitae vel.', 1, 'public_events/portsmouth_food_festival/event_13_pic_1.jpg'),
(51, 13, 2, 'event_13_pic_2.jpg', '2025-07-18 23:00:00', 'E13P51', 'Eos nihil eligendi sapiente.', 1, 'public_events/portsmouth_food_festival/event_13_pic_2.jpg'),
(52, 13, 2, 'event_13_pic_3.jpg', '2025-07-18 23:00:00', 'E13P52', 'Sint tempore earum eligendi ea.', 1, 'public_events/portsmouth_food_festival/event_13_pic_3.jpg'),
(53, 14, 7, 'event_14_pic_1.jpg', '2025-09-14 23:00:00', 'E14P53', 'Quod sapiente porro odio ut omnis.', 1, 'public_events/university_open_day/event_14_pic_1.jpg'),
(54, 14, 7, 'event_14_pic_2.jpg', '2025-09-14 23:00:00', 'E14P54', 'Dicta dolore et vel tempore quo voluptas.', 1, 'public_events/university_open_day/event_14_pic_2.jpg'),
(55, 14, 7, 'event_14_pic_3.jpg', '2025-09-14 23:00:00', 'E14P55', NULL, 1, 'public_events/university_open_day/event_14_pic_3.jpg'),
(56, 14, 7, 'event_14_pic_4.jpg', '2025-09-14 23:00:00', 'E14P56', 'Dolores consequuntur autem sapiente.', 1, 'public_events/university_open_day/event_14_pic_4.jpg'),
(57, 15, 8, 'event_15_pic_1.jpg', '2025-08-20 23:00:00', 'E15P57', NULL, 1, 'public_events/charity_fun_run/event_15_pic_1.jpg'),
(58, 15, 8, 'event_15_pic_2.jpg', '2025-08-20 23:00:00', 'E15P58', 'Blanditiis quas fugiat suscipit dignissimos.', 1, 'public_events/charity_fun_run/event_15_pic_2.jpg'),
(59, 15, 8, 'event_15_pic_3.jpg', '2025-08-20 23:00:00', 'E15P59', NULL, 1, 'public_events/charity_fun_run/event_15_pic_3.jpg'),
(60, 16, 4, 'event_16_pic_1.jpg', '2025-06-15 23:00:00', 'E16P60', 'Et voluptas ipsam sint vel voluptas aliquid.', 1, 'private_events/smith_family_portraits/event_16_pic_1.jpg'),
(61, 17, 5, 'event_17_pic_1.jpg', '2025-06-28 23:00:00', 'E17P61', 'Consequatur qui sit et.', 1, 'private_events/olivia_marcus_wedding/event_17_pic_1.jpg'),
(62, 17, 5, 'event_17_pic_2.jpg', '2025-06-28 23:00:00', 'E17P62', 'Mollitia labore ut et quidem aut.', 1, 'private_events/olivia_marcus_wedding/event_17_pic_2.jpg'),
(63, 18, 7, 'event_18_pic_1.jpg', '2025-07-05 23:00:00', 'E18P63', 'Eius qui beatae atque omnis.', 1, 'private_events/st_marys_year_11_prom/event_18_pic_1.jpg'),
(64, 18, 7, 'event_18_pic_2.jpg', '2025-07-05 23:00:00', 'E18P64', NULL, 1, 'private_events/st_marys_year_11_prom/event_18_pic_2.jpg'),
(65, 18, 7, 'event_18_pic_3.jpg', '2025-07-05 23:00:00', 'E18P65', NULL, 1, 'private_events/st_marys_year_11_prom/event_18_pic_3.jpg'),
(66, 19, 4, 'event_19_pic_1.jpg', '2025-07-14 23:00:00', 'E19P66', 'Molestiae modi et autem eos. Sit hic qui a.', 1, 'private_events/jones_family_reunion/event_19_pic_1.jpg'),
(67, 20, 9, 'event_20_pic_1.jpg', '2025-08-01 23:00:00', 'E20P67', NULL, 1, 'private_events/corporate_headshots/event_20_pic_1.jpg'),
(68, 20, 9, 'event_20_pic_2.jpg', '2025-08-01 23:00:00', 'E20P68', NULL, 1, 'private_events/corporate_headshots/event_20_pic_2.jpg'),
(69, 20, 9, 'event_20_pic_3.jpg', '2025-08-01 23:00:00', 'E20P69', 'Et numquam eum aut illum sit voluptatem autem.', 1, 'private_events/corporate_headshots/event_20_pic_3.jpg'),
(70, 21, 4, 'event_21_pic_1.jpg', '2025-09-10 23:00:00', 'E21P70', 'Voluptas quasi temporibus ab eaque ipsum alias.', 1, 'private_events/lucys_18th_birthday/event_21_pic_1.jpg'),
(71, 22, 5, 'event_22_pic_1.jpg', '2025-08-12 23:00:00', 'E22P71', NULL, 1, 'private_events/wilson_engagement_party/event_22_pic_1.jpg'),
(72, 22, 5, 'event_22_pic_2.jpg', '2025-08-12 23:00:00', 'E22P72', NULL, 1, 'private_events/wilson_engagement_party/event_22_pic_2.jpg'),
(73, 22, 5, 'event_22_pic_3.jpg', '2025-08-12 23:00:00', 'E22P73', NULL, 1, 'private_events/wilson_engagement_party/event_22_pic_3.jpg'),
(74, 23, 4, 'event_23_pic_1.jpg', '2025-07-25 23:00:00', 'E23P74', 'Laboriosam praesentium explicabo modi totam.', 1, 'private_events/model_portfolio_shoot/event_23_pic_1.jpg'),
(75, 24, 4, 'event_24_pic_1.jpg', '2025-06-27 23:00:00', 'E24P75', NULL, 1, 'private_events/harris_baby_shower/event_24_pic_1.jpg'),
(76, 24, 4, 'event_24_pic_2.jpg', '2025-06-27 23:00:00', 'E24P76', NULL, 1, 'private_events/harris_baby_shower/event_24_pic_2.jpg'),
(77, 25, 11, 'event_25_pic_1.jpg', '2025-12-13 00:00:00', 'E25P77', 'Perspiciatis quia laborum ratione earum et.', 1, 'private_events/studio_christmas_session/event_25_pic_1.jpg'),
(78, 25, 11, 'event_25_pic_2.jpg', '2025-12-13 00:00:00', 'E25P78', NULL, 1, 'private_events/studio_christmas_session/event_25_pic_2.jpg'),
(79, 26, 10, 'event_26_pic_1.jpg', '2025-07-03 23:00:00', 'E26P79', 'Non voluptas facere qui praesentium.', 1, 'private_events/pet_portraits_day/event_26_pic_1.jpg'),
(80, 26, 10, 'event_26_pic_2.jpg', '2025-07-03 23:00:00', 'E26P80', 'Expedita quaerat dolores enim adipisci.', 1, 'private_events/pet_portraits_day/event_26_pic_2.jpg'),
(81, 26, 10, 'event_26_pic_3.jpg', '2025-07-03 23:00:00', 'E26P81', 'Voluptatem et sit omnis non.', 1, 'private_events/pet_portraits_day/event_26_pic_3.jpg'),
(82, 26, 10, 'event_26_pic_4.jpg', '2025-07-03 23:00:00', 'E26P82', 'Quo minima eum et qui maxime debitis.', 1, 'private_events/pet_portraits_day/event_26_pic_4.jpg'),
(83, 26, 10, 'event_26_pic_5.jpg', '2025-07-03 23:00:00', 'E26P83', NULL, 1, 'private_events/pet_portraits_day/event_26_pic_5.jpg'),
(84, 27, 1, 'event_27_pic_1.jpg', '2025-07-15 23:00:00', 'E27P84', 'Quo corporis quibusdam nesciunt quia autem.', 1, 'private_events/graduation_photos_retake/event_27_pic_1.jpg'),
(85, 27, 1, 'event_27_pic_2.jpg', '2025-07-15 23:00:00', 'E27P85', NULL, 1, 'private_events/graduation_photos_retake/event_27_pic_2.jpg'),
(86, 27, 1, 'event_27_pic_3.jpg', '2025-07-15 23:00:00', 'E27P86', 'Dicta unde mollitia rerum cum modi velit.', 1, 'private_events/graduation_photos_retake/event_27_pic_3.jpg'),
(87, 27, 1, 'event_27_pic_4.jpg', '2025-07-15 23:00:00', 'E27P87', 'Quos ipsa odit nam quas porro beatae.', 1, 'private_events/graduation_photos_retake/event_27_pic_4.jpg'),
(88, 28, 9, 'event_28_pic_1.jpg', '2025-09-03 23:00:00', 'E28P88', 'Odit et quas dicta est iure voluptas deleniti.', 1, 'private_events/client_branding_session/event_28_pic_1.jpg'),
(89, 28, 9, 'event_28_pic_2.jpg', '2025-09-03 23:00:00', 'E28P89', 'Et ratione et quis est commodi fugit.', 1, 'private_events/client_branding_session/event_28_pic_2.jpg'),
(90, 28, 9, 'event_28_pic_3.jpg', '2025-09-03 23:00:00', 'E28P90', 'Ipsum distinctio voluptatem error eligendi.', 1, 'private_events/client_branding_session/event_28_pic_3.jpg'),
(91, 29, 11, 'event_29_pic_1.jpg', '2025-12-04 00:00:00', 'E29P91', NULL, 1, 'private_events/family_christmas_portraits/event_29_pic_1.jpg'),
(92, 30, 5, 'event_30_pic_1.jpg', '2025-10-12 23:00:00', 'E30P92', NULL, 1, 'private_events/engagement_shoot_priya_jay/event_30_pic_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `picture_sizes`
--

CREATE TABLE `picture_sizes` (
  `pic_size_id` int UNSIGNED NOT NULL,
  `pic_size_label` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_size_width` decimal(5,2) NOT NULL,
  `pic_size_height` decimal(5,2) NOT NULL,
  `pic_size_price` decimal(6,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `picture_sizes`
--

INSERT INTO `picture_sizes` (`pic_size_id`, `pic_size_label`, `pic_size_width`, `pic_size_height`, `pic_size_price`) VALUES
(1, '6x4', 6.00, 4.00, 1.500),
(2, '7x5', 7.00, 5.00, 2.000),
(3, '10x8', 10.00, 8.00, 3.000),
(4, '12x8', 12.00, 8.00, 3.500),
(5, 'A5', 5.83, 8.27, 2.500),
(6, 'A4', 8.27, 11.69, 4.000),
(7, 'A3', 11.69, 16.54, 6.000),
(8, 'Square 5x5', 5.00, 5.00, 1.750),
(9, 'Panoramic 12x4', 12.00, 4.00, 3.250),
(10, 'Passport Size', 2.00, 2.00, 1.000);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `customers_cust_email_unique` (`cust_email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `events_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `event_accesses`
--
ALTER TABLE `event_accesses`
  ADD PRIMARY KEY (`cust_id`,`event_id`),
  ADD KEY `event_accesses_event_id_foreign` (`event_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_cust_id_foreign` (`cust_id`);

--
-- Indexes for table `order_pictures`
--
ALTER TABLE `order_pictures`
  ADD PRIMARY KEY (`order_id`,`pic_id`,`pic_size_id`),
  ADD KEY `order_pictures_pic_id_foreign` (`pic_id`),
  ADD KEY `order_pictures_pic_size_id_foreign` (`pic_size_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`pic_id`),
  ADD UNIQUE KEY `pictures_pic_locator_unique` (`pic_locator`),
  ADD KEY `pictures_event_id_foreign` (`event_id`),
  ADD KEY `pictures_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `picture_sizes`
--
ALTER TABLE `picture_sizes`
  ADD PRIMARY KEY (`pic_size_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `pic_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `picture_sizes`
--
ALTER TABLE `picture_sizes`
  MODIFY `pic_size_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`);

--
-- Constraints for table `event_accesses`
--
ALTER TABLE `event_accesses`
  ADD CONSTRAINT `event_accesses_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`),
  ADD CONSTRAINT `event_accesses_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `customers` (`cust_id`);

--
-- Constraints for table `order_pictures`
--
ALTER TABLE `order_pictures`
  ADD CONSTRAINT `order_pictures_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_pictures_pic_id_foreign` FOREIGN KEY (`pic_id`) REFERENCES `pictures` (`pic_id`),
  ADD CONSTRAINT `order_pictures_pic_size_id_foreign` FOREIGN KEY (`pic_size_id`) REFERENCES `picture_sizes` (`pic_size_id`);

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `pictures_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
