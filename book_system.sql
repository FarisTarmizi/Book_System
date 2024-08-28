-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 01:17 PM
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
-- Database: `book_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `i_num` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `c_img` varchar(255) DEFAULT NULL,
  `available` varchar(255) DEFAULT NULL,
  `id_borrower` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `created_at`, `updated_at`, `i_num`, `author`, `description`, `price`, `c_img`, `available`, `id_borrower`) VALUES
(6, 'C# Programming', '2024-02-14 19:17:23', '2024-03-18 17:30:44', '111bcp', 'Tyan Turner', 'Now, with C#: 2 books in 1 - The Ultimate Beginner\'s & Intermediate Guide to Learn C# Programming Step by Step, even a complete beginner can start to understand and develop programs and increase his knowledge with it through chapters on.With the information contained in this book you could be on your way to learning how this guide can develop and expand on your programming knowledge and lead you to exciting new discoveries in this fascinating subject. This book will help you take the next step up from the basics of C# quickly and seamlessly.', '198.03', '2024-02-15c.jpg', NULL, NULL),
(7, 'Business Management for the IB Diploma Coursebook 2nd Edition', '2024-02-14 19:19:45', '2024-02-19 22:58:07', '112bbm', 'Peter Stimpson, Alex Smith', 'A comprehensive second edition of Business Management for the IB Diploma, revised for first teaching in 2014. Designed for class use and independent study, this Coursebook is tailored to the thematic requirements and assessment objectives of the IB syllabus. It includes learning objectives and summaries; integrated Theory of Knowledge material; text in clear sections, following the IB syllabus structure and content specifications; clear, accessible English for students whose first language is not English; exam-style practice questions and a chapter on assessment and exam techniques. Written by two practising Business and Management teachers, Peter Stimpson and Alex Smith, it features the following topics: Business organisation and environment; Human resource management; Finance and accounts; Marketing; Operations management.', '307.16', '2024-02-15bm.jpg', NULL, NULL),
(8, 'Cambridge IGCSE™ Accounting Student\'s Book (Collins Cambridge IGCSE™)', '2024-02-14 22:09:18', '2024-05-11 21:38:52', '113bap', 'David Horner, Leanna Oliver', 'Collins Cambridge IGCSE ® Accounting Student Book provides comprehensive coverage of the Cambridge IGCSE Accounting (0452) syllabus, with in-depth content presented in a clear and easily accessible format. Written by experienced teachers, it offers a wide range of carefully developed features to help students to develop and apply their knowledge.', '79.49', '2024-02-15acct.jpg', 'NO', '18DDT12F1040'),
(9, 'Mechanical Engineering Education Handbook', '2024-02-14 22:17:44', '2024-05-11 21:38:52', '114bme', 'Charles E. Baukal', 'This book is believed to be the first to specifically address mechanical engineering education. It is divided into three sections: pedagogy, curriculum, and future. The pedagogy section contains seven chapters on various aspects of enhancing student learning. Chapter one concerns research regarding mechanical engineering (ME) students’ learning preferences.', '1100.43', '2024-02-15me.jpg', 'NO', '18DDT12F1040'),
(10, 'Python for Data Science: The Ultimate Beginners\' Guide', '2024-02-17 23:45:07', '2024-02-24 18:42:54', '115bpl', 'Ethan Williams', 'This book is a comprehensive guide for beginners to learn Python Programming, especially its application for Data Science. While the lessons in this book are targeted at the absolute beginner to programming, people at various levels of proficiency in Python, or any other programming languages can also learn some basics and concepts of data science. A few Python libraries are introduced, including NumPy, Pandas, Matplotlib, and Seaborn for data analysis and visualisation. To make the lessons more intuitive and relatable, practical examples and applications of each lesson are given. The reader is equally encouraged to practise the techniques via exercises, within and at the end of the relevant chapters. To help the reader get a full learning experience, there are references to relevant reading and practice materials, and the reader is encouraged to click these links and explore the possibilities they offer. It is expected that with consistency in learning and practicing the reader can master Python and the basics of its application in data science. The only limitation to the reader\'s progress, however, is themselves.', '95.55', '2024-02-18py.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(5, '2024_02_04_015105_create_students_table', 2),
(6, 'create_students_table', 3),
(7, '2024_02_04_021610_add_column_gender_to_students_table', 4),
(8, '2024_02_07_012547_add_columns_to_students_table', 5),
(9, '2024_02_07_014415_drop_user_table', 6),
(10, '2024_02_07_014652_create_books_table', 7),
(11, '2024_02_07_040030_add_column_to_student_table', 8),
(12, '2024_02_12_011613_create_user_table', 9),
(13, '2024_02_12_023727_rename_user_table', 10),
(14, '2024_02_12_072244_add_defult_value_password_to_user_table', 11),
(15, '2024_02_14_015549_add_column_to_user_table', 12),
(16, '2024_02_14_022646_add_column_to_students_table', 13),
(17, '2024_02_15_000118_add_column_to_books_table', 14),
(18, '2024_02_15_001207_add_column_to_books_table', 15),
(19, '2024_02_15_001707_add_column_to_books_table', 16),
(20, '2024_02_15_003745_add_column_to_books_table', 17),
(21, '2024_02_15_014635_add_column_to_books_table', 18),
(22, '2024_02_15_022837_add_column_to_books_table', 19),
(23, '2024_02_15_031345_add_column_to_books_table', 19),
(24, '2024_02_18_023132_add_column_to_books_table', 20),
(25, '2024_02_18_024607_add_column_to_students_table', 21),
(26, '2024_02_18_071824_add_column_to_books_table', 22),
(27, '2024_02_18_081946_add_column_to_students_table', 23),
(28, '2024_02_20_064517_add_column_to_books_table', 24),
(29, '2024_02_20_065151_change_column_to_books_table', 25),
(30, '2024_02_20_065854_change_column_to_books_table', 26),
(31, '2024_02_25_015536_change_column_to_students_table', 27),
(32, '2024_03_04_011759_create_permission_tables', 28),
(33, '2024_03_11_001127_add_column_to_users_table', 29),
(34, '2024_03_13_015441_add_column_to_students_table', 30),
(35, '0001_01_01_000001_create_cache_table', 31),
(36, '2024_05_02_000839_create_sessions_table', 32);

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
(1, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'alter borrower details', 'web', '2024-03-03 20:12:24', '2024-03-03 20:12:24'),
(2, 'book a book', 'web', '2024-03-03 20:12:24', '2024-03-03 20:12:24');

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
(1, 'admin', 'web', '2024-03-03 19:47:54', '2024-03-03 19:47:54'),
(2, 'borrower', 'web', '2024-03-03 19:47:54', '2024-03-03 19:47:54');

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
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cJNPigLR6EOk06wPS3Im5Qa2VBeuMR43q6Nkxk89', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWUxa1ZnRnpTT21La1VIU0NpVWUzaldiYnlMVHFUYzJIVGhjMXNoYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbl9ib3Jyb3dlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1724657585),
('duQ6UpWX0jgdBqdjtybqGTPhxazi5hOht24Spa75', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSFBteFpKNXNmQzZwaG9MRWxscXp6TlhnVm1XRG5qVVRLT3pJYkNxSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO30=', 1724657208),
('GsFseQLUO2cWXILAwFqOk18dFBI3zdcuDKH4XCs7', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaGZ5RjVEdnhlVWU2eU1RdjdPNEtjM0tjSnU1aVdIRkNsT2JnYjJGYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo1O30=', 1724664335),
('k1E6MFz0zZ11giIuVs3jQrshnptgIu4Ad9WT4MUh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmRlRWRKT2p5M2xQSW9FWnRHTG1tdWE3Y2ZURG5ZT3NHY0gwQnhCMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbl9ib3Jyb3dlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1724657840),
('Vso5mMblFimW38ptgz70zaCaAD5TOkV630pR9iq9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmdUeUoyaWV0RFdZaUE2Z0Y2aUZSeEIzOTFMQUZyb2hGTEZnNzdlUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbl9ib3Jyb3dlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1724657695),
('w5fs7thoAI2vMBPt9FSYHWc7sAFcYAl1lVQA3vIS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienFlYWJFODhwN3JBeXJDUXBPYXFaUkJLTUU0aUxBVzdPbHNiRDlHWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbl9ib3Jyb3dlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1724657904);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `num_day` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `ic` varchar(255) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `i_num` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `date_borrow` date DEFAULT NULL,
  `status` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `num_day`, `department`, `ic`, `user_email`, `img`, `i_num`, `created_at`, `updated_at`, `deadline`, `date_borrow`, `status`) VALUES
(13, 'wan irfan', '3', 'IT', '18DDT12F1040', 'wan11@gmail.com', '2024-02-182dbc919c2f3e8d5162b47b47fc2ca4fa-thumb.jpg', '114bme,113bap', '2024-02-17 19:06:13', '2024-05-11 21:38:52', '2024-05-16', '2024-05-12', 'B'),
(18, 'faiz', NULL, 'IT', '18DDT12F1049', 'fareast8270@gmail.com', '2024-02-19home.jpg', NULL, '2024-02-18 17:13:23', '2024-03-18 17:30:44', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(5, 'FARIS TARMIZI', 'faristarmizi66@gmail.com', '$2y$12$pOE45U8JsXUCXVuaDMqoKuFtNEipKlnBahmQpmVN.2fhYxkhu61KO', NULL, '2024-02-11 23:45:19', '2024-08-25 23:40:46', 1),
(6, 'iffah farhanah', 'iffh22@gmail.com', '$2y$12$L9EEJNSHQcfWAUvOKVuNV.6q4wYjm9oTTszsTvCV7Frv6O.qVyuqq', NULL, '2024-02-13 17:45:12', '2024-02-13 17:45:12', 1),
(10, 'wan irfan', 'wan11@gmail.com', '$2y$12$Io3iU4k2Cg491vGSiyTjFuTvwZW2L0xQxADb0yZBgz/5yfd6Tcp4O', NULL, '2024-03-16 20:45:10', '2024-03-17 23:08:48', 0),
(11, 'faiz', 'fareast8270@gmail.com', '$2y$12$5J.1bBfxPThhkSwxHWVuDekYabRr5DxNuULqbBvCf3QiKKt68uIie', NULL, '2024-03-16 23:21:07', '2024-05-11 06:28:14', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_i_num_unique` (`i_num`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_email_user_email` (`user_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_email_user_email` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
