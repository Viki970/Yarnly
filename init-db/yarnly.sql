-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 11, 2026 at 07:23 PM
-- Server version: 9.5.0
-- PHP Version: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yarnly`
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
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `craft_type` enum('crochet','knitting','embroidery') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'crochet',
  `cover_image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`id`, `name`, `description`, `craft_type`, `cover_image_path`, `is_public`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'Pooh & Piglet', 'Cute Pooh and Piglet amigurumi crochet pattern set', 'crochet', 'collections/covers/LVLAesxqOTvEdAHOZOxxdQmcwiqTmSq7KCJCDJwY.png', 1, 1, '2026-02-15 19:07:18', '2026-02-15 20:40:33'),
(6, 'Toothles bundle', 'Black & White versions of Toothless', 'crochet', NULL, 1, 1, '2026-02-15 21:44:59', '2026-02-15 21:44:59'),
(7, 'Sailor/Anemone Sweaters', NULL, 'knitting', NULL, 1, 1, '2026-02-25 20:58:27', '2026-02-25 20:58:27'),
(8, 'Hoop Art Embroidery Patterns', NULL, 'embroidery', NULL, 1, 1, '2026-02-26 09:36:52', '2026-02-26 09:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `collection_favorites`
--

CREATE TABLE `collection_favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `collection_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collection_favorites`
--

INSERT INTO `collection_favorites` (`id`, `user_id`, `collection_id`, `created_at`, `updated_at`) VALUES
(3, 1, 6, '2026-02-16 04:32:14', '2026-02-16 04:32:14'),
(4, 2, 8, '2026-02-26 09:37:42', '2026-02-26 09:37:42'),
(5, 2, 7, '2026-02-26 09:38:06', '2026-02-26 09:38:06'),
(6, 2, 6, '2026-02-26 09:38:24', '2026-02-26 09:38:24'),
(7, 2, 3, '2026-02-26 09:38:27', '2026-02-26 09:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `collection_pattern`
--

CREATE TABLE `collection_pattern` (
  `collection_id` bigint UNSIGNED NOT NULL,
  `pattern_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `collection_pattern`
--

INSERT INTO `collection_pattern` (`collection_id`, `pattern_id`, `created_at`, `updated_at`) VALUES
(3, 3, '2026-02-15 19:07:18', '2026-02-15 19:07:18'),
(3, 4, '2026-02-15 19:07:18', '2026-02-15 19:07:18'),
(6, 1, '2026-02-15 21:44:59', '2026-02-15 21:44:59'),
(6, 2, '2026-02-15 21:44:59', '2026-02-15 21:44:59'),
(7, 8, '2026-02-25 20:58:27', '2026-02-25 20:58:27'),
(7, 10, '2026-02-25 20:58:27', '2026-02-25 20:58:27'),
(8, 11, '2026-02-26 09:36:52', '2026-02-26 09:36:52'),
(8, 12, '2026-02-26 09:36:52', '2026-02-26 09:36:52');

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
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` bigint UNSIGNED NOT NULL,
  `follower_id` bigint UNSIGNED NOT NULL,
  `following_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `follower_id`, `following_id`, `created_at`, `updated_at`) VALUES
(5, 2, 1, '2026-03-12 14:17:25', '2026-03-12 14:17:25'),
(8, 1, 2, '2026-03-14 17:20:45', '2026-03-14 17:20:45');

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
(17, '0001_01_01_000000_create_users_table', 1),
(18, '0001_01_01_000001_create_cache_table', 1),
(19, '0001_01_01_000002_create_jobs_table', 1),
(20, '2025_01_21_000000_create_crochet_patterns_table', 1),
(21, '2025_09_02_075243_add_two_factor_columns_to_users_table', 1),
(22, '2026_01_28_113135_create_user_favorites_table', 1),
(23, '2026_02_13_132217_create_collections_table', 1),
(24, '2026_02_13_132304_create_collection_pattern_table', 1),
(25, '2026_02_16_000000_create_collection_favorites_table', 2),
(26, '2026_03_04_000001_create_posts_table', 3),
(27, '2026_03_04_000002_create_post_images_table', 3),
(28, '2026_03_04_000003_create_post_likes_table', 3),
(29, '2026_03_04_000004_create_post_favorites_table', 3),
(30, '2026_03_10_000000_create_follows_table', 4),
(31, '2026_03_11_000000_create_post_comments_table', 5),
(32, '2026_03_11_164404_create_notifications_table', 6),
(33, '2026_03_13_000000_create_post_collections_table', 7),
(34, '2026_03_13_000001_create_post_collection_post_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('19dae418-cdfa-4f30-abb0-8bf69b4c053c', 'App\\Notifications\\NewLikeNotification', 'App\\Models\\User', 1, '{\"type\":\"like\",\"liker_id\":2,\"liker_name\":\"Viki Shtarbanova\",\"post_id\":3,\"message\":\"Viki Shtarbanova liked your post.\",\"url\":\"http:\\/\\/localhost:8000\\/posts\\/3\"}', '2026-03-12 11:31:12', '2026-03-12 11:09:09', '2026-03-12 11:31:12'),
('25b475e5-9309-4f12-8603-eface98fa57e', 'App\\Notifications\\NewLikeNotification', 'App\\Models\\User', 1, '{\"type\":\"like\",\"liker_id\":2,\"liker_name\":\"Viki Shtarbanova\",\"post_id\":5,\"message\":\"Viki Shtarbanova liked your post.\",\"url\":\"http:\\/\\/localhost:8000\\/posts\\/5\"}', '2026-03-12 11:31:12', '2026-03-12 11:31:00', '2026-03-12 11:31:12'),
('31d1bc04-4002-45a4-9270-82f75d71f4fe', 'App\\Notifications\\NewCommentNotification', 'App\\Models\\User', 2, '{\"type\":\"comment\",\"commenter_id\":1,\"commenter_name\":\"Viki\",\"post_id\":9,\"message\":\"Viki commented on your post.\",\"url\":\"http:\\/\\/localhost:8000\\/posts\\/9\"}', '2026-03-12 05:38:43', '2026-03-12 05:38:24', '2026-03-12 05:38:43'),
('4d4629ea-a4f1-482a-a2d0-d65525178843', 'App\\Notifications\\NewPostFromFollowedNotification', 'App\\Models\\User', 1, '{\"type\":\"new_post\",\"poster_id\":2,\"poster_name\":\"Viki Shtarbanova\",\"post_id\":12,\"message\":\"Viki Shtarbanova published a new post.\",\"url\":\"http:\\/\\/localhost:8000\\/posts\\/12\"}', '2026-03-18 12:04:44', '2026-03-14 18:49:45', '2026-03-18 12:04:44'),
('4e6d97a1-a66b-4808-afb9-66fa1d753649', 'App\\Notifications\\NewFollowNotification', 'App\\Models\\User', 2, '{\"type\":\"follow\",\"follower_id\":1,\"follower_name\":\"Viki\",\"message\":\"Viki started following you.\",\"url\":\"http:\\/\\/localhost:8000\\/my-profile\"}', '2026-03-14 20:20:49', '2026-03-14 17:20:45', '2026-03-14 20:20:49'),
('61705f7b-3ffa-4558-9c44-4933e8c50ebe', 'App\\Notifications\\NewFollowNotification', 'App\\Models\\User', 2, '{\"type\":\"follow\",\"follower_id\":1,\"follower_name\":\"Viki\",\"message\":\"Viki started following you.\",\"url\":\"http:\\/\\/localhost:8000\\/my-profile\"}', '2026-03-12 17:42:32', '2026-03-12 17:42:22', '2026-03-12 17:42:32'),
('7c63a4e4-0d73-41f7-9a85-e9718e5ceb3e', 'App\\Notifications\\NewFollowNotification', 'App\\Models\\User', 2, '{\"type\":\"follow\",\"follower_id\":1,\"follower_name\":\"Viki\",\"message\":\"Viki started following you.\",\"url\":\"http:\\/\\/localhost:8000\\/my-profile\"}', '2026-03-14 20:20:49', '2026-03-14 17:20:32', '2026-03-14 20:20:49'),
('80233475-1480-40f9-a80a-69472eb5031d', 'App\\Notifications\\NewLikeNotification', 'App\\Models\\User', 2, '{\"type\":\"like\",\"liker_id\":1,\"liker_name\":\"Viki\",\"post_id\":9,\"message\":\"Viki liked your post.\",\"url\":\"http:\\/\\/localhost:8000\\/posts\\/9\"}', '2026-03-12 05:38:43', '2026-03-12 05:38:01', '2026-03-12 05:38:43'),
('c1a0d378-8c28-4d69-9fff-db2f56f398a7', 'App\\Notifications\\NewFollowNotification', 'App\\Models\\User', 1, '{\"type\":\"follow\",\"follower_id\":2,\"follower_name\":\"Viki Shtarbanova\",\"message\":\"Viki Shtarbanova started following you.\",\"url\":\"http:\\/\\/localhost:8000\\/my-profile\"}', '2026-03-12 16:21:31', '2026-03-12 14:17:25', '2026-03-12 16:21:31'),
('c42f0a9e-de1a-4bed-9753-9f383841041b', 'App\\Notifications\\NewPostFromFollowedNotification', 'App\\Models\\User', 1, '{\"type\":\"new_post\",\"poster_id\":2,\"poster_name\":\"Viki Shtarbanova\",\"post_id\":10,\"message\":\"Viki Shtarbanova published a new post.\",\"url\":\"http:\\/\\/localhost:8000\\/posts\\/10\"}', '2026-03-18 12:04:44', '2026-03-14 16:35:10', '2026-03-18 12:04:44'),
('d4a14580-0a5d-47d7-aac9-fe34a19716d3', 'App\\Notifications\\NewPostFromFollowedNotification', 'App\\Models\\User', 2, '{\"type\":\"new_post\",\"poster_id\":1,\"poster_name\":\"Viki\",\"post_id\":11,\"message\":\"Viki published a new post.\",\"url\":\"http:\\/\\/localhost:8000\\/posts\\/11\"}', '2026-03-14 20:20:49', '2026-03-14 17:47:31', '2026-03-14 20:20:49'),
('ff0411c7-2bef-49fb-932c-2a081e3c6a9d', 'App\\Notifications\\NewFollowNotification', 'App\\Models\\User', 2, '{\"type\":\"follow\",\"follower_id\":1,\"follower_name\":\"Viki\",\"message\":\"Viki started following you.\",\"url\":\"http:\\/\\/localhost:8000\\/my-profile\"}', '2026-03-12 05:38:43', '2026-03-12 05:37:28', '2026-03-12 05:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('viki260407@gmail.com', '$2y$12$n/8HmDvdxJjeQx7ZwvNBzOmkRqomZmQSyxIv9n6ae7vuJP6CIgW7.', '2026-03-17 06:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `patterns`
--

CREATE TABLE `patterns` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` enum('beginner','intermediate','advanced') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'beginner',
  `estimated_hours` int DEFAULT NULL,
  `pdf_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `craft_type` enum('crochet','knitting','embroidery') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'crochet',
  `makers_saved` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patterns`
--

INSERT INTO `patterns` (`id`, `user_id`, `title`, `description`, `category`, `difficulty`, `estimated_hours`, `pdf_file`, `original_filename`, `image_path`, `tags`, `craft_type`, `makers_saved`, `created_at`, `updated_at`) VALUES
(1, 1, 'Black Toothless', 'I have a white version on my profile!', 'amigurumi', 'intermediate', 4, 'patterns/pdfs/35nox9iPXXtxHh0wCKBbSxBLHvuW65UdkKh517PW.pdf', 'NightDragonPatternv2.pdf', 'patterns/images/9FvSPdXHVqGESzSLP1y4OUKZEhfuBZYC2OeV5PfP.png', '#toothless #black #dragon', 'crochet', 1, '2026-02-15 18:33:22', '2026-02-15 18:41:16'),
(2, 1, 'White Toothless', 'I have a black version on my profile!', 'amigurumi', 'intermediate', 4, 'patterns/pdfs/phdXTdsnFbuN4KnUvGe5NhJkJYJJTaM03TCPNOjT.pdf', 'LightDragonPatternv2.pdf', 'patterns/images/s8s2r1SVU9gz1Et8nb2m1CPbwswiyMQNxvVoHqXz.png', '#toothless #white #dragon', 'crochet', 1, '2026-02-15 18:34:09', '2026-02-15 18:41:15'),
(3, 1, 'Winnie the Pooh', 'Adorable handmade Pooh amigurumi crochet design', 'amigurumi', 'beginner', 3, 'patterns/pdfs/x5XtFnT5b8PYReinoseqzWZaZeeP1OerLhnTaufz.pdf', 'Pooh.pdf', 'patterns/images/WXQxPj9oAqQjeeF0Bxh5vWQ5q4A4XAspQ9sotsko.png', '#poo #character #yellow #plush #WinnieThePooh', 'crochet', 1, '2026-02-15 18:36:10', '2026-02-15 18:41:19'),
(4, 1, 'Piglet', 'Cute chubby Piglet amigurumi crochet pattern', 'amigurumi', 'beginner', 3, 'patterns/pdfs/OYNBNOkPFTQv5GIfM3R7pMTr37ozuLWIsu7qviM3.pdf', 'Piglet.pdf', 'patterns/images/hImtaHCh49IeM8DMlPrmf28y9naSJTc4rRGwFprn.png', '#Piglet #pink #cute #Pooh', 'crochet', 1, '2026-02-15 18:36:55', '2026-02-15 18:41:18'),
(5, 2, 'Plush Bear', 'A cute Plush Bear', 'amigurumi', 'intermediate', 5, 'patterns/pdfs/LlqcmqQLUnq1cTLBoExbuxIZJe8LaXOLCuyoA7GP.pdf', 'Plush Bear.pdf', 'patterns/images/VOWBnanTwVGddqory4dRBKXJsqg8jIgXomcKYtMX.png', '#bear #brown #cute #Amigurumi', 'crochet', 1, '2026-02-15 18:40:14', '2026-02-15 20:43:40'),
(8, 1, 'Sailor Sweater', NULL, 'sweaters', 'intermediate', 15, 'patterns/pdfs/SJkHs05IrpCHoi5JgNaIlH9KHPc9n1aaJ7pqjXiz.pdf', 'SailorSweater.pdf', 'patterns/images/myNq1kivqatrMait9lR1cTFUUfB87APlkoe8TTlj.png', NULL, 'knitting', 1, '2026-02-25 20:45:57', '2026-02-25 20:57:06'),
(9, 2, 'Saga Sweater', NULL, 'sweaters', 'intermediate', 20, 'patterns/pdfs/TN1PbT5dASPWKd5a6vPP41sFjvLehmSgvGvGTz8t.pdf', 'SagaSweater.pdf', 'patterns/images/3Kfs4rNcy2Vlu7fHuRMc0pfTbItuZZ2VjFvIDX3M.png', NULL, 'knitting', 1, '2026-02-25 20:53:14', '2026-02-25 20:53:49'),
(10, 1, 'Anemone Sweater', NULL, 'sweaters', 'advanced', 25, 'patterns/pdfs/z72ZtLxA9gZqyfuUMRkhsG13urwRNdBBqRmEa0mB.pdf', 'AnemoneSweater.pdf', 'patterns/images/BMhbhzy5vrkQxZfekXeaVZuh7c6Xej2iaS7qpb3j.png', NULL, 'knitting', 0, '2026-02-25 20:55:47', '2026-02-25 20:55:47'),
(11, 1, 'Bloom Embroidery', NULL, 'hoop-art-wall-decor', 'beginner', 1, 'patterns/pdfs/yznSOSyRuX5qK08jEpuIgLT83HnNrNcOCzQtOGaS.pdf', 'BloomEmroidery.pdf', NULL, NULL, 'embroidery', 0, '2026-02-26 08:34:36', '2026-02-26 08:34:36'),
(12, 1, 'Trio of Flowers Embroidery Pattern', NULL, 'hoop-art-wall-decor', 'beginner', 2, 'patterns/pdfs/6tRaeP8r5AKVW7scYWPvJsKUVfY8PwOSoesLbXxX.pdf', 'TrioPatterns.pdf', 'patterns/images/NdIpBqc0npYNZr8qmgwUq7CjNTYlCzWaCnCH7V80.png', NULL, 'embroidery', 0, '2026-02-26 08:37:09', '2026-02-26 08:37:09'),
(13, 2, 'Flower Cross Stitch', NULL, 'cross-stitch', 'beginner', 2, 'patterns/pdfs/r0pf4UUfUSWIWJPGPnhFhCa8OlWgikvOkEYBLm96.pdf', 'FlowerPixArt.pdf', 'patterns/images/96yubQdAePxhoJTWNJXjviVnSKuk0gdOJPfV2Vb9.jpg', NULL, 'embroidery', 1, '2026-02-26 08:39:11', '2026-02-26 09:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `craft_type` enum('crochet','knitting','embroidery') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `description`, `craft_type`, `tags`, `created_at`, `updated_at`) VALUES
(1, 1, 'Black & White version of Toothless!', 'crochet', '#crochet #toothless', '2026-03-05 10:51:54', '2026-03-05 10:51:54'),
(2, 1, 'Jumbo Tom & Jerry', 'crochet', '#tom #jerry #cartoon', '2026-03-06 10:28:44', '2026-03-06 10:28:44'),
(3, 1, 'Little Ninja for a car mirror', 'crochet', '#ninja #car #mirror', '2026-03-06 10:29:42', '2026-03-06 10:29:42'),
(4, 1, 'Tiger & Eeyore', 'crochet', '#tiger #eeyore #cartoon', '2026-03-06 10:31:20', '2026-03-06 10:31:20'),
(5, 1, 'Bear with bouquet with roses', 'crochet', '#bear # bouquet #roses #love', '2026-03-06 10:33:18', '2026-03-06 10:33:18'),
(6, 1, 'Winnie the Pooh & Piglet', 'crochet', '#winniethepooh #piglet #cartoon', '2026-03-06 10:34:11', '2026-03-06 10:34:11'),
(7, 2, 'Blue Stitch Amigurumi', 'crochet', '#stitch #blue #amigurumi #cartoon', '2026-03-06 12:27:25', '2026-03-06 12:27:25'),
(8, 2, 'Pink Stitch Amigurumi (Angel)', 'crochet', '#stitch #angel #amigurumi #cartoon', '2026-03-06 12:30:04', '2026-03-06 12:30:04'),
(9, 2, 'Christmas Stitch', 'crochet', '#stitch #blue #christmas #amigurumi #cartoon', '2026-03-06 12:32:27', '2026-03-06 12:32:27'),
(11, 1, NULL, 'crochet', '#crochet #amigurumi #dog #puppy', '2026-03-14 17:47:31', '2026-03-14 17:47:31'),
(12, 2, 'The second version of Tom & Jerry!😊', 'crochet', NULL, '2026-03-14 18:49:45', '2026-03-14 18:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `post_collections`
--

CREATE TABLE `post_collections` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_collections`
--

INSERT INTO `post_collections` (`id`, `user_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Stitch', '2026-03-13 12:16:51', '2026-03-13 12:16:51'),
(2, 2, 'test', '2026-03-13 12:35:00', '2026-03-13 12:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_collection_post`
--

CREATE TABLE `post_collection_post` (
  `id` bigint UNSIGNED NOT NULL,
  `post_collection_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_collection_post`
--

INSERT INTO `post_collection_post` (`id`, `post_collection_id`, `post_id`, `created_at`, `updated_at`) VALUES
(3, 1, 7, '2026-03-13 12:19:24', '2026-03-13 12:19:24'),
(4, 1, 8, '2026-03-13 12:21:04', '2026-03-13 12:21:04'),
(5, 2, 1, '2026-03-13 12:39:57', '2026-03-13 12:39:57'),
(6, 2, 6, '2026-03-13 12:41:57', '2026-03-13 12:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Theese are so cute! Will definetly try to do it later.😊😊', '2026-03-11 13:34:35', '2026-03-11 13:34:35'),
(2, 1, 1, '@VikiShtarbanova Hope you like it!💕', '2026-03-11 13:53:19', '2026-03-11 13:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `post_favorites`
--

CREATE TABLE `post_favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_favorites`
--

INSERT INTO `post_favorites` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2026-03-06 12:30:10', '2026-03-06 12:30:10'),
(2, 2, 5, '2026-03-06 12:30:49', '2026-03-06 12:30:49'),
(3, 1, 9, '2026-03-12 16:34:44', '2026-03-12 16:34:44'),
(4, 1, 8, '2026-03-12 16:34:47', '2026-03-12 16:34:47'),
(5, 1, 7, '2026-03-12 16:34:49', '2026-03-12 16:34:49'),
(8, 2, 2, '2026-03-13 12:34:10', '2026-03-13 12:34:10'),
(12, 2, 1, '2026-03-13 12:39:53', '2026-03-13 12:39:53'),
(13, 2, 4, '2026-03-13 12:40:00', '2026-03-13 12:40:00'),
(17, 2, 6, '2026-03-13 12:42:51', '2026-03-13 12:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_images`
--

INSERT INTO `post_images` (`id`, `post_id`, `image_path`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'posts/qfcwpvxJ958LL6sbD09r00Ad4zTj99GoejBMb1d6.png', 0, '2026-03-05 10:51:55', '2026-03-05 10:51:55'),
(2, 1, 'posts/Chhdzg2ilNEZHo5jTxZDGrs51of2oxyRJ743fP2A.png', 1, '2026-03-05 10:51:55', '2026-03-05 10:51:55'),
(3, 2, 'posts/8wzGAPebPebfMg1loZipqUDmJbQPrZ2JrEZllnan.jpg', 0, '2026-03-06 10:28:45', '2026-03-06 10:28:45'),
(4, 2, 'posts/mcFn2Wa82hqmdf92csZFaR7rone3yk08dKVpcupF.jpg', 1, '2026-03-06 10:28:45', '2026-03-06 10:28:45'),
(5, 2, 'posts/W2uMGS0rrMGD7DqfuATZbYYvUJRHGLTDPLcxI6Ip.jpg', 2, '2026-03-06 10:28:45', '2026-03-06 10:28:45'),
(6, 3, 'posts/RpmIQCkEyjyDL5F2o7DXELDvL4omt2etHmov6GMw.jpg', 0, '2026-03-06 10:29:42', '2026-03-06 10:29:42'),
(7, 4, 'posts/UXtI4gVsMNJjBxxJqYhQlpLSAb2vra8BIm73Ovig.jpg', 0, '2026-03-06 10:31:20', '2026-03-06 10:31:20'),
(8, 4, 'posts/aKDAvjxAwGTprIHsmQPQtuL4u17DxrpgEb3vZMgI.jpg', 1, '2026-03-06 10:31:20', '2026-03-06 10:31:20'),
(9, 5, 'posts/j814V9S1SjhIfeJhljCoRCmRVmT58X1SvNgbc4zg.jpg', 0, '2026-03-06 10:33:18', '2026-03-06 10:33:18'),
(10, 5, 'posts/NQWlnTuv7PnirYDrUNOqvvaZMqEx9kiGRSgzPkZS.jpg', 1, '2026-03-06 10:33:18', '2026-03-06 10:33:18'),
(11, 5, 'posts/O8OkxrvyzKV8IzPido8KGKuPcubYUZWCGvpIWlOt.jpg', 2, '2026-03-06 10:33:18', '2026-03-06 10:33:18'),
(12, 6, 'posts/jxpea3pLTfHD75AfB8yN0liXK5F3FOSrvWnWhjlN.jpg', 0, '2026-03-06 10:34:11', '2026-03-06 10:34:11'),
(13, 6, 'posts/vcP4Nhn8157nO3vg7mSjUbQ8wX1F1M17TcjatPFK.jpg', 1, '2026-03-06 10:34:11', '2026-03-06 10:34:11'),
(14, 6, 'posts/Ts2EHASr1Fa9OnP72wbYuI9PFubIh4ff0h3qqO7n.jpg', 2, '2026-03-06 10:34:11', '2026-03-06 10:34:11'),
(15, 7, 'posts/urOzIkcFh60wGJfYgLqx8J2zlKDzt7WGJcTHeUKR.jpg', 0, '2026-03-06 12:27:25', '2026-03-06 12:27:25'),
(16, 7, 'posts/SSV37BKRDuG1MH2NxY6OzuDCcrnQMRz7mSfR34dU.jpg', 1, '2026-03-06 12:27:25', '2026-03-06 12:27:25'),
(17, 7, 'posts/zWdga66zmNAwkhS5IH1Z9PBbeZLpa9MZnKShOlCS.jpg', 2, '2026-03-06 12:27:25', '2026-03-06 12:27:25'),
(18, 8, 'posts/z8NIGzjfZyUZoKFC8FwNDtrCfHXIhBZZlreYLwWL.jpg', 0, '2026-03-06 12:30:04', '2026-03-06 12:30:04'),
(19, 8, 'posts/AUDHavcRK935rQdyrAJPN4gogyojuBd3OixaQq9e.jpg', 1, '2026-03-06 12:30:04', '2026-03-06 12:30:04'),
(20, 8, 'posts/K12jd4hEDvWHCOpvx7kkC7NkVYK0FcFGCN2XQWsz.jpg', 2, '2026-03-06 12:30:04', '2026-03-06 12:30:04'),
(21, 9, 'posts/1hi86TQ6052tRUSVw4xy28pIcTgiaUTM9SqwE9AW.jpg', 0, '2026-03-06 12:32:27', '2026-03-06 12:32:27'),
(25, 11, 'posts/iLPDmYdRbh6UzkpziLK3y1sk0Dt85tH8j1pV8zeG.jpg', 0, '2026-03-14 17:47:31', '2026-03-14 17:47:31'),
(26, 11, 'posts/LQGELqdZkWkIKNeyMLQEZ2EeH5ckUSDll2p42OJP.jpg', 1, '2026-03-14 17:47:31', '2026-03-14 17:47:31'),
(27, 12, 'posts/J89rilwGtYQ5e8i06VItpSvxySmzi6XPkFa5b7by.jpg', 0, '2026-03-14 18:49:45', '2026-03-14 18:49:45'),
(28, 12, 'posts/WRtkgAFmto2zrwPJVIuFGdZlpxpowrxJ9dtYdLe7.jpg', 1, '2026-03-14 18:49:45', '2026-03-14 18:49:45'),
(29, 12, 'posts/ys4AAlaNczDWPIP2PFwCTKHXaq6npFYqMRs3ogpI.jpg', 2, '2026-03-14 18:49:45', '2026-03-14 18:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2026-03-06 09:35:46', '2026-03-06 09:35:46'),
(3, 2, 7, '2026-03-06 12:30:39', '2026-03-06 12:30:39'),
(4, 2, 1, '2026-03-06 12:30:43', '2026-03-06 12:30:43'),
(5, 2, 4, '2026-03-06 12:30:45', '2026-03-06 12:30:45'),
(7, 2, 6, '2026-03-06 12:30:56', '2026-03-06 12:30:56'),
(8, 1, 9, '2026-03-12 05:38:01', '2026-03-12 05:38:01'),
(9, 2, 3, '2026-03-12 11:09:07', '2026-03-12 11:09:07'),
(10, 2, 2, '2026-03-12 11:29:58', '2026-03-12 11:29:58'),
(11, 2, 5, '2026-03-12 11:31:00', '2026-03-12 11:31:00');

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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gAtuH9sLyKgpsPSprWbRfIxF1ZBNdX2gDkSmGMTY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidWVLaG52Ym1zRmlva2NpYjhmTWh5NFd0Z1V1NnV2WnZ0SDFBM3BJSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO319', 1775749376),
('hBU5iStHOROWa7fh4S5v9ECAzz0VwQpawj19TH0l', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT2h3T1czdXpDUFNaYWxzQlpxT080YmFjOHg2VkI1VEZEZEJzb3A5bCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO319', 1775749796);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_color` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_preference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'dark',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `bio`, `username`, `profile_picture`, `avatar_color`, `theme_preference`, `email`, `email_verified_at`, `role`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Viki', NULL, 'viki', NULL, '#3b82f6', 'dark', 'viki260407@gmail.com', NULL, 'user', '$2y$12$rSXCdnvCEYIVwvrulVcdJOvzuNJW/XZU8PNlQke9Jk3fUElHYU/wW', NULL, NULL, NULL, 'czIghVCpOt968jkxzo85L8nLFZMKumruzFJe7bhXQw4LcCjgyCJi93004tTx', '2026-02-15 18:31:55', '2026-04-07 04:57:50'),
(2, 'Viki Shtarbanova', 'insta: vi.ki_sh', 'viki_shtarbanova', NULL, '#7c3aed', 'light', 'viktoriashtarbanova@gmail.com', NULL, 'admin', '$2y$12$xdZszXOeInmcgUxB38UHyeaGMfGzllLPf4Oef49zDJD8HWlCjVroG', NULL, NULL, NULL, 'enwK2pCyMtrx8QDZaedBVfUohwKHppQ4ETatOrijJ6qbRe8zpjMA3wBaAFNx', '2026-02-15 18:32:21', '2026-04-07 08:04:44'),
(3, 'K.D.D was here', 'insta: k_dimitrov.exe', 'terminal', NULL, '#7c3aed', 'dark', 'kdimitrov@futuredesign-bg.com', NULL, 'admin', '$2y$12$8.p9Z6I6pS5L8p9Z6I6pSe7Ym/oN7kXkK/1yH6Vp7j0N1p7Z6I6pS', NULL, NULL, NULL, '', '2002-10-19 19:10:00', '2002-10-19 19:10:00'),
(4, 'Administrator', '\r\n', 'administrator', NULL, '#7c3aed', 'light', 'admin@yarnly.com', NULL, 'admin', '$2y$12$jfk7uMygea.MLzh55v53EeBz5PYLhiJ2.X5uS7QWhvIQ6r9IBXLUi', NULL, NULL, NULL, '', '2030-01-02 23:59:59', '2030-01-02 23:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_favorites`
--

CREATE TABLE `user_favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pattern_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_favorites`
--

INSERT INTO `user_favorites` (`id`, `user_id`, `pattern_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2026-02-15 18:41:15', '2026-02-15 18:41:15'),
(2, 2, 1, '2026-02-15 18:41:16', '2026-02-15 18:41:16'),
(3, 2, 4, '2026-02-15 18:41:18', '2026-02-15 18:41:18'),
(4, 2, 3, '2026-02-15 18:41:19', '2026-02-15 18:41:19'),
(5, 1, 5, '2026-02-15 20:43:40', '2026-02-15 20:43:40'),
(6, 2, 8, '2026-02-25 20:46:44', '2026-02-25 20:46:44'),
(7, 1, 9, '2026-02-25 20:53:49', '2026-02-25 20:53:49'),
(10, 2, 13, '2026-02-26 09:09:43', '2026-02-26 09:09:43');

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
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `collections_user_id_foreign` (`user_id`);

--
-- Indexes for table `collection_favorites`
--
ALTER TABLE `collection_favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `collection_favorites_user_id_collection_id_unique` (`user_id`,`collection_id`),
  ADD KEY `collection_favorites_collection_id_foreign` (`collection_id`);

--
-- Indexes for table `collection_pattern`
--
ALTER TABLE `collection_pattern`
  ADD PRIMARY KEY (`collection_id`,`pattern_id`),
  ADD KEY `collection_pattern_pattern_id_foreign` (`pattern_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `follows_follower_id_following_id_unique` (`follower_id`,`following_id`),
  ADD KEY `follows_following_id_foreign` (`following_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patterns`
--
ALTER TABLE `patterns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crochet_patterns_user_id_foreign` (`user_id`),
  ADD KEY `crochet_patterns_category_index` (`category`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_craft_type_index` (`craft_type`);

--
-- Indexes for table `post_collections`
--
ALTER TABLE `post_collections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_collections_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_collection_post`
--
ALTER TABLE `post_collection_post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_collection_post_post_collection_id_post_id_unique` (`post_collection_id`,`post_id`),
  ADD KEY `post_collection_post_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`),
  ADD KEY `post_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `post_favorites`
--
ALTER TABLE `post_favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_favorites_user_id_post_id_unique` (`user_id`,`post_id`),
  ADD KEY `post_favorites_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_images_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_likes_user_id_post_id_unique` (`user_id`,`post_id`),
  ADD KEY `post_likes_post_id_foreign` (`post_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_favorites_user_id_pattern_id_unique` (`user_id`,`pattern_id`),
  ADD KEY `user_favorites_pattern_id_foreign` (`pattern_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `collection_favorites`
--
ALTER TABLE `collection_favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `patterns`
--
ALTER TABLE `patterns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post_collections`
--
ALTER TABLE `post_collections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_collection_post`
--
ALTER TABLE `post_collection_post`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_favorites`
--
ALTER TABLE `post_favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_favorites`
--
ALTER TABLE `user_favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `collections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collection_favorites`
--
ALTER TABLE `collection_favorites`
  ADD CONSTRAINT `collection_favorites_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collection_favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `collection_pattern`
--
ALTER TABLE `collection_pattern`
  ADD CONSTRAINT `collection_pattern_collection_id_foreign` FOREIGN KEY (`collection_id`) REFERENCES `collections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `collection_pattern_pattern_id_foreign` FOREIGN KEY (`pattern_id`) REFERENCES `patterns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `follows_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follows_following_id_foreign` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patterns`
--
ALTER TABLE `patterns`
  ADD CONSTRAINT `crochet_patterns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_collections`
--
ALTER TABLE `post_collections`
  ADD CONSTRAINT `post_collections_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_collection_post`
--
ALTER TABLE `post_collection_post`
  ADD CONSTRAINT `post_collection_post_post_collection_id_foreign` FOREIGN KEY (`post_collection_id`) REFERENCES `post_collections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_collection_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_favorites`
--
ALTER TABLE `post_favorites`
  ADD CONSTRAINT `post_favorites_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `post_images_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_favorites`
--
ALTER TABLE `user_favorites`
  ADD CONSTRAINT `user_favorites_pattern_id_foreign` FOREIGN KEY (`pattern_id`) REFERENCES `patterns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
