-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 02:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nbstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `nama`, `harga`, `gambar`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Mobil', '1280192012', 'images/t9d6vTItvVbQXM4opVdAAGmJ2mwigC0A8QmCcMuJ.png', NULL, '2024-06-01 06:02:28', '2024-06-01 06:02:28'),
(8, 'asas', '12121212231', 'images/1717302420_Frame 1000002771.png', NULL, '2024-06-01 21:25:33', '2024-06-01 21:27:05'),
(9, 'asas', '1212121', 'images/1717302333_Screen Shot 2024-06-01 at 23.47.54.png', NULL, '2024-06-01 21:25:33', '2024-06-01 21:25:33'),
(10, 'asas', '12112', 'images/1717303344_Screen Shot 2024-06-01 at 23.42.28.png', NULL, '2024-06-01 21:42:24', '2024-06-01 21:42:24'),
(11, 'asas', '12112', 'images/1717303354_Desain_tanpa_judul-removebg-preview 2.png', NULL, '2024-06-01 21:42:24', '2024-06-01 21:42:34');

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_06_01_115121_barangs', 1),
(4, '2024_06_01_115201_order', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `barang_id` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `snap_token` varchar(225) NOT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'Pending',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `barang_id`, `harga`, `nama`, `jumlah`, `snap_token`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(24, '5', '8', '12121212231', 'asas', '2', '32af381d-c636-4213-999d-4fb63ba9b0b5', 'Pending', NULL, '2024-06-02 21:06:07', '2024-06-02 21:06:08'),
(25, '5', '8', '12121212231', 'asas', '2', 'a2fbebde-f587-4af5-a6e7-26476c76864a', 'Pending', NULL, '2024-06-02 21:08:34', '2024-06-02 21:08:35'),
(26, '5', '8', '12121212231', 'asas', '2', 'd29a5ace-1197-427b-b585-71d7e84aa7de', 'Success', NULL, '2024-06-02 21:10:19', '2024-06-02 21:10:19'),
(27, '5', '8', '12121212231', 'asas', '2', '79ccc328-ad51-4288-9d41-40c5a871080f', 'Success', NULL, '2024-06-02 21:13:54', '2024-06-02 21:15:44');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL DEFAULT 'user',
  `token` varchar(225) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `level`, `token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'udin', 'udin@gmail.com', '$2y$10$l2s6FqeHGFjkbmc6zBh2f.kcRQEuRbW2Rp.wsPKbZfdGT3yorkQUW', 'admin', '', NULL, '2024-06-01 04:58:41', '2024-06-01 04:58:41'),
(5, 'bibi', 'bibi@gmail.com', '$2y$10$i/QDEeUQGFHfHNxl/Zi6I.pLOfhDqly3FvViD5t/HOpTmlMGMrqmG', 'user', '$2y$10$XOXp3bl0TzrnMzqg5fGgcuH4T.xCWvHH.KSsGpzufqN3DFP.l5SX2', NULL, '2024-06-01 17:58:22', '2024-06-01 17:58:22'),
(6, 'asas', 'asa@gmail.com', '$2y$10$yfhxnIO3O9lvC/pnKQkM.uXLUcw/QRi4In1UM3x/.MptqjPDl.4Pa', 'user', '$2y$10$pnsh76RJAnfwCPJy1B9La.ZPsBORbfdnACIhf4Um.wILA5dXxIW.y', NULL, '2024-06-01 18:13:22', '2024-06-01 18:13:22'),
(7, 'siti', 'siti@gmail.com', '$2y$10$ppqU5ZeHpmbxyehI67mJ5u6kBv/dvdYKwH7DbaeV.t/ZSJLP5YaeW', 'user', 'sLOmUJGjjGmooZT7lnwsdRZXyofOaxVnUlYQSYJ5r9amlSbkDTDQAnRAxauycIXJRuxGM00XkwsmoJSr', NULL, '2024-06-01 23:27:30', '2024-06-01 23:27:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
