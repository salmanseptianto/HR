-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2024 at 12:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `harian`
--

CREATE TABLE `harian` (
  `id` bigint UNSIGNED NOT NULL,
  `id_marketing` int DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `prospek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `harian`
--

INSERT INTO `harian` (`id`, `id_marketing`, `nama`, `date`, `project`, `pekerjaan`, `alamat`, `prospek`, `foto`, `status`, `created_at`, `updated_at`) VALUES
(26, 3, 'Miftakhul Anam', '2024-09-18 06:27:45', 'sakinah', 'kuli', 'ps batang', 'Prosepek', NULL, 1, '2024-09-18 06:27:45', '2024-09-18 07:18:30'),
(27, 3, 'Miftakhul Anam', '2024-09-18 06:28:02', 'sakinah', 'kuli', 'ps batang', 'Non Prospek', NULL, 1, '2024-09-18 06:28:02', '2024-09-18 07:18:41'),
(28, 3, 'Miftakhul Anam', '2024-09-18 06:28:26', 'sakinah', 'kuli', 'ps batang', 'Non Prospek', NULL, 1, '2024-09-18 06:28:26', '2024-09-18 07:18:43'),
(29, 3, 'Miftakhul Anam', '2024-09-18 06:53:09', 'savill', 'kuli', 'Jl.KH Ahmad Dahlan Rt/05 Rw 06', 'Non Prospek', NULL, 1, '2024-09-18 06:53:09', '2024-09-18 07:19:18'),
(30, 3, 'dwad', '2024-09-18 14:14:34', 'sakinah', 'kuli', 'ps batang', 'prosepek', NULL, 1, '2024-09-18 14:14:34', '2024-09-18 14:14:34'),
(31, 3, 'Miftakhul Anam', '2024-09-18 14:17:38', 'triehans', 'kuli', 'ps batang', 'prosepek', NULL, 1, '2024-09-18 14:17:38', '2024-09-18 14:17:38'),
(32, 3, 'Kapling 1', '2024-09-18 14:18:53', 'triehans', 'kuli', 'ps batang', 'nonprospek', NULL, 1, '2024-09-18 14:18:53', '2024-09-18 14:18:53'),
(44, 3, 'a', '2024-09-19 06:30:03', 'sakinah', '', NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kpis`
--

CREATE TABLE `kpis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bobot` decimal(8,2) NOT NULL,
  `target` decimal(8,2) NOT NULL,
  `realisasi` decimal(8,2) NOT NULL,
  `skor` decimal(8,2) NOT NULL,
  `final_skor` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kpis`
--

INSERT INTO `kpis` (`id`, `nama`, `jabatan`, `desc`, `month`, `year`, `bobot`, `target`, `realisasi`, `skor`, `final_skor`, `created_at`, `updated_at`) VALUES
(14, 'Iqbal Ramadhan', 'Designer HR GROUP', 'Waktu Penyelesaian Tugas yang di berikan', 'Desember', '2024', '15.00', '100.00', '75.00', '75.00', '11.25', '2024-12-04 08:41:24', '2024-12-04 08:41:24'),
(15, 'Iqbal Ramadhan', 'Designer HR GROUP', 'Tingkat Revisi', 'Desember', '2024', '10.00', '100.00', '70.00', '70.00', '7.00', '2024-12-04 08:42:01', '2024-12-04 08:42:01'),
(16, 'Iqbal Ramadhan', 'Designer HR GROUP', 'Kepuasan Klien (Pemesan)', 'Desember', '2024', '15.00', '100.00', '80.00', '80.00', '12.00', '2024-12-04 08:42:36', '2024-12-04 08:42:36'),
(17, 'Iqbal Ramadhan', 'Designer HR GROUP', 'Kualitas Design', 'Desember', '2024', '15.00', '100.00', '75.00', '75.00', '11.25', '2024-12-04 08:43:16', '2024-12-04 08:43:16'),
(18, 'Iqbal Ramadhan', 'Designer HR GROUP', 'Jumlah Konten yang di produksi real dengan apa yang sudah di jadwalkan/rencanakan', 'Desember', '2024', '10.00', '100.00', '55.00', '55.00', '5.50', '2024-12-04 08:51:49', '2024-12-04 08:51:49'),
(19, 'Iqbal Ramadhan', 'Designer HR GROUP', 'Kualitas Konten', 'Desember', '2024', '10.00', '100.00', '70.00', '70.00', '7.00', '2024-12-04 08:52:38', '2024-12-04 08:52:38'),
(20, 'Iqbal Ramadhan', 'Designer HR GROUP', 'Tingkat Konverensi (jumlah pengunjung)', 'Desember', '2024', '10.00', '100.00', '60.00', '60.00', '6.00', '2024-12-04 08:53:21', '2024-12-04 08:53:21'),
(21, 'Iqbal Ramadhan', 'Designer HR GROUP', 'Konsistensi Brending', 'Desember', '2024', '15.00', '100.00', '75.00', '75.00', '11.25', '2024-12-04 08:55:14', '2024-12-04 08:55:14'),
(22, 'Imron Yazid', 'Maintenance', 'Waktu respont terhadap permintaan', 'Desember', '2024', '20.00', '100.00', '60.00', '60.00', '12.00', '2024-12-04 14:18:45', '2024-12-04 14:18:45'),
(23, 'Imron Yazid', 'Maintenance', 'Tingkat penyelesaian Tugas', 'Desember', '2024', '25.00', '100.00', '55.00', '55.00', '13.75', '2024-12-04 14:20:05', '2024-12-04 14:20:05'),
(24, 'Imron Yazid', 'Maintenance', 'Biaya Pemeliharaan (total biaya pemeliharaan dengan anggaran yang di tetapkan)', 'Desember', '2024', '15.00', '100.00', '70.00', '70.00', '10.50', '2024-12-04 14:20:40', '2024-12-04 14:20:40'),
(25, 'Imron Yazid', 'Maintenance', 'Jumlah Kerusakan berulang', 'Desember', '2024', '15.00', '100.00', '80.00', '80.00', '12.00', '2024-12-04 14:21:20', '2024-12-04 14:21:20'),
(26, 'Imron Yazid', 'Maintenance', 'Kepuasan Pengguna', 'Desember', '2024', '25.00', '100.00', '80.00', '80.00', '20.00', '2024-12-04 14:22:09', '2024-12-04 14:22:09'),
(27, 'M Salman Septianto', 'Web Developer', 'Waktu respont terhadap permintaan', 'Desember', '2024', '30.00', '100.00', '80.00', '80.00', '24.00', '2024-12-05 05:06:12', '2024-12-05 05:06:12'),
(28, 'M Salman Septianto', 'Web Developer', 'Tingkat penyelesaian Tugas', 'November', '2021', '25.00', '100.00', '20.00', '20.00', '5.00', '2024-12-06 00:19:14', '2024-12-06 00:19:14'),
(30, 'M Salman Septianto', 'Web Developer', 'Waktu respont terhadap permintaan', 'Desember', '2024', '30.00', '100.00', '80.00', '80.00', '24.00', '2024-12-06 02:43:54', '2024-12-06 02:43:54'),
(32, 'Nur Sholeh', 'Office Boy', 'Frekuensi kebersihan (area yang di bersihkan dalam 1 hari di banding jadwal)', 'Desember', '2024', '15.00', '100.00', '90.00', '90.00', '13.50', '2024-12-06 03:42:28', '2024-12-06 03:42:28'),
(33, 'Nur Sholeh', 'Office Boy', 'Tingkat Kebersihan', 'Desember', '2024', '20.00', '100.00', '85.00', '85.00', '17.00', '2024-12-06 03:43:41', '2024-12-06 03:43:41'),
(34, 'Asikin', 'Security Sakinah Village', 'sasasasas', 'Desember', '2024', '29.00', '100.00', '90.00', '90.00', '26.10', '2024-12-06 06:33:11', '2024-12-06 06:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_09_09_050757_add_role_to_users_table', 2),
(7, '2024_09_10_180441_create_harian_table', 3),
(8, '2024_09_11_083128_create_mingguan_table', 4),
(9, '2024_12_04_101429_kpi', 5);

-- --------------------------------------------------------

--
-- Table structure for table `mingguan`
--

CREATE TABLE `mingguan` (
  `id` bigint UNSIGNED NOT NULL,
  `id_marketing` int DEFAULT '0',
  `projectArea` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode` date NOT NULL,
  `totalJumlahKanva` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlahKanvasTimSeminggu` int NOT NULL,
  `iklanOnline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postingSosmed` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `janjiTemuDanKunjungan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `calonKonsCekLokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalDataLeads` int NOT NULL,
  `dataProspek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotProspek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemberkasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `closingAkadCash` decimal(15,2) NOT NULL,
  `rencanaTargetClosingDalam1Bulan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mingguan`
--

INSERT INTO `mingguan` (`id`, `id_marketing`, `projectArea`, `periode`, `totalJumlahKanva`, `jumlahKanvasTimSeminggu`, `iklanOnline`, `postingSosmed`, `janjiTemuDanKunjungan`, `calonKonsCekLokasi`, `totalDataLeads`, `dataProspek`, `hotProspek`, `booking`, `pemberkasan`, `closingAkadCash`, `rencanaTargetClosingDalam1Bulan`, `status`, `created_at`, `updated_at`) VALUES
(9, 3, 'sakinah', '2024-09-18', '1', 1, '1', '1', '1', '1', 1, '1', '1', '1', '1', '10000000.00', '1', 1, '2024-09-18 06:29:07', '2024-09-18 07:18:55'),
(10, 3, 'savill', '2024-09-19', '21', 22, '22221', '212', '2121', '121', 21, '21212', '121', '2121', '21', '2121.00', '212121', 1, '2024-09-18 13:51:46', '2024-09-18 13:51:46'),
(11, 3, 'triehans', '2024-09-19', '121212', 121212, '1212313132', '2341234', '2334123', '1234', 12341234, '1234123', '423412', '3412412', '234', '234123.00', '23412341', 2, '2024-09-18 13:52:09', '2024-09-18 13:52:09'),
(12, 3, 'sakinah', '2000-09-27', 'adadad2', 1212, 'AWD12', '12DW1D1WD1', '1WDWADsd', 'asDSADsd', 21, 'DS', 'DAdwD', 'D', '121D', '121212.00', 'DWADAWDawD', 2, '2024-09-18 13:52:46', '2024-09-18 13:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('112umarshahib@gmail.com', '$2y$12$qiIW2fDSrx6C1e.9vcBwqOSRwSNqjS.Hwqlbdj8xj6MPwR3TnuW/O', '2024-09-16 23:31:47'),
('umar112shahib@gmail.com', '$2y$12$Q/gNQNtMZ6s7mn003nGrTe3VbsabSZhCoV96qRfMULbm0oNWExkpe', '2024-09-08 22:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'marketing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `jabatan`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'umar', 'admin@gmail.com', '', '2024-09-09 05:13:05', '$2y$12$3QXWPcB4DscfJQwMpdVWze1JbBxInkXj.Ey.J76F8PVMqa4.mEAqa', NULL, '2024-09-09 05:37:05', '2024-09-16 23:20:56', 'admin'),
(2, 'Manager Marketing', 'gm@gmail.com', '', NULL, '$2y$12$nfIGqWOpDsRn3gv6FWnL4uxsyHH2PWswyJWUnq.h5/g56NMQsKk3.', NULL, NULL, NULL, 'gm'),
(3, 'markeing A', 'hrd@gmail.com', '', '2024-09-11 09:51:30', '$2y$12$nfIGqWOpDsRn3gv6FWnL4uxsyHH2PWswyJWUnq.h5/g56NMQsKk3.', NULL, NULL, NULL, 'mh'),
(8, 'Iqbal Ramadhan', 'test@gmail.com', 'Designer HR GROUP', NULL, '$2y$12$ed22CwxMQs6GlspqWU8ZYOGZ4OVXqotOYL/slVhzDvTORqusbHVIq', NULL, '2024-12-04 04:22:09', '2024-12-04 04:22:09', 'hrd'),
(9, 'M Salman Septianto', 'salmanseptianto0@gmail.com', 'Web Developer', NULL, '$2y$12$3BfEYpy2YMVAp8lSn9JS/uTmsQTdu0NznMxp1yHPBVVnv1/t5cFw2', NULL, '2024-12-04 06:07:56', '2024-12-04 06:07:56', 'hrd'),
(10, 'Nur Sholeh', 'ob@gmail.com', 'Office Boy', NULL, '$2y$12$rXhfApi0ukoLJO9O2igjLObyX1jvGVU7vCC3Ub7LBdhoUN.gB4Ft.', NULL, '2024-12-04 08:36:40', '2024-12-04 08:36:40', 'hrd'),
(11, 'Asikin', 'security@gmail.com', 'Security Sakinah Village', NULL, '$2y$12$ebkrfAZDqse.jWjlvCg/7uSNkqkJSrMKqueXKQqnUkz1EKj08lKQe', NULL, '2024-12-04 08:38:02', '2024-12-04 08:38:02', 'hrd'),
(12, 'Bowo', 'bowo@gmail.com', 'Security Triehans Tanjung', NULL, '$2y$12$prWHL0ksXIOjpLE1vIHbNunj5YReGuiGi5J8EPtV9QNEwFBpdaSQm', NULL, '2024-12-04 08:38:34', '2024-12-04 08:38:34', 'hrd'),
(13, 'Imron Yazid', 'maintenance@gmail.com', 'Maintenance', NULL, '$2y$12$v3834iUiKbx.BdtlihNWSuHncVB7KJlZ5Z4PuZKm.5cCG7wuW3lLy', NULL, '2024-12-04 08:39:56', '2024-12-04 08:39:56', 'hrd');

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
-- Indexes for table `harian`
--
ALTER TABLE `harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_harian_users` (`id_marketing`);

--
-- Indexes for table `kpis`
--
ALTER TABLE `kpis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mingguan`
--
ALTER TABLE `mingguan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_mingguan_users` (`id_marketing`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harian`
--
ALTER TABLE `harian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `kpis`
--
ALTER TABLE `kpis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mingguan`
--
ALTER TABLE `mingguan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `harian`
--
ALTER TABLE `harian`
  ADD CONSTRAINT `FK_harian_users` FOREIGN KEY (`id_marketing`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mingguan`
--
ALTER TABLE `mingguan`
  ADD CONSTRAINT `FK_mingguan_users` FOREIGN KEY (`id_marketing`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
