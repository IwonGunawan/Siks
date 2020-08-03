-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2020 at 04:39 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siks`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_ajar`
--

CREATE TABLE `bidang_ajar` (
  `id` int(10) NOT NULL,
  `judul` varchar(225) NOT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidang_ajar`
--

INSERT INTO `bidang_ajar` (`id`, `judul`, `deleted`) VALUES
(1, 'Aqidah', '0'),
(2, 'Hadist', '0'),
(3, 'Nahwu', '0'),
(4, 'Siroh', '0'),
(5, 'Fikih', '0'),
(6, 'Akhlak', '0'),
(7, 'Muhadatsah', '0'),
(8, 'Mufrodat', '0'),
(9, 'Khot', '0'),
(10, 'IPA', '0'),
(11, 'MTK', '0'),
(12, 'Bhs. Inggris', '0'),
(13, 'Bhs.Indonesia', '0'),
(14, 'Tahfidz', '0'),
(15, 'Tahsin', '0');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `nip` varchar(225) NOT NULL,
  `jk` char(1) NOT NULL DEFAULT '0' COMMENT 'M=pria, F=wanita',
  `tempat_lahir` varchar(225) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text NOT NULL,
  `email` varchar(225) NOT NULL,
  `nohp` varchar(225) NOT NULL,
  `pendidikan_terakhir` varchar(225) NOT NULL,
  `bidang_ajar` varchar(225) NOT NULL,
  `dibuat_tgl` datetime DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  `diubah_tgl` datetime DEFAULT NULL,
  `diubah_oleh` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hafalan`
--

CREATE TABLE `hafalan` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `santri_id` int(11) NOT NULL,
  `kelas` varchar(225) NOT NULL,
  `nama_surat` varchar(225) NOT NULL,
  `ayat_awal` varchar(225) NOT NULL,
  `ayat_akhir` varchar(225) NOT NULL,
  `jmlh_setoran` varchar(225) NOT NULL,
  `catatan` text NOT NULL,
  `dibuat_tgl` datetime DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  `diubah_tgl` datetime DEFAULT NULL,
  `diubah_oleh` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted,  1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `no_induk` varchar(225) NOT NULL,
  `nisn` varchar(225) NOT NULL,
  `jk` char(1) NOT NULL COMMENT '0=pria, 1=wanita',
  `tempat_lahir` varchar(225) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `agama` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL COMMENT 'status dalam keluarga',
  `anak_ke` int(2) NOT NULL,
  `alamat` text NOT NULL,
  `asal_sekolah` varchar(225) NOT NULL,
  `diterima_dikelas` varchar(225) NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `ayah` varchar(225) NOT NULL,
  `ayah_pekerjaan` varchar(225) NOT NULL,
  `ibu` varchar(225) NOT NULL,
  `ibu_pekerjaan` varchar(225) NOT NULL,
  `wali` varchar(225) NOT NULL,
  `wali_pekerjaan` varchar(225) NOT NULL,
  `dibuat_tgl` datetime DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  `diubah_tgl` datetime DEFAULT NULL,
  `diubah_oleh` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_uuid` char(36) NOT NULL,
  `users_name` varchar(225) NOT NULL,
  `users_email` varchar(225) NOT NULL,
  `users_password` varchar(225) NOT NULL,
  `users_level` char(1) NOT NULL COMMENT '0=admin, 1=guru',
  `users_status` char(1) NOT NULL COMMENT '0=active, 1=non active',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(225) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(225) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_uuid`, `users_name`, `users_email`, `users_password`, `users_level`, `users_status`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted`) VALUES
(1, '152d48e7-a68f-3620-94fb-e78e639f1bad', 'Yayi Suaidah', 'admin@gmail.com', '$2y$10$zoOglWgt8hMkUM2T8evfleqSygHjLIU.OWi3Nti9haiCOD.8MrL4W', '0', '0', '2018-07-25 06:38:19', 'yayi', NULL, '0', '0'),
(2, '152d48e7-a68f-3620-94fb-e78e639fb002', 'Siti Fatimah', 'ustadzah1@gmail.com', '$2y$10$zoOglWgt8hMkUM2T8evfleqSygHjLIU.OWi3Nti9haiCOD.8MrL4W', '1', '0', '2018-07-25 06:38:19', 'yayi', NULL, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_ajar`
--
ALTER TABLE `bidang_ajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `hafalan`
--
ALTER TABLE `hafalan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `usersId` (`users_id`),
  ADD KEY `users_id` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_ajar`
--
ALTER TABLE `bidang_ajar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hafalan`
--
ALTER TABLE `hafalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `santri`
--
ALTER TABLE `santri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
