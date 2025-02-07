-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 07:12 PM
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
-- Database: `laravel`
--

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
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `clouser` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `user_id`, `clouser`, `name`, `business_name`, `phone`, `address`, `zip`, `state`, `country`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(15, 1, 4, 'Carla Cochran', 'Scarlett Parks', '+1 (767) 354-9438', 'Autem eos expedita f', '28248', 'Ipsam eos labore ex', 'Vitae nesciunt corp', 'Nulla et corrupti s', 'Sale', '2025-02-05 11:53:36', '2025-02-05 13:04:19'),
(16, 1, 1, 'Lacy Small', 'Whilemina Burris', '+1 (372) 921-1801', 'Aliquid id quas porr', '60670', 'Porro corrupti aut', 'Vel in enim soluta s', 'Ipsum illo magnam a', 'Pending', '2025-02-05 12:33:01', '2025-02-05 12:33:01'),
(17, 4, 4, 'dssd', 'df', 'df', 'gfd', 'dfg', 'gdf', 'fdgdfg', 'fg', 'Sale', '2025-02-05 13:04:38', '2025-02-05 13:06:34'),
(18, 4, 4, 'gdfgfd', 'g dfg f', 'g', 'g fd', 'dg df', 'f gdf', 'g fdg f', 'dff', 'Approved', '2025-02-05 13:07:10', '2025-02-05 13:07:18'),
(19, 4, 4, 'gh gf gf', 'gf hgfh', 'hgf', 'gfhgf', 'hgf', 'h gf', 'hgfh gf', 'h gfhg', 'Approved', '2025-02-05 13:08:10', '2025-02-06 12:09:23'),
(20, 4, 4, 'asdasd', NULL, '345345', NULL, NULL, NULL, NULL, 'dfgfdg fhdf', 'Sale', '2025-02-05 15:07:33', '2025-02-06 12:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `lead_files`
--

CREATE TABLE `lead_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lead_files`
--

INSERT INTO `lead_files` (`id`, `lead_id`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 5, 'leads/files/E68O9Y81Ionnajit17CWyhVPMjmUlrANdj4lgEAv.wav', '2025-02-04 10:54:40', '2025-02-04 10:54:40'),
(2, 5, 'leads/files/Uxpnt7bkRYk0hntj7JM44aRL5wHibcW4aVQC0Xz8.wav', '2025-02-04 10:54:40', '2025-02-04 10:54:40'),
(3, 5, 'leads/files/wd8XpOsHjf6uPfJXKqtWSgFtxXh67gk2q4JxZAfv.wav', '2025-02-04 10:54:40', '2025-02-04 10:54:40'),
(4, 6, 'leads/files/hpasqgpVrHbakzqFsdim9vnIpU8WUOpSVwTg19OE.wav', '2025-02-04 11:16:39', '2025-02-04 11:16:39'),
(5, 6, 'leads/files/icoLkNtrxDrLiBHvpqfD2DMgkxNOUMgeEyR66rPJ.wav', '2025-02-04 11:16:39', '2025-02-04 11:16:39'),
(6, 6, 'leads/files/ZHZo67kYfWvaWWMWwhzf0nmTSDWUQMfreYuVFMAi.wav', '2025-02-04 11:16:39', '2025-02-04 11:16:39'),
(7, 5, 'leads/files/OWxTQ8XdsvzvgwHg2LTn79jNfpJ6Vn4lF9x8KKjX.wav', '2025-02-04 13:06:11', '2025-02-04 13:06:11'),
(8, 5, 'leads/files/5VtVLSBJWDRLLCJZ1vkJco6Zg5GFZL2N5xoyXQwI.mp3', '2025-02-04 13:06:11', '2025-02-04 13:06:11'),
(9, 5, 'leads/files/E2J5SYEaXz3Pbsi4nICRl87Rd2oYzWNTeMRpDZQp.mp3', '2025-02-04 13:06:11', '2025-02-04 13:06:11'),
(10, 7, 'leads/files/TZ56FpOOGxDcJwBqSHw3H5MDaRco2veKhBANnTew.wav', '2025-02-04 14:18:19', '2025-02-04 14:18:19'),
(11, 7, 'leads/files/ko2ZJGJD5EWqZ3P51m06lwsS1vo6cGhnI6r3aVoa.wav', '2025-02-04 14:18:19', '2025-02-04 14:18:19'),
(12, 7, 'leads/files/KFPiYWyaw3ZAZfVZ3O4NGrVaWI9nOC3p7OVFda2U.wav', '2025-02-04 14:18:19', '2025-02-04 14:18:19'),
(13, 7, 'leads/files/UdtyPs429SV0DZfm3QGVkeZdCspAY9SilTLyHdDD.mp3', '2025-02-04 14:18:19', '2025-02-04 14:18:19'),
(14, 7, 'leads/files/Em6CIxsC24UQnKXxw9dvYbpsCFEnS2IYqeJJt71V.mp3', '2025-02-04 14:18:19', '2025-02-04 14:18:19'),
(15, 8, 'leads/files/Jw5FLBjZELLrU3ITpTgjyvpG5MXucCHPEmzoCnBS.wav', '2025-02-04 14:24:42', '2025-02-04 14:24:42'),
(16, 8, 'leads/files/BUxwbTTA5ruUUcOTBaNhsqRlh7T2kKi2A7rozR8J.wav', '2025-02-04 14:24:42', '2025-02-04 14:24:42'),
(17, 8, 'leads/files/KtA1gukmGBvXTjqH6g5rTC47U3annozBGzjMicK2.wav', '2025-02-04 14:24:42', '2025-02-04 14:24:42'),
(18, 9, 'leads/files/VPsksJ5L4uqgVXLMSyeAkTG7f2PNBJK4b4dtWCKW.wav', '2025-02-04 14:25:22', '2025-02-04 14:25:22'),
(19, 9, 'leads/files/tN2Qo8nL62q6LLhNfYo0v2ZJg5SxJ6Ig7IVCcFWG.wav', '2025-02-04 14:25:22', '2025-02-04 14:25:22'),
(20, 9, 'leads/files/uBadAHy9nEwkhkRCgD2Le5zeYpQor9pp8A7Gxb8V.wav', '2025-02-04 14:25:22', '2025-02-04 14:25:22'),
(21, 10, 'leads/files/RNVgb7Sy1bmYNnaEyvmjKIPHVPFF9LiiN06hfrM1.wav', '2025-02-04 15:10:33', '2025-02-04 15:10:33'),
(22, 10, 'leads/files/W8RadOjVuDC7bnzzdnhs0RvcZ2beYNDuZ0NHCYwZ.wav', '2025-02-04 15:10:33', '2025-02-04 15:10:33'),
(23, 10, 'leads/files/8QBdqizhKSdpjAfXOKPnitOPbevATvnrkFAABQYQ.wav', '2025-02-04 15:10:33', '2025-02-04 15:10:33'),
(24, 11, 'leads/files/NhRJ8NfBJfZOwOO5OdIUIFLvuZkTwYoQIWiaAIXO.wav', '2025-02-04 15:12:38', '2025-02-04 15:12:38'),
(25, 11, 'leads/files/0GpgmMojIhm08BPDW8HT2IrDPJrZMF1k4NNTJ4YP.wav', '2025-02-04 15:12:38', '2025-02-04 15:12:38'),
(26, 11, 'leads/files/LI1xnnNOJXxdo7wwLVcpQLHtreNwcJyWuwQD247c.wav', '2025-02-04 15:12:38', '2025-02-04 15:12:38'),
(27, 11, 'leads/files/WFwYQJ4ThjLcXQPyKZNFjvxSCSS41CO3qQzDRX9l.mp3', '2025-02-04 15:12:38', '2025-02-04 15:12:38'),
(28, 12, 'leads/files/2z9kRKW87OMG1Be46X38PcKqvbZRFqkMJ30nIJVC.wav', '2025-02-04 15:54:01', '2025-02-04 15:54:01');

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
(5, '2025_02_03_164419_create_leads_table', 2),
(6, '2025_02_03_164419_create_sales_table', 2),
(7, '2025_02_03_164420_create_sale_files_table', 2);

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
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `lead_id`, `status`, `comment`, `created_at`, `updated_at`) VALUES
(16, 15, 'Sale', 'hjghj', '2025-02-05 12:53:37', '2025-02-05 13:04:19'),
(18, 17, 'Sale', 'apply for sale', '2025-02-05 13:05:11', '2025-02-05 13:06:34'),
(19, 17, 'Pending', 'apply for sale 2', '2025-02-05 13:05:34', '2025-02-05 13:05:34'),
(20, 18, 'Pending', 'sdsdas asd', '2025-02-05 13:44:29', '2025-02-05 13:44:29'),
(21, 20, 'Sale', 'test', '2025-02-06 12:09:54', '2025-02-06 12:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `sale_files`
--

CREATE TABLE `sale_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_files`
--

INSERT INTO `sale_files` (`id`, `sale_id`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 7, 'Sale/files/soBaFmqk2oNU2cYkWTQQ4C6onFqKLYiPOcoQARjf.wav', '2025-02-04 13:41:23', '2025-02-04 13:41:23'),
(2, 7, 'Sale/files/Kk8EAhUUMWbvSMM1HjaJgaVSm0OexJaLahwt5SZS.wav', '2025-02-04 13:41:23', '2025-02-04 13:41:23'),
(3, 7, 'Sale/files/Pj9x9rkeLkkR7VpLspJ3dh1goPHBa7B7LAxDCUkP.mp3', '2025-02-04 13:41:23', '2025-02-04 13:41:23'),
(4, 8, 'Sale/files/MTkSYT4ArqCyrfCij8aTbkw3uR8o8ZGpdSINbCrq.wav', '2025-02-04 15:16:33', '2025-02-04 15:16:33'),
(5, 8, 'Sale/files/nYtTW9MAfPkPDfa8OIDG8mtoBFfXSYSvlpYsOlfT.webp', '2025-02-04 15:16:33', '2025-02-04 15:16:33'),
(7, 10, 'Sale/files/2D1yFINx40QIgQkmJ4fSg3x57Um1NUY8ywqW4EoE.wav', '2025-02-04 16:18:28', '2025-02-04 16:18:28'),
(8, 11, 'Sale/files/8y3jtS8pYA7lf9lHKwwy1jR0DAsOiGYmYzjVBn0A.mp3', '2025-02-04 16:18:41', '2025-02-04 16:18:41'),
(9, 12, 'Sale/files/5d6sffSv0GYh3V8diIgxagDoJIaQd4Zdfdwctzwr.webp', '2025-02-04 16:24:44', '2025-02-04 16:24:44'),
(10, 20, 'Sale/files/XMzjwuXp3uf9SK0tZUnCqhNwv9jJQUVN9MNfQg6b.wav', '2025-02-05 13:44:29', '2025-02-05 13:44:29'),
(11, 20, 'Sale/files/Gcue2eEmCdME2MISA6CqWOGhNUK6LYeXVe5xzmUa.wav', '2025-02-05 13:44:29', '2025-02-05 13:44:29'),
(12, 20, 'Sale/files/jXndWwB5d0nV8DWpmb5B61X8Lx31BheQYe6J9z5N.wav', '2025-02-05 13:44:29', '2025-02-05 13:44:29'),
(13, 21, 'Sale/files/qoLhK3Y4tZjeSCQ2DXBfL3keOvdoijvF5fqrxqRn.wav', '2025-02-06 12:09:54', '2025-02-06 12:09:54'),
(14, 21, 'Sale/files/Q8HlqjjJKFqtoZEF5mXgCSZjtOMr3webBNXQj9ZY.wav', '2025-02-06 12:09:54', '2025-02-06 12:09:54'),
(15, 21, 'Sale/files/VNkR2K03fpgj3Ue4JKNVkoSFAH3U6ogj3bWraOlL.wav', '2025-02-06 12:09:54', '2025-02-06 12:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hatim', 'admin', 'admin@admin.com', NULL, '$2a$12$tFnUX1KCPStqrzpT36F0teyIwKWJo3HKrUTyPUMNwrnLDYtEgbP1q', NULL, '2025-02-03 14:22:19', '2025-02-04 16:50:53'),
(2, 'hatimdsadasd', 'agent', 'lilian@wbsofttech.com', NULL, '$2y$12$9yxBNlMOr8OiCaidpowApelaIeI/1QFVo3/qT3/VfiIGsEmZMmJ6.', NULL, '2025-02-03 14:40:35', '2025-02-03 14:40:35'),
(3, 'hatim', 'agent', 'discord56@wbsofttech.com', NULL, '$2y$12$Xxts0.7mAmImOFfeP.DVZeKGrES3xclgJPFPQlgEiR8Iae66rVZSi', NULL, '2025-02-03 15:55:49', '2025-02-04 15:47:48'),
(4, 'hamza', 'agent', 'hamza@gmail.com', NULL, '$2y$12$lkvpyebx2xXi.FHtbGppL.7L1tCTgZdwAgMbLFmkoM5OzYsJ4TKDm', NULL, '2025-02-04 15:05:04', '2025-02-04 15:05:04'),
(5, 'Aquila Witt', 'agent', 'xydejurix@mailinator.com', NULL, '$2y$12$lZxhPbIcQ9gRA7.gJ.E5uulSaHZwn6N0W.KUGkmtdFXPh.tw43yU2', NULL, '2025-02-04 15:08:10', '2025-02-04 15:08:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leads_user_id_foreign` (`user_id`);

--
-- Indexes for table `lead_files`
--
ALTER TABLE `lead_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_lead_id_foreign` (`lead_id`);

--
-- Indexes for table `sale_files`
--
ALTER TABLE `sale_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_files_sale_id_foreign` (`sale_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `lead_files`
--
ALTER TABLE `lead_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sale_files`
--
ALTER TABLE `sale_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_lead_id_foreign` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_files`
--
ALTER TABLE `sale_files`
  ADD CONSTRAINT `sale_files_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
