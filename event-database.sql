-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2023 at 01:59 AM
-- Server version: 5.7.40-log-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zealtech_event`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertises`
--

CREATE TABLE `advertises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `end_at` datetime DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertises`
--

INSERT INTO `advertises` (`id`, `title`, `image`, `description`, `status`, `end_at`, `start_at`, `position`, `link`, `settings`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Muhibbullah', 'images/-a72dc0782da1abe317338897032937d5-Best-Testimonial-Examples-For-Employees-1.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos \r\nsapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam\r\nrecusandae alias error harum maxime adipisci amet laborum.', 1, '2023-03-11 13:55:00', '2023-01-06 13:55:00', 0, 'https://wmdouglas.com/request-a-proposal/', NULL, 1, '2023-01-07 01:56:02', '2023-01-07 01:56:02'),
(2, 'Where can I get some?', 'images/-81f68a72ae42ef9323e00a08226ceb8e-1603954182-seo-article-header.jpeg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1, '2023-04-08 13:57:00', '2023-01-06 13:56:00', 2, 'https://www.hornehvac.com/', NULL, 1, '2023-01-07 01:57:18', '2023-01-07 01:57:18'),
(3, 'Advertise Two', 'images/-d3314321c18f41943da2776fd748c937-dear-Di6efUKgqqA-unsplash.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2023-02-11 18:29:00', '2023-01-07 18:29:00', -1, 'https://www.hornehvac.com/', NULL, 1, '2023-01-07 06:29:54', '2023-01-07 06:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `m_event_id` bigint(20) UNSIGNED NOT NULL,
  `discount_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_code_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'fixed/percentage',
  `discount_value` double NOT NULL DEFAULT '0',
  `applied_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'all_ticket/specific_ticket',
  `tickets` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `use_limit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'unlimited,one_use,limited',
  `limit_amount` int(11) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_lists`
--

CREATE TABLE `event_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `eventType` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `terms_and_conditions` text COLLATE utf8mb4_unicode_ci,
  `audience` text COLLATE utf8mb4_unicode_ci,
  `attention` text COLLATE utf8mb4_unicode_ci,
  `location` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locationTips` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_link` text COLLATE utf8mb4_unicode_ci,
  `eventCategory` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timezone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `website` text COLLATE utf8mb4_unicode_ci,
  `instagram` text COLLATE utf8mb4_unicode_ci,
  `twitter` text COLLATE utf8mb4_unicode_ci,
  `facebook` text COLLATE utf8mb4_unicode_ci,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `publish` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `weekly_notice` tinyint(1) NOT NULL DEFAULT '0',
  `hourly_notice` tinyint(1) NOT NULL DEFAULT '0',
  `admin_overview_notice` tinyint(1) NOT NULL DEFAULT '0',
  `can_withdraw_notice` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_tickets`
--

CREATE TABLE `event_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `ticketType` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_stock` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_limit` int(10) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `purchase_limit` int(10) UNSIGNED DEFAULT NULL,
  `ticket_description` text COLLATE utf8mb4_unicode_ci,
  `isTransferFeesToGuest` tinyint(1) DEFAULT '0',
  `questions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `perks` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold` int(10) UNSIGNED DEFAULT '0',
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_views`
--

CREATE TABLE `event_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_list_id` bigint(20) UNSIGNED NOT NULL,
  `count` bigint(20) NOT NULL DEFAULT '0',
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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foreign_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gallery',
  `path` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `foreign_id`, `type`, `path`, `created_at`, `updated_at`) VALUES
(2, 1, 'gallery', 'images/gallery-d5f74707845955c6cf5a9a2a7219a398-1603954182-seo-article-header.jpeg', '2023-01-07 02:08:35', '2023-01-07 02:08:35'),
(3, 1, 'gallery', 'images/gallery-a53849b0bfc90798e4c5e254e9050a03-Best-Testimonial-Examples-For-Employees-1.png', '2023-01-07 02:08:43', '2023-01-07 02:08:43'),
(4, 2, 'banner', 'images/banner-e8c5713c399c7aee00a33d46cb08a4e0-Best-Testimonial-Examples-For-Employees-1.png', '2023-01-07 03:36:47', '2023-01-07 03:36:47'),
(5, 3, 'banner', 'images/banner-203d15c14dc203da03f8a1ccfec660da-1603954182-seo-article-header.jpeg', '2023-01-07 03:37:37', '2023-01-07 03:37:37'),
(6, 1, 'banner', 'images/banner-c0d190de1b53cf7ba30735319b1b898c-dear-Di6efUKgqqA-unsplash.jpg', '2023-01-07 03:37:59', '2023-01-07 03:37:59'),
(7, 4, 'banner', 'images/banner-d98b04e9c7c455d2d5c84caabec2e3c6-harry-cunningham-4oe5GJQGQfA-unsplash.jpg', '2023-01-07 03:40:34', '2023-01-07 03:40:34'),
(8, 5, 'banner', 'images/banner-cca2e8e7289afd39b3d896a54f778aec-Freetoolssite.webp', '2023-01-07 03:42:04', '2023-01-07 03:42:04'),
(9, 6, 'banner', 'images/banner-3d75c918f6a31844f3461fb5362a36a9-1603954182-seo-article-header.jpeg', '2023-01-07 03:45:19', '2023-01-07 03:45:19'),
(10, 7, 'banner', 'images/banner-e1aaa2a95889b92838f4d9bba84686e8-harry-cunningham-4oe5GJQGQfA-unsplash.jpg', '2023-01-07 03:46:46', '2023-01-07 03:46:46'),
(11, 8, 'banner', 'images/banner-62ba7916e2a0dab2e8d8f608074a45f7-louis-smit-kaGvtLoikgM-unsplash.jpeg', '2023-01-08 02:34:36', '2023-01-08 02:34:36'),
(12, 9, 'banner', 'images/banner-b59f7a0bf0e09df0b6b68c8cfea49805-Bildschirmfoto 2023-01-04 um 18.30.00.png', '2023-01-08 03:51:35', '2023-01-08 03:51:35'),
(13, 10, 'banner', 'images/banner-ea4f73a89d5019c8cab61d34e80e424a-pexels-nappy-936137.jpg', '2023-01-09 00:34:43', '2023-01-09 00:34:43'),
(14, 10, 'gallery', 'images/gallery-f20e3924f73780bfa86bb78f8805d2ba-adeolu-eletu-rFUFqjEKzfY-unsplash.jpg', '2023-01-09 00:34:57', '2023-01-09 00:34:57'),
(15, 12, 'banner', 'images/banner-1541de0cd2fa053d2c6ce3b71f8cf93f-louis-smit-kaGvtLoikgM-unsplash.jpeg', '2023-01-09 02:37:38', '2023-01-09 02:37:38'),
(16, 13, 'banner', 'images/banner-889c00a29f8012ec8d6b780c26af3df6-Haar-und-Hautpflege__Unique-Afroshop-Berlin.jpg', '2023-01-09 02:47:10', '2023-01-09 02:47:10'),
(17, 13, 'gallery', 'images/gallery-bcc03ef1033297cf03f3033bec39641d-FBD95NKD-large.jpg', '2023-01-09 02:47:30', '2023-01-09 02:47:30'),
(18, 13, 'gallery', 'images/gallery-d8ab0cda105a13fa092290d3973636b2-Sevenshigh_530x@2x.jpg', '2023-01-09 02:47:36', '2023-01-09 02:47:36'),
(19, 13, 'gallery', 'images/gallery-00a2d66c868633c12ebd030971b81462-9FB00F09-BB5D-4D21-BD81-0F23436B8BB6.jpeg', '2023-01-09 02:47:42', '2023-01-09 02:47:42'),
(20, 13, 'gallery', 'images/gallery-a5c974fafe5075645f2cb779b91538df-yethu-mtshali-AYCdq3keWK0-unsplash.jpg', '2023-01-09 02:48:00', '2023-01-09 02:48:00'),
(22, 14, 'gallery', 'images/gallery-57ee56e2ef5e47885046a5ab92e65103-halacious-Vfml26Iy4mI-unsplash.jpg', '2023-01-09 02:58:08', '2023-01-09 02:58:08'),
(23, 14, 'banner', 'images/banner-4aaf518b54f93b89c66fa480fb755dde-manja-vitolic-7tOV35hnkao-unsplash.jpg', '2023-01-09 02:58:25', '2023-01-09 02:58:25'),
(24, 15, 'banner', 'images/banner-2ce2c8120bf2431979a3ce01496d0d98-louis-smit-kaGvtLoikgM-unsplash.jpeg', '2023-01-11 02:05:55', '2023-01-11 02:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, '2022_12_07_034502_create_categories_table', 1),
(6, '2022_12_07_035351_create_time_zones_table', 1),
(7, '2022_12_07_035730_create_m_events_table', 1),
(8, '2022_12_09_100430_create_tickets_table', 1),
(9, '2022_12_10_153130_create_discounts_table', 1),
(10, '2022_12_13_210046_create_event_lists_table', 1),
(11, '2022_12_14_141804_create_images_table', 1),
(12, '2022_12_14_202208_create_event_tickets_table', 1),
(13, '2022_12_15_130927_map_link', 1),
(14, '2022_12_15_205935_create_advertises_table', 1),
(15, '2022_12_17_123718_create_ticket_sales_table', 1),
(16, '2022_12_17_192517_create_site_settings_table', 1),
(17, '2022_12_19_061257_add_position_on_advertise_table', 1),
(18, '2022_12_20_211452_create_guests_table', 1),
(19, '2022_12_22_111028_create_ticket_designs_table', 1),
(20, '2022_12_22_184357_add_ip_info_to_guests_table', 1),
(21, '2022_12_23_203824_create_payment_details_table', 1),
(22, '2022_12_28_171947_create_ticket_numbers_table', 1),
(23, '2022_12_29_165817_add_uuid_to_ticket_sales_table', 1),
(24, '2022_12_30_164445_create_event_views_table', 1),
(25, '2022_12_30_184812_create_transactions_table', 1),
(26, '2022_12_30_201345_create_pages_table', 1),
(27, '2023_01_04_033628_create_jobs_table', 1),
(28, '2023_01_05_172816_add_notice_status_to_events_table', 1),
(29, '2023_01_06_094033_add_some_to_event_lists_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_events`
--

CREATE TABLE `m_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_tips` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventType` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eventCategory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_zone` text COLLATE utf8mb4_unicode_ci,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `event_date_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` text COLLATE utf8mb4_unicode_ci,
  `instagram` text COLLATE utf8mb4_unicode_ci,
  `twitter` text COLLATE utf8mb4_unicode_ci,
  `facebook` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `theme_id` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` text COLLATE utf8mb4_unicode_ci,
  `map_link` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `image`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Imprint', 'imprint', '', 'Adipisci laudantium optio aut dolor. Atque rerum architecto velit iusto et qui. Corporis voluptatibus facere blanditiis voluptatem.', 0, '2023-01-01 13:34:18', '2023-01-06 18:33:15'),
(2, 'Data privacy', 'data-privacy', '', '<p>Nostrum nobis ex nobis ut repudiandae. Consequatur quidem optio nihil ut sed doloribus delectus perspiciatis. Nostrum nobis ex nobis ut repudiandae. Consequatur quidem optio nihil ut sed doloribus delectus perspiciatis. Nostrum nobis ex nobis ut repudiandae. Consequatur quidem optio nihil ut sed doloribus delectus perspiciatis. Nostrum nobis ex nobis ut repudiandae. Consequatur quidem optio nihil ut sed doloribus delectus perspiciatis.</p><p>&nbsp;</p><p>Nostrum nobis ex nobis ut repudiandae. Consequatur quidem optio nihil ut sed doloribus delectus perspiciatis.</p>', 0, '2023-01-01 13:34:18', '2023-01-05 19:06:58'),
(3, 'Terms & conditions', 'terms-conditions', '', 'Vel commodi necessitatibus eos ipsum quidem ut nisi a. Omnis in odit ea. Sit dolores velit vitae natus sit tempora quia sint.', 1, '2023-01-01 13:34:18', '2023-01-01 13:34:18');

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
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mpesa_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'commission', '90', NULL, '2023-01-10 05:51:57'),
(2, 'currency', '€', NULL, '2023-01-07 02:01:49'),
(3, 'home_banner_image', 'images/dear-Di6efUKgqqA-unsplash_63b926edbf33b.jpg', NULL, '2023-01-07 02:01:49'),
(4, 'logo_image', 'images/Ticketprime_V2_Logo_dark-blue-dark-blue-brandname-transparent-background_63b926edbfba1.png', NULL, '2023-01-07 02:01:49'),
(5, 'footer_logo_image', 'images/Ticketprime_V2_Logo_gold-white-brandname-transparent-background_63b926edc0032.png', NULL, '2023-01-07 02:01:49'),
(6, 'home_banner_text', 'Welcome To Our Platform', NULL, '2023-01-11 03:40:23'),
(7, 'facebook_link', 'https://facebook.com/jj', NULL, '2023-01-10 05:51:43'),
(8, 'twitter_link', 'https://twitter.com/', NULL, '2023-01-07 02:01:49'),
(9, 'tiktok_link', 'https://www.tiktok.com/', NULL, '2023-01-07 02:01:49'),
(10, 'instagram_link', 'https://www.instagram.com/', NULL, '2023-01-07 02:01:49'),
(11, 'youtube_link', 'https://www.youtube.com/', NULL, '2023-01-07 02:01:49'),
(12, 'telegram_link', 'https://www.telegram.com/', NULL, '2023-01-10 02:51:08'),
(13, 'fave_icon', 'images/icon_63beaa909337b.png', '2023-01-07 02:01:49', '2023-01-11 17:24:48'),
(14, 'copy_write', NULL, '2023-01-07 02:01:49', '2023-01-07 02:01:49'),
(15, 'paypal_publish_key', NULL, '2023-01-07 02:01:49', '2023-01-11 22:05:33'),
(16, 'stripe_publish_key', NULL, '2023-01-07 02:01:49', '2023-01-11 22:05:33'),
(17, 'stripe_secret_key', NULL, '2023-01-07 02:01:49', '2023-01-11 22:05:33'),
(18, 'auth0_domain', '0', '2023-01-07 02:01:49', '2023-01-12 10:54:06'),
(19, 'auth0_client_id', '0', '2023-01-07 02:01:49', '2023-01-12 10:54:06'),
(20, 'site_name', 'Ticketprime', '2023-01-07 03:52:46', '2023-01-10 05:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `m_events_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_stock` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_limit` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `perks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `isTransferFeesToGuest` tinyint(1) NOT NULL DEFAULT '0',
  `questions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_designs`
--

CREATE TABLE `ticket_designs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_ticket_id` bigint(20) UNSIGNED NOT NULL,
  `border_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#666666',
  `bg_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#FFFFFF',
  `text_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#000000',
  `sub_text_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#666666',
  `footer_text` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#666666',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_numbers`
--

CREATE TABLE `ticket_numbers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_sale_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_sales`
--

CREATE TABLE `ticket_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organizer_id` int(10) UNSIGNED DEFAULT NULL,
  `guest_id` int(10) UNSIGNED DEFAULT NULL,
  `ticket_id` int(10) UNSIGNED DEFAULT NULL,
  `ticket_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `commission` double(8,2) NOT NULL DEFAULT '0.00',
  `price` double(8,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'complete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sales_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_zones`
--

CREATE TABLE `time_zones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_list_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double(8,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mpesa_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interests` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'organizer' COMMENT 'admin/clients/organizer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `interests`, `email`, `phone`, `email_verified_at`, `password`, `type`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'User', NULL, 'admin@gmail.com', NULL, '2023-01-07 01:44:04', '$2y$10$LgJOqut2R6iAvZWmWI09WulZTDkRc/N9BRgEhv/FQO9jfDK0hoDrK', 'admin', NULL, NULL, '2023-01-07 01:44:04', '2023-01-08 00:47:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertises`
--
ALTER TABLE `advertises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_m_event_id_foreign` (`m_event_id`);

--
-- Indexes for table `event_lists`
--
ALTER TABLE `event_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_tickets`
--
ALTER TABLE `event_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_views`
--
ALTER TABLE `event_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_views_event_list_id_foreign` (`event_list_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_events`
--
ALTER TABLE `m_events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `m_events_slug_unique` (`slug`),
  ADD UNIQUE KEY `m_events_custom_url_unique` (`custom_url`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_name_unique` (`name`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_m_events_id_foreign` (`m_events_id`);

--
-- Indexes for table `ticket_designs`
--
ALTER TABLE `ticket_designs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_designs_event_ticket_id_foreign` (`event_ticket_id`);

--
-- Indexes for table `ticket_numbers`
--
ALTER TABLE `ticket_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_numbers_guest_id_foreign` (`guest_id`),
  ADD KEY `ticket_numbers_ticket_sale_id_foreign` (`ticket_sale_id`);

--
-- Indexes for table `ticket_sales`
--
ALTER TABLE `ticket_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_zones`
--
ALTER TABLE `time_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_event_list_id_foreign` (`event_list_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertises`
--
ALTER TABLE `advertises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_lists`
--
ALTER TABLE `event_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `event_tickets`
--
ALTER TABLE `event_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `event_views`
--
ALTER TABLE `event_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `m_events`
--
ALTER TABLE `m_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_designs`
--
ALTER TABLE `ticket_designs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ticket_numbers`
--
ALTER TABLE `ticket_numbers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `ticket_sales`
--
ALTER TABLE `ticket_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `time_zones`
--
ALTER TABLE `time_zones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_m_event_id_foreign` FOREIGN KEY (`m_event_id`) REFERENCES `m_events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_views`
--
ALTER TABLE `event_views`
  ADD CONSTRAINT `event_views_event_list_id_foreign` FOREIGN KEY (`event_list_id`) REFERENCES `event_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_m_events_id_foreign` FOREIGN KEY (`m_events_id`) REFERENCES `m_events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_designs`
--
ALTER TABLE `ticket_designs`
  ADD CONSTRAINT `ticket_designs_event_ticket_id_foreign` FOREIGN KEY (`event_ticket_id`) REFERENCES `event_tickets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_numbers`
--
ALTER TABLE `ticket_numbers`
  ADD CONSTRAINT `ticket_numbers_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`),
  ADD CONSTRAINT `ticket_numbers_ticket_sale_id_foreign` FOREIGN KEY (`ticket_sale_id`) REFERENCES `ticket_sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_event_list_id_foreign` FOREIGN KEY (`event_list_id`) REFERENCES `event_lists` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
