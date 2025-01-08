-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 08, 2025 at 04:39 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pencatatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE `letters` (
  `id` int NOT NULL,
  `tgl` date NOT NULL,
  `no_manifest` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `transporter` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `perusahaan_penghasil` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `satuan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `no_pol` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_supir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `type` enum('incoming','outgoing') COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`id`, `tgl`, `no_manifest`, `transporter`, `perusahaan_penghasil`, `deskripsi_barang`, `qty`, `satuan`, `no_pol`, `nama_supir`, `tgl_kembali`, `keterangan`, `type`, `image`, `created_at`) VALUES
(3, '2024-01-05', 'FST123', 'JNE', 'PT. PERTAMINA', 'asdas', 660000, 'kg', 'asdd', 'Jane Smith', '2024-12-21', 'asdd', 'incoming', 'fe3aaca6b754db24bcc38c1bd2e3f442.jpg', '2024-12-17 09:02:09'),
(8, '2025-01-08', 'asd', 'asdasd', 'dasd', 'asdas', 12312, 'asdasf', 'asd', 'asdas', '2025-01-08', 'asd', 'incoming', '5b1a48e5492c8996760a5b9e910651d2.jpg', '2025-01-08 04:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','superadmin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin123', '$2a$12$XCsg4ZHN5n/2Hh189C84IuC2T3OX1sW/.hkzYWTLqVghFAL8IqJQW', 'admin', '2024-12-17 05:00:00'),
(2, 'superadmin', '$2a$12$3VuCPFhgQpXIrZGVgf9wA.Gmh./zbBk3NuR0GJ6Uka84Awker5qfO', 'superadmin', '2024-12-17 05:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomor_telepon` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id`, `user_id`, `nama_lengkap`, `foto_profil`, `nomor_telepon`, `tanggal_lahir`, `created_at`) VALUES
(1, 1, 'Admin User', 'no-profil.jpg', '08123456789', '1985-06-15', '2024-12-17 05:00:00'),
(2, 2, 'Super Admin', 'no-profil.jpg', '08223456789', '1980-03-22', '2024-12-17 05:05:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_detail_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `letters`
--
ALTER TABLE `letters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `user_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
