-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2026 at 07:19 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classly`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_qr`
--

CREATE TABLE `active_qr` (
  `id` int NOT NULL,
  `qr_code` varchar(100) NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `active_qr`
--

INSERT INTO `active_qr` (`id`, `qr_code`, `create_at`) VALUES
(1, 'Classly-Barcode2026-05-17', '2026-05-17 08:21:56'),
(13, 'Classly-Barcode2026-05-18', '2026-05-18 04:16:50'),
(15, 'Classly-Barcode2026-05-21', '2026-05-21 06:07:38'),
(16, 'Classly-Barcode2026-05-22', '2026-05-22 00:32:58'),
(17, 'Classly-Barcode2026-05-24', '2026-05-24 05:33:47'),
(18, 'Classly-Barcode2026-05-25', '2026-05-25 04:01:48'),
(19, 'Classly-Barcode2026-05-26', '2026-05-26 11:43:32'),
(20, 'Classly-Barcode2026-06-02', '2026-06-02 09:53:44'),
(21, 'Classly-Barcode2026-06-03', '2026-06-03 03:25:47'),
(22, 'Classly-Barcode2026-06-04', '2026-06-04 00:36:04'),
(23, 'Classly-Barcode2026-06-07', '2026-06-07 06:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(225) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `tanggal`, `judul`, `deskripsi`, `created_at`) VALUES
(32, '2026-05-23', 'sample', NULL, '2026-05-22 02:36:28'),
(35, '2026-06-05', 'hhh\r\n\r\n\r\n', NULL, '2026-06-04 00:50:17'),
(38, '2026-06-27', 'mmm', NULL, '2026-06-07 07:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int NOT NULL,
  `qr_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('Present','Permit','Sick','Absent') NOT NULL,
  `surat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `qr_code`, `username`, `date`, `time`, `status`, `surat`) VALUES
(5, '0', 'ginalev', '2026-05-24', '06:59:58', 'Present', NULL),
(16, '0', 'yasssss', '2026-06-02', '12:59:06', 'Present', NULL),
(17, 'izin_1780546547_barcode.png', 'yasssss', '2026-06-04', '04:15:47', 'Permit', 'izin_1780546547_barcode.png'),
(18, '0', 'yasssss', '2026-06-07', '06:54:39', 'Present', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pelajaran`
--

CREATE TABLE `jadwal_pelajaran` (
  `id` int NOT NULL,
  `waktu` varchar(20) DEFAULT NULL,
  `senin` varchar(50) DEFAULT NULL,
  `selasa` varchar(50) DEFAULT NULL,
  `rabu` varchar(50) DEFAULT NULL,
  `kamis` varchar(50) DEFAULT NULL,
  `jumat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jadwal_pelajaran`
--

INSERT INTO `jadwal_pelajaran` (`id`, `waktu`, `senin`, `selasa`, `rabu`, `kamis`, `jumat`) VALUES
(1, 'Jam 1', 'B.Indonesia', 'Matematika', 'B.Inggris', 'B.Jawa', 'KK'),
(2, 'Jam 2', 'B.Indonesia', 'Matematika', 'B.Inggris', 'B.Jawa', 'KK'),
(3, 'Jam 3', 'B.Indonesia', 'Matematika', 'MP', 'PJOK', 'KK'),
(4, 'Jam 4', 'BK', 'PAI', 'MP', 'PJOK', 'KK'),
(5, 'Jam 5', 'KK', 'PAI', 'MP', 'PJOK', 'PKK'),
(6, 'Jam 6', 'KK', 'PAI', 'MP', 'PJOK', 'PKK'),
(7, 'Jam 7', 'KK', 'Sejarah', 'KK', 'KK', 'PKK'),
(8, 'Jam 8', 'KK', 'Sejarah', 'KK', 'KK', 'PKK'),
(9, 'Jam 9', 'KK', 'PP', 'KK', 'KK', 'PKK'),
(10, 'Jam 10', 'KK', 'PP', 'KK', 'KK', 'PKK');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `class_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `class_code`) VALUES
(1, 'xi rpl 2', '33560'),
(2, 'sample2', '090709'),
(3, 'coba1', '55555');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tipe` int DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `class_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `tipe`, `email`, `first_name`, `class_code`) VALUES
('ginalev', 'a1d0ebd2b67566eda756ac8f88a6ced3', 2, 'ginaksammy09@gmail.com', 'ginalev', '33560'),
('indana', 'a63c8af156d2de319edd22829cb15bc4', 2, 'indanamaula@gmail.com', 'indana', '33560'),
('mola', '25d55ad283aa400af464c76d713c07ad', 1, 'maula@gmail.com', 'brooo', '33560'),
('yasssss', '0699e69caccddef0cc87601e882efd87', 2, 'diyas@gmail.com', 'brooo', '33560');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_qr`
--
ALTER TABLE `active_qr`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `qr_code` (`qr_code`),
  ADD UNIQUE KEY `qr_code_2` (`qr_code`),
  ADD KEY `qr_code_3` (`qr_code`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `id_qr` (`qr_code`);

--
-- Indexes for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `class_code` (`class_code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_qr`
--
ALTER TABLE `active_qr`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jadwal_pelajaran`
--
ALTER TABLE `jadwal_pelajaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
