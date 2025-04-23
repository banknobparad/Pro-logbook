-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 05:24 PM
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
-- Database: `pro_logbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `confirms`
--

CREATE TABLE `confirms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` tinyint(4) DEFAULT NULL,
  `location_id` tinyint(4) DEFAULT NULL,
  `req` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `confirms`
--

INSERT INTO `confirms` (`id`, `user_id`, `location_id`, `req`, `created_at`, `updated_at`) VALUES
(17, 3, 1, 0, '2025-04-17 23:42:24', '2025-04-18 00:28:29');

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
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `student_id1` varchar(10) DEFAULT NULL,
  `student_id2` varchar(10) DEFAULT NULL,
  `student_id3` varchar(10) DEFAULT NULL,
  `student_id4` varchar(10) DEFAULT NULL,
  `mentor_id1` tinyint(4) DEFAULT NULL,
  `mentor_id2` tinyint(4) DEFAULT NULL,
  `mentor_id3` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `student_id1`, `student_id2`, `student_id3`, `student_id4`, `mentor_id1`, `mentor_id2`, `mentor_id3`, `created_at`, `updated_at`) VALUES
(1, 'KFC', '6314631017', '6314631003', '6314631004', NULL, 3, NULL, NULL, '2025-04-02 14:18:05', '2025-04-18 00:28:29'),
(2, 'Makro', '6314631027', '6314631009', '6314631025', NULL, NULL, NULL, NULL, '2025-04-03 12:15:54', '2025-04-18 00:27:39'),
(3, 'Teenoi', '6314631012', '6314631011', '6314631005', NULL, NULL, NULL, NULL, '2025-04-03 12:19:36', '2025-04-03 12:19:36'),
(4, 'TITAN', '7485966325', '5458521014', '5458521015', NULL, NULL, NULL, NULL, '2025-04-06 11:26:02', '2025-04-17 12:53:48'),
(5, 'Shabu', '6314631026', '6314631027', '6314631009', NULL, NULL, NULL, NULL, '2025-04-19 11:33:28', '2025-04-19 11:33:28'),
(6, 'Big-c', '6314631525', '5748596585', NULL, NULL, NULL, NULL, NULL, '2025-04-19 11:37:40', '2025-04-19 11:37:40');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2025_04_02_201919_create_locations_table', 3),
(10, '2014_10_12_000000_create_users_table', 5),
(11, '2025_04_03_210633_create_confirms_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `branch` enum('วิทยาการคอมพิวเตอร์','เทคโนโลยีสารสนเทศ','เทคโนโลยีเครือข่าย','ภูมิสารสนเทศ') DEFAULT NULL,
  `year` enum('1','2','3','4','5') DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Administrator','Teacher','Student','Mentor') NOT NULL DEFAULT 'Student',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `student_id`, `branch`, `year`, `phone_number`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL, NULL, NULL, 'admin@gmail.com', '2025-04-17 10:11:23', '$2y$10$CtmhRihSgUY8jpgwrWtPVuzVKJSnGWDG5jMMTEgua3mTi.AaJfJbO', 'Administrator', NULL, '2025-04-17 10:11:23', '2025-04-17 10:11:23'),
(2, 'อาจารย์สุวาณี คำศรี', NULL, NULL, NULL, NULL, 'teacher@gmail.com', '2025-04-17 10:11:23', '$2y$10$gu1XoIO5mlAeeFiyrqwWNe2dmhLA/2aXgUs8YDWoS.VzO47Khg7ee', 'Teacher', NULL, '2025-04-17 10:11:23', '2025-04-17 23:20:22'),
(3, 'นายซีเมเจอร์ บลูโซล', NULL, NULL, NULL, NULL, 'mentor1@gmail.com', '2025-04-17 10:11:23', '$2y$10$jeX9eWO7i1fgVKkwW3YlWOJy25WN10Z6CllCzqrlTYsAb3r7hWixq', 'Mentor', NULL, '2025-04-17 10:11:23', '2025-04-17 10:11:23'),
(4, 'นายผ้าพันคอ ดวงดาว', NULL, NULL, NULL, NULL, 'mentor2@gmail.com', '2025-04-17 10:11:23', '$2y$10$pvBRjKw1pyCEgpjbDC.4iu7/9Sjp.gq/bCgvRg1t1FVWlNzdC8Aq6', 'Mentor', NULL, '2025-04-17 10:11:23', '2025-04-17 10:11:23'),
(5, 'นางสาวแทนรัก ประนา', '6314631017', 'วิทยาการคอมพิวเตอร์', '4', '0815783083', 'student@gmail.com', '2025-04-17 10:11:23', '$2y$10$ABAO0birlmHDjP2RhDgOqe/CmllWMkKDdVsKNER7xTR2Kx1iyanl2', 'Student', NULL, '2025-04-17 10:11:23', '2025-04-17 10:11:23'),
(6, 'นายนพรัตน์ ธนสารศิริกุล', '6314631004', 'เทคโนโลยีสารสนเทศ', '2', '0125859658', 'student2@gmail.com', '2025-04-18 00:15:35', '$2y$10$rXkxYxgpEFFwSMQ2i1bFf.ktYPkSW0m10n5pFA4Ra0zBuwwTYENYi', 'Student', '', '2025-04-18 00:15:35', '2025-04-18 00:15:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `confirms`
--
ALTER TABLE `confirms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_student_id1_unique` (`student_id1`),
  ADD UNIQUE KEY `locations_student_id2_unique` (`student_id2`),
  ADD UNIQUE KEY `locations_student_id3_unique` (`student_id3`),
  ADD UNIQUE KEY `locations_student_id4_unique` (`student_id4`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_student_id_unique` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `confirms`
--
ALTER TABLE `confirms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
