-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2024 at 10:37 AM
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
-- Database: `iccadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `position_by`, `created_at`, `updated_at`) VALUES
(1, 'Category1', 1, 1, '2024-08-17 09:58:03', '2024-08-17 09:58:03'),
(3, 'Category2', 1, 2, '2024-08-20 15:35:54', '2024-08-20 15:35:54'),
(4, 'Category3', 1, 3, '2024-08-26 17:20:15', '2024-08-26 17:20:15');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `startdate` varchar(255) DEFAULT NULL,
  `enddate` varchar(255) DEFAULT NULL,
  `documentstatus` varchar(255) DEFAULT NULL,
  `documentcount` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `category_id`, `document`, `startdate`, `enddate`, `documentstatus`, `documentcount`, `description`, `status`, `position_by`, `created_at`, `updated_at`) VALUES
(1, 'test', '1', 'document/kNOSaftfYiZqtZbEt49ai2evcSLiqZDxqojPuJJT.jpg', '29/08/2024', '16/08/2024', NULL, NULL, '<p>test description</p>', 1, 1, '2024-08-20 14:24:13', '2024-08-26 19:12:20'),
(2, 'Test2', '3', 'document/JkrsrHxxijuv9FOXJd49MLAnAzvtFNkUbNG72Z1K.pdf', '21/08/2024', '21/08/2024', NULL, NULL, NULL, 1, 2, '2024-08-20 16:09:09', '2024-08-28 11:43:54'),
(3, 'test document', '3', 'document/KBr9EQ9AdiAPzzcHK9UOkgjANdMTwR5bZh5raqdN.jpg', '22/08/2024', '31/08/2024', NULL, NULL, NULL, 1, 3, '2024-08-26 18:36:14', '2024-08-28 11:56:32'),
(5, 'demo', '4', 'document/JTVbPA4bsx0jcLDCIOJgVwY7aN8Dys4oezQUZL8b.xls', NULL, NULL, NULL, NULL, NULL, 1, 4, '2024-08-26 19:25:59', '2024-08-28 16:35:10'),
(6, 'Sample word file for promo', '4', 'document/2pmkVsG5ynZiyNJLJUFQ2UN8TCLom4bK0bppllWw.docx', '02/08/2024', '23/08/2024', NULL, NULL, '<p>Demo</p>', 1, 5, '2024-08-28 11:54:53', '2024-08-29 03:34:19');

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
(5, '2024_06_27_103239_add_columns_to_users', 1),
(6, '2024_08_14_162505_create_categories_table', 2),
(8, '2024_08_18_171602_create_roles_table', 3),
(10, '2024_08_19_120709_add_columns_to_users_table', 4),
(13, '2024_08_20_114747_create_documents_table', 5),
(14, '2024_08_20_224757_create_table_password_resets', 6),
(16, '2024_08_25_115037_create_news_details_table', 7),
(18, '2024_08_25_111302_create_news_categories_table', 8),
(19, '2024_08_29_110000_modify_description_in_newsdetails_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `newscategories`
--

CREATE TABLE `newscategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newscategories`
--

INSERT INTO `newscategories` (`id`, `name`, `status`, `position_by`, `created_at`, `updated_at`) VALUES
(1, 'First News Category', 1, 1, '2024-08-25 16:46:31', '2024-08-26 11:16:12'),
(2, 'Category2', 1, 2, '2024-08-25 16:47:18', '2024-08-25 16:47:18'),
(3, 'News Category3', 1, 3, '2024-08-25 16:47:39', '2024-08-25 16:47:39'),
(4, 'News Category4', 1, 4, '2024-08-25 16:47:51', '2024-08-25 16:47:51'),
(5, 'News Category5', 1, 5, '2024-08-25 16:48:10', '2024-08-25 16:48:10'),
(6, 'Namrata Rai', 1, 6, '2024-08-26 06:24:09', '2024-08-26 06:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `newsdetails`
--

CREATE TABLE `newsdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `newscategory_id` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `startdate` varchar(255) DEFAULT NULL,
  `enddate` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsdetails`
--

INSERT INTO `newsdetails` (`id`, `title`, `newscategory_id`, `image`, `link`, `startdate`, `enddate`, `description`, `status`, `position_by`, `created_at`, `updated_at`) VALUES
(1, 'All photographs are accurate', '4', 'newsdetails/bmjzxXyTqejGf5RcAq40ZSb8h84N1vLeHcsaeWHn.png', 'https://www.youtube.com/embed/rCoPr8UwRMc?si=Z5SDfLPMGEqirRvq', NULL, NULL, '<h3>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using LoreIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normalIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normalIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normalm Ipsum is that it has a more-or-less normal</h3>', 1, 1, '2024-08-26 11:07:08', '2024-08-29 08:13:54'),
(2, 'Apple Introduces Search Ads Basic', '2', 'newsdetails/EdV07SmloJam8hPn0UsYR8chxWhv8s5zgRRAw8YV.jpg', NULL, '13/08/2024', '30/08/2024', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normalIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>', 1, 2, '2024-08-26 11:18:55', '2024-08-29 08:04:44'),
(3, 'Yotube Demo Iframe Testing', '6', 'newsdetails/qdRhw5nMV6DbwfAnQYYS6p1aze1aXTq9pqn11IL6.png', 'https://www.youtube.com/embed/H84UJn1CiWo', NULL, NULL, '<p>Song : Waalian Singer : Harnoor Co Artist : Katierose Bae Lyrics/Composer : Gifty Music : The Kidd Mix &amp; Master : Dense Dop : Cole Spiritz Editing : Jagjeet Singh Dhanoa Video : Rubbal GTR Producer : Navjot Pandher Project By : Charnjeet Singh Instagram Reels Promotion : Boss Music Productions (Nav Sidhu) Promotions : Black Digital Special Thanks : Arvinder Gurm Label : Jatt Life Studiosng : Waalian Singer : Harnoor Co Artist : Katierose Bae Lyrics/Composer : Gifty Music : The Kidd Mix &amp; Master : Dense Dop : Cole Spiritz Editing : Jagjeet Singh Dhanoa Video : Rubbal GTR Producer : Navjot Pandher Project By : Charnjeet Singh Instagram Reels Promotion : Boss Music Productions (Nav Sidhu) Promotions : Black Digital Special Thanks : Arvinder Gurm Label : Jatt Life Studios</p>', 1, 3, '2024-08-29 05:31:47', '2024-08-29 08:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('namratarai191@gmail.com', 'CUm0HqqyEyb3fzDWLbFS1xp0maJPH6smwJBbMZxQPuw6yOQvoN0weevZfuF7Q4Gh', '2024-08-20 18:51:18'),
('namratarai191@gmail.com', 'ZEfFu9ujOYaeVmR0TUHRAJtz4FzZAgDiNGLUblRCGGHK9CMY5PwylYoOKLJUcCmE', '2024-08-20 18:51:39'),
('namratarai191@gmail.com', 'jvAHvP2AkVv2eGmdu0hctvtc7JBmtPLETyWBkZfWXm3OdQWaxbC5hvuKJsvaSTpy', '2024-08-20 18:53:00'),
('namratarai191@gmail.com', 'MDVuQfNWBqkivji8sA8jUy1BcWwna0KnXGKlIL3dQcIosdbEBEgg3dqO4q0guI4p', '2024-08-20 18:53:50');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `status`, `position_by`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 1, '2024-08-19 17:27:54', '2024-08-19 17:27:54'),
(2, 'Editor', 1, 2, '2024-08-19 17:28:04', '2024-08-19 17:28:04'),
(3, 'Viewer', 1, 3, '2024-08-19 18:21:35', '2024-08-19 18:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position_by` int(11) NOT NULL,
  `original_password` varchar(255) DEFAULT NULL,
  `subscriptionstartdate` varchar(255) DEFAULT NULL,
  `subscriptionenddate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `address`, `mobile`, `icon`, `status`, `position_by`, `original_password`, `subscriptionstartdate`, `subscriptionenddate`) VALUES
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$Uc1BeIazbDeIunQ2SyoM2ePg0MCH1U/569OrYYnWZf0V0H3vY2Gpm', NULL, '2024-08-17 10:12:50', '2024-08-19 10:02:13', 1, 'Lucknow', '2333333333', 'admin/XvDJOJenjGJEecp9OwotWzOIZb4eR09bm2Trj96Z.jpg', 1, 1, NULL, NULL, NULL),
(4, 'Editor', 'namratarai191@gmail.com', NULL, '$2y$10$B8dR7TsrBn/t3qn56dHigeyuthlGaZ4jQEaZcoE58kNRP8/TbAVdW', NULL, '2024-08-19 17:23:12', '2024-08-20 18:50:38', 2, 'Lucknow', '3423444444', NULL, 1, 2, '12345', '14/08/2024', '29/08/2024'),
(5, 'Namrata Rai', 'namratabfcsofttech@gmail.com', NULL, '$2y$10$GqcknDbhgw2t4HBOX953SeG97ZbfTpfJoHDDQPwFwQT3IRW81Gvkq', NULL, '2024-08-22 04:41:35', '2024-08-22 04:41:35', 3, 'LKO', '8934047221', NULL, 1, 3, '12345', '07/08/2024', '29/08/2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
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
-- Indexes for table `newscategories`
--
ALTER TABLE `newscategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsdetails`
--
ALTER TABLE `newsdetails`
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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_name_unique` (`role_name`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `newscategories`
--
ALTER TABLE `newscategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `newsdetails`
--
ALTER TABLE `newsdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
