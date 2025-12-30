-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 09:12 AM
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
-- Database: `cipta_karir`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`, `updated_at`, `email`) VALUES
(1, 'NajwaAlya18', '$2y$12$0.nuKfqJz8ARTgq.TqUTSuGqYC0kfb5QDsB5XvQBAStZYSYWaLehq', '2025-10-07 20:38:13', '2025-11-18 18:58:34', 'njwa204@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `usia` int(11) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `status_pernikahan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tahun_lulus` int(11) NOT NULL,
  `pengalaman_kerja` text DEFAULT NULL,
  `skill_teknis` text DEFAULT NULL,
  `skill_non_teknis` text DEFAULT NULL,
  `status_vaksinasi` varchar(255) DEFAULT NULL,
  `perusahaan_tujuan` varchar(255) DEFAULT NULL,
  `status` enum('Waiting List','Medical Check Up','Pelatihan','Interview','Diterima','Ditolak') DEFAULT 'Waiting List',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `terkirim` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `nama_lengkap`, `tanggal_lahir`, `usia`, `jenis_kelamin`, `status_pernikahan`, `alamat`, `no_telp`, `email`, `pendidikan_terakhir`, `jurusan`, `tahun_lulus`, `pengalaman_kerja`, `skill_teknis`, `skill_non_teknis`, `status_vaksinasi`, `perusahaan_tujuan`, `status`, `created_at`, `updated_at`, `deleted_at`, `terkirim`) VALUES
(20, 'Gabriela Cashey', '2003-06-19', 22, 'P', 'Belum Menikah', 'Tupparev, Karawang Barat', '085625153288', 'gabrielaCashey@gmail.com', 'SMA', 'IPA', 2022, 'Operator Produksi', 'Operasikan Mesin Produksi, Pemeriksaan Kualitas Dasar', 'Teliti, Komunikasi Baik, Disiplin', 'Lengkap', 'PT Paragon Technology and Innovation', 'Diterima', '2025-11-18 01:16:49', '2025-11-27 01:48:44', NULL, 1),
(24, 'Gita Rizky', '2004-12-15', 21, 'P', 'Belum Menikah', 'Cikampek', '081519515325', 'gitaRizky@mail.com', 'SMA', 'Farmasi', 2023, 'Marketing', 'Pengujian Sampel Kosmetik, Pencatatan Hasil Uji, Penerapan GMP & SOP', 'Komunikasi, Leadership', 'Lengkap', 'PT Paragon', 'Medical Check Up', '2025-11-18 18:55:16', '2025-11-27 01:50:28', NULL, 0),
(28, 'Jeano Dirgantara', '2004-06-17', 23, 'P', 'Belum Menikah', 'Nagasari, Karawang Barat', '089876543210', 'jeano@gmail.com', 'SMK, SMA,MA', 'Teknik Kimia', 2020, 'Leader Tim', 'Operasikan Mesin Packing, Cek Kualitas Kemasan, Ikuti Standar Kebersihan', 'Komunikasi, Kerja tim, Rapi', 'Lengkap', 'PT Toyota Astra Motor', 'Waiting List', '2025-11-27 01:37:33', '2025-11-27 01:51:46', NULL, 0),
(29, 'Renjana Putra', '2004-06-17', 23, 'L', 'Belum Menikah', 'Johar, Karawang Timur', '081234567899', 'renjana@gmail.com', 'SMK, SMA,MA', 'Teknik Kimia', 2020, 'Leader Tim', 'Operasikan Mesin Packing, Cek Kualitas Kemasan, Ikuti Standar Kebersihan', 'Cepat, Leadership', 'Belum Lengkap', 'PT Astra Honda Motor', 'Waiting List', '2025-11-27 01:53:02', '2025-11-27 01:53:02', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `applicant_files`
--

CREATE TABLE `applicant_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `link_dokumen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicant_files`
--

INSERT INTO `applicant_files` (`id`, `applicant_id`, `link_dokumen`, `created_at`, `updated_at`) VALUES
(16, 20, 'https://drive.google.com/file/d/1m6nzLIBcPF6eZYA-OvqqSTe5wxoVIphw/view?usp=drive_link', '2025-11-18 01:16:50', '2025-11-18 01:16:50'),
(19, 24, 'https://drive.google.com/file/d/1m6nzLIBcPF6eZYA-OvqqSTe5wxoVIphw/view?usp=drive_link', '2025-11-18 18:55:16', '2025-11-18 18:55:16'),
(22, 28, 'https://drive.google.com/file/d/1m6nzLIBcPF6eZYA-OvqqSTe5wxoVIphw/view?usp=drive_link', '2025-11-27 01:37:33', '2025-11-27 01:37:33'),
(23, 29, 'https://drive.google.com/file/d/1m6nzLIBcPF6eZYA-OvqqSTe5wxoVIphw/view?usp=drive_link', '2025-11-27 01:53:02', '2025-11-27 01:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_recommendations`
--

CREATE TABLE `applicant_recommendations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `vacancy_id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `score` float DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant_recommendations`
--

INSERT INTO `applicant_recommendations` (`id`, `applicant_id`, `vacancy_id`, `company_id`, `score`, `created_at`, `updated_at`) VALUES
(30, 20, 28, 15, 6, '2025-11-27 01:48:44', '2025-11-27 01:48:44'),
(31, 20, 29, 14, 6, '2025-11-27 01:48:44', '2025-11-27 01:48:44'),
(32, 24, 25, 12, 7, '2025-11-27 01:50:28', '2025-11-27 01:50:28'),
(33, 28, 23, 12, 8, '2025-11-27 01:51:46', '2025-11-27 01:51:46'),
(34, 29, 23, 12, 6, '2025-11-27 01:53:02', '2025-11-27 01:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `applicant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `bidang_usaha` varchar(255) NOT NULL,
  `status_lowongan` varchar(50) DEFAULT 'Buka',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `nama_perusahaan`, `alamat`, `kontak`, `bidang_usaha`, `status_lowongan`, `created_at`, `updated_at`) VALUES
(12, 'PT Paragon Technology And Innovation', 'Jl. Raya Setu - Serang, Telajung, Kec. Cikarang Bar., Kabupaten Bekasi, Jawa Barat 17530', 'info@paragon-innovation.com', 'Manufaktur dan Distribusi Produk Kosmetik & Perawatan Diri', 'Buka', '2025-11-17 19:49:55', '2025-11-17 19:49:55'),
(13, 'PT Astra Nippon Gasket Indonesia', 'Jl. Maligi III.Lot N, RW.1, Margakaya, Telukjambe Barat, Karawang, West Java 41361', '(021) 8904404', 'Produksi Gasket, Produksi Material Baku Gasket Lunak, dan Produksi Brake Disk', 'Buka', '2025-11-17 19:56:48', '2025-11-17 19:56:48'),
(14, 'PT Yushiro Indonesia', 'Jl. Maligi No. 1 Lot B-2B Kawasan Industri KIIC Karawang Barat, Sukaluyu, Telukjambe Timur, Karawang, Jawa Barat 41361', '(021) 89114271', 'Produksi Bahan Kimia', 'Tutup', '2025-11-17 19:59:47', '2025-11-27 01:45:57'),
(15, 'PT Paragon Plastik indonesia', 'Jl. Kenari 2 Blok G1 No.B1-2\r\nDelta Silikon V, Lippo Cikarang\r\nCikarang Pusat, Bekasi 17530', 'paragon@gmail.com', 'Vendor Plastiik', 'Buka', '2025-11-18 18:51:18', '2025-11-26 20:25:47'),
(18, 'PT Inkoasku - Pako Group', 'H9M2+68X, Kutanegara, Ciampel, Karawang, West Java 41363', 'pako@gmail.com', 'Car Manufactur', 'Buka', '2025-11-27 09:05:18', '2025-11-27 09:05:18'),
(19, 'PT JTEKT TOYODA Indonesia', 'Jl. Surya Madya Kav. I No.27B, Kutanegara, Kec. Ciampel, Karawang, Jawa Barat 41363', '(0267) 8610270', 'Auto Parts Manufacturer', 'Buka', '2025-12-09 18:33:01', '2025-12-09 18:33:01');

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
(21, '0001_01_01_000001_create_cache_table', 1),
(22, '2025_09_25_073024_create_admins_table', 1),
(23, '2025_09_25_073211_create_companies_table', 1),
(24, '2025_09_25_073254_create_applicants_table', 1),
(25, '2025_09_25_073340_create_archives_table', 1),
(26, '2025_09_25_073418_create_qualifications_table', 1),
(27, '2025_09_25_073458_create_vacancies_table', 1),
(28, '2025_09_25_073532_create_applicant_files_table', 1),
(29, '2025_09_25_073613_create_placements_table', 1),
(30, '2025_10_08_022634_create_password_reset_tokens_table', 1),
(32, '2025_10_08_033551_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vacancy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `applicant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_vaksinasi` varchar(100) DEFAULT NULL,
  `status_pernikahan` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `usia_minimum` int(11) DEFAULT NULL,
  `usia_maksimum` int(11) DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tahun_lulus` int(11) NOT NULL,
  `pengalaman_kerja` text DEFAULT NULL,
  `skill_teknis` text DEFAULT NULL,
  `skill_non_teknis` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `vacancy_id`, `applicant_id`, `status_vaksinasi`, `status_pernikahan`, `jenis_kelamin`, `usia_minimum`, `usia_maksimum`, `pendidikan_terakhir`, `jurusan`, `tahun_lulus`, `pengalaman_kerja`, `skill_teknis`, `skill_non_teknis`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Belum Vaksin', 'Sudah menikah', 'Perempuan', 20, 30, 'SMK', 'Perkantoran', 2021, 'sdsdfsdfsfd', 'sdvdfsdfdf', 'sfddgdsfsfd', '2025-11-03 22:11:35', '2025-11-03 22:11:35'),
(2, NULL, NULL, 'Lengkap', 'Sudah menikah', 'Laki-laki', 20, 30, 'SMK', 'Perkantoran', 2021, 'sdsdfsdfsfd', 'sdvdfsdfdf', 'sfddgdsfsfd', '2025-11-04 00:59:35', '2025-11-04 00:59:35'),
(8, 23, NULL, 'Lengkap', 'Belum menikah', 'Perempuan', 18, 28, 'SMA, SMK, MA', 'Kimia, Farmasi', 2015, 'Packaging, Produksi Kosmetik', 'Operasikan Mesin Packing, Cek Kualitas Kemasan, Ikuti Standar Kebersihan', 'Rapi, Cepat & Efisien, Kerja Sama Tim', '2025-11-17 20:55:47', '2025-11-17 21:35:23'),
(10, 25, NULL, 'Belum Lengkap', 'Belum menikah', 'Perempuan', 18, 26, 'SMA, SMK, MA', 'Kimia Industri, Analis Kimia, Farmasi', 2017, 'Quality Control, Quality Assurance Laboratorium', 'Pengujian Sampel Kosmetik, Pencatatan Hasil Uji, Penerapan GMP & SOP', 'Teliti, Konsisten, Kerja Sama Tim', '2025-11-17 21:30:50', '2025-11-27 04:22:20'),
(13, 28, NULL, 'Lengkap', 'Belum menikah', 'Laki-laki', 19, 23, 'SMK, SMA,MA', 'Teknik', 2021, 'Operator', 'Mengoprasikan alat berat, Merawat alat berat, Mengendarai alat berat', 'Komunikasi, Leadership', '2025-11-18 18:52:07', '2025-11-18 18:52:07'),
(14, 29, NULL, 'Lengkap', 'Belum menikah', 'Laki-laki', 19, 23, 'SMK, SMA,MA', 'Teknik', 2021, 'Operator', 'Mengoprasikan alat berat, Merawat alat berat, Mengendarai alat berat', 'Komunikasi, Leadership', '2025-11-18 19:29:24', '2025-11-18 19:29:24');

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
('UFArQ6OL33NlQlsRlp4GFaRVB9jsM2h5Ao1WIwt1', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR1JTeEtUVzVJTUhNQ3ZvdUI5MVNtZzVoT3JsZGZwbG81RFF6NGR4ZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1765336811);

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `company_id`, `posisi`, `created_at`, `updated_at`) VALUES
(23, 12, 'Packaging Operator', '2025-11-17 20:55:47', '2025-11-17 20:55:47'),
(25, 12, 'Quality Assurance', '2025-11-17 21:30:50', '2025-11-17 21:30:50'),
(28, 15, 'Operator', '2025-11-18 18:52:07', '2025-11-18 18:52:07'),
(29, 14, 'Operator', '2025-11-18 19:29:24', '2025-11-18 19:29:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applicants_email_unique` (`email`);

--
-- Indexes for table `applicant_files`
--
ALTER TABLE `applicant_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_files_applicant_id_foreign` (`applicant_id`);

--
-- Indexes for table `applicant_recommendations`
--
ALTER TABLE `applicant_recommendations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applicant_id` (`applicant_id`),
  ADD KEY `vacancy_id` (`vacancy_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_applicant_id_foreign` (`applicant_id`);

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
-- Indexes for table `companies`
--
ALTER TABLE `companies`
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
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qualifications_applicant_id_foreign` (`applicant_id`),
  ADD KEY `fk_qual_vacancy` (`vacancy_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacancies_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `applicant_files`
--
ALTER TABLE `applicant_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `applicant_recommendations`
--
ALTER TABLE `applicant_recommendations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant_files`
--
ALTER TABLE `applicant_files`
  ADD CONSTRAINT `applicant_files_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_file_applicant` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `applicant_recommendations`
--
ALTER TABLE `applicant_recommendations`
  ADD CONSTRAINT `fk_rec_applicant` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rec_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rec_vacancy` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recommend_applicant` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recommend_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_recommend_vacancy` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `archives`
--
ALTER TABLE `archives`
  ADD CONSTRAINT `archives_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD CONSTRAINT `fk_qual_applicant` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qual_vacancy` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_qualifications_vacancy` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `qualifications_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD CONSTRAINT `fk_vacancies_company` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vacancies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
