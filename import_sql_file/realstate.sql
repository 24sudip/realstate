-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 09:56 AM
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
-- Database: `realstate`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amenities_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenities_name`, `created_at`, `updated_at`) VALUES
(1, 'Air Conditioning', NULL, NULL),
(3, 'CCTV Security', NULL, NULL),
(4, 'Cleaning Services', NULL, NULL),
(5, 'Maintenance Staff', NULL, NULL),
(6, 'First Aid Medical Center', NULL, NULL),
(7, 'Intercom', NULL, NULL),
(8, '24 Hours Concierge', NULL, NULL),
(9, 'Flooring', NULL, NULL),
(10, 'Floor Level', NULL, NULL),
(11, 'Service Elevators', NULL, NULL),
(12, 'Balcony or Terrace', NULL, NULL),
(13, 'Electricity Backup', NULL, NULL),
(14, 'Lobby in Building', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES
(1, 'Real Estate', 'real-estate', NULL, NULL),
(2, 'Interior', 'interior', NULL, NULL),
(3, 'Architecture', 'architecture', NULL, NULL),
(4, 'Home Improvement', 'home-improvement', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_cat_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_slug` varchar(255) DEFAULT NULL,
  `post_image` varchar(255) DEFAULT NULL,
  `short_descp` text DEFAULT NULL,
  `long_descp` text DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `blog_cat_id`, `user_id`, `post_title`, `post_slug`, `post_image`, `short_descp`, `long_descp`, `post_tags`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Sed cillum adipisci', 'sed-cillum-adipisci', '1799832647925998.jpg', 'Sed pariatur Repreh', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'Voluptatem sit irure,Repreh', '2024-05-23 02:49:32', NULL),
(2, 3, 1, 'Reprehenderit amet', 'reprehenderit-amet', '1799832930710404.jpg', 'Harum voluptas moles', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 'Doloremque laboriosa,amet,moles', '2024-05-23 02:54:00', NULL),
(3, 4, 1, 'Alias rerum', 'alias-rerum', '1799916158176735.jpg', 'Qui molestiae', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>', 'Est voluptates exerc,Finibus Bonorum', '2024-05-24 00:56:52', '2024-05-24 00:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'user_id',
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'agent_id',
  `msg` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `sender_id`, `receiver_id`, `msg`, `created_at`, `updated_at`) VALUES
(1, 3, 12, 'hello i need your help', '2024-08-24 05:30:34', '2024-08-24 05:30:34'),
(2, 3, 12, 'Are you here?', '2024-08-24 05:37:00', '2024-08-24 05:37:00'),
(3, 3, 12, 'Hi, check.', '2024-08-26 01:40:10', '2024-08-26 01:40:10'),
(4, 12, 3, 'If It is not argent,  contact me later.', '2024-08-26 11:06:40', '2024-08-26 11:06:40'),
(5, 12, 3, 'I am free now', '2024-08-26 11:37:44', '2024-08-26 11:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `parent_id`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 3, 3, NULL, 'This is a nice post', 'This book is a treatise on the theory of ethics', '2024-05-27 02:51:35', NULL),
(2, 3, 3, NULL, 'Wow! It\'s very nice', 'very popular during the Renaissance.', '2024-05-27 02:56:08', NULL),
(3, 3, 3, 2, 'Thanks for wow.', 'I will contact with you.', '2024-05-28 02:38:17', NULL),
(4, 3, 3, 1, 'Thank You.', 'Your message mean a lot to me.', '2024-05-28 03:56:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `compares`
--

CREATE TABLE `compares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compares`
--

INSERT INTO `compares` (`id`, `user_id`, `property_id`, `created_at`, `updated_at`) VALUES
(2, 3, 5, '2024-04-13 04:18:03', NULL),
(3, 3, 2, '2024-04-14 02:06:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `facility_name` varchar(255) DEFAULT NULL,
  `distance` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `property_id`, `facility_name`, `distance`, `created_at`, `updated_at`) VALUES
(12, 2, 'Bus Stop', '3', '2024-03-09 00:54:03', '2024-03-09 00:54:03'),
(13, 2, 'Airport', '2', '2024-03-09 00:54:03', '2024-03-09 00:54:03'),
(14, 2, 'Railways', '4', '2024-03-09 00:54:03', '2024-03-09 00:54:03'),
(18, 3, 'Pharmacy', '1', '2024-03-09 03:28:07', '2024-03-09 03:28:07'),
(19, 3, 'Entertainment', '3.5', '2024-03-09 03:28:07', '2024-03-09 03:28:07'),
(20, 3, 'School', '4.5', '2024-03-09 03:28:07', '2024-03-09 03:28:07'),
(28, 5, 'Railways', '1', '2024-04-07 02:16:15', '2024-04-07 02:16:15'),
(29, 5, 'Mall', '3', '2024-04-07 02:16:15', '2024-04-07 02:16:15'),
(30, 5, 'Bank', '2', '2024-04-07 02:16:15', '2024-04-07 02:16:15'),
(31, 6, 'Railways', '1.5', '2024-04-09 01:01:41', '2024-04-09 01:01:41'),
(32, 6, 'Hospital', '3.5', '2024-04-09 01:01:41', '2024-04-09 01:01:41'),
(33, 6, 'SuperMarket', '2.5', '2024-04-09 01:01:41', '2024-04-09 01:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_23_134009_create_property_types_table', 2),
(6, '2024_02_24_101520_create_amenities_table', 3),
(7, '2024_02_25_064628_create_properties_table', 4),
(8, '2024_02_25_081310_create_multi_images_table', 4),
(9, '2024_02_25_082215_create_facilities_table', 4),
(10, '2024_04_09_042952_create_package_plans_table', 5),
(11, '2024_04_12_095005_create_wishlists_table', 6),
(12, '2024_04_13_084511_create_compares_table', 7),
(13, '2024_04_14_083650_create_property_messages_table', 8),
(14, '2024_05_11_091553_create_states_table', 9),
(15, '2024_05_16_075813_create_testimonials_table', 10),
(16, '2024_05_17_092223_create_blog_categories_table', 11),
(17, '2024_05_23_035622_create_blog_posts_table', 12),
(18, '2024_05_27_064724_create_comments_table', 13),
(19, '2024_05_30_040235_create_schedules_table', 14),
(20, '2024_05_31_082548_create_smtp_settings_table', 15),
(21, '2024_06_11_080939_create_site_settings_table', 16),
(22, '2024_06_12_061333_create_permission_tables', 17),
(23, '2024_08_24_085903_create_chat_messages_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 13);

-- --------------------------------------------------------

--
-- Table structure for table `multi_images`
--

CREATE TABLE `multi_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_images`
--

INSERT INTO `multi_images` (`id`, `property_id`, `photo_name`, `created_at`, `updated_at`) VALUES
(4, 2, '1792577842792166.jpg', '2024-03-01 08:53:36', '2024-03-04 00:57:29'),
(6, 2, '1792336007857859.jpg', '2024-03-01 08:53:37', NULL),
(7, 2, '1792960005386221.jpg', '2024-03-08 06:11:48', NULL),
(8, 3, '1793040160463768.jpg', '2024-03-09 03:25:49', NULL),
(9, 3, '1793040160824396.jpg', '2024-03-09 03:25:50', NULL),
(10, 3, '1793040161246290.jpg', '2024-03-09 03:25:50', NULL),
(15, 5, '1795663094986336.jpg', '2024-04-07 02:16:14', NULL),
(16, 5, '1795663095345113.jpg', '2024-04-07 02:16:15', NULL),
(17, 5, '1795663095747005.jpg', '2024-04-07 02:16:15', NULL),
(18, 6, '1795839598384075.jpg', '2024-04-09 01:01:41', NULL),
(19, 6, '1795839598549544.jpg', '2024-04-09 01:01:41', NULL),
(20, 6, '1795839598716620.jpg', '2024-04-09 01:01:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_plans`
--

CREATE TABLE `package_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `package_credits` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `package_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_plans`
--

INSERT INTO `package_plans` (`id`, `user_id`, `package_name`, `package_credits`, `invoice`, `package_amount`, `created_at`, `updated_at`) VALUES
(1, 12, 'Business', '3', 'ERS84891983', '20', '2024-04-09 04:56:59', NULL),
(2, 2, 'Professional', '10', 'ERS73359263', '50', '2024-04-09 07:02:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'type.menu', 'web', 'type', '2024-06-12 04:26:30', '2024-06-12 04:26:30'),
(2, 'all.type', 'web', 'type', '2024-06-12 04:28:12', '2024-06-12 04:28:12'),
(3, 'add.type', 'web', 'type', '2024-06-12 04:29:03', '2024-06-12 04:29:03'),
(4, 'edit.type', 'web', 'type', '2024-06-12 04:29:53', '2024-06-12 04:29:53'),
(5, 'delete.type', 'web', 'type', '2024-06-12 04:30:51', '2024-06-12 04:30:51'),
(6, 'state.menu', 'web', 'state', '2024-06-12 04:32:21', '2024-06-12 05:14:31'),
(8, 'all.state', 'web', 'state', '2024-06-13 04:07:03', '2024-06-13 04:07:03'),
(9, 'add.state', 'web', 'state', '2024-06-13 04:07:03', '2024-06-13 04:07:03'),
(10, 'edit.state', 'web', 'state', '2024-06-13 04:07:03', '2024-06-13 04:07:03'),
(11, 'delete.state', 'web', 'state', '2024-06-13 04:07:03', '2024-06-13 04:07:03'),
(12, 'property.menu', 'web', 'property', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(13, 'all.property', 'web', 'property', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(14, 'add.property', 'web', 'property', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(15, 'edit.property', 'web', 'property', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(16, 'delete.property', 'web', 'property', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(17, 'agent.menu', 'web', 'agent', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(18, 'all.agent', 'web', 'agent', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(19, 'add.agent', 'web', 'agent', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(20, 'edit.agent', 'web', 'agent', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(21, 'delete.agent', 'web', 'agent', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(22, 'testimonial.menu', 'web', 'testimonial', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(23, 'all.testimonials', 'web', 'testimonial', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(24, 'add.testimonial', 'web', 'testimonial', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(25, 'edit.testimonial', 'web', 'testimonial', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(26, 'delete.testimonial', 'web', 'testimonial', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(27, 'amenities.menu', 'web', 'amenities', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(28, 'all.amenities', 'web', 'amenities', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(29, 'add.amenities', 'web', 'amenities', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(30, 'edit.amenities', 'web', 'amenities', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(31, 'delete.amenities', 'web', 'amenities', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(32, 'smtp.menu', 'web', 'smtp', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(33, 'site.menu', 'web', 'site', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(34, 'role.menu', 'web', 'role', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(35, 'category.menu', 'web', 'category', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(36, 'post.menu', 'web', 'post', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(37, 'comment.menu', 'web', 'comment', '2024-06-14 00:39:12', '2024-06-14 00:39:12'),
(38, 'package.menu', 'web', 'history', '2024-06-14 03:00:24', '2024-06-14 03:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ptype_id` varchar(255) NOT NULL,
  `amenities_id` varchar(255) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_slug` varchar(255) NOT NULL,
  `property_code` varchar(255) NOT NULL,
  `property_status` varchar(255) NOT NULL,
  `lowest_price` varchar(255) DEFAULT NULL,
  `max_price` varchar(255) DEFAULT NULL,
  `property_thumbnail` varchar(255) NOT NULL,
  `short_descrip` text DEFAULT NULL,
  `long_descrip` text DEFAULT NULL,
  `bedrooms` varchar(255) DEFAULT NULL,
  `bathrooms` varchar(255) DEFAULT NULL,
  `garage` varchar(255) DEFAULT NULL,
  `garage_size` varchar(255) DEFAULT NULL,
  `property_size` varchar(255) DEFAULT NULL,
  `property_video` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `featured` varchar(255) DEFAULT NULL,
  `hot` varchar(255) DEFAULT NULL,
  `agent_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `ptype_id`, `amenities_id`, `property_name`, `property_slug`, `property_code`, `property_status`, `lowest_price`, `max_price`, `property_thumbnail`, `short_descrip`, `long_descrip`, `bedrooms`, `bathrooms`, `garage`, `garage_size`, `property_size`, `property_video`, `address`, `city`, `state`, `postal_code`, `neighborhood`, `latitude`, `longitude`, `featured`, `hot`, `agent_id`, `status`, `created_at`, `updated_at`) VALUES
(2, '5', 'Floor Level,Service Elevators,Balcony or Terrace,Electricity Backup', 'Kyle Mcconnell', 'kyle-mcconnell', 'PC002', 'buy', '900', '631', '1792521828943638.jpg', 'Voluptates quisquam', '<p>eadable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2', '2', 'Ut beatae voluptates', 'Vero ', 'Saepe', 'https://www.youtube.com/embed/wSZskFmmSwg?si=FJoDhweIsOkh6Dlf', 'Assumenda dolorem su', 'Perspiciatis possim', '1', 'Aliqua Ipsam tempor', 'Qui ut laborum Dolo', '23.810331', '90.412521', '1', NULL, 2, '1', '2024-03-01 08:53:36', '2024-03-03 10:07:10'),
(3, '5', 'Cleaning Services,Intercom,Floor Level,Service Elevators,Balcony or Terrace,Electricity Backup', 'Christen Osborne', 'christen-osborne', 'PC003', 'rent', '122', '408', '1793040158173811.jpg', 'Voluptatem perspici', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum</p>', '3', '3', 'Velit beatae volupta', 'Fugit ', 'labore', 'https://www.youtube.com/embed/IY3EfWjUJKo?si=92yXODi16Pcqph0Y', 'Adipisicing rem dolo', 'Veritatis doloribus', '2', 'Expedita velit cons', 'Aut dolores duis del', '1.352083', '103.819839', NULL, '1', 11, '1', '2024-03-09 03:25:49', '2024-04-07 02:26:54'),
(5, '3', 'Air Conditioning,Maintenance Staff,Intercom,Floor Level,Service Elevators,Balcony or Terrace,Electricity Backup', 'Sara Tran', 'sara-tran', 'PC004', 'buy', '790', '386', '1795663093174453.jpg', 'Do impedit fugiat d', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>\r\n<h3>Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC</h3>\r\n<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>', '4', '4', 'Rerum beatae sunt pr', 'Volupta', 'Sinten', 'https://www.youtube.com/embed/SlXOu1V_mrY?si=dEE40vaj74ybGeck', 'Aut ea dolores sunt', 'Corrupti incidunt', '3', 'Non est corrupti in', 'Quis assumenda aut a', '-6.175110', '106.865036', '1', '1', NULL, '1', '2024-04-07 02:16:14', '2024-04-07 02:20:11'),
(6, '5', 'CCTV Security,Cleaning Services,Intercom,Service Elevators,Electricity Backup', 'Uma Garcia', 'uma-garcia', 'PC005', 'rent', '737', '461', '1795839596483197.jpg', 'Autem commodo amet', '<p>\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"</p>', '5', '5', 'Tempora aspernatur a', 'Consequatur', 'ratione', 'https://www.youtube.com/embed/yVL36r6qyIA?si=iuH2uHluT1d15eWS', 'Nihil at esse enim o', 'Iusto quaerat itaque', '4', 'Quia est sint tempor', 'Quod ut amet non ex', '13.7563', '100.5018', '1', '1', 12, '1', '2024-04-09 01:01:41', '2024-05-13 04:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `property_messages`
--

CREATE TABLE `property_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `msg_name` varchar(255) DEFAULT NULL,
  `msg_email` varchar(255) DEFAULT NULL,
  `msg_phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_messages`
--

INSERT INTO `property_messages` (`id`, `user_id`, `agent_id`, `property_id`, `msg_name`, `msg_email`, `msg_phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 5, 'User', 'user@gmail.com', '0172255', 'I need Your Number. Its urgent.', '2024-04-15 01:21:00', NULL),
(2, 3, '2', 2, 'User', 'user@gmail.com', '0172255', 'Plz contact me as soon as possible', '2024-04-15 01:36:11', NULL),
(3, 10, '2', 2, 'Khan', 'khan@gmail.com', '+1 (771) 504-1015', 'I want to buy this property. Its urgent.', '2024-04-16 06:41:56', NULL),
(4, 10, '11', NULL, 'Khan', 'khan@gmail.com', '+1 (771) 504-1017', 'I want to know about your company profile', '2024-04-25 00:37:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `type_name`, `type_icon`, `created_at`, `updated_at`) VALUES
(1, 'Apartment', 'icon-1', NULL, NULL),
(2, 'Office', 'icon-2', NULL, '2024-02-24 01:37:47'),
(3, 'Floor', 'icon-3', NULL, NULL),
(4, 'Duplex', 'icon-4', NULL, NULL),
(5, 'Building', 'icon-5', NULL, NULL),
(6, 'Warehouse', 'icon-6', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'web', '2024-06-13 06:01:53', '2024-06-13 06:01:53'),
(2, 'Manager', 'web', '2024-06-13 06:04:21', '2024-06-13 06:04:21'),
(3, 'Admin', 'web', '2024-06-13 06:04:58', '2024-06-13 06:04:58'),
(4, 'Sales', 'web', '2024-06-13 06:05:33', '2024-06-13 06:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 4),
(3, 1),
(4, 1),
(4, 4),
(5, 1),
(6, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(12, 3),
(13, 1),
(13, 3),
(14, 1),
(14, 3),
(15, 1),
(15, 3),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(35, 3),
(35, 4),
(36, 1),
(36, 3),
(37, 1),
(37, 3),
(37, 4),
(38, 1),
(38, 3);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `agent_id` varchar(255) DEFAULT NULL,
  `tour_date` varchar(255) DEFAULT NULL,
  `tour_time` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `user_id`, `property_id`, `agent_id`, `tour_date`, `tour_time`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 6, '12', '05/31/2024', '9pm', 'I want to visit your property', '1', '2024-05-30 00:06:57', '2024-06-10 03:35:27'),
(2, 3, 6, '12', '06/02/2024', '10pm', 'I would like to see your property and around', '1', '2024-05-31 00:20:20', '2024-05-31 00:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `support_phone` varchar(255) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `support_phone`, `company_address`, `email`, `facebook`, `twitter`, `copyright`, `created_at`, `updated_at`) VALUES
(1, '1801619461187755.jpg', '+251-235-3256', 'Discover St, New York, NY 10012, USA', 'info@example.com', 'https://www.facebook.com/', 'https://www.twitter.com/', 'Realshed © 2021 All Right Reserved', NULL, '2024-06-11 20:10:09');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE `smtp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mailer` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `port` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encryption` varchar(255) DEFAULT NULL,
  `from_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smtp_settings`
--

INSERT INTO `smtp_settings` (`id`, `mailer`, `host`, `port`, `user_name`, `password`, `encryption`, `from_address`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'sandbox.smtp.mailtrap.io', '2525', 'b2aee0d51c12f6', 'aeba2bfec6e7e0', 'tls', 'sudip2tenber@gmail.com', NULL, '2024-06-10 02:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `state_image`, `created_at`, `updated_at`) VALUES
(1, 'Iusto et do ut', '1798914804551646.jpg', NULL, '2024-05-13 02:18:50'),
(2, 'Omnis sed obcaecati', '1798915121788817.jpg', NULL, NULL),
(3, 'Ratione sit quam se', '1798915308526581.jpg', NULL, NULL),
(4, 'Autem consectetur', '1798924874690292.jpg', NULL, '2024-05-13 02:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `image`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Beau Wyat', 'Labor', '1799280536577171.png', 'Cillum harum eveniet ea voluptas q', '2024-05-17 00:33:57', '2024-05-17 02:32:45'),
(2, 'Erich Bates', 'Dolore', '1799288162256600.png', 'Et animi molestiae nihil quis rec', '2024-05-17 00:39:31', '2024-05-17 02:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','agent','user') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `credit` varchar(255) DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `photo`, `phone`, `address`, `role`, `status`, `credit`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin23', '20240220114622img-1.jpg', '01711', 'USA', 'admin', 'active', '0', 'admin@gmail.com', NULL, '$2y$12$qbKW7Ic5ejLBGBB7uGBd6.6v4mwz1jULV2Mqeqc/Zzab0B6QR/Jue', NULL, NULL, '2024-02-20 07:56:00'),
(2, 'Agent', 'agent', '20240422045348optimized_large_thumb_stage.jpg', '+1 (881) 669-7163', '19 East Clarendon Parkway', 'agent', 'active', '17', 'agent@gmail.com', NULL, '$2y$12$lnZdBlCsD9Q4BjgNf99xVua9ycM0OERbsYYb5XhIEoWAMTd8ayKS2', NULL, NULL, '2024-04-21 22:53:48'),
(3, 'User', 'user23', '20240223081520author.jpg', '0172255', '125 Windler Charlene, INDIA 10180', 'user', 'active', '0', 'user@gmail.com', NULL, '$2y$12$xjrVzX2LGfxMGaEZt4ppD.8kmp6A/woxq.jsytAql9ABKxcjY1hBi', NULL, NULL, '2024-02-23 03:42:57'),
(5, 'Mrs. Emilia Wehner', NULL, 'https://via.placeholder.com/60x60.png/0011ff?text=voluptatem', '(814) 363-8270', '125 Windler Road\nNew Charlene, ND 10180', 'user', 'inactive', '0', 'lowe.juston@example.net', '2024-02-13 10:17:19', '$2y$12$9tLCYbMDmHkG4vVn.BeJOuCSW2.zQYTAiMkTbii15zKITRXRiNa6G', 'B1H1FfVqZ9', '2024-02-13 10:17:19', '2024-02-13 10:17:19'),
(8, 'Ryleigh Kozey', NULL, 'https://via.placeholder.com/60x60.png/0088dd?text=voluptatibus', '+1.629.237.0321', '230 Madalyn Field\nGloverfurt, FL 95324-1653', 'user', 'inactive', '0', 'zechariah.nolan@example.com', '2024-02-13 10:17:19', '$2y$12$9tLCYbMDmHkG4vVn.BeJOuCSW2.zQYTAiMkTbii15zKITRXRiNa6G', 'WX0fOegJEz', '2024-02-13 10:17:19', '2024-02-13 10:17:19'),
(9, 'Test', NULL, NULL, NULL, NULL, 'user', 'active', '0', 'test@gmail.com', NULL, '$2y$12$WBkkvrT4WXoo.BqCbiTMIeuYuMssCnLywzmpvZJ3p3wL3aTGq/RD.', NULL, '2024-02-13 10:25:38', '2024-02-13 10:25:38'),
(10, 'Khan', NULL, NULL, NULL, NULL, 'user', 'active', '0', 'khan@gmail.com', NULL, '$2y$12$0II9kVN28lQfbu9dInLW1.Xpu0E4E8ussNs7qBd4b0gOXUDACF/0u', NULL, '2024-02-22 05:05:13', '2024-02-22 05:05:13'),
(11, 'Easy', 'easy', '20240422045534optimized_large_thumb_stage (1).jpg', '0112233', '553 North Clarendon Street', 'agent', 'active', '1', 'easy@gmail.com', NULL, '$2y$12$7.X3sF93KAwAxunPH/bz0uuCGNLGWSZyt/ogUP9ggjqXL3Ui/nWwO', NULL, '2024-03-10 02:53:41', '2024-04-21 22:55:34'),
(12, 'Camille Young', 'camil', '20240422045703demolitions_art.webp', '+1 (149) 794-1914', 'Quis optio aut dolo', 'agent', 'active', '4', 'zoryzy@mailinator.com', NULL, '$2y$12$rL.WuAwcnmaQJIWcsWpmZuBt/Ye75mdVuZNQyI04qmsV/Ep9phRr6', NULL, NULL, '2024-04-21 22:57:03'),
(13, 'Udemy', 'udemy', NULL, '0123654789', '998 East Oak Parkway', 'admin', 'active', '0', 'udemy@gmail.com', NULL, '$2y$12$Y77glgeCiIuvK8RBmDRWaeIZIzpzjMhFAPYOpt/DxoplvZmFki4Om', NULL, '2024-06-16 23:47:41', '2024-06-16 23:47:41'),
(15, 'Evan Bowen', 'zobegyx', NULL, '+1 (225) 214-4436', 'Voluptatem aperiam', 'admin', 'active', '0', 'xuzaqolyri@mailinator.com', NULL, '$2y$12$pyWL.mq9uA8Xb/pG1OybeennPCab4/qjrdLB7.lBRnH8Ot37Qzsty', NULL, '2024-06-17 03:03:22', '2024-06-17 03:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `property_id`, `created_at`, `updated_at`) VALUES
(2, 3, 6, '2024-04-12 09:09:06', NULL),
(3, 3, 5, '2024-04-13 00:36:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compares`
--
ALTER TABLE `compares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `multi_images`
--
ALTER TABLE `multi_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_plans`
--
ALTER TABLE `package_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_messages`
--
ALTER TABLE `property_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `compares`
--
ALTER TABLE `compares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `multi_images`
--
ALTER TABLE `multi_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `package_plans`
--
ALTER TABLE `package_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `property_messages`
--
ALTER TABLE `property_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
